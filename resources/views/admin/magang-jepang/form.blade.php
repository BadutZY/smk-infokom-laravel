@extends('layouts.admin')
@section('title', $item ? 'Edit Magang Jepang' : 'Tambah Magang Jepang')
@section('page-title', $item ? 'Edit Magang Jepang' : 'Tambah Magang Jepang')

@section('content')

@php
  $jenisAktif = old('jenis_media', $item->jenis_media ?? 'instagram');
  $jenisMeta = [
    'foto' => ['image', 'Foto', 'Unggah 1 foto'],
    'video_lokal' => ['video', 'Video Upload', 'Unggah file video'],
    'youtube' => ['youtube', 'YouTube', 'Tempel link YouTube'],
    'instagram' => ['instagram', 'Instagram', 'Tempel link Reel'],
  ];
@endphp

<div class="enter-item enter-d1 mx-auto max-w-3xl rounded-2xl border border-border bg-card p-7 shadow-soft">
  <form method="POST" action="{{ $item ? route('admin.magang-jepang.update', $item) : route('admin.magang-jepang.store') }}" enctype="multipart/form-data" class="grid gap-5">
    @csrf
    @if ($item) @method('PUT') @endif

    {{-- ===== Data alumni ===== --}}
    <div class="grid gap-5 sm:grid-cols-2">
      <div class="sm:col-span-2">
        <label for="nama" class="text-sm font-medium text-foreground">Nama Alumni</label>
        <input type="text" name="nama" id="nama" value="{{ old('nama', $item->nama ?? '') }}" class="input-field" placeholder="Contoh: Surya Difraja" />
        @error('nama') <p class="mt-1 text-xs text-destructive">{{ $message }}</p> @enderror
      </div>

      <div>
        <label for="kota" class="text-sm font-medium text-foreground">Kota / Lokasi <span class="text-muted-foreground">(opsional)</span></label>
        <input type="text" name="kota" id="kota" value="{{ old('kota', $item->kota ?? '') }}" class="input-field" placeholder="Contoh: Tokyo" />
        @error('kota') <p class="mt-1 text-xs text-destructive">{{ $message }}</p> @enderror
      </div>

      <div>
        <label for="angkatan" class="text-sm font-medium text-foreground">Angkatan <span class="text-muted-foreground">(opsional)</span></label>
        <input type="text" name="angkatan" id="angkatan" value="{{ old('angkatan', $item->angkatan ?? '') }}" class="input-field" placeholder="Contoh: Angkatan XVII" />
        @error('angkatan') <p class="mt-1 text-xs text-destructive">{{ $message }}</p> @enderror
      </div>

      <div class="sm:col-span-2">
        <label for="handle" class="text-sm font-medium text-foreground">Username Instagram <span class="text-muted-foreground">(opsional)</span></label>
        <input type="text" name="handle" id="handle" value="{{ old('handle', $item->handle ?? '') }}" class="input-field" placeholder="Contoh: _.prajaa (tanpa @)" />
        @error('handle') <p class="mt-1 text-xs text-destructive">{{ $message }}</p> @enderror
      </div>

      <div class="sm:col-span-2">
        <label for="catatan" class="text-sm font-medium text-foreground">Caption / Pesan <span class="text-muted-foreground">(opsional)</span></label>
        <textarea name="catatan" id="catatan" rows="3" class="input-field" placeholder="Pesan singkat yang tampil di bawah kartu">{{ old('catatan', $item->catatan ?? '') }}</textarea>
        @error('catatan') <p class="mt-1 text-xs text-destructive">{{ $message }}</p> @enderror
      </div>
    </div>

    {{-- ===== Pilihan media (hanya satu) ===== --}}
    <div data-media-picker class="rounded-2xl border border-border bg-secondary/30 p-5">
      <p class="text-sm font-semibold text-foreground">Jenis Media</p>
      <p class="mt-0.5 text-xs text-muted-foreground">Pilih salah satu. Setiap kartu hanya bisa memakai satu jenis media.</p>

      <div class="mt-4 grid grid-cols-2 gap-3 sm:grid-cols-4">
        @foreach ($jenisMeta as $key => [$icon, $label, $hint])
          <label class="cursor-pointer">
            <input type="radio" name="jenis_media" value="{{ $key }}" class="peer sr-only" {{ $jenisAktif === $key ? 'checked' : '' }} />
            <span class="flex h-full flex-col items-center gap-1.5 rounded-xl border border-border bg-card px-3 py-4 text-center transition-all peer-checked:border-primary peer-checked:bg-accent peer-checked:shadow-soft peer-focus-visible:ring-2 peer-focus-visible:ring-ring">
              <x-icon :name="$icon" class="w-6 h-6 text-primary" />
              <span class="text-sm font-semibold text-foreground">{{ $label }}</span>
              <span class="text-[11px] leading-tight text-muted-foreground">{{ $hint }}</span>
            </span>
          </label>
        @endforeach
      </div>
      @error('jenis_media') <p class="mt-2 text-xs text-destructive">{{ $message }}</p> @enderror

      {{-- Panel: Foto --}}
      <div data-media-panel="foto" class="mt-5 hidden">
        <label class="text-sm font-medium text-foreground">File Foto</label>
        @if ($item && $item->jenis_media === 'foto' && $item->media_path)
          <img src="{{ $item->fileUrl() }}" alt="Foto saat ini" class="mt-2 h-40 rounded-xl border border-border object-cover" />
          <p class="mt-1 text-xs text-muted-foreground">Foto saat ini. Pilih file baru hanya jika ingin menggantinya.</p>
        @endif
        <input type="file" name="foto" accept="image/*" data-preview="image" class="input-field" />
        <img data-preview-target="image" alt="" class="mt-3 hidden h-40 rounded-xl border border-border object-cover" />
        <p class="mt-1 text-xs text-muted-foreground">JPG/PNG/WebP, maks 8 MB. Foto potret (tegak) paling pas di kartu.</p>
        @error('foto') <p class="mt-1 text-xs text-destructive">{{ $message }}</p> @enderror
      </div>

      {{-- Panel: Video upload --}}
      <div data-media-panel="video_lokal" class="mt-5 hidden">
        <label class="text-sm font-medium text-foreground">File Video</label>
        @if ($item && $item->jenis_media === 'video_lokal' && $item->media_path)
          <video src="{{ $item->fileUrl() }}" controls preload="metadata" class="mt-2 max-h-64 rounded-xl border border-border bg-black"></video>
          <p class="mt-1 text-xs text-muted-foreground">Video saat ini. Pilih file baru hanya jika ingin menggantinya.</p>
        @endif
        <input type="file" name="video" accept="video/mp4,video/webm,video/quicktime" data-preview="video" class="input-field" />
        <video data-preview-target="video" controls class="mt-3 hidden max-h-64 rounded-xl border border-border bg-black"></video>
        <p class="mt-1 text-xs text-muted-foreground">MP4/WebM/MOV, maks 50 MB. Disarankan video tegak (9:16) berformat MP4 (H.264).</p>
        @error('video') <p class="mt-1 text-xs text-destructive">{{ $message }}</p> @enderror
      </div>

      {{-- Panel: YouTube --}}
      <div data-media-panel="youtube" class="mt-5 hidden">
        <label for="youtube_url" class="text-sm font-medium text-foreground">Link YouTube</label>
        <input type="text" name="youtube_url" id="youtube_url" value="{{ old('youtube_url', $item && $item->jenis_media === 'youtube' ? $item->sourceUrlForForm() : '') }}" class="input-field" placeholder="https://www.youtube.com/watch?v=xxxxxxxxxxx" />
        <p class="mt-1 text-xs text-muted-foreground">Bisa link biasa, youtu.be, atau Shorts. Video harus mengizinkan penyematan (embed).</p>
        @error('youtube_url') <p class="mt-1 text-xs text-destructive">{{ $message }}</p> @enderror
      </div>

      {{-- Panel: Instagram --}}
      <div data-media-panel="instagram" class="mt-5 hidden">
        <label for="instagram_url" class="text-sm font-medium text-foreground">Link Instagram Reel</label>
        <input type="text" name="instagram_url" id="instagram_url" value="{{ old('instagram_url', $item && $item->jenis_media === 'instagram' ? $item->sourceUrlForForm() : '') }}" class="input-field" placeholder="https://www.instagram.com/reel/xxxxxxxx/" />
        <p class="mt-1 text-xs text-muted-foreground">Salin link dari tombol Bagikan di Instagram. Akun harus publik agar video bisa tampil.</p>
        @error('instagram_url') <p class="mt-1 text-xs text-destructive">{{ $message }}</p> @enderror
      </div>

      {{-- Sampul (khusus jenis video) --}}
      <div data-media-panel="sampul" class="mt-5 hidden border-t border-border pt-5">
        <label class="text-sm font-medium text-foreground">Sampul Video <span class="text-muted-foreground">(opsional)</span></label>
        @if ($item && $item->sampul)
          <img src="{{ \App\Support\Site::imageUrl($item->sampul) }}" alt="Sampul saat ini" class="mt-2 h-32 rounded-xl border border-border object-cover" />
          <label class="mt-2 inline-flex items-center gap-2 text-xs font-medium text-destructive">
            <input type="checkbox" name="hapus_sampul" value="1" class="accent-primary" /> Hapus sampul ini
          </label>
        @endif
        <input type="file" name="sampul" accept="image/*" data-preview="image" class="input-field" />
        <img data-preview-target="image" alt="" class="mt-3 hidden h-32 rounded-xl border border-border object-cover" />
        <p class="mt-1 text-xs text-muted-foreground">Gambar yang tampil sebelum video diputar. Jika kosong, kartu memakai latar warna bawaan.</p>
        @error('sampul') <p class="mt-1 text-xs text-destructive">{{ $message }}</p> @enderror
      </div>
    </div>

    {{-- ===== Tampilan ===== --}}
    <div class="grid gap-5 sm:grid-cols-2">
      <div>
        <label for="tema" class="text-sm font-medium text-foreground">Warna Kartu</label>
        <select name="tema" id="tema" class="input-field">
          @foreach (\App\Models\MagangJepang::TEMA as $val => $nama)
            <option value="{{ $val }}" {{ (int) old('tema', $item->tema ?? 0) === $val ? 'selected' : '' }}>{{ $nama }}</option>
          @endforeach
        </select>
        <p class="mt-1 text-xs text-muted-foreground">Dipakai bila kartu tidak punya foto/sampul.</p>
        @error('tema') <p class="mt-1 text-xs text-destructive">{{ $message }}</p> @enderror
      </div>

      <div>
        <label for="urutan" class="text-sm font-medium text-foreground">Urutan Tampil</label>
        <input type="number" name="urutan" id="urutan" value="{{ old('urutan', $item->urutan ?? 0) }}" class="input-field" placeholder="0" />
        <p class="mt-1 text-xs text-muted-foreground">Angka kecil tampil lebih dulu.</p>
        @error('urutan') <p class="mt-1 text-xs text-destructive">{{ $message }}</p> @enderror
      </div>
    </div>

    <div class="mt-2 flex items-center gap-3">
      <button type="submit" class="inline-flex items-center gap-2 rounded-full bg-navy-gradient px-6 py-3 text-sm font-semibold text-hero-foreground shadow-soft">
        <x-icon name="check" class="w-4 h-4" /> Simpan
      </button>
      <a href="{{ route('admin.magang-jepang.index') }}" class="text-sm font-semibold text-muted-foreground hover:text-primary">Batal</a>
    </div>
  </form>
</div>

<script>
  // Menampilkan hanya panel sesuai jenis media yang dipilih + pratinjau file baru.
  (function () {
    var root = document.querySelector('[data-media-picker]');
    if (!root) return;
    var radios = root.querySelectorAll('input[name="jenis_media"]');
    var panels = root.querySelectorAll('[data-media-panel]');

    function sync() {
      var v = (root.querySelector('input[name="jenis_media"]:checked') || {}).value;
      panels.forEach(function (p) {
        var k = p.dataset.mediaPanel;
        var show = (k === v) || (k === 'sampul' && v !== 'foto');
        p.classList.toggle('hidden', !show);
      });
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

@endsection