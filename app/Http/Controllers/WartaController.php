<?php

namespace App\Http\Controllers;

use App\Models\Warta;
use Illuminate\Http\Request;

class WartaController extends Controller
{
    /**
     * Halaman daftar warta jemaat (frontend)
     * HANYA warta yang status = published
     */
    public function index(Request $request)
    {
        $query = Warta::where('status', 'published');

        if ($request->filter == 'week') {
            $query->whereBetween('tanggal', [
                now()->startOfWeek(),
                now()->endOfWeek()
            ]);
        } elseif ($request->filter == 'month') {
            $query->whereMonth('tanggal', now()->month)
                  ->whereYear('tanggal', now()->year);
        }

        $wartas = $query->orderBy('tanggal', 'desc')->get();

        return view('frontend.warta.index', compact('wartas'));
    }

    /**
     * Halaman detail warta jemaat
     * HANYA boleh buka warta published
     */
    public function show($id)
    {
        $warta = Warta::where('status', 'published')
            ->findOrFail($id);

        return view('frontend.warta.show', compact('warta'));
    }
}





