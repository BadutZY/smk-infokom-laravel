@extends('layouts.app')
@section('title', 'Beranda')

@section('content')

{{-- ===================== HERO ===================== --}}
<section data-hero-slider class="home-hero relative overflow-hidden bg-navy-radial text-hero-foreground">
  <div class="pointer-events-none absolute inset-0 bg-grain"></div>
  <span class="bg-orb float-y -left-20 top-10 h-72 w-72 bg-gold/20"></span>
  <span class="bg-orb float-y h-80 w-80 bg-teal/25" style="right:-5rem; bottom:-6rem; animation-delay:1.4s;"></span>
  <div class="hud-grid"></div>
  <canvas data-particles aria-hidden="true"></canvas>

  <div class="relative min-h-[680px] sm:min-h-[720px]">
    @foreach ($heroSlides as $i => $slide)
      @php $tag = $i === 0 ? 'h1' : 'h2'; @endphp
      <div data-hero-slide class="absolute inset-0 flex items-center transition-opacity duration-1000 {{ $i === 0 ? 'opacity-100' : 'opacity-0' }}">
        <div class="relative mx-auto grid w-full max-w-7xl gap-12 px-4 pb-32 pt-14 sm:px-6 lg:grid-cols-[1.05fr_1fr] lg:items-center lg:px-8">
          <div>
            <p class="kicker kicker--light enter-item enter-d1"><i class="accent-mark" aria-hidden="true"></i>{{ $slide['kicker'] }}</p>
            <{{ $tag }} data-split style="--d:.15s" class="hero-title mt-5 whitespace-pre-line">{{ $slide['title'] }}</{{ $tag }}>
            <p class="enter-item enter-d3 mt-6 max-w-xl text-base text-white/75 sm:text-lg">{{ $slide['desc'] }}</p>
            <div class="enter-item enter-d4 mt-9 flex flex-wrap gap-3">
              <a href="{{ route('ppdb') }}" class="shine inline-flex items-center gap-2 rounded-full bg-gold-gradient px-6 py-3 text-sm font-semibold text-gold-foreground shadow-lift glow-gold transition-transform hover:-translate-y-0.5">
                Daftar PPDB Sekarang <x-icon name="arrow-right" class="w-4 h-4" />
              </a>
              <a href="{{ route('profil') }}" class="inline-flex items-center gap-2 rounded-full border border-white/30 px-6 py-3 text-sm font-semibold text-white transition-colors hover:bg-white/10">
                Profil Sekolah
              </a>
            </div>
            @if (! empty($site['majors']))
              <div class="enter-item enter-d5 hero-chips mt-10">
                @foreach ($site['majors'] as $m)
                  <a href="{{ ! empty($m['slug']) ? route('akademik.jurusan', $m['slug']) : route('akademik') }}" class="hero-chip" style="--c: {{ $m['color'] }}" title="{{ $m['name'] }}"><i aria-hidden="true"></i>{{ $m['code'] }}</a>
                @endforeach
              </div>
            @endif
          </div>

          <div data-depth="10" class="enter-item enter-d3 hero-frame hidden lg:block">
            <div class="hero-frame__img ring-gradient">
              <img src="{{ \App\Support\Site::imageUrl($site['images']['hero_school']) }}" alt="{{ $site['school']['name'] }}" class="ken-burns h-full w-full object-cover" />
              <div class="absolute inset-0 bg-gradient-to-t from-primary/50 via-primary/5 to-transparent"></div>
            </div>
            <div class="float-card glass absolute -bottom-6 -left-8 flex items-center gap-3 rounded-2xl border border-white/15 px-5 py-4 shadow-lift">
              <span class="flex h-11 w-11 items-center justify-center rounded-xl bg-gold-gradient text-gold-foreground">
                <x-icon name="trophy" class="w-5 h-5" />
              </span>
              <div class="leading-tight">
                <p class="font-display text-lg font-extrabold text-black">Terakreditasi A</p>
                <p class="text-xs text-black/60">Standar mutu pendidikan terbaik</p>
              </div>
            </div>
            <div class="float-card glass absolute -top-6 -right-6 flex items-center gap-2 rounded-2xl border border-white/15 px-4 py-3 shadow-lift">
              <span class="flex h-9 w-9 items-center justify-center rounded-full bg-teal/90 text-teal-foreground">
                <x-icon name="users" class="w-4 h-4" />
              </span>
              <div class="leading-tight">
                <p class="font-display text-sm font-bold text-black">90%+ Terserap</p>
                <p class="text-[10px] text-black/70">Kerja &amp; kuliah</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    @endforeach
  </div>

  {{-- Penanda slide: bar tipis yang terisi selama slide aktif --}}
  <div class="hero-bars">
    <div class="mx-auto flex max-w-7xl items-center gap-1 px-4 sm:px-6 lg:px-8">
      @foreach ($heroSlides as $i => $slide)
        <button type="button" data-hero-dot class="hero-bar {{ $i === 0 ? 'is-on' : '' }}" aria-label="Slide {{ $i + 1 }}"><span></span></button>
      @endforeach
    </div>
  </div>

  <span class="accent-bar absolute inset-x-0 bottom-0" aria-hidden="true"></span>
