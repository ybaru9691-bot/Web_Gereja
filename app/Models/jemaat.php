<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Jemaat extends Model
{
    protected $table = 'data_jemaat';

    protected $fillable = [
        'nama',
        'email',
        'nomor_hp',
        'alamat'
    ];
}
