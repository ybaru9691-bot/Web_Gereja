@extends('layouts.main')

@section('content')

<link rel="stylesheet" href="{{ asset('css/frontend/warta.css') }}">

<div class="warta-detail-container">

    {{-- FOTO WARTA --}}
    @if($warta->file_path)
        <div class="warta-image-wrapper">
            <img src="{{ asset('storage/'.$warta->file_path) }}"
                 alt="Foto Warta"
                 class="warta-image">
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
        @if($warta->file_path)
            <a href="{{ asset('storage/'.$warta->file_path) }}"
               class="btn-download"
               download>
                📄 Download Warta (PDF)
            </a>
        @endif

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
