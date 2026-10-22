<?php

namespace App\Http\Controllers;

use App\Models\GuruStaff;

class GuruStaffController extends Controller
{
    public function index()
    {
        $guruStaff = GuruStaff::orderBy('urutan')->orderBy('id')->get();

        $urutanKategori = GuruStaff::URUTAN_KATEGORI;

        $grouped = $guruStaff
            ->groupBy('kategori')
            ->sortBy(function ($items, $kategori) use ($urutanKategori) {
                $index = array_search($kategori, $urutanKategori, true);

                return $index === false ? count($urutanKategori) : $index;
            });

        return view('pages.guru-staff', [
            'site' => \App\Support\SiteData::all(),
            'guruStaffGrouped' => $grouped,
        ]);
    }
}