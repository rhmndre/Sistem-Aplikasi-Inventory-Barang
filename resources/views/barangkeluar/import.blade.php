<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Import Data Barang Keluar') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @if (session('warning'))
                        <div class="mb-4 p-4 bg-yellow-100 border border-yellow-400 text-yellow-700 rounded">
                            <p>{{ session('warning') }}</p>
                            @if (session('import_errors'))
                                <ul class="list-disc list-inside mt-2">
                                    @foreach (session('import_errors') as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            @endif
                        </div>
                    @endif

                    @if (session('error'))
                        <div class="mb-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded">
                            {{ session('error') }}
                        </div>
                    @endif

                    <div class="mb-6">
                        <a href="{{ route('adminbarang.barangkeluar.downloadTemplate') }}" class="text-blue-600 hover:text-blue-800">
                            ← Download Template Excel
                        </a>
                    </div>

                    <form action="{{ route('adminbarang.barangkeluar.import') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                        @csrf
                        <div>
                            <label for="file" class="block text-sm font-medium text-gray-700">File Excel</label>
                            <input type="file" name="file" id="file" accept=".xlsx,.xls" class="mt-1 block w-full text-sm text-gray-500
                                file:mr-4 file:py-2 file:px-4
                                file:rounded-full file:border-0
                                file:text-sm file:font-semibold
                                file:bg-purple-50 file:text-purple-700
                                hover:file:bg-purple-100
                            "/>
                            @error('file')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex items-center gap-4">
                            <button type="submit" class="px-4 py-2 bg-purple-600 text-white rounded-md hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-purple-500">
                                Import Data
                            </button>
                            <a href="{{ route('adminbarang.barangkeluar.index') }}" class="px-4 py-2 bg-gray-200 text-gray-700 rounded-md hover:bg-gray-300">
                                Batal
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
