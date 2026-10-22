
<?php $__env->startSection('title', 'BKK'); ?>
<?php $__env->startSection('page-title', 'Kelola BKK (Bursa Kerja Khusus)'); ?>

<?php $__env->startSection('content'); ?>

<?php
  $tabs = ['data' => 'Media BKK', 'konten' => 'Konten Umum & Instagram'];
  foreach ($resources as $key => $resDef) {
      $tabs[$key] = $resDef['label'];
  }
?>

<div class="reveal mb-6 flex gap-2 overflow-x-auto pb-2">
  <?php $__currentLoopData = $tabs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tabKey => $tabLabel): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <a href="<?php echo e(route('admin.bkk.index', ['tab' => $tabKey])); ?>"
       class="shrink-0 rounded-full px-4 py-2 text-sm font-semibold transition-colors <?php echo e($tab === $tabKey ? 'bg-navy-gradient text-hero-foreground shadow-soft' : 'border border-border text-muted-foreground hover:text-primary'); ?>">
      <?php echo e($tabLabel); ?>

    </a>
  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>

<?php if($tab === 'data'): ?>

  <div class="enter-item enter-d1 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
    <p class="text-sm text-muted-foreground">Kelola foto, video, dan info kegiatan BKK (info loker, pembekalan, penyaluran kerja) yang tampil di halaman publik pada bagian "Kegiatan & Info Terbaru BKK".</p>

    <div class="flex flex-wrap items-center gap-3">
      <a href="<?php echo e(route('bkk')); ?>" target="_blank" class="inline-flex items-center justify-center gap-2 rounded-xl border border-border bg-card px-4 py-2.5 text-sm font-semibold text-foreground shadow-soft hover:bg-secondary">
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
      <a href="<?php echo e(route('admin.bkk.create')); ?>" class="inline-flex items-center justify-center gap-2 rounded-xl bg-navy-gradient px-5 py-2.5 text-sm font-semibold text-hero-foreground shadow-soft">
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
<?php endif; ?> Tambah Media
      </a>
    </div>
  </div>

  <div class="enter-item enter-d2 mt-6 overflow-hidden rounded-2xl border border-border bg-card shadow-soft">
    <div class="overflow-x-auto">
      <table class="w-full min-w-[720px] text-left text-sm">
        <thead class="bg-secondary/60 text-xs uppercase tracking-wider text-muted-foreground">
          <tr>
            <th class="px-6 py-3.5">Judul</th>
            <th class="px-6 py-3.5">Jenis Media</th>
            <th class="px-6 py-3.5">Keterangan</th>
            <th class="px-6 py-3.5">Urutan</th>
            <th class="px-6 py-3.5 text-right">Aksi</th>
          </tr>
        </thead>
        <tbody class="divide-y divide-border">
          <?php $__empty_1 = true; $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <?php
              $thumb = $item->posterUrl();
              $icon = ['foto' => 'image', 'video_lokal' => 'video', 'youtube' => 'youtube', 'instagram' => 'instagram'][$item->jenis_media] ?? 'video';
            ?>
            <tr class="transition-colors hover:bg-secondary/40">
              <td class="px-6 py-3.5">
                <div class="flex items-center gap-3">
                  <?php if($thumb): ?>
                    <img src="<?php echo e($thumb); ?>" alt="<?php echo e($item->judul); ?>" class="h-14 w-10 shrink-0 rounded-lg object-cover" />
                  <?php else: ?>
                    <span class="flex h-14 w-10 shrink-0 items-center justify-center rounded-lg bg-navy-gradient text-hero-foreground"><?php if (isset($component)) { $__componentOriginalce262628e3a8d44dc38fd1f3965181bc = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalce262628e3a8d44dc38fd1f3965181bc = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.icon','data' => ['name' => $icon,'class' => 'w-4 h-4']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($icon),'class' => 'w-4 h-4']); ?>
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
                  <?php endif; ?>
                  <div class="leading-tight">
                    <p class="font-medium text-foreground"><?php echo e($item->judul); ?></p>
                  </div>
                </div>
              </td>
              <td class="px-6 py-3.5">
                <span class="inline-flex items-center gap-1.5 rounded-full bg-accent px-2.5 py-1 text-xs font-semibold text-primary">
                  <?php if (isset($component)) { $__componentOriginalce262628e3a8d44dc38fd1f3965181bc = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalce262628e3a8d44dc38fd1f3965181bc = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.icon','data' => ['name' => $icon,'class' => 'w-3.5 h-3.5']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($icon),'class' => 'w-3.5 h-3.5']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalce262628e3a8d44dc38fd1f3965181bc)): ?>
<?php $attributes = $__attributesOriginalce262628e3a8d44dc38fd1f3965181bc; ?>
<?php unset($__attributesOriginalce262628e3a8d44dc38fd1f3965181bc); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalce262628e3a8d44dc38fd1f3965181bc)): ?>
<?php $component = $__componentOriginalce262628e3a8d44dc38fd1f3965181bc; ?>
<?php unset($__componentOriginalce262628e3a8d44dc38fd1f3965181bc); ?>
<?php endif; ?><?php echo e($item->jenisLabel()); ?>

                </span>
              </td>
              <td class="px-6 py-3.5 text-muted-foreground">
                <?php echo e($item->keterangan ? \Illuminate\Support\Str::limit($item->keterangan, 60) : '-'); ?>

              </td>
              <td class="px-6 py-3.5 text-muted-foreground"><?php echo e($item->urutan); ?></td>
              <td class="px-6 py-3.5">
                <div class="flex items-center justify-end gap-2">
                  <a href="<?php echo e(route('admin.bkk.edit', $item)); ?>" class="flex h-9 w-9 items-center justify-center rounded-lg border border-border text-muted-foreground hover:text-primary" title="Edit"><?php if (isset($component)) { $__componentOriginalce262628e3a8d44dc38fd1f3965181bc = $component; } ?>
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
                  <form method="POST" action="<?php echo e(route('admin.bkk.destroy', $item)); ?>" data-confirm="Hapus data &quot;<?php echo e($item->judul); ?>&quot;? File foto/video yang diunggah ikut terhapus.">
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
            <tr><td colspan="5" class="px-6 py-10 text-center text-muted-foreground">Belum ada data media BKK.</td></tr>
          <?php endif; ?>
        </tbody>
      </table>
    </div>
  </div>

