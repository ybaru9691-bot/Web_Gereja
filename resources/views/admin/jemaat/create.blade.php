@extends('layouts.admin')

@section('content')
<div class="page-container">

    <div class="page-header">
        <h2>Tambah Data Jemaat</h2>
        <a href="{{ url('/admin/jemaat') }}" class="btn-secondary">
            ← Kembali
        </a>
    </div>

    <div class="card form-card">
        <form action="{{ url('/admin/jemaat') }}" method="POST">
            @csrf

            <div class="form-group">
                <label>Nama Lengkap</label>
                <input type="text" name="nama" placeholder="Masukkan nama jemaat" required>
            </div>

            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" placeholder="example@email.com">
            </div>

            <div class="form-group">
                <label>Nomor HP</label>
                <input type="text" name="nomor_hp" placeholder="08xxxxxxxxxx">
            </div>

            <div class="form-group">
                <label>Alamat</label>
                <textarea name="alamat" placeholder="Masukkan alamat lengkap"></textarea>
            </div>

            <div class="form-action">
                <button type="submit" class="btn-primary">
                    💾 Simpan Data
                </button>
            </div>
        </form>
    </div>

</div>
@endsection
