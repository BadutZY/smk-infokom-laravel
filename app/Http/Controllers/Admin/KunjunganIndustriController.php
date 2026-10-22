<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\KunjunganIndustri;
use App\Models\KunjunganIndustriFoto;
use App\Models\KunjunganIndustriInfo;
use App\Models\KunjunganIndustriVideo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

class KunjunganIndustriController extends Controller
{
    /** Satu halaman admin dengan 3 tab: Lokasi & Foto, Video (opsional), Info Halaman. */
    public function index(Request $request)
    {
        $tab = $request->query('tab', 'lokasi');
        if (! in_array($tab, ['lokasi', 'video', 'info'], true)) {
            $tab = 'lokasi';
        }

        return view('admin.kunjungan-industri.index', [
            'site' => \App\Support\SiteData::all(),
            'tab' => $tab,
            'lokasiList' => KunjunganIndustri::withCount('fotos')->orderBy('urutan')->orderBy('id')->get(),
            'videos' => KunjunganIndustriVideo::with('lokasi')->orderBy('urutan')->orderBy('id')->get(),
            'info' => KunjunganIndustriInfo::first() ?? new KunjunganIndustriInfo(),
        ]);
    }

    /* ==================================================================
     | INFO HALAMAN
     ================================================================== */

    public function updateInfo(Request $request)
    {
        $data = $request->validate([
            'judul' => ['required', 'string', 'max:150'],
            'periode' => ['nullable', 'string', 'max:100'],
            'kota_tujuan' => ['nullable', 'string', 'max:100'],
            'intro' => ['nullable', 'string', 'max:1500'],
        ]);

        $info = KunjunganIndustriInfo::first() ?? new KunjunganIndustriInfo();
        $info->fill($data)->save();

        return redirect()->route('admin.kunjungan-industri.index', ['tab' => 'info'])
            ->with('success', 'Info halaman Kunjungan Industri berhasil diperbarui');
    }

    /* ==================================================================
     | LOKASI + FOTO
     ================================================================== */

    public function createLokasi()
    {
        return view('admin.kunjungan-industri.lokasi-form', [
            'site' => \App\Support\SiteData::all(),
            'item' => null,
            'lokasiOptions' => collect(),
        ]);
    }

    public function editLokasi(KunjunganIndustri $lokasi)
    {
        $lokasi->load('fotos');

        return view('admin.kunjungan-industri.lokasi-form', [
            'site' => \App\Support\SiteData::all(),
            'item' => $lokasi,
            'lokasiOptions' => KunjunganIndustri::orderBy('urutan')->orderBy('id')->get(['id', 'nama']),
        ]);
    }

    public function storeLokasi(Request $request)
    {
        $this->saveLokasi($request, new KunjunganIndustri());

        return redirect()->route('admin.kunjungan-industri.index', ['tab' => 'lokasi'])
            ->with('success', 'Lokasi kunjungan berhasil ditambahkan');
    }

    public function updateLokasi(Request $request, KunjunganIndustri $lokasi)
    {
        $this->saveLokasi($request, $lokasi);

        return redirect()->route('admin.kunjungan-industri.index', ['tab' => 'lokasi'])
            ->with('success', 'Lokasi kunjungan berhasil diperbarui');
    }

    public function destroyLokasi(KunjunganIndustri $lokasi)
    {
        $disk = Storage::disk('public');
        foreach ($lokasi->fotos as $foto) {
            if ($foto->isUpload()) {
                $disk->delete($foto->path);
            }
        }
        $lokasi->delete(); // foto ikut terhapus (cascade); video hanya dilepas dari lokasi

        return redirect()->route('admin.kunjungan-industri.index', ['tab' => 'lokasi'])
            ->with('success', 'Lokasi kunjungan berhasil dihapus');
    }

