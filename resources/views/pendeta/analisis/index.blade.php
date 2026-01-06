@extends('layouts.pendeta')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-bold m-0">Analisis Pelayanan & Jemaat</h3>
        <button class="btn btn-primary btn-sm">
            <i class="bi bi-arrow-clockwise"></i> Perbarui Analisis
        </button>
    </div>

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
                    
                    <div class="bg-light rounded d-flex flex-column align-items-center justify-content-center" style="height: 300px;">
                        <i class="bi bi-pie-chart-fill text-muted display-1 mb-3"></i>
                        <p class="text-muted">Visualisasi Grafik (Chart.js) akan muncul di sini</p>
                    </div>

                    <div class="mt-4 row text-center">
                        @foreach($clusters as $label => $val)
                        <div class="col-4">
                            <h6 class="mb-1 fw-bold">{{ $label }}</h6>
                            <span class="badge bg-{{ $loop->index == 0 ? 'primary' : ($loop->index == 1 ? 'success' : 'info') }}">{{ $val }}%</span>
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
                                <h6 class="fw-bold mb-1">Keaktifan Meningkat</h6>
                                <p class="text-muted small mb-0">Partisipasi jemaat pada ibadah pagi meningkat 12% dalam sebulan terakhir.</p>
                            </div>
                        </div>

                        <div class="d-flex gap-3">
                            <div class="text-primary"><i class="bi bi-info-circle-fill fs-5"></i></div>
                            <div>
                                <h6 class="fw-bold mb-1">Rekomendasi Warta</h6>
                                <p class="text-muted small mb-0">Topik warta seputar pemberdayaan pemuda memiliki minat baca tertinggi.</p>
                            </div>
                        </div>

                        <div class="d-flex gap-3">
                            <div class="text-success"><i class="bi bi-check-circle-fill fs-5"></i></div>
                            <div>
                                <h6 class="fw-bold mb-1">Target Tercapai</h6>
                                <p class="text-muted small mb-0">Distribusi pengumuman digital telah menjangkau 85% jemaat terdaftar.</p>
                            </div>
                        </div>
                    </div>

                    <div class="mt-5 border-top pt-4">
                        <h6 class="fw-bold mb-3 small text-uppercase text-muted">Aksi Cepat</h6>
                        <div class="d-grid gap-2">
                            <a href="#" class="btn btn-outline-primary btn-sm">Unduh Laporan PDF</a>
                            <a href="#" class="btn btn-outline-secondary btn-sm">Detail Data Mentah</a>
                        </div>
                    </div>
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
