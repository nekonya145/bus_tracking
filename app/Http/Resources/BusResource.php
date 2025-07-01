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
            'nama_route' => $this->route->nama_rute ?? '-',
            'nama_driver' => optional($this->driver)->name,
            'status' => $this->status,
            'time_start' => $this->route->time_start ?? '-',
            'time_end' => $this->route->time_end ?? '-',
            'nama_halte1' => $this->route->nama_halte1 ?? '-',
            'nama_halte2' => $this->route->nama_halte2 ?? '-',
            'nama_halte3' => $this->route->nama_halte3 ?? '-',
            'sekolah_latitude' => $this->route->sekolah_latitude ?? '-',
            'sekolah_longitude' => $this->route->sekolah_longitude ?? '-',
            'route1_latitude' => $this->route->p1_latitude ?? '-',
            'route1_longitude' => $this->route->p1_longitude ?? '-',
            'route2_latitude' => $this->route->p2_latitude ?? '-',
            'route2_longitude' => $this->route->p2_longitude ?? '-',
            'route3_latitude' => $this->route->p3_latitude ?? '-',
            'route3_longitude' => $this->route->p3_longitude ?? '-',
        ];
    }
}
