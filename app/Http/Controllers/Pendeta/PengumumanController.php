<?php

namespace App\Http\Controllers\Pendeta;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pengumuman;

class PengumumanController extends Controller
{
    public function index()
    {
        $pengumuman = Pengumuman::latest('created_at')->paginate(10);
        return view('pendeta.pengumuman.index', compact('pengumuman'));
    }

    public function create()
    {
        return view('pendeta.pengumuman.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'judul' => 'required|string|max:255',
            'isi'   => 'required',
            'tanggal' => 'required|date',
        ]);

        $data['dibuat_oleh'] = auth()->id() ?? 1;

        Pengumuman::create($data);

        return redirect()->route('pendeta.pengumuman')->with('success', 'Pengumuman berhasil dibuat.');
    }

    public function edit($id)
    {
        $p = Pengumuman::findOrFail($id);
        return view('pendeta.pengumuman.edit', compact('p'));
    }

    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'judul' => 'required|string|max:255',
            'isi'   => 'required',
            'tanggal' => 'required|date',
        ]);

        $p = Pengumuman::findOrFail($id);
        $p->update($data);

        return redirect()->route('pendeta.pengumuman')->with('success', 'Pengumuman berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $p = Pengumuman::findOrFail($id);
        $p->delete();

        return redirect()->route('pendeta.pengumuman')->with('success', 'Pengumuman berhasil dihapus.');
    }
}