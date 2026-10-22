@extends('layouts.app')
@section('title', 'Berita')

@section('content')

<x-page-hero crumb="Berita" kicker="Berita Sekolah" title="Berita & Kegiatan" desc="Informasi terbaru seputar kegiatan, prestasi, dan pengumuman SMK INFOKOM Kota Bogor." />

@php
  // Artikel pertama (paling baru) ditonjolkan sebagai kartu unggulan berukuran
  // besar di atas grid — sisanya tampil seperti grid biasa. Kartu unggulan ini
  // tetap ikut ter-filter oleh kategori seperti kartu lainnya.
  $featuredBerita = $beritaList->first();
  $restBerita = $featuredBerita ? $beritaList->skip(1) : $beritaList;
  $readMins = fn ($b) => max(1, (int) ceil(count(preg_split('/\s+/u', trim(strip_tags((string) $b->konten)), -1, PREG_SPLIT_NO_EMPTY)) / 200));
@endphp

<section class="section-pad px-4 sm:px-6 lg:px-8">
  <div class="mx-auto max-w-6xl">

    {{-- Filter kategori + pencarian langsung --}}
    <div class="reveal flex flex-col items-center gap-5 lg:flex-row lg:justify-between">
      <div data-filter-group="#berita-grid" class="flex flex-wrap justify-center gap-2 lg:justify-start">
        <button type="button" data-filter-btn="Semua" class="chip rounded-full px-4 py-2 text-sm font-semibold {{ $activeKategori === 'Semua' ? 'bg-primary text-primary-foreground' : 'bg-secondary text-secondary-foreground' }}">Semua</button>
        @foreach ($categories as $cat)
          <button type="button" data-filter-btn="{{ $cat }}" class="chip rounded-full px-4 py-2 text-sm font-semibold {{ $activeKategori === $cat ? 'bg-primary text-primary-foreground' : 'bg-secondary text-secondary-foreground' }}">{{ $cat }}</button>
        @endforeach
      </div>
      <label class="search-field w-full lg:max-w-xs">
        <span class="sr-only">Cari berita</span>
        <x-icon name="search" />
        <input type="search" data-search-input="#berita-grid" placeholder="Cari judul berita..." autocomplete="off" />
      </label>
    </div>

    <div id="berita-grid" class="stagger-group mt-10 grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
      @if ($featuredBerita)
        <a href="{{ route('berita.show', $featuredBerita->slug) }}"
           data-filter-item data-category="{{ $featuredBerita->kategori }}" data-search="{{ mb_strtolower($featuredBerita->judul.' '.$featuredBerita->kategori.' '.$featuredBerita->ringkasan) }}"
           class="stagger-item tilt-glow card-hover group col-span-full overflow-hidden rounded-3xl border border-border bg-card shadow-lift sm:grid sm:grid-cols-[1.1fr_1fr]">
          <div class="relative aspect-[16/10] overflow-hidden sm:aspect-auto sm:min-h-[19rem]">
            <img src="{{ \App\Support\Site::imageUrl($featuredBerita->gambar_sampul) }}" alt="{{ $featuredBerita->judul }}" class="absolute inset-0 h-full w-full object-cover transition-transform duration-[1200ms] ease-out group-hover:scale-105" />
            <span class="absolute left-4 top-4 inline-flex items-center gap-1.5 rounded-full bg-gold-gradient px-3 py-1 text-xs font-bold text-gold-foreground shadow-soft">
              <x-icon name="sparkles" class="w-3 h-3" /> Terbaru
            </span>
          </div>
          <div class="flex flex-col justify-center p-6 sm:p-8 lg:p-11">
            <div class="flex flex-wrap items-center gap-3">
              <span class="news-tag">{{ $featuredBerita->kategori }}</span>
              <span class="text-xs text-muted-foreground">{{ \App\Support\Site::formatTanggal($featuredBerita->tanggal) }}</span>
            </div>
            <h3 class="mt-4 font-display text-xl font-extrabold leading-snug tracking-tight text-foreground sm:text-2xl lg:text-[1.75rem]">{{ $featuredBerita->judul }}</h3>
            <p class="mt-3 line-clamp-3 text-sm leading-relaxed text-muted-foreground">{{ $featuredBerita->ringkasan }}</p>
            <span class="mt-6 flex items-center justify-between gap-4 text-sm">
              <span class="inline-flex items-center gap-1.5 font-semibold text-primary">Baca selengkapnya <x-icon name="arrow-right" class="w-4 h-4 transition-transform duration-300 group-hover:translate-x-1" /></span>
              <span class="inline-flex items-center gap-1.5 text-xs text-muted-foreground"><x-icon name="clock" class="w-3.5 h-3.5" />{{ $readMins($featuredBerita) }} menit baca</span>
            </span>
          </div>
        </a>
      @endif

      @forelse ($restBerita as $berita)
        <a href="{{ route('berita.show', $berita->slug) }}"
           data-filter-item data-category="{{ $berita->kategori }}" data-search="{{ mb_strtolower($berita->judul.' '.$berita->kategori.' '.$berita->ringkasan) }}"
           class="stagger-item news-card tilt-glow card-hover group overflow-hidden border border-border bg-card shadow-soft {{ $activeKategori !== 'Semua' && $activeKategori !== $berita->kategori ? 'hidden' : '' }}">
          <div class="cover">
            <img src="{{ \App\Support\Site::imageUrl($berita->gambar_sampul) }}" alt="{{ $berita->judul }}" loading="lazy" />
            <span class="news-tag">{{ $berita->kategori }}</span>
          </div>
          <div class="p-5">
            <p class="flex items-center gap-1.5 text-xs text-muted-foreground"><x-icon name="calendar-days" class="w-3.5 h-3.5" />{{ \App\Support\Site::formatTanggal($berita->tanggal) }}</p>
            <h3 class="mt-2.5 line-clamp-2 font-display text-base font-bold leading-snug text-foreground">{{ $berita->judul }}</h3>
            <p class="mt-2 line-clamp-2 text-sm leading-relaxed text-muted-foreground">{{ $berita->ringkasan }}</p>
            <span class="mt-4 flex items-center justify-between gap-3 text-sm">
              <span class="inline-flex items-center gap-1 font-semibold text-primary">Baca selengkapnya <x-icon name="arrow-right" class="w-3.5 h-3.5 transition-transform duration-300 group-hover:translate-x-1" /></span>
              <span class="text-xs text-muted-foreground">{{ $readMins($berita) }} mnt</span>
            </span>
          </div>
        </a>
      @empty
        @if (!$featuredBerita)
          <p class="col-span-full text-center text-sm text-muted-foreground">Belum ada berita yang dipublikasikan.</p>
        @endif
      @endforelse
    </div>

    {{-- Ditampilkan otomatis oleh JS bila kategori/pencarian tidak menghasilkan berita --}}
    <div data-filter-empty class="mt-4 flex-col items-center gap-3 rounded-3xl border border-dashed border-border bg-secondary/40 py-14 text-center">
      <span class="mx-auto flex h-12 w-12 items-center justify-center rounded-full bg-accent text-primary"><x-icon name="newspaper" class="w-5 h-5" /></span>
      <p class="text-sm font-medium text-muted-foreground">Tidak ada berita yang cocok dengan pilihan Anda.</p>
    </div>
  </div>
</section>

@endsection
