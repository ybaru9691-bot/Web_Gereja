@extends('layouts.pendeta')

@section('content')
<div class="container">
    <h3>Edit Pengumuman</h3>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
        </div>
    @endif

    <form action="{{ url('/pendeta/pengumuman/'.$p->id_pengumuman) }}" method="POST">
        @csrf @method('PUT')
        <div class="mb-3">
            <label class="form-label">Judul</label>
            <input type="text" name="judul" class="form-control" value="{{ old('judul', $p->judul) }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Tanggal</label>
            <input type="date" name="tanggal" class="form-control"
                   value="{{ old('tanggal', \Carbon\Carbon::parse($p->tanggal)->format('Y-m-d')) }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Isi</label>
            <textarea name="isi" class="form-control" rows="6" required>{{ old('isi', $p->isi) }}</textarea>
        </div>

        <button class="btn btn-primary">Perbarui</button>
        <a href="{{ route('pendeta.pengumuman') }}" class="btn btn-secondary ms-2">Batal</a>
    </form>
</div>
@endsection