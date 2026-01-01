@extends('layouts.main')

@section('content')
<link rel="stylesheet" href="{{ asset('css/pengumuman.css') }}">

<div class="container mt-5 pengumuman-page">

    {{-- JUDUL --}}
    <h1 class="fw-bold">Pengumuman Jemaat</h1>
    <p class="text-muted">Informasi terbaru dari pendeta dan majelis untuk seluruh jemaat</p>

    {{-- PENGUMUMAN UTAMA --}}
    @if(isset($highlight))
    <div class="pengumuman-utama mt-4">
        <span class="badge-pendeta">Pengumuman dari pendeta</span>

        <h4 class="fw-bold mt-3">
            {{ $highlight->judul }}
        </h4>

        <p class="text-muted">
            Disampaikan oleh {{ optional($highlight->author)->name ?? 'Pendeta' }}
        </p>

        <p class="mt-3 text-muted small">
            {{ \Illuminate\Support\Str::limit(strip_tags($highlight->isi), 300) }}
        </p>
    </div>
    @else
    <div class="pengumuman-utama mt-4">
        <span class="badge-pendeta">Pengumuman dari pendeta</span>
        <h4 class="fw-bold mt-3">Belum ada pengumuman</h4>
    </div>
    @endif

        {{-- SUB JUDUL --}}
        <h5 class="fw-bold mt-5">Pengumuman Terbaru</h5>

        {{-- LIST PENGUMUMAN --}}
        @if(isset($pengumuman) && $pengumuman->count())
            @foreach($pengumuman as $p)
                <div class="pengumuman-item mt-3">
                    <h6 class="fw-bold">{{ $p->judul }}</h6>
                    <p>{{ \Illuminate\Support\Str::limit(strip_tags($p->isi), 200) }}</p>
                    <div class="small text-muted">Tanggal: {{ \Carbon\Carbon::parse($p->tanggal)->format('d M Y') }}</div>
                </div>
            @endforeach
    @else
        <p class="text-muted mt-3">Belum ada pengumuman.</p>
    @endif

</div>
@endsection