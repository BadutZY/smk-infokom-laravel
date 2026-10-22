<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Sebelumnya bagian "Langkah Menuju Jepang" pada halaman publik Magang
     * Jepang berupa array statis di Blade. Dipindahkan ke database supaya
     * bisa dikelola (tambah/ubah/hapus) dari panel admin: Konten Website >
     * Konten Magang Jepang.
     */
    public function up(): void
    {
        Schema::create('magang_jepang_langkah', function (Blueprint $table) {
            $table->id();
            $table->integer('urutan')->default(0);
            $table->string('nomor', 5);
            $table->string('judul', 100);
            $table->text('deskripsi');
            $table->timestamps();
        });

        $now = now();
        DB::table('magang_jepang_langkah')->insert([
            [
                'urutan' => 1,
                'nomor' => '01',
                'judul' => 'Persiapan',
                'deskripsi' => 'Membekali diri dengan bahasa, mental, dan keterampilan teknis.',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'urutan' => 2,
                'nomor' => '02',
                'judul' => 'Seleksi',
                'deskripsi' => 'Mengikuti proses seleksi dan melengkapi berkas keberangkatan.',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'urutan' => 3,
                'nomor' => '03',
                'judul' => 'Keberangkatan',
                'deskripsi' => 'Dilepas sekolah dan keluarga menuju Jepang.',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'urutan' => 4,
                'nomor' => '04',
                'judul' => 'Magang & Berkarya',
                'deskripsi' => 'Bekerja, belajar, dan membanggakan almamater di negeri orang.',
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ]);
    }

    public function down(): void
    {
        Schema::dropIfExists('magang_jepang_langkah');
    }
};