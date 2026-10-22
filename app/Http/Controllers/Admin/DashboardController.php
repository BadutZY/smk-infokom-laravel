<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Berita;
use App\Models\PesanKontak;
use App\Models\Ppdb;
use Carbon\Carbon;
use Illuminate\Support\Collection;

class DashboardController extends Controller
{
    public function index()
    {
        $berita = Berita::orderByDesc('id')->get();
        $ppdb = Ppdb::orderByDesc('created_at')->get();
        $kontak = PesanKontak::orderByDesc('created_at')->get();

        $belumDibaca = $kontak->where('status', 'belum_dibaca')->count();
        $sudahDibaca = $kontak->count() - $belumDibaca;

        $kategoriData = $berita->groupBy('kategori')->map->count();

        // ---- Tren bulan ini vs bulan lalu, untuk kartu statistik ----
        $awalBulanIni = Carbon::now()->startOfMonth();
        $awalBulanLalu = Carbon::now()->subMonthNoOverflow()->startOfMonth();
        $akhirBulanLalu = $awalBulanIni->copy()->subSecond();

        $hitungTren = function (Collection $items) use ($awalBulanIni, $awalBulanLalu, $akhirBulanLalu) {
            $bulanIni = $items->filter(fn ($item) => $item->created_at && $item->created_at->greaterThanOrEqualTo($awalBulanIni))->count();
            $bulanLalu = $items->filter(fn ($item) => $item->created_at && $item->created_at->between($awalBulanLalu, $akhirBulanLalu))->count();

            if ($bulanLalu === 0) {
                $persen = $bulanIni > 0 ? 100 : 0;
            } else {
                $persen = (int) round((($bulanIni - $bulanLalu) / $bulanLalu) * 100);
            }

            return [
                'bulan_ini' => $bulanIni,
                'bulan_lalu' => $bulanLalu,
                'persen' => $persen,
                'arah' => $bulanIni === $bulanLalu ? 'tetap' : ($bulanIni > $bulanLalu ? 'naik' : 'turun'),
            ];
        };

        // ---- Aktivitas 7 hari terakhir (PPDB & Pesan Masuk) ----
        $namaHari = ['Min', 'Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab'];
        $labelAktivitas = [];
        $ppdbHarian = [];
        $kontakHarian = [];

        for ($i = 6; $i >= 0; $i--) {
            $tanggal = Carbon::now()->subDays($i);
            $labelAktivitas[] = $namaHari[$tanggal->dayOfWeek];
            $ppdbHarian[] = $ppdb->filter(fn ($item) => $item->created_at && $item->created_at->isSameDay($tanggal))->count();
            $kontakHarian[] = $kontak->filter(fn ($item) => $item->created_at && $item->created_at->isSameDay($tanggal))->count();
        }

        return view('admin.dashboard', [
            'site' => \App\Support\SiteData::all(),
            'totalBerita' => $berita->count(),
            'totalPpdb' => $ppdb->count(),
            'totalKontak' => $kontak->count(),
            'belumDibaca' => $belumDibaca,
            'sudahDibaca' => $sudahDibaca,
            'kategoriData' => $kategoriData,
            'ppdbTerbaru' => $ppdb->take(5),
            'kontakTerbaru' => $kontak->take(5),
            'trenBerita' => $hitungTren($berita),
            'trenPpdb' => $hitungTren($ppdb),
            'trenKontak' => $hitungTren($kontak),
            'labelAktivitas' => $labelAktivitas,
            'ppdbHarian' => $ppdbHarian,
            'kontakHarian' => $kontakHarian,
        ]);
    }
}