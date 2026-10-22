@extends('layouts.app')
@section('title', 'Profil Sekolah')

@section('content')

<x-page-hero crumb="Profil" kicker="Tentang Kami" title="Profil SMK INFOKOM Kota Bogor" desc="Mengenal lebih dekat sejarah, visi, misi, dan tujuan sekolah." />

{{-- ===================== SEJARAH ===================== --}}
<section class="section-pad overflow-x-clip px-4 sm:px-6 lg:px-8">
  <div class="mx-auto grid max-w-6xl gap-16 lg:grid-cols-[1fr_1.05fr] lg:items-center">
    <div class="reveal-left figure-frame">
      <div class="figure-img aspect-[4/3]">
        <img src="{{ \App\Support\Site::imageUrl($site['images']['students_about']) }}" alt="Siswa SMK INFOKOM" />
      </div>
      <div class="figure-chip">
        <img src="{{ asset('images/logo.png') }}" alt="" />
        <span class="leading-tight">
          <span class="block font-display text-sm font-bold text-foreground">{{ $site['school']['brand_top'] }}</span>
          <span class="block text-[11px] font-semibold text-muted-foreground">{{ $site['school']['brand_bottom'] }}</span>
        </span>
      </div>
    </div>
    <div>
      <x-section-title :center="false" kicker="Sejarah Sekolah" title="{{ $site['school']['name'] }}" />
      <p class="reveal mt-6 whitespace-pre-line text-[15px] leading-[1.85] text-muted-foreground">{{ $site['school']['sejarah'] }}</p>
    </div>
  </div>
</section>

{{-- ===================== SAMBUTAN KEPALA SEKOLAH ===================== --}}
@if (!empty($site['school']['kata_pengantar']))
<section class="section-pad px-4 sm:px-6 lg:px-8">
  <div class="principal-card reveal mx-auto max-w-6xl">
    <span class="accent-bar absolute inset-x-0 top-0" aria-hidden="true"></span>
    <div class="relative grid gap-10 p-8 pt-10 sm:p-10 sm:pt-12 lg:grid-cols-[280px_1fr] lg:gap-14 lg:p-14">
      <div class="mx-auto w-full max-w-[16rem] text-center lg:max-w-none">
        <div class="principal-photo">
          @if (!empty($site['images']['kepala_sekolah']))
            <img src="{{ \App\Support\Site::imageUrl($site['images']['kepala_sekolah']) }}" alt="Foto {{ $site['school']['headmaster'] }}" loading="lazy" />
          @else
            <span class="mb-10 grid h-24 w-24 place-items-center rounded-full bg-accent text-primary"><x-icon name="user" class="h-12 w-12" /></span>
          @endif
        </div>
        @if (!empty($site['school']['headmaster']))
          <p class="mt-4 font-display text-base font-bold text-foreground">{{ $site['school']['headmaster'] }}</p>
          <p class="text-xs font-medium text-muted-foreground">Kepala Sekolah</p>
        @endif
      </div>
      <div class="relative">
        <h2 class="font-display text-2xl font-extrabold tracking-tight text-foreground sm:text-3xl">Sambutan Kepala Sekolah</h2>
        <div class="mt-5 whitespace-pre-line text-[15px] leading-[1.85] text-muted-foreground">{{ $site['school']['kata_pengantar'] }}</div>
      </div>
    </div>
  </div>
</section>
@endif

{{-- ===================== VISI, MISI & TUJUAN ===================== --}}
<section class="section-pad bg-secondary/50 px-4 sm:px-6 lg:px-8">
  <div class="mx-auto max-w-5xl">
    <div data-tabs class="reveal">
      <div class="mx-auto flex w-fit flex-wrap justify-center gap-2 rounded-full border border-border bg-card p-1.5 shadow-soft">
        <button type="button" data-tab-btn="visi-misi" class="rounded-full bg-primary px-5 py-2.5 text-sm font-semibold text-primary-foreground shadow-soft transition-colors">Visi & Misi</button>
        <button type="button" data-tab-btn="tujuan" class="rounded-full px-5 py-2.5 text-sm font-semibold text-muted-foreground transition-colors">Tujuan Sekolah</button>
      </div>

      <div data-tab-panel="visi-misi" class="mt-10 space-y-10">
        <div class="statement">
          <span class="kicker kicker--light"><i class="accent-mark" aria-hidden="true"></i>Visi</span>
          <p class="mt-4 font-display text-xl font-bold leading-snug sm:text-2xl lg:text-[1.65rem]">{{ $site['visi'] }}</p>
        </div>
        <div>
          <h3 class="font-display text-lg font-bold text-foreground">Misi</h3>
          <ol class="pill-list mt-4 grid gap-3 md:grid-cols-2">
            @foreach ($site['misi'] as $i => $item)
              <li><span class="num-dot">{{ $i + 1 }}</span><span class="pt-1">{{ $item }}</span></li>
            @endforeach
          </ol>
        </div>
      </div>

      <div data-tab-panel="tujuan" class="mt-10 hidden">
        <ol class="pill-list grid gap-3 sm:grid-cols-2">
          @foreach ($site['tujuan'] as $i => $item)
            <li><span class="num-dot">{{ $i + 1 }}</span><span class="pt-1">{{ $item }}</span></li>
          @endforeach
        </ol>
      </div>
    </div>
  </div>
</section>

{{-- ===================== TAUTAN KE HALAMAN FASILITAS ===================== --}}
{{-- Fasilitas sekarang punya halaman sendiri (/fasilitas), dikelola di Admin > Fasilitas. --}}
<section class="section-pad px-4 sm:px-6 lg:px-8">
  <div class="mx-auto max-w-6xl">
    <a href="{{ route('fasilitas') }}" class="reveal card-hover group flex flex-col items-center justify-between gap-6 rounded-3xl border border-border bg-card p-8 text-center shadow-soft sm:flex-row sm:p-10 sm:text-left">
      <div class="flex flex-col items-center gap-5 sm:flex-row">
        <span class="flex h-14 w-14 shrink-0 items-center justify-center rounded-2xl bg-navy-gradient text-hero-foreground shadow-soft transition-transform duration-500 group-hover:-rotate-6 group-hover:scale-105">
          <x-icon name="school" class="w-6 h-6" />
        </span>
        <div>
          <h3 class="font-display text-xl font-bold text-foreground sm:text-2xl">Kenali Fasilitas Sekolah Kami</h3>
          <p class="mt-1.5 max-w-xl text-sm leading-relaxed text-muted-foreground">Ruang kelas, perpustakaan, ruang guru, tata usaha, musholla, kantin, taman, dan sarana penunjang lainnya.</p>
        </div>
      </div>
      <span class="inline-flex shrink-0 items-center gap-2 rounded-full bg-gold-gradient px-6 py-3 text-sm font-semibold text-gold-foreground shadow-soft">
        Lihat Fasilitas <x-icon name="arrow-right" class="w-4 h-4 transition-transform duration-300 group-hover:translate-x-1" />
      </span>
    </a>
  </div>
</section>

@endsection