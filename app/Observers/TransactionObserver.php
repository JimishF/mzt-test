<?php

namespace App\Observers;

use App\Models\Transaction;

class TransactionObserver
{
    /**
     * Handle the Transaction "created" event.
     *
     * @param \App\Models\Transaction $transaction
     * @return void
     */
    public function created(Transaction $transaction)
    {
        if ($transaction->type === 'deposit') {
            $transaction->wallet->increment('coins', $transaction->amount);
        } else {
            $transaction->wallet->decrement('coins', $transaction->amount);
        }
    }

    /**
     * Handle the Transaction "updated" event.
     *
     * @param \App\Models\Transaction $transaction
     * @return void
     */
    public function updated(Transaction $transaction)
    {
        //
    }

    /**
     * Handle the Transaction "deleted" event.
     *
     * @param \App\Models\Transaction $transaction
     * @return void
     */
    public function deleted(Transaction $transaction)
    {
        //
    }

    /**
     * Handle the Transaction "restored" event.
     *
     * @param \App\Models\Transaction $transaction
     * @return void
     */
    public function restored(Transaction $transaction)
    {
        //
    }

    /**
     * Handle the Transaction "force deleted" event.
     *
     * @param \App\Models\Transaction $transaction
     * @return void
     */
    public function forceDeleted(Transaction $transaction)
    {
        //
    }
}
