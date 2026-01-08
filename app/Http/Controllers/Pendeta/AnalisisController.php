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

use Barryvdh\DomPDF\Facade\Pdf;

class AnalisisController extends Controller
{
    public function index()
    {
        $jemaatCount = Jemaat::count();
        $wartaCount = Warta::count();
        $pengumumanCount = Pengumuman::count();

        // Data analisis cluster (Periode Terakhir)
        $latestPeriode = AnalisisCluster::max('periode');
        
        if (!$latestPeriode) {
            $latestPeriode = Carbon::now()->format('Y-m');
            $clusters = [];
        } else {
            $clusters = AnalisisCluster::where('periode', $latestPeriode)
                ->select('cluster_label', DB::raw('count(*) as total'))
                ->groupBy('cluster_label')
                ->pluck('total', 'cluster_label')
                ->toArray();
        }

        $labels = ['Aktif', 'Sedang', 'Pasif'];
        $chartData = [];
        foreach ($labels as $label) {
            $chartData[] = $clusters[$label] ?? 0;
        }

        // --- WAWASAN PELAYANAN (DYNAMIC LOGIC) ---
        
        $insights = [
            'growth' => 0,
            'top_warta' => 'Belum ada data',
            'reach' => 0
        ];

        if ($latestPeriode) {
            // 1. Tren Keaktifan (Bandingkan dengan bulan lalu)
            $lastMonth = Carbon::parse($latestPeriode . '-01')->subMonth()->format('Y-m');
            $aktifThisMonth = $clusters['Aktif'] ?? 0;
            $aktifLastMonth = AnalisisCluster::where('periode', $lastMonth)
                ->where('cluster_label', 'Aktif')
                ->count();
            
            if ($aktifLastMonth > 0) {
                $insights['growth'] = round((($aktifThisMonth - $aktifLastMonth) / $aktifLastMonth) * 100);
            } else if ($aktifThisMonth > 0) {
                $insights['growth'] = 100;
            }

            // 2. Rekomendasi Warta
            $topWarta = Warta::latest()->first();
            if ($topWarta) {
                $insights['top_warta'] = $topWarta->judul;
            }

            // 3. Target
            $totalTeranalisis = array_sum($clusters);
            if ($jemaatCount > 0) {
                $insights['reach'] = round(($totalTeranalisis / $jemaatCount) * 100);
            }
        }

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

        return view('pendeta.analisis.index', compact(
            'jemaatCount', 
            'wartaCount', 
            'pengumumanCount',
            'chartData',
            'clusters',
            'insights',
            'latestPeriode',
            'trendChart'
        ));
    }

    public function detail()
    {
        $latestPeriode = AnalisisCluster::max('periode');
        $data = AnalisisCluster::where('periode', $latestPeriode)
            ->get();
            
        return view('pendeta.analisis.detail', compact('data', 'latestPeriode'));
    }

    public function downloadPdf()
    {
        $latestPeriode = AnalisisCluster::max('periode');
        $data = AnalisisCluster::where('periode', $latestPeriode)->get();
        
        $clusters = AnalisisCluster::where('periode', $latestPeriode)
            ->select('cluster_label', DB::raw('count(*) as total'))
            ->groupBy('cluster_label')
            ->pluck('total', 'cluster_label')
            ->toArray();

        $pdf = Pdf::loadView('pendeta.analisis.report_pdf', [
            'data' => $data,
            'clusters' => $clusters,
            'periode' => $latestPeriode,
            'date' => Carbon::now()->format('d F Y')
        ]);

        return $pdf->download('Laporan-Analisis-Jemaat-' . $latestPeriode . '.pdf');
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
