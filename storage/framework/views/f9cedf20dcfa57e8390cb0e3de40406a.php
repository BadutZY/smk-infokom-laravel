
<?php $__env->startSection('title', 'Prestasi Sekolah'); ?>
<?php $__env->startSection('page-title', 'Kelola Prestasi Sekolah'); ?>

<?php $__env->startSection('content'); ?>

<?php
  $tabs = ['data' => 'Data Prestasi'];
  foreach ($resources as $key => $resDef) {
      $tabs[$key] = $resDef['label'];
  }
?>

<div class="reveal mb-6 flex gap-2 overflow-x-auto pb-2">
  <?php $__currentLoopData = $tabs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tabKey => $tabLabel): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <a href="<?php echo e(route('admin.prestasi-sekolah.index', ['tab' => $tabKey])); ?>"
       class="shrink-0 rounded-full px-4 py-2 text-sm font-semibold transition-colors <?php echo e($tab === $tabKey ? 'bg-navy-gradient text-hero-foreground shadow-soft' : 'border border-border text-muted-foreground hover:text-primary'); ?>">
      <?php echo e($tabLabel); ?>

    </a>
  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>

<?php if($tab === 'data'): ?>

  <?php
    $peringkatBadge = [
      'emas' => 'bg-gold/15 text-gold-foreground border border-gold/40',
      'perak' => 'bg-slate-200 text-slate-700 border border-slate-300',
      'perunggu' => 'bg-orange-100 text-orange-700 border border-orange-200',
      'lainnya' => 'bg-secondary text-muted-foreground border border-border',
    ];
  ?>

  <div class="enter-item enter-d1 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
    <p class="text-sm text-muted-foreground">Kelola daftar prestasi siswa/tim yang tampil di halaman publik Prestasi Sekolah. Baris dengan angka <strong>Kelompok</strong> yang sama akan digabung jadi satu kartu (beserta fotonya).</p>

    <div class="flex flex-wrap items-center gap-3">
      <a href="<?php echo e(route('prestasi')); ?>" target="_blank" class="inline-flex items-center justify-center gap-2 rounded-xl border border-border bg-card px-4 py-2.5 text-sm font-semibold text-foreground shadow-soft hover:bg-secondary">
        <?php if (isset($component)) { $__componentOriginalce262628e3a8d44dc38fd1f3965181bc = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalce262628e3a8d44dc38fd1f3965181bc = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.icon','data' => ['name' => 'external-link','class' => 'w-4 h-4']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'external-link','class' => 'w-4 h-4']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalce262628e3a8d44dc38fd1f3965181bc)): ?>
<?php $attributes = $__attributesOriginalce262628e3a8d44dc38fd1f3965181bc; ?>
<?php unset($__attributesOriginalce262628e3a8d44dc38fd1f3965181bc); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalce262628e3a8d44dc38fd1f3965181bc)): ?>
<?php $component = $__componentOriginalce262628e3a8d44dc38fd1f3965181bc; ?>
<?php unset($__componentOriginalce262628e3a8d44dc38fd1f3965181bc); ?>
<?php endif; ?> Lihat Halaman
      </a>
      <a href="<?php echo e(route('admin.prestasi-sekolah.create')); ?>" class="inline-flex items-center justify-center gap-2 rounded-xl bg-navy-gradient px-5 py-2.5 text-sm font-semibold text-hero-foreground shadow-soft">
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
<?php endif; ?> Tambah Prestasi
      </a>
    </div>
  </div>

  <div class="enter-item enter-d2 mt-6 grid grid-cols-2 gap-3 sm:grid-cols-4">
    <?php
      $total = $items->count();
      $emas = $items->where('peringkat', 'emas')->count();
      $perak = $items->where('peringkat', 'perak')->count();
      $perunggu = $items->where('peringkat', 'perunggu')->count();
    ?>
    <div class="rounded-2xl border border-border bg-card p-4 text-center shadow-soft">
      <p class="font-display text-2xl font-extrabold text-primary"><?php echo e($total); ?></p>
      <p class="mt-0.5 text-xs text-muted-foreground">Total Prestasi</p>
    </div>
    <div class="rounded-2xl border border-gold/40 bg-gold/10 p-4 text-center shadow-soft">
      <p class="font-display text-2xl font-extrabold text-gold-foreground"><?php echo e($emas); ?></p>
      <p class="mt-0.5 text-xs text-muted-foreground">Medali Emas</p>
    </div>
    <div class="rounded-2xl border border-slate-300 bg-slate-100 p-4 text-center shadow-soft">
      <p class="font-display text-2xl font-extrabold text-slate-700"><?php echo e($perak); ?></p>
      <p class="mt-0.5 text-xs text-muted-foreground">Medali Perak</p>
    </div>
    <div class="rounded-2xl border border-orange-200 bg-orange-50 p-4 text-center shadow-soft">
      <p class="font-display text-2xl font-extrabold text-orange-700"><?php echo e($perunggu); ?></p>
      <p class="mt-0.5 text-xs text-muted-foreground">Medali Perunggu</p>
    </div>
  </div>

  <div class="enter-item enter-d3 mt-6 overflow-hidden rounded-2xl border border-border bg-card shadow-soft">
    <div class="overflow-x-auto">
      <table class="w-full min-w-[880px] text-left text-sm">
        <thead class="bg-secondary/60 text-xs uppercase tracking-wider text-muted-foreground">
          <tr>
            <th class="px-4 py-3.5">Klp.</th>
            <th class="px-6 py-3.5">Nama Siswa / Tim</th>
            <th class="px-6 py-3.5">Nama Kejuaraan</th>
            <th class="px-6 py-3.5">Juara</th>
            <th class="px-6 py-3.5">Kategori</th>
            <th class="px-6 py-3.5">Tahun</th>
            <th class="px-6 py-3.5 text-right">Aksi</th>
          </tr>
        </thead>
        <tbody class="divide-y divide-border">
          <?php $__empty_1 = true; $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <tr class="transition-colors hover:bg-secondary/40">
              <td class="px-4 py-3.5 text-center font-semibold text-muted-foreground"><?php echo e($item->kelompok); ?></td>
              <td class="px-6 py-3.5">
                <div class="flex items-center gap-3">
                  <?php if($item->foto): ?>
                    <img src="<?php echo e($item->fotoUrl()); ?>" alt="" loading="lazy" class="h-9 w-9 shrink-0 rounded-lg border border-border object-cover" style="object-position:50% 22%;" />
                  <?php else: ?>
                    <span class="flex h-9 w-9 shrink-0 items-center justify-center rounded-lg bg-navy-gradient text-hero-foreground">
                      <?php if (isset($component)) { $__componentOriginalce262628e3a8d44dc38fd1f3965181bc = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalce262628e3a8d44dc38fd1f3965181bc = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.icon','data' => ['name' => $item->kategoriIcon(),'class' => 'w-4 h-4']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($item->kategoriIcon()),'class' => 'w-4 h-4']); ?>
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
                  <?php endif; ?>
                  <p class="font-medium leading-snug text-foreground"><?php echo e($item->nama_siswa); ?></p>
                </div>
              </td>
              <td class="px-6 py-3.5 max-w-xs text-muted-foreground"><?php echo e($item->nama_kejuaraan); ?></td>
              <td class="px-6 py-3.5">
                <span class="inline-flex items-center gap-1.5 whitespace-nowrap rounded-full px-2.5 py-1 text-xs font-semibold <?php echo e($peringkatBadge[$item->peringkat] ?? $peringkatBadge['lainnya']); ?>">
                  <?php if (isset($component)) { $__componentOriginalce262628e3a8d44dc38fd1f3965181bc = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalce262628e3a8d44dc38fd1f3965181bc = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.icon','data' => ['name' => $item->peringkatIcon(),'class' => 'w-3.5 h-3.5']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($item->peringkatIcon()),'class' => 'w-3.5 h-3.5']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalce262628e3a8d44dc38fd1f3965181bc)): ?>
<?php $attributes = $__attributesOriginalce262628e3a8d44dc38fd1f3965181bc; ?>
<?php unset($__attributesOriginalce262628e3a8d44dc38fd1f3965181bc); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalce262628e3a8d44dc38fd1f3965181bc)): ?>
<?php $component = $__componentOriginalce262628e3a8d44dc38fd1f3965181bc; ?>
<?php unset($__componentOriginalce262628e3a8d44dc38fd1f3965181bc); ?>
<?php endif; ?><?php echo e($item->juara); ?>

                </span>
                <?php if($item->tingkat): ?> <p class="mt-1 text-xs text-muted-foreground"><?php echo e($item->tingkat); ?></p> <?php endif; ?>
              </td>
              <td class="px-6 py-3.5 text-muted-foreground"><?php echo e($item->kategori ?: '-'); ?></td>
              <td class="px-6 py-3.5 text-muted-foreground"><?php echo e($item->tahun); ?></td>
              <td class="px-6 py-3.5">
                <div class="flex items-center justify-end gap-2">
                  <a href="<?php echo e(route('admin.prestasi-sekolah.edit', $item)); ?>" class="flex h-9 w-9 items-center justify-center rounded-lg border border-border text-muted-foreground hover:text-primary" title="Edit"><?php if (isset($component)) { $__componentOriginalce262628e3a8d44dc38fd1f3965181bc = $component; } ?>
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
<?php endif; ?></a>
                  <form method="POST" action="<?php echo e(route('admin.prestasi-sekolah.destroy', $item)); ?>" data-confirm="Hapus prestasi &quot;<?php echo e($item->nama_kejuaraan); ?>&quot; milik <?php echo e($item->nama_siswa); ?>?">
                    <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                    <button type="submit" class="flex h-9 w-9 items-center justify-center rounded-lg border border-border text-muted-foreground hover:border-destructive hover:text-destructive" title="Hapus"><?php if (isset($component)) { $__componentOriginalce262628e3a8d44dc38fd1f3965181bc = $component; } ?>
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
<?php endif; ?></button>
                  </form>
                </div>
              </td>
            </tr>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <tr><td colspan="7" class="px-6 py-10 text-center text-muted-foreground">Belum ada data prestasi sekolah.</td></tr>
          <?php endif; ?>
        </tbody>
      </table>
    </div>
  </div>

<?php else: ?>

  <?php $def = $resources[$tab]; ?>
  <?php echo $__env->make('admin.konten._resource-table', ['group' => 'prestasi', 'tab' => $tab, 'def' => $def, 'rows' => $rows], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

<?php endif; ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\rizki\Pictures\INFOKOM-REACT\Laravel\smk-infokom\resources\views/admin/prestasi-sekolah/index.blade.php ENDPATH**/ ?>