<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Menambah kolom `foto` (opsional) pada prestasi sekolah.
     *
     * Foto milik satu "kelompok" (satu kartu siswa/tim). Saat admin mengunggah
     * foto, foto itu otomatis dipakai oleh semua baris dengan nomor kelompok
     * yang sama, sehingga kartu di halaman publik selalu tampil konsisten.
     */
    public function up(): void
    {
        if (! Schema::hasColumn('prestasi_sekolah', 'foto')) {
            Schema::table('prestasi_sekolah', function (Blueprint $table) {
                $table->string('foto', 255)->nullable()->after('tahun');
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasColumn('prestasi_sekolah', 'foto')) {
            Schema::table('prestasi_sekolah', function (Blueprint $table) {
                $table->dropColumn('foto');
            });
        }
    }
};