</section>

{{-- ===================== STATS ===================== --}}
<section class="relative z-10 -mt-14 px-4 sm:px-6 lg:px-8">
  <div class="stagger-group stat-band mx-auto max-w-6xl">
    @foreach ($site['stats'] as $stat)
      <div class="stagger-item stat-cell">
        <span class="stat-icon"><x-icon :name="$stat['icon']" class="w-5 h-5" /></span>
        <p class="stat-value"><span data-countup="{{ $stat['value'] }}" data-suffix="{{ $stat['suffix'] }}">0{{ $stat['suffix'] }}</span></p>
        <p class="stat-label">{{ $stat['label'] }}</p>
      </div>
    @endforeach
  </div>
</section>

{{-- ===================== ANNOUNCEMENTS ===================== --}}
<section class="section-pad px-4 sm:px-6 lg:px-8">
  <div class="mx-auto max-w-6xl">
    <x-section-title kicker="Info Terkini" title="Pengumuman & Agenda Sekolah" desc="Ikuti perkembangan terbaru seputar kegiatan dan agenda SMK INFOKOM Kota Bogor." />

    <div class="stagger-group mt-12 grid gap-5 sm:grid-cols-2 lg:grid-cols-4">
      @foreach ($site['announcements'] as $item)
        <article class="stagger-item agenda-card">
          <span class="flex h-11 w-11 items-center justify-center rounded-xl bg-accent text-primary">
            <x-icon :name="$item['icon']" class="w-5 h-5" />
          </span>
          <h3 class="font-display text-base font-bold leading-snug text-foreground">{{ $item['title'] }}</h3>
          <p class="text-sm leading-relaxed text-muted-foreground">{{ $item['text'] }}</p>
          <span class="agenda-date"><x-icon name="calendar-days" class="w-3.5 h-3.5" />{{ $item['date'] }}</span>
        </article>
      @endforeach
    </div>
  </div>
</section>

{{-- ===================== MAJORS ===================== --}}
<section class="section-pad bg-secondary/50 px-4 sm:px-6 lg:px-8">
  <div class="mx-auto max-w-6xl">
    <div class="flex flex-wrap items-end justify-between gap-4">
      <x-section-title :center="false" kicker="Kompetensi Keahlian" title="Empat Jurusan Unggulan" desc="Program keahlian yang dirancang selaras dengan kebutuhan dunia usaha dan dunia industri." />
      <a href="{{ route('akademik') }}" class="reveal inline-flex items-center gap-1.5 text-sm font-semibold text-primary hover:underline">
        Lihat semua program <x-icon name="arrow-right" class="w-4 h-4" />
      </a>
    </div>

    {{--
      Border luar tiap kartu memakai warna identitas jurusan ($major['color']).
      Warna diatur admin: Admin > Akademik > Kompetensi Keahlian (Jurusan) > "Warna Identitas".
      Semua kartu otomatis sama tinggi; judul maks. 2 baris & deskripsi maks. 3 baris.
    --}}
    <div class="stagger-group mt-12 grid gap-6 sm:grid-cols-2 lg:grid-cols-4">
      @foreach ($site['majors'] as $major)
        <x-major-card :major="$major" class="stagger-item" />
      @endforeach
    </div>
  </div>
</section>

