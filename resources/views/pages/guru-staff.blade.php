@extends('layouts.app')
@section('title', 'Guru & Staff')

@section('content')

<x-page-hero crumb="Guru & Staff" kicker="Tenaga Pendidik" title="Guru & Staff SMK INFOKOM Kota Bogor" desc="Mengenal jajaran pimpinan, tenaga kependidikan, dan guru yang mendampingi proses belajar mengajar di sekolah." />

@php
  // Ikon per kategori. Kategori baru yang belum terdaftar di sini akan
  // otomatis memakai ikon default ('idcard') — jadi tetap aman meski ada
  // kategori tambahan di kemudian hari.
  $kategoriIcon = [
      'Pimpinan Sekolah' => 'shield-check',
      'Manajemen & Tata Usaha' => 'building',
      'Kepala Program Keahlian' => 'graduation-cap',
      'Pembina OSIS' => 'users',
      'Guru & Staf' => 'idcard',
  ];
@endphp

<section class="section-pad px-4 sm:px-6 lg:px-8">
  <div class="mx-auto max-w-6xl">
    <x-section-title kicker="Tim Kami" title="Guru & Staff SMK INFOKOM" desc="Susunan pimpinan, tenaga kependidikan, dan pengajar sekolah." />

    @if ($guruStaffGrouped->isNotEmpty())
      @php $totalStaff = $guruStaffGrouped->collapse()->count(); @endphp

      {{-- Pencarian langsung + filter kategori --}}
      <form class="reveal mx-auto mt-10 grid max-w-3xl gap-3 sm:grid-cols-[1fr_auto]" role="search" action="#" onsubmit="return false">
        <label class="search-field">
          <span class="sr-only">Cari guru atau staff</span>
          <x-icon name="search" />
          <input type="search" data-staff-search placeholder="Cari nama atau jabatan..." autocomplete="off" />
        </label>
        <div class="sm:w-72">
          <label for="staff-filter-select" class="sr-only">Filter kategori Guru &amp; Staff</label>
          <div class="staff-filter-select-wrap">
            <x-icon name="filter" class="staff-filter-select-icon h-4 w-4" />
            <select id="staff-filter-select" data-staff-filter-select class="staff-filter-select">
              <option value="Semua" selected>Semua Kategori ({{ $totalStaff }} orang)</option>
              @foreach ($guruStaffGrouped as $kategori => $anggota)
                <option value="{{ $kategori }}">{{ $kategori }} ({{ $anggota->count() }} orang)</option>
              @endforeach
            </select>
            <x-icon name="chevron-down" class="staff-filter-select-chevron h-4 w-4" />
          </div>
        </div>
      </form>
      <p class="reveal mt-4 text-center text-sm text-muted-foreground">
        Menampilkan <b class="font-semibold text-foreground" data-staff-shown>{{ $totalStaff }}</b> dari {{ $totalStaff }} orang
        di <b class="font-semibold text-foreground">{{ $guruStaffGrouped->count() }}</b> kategori jabatan
      </p>
    @endif

    @forelse ($guruStaffGrouped as $kategori => $anggota)
      <div class="mt-14 first:mt-10" data-staff-category="{{ $kategori }}">

        {{-- Judul kategori --}}
        <div class="reveal mb-6 flex items-center gap-3 sm:gap-4">
          <span class="flex h-11 w-11 shrink-0 items-center justify-center rounded-2xl bg-navy-gradient text-hero-foreground shadow-soft sm:h-12 sm:w-12">
            <x-icon name="{{ $kategoriIcon[$kategori] ?? 'idcard' }}" class="h-5 w-5 sm:h-6 sm:w-6" />
          </span>
          <div class="min-w-0">
            <h3 class="font-display text-lg font-bold text-foreground sm:text-xl">{{ $kategori }}</h3>
            <p class="text-xs text-muted-foreground" data-staff-cat-count>{{ $anggota->count() }} orang</p>
          </div>
          <div class="ml-1 hidden h-px flex-1 bg-border sm:block"></div>
        </div>

        @if ($kategori === 'Pimpinan Sekolah')
          {{-- Kartu Pimpinan Sekolah: sama seperti kartu kategori lain. Khusus
               Kepala Sekolah dibedakan (border & aksen emas permanen, lebih
               menonjol, melebar 2 kolom) + lencana yang ikut membesar bersama
               kartu saat hover, tanpa pernah terpotong sudut membulat kartu. --}}
          <div class="stagger-group grid grid-cols-2 gap-3 sm:gap-5 lg:grid-cols-3 xl:grid-cols-4">
            @foreach ($anggota as $guru)
              @php $isKepsek = $guru->jabatan === 'Kepala Sekolah'; @endphp
              <div data-name="{{ $guru->nama_lengkap }}" data-role="{{ $guru->jabatan }}" class="stagger-item staff-card staff-card-lead relative rounded-[28px] border border-border bg-card text-center shadow-soft {{ $isKepsek ? 'staff-card-principal' : '' }}">
                @if ($isKepsek)
                  <span class="staff-card-lead-badge absolute -left-3 -top-3 z-10 flex h-10 w-10 items-center justify-center rounded-full bg-navy-gradient text-hero-foreground" title="Kepala Sekolah">
                    <x-icon name="award" class="h-5 w-5" />
                  </span>
                @endif

                <div class="relative overflow-hidden rounded-[28px]">
                  <span class="staff-card-accent" aria-hidden="true"></span>

                  <div class="relative z-[1] p-3 pb-0">
                    <div class="staff-photo staff-panel relative aspect-square w-full overflow-hidden rounded-3xl">
                      @if ($guru->foto)
                        <span class="staff-photo-aura" aria-hidden="true"></span>
                        <img src="{{ \App\Support\Site::imageUrl($guru->foto) }}" alt="{{ $guru->nama_lengkap }}" loading="lazy" class="staff-photo-img relative z-[1] h-full w-full object-contain p-3" />
                      @else
                        <div class="relative z-[1] flex h-full w-full items-center justify-center rounded-3xl bg-navy-gradient font-display text-2xl font-bold text-hero-foreground">{{ $guru->initials() }}</div>
                      @endif
                    </div>
                  </div>

                  <div class="relative z-[1] p-3 pt-3 sm:p-5 sm:pt-4">
                    <p class="staff-name font-display text-sm font-bold leading-snug text-foreground">{{ $guru->nama_lengkap }}</p>
                    <span class="staff-badge mt-2 inline-block rounded-full px-3 py-1 text-xs font-semibold {{ $isKepsek ? 'staff-badge-gold bg-transparent' : 'bg-accent text-primary' }}">{{ $guru->jabatan }}</span>
                  </div>
                </div>
              </div>
            @endforeach
          </div>
        @else
          {{-- Kartu kategori lainnya --}}
          <div class="stagger-group grid grid-cols-2 gap-3 sm:gap-5 lg:grid-cols-3 xl:grid-cols-4">
            @foreach ($anggota as $guru)
              <div data-name="{{ $guru->nama_lengkap }}" data-role="{{ $guru->jabatan }}" class="stagger-item staff-card relative overflow-hidden rounded-[28px] border border-border bg-card text-center shadow-soft">
                <span class="staff-card-accent" aria-hidden="true"></span>

                <div class="relative z-[1] p-3 pb-0">
                  <div class="staff-photo staff-panel relative aspect-square w-full overflow-hidden rounded-3xl">
                    @if ($guru->foto)
                      <span class="staff-photo-aura" aria-hidden="true"></span>
                      <img src="{{ \App\Support\Site::imageUrl($guru->foto) }}" alt="{{ $guru->nama_lengkap }}" loading="lazy" class="staff-photo-img relative z-[1] h-full w-full object-contain p-3" />
                    @else
                      <div class="relative z-[1] flex h-full w-full items-center justify-center rounded-3xl bg-navy-gradient font-display text-2xl font-bold text-hero-foreground">{{ $guru->initials() }}</div>
                    @endif
                  </div>
                </div>

                <div class="relative z-[1] p-3 pt-3 sm:p-5 sm:pt-4">
                  <p class="staff-name font-display text-sm font-bold leading-snug text-foreground">{{ $guru->nama_lengkap }}</p>
                  <span class="staff-badge mt-2 inline-block rounded-full bg-accent px-3 py-1 text-xs font-semibold text-primary">{{ $guru->jabatan }}</span>
                </div>
              </div>
            @endforeach
          </div>
        @endif
      </div>
    @empty
      <p class="mt-10 text-center text-sm text-muted-foreground">Data guru & staff belum tersedia.</p>
    @endforelse

    <p data-staff-empty class="mt-14 hidden rounded-2xl border border-dashed border-border py-12 text-center text-sm text-muted-foreground">
      Tidak ada guru atau staff yang cocok dengan pencarian Anda.
    </p>
  </div>
</section>

@endsection