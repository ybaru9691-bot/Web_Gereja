<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ScanLog extends Model
{
    protected $table = 'scan_log';

    public $timestamps = false; // 🔴 INI KUNCI UTAMA

    protected $fillable = [
        'guest_uuid',
        'jadwal_id',
        'warta_id',
        'waktu_scan',
        'status_kehadiran'
    ];

    public function jadwal()
    {
        return $this->belongsTo(
            JadwalIbadah::class,
            'jadwal_id',
            'id_jadwal'
        );
    }

    public function warta()
    {
        return $this->belongsTo(
            Warta::class,
            'warta_jemaat',
            'warta_id'
        );
    }
}

