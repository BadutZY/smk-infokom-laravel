<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Menambahkan kolom `gambar_lab`: satu foto laboratorium/praktik untuk
     * masing-masing jurusan, ditampilkan di halaman detail jurusan
     * (pages.jurusan-show). Dibuat nullable karena bersifat opsional —
     * jurusan yang sudah ada tidak wajib langsung diisi lewat admin.
     */
    public function up(): void
    {
        Schema::table('jurusan', function (Blueprint $table) {
            $table->string('gambar_lab')->nullable()->after('gambar');
        });
    }

    public function down(): void
    {
        Schema::table('jurusan', function (Blueprint $table) {
            $table->dropColumn('gambar_lab');
        });
    }
};