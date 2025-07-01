<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Route extends Model
{
    protected $fillable = [
        'nama_rute',
        'nama_halte1',
        'nama_halte2',
        'nama_halte3',
        'p1_latitude',
        'p1_longitude',
        'p2_latitude',
        'p2_longitude',
        'p3_latitude',
        'p3_longitude',
        'time_start',
        'time_end',
    ];
    
    public function bus()
    {
        return $this->hasMany(Bus::class);
    }
}
