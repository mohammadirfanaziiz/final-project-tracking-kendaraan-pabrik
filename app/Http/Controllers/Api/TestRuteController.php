<?php

// app/Http/Controllers/Api/TestRuteController.php

namespace App\Http\Controllers\Api;

use App\Models\Rute; // Memanggil model Rute
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TestRuteController extends Controller
{
    // API untuk mengambil rute berdasarkan ID
    public function getRute($id)
    {
        $rute = Rute::find($id);

        // Jika rute tidak ditemukan
        if (!$rute) {
            return response()->json(['message' => 'Rute tidak ditemukan'], 404);
        }

        // Mengambil data tujuan dan koordinatnya
        $tujuan = [
            'lat' => $rute->latitude,
            'lng' => $rute->longitude,
            'nama' => $rute->tujuan,
        ];

        // Mengembalikan data tujuan dalam format JSON
        return response()->json($tujuan);
    }

    // API untuk mengambil rute default pertama
    public function getDefaultRute()
    {
        $rute = Rute::first(); // Mengambil rute pertama sebagai default

        // Jika tidak ada rute, berikan nilai default
        if (!$rute) {
            return response()->json([
                'lat' => -6.32361458852203, 
                'lng' => 107.30131140241414,
                'nama' => 'UBP Karawang'
            ]);
        }

        $tujuan = [
            'lat' => $rute->latitude,
            'lng' => $rute->longitude,
            'nama' => $rute->tujuan,
        ];

        return response()->json($tujuan);
    }
}

