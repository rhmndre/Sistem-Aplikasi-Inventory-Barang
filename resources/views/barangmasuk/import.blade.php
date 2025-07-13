<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Import Data Barang Masuk') }}
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
                        <h3 class="text-lg font-medium text-gray-900 mb-2">Petunjuk Import:</h3>
                        <ol class="list-decimal list-inside space-y-1">
                            <li>Download template Excel yang sudah disediakan</li>
                            <li>Isi data sesuai format yang ada di template</li>
                            <li>Pastikan nama barang sesuai dengan yang ada di sistem</li>
                            <li>Pastikan satuan sesuai dengan yang ada di sistem</li>
                            <li>Upload file yang sudah diisi</li>
                        </ol>
                    </div>

                    <div class="mb-6">
                        <x-primary-button tag="a" href="{{ route('adminbarang.barangmasuk.template') }}" class="inline-flex items-center">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                            </svg>
                            Download Template Excel
                        </x-primary-button>
                    </div>

                    <form action="{{ route('adminbarang.barangmasuk.import.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                        @csrf
                        <div>
                            <x-input-label for="file" value="File Excel" />
                            <input type="file" id="file" name="file" 
                                class="mt-1 block w-full text-sm text-gray-500
                                    file:mr-4 file:py-2 file:px-4
                                    file:rounded-md file:border-0
                                    file:text-sm file:font-semibold
                                    file:bg-blue-50 file:text-blue-700
                                    hover:file:bg-blue-100"
                                accept=".xlsx,.xls">
                            @error('file')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex items-center gap-4">
                            <x-primary-button type="submit">
                                Import Data
                            </x-primary-button>

                            <a href="{{ route('adminbarang.barangmasuk.index') }}" 
                                class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150">
                                Kembali
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout> 