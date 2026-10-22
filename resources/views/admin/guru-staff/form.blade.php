@extends('layouts.admin')
@section('title', $item ? 'Edit Guru/Staff' : 'Tambah Guru/Staff')
@section('page-title', $item ? 'Edit Guru/Staff' : 'Tambah Guru/Staff')

@section('content')

<div class="enter-item enter-d1 mx-auto max-w-2xl rounded-2xl border border-border bg-card p-7 shadow-soft">
  <form method="POST" action="{{ $item ? route('admin.guru-staff.update', $item) : route('admin.guru-staff.store') }}" enctype="multipart/form-data" class="grid gap-5">
    @csrf
    @if ($item) @method('PUT') @endif

    <div>
      <label for="nama_lengkap" class="text-sm font-medium text-foreground">Nama Lengkap</label>
      <input type="text" name="nama_lengkap" id="nama_lengkap" value="{{ old('nama_lengkap', $item->nama_lengkap ?? '') }}" class="input-field" placeholder="Nama lengkap beserta gelar" />
      @error('nama_lengkap') <p class="mt-1 text-xs text-destructive">{{ $message }}</p> @enderror
    </div>

    <div>
      <label for="jabatan" class="text-sm font-medium text-foreground">Jabatan</label>
      <input type="text" name="jabatan" id="jabatan" value="{{ old('jabatan', $item->jabatan ?? '') }}" class="input-field" placeholder="Contoh: Kepala Sekolah / Guru Matematika" />
      @error('jabatan') <p class="mt-1 text-xs text-destructive">{{ $message }}</p> @enderror
    </div>

    <div>
      <label for="kategori" class="text-sm font-medium text-foreground">Kategori</label>
      <select name="kategori" id="kategori" class="input-field">
        @php $selectedKategori = old('kategori', $item->kategori ?? ''); @endphp
        <option value="" disabled {{ $selectedKategori === '' ? 'selected' : '' }}>Pilih kategori</option>
        @foreach ($kategoriOptions as $kategori)
          <option value="{{ $kategori }}" {{ $selectedKategori === $kategori ? 'selected' : '' }}>{{ $kategori }}</option>
        @endforeach
      </select>
      @error('kategori') <p class="mt-1 text-xs text-destructive">{{ $message }}</p> @enderror
    </div>

    <div>
      <label for="urutan" class="text-sm font-medium text-foreground">Urutan Tampil</label>
      <input type="number" name="urutan" id="urutan" value="{{ old('urutan', $item->urutan ?? 0) }}" class="input-field" placeholder="0" />
      @error('urutan') <p class="mt-1 text-xs text-destructive">{{ $message }}</p> @enderror
    </div>

    <div data-foto-uploader>
      <label class="text-sm font-medium text-foreground">Foto</label>

      <div class="mt-2 flex items-center gap-4">
        <div class="relative h-24 w-24 shrink-0 overflow-hidden rounded-xl border border-border bg-secondary/60">
          <img
            data-foto-preview
            src="{{ $item && $item->foto ? \App\Support\Site::imageUrl($item->foto) : '' }}"
            alt="{{ $item->nama_lengkap ?? 'Pratinjau foto' }}"
            class="h-full w-full object-cover {{ $item && $item->foto ? '' : 'hidden' }}"
          />
          <div data-foto-placeholder class="flex h-full w-full items-center justify-center {{ $item && $item->foto ? 'hidden' : '' }}">
            <x-icon name="user" class="h-8 w-8 text-muted-foreground/50" />
          </div>
        </div>

        <div class="flex flex-col items-start gap-2">
          <button type="button" data-foto-trigger class="inline-flex items-center gap-2 rounded-full border border-border bg-card px-4 py-2 text-xs font-semibold text-foreground shadow-soft hover:bg-secondary">
            <x-icon name="upload" class="h-3.5 w-3.5" />
            <span data-foto-trigger-label>{{ $item && $item->foto ? 'Ganti Foto' : 'Pilih Foto' }}</span>
          </button>
          <button type="button" data-foto-clear class="hidden text-xs font-semibold text-destructive hover:underline">Batalkan foto baru</button>
          <p class="text-xs text-muted-foreground">JPG/PNG, maks 5MB. Foto akan dipotong menjadi persegi sebelum disimpan.</p>
        </div>
      </div>

      <input type="file" name="foto" id="foto" accept="image/*" class="hidden" data-foto-input />
      @error('foto') <p class="mt-1 text-xs text-destructive">{{ $message }}</p> @enderror
    </div>

    <div class="mt-2 flex items-center gap-3">
      <button type="submit" class="inline-flex items-center gap-2 rounded-full bg-navy-gradient px-6 py-3 text-sm font-semibold text-hero-foreground shadow-soft">
        <x-icon name="check" class="w-4 h-4" /> Simpan
      </button>
      <a href="{{ route('admin.guru-staff.index') }}" class="text-sm font-semibold text-muted-foreground hover:text-primary">Batal</a>
    </div>
  </form>
