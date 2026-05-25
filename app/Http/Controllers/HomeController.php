<?php

namespace App\Http\Controllers;

// use App\Models\Category;
use App\Models\Service;
// use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $services = Service::where('status', 1)->limit(6)->get(['id', 'name', 'slug']);
        return view('home.home', compact('services'));
    }

}
