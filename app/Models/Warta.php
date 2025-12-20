<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Warta extends Model
{
    use HasFactory;

    protected $table = 'warta_jemaat';
    protected $primaryKey = 'warta_id';

    protected $fillable = [
        'judul',
        'tanggal',
        'isi_warta',
        'file_path',
        'qr_code',
        'dibuat_oleh'
    ];
}
