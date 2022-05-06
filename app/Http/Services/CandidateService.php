<?php

namespace App\Http\Services;

use Exception;
use App\Models\Candidate;
use App\Models\Company;
use App\Models\Transaction;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CandidateService
{
    public function contact(Candidate $candidate, Company $company)
    {
        DB::beginTransaction();
        try {
            $amount = config('wallet.charges.contact-candidate');

            if ($company->wallet->coins < $amount) {
                throw new Exception('Insufficient coins to hire candidate. Minimum coins required '.$amount);
            }
            if ($candidate->isContactedBy($company)) {
                throw new Exception('Candidate has already been contacted');
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

            $company->wallet->where("coins", ">=", $amount)
                ->decrement('coins', $amount);

            // @todo
            // dispatch Job => contact email -> aftercommit
            DB::commit();

        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function hire(Candidate $candidate, Company $company)
    {
        if (!$candidate->canBeHiredBy($company)) {
            throw new Exception('Unable to hire candidate.');
        }

        DB::beginTransaction();
        try {
            $amount = config('wallet.charges.contact-candidate');
            $transaction = new Transaction([
                'type' => 'deposit',
                'transaction_id' => Str::uuid(),
                'amount' => $amount,
                'meta' => ['message' => 'Candidate Hired', 'candidate_id' => $candidate->id]
            ]);

            $company->wallet->transactions()->save($transaction);
            $company->wallet->increment('coins', $amount);

            // @todo
            // dispatch Job => Hired email -> aftercommit
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

}