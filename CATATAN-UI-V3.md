# Catatan Perombakan UI v3

Perombakan tampilan seluruh halaman publik + kolom warna jurusan yang bisa diatur admin.
Sistem lama (animasi tirai halaman, partikel, reveal, tilt, kursor bercahaya, dll.) **tidak dihapus**;
lapisan baru ditambahkan di atasnya (`resources/css/ui-v3.css`, `resources/js/ui-v3.js`).

## Revisi: empat warna HANYA untuk jurusan
Sebelumnya empat warna jurusan ikut dipakai sebagai "spektrum" merek di seluruh situs. Sekarang aturannya:
**empat warna itu hanya tampil pada elemen jurusan; bagian lain memakai warna bawaan situs (navy + emas).**

- **Diganti ke emas/navy bawaan:** garis tipis di bawah hero semua halaman & di atas footer, garis atas kartu sambutan (Profil),
  garis bawah kartu Visi, penanda kecil di depan label judul (kicker), cincin berputar di foto hero Beranda (kini emas-cyan seperti cincin footer),
  busur di sudut hero halaman dalam (kini emas), dan bilah progres scroll di navbar (kembali ke gradien emas-cyan bawaan).
- **Tetap berwarna jurusan (memang untuk jurusan):** kartu jurusan (Beranda, Akademik, "Kompetensi Keahlian Lainnya"), bingkai foto & hero halaman detail jurusan
  (busur, garis bawah, penanda, cahaya latar), titik kecil pada chip jurusan di hero Beranda, dan titik pada daftar kompetensi keahlian di footer.
- Kelas CSS `spectrum-bar` / `spectrum-mark` / `ring-spectrum` dan variabel `--spectrum*` sudah dihapus (diganti `accent-bar` / `accent-mark` / `ring-gradient`),
  jadi tidak ada lagi yang menarik warna jurusan ke luar elemen jurusan.
- Setelah menimpa file: `php artisan view:clear`. Aset di `public/build` sudah dibangun ulang.

## Cara memasang
1. Timpa proyek Anda dengan isi zip ini.
2. Database sudah berisi data? Jalankan `php artisan migrate` (menambah kolom `warna` pada tabel `jurusan`
   dan mengisi warna bawaan; data lama aman). Instalasi baru: `php artisan migrate --seed` seperti biasa.
   Alternatif tanpa migrate: impor ulang `database/sekolah_db.sql` (sudah memuat kolom & warna).
3. Aset sudah ter-build di `public/build`. Jalankan `npm run build` lagi hanya bila mengubah `resources/css` / `resources/js`.

Tanpa langkah 2 situs tetap jalan (kartu memakai warna bawaan), hanya saja pilihan warna di admin belum bisa tersimpan;
form admin akan menampilkan pemberitahuan.

## Warna jurusan (yang Anda minta)
- Tiap kartu jurusan punya **border luar tipis berwarna identitas jurusan**; saat di-hover: naik, tepi menyala,
  cahaya tipis berputar mengitari tepi, dan sorotan lembut mengikuti kursor. Isi kartu tetap putih (warna tidak berlebihan).
- Dipakai di: Beranda, Akademik (bingkai kartu besar), Detail Jurusan (bingkai foto + aksen hero), "Jurusan lainnya", footer & chip hero (titik kecil).
- **Diatur admin:** Admin > Akademik > Kompetensi Keahlian (Jurusan) > tambah/edit > **Warna Identitas Jurusan**
  (pemilih warna, kode hex, 10 warna cepat, tombol *Otomatis*, dan pratinjau kartu langsung). Tabel jurusan menampilkan swatch warnanya.
- Warna bawaan diambil dari logo: TKJ `#BD0AA2`, RPL `#E0201B`, DKV `#FF6A13`, PSPT `#F2C200` (ubah di `config/site.php`).
  Jurusan baru yang belum diberi warna otomatis mendapat warna cadangan bergiliran.
