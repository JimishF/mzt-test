<?php
namespace  App\Http\Repositories;

use App\Models\Candidate;
use App\Models\Company;

class CandidateRepository {
     public function contact(Candidate $candidate, Company $company)
    {
        // @todo
        // has enough balance
        // if candidate is not already contacted
        // dispatch Job => contact email -> aftercommit
        // add debit entry in transactions table
        // debit - 5 from balance
        // if new balance != balance - 5  rollback
    }

    public function hire(Candidate $candidate, Company $company)
    {
        // @todo
        // if candidate is already contacted by company
        // if candidate is not already hired
        // dispatch Job => Hired email -> aftercommit
        // add  credit entry in transactions table
        // credit +5 to balance
        // if new balance != balance+5  rollback
    }
}