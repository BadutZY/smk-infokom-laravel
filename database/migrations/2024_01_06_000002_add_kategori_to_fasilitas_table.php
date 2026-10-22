<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Menambahkan `kategori` pada Fasilitas supaya daftar fasilitas bisa
     * dikelompokkan (mis. "Sarana & Prasarana" vs "Laboratorium Komputer")
     * sesuai data pada brosur PPDB, tanpa perlu tabel terpisah.
     */
    public function up(): void
    {
        Schema::table('fasilitas', function (Blueprint $table) {
            $table->string('kategori', 100)->nullable()->default('Sarana & Prasarana')->after('urutan');
        });
    }

    public function down(): void
    {
        Schema::table('fasilitas', function (Blueprint $table) {
            $table->dropColumn('kategori');
        });
    }
};
