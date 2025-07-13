<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Detail Barang
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="mb-6">
                        <a href="{{ route('adminbarang.kelolabarang.index') }}" 
                           class="px-4 py-2 bg-gray-600 text-white rounded-md hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-500">
                            Kembali
                        </a>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-4">
                            <div>
                                <label class="block font-medium text-gray-700">ID Barang:</label>
                                <p class="mt-1">{{ 'B' . str_pad($barang->id_barang, 4, '0', STR_PAD_LEFT) }}</p>
                            </div>

                            <div>
                                <label class="block font-medium text-gray-700">Nama Barang:</label>
                                <p class="mt-1">{{ $barang->nama_barang }}</p>
                            </div>

                            <div>
                                <label class="block font-medium text-gray-700">Jenis Barang:</label>
                                <p class="mt-1">{{ $barang->jenisBarang->jenis_barang }}</p>
                            </div>

                            <div>
                                <label class="block font-medium text-gray-700">Stok:</label>
                                <p class="mt-1">{{ $barang->stok }} {{ $barang->satuan->nama_satuan }}</p>
                            </div>

                            <div>
                                <label class="block font-medium text-gray-700">Minimum Stok:</label>
                                <p class="mt-1">{{ $barang->minimum }} {{ $barang->satuan->nama_satuan }}</p>
                            </div>

                            <div>
                                <label class="block font-medium text-gray-700">Status Stok:</label>
                                <p class="mt-1">
                                    @if($barang->stok <= $barang->minimum)
                                        <span class="px-2 py-1 bg-red-500 text-white rounded text-sm">Stok Minimum</span>
                                    @else
                                        <span class="px-2 py-1 bg-green-500 text-white rounded text-sm">Stok Aman</span>
                                    @endif
                                </p>
                            </div>
                        </div>

                        <div>
                            <label class="block font-medium text-gray-700 mb-2">Foto Barang:</label>
                            @if($barang->foto)
                                <img src="{{ route('adminbarang.kelolabarang.foto', $barang->id_barang) }}" 
                                     alt="Foto {{ $barang->nama_barang }}"
                                     class="max-w-full h-auto rounded-lg shadow-md">
                            @else
                                <div class="bg-gray-100 p-4 rounded-lg text-gray-500 text-center">
                                    Tidak ada foto
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout> 