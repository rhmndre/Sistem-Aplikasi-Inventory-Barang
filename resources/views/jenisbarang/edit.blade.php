@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Jenis Barang</h1>
    <form action="{{ route('jenisbarang.update', $jenisbarang->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="jenis_barang" class="form-label">Jenis Barang</label>
            <input type="text" name="jenis_barang" class="form-control" id="jenis_barang" value="{{ $jenisbarang->jenis_barang }}" required>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('jenisbarang.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
