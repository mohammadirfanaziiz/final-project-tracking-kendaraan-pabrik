<?php

namespace App\Http\Controllers;

use App\Models\Rute;
use Illuminate\Http\Request;

class RuteController extends Controller
{
    /**
     * Tampilkan daftar semua rute
     */
    public function index()
    {
        // Ambil semua data rute
        $rutes = Rute::all();

        // Tampilkan ke view
        return view('rute.index', compact('rutes'));
    }

    /**
     * Tampilkan form untuk tambah rute
     */
    public function create()
    {
        // Tampilkan form untuk menambah rute
        return view('rute.create');
    }

    /**
     * Simpan data rute baru
     */
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'asal' => 'required|string|max:100',
            'tujuan' => 'required|string|max:100',
            'latitude' => 'required|numeric',  // Validasi latitude
            'longitude' => 'required|numeric', // Validasi longitude
        ]);

        // Simpan data rute baru
        Rute::create([
            'asal' => $request->asal,
            'tujuan' => $request->tujuan,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
        ]);

        // Redirect ke halaman index dengan pesan sukses
        return redirect()->route('rute.index')->with('success', 'Rute berhasil ditambahkan.');
    }

    /**
     * Tampilkan detail 1 rute (jika diperlukan)
     */
    public function show($id)
    {
        // Ambil data rute berdasarkan id
        $rute = Rute::findOrFail($id);

        // Tampilkan ke view
        return view('rute.show', compact('rute'));
    }

    /**
     * Tampilkan form edit rute
     */
    public function edit($id)
    {
        // Ambil data rute untuk diedit
        $rute = Rute::findOrFail($id);

        // Tampilkan form edit dengan data rute
        return view('rute.edit', compact('rute'));
    }

    /**
     * Update data rute
     */
    public function update(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'asal' => 'required|string|max:100',
            'tujuan' => 'required|string|max:100',
            'latitude' => 'required|numeric',  // Validasi latitude
            'longitude' => 'required|numeric', // Validasi longitude
        ]);

        // Ambil data rute yang akan diupdate
        $rute = Rute::findOrFail($id);

        // Update data rute
        $rute->update([
            'asal' => $request->asal,
            'tujuan' => $request->tujuan,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
        ]);

        // Redirect ke halaman index dengan pesan sukses
        return redirect()->route('rute.index')->with('success', 'Rute berhasil diperbarui.');
    }

    /**
     * Hapus rute
     */
    public function destroy($id)
    {
        // Ambil data rute untuk dihapus
        $rute = Rute::findOrFail($id);

        // Cek apakah rute digunakan oleh kendaraan
        if ($rute->kendaraan()->count() > 0) {
            return redirect()->route('rute.index')
                ->with('error', 'Tidak bisa menghapus rute karena masih digunakan kendaraan.');
        }

        // Hapus data rute
        $rute->delete();

        // Redirect ke halaman index dengan pesan sukses
        return redirect()->route('rute.index')->with('success', 'Rute berhasil dihapus.');
    }
}
