@extends('layouts.main')

@section('content')

{{-- HERO SECTION --}}
<section class="hero">
    <div class="typing-text-container">
        <h1 class="typing-text fw-bold" id="typingText"></h1>
    </div>
    <p>Akses warta jemaat, jadwal ibadah, dan pengumuman gereja dalam satu tempat yang terpusat dan mudah digunakan</p>
    
    <div class="mt-4">  
        <a href="#warta" class="btn btn-hero-primary me-3">
            <i class="bi bi-book me-2"></i> Lihat Warta Jemaat
        </a>
        <a href="#pengumuman" class="btn btn-hero-secondary">
            <i class="bi bi-megaphone me-2"></i> Lihat Pengumuman
        </a>
    </div>
</section>

<div class="container mt-5">
    
    {{-- WARTA JEMAAT SECTION --}}
    <section id="warta" class="py-5" style="scroll-margin-top: 80px;">
        <div class="text-center mb-5">
            <h2 class="fw-bold"><i class="bi bi-journal-text me-2" style="color: #588157;"></i>Warta Jemaat</h2>
            <p class="text-muted">Rangkuman lengkap ibadah minggu dengan materi khotbah dan informasi penting lainnya</p>
        </div>
        
        <div class="row g-4">
            @forelse ($wartas->take(3) as $warta)
                <div class="col-md-4">
                    <div class="card h-100 border-0 shadow-sm rounded-4 hover-card overflow-hidden">
                        <div class="card-header border-0 p-4 text-white d-flex align-items-center justify-content-center" 
                             style="background: linear-gradient(135deg, #588157 0%, #3a5a40 100%); height: 120px;">
                            <div class="text-center">
                                <h4 class="fw-bold mb-0 text-white-50">{{ \Carbon\Carbon::parse($warta->tanggal)->format('d') }}</h4>
                                <h6 class="text-uppercase mb-0">{{ \Carbon\Carbon::parse($warta->tanggal)->translatedFormat('M Y') }}</h6>
                            </div>
                        </div>
                        <div class="card-body p-4 d-flex flex-column">
                            <h5 class="card-title fw-bold mb-3">
                                <a href="{{ route('warta.show', ['id' => $warta->warta_id]) }}" class="text-decoration-none text-dark stretched-link">
                                    {{ $warta->judul }}
                                </a>
                            </h5>
                            <p class="card-text text-muted mb-4 flex-grow-1">
                                {{ Str::limit(strip_tags($warta->isi_warta), 100, '...') }}
                            </p>
                            
                            <div class="mb-3 position-relative" style="z-index: 5;">
                                <a href="{{ route('warta.download', ['id' => $warta->warta_id]) }}" class="btn btn-outline-forest btn-sm w-100 rounded-pill">
                                    <i class="bi bi-download me-1"></i> Download PDF
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center text-muted">Belum ada warta terbaru.</div>
            @endforelse
        </div>
        <div class="text-center mt-4">
            <a href="{{ route('warta.index') }}" class="btn btn-outline-forest rounded-pill px-4">Lihat Semua Warta</a>
        </div>
    </section>

    <hr class="my-5">

    {{-- JADWAL IBADAH SECTION --}}
    <section id="jadwal" class="py-5" style="scroll-margin-top: 80px;">
        <div class="row">
            <div class="col-lg-8">
                <h2 class="fw-bold mb-4"><i class="bi bi-calendar3 me-2" style="color: #588157;"></i>Jadwal Ibadah Minggu Ini</h2>
                <div class="table-responsive">
                    <table class="data-table">
                        <thead>
                            <tr>
                                <th>Hari</th>
                                <th>Waktu</th>
                                <th>Jenis Ibadah</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($jadwal as $j)
                            <tr>
                                <td><strong>{{ \Carbon\Carbon::parse($j->tanggal)->translatedFormat('l, d M') }}</strong></td>
                                <td>{{ \Carbon\Carbon::parse($j->waktu_mulai)->format('H:i') }} - {{ \Carbon\Carbon::parse($j->waktu_selesai)->format('H:i') }}</td>
                                <td>{{ $j->nama_ibadah }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="3" class="text-center">Belum ada jadwal ibadah minggu ini.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card shadow-sm border-0 rounded-4 p-4 h-100">
                    <h5 class="fw-bold mb-3"><i class="bi bi-clock-history me-2" style="color: #588157;"></i>Kegiatan Rutin</h5>
                    <ul class="list-unstyled">
                        <li class="mb-2"><i class="bi bi-check2-circle me-2 text-success"></i>Ibadah Minggu Pagi (07:00)</li>
                        <li class="mb-2"><i class="bi bi-check2-circle me-2 text-success"></i>Ibadah Minggu Siang (10:30)</li>
                        <li class="mb-2"><i class="bi bi-check2-circle me-2 text-success"></i>Doa Rabu Malam (19:00)</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <hr class="my-5">

    {{-- PENGUMUMAN SECTION --}}
    <section id="pengumuman" class="py-5" style="scroll-margin-top: 80px;">
        <div class="text-center mb-5">
            <h2 class="fw-bold"><i class="bi bi-megaphone me-2" style="color: #588157;"></i>Pengumuman</h2>
            <p class="text-muted">Informasi terbaru dari pendeta dan majelis untuk jemaat</p>
        </div>

        <div class="row">
            @if($highlight)
            <div class="col-12 mb-4">
                <div class="p-4 rounded-4 shadow-sm" style="background: rgba(88, 129, 87, 0.05); border: 1px solid rgba(88, 129, 87, 0.2);">
                    <span class="badge rounded-pill mb-2" style="background-color: #588157;">Utama</span>
                    <h4 class="fw-bold">{{ $highlight->judul }}</h4>
                    <p class="text-muted">{{ Str::limit(strip_tags($highlight->isi), 300) }}</p>
                    <div class="small text-muted mb-3"><i class="bi bi-calendar-event me-1"></i>{{ \Carbon\Carbon::parse($highlight->tanggal)->translatedFormat('d F Y') }}</div>
                </div>
            </div>
            @endif

            <div class="col-12">
                <div class="row g-3">
                    @foreach($pengumuman->skip(1)->take(4) as $p)
                    <div class="col-md-6">
                        <div class="p-3 bg-white shadow-sm rounded-4 border-start border-4" style="border-color: #588157 !important;">
                            <h6 class="fw-bold mb-1">{{ $p->judul }}</h6>
                            <p class="small text-muted mb-0">{{ Str::limit(strip_tags($p->isi), 100) }}</p>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="text-center mt-4">
            <a href="{{ route('pengumuman') }}" class="btn btn-outline-forest rounded-pill px-4">Lihat Semua Pengumuman</a>
        </div>
    </section>

    <hr class="my-5">

    {{-- TENTANG / KONTAK SECTION --}}
    <section id="tentang" class="py-5 mb-5" style="scroll-margin-top: 80px;">
        <div class="row">
            <div class="col-md-6">
                <h2 class="fw-bold mb-4">Mengenal Gereja Bethania</h2>
                <p class="text-muted">Gereja Bethania hadir sebagai rumah bagi setiap orang yang rindu bertumbuh dalam kasih Tuhan. Melalui pelayanan yang terpusat pada firman dan kepedulian antar sesama, kami berkomitmen menjadi terang bagi lingkungan sekitar.</p>
                <div class="mt-4">
                    <a href="{{ route('tentang') }}" class="btn btn-forest rounded-pill px-4">Selengkapnya Tentang Kami</a>
                </div>
            </div>
            <div class="col-md-6 mt-4 mt-md-0">
                <div class="card shadow-sm border-0 rounded-4 p-4">
                    <h5 class="fw-bold mb-4">Informasi Kontak</h5>
                    <div class="d-flex mb-3">
                        <div class="me-3" style="color: #588157;"><i class="bi bi-geo-alt-fill fs-4"></i></div>
                        <div>
                            <h6 class="fw-bold mb-1">Alamat</h6>
                            <p class="text-muted mb-0 small">Jalan Karang Anyer 2, Kota Tangerang</p>
                        </div>
                    </div>
                    <div class="d-flex mb-3">
                        <div class="me-3" style="color: #588157;"><i class="bi bi-telephone-fill fs-4"></i></div>
                        <div>
                            <h6 class="fw-bold mb-1">Telepon</h6>
                            <p class="text-muted mb-0 small">088xxxxx</p>
                        </div>
                    </div>
                    <div class="d-flex">
                        <div class="me-3" style="color: #588157;"><i class="bi bi-envelope-fill fs-4"></i></div>
                        <div>
                            <h6 class="fw-bold mb-1">Email</h6>
                            <p class="text-muted mb-0 small">info@gereja.com</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<style>
    .hover-card {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    .hover-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(88, 129, 87, 0.1) !important;
    }
    .btn-forest {
        background-color: #588157;
        color: white;
        border-color: #588157;
    }
    .btn-forest:hover {
        background-color: #3a5a40;
        color: white;
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

<script>
// Typing Animation
const textToType = "Portal Informasi Jemaat - Selamat Datang di Sistem Informasi Gereja Bethania";
const typingElement = document.getElementById('typingText');
let charIndex = 0;
let isDeleting = false;

function typeText() {
    if (!isDeleting && charIndex < textToType.length) {
        typingElement.textContent = textToType.substring(0, charIndex + 1);
        charIndex++;
        setTimeout(typeText, 100);
    } else if (isDeleting && charIndex > 0) {
        typingElement.textContent = textToType.substring(0, charIndex - 1);
        charIndex--;
        setTimeout(typeText, 50);
    } else if (!isDeleting && charIndex === textToType.length) {
        isDeleting = true;
        setTimeout(typeText, 2000);
    } else if (isDeleting && charIndex === 0) {
        isDeleting = false;
        setTimeout(typeText, 500);
    }
}

document.addEventListener('DOMContentLoaded', function() {
    setTimeout(typeText, 500);
});
</script>

@endsection

