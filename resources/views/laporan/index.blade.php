@extends('layouts.app')

@section('title', 'Laporan Pengiriman')

@section('contents')
<div class="container-fluid">

    <!-- Filter Tanggal -->
    <form method="GET" action="{{ route('laporan.pengiriman') }}" class="mb-3">
        @csrf
        <div class="row">
            <div class="col-md-5">
                <label for="start_date">Tanggal Mulai:</label>
                <input type="date" name="start_date" id="start_date" value="{{ $startDate }}" class="form-control">
            </div>
            <div class="col-md-5">
                <label for="end_date">Tanggal Akhir:</label>
                <input type="date" name="end_date" id="end_date" value="{{ $endDate }}" class="form-control">
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-primary mt-4">Filter</button>
            </div>
        </div>
    </form>

    <!-- Statistik Pengiriman (Tepat Waktu, Terlambat, Rata-rata Waktu Pengiriman) -->
    <div class="row mt-4">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">Tepat Waktu</div>
                <div class="card-body">
                    <h5 class="card-title">{{ $tepatWaktu }} Pengiriman</h5>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card">
                <div class="card-header">Terlambat</div>
                <div class="card-body">
                    <h5 class="card-title">{{ $terlambat }} Pengiriman</h5>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card">
                <div class="card-header">Rata-rata Waktu Pengiriman</div>
                <div class="card-body">
                    <h5 class="card-title">{{ round($rataWaktuPengiriman, 2) }} Menit</h5>
                </div>
            </div>
        </div>
    </div>

    <!-- Tombol Download Laporan -->
    <div class="row mt-4">
        <div class="col-md-12 text-right">
            <a href="{{ route('laporan.export', ['start_date' => $startDate, 'end_date' => $endDate]) }}" class="btn btn-success">Download Laporan</a>
        </div>
    </div>

    <!-- Tabel Pengiriman -->
    <div class="row mt-4">
        <div class="col-md-12">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Kendaraan</th>
                        <th>Driver</th>
                        <th>Rute</th>
                        <th>Status</th>
                        <th>Estimasi Kedatangan</th>
                        <th>Waktu Kedatangan</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($pengiriman as $item)
                        <tr>
                            <td>{{ $item->kendaraan->nomor_polisi }}</td>
                            <td>{{ $item->driver->name }}</td>
                            <td>{{ $item->rute->asal }} - {{ $item->rute->tujuan }}</td>
                            <td>{{ $item->status }}</td>
                            <td>{{ $item->estimasi_kedatangan }}</td>
                            <td>{{ $item->kedatangan_sebenarnya ?? 'Belum Tiba' }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

        </div>
    </div>
</div>
@endsection
