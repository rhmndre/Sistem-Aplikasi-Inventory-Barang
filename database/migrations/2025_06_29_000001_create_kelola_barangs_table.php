<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('kelola_barangs', function (Blueprint $table) {
            $table->id();
            $table->string('kode_barang')->unique();
            $table->string('nama_barang')->unique();
            $table->string('jenis_barang');
            $table->string('satuan');
            $table->integer('stok')->default(0);
            $table->decimal('harga', 10, 2);
            $table->text('keterangan');
            $table->string('foto')->nullable();
            $table->timestamps();

            $table->foreign('jenis_barang')->references('nama_jenis')->on('jenis_barangs')->onDelete('cascade');
            $table->foreign('satuan')->references('nama_satuan')->on('satuans')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kelola_barangs');
    }
}; 
