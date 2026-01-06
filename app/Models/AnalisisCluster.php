<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AnalisisCluster extends Model
{
    protected $table = 'analisis_cluster';

    protected $fillable = [
        'guest_uuid',
        'periode',
        'score_f',
        'score_r',
        'score_d',
        'cluster_label',
        'last_calculated_at',
    ];
}
