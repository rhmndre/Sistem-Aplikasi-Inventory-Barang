<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Edit Jenis Barang
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <form action="{{ route('jenisbarang.update', $jenisbarang->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <label for="jenis_barang" class="block text-gray-700 text-sm font-bold mb-2">Jenis Barang</label>
                        <input type="text" name="jenis_barang" id="jenis_barang" class="form-input rounded-md shadow-sm w-full" value="{{ $jenisbarang->jenis_barang }}" required>
                    </div>

                    <div class="flex items-center justify-start gap-3">
                        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Update</button>
                        <a href="{{ route('jenisbarang.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">Kembali</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
