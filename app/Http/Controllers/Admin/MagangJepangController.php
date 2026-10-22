<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MagangJepang;
use App\Support\KontenResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

class MagangJepangController extends Controller
{
    /**
     * Halaman "Magang Jepang" digabung jadi satu: tab "Data Alumni" (data
     * alumni yang berangkat magang) dan tab-tab konten grup "magang" dari
     * KontenResource ("Kenapa Magang ke Jepang?", "Langkah Menuju Jepang"),
     * supaya tidak perlu 2 menu terpisah di sidebar admin.
     */
    public function index(Request $request)
    {
        $resources = KontenResource::forGroup('magang');

        $tab = $request->query('tab', 'data');
        if ($tab !== 'data' && ! array_key_exists($tab, $resources)) {
            $tab = 'data';
        }

        $data = [
            'site' => \App\Support\SiteData::all(),
            'resources' => $resources,
            'tab' => $tab,
        ];

        if ($tab === 'data') {
            $data['items'] = MagangJepang::orderBy('urutan')->orderBy('id')->get();
        } else {
            $data['rows'] = $resources[$tab]['model']::orderBy('urutan')->orderBy('id')->get();
        }

        return view('admin.magang-jepang.index', $data);
    }

    public function create()
    {
        return view('admin.magang-jepang.form', [
            'site' => \App\Support\SiteData::all(),
            'item' => null,
        ]);
    }

    public function edit(MagangJepang $magangJepang)
    {
        return view('admin.magang-jepang.form', [
            'site' => \App\Support\SiteData::all(),
            'item' => $magangJepang,
        ]);
    }

    public function store(Request $request)
    {
        $this->save($request, null);

        return redirect()->route('admin.magang-jepang.index')->with('success', 'Data magang Jepang berhasil ditambahkan');
    }

    public function update(Request $request, MagangJepang $magangJepang)
    {
        $this->save($request, $magangJepang);

        return redirect()->route('admin.magang-jepang.index')->with('success', 'Data magang Jepang berhasil diperbarui');
    }

    public function destroy(MagangJepang $magangJepang)
    {
        $disk = Storage::disk('public');
        foreach ([$magangJepang->media_path, $magangJepang->sampul] as $path) {
            if ($path) {
                $disk->delete($path);
            }
        }
        $magangJepang->delete();

        return redirect()->route('admin.magang-jepang.index')->with('success', 'Data magang Jepang berhasil dihapus');
    }

    protected function save(Request $request, ?MagangJepang $item): void
    {
        $data = $request->validate([
            'nama' => ['required', 'string', 'min:2', 'max:150'],
            'handle' => ['nullable', 'string', 'max:100'],
            'kota' => ['nullable', 'string', 'max:100'],
            'angkatan' => ['nullable', 'string', 'max:50'],
            'catatan' => ['nullable', 'string', 'max:600'],
            'tema' => ['required', 'integer', 'between:0,2'],
            'urutan' => ['nullable', 'integer'],
            'jenis_media' => ['required', Rule::in(array_keys(MagangJepang::JENIS))],
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
        $item = $item ?? new MagangJepang();
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
                $path = $request->file($field)->store('magang-jepang/'.$field, 'public');
            } elseif ($jenisLama !== $jenis || ! $path) {
                throw ValidationException::withMessages([
                    $field => $jenis === 'foto' ? 'Silakan pilih foto untuk diunggah.' : 'Silakan pilih video untuk diunggah.',
                ]);
            }
            $ref = null;
        } elseif ($jenis === 'youtube') {
            $ref = MagangJepang::parseYoutube((string) ($data['youtube_url'] ?? ''));
            if (! $ref) {
                throw ValidationException::withMessages(['youtube_url' => 'Link YouTube tidak valid. Contoh: https://www.youtube.com/watch?v=xxxxxxxxxxx']);
            }
            $hapusPath = $path;
            $path = null;
        } else { // instagram
            $ref = MagangJepang::parseInstagram((string) ($data['instagram_url'] ?? ''));
            if (! $ref) {
                throw ValidationException::withMessages(['instagram_url' => 'Link Instagram tidak valid. Contoh: https://www.instagram.com/reel/xxxxxxxx/']);
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
                $sampul = $request->file('sampul')->store('magang-jepang/sampul', 'public');
            } elseif ($request->boolean('hapus_sampul') && $sampul) {
                $disk->delete($sampul);
                $sampul = null;
            }
        }

        if ($hapusPath) {
            $disk->delete($hapusPath);
        }

        $item->nama = $data['nama'];
        $item->handle = MagangJepang::normalizeHandle($data['handle'] ?? null);
        $item->kota = $data['kota'] ?? null;
        $item->angkatan = $data['angkatan'] ?? null;
        $item->catatan = $data['catatan'] ?? null;
        $item->tema = (int) $data['tema'];
        $item->urutan = $data['urutan'] ?? $item->urutan ?? 0;
        $item->jenis_media = $jenis;
        $item->media_path = $path;
        $item->media_ref = $ref;
        $item->sampul = $sampul;
        $item->save();
    }
}