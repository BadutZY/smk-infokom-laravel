
<?php $__env->startSection('title', $item ? 'Edit Prestasi' : 'Tambah Prestasi'); ?>
<?php $__env->startSection('page-title', $item ? 'Edit Prestasi' : 'Tambah Prestasi'); ?>

<?php $__env->startSection('content'); ?>

<div class="enter-item enter-d1 mx-auto max-w-2xl rounded-2xl border border-border bg-card p-7 shadow-soft">
  <form method="POST" action="<?php echo e($item ? route('admin.prestasi-sekolah.update', $item) : route('admin.prestasi-sekolah.store')); ?>" enctype="multipart/form-data" class="grid gap-5">
    <?php echo csrf_field(); ?>
    <?php if($item): ?> <?php echo method_field('PUT'); ?> <?php endif; ?>

    <div class="rounded-2xl border border-border bg-secondary/30 p-4">
      <label for="kelompok" class="text-sm font-medium text-foreground">Nomor Kelompok</label>
      <input type="number" min="1" name="kelompok" id="kelompok" value="<?php echo e(old('kelompok', $item->kelompok ?? $kelompokDefault)); ?>" class="input-field" />
      <p class="mt-1.5 text-xs text-muted-foreground">Baris dengan nomor kelompok yang <strong>sama</strong> akan digabung menjadi satu kartu prestasi (untuk siswa/tim yang punya beberapa kejuaraan). Gunakan nomor kelompok siswa yang sudah ada untuk menambah prestasi lain ke kartu yang sama.</p>
      <?php $__errorArgs = ['kelompok'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="mt-1 text-xs text-destructive"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
    </div>

    <div>
      <label for="nama_siswa" class="text-sm font-medium text-foreground">Nama Siswa / Tim</label>
      <input type="text" name="nama_siswa" id="nama_siswa" value="<?php echo e(old('nama_siswa', $item->nama_siswa ?? '')); ?>" class="input-field" placeholder="Contoh: Amanda Tagrida Viona atau Tim Futsal" />
      <?php $__errorArgs = ['nama_siswa'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="mt-1 text-xs text-destructive"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
    </div>

    
    <div class="rounded-2xl border border-border bg-secondary/30 p-4">
      <label for="foto" class="text-sm font-medium text-foreground">Foto Siswa / Tim <span class="text-muted-foreground">(opsional)</span></label>

      <?php if(! ($fotoReady ?? true)): ?>
        <p class="mt-2 rounded-xl border border-gold/40 bg-gold/10 px-3 py-2 text-xs leading-relaxed text-foreground">
          Fitur foto belum aktif di database. Jalankan <code class="font-semibold">php artisan migrate</code> terlebih dahulu, lalu muat ulang halaman ini.
        </p>
      <?php else: ?>
        <div class="mt-3 flex flex-wrap items-start gap-4">
          <div class="relative shrink-0 overflow-hidden rounded-2xl border border-border bg-card" style="width:8.5rem; aspect-ratio:4/3;">
            <img id="foto-preview" src="<?php echo e($fotoSaatIni ?? ''); ?>" alt="Pratinjau foto" class="<?php echo e(($fotoSaatIni ?? null) ? '' : 'hidden'); ?>" style="position:absolute; inset:0; width:100%; height:100%; object-fit:cover; object-position:50% 22%;" />
            <span id="foto-preview-empty" class="<?php echo e(($fotoSaatIni ?? null) ? 'hidden' : 'flex'); ?> items-center justify-center text-muted-foreground" style="position:absolute; inset:0;">
              <?php if (isset($component)) { $__componentOriginalce262628e3a8d44dc38fd1f3965181bc = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalce262628e3a8d44dc38fd1f3965181bc = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.icon','data' => ['name' => 'image','class' => 'w-7 h-7']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'image','class' => 'w-7 h-7']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalce262628e3a8d44dc38fd1f3965181bc)): ?>
<?php $attributes = $__attributesOriginalce262628e3a8d44dc38fd1f3965181bc; ?>
<?php unset($__attributesOriginalce262628e3a8d44dc38fd1f3965181bc); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalce262628e3a8d44dc38fd1f3965181bc)): ?>
<?php $component = $__componentOriginalce262628e3a8d44dc38fd1f3965181bc; ?>
<?php unset($__componentOriginalce262628e3a8d44dc38fd1f3965181bc); ?>
<?php endif; ?>
            </span>
          </div>

          <div class="min-w-0 flex-1" style="min-width:12rem;">
            <input type="file" name="foto" id="foto" accept="image/jpeg,image/png,image/webp" class="input-field" />
            <p class="mt-1.5 text-xs leading-relaxed text-muted-foreground">JPG, PNG, atau WebP, maksimal 5 MB. Gunakan foto yang terang dengan wajah di bagian atas gambar (rasio 4:3 atau potret, lebar minimal 800 px) supaya tampil rapi di kartu.</p>
            <p class="mt-1 text-xs leading-relaxed text-muted-foreground">Satu foto dipakai oleh semua baris dengan <strong>nomor kelompok yang sama</strong>. Menambah prestasi ke kelompok yang sudah punya foto otomatis memakai foto itu.</p>

            <?php if($fotoSaatIni ?? null): ?>
              <label class="mt-3 inline-flex cursor-pointer items-center gap-2 text-sm text-muted-foreground">
                <input type="checkbox" name="hapus_foto" value="1" id="hapus_foto" <?php echo e(old('hapus_foto') ? 'checked' : ''); ?> />
                Hapus foto saat ini
              </label>
            <?php endif; ?>
          </div>
        </div>
      <?php endif; ?>

      <?php $__errorArgs = ['foto'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="mt-2 text-xs text-destructive"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
    </div>

    <div>
      <label for="nama_kejuaraan" class="text-sm font-medium text-foreground">Nama Kejuaraan &amp; Tingkat Lomba</label>
      <textarea name="nama_kejuaraan" id="nama_kejuaraan" rows="2" class="input-field" placeholder="Contoh: OLIMFEST 2025 Bidang Lomba: Olimpiade Biologi Tingkat SMA"><?php echo e(old('nama_kejuaraan', $item->nama_kejuaraan ?? '')); ?></textarea>
      <?php $__errorArgs = ['nama_kejuaraan'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="mt-1 text-xs text-destructive"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
    </div>

    <div class="grid gap-5 sm:grid-cols-2">
      <div>
        <label for="juara" class="text-sm font-medium text-foreground">Predikat Juara</label>
        <input type="text" name="juara" id="juara" value="<?php echo e(old('juara', $item->juara ?? '')); ?>" class="input-field" placeholder="Contoh: Juara 1 (Medali Emas) Nasional" />
        <?php $__errorArgs = ['juara'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="mt-1 text-xs text-destructive"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
      </div>

      <div>
        <label for="peringkat" class="text-sm font-medium text-foreground">Lencana Peringkat</label>
        <?php $selectedPeringkat = old('peringkat', $item->peringkat ?? 'emas'); ?>
        <select name="peringkat" id="peringkat" class="input-field">
          <?php $__currentLoopData = \App\Models\PrestasiSekolah::PERINGKAT; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <option value="<?php echo e($key); ?>" <?php echo e($selectedPeringkat === $key ? 'selected' : ''); ?>><?php echo e($label); ?></option>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
        <?php $__errorArgs = ['peringkat'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="mt-1 text-xs text-destructive"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
      </div>

      <div>
        <label for="tingkat" class="text-sm font-medium text-foreground">Tingkat / Wilayah <span class="text-muted-foreground">(opsional)</span></label>
        <input list="tingkat-options" type="text" name="tingkat" id="tingkat" value="<?php echo e(old('tingkat', $item->tingkat ?? '')); ?>" class="input-field" placeholder="Contoh: Kota Bogor, Nasional" />
        <datalist id="tingkat-options">
          <option value="Kota Bogor"></option>
          <option value="Provinsi Jawa Barat"></option>
          <option value="Nasional"></option>
          <option value="Internasional"></option>
        </datalist>
        <?php $__errorArgs = ['tingkat'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="mt-1 text-xs text-destructive"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
      </div>

      <div>
        <label for="tahun" class="text-sm font-medium text-foreground">Tahun</label>
        <input type="text" name="tahun" id="tahun" value="<?php echo e(old('tahun', $item->tahun ?? date('Y'))); ?>" class="input-field" placeholder="Contoh: 2026" />
        <?php $__errorArgs = ['tahun'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="mt-1 text-xs text-destructive"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
      </div>

      <div>
        <label for="kategori" class="text-sm font-medium text-foreground">Bidang / Kategori</label>
        <?php $selectedKategori = old('kategori', $item->kategori ?? ''); ?>
        <select name="kategori" id="kategori" class="input-field">
          <option value="" disabled <?php echo e($selectedKategori === '' ? 'selected' : ''); ?>>Pilih kategori</option>
          <?php $__currentLoopData = $kategoriOptions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $kategori): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <option value="<?php echo e($kategori); ?>" <?php echo e($selectedKategori === $kategori ? 'selected' : ''); ?>><?php echo e($kategori); ?></option>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
        <?php $__errorArgs = ['kategori'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="mt-1 text-xs text-destructive"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
      </div>

      <div>
        <label for="urutan" class="text-sm font-medium text-foreground">Urutan Tampil <span class="text-muted-foreground">(opsional)</span></label>
        <input type="number" name="urutan" id="urutan" value="<?php echo e(old('urutan', $item->urutan ?? $kelompokDefault)); ?>" class="input-field" />
        <p class="mt-1.5 text-xs text-muted-foreground">Kartu dengan angka lebih kecil tampil lebih dulu. Samakan nilainya untuk baris dalam kelompok yang sama.</p>
        <?php $__errorArgs = ['urutan'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="mt-1 text-xs text-destructive"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
      </div>
    </div>

    <div class="mt-2 flex items-center justify-end gap-3 border-t border-border pt-5">
      <a href="<?php echo e(route('admin.prestasi-sekolah.index')); ?>" class="rounded-xl border border-border bg-card px-5 py-2.5 text-sm font-semibold text-foreground hover:bg-secondary">Batal</a>
      <button type="submit" class="inline-flex items-center gap-2 rounded-xl bg-navy-gradient px-6 py-2.5 text-sm font-semibold text-hero-foreground shadow-soft">
        <?php if (isset($component)) { $__componentOriginalce262628e3a8d44dc38fd1f3965181bc = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalce262628e3a8d44dc38fd1f3965181bc = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.icon','data' => ['name' => 'check','class' => 'w-4 h-4']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'check','class' => 'w-4 h-4']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalce262628e3a8d44dc38fd1f3965181bc)): ?>
<?php $attributes = $__attributesOriginalce262628e3a8d44dc38fd1f3965181bc; ?>
<?php unset($__attributesOriginalce262628e3a8d44dc38fd1f3965181bc); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalce262628e3a8d44dc38fd1f3965181bc)): ?>
<?php $component = $__componentOriginalce262628e3a8d44dc38fd1f3965181bc; ?>
<?php unset($__componentOriginalce262628e3a8d44dc38fd1f3965181bc); ?>
<?php endif; ?> Simpan
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

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\rizki\Pictures\INFOKOM-REACT\Laravel\smk-infokom\resources\views/admin/prestasi-sekolah/form.blade.php ENDPATH**/ ?>