<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pengiriman', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained(); // ID Pelanggan
            $table->string('nama_barang');
            $table->float('berat'); // dalam kg
            $table->decimal('panjang', 8, 2); // dalam cm
            $table->decimal('lebar', 8, 2); // dalam cm
            $table->decimal('tinggi', 8, 2); // dalam cm
            $table->text('alamat_pickup');
            $table->text('alamat_tujuan');
            $table->string('nama_penerima');
            $table->string('telp_penerima');
            $table->decimal('total_harga', 12, 2);
            $table->enum('status', ['pending', 'approved', 'rejected', 'pickup', 'dalam_pengiriman', 'selesai'])->default('pending');
            $table->foreignId('supir_id')->nullable()->constrained('users');
            $table->foreignId('mobil_id')->nullable()->constrained('mobils');
            $table->text('catatan')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pengiriman');
    }
};
