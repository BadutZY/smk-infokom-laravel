<?php $__env->startSection('title', 'Galeri'); ?>

<?php $__env->startSection('content'); ?>

<?php if (isset($component)) { $__componentOriginala9d931d4f11b4d2850df99e991db1dca = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginala9d931d4f11b4d2850df99e991db1dca = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.page-hero','data' => ['crumb' => 'Galeri','kicker' => 'Dokumentasi','title' => 'Galeri Sekolah','desc' => 'Kumpulan dokumentasi kegiatan, fasilitas, dan momen kebersamaan warga sekolah.']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('page-hero'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['crumb' => 'Galeri','kicker' => 'Dokumentasi','title' => 'Galeri Sekolah','desc' => 'Kumpulan dokumentasi kegiatan, fasilitas, dan momen kebersamaan warga sekolah.']); ?>
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
  $galleryItems = collect($site['gallery_items'])->values();
  // Tata letak "bento" (ada foto lebar & tinggi) hanya dipakai bila fotonya cukup banyak;
  // kalau sedikit, semua foto dibuat seragam supaya tidak ada ruang kosong.
  $bento = $galleryItems->count() >= 9;
?>

<section class="section-pad px-4 sm:px-6 lg:px-8">
  <div class="mx-auto max-w-6xl">

    <div class="stagger-group mx-auto mb-12 flex max-w-lg flex-wrap justify-center gap-10 text-center">
      <div class="stagger-item">
        <p class="font-display text-3xl font-extrabold text-primary sm:text-4xl">
          <span data-countup="<?php echo e($galleryItems->count()); ?>" data-suffix="+">0+</span>
        </p>
        <p class="mt-1 text-xs font-medium text-muted-foreground sm:text-sm">Foto Dokumentasi</p>
      </div>
      <div class="stagger-item">
        <p class="font-display text-3xl font-extrabold text-primary sm:text-4xl">
          <span data-countup="<?php echo e(count($categories)); ?>">0</span>
        </p>
        <p class="mt-1 text-xs font-medium text-muted-foreground sm:text-sm">Kategori Kegiatan</p>
      </div>
    </div>

    <div class="reveal flex flex-col items-center gap-5 lg:flex-row lg:justify-between">
      <div data-filter-group="#galeri-grid" class="flex flex-wrap justify-center gap-2 lg:justify-start">
        <button type="button" data-filter-btn="Semua" class="chip rounded-full bg-primary px-4 py-2 text-sm font-semibold text-primary-foreground">Semua</button>
        <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <button type="button" data-filter-btn="<?php echo e($cat); ?>" class="chip rounded-full bg-secondary px-4 py-2 text-sm font-semibold text-secondary-foreground"><?php echo e($cat); ?></button>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      </div>
      <label class="search-field w-full lg:max-w-xs">
        <span class="sr-only">Cari foto</span>
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
        <input type="search" data-search-input="#galeri-grid" placeholder="Cari judul foto..." autocomplete="off" />
      </label>
    </div>

    
    <div id="galeri-grid" data-lightbox-scope class="gallery-grid stagger-group mt-10">
      <?php $__currentLoopData = $galleryItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php
          $shape = '';
          if ($bento) { $shape = ($i % 9 === 0) ? 'is-wide' : (($i % 9 === 4) ? 'is-tall' : ''); }
        ?>
        <button type="button"
                data-filter-item data-category="<?php echo e($item['cat']); ?>" data-search="<?php echo e(mb_strtolower($item['title'].' '.$item['cat'])); ?>"
                data-lightbox-trigger="<?php echo e(\App\Support\Site::imageUrl($item['src'])); ?>"
                data-lightbox-caption="<?php echo e($item['title']); ?>"
                class="stagger-item gallery-tile group <?php echo e($shape); ?>">
          <img src="<?php echo e(\App\Support\Site::imageUrl($item['src'])); ?>" alt="<?php echo e($item['title']); ?>" loading="lazy" />
          <span class="gallery-cap"><b><?php echo e($item['title']); ?></b><span><?php echo e($item['cat']); ?></span></span>
          <span class="pointer-events-none absolute right-3 top-3 z-[2] flex h-8 w-8 items-center justify-center rounded-full bg-white/20 text-white opacity-0 backdrop-blur-sm transition-opacity duration-300 group-hover:opacity-100">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" class="h-3.5 w-3.5"><path d="M15 3h6v6"/><path d="M9 21H3v-6"/><path d="M21 3 14 10"/><path d="m3 21 7-7"/></svg>
          </span>
        </button>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>

    
    <div data-filter-empty class="mt-4 flex-col items-center gap-3 rounded-3xl border border-dashed border-border bg-secondary/40 py-14 text-center">
      <span class="mx-auto flex h-12 w-12 items-center justify-center rounded-full bg-accent text-primary"><?php if (isset($component)) { $__componentOriginalce262628e3a8d44dc38fd1f3965181bc = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalce262628e3a8d44dc38fd1f3965181bc = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.icon','data' => ['name' => 'image','class' => 'w-5 h-5']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'image','class' => 'w-5 h-5']); ?>
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
      <p class="text-sm font-medium text-muted-foreground">Tidak ada foto yang cocok dengan pilihan Anda.</p>
    </div>
  </div>
</section>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\rizki\Pictures\INFOKOM-REACT\Laravel\smk-infokom\resources\views/pages/galeri.blade.php ENDPATH**/ ?>