<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){
        $categories = Category::with(['subCategories' => function($q){
            $q->where('status', 1);
        }])->where('status', 1)->get();

        return view('home.home', compact('categories'));
    }
}
