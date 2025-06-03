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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('brand_id')->constrained()->onDelete('cascade');
            $table->string('nama');
            $table->decimal('harga_semula', 15, 2)->nullable();
            $table->decimal('harga_sekarang', 15, 2);
            $table->boolean('stok')->default(true);
            $table->string('warna')->nullable();
            $table->string('jaringan')->nullable();
            $table->string('sistem_operasi')->nullable();
            $table->string('prosesor')->nullable();
            $table->string('gpu')->nullable();
            $table->string('ram')->nullable();
            $table->string('rom')->nullable();
            $table->string('ukuran_layar')->nullable();
            $table->string('tipe_layar')->nullable();
            $table->string('resolusi_layar')->nullable();
            $table->string('kamera_belakang')->nullable();
            $table->string('kamera_depan')->nullable();
            $table->string('audio')->nullable();
            $table->string('wlan')->nullable();
            $table->string('bluetooth')->nullable();
            $table->string('gps')->nullable();
            $table->string('sensor')->nullable();
            $table->string('baterai')->nullable();
            $table->string('pengisi_daya')->nullable();
            $table->string('slot_memori_eksternal')->nullable();
            $table->string('sim')->nullable();
            $table->string('berat')->nullable();
            $table->string('dimensi')->nullable();
            $table->text('lainnya')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
