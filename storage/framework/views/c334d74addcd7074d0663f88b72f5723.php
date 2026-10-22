
<?php
  $model = $def['model'];
  $hasColumn = \Illuminate\Support\Facades\Schema::hasColumn((new $model)->getTable(), $name);
  $current = strtoupper((string) old($name, $item->$name ?? ''));
  $fallback = method_exists($model, 'resolveWarna')
      ? $model::resolveWarna(null, $item->kode ?? null, (int) ($item->urutan ?? 0))
      : '#2563EB';
  $shown = preg_match('/^#[0-9A-F]{6}$/', $current) ? $current : $fallback;
  $presets = array_values(array_unique(array_map('strtoupper', array_merge(
      array_values((array) config('site.jurusan_warna_default', [])),
      (array) config('site.jurusan_warna_cadangan', [])
  ))));
?>

<div data-color-field data-fallback="<?php echo e($fallback); ?>" class="color-field mt-2 grid gap-5 sm:grid-cols-[1fr_15rem] sm:items-start">
  <div class="grid gap-3">
    <div class="flex items-center gap-3">
      <label for="<?php echo e($name); ?>-picker" class="color-field-picker" title="Pilih warna">
        <input type="color" id="<?php echo e($name); ?>-picker" data-color-picker value="<?php echo e(strtolower($shown)); ?>" aria-label="Pilih warna" />
      </label>
      <input type="text" name="<?php echo e($name); ?>" id="<?php echo e($name); ?>" data-color-text value="<?php echo e($current); ?>" maxlength="7"
             placeholder="Otomatis (bawaan)" autocomplete="off" spellcheck="false"
             class="input-field !mt-0 font-mono uppercase" />
      <button type="button" data-color-reset
              class="shrink-0 rounded-xl border border-border px-3.5 py-2.5 text-xs font-semibold text-muted-foreground transition-colors hover:border-primary hover:text-primary">
        Otomatis
      </button>
    </div>

    <div class="flex flex-wrap gap-2" role="group" aria-label="Pilihan warna cepat">
      <?php $__currentLoopData = $presets; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $preset): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <button type="button" data-color-swatch="<?php echo e($preset); ?>" class="color-swatch" style="--sw: <?php echo e($preset); ?>"
                title="<?php echo e($preset); ?>" aria-label="Pakai warna <?php echo e($preset); ?>"></button>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>

    <?php if(! empty($field['hint'])): ?>
      <p class="text-xs leading-relaxed text-muted-foreground"><?php echo e($field['hint']); ?></p>
    <?php endif; ?>

    <?php if (! ($hasColumn)): ?>
      <p class="rounded-lg bg-destructive/10 px-3 py-2 text-xs leading-relaxed text-destructive">
        Kolom warna belum ada di database, jadi pilihan warna belum bisa tersimpan.
        Jalankan <code class="font-mono">php artisan migrate</code> terlebih dahulu.
      </p>
    <?php endif; ?>
  </div>

  <div>
    <p class="text-xs font-medium text-muted-foreground">Pratinjau kartu</p>
    <div data-color-preview class="major-tile-mini mt-2" style="--major: <?php echo e($shown); ?>">
      <span data-color-preview-code class="major-tile-mini__code"><?php echo e($item->kode ?? 'KODE'); ?></span>
      <span data-color-preview-name class="major-tile-mini__name"><?php echo e($item->nama ?? 'Nama jurusan'); ?></span>
    </div>
  </div>
</div>
<?php /**PATH C:\Users\rizki\Pictures\INFOKOM-REACT\Laravel\smk-infokom\resources\views/admin/konten/_color-field.blade.php ENDPATH**/ ?>