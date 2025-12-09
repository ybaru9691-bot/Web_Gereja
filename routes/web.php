<?php
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('frontend.home');
})->name('home');

Route::get('/login', function () {
    return view('auth.login');
})->name('login');
