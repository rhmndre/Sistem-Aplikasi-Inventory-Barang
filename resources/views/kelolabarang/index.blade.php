@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Kelola Barang</h1>
    <a href="{{ route('kelolabarang.create') }}" class="btn btn-primary mb-3">Tambah Barang</a>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID Barang</th>
                <th>Nama Barang</th>
                <th>Stok</th>
                <th>Satuan</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($barangs as $barang)
            <tr>
                <td>{{ $barang->id_barang }}</td>
                <td>{{ $barang->nama_barang }}</td>
                <td>{{ $barang->stok }}</td>
                <td>{{ $barang->satuan }}</td>
                <td>
                    <a href="{{ route('kelolabarang.edit', $barang->id_barang) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('kelolabarang.destroy', $barang->id_barang) }}" method="POST" style="display:inline-block;">
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
