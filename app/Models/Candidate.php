<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Candidate extends Model
{
    use HasFactory;

    protected $casts = [
        'strengths' => 'json'
    ];

    public function companiesPivot()
    {
        return $this->hasMany(CompanyCandidate::class);
    }

    public function companies()
    {
        return $this->belongsToMany(Company::class, 'company_candidates')->withTimestamps();
    }

    public function isContactedBy(Company $company)
    {
        return $this->companiesPivot()
            ->where('company_id', $company->id)->exists();
    }

    public function hiredBy()
    {
        return $this->companiesPivot()->where('status', 'hired')->first();
    }

    public function canBeHiredBy(Company $company)
    {
        $alreadyHiredBy = $this->hiredBy();
        return !$alreadyHiredBy && $this->isContactedBy($company);
    }
}
