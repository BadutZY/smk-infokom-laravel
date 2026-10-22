<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Sebelumnya bagian "Prestasi di Berbagai Bidang" pada halaman publik
     * Prestasi berupa array statis di Blade. Dipindahkan ke database supaya
     * bisa dikelola (tambah/ubah/hapus) dari panel admin: Konten Website >
     * Bidang Prestasi.
     */
    public function up(): void
    {
        Schema::create('prestasi_bidang', function (Blueprint $table) {
            $table->id();
            $table->integer('urutan')->default(0);
            $table->string('icon', 50);
            $table->string('judul', 150);
            $table->text('deskripsi');
            $table->timestamps();
        });

        $now = now();
        DB::table('prestasi_bidang')->insert([
            [
                'urutan' => 1,
                'icon' => 'book-open',
                'judul' => 'Akademik & Sains',
                'deskripsi' => 'Olimpiade sains, karya ilmiah, dan kompetisi riset tingkat kota hingga nasional.',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'urutan' => 2,
                'icon' => 'activity',
                'judul' => 'Olahraga',
                'deskripsi' => 'Futsal, handball, bulu tangkis, dan berbagai cabang olahraga kompetitif lainnya.',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'urutan' => 3,
                'icon' => 'graduation-cap',
                'judul' => 'Bahasa & Budaya',
                'deskripsi' => 'Kompetisi bahasa asing seperti Bahasa Jepang dan festival budaya antarsekolah.',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'urutan' => 4,
                'icon' => 'code',
                'judul' => 'Digital & E-Sport',
                'deskripsi' => 'Kompetisi e-sport dan ajang kreativitas teknologi digital siswa.',
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ]);
    }

    public function down(): void
    {
        Schema::dropIfExists('prestasi_bidang');
    }
};