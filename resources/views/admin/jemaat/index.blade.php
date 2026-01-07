@extends('layouts.admin')

@section('content')

<div class="page-container">

    <div class="page-header">
        <h2 class="page-title">
            <i class="bi bi-people-fill"></i>
            Kelola Data Jemaat
        </h2>

        <a href="/admin/jemaat/create" class="btn-primary">
            <i class="bi bi-plus-lg"></i>
            Tambah Jemaat
        </a>
    </div>

    <div class="card">
        <table class="data-table">
            <thead>
                <tr>
                    <th>Nama</th>
                    <th><i class="bi bi-envelope"></i> Email</th>
                    <th><i class="bi bi-phone"></i> No HP</th>
                    <th>Alamat</th>
                    <th style="width:150px; text-align:center;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($jemaat as $j)
                <tr>
                    <td>
                        <div style="display:flex; align-items:center; gap:10px;">
                            <div style="width:36px; height:36px; border-radius:50%; background:linear-gradient(135deg, #f08db3, #e56aa0); display:flex; align-items:center; justify-content:center; color:#fff; font-weight:600; font-size:14px;">
                                {{ strtoupper(substr($j->nama, 0, 1)) }}
                            </div>
                            <span style="font-weight:500;">{{ $j->nama }}</span>
                        </div>
                    </td>
                    <td>{{ $j->email }}</td>
                    <td>{{ $j->nomor_hp }}</td>
                    <td>{{ $j->alamat }}</td>
                    <td style="text-align:center;">
                        <div class="action-cell">
                            <a href="/admin/jemaat/{{ $j->id }}/edit" class="btn-edit">
                                <i class="bi bi-pencil-square"></i>
                                Edit
                            </a>

                            <form action="/admin/jemaat/{{ $j->id }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="btn-delete"
                                    onclick="return confirm('Yakin hapus data ini?')">
                                    <i class="bi bi-trash3"></i>
                                    Hapus
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5">
                        <div class="empty-state">
                            <i class="bi bi-people"></i>
                            <p>Belum ada data jemaat</p>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

<x-hint-button title="Fungsi Data Jemaat">
    Manajemen data jemaat Gereja Bethania. Anda dapat menambah, mencari, dan memperbarui informasi jemaat.
</x-hint-button>

@endsection

