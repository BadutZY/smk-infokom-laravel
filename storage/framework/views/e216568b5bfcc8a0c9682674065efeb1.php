<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames((['kicker' => null, 'title', 'desc' => null, 'center' => true, 'light' => false]));

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

foreach (array_filter((['kicker' => null, 'title', 'desc' => null, 'center' => true, 'light' => false]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<div <?php echo e($attributes->class(['section-head', 'reveal', 'is-center' => $center, 'is-light' => $light])); ?>>
  <?php if($kicker): ?>
    <span class="kicker <?php echo e($light ? 'kicker--light' : ''); ?>"><i class="accent-mark" aria-hidden="true"></i><?php echo e($kicker); ?></span>
  <?php endif; ?>
  <h2><?php echo e($title); ?></h2>
  <?php if($desc): ?>
    <p><?php echo e($desc); ?></p>
  <?php endif; ?>
</div>
<?php /**PATH C:\Users\rizki\Pictures\INFOKOM-REACT\Laravel\smk-infokom\resources\views/components/section-title.blade.php ENDPATH**/ ?>