<?php

namespace App\Http\Controllers;

use App\Models\ScanLog;
use App\Models\JadwalIbadah;
use Carbon\Carbon;
use Illuminate\Support\Str;

class ScanController extends Controller
{
    public function scan($id_jadwal)
    {
        // 1️⃣ Ambil jadwal ibadah (INI YANG KAMU LUPA)
        $jadwal = JadwalIbadah::where('id_jadwal', $id_jadwal)->firstOrFail();

        // 2️⃣ Waktu sekarang
        $now = Carbon::now('Asia/Jakarta');

        // 3️⃣ Waktu mulai ibadah
        $waktuMulai = Carbon::parse(
            $jadwal->tanggal . ' ' . $jadwal->waktu_mulai
        );

        // 4️⃣ Hitung selisih menit
       if ($now->lessThanOrEqualTo($waktuMulai)) {
    // Scan sebelum atau tepat waktu ibadah
    $kehadiran = 'tepat';
} else {
    // Scan setelah ibadah dimulai
    $selisih = $waktuMulai->diffInMinutes($now);

    if ($selisih <= 5) {
        $kehadiran = 'tepat';
    } elseif ($selisih <= 15) {
        $kehadiran = 'terlambat';
    } else {
        $kehadiran = 'terlambat_berat';
    }
}


        // 5️⃣ Guest UUID (ID palsu)
        if (!session()->has('guest_uuid')) {
            session(['guest_uuid' => (string) Str::uuid()]);
        }

        $guest_uuid = session('guest_uuid');

        // 6️⃣ Cegah scan ganda
        $alreadyScan = ScanLog::where('guest_uuid', $guest_uuid)
            ->where('jadwal_id', $jadwal->id_jadwal)
            ->exists();

        if ($alreadyScan) {
            return view('admin.scan.result', [
                'status'  => 'duplicate',
                'message' => 'Anda sudah melakukan scan untuk jadwal ini.'
            ]);
        }

        // 7️⃣ Simpan scan
        ScanLog::create([
            'guest_uuid'       => $guest_uuid,
            'jadwal_id'        => $jadwal->id_jadwal,
            'warta_id'         => $jadwal->warta_id ?? 1,
            'waktu_scan'       => $now,
            'status_kehadiran' => $kehadiran
        ]);

        // 8️⃣ Tampilkan hasil
        return view('admin.scan.result', [
            'status'    => 'success',
            'kehadiran' => $kehadiran,
            'jadwal'    => $jadwal
        ]);
    }
}
