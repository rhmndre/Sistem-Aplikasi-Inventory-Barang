<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Laporan Barang Masuk
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow p-6 rounded">
                <form method="GET" action="{{ route('laporan.barangmasuk') }}" class="mb-6">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div>
                            <label for="start_date" class="block mb-2 font-medium text-gray-700">Tanggal Awal</label>
                            <input type="date" name="start_date" id="start_date" 
                                value="{{ $startDate ?? '' }}"
                                class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-purple-600">
                        </div>
                        <div>
                            <label for="end_date" class="block mb-2 font-medium text-gray-700">Tanggal Akhir</label>
                            <input type="date" name="end_date" id="end_date" 
                                value="{{ $endDate ?? '' }}"
                                class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-purple-600">
                        </div>
                        <div class="flex items-end space-x-2">
                            <button type="submit" class="px-4 py-2 bg-purple-600 text-white rounded hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-purple-500">
                                Filter Data
                            </button>
                            @if(isset($data) && $data->count() > 0)
                                <a href="{{ route('laporan.barangmasuk.pdf', ['start_date' => $startDate, 'end_date' => $endDate]) }}" target="_blank" 
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

                @if(isset($data) && $data->count() > 0)
                    <div class="overflow-x-auto">
                        <table class="min-w-full table-auto border border-gray-200">
                            <thead>
                                <tr class="bg-gray-100">
                                    <th class="px-4 py-2 border">No</th>
                                    <th class="px-4 py-2 border">Tanggal</th>
                                    <th class="px-4 py-2 border">Nama Barang</th>
                                    <th class="px-4 py-2 border">Jumlah</th>
                                    <th class="px-4 py-2 border">Satuan</th>
                                    <th class="px-4 py-2 border">Keterangan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($data as $index => $barang)
                                    <tr>
                                        <td class="px-4 py-2 border text-center">{{ $index + 1 }}</td>
                                        <td class="px-4 py-2 border text-center">{{ date('d/m/Y', strtotime($barang->tanggal)) }}</td>
                                        <td class="px-4 py-2 border">{{ $barang->kelolaBarang->nama_barang }}</td>
                                        <td class="px-4 py-2 border text-center">{{ $barang->jumlah }}</td>
                                        <td class="px-4 py-2 border text-center">{{ $barang->kelolaBarang->satuan->nama_satuan }}</td>
                                        <td class="px-4 py-2 border">{{ $barang->keterangan }}</td>
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
                        <p class="text-gray-500">Silakan pilih rentang tanggal untuk menampilkan data.</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
