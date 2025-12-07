<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;

class NetworkController extends Controller
{
    public function network($company)
    {
        $currentCompany = Company::where('name', $company)->first();
        $network = $currentCompany->networks;
        return view('network', compact('company'));
    }
}
