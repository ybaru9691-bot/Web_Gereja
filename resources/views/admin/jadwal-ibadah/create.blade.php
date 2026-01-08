@extends('layouts.admin')

@section('title', 'Tambah Jadwal Ibadah')

@section('content')
<div class="container-fluid">

    <h4 class="mb-4">Tambah Jadwal Ibadah</h4>

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

            <form action="{{ url('/admin/jadwal-ibadah') }}" method="POST">
                @csrf

                <div class="row">
                    {{-- TANGGAL --}}
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Tanggal Ibadah</label>
                        <input type="text" id="tanggal" name="tanggal" class="form-control" placeholder="Pilih Tanggal" required>
                    </div>

                    {{-- WAKTU MULAI --}}
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Waktu Mulai</label>
                        <input type="text" id="waktu_mulai" name="waktu_mulai" class="form-control" placeholder="Pilih Waktu" required>
                    </div>

                    {{-- WAKTU SELESAI --}}
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Waktu Selesai (Opsional)</label>
                        <input type="text" id="waktu_selesai" name="waktu_selesai" class="form-control" placeholder="Pilih Waktu Selesai">
                    </div>
                </div>

                {{-- JENIS IBADAH --}}
                <div class="mb-3">
                    <label class="form-label">Jenis Ibadah</label>
                    <input type="text" name="jenis_ibadah" class="form-control"
                        placeholder="Contoh: Ibadah Minggu Pagi" required>
                </div>

                {{-- LOKASI --}}
                <div class="mb-3">
                    <label class="form-label">Lokasi</label>
                    <input type="text" name="lokasi" class="form-control"
                        placeholder="Contoh: Gereja Bethania" required>
                </div>

                {{-- PELAYAN --}}
                <div class="mb-3">
                    <label class="form-label">Pelayan / Pengkhotbah</label>
                    <input type="text" name="pelayan" class="form-control"
                        placeholder="Nama Pendeta / Pelayan" required>
                </div>

                {{-- KETERANGAN --}}
                <div class="mb-3">
                    <label class="form-label">Keterangan (Opsional)</label>
                    <textarea name="keterangan" rows="3" class="form-control"></textarea>
                </div>

                <div class="d-flex justify-content-between">
                    <a href="{{ url('/admin/jadwal-ibadah') }}" class="btn btn-secondary">
                        Kembali
                    </a>
                    <button type="submit" class="btn btn-primary">
                        Simpan Jadwal
                    </button>
                </div>

            </form>

            {{-- ⚡ PREVIEW QR (opsional, muncul setelah disimpan) --}}
            @if(session('qr_preview'))
                <div class="mt-4 text-center">
                    <h5>QR Jadwal Ibadah</h5>
                    <img src="{{ session('qr_preview') }}" alt="QR Jadwal" style="max-width:200px;">
                </div>
            @endif

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
            altFormat: "d/m/Y",
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

        flatpickr("#waktu_selesai", {
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