{{-- ===================== NEWS ===================== --}}
<section class="section-pad px-4 sm:px-6 lg:px-8">
  <div class="mx-auto max-w-6xl">
    <div class="flex flex-wrap items-end justify-between gap-4">
      <x-section-title :center="false" kicker="Berita Sekolah" title="Kabar Terbaru" />
      <a href="{{ route('berita.index') }}" class="reveal inline-flex items-center gap-1.5 text-sm font-semibold text-primary hover:underline">
        Lihat semua berita <x-icon name="arrow-right" class="w-4 h-4" />
      </a>
    </div>

    @if ($beritaTerbaru->isNotEmpty())
      @php $lead = $beritaTerbaru->first(); $rest = $beritaTerbaru->skip(1); @endphp
      <div class="stagger-group mt-12 grid gap-6 lg:grid-cols-5">
        <a href="{{ route('berita.show', $lead->slug) }}" class="stagger-item news-lead p-7 sm:p-9 lg:col-span-3">
          <img src="{{ \App\Support\Site::imageUrl($lead->gambar_sampul) }}" alt="" loading="lazy" />
          <span class="news-tag">{{ $lead->kategori }}</span>
          <h3 class="mt-4 max-w-xl">{{ $lead->judul }}</h3>
          <p class="mt-3 line-clamp-2 max-w-xl text-sm leading-relaxed text-white/75">{{ $lead->ringkasan }}</p>
          <span class="mt-6 flex items-center justify-between gap-4 text-sm">
            <span class="text-white/70">{{ \App\Support\Site::formatTanggal($lead->tanggal) }}</span>
            <span class="inline-flex items-center gap-1.5 font-semibold">Baca selengkapnya <x-icon name="arrow-right" class="w-4 h-4" /></span>
          </span>
        </a>

        <div class="grid content-start gap-4 lg:col-span-2">
          @foreach ($rest as $berita)
            <a href="{{ route('berita.show', $berita->slug) }}" class="stagger-item news-row group">
              <span class="thumb"><img src="{{ \App\Support\Site::imageUrl($berita->gambar_sampul) }}" alt="" loading="lazy" /></span>
              <span class="min-w-0">
                <span class="news-tag">{{ $berita->kategori }}</span>
                <span class="mt-2 line-clamp-2 block font-display text-sm font-bold leading-snug text-foreground">{{ $berita->judul }}</span>
                <span class="mt-1.5 block text-xs text-muted-foreground">{{ \App\Support\Site::formatTanggal($berita->tanggal) }}</span>
              </span>
            </a>
          @endforeach
        </div>
      </div>
    @else
      <p class="mt-10 text-center text-sm text-muted-foreground">Belum ada berita.</p>
    @endif
  </div>
</section>

{{-- ===================== TEASER MAGANG JEPANG ===================== --}}
@if ($magangJepang->isNotEmpty())
<section class="px-4 pb-4 sm:px-6 lg:px-8">
  <div class="reveal relative mx-auto max-w-6xl overflow-hidden rounded-3xl bg-navy-radial px-6 py-12 text-hero-foreground shadow-lift sm:px-12 lg:py-14">
    <div class="pointer-events-none absolute inset-0 bg-grain"></div>
    <span class="bg-orb float-y -left-10 -top-10 h-56 w-56" style="background: oklch(0.6 0.22 25 / .35);"></span>
    <span class="bg-orb float-y h-56 w-56 bg-teal/25" style="right:-3rem; bottom:-3rem; animation-delay:1s;"></span>
    <span class="pointer-events-none absolute -right-2 -top-6 select-none text-[11rem] font-extrabold leading-none text-white/[0.05]" style="font-family:'Yu Mincho','Hiragino Mincho ProN','Noto Serif JP',serif;">日本</span>

    <div class="relative grid items-center gap-8 lg:grid-cols-[1.3fr_1fr]">
      <div>
        <span class="kicker kicker--light"><i class="accent-mark" aria-hidden="true"></i>Magang Internasional</span>
        <h2 class="mt-4 font-display text-3xl font-bold leading-tight sm:text-4xl">Alumni Kami Terbang ke <span class="text-gradient-gold">Jepang</span></h2>
        <p class="mt-3 max-w-xl text-sm text-white/75 sm:text-base">{{ $totalMagang }} alumni sudah berangkat magang ke Negeri Sakura. Tonton momen mereka dan jadilah yang berikutnya.</p>
        <a href="{{ route('magang-jepang') }}" class="shine mt-7 inline-flex items-center gap-2 rounded-full bg-gold-gradient px-6 py-3 text-sm font-semibold text-gold-foreground shadow-lift glow-gold transition-transform hover:-translate-y-0.5">
          Lihat Kisah Mereka <x-icon name="arrow-right" class="w-4 h-4" />
        </a>
      </div>
      <div class="stagger-group grid gap-3">
        @foreach ($magangJepang as $m)
          <a href="{{ route('magang-jepang') }}" class="stagger-item glass-dark flex items-center gap-3 rounded-2xl border border-white/15 px-4 py-3 transition-transform hover:translate-x-1">
            <span class="flex h-10 w-10 shrink-0 items-center justify-center rounded-full bg-gold-gradient font-display text-sm font-extrabold text-gold-foreground">{{ $m->initials() }}</span>
            <span class="leading-tight">
              <span class="block font-display text-sm font-bold">{{ $m->nama }}</span>
              <span class="flex items-center gap-1 text-xs text-white/70"><x-icon name="map-pin" class="w-3 h-3 text-gold" />{{ $m->kota ?: 'Jepang' }}</span>
            </span>
            <x-icon name="arrow-right" class="ml-auto w-4 h-4 text-white/60" />
          </a>
        @endforeach
      </div>
    </div>
  </div>
