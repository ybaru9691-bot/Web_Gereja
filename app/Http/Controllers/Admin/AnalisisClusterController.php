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

        // --- TREN 6 BULAN TERAKHIR ---
        $trendPeriods = AnalisisCluster::select('periode')
            ->groupBy('periode')
            ->orderBy('periode', 'desc')
            ->limit(6)
            ->pluck('periode')
            ->sort();

        $trendChart = [
            'labels' => [],
            'Aktif' => [],
            'Sedang' => [],
            'Pasif' => []
        ];

        foreach ($trendPeriods as $tp) {
            $trendChart['labels'][] = Carbon::parse($tp . '-01')->format('M Y');
            
            $counts = AnalisisCluster::where('periode', $tp)
                ->select('cluster_label', DB::raw('count(*) as total'))
                ->groupBy('cluster_label')
                ->pluck('total', 'cluster_label');
            
            $trendChart['Aktif'][] = $counts['Aktif'] ?? 0;
            $trendChart['Sedang'][] = $counts['Sedang'] ?? 0;
            $trendChart['Pasif'][] = $counts['Pasif'] ?? 0;
        }

        return view('admin.analisis.index', compact('data', 'trendChart'));
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

            if ($log->score_f >= 3 && $log->score_r == 0) {
                $cluster = 'Aktif';
            } elseif ($log->score_f >= 2 && $log->score_d <= 30) {
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
