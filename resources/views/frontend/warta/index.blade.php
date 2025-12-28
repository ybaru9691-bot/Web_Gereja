@extends('layouts.main')

@section('content')

<div class="container mt-5">

    {{-- JUDUL --}}
    <h1 class="fw-bold">Daftar warta jemaat</h1>
    <p class="text-muted">
        Lihat rangkuman warta mingguan gereja dan akses detail setiap ibadah
    </p>

    {{-- SEARCH & FILTER (UI saja, logic belakangan) --}}
    <div class="row g-2 mt-3">
        <div class="col-md-4">
            <input type="text" class="form-control rounded-pill"
                placeholder="Cari warta berdasarkan judul atau tema">
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
        <small class="text-muted">Menampilkan warta terbaru</small>
    </div>

    {{-- DATA DARI ADMIN --}}
    @forelse ($wartas as $warta)
        <div class="p-4 rounded mt-3" style="background:#cbbf6a;">
            <div class="row align-items-center">

                <div class="col-md-7">
                    <h5 class="fw-bold">
                        {{ $warta->judul }}
                    </h5>

                    <small>
                        {{ \Carbon\Carbon::parse($warta->tanggal)->translatedFormat('l, d F Y') }}
                        · Disusun oleh Majelis Jemaat
                    </small>

                    <div class="bg-white rounded-pill px-3 py-1 mt-2 d-inline-block">
                        {{ Str::limit(strip_tags($warta->isi_warta), 50) }}
                    </div>
                </div>

                <div class="col-md-3">
                    <strong>Ibadah pagi</strong><br>
                    <small>Pelayan firman</small>
                </div>

                <div class="col-md-2 text-end">
                    <a href="{{ route('warta.show', ['id' => $warta->warta_id]) }}"
                       class="btn btn-primary rounded-pill px-4">
                        Lihat detail
                    </a>
                </div>

            </div>
        </div>
    @empty
        <div class="alert alert-warning mt-4">
            Belum ada warta yang dipublikasikan
        </div>
    @endforelse

</div>

@endsection