</section>
@endif

{{-- ===================== PARTNERSHIP / KERJASAMA UNIVERSITAS & INDUSTRI ===================== --}}
@php
  // Kartu logo mitra (dipakai bersama untuk Kerjasama Universitas & Industri).
  // Kalau logo belum diunggah (kosong), tampilkan lencana inisial nama
  // sebagai gantinya supaya kartu tetap rapi sebelum gambar ditambahkan
  // lewat panel admin (Profil Sekolah > tab Kerjasama Universitas/Industri).
@endphp
@if (!empty($site['kerjasama_universitas']))
<section class="section-pad border-t border-border bg-secondary/50 px-4 sm:px-6 lg:px-8">
  <div class="mx-auto max-w-6xl">
    <x-section-title kicker="Kerja Sama Universitas" title="Perguruan Tinggi & Lembaga Mitra" desc="SMK INFOKOM Kota Bogor menjalin kerja sama dengan berbagai perguruan tinggi untuk penyelarasan kurikulum, kunjungan edukatif, dan jalur lanjut studi." />

    <div class="stagger-group mt-10 flex flex-wrap justify-center gap-7">
      @foreach ($site['kerjasama_universitas'] as $mitra)
        <div class="stagger-item card-hover group flex aspect-[4/3] w-44 flex-col items-center justify-center gap-2 rounded-2xl border border-border bg-card p-7 shadow-soft transition-all duration-300 hover:shadow-lift sm:w-56">
          @if (!empty($mitra['logo']))
            <img
              src="{{ \App\Support\Site::imageUrl($mitra['logo']) }}"
              alt="{{ $mitra['nama'] }}"
              class="max-h-24 w-full object-contain transition-transform duration-300 ease-out group-hover:scale-110 sm:max-h-32"
              loading="lazy"
            />
          @else
            <span class="flex h-16 w-16 items-center justify-center rounded-2xl bg-accent text-lg font-bold text-primary sm:h-20 sm:w-20 sm:text-xl">
              {{ \Illuminate\Support\Str::of($mitra['nama'])->explode(' ')->take(2)->map(fn ($w) => mb_substr($w, 0, 1))->implode('') }}
            </span>
          @endif
          <span class="text-center text-xs font-medium text-muted-foreground">{{ $mitra['nama'] }}</span>
        </div>
      @endforeach
    </div>
  </div>
</section>
@endif

@if (!empty($site['kerjasama_industri']))
@php
  // Marquee tak-berhenti: daftar mitra digandakan 2x supaya saat trek
  // bergeser sejauh 50% lebar totalnya, salinan kedua persis menempati
  // posisi salinan pertama semula -> perpindahan tidak pernah terlihat
  // (loop mulus, tidak ada jeda/putus). Durasi menyesuaikan jumlah mitra
  // supaya kecepatan geser terasa konsisten walau datanya bertambah.
  $mitraIndustri = $site['kerjasama_industri'];
  $partnerMarqueeDuration = max(18, count($mitraIndustri) * 3.2);
@endphp
<section class="section-pad overflow-x-hidden px-4 sm:px-6 lg:px-8">

  {{-- Dibuat "full-bleed": ditarik keluar dari max-w-6xl DAN dari padding
       section ini sendiri (via trik left:50%/margin -50vw), supaya baris
       logo benar-benar membentang dari ujung kiri sampai ujung kanan
       jendela browser, bukan cuma selebar kontainer konten. --}}
  <div class="partner-marquee-bleed reveal mt-10" style="--partner-marquee-duration: {{ $partnerMarqueeDuration }}s;">
    <div class="partner-marquee">
      <div class="partner-marquee__track">
        @for ($dup = 0; $dup < 2; $dup++)
          @foreach ($mitraIndustri as $mitra)
            <div
              class="partner-marquee__item group flex aspect-[4/3] w-44 flex-col items-center justify-center gap-2 rounded-2xl border border-border bg-card p-6 shadow-soft sm:w-56"
              @if ($dup === 1) aria-hidden="true" @endif
            >
              @if (!empty($mitra['logo']))
                <img
                  src="{{ \App\Support\Site::imageUrl($mitra['logo']) }}"
                  alt="{{ $mitra['nama'] }}"
                  class="max-h-20 w-full object-contain sm:max-h-28"
                  loading="lazy"
                  draggable="false"
                />
              @else
                <span class="flex h-14 w-14 items-center justify-center rounded-xl bg-accent text-base font-bold text-primary sm:h-[4.5rem] sm:w-[4.5rem] sm:text-lg">
                  {{ \Illuminate\Support\Str::of($mitra['nama'])->explode(' ')->take(2)->map(fn ($w) => mb_substr($w, 0, 1))->implode('') }}
                </span>
              @endif
              <span class="text-center text-[11px] font-medium leading-snug text-muted-foreground">{{ $mitra['nama'] }}</span>
            </div>
          @endforeach
        @endfor
      </div>
    </div>
  </div>
