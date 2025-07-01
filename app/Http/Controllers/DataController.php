<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Data;
use App\Events\NewDataReceived;

class DataController extends Controller
{
    //
    // Menampilkan tampilan dashboard dengan data terbaru
    public function dashboard()
    {
        // Ambil data terakhir
        $latestData = Data::latest('id')->first();

        // Hitung persentase air dari sensor aktif (max 5 sensor)
        $waterLevelPercent = 0;
        if ($latestData) {
            $activeSensors = $latestData->sensor1 + $latestData->sensor2 + $latestData->sensor3 + $latestData->sensor4 + $latestData->sensor5;
            $waterLevelPercent = ($activeSensors / 5) * 100;
        }

        // Ambil data 7 hari terakhir
        $weeklyData = Data::where('created_at', '>=', now()->subDays(7))->get();

        // Hitung persentase air dari tiap data
        $weeklyPercentages = $weeklyData->map(function ($data) {
            $active = $data->sensor1 + $data->sensor2 + $data->sensor3 + $data->sensor4 + $data->sensor5;
            return ($active / 5) * 100;
        });

        // Hitung rata-rata dan nilai maksimum
        $weeklyAverage = $weeklyPercentages->average() ?? 0;
        $weeklyMax = $weeklyPercentages->max() ?? 0;

        // Kirim data ke view
        return view('dashboard', compact('latestData', 'waterLevelPercent', 'weeklyAverage', 'weeklyMax'));
    }



    // Menampilkan seluruh riwayat data pada tabel
    public function table()
    {
        $allData = Data::orderBy('id', 'desc')->get();

        return view('data', compact('allData'));
    }

    // Menyimpan data sensor
    public function store(Request $request)
    {
        $validated = $request->validate([
            'sensor1' => 'required|boolean',
            'sensor2' => 'required|boolean',
            'sensor3' => 'required|boolean',
            'sensor4' => 'required|boolean',
            'sensor5' => 'required|boolean',
        ]);

        $activeCount = $validated['sensor1'] + $validated['sensor2'] + $validated['sensor3'] + $validated['sensor4'] + $validated['sensor5'];

        // Penentuan status
        if ($activeCount == 1) {
            $status = 'Bahaya';
        } elseif ($activeCount == 2 || $activeCount == 3) {
            $status = 'Waspada';
        } elseif ($activeCount == 4) {
            $status = 'Siaga';
        } elseif ($activeCount == 5) {
            $status = 'Aman';
        } else {
            $status = 'Tidak Terdeteksi';
        }

        $data = Data::create([
            'sensor1' => $validated['sensor1'],
            'sensor2' => $validated['sensor2'],
            'sensor3' => $validated['sensor3'],
            'sensor4' => $validated['sensor4'],
            'sensor5' => $validated['sensor5'],
            'status'  => $status,
            'waktu'   => now(),
            'catatan' => null
        ]);

        broadcast(new NewDataReceived($data))->toOthers();

        return redirect()->route('dashboard')->with('success', 'Data berhasil disimpan.');
    }
}
