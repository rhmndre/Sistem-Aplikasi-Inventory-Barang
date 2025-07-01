<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('manajemen_users', function (Blueprint $table) {
            $table->id();
            $table->string('nama_user');
            $table->string('username')->unique();
            $table->string('hak_akses');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('manajemen_users');
    }
};
