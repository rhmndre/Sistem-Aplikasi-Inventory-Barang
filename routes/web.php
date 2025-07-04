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
use App\Http\Controllers\LaporanController;

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
});

// Laporan Routes - accessible by all three roles with different views
Route::middleware(['auth', 'role:superadmin,adminbarang,kepalagudang'])->group(function () {
    // Laporan Stok
    Route::get('/laporan/stok', [LaporanController::class, 'stok'])->name('laporan.stok');
    
    // Laporan Barang Masuk - accessible by all three roles
    Route::get('/laporan/barangmasuk', [LaporanController::class, 'barangMasuk'])->name('laporan.barangmasuk');
    
    // Export Laporan Barang Masuk
    Route::get('/laporan/barangmasuk/export', [LaporanController::class, 'exportBarangMasuk'])->name('laporan.barangmasuk.export');
    
    // API untuk chart data
    Route::get('/laporan/barangmasuk/chart-data', [LaporanController::class, 'getChartData'])->name('laporan.barangmasuk.chart');
    
    // Laporan Barang Keluar
    Route::get('/laporan/barangkeluar', [LaporanController::class, 'barangKeluar'])->name('laporan.barangkeluar');
});

require __DIR__.'/auth.php';
