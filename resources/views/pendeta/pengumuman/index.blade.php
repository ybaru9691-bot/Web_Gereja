@extends('layouts.pendeta')

@extends('layouts.pendeta')

@section('content')
<style>
/* Styling ringan untuk mendekati Figma tanpa mengubah global */
.pengumuman-header { background: #f0f0f0; padding: 18px; border-radius: 10px; }
.badge-status { padding: .35rem .6rem; border-radius: 999px; font-size: .85rem; }
.card-round { border-radius: 12px; }
.card-ann { background:#fff; border-radius:12px; padding:18px; box-shadow:0 6px 18px rgba(0,0,0,.06); }
.small-muted { color:#6c757d; font-size:.9rem; }
.action-pill { border-radius:20px; padding:.35rem .8rem; font-size:.85rem; }
.table-summary tbody tr td { vertical-align: middle; }
</style>

<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-start mb-4">
        <div>
            <h2 class="fw-bold">Pengumuman</h2>
            <p class="text-muted mb-1">Kelola pengumuman gereja serta pantau ringkasan keuangan.</p>
            <small class="small-muted">Pendeta dapat membuat, mengedit, dan menghapus pengumuman. Semua pengumuman aktif akan terlihat di sisi jemaat. Terakhir diperbarui 05 Nov 2025, 20:45</small>
        </div>
        <div>
            <a href="#" class="btn btn-primary">Buat Pengumuman</a>
        </div>
    </div>

    <!-- Status filter -->
    <div class="mb-4">
        <div class="btn-group" role="group">
            <button class="btn btn-outline-secondary active">Aktif</button>
            <button class="btn btn-outline-secondary">Terjadwal</button>
            <button class="btn btn-outline-secondary">Arsip</button>
        </div>
    </div>

    <div class="row g-4">
        <!-- Left column: main announcements -->
        <div class="col-lg-7">
            <!-- Highlight -->
            <div class="card-ann mb-3">
                <div class="d-flex justify-content-between">
                    <div>
                        <span class="badge bg-warning text-dark mb-2">Pengumuman dari Pendeta</span>
                        <h5 class="mb-1">Ibadah syukur ulang tahun gereja ke-35</h5>
                        <div class="small-muted">Diposting oleh Pdt. Johanes • Tayang ke jemaat : 10 Nov 2025, 20:45</div>
                        <p class="mt-3 mb-0">Ibadah syukur ulang tahun gereja ke-35 akan dilaksanakan pada hari Minggu 16 November 2025, pukul 09.00 WIB. Jemaat diundang untuk hadir dan bersyukur atas pimpinan Tuhan selama ini.</p>
                        <div class="small-muted mt-2">Akan tampil di beranda jemaat mulai 10 Nov 2025</div>
                    </div>
                    <div class="d-flex flex-column gap-2 align-items-end">
                        <a href="#" class="btn btn-sm btn-outline-warning action-pill">Edit</a>
                        <a href="#" class="btn btn-sm btn-outline-danger action-pill">Hapus</a>
                    </div>
                </div>
            </div>

            <!-- Another announcement -->
            <div class="card-ann mb-3">
                <div class="d-flex justify-content-between">
                    <div>
                        <h6 class="fw-bold mb-1">Perubahan ibadah jadwal tengah minggu</h6>
                        <div class="small-muted">Diposting oleh Pdt. Johanes • 4 Nov 2025</div>
                        <p class="mt-2 mb-0">Mulai minggu depan ibadah tengah minggu akan diadakan setiap hari Kamis pukul 19.00 secara onsite di gereja dan akan disebarkan secara online melalui aplikasi jemaat.</p>
                    </div>
                    <div class="d-flex flex-column gap-2 align-items-end">
                        <a href="#" class="btn btn-sm btn-outline-warning action-pill">Edit</a>
                        <a href="#" class="btn btn-sm btn-outline-danger action-pill">Hapus</a>
                    </div>
                </div>
            </div>

            <!-- List/summaries -->
            <div class="card card-round shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">Daftar pengumuman</h5>
                    <p class="text-muted small">Ringkasan seluruh pengumuman yang pernah dibuat pendeta</p>

                    <div class="table-responsive">
                        <table class="table table-borderless table-sm mt-3">
                            <thead class="small text-muted">
                                <tr>
                                    <th>Judul</th>
                                    <th>Status</th>
                                    <th>Tanggal</th>
                                    <th>Dilihat jemaat</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="align-middle">
                                    <td>Ibadah syukur</td>
                                    <td><span class="badge bg-success">Aktif</span></td>
                                    <td>10 Nov 2025</td>
                                    <td>235 jemaat</td>
                                    <td>
                                        <a href="#" class="btn btn-sm btn-outline-secondary">Edit</a>
                                        <a href="#" class="btn btn-sm btn-outline-danger">Hapus</a>
                                    </td>
                                </tr>
                                <tr class="align-middle">
                                    <td>Perubahan jadwal</td>
                                    <td><span class="badge bg-success">Aktif</span></td>
                                    <td>4 Nov 2025</td>
                                    <td>120 jemaat</td>
                                    <td>
                                        <a href="#" class="btn btn-sm btn-outline-secondary">Edit</a>
                                        <a href="#" class="btn btn-sm btn-outline-danger">Hapus</a>
                                    </td>
                                </tr>
                                <tr class="align-middle">
                                    <td>Donasi pembangunan</td>
                                    <td><span class="badge bg-warning text-dark">Terjadwal</span></td>
                                    <td>15 Nov 2025</td>
                                    <td>—</td>
                                    <td>
                                        <a href="#" class="btn btn-sm btn-outline-secondary">Edit</a>
                                        <a href="#" class="btn btn-sm btn-outline-danger">Hapus</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="5" class="text-center text-muted small">Menampilkan 3 dari 12 entri</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination (statik) -->
                    <div class="d-flex justify-content-between align-items-center mt-3">
                        <div>
                            <button class="btn btn-sm btn-outline-primary">Sebelumnya</button>
                        </div>
                        <div>
                            <nav><ul class="pagination pagination-sm mb-0">
                                <li class="page-item"><a class="page-link" href="#">1</a></li>
                                <li class="page-item"><a class="page-link" href="#">2</a></li>
                                <li class="page-item"><a class="page-link" href="#">3</a></li>
                            </ul></nav>
                        </div>
                        <div>
                            <button class="btn btn-sm btn-primary">Berikutnya</button>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <!-- Right column: summary -->
        <div class="col-lg-5">
            <div class="card mb-3 card-round shadow-sm">
                <div class="card-body">
                    <h6 class="card-title">Ringkasan</h6>
                    <div class="mb-2">Total Pengumuman: <strong>12</strong></div>
                    <div class="mb-2">Aktif: <strong>7</strong></div>
                    <div class="mb-2">Terjadwal: <strong>3</strong></div>
                </div>
            </div>

            <div class="card card-round shadow-sm">
                <div class="card-body">
                    <h6 class="card-title">Aktivitas Terbaru</h6>
                    <ul class="list-unstyled small mt-2">
                        <li class="mb-2"><strong>10 Nov:</strong> Ibadah syukur dipublikasikan</li>
                        <li class="mb-2"><strong>04 Nov:</strong> Perubahan jadwal dipublikasikan</li>
                        <li class="mb-2"><strong>01 Nov:</strong> Donasi dipublikasikan</li>
                    </ul>
                    <a href="#" class="btn btn-sm btn-outline-primary">Lihat semua aktivitas</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection