@extends('layouts.app')
@section('title', 'Galeri')

@section('content')

<x-page-hero crumb="Galeri" kicker="Dokumentasi" title="Galeri Sekolah" desc="Kumpulan dokumentasi kegiatan, fasilitas, dan momen kebersamaan warga sekolah." />

@php
  $galleryItems = collect($site['gallery_items'])->values();
  // Tata letak "bento" (ada foto lebar & tinggi) hanya dipakai bila fotonya cukup banyak;
  // kalau sedikit, semua foto dibuat seragam supaya tidak ada ruang kosong.
  $bento = $galleryItems->count() >= 9;
@endphp

<section class="section-pad px-4 sm:px-6 lg:px-8">
  <div class="mx-auto max-w-6xl">

    <div class="stagger-group mx-auto mb-12 flex max-w-lg flex-wrap justify-center gap-10 text-center">
      <div class="stagger-item">
        <p class="font-display text-3xl font-extrabold text-primary sm:text-4xl">
          <span data-countup="{{ $galleryItems->count() }}" data-suffix="+">0+</span>
        </p>
        <p class="mt-1 text-xs font-medium text-muted-foreground sm:text-sm">Foto Dokumentasi</p>
      </div>
      <div class="stagger-item">
        <p class="font-display text-3xl font-extrabold text-primary sm:text-4xl">
          <span data-countup="{{ count($categories) }}">0</span>
        </p>
        <p class="mt-1 text-xs font-medium text-muted-foreground sm:text-sm">Kategori Kegiatan</p>
      </div>
    </div>

    <div class="reveal flex flex-col items-center gap-5 lg:flex-row lg:justify-between">
      <div data-filter-group="#galeri-grid" class="flex flex-wrap justify-center gap-2 lg:justify-start">
        <button type="button" data-filter-btn="Semua" class="chip rounded-full bg-primary px-4 py-2 text-sm font-semibold text-primary-foreground">Semua</button>
        @foreach ($categories as $cat)
          <button type="button" data-filter-btn="{{ $cat }}" class="chip rounded-full bg-secondary px-4 py-2 text-sm font-semibold text-secondary-foreground">{{ $cat }}</button>
        @endforeach
      </div>
      <label class="search-field w-full lg:max-w-xs">
        <span class="sr-only">Cari foto</span>
        <x-icon name="search" />
        <input type="search" data-search-input="#galeri-grid" placeholder="Cari judul foto..." autocomplete="off" />
      </label>
    </div>

    {{-- Klik foto untuk memperbesar; di dalam penampil bisa geser dengan panah / jari --}}
    <div id="galeri-grid" data-lightbox-scope class="gallery-grid stagger-group mt-10">
      @foreach ($galleryItems as $i => $item)
        @php
          $shape = '';
          if ($bento) { $shape = ($i % 9 === 0) ? 'is-wide' : (($i % 9 === 4) ? 'is-tall' : ''); }
        @endphp
        <button type="button"
                data-filter-item data-category="{{ $item['cat'] }}" data-search="{{ mb_strtolower($item['title'].' '.$item['cat']) }}"
                data-lightbox-trigger="{{ \App\Support\Site::imageUrl($item['src']) }}"
                data-lightbox-caption="{{ $item['title'] }}"
                class="stagger-item gallery-tile group {{ $shape }}">
          <img src="{{ \App\Support\Site::imageUrl($item['src']) }}" alt="{{ $item['title'] }}" loading="lazy" />
          <span class="gallery-cap"><b>{{ $item['title'] }}</b><span>{{ $item['cat'] }}</span></span>
          <span class="pointer-events-none absolute right-3 top-3 z-[2] flex h-8 w-8 items-center justify-center rounded-full bg-white/20 text-white opacity-0 backdrop-blur-sm transition-opacity duration-300 group-hover:opacity-100">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" class="h-3.5 w-3.5"><path d="M15 3h6v6"/><path d="M9 21H3v-6"/><path d="M21 3 14 10"/><path d="m3 21 7-7"/></svg>
          </span>
        </button>
      @endforeach
    </div>

    {{-- Ditampilkan otomatis oleh JS bila kategori/pencarian tidak menghasilkan foto --}}
    <div data-filter-empty class="mt-4 flex-col items-center gap-3 rounded-3xl border border-dashed border-border bg-secondary/40 py-14 text-center">
      <span class="mx-auto flex h-12 w-12 items-center justify-center rounded-full bg-accent text-primary"><x-icon name="image" class="w-5 h-5" /></span>
      <p class="text-sm font-medium text-muted-foreground">Tidak ada foto yang cocok dengan pilihan Anda.</p>
    </div>
  </div>
</section>

@endsection
