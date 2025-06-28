<?php

namespace App\Http\Controllers\Api;

use Carbon\Carbon;
use App\Models\Rute;
use App\Models\User;
use App\Models\Kendaraan;
use App\Models\Pengiriman;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PengirimanController extends Controller
{
    // API untuk mengambil semua data pengiriman
    public function apiIndex()
    {
        $pengiriman = Pengiriman::with(['kendaraan', 'driver', 'rute'])->get();
        return response()->json($pengiriman);
    }

    // API untuk mengambil detail pengiriman berdasarkan ID
    public function apiShow($id)
    {
        $pengiriman = Pengiriman::with(['kendaraan', 'driver', 'rute'])->find($id);

        if ($pengiriman) {
            return response()->json($pengiriman);
        }

        return response()->json(['message' => 'Pengiriman tidak ditemukan'], 404);
    }

    // API untuk menyimpan data pengiriman
    public function apiStore(Request $request)
    {
        // Validasi input
        $request->validate([
            'kendaraan_id' => 'required',
            'driver_id' => 'required',
            'rute_id' => 'required',
            'status' => 'required|in:' . implode(',', [Pengiriman::STATUS_OTW, Pengiriman::STATUS_SELESAI]), // Validasi status
            'deskripsi_barang' => 'nullable|string',
            'estimasi_kedatangan' => 'nullable|date',
        ]);

        // Simpan pengiriman baru
        $pengiriman = Pengiriman::create($request->all());

        return response()->json($pengiriman, 201);
    }

    // API untuk memperbarui pengiriman
    public function apiUpdate(Request $request, $id)
    {
        $pengiriman = Pengiriman::find($id);

        if (!$pengiriman) {
            return response()->json(['message' => 'Pengiriman tidak ditemukan'], 404);
        }

        // Validasi input
        $request->validate([
            'kendaraan_id' => 'required',
            'driver_id' => 'required',
            'rute_id' => 'required',
            'status' => 'required|in:' . implode(',', [Pengiriman::STATUS_OTW, Pengiriman::STATUS_SELESAI]), // Validasi status
            'deskripsi_barang' => 'nullable|string',
            'estimasi_kedatangan' => 'nullable|date',
        ]);

        // Perbarui pengiriman
        $pengiriman->update($request->all());

        return response()->json($pengiriman);
    }

    // API untuk menghapus pengiriman
    public function apiDestroy($id)
    {
        $pengiriman = Pengiriman::find($id);

        if (!$pengiriman) {
            return response()->json(['message' => 'Pengiriman tidak ditemukan'], 404);
        }

        $pengiriman->delete();

        return response()->json(['message' => 'Pengiriman berhasil dihapus']);
    }

    // API untuk mengambil semua kendaraan (untuk dropdown)
    public function getKendaraan()
    {
        $kendaraans = Kendaraan::all(); // Ambil semua data kendaraan
        return response()->json($kendaraans);  // Kirimkan data kendaraan dalam format JSON
    }

    // API untuk mengambil semua driver (untuk dropdown)
    public function getDriver()
    {
        $drivers = User::where('role', 'driver')->get(); // Ambil data driver berdasarkan role 'driver'
        return response()->json($drivers);  // Kirimkan data driver dalam format JSON
    }

    // API untuk mengambil semua rute (untuk dropdown)
    public function getRute()
    {
        $rutes = Rute::all(); // Ambil semua data rute
        return response()->json($rutes);  // Kirimkan data rute dalam format JSON
    }

    // API untuk menyelesaikan pengiriman
    public function apiSelesai($id)
    {
        $pengiriman = Pengiriman::find($id);

        if (!$pengiriman) {
            return response()->json(['message' => 'Pengiriman tidak ditemukan'], 404);
        }

        // Ubah status pengiriman menjadi 'Selesai'
        $pengiriman->status = Pengiriman::STATUS_SELESAI;

        // Isi waktu kedatangan aktual dengan waktu saat ini
        $pengiriman->kedatangan_sebenarnya = Carbon::now('Asia/Jakarta');  // Waktu sekarang dengan timezone WIB

        // Simpan perubahan
        $pengiriman->save();

        // Kembalikan data pengiriman yang sudah diperbarui
        return response()->json([
            'message' => 'Pengiriman selesai!',
            'data' => $pengiriman
        ]);
    }
}
