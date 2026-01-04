@extends('layouts.main')

@section('content')

<div class="container mt-5 tentang-page">

    {{-- JUDUL --}}
    <div class="text-center mb-5">
        <h1 class="fw-bold">Tentang Gereja</h1>
        <p class="text-muted lead">
            Mengenal lebih dekat Gereja Bethania, visi, misi, dan pelayanan kami
        </p>
    </div>

    {{-- PROFIL GEREJA --}}
    <div class="row align-items-center mb-5 tentang-section">
        <div class="col-md-6 mb-3 mb-md-0">
            <img src="{{ asset('images/img betania.jpeg') }}"
                 alt="Gereja Bethania"
                 class="img-fluid gereja-img">
        </div>
        <div class="col-md-6">
            <h4 class="fw-bold" style="color: #588157;">Gereja Bethania</h4>
            <p class="text-muted">
                Gereja Bethania adalah komunitas iman yang bertumbuh dalam kasih,
                pelayanan, dan kesetiaan kepada Tuhan. Kami hadir untuk melayani
                jemaat dan masyarakat melalui ibadah, persekutuan, dan pelayanan sosial.
            </p>
            <p class="text-muted mb-0">
                Sejak berdiri, kami berkomitmen untuk menjadi terang bagi dunia
                dan membawa transformasi melalui kasih Kristus.
            </p>
        </div>
    </div>

    {{-- VISI MISI --}}
    <div class="row mb-5 tentang-section visi-misi">
        <div class="col-12 text-center mb-4">
            <h4 class="fw-bold">Visi & Misi Kami</h4>
        </div>
        
        <div class="col-md-6 mb-3">
            <div class="tentang-card h-100">
                <div class="tentang-icon">
                    <i class="bi bi-eye-fill" style="color: #fff;"></i>
                </div>
                <h5 class="fw-bold">Visi</h5>
                <p class="mb-0">
                    Menjadi gereja yang bertumbuh secara rohani,
                    berdampak bagi sesama, dan memuliakan Tuhan dalam setiap aspek kehidupan.
                </p>
            </div>
        </div>

        <div class="col-md-6 mb-3">
            <div class="tentang-card h-100">
                <div class="tentang-icon">
                    <i class="bi bi-bullseye" style="color: #fff;"></i>
                </div>
                <h5 class="fw-bold">Misi</h5>
                <ul class="mb-0">
                    <li>Melayani jemaat dengan kasih Kristus</li>
                    <li>Membangun iman melalui ibadah dan pengajaran</li>
                    <li>Menjadi terang dan garam bagi masyarakat</li>
                    <li>Mengembangkan talenta dan potensi setiap jemaat</li>
                </ul>
            </div>
        </div>
    </div>

    {{-- SEJARAH SINGKAT --}}
    <div class="tentang-section sejarah text-center py-5 rounded-4 mb-5">
        <div class="container">
            <h4 class="fw-bold mb-4">Sejarah Singkat</h4>
            <p class="lead mb-0 text-white">
                Gereja Bethania didirikan pada tahun 1985 dengan visi untuk melayani
                masyarakat dan membangun iman yang kokoh. Selama lebih dari 35 tahun,
                kami telah menjadi rumah spiritual bagi ribuan jemaat dan terus bertumbuh
                dalam kasih karunia Tuhan.
            </p>
        </div>
    </div>

    {{-- AYAT ALKITAB --}}
    <div class="row mb-5">
        <div class="col-12">
            <div class="ayat">
                <p class="fs-5 fw-bold mb-2">
                    "Karena Aku ini mengetahui rancangan-rancangan apa yang ada pada-Ku mengenai kamu, 
                    demikianlah firman TUHAN, yaitu rancangan damai sejahtera dan bukan rancangan kecelakaan, 
                    untuk memberikan kepadamu hari depan yang penuh harapan."
                </p>
                <p class="text-end mb-0 fw-bold">— Yeremia 29:11</p>
            </div>
        </div>
    </div>

    {{-- PELAYANAN --}}
    <div class="mb-5 tentang-section">
        <h4 class="fw-bold text-center mb-4">Pelayanan Gereja</h4>

        <div class="row text-center">
            <div class="col-md-4 mb-4">
                <div class="tentang-card h-100">
                    <img src="https://images.unsplash.com/photo-1507692049790-de58290a4334?w=400" 
                         alt="Ibadah Mingguan" 
                         class="img-fluid rounded mb-3"
                         style="height: 200px; object-fit: cover; width: 100%;">
                    <h6 class="fw-bold">Ibadah Mingguan</h6>
                    <p class="text-muted mb-0">
                        Ibadah rutin untuk seluruh jemaat setiap minggu dengan pujian dan firman Tuhan
                    </p>
                </div>
            </div>

            <div class="col-md-4 mb-4">
                <div class="tentang-card h-100">
                    <img src="https://images.unsplash.com/photo-1529070538774-1843cb3265df?w=400" 
                         alt="Pelayanan Pemuda" 
                         class="img-fluid rounded mb-3"
                         style="height: 200px; object-fit: cover; width: 100%;">
                    <h6 class="fw-bold">Pelayanan Pemuda</h6>
                    <p class="text-muted mb-0">
                        Membina generasi muda dalam iman dan karakter melalui kegiatan yang inspiratif
                    </p>
                </div>
            </div>

            <div class="col-md-4 mb-4">
                <div class="tentang-card h-100">
                    <img src="https://images.unsplash.com/photo-1559027615-cd4628902d4a?w=400" 
                         alt="Pelayanan Sosial" 
                         class="img-fluid rounded mb-3"
                         style="height: 200px; object-fit: cover; width: 100%;">
                    <h6 class="fw-bold">Pelayanan Sosial</h6>
                    <p class="text-muted mb-0">
                        Melayani masyarakat melalui aksi sosial dan kepedulian terhadap sesama
                    </p>
                </div>
            </div>
        </div>
    </div>

    {{-- GALERI FOTO --}}
    <div class="mb-5 tentang-section">
        <h4 class="fw-bold text-center mb-4">Galeri Foto</h4>
        <div class="row g-3">
            <div class="col-md-4 col-6">
                <img src="https://images.unsplash.com/photo-1438232992991-995b7058bbb3?w=500" 
                     alt="Gereja" 
                     class="img-fluid rounded shadow-sm"
                     style="height: 200px; object-fit: cover; width: 100%;">
            </div>
            <div class="col-md-4 col-6">
                <img src="https://images.unsplash.com/photo-1507692049790-de58290a4334?w=500" 
                     alt="Ibadah" 
                     class="img-fluid rounded shadow-sm"
                     style="height: 200px; object-fit: cover; width: 100%;">
            </div>
            <div class="col-md-4 col-6">
                <img src="https://images.unsplash.com/photo-1529070538774-1843cb3265df?w=500" 
                     alt="Pemuda" 
                     class="img-fluid rounded shadow-sm"
                     style="height: 200px; object-fit: cover; width: 100%;">
            </div>
            <div class="col-md-4 col-6">
                <img src="https://images.unsplash.com/photo-1511632765486-a01980e01a18?w=500" 
                     alt="Persekutuan" 
                     class="img-fluid rounded shadow-sm"
                     style="height: 200px; object-fit: cover; width: 100%;">
            </div>
            <div class="col-md-4 col-6">
                <img src="https://images.unsplash.com/photo-1559027615-cd4628902d4a?w=500" 
                     alt="Pelayanan" 
                     class="img-fluid rounded shadow-sm"
                     style="height: 200px; object-fit: cover; width: 100%;">
            </div>
            <div class="col-md-4 col-6">
                <img src="https://images.unsplash.com/photo-1519491050282-cf00c82424b4?w=500" 
                     alt="Komunitas" 
                     class="img-fluid rounded shadow-sm"
                     style="height: 200px; object-fit: cover; width: 100%;">
            </div>
        </div>
    </div>

    {{-- KONTAK INFO --}}
    <div class="row text-center mb-5">
        <div class="col-md-4 mb-3">
            <div class="tentang-card">
                <div class="tentang-icon"><i class="bi bi-geo-alt-fill"></i></div>
                <h6 class="fw-bold">Alamat</h6>
                <p class="text-muted mb-0">Jalan Karang Anyer 2<br>Kota Anda</p>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="tentang-card">
                <div class="tentang-icon"><i class="bi bi-telephone-fill"></i></div>
                <h6 class="fw-bold">Telepon</h6>
                <p class="text-muted mb-0">088xxx</p>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="tentang-card">
                <div class="tentang-icon"><i class="bi bi-envelope-fill"></i></div>
                <h6 class="fw-bold">Email</h6>
                <p class="text-muted mb-0">email@gereja.com</p>
            </div>
        </div>
    </div>

</div>

@endsection