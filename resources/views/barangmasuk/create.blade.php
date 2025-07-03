<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tambah Barang Masuk') }}
        </h2>
    </x-slot>
    <div class="container mt-4">
        <form action="{{ route('adminbarang.barangmasuk.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="id_transaksi" class="form-label">ID Transaksi</label>
                <input type="text" name="id_transaksi" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="tanggal" class="form-label">Tanggal</label>
                <input type="date" name="tanggal" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="barang" class="form-label">Barang</label>
                <input type="text" name="barang" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="jumlah_barang" class="form-label">Jumlah Barang</label>
                <input type="number" name="jumlah_barang" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="jumlah_masuk" class="form-label">Jumlah Masuk</label>
                <input type="number" name="jumlah_masuk" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="satuan" class="form-label">Satuan</label>
                <input type="text" name="satuan" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="{{ route('adminbarang.barangmasuk.index') }}" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
</x-app-layout>
