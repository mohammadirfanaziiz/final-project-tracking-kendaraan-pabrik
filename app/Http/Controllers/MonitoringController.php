<?php

namespace App\Http\Controllers;

use App\Models\Pengiriman;
use Illuminate\Http\Request;

class MonitoringController extends Controller
{
    public function index() 
    {
        // Mengambil data pengiriman aktif beserta data GPS terkait
        $pengirimanAktif = Pengiriman::with(['driver', 'kendaraan', 'rute']) // Ambil semua data GPS terkait
            ->where(function($query) {
                $query->where('status', 'OTW')
                    ->orWhere('status', 'SELESAI');
                })
                    // Hanya yang statusnya OTW (On The Way)
            ->get();

        //  dd($pengirimanAktif); 

        return view('admin.monitoring', compact('pengirimanAktif'));
    }
}
