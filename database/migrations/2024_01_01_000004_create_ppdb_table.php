<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('ppdb', function (Blueprint $table) {
            $table->id();
            $table->string('nomor_pendaftaran', 50);
            $table->string('nama', 100);
            $table->string('nisn', 10);
            $table->string('asal_sekolah', 100);
            $table->enum('jenis_kelamin', ['Laki-laki', 'Perempuan']);
            $table->string('email', 100);
            $table->string('telepon', 15);
            $table->string('pilihan1', 10);
            $table->string('pilihan2', 10);
            $table->text('alamat');
            $table->timestamp('created_at')->nullable()->useCurrent();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ppdb');
    }
};
