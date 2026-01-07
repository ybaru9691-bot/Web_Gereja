<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KeuanganController extends Controller
{
    // ================== INDEX ==================
    public function index()
    {
        $keuangan = DB::table('keuangan_ibadah')
            ->join('jadwal_ibadah', 'keuangan_ibadah.jadwal_id', '=', 'jadwal_ibadah.id_jadwal')
            ->select(
                'keuangan_ibadah.*',
                'jadwal_ibadah.tanggal',
                'jadwal_ibadah.jenis_ibadah'
            )
            ->orderBy('tanggal', 'desc')
            ->get();

        return view('admin.keuangan.index', compact('keuangan'));
    }

    // ================== CREATE ==================
    public function create()
    {
        $jadwal = DB::table('jadwal_ibadah')
            ->where('status', 'aktif')
            ->get();

        return view('admin.keuangan.create', compact('jadwal'));
    }

    // ================== STORE ==================
    public function store(Request $request)
    {
       $request->validate([
    'jadwal_id'        => 'required',
    'jenis_transaksi' => 'required|in:pemasukan,pengeluaran',
    'kategori'         => 'required',
    'nominal'          => 'required|numeric'
]);


       DB::table('keuangan_ibadah')->insert([
    'jadwal_id'        => $request->jadwal_id,
    'jenis_transaksi' => $request->jenis_transaksi,
    'kategori'         => $request->kategori,
    'nominal'          => $request->nominal,
    'created_at'       => now()
]);


        return redirect()->route('admin.keuangan.index')
            ->with('success', 'Data keuangan berhasil disimpan');
    }
}
