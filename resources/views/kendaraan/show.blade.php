@extends('layouts.app')
  
@section('title', 'Detail Data Kendaraan')
  
@section('contents')
    <h1 class="mb-0">Detail Data Kendaraan</h1>
    <hr />
    <div class="row">
        <div class="col mb-3">
            <label class="form-label">Nomor Polisi</label>
            <input type="text" name="nomor_polisi" class="form-control" placeholder="Nomor Polisi" value="{{ $kendaraan->nomor_polisi }}" readonly>
        </div>
        <div class="col mb-3">
            <label class="form-label">Jenis Kendaraan</label>
            <input type="text" name="jenis" class="form-control" placeholder="Jenis Kendaraan" value="{{ $kendaraan->jenis }}" readonly>
        </div>
    </div>
    <div class="row">
        <div class="col mb-3">
            <label class="form-label">Rute Ditugaskan</label>
            <input type="text" name="rute_ditugaskan_id" class="form-control" placeholder="Rute Ditugaskan" value="{{ $kendaraan->rute ? $kendaraan->rute->asal . ' - ' . $kendaraan->rute->tujuan : 'Tidak Ditugaskan' }}" readonly>
        </div>
    </div>

    <div class="row">
        <div class="col mb-3">
            <label class="form-label">Created At</label>
            <input type="text" name="created_at" class="form-control" placeholder="Created At" value="{{ $kendaraan->created_at }}" readonly>
        </div>
        <div class="col mb-3">
            <label class="form-label">Updated At</label>
            <input type="text" name="updated_at" class="form-control" placeholder="Updated At" value="{{ $kendaraan->updated_at }}" readonly>
        </div>
    </div>

    <div class="mt-3 text-left">
        <a href="{{ route('kendaraan.index') }}" id="btn-kembali" class="btn btn-secondary">Kembali</a>
    </div>
@endsection
