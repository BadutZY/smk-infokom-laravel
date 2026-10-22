<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Sebelumnya bagian "Cara Kerja Layanan BKK" pada halaman publik BKK
     * berupa array statis di Blade. Dipindahkan ke database supaya bisa
     * dikelola dari panel admin: BKK > tab "Cara Kerja Layanan".
     */
    public function up(): void
    {
        Schema::create('bkk_langkah', function (Blueprint $table) {
            $table->id();
            $table->integer('urutan')->default(0);
            $table->string('nomor', 5);
            $table->string('judul', 100);
            $table->text('deskripsi');
            $table->timestamps();
        });

        $now = now();
        DB::table('bkk_langkah')->insert([
            [
                'urutan' => 1,
                'nomor' => '01',
                'judul' => 'Daftar ke BKK',
                'deskripsi' => 'Alumni mendaftarkan diri sebagai pencari kerja binaan BKK INFOKOM.',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'urutan' => 2,
                'nomor' => '02',
                'judul' => 'Bimbingan & Konseling',
                'deskripsi' => 'Mendapat pembekalan CV, wawancara kerja, dan konsultasi minat karier.',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'urutan' => 3,
                'nomor' => '03',
                'judul' => 'Pencocokan Lowongan',
                'deskripsi' => 'BKK mencocokkan profil alumni dengan lowongan dari mitra industri.',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'urutan' => 4,
                'nomor' => '04',
                'judul' => 'Penyaluran & Penempatan',
                'deskripsi' => 'Alumni disalurkan dan ditempatkan bekerja di perusahaan mitra.',
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ]);
    }

    public function down(): void
    {
        Schema::dropIfExists('bkk_langkah');
    }
};