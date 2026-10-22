<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Menambahkan kolom "kata_pengantar" (kata sambutan/pengantar dari
     * kepala sekolah) beserta foto kepala sekolahnya ke tabel
     * profil_sekolah. Ditampilkan di halaman Profil, di antara bagian
     * "Sejarah Sekolah" dan "Visi & Misi", dan bisa diubah lewat admin.
     */
    public function up(): void
    {
        Schema::table('profil_sekolah', function (Blueprint $table) {
            $table->longText('kata_pengantar')->nullable()->after('sejarah');
            $table->string('gambar_kepala_sekolah', 255)->nullable()->after('gambar_siswa');
        });
    }

    public function down(): void
    {
        Schema::table('profil_sekolah', function (Blueprint $table) {
            $table->dropColumn(['kata_pengantar', 'gambar_kepala_sekolah']);
        });
    }
};