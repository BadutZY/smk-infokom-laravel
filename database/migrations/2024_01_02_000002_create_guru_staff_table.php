<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('guru_staff', function (Blueprint $table) {
            $table->id();
            $table->string('nama_lengkap', 150);
            $table->string('foto', 255)->nullable();
            $table->string('mata_pelajaran', 150);
            $table->integer('urutan')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('guru_staff');
    }
};
