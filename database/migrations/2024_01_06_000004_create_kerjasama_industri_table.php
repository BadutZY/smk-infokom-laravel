<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Daftar perusahaan/industri mitra kerja sama (Kerjasama Industri) yang
     * tampil di halaman Beranda (menggantikan array statis $partnerLogos).
     * Logo bersifat opsional karena berkas gambarnya akan diunggah menyusul
     * lewat panel admin.
     */
    public function up(): void
    {
        Schema::create('kerjasama_industri', function (Blueprint $table) {
            $table->id();
            $table->integer('urutan')->default(0);
            $table->string('nama', 200);
            $table->string('logo', 255)->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kerjasama_industri');
    }
};
