<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Barang Keluar') }}
        </h2>
    </x-slot>
    <div class="container mt-4">
        <a href="{{ route('superadmin.barangkeluar.create') }}" class="btn btn-primary mb-3">Tambah Barang Keluar</a>
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>ID Transaksi</th>
                    <th>Tanggal</th>
                    <th>Barang</th>
                    <th>Jumlah Barang</th>
                    <th>Jumlah Keluar</th>
                    <th>Satuan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($barangkeluars as $barangkeluar)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $barangkeluar->id_transaksi }}</td>
                    <td>{{ $barangkeluar->tanggal }}</td>
                    <td>{{ $barangkeluar->barang }}</td>
                    <td>{{ $barangkeluar->jumlah_barang }}</td>
                    <td>{{ $barangkeluar->jumlah_keluar }}</td>
                    <td>{{ $barangkeluar->satuan }}</td>
                    <td>
                        <a href="{{ route('barangkeluar.edit', $barangkeluar->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('barangkeluar.destroy', $barangkeluar->id) }}" method="POST" style="display:inline-block;">
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
</x-app-layout>
