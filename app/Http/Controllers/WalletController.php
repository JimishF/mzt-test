<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;

class WalletController extends Controller
{
    public function show()
    {
        //@todo get company from auth user
        $company = Company::find(1);
        return $company->wallet;
    }
}
