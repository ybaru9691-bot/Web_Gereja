<?php

namespace App\Http\Controllers;

use App\Models\JadwalIbadah;

class JadwalController extends Controller
{
    public function index()
    {
        $jadwal = JadwalIbadah::where('status', 'aktif')
            ->orderBy('tanggal')
            ->orderBy('waktu_mulai')
            ->get();

        return view('frontend.jadwal.index', compact('jadwal'));
    }

   // DETAIL JADWAL
    public function show($id)
    {
        $jadwal = JadwalIbadah::findOrFail($id);

        return view('frontend.jadwal.show', compact('jadwal'));
    }
}