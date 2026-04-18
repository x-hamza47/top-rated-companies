<?php

namespace App\Http\Controllers;

// use App\Models\Category;
use App\Models\Service;
// use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){
        $services = Service::where('status', 1)->get(['id', 'name', 'slug']);
        // $dev = Category::where('name', 'Marketing')->with('services:id,category_id,name')->first();
        
        return view('home.home', compact('services'));
    }

}
