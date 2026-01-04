@extends('layouts.main')

@section('content')

<link rel="stylesheet" href="{{ asset('css/frontend/warta.css') }}">

<div class="warta-detail-container">

    {{-- FOTO WARTA --}}
    {{-- FOTO WARTA (GALLERY) --}}
    @if($warta->fotos->count() > 0)
        <div class="warta-gallery">
            @foreach($warta->fotos as $foto)
                <div class="warta-image-wrapper mb-3">
                    <img src="{{ asset('storage/'.$foto->nama_file) }}"
                         alt="Foto Warta"
                         class="warta-image rounded shadow-sm">
                </div>
            @endforeach
        </div>
    @elseif($warta->file_path)
        {{-- Fallback untuk data lama --}}
        <div class="warta-image-wrapper">
            <img src="{{ asset('storage/'.$warta->file_path) }}"
                 alt="Foto Warta"
                 class="warta-image rounded shadow-sm">
        </div>
    @endif

    {{-- JUDUL --}}
    <h1 class="warta-title">
        {{ $warta->judul }}
    </h1>

    {{-- TANGGAL --}}
    <p class="warta-date">
        {{ \Carbon\Carbon::parse($warta->tanggal)->translatedFormat('l, d F Y') }}
    </p>

    {{-- ISI --}}
    <div class="warta-content">
        {!! nl2br(e($warta->isi_warta)) !!}
    </div>

    {{-- ACTION --}}
    <div class="warta-action">

        {{-- DOWNLOAD PDF --}}
        <a href="{{ route('warta.download', ['id' => $warta->warta_id]) }}"
           class="btn-download">
             📄 Download Warta (PDF)
        </a>

        {{-- QR CODE --}}
        @if($warta->qr_code)
            <div class="qr-wrapper">
                <img src="{{ asset('storage/'.$warta->qr_code) }}"
                     alt="QR Code"
                     class="qr-image">
                <small>Scan untuk akses cepat</small>
            </div>
        @endif

    </div>

</div>

@endsection
