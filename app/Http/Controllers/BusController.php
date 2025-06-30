<?php

namespace App\Http\Controllers;
use App\Models\Bus;
use App\Models\User;
use App\Models\Route;
use Illuminate\Http\Request;

class BusController
{
    public function manajemen_bus()
    {
        $buses = Bus::latest()->get();
        $routes = Route::all();
        $drivers = User::where('role', 'driver')->get();

        return view('dashboards.manajemen-bus', [
            "namepage"      => "Manajemen Bus",
            'buses'         => $buses,
            'drivers'       => $drivers,
            'routes'        => $routes,
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

    public function tambah_bus(Request $request)
    {

    }

    public function update(Request $request)
    {
        $id = $request->id;
        $bus = Bus::findOrFail($id);

        $request->validate([
            'nama_bus' => 'required|string|max:255',
            'plat'     => 'required|string|max:100',
            'status'    => 'required|in:TERSEDIA,FULL,MAINTENANCE',
            'driver_id' => 'nullable|exists:users,id',
            'route_id'  => 'nullable|exists:routes,id',
        ]);

        $bus->update([
            'nama_bus'  => $request->input('nama_bus'),
            'plat'      => $request->input('plat'),
            'status'    => $request->input('status'),
            'driver_id' => $request->input('driver_id'),
            'route_id'  => $request->input('route_id'),
        ]);

        return redirect()->back()->with('success', 'Data bus berhasil diperbarui.');
    }

    public function hapus(Request $request)
    {
        $id = $request->id;
        $bus = Bus::findOrFail($id);
        $bus->delete();

        return redirect()->back()->with('success', 'Data bus berhasil dihapus.');
    }
}
