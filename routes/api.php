<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\DosenController;
use App\Http\Controllers\PengajuanKPController;
use App\Http\Controllers\BimbinganKPController;


Route::get('/hello', function () {
    return response()->json(['message' => 'Hello, API!']);
});


Route::apiResource('mahasiswa', MahasiswaController::class);
Route::apiResource('dosen', DosenController::class);
Route::apiResource('pengajuan-kp', PengajuanKPController::class);
Route::apiResource('bimbingan', BimbinganKPController::class);