@extends('layouts.admin')

@section('title', 'Jadwal Ibadah')

@section('content')
<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4>Jadwal Ibadah</h4>
        <a href="{{ url('/admin/jadwal-ibadah/create') }}" class="btn btn-primary">
            + Tambah Jadwal
        </a>
    </div>

    {{-- ALERT SUCCESS --}}
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="card">
        <div class="card-body table-responsive">

            <table class="table table-bordered table-hover">
                <thead class="table-light">
                    <tr>
                        <th>No</th>
                        <th>Tanggal</th>
                        <th>Waktu</th>
                        <th>Jenis Ibadah</th>
                        <th>Lokasi</th>
                        <th>Pelayan</th>
                        <th>Status</th>
                         <th>Aksi</th>
                    </tr>
                </thead>

             <tbody>
@forelse ($jadwal as $item)
<tr>
    <td>{{ $loop->iteration }}</td>

    <td>
        {{ \Carbon\Carbon::parse($item->tanggal)->format('d M Y') }}
    </td>

    <td>
        {{ substr($item->waktu_mulai, 0, 5) }}
        @if($item->waktu_selesai)
            – {{ substr($item->waktu_selesai, 0, 5) }}
        @endif
    </td>

    <td>{{ $item->jenis_ibadah }}</td>
    <td>{{ $item->lokasi }}</td>
    <td>{{ $item->pelayan ?? '-' }}</td>

    {{-- STATUS --}}
    <td>
        @if ($item->tanggal >= now()->toDateString())
            <span class="badge bg-success">Akan Datang</span>
        @else
            <span class="badge bg-secondary">Selesai</span>
        @endif
    </td>

    {{-- AKSI --}}
    {{-- AKSI --}}
    <td>
        <a href="{{ route('admin.jadwal.edit', $item->id_jadwal) }}"
           class="btn btn-sm btn-warning">
            Edit
        </a>

        <form action="{{ route('admin.jadwal.destroy', $item->id_jadwal) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus jadwal ini?');">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-sm btn-danger">
                Hapus
            </button>
        </form>
    </td>
</tr>
@empty
<tr>
    <td colspan="8" class="text-center">
        Belum ada jadwal ibadah
    </td>
</tr>
@endforelse
</tbody>

            </table>

        </div>
    </div>

<x-hint-button title="Fungsi Jadwal Ibadah">
    Mengatur jadwal pelayanan ibadah rutin dan khusus. Pastikan informasi tanggal, waktu, dan lokasi ibadah sudah akurat sebelum dipublikasikan agar jemaat mendapatkan informasi yang benar.
</x-hint-button>

@endsection
