<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Candidate extends Model
{
    use HasFactory;

    public function companiesContacted()
    {
        return $this->belongsToMany(Company::class, 'company_candidates')->withTimestamps();;
    }

    public function isContactedBy(Company $company) {
        return $this->companiesContacted()->where('company_id', $company->id)->exists();
    }
    public function canBeHiredBy(Company $company)
    {
        $company = $this->companiesContacted()->where('company_id', $company->id)->first();
        return $company && $company->pivot->status === 'contacted';
    }
}
