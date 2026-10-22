<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Daftar perguruan tinggi/lembaga mitra kerja sama (Kerjasama
     * Universitas) yang tampil di halaman Beranda. Logo bersifat opsional
     * karena berkas gambarnya akan diunggah menyusul lewat panel admin.
     */
    public function up(): void
    {
        Schema::create('kerjasama_universitas', function (Blueprint $table) {
            $table->id();
            $table->integer('urutan')->default(0);
            $table->string('nama', 200);
            $table->string('logo', 255)->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kerjasama_universitas');
    }
};
