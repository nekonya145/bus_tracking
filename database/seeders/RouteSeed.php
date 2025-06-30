<?php

namespace Database\Seeders;

use App\Models\Route;
use Illuminate\Database\Seeder;

class RouteSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $routes = [
            [
                'nama_rute'         => 'Rute ACZ 175',
                'sekolah_latitude'  => '-5.136723',
                'sekolah_longitude' => '119.514976',
                'p1_latitude'       => '-5.131969',
                'p1_longitude'      => '119.498285',
                'p2_latitude'       => '-5.112568',
                'p2_longitude'      => '119.511728',
                'p3_latitude'       => '-5.141339',
                'p3_longitude'      => '119.521769',
                'time_start'        => '06:00',
                'time_end'          => '07:30',
                'created_at'        => '2020-03-07 20:05:21',
            ],
            [
                'nama_rute'         => 'Rute PXT 86',
                'sekolah_latitude'  => '-5.136723',
                'sekolah_longitude' => '119.514976',
                'p1_latitude'       => '-5.131969',
                'p1_longitude'      => '119.498285',
                'p2_latitude'       => '-5.112568',
                'p2_longitude'      => '119.511728',
                'p3_latitude'       => '-5.141339',
                'p3_longitude'      => '119.521769',
                'time_start'        => '06:30',
                'time_end'          => '08:00',
                'created_at'        => '2020-03-08 20:05:21',
            ],
        ];

        foreach ($routes as $route){
            Route::insert($route);
        }

    }
}