<header data-navbar class="sticky top-0 z-40 px-3 pt-3 sm:px-4">
  <nav class="site-nav glass relative mx-auto flex h-[68px] max-w-7xl items-center justify-between rounded-2xl border border-border/70 px-4 shadow-soft sm:px-5">
    <a href="{{ route('home') }}" class="group flex shrink-0 items-center gap-3">
      <span class="relative flex h-11 w-11 items-center justify-center rounded-xl bg-navy-gradient text-hero-foreground shadow-soft transition-transform duration-500 group-hover:-rotate-6 group-hover:scale-105">
        <span class="pointer-events-none absolute -inset-0.5 rounded-xl bg-gold/40 opacity-0 blur-md transition-opacity duration-300 group-hover:opacity-100"></span>
        <img src="{{ asset('images/logo.png') }}" alt="Logo {{ $site['school']['brand_top'] ?? 'Sekolah' }}" class="relative">
      </span>
      <span class="leading-tight">
        <span class="block font-display text-sm font-bold tracking-wide text-primary sm:text-base">{{ $site['school']['brand_top'] }}</span>
        <span class="block text-[11px] font-semibold tracking-[0.2em] text-gold sm:text-xs">{{ $site['school']['brand_bottom'] }}</span>
      </span>
    </a>

    <div data-nav-track class="relative hidden items-center gap-1 rounded-full border border-border/60 bg-background/40 p-1 xl:flex">
      @foreach ($site['nav_links'] as $link)
        @if (! empty($link['children']))
          @php
            $active = collect($link['children'])->contains(function ($child) {
              $to = ltrim($child['to'], '/');
              return request()->is($to) || request()->is($to.'/*');
            });
          @endphp
          <div class="group/nav relative">
            <button type="button"
                    class="relative flex items-center gap-1.5 rounded-full px-3 py-2 text-sm font-medium 2xl:px-4 transition-colors duration-200 {{ $active ? 'bg-navy-gradient text-hero-foreground shadow-soft' : 'text-muted-foreground hover:text-primary' }}">
              {{ $link['label'] }}
              <x-icon name="chevron-down" class="w-3.5 h-3.5 transition-transform duration-300 group-hover/nav:rotate-180" />
            </button>

            {{-- pt-3 menjaga area hover tetap "menyatu" (tanpa celah mati) antara tombol & panel dropdown --}}
            <div class="nav-dropdown invisible absolute left-1/2 top-full z-50 w-72 -translate-x-1/2 pt-3 opacity-0 translate-y-1 group-hover/nav:visible group-hover/nav:opacity-100 group-hover/nav:translate-y-0 group-focus-within/nav:visible group-focus-within/nav:opacity-100 group-focus-within/nav:translate-y-0">
              <div class="glass overflow-hidden rounded-2xl border border-border/70 p-2 shadow-lift">
                @foreach ($link['children'] as $child)
                  @php
                    $childTo = ltrim($child['to'], '/');
                    $childActive = request()->is($childTo) || request()->is($childTo.'/*');
                  @endphp
                  <a href="{{ url($child['to']) }}"
                     class="flex items-center gap-3 rounded-xl px-3 py-2.5 text-sm transition-colors {{ $childActive ? 'bg-accent text-primary' : 'text-foreground hover:bg-secondary' }}">
                    <span class="flex h-9 w-9 shrink-0 items-center justify-center rounded-lg bg-navy-gradient text-hero-foreground">
                      <x-icon :name="$child['icon'] ?? 'chevron-right'" class="w-4 h-4" />
                    </span>
                    <span class="leading-tight">
                      <span class="block font-semibold">{{ $child['label'] }}</span>
                      @if (! empty($child['desc']))
                        <span class="block text-xs text-muted-foreground">{{ $child['desc'] }}</span>
                      @endif
                    </span>
                  </a>
                @endforeach
              </div>
            </div>
          </div>
        @else
          @php
            $to = ltrim($link['to'], '/');
            $active = $to === '' ? request()->is('/') : (request()->is($to) || request()->is($to.'/*'));
          @endphp
          <a href="{{ $link['to'] === '/' ? route('home') : url($link['to']) }}"
             class="relative rounded-full px-3 py-2 text-sm font-medium 2xl:px-4 transition-colors duration-200 {{ $active ? 'bg-navy-gradient text-hero-foreground shadow-soft' : 'text-muted-foreground hover:text-primary' }}">
            {{ $link['label'] }}
          </a>
        @endif
      @endforeach
    </div>

    <div class="hidden items-center gap-3 xl:flex">
      <a href="{{ route('ppdb') }}" class="shine inline-flex items-center gap-2 rounded-full bg-gold-gradient px-5 py-2.5 text-sm font-semibold text-gold-foreground shadow-soft transition-transform hover:-translate-y-0.5">
        Daftar PPDB <x-icon name="arrow-right" class="w-3.5 h-3.5" />
      </a>
    </div>

    <button type="button" data-nav-toggle aria-expanded="false" class="flex h-10 w-10 items-center justify-center rounded-full border border-border text-primary xl:hidden">
      <x-icon name="menu" data-icon-menu class="w-5 h-5" />
      <x-icon name="x" data-icon-close class="hidden w-5 h-5" />
    </button>

    <span data-nav-progress class="nav-scroll-progress" aria-hidden="true"></span>
  </nav>

  <div data-nav-menu class="glass mx-auto mt-2 hidden max-w-7xl flex-col gap-1 rounded-2xl border border-border/70 p-3 shadow-soft xl:hidden">
    @foreach ($site['nav_links'] as $link)
      @if (! empty($link['children']))
        @php
          $active = collect($link['children'])->contains(function ($child) {
            $to = ltrim($child['to'], '/');
            return request()->is($to) || request()->is($to.'/*');
          });
        @endphp
        <div data-nav-accordion class="overflow-hidden rounded-xl {{ $active ? 'bg-accent/60' : '' }}">
          <button type="button" data-nav-accordion-toggle class="flex w-full items-center justify-between rounded-xl px-4 py-3 text-sm font-medium {{ $active ? 'text-primary' : 'text-muted-foreground' }}">
            {{ $link['label'] }}
            <x-icon name="chevron-down" class="w-4 h-4 transition-transform duration-300 {{ $active ? 'rotate-180' : '' }}" data-nav-accordion-chevron />
          </button>
          <div data-nav-accordion-panel class="nav-acc-panel {{ $active ? 'is-open' : '' }}"><div><div class="grid gap-1 px-2 pb-2">
            @foreach ($link['children'] as $child)
              @php
                $childTo = ltrim($child['to'], '/');
                $childActive = request()->is($childTo) || request()->is($childTo.'/*');
              @endphp
              <a href="{{ url($child['to']) }}"
                 class="flex items-center gap-3 rounded-lg px-3 py-2.5 text-sm font-medium {{ $childActive ? 'bg-navy-gradient text-hero-foreground' : 'bg-card text-foreground' }}">
                <x-icon :name="$child['icon'] ?? 'chevron-right'" class="w-4 h-4" />
                {{ $child['label'] }}
              </a>
            @endforeach
          </div></div></div>
        </div>
      @else
        @php
          $to = ltrim($link['to'], '/');
          $active = $to === '' ? request()->is('/') : (request()->is($to) || request()->is($to.'/*'));
        @endphp
        <a href="{{ $link['to'] === '/' ? route('home') : url($link['to']) }}"
           class="rounded-xl px-4 py-3 text-sm font-medium {{ $active ? 'bg-navy-gradient text-hero-foreground' : 'text-muted-foreground' }}">
          {{ $link['label'] }}
        </a>
      @endif
    @endforeach
    <a href="{{ route('ppdb') }}" class="mt-1 inline-flex items-center justify-center gap-2 rounded-xl bg-gold-gradient px-4 py-3 text-sm font-semibold text-gold-foreground">
      Daftar PPDB <x-icon name="arrow-right" class="w-3.5 h-3.5" />
    </a>
  </div>
</header>