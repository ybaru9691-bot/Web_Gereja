@extends('layouts.pendeta')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-bold m-0">Analisis Pelayanan & Jemaat</h3>
        <form action="{{ route('pendeta.analisis.hitung') }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-primary btn-sm">
                <i class="bi bi-arrow-clockwise"></i> Perbarui Analisis
            </button>
        </form>
    </div>

    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm mb-4" role="alert">
        <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    @if(session('info'))
    <div class="alert alert-info alert-dismissible fade show border-0 shadow-sm mb-4" role="alert">
        <i class="bi bi-info-circle-fill me-2"></i> {{ session('info') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    {{-- HIGHLIGHT CARDS --}}
    <div class="row g-3 mb-4">
        <div class="col-md-4">
            <div class="card border-0 shadow-sm p-3">
                <div class="d-flex align-items-center gap-3">
                    <div class="bg-primary bg-opacity-10 p-3 rounded text-primary">
                        <i class="bi bi-people-fill fs-4"></i>
                    </div>
                    <div>
                        <small class="text-muted d-block">Total Jemaat</small>
                        <h4 class="fw-bold mb-0">{{ $jemaatCount }}</h4>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card border-0 shadow-sm p-3">
                <div class="d-flex align-items-center gap-3">
                    <div class="bg-success bg-opacity-10 p-3 rounded text-success">
                        <i class="bi bi-file-earmark-text-fill fs-4"></i>
                    </div>
                    <div>
                        <small class="text-muted d-block">Total Warta</small>
                        <h4 class="fw-bold mb-0">{{ $wartaCount }}</h4>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card border-0 shadow-sm p-3">
                <div class="d-flex align-items-center gap-3">
                    <div class="bg-info bg-opacity-10 p-3 rounded text-info">
                        <i class="bi bi-megaphone-fill fs-4"></i>
                    </div>
                    <div>
                        <small class="text-muted d-block">Pengumuman</small>
                        <h4 class="fw-bold mb-0">{{ $pengumumanCount }}</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-4">
        {{-- CLUSTERING CHART (PLACEHOLDER) --}}
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body p-4">
                    <h5 class="fw-bold mb-3">Distribusi Klaster Jemaat</h5>
                    <p class="text-muted small mb-4">Analisis berdasarkan keaktifan dan partisipasi ibadah menggunakan algoritma K-Means.</p>
                    
                    <div style="height: 300px;">
                        <canvas id="jemaatChart"></canvas>
                    </div>

                    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
                    <script>
                        const ctx = document.getElementById('jemaatChart').getContext('2d');
                        new Chart(ctx, {
                            type: 'bar',
                            data: {
                                labels: ['Aktif', 'Sedang', 'Pasif'],
                                datasets: [{
                                    label: 'Jumlah Jemaat',
                                    data: @json($chartData),
                                    backgroundColor: [
                                        'rgba(40, 167, 69, 0.7)',  // Success/Green for Aktif
                                        'rgba(255, 193, 7, 0.7)',  // Warning/Yellow for Sedang
                                        'rgba(220, 53, 69, 0.7)'   // Danger/Red for Pasif
                                    ],
                                    borderColor: [
                                        'rgb(40, 167, 69)',
                                        'rgb(255, 193, 7)',
                                        'rgb(220, 53, 69)'
                                    ],
                                    borderWidth: 1
                                }]
                            },
                            options: {
                                responsive: true,
                                maintainAspectRatio: false,
                                scales: {
                                    y: {
                                        beginAtZero: true,
                                        ticks: {
                                            stepSize: 1
                                        }
                                    }
                                },
                                plugins: {
                                    legend: {
                                        display: false
                                    }
                                }
                            }
                        });
                    </script>

                    <div class="mt-4 row text-center">
                        @foreach(['Aktif', 'Sedang', 'Pasif'] as $label)
                        <div class="col-4">
                            <h6 class="mb-1 fw-bold small text-uppercase text-muted">{{ $label }}</h6>
                            <h4 class="fw-bold mb-0 text-{{ $label == 'Aktif' ? 'success' : ($label == 'Sedang' ? 'warning' : 'danger') }}">
                                {{ $clusters[$label] ?? 0 }}
                            </h4>
                            <small class="text-muted">Jemaat</small>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        {{-- INSIGHTS --}}
        <div class="col-lg-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body p-4">
                    <h5 class="fw-bold mb-4">Wawasan Pelayanan</h5>
                    
                    <div class="d-flex flex-column gap-3">
                        <div class="d-flex gap-3">
                            <div class="text-warning"><i class="bi bi-lightbulb-fill fs-5"></i></div>
                            <div>
                                <h6 class="fw-bold mb-1">Keaktifan Jemaat</h6>
                                <p class="text-muted small mb-0">Tren keaktifan jemaat di klaster Aktif 
                                    <span class="fw-bold text-{{ $insights['growth'] >= 0 ? 'success' : 'danger' }}">
                                        {{ $insights['growth'] >= 0 ? 'meningkat' : 'menurun' }} {{ abs($insights['growth']) }}%
                                    </span> 
                                    dibandingkan bulan lalu.
                                </p>
                            </div>
                        </div>

                        <div class="d-flex gap-3">
                            <div class="text-primary"><i class="bi bi-info-circle-fill fs-5"></i></div>
                            <div>
                                <h6 class="fw-bold mb-1">Rekomendasi Warta</h6>
                                <p class="text-muted small mb-0">Topik warta terbaru: <span class="fw-bold">"{{ $insights['top_warta'] }}"</span> memiliki potensi minat baca tinggi.</p>
                            </div>
                        </div>

                        <div class="d-flex gap-3">
                            <div class="text-success"><i class="bi bi-check-circle-fill fs-5"></i></div>
                            <div>
                                <h6 class="fw-bold mb-1">Target Jangkauan</h6>
                                <p class="text-muted small mb-0">Sistem mendeteksi <span class="fw-bold">{{ $insights['reach'] }}%</span> jemaat terdaftar telah teranalisis di periode {{ $latestPeriode }}.</p>
                            </div>
                        </div>
                    </div>

                    <div class="mt-5 border-top pt-4">
                        <h6 class="fw-bold mb-3 small text-uppercase text-muted">Aksi Cepat</h6>
                        <div class="d-grid gap-2">
                            <a href="{{ route('pendeta.analisis.download') }}" class="btn btn-outline-primary btn-sm">Unduh Laporan PDF</a>
                            <a href="{{ route('pendeta.analisis.detail') }}" class="btn btn-outline-secondary btn-sm">Detail Data Mentah</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <div class="row g-4 mb-4">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-body p-4">
                    <h5 class="fw-bold mb-3">Tren Keaktifan Jemaat (6 Periode Terakhir)</h5>
                    <p class="text-muted small mb-4">Grafik ini menunjukkan perkembangan jumlah jemaat di setiap kategori klaster dari bulan ke bulan.</p>
                    
                    <div style="height: 350px;">
                        <canvas id="trendChart"></canvas>
                    </div>

                    <script>
                        const trendCtx = document.getElementById('trendChart').getContext('2d');
                        new Chart(trendCtx, {
                            type: 'line',
                            data: {
                                labels: @json($trendChart['labels']),
                                datasets: [
                                    {
                                        label: 'Aktif',
                                        data: @json($trendChart['Aktif']),
                                        borderColor: 'rgb(40, 167, 69)',
                                        backgroundColor: 'rgba(40, 167, 69, 0.1)',
                                        fill: true,
                                        tension: 0.4
                                    },
                                    {
                                        label: 'Sedang',
                                        data: @json($trendChart['Sedang']),
                                        borderColor: 'rgb(255, 193, 7)',
                                        backgroundColor: 'rgba(255, 193, 7, 0.1)',
                                        fill: true,
                                        tension: 0.4
                                    },
                                    {
                                        label: 'Pasif',
                                        data: @json($trendChart['Pasif']),
                                        borderColor: 'rgb(220, 53, 69)',
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
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .bg-opacity-10 {
        background-color: rgba(var(--bs-primary-rgb), 0.1) !important;
    }
    .bg-success.bg-opacity-10 {
        background-color: rgba(var(--bs-success-rgb), 0.1) !important;
    }
    .bg-info.bg-opacity-10 {
        background-color: rgba(var(--bs-info-rgb), 0.1) !important;
    }
</style>
@endsection
