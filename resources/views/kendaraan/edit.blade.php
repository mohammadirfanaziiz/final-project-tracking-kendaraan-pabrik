@extends('layouts.app')
  
@section('title', 'Edit Data Kendaraan')
  
@section('contents')
    <h1 class="mb-0">Edit Data Kendaraan</h1>
    <hr />
    <form action="{{ route('kendaraan.update', $kendaraan->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col mb-3">
                <label class="form-label">Nomor Polisi</label>
                <input type="text" name="nomor_polisi" class="form-control" placeholder="Nomor Polisi" value="{{ $kendaraan->nomor_polisi }}" required>
            </div>
            <div class="col mb-3">
                <label class="form-label">Jenis Kendaraan</label>
                <input type="text" name="jenis" class="form-control" placeholder="Jenis Kendaraan" value="{{ $kendaraan->jenis }}" required>
            </div>
        </div>
        <div class="row">
            <div class="col mb-3">
                <label class="form-label">Rute Ditugaskan</label>
                <select name="rute_ditugaskan_id" class="form-control" required>
                    <option value="">Pilih Rute</option>
                    @foreach($rutes as $rute)
                        <option value="{{ $rute->id }}" @if($kendaraan->rute_ditugaskan_id == $rute->id) selected @endif>
                            {{ $rute->asal }} - {{ $rute->tujuan }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="mt-3 text-left">
            <button type="submit" class="btn btn-info">Perbarui</button>
            <a href="{{ route('kendaraan.index') }}" id="btn-kembali" class="btn btn-secondary ml-3">Kembali</a>
        </div>
    </form>
@endsection
