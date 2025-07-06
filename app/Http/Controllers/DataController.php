<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Data;
use App\Events\WaterLevelUpdated;
use Illuminate\Support\Facades\Validator;

class DataController extends Controller
{
    /**
     * Menampilkan halaman dashboard dengan data dari kedua reservoir.
     */
    public function dashboard()
    {
        // --- AMBIL DATA UNTUK SUMUR 1 ---
        $latestData1 = Data::where('catatan', 'Sumur Reservoir 1')->latest('waktu')->first();
        $waterLevelPercent1 = 0;
        if ($latestData1) {
            $activeSensors1 = $latestData1->sensor1 + $latestData1->sensor2 + $latestData1->sensor3 + $latestData1->sensor4 + $latestData1->sensor5;
            $waterLevelPercent1 = $activeSensors1 * 20;
        }

        // --- AMBIL DATA UNTUK SUMUR 2 ---
        $latestData2 = Data::where('catatan', 'Sumur Reservoir 2')->latest('waktu')->first();
        $waterLevelPercent2 = 0;
        if ($latestData2) {
            $activeSensors2 = $latestData2->sensor1 + $latestData2->sensor2 + $latestData2->sensor3 + $latestData2->sensor4 + $latestData2->sensor5;
            $waterLevelPercent2 = $activeSensors2 * 20;
        }

        // Kirim data dari kedua sumur ke view
        return view('dashboard', [
            'latestData1' => $latestData1,
            'waterLevelPercent1' => $waterLevelPercent1,
            'latestData2' => $latestData2,
            'waterLevelPercent2' => $waterLevelPercent2,
        ]);
    }

    /**
     * Menampilkan halaman tabel data dengan fungsionalitas filter.
     */
    public function table(Request $request)
    {
        // Ambil nilai filter dari URL. Jika tidak ada, defaultnya null.
        $filter = $request->input('filter');

        // Mulai membangun query ke database
        $query = Data::query();

        // Jika ada filter yang diterapkan, tambahkan kondisi 'where'
        if ($filter) {
            $query->where('catatan', $filter);
        }

        // Eksekusi query, urutkan dari yang terbaru, dan aktifkan paginasi.
        // withQueryString() penting agar filter tetap aktif saat berpindah halaman.
        $allData = $query->latest('waktu')->paginate(15)->withQueryString();

        // Kirim data yang sudah difilter dan nilai filter saat ini ke view
        return view('data', [
            'allData' => $allData,
            'currentFilter' => $filter
        ]);
    }

    /**
     * Menerima dan menyimpan data dari ESP32.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'sensor1' => 'required|boolean',
            'sensor2' => 'required|boolean',
            'sensor3' => 'required|boolean',
            'sensor4' => 'required|boolean',
            'sensor5' => 'required|boolean',
            'status' => 'required|in:Bahaya,Siaga,Waspada,Aman',
            'catatan' => 'required|string|in:Sumur Reservoir 1,Sumur Reservoir 2',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $data = Data::create($validator->validated() + ['waktu' => now()]);

        $activeSensors = $data->sensor1 + $data->sensor2 + $data->sensor3 + $data->sensor4 + $data->sensor5;
        $data->waterLevelPercent = $activeSensors * 20;

        broadcast(new WaterLevelUpdated($data))->toOthers();

        return response()->json([
            'message' => 'Data received successfully',
            'data' => $data
        ], 201);
    }
}
