<?php

namespace App\Http\Controllers;

use App\Models\Warta;   // ⬅️ WAJIB
use Illuminate\Http\Request;

class WartaController extends Controller
{
    public function index()
    {
        $wartas = Warta::latest()->get();
        return view('frontend.warta.index', compact('wartas'));
    }

    public function show($id)
    {
        $warta = Warta::findOrFail($id);
        return view('frontend.warta.show', compact('warta'));
    }
    
}
