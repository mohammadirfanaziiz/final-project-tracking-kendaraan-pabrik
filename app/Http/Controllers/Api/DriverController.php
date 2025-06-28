<?php
namespace App\Http\Controllers\Api;

use App\Events\DriverLocationUpdated;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DriverController extends Controller
{
    public function updateLocation(Request $request, $driverId)
    {
        // Validasi data latitude dan longitude
        $request->validate([
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
        ]);

        // Mengupdate lokasi driver
        $latitude = $request->latitude;
        $longitude = $request->longitude;

        // Broadcasting event dengan lokasi driver yang diperbarui
        broadcast(new DriverLocationUpdated($driverId, $latitude, $longitude));

        return response()->json(['message' => 'Lokasi driver diperbarui']);
    }
}
