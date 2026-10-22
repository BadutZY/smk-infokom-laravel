
<?php $__env->startSection('title', 'Fasilitas Sekolah'); ?>
<?php $__env->startSection('description', 'Kenali sarana dan prasarana sekolah: ruang kelas, perpustakaan, ruang guru, tata usaha, musholla, kantin, taman, dan fasilitas penunjang lainnya.'); ?>

<?php $__env->startSection('content'); ?>

<?php if (isset($component)) { $__componentOriginala9d931d4f11b4d2850df99e991db1dca = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginala9d931d4f11b4d2850df99e991db1dca = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.page-hero','data' => ['crumb' => 'Fasilitas','parent' => ['to' => route('profil'), 'label' => 'Profil'],'kicker' => 'Sarana & Prasarana','title' => 'Fasilitas Sekolah','desc' => 'Lingkungan belajar yang nyaman dan lengkap untuk mendukung kegiatan belajar, bekerja, dan berkarya seluruh warga sekolah.']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('page-hero'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['crumb' => 'Fasilitas','parent' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(['to' => route('profil'), 'label' => 'Profil']),'kicker' => 'Sarana & Prasarana','title' => 'Fasilitas Sekolah','desc' => 'Lingkungan belajar yang nyaman dan lengkap untuk mendukung kegiatan belajar, bekerja, dan berkarya seluruh warga sekolah.']); ?>
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
  $items = collect($site['fasilitas'])->values();
  $kategoris = $items->pluck('kategori')->unique()->values();
  $totalItems = $items->count();
  $totalMajors = count($site['majors'] ?? []);
?>

<section class="section-pad overflow-x-clip px-4 sm:px-6 lg:px-8">
  <div class="mx-auto max-w-6xl">

    <?php if (isset($component)) { $__componentOriginal6a0a1523cc2edf33c83fe20a5d1f7f78 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal6a0a1523cc2edf33c83fe20a5d1f7f78 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.section-title','data' => ['kicker' => 'Lingkungan Belajar','title' => 'Ruang yang Mendukung Setiap Aktivitas','desc' => 'Kenali ruang-ruang yang menopang kegiatan belajar, bekerja, ibadah, dan istirahat warga sekolah setiap hari.']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('section-title'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['kicker' => 'Lingkungan Belajar','title' => 'Ruang yang Mendukung Setiap Aktivitas','desc' => 'Kenali ruang-ruang yang menopang kegiatan belajar, bekerja, ibadah, dan istirahat warga sekolah setiap hari.']); ?>
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

    <?php if($totalItems > 0): ?>

      
      <div class="fas-stats stagger-group mt-12">
        <div class="stagger-item fas-stat">
          <span class="fas-stat__icon"><?php if (isset($component)) { $__componentOriginalce262628e3a8d44dc38fd1f3965181bc = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalce262628e3a8d44dc38fd1f3965181bc = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.icon','data' => ['name' => 'school','class' => 'w-5 h-5']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'school','class' => 'w-5 h-5']); ?>
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
          <span>
            <b class="fas-stat__num"><span data-countup="<?php echo e($totalItems); ?>">0</span></b>
            <span class="fas-stat__label">Fasilitas Sekolah</span>
          </span>
        </div>
        <div class="stagger-item fas-stat">
          <span class="fas-stat__icon"><?php if (isset($component)) { $__componentOriginalce262628e3a8d44dc38fd1f3965181bc = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalce262628e3a8d44dc38fd1f3965181bc = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.icon','data' => ['name' => 'layers','class' => 'w-5 h-5']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'layers','class' => 'w-5 h-5']); ?>
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
          <span>
            <b class="fas-stat__num"><span data-countup="<?php echo e($kategoris->count()); ?>">0</span></b>
            <span class="fas-stat__label">Kategori Ruang</span>
          </span>
        </div>
        <?php if($totalMajors > 0): ?>
          <div class="stagger-item fas-stat">
            <span class="fas-stat__icon"><?php if (isset($component)) { $__componentOriginalce262628e3a8d44dc38fd1f3965181bc = $component; } ?>
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
            <span>
              <b class="fas-stat__num"><span data-countup="<?php echo e($totalMajors); ?>">0</span></b>
              <span class="fas-stat__label">Kompetensi Keahlian</span>
            </span>
          </div>
        <?php endif; ?>
      </div>

      
      <div class="reveal mt-12 flex flex-col items-center gap-5 lg:flex-row lg:justify-between">
        <div data-filter-group="#fasilitas-grid" class="flex flex-wrap justify-center gap-2 lg:justify-start">
          <button type="button" data-filter-btn="Semua" class="chip rounded-full bg-primary px-4 py-2 text-sm font-semibold text-primary-foreground">Semua<span class="fas-chip-n"><?php echo e($totalItems); ?></span></button>
          <?php $__currentLoopData = $kategoris; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $kat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <button type="button" data-filter-btn="<?php echo e($kat); ?>" class="chip rounded-full bg-secondary px-4 py-2 text-sm font-semibold text-secondary-foreground"><?php echo e($kat); ?><span class="fas-chip-n"><?php echo e($items->where('kategori', $kat)->count()); ?></span></button>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
        <label class="search-field w-full lg:max-w-xs">
          <span class="sr-only">Cari fasilitas</span>
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
          <input type="search" data-search-input="#fasilitas-grid" placeholder="Cari fasilitas..." autocomplete="off" />
        </label>
      </div>

      
      <div id="fasilitas-grid" class="fas-grid stagger-group mt-10">
        <?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $f): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <?php
            $photos = collect([$f['gambar'] ?? null, $f['gambar_2'] ?? null])
              ->filter()
              ->map(fn ($p) => \App\Support\Site::imageUrl($p))
              ->values()
              ->all();
            $icon = $f['icon'] ?: 'building';
          ?>

          
          <div class="stagger-item fas-item"
               data-fas-card
               data-filter-item
               data-category="<?php echo e($f['kategori']); ?>"
               data-search="<?php echo e(mb_strtolower($f['title'].' '.$f['kategori'].' '.$f['desc'])); ?>"
               data-photos="<?php echo e(json_encode($photos)); ?>">
            <article class="fas-card card-hover">
              <div class="fas-card__media">
                <?php if(count($photos) > 0): ?>
                  <img src="<?php echo e($photos[0]); ?>" alt="<?php echo e($f['title']); ?>" loading="lazy" decoding="async" />
                <?php else: ?>
                  
                  <div class="fas-ph" aria-hidden="true">
                    <div class="hud-grid"></div>
                    <span class="fas-ph__ring"><?php if (isset($component)) { $__componentOriginalce262628e3a8d44dc38fd1f3965181bc = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalce262628e3a8d44dc38fd1f3965181bc = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.icon','data' => ['name' => $icon,'class' => 'fas-ph__icon']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($icon),'class' => 'fas-ph__icon']); ?>
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
                  </div>
                <?php endif; ?>
                <span class="fas-card__shade" aria-hidden="true"></span>
                <span class="fas-card__cat"><?php echo e($f['kategori']); ?></span>
                <span class="fas-card__no" aria-hidden="true"><?php echo e(str_pad((string) ($i + 1), 2, '0', STR_PAD_LEFT)); ?></span>
                <?php if(count($photos) > 1): ?>
                  <span class="fas-card__count"><?php if (isset($component)) { $__componentOriginalce262628e3a8d44dc38fd1f3965181bc = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalce262628e3a8d44dc38fd1f3965181bc = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.icon','data' => ['name' => 'camera','class' => 'w-3 h-3']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'camera','class' => 'w-3 h-3']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalce262628e3a8d44dc38fd1f3965181bc)): ?>
<?php $attributes = $__attributesOriginalce262628e3a8d44dc38fd1f3965181bc; ?>
<?php unset($__attributesOriginalce262628e3a8d44dc38fd1f3965181bc); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalce262628e3a8d44dc38fd1f3965181bc)): ?>
<?php $component = $__componentOriginalce262628e3a8d44dc38fd1f3965181bc; ?>
<?php unset($__componentOriginalce262628e3a8d44dc38fd1f3965181bc); ?>
<?php endif; ?> <?php echo e(count($photos)); ?> foto</span>
                <?php endif; ?>
              </div>

              <div class="fas-card__body">
                <span class="fas-card__icon"><?php if (isset($component)) { $__componentOriginalce262628e3a8d44dc38fd1f3965181bc = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalce262628e3a8d44dc38fd1f3965181bc = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.icon','data' => ['name' => $icon,'class' => 'w-5 h-5']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($icon),'class' => 'w-5 h-5']); ?>
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
                <h3><?php echo e($f['title']); ?></h3>
                <p><?php echo e($f['desc']); ?></p>
                <span class="fas-card__cta">Lihat detail <?php if (isset($component)) { $__componentOriginalce262628e3a8d44dc38fd1f3965181bc = $component; } ?>
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
<?php endif; ?></span>
              </div>

              <button type="button" class="fas-card__hit" data-fas-open aria-haspopup="dialog" aria-label="Lihat detail <?php echo e($f['title']); ?>"></button>
            </article>
          </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      </div>

      
      <div data-filter-empty class="mt-4 flex-col items-center gap-3 rounded-3xl border border-dashed border-border bg-secondary/40 py-14 text-center">
        <span class="mx-auto flex h-12 w-12 items-center justify-center rounded-full bg-accent text-primary"><?php if (isset($component)) { $__componentOriginalce262628e3a8d44dc38fd1f3965181bc = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalce262628e3a8d44dc38fd1f3965181bc = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.icon','data' => ['name' => 'search','class' => 'w-5 h-5']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'search','class' => 'w-5 h-5']); ?>
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
        <p class="text-sm font-medium text-muted-foreground">Tidak ada fasilitas yang cocok dengan pilihan Anda.</p>
      </div>

    <?php else: ?>

      <div class="reveal mt-12 rounded-3xl border border-dashed border-border bg-secondary/40 px-6 py-16 text-center">
        <span class="mx-auto flex h-14 w-14 items-center justify-center rounded-full bg-accent text-primary"><?php if (isset($component)) { $__componentOriginalce262628e3a8d44dc38fd1f3965181bc = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalce262628e3a8d44dc38fd1f3965181bc = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.icon','data' => ['name' => 'school','class' => 'w-6 h-6']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'school','class' => 'w-6 h-6']); ?>
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
        <p class="mt-4 font-display text-lg font-bold text-foreground">Data fasilitas belum tersedia</p>
        <p class="mx-auto mt-2 max-w-md text-sm text-muted-foreground">Informasi fasilitas sekolah akan segera ditampilkan di halaman ini.</p>
      </div>

    <?php endif; ?>
  </div>
</section>


<section class="fas-cta-wrap px-4 sm:px-6 lg:px-8">
  <div class="mx-auto max-w-6xl">
    <div class="fas-cta reveal-scale bg-navy-radial text-hero-foreground">
      <div class="pointer-events-none absolute inset-0 bg-grain"></div>
      <div class="hud-grid opacity-70"></div>
      <span class="accent-bar absolute inset-x-0 top-0" aria-hidden="true"></span>
      <div class="relative">
        <h3>Ingin melihat fasilitas kami secara langsung?</h3>
        <p>Hubungi kami untuk informasi kunjungan sekolah, atau lihat dokumentasi kegiatan di galeri.</p>
      </div>
      <div class="relative flex flex-wrap items-center gap-3">
        <a href="<?php echo e(route('kontak')); ?>" class="shine inline-flex shrink-0 items-center gap-2 rounded-full bg-gold-gradient px-6 py-3 text-sm font-semibold text-gold-foreground shadow-soft transition-transform hover:-translate-y-0.5">
          Hubungi Kami <?php if (isset($component)) { $__componentOriginalce262628e3a8d44dc38fd1f3965181bc = $component; } ?>
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
        </a>
        <a href="<?php echo e(route('galeri')); ?>" class="fas-btn-ghost">
          <?php if (isset($component)) { $__componentOriginalce262628e3a8d44dc38fd1f3965181bc = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalce262628e3a8d44dc38fd1f3965181bc = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.icon','data' => ['name' => 'image','class' => 'w-4 h-4']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'image','class' => 'w-4 h-4']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalce262628e3a8d44dc38fd1f3965181bc)): ?>
<?php $attributes = $__attributesOriginalce262628e3a8d44dc38fd1f3965181bc; ?>
<?php unset($__attributesOriginalce262628e3a8d44dc38fd1f3965181bc); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalce262628e3a8d44dc38fd1f3965181bc)): ?>
<?php $component = $__componentOriginalce262628e3a8d44dc38fd1f3965181bc; ?>
<?php unset($__componentOriginalce262628e3a8d44dc38fd1f3965181bc); ?>
<?php endif; ?> Lihat Galeri
        </a>
      </div>
    </div>
  </div>
</section>


<div class="fas-modal" data-fas-modal role="dialog" aria-modal="true" aria-labelledby="fas-modal-title" aria-hidden="true">
  <div class="fas-modal__backdrop" data-fas-close></div>

  <div class="fas-modal__panel">
    <button type="button" class="fas-modal__close" data-fas-close aria-label="Tutup">
      <?php if (isset($component)) { $__componentOriginalce262628e3a8d44dc38fd1f3965181bc = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalce262628e3a8d44dc38fd1f3965181bc = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.icon','data' => ['name' => 'x','class' => 'w-5 h-5']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'x','class' => 'w-5 h-5']); ?>
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

    <div class="fas-modal__media" data-fas-media>
      <img data-fas-img src="" alt="" />
      <div class="fas-ph" data-fas-ph aria-hidden="true">
        <div class="hud-grid"></div>
        <span class="fas-ph__ring" data-fas-phicon></span>
      </div>
      <div class="fas-modal__thumbs" data-fas-thumbs></div>
    </div>

    <div class="fas-modal__body">
      <div class="fas-modal__head">
        <span class="fas-modal__icon" data-fas-icon></span>
        <span class="fas-modal__cat" data-fas-cat></span>
      </div>
      <h3 id="fas-modal-title" data-fas-title></h3>
      <span class="fas-modal__rule" aria-hidden="true"></span>
      <p data-fas-desc></p>

      <div class="fas-modal__nav">
        <button type="button" class="fas-nav-btn" data-fas-prev>
          <?php if (isset($component)) { $__componentOriginalce262628e3a8d44dc38fd1f3965181bc = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalce262628e3a8d44dc38fd1f3965181bc = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.icon','data' => ['name' => 'chevron-left','class' => 'w-4 h-4']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'chevron-left','class' => 'w-4 h-4']); ?>
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
          <span><small>Sebelumnya</small><b data-fas-prev-name></b></span>
        </button>
        <span class="fas-modal__pos" data-fas-pos></span>
        <button type="button" class="fas-nav-btn is-next" data-fas-next>
          <span><small>Berikutnya</small><b data-fas-next-name></b></span>
          <?php if (isset($component)) { $__componentOriginalce262628e3a8d44dc38fd1f3965181bc = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalce262628e3a8d44dc38fd1f3965181bc = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.icon','data' => ['name' => 'chevron-right','class' => 'w-4 h-4']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'chevron-right','class' => 'w-4 h-4']); ?>
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
      </div>
    </div>
  </div>
</div>

<style>
  /* ---------- Ringkasan ---------- */
  .fas-stats { display: grid; gap: 1rem; grid-template-columns: repeat(1, minmax(0, 1fr)); max-width: 52rem; margin-inline: auto; }
  @media (min-width: 640px) { .fas-stats { grid-template-columns: repeat(3, minmax(0, 1fr)); } }
  .fas-stat {
    display: flex; align-items: center; gap: 0.9rem; padding: 1rem 1.15rem; border-radius: 1.25rem;
    background: var(--card); border: 1px solid var(--border); box-shadow: var(--shadow-soft);
    transition: transform 0.45s var(--ease-out), box-shadow 0.45s var(--ease-out), border-color 0.4s ease;
  }
  @media (hover: hover) { .fas-stat:hover { transform: translateY(-4px); box-shadow: var(--shadow-lift); border-color: oklch(from var(--gold) l c h / 0.5); } }
  .fas-stat__icon {
    display: grid; flex: none; place-items: center; width: 2.9rem; height: 2.9rem; border-radius: 0.95rem;
    background: var(--gradient-navy); color: var(--hero-foreground);
  }
  .fas-stat__num { display: block; font-family: var(--font-display); font-size: 1.65rem; font-weight: 800; line-height: 1.1; color: var(--primary); }
  .fas-stat__label { display: block; margin-top: 0.15rem; font-size: 0.75rem; font-weight: 600; white-space: nowrap; color: var(--muted-foreground); }

  .fas-chip-n { margin-left: 0.45rem; font-size: 0.7rem; font-weight: 700; opacity: 0.65; font-variant-numeric: tabular-nums; }

  /* ---------- Grid & kartu ---------- */
  .fas-grid { display: grid; gap: 1.5rem; grid-template-columns: repeat(1, minmax(0, 1fr)); }
  @media (min-width: 640px) { .fas-grid { grid-template-columns: repeat(2, minmax(0, 1fr)); } }
  @media (min-width: 1024px) { .fas-grid { grid-template-columns: repeat(3, minmax(0, 1fr)); gap: 1.75rem; } }
  .fas-item { min-width: 0; }

  .fas-card {
    position: relative; display: flex; flex-direction: column; height: 100%; overflow: hidden;
    border-radius: 1.6rem; background: var(--card); border: 1px solid var(--border); box-shadow: var(--shadow-soft);
  }
  /* garis emas yang "menyapu" di dasar kartu saat di-hover */
  .fas-card::before {
    content: ''; position: absolute; left: 0; right: 0; bottom: 0; z-index: 6; height: 3px;
    background: var(--gradient-gold); transform: scaleX(0); transform-origin: left; transition: transform 0.65s var(--ease-out);
  }
  @media (hover: hover) {
    .fas-card:hover::before { transform: scaleX(1); }
    .fas-card:hover .fas-card__media img { transform: scale(1.05); }
    .fas-card:hover .fas-card__icon { transform: rotate(-8deg) scale(1.08); }
    .fas-card:hover .fas-card__cta svg { transform: translateX(6px); }
    .fas-card:hover .fas-ph__ring { transform: scale(1.08); }
  }

  /* Bingkai foto 16:9 = rasio foto fasilitas, jadi foto tampil penuh 100% tanpa terpotong. */
  .fas-card__media {
    position: relative; aspect-ratio: 16 / 9; overflow: hidden;
    background: var(--gradient-navy-radial); color: var(--hero-foreground);
  }
  .fas-card__media img { width: 100%; height: 100%; object-fit: cover; transition: transform 1s var(--ease-out); }
  .fas-card__shade {
    position: absolute; inset: 0; pointer-events: none;
    background: linear-gradient(to top, oklch(0.16 0.06 262 / 0.5), transparent 55%);
  }
  .fas-card__cat, .fas-card__no, .fas-card__count {
    position: absolute; z-index: 2; display: inline-flex; align-items: center; gap: 0.35rem;
    padding: 0.3rem 0.8rem; border-radius: 999px; font-size: 0.72rem; font-weight: 700; color: #fff;
    background: oklch(0.2 0.07 262 / 0.62); backdrop-filter: blur(8px); -webkit-backdrop-filter: blur(8px);
    border: 1px solid oklch(1 0 0 / 0.16);
  }
  .fas-card__cat { left: 0.85rem; top: 0.85rem; max-width: calc(100% - 4.5rem); overflow: hidden; text-overflow: ellipsis; white-space: nowrap; }
  .fas-card__no { right: 0.85rem; top: 0.85rem; letter-spacing: 0.08em; font-variant-numeric: tabular-nums; }
  .fas-card__count { right: 0.85rem; bottom: 2rem; }

  /* Tampilan pengganti (belum ada foto) */
  .fas-ph { position: absolute; inset: 0; display: grid; place-items: center; overflow: hidden; }
  .fas-ph__ring {
    position: relative; display: grid; place-items: center; width: 5.5rem; height: 5.5rem; border-radius: 999px;
    color: oklch(0.92 0.11 92); background: oklch(1 0 0 / 0.07);
    border: 1px solid oklch(from var(--gold) l c h / 0.45);
    box-shadow: 0 0 0 10px oklch(1 0 0 / 0.035), 0 0 46px -6px oklch(from var(--gold) l c h / 0.5);
    transition: transform 0.6s var(--ease-spring);
  }
  .fas-ph__ring::after {
    content: ''; position: absolute; inset: -0.9rem; border-radius: inherit;
    border: 1px solid oklch(from var(--gold) l c h / 0.32); animation: fasPulse 3.2s var(--ease-out) infinite;
  }
  .fas-ph__icon { width: 2.4rem; height: 2.4rem; }
  .fas-ph__ring svg { width: 2.4rem; height: 2.4rem; }
  @keyframes fasPulse { 0% { transform: scale(0.86); opacity: 0.9; } 100% { transform: scale(1.5); opacity: 0; } }

  .fas-card__body { position: relative; z-index: 1; display: flex; flex: 1; flex-direction: column; padding: 0 1.5rem 1.5rem; }
  .fas-card__icon {
    display: grid; place-items: center; width: 3.3rem; height: 3.3rem; margin-top: -1.65rem; margin-left: -0.15rem;
    border-radius: 1.05rem; color: var(--gold-foreground); background: var(--gradient-gold);
    border: 3px solid var(--card); box-shadow: 0 14px 26px -12px oklch(0.74 0.18 68 / 0.75);
    transition: transform 0.55s var(--ease-spring);
  }
  .fas-card__body h3 {
    margin-top: 1rem; font-family: var(--font-display); font-size: 1.12rem; font-weight: 700; line-height: 1.3; color: var(--foreground);
  }
  .fas-card__body p {
    margin-top: 0.55rem; font-size: 0.875rem; line-height: 1.65; color: var(--muted-foreground);
    display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical; overflow: hidden;
  }
  .fas-card__cta {
    display: inline-flex; align-items: center; gap: 0.4rem; margin-top: auto; padding-top: 1.15rem;
    font-size: 0.85rem; font-weight: 700; color: var(--primary);
  }
  .fas-card__cta svg { transition: transform 0.45s var(--ease-out); }

  /* tombol transparan yang menutupi seluruh kartu (kartu bisa diklik & diakses keyboard) */
  .fas-card > .fas-card__hit {
    position: absolute; inset: 0; z-index: 5; width: 100%; height: 100%; border-radius: inherit;
    background: transparent; cursor: pointer;
  }
  .fas-card > .fas-card__hit:focus-visible { outline: 3px solid var(--gold); outline-offset: -3px; }

  /* ---------- CTA ---------- */
  .fas-cta-wrap { padding-bottom: 5rem; }
  @media (min-width: 1024px) { .fas-cta-wrap { padding-bottom: 7rem; } }
  .fas-cta {
    position: relative; display: flex; flex-direction: column; align-items: center; justify-content: space-between; gap: 1.5rem;
    overflow: hidden; padding: 2.5rem 1.75rem; text-align: center; border-radius: 1.9rem; box-shadow: var(--shadow-lift);
  }
  @media (min-width: 768px) { .fas-cta { flex-direction: row; padding: 2.75rem 3rem; text-align: left; } }
  .fas-cta h3 { font-family: var(--font-display); font-size: 1.35rem; font-weight: 800; line-height: 1.25; }
  @media (min-width: 640px) { .fas-cta h3 { font-size: 1.6rem; } }
  .fas-cta p { margin-top: 0.45rem; max-width: 34rem; font-size: 0.9rem; line-height: 1.65; color: rgb(255 255 255 / 0.72); }
  .fas-btn-ghost {
    display: inline-flex; align-items: center; gap: 0.5rem; padding: 0.72rem 1.4rem; border-radius: 999px;
    font-size: 0.875rem; font-weight: 600; color: #fff; background: oklch(1 0 0 / 0.08); border: 1px solid oklch(1 0 0 / 0.22);
    transition: background 0.3s, transform 0.3s var(--ease-out), border-color 0.3s;
  }
  .fas-btn-ghost:hover { background: oklch(1 0 0 / 0.16); border-color: oklch(from var(--gold) l c h / 0.6); transform: translateY(-2px); }

  /* ---------- Jendela detail ---------- */
  .fas-modal { position: fixed; inset: 0; z-index: 70; display: none; align-items: center; justify-content: center; padding: 1rem; }
  .fas-modal.is-open { display: flex; }
  .fas-modal__backdrop {
    position: absolute; inset: 0; background: oklch(0.14 0.06 262 / 0.74);
    backdrop-filter: blur(6px); -webkit-backdrop-filter: blur(6px); animation: fasFade 0.3s ease both;
  }
  .fas-modal.is-closing .fas-modal__backdrop { animation: fasFadeOut 0.22s ease both; }
  .fas-modal__panel {
    position: relative; display: grid; grid-template-columns: 1.5fr 1fr; width: min(76rem, 100%); max-height: min(92vh, 44rem);
    overflow: hidden; border-radius: 1.9rem; background: var(--card); box-shadow: 0 46px 100px -34px rgb(0 0 0 / 0.65);
    animation: fasPop 0.5s var(--ease-spring) both;
  }
  .fas-modal.is-closing .fas-modal__panel { animation: fasPopOut 0.22s ease both; }
  @media (max-width: 820px) {
    .fas-modal__panel { grid-template-columns: 1fr; grid-template-rows: auto 1fr; overflow-y: auto; max-height: 92vh; }
  }
  .fas-modal__close {
    position: absolute; right: 0.9rem; top: 0.9rem; z-index: 8; display: grid; place-items: center; width: 2.6rem; height: 2.6rem;
    border-radius: 999px; color: var(--foreground); background: var(--card); border: 1px solid var(--border);
    box-shadow: var(--shadow-soft); transition: transform 0.35s var(--ease-out), background 0.3s, color 0.3s;
  }
  .fas-modal__close:hover { transform: rotate(90deg); background: var(--primary); color: var(--primary-foreground); }

  /* Kolom foto selalu 16:9 (sama dengan foto asli) -> foto memenuhi kolom, tanpa pinggiran kosong. */
  .fas-modal__media {
    position: relative; overflow: hidden; aspect-ratio: 16 / 9;
    background: var(--gradient-navy-radial); color: var(--hero-foreground);
  }
  .fas-modal__media > img {
    position: absolute; inset: 0; width: 100%; height: 100%; object-fit: cover; object-position: center;
    transition: opacity 0.35s ease;
  }
  .fas-modal__media > img.is-swap { opacity: 0; }
  .fas-modal__media .fas-ph__ring { width: 7rem; height: 7rem; }
  .fas-modal__media .fas-ph__ring svg { width: 3rem; height: 3rem; }
  .fas-modal__thumbs { position: absolute; left: 1rem; bottom: 1rem; z-index: 3; display: flex; gap: 0.5rem; }
  .fas-thumb {
    width: 4.2rem; height: 3rem; overflow: hidden; padding: 0; border-radius: 0.75rem; opacity: 0.8;
    border: 2px solid oklch(1 0 0 / 0.55); box-shadow: 0 8px 18px -8px rgb(0 0 0 / 0.6);
    transition: transform 0.3s var(--ease-out), opacity 0.3s, border-color 0.3s;
  }
  .fas-thumb img { width: 100%; height: 100%; object-fit: cover; }
  .fas-thumb:hover { transform: translateY(-2px); opacity: 1; }
  .fas-thumb.is-active { opacity: 1; border-color: var(--gold); }

  .fas-modal__body { display: flex; flex-direction: column; min-height: 0; overflow-y: auto; padding: 2.5rem 2.5rem 2rem; }
  @media (max-width: 820px) { .fas-modal__body { overflow: visible; padding: 1.5rem 1.4rem 1.4rem; } }
  .fas-modal__head { display: flex; align-items: center; gap: 0.75rem; padding-right: 2.6rem; }
  .fas-modal__icon {
    display: grid; flex: none; place-items: center; width: 2.9rem; height: 2.9rem; border-radius: 0.95rem;
    color: var(--gold-foreground); background: var(--gradient-gold);
  }
  .fas-modal__icon svg { width: 1.35rem; height: 1.35rem; }
  .fas-modal__cat { padding: 0.28rem 0.8rem; border-radius: 999px; font-size: 0.72rem; font-weight: 700; color: var(--primary); background: var(--accent); }
  .fas-modal__body h3 {
    margin-top: 1.25rem; font-family: var(--font-display); font-size: clamp(1.4rem, 1.1rem + 1vw, 1.85rem);
    font-weight: 800; line-height: 1.2; letter-spacing: -0.015em; color: var(--foreground);
  }
  .fas-modal__rule { display: block; width: 3.2rem; height: 4px; margin-top: 1rem; border-radius: 4px; background: var(--gradient-gold); }
  .fas-modal__body > p { margin-top: 1rem; font-size: 1rem; line-height: 1.8; color: var(--muted-foreground); white-space: pre-line; }

  .fas-modal__nav {
    display: flex; align-items: center; justify-content: space-between; gap: 0.75rem; margin-top: auto; padding-top: 1.75rem;
  }
  .fas-modal__pos { flex: none; font-size: 0.75rem; font-weight: 700; letter-spacing: 0.06em; color: var(--muted-foreground); font-variant-numeric: tabular-nums; }
  .fas-nav-btn {
    display: inline-flex; min-width: 0; flex: 1; align-items: center; gap: 0.55rem; padding: 0.6rem 0.85rem; border-radius: 1rem;
    text-align: left; color: var(--primary); background: var(--secondary); border: 1px solid transparent;
    transition: background 0.3s, transform 0.3s var(--ease-out), border-color 0.3s;
  }
  .fas-nav-btn.is-next { justify-content: flex-end; text-align: right; }
  .fas-nav-btn:hover { background: var(--accent); border-color: oklch(from var(--gold) l c h / 0.5); transform: translateY(-2px); }
  .fas-nav-btn svg { flex: none; }
  .fas-nav-btn > span { min-width: 0; }
  .fas-nav-btn small { display: block; font-size: 0.65rem; font-weight: 600; color: var(--muted-foreground); }
  .fas-nav-btn b { display: block; overflow: hidden; text-overflow: ellipsis; white-space: nowrap; font-size: 0.8rem; font-weight: 700; }
  .fas-nav-btn[disabled] { visibility: hidden; }
  @media (max-width: 480px) { .fas-nav-btn b { display: none; } .fas-nav-btn { flex: none; } .fas-modal__pos { flex: 1; text-align: center; } }

  @keyframes fasFade { from { opacity: 0; } to { opacity: 1; } }
  @keyframes fasFadeOut { from { opacity: 1; } to { opacity: 0; } }
  @keyframes fasPop { from { opacity: 0; transform: translateY(28px) scale(0.94); } to { opacity: 1; transform: none; } }
  @keyframes fasPopOut { from { opacity: 1; transform: none; } to { opacity: 0; transform: translateY(16px) scale(0.97); } }

  @media (prefers-reduced-motion: reduce) {
    .fas-card::before, .fas-card__media img, .fas-card__icon, .fas-card__cta svg, .fas-ph__ring, .fas-stat,
    .fas-modal__close, .fas-nav-btn, .fas-thumb, .fas-btn-ghost { transition: none !important; }
    .fas-ph__ring::after, .fas-modal__backdrop, .fas-modal__panel { animation: none !important; }
  }
</style>

<script>
  (function () {
    var grid = document.getElementById('fasilitas-grid');
    var modal = document.querySelector('[data-fas-modal]');
    if (!grid || !modal) return;

    // Pindahkan ke <body> supaya tidak terpengaruh elemen induk (transform/overflow) di halaman.
    document.body.appendChild(modal);

    var q = function (sel) { return modal.querySelector(sel); };
    var el = {
      img: q('[data-fas-img]'), ph: q('[data-fas-ph]'), phIcon: q('[data-fas-phicon]'), thumbs: q('[data-fas-thumbs]'),
      icon: q('[data-fas-icon]'), cat: q('[data-fas-cat]'), title: q('[data-fas-title]'), desc: q('[data-fas-desc]'),
      pos: q('[data-fas-pos]'), prev: q('[data-fas-prev]'), next: q('[data-fas-next]'),
      prevName: q('[data-fas-prev-name]'), nextName: q('[data-fas-next-name]'), panel: q('.fas-modal__panel')
    };

    var list = [];
    var index = 0;
    var lastFocus = null;
    var closeTimer = null;
    var reduced = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

    // Hanya kartu yang sedang tampil (tidak disembunyikan filter kategori / pencarian).
    function visibleCards() {
      return Array.prototype.slice.call(grid.querySelectorAll('[data-fas-card]')).filter(function (c) {
        return !c.classList.contains('hidden') && !c.classList.contains('is-search-hidden');
      });
    }

    function titleOf(card) { var h = card.querySelector('h3'); return h ? h.textContent.trim() : ''; }

    function cloneSvg(from, into) {
      into.innerHTML = '';
      if (from) into.appendChild(from.cloneNode(true));
    }

    function showPhoto(photos, n) {
      if (!photos.length) {
        el.img.style.display = 'none';
        el.ph.style.display = '';
        return;
      }
      el.ph.style.display = 'none';
      el.img.style.display = '';
      el.img.classList.add('is-swap');
      var src = photos[n];
      var done = function () { el.img.classList.remove('is-swap'); };
      el.img.onload = done;
      el.img.onerror = done;
      el.img.src = src;
      if (el.img.complete) done();
      Array.prototype.forEach.call(el.thumbs.children, function (b, i) { b.classList.toggle('is-active', i === n); });
    }

    function render() {
      var card = list[index];
      if (!card) return;

      var photos = [];
      try { photos = JSON.parse(card.getAttribute('data-photos') || '[]'); } catch (e) { photos = []; }
      var name = titleOf(card);
      var desc = card.querySelector('.fas-card__body p');

      el.title.textContent = name;
      el.cat.textContent = card.getAttribute('data-category') || '';
      el.desc.textContent = desc ? desc.textContent.trim() : '';
      el.img.alt = name;
      cloneSvg(card.querySelector('.fas-card__icon svg'), el.icon);
      cloneSvg(card.querySelector('.fas-card__icon svg'), el.phIcon);

      // Thumbnail hanya muncul bila ada lebih dari satu foto
      el.thumbs.innerHTML = '';
      if (photos.length > 1) {
        photos.forEach(function (src, i) {
          var b = document.createElement('button');
          b.type = 'button';
          b.className = 'fas-thumb';
          b.setAttribute('aria-label', 'Foto ' + (i + 1));
          var im = document.createElement('img');
          im.src = src; im.alt = '';
          b.appendChild(im);
          b.addEventListener('click', function () { showPhoto(photos, i); });
          el.thumbs.appendChild(b);
        });
      }
      showPhoto(photos, 0);

      el.pos.textContent = (index + 1) + ' / ' + list.length;
      var many = list.length > 1;
      el.prev.disabled = !many;
      el.next.disabled = !many;
      if (many) {
        el.prevName.textContent = titleOf(list[(index - 1 + list.length) % list.length]);
        el.nextName.textContent = titleOf(list[(index + 1) % list.length]);
      }
    }

    function go(d) {
      if (list.length < 2) return;
      index = (index + d + list.length) % list.length;
      render();
    }

    function open(card) {
      clearTimeout(closeTimer);
      modal.classList.remove('is-closing');
      list = visibleCards();
      index = Math.max(0, list.indexOf(card));
      if (!list.length) { list = [card]; index = 0; }
      lastFocus = document.activeElement;
      render();
      modal.classList.add('is-open');
      modal.setAttribute('aria-hidden', 'false');
      document.documentElement.style.overflow = 'hidden';
      var closeBtn = q('.fas-modal__close');
      if (closeBtn) closeBtn.focus({ preventScroll: true });
    }

    function close() {
      if (!modal.classList.contains('is-open') || modal.classList.contains('is-closing')) return;
      var finish = function () {
        modal.classList.remove('is-open', 'is-closing');
        modal.setAttribute('aria-hidden', 'true');
        document.documentElement.style.overflow = '';
        if (lastFocus && lastFocus.focus) lastFocus.focus({ preventScroll: true });
      };
      if (reduced) { finish(); return; }
      modal.classList.add('is-closing');
      closeTimer = setTimeout(finish, 230);
    }

    grid.addEventListener('click', function (e) {
      var hit = e.target instanceof Element ? e.target.closest('[data-fas-open]') : null;
      if (!hit) return;
      var card = hit.closest('[data-fas-card]');
      if (card) open(card);
    });

    modal.addEventListener('click', function (e) {
      if (e.target instanceof Element && e.target.closest('[data-fas-close]')) close();
    });
    el.prev.addEventListener('click', function () { go(-1); });
    el.next.addEventListener('click', function () { go(1); });

    document.addEventListener('keydown', function (e) {
      if (!modal.classList.contains('is-open')) return;
      if (e.key === 'Escape') { close(); return; }
      if (e.key === 'ArrowLeft') { go(-1); return; }
      if (e.key === 'ArrowRight') { go(1); return; }
      if (e.key === 'Tab') {
        // Fokus keyboard tetap berputar di dalam jendela
        var f = Array.prototype.slice.call(modal.querySelectorAll('button:not([disabled])'));
        if (!f.length) return;
        var first = f[0], last = f[f.length - 1];
        if (e.shiftKey && document.activeElement === first) { e.preventDefault(); last.focus(); }
        else if (!e.shiftKey && document.activeElement === last) { e.preventDefault(); first.focus(); }
      }
    });

    // Geser jari kiri/kanan untuk pindah fasilitas
    var sx = null, sy = null;
    el.panel.addEventListener('touchstart', function (e) { sx = e.touches[0].clientX; sy = e.touches[0].clientY; }, { passive: true });
    el.panel.addEventListener('touchend', function (e) {
      if (sx === null) return;
      var dx = e.changedTouches[0].clientX - sx;
      var dy = e.changedTouches[0].clientY - sy;
      sx = null; sy = null;
      if (Math.abs(dx) > 60 && Math.abs(dx) > Math.abs(dy) * 1.5) go(dx < 0 ? 1 : -1);
    }, { passive: true });
  })();
</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\rizki\Pictures\INFOKOM-REACT\Laravel\smk-infokom\resources\views/pages/fasilitas.blade.php ENDPATH**/ ?>