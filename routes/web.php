<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\SatuanController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\BarangMasukController;
use App\Http\Controllers\JenisBarangController;
use App\Http\Controllers\BarangKeluarController;
use App\Http\Controllers\KelolaBarangController;
use App\Http\Controllers\ManajemenUserController;

Route::get('/', function () {
    return Redirect::route('login');
});

Route::get('/dashboard', function () {
    // Contoh: ambil barang dengan stok minimum dari model KelolaBarang
    $barangMinimum = \App\Models\KelolaBarang::whereColumn('stok', '<=', 'minimum')->get();
    return view('dashboard', compact('barangMinimum'));
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'role:superadmin'])->prefix('superadmin')->name('superadmin.')->group(function () {
    Route::get('/superadmin', [DashboardController::class, 'index'])->name('dashboard');
    
    Route::resource('jenisbarang', JenisBarangController::class);
    Route::resource('satuan', SatuanController::class);
    Route::resource('manajemenuser', ManajemenUserController::class);
});


Route::middleware(['auth', 'role:adminbarang,superadmin'])->prefix('adminbarang')->name('adminbarang.')->group(function () {
    Route::resource('kelolabarang', KelolaBarangController::class)->except(['destroy']);
    Route::resource('barangmasuk', BarangMasukController::class);
    Route::resource('barangkeluar', BarangKeluarController::class);
    // Laporan stok
});

Route::middleware(['auth', 'role:superadmin,adminbarang,kepalagudang'])->group(function () {
    Route::get('/laporan/stok', [App\Http\Controllers\LaporanController::class, 'stok'])->name('laporan.stok');
});

Route::middleware(['auth', 'role:kepalagudang,superadmin'])->group(function () {
    // Hanya akses laporan dan monitoring
    Route::get('/laporan/barangmasuk', [App\Http\Controllers\LaporanController::class, 'barangMasuk'])->name('laporan.barangmasuk');
    Route::get('/laporan/barangkeluar', [App\Http\Controllers\LaporanController::class, 'barangKeluar'])->name('laporan.barangkeluar');
});

require __DIR__.'/auth.php';
