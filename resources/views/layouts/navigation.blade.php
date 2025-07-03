<div class="flex min-h-screen">
    <!-- Sidebar -->
    <aside class="w-64 bg-white text-gray-800 flex flex-col min-h-screen shadow-lg">
        <div class="flex items-center gap-2 justify-center h-16 bg-[#6C63FF] border-b border-[#6C63FF]">
            <span class="text-3xl font-bold text-yellow-400">PMAR</span>
            <span class="text-xl font-semibold text-white">MATERIAL</span>
            <button class="ml-auto mr-4 text-white focus:outline-none lg:hidden">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </button>
        </div>
        <nav class="flex-1 px-4 py-6 space-y-2 overflow-y-auto">
            <a href="{{ route('dashboard') }}" class="flex items-center gap-2 px-3 py-2 rounded-lg font-semibold text-white bg-[#6C63FF] shadow">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0h6" stroke-linecap="round" stroke-linejoin="round"/></svg>
                Dashboard
            </a>
            @if(Auth::user()->role === 'superadmin')
                <div class="mt-6 mb-2 text-xs font-bold text-gray-500 uppercase">Master</div>
                <a href="{{ route('superadmin.kelolabarang.index') }}" class="flex items-center gap-2 px-3 py-2 rounded-lg text-gray-700 hover:bg-gray-100">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M4 6h16M4 12h16M4 18h16" stroke-linecap="round" stroke-linejoin="round"/></svg>
                    Barang
                </a>
                <a href="{{ route('superadmin.jenisbarang.index') }}" class="flex items-center gap-2 px-3 py-2 rounded-lg text-gray-700 hover:bg-gray-100">Jenis Barang</a>
                <a href="{{ route('superadmin.satuan.index') }}" class="flex items-center gap-2 px-3 py-2 rounded-lg text-gray-700 hover:bg-gray-100">Satuan</a>
                <div class="mt-6 mb-2 text-xs font-bold text-gray-500 uppercase">Pengaturan</div>
                <a href="{{ route('superadmin.manajemenuser.index') }}" class="flex items-center gap-2 px-3 py-2 rounded-lg text-gray-700 hover:bg-gray-100">Manajemen User</a>
            @endif
            @if(Auth::user()->role === 'superadmin' || Auth::user()->role === 'adminbarang')
                <div class="mt-6 mb-2 text-xs font-bold text-gray-500 uppercase">Transaksi</div>
                <a href="{{ route('superadmin.barangmasuk.index') }}" class="flex items-center gap-2 px-3 py-2 rounded-lg text-gray-700 hover:bg-gray-100">Barang Masuk</a>
                <a href="{{ route('superadmin.barangkeluar.index') }}" class="flex items-center gap-2 px-3 py-2 rounded-lg text-gray-700 hover:bg-gray-100">Barang Keluar</a>
            @endif
            <div class="mt-6 mb-2 text-xs font-bold text-gray-500 uppercase">Laporan</div>
            <a href="{{ route('laporan.stok') }}" class="flex items-center gap-2 px-3 py-2 rounded-lg text-gray-700 hover:bg-gray-100">Laporan Stok</a>
            <a href="{{ route('laporan.barangmasuk') }}" class="flex items-center gap-2 px-3 py-2 rounded-lg text-gray-700 hover:bg-gray-100">Laporan Barang Masuk</a>
            <a href="{{ route('laporan.barangkeluar') }}" class="flex items-center gap-2 px-3 py-2 rounded-lg text-gray-700 hover:bg-gray-100">Laporan Barang Keluar</a>
        </nav>
        <div class="border-t border-gray-200 p-4">
            <div class="mb-2 font-semibold">{{ Auth::user()->name }}</div>
            <div class="mb-4 text-sm text-gray-500">{{ Auth::user()->email }}</div>
            <a href="{{ route('profile.edit') }}" class="block px-3 py-2 rounded-lg text-gray-700 hover:bg-gray-100">Profile</a>
            <form method="POST" action="{{ route('logout') }}" class="mt-2">
                @csrf
                <button type="submit" class="block w-full text-left px-3 py-2 rounded-lg text-gray-700 hover:bg-gray-100">Log Out</button>
            </form>
        </div>
    </aside>
    <!-- Main Content -->
    <div class="flex-1 bg-gray-100 min-h-screen">
        @yield('content')
    </div>
</div>
