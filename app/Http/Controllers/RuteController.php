<?php

namespace App\Http\Controllers;

use App\Models\Route;
use Illuminate\Http\Request;

class RuteController extends Controller
{
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
