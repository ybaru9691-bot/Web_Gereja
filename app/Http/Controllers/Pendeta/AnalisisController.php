<?php

namespace App\Http\Controllers\Pendeta;

use App\Http\Controllers\Controller;
use App\Models\Jemaat;
use App\Models\Warta;
use App\Models\Pengumuman;
use Illuminate\Http\Request;

class AnalisisController extends Controller
{
    public function index()
    {
        $jemaatCount = Jemaat::count();
        $wartaCount = Warta::count();
        $pengumumanCount = Pengumuman::count();

        // Placeholder for clustering data
        $clusters = [
            'Cluster A' => 45,
            'Cluster B' => 30,
            'Cluster C' => 25,
        ];

        return view('pendeta.analisis.index', compact(
            'jemaatCount', 
            'wartaCount', 
            'pengumumanCount',
            'clusters'
        ));
    }
}
