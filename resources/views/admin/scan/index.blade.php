@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="page-header d-flex justify-content-between align-items-center mb-4">
        <h2 class="page-title">Scan Log Kehadiran</h2>
    </div>

    <div class="card">
        <div class="card-body table-responsive p-0">
            <table class="table table-hover mb-0">
                <thead class="table-light">
                    <tr>
                        <th class="px-4 py-3">No</th>
                        <th class="py-3">Guest UUID</th>
                        <th class="py-3">Jenis Ibadah</th>
                        <th class="py-3">Tanggal Ibadah</th>
                        <th class="py-3">Waktu Scan</th>
                        <th class="py-3">Status Kehadiran</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($logs as $i => $log)
                    <tr>
                        <td class="px-4">{{ $logs->firstItem() + $i }}</td>
                        <td><code class="text-muted">{{ $log->guest_uuid }}</code></td>
                        <td>{{ $log->jadwal->jenis_ibadah ?? '-' }}</td>
                        <td>{{ $log->jadwal->tanggal ?? '-' }}</td>
                        <td>{{ \Carbon\Carbon::parse($log->waktu_scan)->format('H:i:s') }}</td>
                        <td>
                            @if ($log->status_kehadiran === 'hadir')
                                <span class="badge bg-success-subtle text-success border border-success-subtle px-3 py-2">Hadir</span>
                            @else
                                <span class="badge bg-danger-subtle text-danger border border-danger-subtle px-3 py-2">Terlambat</span>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center py-5 text-muted">
                            Belum ada data scan log
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-4">
        {{ $logs->links() }}
    </div>
</div>

<x-hint-button title="Fungsi Scan Log">
    Halaman ini menampilkan riwayat scan kehadiran jemaat saat mengikuti ibadah. Anda dapat memantau siapa saja yang hadir dan ketepatan waktu mereka.
</x-hint-button>
@endsection
