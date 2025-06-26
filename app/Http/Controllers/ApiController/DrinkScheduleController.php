<?php

namespace App\Http\Controllers\ApiController;

use App\Http\Controllers\Controller;
use App\Models\DrinkSchedule;
use Illuminate\Http\Request;

class DrinkScheduleController extends Controller
{
    public function index()
    {
        return response()->json(DrinkSchedule::all());
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|integer',
            'schedule_time' => 'required|date_format:H:i',
            'volume_ml' => 'required|integer|min:1',
        ]);

        $schedule = DrinkSchedule::create($validated);

        return response()->json([
            'message' => 'Jadwal minum berhasil dibuat',
            'data' => $schedule
        ], 201);
    }

    public function show($id)
    {
        $data = DrinkSchedule::find($id);
        if (!$data) {
            return response()->json(['message' => 'Data tidak ditemukan'], 404);
        }
        return response()->json($data);
    }

    public function update(Request $request, $id)
    {
        $data = DrinkSchedule::find($id);
        if (!$data) {
            return response()->json(['message' => 'Data tidak ditemukan'], 404);
        }

        $validated = $request->validate([
            'user_id' => 'sometimes|integer',
            'schedule_time' => 'sometimes|date_format:H:i',
            'volume_ml' => 'sometimes|integer|min:1',
        ]);

        $data->update($validated);

        return response()->json([
            'message' => 'Jadwal berhasil diperbarui',
            'data' => $data
        ]);
    }

    public function destroy($id)
    {
        $data = DrinkSchedule::find($id);
        if (!$data) {
            return response()->json(['message' => 'Data tidak ditemukan'], 404);
        }

        $data->delete();
        return response()->json(['message' => 'Jadwal berhasil dihapus']);
    }
}
