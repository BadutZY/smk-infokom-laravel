@extends('layouts.app')
@section('title', $item->judul)
@section('description', $item->ringkasan)

@section('content')

<div class="read-progress-track"><div data-read-progress-bar class="read-progress-bar"></div></div>

@php
  $mins = max(1, (int) ceil(count(preg_split('/\s+/u', trim(strip_tags((string) $item->konten)), -1, PREG_SPLIT_NO_EMPTY)) / 200));
@endphp

<section class="relative overflow-hidden bg-navy-radial pb-14 pt-12 text-hero-foreground">
  <div class="pointer-events-none absolute inset-0 bg-grain"></div>
  <span class="bg-orb float-y -left-16 -top-16 h-56 w-56 bg-gold/20"></span>
  <span class="bg-orb float-y h-64 w-64 bg-teal/15" style="right:-4rem; bottom:-3rem; animation-delay:1s;"></span>
  <div class="hud-grid"></div>

  <div class="relative mx-auto max-w-3xl px-4 sm:px-6 lg:px-8">
    <nav class="hero-crumb enter-item enter-d1" aria-label="Breadcrumb">
      <a href="{{ route('home') }}">Beranda</a><span aria-hidden="true">/</span><a href="{{ route('berita.index') }}">Berita</a><span aria-hidden="true">/</span><span aria-current="page">{{ $item->kategori }}</span>
    </nav>
    <span class="news-tag enter-item enter-d2 mt-7">{{ $item->kategori }}</span>
    <h1 class="enter-item enter-d3 mt-4 font-display text-3xl font-extrabold leading-[1.12] tracking-tight sm:text-4xl lg:text-[2.75rem]">{{ $item->judul }}</h1>
    <div class="enter-item enter-d4 mt-6 flex flex-wrap items-center gap-x-6 gap-y-2 text-sm text-white/70">
      <span class="meta-chip"><x-icon name="user" class="w-4 h-4" /> {{ $item->penulis }}</span>
      <span class="meta-chip"><x-icon name="calendar-days" class="w-4 h-4" /> {{ \App\Support\Site::formatTanggalPanjang($item->tanggal) }}</span>
      <span class="meta-chip"><x-icon name="clock" class="w-4 h-4" /> {{ $mins }} menit baca</span>
    </div>
  </div>
  <span class="accent-bar absolute inset-x-0 bottom-0" aria-hidden="true"></span>
</section>

