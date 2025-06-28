@extends('layouts.app')

@section('contents')
<div class="container-fluid">
    <h3>Daftar GPS</h3>
    
    <!-- Tampilkan pesan sukses jika ada -->
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('gps.create') }}" class="btn btn-primary mb-3">Tambah GPS</a>

    <table class="table">
        <thead>
            <tr>
                <th>Latitude</th>
                <th>Longitude</th>
                <th>Timestamp</th>
                <th>Pengiriman ID</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($gpsData as $gps)
                <tr>
                    <td>{{ $gps->latitude }}</td>
                    <td>{{ $gps->longitude }}</td>
                    <!-- Format timestamp supaya lebih mudah dibaca -->
                    <td>{{ \Carbon\Carbon::parse($gps->timestamp)->format('d/m/Y H:i:s') }}</td>
                    <td>{{ $gps->pengiriman_id }}</td>
                    <td>
                        <a href="{{ route('gps.edit', $gps->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        
                        <form action="{{ route('gps.destroy', $gps->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
