<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('mobils', function (Blueprint $table) {
            $table->id();
            $table->string('nama_mobil');
            $table->string('nomor_plat')->unique();
            $table->string('merk');
            $table->string('warna');
            $table->integer('tahun');
            $table->enum('status', ['tersedia', 'disewa', 'perbaikan'])->default('tersedia');
            $table->text('keterangan')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('mobils');
    }
};
