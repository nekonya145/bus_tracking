<?php

namespace App\Http\Controllers;
use App\Models\Bus;
use App\Models\Route;
use Illuminate\Http\Request;

class BusController
{
    public function manajemen_bus()
    {
        $buses = Bus::latest()->get();

        return view('dashboards.manajemen-bus', [
            "namepage"      => "Manajemen Bus",
            'buses'         => $buses,
        ]);
    }
    
    public function manajemen_rute()
    {
        $routes = Route::get();

        return view('dashboards.manajemen-rute', [
            "namepage"      => "Manajemen Rute",
            'routes'         => $routes,
        ]);
    }

    public function tambah_rute(Request $request)
    {

    }
}
