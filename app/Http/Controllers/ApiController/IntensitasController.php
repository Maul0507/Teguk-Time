<?php

namespace App\Http\Controllers\ApiController;

use App\Http\Controllers\Controller;
use App\Models\Intensitas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

class IntensitasController extends Controller
{
    public function index()
    {
        return response()->json(Intensitas::all());
    }

    public function show(string $id)
    {
        $data = Intensitas::find($id);
        if (!$data) {
            return response()->json(['message' => 'Data tidak ditemukan'], 404);
        }

        return response()->json($data);
    }

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
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validasi gagal',
                'errors' => $validator->errors()
            ], 422);
        }

        // Cek apakah user sudah mengisi hari ini
        $today = Carbon::today()->toDateString();
        $existing = Intensitas::where('user_id', $request->user_id)
            ->whereDate('tanggal', $today)
            ->first();

        if ($existing) {
            return response()->json([
                'message' => 'Anda sudah mengisi intensitas hari ini.',
                'data' => $existing
            ], 409); // Conflict
        }

        $data = $validator->validated();
        $data['tanggal'] = $today;

        $intensitas = Intensitas::create($data);

        return response()->json([
            'message' => 'Data intensitas berhasil ditambahkan',
            'data' => $intensitas
        ], 201);
    }

    public function destroy(string $id)
    {
        $data = Intensitas::find($id);
        if (!$data) {
            return response()->json(['message' => 'Data tidak ditemukan'], 404);
        }

        $data->delete();
        return response()->json(['message' => 'Data intensitas berhasil dihapus']);
    }

    public function getHariIni($id)
    {
        $today = Carbon::today()->toDateString();
        $data = Intensitas::where('user_id', $id)
            ->whereDate('tanggal', $today)
            ->first();

        if ($data) {
            return response()->json($data);
        }

        return response()->json(['message' => 'Belum ada input intensitas hari ini'], 404);
    }
}
