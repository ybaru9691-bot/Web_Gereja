@extends('layouts.pendeta')

@section('content')

<h3 class="fw-bold mb-4">Ringkasan Pelayanan</h3>

{{-- KARTU STATISTIK --}}
<div class="row g-3 mb-4">

    <div class="col-md-3">
        <div class="bg-white p-3 rounded shadow-sm">
            <small>Jumlah Jemaat</small>
            <h4 class="fw-bold">{{ $jemaatCount ?? 0 }}</h4>
            <span class="badge bg-success">Aktif</span>
        </div>
    </div>

    <div class="col-md-3">
        <div class="bg-white p-3 rounded shadow-sm">
            <small>Jumlah Warta</small>
            <h4 class="fw-bold">{{ $wartaCount ?? 0 }}</h4>
            <span class="badge bg-warning text-dark">Semua waktu</span>
        </div>
    </div>

    <div class="col-md-3">
        <div class="bg-white p-3 rounded shadow-sm">
            <small>Scan Mingguan</small>
            <h4 class="fw-bold">{{ $weeklyScanCount ?? 0 }}</h4>
            <span class="badge bg-primary">QR Code</span>
        </div>
    </div>

    <div class="col-md-3">
        <div class="bg-white p-3 rounded shadow-sm">
            <small>Jumlah Pengumuman</small>
            <h4 class="fw-bold">{{ $pengumumanCount ?? 0 }}</h4>
            <span class="badge bg-info text-dark">Total</span>
        </div>
    </div>

</div>

{{-- AKTIVITAS & RINGKASAN --}}
<div class="row g-4">

    {{-- AKTIVITAS --}}
    <div class="col-md-8">
        <div class="bg-white p-4 rounded shadow-sm">
            <h5 class="fw-bold mb-3">Aktivitas Jemaat</h5>

            <p class="text-muted">
                Perbandingan scan kehadiran per hari dalam minggu berjalan
            </p>

            <div class="d-flex gap-2 mb-3">
                <span class="badge bg-light text-dark">Senin</span>
                <span class="badge bg-light text-dark">Selasa</span>
                <span class="badge bg-light text-dark">Rabu</span>
                <span class="badge bg-light text-dark">Jumat</span>
                <span class="badge bg-light text-dark">Sabtu</span>
                <span class="badge bg-primary">Minggu</span>
            </div>

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
                                'rgba(40, 167, 69, 0.7)',  // Success/Green for Disiplin
                                'rgba(255, 193, 7, 0.7)',  // Warning/Yellow for Cukup Disiplin
                                'rgba(220, 53, 69, 0.7)'   // Danger/Red for Tidak Disiplin
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
        </div>
    </div>

    {{-- RINGKASAN SCAN --}}
    <div class="col-md-4">
        <div class="bg-white p-4 rounded shadow-sm">
            <h5 class="fw-bold mb-3">Ringkasan Scan Terbaru</h5>

            <ul class="list-unstyled">
                <li class="mb-2">
                    <strong>Ibadah Minggu Pagi</strong><br>
                    <small>08.00 - 10.00</small>
                    <span class="float-end">{{ $pagiCount ?? 0 }} scan</span>
                </li>

                <li class="mb-2">
                    <strong>Ibadah Minggu Siang</strong><br>
                    <small>10.30 - 12.30</small>
                    <span class="float-end">{{ $siangCount ?? 0 }} scan</span>
                </li>
            </ul>

            <small class="text-muted">
                Untuk data lengkap, buka menu Scan Log
            </small>
        </div>
    </div>

</div>

@endsection