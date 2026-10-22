<?php $__env->startSection('title', 'Halaman Tidak Ditemukan'); ?>

<?php ($site = $site ?? config('site')); ?>

<?php $__env->startSection('content'); ?>
<section class="relative flex min-h-[80vh] items-center justify-center overflow-hidden bg-navy-radial px-4 py-20 text-center text-hero-foreground">
  <div class="pointer-events-none absolute inset-0 bg-grain"></div>
  <div class="hud-grid"></div>
  <canvas data-particles aria-hidden="true"></canvas>
  <span class="bg-orb float-y -left-16 top-10 h-64 w-64 bg-gold/25"></span>
  <span class="bg-orb float-y h-72 w-72 bg-teal/20" style="right:-4rem; bottom:-3rem; animation-delay:1.2s;"></span>

  <div class="relative">
    <span class="enter-item enter-d1 mx-auto flex h-20 w-20 items-center justify-center rounded-3xl bg-white/10 text-gold shadow-lift">
      <?php if (isset($component)) { $__componentOriginalce262628e3a8d44dc38fd1f3965181bc = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalce262628e3a8d44dc38fd1f3965181bc = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.icon','data' => ['name' => 'search','class' => 'h-9 w-9']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'search','class' => 'h-9 w-9']); ?>
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
    <p class="enter-item enter-d2 mt-6 font-display text-7xl font-extrabold text-gradient-gold sm:text-8xl">404</p>
    <h1 class="enter-item enter-d3 mt-3 font-display text-xl font-bold sm:text-2xl">Halaman tidak ditemukan</h1>
    <p class="enter-item enter-d4 mx-auto mt-2 max-w-md text-sm text-white/70">Halaman yang Anda cari tidak tersedia atau sudah dipindahkan. Yuk, coba salah satu tautan populer di bawah ini.</p>

    <div class="enter-item enter-d5 mt-8 flex flex-wrap items-center justify-center gap-3">
      <a href="<?php echo e(route('home')); ?>" class="shine inline-flex items-center gap-2 rounded-full bg-gold-gradient px-6 py-3 text-sm font-semibold text-gold-foreground shadow-lift transition-transform hover:-translate-y-0.5">
        <?php if (isset($component)) { $__componentOriginalce262628e3a8d44dc38fd1f3965181bc = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalce262628e3a8d44dc38fd1f3965181bc = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.icon','data' => ['name' => 'home','class' => 'w-4 h-4']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'home','class' => 'w-4 h-4']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalce262628e3a8d44dc38fd1f3965181bc)): ?>
<?php $attributes = $__attributesOriginalce262628e3a8d44dc38fd1f3965181bc; ?>
<?php unset($__attributesOriginalce262628e3a8d44dc38fd1f3965181bc); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalce262628e3a8d44dc38fd1f3965181bc)): ?>
<?php $component = $__componentOriginalce262628e3a8d44dc38fd1f3965181bc; ?>
<?php unset($__componentOriginalce262628e3a8d44dc38fd1f3965181bc); ?>
<?php endif; ?> Kembali ke Beranda
      </a>
      <a href="<?php echo e(route('ppdb')); ?>" class="inline-flex items-center gap-2 rounded-full border border-white/25 px-6 py-3 text-sm font-semibold transition-colors hover:bg-white/10">
        Daftar PPDB
      </a>
      <a href="<?php echo e(route('kontak')); ?>" class="inline-flex items-center gap-2 rounded-full border border-white/25 px-6 py-3 text-sm font-semibold transition-colors hover:bg-white/10">
        Hubungi Kami
      </a>
    </div>
  </div>
</section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\PunyaSaya\smk-infokom\resources\views/errors/404.blade.php ENDPATH**/ ?>