@extends('layouts.main')


@section('content')

<div class="container mt-5">

    {{-- JUDUL --}}
    <h1 class="fw-bold">Daftar warta jemaat</h1>
    <p class="text-muted">
        Lihat rangkuman warta mingguan gereja dan akses detail setiap ibadah
    </p>

    {{-- SEARCH & FILTER --}}
    <div class="row g-2 mt-3">
        <div class="col-md-4">
            <input type="text" class="form-control rounded-pill"
                placeholder="Cari warta berdasarkan judul, tema atau pengkhotbah">
        </div>
        <div class="col-md-3">
            <input type="date" class="form-control rounded-pill">
        </div>
        <div class="col-md-3">
            <input type="date" class="form-control rounded-pill">
        </div>
    </div>

    {{-- FILTER BUTTON --}}
    <div class="mt-3 p-2 rounded" style="background:#d6cfcf;">
        <button class="btn btn-warning rounded-pill me-2">Minggu ini</button>
        <button class="btn btn-light rounded-pill me-2">Bulan ini</button>
        <button class="btn btn-light rounded-pill">Semua</button>
    </div>

    {{-- SUB JUDUL --}}
    <div class="d-flex justify-content-between align-items-center mt-4">
        <h4 class="fw-bold">Warta mingguan</h4>
        <small class="text-muted">Menampilkan warta terakhir</small>
    </div>

    {{-- CARD WARTA --}}
    <div class="p-4 rounded mt-3" style="background:#cbbf6a;">
        <div class="row align-items-center">
            <div class="col-md-7">
                <h5 class="fw-bold">Ibadah minggu syukur dan perjamuan</h5>
                <small>
                    Minggu 23 Nov 2025 · Disusun oleh majelis jemaat
                </small>

                <div class="bg-white rounded-pill px-3 py-1 mt-2 d-inline-block">
                    Tema bersyukur dalam segala hal
                </div>
            </div>

            <div class="col-md-3">
                <strong>Ibadah pagi 07.00 - 09.00 WIB</strong><br>
                <small>Pelayan firman Pdt Relita Gultom</small>
            </div>

            <div class="col-md-2 text-end">
                <a href="{{ route('warta.show', 1) }}"
                   class="btn btn-primary rounded-pill px-4">
                    Lihat detail
                </a>
            </div>
        </div>
    </div>

    {{-- CARD WARTA 2 --}}
    <div class="p-4 rounded mt-3" style="background:#cbbf6a;">
        <div class="row align-items-center">
            <div class="col-md-7">
                <h5 class="fw-bold">Ibadah minggu pertumbuhan iman keluarga</h5>
                <small>
                    Minggu 16 Nov 2025 · Disusun oleh komisi keluarga
                </small>

                <div class="bg-white rounded-pill px-3 py-1 mt-2 d-inline-block">
                    Tema rumah yang dibangun Tuhan
                </div>
            </div>

            <div class="col-md-3">
                <strong>Ibadah pagi 09.00 - 11.30 WIB</strong><br>
                <small>Pelayan firman Pdt Relita Gultom</small>
            </div>

            <div class="col-md-2 text-end">
              <a href="{{ route('warta.show', $warta->id) }}"
                    class="btn btn-sm btn-primary">
                          Lihat detail
                                 </a>

            </div>
        </div>
    </div>

</div>

@endsection
