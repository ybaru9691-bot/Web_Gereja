<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JadwalIbadah extends Model
{
    protected $table = 'jadwal_ibadah';
    protected $primaryKey = 'id_jadwal';
    public $incrementing = true;

    protected $fillable = [
        'tanggal',
        'waktu_mulai',
        'waktu_selesai',
        'jenis_ibadah',
        'lokasi',
        'pelayan',
        'keterangan',
        'status'
    ];
}
