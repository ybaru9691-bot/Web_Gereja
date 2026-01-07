@extends('layouts.admin')

@section('content')
<div class="container">
    <h3>Data Keuangan Ibadah</h3>

    <a href="{{ route('admin.keuangan.create') }}" class="btn btn-primary mb-3">
        + Input Keuangan
    </a>

    <table class="table table-bordered table-hover">
        <thead class="table-light">
            <tr>
                <th>Tanggal</th>
                <th>Jenis Ibadah</th>
                <th>Jenis Transaksi</th>
                <th>Kategori</th>
                <th>Nominal</th>
            </tr>
        </thead>
        <tbody>
            @forelse($keuangan as $k)
            <tr>
                <td>{{ $k->tanggal }}</td>
                <td>{{ $k->jenis_ibadah }}</td>
                <td>
                    @if($k->jenis_transaksi == 'pemasukan')
                        <span class="badge bg-success">Pemasukan</span>
                    @else
                        <span class="badge bg-danger">Pengeluaran</span>
                    @endif
                </td>
                <td>{{ $k->kategori }}</td>
                <td>
                    Rp {{ number_format($k->nominal, 0, ',', '.') }}
                </td>
               
            </tr>
            @empty
            <tr>
                <td colspan="6" class="text-center">
                    Belum ada data keuangan
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