<section class="px-4 pb-20 pt-10 sm:px-6 lg:px-8">
  <div data-read-progress class="mx-auto max-w-3xl">
    <div class="enter-item enter-d2 aspect-[16/9] overflow-hidden rounded-3xl shadow-lift ring-1 ring-black/5">
      <img src="{{ \App\Support\Site::imageUrl($item->gambar_sampul) }}" alt="{{ $item->judul }}" class="h-full w-full object-cover" />
    </div>

    <article class="article mt-10">
      @foreach (explode("\n", $item->konten) as $paragraf)
        @if (trim($paragraf) !== '')
          <p>{{ $paragraf }}</p>
        @endif
      @endforeach
    </article>

    {{-- ===================== BAGIKAN ARTIKEL ===================== --}}
    <div class="reveal mt-10 flex flex-wrap items-center gap-3 border-y border-border py-5">
      <span class="text-sm font-semibold text-foreground">Bagikan artikel ini:</span>
      <button type="button" data-share="whatsapp" aria-label="Bagikan ke WhatsApp" class="share-btn flex h-9 w-9 items-center justify-center rounded-full bg-secondary text-muted-foreground hover:bg-[#25D366] hover:text-white">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="h-4 w-4"><path d="M12.04 2c-5.5 0-9.96 4.46-9.96 9.96 0 1.76.46 3.4 1.26 4.83L2 22l5.35-1.28a9.9 9.9 0 0 0 4.69 1.2h.01c5.5 0 9.96-4.47 9.96-9.97 0-2.66-1.04-5.16-2.92-7.04A9.9 9.9 0 0 0 12.04 2Zm5.8 14.24c-.24.68-1.4 1.3-1.93 1.37-.5.08-1.1.11-1.78-.11-.4-.13-.92-.3-1.6-.58-2.8-1.2-4.63-4.02-4.77-4.2-.14-.19-1.14-1.51-1.14-2.88 0-1.37.72-2.04.97-2.32.25-.28.55-.35.73-.35h.53c.17 0 .4-.06.62.48.24.57.8 1.98.87 2.12.07.14.12.31.02.5-.09.19-.14.31-.28.47-.14.17-.29.37-.42.5-.14.14-.28.29-.12.57.16.28.71 1.18 1.53 1.91 1.05.94 1.93 1.23 2.21 1.37.28.14.44.12.6-.07.17-.19.71-.83.9-1.11.19-.28.38-.24.63-.14.26.09 1.64.78 1.92.92.28.14.47.21.53.33.07.12.07.68-.17 1.36Z"/></svg>
      </button>
      <button type="button" data-share="facebook" aria-label="Bagikan ke Facebook" class="share-btn flex h-9 w-9 items-center justify-center rounded-full bg-secondary text-muted-foreground hover:bg-[#1877F2] hover:text-white">
        <x-icon name="facebook" class="h-4 w-4" />
      </button>
      <button type="button" data-share="twitter" aria-label="Bagikan ke X / Twitter" class="share-btn flex h-9 w-9 items-center justify-center rounded-full bg-secondary text-muted-foreground hover:bg-black hover:text-white">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="h-3.5 w-3.5"><path d="M18.9 2H22l-7.6 8.7L23 22h-7l-5.5-6.7L4.3 22H1.1l8.2-9.3L1 2h7.2l5 6.1L18.9 2Zm-1.2 18h1.7L7.4 4H5.6l12.1 16Z"/></svg>
      </button>
      <button type="button" data-share="copy" class="share-btn inline-flex items-center gap-2 rounded-full bg-secondary px-4 py-2 text-xs font-semibold text-muted-foreground hover:bg-accent hover:text-primary">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" class="h-4 w-4"><rect x="9" y="9" width="13" height="13" rx="2"/><path d="M5 15H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h9a2 2 0 0 1 2 2v1"/></svg>
        <span>Salin Tautan</span>
      </button>
    </div>

    @if ($galeri->count() > 1)
      <div class="mt-10">
        <h3 class="font-display text-xl font-extrabold tracking-tight text-foreground">Galeri Foto</h3>
        <div data-lightbox-scope class="mt-4 grid grid-cols-2 gap-3 sm:grid-cols-3">
          @foreach ($galeri as $foto)
            <button type="button" data-lightbox-trigger="{{ \App\Support\Site::imageUrl($foto) }}" data-lightbox-caption="{{ $item->judul }}" class="group aspect-square overflow-hidden rounded-2xl border border-border shadow-soft">
              <img src="{{ \App\Support\Site::imageUrl($foto) }}" alt="Galeri {{ $item->judul }}" class="h-full w-full object-cover transition-transform duration-700 group-hover:scale-105" />
            </button>
          @endforeach
        </div>
      </div>
    @endif

    @if ($related->count() > 0)
      <div class="mt-16 border-t border-border pt-10">
        <h3 class="font-display text-xl font-extrabold tracking-tight text-foreground">Berita Lainnya</h3>
        <div class="mt-6 grid gap-5 sm:grid-cols-3">
          @foreach ($related as $rel)
            <a href="{{ route('berita.show', $rel->slug) }}" class="tilt-glow card-hover group overflow-hidden rounded-2xl border border-border bg-card shadow-soft">
              <div class="aspect-[4/3] overflow-hidden">
                <img src="{{ \App\Support\Site::imageUrl($rel->gambar_sampul) }}" alt="{{ $rel->judul }}" class="h-full w-full object-cover transition-transform duration-500 group-hover:scale-105" />
              </div>
              <div class="p-4">
                <p class="line-clamp-2 text-sm font-bold text-foreground transition-colors group-hover:text-primary">{{ $rel->judul }}</p>
                <p class="mt-1 text-xs text-muted-foreground">{{ \App\Support\Site::formatTanggal($rel->tanggal) }}</p>
              </div>
            </a>
          @endforeach
        </div>
      </div>
    @endif
  </div>
</section>

@endsection
