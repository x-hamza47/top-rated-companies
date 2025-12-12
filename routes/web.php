<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ServiceController;

Route::get('/',[HomeController::class, 'index'])->name('home.index');
Route::get('/companies/{serviceSlug}', [ServiceController::class, 'index'])->name('services.companies');
Route::get('/profile/{companySlug}', [ProfileController::class, 'index'])->name('profile.index');

