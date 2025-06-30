<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BusResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'nama_bus' => $this->nama_bus,
            'plat' => $this->plat,
            'latitude' => $this->latitude,
            'longitude' => $this->longitude,
            'nama_route' => $this->route->nama_rute,
            'driver_id' => $this->driver_id,
            'status' => $this->status,
        ];
    }
}
