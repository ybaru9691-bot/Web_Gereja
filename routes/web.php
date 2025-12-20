<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WartaController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('frontend.home');
})->name('home');

Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::get('/warta', [WartaController::class, 'index'])
    ->name('warta.index');

Route::get('/warta/{id}', [WartaController::class, 'show'])
    ->name('warta.show');
