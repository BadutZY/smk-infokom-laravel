<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

return new class extends Migration
{
    /**
     * Menambahkan:
     * - `slug`          : dipakai untuk URL halaman detail jurusan
     *                     (/akademik/jurusan/{slug}), dibuat otomatis dari
     *                     `kode` lewat Jurusan::boot() setiap kali disimpan.
     * - `lingkup_kerja` : daftar peluang kerja/profesi per jurusan (satu
     *                     baris = satu item), sesuai data "Lingkup Kerja"
     *                     pada brosur PPDB.
     */
    public function up(): void
    {
        Schema::table('jurusan', function (Blueprint $table) {
            // Sengaja dibuat nullable (bukan pakai ->change() ke NOT NULL)
            // karena paket doctrine/dbal tidak terpasang di proyek ini.
            // Keunikan & pengisian slug tetap dijamin di level aplikasi oleh
            // Jurusan::boot() setiap kali data disimpan lewat admin.
            $table->string('slug', 160)->nullable()->unique()->after('kode');
            $table->json('lingkup_kerja')->nullable()->after('poin');
        });

        // Isi slug untuk baris yang sudah ada supaya langsung bisa dibuka
        // halaman detailnya tanpa perlu disimpan ulang lewat admin dulu.
        foreach (DB::table('jurusan')->select('id', 'kode', 'nama')->get() as $row) {
            $base = Str::slug($row->kode ?: $row->nama) ?: 'jurusan-'.$row->id;
            $slug = $base;
            $i = 2;
            while (DB::table('jurusan')->where('slug', $slug)->where('id', '!=', $row->id)->exists()) {
                $slug = $base.'-'.$i++;
            }
            DB::table('jurusan')->where('id', $row->id)->update(['slug' => $slug]);
        }
    }

    public function down(): void
    {
        Schema::table('jurusan', function (Blueprint $table) {
            $table->dropUnique(['jurusan_slug_unique']);
            $table->dropColumn(['slug', 'lingkup_kerja']);
        });
    }
};
