@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Tambah Jenis Barang</h1>
    <form action="{{ route('jenisbarang.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="jenis_barang" class="form-label">Jenis Barang</label>
            <input type="text" name="jenis_barang" class="form-control" id="jenis_barang" required>
        </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="{{ route('jenisbarang.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
