<?php

namespace App\Http\Controllers;

use App\Http\Repositories\CandidateRepository;
use App\Models\Candidate;
use App\Models\Company;

class CandidateController extends Controller
{
    protected CandidateRepository $candidate;

    public function __construct(CandidateRepository $candidateRepository)
    {
        $this->candidate = $candidateRepository;
    }

    public function index()
    {
        $candidates = Candidate::all();
        $coins = Company::find(1)->coins;
        return view('candidates.index', compact('candidates', 'coins'));
    }

    public function contact(Candidate $candidate)
    {
        //@todo get company from auth user
        $company = Company::find(1);

        return $this->candidate->hire($candidate, $company);
    }

    public function hire(Candidate $candidate)
    {
        //@todo get company from auth user
        $company = Company::find(1);

        return $this->candidate->hire($candidate, $company);
    }
}
