@extends('layouts.admin')

@section('content')

<div class="page-container">

    <div class="card">
        <h2 class="page-title">Edit Warta Jemaat</h2>

        <form action="/admin/warta/{{ $warta->warta_id }}" 
      method="POST" 
      enctype="multipart/form-data">

            @csrf
            @method('PUT')

            <label>Judul</label>
            <input type="text"
                   name="judul"
                   value="{{ old('judul', $warta->judul) }}"
                   required>

            <label>Tanggal</label>
            <input type="date"
                   name="tanggal"
                   value="{{ old('tanggal', $warta->tanggal) }}"
                   required>

            <label>Isi Warta</label>
            <textarea name="isi_warta"
                      rows="6"
                      required>{{ old('isi_warta', $warta->isi_warta) }}</textarea>

                      <label>Ganti Foto (opsional)</label>
               <input type="file" name="foto" accept="image/*">

                            @if($warta->file_path)
                                         <br>
                                 <small>Foto saat ini:</small><br>
                      <img src="{{ asset('storage/'.$warta->file_path) }}" width="120">
                                    @endif


            <label>Status</label>
            <select name="status" required>
                <option value="draft"
                    {{ old('status', $warta->status) == 'draft' ? 'selected' : '' }}>
                    Draft (Arsip)
                </option>
                <option value="published"
                    {{ old('status', $warta->status) == 'published' ? 'selected' : '' }}>
                    Published
                </option>
            </select>

            <div class="form-action">
                <button type="submit" class="btn-primary">
                    💾 Update Warta
                </button>

                <a href="{{ url('/admin/warta') }}" class="btn-secondary">
                    ⬅ Kembali
                </a>
            </div>

        </form>
    </div>

</div>

@endsection
