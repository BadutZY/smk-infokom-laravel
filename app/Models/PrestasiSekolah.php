<?php

namespace App\Models;

use App\Support\Site;
use Illuminate\Database\Eloquent\Model;

class PrestasiSekolah extends Model
{
    protected $table = 'prestasi_sekolah';

    /**
     * Kolom `foto` ditambahkan oleh migration
     * 2026_10_01_000001_add_foto_to_prestasi_sekolah_table.php.
     */
    protected $fillable = [
        'kelompok', 'nama_siswa', 'nama_kejuaraan', 'juara',
        'peringkat', 'tingkat', 'kategori', 'tahun', 'foto', 'urutan',
    ];

    /** Pilihan peringkat/medali (dipakai untuk lencana warna & statistik). */
    public const PERINGKAT = [
        'emas' => 'Juara 1 / Medali Emas',
        'perak' => 'Juara 2 / Medali Perak',
        'perunggu' => 'Juara 3 / Medali Perunggu',
        'lainnya' => 'Penghargaan Lain / Harapan',
    ];

    /** Pilihan bidang/kategori lomba (dipakai untuk filter di halaman publik). */
    public const KATEGORI = [
        'Akademik & Sains',
        'Olahraga',
        'Bahasa & Budaya',
        'Digital & Teknologi',
        'Baris-Berbaris',
        'Seni & Kreativitas',
        'Lainnya',
    ];

    public function peringkatLabel(): string
    {
        return self::PERINGKAT[$this->peringkat] ?? self::PERINGKAT['lainnya'];
    }

    public function peringkatIcon(): string
    {
        return match ($this->peringkat) {
            'emas' => 'trophy',
            'perak' => 'award',
            'perunggu' => 'award',
            default => 'star',
        };
    }

    /** Kelas warna tema lencana peringkat (dipetakan lewat CSS var di halaman publik). */
    public function peringkatTema(): string
    {
        return match ($this->peringkat) {
            'emas' => 'emas',
            'perak' => 'perak',
            'perunggu' => 'perunggu',
            default => 'lainnya',
        };
    }

    /** Bobot peringkat untuk mengurutkan prestasi (emas paling tinggi). */
    public function peringkatRank(): int
    {
        return match ($this->peringkat) {
            'emas' => 3,
            'perak' => 2,
            'perunggu' => 1,
            default => 0,
        };
    }

    /** Bobot tingkat lomba untuk mengurutkan prestasi (internasional paling tinggi). */
    public function tingkatRank(): int
    {
        $tingkat = mb_strtolower(trim((string) $this->tingkat));

        return match (true) {
            str_contains($tingkat, 'internasional') => 4,
            str_contains($tingkat, 'nasional') => 3,
            str_contains($tingkat, 'provinsi') => 2,
            $tingkat !== '' => 1,
            default => 0,
        };
    }

    public function kategoriIcon(): string
    {
        return match ($this->kategori) {
            'Akademik & Sains' => 'book-open',
            'Olahraga' => 'activity',
            'Bahasa & Budaya' => 'graduation-cap',
            'Digital & Teknologi' => 'code',
            'Baris-Berbaris' => 'shield-check',
            'Seni & Kreativitas' => 'palette',
            default => 'sparkles',
        };
    }

    public function initials(): string
    {
        $kata = array_values(array_filter(preg_split('/[\s,&]+/', trim($this->nama_siswa)) ?: []));
        $inisial = collect($kata)->take(2)->map(fn ($w) => mb_strtoupper(mb_substr($w, 0, 1)))->implode('');

        return $inisial !== '' ? $inisial : '?';
    }

    /**
     * Daftar nama pada kolom `nama_siswa`. Beberapa nama dipisah koma atau "&",
     * contoh: "Rafisha, Mario & Alif" -> ['Rafisha', 'Mario', 'Alif'].
     *
     * @return array<int, string>
     */
    public function anggota(): array
    {
        $bagian = preg_split('/\s*(?:,|&)\s*/u', trim((string) $this->nama_siswa)) ?: [];

        return array_values(array_filter(array_map('trim', $bagian), fn ($nama) => $nama !== ''));
    }

    /** True bila baris ini milik tim (diawali "Tim" atau berisi lebih dari satu nama). */
    public function isTim(): bool
    {
        return count($this->anggota()) > 1
            || preg_match('/^tim\b/iu', trim((string) $this->nama_siswa)) === 1;
    }

    /** URL foto siswa/tim, atau null bila belum ada foto. */
    public function fotoUrl(): ?string
    {
        return $this->foto ? Site::imageUrl($this->foto) : null;
    }
}