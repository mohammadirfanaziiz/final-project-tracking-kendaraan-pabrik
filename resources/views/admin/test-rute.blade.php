@extends('layouts.app')

@section('title', 'Uji Coba Rute')

@push('styles')
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
<link rel="stylesheet" href="https://unpkg.com/leaflet-routing-machine/dist/leaflet-routing-machine.css" />
<style>
    #map { height: 600px; z-index: 0; }
</style>
@endpush

@section('contents')
<div class="container-fluid">
    <h3>Uji Coba Lokasi awal ke → {{ $tujuan['nama'] }}</h3>
    <div id="map"></div>

    <!-- Tombol Selesai -->
    @if($pengiriman) <!-- Periksa jika ada data pengiriman -->
    <form method="POST" action="{{ route('pengiriman.selesai', $pengiriman->id) }}">
        @csrf
        <button type="submit" class="btn btn-success mt-3">Selesai</button>
    </form>
    @endif
</div>
@endsection

@push('scripts')
<script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
<script src="https://unpkg.com/leaflet-routing-machine/dist/leaflet-routing-machine.js"></script>
<script>
    const tujuan = @json($tujuan);

    // Inisialisasi Map
    const map = L.map('map').setView([tujuan.lat, tujuan.lng], 13);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; OpenStreetMap contributors'
    }).addTo(map);

    // Tambahkan marker tujuan
    const tujuanMarker = L.marker([tujuan.lat, tujuan.lng]).addTo(map)
        .bindPopup(`<b>Tujuan:</b><br>${tujuan.nama}`)
        .openPopup();

    let adminMarker;
    let routingControl;  // Variabel kontrol rute

    // Fungsi untuk melacak lokasi admin secara real-time
    function trackLocation() {
        if (navigator.geolocation) {
            navigator.geolocation.watchPosition(function(position) {
                const lat = position.coords.latitude;
                const lng = position.coords.longitude;

                // Jika marker admin belum ada, buat marker baru
                if (!adminMarker) {
                    adminMarker = L.marker([lat, lng]).addTo(map)
                        .bindPopup("Lokasi").openPopup();
                } else {
                    // Update posisi marker admin jika sudah ada
                    adminMarker.setLatLng([lat, lng]);
                }

                // Hapus kontrol rute sebelumnya jika ada
                if (routingControl) {
                    map.removeControl(routingControl);
                }

                // Gunakan Leaflet Routing Machine untuk menggambar rute yang mengikuti jalan
                routingControl = L.Routing.control({
                    waypoints: [
                        L.latLng(lat, lng),   // Lokasi admin
                        L.latLng(tujuan.lat, tujuan.lng) // Lokasi tujuan
                    ],
                    routeWhileDragging: true,
                    createMarker: function() { return null; }, // Menghindari marker tambahan
                    lineOptions: { styles: [{color: 'blue', weight: 5}] }
                }).addTo(map);

                // Zoom peta ke rute yang digambar
                map.fitBounds(routingControl.getBounds());
            }, function(error) {
                alert("Gagal mengambil lokasi admin.");
                console.log("Error: " + error.message);
            });
        } else {
            alert("Geolocation tidak didukung oleh browser ini.");
        }
    }

    // Panggil fungsi untuk mulai melacak lokasi admin
    trackLocation();
</script>
@endpush
