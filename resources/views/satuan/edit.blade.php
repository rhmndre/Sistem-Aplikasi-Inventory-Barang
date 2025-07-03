@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Satuan</h1>
    <form action="{{ route('superadmin.satuan.update', $satuan->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="jenis_barang" class="form-label">Jenis Barang</label>
            <input type="text" name="jenis_barang" class="form-control" value="{{ $satuan->jenis_barang }}" required>
        </div>
        <button type="submit" class="btn btn-success">Update</button>
        <a href="{{ route('satuan.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
