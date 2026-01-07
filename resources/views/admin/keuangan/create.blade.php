@extends('layouts.admin')

@section('content')
<div class="container">
    <h4>Input Keuangan Ibadah</h4>

    <form action="{{ route('admin.keuangan.store') }}" method="POST">
        @csrf

        {{-- Pilih Jadwal Ibadah --}}
        <div class="mb-3">
            <label class="form-label">Jadwal Ibadah</label>
            <select name="jadwal_id" class="form-control" required>
                <option value="">-- Pilih Jadwal --</option>
                @foreach ($jadwal as $j)
                    <option value="{{ $j->id_jadwal }}">
                        {{ $j->jenis_ibadah }} | {{ $j->tanggal }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- Jenis Transaksi --}}
        <div class="mb-3">
            <label class="form-label">Jenis Transaksi</label>
            <select name="jenis_transaksi" class="form-control" required>
                <option value="">-- Pilih Jenis --</option>
                <option value="pemasukan">Pemasukan</option>
                <option value="pengeluaran">Pengeluaran</option>
            </select>
        </div>

        {{-- Kategori --}}
        <div class="mb-3">
            <label class="form-label">Kategori</label>
            <input type="text"
                   name="kategori"
                   class="form-control"
                   placeholder="Contoh: Pelean IA"
                   required>
        </div>

        {{-- Nominal --}}
        <div class="mb-3">
            <label class="form-label">Nominal (Rp)</label>
            <input type="number"
                   name="nominal"
                   class="form-control"
                   placeholder="Contoh: 596000"
                   required>
        </div>

        <button type="submit" class="btn btn-primary">
            Simpan
        </button>
    </form>
</div>
@endsection
