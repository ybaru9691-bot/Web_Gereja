@extends('layouts.main')


@section('content')

<section class="hero text-center">
    <h4 class="fw-bold">Portal Informasi Jemaat</h4>
    <h2 class="fw-bold mt-2">Selamat Datang di Sistem Informasi Gereja</h2>
    <p>Akses warta jemaat, jadwal ibadah, dan pengumuman gereja dalam satu tempat</p>
    
    <a href="{{ route('warta.index') }}" class="btn btn-primary mt-3">
    Lihat Warta Jemaat
</a>

    <a class="btn btn-warning mt-3">Jadwal Ibadah</a>
</section>

<div class="container mt-5">
    

    <h4 class="fw-bold mt-5">Jadwal ibadah minggu ini</h4>

    <table class="table table-bordered table-striped text-center">
        <thead class="table-warning">
            <tr>
                <th>Hari</th>
                <th>Jam</th>
                <th>Jenis Ibadah</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Minggu</td>
                <td>07.00 - 10.00</td>
                <td>Ibadah umum</td>
            </tr>
            <tr>
                <td>Rabu</td>
                <td>19.00</td>
                <td>Ibadah doa dan pemahaman Alkitab</td>
            </tr>
        </tbody>
    </table>

    <div class="row mt-4">
        <div class="col-md-6 text-center">
            <p><strong>Alamat Gereja</strong><br>Jalan Karang Anyer 2</p>
        </div>
        <div class="col-md-6 text-center">
            <p><strong>Telepon & Email</strong><br>088xxx | email@gereja.com</p>
        </div>
    </div>

</div>

@endsection
