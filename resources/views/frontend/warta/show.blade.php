@extends('layouts.main')

@section('content')

<link rel="stylesheet" href="{{ asset('css/frontend/warta.css') }}">

<div class="warta-detail-container">

{{-- Fancybox CSS --}}
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.css" />

<div class="warta-detail-container">

    {{-- FOTO WARTA (GALLERY / SLIDER) --}}
    @if($warta->fotos->count() > 0)
        <div id="wartaCarousel" class="carousel slide mb-4 shadow-sm rounded" data-bs-ride="carousel">
            <div class="carousel-inner rounded">
                @foreach($warta->fotos as $index => $foto)
                    <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                        <a href="{{ asset('storage/'.$foto->nama_file) }}" data-fancybox="gallery" data-caption="{{ $warta->judul }}">
                            <img src="{{ asset('storage/'.$foto->nama_file) }}"
                                 alt="Foto Warta"
                                 class="d-block w-100 warta-carousel-img">
                        </a>
                    </div>
                @endforeach
            </div>
            
            @if($warta->fotos->count() > 1)
                <button class="carousel-control-prev" type="button" data-bs-target="#wartaCarousel" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#wartaCarousel" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>

                <div class="carousel-indicators">
                    @foreach($warta->fotos as $index => $foto)
                        <button type="button" data-bs-target="#wartaCarousel" data-bs-slide-to="{{ $index }}" class="{{ $index == 0 ? 'active' : '' }}" aria-label="Slide {{ $index + 1 }}"></button>
                    @endforeach
                </div>
            @endif
        </div>
    @elseif($warta->file_path)
        {{-- Fallback untuk data lama --}}
        <div class="warta-image-wrapper mb-4">
            <a href="{{ asset('storage/'.$warta->file_path) }}" data-fancybox="gallery">
                <img src="{{ asset('storage/'.$warta->file_path) }}"
                     alt="Foto Warta"
                     class="warta-image rounded shadow-sm">
            </a>
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

@section('scripts')
{{-- Fancybox JS --}}
<script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.umd.js"></script>
<script>
    Fancybox.bind("[data-fancybox]", {
        // Options if needed
    });
</script>
@endsection

@endsection
