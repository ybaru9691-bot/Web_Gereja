@extends('layouts.pendeta')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-1">
                    <li class="breadcrumb-item"><a href="{{ route('pendeta.analisis') }}">Analisis</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Detail Data Mentah</li>
                </ol>
            </nav>
            <h3 class="fw-bold m-0">Detail Data Analisis Jemaat</h3>
            <p class="text-muted small">Periode: {{ $latestPeriode }}</p>
        </div>
        <a href="{{ route('pendeta.analisis.download') }}" class="btn btn-outline-primary btn-sm">
            <i class="bi bi-file-earmark-pdf"></i> Unduh PDF
        </a>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light">
                        <tr>
                            <th class="ps-4">Guest UUID</th>
                            <th>F (Frekuensi)</th>
                            <th>R (Lateness)</th>
                            <th>D (Duration)</th>
                            <th>Klaster</th>
                            <th class="text-end pe-4">Waktu Update</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($data as $row)
                        <tr>
                            <td class="ps-4">
                                <span class="fw-bold">{{ $row->guest_uuid }}</span>
                            </td>
                            <td>{{ $row->score_f }} Kali</td>
                            <td>{{ $row->score_r }} Kali Terlambat</td>
                            <td>{{ $row->score_d }} Menit</td>
                            <td>
                                <span class="badge rounded-pill 
                                    @if($row->cluster_label == 'Aktif') bg-success 
                                    @elseif($row->cluster_label == 'Sedang') bg-warning text-dark 
                                    @else bg-danger @endif">
                                    {{ $row->cluster_label }}
                                </span>
                            </td>
                            <td class="text-end pe-4 text-muted small">
                                {{ \Carbon\Carbon::parse($row->last_calculated_at)->format('d/m/Y H:i') }}
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center py-5 text-muted"> Belum ada data analisis untuk periode ini.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
