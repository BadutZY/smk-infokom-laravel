<?php $__env->startSection('title', 'Berita'); ?>

<?php $__env->startSection('content'); ?>

<?php if (isset($component)) { $__componentOriginala9d931d4f11b4d2850df99e991db1dca = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginala9d931d4f11b4d2850df99e991db1dca = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.page-hero','data' => ['crumb' => 'Berita','kicker' => 'Berita Sekolah','title' => 'Berita & Kegiatan','desc' => 'Informasi terbaru seputar kegiatan, prestasi, dan pengumuman SMK INFOKOM Kota Bogor.']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('page-hero'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['crumb' => 'Berita','kicker' => 'Berita Sekolah','title' => 'Berita & Kegiatan','desc' => 'Informasi terbaru seputar kegiatan, prestasi, dan pengumuman SMK INFOKOM Kota Bogor.']); ?>
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
  // Artikel pertama (paling baru) ditonjolkan sebagai kartu unggulan berukuran
  // besar di atas grid — sisanya tampil seperti grid biasa. Kartu unggulan ini
  // tetap ikut ter-filter oleh kategori seperti kartu lainnya.
  $featuredBerita = $beritaList->first();
  $restBerita = $featuredBerita ? $beritaList->skip(1) : $beritaList;
  $readMins = fn ($b) => max(1, (int) ceil(count(preg_split('/\s+/u', trim(strip_tags((string) $b->konten)), -1, PREG_SPLIT_NO_EMPTY)) / 200));
?>

<section class="section-pad px-4 sm:px-6 lg:px-8">
  <div class="mx-auto max-w-6xl">

    
    <div class="reveal flex flex-col items-center gap-5 lg:flex-row lg:justify-between">
      <div data-filter-group="#berita-grid" class="flex flex-wrap justify-center gap-2 lg:justify-start">
        <button type="button" data-filter-btn="Semua" class="chip rounded-full px-4 py-2 text-sm font-semibold <?php echo e($activeKategori === 'Semua' ? 'bg-primary text-primary-foreground' : 'bg-secondary text-secondary-foreground'); ?>">Semua</button>
        <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <button type="button" data-filter-btn="<?php echo e($cat); ?>" class="chip rounded-full px-4 py-2 text-sm font-semibold <?php echo e($activeKategori === $cat ? 'bg-primary text-primary-foreground' : 'bg-secondary text-secondary-foreground'); ?>"><?php echo e($cat); ?></button>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      </div>
      <label class="search-field w-full lg:max-w-xs">
        <span class="sr-only">Cari berita</span>
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
        <input type="search" data-search-input="#berita-grid" placeholder="Cari judul berita..." autocomplete="off" />
      </label>
    </div>

    <div id="berita-grid" class="stagger-group mt-10 grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
      <?php if($featuredBerita): ?>
        <a href="<?php echo e(route('berita.show', $featuredBerita->slug)); ?>"
           data-filter-item data-category="<?php echo e($featuredBerita->kategori); ?>" data-search="<?php echo e(mb_strtolower($featuredBerita->judul.' '.$featuredBerita->kategori.' '.$featuredBerita->ringkasan)); ?>"
           class="stagger-item tilt-glow card-hover group col-span-full overflow-hidden rounded-3xl border border-border bg-card shadow-lift sm:grid sm:grid-cols-[1.1fr_1fr]">
          <div class="relative aspect-[16/10] overflow-hidden sm:aspect-auto sm:min-h-[19rem]">
            <img src="<?php echo e(\App\Support\Site::imageUrl($featuredBerita->gambar_sampul)); ?>" alt="<?php echo e($featuredBerita->judul); ?>" class="absolute inset-0 h-full w-full object-cover transition-transform duration-[1200ms] ease-out group-hover:scale-105" />
            <span class="absolute left-4 top-4 inline-flex items-center gap-1.5 rounded-full bg-gold-gradient px-3 py-1 text-xs font-bold text-gold-foreground shadow-soft">
              <?php if (isset($component)) { $__componentOriginalce262628e3a8d44dc38fd1f3965181bc = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalce262628e3a8d44dc38fd1f3965181bc = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.icon','data' => ['name' => 'sparkles','class' => 'w-3 h-3']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'sparkles','class' => 'w-3 h-3']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalce262628e3a8d44dc38fd1f3965181bc)): ?>
<?php $attributes = $__attributesOriginalce262628e3a8d44dc38fd1f3965181bc; ?>
<?php unset($__attributesOriginalce262628e3a8d44dc38fd1f3965181bc); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalce262628e3a8d44dc38fd1f3965181bc)): ?>
<?php $component = $__componentOriginalce262628e3a8d44dc38fd1f3965181bc; ?>
<?php unset($__componentOriginalce262628e3a8d44dc38fd1f3965181bc); ?>
<?php endif; ?> Terbaru
            </span>
          </div>
          <div class="flex flex-col justify-center p-6 sm:p-8 lg:p-11">
            <div class="flex flex-wrap items-center gap-3">
              <span class="news-tag"><?php echo e($featuredBerita->kategori); ?></span>
              <span class="text-xs text-muted-foreground"><?php echo e(\App\Support\Site::formatTanggal($featuredBerita->tanggal)); ?></span>
            </div>
            <h3 class="mt-4 font-display text-xl font-extrabold leading-snug tracking-tight text-foreground sm:text-2xl lg:text-[1.75rem]"><?php echo e($featuredBerita->judul); ?></h3>
            <p class="mt-3 line-clamp-3 text-sm leading-relaxed text-muted-foreground"><?php echo e($featuredBerita->ringkasan); ?></p>
            <span class="mt-6 flex items-center justify-between gap-4 text-sm">
              <span class="inline-flex items-center gap-1.5 font-semibold text-primary">Baca selengkapnya <?php if (isset($component)) { $__componentOriginalce262628e3a8d44dc38fd1f3965181bc = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalce262628e3a8d44dc38fd1f3965181bc = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.icon','data' => ['name' => 'arrow-right','class' => 'w-4 h-4 transition-transform duration-300 group-hover:translate-x-1']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'arrow-right','class' => 'w-4 h-4 transition-transform duration-300 group-hover:translate-x-1']); ?>
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
              <span class="inline-flex items-center gap-1.5 text-xs text-muted-foreground"><?php if (isset($component)) { $__componentOriginalce262628e3a8d44dc38fd1f3965181bc = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalce262628e3a8d44dc38fd1f3965181bc = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.icon','data' => ['name' => 'clock','class' => 'w-3.5 h-3.5']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'clock','class' => 'w-3.5 h-3.5']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalce262628e3a8d44dc38fd1f3965181bc)): ?>
<?php $attributes = $__attributesOriginalce262628e3a8d44dc38fd1f3965181bc; ?>
<?php unset($__attributesOriginalce262628e3a8d44dc38fd1f3965181bc); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalce262628e3a8d44dc38fd1f3965181bc)): ?>
<?php $component = $__componentOriginalce262628e3a8d44dc38fd1f3965181bc; ?>
<?php unset($__componentOriginalce262628e3a8d44dc38fd1f3965181bc); ?>
<?php endif; ?><?php echo e($readMins($featuredBerita)); ?> menit baca</span>
            </span>
          </div>
        </a>
      <?php endif; ?>

      <?php $__empty_1 = true; $__currentLoopData = $restBerita; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $berita): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
        <a href="<?php echo e(route('berita.show', $berita->slug)); ?>"
           data-filter-item data-category="<?php echo e($berita->kategori); ?>" data-search="<?php echo e(mb_strtolower($berita->judul.' '.$berita->kategori.' '.$berita->ringkasan)); ?>"
           class="stagger-item news-card tilt-glow card-hover group overflow-hidden border border-border bg-card shadow-soft <?php echo e($activeKategori !== 'Semua' && $activeKategori !== $berita->kategori ? 'hidden' : ''); ?>">
          <div class="cover">
            <img src="<?php echo e(\App\Support\Site::imageUrl($berita->gambar_sampul)); ?>" alt="<?php echo e($berita->judul); ?>" loading="lazy" />
            <span class="news-tag"><?php echo e($berita->kategori); ?></span>
          </div>
          <div class="p-5">
            <p class="flex items-center gap-1.5 text-xs text-muted-foreground"><?php if (isset($component)) { $__componentOriginalce262628e3a8d44dc38fd1f3965181bc = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalce262628e3a8d44dc38fd1f3965181bc = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.icon','data' => ['name' => 'calendar-days','class' => 'w-3.5 h-3.5']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'calendar-days','class' => 'w-3.5 h-3.5']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalce262628e3a8d44dc38fd1f3965181bc)): ?>
<?php $attributes = $__attributesOriginalce262628e3a8d44dc38fd1f3965181bc; ?>
<?php unset($__attributesOriginalce262628e3a8d44dc38fd1f3965181bc); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalce262628e3a8d44dc38fd1f3965181bc)): ?>
<?php $component = $__componentOriginalce262628e3a8d44dc38fd1f3965181bc; ?>
<?php unset($__componentOriginalce262628e3a8d44dc38fd1f3965181bc); ?>
<?php endif; ?><?php echo e(\App\Support\Site::formatTanggal($berita->tanggal)); ?></p>
            <h3 class="mt-2.5 line-clamp-2 font-display text-base font-bold leading-snug text-foreground"><?php echo e($berita->judul); ?></h3>
            <p class="mt-2 line-clamp-2 text-sm leading-relaxed text-muted-foreground"><?php echo e($berita->ringkasan); ?></p>
            <span class="mt-4 flex items-center justify-between gap-3 text-sm">
              <span class="inline-flex items-center gap-1 font-semibold text-primary">Baca selengkapnya <?php if (isset($component)) { $__componentOriginalce262628e3a8d44dc38fd1f3965181bc = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalce262628e3a8d44dc38fd1f3965181bc = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.icon','data' => ['name' => 'arrow-right','class' => 'w-3.5 h-3.5 transition-transform duration-300 group-hover:translate-x-1']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'arrow-right','class' => 'w-3.5 h-3.5 transition-transform duration-300 group-hover:translate-x-1']); ?>
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
              <span class="text-xs text-muted-foreground"><?php echo e($readMins($berita)); ?> mnt</span>
            </span>
          </div>
        </a>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
        <?php if(!$featuredBerita): ?>
          <p class="col-span-full text-center text-sm text-muted-foreground">Belum ada berita yang dipublikasikan.</p>
        <?php endif; ?>
      <?php endif; ?>
    </div>

    
    <div data-filter-empty class="mt-4 flex-col items-center gap-3 rounded-3xl border border-dashed border-border bg-secondary/40 py-14 text-center">
      <span class="mx-auto flex h-12 w-12 items-center justify-center rounded-full bg-accent text-primary"><?php if (isset($component)) { $__componentOriginalce262628e3a8d44dc38fd1f3965181bc = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalce262628e3a8d44dc38fd1f3965181bc = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.icon','data' => ['name' => 'newspaper','class' => 'w-5 h-5']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'newspaper','class' => 'w-5 h-5']); ?>
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
      <p class="text-sm font-medium text-muted-foreground">Tidak ada berita yang cocok dengan pilihan Anda.</p>
    </div>
  </div>
</section>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\PunyaSaya\smk-infokom\resources\views/pages/berita-index.blade.php ENDPATH**/ ?>