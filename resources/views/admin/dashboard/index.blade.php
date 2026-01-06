@extends('layouts.admin')

@section('content')

<h3 class="fw-bold mb-4 ps-5 ps-md-0">Ringkasan Pelayanan</h3>

{{-- KARTU STATISTIK --}}
<div class="row g-3 mb-4">

    <div class="col-6 col-md-3">
        <div class="bg-white p-3 rounded shadow-sm h-100">
            <small class="text-muted d-block mb-1">Jumlah Jemaat</small>
            <h4 class="fw-bold mb-2">{{ $jemaatCount ?? 0 }}</h4>
            <span class="badge bg-success">Aktif</span>
        </div>
    </div>

    <div class="col-6 col-md-3">
        <div class="bg-white p-3 rounded shadow-sm h-100">
            <small class="text-muted d-block mb-1">Jumlah Warta</small>
            <h4 class="fw-bold mb-2">{{ $wartaCount ?? 0 }}</h4>
            <span class="badge bg-warning text-dark">Semua waktu</span>
        </div>
    </div>

    <div class="col-6 col-md-3">
        <div class="bg-white p-3 rounded shadow-sm h-100">
            <small class="text-muted d-block mb-1">Scan Mingguan</small>
            <h4 class="fw-bold mb-2">137</h4>
            <span class="badge bg-primary">QR Code</span>
        </div>
    </div>

    <div class="col-6 col-md-3">
        <div class="bg-white p-3 rounded shadow-sm h-100">
            <small class="text-muted d-block mb-1">Aktivitas Jemaat</small>
            <h6 class="fw-bold mb-2">Minggu berjalan</h6>
            <a href="#" class="text-primary small text-decoration-none">Lihat detail</a>
        </div>
    </div>

</div>

{{-- AKTIVITAS & RINGKASAN --}}
<div class="row g-4">

    {{-- AKTIVITAS --}}
    <div class="col-12 col-lg-8">
        <div class="bg-white p-4 rounded shadow-sm">
            <h5 class="fw-bold mb-3">Aktivitas Jemaat</h5>

            <p class="text-muted small">
                Perbandingan scan kehadiran per hari dalam minggu berjalan
            </p>

            <div class="d-flex flex-wrap gap-2 mb-3">
                <span class="badge bg-light text-dark">Senin</span>
                <span class="badge bg-light text-dark">Selasa</span>
                <span class="badge bg-light text-dark">Rabu</span>
                <span class="badge bg-light text-dark">Jumat</span>
                <span class="badge bg-light text-dark">Sabtu</span>
                <span class="badge bg-primary">Minggu</span>
            </div>

            <div class="p-5 text-center text-muted border rounded">
                Grafik akan ditampilkan di sini  
                <br><small>(Chart.js nanti)</small>
            </div>
        </div>
    </div>

    {{-- RINGKASAN SCAN --}}
    <div class="col-12 col-lg-4">
        <div class="bg-white p-4 rounded shadow-sm">
            <h5 class="fw-bold mb-3">Ringkasan Scan Terbaru</h5>

            <ul class="list-unstyled">
                <li class="mb-3 border-bottom pb-2">
                    <strong>Ibadah Minggu Pagi</strong><br>
                    <small class="text-muted">07.00 - 09.00</small>
                    <span class="float-end badge bg-light text-dark">82 scan</span>
                </li>

                <li class="mb-3 border-bottom pb-2">
                    <strong>Ibadah Minggu Siang</strong><br>
                    <small class="text-muted">10.00 - 12.00</small>
                    <span class="float-end badge bg-light text-dark">43 scan</span>
                </li>

                <li class="mb-3">
                    <strong>Ibadah Pemuda</strong><br>
                    <small class="text-muted">Sabtu 17.00</small>
                    <span class="float-end badge bg-light text-dark">12 scan</span>
                </li>
            </ul>

            <small class="text-muted d-block mt-3 bg-light p-2 rounded text-center">
                Untuk data lengkap, buka menu Scan Log
            </small>
        </div>
    </div>

</div>

<x-hint-button title="Apa itu Dashboard?">
    Halaman ini memberikan ringkasan data jemaat, warta, dan statistik scan QR code secara real-time untuk memudahkan Anda memantau perkembangan pelayanan Gereja Bethania.
</x-hint-button>

@endsection
