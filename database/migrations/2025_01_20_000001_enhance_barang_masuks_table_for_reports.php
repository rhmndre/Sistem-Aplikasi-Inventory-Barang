<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('barang_masuks', function (Blueprint $table) {
            $table->string('supplier')->nullable()->after('satuan');
            $table->text('keterangan')->nullable()->after('supplier');
            $table->decimal('harga_satuan', 10, 2)->nullable()->after('keterangan');
            $table->decimal('total_harga', 12, 2)->nullable()->after('harga_satuan');
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending')->after('total_harga');
            $table->string('approved_by')->nullable()->after('status');
            $table->timestamp('approved_at')->nullable()->after('approved_by');
            $table->string('created_by')->nullable()->after('approved_at');
        });
    }

    public function down(): void
    {
        Schema::table('barang_masuks', function (Blueprint $table) {
            $table->dropColumn([
                'supplier',
                'keterangan', 
                'harga_satuan',
                'total_harga',
                'status',
                'approved_by',
                'approved_at',
                'created_by'
            ]);
        });
    }
};