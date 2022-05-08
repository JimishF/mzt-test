<?php

namespace App\Http\Services;

use App\Jobs\SendContactedEmailJob;
use App\Mail\CandidateContactedMail;
use Exception;
use App\Models\Candidate;
use App\Models\Company;
use App\Models\Transaction;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Ramsey\Collection\Collection;

class CandidateService
{
    public function listFor($company): Collection
    {
        $candidates = Candidate::with('companiesPivot')->get();
        $candidates = $candidates->filter(function ($candidate) use ($company) {
            if (!$candidate->companiesPivot->count()) {
                return true;
            }

            $companyHired = $candidate->hiredBy();
            if ($companyHired) {
                return $companyHired->company_id == $company->id;
            }

            return true;
        });
        return $candidates->values();
    }

    /**
     * @throws Exception
     */
    public function contact(Candidate $candidate, Company $company)
    {
        DB::beginTransaction();
        try {
            $amount = config('wallet.charges.candidate');
            if ($company->wallet->coins < $amount) {
                throw new Exception('Insufficient coins to hire candidate. Minimum coins required ' . $amount);
            }
            if ($candidate->isContactedBy($company)) {
                throw new Exception('Candidate has already been contacted');
            }

            $transaction = new Transaction([
                'type' => 'withdraw',
                'transaction_id' => Str::uuid(),
                'amount' => $amount,
                'meta' => ['message' => 'Candidate Contacted', 'candidate_id' => $candidate->id]
            ]);

            $company->wallet->transactions()->save($transaction);

            $company->wallet->where("coins", ">=", $amount)
                ->decrement('coins', $amount);

            $candidate->companies()
                ->syncWithPivotValues([$company->id], ['status' => 'contacted'], false);

            // @todo
            // dispatch Job => contact email -> aftercommit

            SendContactedEmailJob::dispatch($candidate, $company)->afterCommit();

            DB::commit();

        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    /**
     * @throws Exception
     */
    public function hire(Candidate $candidate, Company $company)
    {

        if (!$candidate->canBeHiredBy($company)) {
            throw new Exception('Unable to hire candidate.');
        }

        DB::beginTransaction();
        try {
            $amount = config('wallet.charges.candidate');
            $transaction = new Transaction([
                'type' => 'deposit',
                'transaction_id' => Str::uuid(),
                'amount' => $amount,
                'meta' => ['message' => 'Candidate Hired', 'candidate_id' => $candidate->id]
            ]);

            $company->wallet->transactions()->save($transaction);
            $company->wallet->increment('coins', $amount);

            $candidate->companies()
                ->syncWithPivotValues([$company->id], ['status' => 'hired'], false);
            // @todo
            // dispatch Job => Hired email -> aftercommit

            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }

    }

}