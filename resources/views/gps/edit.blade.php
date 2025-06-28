@extends('layouts.app')

@section('contents')
<div class="container-fluid">
    <h3>Edit GPS</h3>

    <form action="{{ route('gps.update', $gps->id) }}" method="POST">
        @csrf
        @method('PUT')
        
        <div class="form-group">
            <label for="latitude">Latitude</label>
            <input type="number" step="any" name="latitude" id="latitude" class="form-control" value="{{ $gps->latitude }}" required>
        </div>
        <div class="form-group">
            <label for="longitude">Longitude</label>
            <input type="number" step="any" name="longitude" id="longitude" class="form-control" value="{{ $gps->longitude }}" required>
        </div>

        <!-- Dropdown untuk Pengiriman ID -->
        <div class="form-group">
            <label for="pengiriman_id">Pengiriman ID</label>
            <select name="pengiriman_id" id="pengiriman_id" class="form-control" required>
                @foreach($pengirimans as $pengiriman)
                    <option value="{{ $pengiriman->id }}" 
                        @if($gps->pengiriman_id == $pengiriman->id) selected @endif>
                        {{ $pengiriman->id }}
                    </option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-warning mt-3">Update</button>
    </form>
</div>
@endsection
