<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Menambahkan kolom "sejarah" (riwayat/sejarah sekolah) ke tabel
     * profil_sekolah. Kolom ini dipakai untuk mengganti tampilan lama
     * "Sekilas Sekolah" (kepala sekolah, alamat, telepon) di bagian atas
     * halaman Profil, menjadi teks sejarah sekolah yang panjang dan bisa
     * diubah lewat halaman admin.
     */
    public function up(): void
    {
        Schema::table('profil_sekolah', function (Blueprint $table) {
            $table->longText('sejarah')->nullable()->after('visi');
        });
    }

    public function down(): void
    {
        Schema::table('profil_sekolah', function (Blueprint $table) {
            $table->dropColumn('sejarah');
        });
    }
};