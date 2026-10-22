@extends('layouts.admin')
@section('title', $item ? 'Edit Video Kunjungan' : 'Tambah Video Kunjungan')
@section('page-title', $item ? 'Edit Video Kunjungan' : 'Tambah Video Kunjungan')

@section('content')

@php
  $jenisAktif = old('jenis', $item->jenis ?? 'embed');
  $jenisMeta = [
    'embed' => ['external-link', 'Embed dari Link', 'Tempel link YouTube, Instagram, TikTok, dll.'],
    'lokal' => ['upload', 'Upload dari Komputer', 'Unggah file video (MP4/WebM/MOV)'],
  ];
  // Nilai link yang ditampilkan kembali saat edit.
  $linkLama = $item && $item->jenis === 'embed' ? ($item->source_url ?: $item->embed_url) : '';
@endphp

<div class="enter-item enter-d1 mx-auto max-w-3xl rounded-2xl border border-border bg-card p-7 shadow-soft">
  <form method="POST" action="{{ $item ? route('admin.kunjungan-industri.video.update', $item) : route('admin.kunjungan-industri.video.store') }}" enctype="multipart/form-data" class="grid gap-5">
    @csrf
    @if ($item) @method('PUT') @endif

    <div class="grid gap-5 sm:grid-cols-2">
      <div class="sm:col-span-2">
        <label for="judul" class="text-sm font-medium text-foreground">Judul Video</label>
        <input type="text" name="judul" id="judul" value="{{ old('judul', $item->judul ?? '') }}" class="input-field" placeholder="Contoh: Keseruan di Lava Tour Merapi" />
        @error('judul') <p class="mt-1 text-xs text-destructive">{{ $message }}</p> @enderror
      </div>

      <div class="sm:col-span-2">
        <label for="deskripsi" class="text-sm font-medium text-foreground">Keterangan <span class="text-muted-foreground">(opsional)</span></label>
        <textarea name="deskripsi" id="deskripsi" rows="2" class="input-field" placeholder="Keterangan singkat yang tampil di bawah video">{{ old('deskripsi', $item->deskripsi ?? '') }}</textarea>
        @error('deskripsi') <p class="mt-1 text-xs text-destructive">{{ $message }}</p> @enderror
      </div>

      <div>
        <label for="kunjungan_industri_id" class="text-sm font-medium text-foreground">Terkait Lokasi <span class="text-muted-foreground">(opsional)</span></label>
        <select name="kunjungan_industri_id" id="kunjungan_industri_id" class="input-field">
          <option value="">- Umum / tidak terkait lokasi -</option>
          @foreach ($lokasiList as $l)
            <option value="{{ $l->id }}" {{ (string) old('kunjungan_industri_id', $item->kunjungan_industri_id ?? '') === (string) $l->id ? 'selected' : '' }}>{{ $l->nama }}</option>
          @endforeach
        </select>
        @error('kunjungan_industri_id') <p class="mt-1 text-xs text-destructive">{{ $message }}</p> @enderror
      </div>

      <div>
        <label for="urutan" class="text-sm font-medium text-foreground">Urutan Tampil</label>
        <input type="number" name="urutan" id="urutan" value="{{ old('urutan', $item->urutan ?? 0) }}" class="input-field" placeholder="0" />
        <p class="mt-1 text-xs text-muted-foreground">Angka kecil tampil lebih dulu.</p>
        @error('urutan') <p class="mt-1 text-xs text-destructive">{{ $message }}</p> @enderror
      </div>
    </div>

    {{-- ===== Sumber video ===== --}}
    <div data-media-picker class="rounded-2xl border border-border bg-secondary/30 p-5">
      <p class="text-sm font-semibold text-foreground">Sumber Video</p>
      <p class="mt-0.5 text-xs text-muted-foreground">Pilih salah satu: unggah dari komputer, atau sematkan dari link website lain.</p>

      <div class="mt-4 grid grid-cols-1 gap-3 sm:grid-cols-2">
        @foreach ($jenisMeta as $key => [$icon, $label, $hint])
          <label class="cursor-pointer">
            <input type="radio" name="jenis" value="{{ $key }}" class="peer sr-only" {{ $jenisAktif === $key ? 'checked' : '' }} />
            <span class="flex h-full flex-col items-center gap-1.5 rounded-xl border border-border bg-card px-3 py-4 text-center transition-all peer-checked:border-primary peer-checked:bg-accent peer-checked:shadow-soft peer-focus-visible:ring-2 peer-focus-visible:ring-ring">
              <x-icon :name="$icon" class="w-6 h-6 text-primary" />
              <span class="text-sm font-semibold text-foreground">{{ $label }}</span>
              <span class="text-[11px] leading-tight text-muted-foreground">{{ $hint }}</span>
            </span>
          </label>
        @endforeach
      </div>
      @error('jenis') <p class="mt-2 text-xs text-destructive">{{ $message }}</p> @enderror

      {{-- Panel: Embed link --}}
      <div data-media-panel="embed" class="mt-5 hidden">
        <label for="embed_link" class="text-sm font-medium text-foreground">Link / Kode Embed</label>
        <textarea name="embed_link" id="embed_link" rows="2" class="input-field" placeholder="https://www.youtube.com/watch?v=xxxxxxxxxxx">{{ old('embed_link', $linkLama) }}</textarea>
        <p class="mt-1 text-xs text-muted-foreground">
          Didukung: <strong>YouTube</strong> (termasuk Shorts), <strong>Vimeo</strong>, <strong>Instagram</strong> (Reel/Post), <strong>TikTok</strong>, <strong>Facebook</strong>, <strong>Google Drive</strong>, link file video langsung (.mp4), atau kode <code>&lt;iframe&gt;</code> dari situs lain.
          Video harus berstatus publik dan mengizinkan penyematan (embed).
        </p>
        @error('embed_link') <p class="mt-1 text-xs text-destructive">{{ $message }}</p> @enderror
      </div>

      {{-- Panel: Upload --}}
      <div data-media-panel="lokal" class="mt-5 hidden">
        <label class="text-sm font-medium text-foreground">File Video</label>
        @if ($item && $item->jenis === 'lokal' && $item->media_path)
          <video src="{{ \App\Support\Site::imageUrl($item->media_path) }}" controls preload="metadata" class="mt-2 max-h-64 rounded-xl border border-border bg-black"></video>
          <p class="mt-1 text-xs text-muted-foreground">Video saat ini. Pilih file baru hanya jika ingin menggantinya.</p>
        @endif
        <input type="file" name="video" accept="video/mp4,video/webm,video/quicktime" data-preview="video" class="input-field" />
        <video data-preview-target="video" controls class="mt-3 hidden max-h-64 rounded-xl border border-border bg-black"></video>
        <p class="mt-1 text-xs text-muted-foreground">MP4/WebM/MOV, maks 100 MB (juga bergantung pada upload_max_filesize &amp; post_max_size di php.ini). Untuk video besar, lebih baik unggah ke YouTube lalu pakai opsi Embed.</p>
        @error('video') <p class="mt-1 text-xs text-destructive">{{ $message }}</p> @enderror
      </div>
    </div>

    {{-- ===== Tampilan ===== --}}
    <div class="grid gap-5 sm:grid-cols-2">
      <div>
        <label for="rasio" class="text-sm font-medium text-foreground">Bentuk Pemutar</label>
        <select name="rasio" id="rasio" class="input-field">
          @foreach (\App\Models\KunjunganIndustriVideo::RASIO as $val => $label)
            <option value="{{ $val }}" {{ old('rasio', $item ? $item->rasio : 'auto') === $val ? 'selected' : '' }}>{{ $label }}</option>
          @endforeach
        </select>
        <p class="mt-1 text-xs text-muted-foreground">Pilih "Otomatis" jika ragu. Reel/TikTok/Shorts otomatis tegak.</p>
        @error('rasio') <p class="mt-1 text-xs text-destructive">{{ $message }}</p> @enderror
      </div>

      <div>
        <label class="text-sm font-medium text-foreground">Sampul Video <span class="text-muted-foreground">(opsional)</span></label>
        @if ($item && $item->sampul)
          <img src="{{ \App\Support\Site::imageUrl($item->sampul) }}" alt="Sampul saat ini" class="mt-2 h-24 rounded-xl border border-border object-cover" />
          <label class="mt-2 inline-flex items-center gap-2 text-xs font-medium text-destructive">
            <input type="checkbox" name="hapus_sampul" value="1" class="accent-primary" /> Hapus sampul ini
          </label>
        @endif
        <input type="file" name="sampul" accept="image/*" class="input-field" />
        <p class="mt-1 text-xs text-muted-foreground">Gambar sebelum video diputar. Untuk YouTube, sampul otomatis dipakai bila kosong.</p>
        @error('sampul') <p class="mt-1 text-xs text-destructive">{{ $message }}</p> @enderror
      </div>
    </div>

    <div class="mt-2 flex items-center gap-3">
      <button type="submit" class="inline-flex items-center gap-2 rounded-full bg-navy-gradient px-6 py-3 text-sm font-semibold text-hero-foreground shadow-soft">
        <x-icon name="check" class="w-4 h-4" /> Simpan
      </button>
      <a href="{{ route('admin.kunjungan-industri.index', ['tab' => 'video']) }}" class="text-sm font-semibold text-muted-foreground hover:text-primary">Batal</a>
    </div>
  </form>
</div>

<script>
  // Menampilkan hanya panel sesuai sumber video yang dipilih + pratinjau file baru.
  (function () {
    var root = document.querySelector('[data-media-picker]');
    if (!root) return;
    var radios = root.querySelectorAll('input[name="jenis"]');
    var panels = root.querySelectorAll('[data-media-panel]');

    function sync() {
      var v = (root.querySelector('input[name="jenis"]:checked') || {}).value;
      panels.forEach(function (p) { p.classList.toggle('hidden', p.dataset.mediaPanel !== v); });
    }
    radios.forEach(function (r) { r.addEventListener('change', sync); });
    sync();

    root.querySelectorAll('input[type="file"][data-preview]').forEach(function (input) {
      input.addEventListener('change', function () {
        var target = input.parentElement.querySelector('[data-preview-target="' + input.dataset.preview + '"]');
        if (!target) return;
        var file = input.files && input.files[0];
        if (!file) { target.classList.add('hidden'); return; }
        target.src = URL.createObjectURL(file);
        target.classList.remove('hidden');
      });
    });
  })();
</script>

@include('admin.kunjungan-industri._upload-guard')

@endsection