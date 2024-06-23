<?php

namespace App\Http\Controllers;

use App\Models\Kamar;
use Illuminate\Http\Request;

class KamarController extends Controller
{
    public function index()
    {
        $kamars = Kamar::all();
        return response()->json($kamars);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string',
            'nomor' => 'required|string',
            'level' => 'required|in:VIP,Reguler,Ekonomi',
        ]);

        $kamar = Kamar::create([
            'nama' => $request->nama,
            'nomor' => $request->nomor,
            'level' => $request->level,
            'ketersediaan' => true, 
        ]);

        return response()->json($kamar, 201);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'string',
            'nomor' => 'string',
            'level' => 'in:VIP,Reguler,Ekonomi',
        ]);

        $kamar = Kamar::findOrFail($id);
        $kamar->update($request->all());

        return response()->json($kamar, 200);
    }

    public function destroy($id)
    {
        $kamar = Kamar::findOrFail($id);
        $kamar->delete();

        return response()->json(null, 204);
    }
}
