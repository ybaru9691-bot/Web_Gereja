@extends('layouts.pendeta')

@section('content')
<div class="container-fluid">
    {{-- HEADER --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-bold mb-0">
            <i class="bi bi-cash-coin me-2"></i>Laporan Keuangan
        </h3>
        <span class="badge bg-secondary">
            <i class="bi bi-eye me-1"></i>Mode Lihat
        </span>
    </div>

    {{-- RINGKASAN KEUANGAN --}}
    <div class="row g-3 mb-4">
        <div class="col-md-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="rounded-circle bg-success bg-opacity-10 p-3 me-3">
                            <i class="bi bi-arrow-down-circle text-success fs-4"></i>
                        </div>
                        <div>
                            <small class="text-muted">Total Pemasukan</small>
                            <h5 class="fw-bold text-success mb-0">
                                Rp {{ number_format($totalPemasukan ?? 0, 0, ',', '.') }}
                            </h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="rounded-circle bg-danger bg-opacity-10 p-3 me-3">
                            <i class="bi bi-arrow-up-circle text-danger fs-4"></i>
                        </div>
                        <div>
                            <small class="text-muted">Total Pengeluaran</small>
                            <h5 class="fw-bold text-danger mb-0">
                                Rp {{ number_format($totalPengeluaran ?? 0, 0, ',', '.') }}
                            </h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="rounded-circle bg-primary bg-opacity-10 p-3 me-3">
                            <i class="bi bi-wallet2 text-primary fs-4"></i>
                        </div>
                        <div>
                            <small class="text-muted">Saldo</small>
                            <h5 class="fw-bold text-primary mb-0">
                                Rp {{ number_format($saldo ?? 0, 0, ',', '.') }}
                            </h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- TABEL KEUANGAN --}}
    <div class="card border-0 shadow-sm">
        <div class="card-header bg-white py-3">
            <h5 class="mb-0 fw-bold">
                <i class="bi bi-table me-2"></i>Rincian Transaksi
            </h5>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th class="ps-4">No</th>
                            <th>Tanggal</th>
                            <th>Jenis Ibadah</th>
                            <th>Jenis Transaksi</th>
                            <th>Kategori</th>
                            <th class="text-end pe-4">Nominal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($keuangan as $index => $k)
                        <tr>
                            <td class="ps-4">{{ $index + 1 }}</td>
                            <td>
                                <span class="text-muted">
                                    {{ \Carbon\Carbon::parse($k->tanggal)->format('d M Y') }}
                                </span>
                            </td>
                            <td>
                                <span class="fw-medium">{{ $k->jenis_ibadah }}</span>
                            </td>
                            <td>
                                @if($k->jenis_transaksi == 'pemasukan')
                                    <span class="badge bg-success bg-opacity-75">
                                        <i class="bi bi-arrow-down-circle me-1"></i>Pemasukan
                                    </span>
                                @else
                                    <span class="badge bg-danger bg-opacity-75">
                                        <i class="bi bi-arrow-up-circle me-1"></i>Pengeluaran
                                    </span>
                                @endif
                            </td>
                            <td>
                                <span class="badge bg-light text-dark">{{ $k->kategori }}</span>
                            </td>
                            <td class="text-end pe-4">
                                <span class="fw-bold {{ $k->jenis_transaksi == 'pemasukan' ? 'text-success' : 'text-danger' }}">
                                    Rp {{ number_format($k->nominal, 0, ',', '.') }}
                                </span>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center py-5">
                                <div class="text-muted">
                                    <i class="bi bi-inbox fs-1 d-block mb-2"></i>
                                    <p class="mb-0">Belum ada data keuangan yang diinput oleh Admin.</p>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        @if(count($keuangan) > 0)
        <div class="card-footer bg-white py-3">
            <small class="text-muted">
                <i class="bi bi-info-circle me-1"></i>
                Menampilkan {{ count($keuangan) }} transaksi. Data ini diinput oleh Admin.
            </small>
        </div>
        @endif
    </div>
</div>

<style>
    .table th {
        font-weight: 600;
        font-size: 0.85rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        color: #6c757d;
    }
    
    .table td {
        vertical-align: middle;
    }
    
    .card {
        border-radius: 10px;
    }
    
    .badge {
        font-weight: 500;
    }
</style>
@endsection