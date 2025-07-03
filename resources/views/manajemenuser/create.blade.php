<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tambah User') }}
        </h2>
    </x-slot>
    <div class="container mt-4">
        <form action="{{ route('superadmin.manajemenuser.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="nama_user" class="form-label">Nama User</label>
                <input type="text" name="nama_user" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" name="username" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="hak_akses" class="form-label">Hak Akses</label>
                <input type="text" name="hak_akses" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="{{ route('superadmin.manajemenuser.index') }}" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
</x-app-layout>
