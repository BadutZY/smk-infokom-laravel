<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Membuat akun admin default.
     * Username : admin
     * Password : admin123
     *
     * SANGAT DISARANKAN untuk langsung login lalu ganti password ini
     * lewat menu "Pengaturan" di panel admin.
     */
    public function run(): void
    {
        Admin::firstOrCreate(
            ['username' => 'admin'],
            [
                'password' => Hash::make('admin123'),
                'nama_lengkap' => 'Admin SMK INFOKOM',
            ]
        );
    }
}
