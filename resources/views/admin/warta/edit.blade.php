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

                       <label>Tambah Foto Baru (opsional)</label>
                <input type="file" name="foto[]" accept="image/*" multiple>

                @if($warta->fotos->count() > 0)
                    <div class="mt-3">
                        <label>Foto Saat Ini (Centang untuk hapus):</label>
                        <div class="d-flex flex-wrap gap-3 mt-2">
                            @foreach($warta->fotos as $foto)
                                <div class="text-center">
                                    <img src="{{ asset('storage/'.$foto->nama_file) }}" 
                                         class="rounded mb-1" 
                                         style="width: 120px; height: 120px; object-fit: cover; border: 1px solid #ddd;">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="hapus_foto[]" value="{{ $foto->id }}" id="foto{{ $foto->id }}">
                                        <label class="form-check-label text-danger" for="foto{{ $foto->id }}">
                                            Hapus
                                        </label>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
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
