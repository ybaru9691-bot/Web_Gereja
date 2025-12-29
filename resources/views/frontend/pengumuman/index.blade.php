@extends('layouts.main')

@section('content')
<link rel="stylesheet" href="{{ asset('css/pengumuman.css') }}">

<div class="container mt-5 pengumuman-page">

    {{-- JUDUL --}}
    <h1 class="fw-bold">Pengumuman Jemaat</h1>
    <p class="text-muted">
        Informasi terbaru dari pendeta dan majelis untuk seluruh jemaat
    </p>

    {{-- PENGUMUMAN UTAMA --}}
    <div class="pengumuman-utama mt-4">
        <span class="badge-pendeta">Pengumuman dari pendeta</span>

        <h4 class="fw-bold mt-3">
            Ibadah syukur akhir tahun dan doa bersama keluarga
        </h4>

        <p class="text-muted">
            Disampaikan oleh Pdt. Relita Gultom
        </p>
    </div>

    {{-- SUB JUDUL --}}
    <h5 class="fw-bold mt-5">Pengumuman Terbaru</h5>

    {{-- LIST PENGUMUMAN --}}
    <div class="pengumuman-item mt-3">
        <h6 class="fw-bold">
            Pendaftaran Katekisasi Remaja Angkatan 2026
        </h6>
        <p>
            Remaja usia 15–18 tahun diundang untuk mengikuti katekisasi...
        </p>
    </div>

    <div class="pengumuman-item mt-3">
        <h6 class="fw-bold">
            Pelayanan Diakonia : Pengumpulan Sembako Natal
        </h6>
        <p>
            Jemaat yang tergerak dapat membawa bantuan sembako...
        </p>
    </div>

</div>
@endsection
