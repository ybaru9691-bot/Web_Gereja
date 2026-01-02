<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WartaController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\JemaatController;
use App\Http\Controllers\Admin\WartaController as AdminWartaController;

use App\Http\Controllers\Pendeta\PengumumanController as PendetaPengumumanController;
use App\Models\Pengumuman;
use App\Models\Warta;

use App\Http\Controllers\Admin\JadwalIbadahController;
  use App\Http\Controllers\JadwalController;




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

// Password reset routes — direct reset (no email link)
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

Route::get('/forgot-password', function () {
    return view('auth.forgot');
})->name('password.request');

Route::post('/forgot-password', function (Request $request) {
    // Validate email and new password (confirmation required)
    $request->validate([
        'email' => 'required|email',
        'password' => 'required|min:8|confirmed',
    ]);

    // Find the user by email
    $user = User::where('email', $request->email)->first();

    // For security/privacy, always return same success message whether user exists or not
    if ($user) {
        $user->password = Hash::make($request->password);
        $user->setRememberToken(Str::random(60));
        $user->save();
    }

    return redirect()->route('login')->with('status', 'Password berhasil direset. Silakan login dengan password baru.');
})->name('password.update');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');



/* ================= FRONTEND ================= */
Route::get('/warta', [WartaController::class, 'index'])
    ->name('warta.index');

Route::get('/warta/{id}', [WartaController::class, 'show'])
    ->name('warta.show');
 
Route::get('/jadwal', [JadwalController::class, 'index'])
    ->name('jadwal');
    
Route::get('/jadwal/{id}', [JadwalController::class, 'show'])
    ->name('jadwal.show');

Route::get('/pengumuman', function () {
    $pengumuman = Pengumuman::latest('created_at')->get();
    $highlight = $pengumuman->first();
    return view('frontend.pengumuman.index', compact('pengumuman', 'highlight'));
})->name('pengumuman');

Route::get('/tentang', function () {
    return view('frontend.tentang.index');
})->name('tentang');

Route::get('/contact', function () {
    return view('frontend.contact.index');
})->name('contact');



/* ================= DASHBOARD ================= */
Route::get('/admin/dashboard', function () {
    $wartaCount = Warta::count();
    return view('admin.dashboard.index', compact('wartaCount'));
})->name('admin.dashboard');

Route::get('/pendeta/dashboard', function () {
    $wartaCount = \App\Models\Warta::count();
    $pengumumanCount = \App\Models\Pengumuman::count();
    return view('pendeta.dashboard.index', compact('wartaCount', 'pengumumanCount'));
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

     // ================= JADWAL IBADAH =================
   

   Route::get('/jadwal-ibadah', [JadwalIbadahController::class, 'index'])
        ->name('admin.jadwal.index');

    Route::get('/jadwal-ibadah/create', [JadwalIbadahController::class, 'create'])
        ->name('admin.jadwal.create');

    Route::post('/jadwal-ibadah', [JadwalIbadahController::class, 'store'])
        ->name('admin.jadwal.store');
});

/*
|--------------------------------------------------------------------------
| PENDETA
|--------------------------------------------------------------------------
*/
Route::get('/pendeta/keuangan', function () {
    return view('pendeta.keuangan.index');
})->name('pendeta.keuangan');





Route::prefix('pendeta')->group(function () {
    Route::get('/pengumuman', [PendetaPengumumanController::class, 'index'])->name('pendeta.pengumuman');
    Route::get('/pengumuman/create', [PendetaPengumumanController::class, 'create']);
    Route::post('/pengumuman', [PendetaPengumumanController::class, 'store']);
    Route::get('/pengumuman/{id}/edit', [PendetaPengumumanController::class, 'edit']);
    Route::put('/pengumuman/{id}', [PendetaPengumumanController::class, 'update']);
    Route::delete('/pengumuman/{id}', [PendetaPengumumanController::class, 'destroy']);
});