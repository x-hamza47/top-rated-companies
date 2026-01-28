<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Package;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class PackageController extends Controller
{
    public function list()
    {
        $user = Auth::user();
        if (Gate::allows('admin')) {
            $packages = Company::withCount('packages')->paginate(10);

            return view('dashboard.packages.list', compact('companies'));
        }

        $packages = Package::with('service')
        ->where('company_id', $user->company_id)
        ->get();

        return view('dashboard.packages.list', compact('packages'));
    }
}
