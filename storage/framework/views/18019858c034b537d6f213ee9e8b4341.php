<?php $__env->startSection('title', 'Guru & Staff'); ?>

<?php $__env->startSection('content'); ?>

<?php if (isset($component)) { $__componentOriginala9d931d4f11b4d2850df99e991db1dca = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginala9d931d4f11b4d2850df99e991db1dca = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.page-hero','data' => ['crumb' => 'Guru & Staff','kicker' => 'Tenaga Pendidik','title' => 'Guru & Staff SMK INFOKOM Kota Bogor','desc' => 'Mengenal jajaran pimpinan, tenaga kependidikan, dan guru yang mendampingi proses belajar mengajar di sekolah.']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('page-hero'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['crumb' => 'Guru & Staff','kicker' => 'Tenaga Pendidik','title' => 'Guru & Staff SMK INFOKOM Kota Bogor','desc' => 'Mengenal jajaran pimpinan, tenaga kependidikan, dan guru yang mendampingi proses belajar mengajar di sekolah.']); ?>
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

<?php
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
?>

<section class="section-pad px-4 sm:px-6 lg:px-8">
  <div class="mx-auto max-w-6xl">
    <?php if (isset($component)) { $__componentOriginal6a0a1523cc2edf33c83fe20a5d1f7f78 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal6a0a1523cc2edf33c83fe20a5d1f7f78 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.section-title','data' => ['kicker' => 'Tim Kami','title' => 'Guru & Staff SMK INFOKOM','desc' => 'Susunan pimpinan, tenaga kependidikan, dan pengajar sekolah.']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('section-title'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['kicker' => 'Tim Kami','title' => 'Guru & Staff SMK INFOKOM','desc' => 'Susunan pimpinan, tenaga kependidikan, dan pengajar sekolah.']); ?>
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

    <?php if($guruStaffGrouped->isNotEmpty()): ?>
      <?php $totalStaff = $guruStaffGrouped->collapse()->count(); ?>

      
      <form class="reveal mx-auto mt-10 grid max-w-3xl gap-3 sm:grid-cols-[1fr_auto]" role="search" action="#" onsubmit="return false">
        <label class="search-field">
          <span class="sr-only">Cari guru atau staff</span>
          <?php if (isset($component)) { $__componentOriginalce262628e3a8d44dc38fd1f3965181bc = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalce262628e3a8d44dc38fd1f3965181bc = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.icon','data' => ['name' => 'search']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'search']); ?>
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
          <input type="search" data-staff-search placeholder="Cari nama atau jabatan..." autocomplete="off" />
        </label>
        <div class="sm:w-72">
          <label for="staff-filter-select" class="sr-only">Filter kategori Guru &amp; Staff</label>
          <div class="staff-filter-select-wrap">
            <?php if (isset($component)) { $__componentOriginalce262628e3a8d44dc38fd1f3965181bc = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalce262628e3a8d44dc38fd1f3965181bc = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.icon','data' => ['name' => 'filter','class' => 'staff-filter-select-icon h-4 w-4']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'filter','class' => 'staff-filter-select-icon h-4 w-4']); ?>
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
            <select id="staff-filter-select" data-staff-filter-select class="staff-filter-select">
              <option value="Semua" selected>Semua Kategori (<?php echo e($totalStaff); ?> orang)</option>
              <?php $__currentLoopData = $guruStaffGrouped; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $kategori => $anggota): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($kategori); ?>"><?php echo e($kategori); ?> (<?php echo e($anggota->count()); ?> orang)</option>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
            <?php if (isset($component)) { $__componentOriginalce262628e3a8d44dc38fd1f3965181bc = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalce262628e3a8d44dc38fd1f3965181bc = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.icon','data' => ['name' => 'chevron-down','class' => 'staff-filter-select-chevron h-4 w-4']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'chevron-down','class' => 'staff-filter-select-chevron h-4 w-4']); ?>
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
          </div>
        </div>
      </form>
      <p class="reveal mt-4 text-center text-sm text-muted-foreground">
        Menampilkan <b class="font-semibold text-foreground" data-staff-shown><?php echo e($totalStaff); ?></b> dari <?php echo e($totalStaff); ?> orang
        di <b class="font-semibold text-foreground"><?php echo e($guruStaffGrouped->count()); ?></b> kategori jabatan
      </p>
    <?php endif; ?>

    <?php $__empty_1 = true; $__currentLoopData = $guruStaffGrouped; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $kategori => $anggota): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
      <div class="mt-14 first:mt-10" data-staff-category="<?php echo e($kategori); ?>">

        
        <div class="reveal mb-6 flex items-center gap-3 sm:gap-4">
          <span class="flex h-11 w-11 shrink-0 items-center justify-center rounded-2xl bg-navy-gradient text-hero-foreground shadow-soft sm:h-12 sm:w-12">
            <?php if (isset($component)) { $__componentOriginalce262628e3a8d44dc38fd1f3965181bc = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalce262628e3a8d44dc38fd1f3965181bc = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.icon','data' => ['name' => ''.e($kategoriIcon[$kategori] ?? 'idcard').'','class' => 'h-5 w-5 sm:h-6 sm:w-6']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => ''.e($kategoriIcon[$kategori] ?? 'idcard').'','class' => 'h-5 w-5 sm:h-6 sm:w-6']); ?>
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
          <div class="min-w-0">
            <h3 class="font-display text-lg font-bold text-foreground sm:text-xl"><?php echo e($kategori); ?></h3>
            <p class="text-xs text-muted-foreground" data-staff-cat-count><?php echo e($anggota->count()); ?> orang</p>
          </div>
          <div class="ml-1 hidden h-px flex-1 bg-border sm:block"></div>
        </div>

        <?php if($kategori === 'Pimpinan Sekolah'): ?>
          
          <div class="stagger-group grid grid-cols-2 gap-3 sm:gap-5 lg:grid-cols-3 xl:grid-cols-4">
            <?php $__currentLoopData = $anggota; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $guru): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <?php $isKepsek = $guru->jabatan === 'Kepala Sekolah'; ?>
              <div data-name="<?php echo e($guru->nama_lengkap); ?>" data-role="<?php echo e($guru->jabatan); ?>" class="stagger-item staff-card staff-card-lead relative rounded-[28px] border border-border bg-card text-center shadow-soft <?php echo e($isKepsek ? 'staff-card-principal' : ''); ?>">
                <?php if($isKepsek): ?>
                  <span class="staff-card-lead-badge absolute -left-3 -top-3 z-10 flex h-10 w-10 items-center justify-center rounded-full bg-navy-gradient text-hero-foreground" title="Kepala Sekolah">
                    <?php if (isset($component)) { $__componentOriginalce262628e3a8d44dc38fd1f3965181bc = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalce262628e3a8d44dc38fd1f3965181bc = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.icon','data' => ['name' => 'award','class' => 'h-5 w-5']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'award','class' => 'h-5 w-5']); ?>
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
                <?php endif; ?>

                <div class="relative overflow-hidden rounded-[28px]">
                  <span class="staff-card-accent" aria-hidden="true"></span>

                  <div class="relative z-[1] p-3 pb-0">
                    <div class="staff-photo staff-panel relative aspect-square w-full overflow-hidden rounded-3xl">
                      <?php if($guru->foto): ?>
                        <span class="staff-photo-aura" aria-hidden="true"></span>
                        <img src="<?php echo e(\App\Support\Site::imageUrl($guru->foto)); ?>" alt="<?php echo e($guru->nama_lengkap); ?>" loading="lazy" class="staff-photo-img relative z-[1] h-full w-full object-contain p-3" />
                      <?php else: ?>
                        <div class="relative z-[1] flex h-full w-full items-center justify-center rounded-3xl bg-navy-gradient font-display text-2xl font-bold text-hero-foreground"><?php echo e($guru->initials()); ?></div>
                      <?php endif; ?>
                    </div>
                  </div>

                  <div class="relative z-[1] p-3 pt-3 sm:p-5 sm:pt-4">
                    <p class="staff-name font-display text-sm font-bold leading-snug text-foreground"><?php echo e($guru->nama_lengkap); ?></p>
                    <span class="staff-badge mt-2 inline-block rounded-full px-3 py-1 text-xs font-semibold <?php echo e($isKepsek ? 'staff-badge-gold bg-transparent' : 'bg-accent text-primary'); ?>"><?php echo e($guru->jabatan); ?></span>
                  </div>
                </div>
              </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </div>
        <?php else: ?>
          
          <div class="stagger-group grid grid-cols-2 gap-3 sm:gap-5 lg:grid-cols-3 xl:grid-cols-4">
            <?php $__currentLoopData = $anggota; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $guru): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <div data-name="<?php echo e($guru->nama_lengkap); ?>" data-role="<?php echo e($guru->jabatan); ?>" class="stagger-item staff-card relative overflow-hidden rounded-[28px] border border-border bg-card text-center shadow-soft">
                <span class="staff-card-accent" aria-hidden="true"></span>

                <div class="relative z-[1] p-3 pb-0">
                  <div class="staff-photo staff-panel relative aspect-square w-full overflow-hidden rounded-3xl">
                    <?php if($guru->foto): ?>
                      <span class="staff-photo-aura" aria-hidden="true"></span>
                      <img src="<?php echo e(\App\Support\Site::imageUrl($guru->foto)); ?>" alt="<?php echo e($guru->nama_lengkap); ?>" loading="lazy" class="staff-photo-img relative z-[1] h-full w-full object-contain p-3" />
                    <?php else: ?>
                      <div class="relative z-[1] flex h-full w-full items-center justify-center rounded-3xl bg-navy-gradient font-display text-2xl font-bold text-hero-foreground"><?php echo e($guru->initials()); ?></div>
                    <?php endif; ?>
                  </div>
                </div>

                <div class="relative z-[1] p-3 pt-3 sm:p-5 sm:pt-4">
                  <p class="staff-name font-display text-sm font-bold leading-snug text-foreground"><?php echo e($guru->nama_lengkap); ?></p>
                  <span class="staff-badge mt-2 inline-block rounded-full bg-accent px-3 py-1 text-xs font-semibold text-primary"><?php echo e($guru->jabatan); ?></span>
                </div>
              </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </div>
        <?php endif; ?>
      </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
      <p class="mt-10 text-center text-sm text-muted-foreground">Data guru & staff belum tersedia.</p>
    <?php endif; ?>

    <p data-staff-empty class="mt-14 hidden rounded-2xl border border-dashed border-border py-12 text-center text-sm text-muted-foreground">
      Tidak ada guru atau staff yang cocok dengan pencarian Anda.
    </p>
  </div>
</section>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\PunyaSaya\smk-infokom\resources\views/pages/guru-staff.blade.php ENDPATH**/ ?>