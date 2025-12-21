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
route::get('/jadwal', function () {
    return view('frontend.jadwal.index');
})->name('jadwal');
route::get('/pengumuman', function () {
    return view('frontend.pengumuman.index');
})->name('pengumuman');
route::get('/tentang', function () {
    return view('frontend.tentang.index');
})->name('tentang');
route::get('/contact', function () {
    return view('frontend.contact.index');
})->name('contact');