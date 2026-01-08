@extends('layouts.admin')

@section('content')
<div class="analisis-container">

    <div class="analisis-header">
        <h1 class="analisis-title">
            <i class="bi bi-bar-chart-line-fill"></i>
            Analisis Jemaat
        </h1>

        {{-- tombol hitung --}}
        <form action="{{ route('admin.analisis.hitung') }}" method="POST" class="m-0">
            @csrf
            <button type="submit" class="btn-calculate">
                <i class="bi bi-calculator"></i>
                Hitung Analisis Jemaat
            </button>
        </form>
    </div>

    {{-- notifikasi sukses --}}
    @if(session('success'))
        <div class="alert-modern">
            <i class="bi bi-check-circle-fill"></i>
            {{ session('success') }}
        </div>
    @endif

    {{-- CHART TREN --}}
    <div class="table-card mb-4 p-4">
        <h5 class="fw-bold mb-3">Tren Keaktifan Jemaat</h5>
        <div style="height: 300px;">
            <canvas id="trendChart"></canvas>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctx = document.getElementById('trendChart').getContext('2d');
        new Chart(ctx, {
            type: 'line',
            data: {
                labels: @json($trendChart['labels']),
                datasets: [
                    {
                        label: 'Aktif',
                        data: @json($trendChart['Aktif']),
                        borderColor: '#28a745',
                        backgroundColor: 'rgba(40, 167, 69, 0.1)',
                        fill: true,
                        tension: 0.4
                    },
                    {
                        label: 'Sedang',
                        data: @json($trendChart['Sedang']),
                        borderColor: '#ffc107',
                        backgroundColor: 'rgba(255, 193, 7, 0.1)',
                        fill: true,
                        tension: 0.4
                    },
                    {
                        label: 'Pasif',
                        data: @json($trendChart['Pasif']),
                        borderColor: '#dc3545',
                        backgroundColor: 'rgba(220, 53, 69, 0.1)',
                        fill: true,
                        tension: 0.4
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom'
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            stepSize: 1
                        }
                    }
                }
            }
        });
    </script>

    {{-- tabel hasil --}}
    <div class="table-card">
        <table class="analisis-table">
           <thead>
                <tr>
                    <th>Periode</th>
                    <th>Guest UUID</th>
                    <th>Score F</th>
                    <th>Score R</th>
                    <th>Score D</th>
                    <th>Cluster</th>
                    <th>Terakhir Dihitung</th>
                </tr>
            </thead>

            <tbody>
              @forelse ($data as $row)
                <tr>
                    <td>{{ $row->periode }}</td>
                    <td>
                        <span class="uuid-cell" title="{{ $row->guest_uuid }}">
                            {{ $row->guest_uuid }}
                        </span>
                    </td>
                    <td class="score-cell score-f">{{ $row->score_f }}</td>
                    <td class="score-cell score-r">{{ $row->score_r }}</td>
                    <td class="score-cell score-d">{{ $row->score_d }}</td>
                    <td>
                        <span class="cluster-badge 
                            @if($row->cluster_label == 'Aktif') cluster-disiplin
                            @elseif($row->cluster_label == 'Sedang') cluster-cukup
                            @else cluster-kurang
                            @endif
                        ">
                            @if($row->cluster_label == 'Aktif')
                                <i class="bi bi-check-circle-fill"></i>
                            @elseif($row->cluster_label == 'Sedang')
                                <i class="bi bi-dash-circle-fill"></i>
                            @else
                                <i class="bi bi-x-circle-fill"></i>
                            @endif
                            {{ $row->cluster_label }}
                        </span>
                    </td>
                    <td class="date-cell">
                        <i class="bi bi-clock"></i>
                        {{ \Carbon\Carbon::parse($row->last_calculated_at)->format('Y-m-d H:i') }}
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7">
                        <div class="empty-state">
                            <i class="bi bi-inbox"></i>
                            <p>Belum ada data analisis</p>
                        </div>
                    </td>
                </tr>
            @endforelse

            </tbody>
        </table>
    </div>

</div>

<x-hint-button title="Fungsi Analisis Jemaat">
    Menganalisis tingkat keaktifan jemaat berdasarkan frekuensi kehadiran (F), kedekatan waktu (R), dan durasi (D).
</x-hint-button>
@endsection

