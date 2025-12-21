@extends('layouts.main')

@section('content')

<div class="container mt-5 tentang-page">

    {{-- JUDUL --}}
    <div class="text-center mb-5">
        <h1 class="fw-bold">Tentang Gereja</h1>
        <p class="text-muted">
            Mengenal lebih dekat Gereja Bethania, visi, misi, dan pelayanan kami
        </p>
    </div>

    {{-- PROFIL GEREJA --}}
    <div class="row align-items-center mb-5">
        <div class="col-md-6 mb-3 mb-md-0">
            <img src="{{ asset('images/gereja.jpg') }}"
                 alt="Gereja Bethania"
                 class="img-fluid rounded shadow-sm">
        </div>
        <div class="col-md-6">
            <h4 class="fw-bold">Gereja Bethania</h4>
            <p>
                Gereja Bethania adalah komunitas iman yang bertumbuh dalam kasih,
                pelayanan, dan kesetiaan kepada Tuhan. Kami hadir untuk melayani
                jemaat dan masyarakat melalui ibadah, persekutuan, dan pelayanan sosial.
            </p>
        </div>
    </div>

    {{-- VISI MISI --}}
    <div class="row mb-5">
        <div class="col-md-6 mb-3">
            <div class="p-4 rounded shadow-sm bg-light h-100">
                <h5 class="fw-bold">Visi</h5>
                <p>
                    Menjadi gereja yang bertumbuh secara rohani,
                    berdampak bagi sesama, dan memuliakan Tuhan.
                </p>
            </div>
        </div>

        <div class="col-md-6 mb-3">
            <div class="p-4 rounded shadow-sm bg-light h-100">
                <h5 class="fw-bold">Misi</h5>
                <ul class="mb-0">
                    <li>Melayani jemaat dengan kasih Kristus</li>
                    <li>Membangun iman melalui ibadah dan pengajaran</li>
                    <li>Menjadi terang dan garam bagi masyarakat</li>
                </ul>
            </div>
        </div>
    </div>

    {{-- PELAYANAN --}}
    <div class="mb-5">
        <h4 class="fw-bold text-center mb-4">Pelayanan Gereja</h4>

        <div class="row text-center">
            <div class="col-md-4 mb-3">
                <div class="p-4 rounded shadow-sm bg-white h-100">
                    <h6 class="fw-bold">Ibadah Mingguan</h6>
                    <p class="text-muted mb-0">
                        Ibadah rutin untuk seluruh jemaat setiap minggu
                    </p>
                </div>
            </div>

            <div class="col-md-4 mb-3">
                <div class="p-4 rounded shadow-sm bg-white h-100">
                    <h6 class="fw-bold">Pelayanan Pemuda</h6>
                    <p class="text-muted mb-0">
                        Membina generasi muda dalam iman dan karakter
                    </p>
                </div>
            </div>

            <div class="col-md-4 mb-3">
                <div class="p-4 rounded shadow-sm bg-white h-100">
                    <h6 class="fw-bold">Pelayanan Sosial</h6>
                    <p class="text-muted mb-0">
                        Melayani masyarakat melalui aksi sosial dan kepedulian
                    </p>
                </div>
            </div>
        </div>
    </div>

</div>

@endsection
