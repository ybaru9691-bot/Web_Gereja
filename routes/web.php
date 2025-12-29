<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WartaController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\JemaatController;
use App\Http\Controllers\Admin\WartaController as AdminWartaController;



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('frontend.home');
})->name('home');

/* ================= LOGIN ================= */
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.process');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/admin/dashboard', function () {
    return view('admin.dashboard');
})->name('admin.dashboard');

/* ================= FRONTEND ================= */
Route::get('/warta', [WartaController::class, 'index'])
    ->name('warta.index');

Route::get('/warta/{id}', [WartaController::class, 'show'])
    ->name('warta.show');

Route::get('/jadwal', function () {
    return view('frontend.jadwal.index');
})->name('jadwal');

Route::get('/pengumuman', function () {
    return view('frontend.pengumuman.index');
})->name('pengumuman');

Route::get('/tentang', function () {
    return view('frontend.tentang.index');
})->name('tentang');

Route::get('/contact', function () {
    return view('frontend.contact.index');
})->name('contact');



/* ================= DASHBOARD ================= */
Route::get('/admin/dashboard', function () {
    return view('admin.dashboard.index');
})->name('admin.dashboard');

Route::get('/pendeta/dashboard', function () {
    return view('pendeta.dashboard.index');
})->name('pendeta.dashboard');

/*
|--------------------------------------------------------------------------
| ADMIN
|--------------------------------------------------------------------------
*/

Route::prefix('admin')->group(function () {

    Route::get('/jemaat', [JemaatController::class, 'index']);
    Route::get('/jemaat/create', [JemaatController::class, 'create']);
    Route::post('/jemaat', [JemaatController::class, 'store']);
    Route::get('/jemaat/{id}/edit', [JemaatController::class, 'edit']);
    Route::put('/jemaat/{id}', [JemaatController::class, 'update']);
    Route::delete('/jemaat/{id}', [JemaatController::class, 'destroy']);
    Route::get('/warta', [AdminWartaController::class, 'index']);
    Route::get('/warta/create', [AdminWartaController::class, 'create']);
    Route::post('/warta', [AdminWartaController::class, 'store']);
    Route::get('/warta/{id}', [WartaController::class, 'show'])->name('warta.show');
 // ✏️ EDIT
    Route::get('/warta/{id}/edit', [App\Http\Controllers\Admin\WartaController::class, 'edit']);
    Route::put('/warta/{id}', [App\Http\Controllers\Admin\WartaController::class, 'update']);

    // 🗑 HAPUS
    Route::delete('/warta/{id}', [App\Http\Controllers\Admin\WartaController::class, 'destroy']);
    
});

/*
|--------------------------------------------------------------------------
| PENDETA
|--------------------------------------------------------------------------
*/
