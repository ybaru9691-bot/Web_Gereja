<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ScanLog;
use App\Models\JadwalIbadah;
use Carbon\Carbon;

class ScanLogController extends Controller
{
    public function index()
    {
        // Ambil logs (tanpa eager load jadwal dulu)
        $logs = ScanLog::with('warta')
            ->orderBy('waktu_scan', 'desc')
            ->paginate(10);

        // Kumpulkan tanggal unik dari page saat ini
        $dates = $logs->pluck('waktu_scan')
            ->map(function($t) { return Carbon::parse($t)->toDateString(); })
            ->unique()
            ->values()
            ->toArray();

        // Ambil semua jadwal pada tanggal-tanggal tersebut
        $jadwalsByDate = JadwalIbadah::whereIn('tanggal', $dates)->get()->groupBy('tanggal');

        // Untuk setiap log, jika tidak punya jadwal terkait, coba inference berdasarkan waktu
        foreach ($logs as $log) {
            if ($log->jadwal) continue; // sudah ada relasi

            $date = Carbon::parse($log->waktu_scan)->toDateString();
            if (! isset($jadwalsByDate[$date])) continue;

            $time = Carbon::parse($log->waktu_scan);
            $matched = null;

            // 1) Coba match strict: antara start..end
            foreach ($jadwalsByDate[$date] as $jadwal) {
                // normalize waktu_mulai / waktu_selesai
                $start = Carbon::parse($date . ' ' . str_replace('.', ':', $jadwal->waktu_mulai));

                if ($jadwal->waktu_selesai) {
                    $end = Carbon::parse($date . ' ' . str_replace('.', ':', $jadwal->waktu_selesai));
                } else {
                    // jika tidak ada waktu selesai, anggap durasi 3 jam sebagai fallback
                    $end = (clone $start)->addHours(3);
                }

                if ($time->between($start, $end)) {
                    $matched = $jadwal;
                    $matched->inference_method = 'between';
                    break;
                }
            }

            // 2) Jika tidak ada match strict, cari jadwal terdekat pada tanggal yang sama (within threshold)
            if (!$matched) {
                $best = null;
                $bestDiff = null; // minutes
                foreach ($jadwalsByDate[$date] as $jadwal) {
                    $start = Carbon::parse($date . ' ' . str_replace('.', ':', $jadwal->waktu_mulai));
                    $diff = $time->diffInMinutes($start, false); // signed minutes
                    $abs = abs($diff);

                    if (is_null($best) || $abs < $bestDiff) {
                        $best = $jadwal;
                        $bestDiff = $abs;
                        $bestSigned = $diff;
                    }
                }

                // terima match terdekat jika dalam threshold (3 jam / 180 menit)
                if ($best && $bestDiff <= 180) {
                    $matched = $best;
                    $matched->inference_method = 'closest';
                    $matched->inference_diff_minutes = $bestDiff;
                    $matched->inference_signed_minutes = $bestSigned ?? null;
                }
            }

            if ($matched) {
                // tandai sebagai inferred dan set relasi sementara untuk view
                $matched->inferred = true;
                $log->setRelation('jadwal', $matched);
            }
        }

        return view('admin.scan.index', compact('logs'));
    }
}



