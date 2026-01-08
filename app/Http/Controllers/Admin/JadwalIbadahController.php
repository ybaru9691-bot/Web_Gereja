<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Models\JadwalIbadah;

// ✅ ENDROID QR CODE V6
use Endroid\QrCode\Builder\Builder;
use Endroid\QrCode\Writer\PngWriter;

class JadwalIbadahController extends Controller
{
    /**
     * Tampilkan daftar jadwal ibadah
     */
    public function index()
    {
        $jadwal = JadwalIbadah::orderBy('tanggal')->get();
        return view('admin.jadwal-ibadah.index', compact('jadwal'));
    }

    /**
     * Form tambah jadwal ibadah
     */
    public function create()
    {
        return view('admin.jadwal-ibadah.create');
    }

    /**
     * Simpan jadwal ibadah + generate QR
     */
    public function store(Request $request)
    {
        $request->validate([
            'tanggal'       => 'required|date',
            'waktu_mulai'   => 'required',
            'jenis_ibadah'  => 'required|string|max:100',
            'lokasi'        => 'required|string|max:100',
            'pelayan'       => 'required|string|max:100',
            'keterangan'    => 'nullable|string'
        ]);

        // 🔹 Tambah UUID unik
        $data = $request->all();
        $data['uuid_jadwal'] = (string) Str::uuid();
        $data['status'] = 'aktif'; // default

        // 🔹 Buat jadwal
        $jadwal = JadwalIbadah::create($data);

        // 🔹 Generate QR Jadwal (Endroid v6)
        $url = route('scan.jadwal', ['uuid_jadwal' => $jadwal->uuid_jadwal]);
        $qrName = 'qr-jadwal-' . $jadwal->id_jadwal . '.png';

        $result = new Builder(
            writer: new PngWriter(),
            data: $url,
            size: 300,
            margin: 10
        );

        // 🔹 Simpan file QR ke storage/app/public/qr
        Storage::disk('public')->put('qr/' . $qrName, $result->build()->getString());

        // 🔹 Simpan path QR ke database
        $jadwal->update([
            'qr_code' => 'qr/' . $qrName
        ]);

        return redirect()->route('admin.jadwal.index')
            ->with('success', 'Jadwal ibadah berhasil ditambahkan & QR dibuat');
    }

    /**
     * Form edit jadwal ibadah
     */
    public function edit($id)
    {
        $jadwal = JadwalIbadah::findOrFail($id);
        return view('admin.jadwal-ibadah.edit', compact('jadwal'));
    }

    /**
     * Update jadwal ibadah + regenerate QR
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'tanggal'       => 'required|date',
            'waktu_mulai'   => 'required',
            'jenis_ibadah'  => 'required|string|max:100',
            'lokasi'        => 'required|string|max:100',
            'pelayan'       => 'required|string|max:100',
            'keterangan'    => 'nullable|string'
        ]);

        $jadwal = JadwalIbadah::findOrFail($id);
        $jadwal->update($request->all());

        // 🔹 Regenerate QR jika UUID ada
        if ($jadwal->uuid_jadwal) {
            $url = route('scan.jadwal', ['uuid_jadwal' => $jadwal->uuid_jadwal]);
            $qrName = 'qr-jadwal-' . $jadwal->id_jadwal . '.png';

            $result = new Builder(
                writer: new PngWriter(),
                data: $url,
                size: 300,
                margin: 10
            );

            Storage::disk('public')->put('qr/' . $qrName, $result->build()->getString());
            $jadwal->update(['qr_code' => 'qr/' . $qrName]);
        }

        return redirect()->route('admin.jadwal.index')
            ->with('success', 'Jadwal ibadah berhasil diperbarui & QR diperbarui');
    }

    /**
     * Hapus jadwal ibadah
     */
    public function destroy($id)
    {
        $jadwal = JadwalIbadah::findOrFail($id);

        // 🔹 Hapus QR lama jika ada
        if ($jadwal->qr_code) {
            Storage::disk('public')->delete($jadwal->qr_code);
        }

        $jadwal->delete();

        return redirect()->route('admin.jadwal.index')
            ->with('success', 'Jadwal ibadah berhasil dihapus');
    }
}
