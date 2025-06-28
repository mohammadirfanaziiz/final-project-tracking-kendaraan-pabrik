<?php

namespace App\Http\Controllers;

use App\Models\Rute;
use App\Models\Pengiriman;
use Illuminate\Http\Request;

class TestRuteController extends Controller
{  
    public function index($id, Request $request)
    {
        // Ambil data rute berdasarkan ID yang dikirimkan
        $rute = Rute::find($id);

        // Periksa apakah rute ditemukan
        if ($rute) {
            $tujuan = [
                'lat' => $request->lat,  // Mengambil latitude dari URL
                'lng' => $request->lng, // Mengambil longitude dari URL
                'nama' => $request->nama,   // Mengambil nama tujuan dari URL
            ];

            // Ambil pengiriman terkait berdasarkan rute_id
            $pengiriman = Pengiriman::where('rute_id', $rute->id)->first();  // Menyaring berdasarkan rute_id (jika ada pengiriman yang terkait)
        } else {
            // Jika rute tidak ditemukan, set tujuan default
            $tujuan = [
                'lat' => -6.32361458852203, 
                'lng' => 107.30131140241414,
                'nama' => 'UBP Karawang',
            ];

            $pengiriman = null; // Jika tidak ada rute yang ditemukan, tidak ada pengiriman terkait
        }

        // Kirimkan data lat, lng, nama tujuan, dan pengiriman ke view
        return view('admin.test-rute', compact('tujuan', 'pengiriman'));
    }
}

