<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Menambahkan kolom "ig_foto" (foto/logo profil untuk kartu Instagram
     * pada halaman publik BKK) ke tabel bkk_konten, menggantikan ikon
     * bawaan (briefcase). Bisa diunggah dan diubah lewat panel admin:
     * BKK > tab "Konten Umum & Instagram".
     */
    public function up(): void
    {
        Schema::table('bkk_konten', function (Blueprint $table) {
            $table->string('ig_foto', 255)->nullable()->after('ig_nama');
        });
    }

    public function down(): void
    {
        Schema::table('bkk_konten', function (Blueprint $table) {
            $table->dropColumn('ig_foto');
        });
    }
};