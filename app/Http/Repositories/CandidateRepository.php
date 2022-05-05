<?php

namespace App\Http\Repositories;

use App\Models\Candidate;
use App\Models\Company;
use App\Models\Transaction;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CandidateRepository
{
    public function contact(Candidate $candidate, Company $company)
    {
        DB::beginTransaction();
        $amount = config('wallet.charges.contact-candidate');

        if ($company->wallet->coins < $amount || $candidate->isContactedBy($company)) {
//            @todo construct response
            abort(400);
        }


        $candidate->companiesContacted()
            ->syncWithPivotValues([$company->id], ['status' => 'contacted'], false);


        $transaction = new Transaction([
            'type' => 'withdraw',
            'transaction_id' => Str::uuid(),
            'amount' => $amount,
            'meta' => ['message' => 'Candidate Contacted', 'candidate_id' => $candidate->id]
        ]);

        $company->wallet->transactions()->save($transaction);

        // @todo
        // dispatch Job => contact email -> aftercommit
        DB::commit();
        return [];

    }

    public function hire(Candidate $candidate, Company $company)
    {
        if (!$candidate->canBeHiredBy($company)) {
//            @todo construct response
            abort(400);
        }
        DB::beginTransaction();

        $amount = config('wallet.charges.contact-candidate');
        $company->wallet->transaction()->create([
            'type' => 'deposit',
            'amount' => $amount,
            'meta' => ['message' => 'Candidate Hired', 'candidate_id' => $candidate->id]
        ]);

        // @todo
        // dispatch Job => Hired email -> aftercommit

        DB::commit();
        return [];
    }

}