@extends('layouts.app')

@section('contents')
<div class="container-fluid">
    <h3>Monitoring Pengiriman Aktif</h3>
    <div id="map" style="height: 500px;"></div>
</div>

<!-- Leaflet CSS -->
<link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
<!-- Leaflet JS -->
<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Membuat peta dengan koordinat awal
        const map = L.map('map').setView([-6.2, 106.8], 6);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; OpenStreetMap contributors'
        }).addTo(map);

        // Mengambil data pengiriman aktif dari Laravel
        const data = @json($pengirimanAktif);

        // Looping untuk setiap pengiriman aktif
        data.forEach(item => {
            // Membuat popup untuk setiap marker tujuan pengiriman
            const popupText = `
                <b>Driver:</b> ${item.driver.name}<br>
                <b>Kendaraan:</b> ${item.kendaraan.nomor_polisi}<br>
                <b>Rute:</b> ${item.rute.asal} → ${item.rute.tujuan}<br>
                <b>Status:</b> ${item.status}<br>
            `;

            // Menambahkan marker pada peta dengan koordinat tujuan (latitude dan longitude rute)
            L.marker([item.rute.latitude, item.rute.longitude])
                .addTo(map)
                .bindPopup(popupText); // Menambahkan popup pada marker
        });
    });
</script>
@endsection

{{-- <!-- resources/views/monitoring.blade.php -->

@extends('layouts.app')

@section('contents')
<div class="container-fluid">
    <h3>Monitoring Pengiriman Aktif</h3>
    <div id="map" style="height: 500px;"></div>
</div>

<!-- Leaflet CSS -->
<link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
<!-- Leaflet JS -->
<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

<script src="https://cdn.jsdelivr.net/npm/laravel-echo@1.10.0/dist/echo.iife.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Inisialisasi peta di frontend
        const map = L.map('map').setView([0, 0], 6);  // Koordinat default, bisa diubah sesuai kebutuhan

        // Menambahkan tile layer (peta)
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; OpenStreetMap contributors'
        }).addTo(map);

        // Menyimpan marker driver
        const markers = {};

        // Menggunakan Laravel Echo untuk mendengarkan event dari Pusher
        Echo.channel('driver-location')
            .listen('DriverLocationUpdated', (event) => {
                const { driverId, latitude, longitude } = event;

                // Jika marker untuk driver belum ada, buat marker baru
                if (!markers[driverId]) {
                    markers[driverId] = L.marker([latitude, longitude]).addTo(map)
                        .bindPopup(`<b>Driver ID:</b> ${driverId}`);
                } else {
                    // Jika marker sudah ada, update lokasi marker
                    markers[driverId].setLatLng([latitude, longitude]);
                }

                // Menyesuaikan peta berdasarkan lokasi driver
                map.setView([latitude, longitude], 13);  // Zoom ke posisi driver
            });
    });
</script>
@endsection
 --}}