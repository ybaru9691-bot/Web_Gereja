@extends('layouts.admin')

@section('content')

<div class="page-container">

    <div class="card">
        <h2 class="page-title">Tambah Warta Baru</h2>

       <form action="/admin/warta" method="POST" enctype="multipart/form-data">
            @csrf

            <label>Judul</label>
            <input type="text" name="judul" required>

            <label>Tanggal</label>
            <input type="date" name="tanggal" required>

            <label>Isi Warta</label>
            <textarea name="isi_warta" rows="6" required></textarea>

            <label>Foto Warta</label>
              <input type="file" name="foto" accept="image/*">


            <input type="hidden" name="status" id="status">

            <div class="form-action">
                <button type="submit"
                    onclick="document.getElementById('status').value='draft'"
                    class="btn-secondary">
                    💾 Simpan Draft
                </button>

                <button type="submit"
                    onclick="document.getElementById('status').value='published'"
                    class="btn-primary">
                    🚀 Publikasikan
                </button>
            </div>

        </form>
    </div>

</div>

@endsection
