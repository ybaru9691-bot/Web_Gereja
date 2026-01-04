@extends('layouts.admin')

@section('content')

<div class="page-container">

    <div class="page-header">
        <h2 class="page-title">Kelola Data Jemaat</h2>

        <a href="/admin/jemaat/create" class="btn-primary">
            + Tambah Jemaat
        </a>
    </div>

    <div class="card">
        <table class="data-table">
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>No HP</th>
                    <th>Alamat</th>
                    <th style="width:150px; text-align:center;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($jemaat as $j)
                <tr>
                    <td>{{ $j->nama }}</td>
                    <td>{{ $j->email }}</td>
                    <td>{{ $j->nomor_hp }}</td>
                    <td>{{ $j->alamat }}</td>
                    <td style="text-align:center;">
                        <div class="action-cell">
                            <a href="/admin/jemaat/{{ $j->id }}/edit" class="btn-edit">
                                Edit
                            </a>

                            <form action="/admin/jemaat/{{ $j->id }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="btn-delete"
                                    onclick="return confirm('Yakin hapus data ini?')">
                                    Hapus
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="empty-text">
                        Belum ada data jemaat 
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

<x-hint-button title="Fungsi Data Jemaat">
    Manajemen data jemaat Gereja Bethania. Anda dapat melihat, mencari, dan memperbarui informasi personal jemaat untuk keperluan administrasi dan pelayanan.
</x-hint-button>

@endsection
