@extends('layouts.admin')

@section('content')

<div class="page-container">

    <div class="page-header">
        <h2 class="page-title">Kelola Warta Gereja</h2>

        <a href="{{ url('/admin/warta/create') }}" class="btn-primary">
            + Tambah Warta
        </a>
    </div>

    <div class="card">
        <table class="data-table">
            <thead>
                <tr>
                    <th>Judul</th>
                    <th>Tanggal</th>
                    <th>Status</th>
                    <th>QR</th>

                    <th style="width:120px">Aksi</th>
                </tr>
            </thead>

            <tbody>
                @forelse($wartas as $w)
                    <tr>
                        <td>{{ $w->judul }}</td>
                        <td>{{ \Carbon\Carbon::parse($w->tanggal)->format('d M Y') }}</td>
                        <td>
                            @if($w->status === 'published')
                                <span class="badge-published">Published</span>
                            @else
                                <span class="badge-draft">Draft</span>
                            @endif

                             @if($w->qr_code)
        <img 
            src="{{ asset('storage/qr/' . $w->qr_code) }}"
            width="80"
            alt="QR Warta"
        >
    @else
        <small>Belum ada</small>
    @endif
                        </td>


                      <td class="action-cell">
    <a href="{{ url('/admin/warta/'.$w->warta_id.'/edit') }}"
       class="btn-edit">
        Edit
    </a>

    <form action="{{ url('/admin/warta/'.$w->warta_id) }}"
          method="POST"
          style="display:inline">
        @csrf
        @method('DELETE')

        <button type="submit"
                class="btn-delete"
                onclick="return confirm('Yakin ingin menghapus warta ini?')">
            Hapus
        </button>
    </form>
</td>                  
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="empty-text">
                            Belum ada warta 
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>

@endsection