</section>

<style>
  /* ===== Partner marquee: loop tak-berhenti & full-bleed untuk "Perusahaan Mitra & Partner Kami" ===== */

  /* Membentangkan elemen selebar viewport (100vw), keluar dari batas
     kontainer manapun ia berada, lalu overflow-x-hidden di <section>
     (di atas) mencegah ini memunculkan scrollbar horizontal tambahan. */
  .partner-marquee-bleed {
    position: relative;
    left: 50%;
    right: 50%;
    width: 100vw;
    margin-left: -50vw;
    margin-right: -50vw;
  }

  .partner-marquee {
    position: relative;
    overflow: hidden;
    cursor: grab;
    /* Izinkan browser tetap menangani scroll vertikal halaman (jari geser
       ke atas/bawah), sementara geser kiri/kanan kami tangani sendiri lewat
       JS (initPartnerMarquee di app.js) tanpa bentrok dengan gesture jari. */
    touch-action: pan-y;
    -webkit-mask-image: linear-gradient(to right, transparent, black 4%, black 96%, transparent);
    mask-image: linear-gradient(to right, transparent, black 4%, black 96%, transparent);
  }

  /* Saat sedang digeser (drag) oleh mouse/jari, kursor berubah jadi
     "grabbing" dan seleksi teks/gambar dimatikan supaya geseran mulus. */
  .partner-marquee.is-dragging {
    cursor: grabbing;
    -webkit-user-select: none;
    user-select: none;
  }

  .partner-marquee__track {
    display: flex;
    width: max-content;
    gap: 1.5rem;
    padding-inline: 1.5rem;
    will-change: transform;
    /* animation CSS di bawah ini hanyalah fallback jika JavaScript tidak
       aktif. Ketika app.js berhasil jalan (initPartnerMarquee), animation
       ini akan dimatikan (animation: none) dan pergeserannya diambil-alih
       sepenuhnya oleh JS lewat transform: translateX(...) supaya trek bisa
       digeser manual (drag) dan tetap bisa lanjut looping otomatis lagi. */
    animation: partner-marquee-scroll var(--partner-marquee-duration, 24s) linear infinite;
  }

  /* Trek digandakan 2x (100% + 100%) lalu digeser -50% -> tepat kembali
     ke titik awal tanpa ada frame kosong/putus, sehingga loop terasa
     menerus selamanya. */
  @keyframes partner-marquee-scroll {
    from { transform: translateX(0); }
    to { transform: translateX(-50%); }
  }

  .partner-marquee__item {
    flex: 0 0 auto;
    /* Hanya warna & border yang berubah saat hover -> logo/kartu tetap
       diam di tempat, sama sekali tidak ada efek zoom/scale/naik-turun. */
    transition: border-color 0.3s ease, box-shadow 0.3s ease, background-color 0.3s ease;
  }

  .partner-marquee__item:hover,
  .partner-marquee__item:focus-within {
    border-color: oklch(from var(--gold) l c h / 0.55);
    box-shadow: var(--shadow-lift), 0 0 24px -8px oklch(from var(--gold) l c h / 0.25);
  }

  /* Fallback CSS: dipakai kalau JS gagal/nonaktif, animasi berhenti saat
     kursor di atas trek (perilaku dasar sebelum JS mengambil-alih). */
  .partner-marquee:hover .partner-marquee__track,
  .partner-marquee:focus-within .partner-marquee__track {
    animation-play-state: paused;
  }

  /* Pengguna yang memilih "reduce motion" di sistemnya akan melihat
     baris statis (tanpa animasi) dan salinan duplikat disembunyikan. */
  @media (prefers-reduced-motion: reduce) {
    .partner-marquee {
      cursor: default;
    }
    .partner-marquee__track {
      animation: none;
      flex-wrap: wrap;
      width: auto;
      justify-content: center;
      padding-inline: 1rem;
    }
    .partner-marquee__item[aria-hidden="true"] {
      display: none;
    }
  }
</style>
@endif

@endsection