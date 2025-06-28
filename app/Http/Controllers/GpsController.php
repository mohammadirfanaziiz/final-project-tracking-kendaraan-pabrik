<?php

namespace App\Http\Controllers;

use App\Models\Gps;
use App\Models\Pengiriman;  // Pastikan model Pengiriman diimport
use Illuminate\Http\Request;

class GpsController extends Controller
{
    // Menampilkan daftar GPS
    public function index()
    {
        $gpsData = Gps::all();  // Mendapatkan semua data GPS
        return view('gps.index', compact('gpsData'));
    }

    // Menampilkan form untuk menambahkan GPS baru
    public function create()
    {
        // Ambil data pengiriman yang aktif atau yang sudah ada
        $pengirimans = Pengiriman::all();  // Sesuaikan dengan kondisi aktif jika perlu

        return view('gps.create', compact('pengirimans'));
    }

    // Menyimpan data GPS baru
    public function store(Request $request)
    {
        // Validasi input dari form
        $request->validate([
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'pengiriman_id' => 'required|exists:pengiriman,id',  // Validasi pengiriman_id
        ]);

        // Menyimpan data GPS baru tanpa mengisi 'timestamp' secara manual
        Gps::create([
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'pengiriman_id' => $request->pengiriman_id,
            // 'timestamp' dihilangkan karena otomatis akan diisi oleh database
        ]);

        return redirect()->route('gps.index')->with('success', 'Data GPS berhasil ditambahkan!');
    }

    // Menampilkan form untuk mengedit data GPS
    public function edit($id)
    {
        $gps = Gps::findOrFail($id);
        $pengirimans = Pengiriman::all();  // Ambil data pengiriman untuk dropdown

        return view('gps.edit', compact('gps', 'pengirimans'));
    }

    // Mengupdate data GPS
    public function update(Request $request, $id)
    {
        // Validasi input dari form
        $request->validate([
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'pengiriman_id' => 'required|exists:pengiriman,id',  // Validasi pengiriman_id
        ]);

        $gps = Gps::findOrFail($id);
        
        // Mengupdate data GPS tanpa mengisi 'timestamp' secara manual
        $gps->update([
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'pengiriman_id' => $request->pengiriman_id,
            // 'timestamp' dihilangkan karena otomatis akan diisi oleh database
        ]);

        return redirect()->route('gps.index')->with('success', 'Data GPS berhasil diperbarui!');
    }

    // Menghapus data GPS
    public function destroy($id)
    {
        $gps = Gps::findOrFail($id);
        $gps->delete();

        return redirect()->route('gps.index')->with('success', 'Data GPS berhasil dihapus!');
    }
}
