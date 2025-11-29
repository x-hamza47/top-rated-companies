<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        if ($request->username == "admin" && $request->password == "123") {
            return "Correct";
        }
        return view('auth.login');
    }
}
