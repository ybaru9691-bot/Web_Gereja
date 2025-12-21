@extends('layouts.main')

@section('content')

<div class="container mt-5 contact-page">

    {{-- JUDUL --}}
    <div class="text-center mb-5">
        <h1 class="fw-bold">Hubungi Kami</h1>
        <p class="text-muted">
            Silakan hubungi kami untuk pertanyaan, doa, atau informasi pelayanan
        </p>
    </div>

    <div class="row">

        {{-- INFO KONTAK --}}
        <div class="col-md-5 mb-4">
            <div class="p-4 rounded shadow-sm bg-light h-100">
                <h5 class="fw-bold mb-3">Informasi Gereja</h5>

                <p class="mb-2">
                    <strong>Alamat:</strong><br>
                    Jl. Contoh No. 123, Kota Anda
                </p>

                <p class="mb-2">
                    <strong>Telepon:</strong><br>
                    0812-3456-7890
                </p>

                <p class="mb-2">
                    <strong>Email:</strong><br>
                    gerejabethania@email.com
                </p>

                <p class="mb-0">
                    <strong>Jam Pelayanan:</strong><br>
                    Senin – Jumat, 09.00 – 16.00 WIB
                </p>
            </div>
        </div>

        {{-- FORM KONTAK --}}
        <div class="col-md-7">
            <div class="p-4 rounded shadow-sm bg-white">
                <h5 class="fw-bold mb-3">Kirim Pesan</h5>

                <form>
                    <div class="mb-3">
                        <label class="form-label">Nama</label>
                        <input type="text" class="form-control"
                               placeholder="Masukkan nama Anda">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" class="form-control"
                               placeholder="Masukkan email Anda">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Pesan</label>
                        <textarea class="form-control" rows="4"
                                  placeholder="Tulis pesan Anda"></textarea>
                    </div>

                    <button type="submit" class="btn btn-primary rounded-pill px-4">
                        Kirim Pesan
                    </button>
                </form>
            </div>
        </div>

    </div>

</div>

@endsection
