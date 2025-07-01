@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Data Satuan</h1>
    <a href="{{ route('satuan.create') }}" class="btn btn-primary mb-3">Tambah Satuan</a>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>Jenis Barang</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($satuans as $satuan)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $satuan->jenis_barang }}</td>
                <td>
                    <a href="{{ route('satuan.edit', $satuan->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('satuan.destroy', $satuan->id) }}" method="POST" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin hapus?')">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
