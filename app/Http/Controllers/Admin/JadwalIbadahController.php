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
        $jadwal = JadwalIbadah::latest()->get();
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

            return redirect()->route('admin.jadwal.index')
                ->with('success', 'Jadwal ibadah berhasil ditambahkan');
    }

    public function edit($id)
    {
        $jadwal = JadwalIbadah::findOrFail($id);
        return view('admin.jadwal-ibadah.edit', compact('jadwal'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'tanggal'       => 'required|date',
            'waktu_mulai'   => 'required',
            'jenis_ibadah'  => 'required',
            'lokasi'        => 'required',
            'pelayan'       => 'required',
        ]);

        $jadwal = JadwalIbadah::findOrFail($id);
        $jadwal->update($request->all());

        return redirect()->route('admin.jadwal.index')
            ->with('success', 'Jadwal ibadah berhasil diperbarui');
    }

    public function destroy($id)
    {
        $jadwal = JadwalIbadah::findOrFail($id);
        $jadwal->delete();

        return redirect()->route('admin.jadwal.index')
            ->with('success', 'Jadwal ibadah berhasil dihapus');
    }
}
