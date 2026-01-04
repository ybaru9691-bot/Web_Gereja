<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Warta;
use App\Models\WartaFoto;

// ✅ ENDROID QR CODE (VERSI BENAR)
use Endroid\QrCode\Builder\Builder;
use Endroid\QrCode\Writer\PngWriter;


class WartaController extends Controller
{
    /**
     * Tampilkan daftar warta (admin)
     */
    public function index()
    {
        $wartas = Warta::orderBy('tanggal', 'desc')->get();
        return view('admin.warta.index', compact('wartas'));
    }

    /**
     * Form tambah warta
     */
    public function create()
    {
        return view('admin.warta.create');
    }

    /**
     * Simpan warta (draft / published)
     */
    public function store(Request $request)
    {
        $request->validate([
            'judul'     => 'required|string|max:255',
            'tanggal'   => 'required|date',
            'isi_warta' => 'required',
            'status'    => 'required|in:draft,published',
            'foto.*'      => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // 🔹 SIMPAN DATA WARTA
        $warta = Warta::create([
            'judul'       => $request->judul,
            'tanggal'     => $request->tanggal,
            'isi_warta'   => $request->isi_warta,
            'status'      => $request->status,
            'dibuat_oleh' => auth()->id() ?? 1,
        ]);

        // 🔹 SIMPAN FOTO-FOTO (MULTI)
        if ($request->hasFile('foto')) {
            foreach ($request->file('foto') as $index => $file) {
                $path = $file->store('warta', 'public');
                
                // Simpan ke tabel warta_foto
                WartaFoto::create([
                    'warta_id' => $warta->warta_id,
                    'nama_file' => $path
                ]);

                // Sinkronkan ke kolom legacy file_path untuk foto pertama (biar thumbnail lama aman)
                if ($index === 0) {
                    $warta->update(['file_path' => $path]);
                }
            }
        }
        
       // 🔥 URL DETAIL WARTA
$url = route('warta.show', ['id' => $warta->warta_id]);

// 🔥 NAMA FILE QR
$qrName = 'qr-warta-' . $warta->warta_id . '.png';

// 🔥 GENERATE QR (ENDROID FIX 100%)
$result = new Builder(
    writer: new PngWriter(),
    data: $url,
    size: 300,
    margin: 10
);

// 🔥 SIMPAN KE storage/app/public/qr
Storage::disk('public')->put(
    'qr/' . $qrName,
    $result->build()->getString()
);

// 🔥 SIMPAN PATH QR KE DB
$warta->update([
    'qr_code' => 'qr/' . $qrName
]);

        return redirect('/admin/warta')
            ->with('success', 'Warta berhasil disimpan');
    }

    /**
     * Form edit warta
     */
    public function edit($id)
    {
        $warta = Warta::with('fotos')->findOrFail($id);
        return view('admin.warta.edit', compact('warta'));
    }

    /**
     * Update warta
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'judul'     => 'required|string|max:255',
            'tanggal'   => 'required|date',
            'isi_warta' => 'required',
            'status'    => 'required|in:draft,published',
            'foto.*'    => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'hapus_foto.*' => 'nullable|integer'
        ]);

        $warta = Warta::findOrFail($id);

        // 🔹 HAPUS FOTO YANG DIPILIH
        if ($request->has('hapus_foto')) {
            foreach ($request->hapus_foto as $fotoId) {
                $foto = WartaFoto::where('warta_id', $warta->warta_id)->find($fotoId);
                if ($foto) {
                    Storage::disk('public')->delete($foto->nama_file);
                    $foto->delete();
                }
            }
        }

        // 🔹 TAMBAH FOTO BARU
        if ($request->hasFile('foto')) {
            foreach ($request->file('foto') as $file) {
                $path = $file->store('warta', 'public');
                WartaFoto::create([
                    'warta_id' => $warta->warta_id,
                    'nama_file' => $path
                ]);
            }
        }

        $warta->update([
            'judul'     => $request->judul,
            'tanggal'   => $request->tanggal,
            'isi_warta' => $request->isi_warta,
            'status'    => $request->status,
        ]);

        // Update legacy file_path agar sinkron dengan foto pertama yang tersisa
        $firstFoto = $warta->fotos()->first();
        $warta->update(['file_path' => $firstFoto ? $firstFoto->nama_file : null]);

        return redirect('/admin/warta')
            ->with('success', 'Warta berhasil diperbarui');
    }

    /**
     * Hapus warta
     */
    public function destroy($id)
    {
        $warta = Warta::findOrFail($id);
        $warta->delete();

        return redirect('/admin/warta')
            ->with('success', 'Warta berhasil dihapus');
    }
}