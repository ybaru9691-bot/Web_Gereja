<?php

namespace App\Http\Controllers\Pendeta;

use App\Http\Controllers\Controller;
use App\Models\Jemaat;
use App\Models\Warta;
use App\Models\Pengumuman;
use App\Models\AnalisisCluster;
use App\Models\ScanLog;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AnalisisController extends Controller
{
    public function index()
    {
        $jemaatCount = Jemaat::count();
        $wartaCount = Warta::count();
        $pengumumanCount = Pengumuman::count();

        // Data analisis cluster
        $clusters = AnalisisCluster::select('cluster_label', DB::raw('count(*) as total'))
            ->groupBy('cluster_label')
            ->pluck('total', 'cluster_label')
            ->toArray();

        $labels = ['Aktif', 'Sedang', 'Pasif'];
        $chartData = [];
        foreach ($labels as $label) {
            $chartData[] = $clusters[$label] ?? 0;
        }

        return view('pendeta.analisis.index', compact(
            'jemaatCount', 
            'wartaCount', 
            'pengumumanCount',
            'chartData',
            'clusters'
        ));
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
            return back()->with('info', 'Belum ada data scan di periode ini.');
        }

        foreach ($logs as $log) {
            if ($log->score_r == 0) {
                $cluster = 'Aktif';
            } elseif ($log->score_d <= 30) {
                $cluster = 'Sedang';
            } else {
                $cluster = 'Pasif';
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
