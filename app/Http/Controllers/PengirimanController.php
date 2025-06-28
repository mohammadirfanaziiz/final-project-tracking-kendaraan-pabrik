<?php

namespace App\Http\Controllers;

use App\Models\Pengiriman;
use App\Models\Kendaraan;
use App\Models\User;
use App\Models\Rute;
use Illuminate\Http\Request;
use Carbon\Carbon;

class PengirimanController extends Controller
{
    public function index()
    {
        $pengiriman = Pengiriman::with(['kendaraan', 'driver', 'rute'])->get();
        return view('pengiriman.index', compact('pengiriman'));
    }

    public function create()
    {
        $kendaraans = Kendaraan::all();
        $drivers = User::where('role', 'driver')->get();
        $rutes = Rute::all();
        return view('pengiriman.create', compact('kendaraans', 'drivers', 'rutes'));
    }

    public function store(Request $request)
    {
        // Validasi request
        $request->validate([
            'kendaraan_id' => 'required',
            'driver_id' => 'required',
            'rute_id' => 'required',
            'status' => 'required|in:' . implode(',', [Pengiriman::STATUS_OTW, Pengiriman::STATUS_SELESAI]), // Validate using enum values
            'deskripsi_barang' => 'nullable|string',
            'estimasi_kedatangan' => 'nullable|date',
        ]);

        // Menyimpan pengiriman baru
        $pengiriman = Pengiriman::create($request->all());

        // Ambil data rute yang dipilih untuk mendapatkan koordinat tujuan
        $rute = Rute::findOrFail($request->rute_id);

        // Redirect ke halaman peta dengan data lat, lng, dan nama tujuan
        return redirect()->route('test-rute.index', [
            'id' => $rute->id,
            'lat' => $rute->latitude, // Ambil latitude dari rute
            'lng' => $rute->longitude, // Ambil longitude dari rute
            'nama' => $rute->tujuan,   // Ambil nama tujuan dari rute
        ]);
    }

    public function edit($id)
    {
        $pengiriman = Pengiriman::findOrFail($id);
        $kendaraans = Kendaraan::all();
        $drivers = User::where('role', 'driver')->get();
        $rutes = Rute::all();
        return view('pengiriman.edit', compact('pengiriman', 'kendaraans', 'drivers', 'rutes'));
    }

    public function update(Request $request, $id)
    {
        $pengiriman = Pengiriman::findOrFail($id);

        // Validasi request
        $request->validate([
            'kendaraan_id' => 'required',
            'driver_id' => 'required',
            'rute_id' => 'required',
            'status' => 'required|in:' . implode(',', [Pengiriman::STATUS_OTW, Pengiriman::STATUS_SELESAI]), // Validate using enum values
            'deskripsi_barang' => 'nullable|string',
            'estimasi_kedatangan' => 'nullable|date',
        ]);

        // Update pengiriman
        $pengiriman->update($request->all());

        return redirect()->route('pengiriman.index')->with('success', 'Pengiriman berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $pengiriman = Pengiriman::findOrFail($id);
        $pengiriman->delete();

        return redirect()->route('pengiriman.index')->with('success', 'Pengiriman berhasil dihapus.');
    }

    // Method untuk memperbarui status pengiriman menjadi 'Selesai'
    public function selesai($id)
    {
        $pengiriman = Pengiriman::findOrFail($id);

        // Ubah status menjadi Selesai
        $pengiriman->status = Pengiriman::STATUS_SELESAI;

        // Isi waktu kedatangan aktual dengan waktu saat ini
        $pengiriman->kedatangan_sebenarnya = Carbon::now('Asia/Jakarta');  // Waktu sekarang dengan timezone WIB

        // Simpan perubahan
        $pengiriman->save();

        // Redirect kembali ke halaman pengiriman dengan status selesai
        return redirect()->route('pengiriman.index')->with('status', 'Pengiriman selesai!');
    }


    // Method untuk memperbarui status pengiriman menjadi 'OTW'
    public function otw($id)
    {
        $pengiriman = Pengiriman::findOrFail($id);
        $pengiriman->status = Pengiriman::STATUS_OTW; // Menggunakan konstanta
        $pengiriman->save();

        return redirect()->route('pengiriman.index')->with('status', 'Pengiriman sedang dalam perjalanan (OTW).');
    }
}
