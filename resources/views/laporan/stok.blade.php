<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Laporan Stok
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow p-6 rounded">
                <form method="GET" action="{{ route('laporan.stok') }}" class="mb-6">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div>
                            <label for="filter" class="block mb-2 font-medium text-gray-700">Filter Stok <span class="text-red-500">*</span></label>
                            <select name="filter" id="filter" class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-purple-600">
                                <option value="">-- Pilih Filter --</option>
                                <option value="all" {{ $filter === 'all' ? 'selected' : '' }}>Seluruh Stok</option>
                                <option value="minimum" {{ $filter === 'minimum' ? 'selected' : '' }}>Stok Minimum</option>
                            </select>
                        </div>
                        <div class="md:col-span-2 flex items-end space-x-2">
                            <button type="submit" class="px-4 py-2 bg-purple-600 text-white rounded hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-purple-500">
                                Tampilkan Data
                            </button>
                            @if(isset($data) && count($data) > 0)
                                <a href="{{ route('laporan.stok.pdf', ['filter' => $filter]) }}" target="_blank" 
                                   class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 flex items-center">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                                    </svg>
                                    Export PDF
                                </a>
                            @endif
                        </div>
                    </div>
                </form>

                @if(isset($data) && count($data) > 0)
                    <div class="overflow-x-auto">
                        <table class="min-w-full table-auto border border-gray-200">
                            <thead>
                                <tr class="bg-gray-100">
                                    <th class="px-4 py-2 border">No</th>
                                    <th class="px-4 py-2 border">ID Barang</th>
                                    <th class="px-4 py-2 border">Nama Barang</th>
                                    <th class="px-4 py-2 border">Jenis Barang</th>
                                    <th class="px-4 py-2 border">Stok</th>
                                    <th class="px-4 py-2 border">Satuan</th>
                                    <th class="px-4 py-2 border">Minimum Stok</th>
                                    <th class="px-4 py-2 border">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($data as $index => $barang)
                                    <tr class="{{ $barang['stok'] <= $barang['minimum'] ? 'bg-red-100' : '' }}">
                                        <td class="px-4 py-2 border text-center">{{ $index + 1 }}</td>
                                        <td class="px-4 py-2 border text-center">{{ $barang['id_barang'] }}</td>
                                        <td class="px-4 py-2 border">{{ $barang['nama_barang'] }}</td>
                                        <td class="px-4 py-2 border">{{ $barang['jenis_barang'] }}</td>
                                        <td class="px-4 py-2 border text-center">{{ $barang['stok'] }}</td>
                                        <td class="px-4 py-2 border text-center">{{ $barang['satuan'] }}</td>
                                        <td class="px-4 py-2 border text-center">{{ $barang['minimum'] }}</td>
                                        <td class="px-4 py-2 border text-center">
                                            @if($barang['stok'] <= $barang['minimum'])
                                                <span class="px-2 py-1 bg-red-500 text-white rounded text-sm">Stok Minimum</span>
                                            @else
                                                <span class="px-2 py-1 bg-green-500 text-white rounded text-sm">Stok Aman</span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @elseif(isset($data))
                    <div class="text-center py-4">
                        <p class="text-gray-500">Tidak ada data yang ditemukan.</p>
                    </div>
                @else
                    <div class="text-center py-4">
                        <p class="text-gray-500">Silakan pilih filter untuk menampilkan data.</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
