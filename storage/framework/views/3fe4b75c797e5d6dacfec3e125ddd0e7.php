<?php $__env->startSection('title', 'Dashboard'); ?>
<?php $__env->startSection('page-title', 'Dashboard'); ?>

<?php $__env->startSection('content'); ?>

<?php
  $statCards = [
    [
      'icon' => 'newspaper',
      'iconClass' => 'bg-navy-gradient text-hero-foreground',
      'value' => $totalBerita,
      'label' => 'Total Berita',
      'tren' => $trenBerita,
    ],
    [
      'icon' => 'idcard',
      'iconClass' => 'bg-gold-gradient text-gold-foreground',
      'value' => $totalPpdb,
      'label' => 'Pendaftar PPDB',
      'tren' => $trenPpdb,
    ],
    [
      'icon' => 'message-square',
      'iconClass' => 'bg-teal text-teal-foreground',
      'value' => $totalKontak,
      'label' => 'Pesan Masuk',
      'tren' => $trenKontak,
    ],
    [
      'icon' => 'bell',
      'iconClass' => 'bg-destructive/10 text-destructive',
      'value' => $belumDibaca,
      'label' => 'Pesan Belum Dibaca',
      'tren' => null,
    ],
  ];
?>


<div class="reveal relative mb-6 overflow-hidden rounded-2xl bg-navy-radial px-6 py-7 text-hero-foreground shadow-soft sm:px-8">
  <div class="pointer-events-none absolute inset-0 bg-grain"></div>
  <span class="bg-orb h-40 w-40 bg-gold/20" style="right:-2rem; top:-2rem;"></span>
  <div class="relative flex flex-wrap items-center justify-between gap-4">
    <div>
      <p class="text-xs font-semibold uppercase tracking-widest text-gold">Selamat datang kembali</p>
      <h2 class="mt-1 font-display text-xl font-bold sm:text-2xl"><?php echo e(auth()->user()->nama_lengkap ?? 'Admin'); ?></h2>
      <p class="mt-1 text-sm text-white/70">Berikut ringkasan aktivitas website sekolah hari ini.</p>
    </div>
    <a href="<?php echo e(route('home')); ?>" target="_blank" class="inline-flex items-center gap-2 rounded-full border border-white/20 bg-white/10 px-4 py-2 text-xs font-semibold transition-colors hover:bg-white/20">
      <?php if (isset($component)) { $__componentOriginalce262628e3a8d44dc38fd1f3965181bc = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalce262628e3a8d44dc38fd1f3965181bc = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.icon','data' => ['name' => 'home','class' => 'w-3.5 h-3.5']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'home','class' => 'w-3.5 h-3.5']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalce262628e3a8d44dc38fd1f3965181bc)): ?>
<?php $attributes = $__attributesOriginalce262628e3a8d44dc38fd1f3965181bc; ?>
<?php unset($__attributesOriginalce262628e3a8d44dc38fd1f3965181bc); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalce262628e3a8d44dc38fd1f3965181bc)): ?>
<?php $component = $__componentOriginalce262628e3a8d44dc38fd1f3965181bc; ?>
<?php unset($__componentOriginalce262628e3a8d44dc38fd1f3965181bc); ?>
<?php endif; ?> Lihat Situs
    </a>
  </div>
</div>


