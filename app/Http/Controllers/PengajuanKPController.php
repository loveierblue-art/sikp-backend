<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PengajuanKP; 

class PengajuanKPController extends Controller
{
    public function index()
    {
        //tampilin semua pengajuan, biasanya nanti mahasiswa hanya lihat miliknya sendiri
        $data = PengajuanKP::all();
        return response()->json($data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'npm' => 'required',
            'semester' => 'required',
            'tujuan_instansi' => 'required',
        ]);

        $pengajuan = PengajuanKP::create([
            'npm' => $request->npm,
            'semester' => $request->semester,
            'tujuan_instansi' => $request->tujuan_instansi,
            'status' => 'Pending',
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Pengajuan KP Berhasil Terkirim!',
            'data' => $pengajuan
        ], 201);
    }
}