<?php

namespace App\Http\Controllers;

use App\Models\Route;
use Illuminate\Http\Request;

class RuteController extends Controller
{
    public function tambah_rute(Request $request)
    {
        $request->validate([
            'nama_rute'          => 'required|string|max:255',
            'nama_halte1'        => 'nullable|string|max:255',
            'nama_halte2'        => 'nullable|string|max:255',
            'nama_halte3'        => 'nullable|string|max:255',
            'p1_latitude'        => 'nullable|numeric',
            'p1_longitude'       => 'nullable|numeric',
            'p2_latitude'        => 'nullable|numeric',
            'p2_longitude'       => 'nullable|numeric',
            'p3_latitude'        => 'nullable|numeric',
            'p3_longitude'       => 'nullable|numeric',
            'time_start'         => 'required|date_format:H:i',
            'time_end'           => 'required|date_format:H:i',
        ]);

        Route::create([
            'nama_rute'          => $request->input('nama_rute'),
            'nama_halte1'        => $request->input('nama_halte1'),
            'nama_halte2'        => $request->input('nama_halte2'),
            'nama_halte3'        => $request->input('nama_halte3'),
            'p1_latitude'        => $request->input('p1_latitude'),
            'p1_longitude'       => $request->input('p1_longitude'),
            'p2_latitude'        => $request->input('p2_latitude'),
            'p2_longitude'       => $request->input('p2_longitude'),
            'p3_latitude'        => $request->input('p3_latitude'),
            'p3_longitude'       => $request->input('p3_longitude'),
            'time_start'         => $request->input('time_start'),
            'time_end'           => $request->input('time_end'),
        ]);
        return redirect()->back()->with('success', 'Data bus berhasil Ditambahkan.');
    }
    
    public function update(Request $request)
    {
        $id = $request->id;
        $route = Route::findOrFail($id);

        $request->validate([
            'nama_rute'         => 'required|string|max:255',
            'jam_keberangkatan' => 'required|date_format:H:i',
            'jam_kepulangan'    => 'required|date_format:H:i',
        ]);

        $route->update([
            'nama_rute'     => $request->input('nama_rute'),
            'time_start'    => $request->input('jam_keberangkatan'),
            'time_end'      => $request->input('jam_kepulangan'),
        ]);

        return redirect()->back()->with('success', 'Data bus berhasil diperbarui.');
    }

    public function hapus(Request $request)
    {
        $id = $request->id;
        $route = Route::findOrFail($id);

        try {
            $route->delete();
            return redirect()->back()->with('success', 'Rute berhasil dihapus.');
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->back()->with('error', 'Rute tidak dapat dihapus karena masih digunakan oleh bus.');
        }
    }
}
