@extends('layouts.app')

@section('contents')
<div class="container-fluid">
    <h2>Tambah Pengiriman</h2>

    <form method="POST" action="{{ route('pengiriman.store') }}">
        @csrf

        <div class="form-group">
            <label>Kendaraan</label>
            <select name="kendaraan_id" class="form-control" required>
                <option value="">-- Pilih --</option>
                @foreach($kendaraans as $k)
                    <option value="{{ $k->id }}">{{ $k->nomor_polisi }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label>Driver</label>
            <select name="driver_id" class="form-control" required>
                <option value="">-- Pilih --</option>
                @foreach($drivers as $d)
                    <option value="{{ $d->id }}">{{ $d->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label>Rute</label>
            <select name="rute_id" class="form-control" required>
                <option value="">-- Pilih --</option>
                @foreach($rutes as $r)
                    <option value="{{ $r->id }}">{{ $r->asal }} - {{ $r->tujuan }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label>Status</label>
            <select name="status" class="form-control" required>
                <option value="">-- Pilih Status --</option>
                <option value="{{ App\Models\Pengiriman::STATUS_OTW }}">OTW (On The Way)</option>
                <option value="{{ App\Models\Pengiriman::STATUS_SELESAI }}">Selesai</option>
            </select>
        </div>

        <div class="form-group">
            <label>Deskripsi Barang</label>
            <textarea name="deskripsi_barang" class="form-control"></textarea>
        </div>

        <div class="form-group">
            <label>Estimasi Kedatangan</label>
            <input type="datetime-local" name="estimasi_kedatangan" class="form-control">
        </div>

        <button class="btn btn-success mt-2">Simpan</button>
    </form>
</div>
@endsection
