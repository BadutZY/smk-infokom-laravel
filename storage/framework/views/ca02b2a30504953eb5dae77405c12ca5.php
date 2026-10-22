
<?php $itemLabel = $def['item_label'] ?? $def['label']; ?>
<?php $backRoute = \App\Support\KontenResource::backRoute($group); ?>
<?php $__env->startSection('title', ($item ? 'Edit' : 'Tambah').' '.$itemLabel); ?>
<?php $__env->startSection('page-title', ($item ? 'Edit' : 'Tambah').' '.$itemLabel); ?>

<?php $__env->startSection('content'); ?>

<a href="<?php echo e(route($backRoute, ['tab' => $resource])); ?>" class="enter-item enter-d1 inline-flex items-center gap-1 text-sm text-muted-foreground hover:text-primary">
  <?php if (isset($component)) { $__componentOriginalce262628e3a8d44dc38fd1f3965181bc = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalce262628e3a8d44dc38fd1f3965181bc = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.icon','data' => ['name' => 'arrow-left','class' => 'w-4 h-4']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'arrow-left','class' => 'w-4 h-4']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalce262628e3a8d44dc38fd1f3965181bc)): ?>
<?php $attributes = $__attributesOriginalce262628e3a8d44dc38fd1f3965181bc; ?>
<?php unset($__attributesOriginalce262628e3a8d44dc38fd1f3965181bc); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalce262628e3a8d44dc38fd1f3965181bc)): ?>
<?php $component = $__componentOriginalce262628e3a8d44dc38fd1f3965181bc; ?>
<?php unset($__componentOriginalce262628e3a8d44dc38fd1f3965181bc); ?>
<?php endif; ?> Kembali
</a>

<div class="enter-item enter-d2 mx-auto mt-4 max-w-2xl rounded-2xl border border-border bg-card p-7 shadow-soft">
  <form method="POST"
        action="<?php echo e($item ? route('admin.konten.update', [$group, $resource, $item->id]) : route('admin.konten.store', [$group, $resource])); ?>"
        enctype="multipart/form-data" class="grid gap-5">
    <?php echo csrf_field(); ?>
    <?php if($item): ?> <?php echo method_field('PUT'); ?> <?php endif; ?>

    <div>
      <label for="urutan" class="text-sm font-medium text-foreground">Urutan Tampil</label>
      <input type="number" name="urutan" id="urutan" value="<?php echo e(old('urutan', $item->urutan ?? '')); ?>" class="input-field" placeholder="Kosongkan untuk otomatis di urutan terakhir" />
      <?php $__errorArgs = ['urutan'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="mt-1 text-xs text-destructive"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
    </div>

    <?php $__currentLoopData = $def['fields']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $name => $field): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
      <?php $type = $field['type'] ?? 'text'; ?>
      <div>
        <label for="<?php echo e($name); ?>" class="text-sm font-medium text-foreground"><?php echo e($field['label']); ?></label>

        <?php if($type === 'textarea'): ?>
          <textarea name="<?php echo e($name); ?>" id="<?php echo e($name); ?>" rows="4" class="input-field"><?php echo e(old($name, $item->$name ?? '')); ?></textarea>

        <?php elseif($type === 'lines'): ?>
          <textarea name="<?php echo e($name); ?>" id="<?php echo e($name); ?>" rows="4" class="input-field"><?php echo e(old($name, $item ? implode("\n", (array) $item->$name) : '')); ?></textarea>
          <p class="mt-1 text-xs text-muted-foreground">Satu poin per baris.</p>

        <?php elseif($type === 'number'): ?>
          <input type="number" name="<?php echo e($name); ?>" id="<?php echo e($name); ?>" value="<?php echo e(old($name, $item->$name ?? '')); ?>" class="input-field" />

        <?php elseif($type === 'color'): ?>
          <?php echo $__env->make('admin.konten._color-field', ['name' => $name, 'field' => $field, 'item' => $item, 'def' => $def], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

        <?php elseif($type === 'select'): ?>
          <?php $selected = (string) old($name, $item->$name ?? ($field['default'] ?? '')); ?>
          <select name="<?php echo e($name); ?>" id="<?php echo e($name); ?>" class="input-field">
            <?php $__currentLoopData = ($field['options'] ?? []); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $optValue => $optLabel): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <option value="<?php echo e($optValue); ?>" <?php if($selected === (string) $optValue): echo 'selected'; endif; ?>><?php echo e($optLabel); ?></option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </select>
          <?php if(! empty($field['hint'])): ?>
            <p class="mt-1 text-xs text-muted-foreground"><?php echo e($field['hint']); ?></p>
          <?php endif; ?>

        <?php elseif($type === 'image'): ?>
          <?php if($item && $item->$name): ?>
            <img src="<?php echo e(\App\Support\Site::imageUrl($item->$name)); ?>" alt="<?php echo e($field['label']); ?>" class="mt-2 mb-3 h-28 w-full max-w-xs rounded-xl object-cover" />
          <?php endif; ?>
          <input type="file" name="<?php echo e($name); ?>" id="<?php echo e($name); ?>" accept="image/*" class="input-field" />
          <?php if($item): ?>
            <p class="mt-1 text-xs text-muted-foreground">Kosongkan jika tidak ingin mengganti gambar.</p>
          <?php endif; ?>

        <?php else: ?>
          <input type="text" name="<?php echo e($name); ?>" id="<?php echo e($name); ?>" value="<?php echo e(old($name, $item->$name ?? '')); ?>" class="input-field" />
        <?php endif; ?>

        <?php $__errorArgs = [$name];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="mt-1 text-xs text-destructive"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
      </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

    <div class="mt-2 flex items-center gap-3">
      <button type="submit" class="inline-flex items-center gap-2 rounded-full bg-navy-gradient px-6 py-3 text-sm font-semibold text-hero-foreground shadow-soft">
        <?php if (isset($component)) { $__componentOriginalce262628e3a8d44dc38fd1f3965181bc = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalce262628e3a8d44dc38fd1f3965181bc = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.icon','data' => ['name' => 'check','class' => 'w-4 h-4']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'check','class' => 'w-4 h-4']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalce262628e3a8d44dc38fd1f3965181bc)): ?>
<?php $attributes = $__attributesOriginalce262628e3a8d44dc38fd1f3965181bc; ?>
<?php unset($__attributesOriginalce262628e3a8d44dc38fd1f3965181bc); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalce262628e3a8d44dc38fd1f3965181bc)): ?>
<?php $component = $__componentOriginalce262628e3a8d44dc38fd1f3965181bc; ?>
<?php unset($__componentOriginalce262628e3a8d44dc38fd1f3965181bc); ?>
<?php endif; ?> Simpan
      </button>
      <a href="<?php echo e(route($backRoute, ['tab' => $resource])); ?>" class="text-sm font-semibold text-muted-foreground hover:text-primary">Batal</a>
    </div>
  </form>
</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\PunyaSaya\smk-infokom\resources\views/admin/konten/form.blade.php ENDPATH**/ ?>