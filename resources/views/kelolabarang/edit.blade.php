<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Edit Barang
        </h2>
    </x-slot>

    <div class="py-10">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 rounded shadow-md">
                <form action="{{ route('adminbarang.kelolabarang.update', $barang->id_barang) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    {{-- Nama Barang --}}
                    <div class="mb-4">
                        <label for="nama_barang" class="block text-sm font-medium text-gray-700">Nama Barang</label>
                        <input type="text" name="nama_barang" id="nama_barang"
                            value="{{ old('nama_barang', $barang->nama_barang) }}"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                            required>
                        @error('nama_barang')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Jenis Barang --}}
                    <div class="mb-4">
                        <label for="jenis_barang_id" class="block text-sm font-medium text-gray-700">Jenis Barang</label>
                        <select name="jenis_barang_id" id="jenis_barang_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                            <option value="">Pilih Jenis Barang</option>
                            @foreach($jenisBarangs as $jenis)
                                <option value="{{ $jenis->id }}" {{ old('jenis_barang_id', $barang->jenis_barang_id) == $jenis->id ? 'selected' : '' }}>
                                    {{ $jenis->jenis_barang }}
                                </option>
                            @endforeach
                        </select>
                        @error('jenis_barang_id')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Satuan --}}
                    <div class="mb-4">
                        <label for="satuan_id" class="block text-sm font-medium text-gray-700">Satuan</label>
                        <select name="satuan_id" id="satuan_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                            <option value="">Pilih Satuan</option>
                            @foreach($satuans as $satuan)
                                <option value="{{ $satuan->id }}" {{ old('satuan_id', $barang->satuan_id) == $satuan->id ? 'selected' : '' }}>
                                    {{ $satuan->nama_satuan }}
                                </option>
                            @endforeach
                        </select>
                        @error('satuan_id')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Stok --}}
                    <div class="mb-4">
                        <label for="stok" class="block text-sm font-medium text-gray-700">Stok</label>
                        <input type="number" name="stok" id="stok"
                            value="{{ old('stok', $barang->stok) }}"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                            required>
                        @error('stok')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Foto --}}
                    <div class="mb-4">
                        <label for="foto" class="block text-sm font-medium text-gray-700">Foto Barang</label>
                        <input type="file" name="foto" id="foto"
                            class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100">
                        @error('foto')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                        @if($barang->foto)
                            <div class="mt-2">
                                <img src="{{ route('adminbarang.kelolabarang.foto', $barang->id_barang) }}" alt="Foto Barang" class="h-32 w-32 object-cover rounded">
                            </div>
                        @endif
                    </div>

                    {{-- Tombol --}}
                    <div class="flex items-center justify-end mt-6 gap-4">
                        <a href="{{ route('adminbarang.kelolabarang.index') }}" 
                           class="inline-flex items-center px-4 py-2 bg-gray-300 border border-transparent rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-400 focus:bg-gray-400 active:bg-gray-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                            Kembali
                        </a>
                        <button type="submit" 
                                class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 active:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                            Update
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
