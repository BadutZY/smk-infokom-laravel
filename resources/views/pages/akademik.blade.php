@extends('layouts.app')
@section('title', 'Akademik')

@section('content')

<x-page-hero crumb="Akademik" kicker="Kurikulum & Program" title="Akademik SMK INFOKOM" desc="Kompetensi keahlian, kalender akademik, dan kegiatan ekstrakurikuler sekolah." />

{{-- ===================== MAJORS DETAIL ===================== --}}
<section class="section-pad px-4 sm:px-6 lg:px-8">
  <div class="mx-auto max-w-6xl">
    <x-section-title kicker="Program Keahlian" title="Kompetensi Keahlian" desc="Empat program keahlian dengan kurikulum berbasis kebutuhan industri." />

    <div class="mt-10 space-y-8">
      @foreach ($site['majors'] as $i => $major)
        <div data-dir="{{ $i % 2 === 1 ? 'right' : 'left' }}" style="--major: {{ $major['color'] }}" class="major-card reveal grid gap-8 overflow-hidden rounded-3xl lg:grid-cols-2 {{ $i % 2 === 1 ? 'lg:[&>*:nth-child(2)]:order-2' : '' }}">
          <div class="major-card-frame" aria-hidden="true"></div>
          <div class="major-card-media aspect-[5/4] lg:aspect-auto">
            <img src="{{ \App\Support\Site::imageUrl($major['image']) }}" alt="{{ $major['name'] }}" class="h-full w-full object-cover" />
            <span class="major-card-hint" aria-hidden="true"><x-icon name="eye" class="w-3.5 h-3.5" /> Arahkan kursor untuk detail</span>
          </div>
          <div class="major-card-body flex flex-col justify-center p-7 sm:p-10" data-code="{{ $major['code'] }}">
            <span class="w-fit rounded-full bg-accent px-3 py-1 text-xs font-bold text-primary">{{ $major['code'] }}</span>
            <h3 class="mt-4 font-display text-xl font-bold text-foreground">{{ $major['name'] }}</h3>
            <p class="mt-3 text-sm leading-relaxed text-muted-foreground">{{ $major['desc'] }}</p>
            <ul class="mt-5 grid gap-2 sm:grid-cols-2">
              @foreach ($major['points'] as $point)
                <li class="flex items-start gap-2 text-sm text-muted-foreground">
                  <x-icon name="check-circle" class="mt-0.5 w-4 h-4 shrink-0 text-gold" /> {{ $point }}
                </li>
              @endforeach
            </ul>

            @if (!empty($major['slug']))
              {{--
                Kartu dengan foto di sebelah kanan (data-dir="right", index
                ganjil) diberi "self-end" supaya tombol ini nempel di sisi
                kanan kolom teks -> pas di sebelah foto (sesuai arah animasi
                reveal-nya yang datang dari kanan ke kiri). Kartu dengan foto
                di kiri (data-dir="left", index genap -> mis. DKV & TKJ)
                TIDAK diberi class ini, jadi tombolnya tetap di kiri seperti
                semula, tidak berubah.
              --}}
              <a href="{{ route('akademik.jurusan', $major['slug']) }}"
                 class="group/link relative mt-6 inline-flex w-fit items-center gap-1.5 text-sm font-bold text-primary {{ $i % 2 === 1 ? 'lg:self-end' : '' }}">
                Telusuri Lebih Lanjut
                <x-icon name="arrow-right" class="w-4 h-4 transition-transform duration-300 group-hover/link:translate-x-1.5" />
                <span class="absolute -bottom-1 left-0 h-0.5 w-0 bg-gold transition-all duration-300 group-hover/link:w-full"></span>
              </a>
            @endif
          </div>
          <div class="major-card-hit" aria-hidden="true"></div>
        </div>
      @endforeach
    </div>
  </div>
</section>

{{-- ===================== TABS: KALENDER & EKSKUL ===================== --}}
<section class="section-pad bg-secondary/50 px-4 sm:px-6 lg:px-8">
  <div class="mx-auto max-w-5xl">
    <div data-tabs class="reveal">
      <div class="mx-auto flex w-fit gap-2 rounded-full border border-border bg-card p-1.5 shadow-soft">
        <button type="button" data-tab-btn="kalender" class="rounded-full bg-primary px-5 py-2.5 text-sm font-semibold text-primary-foreground shadow-soft transition-colors">Kalender Akademik</button>
        <button type="button" data-tab-btn="ekskul" class="rounded-full px-5 py-2.5 text-sm font-semibold text-muted-foreground transition-colors">Ekstrakurikuler</button>
      </div>

      <div data-tab-panel="kalender" class="mt-10">
        <div class="rounded-3xl border border-border bg-card p-6 shadow-soft sm:p-10">
          <ol class="timeline stagger-group">
            @foreach ($site['kalender_akademik'] as $item)
              <li class="timeline-item stagger-item">
                <span class="timeline-when">{{ $item['periode'] }}</span>
                <span class="timeline-what">{{ $item['agenda'] }}</span>
              </li>
            @endforeach
          </ol>
        </div>
      </div>

      <div data-tab-panel="ekskul" class="mt-10 hidden">
        <div class="stagger-group grid gap-5 sm:grid-cols-2 lg:grid-cols-3">
          @foreach ($site['ekskul'] as $item)
            <div class="stagger-item card-hover group relative overflow-hidden rounded-2xl border border-border bg-card p-6 shadow-soft transition-all duration-300 hover:-translate-y-1 hover:shadow-lift">
              <span class="pointer-events-none absolute -right-6 -top-6 h-24 w-24 rounded-full bg-accent/60 transition-transform duration-500 group-hover:scale-125"></span>
              <span class="relative flex h-12 w-12 items-center justify-center rounded-2xl bg-navy-gradient text-hero-foreground shadow-soft">
                <x-icon :name="$item['icon']" class="w-6 h-6" />
              </span>
              <h3 class="relative mt-4 font-display text-base font-bold text-foreground">{{ $item['nama'] }}</h3>
              @if (!empty($item['deskripsi']))
                <p class="relative mt-2 text-sm leading-relaxed text-muted-foreground">{{ $item['deskripsi'] }}</p>
              @endif
            </div>
          @endforeach
        </div>
      </div>
    </div>
  </div>
</section>

{{-- ===================== FAQ ===================== --}}
<section class="section-pad px-4 sm:px-6 lg:px-8">
  <div class="mx-auto max-w-3xl">
    <x-section-title kicker="Tanya Jawab" title="Pertanyaan Seputar Akademik" />
    <div class="mt-10 space-y-3">
      @foreach ($site['faqs'] as $i => $faq)
        <details class="faq-item reveal">
          <summary>
            {{ $faq['q'] }}
            <span class="faq-plus"><x-icon name="plus" class="w-4 h-4" /></span>
          </summary>
          <p class="faq-body">{{ $faq['a'] }}</p>
        </details>
      @endforeach
    </div>
  </div>
</section>

@endsection