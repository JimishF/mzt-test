<?php

namespace App\Http\Controllers;

use Exception;
use App\Http\Services\CandidateService;
use App\Models\Candidate;
use App\Models\Company;

class CandidateController extends Controller
{
    protected CandidateService $candidateService;

    public function __construct(CandidateService $candidateService)
    {
        $this->candidateService = $candidateService;
    }

    public function index()
    {
        $company = Company::find(1);
        return $this->candidateService->listFor($company);
    }

    public function contact(Candidate $candidate)
    {
        //@todo get company from auth user
        $company = Company::find(1);
        try {
            $this->candidateService->contact($candidate, $company);
            return response()->json(['message' => 'Candidate has been contacted.']);
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()], 422);
        }
    }

    public function hire(Candidate $candidate)
    {
        //@todo get company from auth user
        $company = Company::find(1);
        try {
            $this->candidateService->hire($candidate, $company);
            return response()->json(['message' => 'Candidate has been hired.']);

        } catch (Exception  $e) {
            return response()->json(['message' => $e->getMessage()], 422);
        }
    }
}
