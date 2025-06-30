<?php

namespace Database\Seeders;

use App\Models\Bus;
use Illuminate\Database\Seeder;

class BusSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $buses = [
            [
                'nama_bus'      => 'SRT A2',
                'plat'          => 'DD 55 XYZ',
                'latitude'      => '-5.132969',
                'longitude'     => '119.515476',
                'status'        => 'TERSEDIA',
                'driver_id'     => '2',
                'route_id'      => '1',
                'created_at'    => '2020-03-07 20:05:21',
            ],
            [
                'nama_bus'      => 'SRT B3',
                'plat'          => 'DD 45 ZX',
                'latitude'      => '-5.131969',
                'longitude'     => '119.514976',
                'status'        => 'FULL',
                'driver_id'     => '3',
                'route_id'      => '2',
                'created_at'    => '2020-03-07 20:05:21',
            ],
            [
                'nama_bus'      => 'SRT C4',
                'plat'          => 'DD 1024 AC',
                'latitude'      => '-5.131569',
                'longitude'     => '119.514876',
                'status'        => 'MAINTENANCE',
                'driver_id'     => null,
                'route_id'      => '1',
                'created_at'    => '2020-03-07 20:05:21',
            ],
        ];

        foreach ($buses as $bus){
            Bus::insert($bus);
        }

    }
}