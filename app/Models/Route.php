<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Route extends Model
{
    public function buses()
    {
        return $this->hasMany(Bus::class);
    }
}
