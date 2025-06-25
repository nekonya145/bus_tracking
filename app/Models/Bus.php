<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bus extends Model
{
    // Otomatis eager load driver dan route
    protected $with = ['drivers', 'routes'];

    public function drivers()
    {
        return $this->belongsTo(User::class, 'driver_id');
    }

    public function routes()
    {
        return $this->belongsTo(Route::class);
    }
}
