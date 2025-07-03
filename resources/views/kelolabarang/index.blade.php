<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Kelola Barang
        </h2>
    </x-slot>

    <div class="py-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 rounded-lg shadow">
                
                {{-- Tombol Tambah Barang --}}
                <div class="mb-4 flex justify-between items-center">
                    @if(session('success'))
                        <div class="px-4 py-2 rounded text-sm bg-green-100 text-green-700">
                            {{ session('success') }}
                        </div>
                    @endif
                    <a href="{{ route('adminbarang.kelolabarang.create') }}" class="inline-block px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition">
                        + Tambah Barang
                    </a>
                </div>

                {{-- Tabel Data Barang --}}
                <div class="overflow-x-auto">
                    <table class="min-w-full bg-white border border-gray-200 text-sm">
                        <thead class="bg-gray-100 text-gray-700">
                            <tr>
                                <th class="px-4 py-2 border">ID Barang</th>
                                <th class="px-4 py-2 border">Nama Barang</th>
                                <th class="px-4 py-2 border">Stok</th>
                                <th class="px-4 py-2 border">Satuan</th>
                                <th class="px-4 py-2 border">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-700">
                            @forelse($barangs as $barang)
                            <tr class="hover:bg-gray-50">
                                <td class="px-4 py-2 border">{{ $barang->id_barang }}</td>
                                <td class="px-4 py-2 border">{{ $barang->nama_barang }}</td>
                                <td class="px-4 py-2 border">{{ $barang->stok }}</td>
                                <td class="px-4 py-2 border">{{ $barang->satuan }}</td>
                                <td class="px-4 py-2 border flex gap-2">
                                    <a href="{{ route('adminbarang.kelolabarang.edit', $barang->id_barang) }}"
                                       class="inline-flex items-center px-3 py-1 bg-yellow-400 text-white text-xs font-medium rounded hover:bg-yellow-500 transition">
                                        <i class="fas fa-edit mr-1"></i> Edit
                                    </a>
                                    <form action="{{ route('adminbarang.kelolabarang.destroy', $barang->id_barang) }}" method="POST" onsubmit="return confirm('Yakin hapus?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="inline-flex items-center px-3 py-1 bg-red-600 text-white text-xs font-medium rounded hover:bg-red-700 transition">
                                            <i class="fas fa-trash-alt mr-1"></i> Hapus
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="text-center py-4 text-gray-500">Tidak ada data barang.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
