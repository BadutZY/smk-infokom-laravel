<footer class="relative overflow-hidden bg-navy-radial text-hero-foreground">
  <span class="accent-bar absolute inset-x-0 top-0" aria-hidden="true"></span>
  <div class="pointer-events-none absolute inset-0 bg-grain"></div>
  <div class="hud-grid opacity-70"></div>
  <span class="footer-watermark" aria-hidden="true">{{ $site['school']['brand_top'] }}</span>

  {{-- CTA band --}}
  <div class="relative border-b border-white/10">
    <div class="mx-auto max-w-7xl px-4 py-14 sm:px-6 lg:px-8">
      <div class="reveal-scale ring-gradient flex flex-col items-center justify-between gap-6 rounded-3xl border border-white/10 bg-white/5 px-6 py-9 text-center shadow-lift sm:flex-row sm:text-left lg:px-11">
        <div>
          <h3 class="font-display text-xl font-bold sm:text-2xl">Tertarik bergabung dengan {{ $site['school']['brand_top'] }}?</h3>
          <p class="mt-1.5 text-sm text-white/70">Pendaftaran PPDB dibuka. Kuota terbatas, daftar sekarang.</p>
        </div>
        <a href="{{ route('ppdb') }}" class="shine inline-flex shrink-0 items-center gap-2 rounded-full bg-gold-gradient px-6 py-3 text-sm font-semibold text-gold-foreground shadow-soft transition-transform hover:-translate-y-0.5">
          Daftar PPDB <x-icon name="arrow-right" class="w-4 h-4" />
        </a>
      </div>
    </div>
  </div>

  <div class="relative mx-auto max-w-7xl px-4 py-16 sm:px-6 lg:px-8">
    <div class="stagger-group grid gap-10 sm:grid-cols-2 lg:grid-cols-12">
      <div class="stagger-item sm:col-span-2 lg:col-span-4">
        <div class="flex items-center gap-3">
          <span class="flex h-12 w-12 items-center justify-center rounded-xl bg-white/10 p-1.5">
            <img src="{{ asset('images/logo.png') }}" alt="" class="h-full w-full object-contain" />
          </span>
          <span class="leading-tight">
            <span class="block font-display text-base font-bold">{{ $site['school']['brand_top'] }}</span>
            <span class="block text-xs font-semibold tracking-[0.2em] text-gold">{{ $site['school']['brand_bottom'] }}</span>
          </span>
        </div>
        <p class="mt-5 max-w-sm text-sm leading-relaxed text-white/70">{{ $site['school']['tagline'] }}</p>
        <div class="mt-6 flex items-center gap-3">
          <a href="#" aria-label="Facebook" class="flex h-9 w-9 items-center justify-center rounded-full bg-white/10 transition-all duration-300 hover:-translate-y-1 hover:bg-gold hover:text-primary"><x-icon name="facebook" class="w-4 h-4" /></a>
          <a href="#" aria-label="Instagram" class="flex h-9 w-9 items-center justify-center rounded-full bg-white/10 transition-all duration-300 hover:-translate-y-1 hover:bg-gold hover:text-primary"><x-icon name="instagram" class="w-4 h-4" /></a>
          <a href="#" aria-label="YouTube" class="flex h-9 w-9 items-center justify-center rounded-full bg-white/10 transition-all duration-300 hover:-translate-y-1 hover:bg-gold hover:text-primary"><x-icon name="youtube" class="w-4 h-4" /></a>
        </div>
      </div>

      <div class="stagger-item lg:col-span-2">
        <h3 class="footer-heading">Tautan</h3>
        <ul class="mt-4 space-y-2.5 text-sm text-white/75">
          {{-- Footer hanya menampilkan menu utama (yang punya link langsung di navbar).
               Menu dropdown (Profil, Prestasi & Karier) sengaja tidak dimunculkan agar footer tidak menumpuk. --}}
          @foreach ($site['nav_links'] as $link)
            @if (empty($link['children']))
              <li><a href="{{ $link['to'] === '/' ? route('home') : url($link['to']) }}" class="link-underline inline-block transition-colors hover:text-white">{{ $link['label'] }}</a></li>
            @endif
          @endforeach
        </ul>
      </div>

      <div class="stagger-item lg:col-span-3">
        <h3 class="footer-heading">Kompetensi keahlian</h3>
        <ul class="mt-4 space-y-3 text-sm text-white/75">
          @foreach ($site['majors'] as $m)
            <li>
              <a href="{{ ! empty($m['slug']) ? route('akademik.jurusan', $m['slug']) : route('akademik') }}" class="footer-major group transition-colors hover:text-white" style="--c: {{ $m['color'] }}">
                <i aria-hidden="true"></i>
                <span><b class="font-semibold text-white">{{ $m['code'] }}</b> <span class="text-white/60 transition-colors group-hover:text-white/85">{{ $m['name'] }}</span></span>
              </a>
            </li>
          @endforeach
        </ul>
      </div>

      <div class="stagger-item lg:col-span-3">
        <h3 class="footer-heading">Kontak</h3>
        <ul class="mt-4 space-y-3 text-sm text-white/75">
          <li class="flex gap-3"><x-icon name="map-pin" class="w-4 h-4 mt-0.5 shrink-0 text-gold" /><span>{{ $site['school']['address'] }}</span></li>
          <li class="flex gap-3"><x-icon name="phone" class="w-4 h-4 shrink-0 text-gold" /><span>{{ $site['school']['phone'] }}</span></li>
          <li class="flex gap-3"><x-icon name="mail" class="w-4 h-4 shrink-0 text-gold" /><span>{{ $site['school']['email'] }}</span></li>
          <li class="flex gap-3"><x-icon name="clock" class="w-4 h-4 shrink-0 text-gold" /><span>{{ $site['school']['hours'] }}</span></li>
        </ul>
      </div>
    </div>

    <div class="mt-12 flex flex-col items-center justify-between gap-4 border-t border-white/10 pt-6 text-xs text-white/60 sm:flex-row">
      <p>&copy; {{ date('Y') }} {{ $site['school']['name'] }}. Semua hak cipta dilindungi.</p>
      <p>Dibangun dengan Laravel</p>
    </div>
  </div>
</footer>