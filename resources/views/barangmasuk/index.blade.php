<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Barang Masuk') }}
        </h2>
    </x-slot>
    <div class="container mt-4">
        <a href="{{ route('barangmasuk.create') }}" class="btn btn-primary mb-3">Tambah Barang Masuk</a>
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
                    <th>Jumlah Masuk</th>
                    <th>Satuan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($barangmasuks as $barangmasuk)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $barangmasuk->id_transaksi }}</td>
                    <td>{{ $barangmasuk->tanggal }}</td>
                    <td>{{ $barangmasuk->barang }}</td>
                    <td>{{ $barangmasuk->jumlah_barang }}</td>
                    <td>{{ $barangmasuk->jumlah_masuk }}</td>
                    <td>{{ $barangmasuk->satuan }}</td>
                    <td>
                        <a href="{{ route('barangmasuk.edit', $barangmasuk->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('barangmasuk.destroy', $barangmasuk->id) }}" method="POST" style="display:inline-block;">
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
