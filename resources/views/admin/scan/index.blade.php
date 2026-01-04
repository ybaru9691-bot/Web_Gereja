<table border="1" cellpadding="8">
    <thead>
        <tr>
            <th>No</th>
            <th>Guest UUID</th>
            <th>Jenis Ibadah</th>
            <th>Tanggal Ibadah</th>
            <th>Waktu Scan</th>
            <th>Status Kehadiran</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($logs as $i => $log)
        <tr>
            <td>{{ $logs->firstItem() + $i }}</td>

            {{-- ID PALSU (INI YANG BENAR) --}}
            <td>{{ $log->guest_uuid }}</td>

            {{-- RELASI JADWAL --}}
            <td>{{ $log->jadwal->jenis_ibadah ?? '-' }}</td>
            <td>{{ $log->jadwal->tanggal ?? '-' }}</td>

            <td>{{ $log->waktu_scan }}</td>

            <td>
                @if ($log->status_kehadiran === 'hadir')
                    <span style="color:green;font-weight:bold;">Hadir</span>
                @else
                    <span style="color:red;font-weight:bold;">Terlambat</span>
                @endif
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

{{ $logs->links() }}
