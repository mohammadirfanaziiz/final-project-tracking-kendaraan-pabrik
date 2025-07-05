<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pengiriman;

class PengirimanDriverController extends Controller
{
    public function index($id) //$request->user() pake sanctum
{
    $pengiriman = Pengiriman::with([
    'kendaraan:id,id,jenis,nomor_polisi',
    'rute:id,id,asal,tujuan'
    ])
    ->select('id', 'status', 'estimasi_kedatangan', 'deskripsi_barang', 'kedatangan_sebenarnya', 'kendaraan_id', 'rute_id', 'driver_id')
    ->where('driver_id', $id)
    ->orderByDesc('created_at')
    ->get();


    if ($pengiriman->isEmpty()) {
        return response()->json([
            'message' => 'Tidak ada pengiriman ditemukan untuk driver ini.',
        ], 404);
    }

    return response()->json([
        'driver_id' => $id,
        'pengiriman' => $pengiriman,
    ]);
}

}
