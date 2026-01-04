@extends('layouts.main')

@section('content')

<section class="hero">
    <div class="typing-text-container">
        <h1 class="typing-text fw-bold" id="typingText"></h1>
    </div>
    <p>Akses warta jemaat, jadwal ibadah, dan pengumuman gereja dalam satu tempat yang terpusat dan mudah digunakan</p>
    
    <div class="mt-4">  
        <a href="{{ route('warta.index') }}" class="btn btn-hero-primary me-3">
            <i class="bi bi-book me-2"></i> Lihat Warta Jemaat
        </a>
        <a href="{{ route('pengumuman') }}" class="btn btn-hero-secondary">
            <i class="bi bi-megaphone me-2"></i> Lihat Pengumuman
        </a>
    </div>
</section>

<div class="container mt-6">
    <div class="row mb-5">
        <div class="col-md-4">
            <div class="section-box">
                <h3><i class="bi bi-journal-text me-2" style="color: #588157;"></i>Warta Mingguan</h3>
                <p>Rangkuman lengkap ibadah minggu dengan materi khotbah dan informasi penting lainnya</p>
                <a href="{{ route('warta.index') }}" class="btn btn-primary btn-sm">Baca selengkapnya →</a>
            </div>
        </div>
        <div class="col-md-4">
            <div class="section-box">
                <h3><i class="bi bi-megaphone me-2" style="color: #588157;"></i>Pengumuman</h3>
                <p>Informasi terbaru dari pendeta dan majelis untuk seluruh jemaat Gereja Bethania</p>
                <a href="{{ route('pengumuman') }}" class="btn btn-primary btn-sm">Lihat semua →</a>
            </div>
        </div>
        <div class="col-md-4">
            <div class="section-box">
                <h3><i class="bi bi-calendar3 me-2" style="color: #588157;"></i>Jadwal Ibadah</h3>
                <p>Informasi lengkap jadwal ibadah, persekutuan, dan kegiatan gereja setiap minggu</p>
                <a href="{{ route('jadwal') }}" class="btn btn-primary btn-sm">Lihat jadwal →</a>
            </div>
        </div>
    </div>

    <div class="row mt-5">
        <div class="col-lg-8">
            <h3 class="fw-bold mb-3">Jadwal Ibadah Minggu Ini</h3>
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
                        <tr>
                            <td><strong>Minggu</strong></td>
                            <td>07:00 - 10:00</td>
                            <td>Ibadah Umum Pagi</td>
                        </tr>
                        <tr>
                            <td><strong>Rabu</strong></td>
                            <td>19:00</td>
                            <td>Doa dan Pemahaman Alkitab</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card">
                <h5 class="fw-bold mb-3"><i class="bi bi-geo-alt-fill me-2" style="color: #588157;"></i>Informasi Kontak</h5>
                <div class="mb-3">
                    <p class="small text-muted mb-1">Alamat Gereja</p>
                    <p class="fw-500">Jalan Karang Anyer 2<br>Kota Tangerang</p>
                </div>
                <div class="mb-3">
                    <p class="small text-muted mb-1">Telepon</p>
                    <p class="fw-500">088xxxxx</p>
                </div>
                <div>
                    <p class="small text-muted mb-1">Email</p>
                    <p class="fw-500">info@gereja.com</p>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
// Typing Animation
const textToType = "Portal Informasi Jemaat - Selamat Datang di Sistem Informasi Gereja Bethania";
const typingElement = document.getElementById('typingText');
let charIndex = 0;
let isDeleting = false;

function typeText() {
    if (!isDeleting && charIndex < textToType.length) {
        // Typing
        typingElement.textContent = textToType.substring(0, charIndex + 1);
        charIndex++;
        setTimeout(typeText, 100); // Speed of typing
    } else if (isDeleting && charIndex > 0) {
        // Deleting
        typingElement.textContent = textToType.substring(0, charIndex - 1);
        charIndex--;
        setTimeout(typeText, 50); // Speed of deleting (faster)
    } else if (!isDeleting && charIndex === textToType.length) {
        // Pause at end, then start deleting
        isDeleting = true;
        setTimeout(typeText, 2000); // Pause before deleting
    } else if (isDeleting && charIndex === 0) {
        // Restart typing
        isDeleting = false;
        setTimeout(typeText, 500); // Pause before retyping
    }
}

// Start the animation when page loads
document.addEventListener('DOMContentLoaded', function() {
    setTimeout(typeText, 500); // Initial delay
});
</script>

@endsection
