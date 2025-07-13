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
use App\Http\Controllers\FakturController;

Route::get('/', function () {
    return Redirect::route('login');
});

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'role:superadmin'])->prefix('superadmin')->name('superadmin.')->group(function () {
    Route::get('/superadmin', [DashboardController::class, 'index'])->name('dashboard');

    Route::resource('manajemenuser', ManajemenUserController::class);
});


Route::middleware(['auth', 'role:adminbarang,superadmin'])->name('adminbarang.')->group(function () {
    // Barang Masuk Import Routes - harus ditempatkan sebelum resource route
    Route::get('/barangmasuk/import', [BarangMasukController::class, 'importForm'])->name('barangmasuk.import');
    Route::post('/barangmasuk/import', [BarangMasukController::class, 'import'])->name('barangmasuk.import.store');
    Route::get('/barangmasuk/template', [BarangMasukController::class, 'downloadTemplate'])->name('barangmasuk.template');

    // Barang Keluar Import Routes
    Route::get('/barangkeluar/import', [BarangKeluarController::class, 'importForm'])->name('barangkeluar.import');
    Route::post('/barangkeluar/import', [BarangKeluarController::class, 'import'])->name('barangkeluar.import.store');
    Route::get('/barangkeluar/template', [BarangKeluarController::class, 'downloadTemplate'])->name('barangkeluar.template');

    // Resource routes
    Route::resource('kelolabarang', KelolaBarangController::class);
    Route::get('kelolabarang/foto/{id}', [KelolaBarangController::class, 'showFoto'])->name('kelolabarang.foto');
    Route::resource('jenisbarang', JenisBarangController::class);
    Route::resource('barangmasuk', BarangMasukController::class);
    Route::resource('satuan', SatuanController::class);
    Route::resource('barangkeluar', BarangKeluarController::class);

    // Mengubah route faktur menjadi resource route
    Route::resource('faktur', FakturController::class);
    // Menambahkan route khusus untuk print faktur
    Route::get('faktur/{faktur}/print', [FakturController::class, 'print'])->name('faktur.print');
});
    // Laporan stok
Route::middleware(['auth', 'role:superadmin,adminbarang,kepalagudang'])->group(function () {
    Route::get('/laporan/stok', [App\Http\Controllers\LaporanController::class, 'stok'])->name('laporan.stok');
    Route::get('/laporan/stok/pdf', [App\Http\Controllers\LaporanController::class, 'stokPdf'])->name('laporan.stok.pdf');

    Route::get('/laporan/barangmasuk', [App\Http\Controllers\LaporanController::class, 'barangMasuk'])->name('laporan.barangmasuk');
    Route::get('/laporan/barangmasuk/pdf', [App\Http\Controllers\LaporanController::class, 'barangMasukPdf'])->name('laporan.barangmasuk.pdf');

    Route::get('/laporan/barangkeluar', [App\Http\Controllers\LaporanController::class, 'barangKeluar'])->name('laporan.barangkeluar');
    Route::get('/laporan/barangkeluar/pdf', [App\Http\Controllers\LaporanController::class, 'barangKeluarPdf'])->name('laporan.barangkeluar.pdf');
});


require __DIR__.'/auth.php';
