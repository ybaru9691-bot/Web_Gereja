@extends('layouts.admin')

@section('content')
<div class="page-container">
    <div class="page-header">
        <h2 class="page-title">
            <i class="bi bi-qr-code-scan"></i>
            Scan Log Kehadiran
        </h2>
    </div>

    <div class="card">
        <div class="table-responsive">
            <table class="data-table">
                <thead>
                    <tr>
                        <th style="width:60px">No</th>
                        <th>Guest UUID</th>
                        <th>Jenis Ibadah</th>
                        <th><i class="bi bi-calendar3"></i> Tanggal Ibadah</th>
                        <th><i class="bi bi-clock"></i> Waktu Scan</th>
                        <th>Status Kehadiran</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($logs as $i => $log)
                    <tr>
                        <td class="index-cell">{{ $logs->firstItem() + $i }}</td>
                        <td>
                            <span class="uuid-cell" title="{{ $log->guest_uuid }}">
                                {{ $log->guest_uuid }}
                            </span>
                        </td>
                        <td>
                            <span style="font-weight:500;">
                                {{-- Tampilkan dari relasi jadwal, jika tidak ada tetap '-' --}}
                                @if($log->jadwal && $log->jadwal->jenis_ibadah)
                                    {{ $log->jadwal->jenis_ibadah }}
                                    @if(!empty($log->jadwal->inferred))
                                        <small class="text-muted">(inferred)</small>
                                    @endif
                                @else
                                    -
                                @endif
                            </span>
                        </td>
                        <td>
                            {{-- Jika tidak ada jadwal terkait, tampilkan tanggal dari waktu_scan sebagai fallback --}}
                            @if($log->jadwal && $log->jadwal->tanggal)
                                {{ $log->jadwal->tanggal }}
                            @else
                                {{ \Carbon\Carbon::parse($log->waktu_scan)->toDateString() }}
                            @endif
                        </td>
                        <td>{{ \Carbon\Carbon::parse($log->waktu_scan)->format('H:i:s') }}</td>
                        <td>
                            @if ($log->status_kehadiran === 'tepat')
                                <span class="badge bg-success-subtle text-success border border-success-subtle px-3 py-2">Tepat Waktu</span>
                            @elseif ($log->status_kehadiran === 'terlambat')
                                <span class="badge bg-warning-subtle text-warning border border-warning-subtle px-3 py-2">Terlambat</span>
                            @elseif ($log->status_kehadiran === 'terlambat_berat')
                                <span class="badge bg-danger-subtle text-danger border border-danger-subtle px-3 py-2">Terlambat Berat</span>
                            @else
                                <span class="badge bg-secondary-subtle text-secondary border border-secondary-subtle px-3 py-2">{{ ucfirst($log->status_kehadiran ?? '-') }}</span>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6">
                            <div class="empty-state">
                                <i class="bi bi-qr-code"></i>
                                <p>Belum ada data scan log</p>
                            </div>
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
    Halaman ini menampilkan riwayat scan QR oleh jemaat saat mengikuti ibadah.
</x-hint-button>
@endsection

