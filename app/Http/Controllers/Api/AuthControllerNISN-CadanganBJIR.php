<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $user = User::where('nisn', $request->nisn)->firstOrFail();
        
        $request->validate([
            'nisn' => 'required',
            'password' => 'required',
        ]);

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json([
                'message' => 'NISN atau Password salah.'
            ], 401);
        }

        $user->tokens()->delete(); 
        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'message'   => 'Login berhasil',
            'user'      => $user,
            'token'     => $token,
            'token_type'=> 'Bearer',
        ]);
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'message' => 'Logout berhasil'
        ]);
    }
}
