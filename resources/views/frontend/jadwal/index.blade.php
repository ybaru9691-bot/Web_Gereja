@extends('layouts.main')

@section('content')

<div class="container mt-5 jadwal-page">

    {{-- JUDUL --}}
    <h1 class="fw-bold">Jadwal Ibadah Mingguan</h1>
    <p class="text-muted">
        Lihat jadwal ibadah beserta jam dan lokasi pelaksanaannya
    </p>

    {{-- HEADER --}}
    <div class="row jadwal-header text-center rounded-pill py-2 mb-3">
        <div class="col-md-3">Hari / Tanggal</div>
        <div class="col-md-3">Jam Ibadah</div>
        <div class="col-md-3">Jenis Ibadah</div>
        <div class="col-md-3">Lokasi</div>
    </div>

    {{-- DATA --}}
  @forelse ($jadwal as $item)
    <div class="row jadwal-row text-center rounded-pill py-2 mb-2 align-items-center">

        <div class="col-md-3">
            {{ \Carbon\Carbon::parse($item->tanggal)->translatedFormat('l, d M Y') }}
        </div>

        <div class="col-md-2">
            {{ substr($item->waktu_mulai, 0, 5) }}
            @if($item->waktu_selesai)
                – {{ substr($item->waktu_selesai, 0, 5) }} WIB
            @endif
        </div>

        <div class="col-md-3">
            {{ $item->jenis_ibadah }}
        </div>

        <div class="col-md-2">
            {{ $item->lokasi }}
        </div>

        {{-- 👉 TOMBOL DETAIL --}}
        <div class="col-md-2">
           <a href="{{ route('jadwal.show', $item->id_jadwal) }}"
               class="btn btn-sm btn-primary">
      Lihat Detail
                </a>

        </div>

    </div>
@empty

        <div class="alert alert-info text-center mt-3">
            Jadwal ibadah belum tersedia
        </div>
    @endforelse

</div>

@endsection
