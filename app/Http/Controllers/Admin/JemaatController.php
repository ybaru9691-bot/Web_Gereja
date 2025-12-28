<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Jemaat;

class JemaatController extends Controller
{
    // ======================
    // TAMPILKAN DATA
    // ======================
    public function index()
    {
        $jemaat = Jemaat::all();
        return view('admin.jemaat.index', compact('jemaat'));
    }

    // ======================
    // FORM TAMBAH DATA
    // ======================
    public function create()
    {
        return view('admin.jemaat.create');
    }

    // ======================
    // SIMPAN DATA
    // ======================
    public function store(Request $request)
    {
        $request->validate([
            'nama'      => 'required',
            'email'     => 'required|email',
            'nomor_hp'  => 'required',
            'alamat'    => 'required'
        ]);

        Jemaat::create([
            'nama'      => $request->nama,
            'email'     => $request->email,
            'nomor_hp'  => $request->nomor_hp,
            'alamat'    => $request->alamat,
        ]);

        return redirect('/admin/jemaat')
            ->with('success', 'Data jemaat berhasil ditambahkan');
    }

    // ======================
    // FORM EDIT
    // ======================
    public function edit($id)
    {
        $jemaat = Jemaat::findOrFail($id);
        return view('admin.jemaat.edit', compact('jemaat'));
    }

    // ======================
    // UPDATE DATA
    // ======================
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama'      => 'required',
            'email'     => 'required|email',
            'nomor_hp'  => 'required',
            'alamat'    => 'required'
        ]);

        $jemaat = Jemaat::findOrFail($id);

        $jemaat->update([
            'nama'      => $request->nama,
            'email'     => $request->email,
            'nomor_hp'  => $request->nomor_hp,
            'alamat'    => $request->alamat,
        ]);

        return redirect('/admin/jemaat')
            ->with('success', 'Data jemaat berhasil diperbarui');
    }

    // ======================
    // HAPUS DATA
    // ======================
    public function destroy($id)
    {
        $jemaat = Jemaat::findOrFail($id);
        $jemaat->delete();

        return redirect('/admin/jemaat')
            ->with('success', 'Data jemaat berhasil dihapus');
    }
}
