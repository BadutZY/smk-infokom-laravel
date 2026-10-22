<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Sebelumnya bagian "Apa Saja yang BKK Bantu?" pada halaman publik BKK
     * berupa array statis di Blade. Dipindahkan ke database supaya bisa
     * dikelola dari panel admin: BKK > tab "Layanan BKK".
     */
    public function up(): void
    {
        Schema::create('bkk_layanan', function (Blueprint $table) {
            $table->id();
            $table->integer('urutan')->default(0);
            $table->string('icon', 50);
            $table->string('judul', 150);
            $table->text('deskripsi');
            $table->timestamps();
        });

        $now = now();
        DB::table('bkk_layanan')->insert([
            [
                'urutan' => 1,
                'icon' => 'megaphone',
                'judul' => 'Info Lowongan Kerja',
                'deskripsi' => 'Menghimpun dan menyebarkan informasi lowongan kerja terpercaya dari berbagai mitra industri.',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'urutan' => 2,
                'icon' => 'users',
                'judul' => 'Bimbingan Karier',
                'deskripsi' => 'Konseling dan pembekalan agar siswa/alumni siap menghadapi dunia kerja, mulai dari CV hingga wawancara.',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'urutan' => 3,
                'icon' => 'shield-check',
                'judul' => 'Penyaluran Tenaga Kerja',
                'deskripsi' => 'Menjembatani dan menyalurkan lulusan ke perusahaan/industri yang membutuhkan tenaga kerja.',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'urutan' => 4,
                'icon' => 'building',
                'judul' => 'Kerja Sama Industri',
                'deskripsi' => 'Membangun kemitraan berkelanjutan dengan perusahaan untuk membuka lebih banyak peluang kerja bagi alumni.',
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ]);
    }

    public function down(): void
    {
        Schema::dropIfExists('bkk_layanan');
    }
};