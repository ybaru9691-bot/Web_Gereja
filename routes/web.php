<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WartaController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\JemaatController;
use App\Http\Controllers\Admin\WartaController as AdminWartaController;

use App\Http\Controllers\Pendeta\PengumumanController as PendetaPengumumanController;
use App\Http\Controllers\Pendeta\AnalisisController as PendetaAnalisisController;
use App\Http\Controllers\Pendeta\KeuanganController as PendetaKeuanganController;
use App\Models\Pengumuman;
use App\Models\Warta;

use App\Http\Controllers\Admin\JadwalIbadahController;
  use App\Http\Controllers\JadwalController;
  use App\Http\Controllers\ScanController;
use App\Http\Controllers\Admin\ScanLogController;

use App\Models\ScanLog;
use Carbon\Carbon;

use App\Http\Controllers\Admin\KeuanganController;



  





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

Route::get('/warta/{id}/download', [WartaController::class, 'downloadPdf'])
    ->name('warta.download');
 
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
    $jemaatCount = \App\Models\Jemaat::count();

    // Data analisis cluster
    $clusters = \App\Models\AnalisisCluster::select('cluster_label', DB::raw('count(*) as total'))
        ->groupBy('cluster_label')
        ->pluck('total', 'cluster_label')
        ->toArray();

    $labels = ['Aktif', 'Sedang', 'Pasif'];
    $chartData = [];
    foreach ($labels as $label) {
        $chartData[] = $clusters[$label] ?? 0;
    }

    $weeklyScanCount = ScanLog::whereBetween('waktu_scan', [
        Carbon::now()->startOfWeek(),
        Carbon::now()->endOfWeek()
    ])->count();

    $today = Carbon::today();
    $targetSunday = $today->isSunday() ? $today : $today->copy()->previous(Carbon::SUNDAY);

    $pagiCount = ScanLog::whereDate('waktu_scan', $targetSunday)
        ->whereTime('waktu_scan', '>=', '08:00:00')
        ->whereTime('waktu_scan', '<=', '10:00:00')
        ->count();

    $siangCount = ScanLog::whereDate('waktu_scan', $targetSunday)
        ->whereTime('waktu_scan', '>=', '10:30:00')
        ->whereTime('waktu_scan', '<=', '12:30:00')
        ->count();

    $dayNames = ['Senin','Selasa','Rabu','Kamis','Jumat','Sabtu','Minggu'];
    $currentDay = $dayNames[Carbon::now()->dayOfWeekIso - 1];

    return view('admin.dashboard.index', compact('wartaCount', 'jemaatCount', 'chartData', 'weeklyScanCount', 'pagiCount', 'siangCount', 'currentDay'));
})->name('admin.dashboard');

Route::get('/admin/dashboard/scan-by-day', function (Illuminate\Http\Request $request) {
    $day = $request->query('day');
    $dayNames = ['Senin','Selasa','Rabu','Kamis','Jumat','Sabtu','Minggu'];
    if (!in_array($day, $dayNames)) {
        return response()->json(['error' => 'Invalid day'], 400);
    }

    $index = array_search($day, $dayNames); // 0..6 (Senin..Minggu)
    $date = Carbon::now()->startOfWeek()->addDays($index)->toDateString();

    $jadwalExists = \App\Models\JadwalIbadah::whereDate('tanggal', $date)->exists();

    $attendees = \App\Models\ScanLog::whereDate('waktu_scan', $date)->distinct('guest_uuid')->pluck('guest_uuid')->toArray();
    $attendeesCount = count($attendees);

    $latestPeriode = \App\Models\AnalisisCluster::max('periode');
    $clusters = [];
    if (!empty($attendees) && $latestPeriode) {
        $clusters = \App\Models\AnalisisCluster::whereIn('guest_uuid', $attendees)
            ->where('periode', $latestPeriode)
            ->select('cluster_label', DB::raw('count(*) as total'))
            ->groupBy('cluster_label')
            ->pluck('total','cluster_label')
            ->toArray();
    }

    $labels = ['Aktif','Sedang','Pasif'];
    $clusterCounts = [];
    foreach ($labels as $label) {
        $clusterCounts[$label] = $clusters[$label] ?? 0;
    }

    return response()->json([
        'date' => $date,
        'exists' => $jadwalExists,
        'attendees_count' => $attendeesCount,
        'clusters' => $clusterCounts
    ]);
})->name('admin.dashboard.scanByDay');

