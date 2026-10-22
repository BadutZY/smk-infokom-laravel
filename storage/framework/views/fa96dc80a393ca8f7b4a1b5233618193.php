<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title><?php echo $__env->yieldContent('title', $site['school']['short'] ?? 'SMK INFOKOM Kota Bogor'); ?> - <?php echo e($site['school']['short'] ?? ''); ?></title>
  <meta name="description" content="<?php echo $__env->yieldContent('description', $site['school']['tagline'] ?? ''); ?>" />
  <meta name="robots" content="noindex, nofollow" />
  <link rel="icon" href="<?php echo e(asset('images/logo.png')); ?>" />

  <?php echo $__env->make('partials.head-boot', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Sora:wght@400;600;700;800&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" />

  <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>
</head>
<body class="bg-background text-foreground antialiased" data-transition="curtain">
  <?php echo $__env->make('partials.page-transition', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
  <?php echo $__env->make('partials.flash', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

  <main class="min-h-screen">
    <?php echo $__env->yieldContent('content'); ?>
  </main>
</body>
</html><?php /**PATH C:\Users\rizki\Pictures\INFOKOM-REACT\Laravel\smk-infokom\resources\views/layouts/auth.blade.php ENDPATH**/ ?>