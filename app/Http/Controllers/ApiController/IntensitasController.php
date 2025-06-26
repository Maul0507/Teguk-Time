<?php

namespace App\Http\Controllers\ApiController;

use App\Http\Controllers\Controller;
use App\Models\Intensitas;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Validator;

class IntensitasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(Intensitas::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    $validator = Validator::make($request->all(), [
        'user_id' => 'required|integer',
        'gender' => 'required|in:Laki-laki,Perempuan',
        'age' => 'required|integer|min:0',
        'weight_kg' => 'required|numeric|min:0',
        'height_cm' => 'required|numeric|min:0',
        'activity_level' => 'required|in:Ringan,Sedang,Berat',
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
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $data = Intensitas::findOrFail($id);
            return response()->json($data);
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'Data tidak ditemukan'], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $intensitas = Intensitas::findOrFail($id);

            $validated = $request->validate([
                'user_id' => 'sometimes|integer',
                'gender' => 'sometimes|in:Laki-laki,Perempuan',
                'age' => 'sometimes|integer|min:0',
                'weight_kg' => 'sometimes|numeric|min:0',
                'height_cm' => 'sometimes|numeric|min:0',
                'activity_level' => 'sometimes|in:Ringan,Sedang,Berat',
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

    /**
     * Remove the specified resource from storage.
     */
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
