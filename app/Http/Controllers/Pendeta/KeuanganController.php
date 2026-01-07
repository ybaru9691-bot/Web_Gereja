<?php

namespace App\Http\Controllers\Pendeta;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class KeuanganController extends Controller
{
    /**
     * Menampilkan daftar laporan keuangan untuk pendeta (read-only)
     */
    public function index()
    {
        // Ambil semua data keuangan dengan join ke jadwal ibadah
        $keuangan = DB::table('keuangan_ibadah')
            ->join('jadwal_ibadah', 'keuangan_ibadah.jadwal_id', '=', 'jadwal_ibadah.id_jadwal')
            ->select(
                'keuangan_ibadah.*',
                'jadwal_ibadah.tanggal',
                'jadwal_ibadah.jenis_ibadah'
            )
            ->orderBy('tanggal', 'desc')
            ->get();

        // Hitung total pemasukan dan pengeluaran
        $totalPemasukan = $keuangan->where('jenis_transaksi', 'pemasukan')->sum('nominal');
        $totalPengeluaran = $keuangan->where('jenis_transaksi', 'pengeluaran')->sum('nominal');
        $saldo = $totalPemasukan - $totalPengeluaran;

        return view('pendeta.keuangan.index', compact(
            'keuangan',
            'totalPemasukan',
            'totalPengeluaran',
            'saldo'
        ));
    }
}
