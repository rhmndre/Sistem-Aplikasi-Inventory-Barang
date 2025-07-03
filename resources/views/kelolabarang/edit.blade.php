<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Edit Barang
        </h2>
    </x-slot>

    <div class="py-10">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 rounded shadow-md">
                <form action="{{ route('kelolabarang.update', $barang->id_barang) }}" method="POST">
                    @csrf
                    @method('PUT')

                    {{-- Nama Barang --}}
                    <div class="mb-4">
                        <label for="nama_barang" class="block text-sm font-medium text-gray-700">Nama Barang</label>
                        <input type="text" name="nama_barang" id="nama_barang"
                            value="{{ $barang->nama_barang }}"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                            required>
                    </div>

                    {{-- Stok --}}
                    <div class="mb-4">
                        <label for="stok" class="block text-sm font-medium text-gray-700">Stok</label>
                        <input type="number" name="stok" id="stok"
                            value="{{ $barang->stok }}"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                            required>
                    </div>

                    {{-- Satuan --}}
                    <div class="mb-4">
                        <label for="satuan" class="block text-sm font-medium text-gray-700">Satuan</label>
                        <input type="text" name="satuan" id="satuan"
                            value="{{ $barang->satuan }}"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                            required>
                    </div>

                    {{-- Tombol --}}
                    <div class="flex items
