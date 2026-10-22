{{--
    Partial ini dipakai bersama oleh halaman admin.konten.profil,
    admin.konten.akademik, admin.konten.ppdb, dan admin.konten.galeri
    untuk menampilkan tab (jika resource dalam grup > 1) beserta tabel
    CRUD generik untuk resource yang sedang aktif ($tab).

    Variabel yang dibutuhkan (selalu tersedia dari KontenController):
    - $group     : kunci grup, contoh 'akademik'
    - $resources : daftar def resource dalam grup ini (KontenResource::forGroup)
    - $tab       : kunci resource yang sedang aktif
    - $rows      : data untuk resource yang sedang aktif
--}}

@if (count($resources) > 1)
  <div class="reveal mb-6 flex gap-2 overflow-x-auto pb-2">
    @foreach ($resources as $key => $resDef)
      <a href="{{ route('admin.konten.'.$group, ['tab' => $key]) }}"
         class="shrink-0 rounded-full px-4 py-2 text-sm font-semibold transition-colors {{ $tab === $key ? 'bg-navy-gradient text-hero-foreground shadow-soft' : 'border border-border text-muted-foreground hover:text-primary' }}">
        {{ $resDef['label'] }}
      </a>
    @endforeach
  </div>
@endif

@php $def = $resources[$tab]; @endphp

@if ($group === 'profil' && $tab === 'misi')
  {{-- Visi digabung bersebelahan dengan Misi supaya lebih mudah & terstruktur untuk diubah --}}
  <div class="reveal card-hover mb-6 overflow-hidden rounded-2xl border border-border bg-card shadow-soft">
    <div class="flex items-center gap-2.5 border-b border-border px-6 py-4">
      <span class="flex h-9 w-9 items-center justify-center rounded-xl bg-navy-gradient text-hero-foreground shadow-soft">
        <x-icon name="sparkles" class="w-4 h-4" />
      </span>
      <div>
        <h4 class="font-display text-sm font-bold text-foreground">Visi Sekolah</h4>
        <p class="text-xs text-muted-foreground">Satu kalimat visi utama. Poin-poin Misi diatur di bawah ini.</p>
      </div>
    </div>
    <form method="POST" action="{{ route('admin.konten.profil.visi') }}" class="px-6 py-5">
      @csrf
      @method('PUT')
      <label for="visi" class="text-sm font-medium text-foreground">Isi Visi</label>
      <textarea name="visi" id="visi" rows="3" class="input-field" placeholder="Contoh: SMK yang peduli dan berbudaya lingkungan hidup dengan tamatan kompeten...">{{ old('visi', $profil->visi ?? '') }}</textarea>
      @error('visi') <p class="mt-1 text-xs text-destructive">{{ $message }}</p> @enderror

      <div class="mt-4 flex items-center gap-3">
        <button type="submit" class="shine inline-flex items-center gap-2 rounded-full bg-navy-gradient px-5 py-2.5 text-sm font-semibold text-hero-foreground shadow-soft">
          <x-icon name="check" class="w-4 h-4" /> Simpan Visi
        </button>
      </div>
    </form>
  </div>

  <div class="mb-3 flex items-center gap-2">
    <span class="h-px flex-1 bg-border"></span>
    <span class="flex items-center gap-1.5 text-xs font-bold uppercase tracking-wider text-muted-foreground">
      <x-icon name="trending-up" class="w-3.5 h-3.5" /> Poin-Poin Misi
    </span>
    <span class="h-px flex-1 bg-border"></span>
  </div>
@endif

@include('admin.konten._resource-table', ['group' => $group, 'tab' => $tab, 'def' => $def, 'rows' => $rows])