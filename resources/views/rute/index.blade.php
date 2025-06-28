@extends('layouts.app')

@section('contents')
<div class="container-fluid">
    <h2>Daftar Rute</h2>

    @if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <a href="{{ route('rute.create') }}" class="btn btn-primary mb-3">Tambah Rute</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Asal</th>
                <th>Tujuan</th>
                <th>Latitude</th>
                <th>Longitude</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($rutes as $rute)
                <tr>
                    <td>{{ $rute->asal }}</td>
                    <td>{{ $rute->tujuan }}</td>
                    <td>{{ $rute->latitude }}</td>
                    <td>{{ $rute->longitude }}</td>
                    <td>
                        <a href="{{ route('rute.edit', $rute->id) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('rute.destroy', $rute->id) }}" method="POST" style="display:inline">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger" onclick="return confirm('Yakin hapus?')">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
