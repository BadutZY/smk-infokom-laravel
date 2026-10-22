# Website Sekolah SMK INFOKOM Kota Bogor (Laravel 13)

Website ini adalah hasil migrasi dari versi React + PHP native ke **Laravel 13**
(Blade + Tailwind CSS v4 + Vite), lengkap dengan panel admin.

Tampilan, fitur, dan alur (PPDB, Berita, Galeri, Kontak, Login Admin, CRUD
Berita, Data PPDB, Pesan Masuk, Ganti Password) dibuat semirip mungkin dengan
versi React sebelumnya, namun kini backend-nya memakai Laravel + MySQL
(phpMyAdmin), bukan lagi file PHP native terpisah.

---

## 1. Yang perlu disiapkan

- **XAMPP** (Apache + MySQL + phpMyAdmin) - https://www.apachefriends.org
- **PHP 8.3 atau lebih baru** (sudah termasuk di XAMPP terbaru)
- **Composer** - https://getcomposer.org/download/
- **Node.js 18+ dan NPM** - https://nodejs.org (untuk build tampilan Tailwind)

> Folder ini **belum** berisi folder `vendor/` (dependensi PHP Laravel) dan
> `node_modules/` (dependensi Tailwind/Vite), karena keduanya diunduh otomatis
> lewat Composer dan NPM. Ini normal dan wajib dilakukan sekali di awal.

---

## 2. Cara Menjalankan (XAMPP + phpMyAdmin)

### Langkah 1 - Salin folder project

Ekstrak folder hasil unduhan ini ke mana saja di komputer Anda, **tidak wajib**
di dalam `htdocs` (berbeda dengan PHP native, Laravel dijalankan lewat
`php artisan serve`, bukan diakses langsung lewat folder htdocs).

Contoh: `D:\project\sekolah-laravel\`

### Langkah 2 - Install dependensi PHP (Composer)

Buka terminal / CMD di dalam folder project, lalu jalankan:

```bash
composer install
```

Tunggu sampai proses selesai (mengunduh Laravel Framework beserta seluruh
dependensinya).

### Langkah 3 - Salin file environment

```bash
copy .env.example .env      # Windows (CMD)
# atau
cp .env.example .env        # Mac / Linux / Git Bash
```

Lalu generate application key:

```bash
php artisan key:generate
```

### Langkah 4 - Buat database lewat phpMyAdmin

1. Jalankan **Apache** dan **MySQL** dari XAMPP Control Panel.
2. Buka `http://localhost/phpmyadmin`.
3. Klik **New / Baru**, buat database dengan nama persis: `sekolah_db`
   (atau nama lain, asal disesuaikan juga di file `.env`).
4. Tidak perlu import tabel manual - tabel akan dibuat otomatis lewat
   migration Laravel di langkah berikutnya.

