<?php

namespace App\Http\Controllers;

use App\Models\ScanLog;
use App\Models\JadwalIbadah;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Cookie;

class ScanController extends Controller
{
    public function scan($id_jadwal)
    {
        // 1️⃣ Ambil jadwal ibadah
        $jadwal = JadwalIbadah::where('id_jadwal', $id_jadwal)->firstOrFail();

        // 2️⃣ Waktu sekarang
        $now = Carbon::now('Asia/Jakarta');

        // 3️⃣ Waktu mulai ibadah (Ganti titik ke titik dua agar Carbon bisa parse dengan benar)
        $cleanTime = str_replace('.', ':', $jadwal->waktu_mulai);
        $waktuMulai = Carbon::parse(
            $jadwal->tanggal . ' ' . $cleanTime,
            'Asia/Jakarta'
        );

        // 4️⃣ Tentukan status kehadiran
        $selisih = 0;
        if ($now->lessThanOrEqualTo($waktuMulai)) {
            $kehadiran = 'tepat';
        } else {
            $selisih = $waktuMulai->diffInMinutes($now);

            if ($selisih <= 5) {
                $kehadiran = 'tepat';
            } elseif ($selisih <= 15) {
                $kehadiran = 'terlambat';
            } else {
                $kehadiran = 'terlambat_berat';
            }
        }

        // 5️⃣ Guest UUID (SESSION + COOKIE → STABIL)
        if (Cookie::has('guest_uuid')) {
            $guest_uuid = Cookie::get('guest_uuid');
        } elseif (session()->has('guest_uuid')) {
            $guest_uuid = session('guest_uuid');
        } else {
            $guest_uuid = (string) Str::uuid();

            session(['guest_uuid' => $guest_uuid]);
            Cookie::queue('guest_uuid', $guest_uuid, 60 * 24 * 30); // 30 hari
        }

        // 6️⃣ Cegah scan ganda pada jadwal yang sama
        $alreadyScan = ScanLog::where('guest_uuid', $guest_uuid)
            ->where('jadwal_id', $jadwal->id_jadwal)
            ->exists();

        if ($alreadyScan) {
            return view('admin.scan.result', [
                'status'  => 'duplicate',
                'message' => 'Anda sudah melakukan scan untuk jadwal ini.'
            ]);
        }

        // 7️⃣ Simpan scan log
        ScanLog::create([
            'guest_uuid'       => $guest_uuid,
            'jadwal_id'        => $jadwal->id_jadwal,
            'warta_id'         => $jadwal->warta_id ?? 1,
            'waktu_scan'       => $now,
            'status_kehadiran' => $kehadiran,
            'selisih_menit'    => $selisih
        ]);

        // 8️⃣ Tampilkan hasil
        return view('admin.scan.result', [
            'status'    => 'success',
            'kehadiran' => $kehadiran,
            'jadwal'    => $jadwal
        ]);
    }
}
