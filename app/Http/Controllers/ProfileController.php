<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProfileController
{
    public function login()
    {
        return view('profiles.login', [
            "namepage" => "Login",
        ]);
    }
    
    public function masuk(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('/dashboards.index')->with('userinmessage', 'Login Anda Berhasil');
        }
 
        return back()->with('userfail', 'Akun/ Password tidak ditemukan');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/')->with('useroutmessage', 'Anda Telah Keluar');
    }
}
