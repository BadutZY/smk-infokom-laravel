<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>@yield('title', 'Dashboard') - Admin {{ $site['school']['short'] ?? '' }}</title>
  <link rel="icon" href="{{ asset('images/logo.png') }}" />

  @include('partials.head-boot')

  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Sora:wght@400;600;700;800&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" />

  @vite(['resources/css/app.css', 'resources/js/app.js'])
  <script src="https://cdn.jsdelivr.net/npm/chart.js@4"></script>
</head>
<body class="bg-secondary/40 text-foreground antialiased" data-transition="normal">
  <div class="flex min-h-screen">

    <div data-admin-sidebar-overlay class="fixed inset-0 z-30 hidden bg-black/60 backdrop-blur-sm lg:hidden"></div>

    <aside data-admin-sidebar class="fixed inset-y-0 left-0 z-40 flex w-72 -translate-x-full flex-col overflow-hidden bg-navy-radial text-hero-foreground shadow-2xl transition-transform duration-300 lg:translate-x-0">
      <div class="pointer-events-none absolute inset-0 bg-grain"></div>
      <span class="bg-orb h-56 w-56 bg-gold/10" style="left:-4rem; top:-4rem;"></span>

      <div class="relative flex items-center gap-3 border-b border-white/10 px-6 py-6">
        <span class="relative flex h-11 w-11 items-center justify-center rounded-xl bg-white/10 shadow-soft">
          <img src="{{ asset('images/logo.png') }}">
        </span>
        <span class="leading-tight">
          <span class="block text-sm font-bold">{{ $site['school']['brand_top'] }}</span>
          <span class="block text-[11px] font-semibold tracking-widest text-gold">PANEL ADMIN</span>
        </span>
      </div>

      <nav class="relative flex-1 space-y-5 overflow-y-auto px-4 py-5">
        @php
          $adminNavGroups = [
            'Utama' => [
              ['route' => 'admin.dashboard', 'icon' => 'layout-dashboard', 'label' => 'Dashboard'],
            ],
            'Konten Website' => [
              ['route' => 'admin.konten.profil', 'icon' => 'building', 'label' => 'Profil Sekolah'],
              ['route' => 'admin.konten.fasilitas', 'icon' => 'school', 'label' => 'Fasilitas'],
              ['route' => 'admin.konten.akademik', 'icon' => 'book-open', 'label' => 'Akademik'],
              ['route' => 'admin.konten.galeri', 'icon' => 'image', 'label' => 'Galeri'],
              ['route' => 'admin.konten.ppdb', 'icon' => 'calendar-days', 'label' => 'Konten PPDB'],
              ['route' => 'admin.berita.index', 'icon' => 'newspaper', 'label' => 'Berita'],
              ['route' => 'admin.guru-staff.index', 'icon' => 'users', 'label' => 'Guru & Staff'],
              ['route' => 'admin.prestasi-sekolah.index', 'icon' => 'trophy', 'label' => 'Prestasi Sekolah'],
              ['route' => 'admin.magang-jepang.index', 'icon' => 'award', 'label' => 'Magang Jepang'],
              ['route' => 'admin.kunjungan-industri.index', 'match' => 'admin.kunjungan-industri.*', 'icon' => 'map-pin', 'label' => 'Kunjungan Industri'],
              ['route' => 'admin.bkk.index', 'icon' => 'briefcase', 'label' => 'BKK'],
            ],
            'Interaksi' => [
              ['route' => 'admin.ppdb.index', 'icon' => 'idcard', 'label' => 'Data PPDB'],
              ['route' => 'admin.pesan.index', 'icon' => 'message-square', 'label' => 'Pesan Masuk'],
            ],
          ];
        @endphp

        @foreach ($adminNavGroups as $groupLabel => $items)
          <div>
            <p class="px-4 pb-2 text-[11px] font-bold uppercase tracking-widest text-white/35">{{ $groupLabel }}</p>
            <div class="space-y-1">
              @foreach ($items as $item)
                @php $active = request()->routeIs($item['match'] ?? ($item['route'].'*')); @endphp
                <a href="{{ route($item['route']) }}" class="sidebar-link flex items-center gap-3 rounded-xl px-4 py-3 text-sm font-medium transition-colors {{ $active ? 'is-active bg-white/15 text-white' : 'text-white/70 hover:bg-white/10 hover:text-white' }}">
                  <x-icon :name="$item['icon']" class="w-4 h-4" />
                  {{ $item['label'] }}
                  @if ($item['route'] === 'admin.pesan.index' && ($unreadBadge ?? 0) > 0)
                    <span class="ml-auto flex h-5 min-w-5 items-center justify-center rounded-full bg-gold px-1 text-[10px] font-bold text-primary">{{ $unreadBadge }}</span>
                  @endif
                </a>
              @endforeach
            </div>
          </div>
        @endforeach
      </nav>

      <div class="relative border-t border-white/10 px-6 py-5">
        <a href="{{ route('home') }}" class="flex items-center gap-3 rounded-xl px-1 py-1 transition-colors hover:bg-white/5">
          <span class="flex h-9 w-9 shrink-0 items-center justify-center rounded-lg bg-gold-gradient text-gold-foreground">
            <x-icon name="sparkles" class="w-4 h-4" />
          </span>
          <div class="min-w-0 leading-tight">
            <p class="truncate text-xs font-semibold text-white/80">Lihat Situs Publik</p>
            <p class="truncate text-[11px] text-white/40">Buka tampilan website sekolah</p>
          </div>
          <x-icon name="arrow-right" class="ml-auto w-3.5 h-3.5 shrink-0 text-white/40" />
        </a>
      </div>
    </aside>

    <div class="flex min-h-screen flex-1 flex-col lg:pl-72">
      <header class="glass sticky top-0 z-20 flex items-center justify-between border-b border-border/70 px-4 py-4 sm:px-8">
        <div class="flex items-center gap-3">
          <button type="button" data-admin-sidebar-toggle class="flex h-10 w-10 items-center justify-center rounded-full border border-border text-primary lg:hidden">
            <x-icon name="menu" class="w-5 h-5" />
          </button>
          <div>
            <p class="text-[11px] font-semibold uppercase tracking-widest text-muted-foreground">Panel Admin</p>
            <h1 class="font-display text-lg font-bold leading-tight text-foreground sm:text-xl">@yield('page-title', 'Dashboard')</h1>
          </div>
        </div>

        <div class="flex items-center gap-3">
          <div class="relative">
            <button type="button" data-popover-toggle="#notif-panel" class="flex h-10 w-10 items-center justify-center rounded-full border border-border text-muted-foreground hover:text-primary">
              <x-icon name="bell" class="w-5 h-5" />
              @if (($unreadBadge ?? 0) > 0)
                <span class="absolute right-1.5 top-1.5 h-2 w-2 rounded-full bg-gold"></span>
              @endif
            </button>
            <div id="notif-panel" class="absolute right-0 z-30 mt-2 hidden w-72 rounded-2xl border border-border bg-card p-4 text-sm shadow-lift">
              <p class="font-semibold text-foreground">Pesan belum dibaca</p>
              <p class="mt-1 text-muted-foreground">{{ $unreadBadge ?? 0 }} pesan menunggu untuk dibaca.</p>
              <a href="{{ route('admin.pesan.index') }}" class="mt-3 inline-flex items-center gap-1 text-primary hover:underline">Lihat pesan <x-icon name="arrow-right" class="w-3.5 h-3.5" /></a>
            </div>
          </div>

          <div class="relative">
            <button type="button" data-popover-toggle="#profile-panel" class="flex items-center gap-2 rounded-full bg-secondary py-1.5 pl-1.5 pr-3 hover:bg-secondary/70 sm:pr-4">
              <span class="flex h-8 w-8 items-center justify-center rounded-full bg-navy-gradient text-hero-foreground">
                <x-icon name="user" class="w-4 h-4" />
              </span>
              <span class="hidden text-sm font-medium text-foreground sm:block">{{ auth()->user()->nama_lengkap ?? 'Admin' }}</span>
              <x-icon name="chevron-down" class="hidden w-3.5 h-3.5 text-muted-foreground sm:block" />
            </button>
            <div id="profile-panel" class="absolute right-0 z-30 mt-2 hidden w-64 overflow-hidden rounded-2xl border border-border bg-card shadow-lift">
              <div class="flex items-center gap-3 border-b border-border px-4 py-4">
                <span class="flex h-10 w-10 items-center justify-center rounded-full bg-navy-gradient text-hero-foreground">
                  <x-icon name="user" class="w-4 h-4" />
                </span>
                <div class="min-w-0">
                  <p class="truncate text-sm font-semibold text-foreground">{{ auth()->user()->nama_lengkap ?? 'Admin' }}</p>
                  <p class="truncate text-xs text-muted-foreground">{{ auth()->user()->username ?? '-' }}</p>
                </div>
              </div>
              <div class="p-2">
                <a href="{{ route('admin.settings') }}" class="flex items-center gap-3 rounded-xl px-3 py-2.5 text-sm font-medium text-foreground hover:bg-secondary">
                  <x-icon name="settings" class="w-4 h-4 text-muted-foreground" /> Pengaturan Akun
                </a>
                <a href="{{ route('home') }}" class="flex items-center gap-3 rounded-xl px-3 py-2.5 text-sm font-medium text-foreground hover:bg-secondary">
                  <x-icon name="home" class="w-4 h-4 text-muted-foreground" /> Lihat Situs
                </a>
              </div>
              <div class="border-t border-border p-2">
                <form method="POST" action="{{ route('logout') }}">
                  @csrf
                  <button type="submit" class="flex w-full items-center gap-3 rounded-xl px-3 py-2.5 text-sm font-medium text-destructive hover:bg-destructive/10">
                    <x-icon name="log-out" class="w-4 h-4" /> Keluar
                  </button>
                </form>
              </div>
            </div>
          </div>
        </div>
      </header>

      <div class="px-4 py-6 sm:px-8 sm:py-8">
        @include('partials.flash')
        @yield('content')
      </div>
    </div>
  </div>
</body>
</html>