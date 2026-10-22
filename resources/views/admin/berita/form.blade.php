@extends('layouts.admin')
@section('title', $item ? 'Edit Berita' : 'Berita Baru')
@section('page-title', $item ? 'Edit Berita' : 'Tambah Berita Baru')

@section('content')

<a href="{{ route('admin.berita.index') }}" class="enter-item enter-d1 inline-flex items-center gap-1 text-sm text-muted-foreground hover:text-primary">
  <x-icon name="arrow-left" class="w-4 h-4" /> Kembali ke daftar berita
</a>

<div class="enter-item enter-d2 mt-4 max-w-3xl rounded-2xl border border-border bg-card p-7 shadow-soft sm:p-9">
  <form method="POST" action="{{ $item ? route('admin.berita.update', $item) : route('admin.berita.store') }}" enctype="multipart/form-data" class="grid gap-5">
    @csrf
    @if ($item) @method('PUT') @endif

    <div>
      <label for="judul" class="text-sm font-medium text-foreground">Judul Berita</label>
      <input type="text" name="judul" id="judul" value="{{ old('judul', $item->judul ?? '') }}" class="input-field" placeholder="Judul berita" />
      @error('judul') <p class="mt-1 text-xs text-destructive">{{ $message }}</p> @enderror
    </div>

    <div class="grid gap-5 sm:grid-cols-2">
      <div>
        <label for="kategori" class="text-sm font-medium text-foreground">Kategori</label>
        <select name="kategori" id="kategori" class="input-field">
          @foreach ($site['kategori_berita'] as $kat)
            <option value="{{ $kat }}" @selected(old('kategori', $item->kategori ?? '') === $kat)>{{ $kat }}</option>
          @endforeach
        </select>
        @error('kategori') <p class="mt-1 text-xs text-destructive">{{ $message }}</p> @enderror
      </div>
      <div>
        <label for="tanggal" class="text-sm font-medium text-foreground">Tanggal</label>
        <input type="date" name="tanggal" id="tanggal" value="{{ old('tanggal', isset($item) ? $item->tanggal->format('Y-m-d') : now()->format('Y-m-d')) }}" class="input-field" />
        @error('tanggal') <p class="mt-1 text-xs text-destructive">{{ $message }}</p> @enderror
      </div>
    </div>

    <div>
      <label for="ringkasan" class="text-sm font-medium text-foreground">Ringkasan</label>
      <textarea name="ringkasan" id="ringkasan" rows="2" class="input-field" placeholder="Ringkasan singkat berita (tampil di daftar berita)">{{ old('ringkasan', $item->ringkasan ?? '') }}</textarea>
      @error('ringkasan') <p class="mt-1 text-xs text-destructive">{{ $message }}</p> @enderror
    </div>

    <div>
      <label for="konten" class="text-sm font-medium text-foreground">Konten Berita</label>
      <textarea name="konten" id="konten" rows="8" class="input-field" placeholder="Tulis isi berita di sini. Pisahkan paragraf dengan baris baru.">{{ old('konten', $item->konten ?? '') }}</textarea>
      @error('konten') <p class="mt-1 text-xs text-destructive">{{ $message }}</p> @enderror
    </div>

    <div>
      <label class="text-sm font-medium text-foreground">Foto Berita</label>
      <p class="mt-1 text-xs text-muted-foreground">Unggah satu atau beberapa foto. Pilih salah satu sebagai gambar sampul.</p>

      @if ($existingFoto->count() > 0)
        <div class="mt-3 grid grid-cols-3 gap-3 sm:grid-cols-4">
          @foreach ($existingFoto as $foto)
            <label class="group relative block cursor-pointer overflow-hidden rounded-xl border-2 border-transparent transition-transform duration-300 hover:-translate-y-1 has-[:checked]:border-gold">
              <img src="{{ \App\Support\Site::imageUrl($foto->url_gambar) }}" alt="Foto berita" class="aspect-square w-full object-cover transition-transform duration-500 group-hover:scale-105" />
              <span class="absolute left-1.5 top-1.5 flex items-center gap-1 rounded-full bg-black/60 px-2 py-1 text-[10px] font-semibold text-white">
                <input type="radio" name="sampul_pilihan" value="lama:{{ $foto->id }}" class="h-3 w-3" @checked($item->gambar_sampul === $foto->url_gambar)>
                Sampul
              </span>
              <span class="absolute right-1.5 top-1.5 flex items-center gap-1 rounded-full bg-black/60 px-1.5 py-1 text-white">
                <input type="checkbox" name="hapus_foto[]" value="{{ $foto->id }}" class="h-3.5 w-3.5" title="Hapus foto ini">
              </span>
            </label>
          @endforeach
        </div>
      @endif

      <div class="mt-3">
        <label for="foto_baru" class="flex cursor-pointer items-center justify-center gap-2 rounded-xl border-2 border-dashed border-border py-6 text-sm text-muted-foreground transition-colors duration-300 hover:border-primary hover:text-primary hover:bg-secondary/40">
          <x-icon name="upload" class="w-4 h-4" /> Klik untuk unggah foto baru
        </label>
        <input type="file" name="foto_baru[]" id="foto_baru" accept="image/*" multiple class="hidden" onchange="document.getElementById('preview-baru').textContent = this.files.length + ' foto baru dipilih. Sampul akan menggunakan foto pertama jika belum ada sampul lain.'">
        <p id="preview-baru" class="mt-2 text-xs text-muted-foreground"></p>
        @if (! $item)
          <input type="hidden" name="sampul_pilihan" value="baru:0">
        @endif
      </div>
      @error('foto_baru.*') <p class="mt-1 text-xs text-destructive">{{ $message }}</p> @enderror
    </div>

    <div class="mt-2 flex gap-3">
      <button type="submit" class="shine inline-flex items-center gap-2 rounded-full bg-navy-gradient px-6 py-3 text-sm font-semibold text-hero-foreground shadow-soft">
        {{ $item ? 'Simpan Perubahan' : 'Publikasikan Berita' }}
      </button>
      <a href="{{ route('admin.berita.index') }}" class="inline-flex items-center gap-2 rounded-full border border-border px-6 py-3 text-sm font-semibold text-muted-foreground">Batal</a>
    </div>
  </form>
</div>

@endsection
