<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Tabel-tabel ini menyimpan konten yang sebelumnya berupa data statis
     * di config/site.php (halaman Profil & Akademik), supaya bisa dikelola dari database.
     */
    public function up(): void
    {
        // Data utama sekolah (satu baris/singleton): identitas, kontak, visi, gambar, dan total biaya PPDB.
        Schema::create('profil_sekolah', function (Blueprint $table) {
            $table->id();
            $table->string('nama', 200);
            $table->string('nama_singkat', 100);
            $table->string('brand_atas', 100);
            $table->string('brand_bawah', 100);
            $table->text('tagline');
            $table->text('alamat');
            $table->string('telepon', 50);
            $table->string('whatsapp', 100);
            $table->string('email', 100);
            $table->string('jam_operasional', 100);
            $table->string('kepala_sekolah', 150);
            $table->text('visi');
            $table->string('gambar_hero', 255)->nullable();
            $table->string('gambar_siswa', 255)->nullable();
            $table->unsignedBigInteger('total_biaya_gelombang1')->default(0);
            $table->unsignedBigInteger('total_biaya_gelombang2')->default(0);
            $table->unsignedBigInteger('total_biaya_gelombang3')->default(0);
            $table->timestamps();
        });

        Schema::create('misi', function (Blueprint $table) {
            $table->id();
            $table->integer('urutan')->default(0);
            $table->text('isi');
            $table->timestamps();
        });

        Schema::create('tujuan', function (Blueprint $table) {
            $table->id();
            $table->integer('urutan')->default(0);
            $table->text('isi');
            $table->timestamps();
        });

        Schema::create('stats', function (Blueprint $table) {
            $table->id();
            $table->integer('urutan')->default(0);
            $table->unsignedInteger('value');
            $table->string('suffix', 10)->nullable();
            $table->string('label', 100);
            $table->string('icon', 50);
            $table->timestamps();
        });

        Schema::create('pengumuman', function (Blueprint $table) {
            $table->id();
            $table->integer('urutan')->default(0);
            $table->string('judul', 100);
            $table->text('teks');
            $table->string('tanggal', 50);
            $table->string('icon', 50);
            $table->timestamps();
        });

        Schema::create('jurusan', function (Blueprint $table) {
            $table->id();
            $table->integer('urutan')->default(0);
            $table->string('kode', 10);
            $table->string('nama', 150);
            $table->text('deskripsi');
            $table->string('gambar', 255);
            $table->json('poin');
            $table->timestamps();
        });

        Schema::create('fasilitas', function (Blueprint $table) {
            $table->id();
            $table->integer('urutan')->default(0);
            $table->string('judul', 150);
            $table->text('deskripsi');
            $table->timestamps();
        });

        Schema::create('ppdb_langkah', function (Blueprint $table) {
            $table->id();
            $table->integer('urutan')->default(0);
            $table->string('nomor', 5);
            $table->string('judul', 100);
            $table->text('deskripsi');
            $table->timestamps();
        });

        Schema::create('ppdb_jadwal', function (Blueprint $table) {
            $table->id();
            $table->integer('urutan')->default(0);
            $table->string('periode', 100);
            $table->string('agenda', 150);
            $table->timestamps();
        });

        Schema::create('ppdb_syarat', function (Blueprint $table) {
            $table->id();
            $table->integer('urutan')->default(0);
            $table->string('isi', 255);
            $table->timestamps();
        });

        Schema::create('ppdb_biaya', function (Blueprint $table) {
            $table->id();
            $table->integer('urutan')->default(0);
            $table->string('jenis', 150);
            $table->unsignedBigInteger('gelombang1');
            $table->unsignedBigInteger('gelombang2');
            $table->unsignedBigInteger('gelombang3');
            $table->timestamps();
        });

        Schema::create('kalender_akademik', function (Blueprint $table) {
            $table->id();
            $table->integer('urutan')->default(0);
            $table->string('periode', 100);
            $table->string('agenda', 150);
            $table->timestamps();
        });

        Schema::create('ekstrakurikuler', function (Blueprint $table) {
            $table->id();
            $table->integer('urutan')->default(0);
            $table->string('nama', 100);
            $table->string('icon', 50)->default('sparkles');
            $table->string('deskripsi', 255)->nullable();
            $table->timestamps();
        });

        Schema::create('faq', function (Blueprint $table) {
            $table->id();
            $table->integer('urutan')->default(0);
            $table->string('pertanyaan', 255);
            $table->text('jawaban');
            $table->timestamps();
        });

        Schema::create('galeri', function (Blueprint $table) {
            $table->id();
            $table->integer('urutan')->default(0);
            $table->string('sumber', 255);
            $table->string('judul', 150);
            $table->string('kategori', 50);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('galeri');
        Schema::dropIfExists('faq');
        Schema::dropIfExists('ekstrakurikuler');
        Schema::dropIfExists('kalender_akademik');
        Schema::dropIfExists('ppdb_biaya');
        Schema::dropIfExists('ppdb_syarat');
        Schema::dropIfExists('ppdb_jadwal');
        Schema::dropIfExists('ppdb_langkah');
        Schema::dropIfExists('fasilitas');
        Schema::dropIfExists('jurusan');
        Schema::dropIfExists('pengumuman');
        Schema::dropIfExists('stats');
        Schema::dropIfExists('tujuan');
        Schema::dropIfExists('misi');
        Schema::dropIfExists('profil_sekolah');
    }
};
