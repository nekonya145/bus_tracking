<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bus extends Model
{
    protected $fillable = [
        'nama_bus',
        'plat',
        'latitude',
        'longitude',
        'status',
        'driver_id',
        'route_id',
    ];
    
    protected $with = ['driver', 'route'];

    public function driver()
    {
        return $this->belongsTo(User::class, 'driver_id');
    }

    public function route()
    {
        return $this->belongsTo(Route::class);
    }
}
