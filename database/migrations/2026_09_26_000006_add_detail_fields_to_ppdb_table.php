<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Melengkapi formulir pendaftaran PPDB publik: data kelahiran & agama
     * siswa, data orang tua/wali, serta unggahan dokumen pendukung
     * (KK/Akta/Ijazah). Semua kolom nullable supaya data lama (sebelum
     * migrasi ini) tetap valid; validasi wajib isi diterapkan di
     * PpdbController untuk pendaftaran baru.
     */
    public function up(): void
    {
        Schema::table('ppdb', function (Blueprint $table) {
            $table->string('tempat_lahir', 100)->nullable()->after('asal_sekolah');
            $table->date('tanggal_lahir')->nullable()->after('tempat_lahir');
            $table->string('agama', 30)->nullable()->after('jenis_kelamin');
            $table->string('nama_orang_tua', 100)->nullable()->after('alamat');
            $table->string('telepon_orang_tua', 20)->nullable()->after('nama_orang_tua');
            $table->string('pekerjaan_orang_tua', 100)->nullable()->after('telepon_orang_tua');
            $table->string('dokumen', 255)->nullable()->after('pekerjaan_orang_tua');
        });
    }

    public function down(): void
    {
        Schema::table('ppdb', function (Blueprint $table) {
            $table->dropColumn([
                'tempat_lahir', 'tanggal_lahir', 'agama',
                'nama_orang_tua', 'telepon_orang_tua', 'pekerjaan_orang_tua', 'dokumen',
            ]);
        });
    }
};