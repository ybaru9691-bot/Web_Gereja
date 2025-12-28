<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Warta extends Model
{
    protected $table = 'warta';
    protected $primaryKey = 'warta_id';

    protected $fillable = [
        'judul',
        'tanggal',
        'isi_warta',
        'file_path',
        'qr_code',
        'status',
        'dibuat_oleh'
    ];
}
