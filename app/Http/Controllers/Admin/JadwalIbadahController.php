<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\JadwalIbadah;
use App\Http\Controllers\Admin\JadwalIbadahController; 

class JadwalIbadahController extends Controller
{
    public function index()
    {
        $jadwal = JadwalIbadah::orderBy('tanggal')->get();
        return view('admin.jadwal-ibadah.index', compact('jadwal'));
    }

    public function create()
    {
        return view('admin.jadwal-ibadah.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'tanggal'       => 'required|date',
            'waktu_mulai'   => 'required',
            'jenis_ibadah'  => 'required',
            'lokasi'        => 'required',
            'pelayan'       => 'required',
        ]);

        JadwalIbadah::create($request->all());

       
            return redirect('/admin/jadwal-ibadah')
    ->with('success', 'Jadwal ibadah berhasil ditambahkan');

    }
}
