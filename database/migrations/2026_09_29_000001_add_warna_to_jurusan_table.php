<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Menambah kolom `warna` (kode hex, mis. "#BD0AA2") pada tabel jurusan.
     * Warna ini dipakai sebagai border luar kartu jurusan di seluruh website
     * dan bisa diubah admin dari panel (Akademik > Kompetensi Keahlian).
     *
     * Aman dijalankan berulang: kalau kolom sudah ada (mis. database diimpor
     * dari sekolah_db.sql yang baru) langkah menambah kolom dilewati.
     */
    public function up(): void
    {
        if (! Schema::hasColumn('jurusan', 'warna')) {
            Schema::table('jurusan', function (Blueprint $table) {
                $table->string('warna', 9)->nullable()->after('gambar_lab');
            });
        }

        // Isi warna bawaan untuk jurusan yang sudah ada (hanya yang masih kosong).
        $defaults = (array) config('site.jurusan_warna_default', []);
        foreach ($defaults as $kode => $warna) {
            DB::table('jurusan')
                ->whereRaw('UPPER(kode) = ?', [strtoupper($kode)])
                ->whereNull('warna')
                ->update(['warna' => strtoupper($warna)]);
        }
    }

    public function down(): void
    {
        if (Schema::hasColumn('jurusan', 'warna')) {
            Schema::table('jurusan', function (Blueprint $table) {
                $table->dropColumn('warna');
            });
        }
    }
};
