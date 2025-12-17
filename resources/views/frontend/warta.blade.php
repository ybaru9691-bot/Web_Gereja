@extends('layouts.main')

@section('content')

<div class="container mt-5">

    <h3 class="fw-bold">Daftar Warta Jemaat</h3>
    <p>Lihat rangkuman warta mingguan gereja dan akses detail tiap ibadah</p>

    {{-- FILTER --}}
    <div class="card p-3 mb-4">
        <form class="row g-2">
            <div class="col-md-3">
                <input type="date" class="form-control" placeholder="Dari tanggal">
            </div>
            <div class="col-md-3">
                <input type="date" class="form-control" placeholder="Sampai tanggal">
            </div>
            <div class="col-md-3">
                <input type="text" class="form-control" placeholder="Cari judul warta">
            </div>
            <div class="col-md-3">
                <button class="btn btn-primary w-100">Cari</button>
            </div>
        </form>
    </div>

    {{-- LIST WARTA --}}
    <div class="card p-3 mb-3">
        <h5>Ibadah minggu syukur dan perjamuan</h5>
        <p>Minggu 23 Nov 2025 - Pelayan firman Pdt Relita</p>
        <a href="#" class="btn btn-sm btn-primary">Lihat detail</a>
    </div>

    <div class="card p-3 mb-3">
        <h5>Ibadah keluarga</h5>
        <p>Minggu 16 Nov 2025 - Pelayan firman Pdt Relita</p>
        <a href="#" class="btn btn-sm btn-primary">Lihat detail</a>
    </div>

</div>

@endsection
