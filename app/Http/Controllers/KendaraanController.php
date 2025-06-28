<?php

namespace App\Http\Controllers;

use App\Models\Rute;
use App\Models\Kendaraan;
use Illuminate\Http\Request;

class KendaraanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kendaraan = Kendaraan::orderBy('created_at', 'DESC')->get();
        return view('kendaraan.index', compact('kendaraan'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Mengambil semua data rute yang ada
        $rutes = Rute::all();

        // Kirimkan data rutes ke view
        return view('kendaraan.create', compact('rutes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nomor_polisi' => 'required|string|max:20',
            'jenis' => 'nullable|string|max:50',
            'status' => 'nullable|string|max:20',
            'rute_ditugaskan_id' => 'nullable|exists:rutes,id', // Sesuaikan nama tabel rutes di sini
        ]);

        Kendaraan::create($request->all());

        return redirect()->route('kendaraan.index')->with('success', 'Data kendaraan berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $kendaraan = Kendaraan::findOrFail($id);
        return view('kendaraan.show', compact('kendaraan'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $kendaraan = Kendaraan::findOrFail($id);
        $rutes = Rute::all();  // Ambil semua data rute untuk dropdown

        return view('kendaraan.edit', compact('kendaraan', 'rutes'));  // Kirim data kendaraan dan rutes ke view
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'nomor_polisi' => 'required|string|max:20',
            'jenis' => 'nullable|string|max:50',
            'status' => 'nullable|string|max:20',
            'rute_ditugaskan_id' => 'nullable|exists:rutes,id', // Sesuaikan nama tabel rutes di sini
        ]);

        $kendaraan = Kendaraan::findOrFail($id);
        $kendaraan->update($request->all());

        return redirect()->route('kendaraan.index')->with('success', 'Data kendaraan berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $kendaraan = Kendaraan::findOrFail($id);
        $kendaraan->delete();

        return redirect()->route('kendaraan.index')->with('success', 'Data kendaraan berhasil dihapus!');
    }
}
