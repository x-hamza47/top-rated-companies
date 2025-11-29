<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
})->name('home');
Route::get('/listicle', function () {
    return view('listicle');
})->name('listicle');

Route::get('/login', [AuthController::class, 'index'])->name('loginForm');
Route::post('/login', [AuthController::class, 'login'])->name('login');