</div>

{{-- Modal potong foto: dipicu otomatis begitu file pada input "Foto" di atas dipilih --}}
<div id="modal-crop-foto" data-modal class="fixed inset-0 z-50 hidden items-center justify-center bg-foreground/50 p-4 backdrop-blur-sm">
  <div data-modal-panel class="flex w-full max-w-md flex-col overflow-hidden rounded-3xl bg-card shadow-lift">

    <div class="relative shrink-0 overflow-hidden bg-navy-gradient px-6 py-5 text-hero-foreground">
      <div class="pointer-events-none absolute -right-10 -top-10 h-32 w-32 rounded-full bg-white/5"></div>
      <div class="relative flex items-center justify-between gap-4">
        <div class="flex items-center gap-3">
          <span class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-white/15">
            <x-icon name="image" class="h-5 w-5" />
          </span>
          <div class="min-w-0">
            <p class="font-display text-sm font-bold">Potong Foto</p>
            <p class="text-xs text-white/70">Geser & perbesar untuk memilih area foto</p>
          </div>
        </div>
        <button type="button" data-modal-close class="flex h-9 w-9 shrink-0 items-center justify-center rounded-full bg-white/10 hover:bg-white/20">
          <x-icon name="x" class="h-4 w-4" />
        </button>
      </div>
    </div>

    <div class="px-6 py-6">
      <div data-crop-frame class="relative mx-auto h-72 w-72 max-w-full touch-none select-none overflow-hidden rounded-2xl border border-border bg-secondary/60">
        <img data-crop-image src="" alt="" class="absolute left-1/2 top-1/2 max-w-none cursor-grab active:cursor-grabbing" draggable="false" />
      </div>

      <div class="mt-5 flex items-center gap-3">
        <x-icon name="minus" class="h-4 w-4 shrink-0 text-muted-foreground" />
        <input type="range" data-crop-zoom min="0" max="100" value="0" class="w-full accent-primary" />
        <x-icon name="plus" class="h-4 w-4 shrink-0 text-muted-foreground" />
      </div>
      <p class="mt-2 text-center text-xs text-muted-foreground">Seret foto di dalam kotak untuk mengatur posisi</p>
    </div>

    <div class="flex items-center justify-end gap-3 border-t border-border px-6 py-4">
      <button type="button" data-modal-close class="rounded-xl border border-border px-5 py-2.5 text-sm font-semibold text-foreground hover:bg-secondary">Batal</button>
      <button type="button" data-foto-crop-confirm class="inline-flex items-center gap-2 rounded-full bg-navy-gradient px-6 py-2.5 text-sm font-semibold text-hero-foreground shadow-soft">
        <x-icon name="check" class="h-4 w-4" /> Gunakan Foto
      </button>
    </div>

  </div>
</div>

@endsection