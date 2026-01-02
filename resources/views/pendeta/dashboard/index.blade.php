@extends('layouts.pendeta')

@section('content')

<h3 class="fw-bold mb-4">Ringkasan Pelayanan</h3>

{{-- KARTU STATISTIK --}}
<div class="row g-3 mb-4">

    <div class="col-md-3">
        <div class="bg-white p-3 rounded shadow-sm">
            <small>Jumlah Jemaat</small>
            <h4 class="fw-bold">428</h4>
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
            <h4 class="fw-bold">137</h4>
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

            <div class="p-5 text-center text-muted border rounded">
                Grafik akan ditampilkan di sini  
                <br><small>(Chart.js nanti)</small>
            </div>
        </div>
    </div>

    {{-- RINGKASAN SCAN --}}
    <div class="col-md-4">
        <div class="bg-white p-4 rounded shadow-sm">
            <h5 class="fw-bold mb-3">Ringkasan Scan Terbaru</h5>

            <ul class="list-unstyled">
                <li class="mb-2">
                    <strong>Ibadah Minggu Pagi</strong><br>
                    <small>07.00 - 09.00</small>
                    <span class="float-end">82 scan</span>
                </li>

                <li class="mb-2">
                    <strong>Ibadah Minggu Siang</strong><br>
                    <small>10.00 - 12.00</small>
                    <span class="float-end">43 scan</span>
                </li>

                <li>
                    <strong>Ibadah Pemuda</strong><br>
                    <small>Sabtu 17.00</small>
                    <span class="float-end">12 scan</span>
                </li>
            </ul>

            <small class="text-muted">
                Untuk data lengkap, buka menu Scan Log
            </small>
        </div>
    </div>

</div>

@endsection