- Warna jurusan tidak dipakai di luar elemen jurusan (lihat bagian Revisi di atas). Garis, penanda, dan cincin di bagian situs lain memakai emas bawaan.

## Perubahan per halaman
- **Beranda:** hero dengan bingkai foto bercincin emas-cyan, bar progres slide, tombol cepat ke tiap jurusan; statistik pita bersekat; kartu agenda;
  kartu jurusan berborder warna; berita ala portal (1 utama + daftar); slide ke-3 hero kini dibuat dari kode jurusan di database
  (sebelumnya teks tetap "MULTIMEDIA" padahal jurusannya DKV).
- **Profil:** foto sejarah berbingkai bergeser saat hover, sambutan kepala sekolah dengan panel foto, Visi sebagai pernyataan besar, Misi/Tujuan bernomor, kartu fasilitas.
- **Akademik:** kartu geser lama dipertahankan (border warna, watermark kode, petunjuk "arahkan kursor"); kalender akademik jadi garis waktu yang tergambar saat di-scroll; FAQ mulus.
- **Detail Jurusan:** hero beraksen warna jurusan + breadcrumb, bingkai foto berwarna, poin keunggulan, lingkup kerja, foto lab bisa diperbesar, jurusan lain sebagai kartu berborder warna.
- **Guru & Staff:** pencarian langsung (nama/jabatan) + filter kategori + penghitung, panel foto lembut, 2 kolom di ponsel (halaman ~55% lebih pendek).
- **Berita:** pencarian + filter kategori, kartu unggulan, estimasi waktu baca; artikel dengan tipografi lebih nyaman.
- **Galeri:** tata letak "bento", pencarian + filter, penampil foto dengan tombol sebelumnya/berikutnya, panah keyboard, dan geser jari.
- **Prestasi, BKK, Magang Jepang, PPDB, Kontak:** ikut memakai hero, judul section, footer, dan gerak baru.
- **Footer:** kolom kompetensi keahlian (dengan titik warna), CTA PPDB.

## Kehalusan & performa
- `SiteData::all()` sebelumnya dipanggil ulang untuk setiap view/ikon. Pada pengujian saya (SQLite, data dari sekolah_db.sql)
  Beranda memicu ±1.389 query dan halaman lain 600-1.350; sekarang **18-21 query per halaman** (waktu render 388 ms -> 55 ms untuk Beranda).
  Di MySQL selisihnya lebih terasa.
- Animasi `blur()` pada elemen yang masuk dihapus; grid HUD tidak lagi menganimasikan `background-position` (repaint tiap frame); garis pemindai hero dimatikan.
- Semua gerak menghormati `prefers-reduced-motion`.

## File
Baru: `resources/css/ui-v3.css`, `resources/js/ui-v3.js`, `resources/views/components/major-card.blade.php`,
`resources/views/admin/konten/_color-field.blade.php`, `database/migrations/2026_09_29_000001_add_warna_to_jurusan_table.php`.
Diubah: view halaman publik, `page-hero`, `section-title`, `layouts/app`, `partials/footer`, `resources/js/app.js` (slider hero + lightbox),
`Models/Jurusan`, `Support/SiteData`, `Support/KontenResource`, `Admin/KontenController`, `HomeController`, `config/site.php`, `database/sekolah_db.sql`, `public/build`.

## Catatan
- Teks di hero "Terakreditasi A" dan "90%+ Terserap" adalah bawaan kode lama dan tidak saya ubah; pastikan masih benar.
- Diuji di Chromium (desktop 1440 px & ponsel 390 px) dengan PHP 8.5 / Laravel 13.31 dan SQLite berisi data dari sekolah_db.sql:
  semua halaman publik, alur admin (simpan & reset warna), pencarian, lightbox, tanpa error JS dan tanpa geser horizontal di ponsel.
  **Belum diuji** di MySQL Anda, Safari, atau Firefox. Efek warna memakai `color-mix()`; browser sebelum 2023 hanya kehilangan border warna.
