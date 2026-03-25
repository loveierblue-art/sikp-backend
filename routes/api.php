<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\DosenController;
use App\Http\Controllers\PengajuanKPController;
use App\Http\Controllers\BimbinganKPController;
use App\Http\Controllers\AuthController;


Route::get('/hello', function () {
    return response()->json(['message' => 'Hello, API!']);
});

Route::post('/register', [AuthController::class, 'register']);
Route::post('/forgot-password', [AuthController::class, 'forgotPassword']);
Route::apiResource('mahasiswa', MahasiswaController::class);
Route::apiResource('dosen', DosenController::class);
Route::apiResource('pengajuan-kp', PengajuanKPController::class);
Route::apiResource('bimbingan', BimbinganKPController::class);
Route::post('/login', [AuthController::class, 'login']);