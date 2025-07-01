<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <i class="fas fa-home"></i> Dashboard
        </h2>
    </x-slot>
    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
                <div class="bg-white rounded-lg shadow p-4 flex flex-col items-center">
                    <i class="fas fa-box fa-2x text-indigo-500 mb-2"></i>
                    <div class="text-gray-600">Data Barang</div>
                    <div class="text-2xl font-bold">{{ $jumlahBarang ?? 0 }}</div>
                </div>
                <div class="bg-white rounded-lg shadow p-4 flex flex-col items-center">
                    <i class="fas fa-arrow-down fa-2x text-green-500 mb-2"></i>
                    <div class="text-gray-600">Data Barang Masuk</div>
                    <div class="text-2xl font-bold">{{ $jumlahBarangMasuk ?? 0 }}</div>
                </div>
                <div class="bg-white rounded-lg shadow p-4 flex flex-col items-center">
                    <i class="fas fa-arrow-up fa-2x text-orange-500 mb-2"></i>
                    <div class="text-gray-600">Data Barang Keluar</div>
                    <div class="text-2xl font-bold">{{ $jumlahBarangKeluar ?? 0 }}</div>
                </div>
                <div class="bg-white rounded-lg shadow p-4 flex flex-col items-center">
                    <i class="fas fa-users fa-2x text-green-600 mb-2"></i>
                    <div class="text-gray-600">Data User</div>
                    <div class="text-2xl font-bold">{{ $jumlahUser ?? 0 }}</div>
                </div>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
                <div class="bg-yellow-100 rounded-lg shadow p-4 flex items-center">
                    <i class="fas fa-layer-group fa-2x text-yellow-500 mr-4"></i>
                    <div>
                        <div class="text-gray-700 font-semibold">Data Jenis Barang</div>
                        <div class="text-xl font-bold">{{ $jumlahJenisBarang ?? 0 }}</div>
                    </div>
                </div>
                <div class="bg-blue-100 rounded-lg shadow p-4 flex items-center">
                    <i class="fas fa-folder fa-2x text-blue-500 mr-4"></i>
                    <div>
                        <div class="text-gray-700 font-semibold">Data Satuan</div>
                        <div class="text-xl font-bold">{{ $jumlahSatuan ?? 0 }}</div>
                    </div>
                </div>
                <div class="bg-green-100 rounded-lg shadow p-4 flex items-center">
                    <i class="fas fa-user fa-2x text-green-500 mr-4"></i>
                    <div>
                        <div class="text-gray-700 font-semibold">Data User</div>
                        <div class="text-xl font-bold">{{ $jumlahUser ?? 0 }}</div>
                    </div>
                </div>
            </div>
            <div class="bg-white rounded-lg shadow p-6 mb-6">
                <h3 class="text-lg font-bold mb-2"><i class="fas fa-exclamation-triangle text-yellow-500"></i> Stok barang telah mencapai batas minimum</h3>
                <div class="overflow-x-auto">
                    <table class="table-auto w-full">
                        <thead>
                            <tr>
                                <th class="px-4 py-2">No.</th>
                                <th class="px-4 py-2">ID Barang</th>
                                <th class="px-4 py-2">Nama Barang</th>
                                <th class="px-4 py-2">Jenis Barang</th>
                                <th class="px-4 py-2">Stok</th>
                                <th class="px-4 py-2">Satuan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($barangMinimum as $i => $barang)
                            <tr>
                                <td class="px-4 py-2">{{ $i+1 }}</td>
                                <td class="px-4 py-2">{{ $barang->id_barang }}</td>
                                <td class="px-4 py-2">{{ $barang->nama_barang }}</td>
                                <td class="px-4 py-2">{{ $barang->jenis_barang }}</td>
                                <td class="px-4 py-2">
                                    <span class="bg-yellow-200 text-yellow-800 px-2 py-1 rounded">{{ $barang->stok }}</span>
                                </td>
                                <td class="px-4 py-2">{{ $barang->satuan }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