    protected function saveLokasi(Request $request, KunjunganIndustri $lokasi): void
    {
        $data = $request->validate([
            'nama' => ['required', 'string', 'min:2', 'max:150'],
            'kategori' => ['nullable', 'string', 'max:80'],
            'icon' => ['required', Rule::in(array_keys(KunjunganIndustri::ICONS))],
            'kota' => ['nullable', 'string', 'max:150'],
            'deskripsi' => ['nullable', 'string', 'max:2000'],
            'sorotan' => ['nullable', 'string', 'max:800'],
            'urutan' => ['nullable', 'integer'],
            'fotos' => ['nullable', 'array', 'max:30'],
            'fotos.*' => ['image', 'max:10240'],
            'foto_keterangan' => ['nullable', 'array'],
            'foto_keterangan.*' => ['nullable', 'string', 'max:200'],
            'foto_urutan' => ['nullable', 'array'],
            'foto_urutan.*' => ['nullable', 'integer'],
            'hapus_foto' => ['nullable', 'array'],
            'hapus_foto.*' => ['integer'],
            'ganti_foto' => ['nullable', 'array'],
            'ganti_foto.*' => ['nullable', 'image', 'max:10240'],
            'foto_lokasi' => ['nullable', 'array'],
            'foto_lokasi.*' => ['nullable', 'integer', 'exists:kunjungan_industri,id'],
        ], [
            'ganti_foto.*.image' => 'Foto pengganti harus berupa gambar (JPG/PNG/WebP).',
            'ganti_foto.*.max' => 'Ukuran foto pengganti maksimal 10 MB.',
            'ganti_foto.*.uploaded' => 'Foto pengganti gagal diunggah. Ukurannya melebihi batas server (upload_max_filesize di php.ini).',
            'fotos.*.image' => 'Setiap file foto harus berupa gambar (JPG/PNG/WebP).',
            'fotos.*.max' => 'Ukuran tiap foto maksimal 10 MB.',
            'fotos.*.uploaded' => 'Foto gagal diunggah. Ukurannya melebihi batas server (upload_max_filesize di php.ini).',
        ]);

        $lokasi->fill([
            'nama' => $data['nama'],
            'kategori' => $data['kategori'] ?? null,
            'icon' => $data['icon'],
            'kota' => $data['kota'] ?? null,
            'deskripsi' => $data['deskripsi'] ?? null,
            'sorotan' => $data['sorotan'] ?? null,
            'urutan' => $data['urutan'] ?? $lokasi->urutan ?? 0,
        ])->save();

        $disk = Storage::disk('public');

        // Foto lama: hapus yang dicentang, perbarui keterangan & urutan sisanya.
        if ($lokasi->exists) {
            $hapus = array_map('intval', $data['hapus_foto'] ?? []);
            $pengganti = $request->file('ganti_foto', []);
            foreach ($lokasi->fotos()->get() as $foto) {
                if (in_array($foto->id, $hapus, true)) {
                    if ($foto->isUpload()) {
                        $disk->delete($foto->path);
                    }
                    $foto->delete();

                    continue;
                }

                // Ganti file foto (file lama yang berasal dari upload ikut dihapus dari disk).
                $file = $pengganti[$foto->id] ?? null;
                if ($file && $file->isValid()) {
                    $pathLama = $foto->path;
                    $lamaUpload = $foto->isUpload();
                    $foto->path = $file->store('kunjungan-industri/foto', 'public');
                    if ($lamaUpload) {
                        $disk->delete($pathLama);
                    }
                }

                // Pindahkan foto ke lokasi lain.
                if (! empty($data['foto_lokasi'][$foto->id])) {
                    $foto->kunjungan_industri_id = (int) $data['foto_lokasi'][$foto->id];
                }
                if (array_key_exists($foto->id, $data['foto_keterangan'] ?? [])) {
                    $foto->keterangan = $data['foto_keterangan'][$foto->id];
                }
                if (isset($data['foto_urutan'][$foto->id])) {
                    $foto->urutan = (int) $data['foto_urutan'][$foto->id];
                }
                $foto->save();
            }
        }

        // Foto baru.
        $next = (int) ($lokasi->fotos()->max('urutan') ?? 0);
        foreach ($request->file('fotos', []) as $file) {
            $next++;
            KunjunganIndustriFoto::create([
                'kunjungan_industri_id' => $lokasi->id,
                'path' => $file->store('kunjungan-industri/foto', 'public'),
                'keterangan' => null,
                'urutan' => $next,
            ]);
        }
    }

    /* ==================================================================
     | VIDEO (OPSIONAL)
     ================================================================== */

    public function createVideo()
    {
        return view('admin.kunjungan-industri.video-form', [
            'site' => \App\Support\SiteData::all(),
            'item' => null,
            'lokasiList' => KunjunganIndustri::orderBy('urutan')->orderBy('id')->get(),
        ]);
    }

    public function editVideo(KunjunganIndustriVideo $video)
    {
        return view('admin.kunjungan-industri.video-form', [
            'site' => \App\Support\SiteData::all(),
            'item' => $video,
            'lokasiList' => KunjunganIndustri::orderBy('urutan')->orderBy('id')->get(),
        ]);
    }

    public function storeVideo(Request $request)
    {
        $this->saveVideo($request, new KunjunganIndustriVideo());

        return redirect()->route('admin.kunjungan-industri.index', ['tab' => 'video'])
            ->with('success', 'Video berhasil ditambahkan');
    }

    public function updateVideo(Request $request, KunjunganIndustriVideo $video)
    {
        $this->saveVideo($request, $video);

        return redirect()->route('admin.kunjungan-industri.index', ['tab' => 'video'])
            ->with('success', 'Video berhasil diperbarui');
    }

