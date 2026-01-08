@extends('layouts.admin')

@section('title', 'Edit Jadwal Ibadah')

@section('content')
<div class="container-fluid">

    <h4 class="mb-4">Edit Jadwal Ibadah</h4>

    <div class="card">
        <div class="card-body">

            {{-- ERROR VALIDASI --}}
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('admin.jadwal.update', $jadwal->id_jadwal) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="row">
                    {{-- TANGGAL --}}
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Tanggal Ibadah</label>
                        <input type="text" id="tanggal" name="tanggal" class="form-control" 
                               value="{{ old('tanggal', $jadwal->tanggal) }}" required>
                    </div>

                    {{-- WAKTU --}}
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Waktu Mulai</label>
                        <input type="text" id="waktu_mulai" name="waktu_mulai" class="form-control" 
                               value="{{ old('waktu_mulai', $jadwal->waktu_mulai) }}" required>
                    </div>
                </div>

                {{-- JENIS IBADAH --}}
                <div class="mb-3">
                    <label class="form-label">Jenis Ibadah</label>
                    <input type="text" name="jenis_ibadah" class="form-control"
                        placeholder="Contoh: Ibadah Minggu Pagi" 
                        value="{{ old('jenis_ibadah', $jadwal->jenis_ibadah) }}" required>
                </div>

                {{-- LOKASI --}}
                <div class="mb-3">
                    <label class="form-label">Lokasi</label>
                    <input type="text" name="lokasi" class="form-control"
                        placeholder="Contoh: Gereja Bethania" 
                        value="{{ old('lokasi', $jadwal->lokasi) }}" required>
                </div>

                {{-- PELAYAN --}}
                <div class="mb-3">
                    <label class="form-label">Pelayan / Pengkhotbah</label>
                    <input type="text" name="pelayan" class="form-control"
                        placeholder="Nama Pendeta / Pelayan" 
                        value="{{ old('pelayan', $jadwal->pelayan) }}" required>
                </div>

                {{-- KETERANGAN --}}
                <div class="mb-3">
                    <label class="form-label">Keterangan (Opsional)</label>
                    <textarea name="keterangan" rows="3" class="form-control">{{ old('keterangan', $jadwal->keterangan) }}</textarea>
                </div>

                {{-- PREVIEW QR --}}
                @if($jadwal->qr_code)
                <div class="mb-3">
                    <label class="form-label">QR Jadwal Ibadah</label>
                    <div>
                        <img src="{{ asset('storage/' . $jadwal->qr_code) }}" alt="QR Jadwal" style="width:120px;height:120px;">
                    </div>
                    <a href="{{ asset('storage/' . $jadwal->qr_code) }}" target="_blank" class="btn btn-sm btn-outline-primary mt-2">
                        <i class="bi bi-download"></i> Download QR
                    </a>
                </div>
                @endif

                <div class="d-flex justify-content-between">
                    <a href="{{ route('admin.jadwal.index') }}" class="btn btn-secondary">
                        Kembali
                    </a>
                    <button type="submit" class="btn btn-primary">
                        Update Jadwal
                    </button>
                </div>

            </form>

        </div>
    </div>

</div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        flatpickr("#tanggal", {
            dateFormat: "Y-m-d",
            altInput: true,
            altFormat: "d/m/y",
            allowInput: true
        });

        flatpickr("#waktu_mulai", {
            enableTime: true,
            noCalendar: true,
            dateFormat: "H:i:S",
            time_24hr: true,
            altInput: true,
            altFormat: "H.i/00",
            allowInput: true
        });
    });
</script>
@endsection
