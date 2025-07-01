<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Route extends Model
{
    protected $fillable = [
        'nama_rute',
        'time_start',
        'time_end',
    ];
    
    public function bus()
    {
        return $this->hasMany(Bus::class);
    }
}
