<?php

namespace App\Http\Controllers\ApiController;

use App\Http\Controllers\Controller;
use App\Models\Intensitas;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Validator;

class IntensitasController extends Controller
{
    // GET semua data
    public function index()
    {
        return response()->json(Intensitas::all());
    }

    // POST data baru
    public function store(Request $request)
{
    $validator = Validator::make($request->all(), [
        'user_id' => 'required|integer',
        'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
        'umur' => 'required|integer|min:0',
        'berat_badan' => 'required|numeric|min:0',
        'tinggi_badan' => 'required|numeric|min:0',
        'aktivitas' => 'required|in:Ringan,Sedang,Berat',
        'target_air' => 'required|numeric|min:0',
        'tanggal' => 'required|date',
    ]);

    if ($validator->fails()) {
        return response()->json([
            'message' => 'Validasi gagal',
            'errors' => $validator->errors()
        ], 422);
    }

    $intensitas = Intensitas::create($validator->validated());

    return response()->json([
        'message' => 'Data intensitas berhasil ditambahkan',
        'data' => $intensitas
    ], 201);
}

    // GET detail by ID
    public function show(string $id)
    {
        try {
            $data = Intensitas::findOrFail($id);
            return response()->json($data);
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'Data tidak ditemukan'], 404);
        }
    }

    // PUT update
    public function update(Request $request, string $id)
    {
        try {
            $intensitas = Intensitas::findOrFail($id);

            $validated = $request->validate([
                'user_id' => 'sometimes|integer',
                'jenis_kelamin' => 'sometimes|in:Laki-laki,Perempuan',
                'umur' => 'sometimes|integer|min:0',
                'berat_badan' => 'sometimes|numeric|min:0',
                'tinggi_badan' => 'sometimes|numeric|min:0',
                'aktivitas' => 'sometimes|in:Ringan,Sedang,Berat',
                'target_air' => 'sometimes|numeric|min:0',
                'tanggal' => 'sometimes|date',
            ]);

            $intensitas->update($validated);

            return response()->json([
                'message' => 'Data intensitas berhasil diperbarui',
                'data' => $intensitas
            ]);
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'Data tidak ditemukan'], 404);
        }
    }

    // DELETE
    public function destroy(string $id)
    {
        try {
            $intensitas = Intensitas::findOrFail($id);
            $intensitas->delete();

            return response()->json(['message' => 'Data intensitas berhasil dihapus']);
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'Data tidak ditemukan'], 404);
        }
    }
}
