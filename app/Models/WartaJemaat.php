<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WartaJemaat extends Model
{
    use HasFactory;

    protected $table = 'warta_jemaat'; // PENTING

    protected $primaryKey = 'warta_id'; // PENTING

    protected $fillable = [
        'judul',
        'tanggal',
        'isi_warta',
        'file_path',
        'qr_code',
        'dibuat_oleh',
    ];

    protected $casts = [
        'tanggal' => 'date',
    ];
}
