<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Sebelumnya kartu "Kenapa follow" (Info Loker Real-Time, Jadwal
     * Kegiatan, Kisah Sukses Alumni) pada bagian "Update Info Loker via
     * Instagram" berupa array statis di Blade. Dipindahkan ke database
     * supaya bisa dikelola dari panel admin: BKK > tab "Alasan Follow IG".
     */
    public function up(): void
    {
        Schema::create('bkk_follow', function (Blueprint $table) {
            $table->id();
            $table->integer('urutan')->default(0);
            $table->string('icon', 50);
            $table->string('judul', 150);
            $table->text('deskripsi');
            $table->timestamps();
        });

        $now = now();
        DB::table('bkk_follow')->insert([
            [
                'urutan' => 1,
                'icon' => 'bell',
                'judul' => 'Info Loker Real-Time',
                'deskripsi' => 'Jadi yang pertama tahu saat ada lowongan kerja baru dari mitra industri BKK.',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'urutan' => 2,
                'icon' => 'calendar-days',
                'judul' => 'Jadwal Kegiatan',
                'deskripsi' => 'Pantau jadwal pembekalan, walk-in interview, dan job fair yang diadakan BKK.',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'urutan' => 3,
                'icon' => 'star',
                'judul' => 'Kisah Sukses Alumni',
                'deskripsi' => 'Lihat cerita alumni yang berhasil disalurkan dan diterima bekerja.',
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ]);
    }

    public function down(): void
    {
        Schema::dropIfExists('bkk_follow');
    }
};