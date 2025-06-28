@extends('layouts.app')

@section('title', 'Data Kendaraan')

@section('contents')
    <div class="d-flex align-items-center justify-content-between">
        <h3 class="mb-0">List Data Kendaraan</h3>
        <a href="{{ route('kendaraan.create') }}" class="btn btn-success">Tambah Data Kendaraan</a>
    </div>
    <hr />
    @if(Session::has('success'))
        <div class="alert alert-success" role="alert">
            {{ Session::get('success') }}
        </div>
    @endif
    <table class="table table-hover">
        <thead class="table-primary">
            <tr>
                <th>#</th>
                <th>Nomor Polisi</th>
                <th>Jenis</th>
                <th>Rute Ditugaskan</th>
                <th>Tindakan</th>
            </tr>
        </thead>
        <tbody>
            @if($kendaraan->count() > 0)
                @foreach($kendaraan as $k)
                    <tr>
                        <td class="align-middle">{{ $loop->iteration }}</td>
                        <td class="align-middle">{{ $k->nomor_polisi }}</td>
                        <td class="align-middle">{{ $k->jenis }}</td>
                        <td class="align-middle">
                            @if($k->rute)
                                {{ $k->rute->asal }} - {{ $k->rute->tujuan }}
                            @else
                                Tidak Ditugaskan
                            @endif
                        </td>
                        <td class="align-middle">
                            <a href="{{ route('kendaraan.show', $k->id) }}" type="button" class="btn btn-primary">Detail</a>
                            <a href="{{ route('kendaraan.edit', $k->id) }}" type="button" class="btn btn-warning">Edit</a>
                            <div class="btn-group" role="group" aria-label="Basic example">
                                <form action="{{ route('kendaraan.destroy', $k->id) }}" method="POST" class="btn btn-danger p-0" onsubmit="return confirm('Delete?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger">Hapus</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td class="text-center" colspan="5">Data Kendaraan Tidak Ditemukan</td>
                </tr>
            @endif
        </tbody>
    </table>
@endsection
