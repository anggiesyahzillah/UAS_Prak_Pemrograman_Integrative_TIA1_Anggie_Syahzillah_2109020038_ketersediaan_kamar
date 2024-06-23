<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KamarController;
use App\Http\Controllers\PasienController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::apiResource('kamars', KamarController::class);

Route::get('/pasiens', [PasienController::class, 'index']);
Route::post('/pasien/masuk-kamar', [PasienController::class, 'masukKamar']);
Route::delete('/pasien/keluar-kamar/{id}', [PasienController::class, 'keluarKamar']);