<?php
use Illuminate\Support\Facades\Route;

Route::view('/','home/home')->name('home');
Route::view('/listicle', 'listicle');;

