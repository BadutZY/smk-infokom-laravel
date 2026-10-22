@extends('layouts.app')
@section('title', 'PPDB')

@section('content')

<style>
  /* ===== Formulir PPDB (style khusus halaman ini) ===== */
  .ppdb-progress-track { height: 8px; border-radius: 9999px; background: var(--secondary); overflow: hidden; }
  .ppdb-progress-bar {
    height: 100%; width: 0%; border-radius: 9999px; background: var(--gradient-gold);
    transition: width .5s cubic-bezier(.22,1,.36,1);
  }

  .ppdb-section {
    position: relative; border-radius: 1.5rem; border: 1px solid var(--border); background: var(--card);
    padding: 1.5rem; transition: border-color .3s ease, box-shadow .3s ease;
  }
  .ppdb-section:focus-within { border-color: oklch(from var(--gold) l c h / .5); box-shadow: 0 0 0 4px oklch(from var(--gold) l c h / .1); }

  .ppdb-section-icon {
    display: flex; height: 2.75rem; width: 2.75rem; flex-shrink: 0; align-items: center; justify-content: center;
    border-radius: 0.9rem; background: var(--gradient-navy); color: var(--hero-foreground); box-shadow: var(--shadow-soft);
  }

  .ppdb-req { color: var(--gold); }

  /* Zona unggah dokumen (drag & drop) */
  .ppdb-dropzone {
    position: relative; display: flex; flex-direction: column; align-items: center; justify-content: center;
    gap: .5rem; border: 2px dashed var(--border); border-radius: 1.1rem; padding: 2rem 1.25rem; text-align: center;
    cursor: pointer; background: var(--background); transition: border-color .3s ease, background-color .3s ease, transform .3s ease;
  }
  .ppdb-dropzone:hover { border-color: oklch(from var(--gold) l c h / .6); }
  .ppdb-dropzone.is-dragover { border-color: var(--gold); background: oklch(from var(--gold) l c h / .08); transform: scale(1.01); }
  .ppdb-dropzone.has-file { border-style: solid; border-color: var(--gold); background: oklch(from var(--gold) l c h / .06); }
  .ppdb-dropzone input[type="file"] { position: absolute; inset: 0; z-index: 1; cursor: pointer; opacity: 0; }
  .ppdb-dropzone-icon {
    display: flex; height: 3rem; width: 3rem; align-items: center; justify-content: center; border-radius: 9999px;
    background: var(--accent); color: var(--primary); transition: transform .3s cubic-bezier(.22,1,.36,1);
  }
  .ppdb-dropzone:hover .ppdb-dropzone-icon { transform: translateY(-3px); }
  .ppdb-dropzone-file { display: none; align-items: center; justify-content: center; gap: .6rem; }
  .ppdb-dropzone-placeholder { display: flex; flex-direction: column; align-items: center; gap: .5rem; }
  .ppdb-dropzone.has-file .ppdb-dropzone-placeholder { display: none; }
  .ppdb-dropzone.has-file .ppdb-dropzone-file { display: flex; }
  .ppdb-dropzone-clear {
    position: relative; z-index: 2; display: flex; height: 1.75rem; width: 1.75rem; align-items: center; justify-content: center;
    border-radius: 9999px; background: var(--destructive); color: white; transition: transform .2s ease;
  }
  .ppdb-dropzone-clear:hover { transform: scale(1.1); }

  @media (prefers-reduced-motion: reduce) {
    .ppdb-progress-bar { transition: none; }
    .ppdb-dropzone, .ppdb-dropzone-icon, .ppdb-dropzone-clear { transition: none; }
  }
</style>

<x-page-hero kicker="Penerimaan Peserta Didik Baru" title="Pendaftaran PPDB {{ date('Y') }}/{{ date('Y') + 1 }}" desc="Wujudkan masa depan gemilang bersama SMK INFOKOM Kota Bogor." />

