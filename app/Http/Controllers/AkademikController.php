<?php

namespace App\Http\Controllers;

use App\Models\Jurusan;

class AkademikController extends Controller
{
    public function index()
    {
        return view('pages.akademik', [
            'site' => \App\Support\SiteData::all(),
        ]);
    }

    /**
     * Halaman detail satu kompetensi keahlian (jurusan), diakses lewat
     * tombol "Telusuri Lebih Lanjut" pada kartu jurusan di halaman Akademik.
     * Berisi penjelasan lebih rinci: deskripsi lengkap, poin keunggulan,
     * dan daftar Lingkup Kerja/peluang profesi jurusan tersebut.
     */
    public function jurusanShow(string $slug)
    {
        $jurusan = Jurusan::where('slug', $slug)->first();

        abort_if(! $jurusan, 404);

        $lainnya = Jurusan::where('id', '!=', $jurusan->id)->orderBy('urutan')->get();

        return view('pages.jurusan-show', [
            'site' => \App\Support\SiteData::all(),
            'jurusan' => $jurusan,
            'lainnya' => $lainnya,
        ]);
    }
}
