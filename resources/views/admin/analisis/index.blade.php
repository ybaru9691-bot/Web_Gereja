@extends('layouts.admin')

@section('content')
<div class="analisis-container">

    <div class="analisis-header">
        <h1 class="analisis-title">
            <i class="bi bi-bar-chart-line-fill"></i>
            Analisis Jemaat
        </h1>

        {{-- tombol hitung --}}
        <form action="{{ route('admin.analisis.hitung') }}" method="POST" class="m-0">
            @csrf
            <button type="submit" class="btn-calculate">
                <i class="bi bi-calculator"></i>
                Hitung Analisis Jemaat
            </button>
        </form>
    </div>

    {{-- notifikasi sukses --}}
    @if(session('success'))
        <div class="alert-modern">
            <i class="bi bi-check-circle-fill"></i>
            {{ session('success') }}
        </div>
    @endif

    {{-- tabel hasil --}}
    <div class="table-card">
        <table class="analisis-table">
           <thead>
                <tr>
                    <th>Periode</th>
                    <th>Guest UUID</th>
                    <th>Score F</th>
                    <th>Score R</th>
                    <th>Score D</th>
                    <th>Cluster</th>
                    <th>Terakhir Dihitung</th>
                </tr>
            </thead>

            <tbody>
              @forelse ($data as $row)
                <tr>
                    <td>{{ $row->periode }}</td>
                    <td>
                        <span class="uuid-cell" title="{{ $row->guest_uuid }}">
                            {{ $row->guest_uuid }}
                        </span>
                    </td>
                    <td class="score-cell score-f">{{ $row->score_f }}</td>
                    <td class="score-cell score-r">{{ $row->score_r }}</td>
                    <td class="score-cell score-d">{{ $row->score_d }}</td>
                    <td>
                        <span class="cluster-badge 
                            @if($row->cluster_label == 'Disiplin') cluster-disiplin
                            @elseif($row->cluster_label == 'Cukup Disiplin') cluster-cukup
                            @else cluster-kurang
                            @endif
                        ">
                            @if($row->cluster_label == 'Disiplin')
                                <i class="bi bi-check-circle-fill"></i>
                            @elseif($row->cluster_label == 'Cukup Disiplin')
                                <i class="bi bi-dash-circle-fill"></i>
                            @else
                                <i class="bi bi-x-circle-fill"></i>
                            @endif
                            {{ $row->cluster_label }}
                        </span>
                    </td>
                    <td class="date-cell">
                        <i class="bi bi-clock"></i>
                        {{ \Carbon\Carbon::parse($row->last_calculated_at)->format('Y-m-d H:i') }}
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7">
                        <div class="empty-state">
                            <i class="bi bi-inbox"></i>
                            <p>Belum ada data analisis</p>
                        </div>
                    </td>
                </tr>
            @endforelse

            </tbody>
        </table>
    </div>

</div>
@endsection

