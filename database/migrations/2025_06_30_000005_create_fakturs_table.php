<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('fakturs', function (Blueprint $table) {
            $table->id();
            $table->string('nomor_faktur')->unique();
            $table->date('tanggal_faktur');
            $table->string('id_transaksi');
            $table->string('nama_barang');
            $table->string('jenis_barang');
            $table->integer('jumlah');
            $table->string('satuan');
            $table->decimal('harga_satuan', 15, 2)->default(0);
            $table->decimal('total_harga', 15, 2)->default(0);
            $table->text('keterangan')->nullable();
            $table->timestamps();
            
            // Foreign keys
            $table->foreign('id_transaksi')->references('id_transaksi')->on('barang_masuks')->onDelete('cascade');
            $table->foreign('nama_barang')->references('nama_barang')->on('kelola_barangs')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fakturs');
    }
}; 