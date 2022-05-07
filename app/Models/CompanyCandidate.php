<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyCandidate extends Model
{
    use HasFactory;
    protected $fillable = ['company_id', 'candidate_id', 'status'];
}
