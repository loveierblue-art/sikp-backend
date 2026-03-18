<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function register(Request $request) {
        $request->validate([
            'id_user' => 'required',
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            // Logika sederhana: kalau input 10-11 digit berarti NPM, selain itu NIDN
            'npm' => (strlen($request->id_user) >= 10) ? $request->id_user : null,
            'nidn' => (strlen($request->id_user) < 10) ? $request->id_user : null,
        ]);

        return response()->json(['success' => true, 'message' => 'Registrasi Berhasil!']);
    }

public function forgotPassword(Request $request) {
    // Versi sederhana: Langsung timpa password tanpa kirim email
    $user = User::where('npm', $request->id_user)->orWhere('nidn', $request->id_user)->first();
    
    if (!$user) return response()->json(['success' => false, 'message' => 'User tidak ditemukan']);

    $user->password = Hash::make($request->new_password);
    $user->save();

    return response()->json(['success' => true, 'message' => 'Password berhasil direset!']);
}
    public function login(Request $request)
    {
        $request->validate([
            'id_user' => 'required',
            'password' => 'required',
        ]);

        $id = $request->id_user;

        $user = User::where('npm', $id)
                    ->orWhere('nidn', $id)
                    ->first();

        //cek User & Password
        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json([
                'success' => false,
                'message' => 'NPM/NIDN atau Password salah!'
            ], 401);
        }

        //deteksi role berdasarkan kolom mana yang terisi
        $role = ($user->nidn != null) ? 'dosen' : 'mahasiswa';

        return response()->json([
            'success' => true,
            'message' => 'Selamat datang, ' . $user->name,
            'role' => $role,
            'user' => [
                'id' => $user->id,
                'name' => $user->name,
                'npm' => $user->npm,
                'nidn' => $user->nidn,
                'email' => $user->email,
            ],
            'token' => 'SiKP-secret-token-' . $user->id //dummy token sementara
        ], 200);
    }
}