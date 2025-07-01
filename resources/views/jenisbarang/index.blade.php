@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Kelola Jenis Barang</h1>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <a href="{{ route('jenisbarang.create') }}" class="btn btn-primary mb-3">Tambah Jenis Barang</a>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>Jenis Barang</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($jenisBarangs as $index => $jenis)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $jenis->jenis_barang }}</td>
                <td>
                    <a href="{{ route('jenisbarang.edit', $jenis->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('jenisbarang.destroy', $jenis->id) }}" method="POST" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus?')">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
