@extends('layouts.pendeta')

@section('content')
<!-- (style bagian tetap seperti desain sebelumnya) -->

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<div class="d-flex justify-content-between align-items-start mb-4">
    <div>
        <h2 class="fw-bold">Pengumuman</h2>
        <p class="text-muted mb-1">Kelola pengumuman gereja serta pantau ringkasan publikasi.</p>
    </div>
    <div>
        <a href="{{ url('/pendeta/pengumuman/create') }}" class="btn btn-primary">Buat Pengumuman</a>
    </div>
</div>

<!-- status filter (UI only) -->
<div class="mb-4">
    <div class="btn-group">
        <a href="{{ route('pendeta.pengumuman', ['status'=>'aktif']) }}" class="btn btn-outline-secondary">Aktif</a>
        <a href="{{ route('pendeta.pengumuman', ['status'=>'terjadwal']) }}" class="btn btn-outline-secondary">Terjadwal</a>
        <a href="{{ route('pendeta.pengumuman', ['status'=>'arsip']) }}" class="btn btn-outline-secondary">Arsip</a>
    </div>
</div>

<div class="row g-4">
    <div class="col-lg-7">
        @forelse($pengumuman as $p)
            <div class="card-ann mb-3">
                <div class="d-flex justify-content-between">
                    <div>
                        <h5 class="mb-1">{{ $p->judul }}</h5>
                        <div class="small-muted">Diposting oleh {{ $p->dibuat_oleh }} • {{ \Carbon\Carbon::parse($p->tanggal)->format('d M Y') }}</div>
                        <p class="mt-2 mb-0">{{ \Illuminate\Support\Str::limit(strip_tags($p->isi), 220) }}</p>
                    </div>
                    <div class="d-flex flex-column gap-2 align-items-end">
                        <a href="{{ url('/pendeta/pengumuman/'.$p->id_pengumuman.'/edit') }}" class="btn btn-sm btn-outline-warning action-pill">Edit</a>
                        <form action="{{ url('/pendeta/pengumuman/'.$p->id_pengumuman) }}" method="POST" onsubmit="return confirm('Hapus pengumuman ini?');">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-outline-danger action-pill">Hapus</button>
                        </form>
                    </div>
                </div>
            </div>
        @empty
            <div class="alert alert-secondary">Belum ada pengumuman</div>
        @endforelse

        {{ $pengumuman->links() }}
    </div>

    <div class="col-lg-5">
        <!-- Ringkasan statis/dinamis -->
        <div class="card mb-3">
            <div class="card-body">
                <h6 class="card-title">Ringkasan</h6>
                <div>Total Pengumuman: <strong>{{ $pengumuman->total() }}</strong></div>
            </div>
        </div>

        <!-- Aktivitas -->
        <div class="card">
            <div class="card-body">
                <h6 class="card-title">Aktivitas Terbaru</h6>
                <ul class="list-unstyled small mt-2">
                    @foreach($pengumuman->take(3) as $recent)
                        <li class="mb-2"><strong>{{ \Carbon\Carbon::parse($recent->tanggal)->format('d M') }}:</strong> {{ \Illuminate\Support\Str::limit($recent->judul, 40) }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection