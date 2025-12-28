<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Warta extends Model
{
    // WAJIB: nama tabel sesuai database
    protected $table = 'warta_jemaat';

    // WAJIB: primary key bukan "id"
    protected $primaryKey = 'warta_id';

    // Kalau primary key auto increment
    public $incrementing = true;

    // Tipe primary key
    protected $keyType = 'int';

    // Mass assignment
    protected $fillable = [
        'judul',
        'tanggal',
        'isi_warta',
        'file_path',
        'qr_code',
        'status',
        'dibuat_oleh',
    ];
}
