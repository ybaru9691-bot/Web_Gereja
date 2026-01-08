@extends('layouts.admin')

@section('content')
<div class="page-container">
    <div class="page-header">
        <h2 class="page-title">
            <i class="bi bi-cash-coin"></i>
            Data Keuangan Ibadah
        </h2>

        <a href="{{ route('admin.keuangan.create') }}" class="btn-primary">
            <i class="bi bi-plus-lg"></i>
            Input Keuangan
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
                        <th><i class="bi bi-calendar3"></i> Tanggal</th>
                        <th><i class="bi bi-church"></i> Jenis Ibadah</th>
                        <th><i class="bi bi-cash-stack"></i> Jenis Transaksi</th>
                        <th><i class="bi bi-tag"></i> Kategori</th>
                        <th><i class="bi bi-wallet2"></i> Nominal</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($keuangan as $k)
                    <tr>
                        <td>{{ $k->tanggal }}</td>
                        <td>
                            <span style="font-weight:500;">{{ $k->jenis_ibadah }}</span>
                        </td>
                        <td>
                            @if($k->jenis_transaksi == 'pemasukan')
                                <span class="badge bg-success-subtle text-success border border-success-subtle px-3 py-2">Pemasukan</span>
                            @else
                                <span class="badge bg-danger-subtle text-danger border border-danger-subtle px-3 py-2">Pengeluaran</span>
                            @endif
                        </td>
                        <td>{{ $k->kategori }}</td>
                        <td>
                            <span style="font-weight:600; color: #333;">
                                Rp {{ number_format($k->nominal, 0, ',', '.') }}
                            </span>
                        </td>
                       
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5">
                            <div class="empty-state">
                                <i class="bi bi-cash"></i>
                                <p>Belum ada data keuangan</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<x-hint-button title="Fungsi Keuangan Ibadah">
    Mencatat dan mengelola data pemasukan serta pengeluaran kas gereja dari setiap ibadah.
</x-hint-button>
@endsection
