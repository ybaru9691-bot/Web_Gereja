<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ScanLog;

class ScanLogController extends Controller
{
    public function index()
    {
        $logs = ScanLog::with(['jadwal', 'warta'])
            ->orderBy('waktu_scan', 'desc')
            ->paginate(10);

        return view('admin.scan.index', compact('logs'));
    }
}



