@extends('layouts.admin')
@section('title', $item ? 'Edit Lokasi Kunjungan' : 'Tambah Lokasi Kunjungan')
@section('page-title', $item ? 'Edit Lokasi Kunjungan' : 'Tambah Lokasi Kunjungan')

@section('content')

<div class="enter-item enter-d1 mx-auto max-w-3xl rounded-2xl border border-border bg-card p-7 shadow-soft">
  <form method="POST" action="{{ $item ? route('admin.kunjungan-industri.lokasi.update', $item) : route('admin.kunjungan-industri.lokasi.store') }}" enctype="multipart/form-data" class="grid gap-5">
    @csrf
    @if ($item) @method('PUT') @endif

    <div class="grid gap-5 sm:grid-cols-2">
      <div class="sm:col-span-2">
        <label for="nama" class="text-sm font-medium text-foreground">Nama Lokasi</label>
        <input type="text" name="nama" id="nama" value="{{ old('nama', $item->nama ?? '') }}" class="input-field" placeholder="Contoh: Universitas Amikom" />
        @error('nama') <p class="mt-1 text-xs text-destructive">{{ $message }}</p> @enderror
      </div>

      <div>
        <label for="kategori" class="text-sm font-medium text-foreground">Kategori <span class="text-muted-foreground">(opsional)</span></label>
        <input type="text" name="kategori" id="kategori" value="{{ old('kategori', $item->kategori ?? '') }}" class="input-field" placeholder="Contoh: Perguruan Tinggi" />
        @error('kategori') <p class="mt-1 text-xs text-destructive">{{ $message }}</p> @enderror
      </div>

      <div>
        <label for="kota" class="text-sm font-medium text-foreground">Kota / Alamat Singkat <span class="text-muted-foreground">(opsional)</span></label>
        <input type="text" name="kota" id="kota" value="{{ old('kota', $item->kota ?? '') }}" class="input-field" placeholder="Contoh: Yogyakarta" />
        @error('kota') <p class="mt-1 text-xs text-destructive">{{ $message }}</p> @enderror
      </div>

      <div>
        <label for="icon" class="text-sm font-medium text-foreground">Ikon</label>
        <select name="icon" id="icon" class="input-field">
          @foreach (\App\Models\KunjunganIndustri::ICONS as $val => $label)
            <option value="{{ $val }}" {{ old('icon', $item->icon ?? 'map-pin') === $val ? 'selected' : '' }}>{{ $label }}</option>
          @endforeach
        </select>
        @error('icon') <p class="mt-1 text-xs text-destructive">{{ $message }}</p> @enderror
      </div>

      <div>
        <label for="urutan" class="text-sm font-medium text-foreground">Urutan Tampil</label>
        <input type="number" name="urutan" id="urutan" value="{{ old('urutan', $item->urutan ?? 0) }}" class="input-field" placeholder="0" />
        <p class="mt-1 text-xs text-muted-foreground">Angka kecil tampil lebih dulu.</p>
        @error('urutan') <p class="mt-1 text-xs text-destructive">{{ $message }}</p> @enderror
      </div>

      <div class="sm:col-span-2">
        <label for="deskripsi" class="text-sm font-medium text-foreground">Penjelasan Singkat <span class="text-muted-foreground">(opsional)</span></label>
        <textarea name="deskripsi" id="deskripsi" rows="4" class="input-field" placeholder="Ceritakan singkat apa yang dilakukan / dipelajari di lokasi ini">{{ old('deskripsi', $item->deskripsi ?? '') }}</textarea>
        @error('deskripsi') <p class="mt-1 text-xs text-destructive">{{ $message }}</p> @enderror
      </div>

      <div class="sm:col-span-2">
        <label for="sorotan" class="text-sm font-medium text-foreground">Poin Sorotan <span class="text-muted-foreground">(opsional)</span></label>
        <textarea name="sorotan" id="sorotan" rows="3" class="input-field" placeholder="Satu poin per baris, contoh:&#10;Sesi pemaparan di auditorium&#10;Mengenal Amikom Creative Economy Park">{{ old('sorotan', $item->sorotan ?? '') }}</textarea>
        <p class="mt-1 text-xs text-muted-foreground">Tulis satu poin per baris. Disarankan 3 poin agar tampilan seimbang.</p>
        @error('sorotan') <p class="mt-1 text-xs text-destructive">{{ $message }}</p> @enderror
      </div>
    </div>

    {{-- ===== Foto ===== --}}
    <div class="rounded-2xl border border-border bg-secondary/30 p-5">
      <p class="text-sm font-semibold text-foreground">Foto Lokasi</p>
      <p class="mt-0.5 text-xs text-muted-foreground">Foto ditampilkan utuh (tidak dipotong). Foto lebar (landscape) paling pas. Maks 10 MB per foto.</p>

      @if ($item && $item->fotos->isNotEmpty())
        <div class="mt-4 grid gap-3">
          @foreach ($item->fotos as $foto)
            <div data-foto-row class="rounded-xl border border-border bg-card p-3">
              <div class="flex flex-col gap-3 sm:flex-row sm:items-start">
                {{-- Foto saat ini (berubah jadi pratinjau saat memilih file pengganti) --}}
                <div class="w-full shrink-0 sm:w-40">
                  <div class="relative h-24 overflow-hidden rounded-lg border border-border bg-secondary">
                    <img data-foto-img src="{{ $foto->url() }}" alt="" class="h-full w-full object-contain"
                         onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';" />
                    <div style="display:none" class="absolute inset-0 flex-col items-center justify-center gap-1 p-2 text-center text-[10px] leading-tight text-muted-foreground">
                      <x-icon name="image" class="w-5 h-5" />
                      File belum ditemukan
                      <span class="break-all">{{ $foto->path }}</span>
                    </div>
                  </div>
                  <p data-foto-state class="mt-1 text-center text-[11px] text-muted-foreground">Foto saat ini</p>
                </div>

                <div class="grid flex-1 gap-3 sm:grid-cols-[1fr_5rem]">
                  <div>
                    <label class="text-xs font-medium text-muted-foreground">Keterangan foto</label>
                    <input type="text" name="foto_keterangan[{{ $foto->id }}]" value="{{ old('foto_keterangan.'.$foto->id, $foto->keterangan) }}" class="input-field" placeholder="Keterangan singkat (opsional)" />
                  </div>
                  <div>
                    <label class="text-xs font-medium text-muted-foreground">Urutan</label>
                    <input type="number" name="foto_urutan[{{ $foto->id }}]" value="{{ old('foto_urutan.'.$foto->id, $foto->urutan) }}" class="input-field" />
                  </div>

                  <div class="sm:col-span-2">
                    <label class="text-xs font-medium text-muted-foreground">Ganti file foto <span class="font-normal">(kosongkan jika tidak ingin mengganti)</span></label>
                    <input type="file" name="ganti_foto[{{ $foto->id }}]" accept="image/*" data-foto-replace class="input-field" />
                    @error('ganti_foto.'.$foto->id) <p class="mt-1 text-xs text-destructive">{{ $message }}</p> @enderror
                  </div>

                  @if ($lokasiOptions->count() > 1)
                    <div class="sm:col-span-2">
                      <label class="text-xs font-medium text-muted-foreground">Pindahkan ke lokasi</label>
                      <select name="foto_lokasi[{{ $foto->id }}]" class="input-field">
                        @foreach ($lokasiOptions as $opt)
                          <option value="{{ $opt->id }}" {{ (int) old('foto_lokasi.'.$foto->id, $foto->kunjungan_industri_id) === $opt->id ? 'selected' : '' }}>{{ $opt->nama }}</option>
                        @endforeach
                      </select>
                    </div>
                  @endif
                </div>
              </div>

              <label class="mt-3 inline-flex items-center gap-2 text-xs font-medium text-destructive">
                <input type="checkbox" name="hapus_foto[]" value="{{ $foto->id }}" class="accent-primary" /> Hapus foto ini
              </label>
            </div>
          @endforeach
        </div>
      @endif

      <div class="mt-5">
        <label class="text-sm font-medium text-foreground">{{ $item && $item->fotos->isNotEmpty() ? 'Tambah Foto Baru' : 'Unggah Foto' }}</label>
        <input type="file" name="fotos[]" id="fotos" accept="image/*" multiple class="input-field" />
        <p class="mt-1 text-xs text-muted-foreground">Bisa memilih beberapa foto sekaligus. Keterangan tiap foto bisa diisi setelah disimpan (lewat Edit).</p>
        <div id="foto-preview" class="mt-3 grid grid-cols-2 gap-3 sm:grid-cols-4"></div>
        @error('fotos') <p class="mt-1 text-xs text-destructive">{{ $message }}</p> @enderror
        @error('fotos.*') <p class="mt-1 text-xs text-destructive">{{ $message }}</p> @enderror
      </div>
    </div>

    <div class="mt-2 flex items-center gap-3">
      <button type="submit" class="inline-flex items-center gap-2 rounded-full bg-navy-gradient px-6 py-3 text-sm font-semibold text-hero-foreground shadow-soft">
        <x-icon name="check" class="w-4 h-4" /> Simpan
      </button>
      <a href="{{ route('admin.kunjungan-industri.index', ['tab' => 'lokasi']) }}" class="text-sm font-semibold text-muted-foreground hover:text-primary">Batal</a>
    </div>
  </form>
