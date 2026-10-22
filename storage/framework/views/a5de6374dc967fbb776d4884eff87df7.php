
<?php $__env->startSection('title', 'Akademik'); ?>
<?php $__env->startSection('page-title', 'Kelola Konten Akademik'); ?>

<?php $__env->startSection('content'); ?>

<p class="enter-item enter-d1 mb-6 text-sm text-muted-foreground"><?php echo e($groupMeta['desc']); ?></p>

<?php echo $__env->make('admin.konten._resource-panel', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\rizki\Pictures\INFOKOM-REACT\Laravel\smk-infokom\resources\views/admin/konten/akademik.blade.php ENDPATH**/ ?>