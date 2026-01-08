<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JadwalIbadah extends Model
{
    protected $table = 'jadwal_ibadah';
    protected $primaryKey = 'id_jadwal'; // wajib!
    public $incrementing = true; // auto_increment
    protected $keyType = 'int'; // integer primary key

    protected $fillable = [
        'tanggal',
        'waktu_mulai',
        'waktu_selesai',
        'jenis_ibadah',
        'lokasi',
        'pelayan',
        'keterangan',
        'status',
        'qr_code',
        'uuid_jadwal'
    ];
}
