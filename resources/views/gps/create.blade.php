@extends('layouts.app')

@section('contents')
<div class="container-fluid">
    <h3>Tambah GPS</h3>

    <form action="{{ route('gps.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="latitude">Latitude</label>
            <input type="number" step="any" name="latitude" id="latitude" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="longitude">Longitude</label>
            <input type="number" step="any" name="longitude" id="longitude" class="form-control" required>
        </div>

        <!-- Dropdown untuk Pengiriman ID -->
        <div class="form-group">
            <label for="pengiriman_id">Pengiriman ID</label>
            <select name="pengiriman_id" id="pengiriman_id" class="form-control" required>
                <option value="" disabled selected>Pilih Pengiriman</option>
                @foreach($pengirimans as $pengiriman)
                    <option value="{{ $pengiriman->id }}">
                        {{ $pengiriman->id }}
                    </option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary mt-3">Simpan</button>
    </form>
</div>
@endsection