</div>

<script>
  // Pratinjau foto baru sebelum disimpan.
  (function () {
    var input = document.getElementById('fotos');
    var box = document.getElementById('foto-preview');
    if (!input || !box) return;
    input.addEventListener('change', function () {
      box.innerHTML = '';
      Array.prototype.forEach.call(input.files || [], function (file) {
        var img = document.createElement('img');
        img.src = URL.createObjectURL(file);
        img.className = 'h-24 w-full rounded-lg border border-border bg-black/5 object-contain';
        box.appendChild(img);
      });
    });
  })();

  // Pratinjau foto pengganti: gambar di baris foto langsung berganti saat file dipilih.
  (function () {
    document.querySelectorAll('[data-foto-row]').forEach(function (row) {
      var input = row.querySelector('[data-foto-replace]');
      var img = row.querySelector('[data-foto-img]');
      var state = row.querySelector('[data-foto-state]');
      if (!input || !img) return;
      input.addEventListener('change', function () {
        var file = input.files && input.files[0];
        if (!file) return;
        img.style.display = '';
        if (img.nextElementSibling) img.nextElementSibling.style.display = 'none';
        img.src = URL.createObjectURL(file);
        if (state) { state.textContent = 'Foto baru (belum disimpan)'; state.style.color = 'var(--primary)'; }
      });
    });
  })();
</script>

@include('admin.kunjungan-industri._upload-guard')

@endsection