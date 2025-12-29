@extends('layouts.main')

@section('content')

<div class="container mt-5 jadwal-page">

    {{-- JUDUL --}}
    <h1 class="fw-bold">Jadwal Ibadah Mingguan</h1>
    <p class="text-muted">
        Lihat serangkaian jam dan ibadah minggu ini beserta jam dan lokasinya
    </p>

    {{-- PERIODE --}}
    <div class="d-flex justify-content-end mb-3">
        <small class="text-muted">Periode 17–23 Nov 2025</small>
    </div>

    {{-- TABLE HEADER --}}
    <div class="row jadwal-header text-center rounded-pill py-2 mb-2">
        <div class="col-md-3">Hari / Tanggal</div>
        <div class="col-md-3">Jam ibadah</div>
        <div class="col-md-3">Nama ibadah</div>
        <div class="col-md-3">Lokasi</div>
    </div>

    {{-- ROW JADWAL --}}
    <div class="row jadwal-row text-center rounded-pill py-2 mb-2">
        <div class="col-md-3">Minggu, 17 Nov 2025</div>
        <div class="col-md-3">07.00 – 09.00 WIB</div>
        <div class="col-md-3">Ibadah pagi</div>
        <div class="col-md-3">Gereja Bethania</div>
    </div>

    <div class="row jadwal-row text-center rounded-pill py-2 mb-2">
        <div class="col-md-3">Minggu, 17 Nov 2025</div>
        <div class="col-md-3">09.00 – 11.30 WIB</div>
        <div class="col-md-3">Ibadah keluarga</div>
        <div class="col-md-3">Gereja Bethania</div>
    </div>

    <div class="row jadwal-row text-center rounded-pill py-2">
        <div class="col-md-3">Minggu, 17 Nov 2025</div>
        <div class="col-md-3">16.00 – 20.00 WIB</div>
        <div class="col-md-3">Ibadah pemuda</div>
        <div class="col-md-3">Aula pemuda</div>
    </div>

</div>

@endsection
