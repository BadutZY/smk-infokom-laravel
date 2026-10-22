<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Sebelumnya bagian "Apa itu BKK?" dan kartu profil Instagram pada
     * halaman publik BKK berupa teks statis di Blade. Dipindahkan ke
     * database (satu baris/singleton, seperti profil_sekolah) supaya bisa
     * diubah dari panel admin: BKK > tab "Konten Umum & Instagram".
     */
    public function up(): void
    {
        Schema::create('bkk_konten', function (Blueprint $table) {
            $table->id();
            $table->text('apa_itu')->nullable();

            $table->string('ig_nama', 100)->default('BKK INFOKOM');
            $table->string('ig_username', 100)->default('bkkinfokom');
            $table->text('ig_bio')->nullable();
            $table->unsignedInteger('ig_kiriman')->default(0);
            $table->unsignedInteger('ig_pengikut')->default(0);
            $table->unsignedInteger('ig_diikuti')->default(0);
            $table->string('ig_url', 255)->nullable();

            $table->timestamps();
        });

        DB::table('bkk_konten')->insert([
            'apa_itu' => 'Bursa Kerja Khusus (BKK) INFOKOM adalah lembaga unit pelaksana di SMK INFOKOM yang memberikan pelayanan dan informasi lowongan kerja, bimbingan karier, serta penyaluran dan penempatan tenaga kerja bagi para lulusan SMK INFOKOM Kota Bogor.',
            'ig_nama' => 'BKK INFOKOM',
            'ig_username' => 'bkkinfokom',
            'ig_bio' => 'Info loker & penyaluran kerja alumni SMK INFOKOM Kota Bogor.',
            'ig_kiriman' => 108,
            'ig_pengikut' => 850,
            'ig_diikuti' => 8,
            'ig_url' => 'https://www.instagram.com/bkkinfokom/',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    public function down(): void
    {
        Schema::dropIfExists('bkk_konten');
    }
};