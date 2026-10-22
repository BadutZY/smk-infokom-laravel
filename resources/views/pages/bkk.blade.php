@extends('layouts.app')
@section('title', 'BKK - Bursa Kerja Khusus')
@section('description', 'BKK INFOKOM adalah unit layanan Bursa Kerja Khusus SMK INFOKOM Kota Bogor: info lowongan kerja, bimbingan karier, serta penyaluran & penempatan kerja bagi alumni.')

@section('content')

<style>
  /* ===== Halaman BKK (style khusus halaman ini) ===== */

  /* Jaringan koneksi karier yang melayang lembut di hero */
  .bkk-node {
    position: absolute; width: var(--s, 8px); height: var(--s, 8px); border-radius: 9999px;
    background: var(--gold); opacity: .55; left: var(--l); top: var(--t);
    animation: bkkFloat var(--d, 10s) ease-in-out var(--dl, 0s) infinite;
    box-shadow: 0 0 14px 2px oklch(from var(--gold) l c h / .5);
  }
  @keyframes bkkFloat {
    0%, 100% { transform: translate3d(0,0,0); opacity: .35; }
    50% { transform: translate3d(14px, -22px, 0); opacity: .8; }
  }
  .bkk-grid-glow {
    position: absolute; inset: 0; pointer-events: none;
    background-image: linear-gradient(white 1px, transparent 1px), linear-gradient(90deg, white 1px, transparent 1px);
    background-size: 46px 46px; opacity: .06;
  }

  /* ===== Kartu profil ala Instagram, diselaraskan dengan tema navy/emas situs =====
     Latar kartu memakai warna navy polos (tetap, tidak animasi/berubah warna)
     supaya senada dengan tema situs; jejak "ini Instagram" cukup ditunjukkan
     lewat garis tepi tipis bergradasi warna khas Instagram yang diam (statis). */
  .bkk-profile-card {
    position: relative; isolation: isolate; border-radius: 1.75rem; overflow: hidden;
    background: var(--gradient-navy);
    box-shadow: var(--shadow-lift);
    transition: transform .5s cubic-bezier(.22,1,.36,1), box-shadow .5s cubic-bezier(.22,1,.36,1);
  }
  .bkk-profile-card:hover { transform: translateY(-6px); box-shadow: var(--shadow-lift), 0 0 50px -12px oklch(from var(--gold) l c h / .55); }
  .bkk-profile-card::before {
    /* Garis tepi tipis warna khas Instagram (ungu-pink-oranye), statis — bukan untuk latar penuh. */
    content: ''; position: absolute; inset: 0; z-index: -1; border-radius: inherit;
    padding: 1.5px;
    background: linear-gradient(135deg, #4f5bd5, #962fbf, #d62976, #fa7e1e, #feda75);
    -webkit-mask: linear-gradient(#000 0 0) content-box, linear-gradient(#000 0 0);
    -webkit-mask-composite: xor; mask-composite: exclude;
    opacity: .9;
  }
  .bkk-profile-head { position: relative; padding: 2rem 1.75rem 1.5rem; text-align: center; }
  .bkk-avatar-ring {
    position: relative; margin: 0 auto; display: flex; height: 5.5rem; width: 5.5rem; align-items: center; justify-content: center;
    border-radius: 9999px; background: linear-gradient(135deg, #4f5bd5, #962fbf, #d62976, #fa7e1e, #feda75);
    padding: 3px;
  }
  .bkk-avatar-inner {
    display: flex; height: 100%; width: 100%; align-items: center; justify-content: center; overflow: hidden; border-radius: 9999px;
    background: oklch(0.18 0.05 262); color: var(--gold);
  }
  .bkk-avatar-inner img { height: 100%; width: 100%; object-fit: cover; border-radius: 9999px; }
  .bkk-stats-row { display: grid; grid-template-columns: repeat(3, 1fr); border-top: 1px solid rgb(255 255 255 / .1); border-bottom: 1px solid rgb(255 255 255 / .1); }
  .bkk-stats-row > div { padding: 1.1rem .5rem; text-align: center; border-right: 1px solid rgb(255 255 255 / .1); }
  .bkk-stats-row > div:last-child { border-right: 0; }
  .bkk-follow-btn {
    position: relative; display: flex; align-items: center; justify-content: center; gap: .5rem;
    margin: 1.25rem; padding: .9rem 1rem; border-radius: 1rem; overflow: hidden;
    background: white; color: oklch(0.2 0.05 262); font-weight: 700; font-size: .875rem;
    transition: transform .3s cubic-bezier(.22,1,.36,1), box-shadow .3s ease;
  }
  .bkk-follow-btn:hover { transform: translateY(-2px) scale(1.015); box-shadow: 0 10px 26px -8px rgb(0 0 0 / .45); }

  /* ===== Kartu media (foto/video/embed) — kartu biasa, bukan bentuk HP ===== */
  .bkk-card { transition: transform .4s cubic-bezier(.22,1,.36,1), box-shadow .4s cubic-bezier(.22,1,.36,1), border-color .4s cubic-bezier(.22,1,.36,1); }

  .bkk-media {
    position: relative; overflow: hidden; aspect-ratio: 4 / 3;
    background: linear-gradient(160deg, oklch(0.3 0.09 258), oklch(0.2 0.07 262));
  }
  /* Latar belakang buram (versi zoom dari foto yang sama) supaya tidak ada area kosong,
     sementara foto asli di atasnya tampil UTUH 100% tanpa terpotong/terzoom. */
  .bkk-media-bg {
    position: absolute; inset: 0; z-index: 0; width: 100%; height: 100%; object-fit: cover;
    filter: blur(26px) brightness(.55) saturate(1.15); transform: scale(1.25);
    transition: transform .8s cubic-bezier(.22,1,.36,1);
  }
  .bkk-card:hover .bkk-media-bg { transform: scale(1.35); }
  .bkk-media-img {
    position: absolute; inset: 0; z-index: 1; width: 100%; height: 100%;
    object-fit: contain; object-position: center; box-sizing: border-box; padding: .85rem;
  }
  .bkk-media-video { background: #000; object-fit: contain; }

  .bkk-chip { position: absolute; left: .9rem; top: .9rem; z-index: 3; display: inline-flex; align-items: center; gap: .35rem; border-radius: 9999px; background: rgb(255 255 255 / .18); padding: .3rem .7rem; font-size: 10px; font-weight: 600; letter-spacing: .05em; text-transform: uppercase; color: white; backdrop-filter: blur(6px); }

  .bkk-photo-trigger { position: absolute; inset: 0; z-index: 2; cursor: zoom-in; }

  .bkk-play { position: absolute; left: 50%; top: 50%; z-index: 3; display: flex; align-items: center; justify-content: center; width: 4rem; height: 4rem; transform: translate(-50%, -50%); border-radius: 9999px; background: white; color: var(--primary); box-shadow: 0 10px 30px -8px rgb(0 0 0 / .5); transition: transform .3s cubic-bezier(.22,1,.36,1); cursor: pointer; }
  .bkk-play::before, .bkk-play::after { content: ''; position: absolute; inset: 0; border-radius: inherit; border: 2px solid white; opacity: 0; animation: bkkRing 2.4s ease-out infinite; }
  .bkk-play::after { animation-delay: 1.2s; }
  @keyframes bkkRing { 0% { transform: scale(1); opacity: .7; } 100% { transform: scale(1.9); opacity: 0; } }
  .bkk-card:hover .bkk-play { transform: translate(-50%, -50%) scale(1.1); }

  .bkk-frame { position: absolute; inset: 0; z-index: 4; width: 100%; height: 100%; border: 0; background: white; }
  .bkk-loading { position: absolute; inset: 0; z-index: 3; display: none; align-items: center; justify-content: center; background: rgb(0 0 0 / .35); color: white; }
  [data-bkk-reel].is-playing .bkk-loading { display: flex; }
  [data-bkk-reel].is-playing .bkk-media-bg,
  [data-bkk-reel].is-playing .bkk-media-img,
  [data-bkk-reel].is-playing .bkk-play,
  [data-bkk-reel].is-playing .bkk-chip { visibility: hidden; }
  .bkk-stop { position: absolute; right: .7rem; top: .7rem; z-index: 6; display: none; height: 1.9rem; width: 1.9rem; align-items: center; justify-content: center; border-radius: 9999px; background: rgb(0 0 0 / .65); color: white; }
  [data-bkk-reel].is-playing .bkk-stop { display: flex; }

  .bkk-line { position: absolute; left: 1.55rem; top: 0; bottom: 0; width: 2px; background: linear-gradient(to bottom, var(--gold), var(--teal), transparent); }
  @media (min-width: 1024px) { .bkk-line { display: none; } }

  @media (prefers-reduced-motion: reduce) {
    .bkk-node, .bkk-play::before, .bkk-play::after { animation: none !important; }
    .bkk-card:hover, .bkk-profile-card:hover { transform: none; }
    .bkk-card:hover .bkk-media-bg { transform: scale(1.25); }
  }
</style>

{{-- ===================== HERO ===================== --}}
<section class="relative overflow-hidden bg-navy-radial pb-28 pt-24 text-hero-foreground sm:pb-32 sm:pt-28">
  <div class="pointer-events-none absolute inset-0 bg-grain"></div>
  <div class="bkk-grid-glow pointer-events-none"></div>

  <div class="pointer-events-none absolute inset-0 overflow-hidden" aria-hidden="true">
    @for ($i = 0; $i < 14; $i++)
      <span class="bkk-node" style="--l:{{ ($i * 7.3 + 4) % 96 }}%; --t:{{ ($i * 11.5 + 6) % 80 }}%; --s:{{ 6 + ($i % 3) * 3 }}px; --d:{{ 8 + ($i % 5) * 2 }}s; --dl:-{{ number_format($i * 0.8, 1) }}s;"></span>
    @endfor
  </div>

  <div class="relative mx-auto max-w-4xl px-4 text-center sm:px-6 lg:px-8">
    <span class="enter-item enter-d1 kicker kicker--light">
      <x-icon name="briefcase" class="w-3.5 h-3.5" />Bursa Kerja Khusus
    </span>
    <h1 class="enter-item enter-d2 mt-5 font-display text-4xl font-extrabold leading-[1.1] sm:text-5xl lg:text-6xl">
      BKK INFOKOM, Jembatan Menuju <span class="text-gradient-gold">Dunia Kerja</span>
    </h1>
    <p class="enter-item enter-d3 mx-auto mt-5 max-w-2xl text-base text-white/75 sm:text-lg">
      Unit layanan resmi {{ $site['school']['brand_top'] }} yang menghubungkan lulusan dengan info lowongan kerja, bimbingan karier, serta penyaluran dan penempatan tenaga kerja ke dunia industri.
    </p>
    <div class="enter-item enter-d4 mt-8 flex flex-wrap items-center justify-center gap-3">
      <a href="#profil-ig" class="shine inline-flex items-center gap-2 rounded-full bg-gold-gradient px-6 py-3 text-sm font-semibold text-gold-foreground shadow-lift glow-gold transition-transform hover:-translate-y-0.5">
        Info Loker Terbaru <x-icon name="arrow-right" class="w-4 h-4" />
      </a>
      <a href="{{ route('kontak') }}" class="inline-flex items-center gap-2 rounded-full border border-white/30 px-6 py-3 text-sm font-semibold text-white transition-colors hover:bg-white/10">
        Hubungi BKK
      </a>
    </div>
  </div>

  <span class="accent-bar absolute inset-x-0 bottom-0" aria-hidden="true"></span>
</section>

{{-- ===================== TENTANG BKK ===================== --}}
<section class="relative -mt-10 px-4 sm:px-6 lg:px-8">
  <div class="reveal-scale mx-auto max-w-4xl rounded-3xl border border-border bg-card p-7 text-center shadow-lift sm:p-10">
    <span class="mx-auto flex h-12 w-12 items-center justify-center rounded-full bg-navy-gradient text-hero-foreground"><x-icon name="info" class="w-6 h-6" /></span>
    <h2 class="mt-4 font-display text-xl font-bold text-foreground sm:text-2xl">Apa itu BKK?</h2>
    <p class="mx-auto mt-3 max-w-2xl text-sm leading-relaxed text-muted-foreground sm:text-base">
      {{-- Dikelola dari panel admin: BKK > tab "Konten Umum & Instagram". --}}
      {{ $konten->apa_itu ?? '' }}
    </p>
  </div>
</section>

{{-- ===================== LAYANAN BKK ===================== --}}
<section class="section-pad px-4 sm:px-6 lg:px-8">
  <div class="mx-auto max-w-6xl">
    <x-section-title kicker="Layanan" title="Apa Saja yang BKK Bantu?" desc="Empat layanan utama BKK INFOKOM untuk mempersiapkan dan menyalurkan alumni ke dunia kerja." />

    {{-- Dikelola dari panel admin: BKK > tab "Layanan BKK". --}}
    @if ($layananList->isEmpty())
      <p class="mt-10 text-center text-sm text-muted-foreground">Belum ada data.</p>
    @else
    <div class="stagger-group mt-12 grid gap-6 sm:grid-cols-2 lg:grid-cols-4">
      @foreach ($layananList as $layanan)
        <div class="stagger-item card-hover group rounded-2xl border border-border bg-card p-6 shadow-soft">
          <span class="flex h-12 w-12 items-center justify-center rounded-xl bg-navy-gradient text-hero-foreground transition-transform duration-300 group-hover:-rotate-6 group-hover:scale-110">
            <x-icon :name="$layanan->icon" class="w-6 h-6" />
          </span>
          <h3 class="mt-5 font-display text-base font-bold text-foreground">{{ $layanan->judul }}</h3>
          <p class="mt-2 text-sm leading-relaxed text-muted-foreground">{{ $layanan->deskripsi }}</p>
        </div>
      @endforeach
    </div>
    @endif
  </div>
</section>

{{-- ===================== PROFIL INSTAGRAM ===================== --}}
<section id="profil-ig" class="section-pad scroll-mt-24 bg-secondary/50 px-4 sm:px-6 lg:px-8">
  <div class="mx-auto max-w-6xl">
    <x-section-title kicker="Ikuti Kami" title="Update Info Loker via Instagram" desc="Pantau info lowongan kerja dan kegiatan BKK terbaru langsung dari akun resmi Instagram kami." />

    <div class="mt-12 grid items-center gap-10 lg:grid-cols-2">
      {{-- Kartu profil ala Instagram --}}
      <div class="reveal mx-auto w-full max-w-sm">
        <div class="bkk-profile-card">
          <div class="bkk-profile-head">
            <div class="bkk-avatar-ring">
              <span class="bkk-avatar-inner">
                {{-- Dikelola dari panel admin: BKK > tab "Konten Umum & Instagram". --}}
                @if ($konten->ig_foto ?? null)
                  <img src="{{ \App\Support\Site::imageUrl($konten->ig_foto) }}" alt="Foto profil {{ $konten->ig_nama ?? 'BKK INFOKOM' }}" />
                @else
                  <x-icon name="briefcase" class="w-8 h-8" />
                @endif
              </span>
            </div>
            {{-- Dikelola dari panel admin: BKK > tab "Konten Umum & Instagram". --}}
            <h3 class="mt-4 font-display text-lg font-extrabold text-white">{{ $konten->ig_nama ?? 'BKK INFOKOM' }}</h3>
            <p class="mt-0.5 text-sm font-medium text-gold">&#64;{{ $konten->ig_username ?? 'bkkinfokom' }}</p>
            <p class="mx-auto mt-3 max-w-[240px] text-xs leading-relaxed text-white/60">{{ $konten->ig_bio ?? '' }}</p>
          </div>

          <div class="bkk-stats-row text-white">
            <div>
              <p class="font-display text-xl font-extrabold">{{ $konten->ig_kiriman ?? 0 }}</p>
              <p class="mt-0.5 text-[10px] font-semibold uppercase tracking-wider text-white/55">Kiriman</p>
            </div>
            <div>
              <p class="font-display text-xl font-extrabold">{{ $konten->ig_pengikut ?? 0 }}</p>
              <p class="mt-0.5 text-[10px] font-semibold uppercase tracking-wider text-white/55">Pengikut</p>
            </div>
            <div>
              <p class="font-display text-xl font-extrabold">{{ $konten->ig_diikuti ?? 0 }}</p>
              <p class="mt-0.5 text-[10px] font-semibold uppercase tracking-wider text-white/55">Diikuti</p>
            </div>
          </div>

          <a href="{{ $konten->ig_url ?? '#' }}" target="_blank" rel="noopener" class="bkk-follow-btn">
            <x-icon name="instagram" class="w-4 h-4" /> Kunjungi Instagram <x-icon name="external-link" class="w-3.5 h-3.5" />
          </a>
        </div>
      </div>

      {{-- Kenapa follow — dikelola dari panel admin: BKK > tab "Alasan Follow Instagram". --}}
      <div class="reveal">
        <div class="stagger-group grid gap-5">
          @foreach ($followList as $follow)
            <div class="stagger-item flex items-start gap-4 rounded-2xl border border-border bg-card p-5 shadow-soft">
              <span class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-accent text-primary"><x-icon :name="$follow->icon" class="w-5 h-5" /></span>
              <div>
                <h4 class="font-display text-sm font-bold text-foreground">{{ $follow->judul }}</h4>
                <p class="mt-1 text-sm leading-relaxed text-muted-foreground">{{ $follow->deskripsi }}</p>
              </div>
            </div>
          @endforeach
        </div>
      </div>
    </div>
  </div>
</section>

{{-- ===================== GALERI MEDIA BKK ===================== --}}
<section id="media" class="section-pad scroll-mt-24 px-4 sm:px-6 lg:px-8">
  <div class="mx-auto max-w-6xl">
    <x-section-title kicker="Dokumentasi" title="Kegiatan & Info Terbaru BKK" desc="Tekan tombol putar untuk menonton, atau tekan foto untuk memperbesar." />

    @if ($media->isEmpty())
      <p class="mt-14 text-center text-sm text-muted-foreground">Belum ada media BKK. Admin dapat menambahkannya lewat panel Konten Website &gt; BKK.</p>
    @else
    <div class="stagger-group mt-14 grid gap-7 sm:grid-cols-2 lg:grid-cols-3">
      @php
        $posters = [
          'from-primary via-primary-soft to-teal',
          'from-primary via-primary-soft to-[oklch(0.65_0.16_75)]',
          'from-primary via-primary-soft to-[oklch(0.55_0.1_200)]',
        ];
        $chipIcons = ['foto' => 'image', 'video_lokal' => 'video', 'youtube' => 'youtube', 'instagram' => 'instagram'];
      @endphp
      @foreach ($media as $m)
        @php
          $isFoto = $m->isFoto();
          $poster = $m->posterUrl();
        @endphp
        <article class="stagger-item bkk-card card-hover overflow-hidden rounded-2xl border border-border bg-card shadow-soft">
          <div @if (! $isFoto) data-bkk-reel data-type="{{ $m->jenis_media }}" data-src="{{ $m->embedSrc() }}" @endif
               class="bkk-media bg-gradient-to-br {{ $posters[$m->tema % 3] }}">
            @if (! $isFoto)
              <button type="button" class="bkk-stop" data-bkk-reel-stop aria-label="Tutup video">
                <x-icon name="x" class="w-4 h-4" />
              </button>
              <span class="bkk-loading"><span class="btn-spinner" style="width:1.6rem;height:1.6rem;"></span></span>
            @endif

            @if ($poster)
              <img src="{{ $poster }}" alt="" aria-hidden="true" class="bkk-media-bg" loading="lazy" />
              <img src="{{ $poster }}" alt="{{ $m->judul }}" class="bkk-media-img" loading="lazy" />
            @else
              <x-icon name="briefcase" class="absolute right-4 top-4 h-16 w-16 text-white/10" />
            @endif

            <span class="bkk-chip"><x-icon :name="$chipIcons[$m->jenis_media] ?? 'video'" class="w-3 h-3" />{{ $m->jenisLabel() }}</span>

            @if ($isFoto)
              <button type="button" data-lightbox-trigger="{{ $poster }}" data-lightbox-caption="{{ $m->judul }}" aria-label="Perbesar foto {{ $m->judul }}" class="bkk-photo-trigger"></button>
            @else
              <button type="button" data-bkk-reel-play aria-label="Putar video {{ $m->judul }}" class="bkk-play">
                <svg viewBox="0 0 24 24" fill="currentColor" class="ml-1 h-6 w-6" aria-hidden="true"><path d="M8 5.5v13a1 1 0 0 0 1.5.86l10.5-6.5a1 1 0 0 0 0-1.72L9.5 4.64A1 1 0 0 0 8 5.5Z"/></svg>
              </button>
            @endif
          </div>

          <div class="p-5">
            <h3 class="font-display text-base font-bold leading-snug text-foreground">{{ $m->judul }}</h3>
            @if ($m->keterangan)
              <p class="mt-1.5 text-sm leading-relaxed text-muted-foreground">{{ $m->keterangan }}</p>
            @endif
            @if ($m->sourceUrl())
              <a href="{{ $m->sourceUrl() }}" target="_blank" rel="noopener" class="mt-3 inline-flex items-center gap-1.5 text-sm font-semibold text-primary hover:underline">
                <x-icon :name="$chipIcons[$m->jenis_media]" class="w-4 h-4" />{{ $m->sourceLabel() }}
              </a>
            @endif
          </div>
        </article>
      @endforeach
    </div>
    @endif
  </div>
</section>

{{-- ===================== ALUR LAYANAN ===================== --}}
<section class="section-pad bg-secondary/50 px-4 sm:px-6 lg:px-8">
  <div class="mx-auto max-w-6xl">
    <x-section-title kicker="Alur Layanan" title="Cara Kerja Layanan BKK" desc="Langkah sederhana bagi alumni untuk mendapatkan pendampingan hingga penyaluran kerja." />

    {{-- Dikelola dari panel admin: BKK > tab "Cara Kerja Layanan". --}}
    @if ($langkahList->isEmpty())
      <p class="mt-10 text-center text-sm text-muted-foreground">Belum ada data.</p>
    @else
    <div class="relative mt-14">
      <div class="bkk-line"></div>
      <div class="stagger-group grid gap-8 lg:grid-cols-4">
        @foreach ($langkahList as $langkah)
          <div class="stagger-item relative pl-16 lg:pl-0 lg:text-center">
            <span class="absolute left-0 top-0 flex h-12 w-12 items-center justify-center rounded-full bg-gold-gradient font-display text-sm font-extrabold text-gold-foreground shadow-soft glow-gold lg:relative lg:mx-auto">{{ $langkah->nomor }}</span>
            <h3 class="mt-1 font-display text-base font-bold text-foreground lg:mt-4">{{ $langkah->judul }}</h3>
            <p class="mt-2 text-sm leading-relaxed text-muted-foreground">{{ $langkah->deskripsi }}</p>
          </div>
        @endforeach
      </div>
    </div>
    @endif
  </div>
</section>

{{-- ===================== CTA ===================== --}}
<section class="section-pad px-4 sm:px-6 lg:px-8">
  <div class="reveal relative mx-auto max-w-6xl overflow-hidden rounded-3xl bg-navy-radial px-8 py-16 text-center text-hero-foreground shadow-lift sm:px-16">
    <div class="pointer-events-none absolute inset-0 bg-grain"></div>
    <span class="bg-orb float-y -left-10 -top-10 h-52 w-52 bg-gold/25"></span>
    <span class="bg-orb float-y h-52 w-52 bg-teal/25" style="right:-2.5rem; bottom:-2.5rem; animation-delay:1s;"></span>
    <div class="relative">
      <h2 class="font-display text-3xl font-bold sm:text-4xl">Siap Melangkah ke <span class="text-gradient-gold">Dunia Kerja?</span></h2>
      <p class="mx-auto mt-3 max-w-xl text-sm text-white/75 sm:text-base">Ikuti Instagram BKK INFOKOM untuk info loker terbaru, atau hubungi kami langsung untuk konsultasi karier.</p>
      <div class="mt-8 flex flex-wrap items-center justify-center gap-3">
        <a href="{{ $konten->ig_url ?? '#' }}" target="_blank" rel="noopener" class="shine inline-flex items-center gap-2 rounded-full bg-gold-gradient px-7 py-3 text-sm font-semibold text-gold-foreground shadow-lift glow-gold transition-transform hover:-translate-y-0.5">
          <x-icon name="instagram" class="w-4 h-4" /> &#64;{{ $konten->ig_username ?? 'bkkinfokom' }}
        </a>
        <a href="{{ route('kontak') }}" class="inline-flex items-center gap-2 rounded-full border border-white/30 px-7 py-3 text-sm font-semibold text-white transition-colors hover:bg-white/10">
          Hubungi BKK
        </a>
      </div>
    </div>
  </div>
</section>

<script>
  // Video dimuat hanya saat diputar (halaman tetap ringan & cepat).
  // Mendukung: video upload (tag video), YouTube dan Instagram (iframe).
  (function () {
    var cards = document.querySelectorAll('[data-bkk-reel]');

    function stop(card) {
      var f = card.querySelector('.bkk-frame');
      if (f) {
        if (typeof f.pause === 'function') f.pause();
        f.remove();
      }
      card.classList.remove('is-playing');
    }

    function start(card) {
      var type = card.dataset.type;
      var src = card.dataset.src;
      if (!src) return;
      var el;

      if (type === 'video_lokal') {
        el = document.createElement('video');
        el.className = 'bkk-frame bkk-media-video';
        el.src = src;
        el.controls = true;
        el.autoplay = true;
        el.setAttribute('playsinline', '');
        el.preload = 'metadata';
      } else {
        el = document.createElement('iframe');
        el.className = 'bkk-frame';
        el.src = src;
        el.setAttribute('scrolling', 'no');
        el.setAttribute('allowfullscreen', '');
        el.setAttribute('allow', 'autoplay; encrypted-media; picture-in-picture; fullscreen');
        el.setAttribute('title', 'Video BKK INFOKOM');
      }

      card.querySelector('.bkk-media').appendChild(el);
      card.classList.add('is-playing');
    }

    cards.forEach(function (card) {
      var play = card.querySelector('[data-bkk-reel-play]');
      var close = card.querySelector('[data-bkk-reel-stop]');

      play.addEventListener('click', function () {
        cards.forEach(function (c) { if (c !== card) stop(c); }); // hanya 1 video aktif
        start(card);
      });
      close.addEventListener('click', function () { stop(card); });
    });
  })();
</script>

@endsection