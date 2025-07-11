<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('barang_masuks', function (Blueprint $table) {
            $table->id();
            $table->string('id_transaksi')->unique();
            $table->date('tanggal');
            $table->string('barang');
            $table->integer('jumlah_masuk');
            $table->string('satuan');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('barang_masuks');
    }
};
