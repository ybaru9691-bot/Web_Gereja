@extends('layouts.admin')

@section('content')

<div class="page-container">

    <div class="page-header">
        <h2 class="page-title">Edit Data Jemaat</h2>

        <a href="/admin/jemaat" class="btn-primary">
            ← Kembali
        </a>
    </div>

    <div class="card form-card">

        <form action="/admin/jemaat/{{ $jemaat->id }}" method="POST" class="form-jemaat">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label>Nama Jemaat</label>
                <input type="text" name="nama" value="{{ $jemaat->nama }}" required>
            </div>

            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" value="{{ $jemaat->email }}" required>
            </div>

            <div class="form-group">
                <label>No HP</label>
                <input type="text" name="nomor_hp" value="{{ $jemaat->nomor_hp }}" required>
            </div>

            <div class="form-group">
                <label>Alamat</label>
                <textarea name="alamat" required>{{ $jemaat->alamat }}</textarea>
            </div>

            <div class="form-action">
                <button type="submit" class="btn-primary">
                    Simpan Perubahan
                </button>
            </div>

        </form>

    </div>

</div>

@endsection
