
<?php $__env->startSection('title', 'Profil Sekolah'); ?>
<?php $__env->startSection('page-title', 'Kelola Profil Sekolah'); ?>

<?php $__env->startSection('content'); ?>

<p class="enter-item enter-d1 mb-6 text-sm text-muted-foreground"><?php echo e($groupMeta['desc']); ?></p>

<div class="enter-item enter-d2 rounded-2xl border border-border bg-card p-7 shadow-soft">
  <h3 class="font-display text-sm font-bold text-foreground">Identitas & Kontak Sekolah</h3>
  <form method="POST" action="<?php echo e(route('admin.konten.profil.update')); ?>" enctype="multipart/form-data" class="mt-5 grid gap-5 sm:grid-cols-2">
    <?php echo csrf_field(); ?>
    <?php echo method_field('PUT'); ?>

    <div class="sm:col-span-2">
      <h4 class="font-display text-sm font-bold text-foreground">Identitas Sekolah</h4>
    </div>

    <div>
      <label for="nama" class="text-sm font-medium text-foreground">Nama Lengkap Sekolah</label>
      <input type="text" name="nama" id="nama" value="<?php echo e(old('nama', $profil->nama ?? '')); ?>" class="input-field" />
      <?php $__errorArgs = ['nama'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="mt-1 text-xs text-destructive"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
    </div>
    <div>
      <label for="nama_singkat" class="text-sm font-medium text-foreground">Nama Singkat</label>
      <input type="text" name="nama_singkat" id="nama_singkat" value="<?php echo e(old('nama_singkat', $profil->nama_singkat ?? '')); ?>" class="input-field" />
      <?php $__errorArgs = ['nama_singkat'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="mt-1 text-xs text-destructive"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
    </div>
    <div>
      <label for="brand_atas" class="text-sm font-medium text-foreground">Brand Baris Atas (logo/navbar)</label>
      <input type="text" name="brand_atas" id="brand_atas" value="<?php echo e(old('brand_atas', $profil->brand_atas ?? '')); ?>" class="input-field" />
      <?php $__errorArgs = ['brand_atas'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="mt-1 text-xs text-destructive"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
    </div>
    <div>
      <label for="brand_bawah" class="text-sm font-medium text-foreground">Brand Baris Bawah (logo/navbar)</label>
      <input type="text" name="brand_bawah" id="brand_bawah" value="<?php echo e(old('brand_bawah', $profil->brand_bawah ?? '')); ?>" class="input-field" />
      <?php $__errorArgs = ['brand_bawah'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="mt-1 text-xs text-destructive"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
    </div>
    <div class="sm:col-span-2">
      <label for="tagline" class="text-sm font-medium text-foreground">Tagline</label>
      <textarea name="tagline" id="tagline" rows="2" class="input-field"><?php echo e(old('tagline', $profil->tagline ?? '')); ?></textarea>
      <?php $__errorArgs = ['tagline'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="mt-1 text-xs text-destructive"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
    </div>
    <div class="sm:col-span-2">
      <label for="sejarah" class="text-sm font-medium text-foreground">Sejarah Sekolah</label>
      <textarea name="sejarah" id="sejarah" rows="8" class="input-field"><?php echo e(old('sejarah', $profil->sejarah ?? '')); ?></textarea>
      <p class="mt-1 text-xs text-muted-foreground">Teks ini yang akan tampil di halaman Profil pada bagian &laquo;Sejarah Sekolah&raquo;. Tekan Enter untuk membuat paragraf baru.</p>
      <?php $__errorArgs = ['sejarah'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="mt-1 text-xs text-destructive"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
    </div>

    <div class="sm:col-span-2 mt-2">
      <h4 class="font-display text-sm font-bold text-foreground">Kata Pengantar Kepala Sekolah</h4>
      <p class="text-xs text-muted-foreground">Tampil di halaman Profil, di antara bagian &laquo;Sejarah Sekolah&raquo; dan &laquo;Visi &amp; Misi&raquo;.</p>
    </div>
    <div class="sm:col-span-2">
      <label for="kata_pengantar" class="text-sm font-medium text-foreground">Isi Kata Pengantar</label>
      <textarea name="kata_pengantar" id="kata_pengantar" rows="8" class="input-field"><?php echo e(old('kata_pengantar', $profil->kata_pengantar ?? '')); ?></textarea>
      <p class="mt-1 text-xs text-muted-foreground">Tekan Enter untuk membuat paragraf baru. Nama yang tampil sebagai penanda tanda tangan mengikuti field &laquo;Kepala Sekolah&raquo; di atas.</p>
      <?php $__errorArgs = ['kata_pengantar'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="mt-1 text-xs text-destructive"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
    </div>
    <div class="sm:col-span-2">
      <label for="gambar_kepala_sekolah" class="text-sm font-medium text-foreground">Foto Kepala Sekolah</label>
      <?php if($profil?->gambar_kepala_sekolah): ?>
        <img src="<?php echo e(\App\Support\Site::imageUrl($profil->gambar_kepala_sekolah)); ?>" alt="Foto kepala sekolah" class="mt-2 mb-2 h-28 w-28 rounded-xl object-cover" />
      <?php endif; ?>
      <input type="file" name="gambar_kepala_sekolah" id="gambar_kepala_sekolah" accept="image/*" class="input-field" />
      <p class="mt-1 text-xs text-muted-foreground">Kosongkan jika tidak ingin mengganti foto.</p>
      <?php $__errorArgs = ['gambar_kepala_sekolah'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="mt-1 text-xs text-destructive"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
    </div>

    <div class="sm:col-span-2 mt-2">
      <h4 class="font-display text-sm font-bold text-foreground">Kontak & Alamat</h4>
    </div>
    <div class="sm:col-span-2">
      <label for="alamat" class="text-sm font-medium text-foreground">Alamat</label>
      <textarea name="alamat" id="alamat" rows="2" class="input-field"><?php echo e(old('alamat', $profil->alamat ?? '')); ?></textarea>
      <?php $__errorArgs = ['alamat'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="mt-1 text-xs text-destructive"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
    </div>
    <div>
      <label for="telepon" class="text-sm font-medium text-foreground">Telepon</label>
      <input type="text" name="telepon" id="telepon" value="<?php echo e(old('telepon', $profil->telepon ?? '')); ?>" class="input-field" />
      <?php $__errorArgs = ['telepon'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="mt-1 text-xs text-destructive"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
    </div>
    <div>
      <label for="whatsapp" class="text-sm font-medium text-foreground">WhatsApp</label>
      <input type="text" name="whatsapp" id="whatsapp" value="<?php echo e(old('whatsapp', $profil->whatsapp ?? '')); ?>" class="input-field" />
      <?php $__errorArgs = ['whatsapp'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="mt-1 text-xs text-destructive"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
    </div>
    <div>
      <label for="email" class="text-sm font-medium text-foreground">Email</label>
      <input type="email" name="email" id="email" value="<?php echo e(old('email', $profil->email ?? '')); ?>" class="input-field" />
      <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="mt-1 text-xs text-destructive"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
    </div>
    <div>
      <label for="jam_operasional" class="text-sm font-medium text-foreground">Jam Operasional</label>
      <input type="text" name="jam_operasional" id="jam_operasional" value="<?php echo e(old('jam_operasional', $profil->jam_operasional ?? '')); ?>" class="input-field" />
      <?php $__errorArgs = ['jam_operasional'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="mt-1 text-xs text-destructive"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
    </div>
    <div>
      <label for="kepala_sekolah" class="text-sm font-medium text-foreground">Kepala Sekolah</label>
      <input type="text" name="kepala_sekolah" id="kepala_sekolah" value="<?php echo e(old('kepala_sekolah', $profil->kepala_sekolah ?? '')); ?>" class="input-field" />
      <?php $__errorArgs = ['kepala_sekolah'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="mt-1 text-xs text-destructive"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
    </div>

    <div class="sm:col-span-2 mt-2">
      <h4 class="font-display text-sm font-bold text-foreground">Gambar</h4>
    </div>
    <div>
      <label for="gambar_hero" class="text-sm font-medium text-foreground">Gambar Hero (Beranda)</label>
      <?php if($profil?->gambar_hero): ?>
        <img src="<?php echo e(\App\Support\Site::imageUrl($profil->gambar_hero)); ?>" alt="Gambar hero" class="mt-2 mb-2 h-28 w-full rounded-xl object-cover" />
      <?php endif; ?>
      <input type="file" name="gambar_hero" id="gambar_hero" accept="image/*" class="input-field" />
      <p class="mt-1 text-xs text-muted-foreground">Kosongkan jika tidak ingin mengganti gambar.</p>
      <?php $__errorArgs = ['gambar_hero'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="mt-1 text-xs text-destructive"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
    </div>
    <div>
      <label for="gambar_siswa" class="text-sm font-medium text-foreground">Gambar Siswa (Tentang Kami)</label>
      <?php if($profil?->gambar_siswa): ?>
        <img src="<?php echo e(\App\Support\Site::imageUrl($profil->gambar_siswa)); ?>" alt="Gambar siswa" class="mt-2 mb-2 h-28 w-full rounded-xl object-cover" />
      <?php endif; ?>
      <input type="file" name="gambar_siswa" id="gambar_siswa" accept="image/*" class="input-field" />
      <p class="mt-1 text-xs text-muted-foreground">Kosongkan jika tidak ingin mengganti gambar.</p>
      <?php $__errorArgs = ['gambar_siswa'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="mt-1 text-xs text-destructive"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
    </div>

    <div class="sm:col-span-2 mt-2">
      <h4 class="font-display text-sm font-bold text-foreground">Total Biaya PPDB per Gelombang</h4>
      <p class="text-xs text-muted-foreground">Rincian per jenis biaya diatur di halaman "Konten PPDB".</p>
    </div>
    <div>
      <label for="total_biaya_gelombang1" class="text-sm font-medium text-foreground">Total Gelombang 1 (Rp)</label>
      <input type="number" name="total_biaya_gelombang1" id="total_biaya_gelombang1" value="<?php echo e(old('total_biaya_gelombang1', $profil->total_biaya_gelombang1 ?? 0)); ?>" class="input-field" />
      <?php $__errorArgs = ['total_biaya_gelombang1'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="mt-1 text-xs text-destructive"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
    </div>
    <div>
      <label for="total_biaya_gelombang2" class="text-sm font-medium text-foreground">Total Gelombang 2 (Rp)</label>
      <input type="number" name="total_biaya_gelombang2" id="total_biaya_gelombang2" value="<?php echo e(old('total_biaya_gelombang2', $profil->total_biaya_gelombang2 ?? 0)); ?>" class="input-field" />
      <?php $__errorArgs = ['total_biaya_gelombang2'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="mt-1 text-xs text-destructive"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
    </div>
    <div>
      <label for="total_biaya_gelombang3" class="text-sm font-medium text-foreground">Total Gelombang 3 (Rp)</label>
      <input type="number" name="total_biaya_gelombang3" id="total_biaya_gelombang3" value="<?php echo e(old('total_biaya_gelombang3', $profil->total_biaya_gelombang3 ?? 0)); ?>" class="input-field" />
      <?php $__errorArgs = ['total_biaya_gelombang3'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="mt-1 text-xs text-destructive"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
    </div>

    <div class="sm:col-span-2 mt-2 flex items-center gap-3">
      <button type="submit" class="shine inline-flex items-center gap-2 rounded-full bg-navy-gradient px-6 py-3 text-sm font-semibold text-hero-foreground shadow-soft">
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
<?php endif; ?> Simpan Profil
      </button>
    </div>
  </form>
</div>

<div class="enter-item enter-d3 mt-10">
  <h3 class="mb-4 font-display text-sm font-bold text-foreground">Konten Pendukung Profil & Beranda</h3>
  <?php echo $__env->make('admin.konten._resource-panel', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\PunyaSaya\smk-infokom\resources\views/admin/konten/profil.blade.php ENDPATH**/ ?>