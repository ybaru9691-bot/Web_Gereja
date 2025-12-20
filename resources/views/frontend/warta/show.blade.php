@extends('layouts.main')

@section('content')

<div class="container mt-5">

    {{-- BACK --}}
    <a href="{{ route('warta.index') }}"
       class="btn btn-warning rounded-pill mb-4">
        ⬅ Kembali ke warta jemaat
    </a>

    {{-- JUDUL --}}
    <h2 class="fw-bold">
        {{ $warta->judul }}
    </h2>

    <p class="text-muted">
        {{ \Carbon\Carbon::parse($warta->tanggal)->translatedFormat('l, d F Y') }}
        · Disusun oleh {{ $warta->penyusun }}
    </p>

    {{-- QR INFO --}}
    <div class="d-flex align-items-center mb-3">
        <span class="badge bg-warning me-2">&nbsp;</span>
        <strong>Dibuka melalui QR Code</strong>
    </div>

    <small class="text-muted">
        Menyimpan log scan untuk keperluan statistik dan pelaporan kehadiran
    </small>

    {{-- CONTENT --}}
    <div class="row mt-4">

        {{-- ISI WARTA (KERTAS) --}}
        <div class="col-md-7">
            <div class="warta-paper">
                {!! nl2br(e($warta->isi_warta)) !!}
            </div>
        </div>

   {{-- PDF --}}
<div class="col-md-5">
    <div class="pdf-box text-center">

        {{-- PREVIEW PDF --}}
        @if($warta->file_path)
            <div class="pdf-preview mb-3">
                <iframe
                    src="{{ asset('storage/' . $warta->file_path) }}"
                    width="100%"
                    height="400"
                    style="border:1px solid #ddd; border-radius:8px;">
                </iframe>
            </div>

            <a href="{{ asset('storage/' . $warta->file_path) }}"
               target="_blank"
               class="btn btn-primary rounded-pill me-2">
                Buka PDF
            </a>

            <a href="{{ asset('storage/' . $warta->file_path) }}"
               download
               class="btn btn-light rounded-pill">
                Unduh PDF
            </a>

            </div>
        </div>

    </div>
</div>

@endsection