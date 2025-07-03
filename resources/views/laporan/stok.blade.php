<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Laporan Stok
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <form method="GET" action="{{ route('laporan.stok') }}" class="mb-6 bg-white shadow p-6 rounded">
                <label for="filter" class="block mb-2 font-medium text-gray-700">Stok <span class="text-red-500">*</span></label>
                <select name="filter" id="filter" class="w-full border rounded px-3 py-2">
                    <option value="">-- Pilih --</option>
                    <option value="all" {{ request('filter') === 'all' ? 'selected' : '' }}>Seluruh</option>
                    <option value="minimum" {{ request('filter') === 'minimum' ? 'selected' : '' }}>Minimum</option>
                </select>
                <button type="submit" class="mt-4 px-4 py-2 bg-purple-600 text-white rounded">Tampilkan</button>
            </form>

            @if(isset($data))
                <div class="bg-white shadow p-6 rounded">
                    <table class="min-w-full table-auto border border-gray-200">
                        <thead>
                            <tr class="bg-gray-100">
                                <th class="px-4 py-2 border">Nama Barang</th>
                                <th class="px-4 py-2 border">Stok</th>
                                <th class="px-4 py-2 border">Satuan</th>
                                <th class="px-4 py-2 border">Minimum</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($data as $barang)
                                <tr>
                                    <td class="px-4 py-2 border">{{ $barang->nama_barang }}</td>
                                    <td class="px-4 py-2 border">{{ $barang->stok }}</td>
                                    <td class="px-4 py-2 border">{{ $barang->satuan }}</td>
                                    <td class="px-4 py-2 border">{{ $barang->minimum }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="px-4 py-2 border text-center">Tidak ada data.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            @endif

        </div>
    </div>
</x-app-layout>
