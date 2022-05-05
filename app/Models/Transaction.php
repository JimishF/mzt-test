<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = ['type', 'amount', 'meta', 'transaction_id'];
    protected $casts = ['meta' => 'json'];

    public function scopeOfType($query, $type)
    {
        return $query->where('type', $type);
    }

    public function wallet()
    {
        return $this->belongsTo(Wallet::class);
    }

}
