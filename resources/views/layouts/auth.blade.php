<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>@yield('title', $site['school']['short'] ?? 'SMK INFOKOM Kota Bogor') - {{ $site['school']['short'] ?? '' }}</title>
  <meta name="description" content="@yield('description', $site['school']['tagline'] ?? '')" />
  <meta name="robots" content="noindex, nofollow" />
  <link rel="icon" href="{{ asset('images/logo.png') }}" />

  @include('partials.head-boot')

  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Sora:wght@400;600;700;800&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" />

  @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-background text-foreground antialiased" data-transition="curtain">
  @include('partials.page-transition')
  @include('partials.flash')

  <main class="min-h-screen">
    @yield('content')
  </main>
</body>
</html>