<section class="section-pad px-4 sm:px-6 lg:px-8">
  <div class="mx-auto max-w-6xl">

    {{-- ===================== STEPS ===================== --}}
    <x-section-title kicker="Alur Pendaftaran" title="5 Langkah Mudah Mendaftar" />
    <div class="stagger-group mt-10 grid gap-5 sm:grid-cols-2 lg:grid-cols-5">
      @foreach ($site['ppdb_steps'] as $step)
        <div class="stagger-item rounded-2xl border border-border bg-card p-6 text-center shadow-soft">
          <span class="mx-auto flex h-12 w-12 items-center justify-center rounded-full bg-navy-gradient font-display text-lg font-extrabold text-hero-foreground">{{ $step['step'] }}</span>
          <h3 class="mt-4 font-display text-sm font-bold text-foreground">{{ $step['title'] }}</h3>
          <p class="mt-2 text-xs text-muted-foreground">{{ $step['desc'] }}</p>
        </div>
      @endforeach
    </div>

    {{-- ===================== SYARAT & BIAYA ===================== --}}
    <div class="mt-16 grid gap-8 lg:grid-cols-2">
      <div class="reveal rounded-2xl border border-border bg-card p-7 shadow-soft">
        <h3 class="font-display text-lg font-bold text-foreground">Persyaratan Pendaftaran</h3>
        <ul class="mt-4 space-y-3">
          @foreach ($site['syarat_ppdb'] as $syarat)
            <li class="flex gap-2 text-sm text-muted-foreground"><x-icon name="check-circle" class="mt-0.5 w-4 h-4 shrink-0 text-gold" /> {{ $syarat }}</li>
          @endforeach
        </ul>
      </div>
      <div class="reveal rounded-2xl border border-border bg-card p-7 shadow-soft">
        <h3 class="font-display text-lg font-bold text-foreground">Jadwal PPDB</h3>
        <div class="mt-4 space-y-3">
          @foreach ($site['jadwal_ppdb'] as $jadwal)
            <div class="flex items-center gap-4 border-b border-border pb-3 text-sm last:border-0">
              <span class="w-28 shrink-0 font-semibold text-primary">{{ $jadwal['periode'] }}</span>
              <span class="text-muted-foreground">{{ $jadwal['agenda'] }}</span>
            </div>
          @endforeach
        </div>
      </div>
    </div>

    <div class="reveal mt-8 overflow-x-auto rounded-2xl border border-border bg-card p-7 shadow-soft">
      <h3 class="font-display text-lg font-bold text-foreground">Rincian Biaya Pendaftaran</h3>
      <table class="mt-4 w-full min-w-[560px] text-left text-sm">
        <thead>
          <tr class="border-b border-border text-xs uppercase tracking-wider text-muted-foreground">
            <th class="py-2 pr-4">Jenis Biaya</th>
            <th class="py-2 pr-4">Gelombang I</th>
            <th class="py-2 pr-4">Gelombang II</th>
            <th class="py-2">Gelombang III</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($site['biaya_ppdb'] as $biaya)
            <tr class="border-b border-border last:border-0">
              <td class="py-2.5 pr-4 text-foreground">{{ $biaya['jenis'] }}</td>
              <td class="py-2.5 pr-4 text-muted-foreground">{{ \App\Support\Site::rupiah($biaya['gelombang1']) }}</td>
              <td class="py-2.5 pr-4 text-muted-foreground">{{ \App\Support\Site::rupiah($biaya['gelombang2']) }}</td>
              <td class="py-2.5 text-muted-foreground">{{ \App\Support\Site::rupiah($biaya['gelombang3']) }}</td>
            </tr>
          @endforeach
          <tr class="font-bold text-foreground">
            <td class="py-3 pr-4">Total</td>
            <td class="py-3 pr-4 text-gold">{{ \App\Support\Site::rupiah($site['total_biaya_ppdb']['gelombang1']) }}</td>
            <td class="py-3 pr-4 text-gold">{{ \App\Support\Site::rupiah($site['total_biaya_ppdb']['gelombang2']) }}</td>
            <td class="py-3 text-gold">{{ \App\Support\Site::rupiah($site['total_biaya_ppdb']['gelombang3']) }}</td>
          </tr>
        </tbody>
      </table>
    </div>

    {{-- ===================== FORM ===================== --}}
    <div id="form-pendaftaran" class="mt-16">
      <x-section-title kicker="Formulir" title="Daftar Sekarang" desc="Lengkapi seluruh data di bawah ini dengan benar. Data yang Anda kirim akan langsung tercatat di sistem sekolah." />

      <div class="reveal-scale mx-auto mt-10 max-w-3xl overflow-hidden rounded-3xl border border-border bg-card shadow-lift">

        @if (session('ppdb_success'))
          <div class="reveal-scale is-visible m-6 rounded-2xl bg-accent p-6 text-center sm:m-8">
            <span class="mx-auto flex h-14 w-14 items-center justify-center rounded-full bg-primary text-primary-foreground shadow-soft"><x-icon name="check" class="w-7 h-7" /></span>
            <p class="mt-3 font-display text-lg font-bold text-foreground">Pendaftaran Berhasil!</p>
            <p class="mt-1 text-sm text-muted-foreground">Nomor pendaftaran Anda:</p>
            <p class="mt-1 font-display text-2xl font-extrabold text-primary">{{ session('nomor_pendaftaran') }}</p>
            <p class="mt-2 text-xs text-muted-foreground">Simpan nomor ini sebagai bukti pendaftaran Anda.</p>
          </div>
        @endif

        {{-- Indikator kelengkapan formulir, diperbarui otomatis lewat JS di bawah. --}}
        <div class="border-b border-border bg-secondary/40 px-6 py-4 sm:px-10">
          <div class="flex items-center justify-between text-xs font-semibold text-muted-foreground">
            <span>Kelengkapan Formulir</span>
            <span data-ppdb-progress-label class="text-primary">0%</span>
          </div>
          <div class="ppdb-progress-track mt-2">
            <div data-ppdb-progress-bar class="ppdb-progress-bar"></div>
          </div>
        </div>

        <form method="POST" action="{{ route('ppdb.store') }}" enctype="multipart/form-data" class="grid gap-6 p-6 sm:p-10" data-ppdb-form>
          @csrf

          {{-- ===== Data Diri Siswa ===== --}}
          <div class="ppdb-section">
            <div class="flex items-center gap-3">
              <span class="ppdb-section-icon"><x-icon name="user" class="w-5 h-5" /></span>
              <div>
                <h3 class="font-display text-sm font-bold text-foreground">Data Diri Siswa</h3>
                <p class="text-xs text-muted-foreground">Isi sesuai identitas resmi (ijazah/akta/KTP).</p>
              </div>
            </div>

            <div class="mt-5 grid gap-5">
              <div>
                <label for="nama" class="text-sm font-medium text-foreground">Nama Lengkap <span class="ppdb-req">*</span></label>
                <input type="text" name="nama" id="nama" value="{{ old('nama') }}" required class="input-field" placeholder="Nama sesuai ijazah" />
                @error('nama') <p class="mt-1 text-xs text-destructive">{{ $message }}</p> @enderror
              </div>

              <div class="grid gap-5 sm:grid-cols-2">
                <div>
                  <label for="nisn" class="text-sm font-medium text-foreground">NISN <span class="ppdb-req">*</span></label>
                  <input type="text" inputmode="numeric" name="nisn" id="nisn" value="{{ old('nisn') }}" maxlength="10" required class="input-field" placeholder="10 digit NISN" />
                  @error('nisn') <p class="mt-1 text-xs text-destructive">{{ $message }}</p> @enderror
                </div>
                <div>
                  <label for="jenis_kelamin" class="text-sm font-medium text-foreground">Jenis Kelamin <span class="ppdb-req">*</span></label>
                  <select name="jenis_kelamin" id="jenis_kelamin" required class="input-field">
                    <option value="">Pilih</option>
                    <option value="Laki-laki" @selected(old('jenis_kelamin') === 'Laki-laki')>Laki-laki</option>
                    <option value="Perempuan" @selected(old('jenis_kelamin') === 'Perempuan')>Perempuan</option>
                  </select>
                  @error('jenis_kelamin') <p class="mt-1 text-xs text-destructive">{{ $message }}</p> @enderror
                </div>
              </div>

              <div class="grid gap-5 sm:grid-cols-2">
                <div>
                  <label for="tempat_lahir" class="text-sm font-medium text-foreground">Tempat Lahir <span class="ppdb-req">*</span></label>
                  <input type="text" name="tempat_lahir" id="tempat_lahir" value="{{ old('tempat_lahir') }}" required class="input-field" placeholder="Kota/kabupaten kelahiran" />
                  @error('tempat_lahir') <p class="mt-1 text-xs text-destructive">{{ $message }}</p> @enderror
                </div>
                <div>
                  <label for="tanggal_lahir" class="text-sm font-medium text-foreground">Tanggal Lahir <span class="ppdb-req">*</span></label>
                  <input type="date" name="tanggal_lahir" id="tanggal_lahir" value="{{ old('tanggal_lahir') }}" required class="input-field" />
                  @error('tanggal_lahir') <p class="mt-1 text-xs text-destructive">{{ $message }}</p> @enderror
                </div>
              </div>

              <div class="grid gap-5 sm:grid-cols-2">
                <div>
                  <label for="agama" class="text-sm font-medium text-foreground">Agama <span class="ppdb-req">*</span></label>
                  <select name="agama" id="agama" required class="input-field">
                    <option value="">Pilih Agama</option>
                    @foreach ($agamaList as $agama)
                      <option value="{{ $agama }}" @selected(old('agama') === $agama)>{{ $agama }}</option>
                    @endforeach
                  </select>
                  @error('agama') <p class="mt-1 text-xs text-destructive">{{ $message }}</p> @enderror
                </div>
                <div>
                  <label for="asal_sekolah" class="text-sm font-medium text-foreground">Asal Sekolah <span class="ppdb-req">*</span></label>
                  <input type="text" name="asal_sekolah" id="asal_sekolah" value="{{ old('asal_sekolah') }}" required class="input-field" placeholder="Nama SMP/MTs asal" />
                  @error('asal_sekolah') <p class="mt-1 text-xs text-destructive">{{ $message }}</p> @enderror
                </div>
              </div>
            </div>
          </div>

          {{-- ===== Data Orang Tua/Wali ===== --}}
          <div class="ppdb-section">
            <div class="flex items-center gap-3">
              <span class="ppdb-section-icon"><x-icon name="users" class="w-5 h-5" /></span>
              <div>
                <h3 class="font-display text-sm font-bold text-foreground">Data Orang Tua/Wali</h3>
                <p class="text-xs text-muted-foreground">Untuk keperluan komunikasi & administrasi sekolah.</p>
              </div>
            </div>

            <div class="mt-5 grid gap-5">
              <div>
                <label for="nama_orang_tua" class="text-sm font-medium text-foreground">Nama Orang Tua/Wali <span class="ppdb-req">*</span></label>
                <input type="text" name="nama_orang_tua" id="nama_orang_tua" value="{{ old('nama_orang_tua') }}" required class="input-field" placeholder="Nama lengkap orang tua/wali" />
                @error('nama_orang_tua') <p class="mt-1 text-xs text-destructive">{{ $message }}</p> @enderror
              </div>
              <div class="grid gap-5 sm:grid-cols-2">
                <div>
                  <label for="telepon_orang_tua" class="text-sm font-medium text-foreground">No. Telepon Orang Tua/Wali <span class="ppdb-req">*</span></label>
                  <input type="text" inputmode="numeric" name="telepon_orang_tua" id="telepon_orang_tua" value="{{ old('telepon_orang_tua') }}" required class="input-field" placeholder="08xxxxxxxxxx" />
                  @error('telepon_orang_tua') <p class="mt-1 text-xs text-destructive">{{ $message }}</p> @enderror
                </div>
                <div>
                  <label for="pekerjaan_orang_tua" class="text-sm font-medium text-foreground">Pekerjaan Orang Tua/Wali</label>
                  <input type="text" name="pekerjaan_orang_tua" id="pekerjaan_orang_tua" value="{{ old('pekerjaan_orang_tua') }}" class="input-field" placeholder="Opsional" />
                  @error('pekerjaan_orang_tua') <p class="mt-1 text-xs text-destructive">{{ $message }}</p> @enderror
                </div>
              </div>
            </div>
          </div>

          {{-- ===== Kontak & Alamat ===== --}}
          <div class="ppdb-section">
            <div class="flex items-center gap-3">
              <span class="ppdb-section-icon"><x-icon name="phone" class="w-5 h-5" /></span>
              <div>
                <h3 class="font-display text-sm font-bold text-foreground">Kontak &amp; Alamat</h3>
                <p class="text-xs text-muted-foreground">Info pendaftaran akan dikirim ke kontak ini.</p>
              </div>
            </div>

            <div class="mt-5 grid gap-5">
              <div class="grid gap-5 sm:grid-cols-2">
                <div>
                  <label for="email" class="text-sm font-medium text-foreground">Email <span class="ppdb-req">*</span></label>
                  <input type="email" name="email" id="email" value="{{ old('email') }}" required class="input-field" placeholder="nama@email.com" />
                  @error('email') <p class="mt-1 text-xs text-destructive">{{ $message }}</p> @enderror
                </div>
                <div>
                  <label for="telepon" class="text-sm font-medium text-foreground">Nomor Telepon Siswa <span class="ppdb-req">*</span></label>
                  <input type="text" inputmode="numeric" name="telepon" id="telepon" value="{{ old('telepon') }}" required class="input-field" placeholder="08xxxxxxxxxx" />
                  @error('telepon') <p class="mt-1 text-xs text-destructive">{{ $message }}</p> @enderror
                </div>
              </div>
              <div>
                <label for="alamat" class="text-sm font-medium text-foreground">Alamat Lengkap <span class="ppdb-req">*</span></label>
                <textarea name="alamat" id="alamat" rows="3" required class="input-field" placeholder="Alamat sesuai KTP/KK">{{ old('alamat') }}</textarea>
                @error('alamat') <p class="mt-1 text-xs text-destructive">{{ $message }}</p> @enderror
              </div>
            </div>
          </div>

          {{-- ===== Pilihan Jurusan ===== --}}
          <div class="ppdb-section">
            <div class="flex items-center gap-3">
              <span class="ppdb-section-icon"><x-icon name="graduation-cap" class="w-5 h-5" /></span>
              <div>
                <h3 class="font-display text-sm font-bold text-foreground">Pilihan Jurusan</h3>
                <p class="text-xs text-muted-foreground">Tentukan 2 pilihan jurusan yang berbeda.</p>
              </div>
            </div>

            <div class="mt-5 grid gap-5 sm:grid-cols-2">
              <div>
                <label for="pilihan1" class="text-sm font-medium text-foreground">Pilihan Jurusan 1 <span class="ppdb-req">*</span></label>
                <select name="pilihan1" id="pilihan1" required class="input-field">
                  <option value="">Pilih Jurusan</option>
                  @foreach ($site['majors'] as $major)
                    <option value="{{ $major['code'] }}" @selected(old('pilihan1') === $major['code'])>{{ $major['code'] }} - {{ $major['name'] }}</option>
                  @endforeach
                </select>
                @error('pilihan1') <p class="mt-1 text-xs text-destructive">{{ $message }}</p> @enderror
              </div>
              <div>
                <label for="pilihan2" class="text-sm font-medium text-foreground">Pilihan Jurusan 2 <span class="ppdb-req">*</span></label>
                <select name="pilihan2" id="pilihan2" required class="input-field">
                  <option value="">Pilih Jurusan</option>
                  @foreach ($site['majors'] as $major)
                    <option value="{{ $major['code'] }}" @selected(old('pilihan2') === $major['code'])>{{ $major['code'] }} - {{ $major['name'] }}</option>
                  @endforeach
                </select>
                @error('pilihan2') <p class="mt-1 text-xs text-destructive">{{ $message }}</p> @enderror
              </div>
            </div>
          </div>

          {{-- ===== Dokumen Pendukung ===== --}}
          <div class="ppdb-section">
            <div class="flex items-center gap-3">
              <span class="ppdb-section-icon"><x-icon name="upload" class="w-5 h-5" /></span>
              <div>
                <h3 class="font-display text-sm font-bold text-foreground">Dokumen Pendukung</h3>
                <p class="text-xs text-muted-foreground">Kartu Keluarga/Akta/Ijazah/SKL &mdash; opsional, bisa disusulkan.</p>
              </div>
            </div>

            <label class="ppdb-dropzone mt-5" data-ppdb-dropzone>
              <input type="file" name="dokumen" id="dokumen" accept=".pdf,.jpg,.jpeg,.png" data-ppdb-file-input />
              <span class="ppdb-dropzone-placeholder">
                <span class="ppdb-dropzone-icon"><x-icon name="upload" class="w-5 h-5" /></span>
                <span class="text-sm font-semibold text-foreground">Klik atau seret berkas ke sini</span>
                <span class="text-xs text-muted-foreground">PDF, JPG, atau PNG &middot; maksimal 5 MB</span>
              </span>
              <span class="ppdb-dropzone-file">
                <span class="flex h-9 w-9 shrink-0 items-center justify-center rounded-lg bg-accent text-primary"><x-icon name="file-text" class="w-4 h-4" /></span>
                <span class="text-left text-sm font-semibold text-foreground" data-ppdb-file-name>-</span>
                <button type="button" class="ppdb-dropzone-clear" data-ppdb-file-clear title="Hapus berkas" aria-label="Hapus berkas">
                  <x-icon name="x" class="w-3.5 h-3.5" />
                </button>
              </span>
            </label>
            @error('dokumen') <p class="mt-2 text-xs text-destructive">{{ $message }}</p> @enderror
          </div>

          <button type="submit" class="shine mt-2 inline-flex items-center justify-center gap-2 rounded-full bg-navy-gradient px-6 py-3.5 text-sm font-semibold text-hero-foreground shadow-lift transition-transform hover:-translate-y-0.5">
            Kirim Pendaftaran <x-icon name="arrow-right" class="w-4 h-4" />
          </button>
        </form>
      </div>
    </div>
  </div>
