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

        return view('dashboards.index', [
            "namepage"      => "Home",
            'jumlah_bus'    => $jumlah_bus,
            'jumlah_siswa'  => $jumlah_siswa,
            'jumlah_route'  => $jumlah_route,
        ]);
    }
    
    public function live_monitoring()
    {
        return view('dashboards.live-monitoring', [
            "namepage"      => "Live Monitoring",
        ]);
    }
}