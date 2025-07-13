<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Data Barang
            </h2>
            <a href="{{ route('adminbarang.kelolabarang.create') }}" 
               class="px-4 py-2 bg-purple-600 text-white rounded-md hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-purple-500 flex items-center space-x-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" />
                </svg>
                <span>Tambah Barang</span>
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="mb-4 flex justify-between items-center">
                        <div class="flex items-center space-x-2">
                            <span class="text-gray-600">Show</span>
                            <select id="per-page" class="border border-gray-300 rounded-md text-gray-600 px-2 py-1">
                                <option value="10">10</option>
                                <option value="25">25</option>
                                <option value="50">50</option>
                                <option value="100">100</option>
                            </select>
                            <span class="text-gray-600">entries</span>
                        </div>
                        <div class="flex items-center space-x-2">
                            <span class="text-gray-600">Search:</span>
                            <input type="text" id="search" class="border border-gray-300 rounded-md px-3 py-1">
                        </div>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="min-w-full bg-white border border-gray-300">
                            <thead>
                                <tr class="bg-gray-100">
                                    <th class="px-6 py-3 border-b text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No</th>
                                    <th class="px-6 py-3 border-b text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kode Barang</th>
                                    <th class="px-6 py-3 border-b text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Barang</th>
                                    <th class="px-6 py-3 border-b text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jenis Barang</th>
                                    <th class="px-6 py-3 border-b text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Stok</th>
                                    <th class="px-6 py-3 border-b text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Satuan</th>
                                    <th class="px-6 py-3 border-b text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Harga</th>
                                    <th class="px-6 py-3 border-b text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-300">
                                @foreach($barangs as $index => $barang)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $index + 1 }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $barang->kode_barang }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $barang->nama_barang }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $barang->jenisBarang->nama_jenis }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $barang->stok }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $barang->satuanBarang->nama_satuan }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">Rp {{ number_format($barang->harga, 0, ',', '.') }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium space-x-2 flex">
                                        <a href="{{ route('adminbarang.kelolabarang.show', $barang->id) }}" 
                                           class="text-blue-600 hover:text-blue-900">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                                <path d="M10 12a2 2 0 100-4 2 2 0 000 4z" />
                                                <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd" />
                                            </svg>
                                        </a>
                                        <a href="{{ route('adminbarang.kelolabarang.edit', $barang->id) }}" 
                                           class="text-purple-600 hover:text-purple-900">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                                <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                                            </svg>
                                        </a>
                                        <form action="{{ route('adminbarang.kelolabarang.destroy', $barang->id) }}" 
                                              method="POST" 
                                              class="inline"
                                              onsubmit="return confirm('Apakah Anda yakin ingin menghapus barang ini?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-900">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                                    <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                                                </svg>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    @if(session('success'))
                    <div class="mt-4 p-4 bg-green-100 text-green-700 rounded-md">
                        {{ session('success') }}
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