<?php elseif($tab === 'konten'): ?>

  <p class="enter-item enter-d1 mb-6 text-sm text-muted-foreground">Teks bagian "Apa itu BKK?" dan kartu profil Instagram (nama, handle, bio, statistik, serta tautan) pada bagian "Update Info Loker via Instagram" di halaman publik BKK.</p>

  <div class="enter-item enter-d2 rounded-2xl border border-border bg-card p-7 shadow-soft">
    <form method="POST" action="<?php echo e(route('admin.bkk.konten.update')); ?>" enctype="multipart/form-data" class="grid gap-5 sm:grid-cols-2" data-photo-picker>
      <?php echo csrf_field(); ?>
      <?php echo method_field('PUT'); ?>

      <div class="sm:col-span-2">
        <h4 class="font-display text-sm font-bold text-foreground">Apa itu BKK?</h4>
        <p class="text-xs text-muted-foreground">Tampil pada kartu ringkas di bawah hero halaman publik BKK.</p>
      </div>
      <div class="sm:col-span-2">
        <label for="apa_itu" class="text-sm font-medium text-foreground">Deskripsi BKK</label>
        <textarea name="apa_itu" id="apa_itu" rows="5" class="input-field"><?php echo e(old('apa_itu', $konten->apa_itu ?? '')); ?></textarea>
        <?php $__errorArgs = ['apa_itu'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="mt-1 text-xs text-destructive"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
      </div>

      <div class="sm:col-span-2 mt-2">
        <h4 class="font-display text-sm font-bold text-foreground">Kartu Profil Instagram</h4>
        <p class="text-xs text-muted-foreground">Tampil pada bagian "Update Info Loker via Instagram" dan tombol Instagram di bagian CTA (paling bawah halaman).</p>
      </div>
      <div class="sm:col-span-2">
        <label class="text-sm font-medium text-foreground">Foto Profil</label>
        <p class="text-xs text-muted-foreground">Foto/logo yang tampil di lingkaran avatar kartu Instagram. Disarankan bujur sangkar (1:1).</p>
        <?php if($konten->ig_foto ?? null): ?>
          <img src="<?php echo e(\App\Support\Site::imageUrl($konten->ig_foto)); ?>" alt="Foto profil BKK INFOKOM saat ini" class="mt-2 h-20 w-20 rounded-full border border-border object-cover" />
          <label class="mt-2 flex items-center gap-2 text-xs font-medium text-destructive">
            <input type="checkbox" name="hapus_ig_foto" value="1" class="accent-primary" /> Hapus foto ini (kembali ke ikon bawaan)
          </label>
        <?php endif; ?>
        <input type="file" name="ig_foto" accept="image/*" data-preview="image" class="input-field mt-2" />
        <img data-preview-target="image" alt="" class="mt-3 hidden h-20 w-20 rounded-full border border-border object-cover" />
        <p class="mt-1 text-xs text-muted-foreground">Kosongkan jika tidak ingin mengganti foto. Jika belum pernah diisi, kartu memakai ikon bawaan.</p>
        <?php $__errorArgs = ['ig_foto'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="mt-1 text-xs text-destructive"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
      </div>
      <div>
        <label for="ig_nama" class="text-sm font-medium text-foreground">Nama Akun</label>
        <input type="text" name="ig_nama" id="ig_nama" value="<?php echo e(old('ig_nama', $konten->ig_nama ?? '')); ?>" class="input-field" placeholder="BKK INFOKOM" />
        <?php $__errorArgs = ['ig_nama'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="mt-1 text-xs text-destructive"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
      </div>
      <div>
        <label for="ig_username" class="text-sm font-medium text-foreground">Username / Handle</label>
        <input type="text" name="ig_username" id="ig_username" value="<?php echo e(old('ig_username', $konten->ig_username ?? '')); ?>" class="input-field" placeholder="bkkinfokom" />
        <p class="mt-1 text-xs text-muted-foreground">Tanpa tanda &laquo;&#64;&raquo;, contoh: bkkinfokom.</p>
        <?php $__errorArgs = ['ig_username'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="mt-1 text-xs text-destructive"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
      </div>
      <div class="sm:col-span-2">
        <label for="ig_bio" class="text-sm font-medium text-foreground">Bio Singkat</label>
        <textarea name="ig_bio" id="ig_bio" rows="2" class="input-field"><?php echo e(old('ig_bio', $konten->ig_bio ?? '')); ?></textarea>
        <?php $__errorArgs = ['ig_bio'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="mt-1 text-xs text-destructive"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
      </div>
      <div class="sm:col-span-2">
        <label for="ig_url" class="text-sm font-medium text-foreground">Tautan Instagram</label>
        <input type="text" name="ig_url" id="ig_url" value="<?php echo e(old('ig_url', $konten->ig_url ?? '')); ?>" class="input-field" placeholder="https://www.instagram.com/bkkinfokom/" />
        <?php $__errorArgs = ['ig_url'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="mt-1 text-xs text-destructive"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
      </div>
      <div>
        <label for="ig_kiriman" class="text-sm font-medium text-foreground">Jumlah Kiriman</label>
        <input type="number" name="ig_kiriman" id="ig_kiriman" value="<?php echo e(old('ig_kiriman', $konten->ig_kiriman ?? 0)); ?>" class="input-field" />
        <?php $__errorArgs = ['ig_kiriman'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="mt-1 text-xs text-destructive"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
      </div>
      <div>
        <label for="ig_pengikut" class="text-sm font-medium text-foreground">Jumlah Pengikut</label>
        <input type="number" name="ig_pengikut" id="ig_pengikut" value="<?php echo e(old('ig_pengikut', $konten->ig_pengikut ?? 0)); ?>" class="input-field" />
        <?php $__errorArgs = ['ig_pengikut'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="mt-1 text-xs text-destructive"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
      </div>
      <div>
        <label for="ig_diikuti" class="text-sm font-medium text-foreground">Jumlah Diikuti</label>
        <input type="number" name="ig_diikuti" id="ig_diikuti" value="<?php echo e(old('ig_diikuti', $konten->ig_diikuti ?? 0)); ?>" class="input-field" />
        <?php $__errorArgs = ['ig_diikuti'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="mt-1 text-xs text-destructive"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
      </div>

      <div class="sm:col-span-2 mt-2 flex items-center gap-3">
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
      </div>
    </form>
  </div>

  <script>
    // Pratinjau foto profil Instagram yang baru dipilih, sebelum disimpan.
    (function () {
      var root = document.querySelector('[data-photo-picker]');
      if (!root) return;
      root.querySelectorAll('input[type="file"][data-preview]').forEach(function (input) {
        input.addEventListener('change', function () {
          var target = input.parentElement.querySelector('[data-preview-target="' + input.dataset.preview + '"]');
          if (!target) return;
          var file = input.files && input.files[0];
          if (!file) { target.classList.add('hidden'); return; }
          target.src = URL.createObjectURL(file);
          target.classList.remove('hidden');
        });
      });
    })();
  </script>

<?php else: ?>

  <?php $def = $resources[$tab]; ?>
  <?php echo $__env->make('admin.konten._resource-table', ['group' => 'bkk', 'tab' => $tab, 'def' => $def, 'rows' => $rows], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

<?php endif; ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\PunyaSaya\smk-infokom\resources\views/admin/bkk/index.blade.php ENDPATH**/ ?>