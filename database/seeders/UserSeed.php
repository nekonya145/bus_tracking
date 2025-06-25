<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
                'name'           => 'Admin Afdhal',
                'email'          => 'admin@example.com',
                'password'       => bcrypt('123'),
                'role'           => 'admin',
                'nomor_whatsapp' => '+6289506425222',
                'created_at'     => '2020-03-07 20:05:21',
            ],
            [
                'name'           => 'Driver Faiz',
                'email'          => 'driversatu@example.com',
                'password'       => bcrypt('123'),
                'role'           => 'driver',
                'nomor_whatsapp' => '+6289506425212',
                'created_at'     => '2020-03-07 20:05:21',
            ],
            [
                'name'           => 'Driver Afdhol',
                'email'          => 'driverdua@example.com',
                'password'       => bcrypt('123'),
                'role'           => 'driver',
                'nomor_whatsapp' => '+6289506425202',
                'created_at'     => '2020-03-07 20:05:21',
            ],
            [
                'name'           => 'Siswa Fajar',
                'email'          => 'siswasatu@example.com',
                'password'       => bcrypt('123'),
                'nomor_whatsapp' => '+6289506425252',
                'nisn'           => '0056864667',
                'kelas'          => 'X IPA 1',
                'created_at'     => '2020-03-07 20:05:21',
            ],
            [
                'name'           => 'Siswa Rifai',
                'email'          => 'siswadua@example.com',
                'password'       => bcrypt('123'),
                'nomor_whatsapp' => '+6289506425870',
                'nisn'           => '0056864669',
                'kelas'          => 'X IPA 1',
                'created_at'     => '2020-03-07 20:05:21',
            ],
        ];

        foreach ($users as $user){
            User::insert($user);
        }

    }
}