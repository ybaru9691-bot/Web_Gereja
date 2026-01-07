@extends('layouts.admin')

@section('content')
<div class="container">

    <h1 class="mb-3">Analisis Jemaat</h1>

    {{-- notifikasi sukses --}}
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    {{-- tombol hitung --}}
    <form action="{{ route('admin.analisis.hitung') }}" method="POST" class="mb-4">
        @csrf
        <button type="submit" class="btn btn-primary">
            Hitung Analisis Jemaat
        </button>
    </form>

    {{-- tabel hasil --}}
    <table class="table table-bordered">
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
    <td>{{ $row->guest_uuid }}</td>
    <td>{{ $row->score_f }}</td>
    <td>{{ $row->score_r }}</td>
    <td>{{ $row->score_d }}</td>
    <td>
        <span class="badge 
            @if($row->cluster_label == 'Disiplin') bg-success
            @elseif($row->cluster_label == 'Cukup Disiplin') bg-warning
            @else bg-danger
            @endif
        ">
            {{ $row->cluster_label }}
        </span>
    </td>
    <td> {{ \Carbon\Carbon::parse($row->last_calculated_at)->format('Y-m-d H:i') }}</td>
</tr>
@empty
<tr>
    <td colspan="7" class="text-center">Belum ada data</td>
</tr>
@endforelse

        </tbody>
    </table>

</div>
@endsection
