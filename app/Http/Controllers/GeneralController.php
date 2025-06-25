<?php

namespace App\Http\Controllers;

use App\Models\Bus;
use App\Models\User;
use App\Models\Route;

class GeneralController
{
    public function index()
    {
        $jumlah_bus    = Bus::count();
        $jumlah_siswa  = User::where('role', 'siswa')->count();
        $jumlah_route  = Route::count();
        $buses = Bus::get();

        return view('dashboards.index', [
            "namepage"      => "Home",
            'jumlah_bus'    => $jumlah_bus,
            'jumlah_siswa'  => $jumlah_siswa,
            'jumlah_route'  => $jumlah_route,
            'buses'         => $buses,
        ]);
    }
    
    public function live_monitoring()
    {

    }
}