<div class="stagger-group grid gap-4 sm:grid-cols-2 lg:grid-cols-4">
  <?php $__currentLoopData = $statCards; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $card): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <div class="stagger-item card-hover group relative overflow-hidden rounded-2xl border border-border bg-card p-5 shadow-soft">
      <span class="pointer-events-none absolute -right-6 -top-6 h-24 w-24 rounded-full bg-primary/5 transition-transform duration-500 group-hover:scale-125"></span>

      <div class="relative flex items-start justify-between gap-3">
        <span class="<?php echo \Illuminate\Support\Arr::toCssClasses([
            'flex h-12 w-12 shrink-0 items-center justify-center rounded-xl shadow-soft',
            $card['iconClass'],
            'dash-pulse' => $card['label'] === 'Pesan Belum Dibaca' && $card['value'] > 0,
        ]); ?>">
          <?php if (isset($component)) { $__componentOriginalce262628e3a8d44dc38fd1f3965181bc = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalce262628e3a8d44dc38fd1f3965181bc = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.icon','data' => ['name' => $card['icon'],'class' => 'w-5 h-5']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($card['icon']),'class' => 'w-5 h-5']); ?>
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

        <?php if($card['tren']): ?>
          <?php $arah = $card['tren']['arah']; ?>
          <span class="<?php echo \Illuminate\Support\Arr::toCssClasses([
              'inline-flex items-center gap-1 rounded-full px-2 py-1 text-[11px] font-bold',
              'bg-emerald-500/10 text-emerald-600' => $arah === 'naik',
              'bg-destructive/10 text-destructive' => $arah === 'turun',
              'bg-secondary text-muted-foreground' => $arah === 'tetap',
          ]); ?>">
            <?php if (isset($component)) { $__componentOriginalce262628e3a8d44dc38fd1f3965181bc = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalce262628e3a8d44dc38fd1f3965181bc = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.icon','data' => ['name' => $arah === 'naik' ? 'trending-up' : ($arah === 'turun' ? 'trending-down' : 'minus'),'class' => 'w-3 h-3']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($arah === 'naik' ? 'trending-up' : ($arah === 'turun' ? 'trending-down' : 'minus')),'class' => 'w-3 h-3']); ?>
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
            <?php echo e($arah === 'tetap' ? '0%' : ($arah === 'naik' ? '+' : '') . $card['tren']['persen'] . '%'); ?>

          </span>
        <?php endif; ?>
      </div>

      <div class="relative mt-4 min-w-0">
        <p class="font-display text-2xl font-extrabold leading-tight text-foreground" data-countup="<?php echo e($card['value']); ?>">0</p>
        <p class="mt-1 truncate text-xs font-semibold text-muted-foreground"><?php echo e($card['label']); ?></p>
      </div>

      <?php if($card['tren']): ?>
        <p class="relative mt-3 truncate text-[11px] text-muted-foreground">
          <span class="font-semibold text-foreground"><?php echo e($card['tren']['bulan_ini']); ?></span> baru bulan ini &middot; <?php echo e($card['tren']['bulan_lalu']); ?> bulan lalu
        </p>
      <?php else: ?>
        <p class="relative mt-3 truncate text-[11px] text-muted-foreground">Perlu ditindaklanjuti segera</p>
      <?php endif; ?>
    </div>
  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>


<div class="reveal mt-6 grid gap-5 lg:grid-cols-2">
  <div class="card-hover rounded-2xl border border-border bg-card p-5 shadow-soft">
    <div class="flex items-center justify-between">
      <div class="flex items-center gap-2.5">
        <span class="flex h-9 w-9 items-center justify-center rounded-xl bg-navy-gradient text-hero-foreground shadow-soft"><?php if (isset($component)) { $__componentOriginalce262628e3a8d44dc38fd1f3965181bc = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalce262628e3a8d44dc38fd1f3965181bc = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.icon','data' => ['name' => 'trending-up','class' => 'w-4 h-4']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'trending-up','class' => 'w-4 h-4']); ?>
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
        <div>
          <h3 class="font-display text-sm font-bold leading-tight text-foreground">Berita per Kategori</h3>
          <p class="text-[11px] text-muted-foreground">Distribusi konten yang dipublikasikan</p>
        </div>
      </div>
      <span class="shrink-0 rounded-full bg-accent px-2.5 py-1 text-[11px] font-semibold text-primary"><?php echo e($kategoriData->sum()); ?> total</span>
    </div>
    <div class="relative mt-5 h-56">
      <?php if($kategoriData->sum() > 0): ?>
        <canvas id="chartKategori"
          data-labels='<?php echo json_encode($kategoriData->keys(), 15, 512) ?>'
          data-values='<?php echo json_encode($kategoriData->values(), 15, 512) ?>'></canvas>
      <?php else: ?>
        <div class="flex h-full flex-col items-center justify-center gap-2 text-center">
          <span class="flex h-11 w-11 items-center justify-center rounded-full bg-secondary text-muted-foreground"><?php if (isset($component)) { $__componentOriginalce262628e3a8d44dc38fd1f3965181bc = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalce262628e3a8d44dc38fd1f3965181bc = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.icon','data' => ['name' => 'newspaper','class' => 'w-5 h-5']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'newspaper','class' => 'w-5 h-5']); ?>
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
          <p class="text-xs font-medium text-muted-foreground">Belum ada data berita</p>
        </div>
      <?php endif; ?>
    </div>
  </div>

  <div class="card-hover rounded-2xl border border-border bg-card p-5 shadow-soft">
    <div class="flex items-center justify-between">
      <div class="flex items-center gap-2.5">
        <span class="flex h-9 w-9 items-center justify-center rounded-xl bg-gold-gradient text-gold-foreground shadow-soft"><?php if (isset($component)) { $__componentOriginalce262628e3a8d44dc38fd1f3965181bc = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalce262628e3a8d44dc38fd1f3965181bc = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.icon','data' => ['name' => 'message-square','class' => 'w-4 h-4']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'message-square','class' => 'w-4 h-4']); ?>
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
        <div>
          <h3 class="font-display text-sm font-bold leading-tight text-foreground">Status Pesan Masuk</h3>
          <p class="text-[11px] text-muted-foreground">Perbandingan pesan terbaca &amp; belum</p>
        </div>
      </div>
      <span class="shrink-0 rounded-full bg-accent px-2.5 py-1 text-[11px] font-semibold text-primary"><?php echo e($belumDibaca + $sudahDibaca); ?> total</span>
    </div>
    <div class="relative mt-5 h-56">
      <?php if(($belumDibaca + $sudahDibaca) > 0): ?>
        <canvas id="chartStatus"
          data-labels='<?php echo json_encode(["Belum Dibaca", "Sudah Dibaca"], 512) ?>'
          data-values='<?php echo json_encode([$belumDibaca, $sudahDibaca], 512) ?>'></canvas>
        <div class="pointer-events-none absolute inset-0 flex flex-col items-center justify-center">
          <span class="font-display text-2xl font-extrabold text-foreground"><?php echo e($belumDibaca + $sudahDibaca); ?></span>
          <span class="text-[11px] font-medium text-muted-foreground">Pesan</span>
        </div>
      <?php else: ?>
        <div class="flex h-full flex-col items-center justify-center gap-2 text-center">
          <span class="flex h-11 w-11 items-center justify-center rounded-full bg-secondary text-muted-foreground"><?php if (isset($component)) { $__componentOriginalce262628e3a8d44dc38fd1f3965181bc = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalce262628e3a8d44dc38fd1f3965181bc = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.icon','data' => ['name' => 'inbox','class' => 'w-5 h-5']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'inbox','class' => 'w-5 h-5']); ?>
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
          <p class="text-xs font-medium text-muted-foreground">Belum ada pesan masuk</p>
        </div>
      <?php endif; ?>
    </div>
  </div>
</div>


<div class="reveal mt-6 rounded-2xl border border-border bg-card p-5 shadow-soft card-hover">
  <div class="flex flex-wrap items-center justify-between gap-3">
    <div class="flex items-center gap-2.5">
      <span class="flex h-9 w-9 items-center justify-center rounded-xl bg-accent text-primary shadow-soft"><?php if (isset($component)) { $__componentOriginalce262628e3a8d44dc38fd1f3965181bc = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalce262628e3a8d44dc38fd1f3965181bc = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.icon','data' => ['name' => 'activity','class' => 'w-4 h-4']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'activity','class' => 'w-4 h-4']); ?>
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
      <div>
        <h3 class="font-display text-sm font-bold leading-tight text-foreground">Aktivitas 7 Hari Terakhir</h3>
        <p class="text-[11px] text-muted-foreground">Pendaftar PPDB &amp; pesan masuk per hari</p>
      </div>
    </div>
    <div class="flex items-center gap-4 text-[11px] font-semibold text-muted-foreground">
      <span class="flex items-center gap-1.5"><span class="h-2.5 w-2.5 rounded-full bg-primary"></span> PPDB</span>
      <span class="flex items-center gap-1.5"><span class="h-2.5 w-2.5 rounded-full bg-gold"></span> Pesan Masuk</span>
    </div>
  </div>
  <div class="relative mt-5 h-64">
    <canvas id="chartAktivitas"
      data-labels='<?php echo json_encode($labelAktivitas, 15, 512) ?>'
      data-ppdb='<?php echo json_encode($ppdbHarian, 15, 512) ?>'
      data-kontak='<?php echo json_encode($kontakHarian, 15, 512) ?>'></canvas>
  </div>
</div>


<div class="reveal mt-6 grid gap-5 lg:grid-cols-2">
  <div class="overflow-hidden rounded-2xl border border-border bg-card shadow-soft card-hover">
    <div class="flex items-center justify-between border-b border-border px-5 py-3.5">
      <h3 class="font-display text-sm font-bold text-foreground">Pendaftar PPDB Terbaru</h3>
      <a href="<?php echo e(route('admin.ppdb.index')); ?>" class="inline-flex items-center gap-1 text-xs font-semibold text-primary hover:underline">Lihat semua <?php if (isset($component)) { $__componentOriginalce262628e3a8d44dc38fd1f3965181bc = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalce262628e3a8d44dc38fd1f3965181bc = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.icon','data' => ['name' => 'arrow-right','class' => 'w-3.5 h-3.5']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'arrow-right','class' => 'w-3.5 h-3.5']); ?>
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
    </div>
    <div class="divide-y divide-border">
      <?php $__empty_1 = true; $__currentLoopData = $ppdbTerbaru; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
        <div class="flex items-center gap-3 px-5 py-3 text-sm transition-colors hover:bg-secondary/50">
          <span class="flex h-9 w-9 shrink-0 items-center justify-center rounded-full bg-navy-gradient text-xs font-bold text-hero-foreground">
            <?php echo e(strtoupper(substr($p->nama, 0, 1))); ?>

          </span>
          <div class="min-w-0 flex-1">
            <p class="truncate font-medium text-foreground"><?php echo e($p->nama); ?></p>
            <p class="truncate text-xs text-muted-foreground"><?php echo e($p->pilihan1); ?> &middot; <?php echo e($p->asal_sekolah); ?></p>
          </div>
          <span class="shrink-0 text-xs text-muted-foreground"><?php echo e(\App\Support\Site::formatTanggal($p->created_at)); ?></span>
        </div>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
        <div class="flex flex-col items-center gap-2 px-5 py-8 text-center">
          <span class="flex h-11 w-11 items-center justify-center rounded-full bg-secondary text-muted-foreground"><?php if (isset($component)) { $__componentOriginalce262628e3a8d44dc38fd1f3965181bc = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalce262628e3a8d44dc38fd1f3965181bc = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.icon','data' => ['name' => 'idcard','class' => 'w-5 h-5']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'idcard','class' => 'w-5 h-5']); ?>
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
          <p class="text-sm text-muted-foreground">Belum ada pendaftar.</p>
        </div>
      <?php endif; ?>
    </div>
  </div>

  <div class="overflow-hidden rounded-2xl border border-border bg-card shadow-soft card-hover">
    <div class="flex items-center justify-between border-b border-border px-5 py-3.5">
      <h3 class="font-display text-sm font-bold text-foreground">Pesan Terbaru</h3>
      <a href="<?php echo e(route('admin.pesan.index')); ?>" class="inline-flex items-center gap-1 text-xs font-semibold text-primary hover:underline">Lihat semua <?php if (isset($component)) { $__componentOriginalce262628e3a8d44dc38fd1f3965181bc = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalce262628e3a8d44dc38fd1f3965181bc = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.icon','data' => ['name' => 'arrow-right','class' => 'w-3.5 h-3.5']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'arrow-right','class' => 'w-3.5 h-3.5']); ?>
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
    </div>
    <div class="divide-y divide-border">
      <?php $__empty_1 = true; $__currentLoopData = $kontakTerbaru; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
        <div class="flex items-center gap-3 px-5 py-3 text-sm transition-colors hover:bg-secondary/50">
          <span class="flex h-9 w-9 shrink-0 items-center justify-center rounded-full bg-gold-gradient text-xs font-bold text-gold-foreground">
            <?php echo e(strtoupper(substr($k->nama, 0, 1))); ?>

          </span>
          <div class="min-w-0 flex-1">
            <p class="truncate font-medium text-foreground"><?php echo e($k->subjek); ?></p>
            <p class="truncate text-xs text-muted-foreground"><?php echo e($k->nama); ?></p>
          </div>
          <span class="shrink-0 rounded-full px-2.5 py-1 text-[11px] font-semibold <?php echo e($k->status === 'belum_dibaca' ? 'bg-gold/20 text-gold-foreground' : 'bg-secondary text-muted-foreground'); ?>">
            <?php echo e($k->status === 'belum_dibaca' ? 'Baru' : 'Dibaca'); ?>

          </span>
        </div>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
        <div class="flex flex-col items-center gap-2 px-5 py-8 text-center">
          <span class="flex h-11 w-11 items-center justify-center rounded-full bg-secondary text-muted-foreground"><?php if (isset($component)) { $__componentOriginalce262628e3a8d44dc38fd1f3965181bc = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalce262628e3a8d44dc38fd1f3965181bc = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.icon','data' => ['name' => 'message-square','class' => 'w-5 h-5']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'message-square','class' => 'w-5 h-5']); ?>
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
          <p class="text-sm text-muted-foreground">Belum ada pesan.</p>
        </div>
      <?php endif; ?>
    </div>
  </div>
</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\rizki\Pictures\INFOKOM-REACT\Laravel\smk-infokom\resources\views/admin/dashboard.blade.php ENDPATH**/ ?>