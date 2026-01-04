@extends('layouts.main')

@section('content')
<div class="container mt-5 text-center">

    @if ($status === 'success')
        <h3 class="text-success">✅ Scan Berhasil</h3>

        <p class="mt-3">
            Status Kehadiran:
            <strong class="text-uppercase">
                {{ $kehadiran }}
            </strong>
        </p>

        <p>
            Ibadah: {{ $jadwal->jenis_ibadah }} <br>
            Lokasi: {{ $jadwal->lokasi }}
        </p>

    @elseif ($status === 'duplicate')
        <h3 class="text-warning">⚠️ Sudah Scan</h3>
        <p>{{ $message }}</p>
    @endif

</div>
@endsection
