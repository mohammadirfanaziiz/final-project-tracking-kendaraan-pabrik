@extends('layouts.app')

@section('title', 'Input Data Kendaraan')

@section('contents')
    <h1 class="mb-0">Tambah Data Kendaraan</h1>
    <hr />
    <form action="{{ route('kendaraan.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row mb-3">
            <div class="col">
                <input type="text" name="nomor_polisi" class="form-control" placeholder="Nomor Polisi" required>
            </div>
            <div class="col">
                <input type="text" name="jenis" class="form-control" placeholder="Jenis Kendaraan" required>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col">
                <select name="rute_ditugaskan_id" class="form-control" required>
                    <option value="">Pilih Rute</option>
                    @foreach($rutes as $rute)
                        <option value="{{ $rute->id }}">{{ $rute->asal }} - {{ $rute->tujuan }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="mt-5 text-left">
            <button id="btn" class="btn btn-success" type="submit">Simpan Data</button>
            <a href="{{ route('kendaraan.index') }}" id="btn-kembali" class="btn btn-secondary ml-3">Kembali</a>
        </div>
    </form>
@endsection
