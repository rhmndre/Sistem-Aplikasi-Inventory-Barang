<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Satuan') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{ route('adminbarang.satuan.update', $satuan->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-6">
                            <x-input-label for="nama_satuan" :value="__('Nama Satuan')" />
                            <x-text-input id="nama_satuan" name="nama_satuan" type="text" class="mt-1 block w-full" :value="old('nama_satuan', $satuan->nama_satuan)" required />
                            <x-input-error class="mt-2" :messages="$errors->get('nama_satuan')" />
                        </div>

                        <div class="flex items-center gap-4">
                            <x-primary-button>{{ __('Update') }}</x-primary-button>
                            <a href="{{ route('adminbarang.satuan.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-300 border border-transparent rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-400 focus:bg-gray-400 active:bg-gray-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                {{ __('Kembali') }}
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
