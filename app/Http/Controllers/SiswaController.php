<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class SiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $siswas  = User::where('role', 'siswa')->orderBy('name', 'asc')->get();

        return view('siswas.index', [
            "namepage"      => "Daftar Siswa",
            'siswas'        => $siswas,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'            => 'required|string|max:255',
            'email'           => 'required|email|unique:users,email',
            'nisn'            => 'required|string|max:20|unique:users,nisn',
            'kelas'           => 'required|string|max:50',
            'nomor_whatsapp'  => 'required|string|max:20',
        ]);

        User::create([
            'name'            => $request->name,
            'email'           => $request->email,
            'nisn'            => $request->nisn,
            'kelas'           => $request->kelas,
            'nomor_whatsapp'  => $request->nomor_whatsapp,
        ]);

        return redirect()->back()->with('success', 'Siswa berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $siswa = User::findOrFail($id);
        $siswa->delete();
        return redirect()->back()->with('success', 'Siswa berhasil dihapus.');
    }
}
