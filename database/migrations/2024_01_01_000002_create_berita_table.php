<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('berita', function (Blueprint $table) {
            $table->id();
            $table->string('slug', 191)->unique();
            $table->string('judul', 200);
            $table->string('kategori', 50);
            $table->text('ringkasan');
            $table->longText('konten');
            $table->string('gambar_sampul', 255);
            $table->string('penulis', 100)->default('Admin Sekolah');
            $table->date('tanggal');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('berita');
    }
};
