@extends('layouts.app')
@section('title', 'Magang ke Jepang')
@section('description', 'Kisah alumni SMK INFOKOM Kota Bogor yang berangkat magang ke Jepang.')

@section('content')

<style>
  /* ===== Halaman Magang Jepang (style khusus halaman ini) ===== */
  .jp-sakura { --jp-pink: oklch(0.86 0.08 8); --jp-red: oklch(0.6 0.22 25); }

  /* Matahari terbit (Hinomaru) berdenyut lembut di belakang judul */
  .jp-sun {
    position: absolute; left: 50%; top: 46%; width: min(560px, 90vw); aspect-ratio: 1;
    transform: translate(-50%, -50%); border-radius: 9999px; pointer-events: none;
    background: radial-gradient(circle, oklch(0.6 0.22 25 / 0.55) 0%, oklch(0.6 0.22 25 / 0.18) 45%, transparent 70%);
    animation: jpSunPulse 6s ease-in-out infinite;
  }
  @keyframes jpSunPulse {
    0%, 100% { transform: translate(-50%, -50%) scale(1); opacity: .85; }
    50% { transform: translate(-50%, -50%) scale(1.08); opacity: 1; }
  }

  .jp-kanji {
    position: absolute; pointer-events: none; user-select: none; font-weight: 800; line-height: 1;
    font-family: 'Yu Mincho', 'Hiragino Mincho ProN', 'Noto Serif JP', serif;
    color: white; opacity: .05;
  }

  /* Kelopak sakura berjatuhan */
  .jp-petal {
    position: absolute; top: -8%; left: var(--l); width: var(--s); height: var(--s);
    background: linear-gradient(135deg, oklch(0.93 0.05 8), oklch(0.78 0.13 5));
    border-radius: 150% 0 150% 0; opacity: .0; pointer-events: none;
    animation: jpFall var(--d) linear var(--dl) infinite;
    filter: drop-shadow(0 2px 4px oklch(0.6 0.2 10 / .25));
  }
  @keyframes jpFall {
    0%   { transform: translate3d(0, 0, 0) rotate(0deg); opacity: 0; }
    10%  { opacity: .9; }
    50%  { transform: translate3d(40px, 340px, 0) rotate(200deg); }
    100% { transform: translate3d(-30px, 720px, 0) rotate(420deg); opacity: 0; }
  }

  /* Pita teks berjalan */
  .jp-ticker { -webkit-mask-image: linear-gradient(to right, transparent, black 8%, black 92%, transparent); mask-image: linear-gradient(to right, transparent, black 8%, black 92%, transparent); }

  /* Kartu video ala ponsel */
  .jp-phone {
    position: relative; isolation: isolate; border-radius: 2.25rem; padding: .6rem;
    background: linear-gradient(160deg, oklch(0.3 0.09 258), oklch(0.2 0.07 262));
    box-shadow: var(--shadow-lift);
    transition: transform .45s cubic-bezier(.22,1,.36,1), box-shadow .45s cubic-bezier(.22,1,.36,1);
  }
  .jp-phone:hover { transform: translateY(-10px) rotate(-.6deg); box-shadow: var(--shadow-lift), 0 0 44px -10px oklch(from var(--gold) l c h / .5); }
  .jp-phone::before {
    content: ''; position: absolute; inset: -2px; z-index: -1; border-radius: inherit;
    background: linear-gradient(135deg, var(--gold), oklch(0.75 0.13 5), var(--teal), var(--gold));
    background-size: 240% 240%; animation: gradientShift 7s ease infinite; opacity: .9;
  }
  .jp-screen { position: relative; overflow: hidden; border-radius: 1.75rem; aspect-ratio: 9 / 19; background: oklch(0.16 0.05 262); }
  .jp-notch { position: absolute; top: .55rem; left: 50%; z-index: 5; width: 5.5rem; height: 1.35rem; transform: translateX(-50%); border-radius: 9999px; background: oklch(0.12 0.03 262); }

  .jp-poster { position: absolute; inset: 0; display: flex; flex-direction: column; justify-content: flex-end; padding: 1.25rem; color: white; cursor: pointer; text-align: left; width: 100%; }
  .jp-poster .jp-sun-mini { position: absolute; right: -25%; top: 12%; width: 85%; aspect-ratio: 1; border-radius: 9999px; background: radial-gradient(circle at 35% 35%, oklch(0.72 0.2 27), oklch(0.55 0.22 25)); opacity: .85; transition: transform .8s cubic-bezier(.22,1,.36,1); }
  .jp-phone:hover .jp-sun-mini { transform: scale(1.12) translate(-4%, 2%); }
  .jp-poster .jp-kanji-big { position: absolute; left: .6rem; top: 3rem; font-size: 7rem; opacity: .13; font-family: 'Yu Mincho','Hiragino Mincho ProN','Noto Serif JP',serif; font-weight: 800; }
  .jp-poster::after { content: ''; position: absolute; inset: 0; background: linear-gradient(to top, oklch(0.14 0.05 262 / .92) 5%, transparent 60%); pointer-events: none; }
  .jp-poster > * { z-index: 2; }
  .jp-poster > span:not(.jp-play):not(.jp-sun-mini):not(.jp-kanji-big):not(.absolute):not(.jp-chip) { position: relative; }
  .jp-poster .jp-sun-mini, .jp-poster .jp-kanji-big { z-index: 1; }

  /* Latar belakang buram (versi zoom dari foto yang sama) supaya tidak ada area kosong,
     sementara foto asli di atasnya tampil UTUH 100% tanpa terpotong/terzoom. */
  .jp-poster > .jp-cover-bg {
    position: absolute; inset: 0; z-index: 0; width: 100%; height: 100%; object-fit: cover;
    filter: blur(26px) brightness(.55) saturate(1.15); transform: scale(1.25);
    transition: transform .8s cubic-bezier(.22,1,.36,1);
  }
  .jp-phone:hover .jp-cover-bg { transform: scale(1.35); }
  .jp-poster > .jp-cover {
    position: absolute; inset: 0; z-index: 0; width: 100%; height: 100%;
    object-fit: contain; object-position: center; background: transparent;
  }
  .jp-video { background: #000; object-fit: contain; }
  .jp-chip { position: absolute; right: 1rem; top: 2.75rem; z-index: 3; display: inline-flex; align-items: center; gap: .35rem; border-radius: 9999px; background: rgb(255 255 255 / .18); padding: .25rem .65rem; font-size: 10px; font-weight: 600; letter-spacing: .05em; text-transform: uppercase; backdrop-filter: blur(6px); }
  .jp-play { position: relative; display: flex; align-items: center; justify-content: center; width: 4.25rem; height: 4.25rem; border-radius: 9999px; background: white; color: var(--primary); box-shadow: 0 10px 30px -8px rgb(0 0 0 / .5); transition: transform .3s cubic-bezier(.22,1,.36,1); }
  .jp-play::before, .jp-play::after { content: ''; position: absolute; inset: 0; border-radius: inherit; border: 2px solid white; opacity: 0; animation: jpRing 2.4s ease-out infinite; }
  .jp-play::after { animation-delay: 1.2s; }
  @keyframes jpRing { 0% { transform: scale(1); opacity: .7; } 100% { transform: scale(1.9); opacity: 0; } }
  .jp-poster:hover .jp-play { transform: scale(1.1); }

  .jp-frame { position: absolute; inset: 0; z-index: 4; width: 100%; height: 100%; border: 0; background: white; }
  .jp-loading { position: absolute; inset: 0; z-index: 3; display: none; align-items: center; justify-content: center; color: white; }
  [data-reel].is-playing .jp-loading { display: flex; }
  [data-reel].is-playing .jp-poster { visibility: hidden; }
  .jp-stop { position: absolute; right: .6rem; top: .55rem; z-index: 6; display: none; height: 1.9rem; width: 1.9rem; align-items: center; justify-content: center; border-radius: 9999px; background: rgb(0 0 0 / .65); color: white; }
  [data-reel].is-playing .jp-stop { display: flex; }

  /* Garis waktu */
  .jp-line { position: absolute; left: 1.55rem; top: 0; bottom: 0; width: 2px; background: linear-gradient(to bottom, var(--gold), var(--teal), transparent); }
  @media (min-width: 1024px) { .jp-line { display: none; } }

  @media (prefers-reduced-motion: reduce) {
    .jp-sun, .jp-petal, .jp-play::before, .jp-play::after, .jp-phone::before { animation: none !important; }
    .jp-petal { display: none; }
    .jp-phone:hover { transform: none; }
    .jp-phone:hover .jp-cover-bg { transform: scale(1.25); }
  }
</style>

{{-- ===================== HERO ===================== --}}
<section class="jp-sakura relative overflow-hidden bg-navy-radial pb-28 pt-24 text-hero-foreground sm:pb-32 sm:pt-28">
  <div class="pointer-events-none absolute inset-0 bg-grain"></div>
  <div class="hud-grid"></div>
  <canvas data-particles aria-hidden="true"></canvas>
  <span class="jp-sun"></span>
  <span class="jp-kanji" style="left:4%; top:12%; font-size:clamp(6rem,16vw,13rem);">日本</span>
  <span class="jp-kanji" style="right:4%; bottom:14%; font-size:clamp(5rem,13vw,10rem);">桜</span>

  {{-- kelopak sakura --}}
  <div class="pointer-events-none absolute inset-0 overflow-hidden" aria-hidden="true">
    @for ($i = 0; $i < 16; $i++)
      <span class="jp-petal" style="--l:{{ ($i * 6.7 + 3) % 100 }}%; --s:{{ 9 + ($i % 4) * 4 }}px; --d:{{ 9 + ($i % 5) * 2 }}s; --dl:-{{ number_format($i * 1.3, 1) }}s;"></span>
    @endfor
  </div>

  <div class="relative mx-auto max-w-4xl px-4 text-center sm:px-6 lg:px-8">
    <span class="enter-item enter-d1 kicker kicker--light">
      <x-icon name="sparkles" class="w-3.5 h-3.5" />Magang Internasional
    </span>
    <h1 class="enter-item enter-d2 mt-5 font-display text-4xl font-extrabold leading-[1.1] sm:text-5xl lg:text-6xl">
      Dari Bogor, Terbang ke <span class="text-gradient-gold">Negeri Sakura</span>
    </h1>
    <p class="enter-item enter-d3 mx-auto mt-5 max-w-2xl text-base text-white/75 sm:text-lg">
      Alumni {{ $site['school']['brand_top'] }} membuktikan bahwa kerja keras dan tekad bisa membawa siswa SMK menembus batas, sampai ke Jepang.
    </p>
    <div class="enter-item enter-d4 mt-8 flex flex-wrap items-center justify-center gap-3">
      <a href="#kisah" class="shine inline-flex items-center gap-2 rounded-full bg-gold-gradient px-6 py-3 text-sm font-semibold text-gold-foreground shadow-lift glow-gold transition-transform hover:-translate-y-0.5">
        Tonton Kisah Mereka <x-icon name="arrow-right" class="w-4 h-4" />
      </a>
      <a href="{{ route('ppdb') }}" class="inline-flex items-center gap-2 rounded-full border border-white/30 px-6 py-3 text-sm font-semibold text-white transition-colors hover:bg-white/10">
        Daftar PPDB
      </a>
    </div>

    <div class="enter-item enter-d5 mt-10 flex items-center justify-center gap-3 text-xs text-white/70">
      <div class="flex -space-x-2">
        @foreach ($alumni->take(3) as $a)
          <span class="flex h-9 w-9 items-center justify-center rounded-full border-2 border-primary text-[11px] font-bold text-gold-foreground {{ ['bg-gold','bg-teal','bg-white'][$a->tema % 3] }}">{{ $a->initials() }}</span>
        @endforeach
      </div>
      <span>{{ count($alumni) }} alumni sudah berangkat</span>
    </div>
  </div>

  {{-- pita berjalan --}}
  <div class="jp-ticker relative mt-14 overflow-hidden" aria-hidden="true">
    <div class="marquee-track gap-10 whitespace-nowrap font-display text-sm font-semibold tracking-[0.25em] text-white/45">
      @for ($r = 0; $r < 2; $r++)
        @foreach (['日本', '東京', '頑張って', '桜', 'いってらっしゃい', '夢', 'JAPAN', 'SMK INFOKOM'] as $w)
          <span class="flex items-center gap-10">{{ $w }} <span class="h-1.5 w-1.5 rounded-full bg-gold"></span></span>
        @endforeach
      @endfor
    </div>
  </div>

  <span class="accent-bar absolute inset-x-0 bottom-0" aria-hidden="true"></span>
</section>

{{-- ===================== STATISTIK ===================== --}}
<section class="relative -mt-10 px-4 sm:px-6 lg:px-8">
  <div class="stagger-group mx-auto grid max-w-4xl grid-cols-3 gap-3 sm:gap-5">
    <div class="stagger-item glass rounded-2xl border border-border/70 p-4 text-center shadow-lift sm:p-6">
      <p class="font-display text-3xl font-extrabold text-primary sm:text-4xl"><span data-countup="{{ count($alumni) }}">0</span></p>
      <p class="mt-1 text-[11px] font-medium text-muted-foreground sm:text-sm">Alumni Berangkat</p>
    </div>
    <div class="stagger-item glass rounded-2xl border border-border/70 p-4 text-center shadow-lift sm:p-6">
      <p class="font-display text-3xl font-extrabold text-primary sm:text-4xl"><span data-countup="{{ $alumni->where('jenis_media', '!=', 'foto')->count() }}">0</span></p>
      <p class="mt-1 text-[11px] font-medium text-muted-foreground sm:text-sm">Video Kisah</p>
    </div>
    <div class="stagger-item glass rounded-2xl border border-border/70 p-4 text-center shadow-lift sm:p-6">
      <p class="font-display text-3xl font-extrabold text-primary sm:text-4xl">日本</p>
      <p class="mt-1 text-[11px] font-medium text-muted-foreground sm:text-sm">Negara Tujuan</p>
    </div>
  </div>
</section>

{{-- ===================== VIDEO ALUMNI ===================== --}}
<section id="kisah" class="section-pad scroll-mt-24 px-4 sm:px-6 lg:px-8">
  <div class="mx-auto max-w-6xl">
    <x-section-title kicker="Kisah Alumni" title="Mereka yang Sudah Terbang ke Jepang" desc="Tekan tombol putar untuk menonton momen keberangkatan langsung dari Instagram." />

    @if ($alumni->isEmpty())
      <p class="mt-14 text-center text-sm text-muted-foreground">Belum ada data alumni magang Jepang.</p>
    @else
    <div class="stagger-group mt-14 grid gap-10 sm:grid-cols-2 lg:grid-cols-3 lg:gap-8">
      @php
        $posters = [
          'from-primary via-primary-soft to-teal',
          'from-primary via-primary-soft to-[oklch(0.5_0.16_5)]',
          'from-primary via-primary-soft to-[oklch(0.55_0.13_70)]',
        ];
        $chipIcons = ['foto' => 'image', 'video_lokal' => 'video', 'youtube' => 'youtube', 'instagram' => 'instagram'];
      @endphp
      @foreach ($alumni as $i => $a)
        @php
          $isFoto = $a->isFoto();
          $poster = $a->posterUrl();
        @endphp
        <article class="stagger-item mx-auto w-full max-w-[330px] {{ $i % 3 === 1 ? 'lg:mt-12' : '' }}">
          <div @if (! $isFoto) data-reel data-type="{{ $a->jenis_media }}" data-src="{{ $a->embedSrc() }}" @endif class="jp-phone">
            <div class="jp-screen">
              <span class="jp-notch"></span>
              @if (! $isFoto)
                <button type="button" class="jp-stop" data-reel-stop aria-label="Tutup video">
                  <x-icon name="x" class="w-4 h-4" />
                </button>
                <span class="jp-loading"><span class="btn-spinner" style="width:1.6rem;height:1.6rem;"></span></span>
              @endif

              <button type="button"
                      @if ($isFoto) data-lightbox-trigger="{{ $poster }}" data-lightbox-caption="{{ $a->nama }}" aria-label="Perbesar foto {{ $a->nama }}"
                      @else data-reel-play aria-label="Putar video {{ $a->nama }}" @endif
                      class="jp-poster bg-gradient-to-br {{ $posters[$a->tema % 3] }}">
                @if ($poster)
                  <img src="{{ $poster }}" alt="" aria-hidden="true" class="jp-cover-bg" loading="lazy" />
                  <img src="{{ $poster }}" alt="{{ $a->nama }}" class="jp-cover" loading="lazy" />
                @else
                  <span class="jp-sun-mini"></span>
                  <span class="jp-kanji-big">桜</span>
                @endif

                @if ($a->angkatan)
                  <span class="absolute left-4 top-11 inline-flex items-center gap-1.5 rounded-full bg-white/15 px-3 py-1 text-[10px] font-semibold uppercase tracking-wider backdrop-blur">
                    <x-icon name="graduation-cap" class="w-3 h-3" />{{ $a->angkatan }}
                  </span>
                @endif

                <span class="jp-chip"><x-icon :name="$chipIcons[$a->jenis_media] ?? 'video'" class="w-3 h-3" />{{ $a->jenisLabel() }}</span>

                @if (! $isFoto)
                  <span class="jp-play" style="position:absolute; left:50%; top:44%; margin:-2.125rem 0 0 -2.125rem;">
                    <svg viewBox="0 0 24 24" fill="currentColor" class="ml-1 h-7 w-7" aria-hidden="true"><path d="M8 5.5v13a1 1 0 0 0 1.5.86l10.5-6.5a1 1 0 0 0 0-1.72L9.5 4.64A1 1 0 0 0 8 5.5Z"/></svg>
                  </span>
                @endif

                <span class="block font-display text-xl font-extrabold leading-tight">{{ $a->nama }}</span>
                @if ($a->kota)
                  <span class="mt-1 flex items-center gap-1.5 text-xs text-white/80">
                    <x-icon name="map-pin" class="w-3.5 h-3.5 text-gold" />{{ $a->kota }}
                  </span>
                @endif
                @if ($a->handle)
                  <span class="mt-0.5 text-xs text-gold">&#64;{{ $a->handle }}</span>
                @endif
              </button>
            </div>
          </div>

          <div class="mt-5 px-1">
            @if ($a->catatan)
              <p class="text-sm leading-relaxed text-muted-foreground">&ldquo;{{ $a->catatan }}&rdquo;</p>
            @endif
            @if ($a->sourceUrl() || $a->profileUrl())
              <div class="mt-3 flex flex-wrap items-center gap-x-4 gap-y-2 text-sm font-semibold">
                @if ($a->sourceUrl())
                  <a href="{{ $a->sourceUrl() }}" target="_blank" rel="noopener" class="inline-flex items-center gap-1.5 text-primary hover:underline">
                    <x-icon :name="$chipIcons[$a->jenis_media]" class="w-4 h-4" />{{ $a->sourceLabel() }}
                  </a>
                @endif
                @if ($a->profileUrl())
                  <a href="{{ $a->profileUrl() }}" target="_blank" rel="noopener" class="inline-flex items-center gap-1 text-muted-foreground hover:text-primary">
                    &#64;{{ $a->handle }} <x-icon name="external-link" class="w-3 h-3" />
                  </a>
                @endif
              </div>
            @endif
          </div>
        </article>
      @endforeach
    </div>
    @endif
  </div>
</section>

{{-- ===================== KUTIPAN SEKOLAH ===================== --}}
<section class="px-4 sm:px-6 lg:px-8">
  <div class="reveal-scale jp-sakura relative mx-auto max-w-5xl overflow-hidden rounded-3xl bg-navy-radial px-8 py-14 text-center text-hero-foreground shadow-lift sm:px-16">
    <div class="pointer-events-none absolute inset-0 bg-grain"></div>
    <span class="bg-orb float-y -left-10 -top-10 h-52 w-52 bg-gold/25"></span>
    <span class="bg-orb float-y h-52 w-52" style="right:-2.5rem; bottom:-2.5rem; animation-delay:1s; background: oklch(0.7 0.16 8 / .3);"></span>
    <span class="jp-kanji" style="left:50%; top:50%; transform:translate(-50%,-50%); font-size:16rem;">夢</span>
    <div class="relative">
      <span class="mx-auto flex h-12 w-12 items-center justify-center rounded-full bg-gold-gradient text-gold-foreground"><x-icon name="sparkles" class="w-6 h-6" /></span>
      <p class="mx-auto mt-3 max-w-2xl font-display text-xl font-bold leading-snug sm:text-2xl">
        Terima kasih telah membanggakan almamatermu, nak! Terbang tinggi menembus batas untuk mengejar cita-cita dan masa depanmu yang manis.
      </p>
      <p class="mt-4 text-sm font-semibold tracking-wide text-gold">Keluarga Besar {{ $site['school']['brand_top'] }}</p>
    </div>
  </div>
</section>

{{-- ===================== KENAPA MAGANG JEPANG ===================== --}}
<section class="section-pad px-4 sm:px-6 lg:px-8">
  <div class="mx-auto max-w-6xl">
    <x-section-title kicker="Peluang" title="Kenapa Magang ke Jepang?" desc="Pengalaman yang membuka jalan karier lebih luas bagi lulusan SMK." />

    @if ($alasanList->isEmpty())
      <p class="mt-10 text-center text-sm text-muted-foreground">Belum ada data.</p>
    @else
      <div class="stagger-group mt-12 grid gap-6 sm:grid-cols-2 lg:grid-cols-4">
        @foreach ($alasanList as $alasan)
          <div class="stagger-item card-hover group rounded-2xl border border-border bg-card p-6 shadow-soft">
            <span class="flex h-12 w-12 items-center justify-center rounded-xl bg-navy-gradient text-hero-foreground transition-transform duration-300 group-hover:-rotate-6 group-hover:scale-110">
              <x-icon :name="$alasan->icon" class="w-6 h-6" />
            </span>
            <h3 class="mt-5 font-display text-base font-bold text-foreground">{{ $alasan->judul }}</h3>
            <p class="mt-2 text-sm leading-relaxed text-muted-foreground">{{ $alasan->deskripsi }}</p>
          </div>
        @endforeach
      </div>
    @endif
  </div>
</section>

{{-- ===================== ALUR / PERJALANAN ===================== --}}
<section class="section-pad bg-secondary/50 px-4 sm:px-6 lg:px-8">
  <div class="mx-auto max-w-6xl">
    <x-section-title kicker="Perjalanan" title="Langkah Menuju Jepang" desc="Gambaran umum perjalanan siswa dari persiapan hingga berangkat." />

    @if ($langkahList->isEmpty())
      <p class="mt-10 text-center text-sm text-muted-foreground">Belum ada data.</p>
    @else
      <div class="relative mt-14">
        <div class="jp-line"></div>
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
      <h2 class="font-display text-3xl font-bold sm:text-4xl">Kamu Bisa Jadi <span class="text-gradient-gold">yang Berikutnya</span></h2>
      <p class="mx-auto mt-3 max-w-xl text-sm text-white/75 sm:text-base">Mulai langkahmu dari {{ $site['school']['brand_top'] }} dan raih kesempatan menembus dunia kerja internasional.</p>
      <div class="mt-8 flex flex-wrap items-center justify-center gap-3">
        <a href="{{ route('ppdb') }}" class="shine inline-flex items-center gap-2 rounded-full bg-gold-gradient px-7 py-3 text-sm font-semibold text-gold-foreground shadow-lift glow-gold transition-transform hover:-translate-y-0.5">
          Daftar PPDB <x-icon name="arrow-right" class="w-4 h-4" />
        </a>
        <a href="{{ route('kontak') }}" class="inline-flex items-center gap-2 rounded-full border border-white/30 px-7 py-3 text-sm font-semibold text-white transition-colors hover:bg-white/10">
          Tanya Program Magang
        </a>
      </div>
    </div>
  </div>
</section>

<script>
  // Video dimuat hanya saat diputar (halaman tetap ringan & cepat).
  // Mendukung: video upload (tag video), YouTube dan Instagram (iframe).
  (function () {
    var cards = document.querySelectorAll('[data-reel]');

    function stop(card) {
      var f = card.querySelector('.jp-frame');
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
        el.className = 'jp-frame jp-video';
        el.src = src;
        el.controls = true;
        el.autoplay = true;
        el.setAttribute('playsinline', '');
        el.preload = 'metadata';
      } else {
        el = document.createElement('iframe');
        el.className = 'jp-frame';
        el.src = src;
        el.setAttribute('scrolling', 'no');
        el.setAttribute('allowfullscreen', '');
        el.setAttribute('allow', 'autoplay; encrypted-media; picture-in-picture; fullscreen');
        el.setAttribute('title', 'Video alumni magang Jepang');
      }

      card.querySelector('.jp-screen').appendChild(el);
      card.classList.add('is-playing');
    }

    cards.forEach(function (card) {
      var play = card.querySelector('[data-reel-play]');
      var close = card.querySelector('[data-reel-stop]');

      play.addEventListener('click', function () {
        cards.forEach(function (c) { if (c !== card) stop(c); }); // hanya 1 video aktif
        start(card);
      });
      close.addEventListener('click', function () { stop(card); });
    });
  })();
</script>

@endsection