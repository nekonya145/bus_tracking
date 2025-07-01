<?php

namespace App\Http\Controllers;

use App\Models\Bus;
use Illuminate\Http\Request;
use App\Http\Resources\BusResource;
use App\Models\Route;
use App\Models\User;

class BusApiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $buses = Bus::all();

        $formattedBuses = BusResource::collection($buses);

        return response()->json([
            'status' => 'success',
            'message' => 'Data untuk Bus berhasil diambil',
            'data' => [
                'buses'             => $formattedBuses,
                'report_summary'    => [ 
                    'total_buses'   => Bus::count(),
                    'total_routes'  => Route::count(),
                    'total_siswas'  => User::where('role', 'siswa')->count(),
                ]
            ]
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Bus $bus)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Bus $bus)
    {
        // Validasi hanya untuk latitude & longitude
        $request->validate([
            'latitude'  => 'required|numeric|between:-90,90',
            'longitude' => 'required|numeric|between:-180,180',
        ]);

        // Update lokasi bus
        $bus->update([
            'latitude'  => $request->latitude,
            'longitude' => $request->longitude,
        ]);

        // Response ke aplikasi mobile
        return response()->json([
            'status'  => 'success',
            'message' => 'Lokasi bus berhasil diperbarui.',
            'data'    => [
                'id'        => $bus->id,
                'latitude'  => $bus->latitude,
                'longitude' => $bus->longitude,
                'updated_at' => $bus->updated_at,
            ]
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Bus $bus)
    {
        //
    }
}