</section>

<script>
  // Progress kelengkapan formulir + zona unggah dokumen (drag & drop) pada halaman PPDB.
  (function () {
    var form = document.querySelector('[data-ppdb-form]');
    if (!form) return;

    var bar = form.querySelector('[data-ppdb-progress-bar]');
    var label = document.querySelector('[data-ppdb-progress-label]');
    var requiredFields = Array.prototype.slice.call(form.querySelectorAll('[required]'));

    function updateProgress() {
      var filled = requiredFields.filter(function (el) {
        return el.value && el.value.trim() !== '';
      }).length;
      var pct = requiredFields.length ? Math.round((filled / requiredFields.length) * 100) : 0;
      if (bar) bar.style.width = pct + '%';
      if (label) label.textContent = pct + '%';
    }
    requiredFields.forEach(function (el) {
      el.addEventListener('input', updateProgress);
      el.addEventListener('change', updateProgress);
    });
    updateProgress();

    var dropzone = form.querySelector('[data-ppdb-dropzone]');
    var fileInput = form.querySelector('[data-ppdb-file-input]');
    var fileNameEl = form.querySelector('[data-ppdb-file-name]');
    var fileClearBtn = form.querySelector('[data-ppdb-file-clear]');

    function showFile(file) {
      if (!dropzone) return;
      if (!file) {
        dropzone.classList.remove('has-file');
        if (fileNameEl) fileNameEl.textContent = '-';
        return;
      }
      dropzone.classList.add('has-file');
      if (fileNameEl) fileNameEl.textContent = file.name + ' (' + (file.size / 1024 / 1024).toFixed(2) + ' MB)';
    }

    if (fileInput) {
      fileInput.addEventListener('change', function () {
        showFile(fileInput.files && fileInput.files[0]);
      });
    }

    if (dropzone) {
      ['dragover', 'dragenter'].forEach(function (evt) {
        dropzone.addEventListener(evt, function (e) {
          e.preventDefault();
          dropzone.classList.add('is-dragover');
        });
      });
      ['dragleave', 'drop'].forEach(function (evt) {
        dropzone.addEventListener(evt, function (e) {
          e.preventDefault();
          dropzone.classList.remove('is-dragover');
        });
      });
      dropzone.addEventListener('drop', function (e) {
        var file = e.dataTransfer && e.dataTransfer.files && e.dataTransfer.files[0];
        if (file && fileInput) {
          fileInput.files = e.dataTransfer.files;
          showFile(file);
        }
      });
    }

    if (fileClearBtn) {
      fileClearBtn.addEventListener('click', function (e) {
        e.preventDefault();
        e.stopPropagation();
        if (fileInput) fileInput.value = '';
        showFile(null);
      });
    }
  })();
</script>

@endsection