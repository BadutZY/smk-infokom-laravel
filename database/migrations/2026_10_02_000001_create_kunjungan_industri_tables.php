<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Halaman publik "Kunjungan Industri" (/kunjungan-industri).
     *
     * - kunjungan_industri_info   : 1 baris, teks pengantar + periode + kota tujuan
     * - kunjungan_industri        : lokasi yang dikunjungi (Amikom, Lava Tour, dst.)
     * - kunjungan_industri_foto   : foto-foto tiap lokasi (banyak foto per lokasi)
     * - kunjungan_industri_video  : video dokumentasi (OPSIONAL: upload / embed link)
     */
    public function up(): void
    {
        Schema::create('kunjungan_industri_info', function (Blueprint $table) {
            $table->id();
            $table->string('judul', 150);
            $table->string('periode', 100)->nullable();
            $table->string('kota_tujuan', 100)->nullable();
            $table->text('intro')->nullable();
            $table->timestamps();
        });

        Schema::create('kunjungan_industri', function (Blueprint $table) {
            $table->id();
            $table->string('nama', 150);
            $table->string('kategori', 80)->nullable();
            $table->string('icon', 50)->default('map-pin');
            $table->string('kota', 150)->nullable();
            $table->text('deskripsi')->nullable();
            $table->text('sorotan')->nullable(); // satu poin per baris
            $table->integer('urutan')->default(0);
            $table->timestamps();
        });

        Schema::create('kunjungan_industri_foto', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kunjungan_industri_id')->constrained('kunjungan_industri')->cascadeOnDelete();
            $table->string('path', 255);
            $table->string('keterangan', 200)->nullable();
            $table->integer('urutan')->default(0);
            $table->timestamps();
        });

        Schema::create('kunjungan_industri_video', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kunjungan_industri_id')->nullable()->constrained('kunjungan_industri')->nullOnDelete();
            $table->string('judul', 150);
            $table->text('deskripsi')->nullable();
            $table->string('jenis', 20)->default('embed');      // lokal | embed
            $table->string('provider', 20)->nullable();         // youtube, vimeo, instagram, tiktok, facebook, gdrive, file, lainnya
            $table->string('rasio', 20)->default('landscape');  // landscape (16:9) | portrait (9:16)
            $table->string('media_path', 255)->nullable();      // file video upload
            $table->text('embed_url')->nullable();              // alamat yang dimuat di pemutar
            $table->text('source_url')->nullable();             // link asli (untuk tombol "buka di sumber")
            $table->string('sampul', 255)->nullable();          // gambar sampul (opsional)
            $table->integer('urutan')->default(0);
            $table->timestamps();
        });

        // ------------------------------------------------------------------
        // Data awal: Kunjungan Industri SMK INFOKOM ke Yogyakarta.
        // Foto diarahkan ke public/images/kunjungan-industri/ (taruh file foto
        // di folder tersebut dengan nama yang sama), atau ganti lewat admin.
        // ------------------------------------------------------------------
        $now = now();

        DB::table('kunjungan_industri_info')->insert([
            'judul' => 'Kunjungan Industri ke Yogyakarta',
            'periode' => '19-22 Februari 2025',
            'kota_tujuan' => 'Yogyakarta',
            'intro' => 'Kunjungan industri adalah kegiatan belajar di luar kelas agar siswa melihat langsung dunia kampus, industri, dan lingkungan sekitar. Pada kegiatan ini, keluarga besar SMK INFOKOM Bogor berangkat ke Yogyakarta untuk menambah wawasan, memperluas pengalaman, dan mempererat kebersamaan.',
            'created_at' => $now,
            'updated_at' => $now,
        ]);

        $lokasi = [
            [
                'nama' => 'Universitas Amikom',
                'kategori' => 'Perguruan Tinggi',
                'icon' => 'school',
                'kota' => 'Yogyakarta',
                'deskripsi' => 'Siswa berkunjung ke Universitas Amikom Yogyakarta, kampus yang dikenal kuat di bidang teknologi informasi dan ekonomi kreatif. Kegiatan diisi dengan sesi pemaparan di auditorium, pengenalan kampus, dan foto bersama di area Amikom Creative Economy Park, sehingga siswa mendapat gambaran tentang kelanjutan studi dan peluang karier di dunia digital.',
                'sorotan' => "Sesi pemaparan di auditorium\nMengenal Amikom Creative Economy Park\nWawasan kelanjutan studi & karier",
                'urutan' => 1,
                'fotos' => [
                    ['Amikom-1.jpg', 'Sesi bersama pihak Universitas Amikom'],
                    ['Amikom-2.jpg', 'Suasana pemaparan di auditorium kampus'],
                    ['Amikom-3.jpg', 'Di depan gedung Universitas Amikom Yogyakarta'],
                    ['Amikom-4.jpg', 'Foto bersama di Amikom Creative Economy Park'],
                ],
            ],
            [
                'nama' => 'Lava Tour Merapi',
                'kategori' => 'Wisata Edukasi',
                'icon' => 'trees',
                'kota' => 'Lereng Gunung Merapi, Yogyakarta',
                'deskripsi' => 'Lava Tour Merapi mengajak siswa menjelajahi lereng Gunung Merapi dan melihat langsung jejak erupsi yang membentuk lanskap sekitarnya. Selain menyenangkan, kegiatan ini menjadi pelajaran tentang alam, kebencanaan, dan ketangguhan masyarakat yang hidup di kaki gunung.',
                'sorotan' => "Menjelajah lereng Gunung Merapi\nBelajar jejak erupsi & alam\nKebersamaan antar siswa",
                'urutan' => 2,
                'fotos' => [
                    ['Lava-Tour-1.jpg', 'Foto bersama di lereng Merapi'],
                ],
            ],
            [
                'nama' => 'Museum Mini Sisa Hartaku',
                'kategori' => 'Museum',
                'icon' => 'building',
                'kota' => 'Sleman, Yogyakarta',
                'deskripsi' => 'Museum Mini Sisa Hartaku menyimpan benda-benda peninggalan warga yang selamat dari erupsi Merapi. Di sini siswa belajar menghargai kehidupan, memahami dampak bencana, dan menumbuhkan rasa empati terhadap sesama.',
                'sorotan' => "Koleksi peninggalan erupsi Merapi\nPelajaran empati & kepedulian\nDokumentasi kebersamaan siswa",
                'urutan' => 3,
                'fotos' => [
                    ['Sisa-Hartaku-1.jpg', 'Foto bersama di Museum Mini Sisa Hartaku'],
                    ['Sisa-Hartaku-2.jpg', 'Siswa SMK INFOKOM di Museum Mini Sisa Hartaku'],
                ],
            ],
        ];

        foreach ($lokasi as $row) {
            $fotos = $row['fotos'];
            unset($row['fotos']);
            $id = DB::table('kunjungan_industri')->insertGetId($row + ['created_at' => $now, 'updated_at' => $now]);

            foreach ($fotos as $i => [$file, $ket]) {
                DB::table('kunjungan_industri_foto')->insert([
                    'kunjungan_industri_id' => $id,
                    'path' => 'images/kunjungan-industri/'.$file,
                    'keterangan' => $ket,
                    'urutan' => $i + 1,
                    'created_at' => $now,
                    'updated_at' => $now,
                ]);
            }
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('kunjungan_industri_video');
        Schema::dropIfExists('kunjungan_industri_foto');
        Schema::dropIfExists('kunjungan_industri');
        Schema::dropIfExists('kunjungan_industri_info');
    }
};