    public function destroyVideo(KunjunganIndustriVideo $video)
    {
        $disk = Storage::disk('public');
        foreach ([$video->jenis === 'lokal' ? $video->media_path : null, $video->sampul] as $path) {
            if ($path) {
                $disk->delete($path);
            }
        }
        $video->delete();

        return redirect()->route('admin.kunjungan-industri.index', ['tab' => 'video'])
            ->with('success', 'Video berhasil dihapus');
    }

    protected function saveVideo(Request $request, KunjunganIndustriVideo $video): void
    {
        $data = $request->validate([
            'judul' => ['required', 'string', 'min:2', 'max:150'],
            'deskripsi' => ['nullable', 'string', 'max:600'],
            'kunjungan_industri_id' => ['nullable', 'integer', 'exists:kunjungan_industri,id'],
            'jenis' => ['required', Rule::in(array_keys(KunjunganIndustriVideo::JENIS))],
            'rasio' => ['required', Rule::in(array_keys(KunjunganIndustriVideo::RASIO))],
            'video' => ['nullable', 'file', 'mimetypes:video/mp4,video/webm,video/quicktime', 'max:102400'],
            'embed_link' => ['nullable', 'string', 'max:2000'],
            'sampul' => ['nullable', 'image', 'max:5120'],
            'urutan' => ['nullable', 'integer'],
        ], [
            'video.uploaded' => 'Video gagal diunggah. Ukurannya melebihi batas server (upload_max_filesize & post_max_size di php.ini).',
            'video.mimetypes' => 'Format video harus MP4, WebM, atau MOV.',
            'video.max' => 'Ukuran video maksimal 100 MB. Untuk video lebih besar, unggah ke YouTube lalu pakai opsi Embed.',
            'sampul.max' => 'Ukuran sampul maksimal 5 MB.',
        ]);

        $disk = Storage::disk('public');
        $isNew = ! $video->exists;
        $jenis = $data['jenis'];

        $mediaPath = $video->media_path;
        $embedUrl = $video->embed_url;
        $sourceUrl = $video->source_url;
        $provider = $video->provider;
        $rasio = $data['rasio'];
        $hapusPath = null;

        if ($jenis === 'lokal') {
            if ($request->hasFile('video')) {
                $hapusPath = $video->jenis === 'lokal' ? $mediaPath : null;
                $mediaPath = $request->file('video')->store('kunjungan-industri/video', 'public');
            } elseif ($isNew || $video->jenis !== 'lokal' || ! $mediaPath) {
                throw ValidationException::withMessages(['video' => 'Silakan pilih file video untuk diunggah.']);
            }
            $embedUrl = null;
            $sourceUrl = null;
            $provider = 'upload';
            $rasioAkhir = $rasio === 'auto' ? 'landscape' : $rasio;
        } else {
            $parsed = KunjunganIndustriVideo::parseEmbed((string) ($data['embed_link'] ?? ''));
            if (! $parsed) {
                throw ValidationException::withMessages([
                    'embed_link' => 'Link video tidak valid. Tempel link (https://...) dari YouTube, Vimeo, Instagram, TikTok, Facebook, Google Drive, atau kode <iframe> dari situs lain.',
                ]);
            }
            if ($video->jenis === 'lokal') {
                $hapusPath = $mediaPath; // sebelumnya upload, sekarang pindah ke embed
            }
            $mediaPath = null;
            $embedUrl = $parsed['embed_url'];
            $sourceUrl = $parsed['source_url'];
            $provider = $parsed['provider'];
            $rasioAkhir = $rasio === 'auto' ? $parsed['rasio'] : $rasio;
        }

        // Sampul (opsional).
        $sampul = $video->sampul;
        if ($request->hasFile('sampul')) {
            if ($sampul) {
                $disk->delete($sampul);
            }
            $sampul = $request->file('sampul')->store('kunjungan-industri/sampul', 'public');
        } elseif ($request->boolean('hapus_sampul') && $sampul) {
            $disk->delete($sampul);
            $sampul = null;
        }

        if ($hapusPath) {
            $disk->delete($hapusPath);
        }

        $video->fill([
            'kunjungan_industri_id' => $data['kunjungan_industri_id'] ?? null,
            'judul' => $data['judul'],
            'deskripsi' => $data['deskripsi'] ?? null,
            'jenis' => $jenis,
            'provider' => $provider,
            'rasio' => $rasioAkhir,
            'media_path' => $mediaPath,
            'embed_url' => $embedUrl,
            'source_url' => $sourceUrl,
            'sampul' => $sampul,
            'urutan' => $data['urutan'] ?? $video->urutan ?? 0,
        ])->save();
    }
}