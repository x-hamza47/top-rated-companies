<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ViewController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\NetworkController;
use Illuminate\Support\Facades\Route;

Route::get('/', [ViewController::class, 'index'])->name('home');
Route::get('/listicle', [ViewController::class, 'listicle']);
Route::get('/plans', [ViewController::class, 'plans']);
Route::get('/network/{company}', [NetworkController::class, 'network'])->name('network');
Route::get('/profile/{company}', [ProfileController::class, 'profile'])->name('profile');
Route::get('/{category}', [CategoryController::class, 'category'])->name('category');
Route::get('/{category}/{service}', [ServiceController::class, 'service'])->name('service');

//? Ajax Route
Route::get('/profile/{company}/project-sizes', [ProfileController::class, 'projectSizes']);
