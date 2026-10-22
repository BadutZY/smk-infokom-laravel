@extends('layouts.admin')
@section('title', 'Profil Sekolah')
@section('page-title', 'Kelola Profil Sekolah')

@section('content')

<p class="enter-item enter-d1 mb-6 text-sm text-muted-foreground">{{ $groupMeta['desc'] }}</p>

<div class="enter-item enter-d2 rounded-2xl border border-border bg-card p-7 shadow-soft">
  <h3 class="font-display text-sm font-bold text-foreground">Identitas & Kontak Sekolah</h3>
  <form method="POST" action="{{ route('admin.konten.profil.update') }}" enctype="multipart/form-data" class="mt-5 grid gap-5 sm:grid-cols-2">
    @csrf
    @method('PUT')

    <div class="sm:col-span-2">
      <h4 class="font-display text-sm font-bold text-foreground">Identitas Sekolah</h4>
    </div>

    <div>
      <label for="nama" class="text-sm font-medium text-foreground">Nama Lengkap Sekolah</label>
      <input type="text" name="nama" id="nama" value="{{ old('nama', $profil->nama ?? '') }}" class="input-field" />
      @error('nama') <p class="mt-1 text-xs text-destructive">{{ $message }}</p> @enderror
    </div>
    <div>
      <label for="nama_singkat" class="text-sm font-medium text-foreground">Nama Singkat</label>
      <input type="text" name="nama_singkat" id="nama_singkat" value="{{ old('nama_singkat', $profil->nama_singkat ?? '') }}" class="input-field" />
      @error('nama_singkat') <p class="mt-1 text-xs text-destructive">{{ $message }}</p> @enderror
    </div>
    <div>
      <label for="brand_atas" class="text-sm font-medium text-foreground">Brand Baris Atas (logo/navbar)</label>
      <input type="text" name="brand_atas" id="brand_atas" value="{{ old('brand_atas', $profil->brand_atas ?? '') }}" class="input-field" />
      @error('brand_atas') <p class="mt-1 text-xs text-destructive">{{ $message }}</p> @enderror
    </div>
    <div>
      <label for="brand_bawah" class="text-sm font-medium text-foreground">Brand Baris Bawah (logo/navbar)</label>
      <input type="text" name="brand_bawah" id="brand_bawah" value="{{ old('brand_bawah', $profil->brand_bawah ?? '') }}" class="input-field" />
      @error('brand_bawah') <p class="mt-1 text-xs text-destructive">{{ $message }}</p> @enderror
    </div>
    <div class="sm:col-span-2">
      <label for="tagline" class="text-sm font-medium text-foreground">Tagline</label>
      <textarea name="tagline" id="tagline" rows="2" class="input-field">{{ old('tagline', $profil->tagline ?? '') }}</textarea>
      @error('tagline') <p class="mt-1 text-xs text-destructive">{{ $message }}</p> @enderror
    </div>
    <div class="sm:col-span-2">
      <label for="sejarah" class="text-sm font-medium text-foreground">Sejarah Sekolah</label>
      <textarea name="sejarah" id="sejarah" rows="8" class="input-field">{{ old('sejarah', $profil->sejarah ?? '') }}</textarea>
      <p class="mt-1 text-xs text-muted-foreground">Teks ini yang akan tampil di halaman Profil pada bagian &laquo;Sejarah Sekolah&raquo;. Tekan Enter untuk membuat paragraf baru.</p>
      @error('sejarah') <p class="mt-1 text-xs text-destructive">{{ $message }}</p> @enderror
    </div>

    <div class="sm:col-span-2 mt-2">
      <h4 class="font-display text-sm font-bold text-foreground">Kata Pengantar Kepala Sekolah</h4>
      <p class="text-xs text-muted-foreground">Tampil di halaman Profil, di antara bagian &laquo;Sejarah Sekolah&raquo; dan &laquo;Visi &amp; Misi&raquo;.</p>
    </div>
    <div class="sm:col-span-2">
      <label for="kata_pengantar" class="text-sm font-medium text-foreground">Isi Kata Pengantar</label>
      <textarea name="kata_pengantar" id="kata_pengantar" rows="8" class="input-field">{{ old('kata_pengantar', $profil->kata_pengantar ?? '') }}</textarea>
      <p class="mt-1 text-xs text-muted-foreground">Tekan Enter untuk membuat paragraf baru. Nama yang tampil sebagai penanda tanda tangan mengikuti field &laquo;Kepala Sekolah&raquo; di atas.</p>
      @error('kata_pengantar') <p class="mt-1 text-xs text-destructive">{{ $message }}</p> @enderror
    </div>
    <div class="sm:col-span-2">
      <label for="gambar_kepala_sekolah" class="text-sm font-medium text-foreground">Foto Kepala Sekolah</label>
      @if ($profil?->gambar_kepala_sekolah)
        <img src="{{ \App\Support\Site::imageUrl($profil->gambar_kepala_sekolah) }}" alt="Foto kepala sekolah" class="mt-2 mb-2 h-28 w-28 rounded-xl object-cover" />
      @endif
      <input type="file" name="gambar_kepala_sekolah" id="gambar_kepala_sekolah" accept="image/*" class="input-field" />
      <p class="mt-1 text-xs text-muted-foreground">Kosongkan jika tidak ingin mengganti foto.</p>
      @error('gambar_kepala_sekolah') <p class="mt-1 text-xs text-destructive">{{ $message }}</p> @enderror
    </div>

    <div class="sm:col-span-2 mt-2">
      <h4 class="font-display text-sm font-bold text-foreground">Kontak & Alamat</h4>
    </div>
    <div class="sm:col-span-2">
      <label for="alamat" class="text-sm font-medium text-foreground">Alamat</label>
      <textarea name="alamat" id="alamat" rows="2" class="input-field">{{ old('alamat', $profil->alamat ?? '') }}</textarea>
      @error('alamat') <p class="mt-1 text-xs text-destructive">{{ $message }}</p> @enderror
    </div>
    <div>
      <label for="telepon" class="text-sm font-medium text-foreground">Telepon</label>
      <input type="text" name="telepon" id="telepon" value="{{ old('telepon', $profil->telepon ?? '') }}" class="input-field" />
      @error('telepon') <p class="mt-1 text-xs text-destructive">{{ $message }}</p> @enderror
    </div>
    <div>
      <label for="whatsapp" class="text-sm font-medium text-foreground">WhatsApp</label>
      <input type="text" name="whatsapp" id="whatsapp" value="{{ old('whatsapp', $profil->whatsapp ?? '') }}" class="input-field" />
      @error('whatsapp') <p class="mt-1 text-xs text-destructive">{{ $message }}</p> @enderror
    </div>
    <div>
      <label for="email" class="text-sm font-medium text-foreground">Email</label>
      <input type="email" name="email" id="email" value="{{ old('email', $profil->email ?? '') }}" class="input-field" />
      @error('email') <p class="mt-1 text-xs text-destructive">{{ $message }}</p> @enderror
    </div>
    <div>
      <label for="jam_operasional" class="text-sm font-medium text-foreground">Jam Operasional</label>
      <input type="text" name="jam_operasional" id="jam_operasional" value="{{ old('jam_operasional', $profil->jam_operasional ?? '') }}" class="input-field" />
      @error('jam_operasional') <p class="mt-1 text-xs text-destructive">{{ $message }}</p> @enderror
    </div>
    <div>
      <label for="kepala_sekolah" class="text-sm font-medium text-foreground">Kepala Sekolah</label>
      <input type="text" name="kepala_sekolah" id="kepala_sekolah" value="{{ old('kepala_sekolah', $profil->kepala_sekolah ?? '') }}" class="input-field" />
      @error('kepala_sekolah') <p class="mt-1 text-xs text-destructive">{{ $message }}</p> @enderror
    </div>

    <div class="sm:col-span-2 mt-2">
      <h4 class="font-display text-sm font-bold text-foreground">Gambar</h4>
    </div>
    <div>
      <label for="gambar_hero" class="text-sm font-medium text-foreground">Gambar Hero (Beranda)</label>
      @if ($profil?->gambar_hero)
        <img src="{{ \App\Support\Site::imageUrl($profil->gambar_hero) }}" alt="Gambar hero" class="mt-2 mb-2 h-28 w-full rounded-xl object-cover" />
      @endif
      <input type="file" name="gambar_hero" id="gambar_hero" accept="image/*" class="input-field" />
      <p class="mt-1 text-xs text-muted-foreground">Kosongkan jika tidak ingin mengganti gambar.</p>
      @error('gambar_hero') <p class="mt-1 text-xs text-destructive">{{ $message }}</p> @enderror
    </div>
    <div>
      <label for="gambar_siswa" class="text-sm font-medium text-foreground">Gambar Siswa (Tentang Kami)</label>
      @if ($profil?->gambar_siswa)
        <img src="{{ \App\Support\Site::imageUrl($profil->gambar_siswa) }}" alt="Gambar siswa" class="mt-2 mb-2 h-28 w-full rounded-xl object-cover" />
      @endif
      <input type="file" name="gambar_siswa" id="gambar_siswa" accept="image/*" class="input-field" />
      <p class="mt-1 text-xs text-muted-foreground">Kosongkan jika tidak ingin mengganti gambar.</p>
      @error('gambar_siswa') <p class="mt-1 text-xs text-destructive">{{ $message }}</p> @enderror
    </div>

    <div class="sm:col-span-2 mt-2">
      <h4 class="font-display text-sm font-bold text-foreground">Total Biaya PPDB per Gelombang</h4>
      <p class="text-xs text-muted-foreground">Rincian per jenis biaya diatur di halaman "Konten PPDB".</p>
    </div>
    <div>
      <label for="total_biaya_gelombang1" class="text-sm font-medium text-foreground">Total Gelombang 1 (Rp)</label>
      <input type="number" name="total_biaya_gelombang1" id="total_biaya_gelombang1" value="{{ old('total_biaya_gelombang1', $profil->total_biaya_gelombang1 ?? 0) }}" class="input-field" />
      @error('total_biaya_gelombang1') <p class="mt-1 text-xs text-destructive">{{ $message }}</p> @enderror
    </div>
    <div>
      <label for="total_biaya_gelombang2" class="text-sm font-medium text-foreground">Total Gelombang 2 (Rp)</label>
      <input type="number" name="total_biaya_gelombang2" id="total_biaya_gelombang2" value="{{ old('total_biaya_gelombang2', $profil->total_biaya_gelombang2 ?? 0) }}" class="input-field" />
      @error('total_biaya_gelombang2') <p class="mt-1 text-xs text-destructive">{{ $message }}</p> @enderror
    </div>
    <div>
      <label for="total_biaya_gelombang3" class="text-sm font-medium text-foreground">Total Gelombang 3 (Rp)</label>
      <input type="number" name="total_biaya_gelombang3" id="total_biaya_gelombang3" value="{{ old('total_biaya_gelombang3', $profil->total_biaya_gelombang3 ?? 0) }}" class="input-field" />
      @error('total_biaya_gelombang3') <p class="mt-1 text-xs text-destructive">{{ $message }}</p> @enderror
    </div>

    <div class="sm:col-span-2 mt-2 flex items-center gap-3">
      <button type="submit" class="shine inline-flex items-center gap-2 rounded-full bg-navy-gradient px-6 py-3 text-sm font-semibold text-hero-foreground shadow-soft">
        <x-icon name="check" class="w-4 h-4" /> Simpan Profil
      </button>
    </div>
  </form>
</div>

<div class="enter-item enter-d3 mt-10">
  <h3 class="mb-4 font-display text-sm font-bold text-foreground">Konten Pendukung Profil & Beranda</h3>
  @include('admin.konten._resource-panel')
</div>

@endsection