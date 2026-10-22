<?php

return [

    // Menu navigasi (mengikuti struktur route aplikasi).
    'nav_links' => [
        ['to' => '/', 'label' => 'Beranda'],
        [
            'label' => 'Profil',
            // Menu dropdown: Profil Sekolah (sejarah, visi, misi) & Fasilitas.
            'children' => [
                ['to' => '/profil', 'label' => 'Profil Sekolah', 'icon' => 'building', 'desc' => 'Sejarah, visi, misi & tujuan sekolah'],
                ['to' => '/fasilitas', 'label' => 'Fasilitas', 'icon' => 'school', 'desc' => 'Sarana & prasarana penunjang belajar'],
            ],
        ],
        ['to' => '/akademik', 'label' => 'Akademik'],
        ['to' => '/guru-staff', 'label' => 'Guru & Staff'],
        ['to' => '/berita', 'label' => 'Berita'],
        ['to' => '/galeri', 'label' => 'Galeri'],
        [
            'label' => 'Prestasi & Karier',
            // Menu dropdown: mencakup beberapa halaman sekaligus (Prestasi Sekolah,
            // Magang Jepang, Kunjungan Industri, & BKK) tanpa perlu ditampilkan terpisah di navbar utama.
            'children' => [
                ['to' => '/bkk', 'label' => 'BKK', 'icon' => 'briefcase', 'desc' => 'Info loker & penyaluran kerja alumni'],
                ['to' => '/magang-jepang', 'label' => 'Magang Jepang', 'icon' => 'award', 'desc' => 'Kisah alumni magang ke Jepang'],
                ['to' => '/prestasi', 'label' => 'Prestasi Sekolah', 'icon' => 'trophy', 'desc' => 'Torehan juara siswa & tim'],
                ['to' => '/kunjungan-industri', 'label' => 'Kunjungan Industri', 'icon' => 'map-pin', 'desc' => 'Dokumentasi kunjungan ke kampus & industri'],
            ],
        ],
        ['to' => '/ppdb', 'label' => 'PPDB'],
        ['to' => '/kontak', 'label' => 'Kontak'],
    ],

    'kategori_berita' => ['Akademik', 'Kegiatan', 'Kesiswaan', 'Prestasi', 'Pengumuman'],

    // Warna identitas tiap jurusan (dipakai sebagai border luar kartu jurusan).
    // Nilai ini hanya BAWAAN: admin bisa mengubahnya kapan saja lewat
    // Admin > Akademik > Kompetensi Keahlian (Jurusan) > kolom "Warna Identitas".
    // Kunci = kode jurusan (huruf besar). Jurusan baru yang belum punya warna
    // akan otomatis memakai 'jurusan_warna_cadangan' secara bergiliran.
    'jurusan_warna_default' => [
        'TKJ' => '#BD0AA2',
        'RPL' => '#E0201B',
        'DKV' => '#FF6A13',
        'PSPT' => '#F2C200',
    ],
    'jurusan_warna_cadangan' => ['#2563EB', '#0EA5A4', '#7C3AED', '#16A34A', '#DB2777', '#EA580C'],

    // Kode rahasia untuk fitur "Lupa Password" admin. Ganti lewat file .env (RECOVERY_CODE=...)
    'recovery_code' => env('RECOVERY_CODE', 'INFOKOM-BOGOR-2025'),
];