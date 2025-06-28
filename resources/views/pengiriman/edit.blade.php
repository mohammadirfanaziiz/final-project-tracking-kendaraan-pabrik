@extends('layouts.app')

@section('contents')
<div class="container-fluid">
    <h2>Edit Pengiriman</h2>

    <form method="POST" action="{{ route('pengiriman.update', $pengiriman->id) }}">
        @csrf @method('PUT')

        <div class="form-group">
            <label>Kendaraan</label>
            <select name="kendaraan_id" class="form-control" required>
                @foreach($kendaraans as $k)
                    <option value="{{ $k->id }}" {{ $pengiriman->kendaraan_id == $k->id ? 'selected' : '' }}>
                        {{ $k->nomor_polisi }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label>Driver</label>
            <select name="driver_id" class="form-control" required>
                @foreach($drivers as $d)
                    <option value="{{ $d->id }}" {{ $pengiriman->driver_id == $d->id ? 'selected' : '' }}>
                        {{ $d->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label>Rute</label>
            <select name="rute_id" class="form-control" required>
                @foreach($rutes as $r)
                    <option value="{{ $r->id }}" {{ $pengiriman->rute_id == $r->id ? 'selected' : '' }}>
                        {{ $r->asal }} - {{ $r->tujuan }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label>Status</label>
            <select name="status" class="form-control" required>
                <option value="">-- Pilih Status --</option>
                <option value="{{ App\Models\Pengiriman::STATUS_OTW }}" {{ $pengiriman->status == App\Models\Pengiriman::STATUS_OTW ? 'selected' : '' }}>
                    OTW (On The Way)
                </option>
                <option value="{{ App\Models\Pengiriman::STATUS_SELESAI }}" {{ $pengiriman->status == App\Models\Pengiriman::STATUS_SELESAI ? 'selected' : '' }}>
                    Selesai
                </option>
            </select>
        </div>

        <div class="form-group">
            <label>Deskripsi Barang</label>
            <textarea name="deskripsi_barang" class="form-control">{{ $pengiriman->deskripsi_barang }}</textarea>
        </div>

        <div class="form-group">
            <label>Estimasi Kedatangan</label>
            <input type="datetime-local" name="estimasi_kedatangan"
                value="{{ \Carbon\Carbon::parse($pengiriman->estimasi_kedatangan)->format('Y-m-d\TH:i') }}"
                class="form-control">
        </div>

        <button class="btn btn-success mt-2">Update</button>
    </form>
</div>
@endsection
