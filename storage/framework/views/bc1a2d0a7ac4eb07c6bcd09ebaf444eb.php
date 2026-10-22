<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames((['kicker' => null, 'title', 'desc' => null, 'crumb' => null, 'accent' => null, 'parent' => null]));

foreach ($attributes->all() as $__key => $__value) {
    if (in_array($__key, $__propNames)) {
        $$__key = $$__key ?? $__value;
    } else {
        $__newAttributes[$__key] = $__value;
    }
}

$attributes = new \Illuminate\View\ComponentAttributeBag($__newAttributes);

unset($__propNames);
unset($__newAttributes);

foreach (array_filter((['kicker' => null, 'title', 'desc' => null, 'crumb' => null, 'accent' => null, 'parent' => null]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<?php
  $arcs = [[80, 125.66], [140, 219.91], [200, 314.16], [260, 408.41]];
  $arcAlpha = $accent ? 1 : 0.8; // emas dibuat sedikit lebih lembut daripada warna jurusan
?>
<section class="page-hero hero-inner relative overflow-hidden bg-navy-radial text-hero-foreground">
  <div class="pointer-events-none absolute inset-0 bg-grain"></div>
  <span class="bg-orb float-y -left-16 -top-16 h-64 w-64 bg-gold/20"></span>
  <?php if($accent): ?>
    <span class="bg-orb" style="right:8%; bottom:-6rem; width:22rem; height:22rem; background: <?php echo e($accent); ?>; opacity:.22;"></span>
  <?php endif; ?>
  <div class="hud-grid"></div>
  <canvas data-particles aria-hidden="true"></canvas>

  <svg class="hero-arcs" viewBox="0 0 400 400" aria-hidden="true" <?php if($accent): ?> style="--arc: <?php echo e($accent); ?>" <?php endif; ?>>
    <?php $__currentLoopData = $arcs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => [$r, $len]): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
      <path d="M <?php echo e(400 - $r); ?> 400 A <?php echo e($r); ?> <?php echo e($r); ?> 0 0 1 400 <?php echo e(400 - $r); ?>"
            opacity="<?php echo e(number_format($arcAlpha * (1 - $k * 0.2), 2)); ?>"
            style="--len: <?php echo e($len); ?>; --k: <?php echo e($k); ?>;" />
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
  </svg>

  <div class="relative mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
    <nav class="hero-crumb enter-item enter-d1" aria-label="Breadcrumb">
      <a href="<?php echo e(route('home')); ?>">Beranda</a><span aria-hidden="true">/</span><?php if($parent): ?><a href="<?php echo e($parent['to']); ?>"><?php echo e($parent['label']); ?></a><span aria-hidden="true">/</span><?php endif; ?><span aria-current="page"><?php echo e($crumb ?? \Illuminate\Support\Str::limit($title, 32)); ?></span>
    </nav>
    <?php if($kicker): ?>
      <p class="kicker kicker--light enter-item enter-d2 mt-7"><i class="accent-mark" aria-hidden="true" <?php if($accent): ?> style="background: <?php echo e($accent); ?>" <?php endif; ?>></i><?php echo e($kicker); ?></p>
    <?php endif; ?>
    <h1 data-split style="--d:.18s"><?php echo e($title); ?></h1>
    <?php if($desc): ?>
      <p class="hero-desc enter-item enter-d4"><?php echo e($desc); ?></p>
    <?php endif; ?>
  </div>

  <span class="accent-bar absolute inset-x-0 bottom-0" aria-hidden="true" <?php if($accent): ?> style="background: <?php echo e($accent); ?>" <?php endif; ?>></span>
</section>
<?php /**PATH C:\Users\rizki\Pictures\INFOKOM-REACT\Laravel\smk-infokom\resources\views/components/page-hero.blade.php ENDPATH**/ ?>