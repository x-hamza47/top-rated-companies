<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Company;
use App\Models\Service;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CompanyController extends Controller
{
    public function index()
    {// ! Companies with specific Columns
        $companies = Company::with([
            'details:id,company_id,hourly_rate_min,hourly_rate_max,employees_min,employees_max,locations',
            'services:id,name'
        ])
        ->select('id','logo', 'verified', 'name', 'tagline', 'created_at')
        ->withCount('services') // Total Services
        ->paginate(10);
         

        return view("dashboard.company.list", compact('companies'));
    }

    public function edit(Company $company){
        $categories = Category::all();
        $company->load(['details', 'services']);
        $allServices = Service::all(); 
        return view('dashboard.company.edit', compact('company', 'categories', 'allServices'));
    }
}
