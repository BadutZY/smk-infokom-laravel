@extends('layouts.admin')
@section('title', $item ? 'Edit Prestasi' : 'Tambah Prestasi')
@section('page-title', $item ? 'Edit Prestasi' : 'Tambah Prestasi')

@section('content')

<div class="enter-item enter-d1 mx-auto max-w-2xl rounded-2xl border border-border bg-card p-7 shadow-soft">
  <form method="POST" action="{{ $item ? route('admin.prestasi-sekolah.update', $item) : route('admin.prestasi-sekolah.store') }}" enctype="multipart/form-data" class="grid gap-5">
    @csrf
    @if ($item) @method('PUT') @endif

    <div class="rounded-2xl border border-border bg-secondary/30 p-4">
      <label for="kelompok" class="text-sm font-medium text-foreground">Nomor Kelompok</label>
      <input type="number" min="1" name="kelompok" id="kelompok" value="{{ old('kelompok', $item->kelompok ?? $kelompokDefault) }}" class="input-field" />
      <p class="mt-1.5 text-xs text-muted-foreground">Baris dengan nomor kelompok yang <strong>sama</strong> akan digabung menjadi satu kartu prestasi (untuk siswa/tim yang punya beberapa kejuaraan). Gunakan nomor kelompok siswa yang sudah ada untuk menambah prestasi lain ke kartu yang sama.</p>
      @error('kelompok') <p class="mt-1 text-xs text-destructive">{{ $message }}</p> @enderror
    </div>

    <div>
      <label for="nama_siswa" class="text-sm font-medium text-foreground">Nama Siswa / Tim</label>
      <input type="text" name="nama_siswa" id="nama_siswa" value="{{ old('nama_siswa', $item->nama_siswa ?? '') }}" class="input-field" placeholder="Contoh: Amanda Tagrida Viona atau Tim Futsal" />
      @error('nama_siswa') <p class="mt-1 text-xs text-destructive">{{ $message }}</p> @enderror
    </div>

    {{-- Foto siswa / tim: dipakai oleh semua baris dengan nomor kelompok yang sama --}}
    <div class="rounded-2xl border border-border bg-secondary/30 p-4">
      <label for="foto" class="text-sm font-medium text-foreground">Foto Siswa / Tim <span class="text-muted-foreground">(opsional)</span></label>

      @if (! ($fotoReady ?? true))
        <p class="mt-2 rounded-xl border border-gold/40 bg-gold/10 px-3 py-2 text-xs leading-relaxed text-foreground">
          Fitur foto belum aktif di database. Jalankan <code class="font-semibold">php artisan migrate</code> terlebih dahulu, lalu muat ulang halaman ini.
        </p>
      @else
        <div class="mt-3 flex flex-wrap items-start gap-4">
          <div class="relative shrink-0 overflow-hidden rounded-2xl border border-border bg-card" style="width:8.5rem; aspect-ratio:4/3;">
            <img id="foto-preview" src="{{ $fotoSaatIni ?? '' }}" alt="Pratinjau foto" class="{{ ($fotoSaatIni ?? null) ? '' : 'hidden' }}" style="position:absolute; inset:0; width:100%; height:100%; object-fit:cover; object-position:50% 22%;" />
            <span id="foto-preview-empty" class="{{ ($fotoSaatIni ?? null) ? 'hidden' : 'flex' }} items-center justify-center text-muted-foreground" style="position:absolute; inset:0;">
              <x-icon name="image" class="w-7 h-7" />
            </span>
          </div>

          <div class="min-w-0 flex-1" style="min-width:12rem;">
            <input type="file" name="foto" id="foto" accept="image/jpeg,image/png,image/webp" class="input-field" />
            <p class="mt-1.5 text-xs leading-relaxed text-muted-foreground">JPG, PNG, atau WebP, maksimal 5 MB. Gunakan foto yang terang dengan wajah di bagian atas gambar (rasio 4:3 atau potret, lebar minimal 800 px) supaya tampil rapi di kartu.</p>
            <p class="mt-1 text-xs leading-relaxed text-muted-foreground">Satu foto dipakai oleh semua baris dengan <strong>nomor kelompok yang sama</strong>. Menambah prestasi ke kelompok yang sudah punya foto otomatis memakai foto itu.</p>

            @if ($fotoSaatIni ?? null)
              <label class="mt-3 inline-flex cursor-pointer items-center gap-2 text-sm text-muted-foreground">
                <input type="checkbox" name="hapus_foto" value="1" id="hapus_foto" {{ old('hapus_foto') ? 'checked' : '' }} />
                Hapus foto saat ini
              </label>
            @endif
          </div>
        </div>
      @endif

      @error('foto') <p class="mt-2 text-xs text-destructive">{{ $message }}</p> @enderror
    </div>

    <div>
      <label for="nama_kejuaraan" class="text-sm font-medium text-foreground">Nama Kejuaraan &amp; Tingkat Lomba</label>
      <textarea name="nama_kejuaraan" id="nama_kejuaraan" rows="2" class="input-field" placeholder="Contoh: OLIMFEST 2025 Bidang Lomba: Olimpiade Biologi Tingkat SMA">{{ old('nama_kejuaraan', $item->nama_kejuaraan ?? '') }}</textarea>
      @error('nama_kejuaraan') <p class="mt-1 text-xs text-destructive">{{ $message }}</p> @enderror
    </div>

    <div class="grid gap-5 sm:grid-cols-2">
      <div>
        <label for="juara" class="text-sm font-medium text-foreground">Predikat Juara</label>
        <input type="text" name="juara" id="juara" value="{{ old('juara', $item->juara ?? '') }}" class="input-field" placeholder="Contoh: Juara 1 (Medali Emas) Nasional" />
        @error('juara') <p class="mt-1 text-xs text-destructive">{{ $message }}</p> @enderror
      </div>

      <div>
        <label for="peringkat" class="text-sm font-medium text-foreground">Lencana Peringkat</label>
        @php $selectedPeringkat = old('peringkat', $item->peringkat ?? 'emas'); @endphp
        <select name="peringkat" id="peringkat" class="input-field">
          @foreach (\App\Models\PrestasiSekolah::PERINGKAT as $key => $label)
            <option value="{{ $key }}" {{ $selectedPeringkat === $key ? 'selected' : '' }}>{{ $label }}</option>
          @endforeach
        </select>
        @error('peringkat') <p class="mt-1 text-xs text-destructive">{{ $message }}</p> @enderror
      </div>

      <div>
        <label for="tingkat" class="text-sm font-medium text-foreground">Tingkat / Wilayah <span class="text-muted-foreground">(opsional)</span></label>
        <input list="tingkat-options" type="text" name="tingkat" id="tingkat" value="{{ old('tingkat', $item->tingkat ?? '') }}" class="input-field" placeholder="Contoh: Kota Bogor, Nasional" />
        <datalist id="tingkat-options">
          <option value="Kota Bogor"></option>
          <option value="Provinsi Jawa Barat"></option>
          <option value="Nasional"></option>
          <option value="Internasional"></option>
        </datalist>
        @error('tingkat') <p class="mt-1 text-xs text-destructive">{{ $message }}</p> @enderror
      </div>

      <div>
        <label for="tahun" class="text-sm font-medium text-foreground">Tahun</label>
        <input type="text" name="tahun" id="tahun" value="{{ old('tahun', $item->tahun ?? date('Y')) }}" class="input-field" placeholder="Contoh: 2026" />
        @error('tahun') <p class="mt-1 text-xs text-destructive">{{ $message }}</p> @enderror
      </div>

      <div>
        <label for="kategori" class="text-sm font-medium text-foreground">Bidang / Kategori</label>
        @php $selectedKategori = old('kategori', $item->kategori ?? ''); @endphp
        <select name="kategori" id="kategori" class="input-field">
          <option value="" disabled {{ $selectedKategori === '' ? 'selected' : '' }}>Pilih kategori</option>
          @foreach ($kategoriOptions as $kategori)
            <option value="{{ $kategori }}" {{ $selectedKategori === $kategori ? 'selected' : '' }}>{{ $kategori }}</option>
          @endforeach
        </select>
        @error('kategori') <p class="mt-1 text-xs text-destructive">{{ $message }}</p> @enderror
      </div>

      <div>
        <label for="urutan" class="text-sm font-medium text-foreground">Urutan Tampil <span class="text-muted-foreground">(opsional)</span></label>
        <input type="number" name="urutan" id="urutan" value="{{ old('urutan', $item->urutan ?? $kelompokDefault) }}" class="input-field" />
        <p class="mt-1.5 text-xs text-muted-foreground">Kartu dengan angka lebih kecil tampil lebih dulu. Samakan nilainya untuk baris dalam kelompok yang sama.</p>
        @error('urutan') <p class="mt-1 text-xs text-destructive">{{ $message }}</p> @enderror
      </div>
    </div>

    <div class="mt-2 flex items-center justify-end gap-3 border-t border-border pt-5">
      <a href="{{ route('admin.prestasi-sekolah.index') }}" class="rounded-xl border border-border bg-card px-5 py-2.5 text-sm font-semibold text-foreground hover:bg-secondary">Batal</a>
      <button type="submit" class="inline-flex items-center gap-2 rounded-xl bg-navy-gradient px-6 py-2.5 text-sm font-semibold text-hero-foreground shadow-soft">
        <x-icon name="check" class="w-4 h-4" /> Simpan
      </button>
    </div>
  </form>
</div>

<script>
  (function () {
    var input = document.getElementById('foto');
    var img = document.getElementById('foto-preview');
    var empty = document.getElementById('foto-preview-empty');
    var remove = document.getElementById('hapus_foto');
    if (!input || !img || !empty) return;
    var original = img.getAttribute('src') || '';

    input.addEventListener('change', function () {
      var file = input.files && input.files[0];
      if (file) {
        img.src = URL.createObjectURL(file);
        img.classList.remove('hidden');
        empty.classList.add('hidden');
        empty.classList.remove('flex');
        if (remove) remove.checked = false;
      } else if (original) {
        img.src = original;
      } else {
        img.classList.add('hidden');
        empty.classList.remove('hidden');
        empty.classList.add('flex');
      }
    });

    if (remove) {
      remove.addEventListener('change', function () {
        if (remove.checked) {
          input.value = '';
          img.style.opacity = '0.25';
        } else {
          img.style.opacity = '';
        }
      });
    }
  })();
</script>

@endsection