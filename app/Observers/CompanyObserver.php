<?php

namespace App\Observers;

use App\Models\Company;
use App\Models\Transaction;
use App\Models\Wallet;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CompanyObserver
{
    /**
     * Handle the Company "created" event.
     *
     * @param \App\Models\Company $company
     * @return void
     */
    public function created(Company $company)
    {
        $company->wallet()->save(new Wallet(['coins' => 0]));
        DB::transaction(function () use ($company) {

            $credits = config('wallet.initial-credits.company');
            $transaction = new Transaction([
                'type' => 'deposit',
                'transaction_id' => Str::uuid(),
                'amount' => $credits,
                'meta' => ['message' => 'Initial Credit']
            ]);

            $company->wallet->transactions()->save($transaction);
            $company->wallet->increment('coins', $credits);
        });
    }

    /**
     * Handle the Company "updated" event.
     *
     * @param \App\Models\Company $company
     * @return void
     */
    public function updated(Company $company)
    {
        //
    }

    /**
     * Handle the Company "deleted" event.
     *
     * @param \App\Models\Company $company
     * @return void
     */
    public function deleted(Company $company)
    {
        //
    }

    /**
     * Handle the Company "restored" event.
     *
     * @param \App\Models\Company $company
     * @return void
     */
    public function restored(Company $company)
    {
        //
    }

    /**
     * Handle the Company "force deleted" event.
     *
     * @param \App\Models\Company $company
     * @return void
     */
    public function forceDeleted(Company $company)
    {
        //
    }
}
