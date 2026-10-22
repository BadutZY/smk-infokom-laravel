@extends('layouts.app')
@section('title', $jurusan->nama)

@section('content')
@php
  // Warna identitas jurusan (diatur admin) -> dipakai untuk aksen hero & bingkai foto.
  $color = $jurusan->warna_efektif;
@endphp

<x-page-hero :accent="$color" :crumb="$jurusan->kode" :parent="['label' => 'Akademik', 'to' => route('akademik')]" kicker="Kompetensi Keahlian" :title="$jurusan->nama" desc="Penjelasan lengkap program keahlian, poin keunggulan, dan lingkup kerja/peluang profesi bagi lulusan." />

{{-- ===================== DETAIL UTAMA ===================== --}}
<section class="section-pad px-4 sm:px-6 lg:px-8">
  <div class="mx-auto grid max-w-6xl gap-12 lg:grid-cols-[1.02fr_1fr] lg:items-start">
    <div class="reveal-left">
      <div class="major-figure" style="--major: {{ $color }}">
        <div class="major-figure__img">
          <img src="{{ \App\Support\Site::imageUrl($jurusan->gambar) }}" alt="{{ $jurusan->nama }}" />
        </div>
      </div>
    </div>

    <div>
      <span class="major-chip reveal">{{ $jurusan->kode }}</span>
      <h2 class="reveal mt-4 font-display text-2xl font-extrabold tracking-tight text-foreground sm:text-3xl">{{ $jurusan->nama }}</h2>
      <p class="reveal mt-4 whitespace-pre-line text-[15px] leading-[1.85] text-muted-foreground">{{ $jurusan->deskripsi }}</p>

      @if (!empty($jurusan->poin))
        <div class="mt-8">
          <h3 class="reveal flex items-center gap-2 font-display text-base font-bold text-foreground">
            <x-icon name="star" class="w-4 h-4 text-gold" /> Poin Keunggulan
          </h3>
          <ul class="pill-list stagger-group mt-4 grid gap-3 sm:grid-cols-2">
            @foreach ($jurusan->poin as $point)
              <li class="stagger-item">
                <x-icon name="check-circle" class="mt-0.5 w-4 h-4 shrink-0 text-gold" /><span>{{ $point }}</span>
              </li>
            @endforeach
          </ul>
        </div>
      @endif

      <div class="reveal mt-9 flex flex-wrap gap-3">
        <a href="{{ route('ppdb') }}" class="shine inline-flex items-center gap-2 rounded-full bg-gold-gradient px-6 py-3 text-sm font-semibold text-gold-foreground shadow-lift transition-transform hover:-translate-y-0.5">
          Daftar Jurusan Ini <x-icon name="arrow-right" class="w-4 h-4" />
        </a>
        <a href="{{ route('akademik') }}" class="inline-flex items-center gap-2 rounded-full border border-border bg-card px-6 py-3 text-sm font-semibold text-foreground shadow-soft transition-colors hover:border-primary hover:text-primary">
          <x-icon name="arrow-left" class="w-4 h-4" /> Semua Program
        </a>
      </div>
    </div>
  </div>
</section>

{{-- ===================== LINGKUP KERJA ===================== --}}
@if (!empty($jurusan->lingkup_kerja))
<section class="section-pad bg-secondary/50 px-4 sm:px-6 lg:px-8">
  <div class="mx-auto max-w-5xl">
    <x-section-title kicker="Peluang Profesi" title="Lingkup Kerja Lulusan {{ $jurusan->kode }}" desc="Bidang pekerjaan dan profesi yang bisa ditekuni lulusan kompetensi keahlian {{ $jurusan->nama }}." />

    <div class="stagger-group mt-12 grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
      @foreach ($jurusan->lingkup_kerja as $item)
        <div class="stagger-item facility-card card-hover flex items-center gap-4 !p-5">
          <span class="f-icon shrink-0"><x-icon name="award" class="w-5 h-5" /></span>
          <span class="text-sm font-semibold leading-snug text-foreground">{{ $item }}</span>
        </div>
      @endforeach
    </div>
  </div>
</section>
@endif

{{-- ===================== FOTO LABORATORIUM ===================== --}}
@if ($jurusan->gambar_lab)
<section class="section-pad px-4 sm:px-6 lg:px-8">
  <div class="mx-auto max-w-5xl">
    <x-section-title kicker="Fasilitas Praktik" title="Foto Laboratorium {{ $jurusan->kode }}" desc="Ruang praktik/laboratorium yang digunakan siswa kompetensi keahlian {{ $jurusan->nama }} untuk kegiatan belajar." />

    <button type="button" data-lightbox-trigger="{{ \App\Support\Site::imageUrl($jurusan->gambar_lab) }}" data-lightbox-caption="Laboratorium {{ $jurusan->nama }}"
            class="reveal-scale group relative mx-auto mt-12 block w-full max-w-4xl overflow-hidden rounded-3xl shadow-lift">
      <img src="{{ \App\Support\Site::imageUrl($jurusan->gambar_lab) }}" alt="Laboratorium {{ $jurusan->nama }}" loading="lazy" class="aspect-[16/10] w-full object-cover transition-transform duration-[1200ms] ease-out group-hover:scale-105" />
      <span class="absolute bottom-4 right-4 inline-flex items-center gap-2 rounded-full bg-black/55 px-3.5 py-2 text-xs font-semibold text-white backdrop-blur">
        <x-icon name="eye" class="w-3.5 h-3.5" /> Perbesar foto
      </span>
    </button>
  </div>
</section>
@endif

{{-- ===================== JURUSAN LAINNYA ===================== --}}
@if ($lainnya->isNotEmpty())
<section class="section-pad bg-secondary/50 px-4 sm:px-6 lg:px-8">
  <div class="mx-auto max-w-6xl">
    <x-section-title kicker="Program Lain" title="Kompetensi Keahlian Lainnya" />

    <div class="stagger-group mt-12 grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
      @foreach ($lainnya as $item)
        @php
          $m = ['code' => $item->kode, 'slug' => $item->slug, 'name' => $item->nama, 'desc' => $item->deskripsi, 'image' => $item->gambar, 'color' => $item->warna_efektif];
        @endphp
        <x-major-card :major="$m" class="stagger-item" />
      @endforeach
    </div>
  </div>
</section>
@endif

@endsection
