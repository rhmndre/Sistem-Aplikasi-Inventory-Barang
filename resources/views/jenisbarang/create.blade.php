<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Tambah Jenis Barang
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 overflow-hidden shadow-sm sm:rounded-lg">
                <form action="{{ route('adminbarang.jenisbarang.store') }}" method="POST">
                    @csrf
                    <div class="mb-4">
                        <label for="nama_jenis" class="block text-sm font-medium text-gray-700">Jenis Barang</label>
                        <input type="text" name="nama_jenis" id="nama_jenis" required
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm @error('nama_jenis') border-red-500 @enderror"
                               value="{{ old('nama_jenis') }}">
                        @error('nama_jenis')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="keterangan" class="block text-sm font-medium text-gray-700">Keterangan</label>
                        <textarea name="keterangan" id="keterangan" rows="3" required
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm @error('keterangan') border-red-500 @enderror">{{ old('keterangan') }}</textarea>
                        @error('keterangan')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex items-center justify-start gap-4">
                        <button type="submit"
                                class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-white hover:bg-indigo-700">
                            Simpan
                        </button>
                        <a href="{{ route('adminbarang.jenisbarang.index') }}"
                           class="inline-flex items-center px-4 py-2 bg-gray-300 border border-transparent rounded-md font-semibold text-black hover:bg-gray-400">
                            Kembali
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
