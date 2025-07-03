@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Tambah Satuan</h1>
    <form action="{{ route('superadmin.satuan.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="jenis_barang" class="form-label">Jenis Barang</label>
            <input type="text" name="jenis_barang" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="{{ route('satuan.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
