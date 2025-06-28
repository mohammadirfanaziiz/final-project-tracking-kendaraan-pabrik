@extends('layouts.app')

@section('contents')
<div class="container-fluid">
    <h2>Tambah Rute</h2>
    <form method="POST" action="{{ route('rute.store') }}">
        @csrf
        <div class="form-group">
            <label>Asal</label>
            <input type="text" name="asal" class="form-control" required>
            <!-- Asal tetap menggunakan input text untuk nama lokasi -->
        </div>
        <div class="form-group">
            <label>Tujuan</label>
            <input type="text" name="tujuan" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Latitude Tujuan</label>
            <input type="text" name="latitude" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Longitude Tujuan</label>
            <input type="text" name="longitude" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-success mt-2">Simpan</button>
    </form>
</div>
@endsection
