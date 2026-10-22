<?php $__env->startSection('title', 'PPDB'); ?>

<?php $__env->startSection('content'); ?>

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

<?php if (isset($component)) { $__componentOriginala9d931d4f11b4d2850df99e991db1dca = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginala9d931d4f11b4d2850df99e991db1dca = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.page-hero','data' => ['kicker' => 'Penerimaan Peserta Didik Baru','title' => 'Pendaftaran PPDB '.e(date('Y')).'/'.e(date('Y') + 1).'','desc' => 'Wujudkan masa depan gemilang bersama SMK INFOKOM Kota Bogor.']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('page-hero'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['kicker' => 'Penerimaan Peserta Didik Baru','title' => 'Pendaftaran PPDB '.e(date('Y')).'/'.e(date('Y') + 1).'','desc' => 'Wujudkan masa depan gemilang bersama SMK INFOKOM Kota Bogor.']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginala9d931d4f11b4d2850df99e991db1dca)): ?>
<?php $attributes = $__attributesOriginala9d931d4f11b4d2850df99e991db1dca; ?>
<?php unset($__attributesOriginala9d931d4f11b4d2850df99e991db1dca); ?>
<?php endif; ?>
<?php if (isset($__componentOriginala9d931d4f11b4d2850df99e991db1dca)): ?>
<?php $component = $__componentOriginala9d931d4f11b4d2850df99e991db1dca; ?>
<?php unset($__componentOriginala9d931d4f11b4d2850df99e991db1dca); ?>
<?php endif; ?>

<section class="section-pad px-4 sm:px-6 lg:px-8">
  <div class="mx-auto max-w-6xl">

    
    <?php if (isset($component)) { $__componentOriginal6a0a1523cc2edf33c83fe20a5d1f7f78 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal6a0a1523cc2edf33c83fe20a5d1f7f78 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.section-title','data' => ['kicker' => 'Alur Pendaftaran','title' => '5 Langkah Mudah Mendaftar']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('section-title'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['kicker' => 'Alur Pendaftaran','title' => '5 Langkah Mudah Mendaftar']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal6a0a1523cc2edf33c83fe20a5d1f7f78)): ?>
<?php $attributes = $__attributesOriginal6a0a1523cc2edf33c83fe20a5d1f7f78; ?>
<?php unset($__attributesOriginal6a0a1523cc2edf33c83fe20a5d1f7f78); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal6a0a1523cc2edf33c83fe20a5d1f7f78)): ?>
<?php $component = $__componentOriginal6a0a1523cc2edf33c83fe20a5d1f7f78; ?>
<?php unset($__componentOriginal6a0a1523cc2edf33c83fe20a5d1f7f78); ?>
<?php endif; ?>
    <div class="stagger-group mt-10 grid gap-5 sm:grid-cols-2 lg:grid-cols-5">
      <?php $__currentLoopData = $site['ppdb_steps']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $step): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="stagger-item rounded-2xl border border-border bg-card p-6 text-center shadow-soft">
          <span class="mx-auto flex h-12 w-12 items-center justify-center rounded-full bg-navy-gradient font-display text-lg font-extrabold text-hero-foreground"><?php echo e($step['step']); ?></span>
          <h3 class="mt-4 font-display text-sm font-bold text-foreground"><?php echo e($step['title']); ?></h3>
          <p class="mt-2 text-xs text-muted-foreground"><?php echo e($step['desc']); ?></p>
        </div>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>

    
    <div class="mt-16 grid gap-8 lg:grid-cols-2">
      <div class="reveal rounded-2xl border border-border bg-card p-7 shadow-soft">
        <h3 class="font-display text-lg font-bold text-foreground">Persyaratan Pendaftaran</h3>
        <ul class="mt-4 space-y-3">
          <?php $__currentLoopData = $site['syarat_ppdb']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $syarat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <li class="flex gap-2 text-sm text-muted-foreground"><?php if (isset($component)) { $__componentOriginalce262628e3a8d44dc38fd1f3965181bc = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalce262628e3a8d44dc38fd1f3965181bc = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.icon','data' => ['name' => 'check-circle','class' => 'mt-0.5 w-4 h-4 shrink-0 text-gold']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'check-circle','class' => 'mt-0.5 w-4 h-4 shrink-0 text-gold']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalce262628e3a8d44dc38fd1f3965181bc)): ?>
<?php $attributes = $__attributesOriginalce262628e3a8d44dc38fd1f3965181bc; ?>
<?php unset($__attributesOriginalce262628e3a8d44dc38fd1f3965181bc); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalce262628e3a8d44dc38fd1f3965181bc)): ?>
<?php $component = $__componentOriginalce262628e3a8d44dc38fd1f3965181bc; ?>
<?php unset($__componentOriginalce262628e3a8d44dc38fd1f3965181bc); ?>
<?php endif; ?> <?php echo e($syarat); ?></li>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>
      </div>
      <div class="reveal rounded-2xl border border-border bg-card p-7 shadow-soft">
        <h3 class="font-display text-lg font-bold text-foreground">Jadwal PPDB</h3>
        <div class="mt-4 space-y-3">
          <?php $__currentLoopData = $site['jadwal_ppdb']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $jadwal): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="flex items-center gap-4 border-b border-border pb-3 text-sm last:border-0">
              <span class="w-28 shrink-0 font-semibold text-primary"><?php echo e($jadwal['periode']); ?></span>
              <span class="text-muted-foreground"><?php echo e($jadwal['agenda']); ?></span>
            </div>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
          <?php $__currentLoopData = $site['biaya_ppdb']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $biaya): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr class="border-b border-border last:border-0">
              <td class="py-2.5 pr-4 text-foreground"><?php echo e($biaya['jenis']); ?></td>
              <td class="py-2.5 pr-4 text-muted-foreground"><?php echo e(\App\Support\Site::rupiah($biaya['gelombang1'])); ?></td>
              <td class="py-2.5 pr-4 text-muted-foreground"><?php echo e(\App\Support\Site::rupiah($biaya['gelombang2'])); ?></td>
              <td class="py-2.5 text-muted-foreground"><?php echo e(\App\Support\Site::rupiah($biaya['gelombang3'])); ?></td>
            </tr>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          <tr class="font-bold text-foreground">
            <td class="py-3 pr-4">Total</td>
            <td class="py-3 pr-4 text-gold"><?php echo e(\App\Support\Site::rupiah($site['total_biaya_ppdb']['gelombang1'])); ?></td>
            <td class="py-3 pr-4 text-gold"><?php echo e(\App\Support\Site::rupiah($site['total_biaya_ppdb']['gelombang2'])); ?></td>
            <td class="py-3 text-gold"><?php echo e(\App\Support\Site::rupiah($site['total_biaya_ppdb']['gelombang3'])); ?></td>
          </tr>
        </tbody>
      </table>
    </div>

    
    <div id="form-pendaftaran" class="mt-16">
      <?php if (isset($component)) { $__componentOriginal6a0a1523cc2edf33c83fe20a5d1f7f78 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal6a0a1523cc2edf33c83fe20a5d1f7f78 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.section-title','data' => ['kicker' => 'Formulir','title' => 'Daftar Sekarang','desc' => 'Lengkapi seluruh data di bawah ini dengan benar. Data yang Anda kirim akan langsung tercatat di sistem sekolah.']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('section-title'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['kicker' => 'Formulir','title' => 'Daftar Sekarang','desc' => 'Lengkapi seluruh data di bawah ini dengan benar. Data yang Anda kirim akan langsung tercatat di sistem sekolah.']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal6a0a1523cc2edf33c83fe20a5d1f7f78)): ?>
<?php $attributes = $__attributesOriginal6a0a1523cc2edf33c83fe20a5d1f7f78; ?>
<?php unset($__attributesOriginal6a0a1523cc2edf33c83fe20a5d1f7f78); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal6a0a1523cc2edf33c83fe20a5d1f7f78)): ?>
<?php $component = $__componentOriginal6a0a1523cc2edf33c83fe20a5d1f7f78; ?>
<?php unset($__componentOriginal6a0a1523cc2edf33c83fe20a5d1f7f78); ?>
<?php endif; ?>

      <div class="reveal-scale mx-auto mt-10 max-w-3xl overflow-hidden rounded-3xl border border-border bg-card shadow-lift">

        <?php if(session('ppdb_success')): ?>
          <div class="reveal-scale is-visible m-6 rounded-2xl bg-accent p-6 text-center sm:m-8">
            <span class="mx-auto flex h-14 w-14 items-center justify-center rounded-full bg-primary text-primary-foreground shadow-soft"><?php if (isset($component)) { $__componentOriginalce262628e3a8d44dc38fd1f3965181bc = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalce262628e3a8d44dc38fd1f3965181bc = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.icon','data' => ['name' => 'check','class' => 'w-7 h-7']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'check','class' => 'w-7 h-7']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalce262628e3a8d44dc38fd1f3965181bc)): ?>
<?php $attributes = $__attributesOriginalce262628e3a8d44dc38fd1f3965181bc; ?>
<?php unset($__attributesOriginalce262628e3a8d44dc38fd1f3965181bc); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalce262628e3a8d44dc38fd1f3965181bc)): ?>
<?php $component = $__componentOriginalce262628e3a8d44dc38fd1f3965181bc; ?>
<?php unset($__componentOriginalce262628e3a8d44dc38fd1f3965181bc); ?>
<?php endif; ?></span>
            <p class="mt-3 font-display text-lg font-bold text-foreground">Pendaftaran Berhasil!</p>
            <p class="mt-1 text-sm text-muted-foreground">Nomor pendaftaran Anda:</p>
            <p class="mt-1 font-display text-2xl font-extrabold text-primary"><?php echo e(session('nomor_pendaftaran')); ?></p>
            <p class="mt-2 text-xs text-muted-foreground">Simpan nomor ini sebagai bukti pendaftaran Anda.</p>
          </div>
        <?php endif; ?>

        
        <div class="border-b border-border bg-secondary/40 px-6 py-4 sm:px-10">
          <div class="flex items-center justify-between text-xs font-semibold text-muted-foreground">
            <span>Kelengkapan Formulir</span>
            <span data-ppdb-progress-label class="text-primary">0%</span>
          </div>
          <div class="ppdb-progress-track mt-2">
            <div data-ppdb-progress-bar class="ppdb-progress-bar"></div>
          </div>
        </div>

        <form method="POST" action="<?php echo e(route('ppdb.store')); ?>" enctype="multipart/form-data" class="grid gap-6 p-6 sm:p-10" data-ppdb-form>
          <?php echo csrf_field(); ?>

          
          <div class="ppdb-section">
            <div class="flex items-center gap-3">
              <span class="ppdb-section-icon"><?php if (isset($component)) { $__componentOriginalce262628e3a8d44dc38fd1f3965181bc = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalce262628e3a8d44dc38fd1f3965181bc = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.icon','data' => ['name' => 'user','class' => 'w-5 h-5']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'user','class' => 'w-5 h-5']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalce262628e3a8d44dc38fd1f3965181bc)): ?>
<?php $attributes = $__attributesOriginalce262628e3a8d44dc38fd1f3965181bc; ?>
<?php unset($__attributesOriginalce262628e3a8d44dc38fd1f3965181bc); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalce262628e3a8d44dc38fd1f3965181bc)): ?>
<?php $component = $__componentOriginalce262628e3a8d44dc38fd1f3965181bc; ?>
<?php unset($__componentOriginalce262628e3a8d44dc38fd1f3965181bc); ?>
<?php endif; ?></span>
              <div>
                <h3 class="font-display text-sm font-bold text-foreground">Data Diri Siswa</h3>
                <p class="text-xs text-muted-foreground">Isi sesuai identitas resmi (ijazah/akta/KTP).</p>
              </div>
            </div>

            <div class="mt-5 grid gap-5">
              <div>
                <label for="nama" class="text-sm font-medium text-foreground">Nama Lengkap <span class="ppdb-req">*</span></label>
                <input type="text" name="nama" id="nama" value="<?php echo e(old('nama')); ?>" required class="input-field" placeholder="Nama sesuai ijazah" />
                <?php $__errorArgs = ['nama'];
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
                  <label for="nisn" class="text-sm font-medium text-foreground">NISN <span class="ppdb-req">*</span></label>
                  <input type="text" inputmode="numeric" name="nisn" id="nisn" value="<?php echo e(old('nisn')); ?>" maxlength="10" required class="input-field" placeholder="10 digit NISN" />
                  <?php $__errorArgs = ['nisn'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="mt-1 text-xs text-destructive"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
                <div>
                  <label for="jenis_kelamin" class="text-sm font-medium text-foreground">Jenis Kelamin <span class="ppdb-req">*</span></label>
                  <select name="jenis_kelamin" id="jenis_kelamin" required class="input-field">
                    <option value="">Pilih</option>
                    <option value="Laki-laki" <?php if(old('jenis_kelamin') === 'Laki-laki'): echo 'selected'; endif; ?>>Laki-laki</option>
                    <option value="Perempuan" <?php if(old('jenis_kelamin') === 'Perempuan'): echo 'selected'; endif; ?>>Perempuan</option>
                  </select>
                  <?php $__errorArgs = ['jenis_kelamin'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="mt-1 text-xs text-destructive"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
              </div>

              <div class="grid gap-5 sm:grid-cols-2">
                <div>
                  <label for="tempat_lahir" class="text-sm font-medium text-foreground">Tempat Lahir <span class="ppdb-req">*</span></label>
                  <input type="text" name="tempat_lahir" id="tempat_lahir" value="<?php echo e(old('tempat_lahir')); ?>" required class="input-field" placeholder="Kota/kabupaten kelahiran" />
                  <?php $__errorArgs = ['tempat_lahir'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="mt-1 text-xs text-destructive"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
                <div>
                  <label for="tanggal_lahir" class="text-sm font-medium text-foreground">Tanggal Lahir <span class="ppdb-req">*</span></label>
                  <input type="date" name="tanggal_lahir" id="tanggal_lahir" value="<?php echo e(old('tanggal_lahir')); ?>" required class="input-field" />
                  <?php $__errorArgs = ['tanggal_lahir'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="mt-1 text-xs text-destructive"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
              </div>

              <div class="grid gap-5 sm:grid-cols-2">
                <div>
                  <label for="agama" class="text-sm font-medium text-foreground">Agama <span class="ppdb-req">*</span></label>
                  <select name="agama" id="agama" required class="input-field">
                    <option value="">Pilih Agama</option>
                    <?php $__currentLoopData = $agamaList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $agama): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                      <option value="<?php echo e($agama); ?>" <?php if(old('agama') === $agama): echo 'selected'; endif; ?>><?php echo e($agama); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  </select>
                  <?php $__errorArgs = ['agama'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="mt-1 text-xs text-destructive"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
                <div>
                  <label for="asal_sekolah" class="text-sm font-medium text-foreground">Asal Sekolah <span class="ppdb-req">*</span></label>
                  <input type="text" name="asal_sekolah" id="asal_sekolah" value="<?php echo e(old('asal_sekolah')); ?>" required class="input-field" placeholder="Nama SMP/MTs asal" />
                  <?php $__errorArgs = ['asal_sekolah'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="mt-1 text-xs text-destructive"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
              </div>
            </div>
          </div>

          
          <div class="ppdb-section">
            <div class="flex items-center gap-3">
              <span class="ppdb-section-icon"><?php if (isset($component)) { $__componentOriginalce262628e3a8d44dc38fd1f3965181bc = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalce262628e3a8d44dc38fd1f3965181bc = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.icon','data' => ['name' => 'users','class' => 'w-5 h-5']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'users','class' => 'w-5 h-5']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalce262628e3a8d44dc38fd1f3965181bc)): ?>
<?php $attributes = $__attributesOriginalce262628e3a8d44dc38fd1f3965181bc; ?>
<?php unset($__attributesOriginalce262628e3a8d44dc38fd1f3965181bc); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalce262628e3a8d44dc38fd1f3965181bc)): ?>
<?php $component = $__componentOriginalce262628e3a8d44dc38fd1f3965181bc; ?>
<?php unset($__componentOriginalce262628e3a8d44dc38fd1f3965181bc); ?>
<?php endif; ?></span>
              <div>
                <h3 class="font-display text-sm font-bold text-foreground">Data Orang Tua/Wali</h3>
                <p class="text-xs text-muted-foreground">Untuk keperluan komunikasi & administrasi sekolah.</p>
              </div>
            </div>

            <div class="mt-5 grid gap-5">
              <div>
                <label for="nama_orang_tua" class="text-sm font-medium text-foreground">Nama Orang Tua/Wali <span class="ppdb-req">*</span></label>
                <input type="text" name="nama_orang_tua" id="nama_orang_tua" value="<?php echo e(old('nama_orang_tua')); ?>" required class="input-field" placeholder="Nama lengkap orang tua/wali" />
                <?php $__errorArgs = ['nama_orang_tua'];
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
                  <label for="telepon_orang_tua" class="text-sm font-medium text-foreground">No. Telepon Orang Tua/Wali <span class="ppdb-req">*</span></label>
                  <input type="text" inputmode="numeric" name="telepon_orang_tua" id="telepon_orang_tua" value="<?php echo e(old('telepon_orang_tua')); ?>" required class="input-field" placeholder="08xxxxxxxxxx" />
                  <?php $__errorArgs = ['telepon_orang_tua'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="mt-1 text-xs text-destructive"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
                <div>
                  <label for="pekerjaan_orang_tua" class="text-sm font-medium text-foreground">Pekerjaan Orang Tua/Wali</label>
                  <input type="text" name="pekerjaan_orang_tua" id="pekerjaan_orang_tua" value="<?php echo e(old('pekerjaan_orang_tua')); ?>" class="input-field" placeholder="Opsional" />
                  <?php $__errorArgs = ['pekerjaan_orang_tua'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="mt-1 text-xs text-destructive"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
              </div>
            </div>
          </div>

          
          <div class="ppdb-section">
            <div class="flex items-center gap-3">
              <span class="ppdb-section-icon"><?php if (isset($component)) { $__componentOriginalce262628e3a8d44dc38fd1f3965181bc = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalce262628e3a8d44dc38fd1f3965181bc = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.icon','data' => ['name' => 'phone','class' => 'w-5 h-5']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'phone','class' => 'w-5 h-5']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalce262628e3a8d44dc38fd1f3965181bc)): ?>
<?php $attributes = $__attributesOriginalce262628e3a8d44dc38fd1f3965181bc; ?>
<?php unset($__attributesOriginalce262628e3a8d44dc38fd1f3965181bc); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalce262628e3a8d44dc38fd1f3965181bc)): ?>
<?php $component = $__componentOriginalce262628e3a8d44dc38fd1f3965181bc; ?>
<?php unset($__componentOriginalce262628e3a8d44dc38fd1f3965181bc); ?>
<?php endif; ?></span>
              <div>
                <h3 class="font-display text-sm font-bold text-foreground">Kontak &amp; Alamat</h3>
                <p class="text-xs text-muted-foreground">Info pendaftaran akan dikirim ke kontak ini.</p>
              </div>
            </div>

            <div class="mt-5 grid gap-5">
              <div class="grid gap-5 sm:grid-cols-2">
                <div>
                  <label for="email" class="text-sm font-medium text-foreground">Email <span class="ppdb-req">*</span></label>
                  <input type="email" name="email" id="email" value="<?php echo e(old('email')); ?>" required class="input-field" placeholder="nama@email.com" />
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
                  <label for="telepon" class="text-sm font-medium text-foreground">Nomor Telepon Siswa <span class="ppdb-req">*</span></label>
                  <input type="text" inputmode="numeric" name="telepon" id="telepon" value="<?php echo e(old('telepon')); ?>" required class="input-field" placeholder="08xxxxxxxxxx" />
                  <?php $__errorArgs = ['telepon'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="mt-1 text-xs text-destructive"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
              </div>
              <div>
                <label for="alamat" class="text-sm font-medium text-foreground">Alamat Lengkap <span class="ppdb-req">*</span></label>
                <textarea name="alamat" id="alamat" rows="3" required class="input-field" placeholder="Alamat sesuai KTP/KK"><?php echo e(old('alamat')); ?></textarea>
                <?php $__errorArgs = ['alamat'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="mt-1 text-xs text-destructive"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
              </div>
            </div>
          </div>

          
          <div class="ppdb-section">
            <div class="flex items-center gap-3">
              <span class="ppdb-section-icon"><?php if (isset($component)) { $__componentOriginalce262628e3a8d44dc38fd1f3965181bc = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalce262628e3a8d44dc38fd1f3965181bc = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.icon','data' => ['name' => 'graduation-cap','class' => 'w-5 h-5']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'graduation-cap','class' => 'w-5 h-5']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalce262628e3a8d44dc38fd1f3965181bc)): ?>
<?php $attributes = $__attributesOriginalce262628e3a8d44dc38fd1f3965181bc; ?>
<?php unset($__attributesOriginalce262628e3a8d44dc38fd1f3965181bc); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalce262628e3a8d44dc38fd1f3965181bc)): ?>
<?php $component = $__componentOriginalce262628e3a8d44dc38fd1f3965181bc; ?>
<?php unset($__componentOriginalce262628e3a8d44dc38fd1f3965181bc); ?>
<?php endif; ?></span>
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
                  <?php $__currentLoopData = $site['majors']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $major): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($major['code']); ?>" <?php if(old('pilihan1') === $major['code']): echo 'selected'; endif; ?>><?php echo e($major['code']); ?> - <?php echo e($major['name']); ?></option>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
                <?php $__errorArgs = ['pilihan1'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="mt-1 text-xs text-destructive"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
              </div>
              <div>
                <label for="pilihan2" class="text-sm font-medium text-foreground">Pilihan Jurusan 2 <span class="ppdb-req">*</span></label>
                <select name="pilihan2" id="pilihan2" required class="input-field">
                  <option value="">Pilih Jurusan</option>
                  <?php $__currentLoopData = $site['majors']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $major): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($major['code']); ?>" <?php if(old('pilihan2') === $major['code']): echo 'selected'; endif; ?>><?php echo e($major['code']); ?> - <?php echo e($major['name']); ?></option>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
                <?php $__errorArgs = ['pilihan2'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="mt-1 text-xs text-destructive"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
              </div>
            </div>
          </div>

          
          <div class="ppdb-section">
            <div class="flex items-center gap-3">
              <span class="ppdb-section-icon"><?php if (isset($component)) { $__componentOriginalce262628e3a8d44dc38fd1f3965181bc = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalce262628e3a8d44dc38fd1f3965181bc = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.icon','data' => ['name' => 'upload','class' => 'w-5 h-5']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'upload','class' => 'w-5 h-5']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalce262628e3a8d44dc38fd1f3965181bc)): ?>
<?php $attributes = $__attributesOriginalce262628e3a8d44dc38fd1f3965181bc; ?>
<?php unset($__attributesOriginalce262628e3a8d44dc38fd1f3965181bc); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalce262628e3a8d44dc38fd1f3965181bc)): ?>
<?php $component = $__componentOriginalce262628e3a8d44dc38fd1f3965181bc; ?>
<?php unset($__componentOriginalce262628e3a8d44dc38fd1f3965181bc); ?>
<?php endif; ?></span>
              <div>
                <h3 class="font-display text-sm font-bold text-foreground">Dokumen Pendukung</h3>
                <p class="text-xs text-muted-foreground">Kartu Keluarga/Akta/Ijazah/SKL &mdash; opsional, bisa disusulkan.</p>
              </div>
            </div>

            <label class="ppdb-dropzone mt-5" data-ppdb-dropzone>
              <input type="file" name="dokumen" id="dokumen" accept=".pdf,.jpg,.jpeg,.png" data-ppdb-file-input />
              <span class="ppdb-dropzone-placeholder">
                <span class="ppdb-dropzone-icon"><?php if (isset($component)) { $__componentOriginalce262628e3a8d44dc38fd1f3965181bc = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalce262628e3a8d44dc38fd1f3965181bc = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.icon','data' => ['name' => 'upload','class' => 'w-5 h-5']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'upload','class' => 'w-5 h-5']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalce262628e3a8d44dc38fd1f3965181bc)): ?>
<?php $attributes = $__attributesOriginalce262628e3a8d44dc38fd1f3965181bc; ?>
<?php unset($__attributesOriginalce262628e3a8d44dc38fd1f3965181bc); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalce262628e3a8d44dc38fd1f3965181bc)): ?>
<?php $component = $__componentOriginalce262628e3a8d44dc38fd1f3965181bc; ?>
<?php unset($__componentOriginalce262628e3a8d44dc38fd1f3965181bc); ?>
<?php endif; ?></span>
                <span class="text-sm font-semibold text-foreground">Klik atau seret berkas ke sini</span>
                <span class="text-xs text-muted-foreground">PDF, JPG, atau PNG &middot; maksimal 5 MB</span>
              </span>
              <span class="ppdb-dropzone-file">
                <span class="flex h-9 w-9 shrink-0 items-center justify-center rounded-lg bg-accent text-primary"><?php if (isset($component)) { $__componentOriginalce262628e3a8d44dc38fd1f3965181bc = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalce262628e3a8d44dc38fd1f3965181bc = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.icon','data' => ['name' => 'file-text','class' => 'w-4 h-4']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'file-text','class' => 'w-4 h-4']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalce262628e3a8d44dc38fd1f3965181bc)): ?>
<?php $attributes = $__attributesOriginalce262628e3a8d44dc38fd1f3965181bc; ?>
<?php unset($__attributesOriginalce262628e3a8d44dc38fd1f3965181bc); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalce262628e3a8d44dc38fd1f3965181bc)): ?>
<?php $component = $__componentOriginalce262628e3a8d44dc38fd1f3965181bc; ?>
<?php unset($__componentOriginalce262628e3a8d44dc38fd1f3965181bc); ?>
<?php endif; ?></span>
                <span class="text-left text-sm font-semibold text-foreground" data-ppdb-file-name>-</span>
                <button type="button" class="ppdb-dropzone-clear" data-ppdb-file-clear title="Hapus berkas" aria-label="Hapus berkas">
                  <?php if (isset($component)) { $__componentOriginalce262628e3a8d44dc38fd1f3965181bc = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalce262628e3a8d44dc38fd1f3965181bc = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.icon','data' => ['name' => 'x','class' => 'w-3.5 h-3.5']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'x','class' => 'w-3.5 h-3.5']); ?>
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
                </button>
              </span>
            </label>
            <?php $__errorArgs = ['dokumen'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="mt-2 text-xs text-destructive"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
          </div>

          <button type="submit" class="shine mt-2 inline-flex items-center justify-center gap-2 rounded-full bg-navy-gradient px-6 py-3.5 text-sm font-semibold text-hero-foreground shadow-lift transition-transform hover:-translate-y-0.5">
            Kirim Pendaftaran <?php if (isset($component)) { $__componentOriginalce262628e3a8d44dc38fd1f3965181bc = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalce262628e3a8d44dc38fd1f3965181bc = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.icon','data' => ['name' => 'arrow-right','class' => 'w-4 h-4']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'arrow-right','class' => 'w-4 h-4']); ?>
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

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\PunyaSaya\smk-infokom\resources\views/pages/ppdb.blade.php ENDPATH**/ ?>