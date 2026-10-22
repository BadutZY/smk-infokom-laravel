<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('magang_jepang', function (Blueprint $table) {
            $table->id();
            $table->string('nama', 150);
            $table->string('handle', 100)->nullable();      // username Instagram tanpa @
            $table->string('kota', 100)->nullable();
            $table->string('angkatan', 50)->nullable();
            $table->text('catatan')->nullable();

            // Satu kartu hanya boleh punya SATU jenis media:
            // foto | video_lokal | youtube | instagram
            $table->string('jenis_media', 20)->default('foto');
            $table->string('media_path', 255)->nullable();  // file upload (foto / video_lokal)
            $table->string('media_ref', 255)->nullable();   // id YouTube atau "reel/KODE" Instagram
            $table->string('sampul', 255)->nullable();      // gambar sampul opsional untuk kartu video

            $table->unsignedTinyInteger('tema')->default(0); // variasi warna kartu (0, 1, 2)
            $table->integer('urutan')->default(0);
            $table->timestamps();
        });

        // Data awal: 3 alumni yang sudah tampil di halaman publik.
        $now = now();
        DB::table('magang_jepang')->insert([
            [
                'nama' => 'Surya Difraja',
                'handle' => '_.prajaa',
                'kota' => 'Tokyo',
                'angkatan' => 'Angkatan XVII',
                'catatan' => 'Selamat sampai Negeri Sakura (Tokyo) & betah-betah disana. Terbang tinggi menembus batas untuk mengejar cita-cita dan masa depanmu yang manis.',
                'jenis_media' => 'instagram',
                'media_ref' => 'reel/DZE77u4oNN_',
                'tema' => 0,
                'urutan' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'nama' => 'Irfan Rizqullah',
                'handle' => 'fanrzqlh',
                'kota' => 'Negeri Sakura',
                'angkatan' => 'Angkatan XVII',
                'catatan' => 'Selamat sampai Negeri Sakura & betah-betah disana. Terima kasih telah membanggakan almamatermu, nak!',
                'jenis_media' => 'instagram',
                'media_ref' => 'reel/DTfPQPRkkAq',
                'tema' => 1,
                'urutan' => 2,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'nama' => 'Nazib Sopian',
                'handle' => 'naziburaongs',
                'kota' => 'Negeri Sakura',
                'angkatan' => 'Angkatan XVII',
                'catatan' => 'Selamat sampai Negeri Sakura & betah-betah disana. Terbang tinggi untuk mengejar cita-cita dan masa depanmu yang manis.',
                'jenis_media' => 'instagram',
                'media_ref' => 'reel/DWjaMP3CEID',
                'tema' => 2,
                'urutan' => 3,
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ]);
    }

    public function down(): void
    {
        Schema::dropIfExists('magang_jepang');
    }
};