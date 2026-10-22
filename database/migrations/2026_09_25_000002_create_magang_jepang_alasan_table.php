<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Sebelumnya bagian "Kenapa Magang ke Jepang?" pada halaman publik
     * Magang Jepang berupa array statis di Blade. Dipindahkan ke database
     * supaya bisa dikelola (tambah/ubah/hapus) dari panel admin: Konten
     * Website > Konten Magang Jepang.
     */
    public function up(): void
    {
        Schema::create('magang_jepang_alasan', function (Blueprint $table) {
            $table->id();
            $table->integer('urutan')->default(0);
            $table->string('icon', 50);
            $table->string('judul', 150);
            $table->text('deskripsi');
            $table->timestamps();
        });

        $now = now();
        DB::table('magang_jepang_alasan')->insert([
            [
                'urutan' => 1,
                'icon' => 'building',
                'judul' => 'Pengalaman Kerja Nyata',
                'deskripsi' => 'Belajar langsung di lingkungan kerja profesional dan menerapkan keahlian yang dipelajari di sekolah.',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'urutan' => 2,
                'icon' => 'book-open',
                'judul' => 'Bahasa & Budaya Jepang',
                'deskripsi' => 'Menguasai bahasa baru dan memahami budaya kerja yang dikenal rapi, tepat waktu, dan menghargai proses.',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'urutan' => 3,
                'icon' => 'shield-check',
                'judul' => 'Disiplin & Etos Kerja',
                'deskripsi' => 'Membentuk karakter mandiri, bertanggung jawab, dan tangguh menghadapi tantangan.',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'urutan' => 4,
                'icon' => 'trending-up',
                'judul' => 'Modal Karier Masa Depan',
                'deskripsi' => 'Pengalaman internasional menjadi nilai tambah yang kuat saat melamar kerja atau melanjutkan studi.',
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ]);
    }

    public function down(): void
    {
        Schema::dropIfExists('magang_jepang_alasan');
    }
};