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
        Schema::create('umkm', function (Blueprint $table) {
            $table->id();
            $table->string('nama', 100);
            $table->string('kategori', 50);
            $table->text('deskripsi')->nullable();
            $table->text('alamat')->nullable();
            $table->string('kontak', 50)->nullable();
            $table->string('jam_buka', 100)->nullable();
            // Use text for produk to be compatible with older MySQL versions
            $table->text('produk')->nullable();
            $table->string('foto')->nullable();
            // Use double for coordinates for portability
            $table->double('latitude', 10, 8)->nullable();
            $table->double('longitude', 11, 8)->nullable();
            $table->string('google_maps_link')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('umkm');
    }
};
