<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GuruStaff extends Model
{
    protected $table = 'guru_staff';

    protected $fillable = ['nama_lengkap', 'foto', 'jabatan', 'kategori', 'urutan'];

    /**
     * Urutan tampil kategori di halaman Guru & Staff (dari atas ke bawah).
     * Kategori yang tidak ada di daftar ini akan ditaruh paling bawah.
     */
    public const URUTAN_KATEGORI = [
        'Pimpinan Sekolah',
        'Manajemen & Tata Usaha',
        'Kepala Program Keahlian',
        'Pembina OSIS',
        'Guru & Staf',
    ];

    /**
     * Inisial dari nama (untuk avatar fallback saat belum ada foto).
     * Gelar di depan (Ir., Hj., Dr., Drs., dst.) dan di belakang nama
     * (setelah koma) diabaikan supaya inisial yang diambil relevan.
     */
    public function initials(): string
    {
        $titles = ['ir', 'hj', 'h', 'dra', 'drs', 'dr', 'prof', 'r', 'ra', 'rm', 'rr', 'k', 'kh'];

        $namaInti = trim(explode(',', $this->nama_lengkap)[0] ?? '');
        $kata = array_values(array_filter(
            preg_split('/\s+/', $namaInti) ?: [],
            fn ($w) => $w !== '' && ! in_array(mb_strtolower(trim($w, '.')), $titles, true)
        ));

        $initials = collect($kata)->take(2)->map(fn ($w) => mb_strtoupper(mb_substr($w, 0, 1)))->implode('');

        return $initials !== '' ? $initials : mb_strtoupper(mb_substr($namaInti !== '' ? $namaInti : $this->nama_lengkap, 0, 1));
    }
}