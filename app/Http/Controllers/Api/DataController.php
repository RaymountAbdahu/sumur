<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Data;
use App\Events\WaterLevelUpdated;
use Illuminate\Support\Facades\Validator;

class DataController extends Controller
{
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'sensor1' => 'required|boolean',
            'sensor2' => 'required|boolean',
            'sensor3' => 'required|boolean',
            'sensor4' => 'required|boolean',
            'sensor5' => 'required|boolean',
            'status' => 'required|in:Bahaya,Siaga,Waspada,Aman',
            'catatan' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $validatedData = $validator->validated();
        $validatedData['waktu'] = now();

        $data = Data::create($validatedData);

        // --- TAMBAHKAN LOGIKA INI ---
        // Hitung sensor yang aktif
        $activeSensors = 0;
        if ($data->sensor1)
            $activeSensors++;
        if ($data->sensor2)
            $activeSensors++;
        if ($data->sensor3)
            $activeSensors++;
        if ($data->sensor4)
            $activeSensors++;
        if ($data->sensor5)
            $activeSensors++;

        // Hitung persentase (setiap sensor mewakili 20%)
        $waterLevelPercent = $activeSensors * 20;

        // Tambahkan persentase ke objek data sebelum disiarkan
        $data->waterLevelPercent = $waterLevelPercent;
        // --- AKHIR LOGIKA TAMBAHAN ---

        // Siarkan event dengan data yang sudah dilengkapi persentase
        broadcast(new WaterLevelUpdated($data))->toOthers();

        return response()->json([
            'message' => 'Data received successfully',
            'data' => $data
        ], 201);
    }
}