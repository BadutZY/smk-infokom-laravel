<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('guru_staff', function (Blueprint $table) {
            // "mata_pelajaran" diganti nama jadi "jabatan" karena tabel ini
            // sekarang juga menampung Pimpinan Sekolah, Tata Usaha, Kepala
            // Program Keahlian, dst — bukan cuma guru mata pelajaran.
            $table->renameColumn('mata_pelajaran', 'jabatan');
        });

        Schema::table('guru_staff', function (Blueprint $table) {
            // Kelompok untuk mengelompokkan kartu di halaman Guru & Staff,
            // misalnya "Pimpinan Sekolah", "Manajemen & Tata Usaha", dst.
            $table->string('kategori', 100)->default('Guru & Staf')->after('jabatan');
        });
    }

    public function down(): void
    {
        Schema::table('guru_staff', function (Blueprint $table) {
            $table->dropColumn('kategori');
        });

        Schema::table('guru_staff', function (Blueprint $table) {
            $table->renameColumn('jabatan', 'mata_pelajaran');
        });
    }
};