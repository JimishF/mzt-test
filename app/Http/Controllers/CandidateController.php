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
        $company = Company::find(1);

        $coins = $company->wallet->coins;
        $candidates = Candidate::select('candidates.*', 'company_candidates.status')
            ->leftJoin('company_candidates', 'candidates.id', 'company_candidates.candidate_id')
            ->whereNull('company_id')
            ->orWhere('company_id', $company->id)
            ->get();

        return view('candidates.index', compact('candidates', 'coins'));
    }

    public function contact(Candidate $candidate)
    {
        //@todo get company from auth user
        $company = Company::find(1);

        return $this->candidate->contact($candidate, $company);
    }

    public function hire(Candidate $candidate)
    {
        //@todo get company from auth user
        $company = Company::find(1);

        return $this->candidate->hire($candidate, $company);
    }
}
