<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Barang Keluar') }}
        </h2>
    </x-slot>
    <div class="container mt-4">
        <form action="{{ route('barangkeluar.update', $barangkeluar->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="id_transaksi" class="form-label">ID Transaksi</label>
                <input type="text" name="id_transaksi" class="form-control" value="{{ $barangkeluar->id_transaksi }}" required>
            </div>
            <div class="mb-3">
                <label for="tanggal" class="form-label">Tanggal</label>
                <input type="date" name="tanggal" class="form-control" value="{{ $barangkeluar->tanggal }}" required>
            </div>
            <div class="mb-3">
                <label for="barang" class="form-label">Barang</label>
                <input type="text" name="barang" class="form-control" value="{{ $barangkeluar->barang }}" required>
            </div>
            <div class="mb-3">
                <label for="jumlah_barang" class="form-label">Jumlah Barang</label>
                <input type="number" name="jumlah_barang" class="form-control" value="{{ $barangkeluar->jumlah_barang }}" required>
            </div>
            <div class="mb-3">
                <label for="jumlah_keluar" class="form-label">Jumlah Keluar</label>
                <input type="number" name="jumlah_keluar" class="form-control" value="{{ $barangkeluar->jumlah_keluar }}" required>
            </div>
            <div class="mb-3">
                <label for="satuan" class="form-label">Satuan</label>
                <input type="text" name="satuan" class="form-control" value="{{ $barangkeluar->satuan }}" required>
            </div>
            <button type="submit" class="btn btn-success">Update</button>
            <a href="{{ route('barangkeluar.index') }}" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
</x-app-layout>
