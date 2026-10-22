<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BkkKonten;
use App\Models\BkkMedia;
use App\Support\KontenResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

class BkkController extends Controller
{
    /**
     * Halaman "BKK" digabung jadi satu: tab "Media BKK" (foto/video/embed
     * kegiatan), tab "Konten Umum & Instagram" (teks "Apa itu BKK?" dan
     * profil kartu Instagram, data singleton), dan tab-tab konten grup
     * "bkk" dari KontenResource ("Layanan BKK", "Alasan Follow Instagram",
     * "Cara Kerja Layanan BKK"), supaya tidak perlu banyak menu terpisah
     * di sidebar admin.
     */
    public function index(Request $request)
    {
        $resources = KontenResource::forGroup('bkk');

        $tab = $request->query('tab', 'data');
        $validTabs = array_merge(['data', 'konten'], array_keys($resources));
        if (! in_array($tab, $validTabs, true)) {
            $tab = 'data';
        }

        $data = [
            'site' => \App\Support\SiteData::all(),
            'resources' => $resources,
            'tab' => $tab,
            'konten' => BkkKonten::first(),
        ];

        if ($tab === 'data') {
            $data['items'] = BkkMedia::orderBy('urutan')->orderBy('id')->get();
        } elseif ($tab !== 'konten') {
            $data['rows'] = $resources[$tab]['model']::orderBy('urutan')->orderBy('id')->get();
        }

        return view('admin.bkk.index', $data);
    }

    /**
     * Simpan perubahan teks "Apa itu BKK?" dan profil kartu Instagram
     * (data singleton di tabel bkk_konten), dari tab "Konten Umum & Instagram".
     */
    public function updateKonten(Request $request)
    {
        $data = $request->validate([
            'apa_itu' => ['nullable', 'string'],
            'ig_nama' => ['required', 'string', 'max:100'],
            'ig_foto' => ['nullable', 'image', 'max:5120'],
            'hapus_ig_foto' => ['nullable', 'boolean'],
            'ig_username' => ['required', 'string', 'max:100'],
            'ig_bio' => ['nullable', 'string', 'max:500'],
            'ig_kiriman' => ['required', 'integer', 'min:0'],
            'ig_pengikut' => ['required', 'integer', 'min:0'],
            'ig_diikuti' => ['required', 'integer', 'min:0'],
            'ig_url' => ['nullable', 'string', 'max:255'],
        ], [
            'ig_foto.image' => 'File foto harus berupa gambar.',
            'ig_foto.max' => 'Ukuran foto maksimal 5 MB.',
        ]);

        foreach (['apa_itu', 'ig_nama', 'ig_username', 'ig_bio'] as $field) {
            if (array_key_exists($field, $data)) {
                $data[$field] = self::cleanText($data[$field]);
            }
        }

        // Simpan handle Instagram tanpa karakter "@" di depan, sekalipun
        // admin mengetikkannya (biar konsisten dengan tampilan &#64;handle).
        $data['ig_username'] = ltrim($data['ig_username'], '@');

        $konten = BkkKonten::first() ?? new BkkKonten();

        $disk = Storage::disk('public');
        if ($request->hasFile('ig_foto')) {
            if ($konten->ig_foto) {
                $disk->delete($konten->ig_foto);
            }
            $data['ig_foto'] = $request->file('ig_foto')->store('bkk/profil', 'public');
        } elseif ($request->boolean('hapus_ig_foto')) {
            if ($konten->ig_foto) {
                $disk->delete($konten->ig_foto);
            }
            $data['ig_foto'] = null;
        } else {
            unset($data['ig_foto']);
        }

        $konten->fill($data);
        $konten->save();

        return redirect()->route('admin.bkk.index', ['tab' => 'konten'])
            ->with('success', 'Konten umum & Instagram BKK berhasil diperbarui');
    }

    /**
     * Bersihkan HTML entity (&amp;, &nbsp;, &quot;, dst) dari teks yang
     * diketik/paste admin, supaya tidak ter-encode dua kali saat ditampilkan.
     */
    protected static function cleanText(?string $value): ?string
    {
        if ($value === null) {
            return null;
        }

        do {
            $decoded = html_entity_decode($value, ENT_QUOTES | ENT_HTML5, 'UTF-8');
            $changed = $decoded !== $value;
            $value = $decoded;
        } while ($changed);

        return $value;
    }

    public function create()
    {
        return view('admin.bkk.form', [
            'site' => \App\Support\SiteData::all(),
            'item' => null,
        ]);
    }

    public function edit(BkkMedia $bkk)
    {
        return view('admin.bkk.form', [
            'site' => \App\Support\SiteData::all(),
            'item' => $bkk,
        ]);
    }

    public function store(Request $request)
    {
        $this->save($request, null);

        return redirect()->route('admin.bkk.index')->with('success', 'Media BKK berhasil ditambahkan');
    }

