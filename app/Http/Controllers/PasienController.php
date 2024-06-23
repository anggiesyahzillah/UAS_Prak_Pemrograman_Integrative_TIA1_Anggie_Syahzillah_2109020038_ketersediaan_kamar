<?php

namespace App\Http\Controllers;

use App\Models\Pasien;
use App\Models\Kamar;
use Illuminate\Http\Request;

class PasienController extends Controller
{

    public function index()
    {
        $pasiens = Pasien::all();
        return response()->json($pasiens);
    }
    public function masukKamar(Request $request)
    {
        
        $request->validate([
            'nama' => 'required|string',
            'umur' => 'required|integer',
            'kamar_id' => 'required|exists:kamars,id',
        ]);

        $kamar = Kamar::findOrFail($request->kamar_id);
        if (!$kamar->ketersediaan) {
            return response()->json(['message' => 'Kamar tidak tersedia saat ini'], 400);
        }

        $pasien = Pasien::create([
            'nama' => $request->nama,
            'umur' => $request->umur,
            'kamar_id' => $request->kamar_id,
        ]);

        $kamar->ketersediaan = false;
        $kamar->save();

        return response()->json($pasien, 201);
    }

    public function keluarKamar($id)
    {
        $pasien = Pasien::findOrFail($id);

        // Dapatkan kamar yang sedang ditempati oleh pasien
        $kamar = $pasien->kamar;

        // Hapus pasien dari kamar
        $pasien->delete();

        // Ubah status kamar menjadi tersedia
        $kamar->ketersediaan = true;
        $kamar->save();

        return response()->json(null, 204);
    }
}
