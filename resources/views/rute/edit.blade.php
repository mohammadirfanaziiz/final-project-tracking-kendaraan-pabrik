@extends('layouts.app')

@section('contents')
<div class="container-fluid">
    <h2>Edit Rute</h2>
    <form method="POST" action="{{ route('rute.update', $rute->id) }}">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label>Asal</label>
            <input type="text" name="asal" value="{{ $rute->asal }}" class="form-control" required>
            <!-- Asal tetap menggunakan input text -->
        </div>
        <div class="form-group">
            <label>Tujuan</label>
            <input type="text" name="tujuan" value="{{ $rute->tujuan }}" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Latitude Tujuan</label>
            <input type="text" name="latitude" value="{{ $rute->latitude }}" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Longitude Tujuan</label>
            <input type="text" name="longitude" value="{{ $rute->longitude }}" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-success mt-2">Update</button>
    </form>
</div>
@endsection
