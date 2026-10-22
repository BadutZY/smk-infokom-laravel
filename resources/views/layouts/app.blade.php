<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>@yield('title', $site['school']['short'] ?? 'SMK INFOKOM Kota Bogor') - {{ $site['school']['short'] ?? '' }}</title>
  <meta name="description" content="@yield('description', $site['school']['tagline'] ?? '')" />
  <link rel="icon" href="{{ asset('images/logo.png') }}" />

  <meta name="theme-color" content="#0d1a3d" />
  @include('partials.head-boot')

  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Sora:wght@400;600;700;800&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" />

  @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-background text-foreground antialiased" data-transition="curtain">
  @include('partials.page-transition')
  @include('partials.navbar')
  @include('partials.flash')

  <main>
    @yield('content')
  </main>

  @include('partials.footer')

  {{-- Chatbot AI (kanan bawah, di atas tombol "kembali ke atas") --}}
  @include('partials.chatbot')

  <div data-lightbox class="fixed inset-0 z-50 hidden items-center justify-center bg-black/90 p-4" role="dialog" aria-modal="true" aria-label="Penampil foto">
    <span data-lightbox-count class="lb-count" aria-live="polite"></span>
    <button type="button" data-lightbox-close aria-label="Tutup" class="absolute right-5 top-5 z-[3] flex h-11 w-11 items-center justify-center rounded-full bg-white/10 text-white transition-colors hover:bg-white/20">
      <x-icon name="x" class="w-5 h-5" />
    </button>
    <button type="button" data-lightbox-prev aria-label="Foto sebelumnya" class="lb-btn lb-prev hidden"><x-icon name="chevron-left" class="w-6 h-6" /></button>
    <button type="button" data-lightbox-next aria-label="Foto berikutnya" class="lb-btn lb-next hidden"><x-icon name="chevron-right" class="w-6 h-6" /></button>
    <figure class="max-h-[88vh] max-w-5xl">
      <img data-lightbox-img src="" alt="" class="max-h-[76vh] w-full rounded-2xl object-contain" />
      <figcaption data-lightbox-caption class="mt-3 text-center text-sm text-white/80"></figcaption>
    </figure>
  </div>
</body>
</html>