    public function update(Request $request, BkkMedia $bkk)
    {
        $this->save($request, $bkk);

        return redirect()->route('admin.bkk.index')->with('success', 'Media BKK berhasil diperbarui');
    }

    public function destroy(BkkMedia $bkk)
    {
        $disk = Storage::disk('public');
        foreach ([$bkk->media_path, $bkk->sampul] as $path) {
            if ($path) {
                $disk->delete($path);
            }
        }
        $bkk->delete();

        return redirect()->route('admin.bkk.index')->with('success', 'Media BKK berhasil dihapus');
    }

    protected function save(Request $request, ?BkkMedia $item): void
    {
        $data = $request->validate([
            'judul' => ['required', 'string', 'min:2', 'max:150'],
            'keterangan' => ['nullable', 'string', 'max:600'],
            'tema' => ['required', 'integer', 'between:0,2'],
            'urutan' => ['nullable', 'integer'],
            'jenis_media' => ['required', Rule::in(array_keys(BkkMedia::JENIS))],
            'foto' => ['nullable', 'image', 'max:8192'],
            'video' => ['nullable', 'file', 'mimetypes:video/mp4,video/webm,video/quicktime', 'max:51200'],
            'sampul' => ['nullable', 'image', 'max:5120'],
            'youtube_url' => ['nullable', 'string', 'max:255'],
            'instagram_url' => ['nullable', 'string', 'max:255'],
        ], [
            'foto.uploaded' => 'Foto gagal diunggah. Ukurannya melebihi batas server (upload_max_filesize di php.ini).',
            'video.uploaded' => 'Video gagal diunggah. Ukurannya melebihi batas server (upload_max_filesize di php.ini).',
            'video.mimetypes' => 'Format video harus MP4, WebM, atau MOV.',
            'video.max' => 'Ukuran video maksimal 50 MB.',
            'foto.max' => 'Ukuran foto maksimal 8 MB.',
        ]);

        $jenis = $data['jenis_media'];
        $disk = Storage::disk('public');
        $isNew = $item === null;
        $item = $item ?? new BkkMedia();
        $jenisLama = $isNew ? null : $item->jenis_media;

        $path = $item->media_path;
        $ref = $item->media_ref;
        $hapusPath = null; // file lama yang perlu dihapus SETELAH semua validasi lolos

        // ------------------------------------------------------------------
        // Hanya SATU jenis media yang dipakai. Data jenis lain dibersihkan.
        // ------------------------------------------------------------------
        if (in_array($jenis, ['foto', 'video_lokal'], true)) {
            $field = $jenis === 'foto' ? 'foto' : 'video';

            if ($request->hasFile($field)) {
                $hapusPath = $path;
                $path = $request->file($field)->store('bkk/'.$field, 'public');
            } elseif ($jenisLama !== $jenis || ! $path) {
                throw ValidationException::withMessages([
                    $field => $jenis === 'foto' ? 'Silakan pilih foto untuk diunggah.' : 'Silakan pilih video untuk diunggah.',
                ]);
            }
            $ref = null;
        } elseif ($jenis === 'youtube') {
            $ref = BkkMedia::parseYoutube((string) ($data['youtube_url'] ?? ''));
            if (! $ref) {
                throw ValidationException::withMessages(['youtube_url' => 'Link YouTube tidak valid. Contoh: https://www.youtube.com/watch?v=xxxxxxxxxxx']);
            }
            $hapusPath = $path;
            $path = null;
        } else { // instagram
            $ref = BkkMedia::parseInstagram((string) ($data['instagram_url'] ?? ''));
            if (! $ref) {
                throw ValidationException::withMessages(['instagram_url' => 'Link Instagram tidak valid. Contoh: https://www.instagram.com/reel/xxxxxxxx/ atau https://www.instagram.com/p/xxxxxxxx/']);
            }
            $hapusPath = $path;
            $path = null;
        }

        // ------------------------------------------------------------------
        // Sampul: hanya untuk kartu video. Kartu foto tidak memakai sampul.
        // ------------------------------------------------------------------
        $sampul = $item->sampul;
        if ($jenis === 'foto') {
            if ($sampul) {
                $disk->delete($sampul);
            }
            $sampul = null;
        } else {
            if ($request->hasFile('sampul')) {
                if ($sampul) {
                    $disk->delete($sampul);
                }
                $sampul = $request->file('sampul')->store('bkk/sampul', 'public');
            } elseif ($request->boolean('hapus_sampul') && $sampul) {
                $disk->delete($sampul);
                $sampul = null;
            }
        }

        if ($hapusPath) {
            $disk->delete($hapusPath);
        }

        $item->judul = $data['judul'];
        $item->keterangan = $data['keterangan'] ?? null;
        $item->tema = (int) $data['tema'];
        $item->urutan = $data['urutan'] ?? $item->urutan ?? 0;
        $item->jenis_media = $jenis;
        $item->media_path = $path;
        $item->media_ref = $ref;
        $item->sampul = $sampul;
        $item->save();
    }
}