Route::get('/pendeta/dashboard', function () {
    $wartaCount = \App\Models\Warta::count();
    $pengumumanCount = \App\Models\Pengumuman::count();
    $jemaatCount = \App\Models\Jemaat::count();

    // Data analisis cluster
    $clusters = \App\Models\AnalisisCluster::select('cluster_label', DB::raw('count(*) as total'))
        ->groupBy('cluster_label')
        ->pluck('total', 'cluster_label')
        ->toArray();

    $labels = ['Aktif', 'Sedang', 'Pasif'];
    $chartData = [];
    foreach ($labels as $label) {
        $chartData[] = $clusters[$label] ?? 0;
    }

    $weeklyScanCount = ScanLog::whereBetween('waktu_scan', [
        Carbon::now()->startOfWeek(),
        Carbon::now()->endOfWeek()
    ])->count();

    $today = Carbon::today();
    $targetSunday = $today->isSunday() ? $today : $today->copy()->previous(Carbon::SUNDAY);

    $pagiCount = ScanLog::whereDate('waktu_scan', $targetSunday)
        ->whereTime('waktu_scan', '>=', '08:00:00')
        ->whereTime('waktu_scan', '<=', '10:00:00')
        ->count();

    $siangCount = ScanLog::whereDate('waktu_scan', $targetSunday)
        ->whereTime('waktu_scan', '>=', '10:30:00')
        ->whereTime('waktu_scan', '<=', '12:30:00')
        ->count();

    return view('pendeta.dashboard.index', compact('wartaCount', 'pengumumanCount', 'jemaatCount', 'chartData', 'weeklyScanCount', 'pagiCount', 'siangCount'));
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
   

  // ================= JADWAL IBADAH =================

Route::get('/jadwal-ibadah', [JadwalIbadahController::class, 'index'])
    ->name('admin.jadwal.index');

Route::get('/jadwal-ibadah/create', [JadwalIbadahController::class, 'create'])
    ->name('admin.jadwal.create');

Route::post('/jadwal-ibadah', [JadwalIbadahController::class, 'store'])
    ->name('admin.jadwal.store');

// ✏️ EDIT
Route::get('/jadwal-ibadah/{id}/edit', [JadwalIbadahController::class, 'edit'])
    ->name('admin.jadwal.edit');

// 💾 UPDATE
Route::put('/jadwal-ibadah/{id}', [JadwalIbadahController::class, 'update'])
    ->name('admin.jadwal.update');

// 🗑 DELETE
Route::delete('/jadwal-ibadah/{id}', [JadwalIbadahController::class, 'destroy'])
    ->name('admin.jadwal.destroy');

// ================= SCAN LOG =================
Route::get('/scan', [ScanLogController::class, 'index'])
    ->name('admin.scan.index');

    // ================= ANALISIS JEMAAT =================
Route::get('/analisis', [\App\Http\Controllers\Admin\AnalisisClusterController::class, 'index'])
    ->name('admin.analisis.index');

Route::post('/analisis/hitung', [\App\Http\Controllers\Admin\AnalisisClusterController::class, 'hitung'])
    ->name('admin.analisis.hitung');


// ================= KEUANGAN JEMAAT =================
// ================= KEUANGAN JEMAAT =================
Route::get('/keuangan', [KeuanganController::class, 'index'])
    ->name('admin.keuangan.index');

Route::get('/keuangan/create', [KeuanganController::class, 'create'])
    ->name('admin.keuangan.create');

Route::post('/keuangan', [KeuanganController::class, 'store'])
    ->name('admin.keuangan.store');

    
});


Route::get('/scan/{uuid_jadwal}', [ScanController::class, 'scan'])
    ->name('scan.jadwal');


/*
|--------------------------------------------------------------------------
| PENDETA
|--------------------------------------------------------------------------
*/
Route::get('/pendeta/keuangan', [PendetaKeuanganController::class, 'index'])
    ->name('pendeta.keuangan');





Route::prefix('pendeta')->group(function () {
    Route::get('/pengumuman', [PendetaPengumumanController::class, 'index'])->name('pendeta.pengumuman');
    Route::get('/pengumuman/create', [PendetaPengumumanController::class, 'create']);
    Route::post('/pengumuman', [PendetaPengumumanController::class, 'store']);
    Route::get('/pengumuman/{id}/edit', [PendetaPengumumanController::class, 'edit']);
    Route::put('/pengumuman/{id}', [PendetaPengumumanController::class, 'update']);
    Route::delete('/pengumuman/{id}', [PendetaPengumumanController::class, 'destroy']);
    Route::get('/analisis', [PendetaAnalisisController::class, 'index'])->name('pendeta.analisis');
    Route::post('/analisis/hitung', [PendetaAnalisisController::class, 'hitung'])->name('pendeta.analisis.hitung');
    Route::get('/analisis/detail', [PendetaAnalisisController::class, 'detail'])->name('pendeta.analisis.detail');
    Route::get('/analisis/download', [PendetaAnalisisController::class, 'downloadPdf'])->name('pendeta.analisis.download');
});