@extends('layouts.app')

@section('contents')
<div class="container-fluid">
    <h2>Daftar Pengiriman</h2>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('pengiriman.create') }}" class="btn btn-primary mb-3">Tambah Pengiriman</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Kendaraan</th>
                <th>Driver</th>
                <th>Rute</th>
                <th>Status</th>
                <th>Estimasi Kedatangan</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($pengiriman as $item)
                <tr>
                    <td>{{ $item->kendaraan->nomor_polisi }}</td>
                    <td>{{ $item->driver->name }}</td>
                    <td>{{ $item->rute->asal }} - {{ $item->rute->tujuan }}</td>
                    <td>
                        @if ($item->status == App\Models\Pengiriman::STATUS_OTW)
                            OTW (On The Way)
                        @elseif ($item->status == App\Models\Pengiriman::STATUS_SELESAI)
                            Selesai
                        @else
                            <em>Status tidak diketahui</em>
                        @endif
                    </td>
                    <td>{{ \Carbon\Carbon::parse($item->estimasi_kedatangan)->format('d M Y H:i') }}</td>
                    <td>
                        <a href="{{ route('pengiriman.edit', $item->id) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('pengiriman.destroy', $item->id) }}" method="POST" style="display:inline;">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-danger" onclick="return confirm('Yakin hapus?')">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
