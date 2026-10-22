<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('bkk_media', function (Blueprint $table) {
            $table->id();
            $table->string('judul', 150);
            $table->text('keterangan')->nullable();

            // Satu kartu hanya boleh punya SATU jenis media:
            // foto | video_lokal | youtube | instagram
            $table->string('jenis_media', 20)->default('instagram');
            $table->string('media_path', 255)->nullable();  // file upload (foto / video_lokal)
            $table->string('media_ref', 255)->nullable();   // id YouTube atau "reel/KODE" Instagram
            $table->string('sampul', 255)->nullable();      // gambar sampul opsional untuk kartu video

            $table->unsignedTinyInteger('tema')->default(0); // variasi warna kartu (0, 1, 2)
            $table->integer('urutan')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('bkk_media');
    }
};