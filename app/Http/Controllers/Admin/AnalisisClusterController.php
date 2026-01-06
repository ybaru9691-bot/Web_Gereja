<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ScanLog;
use App\Models\AnalisisCluster;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class AnalisisClusterController extends Controller
{
    public function index()
    {
        $data = AnalisisCluster::orderBy('periode', 'desc')->get();
        return view('admin.analisis.index', compact('data'));
    }

    public function hitung()
    {
        $periode = Carbon::now()->format('Y-m');

        $logs = ScanLog::select(
            'guest_uuid',
            DB::raw('COUNT(*) as score_f'),
            DB::raw('SUM(CASE WHEN status_kehadiran != "tepat" THEN 1 ELSE 0 END) as score_r'),
            DB::raw('SUM(COALESCE(selisih_menit,0)) as score_d')
        )
        ->whereRaw("DATE_FORMAT(waktu_scan, '%Y-%m') = ?", [$periode])
        ->groupBy('guest_uuid')
        ->get();

        if ($logs->isEmpty()) {
            return back()->with('success', 'Belum ada data scan di periode ini.');
        }

        foreach ($logs as $log) {

            if ($log->score_r == 0) {
                $cluster = 'Disiplin';
            } elseif ($log->score_d <= 30) {
                $cluster = 'Cukup Disiplin';
            } else {
                $cluster = 'Tidak Disiplin';
            }

            AnalisisCluster::updateOrCreate(
                [
                    'guest_uuid' => $log->guest_uuid,
                    'periode'    => $periode
                ],
                [
                    'score_f' => $log->score_f,
                    'score_r' => $log->score_r,
                    'score_d' => $log->score_d,
                    'cluster_label' => $cluster,
                    'last_calculated_at' => now()
                ]
            );
        }

        return back()->with('success', 'Analisis cluster berhasil dihitung');
    }
}
