@extends('layouts.admin')

@section('title', 'Jadwal Ibadah')

@section('content')
<div class="page-container">

    <div class="page-header">
        <h2 class="page-title">
            <i class="bi bi-calendar-event-fill"></i>
            Jadwal Ibadah
        </h2>
        <a href="{{ url('/admin/jadwal-ibadah/create') }}" class="btn-primary">
            <i class="bi bi-plus-lg"></i>
            Tambah Jadwal
        </a>
    </div>

    {{-- ALERT SUCCESS --}}
    @if (session('success'))
        <div class="alert-modern">
            <i class="bi bi-check-circle-fill"></i>
            {{ session('success') }}
        </div>
    @endif

    <div class="card">
        <div class="table-responsive">
            <table class="data-table">
                <thead>
                    <tr>
                        <th style="width:60px">No</th>
                        <th><i class="bi bi-calendar3"></i> Tanggal</th>
                        <th><i class="bi bi-clock"></i> Waktu</th>
                        <th>Jenis Ibadah</th>
                        <th><i class="bi bi-geo-alt"></i> Lokasi</th>
                        <th>Pelayan</th>
                        <th>Status</th>
                        <th style="width:180px">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($jadwal as $item)
                    <tr>
                        <td class="index-cell">{{ $loop->iteration }}</td>

                        <td>{{ \Carbon\Carbon::parse($item->tanggal)->format('d M Y') }}</td>

                        <td>
                            {{ substr($item->waktu_mulai, 0, 5) }}
                            @if($item->waktu_selesai)
                                – {{ substr($item->waktu_selesai, 0, 5) }}
                            @endif
                        </td>

                        <td>
                            <span style="font-weight:500;">{{ $item->jenis_ibadah }}</span>
                        </td>
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
                        <td>
                            <div class="action-cell">
                                <a href="{{ route('admin.jadwal.edit', $item->id_jadwal) }}"
                                   class="btn-edit">
                                    <i class="bi bi-pencil-square"></i>
                                    Edit
                                </a>

                                <form action="{{ route('admin.jadwal.destroy', $item->id_jadwal) }}" method="POST" style="display:inline" onsubmit="return confirm('Yakin ingin menghapus jadwal ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-delete">
                                        <i class="bi bi-trash3"></i>
                                        Hapus
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8">
                            <div class="empty-state">
                                <i class="bi bi-calendar-x"></i>
                                <p>Belum ada jadwal ibadah</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>

<x-hint-button title="Fungsi Jadwal Ibadah">
    Mengatur jadwal pelayanan ibadah rutin maupun khusus.
</x-hint-button>

@endsection

