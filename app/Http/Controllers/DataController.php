<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Data; // Pastikan model Data sudah di-import
use App\Events\WaterLevelUpdated; // Pastikan event sudah di-import
use Illuminate\Support\Facades\Validator;

class DataController extends Controller
{
    /**
     * Menampilkan halaman dashboard utama dengan data terakhir.
     */
    public function dashboard()
    {
        // Ambil data rekaman terakhir dari database
        $latestData = Data::latest('waktu')->first();
        $waterLevelPercent = 0; // Nilai default

        if ($latestData) {
            // Hitung jumlah sensor yang aktif dari data terakhir
            $activeSensors = 0;
            if ($latestData->sensor1) $activeSensors++;
            if ($latestData->sensor2) $activeSensors++;
            if ($latestData->sensor3) $activeSensors++;
            if ($latestData->sensor4) $activeSensors++;
            if ($latestData->sensor5) $activeSensors++;
            
            // Setiap sensor mewakili 20% dari total ketinggian
            $waterLevelPercent = $activeSensors * 20;
        }

        // Kirim data ke view 'dashboard'
        return view('dashboard', [
            'latestData' => $latestData,
            'waterLevelPercent' => $waterLevelPercent,
            // Anda bisa menambahkan data lain di sini, misal untuk rata-rata mingguan
            'weeklyAverage' => 0, // Contoh
            'weeklyMax' => 0,     // Contoh
        ]);
    }

    /**
     * Menampilkan halaman tabel data.
     */
    public function table()
    {
        // Ambil semua data, urutkan dari yang terbaru
        $allData = Data::latest('waktu')->paginate(10); // Paginate untuk data yang banyak

        return view('data', ['allData' => $allData]);
    }

    /**
     * Menerima dan menyimpan data dari ESP32.
     * Ini adalah API endpoint.
     */
    public function store(Request $request)
    {
        // Validasi data yang masuk dari ESP32
        $validator = Validator::make($request->all(), [
            'sensor1' => 'required|boolean',
            'sensor2' => 'required|boolean',
            'sensor3' => 'required|boolean',
            'sensor4' => 'required|boolean',
            'sensor5' => 'required|boolean',
            'status' => 'required|in:Bahaya,Siaga,Waspada,Aman',
            'catatan' => 'nullable|string',
        ]);

        // Jika validasi gagal, kirim response error
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        // Buat rekaman baru di database
        $data = Data::create([
            'sensor1' => $request->sensor1,
            'sensor2' => $request->sensor2,
            'sensor3' => $request->sensor3,
            'sensor4' => $request->sensor4,
            'sensor5' => $request->sensor5,
            'status' => $request->status,
            'catatan' => $request->catatan,
            'waktu' => now(), // Set waktu saat data diterima
        ]);

        // Hitung persentase untuk disiarkan melalui WebSocket
        $activeSensors = $request->sensor1 + $request->sensor2 + $request->sensor3 + $request->sensor4 + $request->sensor5;
        $waterLevelPercent = $activeSensors * 20;

        // Tambahkan properti baru ke objek data sebelum disiarkan
        $data->waterLevelPercent = $waterLevelPercent;

        // Siarkan event WaterLevelUpdated dengan data yang baru
        broadcast(new WaterLevelUpdated($data))->toOthers();

        // Kirim response sukses kembali ke ESP32
        return response()->json([
            'message' => 'Data received and stored successfully',
            'data' => $data
        ], 201);
    }
}
