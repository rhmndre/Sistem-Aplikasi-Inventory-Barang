<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Barang Masuk') }}
        </h2>
    </x-slot>
    <div class="container mt-4">
        <form action="{{ route('superadmin.barangmasuk.update', $barangmasuk->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="id_transaksi" class="form-label">ID Transaksi</label>
                <input type="text" name="id_transaksi" class="form-control" value="{{ $barangmasuk->id_transaksi }}" required>
            </div>
            <div class="mb-3">
                <label for="tanggal" class="form-label">Tanggal</label>
                <input type="date" name="tanggal" class="form-control" value="{{ $barangmasuk->tanggal }}" required>
            </div>
            <div class="mb-3">
                <label for="barang" class="form-label">Barang</label>
                <input type="text" name="barang" class="form-control" value="{{ $barangmasuk->barang }}" required>
            </div>
            <div class="mb-3">
                <label for="jumlah_barang" class="form-label">Jumlah Barang</label>
                <input type="number" name="jumlah_barang" class="form-control" value="{{ $barangmasuk->jumlah_barang }}" required>
            </div>
            <div class="mb-3">
                <label for="jumlah_masuk" class="form-label">Jumlah Masuk</label>
                <input type="number" name="jumlah_masuk" class="form-control" value="{{ $barangmasuk->jumlah_masuk }}" required>
            </div>
            <div class="mb-3">
                <label for="satuan" class="form-label">Satuan</label>
                <input type="text" name="satuan" class="form-control" value="{{ $barangmasuk->satuan }}" required>
            </div>
            <button type="submit" class="btn btn-success">Update</button>
            <a href="{{ route('barangmasuk.index') }}" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
</x-app-layout>
