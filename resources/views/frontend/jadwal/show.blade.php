@extends('layouts.main')

@section('title', 'Detail Jadwal Ibadah')

@section('content')
<div class="container py-5">

    <a href="{{ route('jadwal') }}" class="btn btn-secondary mb-3">
        ← Kembali ke Jadwal
    </a>

    <div class="card shadow">
        <div class="card-body">

            <h3 class="mb-4 text-center">
                {{ $jadwal->jenis_ibadah }}
            </h3>

            <table class="table table-borderless">
                <tr>
                    <th width="30%">Hari / Tanggal</th>
                    <td>
                        {{ \Carbon\Carbon::parse($jadwal->tanggal)->translatedFormat('l, d F Y') }}
                    </td>
                </tr>

                <tr>
                    <th>Waktu</th>
                    <td>
                        {{ substr($jadwal->waktu_mulai, 0, 5) }}
                        @if($jadwal->waktu_selesai)
                            – {{ substr($jadwal->waktu_selesai, 0, 5) }} WIB
                        @else
                            WIB
                        @endif
                    </td>
                </tr>

                <tr>
                    <th>Lokasi</th>
                    <td>{{ $jadwal->lokasi }}</td>
                </tr>

                <tr>
                    <th>Pelayan</th>
                    <td>{{ $jadwal->pelayan }}</td>
                </tr>

                <tr>
                    <th>Keterangan</th>
                    <td>{{ $jadwal->keterangan ?? '-' }}</td>
                </tr>
            </table>

        </div>
    </div>

</div>
@endsection