File `.env` sudah diatur secara default untuk XAMPP standar:

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=sekolah_db
DB_USERNAME=root
DB_PASSWORD=
```

Jika password MySQL XAMPP Anda **bukan kosong**, sesuaikan `DB_PASSWORD` di
file `.env`.

### Langkah 5 - Jalankan migration + seeder (buat tabel & data awal)

```bash
php artisan migrate --seed
```

Perintah ini akan membuat seluruh tabel (`admins`, `berita`, `berita_foto`,
`ppdb`, `pesan_kontak`) sekaligus mengisi:

- 1 akun admin default
- 4 contoh berita

### Langkah 6 - Hubungkan folder upload foto

```bash
php artisan storage:link
```

Perintah ini wajib dijalankan agar foto berita yang diunggah admin bisa
tampil di browser.

### Langkah 7 - Install dependensi tampilan (Tailwind CSS via NPM)

```bash
npm install
npm run build
```

`npm run build` akan mengompilasi Tailwind CSS + JavaScript menjadi file
final di folder `public/build`. Jalankan ulang perintah ini setiap kali Anda
mengubah file di `resources/css` atau `resources/js`.

Untuk mode pengembangan (tampilan otomatis update saat file diubah), gunakan:

```bash
npm run dev
```

(jalankan di terminal terpisah, biarkan tetap berjalan)

### Langkah 8 - Jalankan server Laravel

```bash
php artisan serve
```

Buka browser ke:

```
http://localhost:8000
```

---

## 3. Login Admin

```
URL      : http://localhost:8000/login
Username : admin
Password : admin123
```

**Sangat disarankan** langsung login lalu ganti password lewat menu
**Pengaturan** di panel admin.

Fitur **Lupa Password** admin menggunakan "kode pemulihan" (bukan email),
karena tidak semua instalasi XAMPP dikonfigurasi untuk mengirim email. Kode
pemulihan default ada di file `.env`:

```
RECOVERY_CODE=INFOKOM-BOGOR-2025
```

Silakan ganti kode ini dengan kode rahasia Anda sendiri sebelum website
digunakan secara nyata.

---

## 4. Struktur Halaman

### Halaman Publik
| URL | Keterangan |
|---|---|
| `/` | Beranda |
| `/profil` | Profil sekolah (visi misi, tujuan, struktur organisasi) |
| `/akademik` | Kompetensi keahlian, kalender akademik, ekskul, FAQ |
| `/berita` | Daftar berita (bisa difilter per kategori) |
| `/berita/{slug}` | Detail berita |
| `/galeri` | Galeri foto |
| `/ppdb` | Info & formulir Penerimaan Peserta Didik Baru |
| `/kontak` | Formulir kontak + peta lokasi |
| `/login` | Login admin |
| `/lupa-password` | Reset password admin (via kode pemulihan) |

### Panel Admin (perlu login)
| URL | Keterangan |
|---|---|
| `/admin` | Dashboard (statistik + grafik) |
| `/admin/berita` | Kelola berita (tambah, edit, hapus, upload foto) |
| `/admin/ppdb` | Data pendaftar PPDB |
| `/admin/pesan` | Pesan masuk dari formulir kontak |
| `/admin/pengaturan` | Ganti password admin |

---

## 5. Struktur Data & Konten Statis

Sebagian konten (info sekolah, visi misi, daftar jurusan, FAQ, biaya PPDB,
galeri, dan lain-lain) disimpan sebagai data statis di:

```
config/site.php
```

Silakan edit file ini langsung untuk mengubah teks-teks tersebut (tidak
perlu lewat database), lalu jalankan:

```bash
php artisan config:clear
```

Sedangkan konten yang dikelola lewat panel admin (Berita, data PPDB, Pesan
Kontak) tersimpan di database MySQL lewat tabel:

- `berita`, `berita_foto`
- `ppdb`
- `pesan_kontak`
- `admins`

---

## 6. Catatan Migrasi dari Versi React + PHP

- Backend PHP native (`sekolah-api/*.php`) digantikan penuh oleh Controller
  dan Model Laravel (`app/Http/Controllers`, `app/Models`).
- Autentikasi admin memakai sistem session bawaan Laravel (Eloquent
  Authenticatable), bukan lagi PHP session manual.
- Animasi yang sebelumnya memakai Framer Motion (React) kini digantikan
  dengan CSS transition + `IntersectionObserver` (reveal saat scroll) di
  `resources/js/app.js`, agar tetap terasa halus tanpa memerlukan React.
- Struktur tabel database (lihat `database/migrations/`) dibuat mengikuti
  struktur tabel pada `database.sql` versi PHP native sebelumnya.

---

## 7. Build untuk Produksi (opsional)

Jika website akan dipakai secara nyata (bukan hanya localhost), jalankan:

```bash
npm run build
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

Dan pastikan `APP_ENV=production` serta `APP_DEBUG=false` di file `.env`.

---

## 8. Masalah Umum

**"could not find driver" saat migrate**
Aktifkan ekstensi `pdo_mysql` di `php.ini` (biasanya sudah aktif di XAMPP).

**Foto berita tidak muncul**
Pastikan sudah menjalankan `php artisan storage:link`.

**Tampilan Tailwind tidak berubah setelah edit CSS**
Jalankan ulang `npm run build`, atau gunakan `npm run dev` saat sedang
mengembangkan.

**Halaman blank / error 500**
Cek `storage/logs/laravel.log` untuk detail error, dan pastikan folder
`storage/` dan `bootstrap/cache/` memiliki izin tulis (write permission).
