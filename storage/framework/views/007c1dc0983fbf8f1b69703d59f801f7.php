

<?php $itemLabel = $def['item_label'] ?? $def['label']; ?>

<div class="reveal flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
  <p class="text-sm text-muted-foreground"><?php echo e($def['desc'] ?? ('Kelola data '.$itemLabel.'.')); ?></p>
  <a href="<?php echo e(route('admin.konten.create', [$group, $tab])); ?>" class="inline-flex items-center justify-center gap-2 rounded-xl bg-navy-gradient px-5 py-2.5 text-sm font-semibold text-hero-foreground shadow-soft">
    <?php if (isset($component)) { $__componentOriginalce262628e3a8d44dc38fd1f3965181bc = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalce262628e3a8d44dc38fd1f3965181bc = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.icon','data' => ['name' => 'plus','class' => 'w-4 h-4']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'plus','class' => 'w-4 h-4']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalce262628e3a8d44dc38fd1f3965181bc)): ?>
<?php $attributes = $__attributesOriginalce262628e3a8d44dc38fd1f3965181bc; ?>
<?php unset($__attributesOriginalce262628e3a8d44dc38fd1f3965181bc); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalce262628e3a8d44dc38fd1f3965181bc)): ?>
<?php $component = $__componentOriginalce262628e3a8d44dc38fd1f3965181bc; ?>
<?php unset($__componentOriginalce262628e3a8d44dc38fd1f3965181bc); ?>
<?php endif; ?> Tambah <?php echo e($itemLabel); ?>

  </a>
</div>

<div class="reveal mt-6 overflow-hidden rounded-2xl border border-border bg-card shadow-soft">
  <div class="overflow-x-auto">
    <table class="w-full min-w-[720px] text-left text-sm">
      <thead class="bg-secondary/60 text-xs uppercase tracking-wider text-muted-foreground">
        <tr>
          <th class="px-6 py-3.5">Urutan</th>
          <?php $__currentLoopData = $def['fields']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $name => $field): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <th class="px-6 py-3.5"><?php echo e($field['label']); ?></th>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          <th class="px-6 py-3.5 text-right">Aksi</th>
        </tr>
      </thead>
      <tbody class="divide-y divide-border">
        <?php $__empty_1 = true; $__currentLoopData = $rows; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
          <tr class="transition-colors hover:bg-secondary/40">
            <td class="px-6 py-3.5 text-muted-foreground"><?php echo e($item->urutan); ?></td>
            <?php $__currentLoopData = $def['fields']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $name => $field): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <td class="px-6 py-3.5">
                <?php if(($field['type'] ?? null) === 'image'): ?>
                  <?php if($item->$name): ?>
                    <img src="<?php echo e(\App\Support\Site::imageUrl($item->$name)); ?>" alt="<?php echo e($field['label']); ?>" class="h-12 w-16 rounded-lg object-cover" />
                  <?php else: ?>
                    <span class="text-muted-foreground">&mdash;</span>
                  <?php endif; ?>
                <?php elseif(($field['type'] ?? null) === 'color'): ?>
                  <?php
                    $hex = method_exists($def['model'], 'resolveWarna')
                        ? $def['model']::resolveWarna($item->$name ?? null, $item->kode ?? null, (int) $item->urutan)
                        : ($item->$name ?? '#2563EB');
                  ?>
                  <span class="inline-flex items-center gap-2">
                    <span class="h-6 w-6 rounded-full border border-border shadow-soft" style="background: <?php echo e($hex); ?>"></span>
                    <span class="font-mono text-xs text-muted-foreground"><?php echo e(! empty($item->$name) ? strtoupper($item->$name) : 'Otomatis'); ?></span>
                  </span>
                <?php elseif(($field['type'] ?? null) === 'lines'): ?>
                  <span class="text-muted-foreground"><?php echo e(\Illuminate\Support\Str::limit(implode(', ', (array) $item->$name), 60)); ?></span>
                <?php else: ?>
                  <span class="text-foreground"><?php echo e(\Illuminate\Support\Str::limit((string) $item->$name, 60)); ?></span>
                <?php endif; ?>
              </td>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <td class="px-6 py-3.5">
              <div class="flex items-center justify-end gap-2">
                <a href="<?php echo e(route('admin.konten.edit', [$group, $tab, $item->id])); ?>" class="flex h-9 w-9 items-center justify-center rounded-lg border border-border text-muted-foreground hover:text-primary" title="Edit">
                  <?php if (isset($component)) { $__componentOriginalce262628e3a8d44dc38fd1f3965181bc = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalce262628e3a8d44dc38fd1f3965181bc = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.icon','data' => ['name' => 'pencil','class' => 'w-4 h-4']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'pencil','class' => 'w-4 h-4']); ?>
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
                <form method="POST" action="<?php echo e(route('admin.konten.destroy', [$group, $tab, $item->id])); ?>" data-confirm="Hapus data ini?">
                  <?php echo csrf_field(); ?>
                  <?php echo method_field('DELETE'); ?>
                  <button type="submit" class="flex h-9 w-9 items-center justify-center rounded-lg border border-border text-muted-foreground hover:border-destructive hover:text-destructive" title="Hapus">
                    <?php if (isset($component)) { $__componentOriginalce262628e3a8d44dc38fd1f3965181bc = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalce262628e3a8d44dc38fd1f3965181bc = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.icon','data' => ['name' => 'trash','class' => 'w-4 h-4']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'trash','class' => 'w-4 h-4']); ?>
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
                </form>
              </div>
            </td>
          </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
          <tr>
            <td colspan="<?php echo e(count($def['fields']) + 2); ?>" class="px-6 py-10 text-center text-muted-foreground">
              Belum ada data <?php echo e($itemLabel); ?>.
            </td>
          </tr>
        <?php endif; ?>
      </tbody>
    </table>
  </div>
</div><?php /**PATH C:\PunyaSaya\smk-infokom\resources\views/admin/konten/_resource-table.blade.php ENDPATH**/ ?>