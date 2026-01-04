<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WartaFoto extends Model
{
    protected $table = 'warta_foto';

    protected $fillable = [
        'warta_id',
        'nama_file',
    ];

    const UPDATED_AT = null;

    public function warta()
    {
        return $this->belongsTo(Warta::class, 'warta_id', 'warta_id');
    }
}
