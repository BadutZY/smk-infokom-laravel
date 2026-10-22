<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Ppdb;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use ZipArchive;

class PpdbController extends Controller
{
    public function index(Request $request)
    {
        $query = Ppdb::orderByDesc('created_at');

        if ($search = $request->query('search')) {
            $term = '%' . $search . '%';
            $query->where(function ($q) use ($term) {
                $q->where('nama', 'like', $term)
                    ->orWhere('nomor_pendaftaran', 'like', $term)
                    ->orWhere('asal_sekolah', 'like', $term);
            });
        }

        $data = $query->get();

        $jurusanFavorit = $data->groupBy('pilihan1')
            ->map->count()
            ->sortDesc()
            ->take(1);

        return view('admin.ppdb.index', [
            'site' => \App\Support\SiteData::all(),
            'data' => $data,
            'search' => $search,
            'jurusanFavoritNama' => $jurusanFavorit->keys()->first(),
            'jurusanFavoritTotal' => $jurusanFavorit->values()->first(),
        ]);
    }

    public function destroy(Ppdb $ppdb)
    {
        if ($ppdb->dokumen) {
            Storage::disk('public')->delete($ppdb->dokumen);
        }

        $ppdb->delete();

        return redirect()->route('admin.ppdb.index')->with('success', 'Data pendaftar berhasil dihapus');
    }

    /**
     * Unduh data pendaftar sebagai PDF formulir. Jika pendaftar juga
     * mengunggah dokumen pendukung, keduanya (PDF formulir + dokumen
     * pendukung) digabung otomatis ke dalam satu berkas ZIP supaya admin
     * cukup sekali klik untuk mendapatkan keduanya.
     */
    public function download(Ppdb $ppdb)
    {
        $pdf = Pdf::loadView('admin.ppdb.pdf', [
            'p' => $ppdb,
            'school' => \App\Support\SiteData::all()['school'] ?? [],
            'tahunAjaran' => $ppdb->created_at
                ? $ppdb->created_at->year . '/' . ($ppdb->created_at->year + 1)
                : date('Y') . '/' . (date('Y') + 1),
        ])->setPaper('a4', 'portrait');

        $slug = Str::slug($ppdb->nama) . '-' . Str::slug($ppdb->nomor_pendaftaran);
        $namaPdf = 'Formulir-PPDB-' . $slug . '.pdf';

        // Tidak ada dokumen pendukung yang diunggah -> cukup unduh PDF formulirnya saja.
        if (!$ppdb->dokumen || !Storage::disk('public')->exists($ppdb->dokumen)) {
            return $pdf->download($namaPdf);
        }

        // Ada dokumen pendukung -> gabungkan PDF formulir + dokumen tsb ke dalam satu ZIP.
        $tempDir = storage_path('app/tmp');
        if (!is_dir($tempDir)) {
            mkdir($tempDir, 0755, true);
        }

        $namaZip = 'PPDB-' . $slug . '.zip';
        $pathZip = $tempDir . '/' . uniqid('ppdb_') . '.zip';

        $zip = new ZipArchive();
        $zip->open($pathZip, ZipArchive::CREATE | ZipArchive::OVERWRITE);
        $zip->addFromString($namaPdf, $pdf->output());

        $ekstensiDokumen = pathinfo($ppdb->dokumen, PATHINFO_EXTENSION);
        $namaDokumen = 'Dokumen-Pendukung-' . $slug . ($ekstensiDokumen ? '.' . $ekstensiDokumen : '');
        $zip->addFile(Storage::disk('public')->path($ppdb->dokumen), $namaDokumen);
        $zip->close();

        return response()->download($pathZip, $namaZip)->deleteFileAfterSend(true);
    }
}