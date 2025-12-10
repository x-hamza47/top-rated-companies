<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ServiceController;

Route::get('/',[HomeController::class, 'index'])->name('home.index');
Route::get('/companies/{subCategorySlug}', [ServiceController::class, 'index'])
    ->name('services.companies');
Route::view('/listicle', 'listicle');;

