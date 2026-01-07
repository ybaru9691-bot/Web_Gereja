@extends('layouts.main')

@section('content')

<div class="container mt-5 mb-5">

    {{-- HEADER SECTION --}}
    <div class="text-center mb-5">
        <h1 class="fw-bold display-5 mb-3">Warta Jemaat</h1>
        <p class="text-muted lead mx-auto" style="max-width: 600px;">
            Dapatkan informasi terbaru mengenai kegiatan, jadwal ibadah, dan pengumuman penting lainnya dari Gereja.
        </p>
    </div>

    {{-- SEARCH & FILTER SECTION --}}
    <div class="card border-0 shadow-sm rounded-4 mb-5 p-4 bg-white">
        <div class="row g-3 align-items-center">
            {{-- SEARCH --}}
            <div class="col-lg-5">
                <div class="input-group">
                    <span class="input-group-text bg-light border-0 ps-3">
                        <i class="bi bi-search text-muted"></i>
                    </span>
                    <input type="text" class="form-control bg-light border-0 py-2" 
                        placeholder="Cari warta...">
                </div>
            </div>

            {{-- DATE FILTER --}}
            <div class="col-lg-3">
                <input type="date" class="form-control bg-light border-0 py-2 text-muted">
            </div>

            {{-- FILTER BUTTONS --}}
            <div class="col-lg-4 text-lg-end">
                <div class="btn-group" role="group">
                    <a href="{{ route('warta.index', ['filter' => 'week']) }}" 
                       class="btn btn-sm {{ request('filter') == 'week' ? 'btn-forest' : 'btn-outline-forest' }} rounded-start-pill px-3">
                        Minggu Ini
                    </a>
                    <a href="{{ route('warta.index', ['filter' => 'month']) }}" 
                       class="btn btn-sm {{ request('filter') == 'month' ? 'btn-forest' : 'btn-outline-forest' }} px-3">
                        Bulan Ini
                    </a>
                    <a href="{{ route('warta.index') }}" 
                       class="btn btn-sm {{ !request('filter') ? 'btn-forest' : 'btn-outline-forest' }} rounded-end-pill px-3">
                        Semua
                    </a>
                </div>
            </div>
        </div>
    </div>

    {{-- WARTA GRID --}}
    <div class="row g-4">
        @forelse ($wartas as $warta)
            <div class="col-md-6 col-lg-4">
                <div class="card h-100 border-0 shadow-sm rounded-4 hover-card overflow-hidden transition-all">
                    
                    {{-- DECORATIVE HEADER / IMAGE PLACEHOLDER --}}
                    <div class="card-header border-0 p-4 text-white d-flex align-items-center justify-content-center" 
                         style="background: linear-gradient(135deg, #588157 0%, #3a5a40 100%); height: 160px;">
                        <div class="text-center">
                            <h3 class="fw-bold mb-0 text-white-50">{{ \Carbon\Carbon::parse($warta->tanggal)->format('d') }}</h3>
                            <h5 class="text-uppercase mb-0">{{ \Carbon\Carbon::parse($warta->tanggal)->translatedFormat('M Y') }}</h5>
                        </div>
                    </div>

                    <div class="card-body p-4 d-flex flex-column">
                        <div class="mb-3">
                            <span class="badge bg-light rounded-pill px-3 py-2" style="color: #588157;">
                                <i class="bi bi-calendar-event me-1"></i>
                                {{ \Carbon\Carbon::parse($warta->tanggal)->translatedFormat('l, d F Y') }}
                            </span>
                        </div>

                        <h4 class="card-title fw-bold mb-3">
                            <a href="{{ route('warta.show', ['id' => $warta->warta_id]) }}" class="text-decoration-none text-dark stretched-link">
                                {{ $warta->judul }}
                            </a>
                        </h4>

                        <p class="card-text text-muted mb-4 flex-grow-1">
                            {{ Str::limit(strip_tags($warta->isi_warta), 100, '...') }}
                        </p>

                        @if($warta->fotos->count() > 0 || $warta->file_path)
                        <div class="mb-3 position-relative" style="z-index: 5;">
                            <a href="{{ route('warta.download', ['id' => $warta->warta_id]) }}" class="btn btn-outline-forest btn-sm w-100 rounded-pill">
                                <i class="bi bi-download me-1"></i> Download PDF
                            </a>
                        </div>
                        @endif

                        <div class="d-flex justify-content-between align-items-center pt-3 border-top">
                            <small class="text-muted">
                                <i class="bi bi-person-circle me-1"></i> Majelis Jemaat
                            </small>
                            <span class="fw-semibold small" style="color: #588157;">
                                Baca selengkapnya <i class="bi bi-arrow-right ms-1"></i>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="text-center py-5">
                    <img src="https://cdn-icons-png.flaticon.com/512/7486/7486777.png" alt="Empty" style="width: 100px; opacity: 0.5;">
                    <h5 class="mt-3 text-muted">Belum ada warta yang dipublikasikan</h5>
                    <p class="text-muted small">Silakan periksa kembali nanti atau ubah filter pencarian Anda.</p>
                </div>
            </div>
        @endforelse
    </div>

</div>

<style>
    .hover-card {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    .hover-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(88, 129, 87, 0.15) !important;
    }
    .btn-forest {
        background-color: #588157;
        color: white;
        border-color: #588157;
    }
    .btn-forest:hover {
        background-color: #3a5a40;
        color: white;
        border-color: #3a5a40;
    }
    .btn-outline-forest {
        color: #588157;
        border-color: #588157;
    }
    .btn-outline-forest:hover {
        background-color: #588157;
        color: white;
    }
</style>

@endsection
