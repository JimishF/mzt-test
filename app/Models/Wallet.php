<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wallet extends Model
{
    use HasFactory;

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

    public function depositTransactions()
    {
        return $this->transactions()->ofType('deposit');
    }

    public function withdrawTransactions()
    {
        return $this->transactions()->ofType('withdraw');
    }
}
