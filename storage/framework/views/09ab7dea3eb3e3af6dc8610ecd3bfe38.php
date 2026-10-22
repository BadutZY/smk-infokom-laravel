<?php $__env->startSection('title', 'Beranda'); ?>

<?php $__env->startSection('content'); ?>


<section data-hero-slider class="home-hero relative overflow-hidden bg-navy-radial text-hero-foreground">
  <div class="pointer-events-none absolute inset-0 bg-grain"></div>
  <span class="bg-orb float-y -left-20 top-10 h-72 w-72 bg-gold/20"></span>
  <span class="bg-orb float-y h-80 w-80 bg-teal/25" style="right:-5rem; bottom:-6rem; animation-delay:1.4s;"></span>
  <div class="hud-grid"></div>
  <canvas data-particles aria-hidden="true"></canvas>

  <div class="relative min-h-[680px] sm:min-h-[720px]">
    <?php $__currentLoopData = $heroSlides; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $slide): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
      <?php $tag = $i === 0 ? 'h1' : 'h2'; ?>
      <div data-hero-slide class="absolute inset-0 flex items-center transition-opacity duration-1000 <?php echo e($i === 0 ? 'opacity-100' : 'opacity-0'); ?>">
        <div class="relative mx-auto grid w-full max-w-7xl gap-12 px-4 pb-32 pt-14 sm:px-6 lg:grid-cols-[1.05fr_1fr] lg:items-center lg:px-8">
          <div>
            <p class="kicker kicker--light enter-item enter-d1"><i class="accent-mark" aria-hidden="true"></i><?php echo e($slide['kicker']); ?></p>
            <<?php echo e($tag); ?> data-split style="--d:.15s" class="hero-title mt-5 whitespace-pre-line"><?php echo e($slide['title']); ?></<?php echo e($tag); ?>>
            <p class="enter-item enter-d3 mt-6 max-w-xl text-base text-white/75 sm:text-lg"><?php echo e($slide['desc']); ?></p>
            <div class="enter-item enter-d4 mt-9 flex flex-wrap gap-3">
              <a href="<?php echo e(route('ppdb')); ?>" class="shine inline-flex items-center gap-2 rounded-full bg-gold-gradient px-6 py-3 text-sm font-semibold text-gold-foreground shadow-lift glow-gold transition-transform hover:-translate-y-0.5">
                Daftar PPDB Sekarang <?php if (isset($component)) { $__componentOriginalce262628e3a8d44dc38fd1f3965181bc = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalce262628e3a8d44dc38fd1f3965181bc = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.icon','data' => ['name' => 'arrow-right','class' => 'w-4 h-4']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'arrow-right','class' => 'w-4 h-4']); ?>
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
              <a href="<?php echo e(route('profil')); ?>" class="inline-flex items-center gap-2 rounded-full border border-white/30 px-6 py-3 text-sm font-semibold text-white transition-colors hover:bg-white/10">
                Profil Sekolah
              </a>
            </div>
            <?php if(! empty($site['majors'])): ?>
              <div class="enter-item enter-d5 hero-chips mt-10">
                <?php $__currentLoopData = $site['majors']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $m): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <a href="<?php echo e(! empty($m['slug']) ? route('akademik.jurusan', $m['slug']) : route('akademik')); ?>" class="hero-chip" style="--c: <?php echo e($m['color']); ?>" title="<?php echo e($m['name']); ?>"><i aria-hidden="true"></i><?php echo e($m['code']); ?></a>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              </div>
            <?php endif; ?>
          </div>

          <div data-depth="10" class="enter-item enter-d3 hero-frame hidden lg:block">
            <div class="hero-frame__img ring-gradient">
              <img src="<?php echo e(\App\Support\Site::imageUrl($site['images']['hero_school'])); ?>" alt="<?php echo e($site['school']['name']); ?>" class="ken-burns h-full w-full object-cover" />
              <div class="absolute inset-0 bg-gradient-to-t from-primary/50 via-primary/5 to-transparent"></div>
            </div>
            <div class="float-card glass absolute -bottom-6 -left-8 flex items-center gap-3 rounded-2xl border border-white/15 px-5 py-4 shadow-lift">
              <span class="flex h-11 w-11 items-center justify-center rounded-xl bg-gold-gradient text-gold-foreground">
                <?php if (isset($component)) { $__componentOriginalce262628e3a8d44dc38fd1f3965181bc = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalce262628e3a8d44dc38fd1f3965181bc = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.icon','data' => ['name' => 'trophy','class' => 'w-5 h-5']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'trophy','class' => 'w-5 h-5']); ?>
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
              <div class="leading-tight">
                <p class="font-display text-lg font-extrabold text-black">Terakreditasi A</p>
                <p class="text-xs text-black/60">Standar mutu pendidikan terbaik</p>
              </div>
            </div>
            <div class="float-card glass absolute -top-6 -right-6 flex items-center gap-2 rounded-2xl border border-white/15 px-4 py-3 shadow-lift">
              <span class="flex h-9 w-9 items-center justify-center rounded-full bg-teal/90 text-teal-foreground">
                <?php if (isset($component)) { $__componentOriginalce262628e3a8d44dc38fd1f3965181bc = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalce262628e3a8d44dc38fd1f3965181bc = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.icon','data' => ['name' => 'users','class' => 'w-4 h-4']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'users','class' => 'w-4 h-4']); ?>
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
              <div class="leading-tight">
                <p class="font-display text-sm font-bold text-black">90%+ Terserap</p>
                <p class="text-[10px] text-black/70">Kerja &amp; kuliah</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
  </div>

  
  <div class="hero-bars">
    <div class="mx-auto flex max-w-7xl items-center gap-1 px-4 sm:px-6 lg:px-8">
      <?php $__currentLoopData = $heroSlides; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $slide): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <button type="button" data-hero-dot class="hero-bar <?php echo e($i === 0 ? 'is-on' : ''); ?>" aria-label="Slide <?php echo e($i + 1); ?>"><span></span></button>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
  </div>

  <span class="accent-bar absolute inset-x-0 bottom-0" aria-hidden="true"></span>
</section>


<section class="relative z-10 -mt-14 px-4 sm:px-6 lg:px-8">
  <div class="stagger-group stat-band mx-auto max-w-6xl">
    <?php $__currentLoopData = $site['stats']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $stat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
      <div class="stagger-item stat-cell">
        <span class="stat-icon"><?php if (isset($component)) { $__componentOriginalce262628e3a8d44dc38fd1f3965181bc = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalce262628e3a8d44dc38fd1f3965181bc = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.icon','data' => ['name' => $stat['icon'],'class' => 'w-5 h-5']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($stat['icon']),'class' => 'w-5 h-5']); ?>
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
        <p class="stat-value"><span data-countup="<?php echo e($stat['value']); ?>" data-suffix="<?php echo e($stat['suffix']); ?>">0<?php echo e($stat['suffix']); ?></span></p>
        <p class="stat-label"><?php echo e($stat['label']); ?></p>
      </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
  </div>
</section>


<section class="section-pad px-4 sm:px-6 lg:px-8">
  <div class="mx-auto max-w-6xl">
    <?php if (isset($component)) { $__componentOriginal6a0a1523cc2edf33c83fe20a5d1f7f78 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal6a0a1523cc2edf33c83fe20a5d1f7f78 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.section-title','data' => ['kicker' => 'Info Terkini','title' => 'Pengumuman & Agenda Sekolah','desc' => 'Ikuti perkembangan terbaru seputar kegiatan dan agenda SMK INFOKOM Kota Bogor.']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('section-title'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['kicker' => 'Info Terkini','title' => 'Pengumuman & Agenda Sekolah','desc' => 'Ikuti perkembangan terbaru seputar kegiatan dan agenda SMK INFOKOM Kota Bogor.']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal6a0a1523cc2edf33c83fe20a5d1f7f78)): ?>
<?php $attributes = $__attributesOriginal6a0a1523cc2edf33c83fe20a5d1f7f78; ?>
<?php unset($__attributesOriginal6a0a1523cc2edf33c83fe20a5d1f7f78); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal6a0a1523cc2edf33c83fe20a5d1f7f78)): ?>
<?php $component = $__componentOriginal6a0a1523cc2edf33c83fe20a5d1f7f78; ?>
<?php unset($__componentOriginal6a0a1523cc2edf33c83fe20a5d1f7f78); ?>
<?php endif; ?>

    <div class="stagger-group mt-12 grid gap-5 sm:grid-cols-2 lg:grid-cols-4">
      <?php $__currentLoopData = $site['announcements']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <article class="stagger-item agenda-card">
          <span class="flex h-11 w-11 items-center justify-center rounded-xl bg-accent text-primary">
            <?php if (isset($component)) { $__componentOriginalce262628e3a8d44dc38fd1f3965181bc = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalce262628e3a8d44dc38fd1f3965181bc = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.icon','data' => ['name' => $item['icon'],'class' => 'w-5 h-5']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($item['icon']),'class' => 'w-5 h-5']); ?>
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
          <h3 class="font-display text-base font-bold leading-snug text-foreground"><?php echo e($item['title']); ?></h3>
          <p class="text-sm leading-relaxed text-muted-foreground"><?php echo e($item['text']); ?></p>
          <span class="agenda-date"><?php if (isset($component)) { $__componentOriginalce262628e3a8d44dc38fd1f3965181bc = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalce262628e3a8d44dc38fd1f3965181bc = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.icon','data' => ['name' => 'calendar-days','class' => 'w-3.5 h-3.5']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'calendar-days','class' => 'w-3.5 h-3.5']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalce262628e3a8d44dc38fd1f3965181bc)): ?>
<?php $attributes = $__attributesOriginalce262628e3a8d44dc38fd1f3965181bc; ?>
<?php unset($__attributesOriginalce262628e3a8d44dc38fd1f3965181bc); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalce262628e3a8d44dc38fd1f3965181bc)): ?>
<?php $component = $__componentOriginalce262628e3a8d44dc38fd1f3965181bc; ?>
<?php unset($__componentOriginalce262628e3a8d44dc38fd1f3965181bc); ?>
<?php endif; ?><?php echo e($item['date']); ?></span>
        </article>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
  </div>
</section>


<section class="section-pad bg-secondary/50 px-4 sm:px-6 lg:px-8">
  <div class="mx-auto max-w-6xl">
    <div class="flex flex-wrap items-end justify-between gap-4">
      <?php if (isset($component)) { $__componentOriginal6a0a1523cc2edf33c83fe20a5d1f7f78 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal6a0a1523cc2edf33c83fe20a5d1f7f78 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.section-title','data' => ['center' => false,'kicker' => 'Kompetensi Keahlian','title' => 'Empat Jurusan Unggulan','desc' => 'Program keahlian yang dirancang selaras dengan kebutuhan dunia usaha dan dunia industri.']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('section-title'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['center' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(false),'kicker' => 'Kompetensi Keahlian','title' => 'Empat Jurusan Unggulan','desc' => 'Program keahlian yang dirancang selaras dengan kebutuhan dunia usaha dan dunia industri.']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal6a0a1523cc2edf33c83fe20a5d1f7f78)): ?>
<?php $attributes = $__attributesOriginal6a0a1523cc2edf33c83fe20a5d1f7f78; ?>
<?php unset($__attributesOriginal6a0a1523cc2edf33c83fe20a5d1f7f78); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal6a0a1523cc2edf33c83fe20a5d1f7f78)): ?>
<?php $component = $__componentOriginal6a0a1523cc2edf33c83fe20a5d1f7f78; ?>
<?php unset($__componentOriginal6a0a1523cc2edf33c83fe20a5d1f7f78); ?>
<?php endif; ?>
      <a href="<?php echo e(route('akademik')); ?>" class="reveal inline-flex items-center gap-1.5 text-sm font-semibold text-primary hover:underline">
        Lihat semua program <?php if (isset($component)) { $__componentOriginalce262628e3a8d44dc38fd1f3965181bc = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalce262628e3a8d44dc38fd1f3965181bc = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.icon','data' => ['name' => 'arrow-right','class' => 'w-4 h-4']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'arrow-right','class' => 'w-4 h-4']); ?>
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
    </div>

    
    <div class="stagger-group mt-12 grid gap-6 sm:grid-cols-2 lg:grid-cols-4">
      <?php $__currentLoopData = $site['majors']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $major): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php if (isset($component)) { $__componentOriginal00b0fb4072572e76c638e2a94bcdad11 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal00b0fb4072572e76c638e2a94bcdad11 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.major-card','data' => ['major' => $major,'class' => 'stagger-item']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('major-card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['major' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($major),'class' => 'stagger-item']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal00b0fb4072572e76c638e2a94bcdad11)): ?>
<?php $attributes = $__attributesOriginal00b0fb4072572e76c638e2a94bcdad11; ?>
<?php unset($__attributesOriginal00b0fb4072572e76c638e2a94bcdad11); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal00b0fb4072572e76c638e2a94bcdad11)): ?>
<?php $component = $__componentOriginal00b0fb4072572e76c638e2a94bcdad11; ?>
<?php unset($__componentOriginal00b0fb4072572e76c638e2a94bcdad11); ?>
<?php endif; ?>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
  </div>
</section>


<section class="section-pad px-4 sm:px-6 lg:px-8">
  <div class="mx-auto max-w-6xl">
    <div class="flex flex-wrap items-end justify-between gap-4">
      <?php if (isset($component)) { $__componentOriginal6a0a1523cc2edf33c83fe20a5d1f7f78 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal6a0a1523cc2edf33c83fe20a5d1f7f78 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.section-title','data' => ['center' => false,'kicker' => 'Berita Sekolah','title' => 'Kabar Terbaru']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('section-title'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['center' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(false),'kicker' => 'Berita Sekolah','title' => 'Kabar Terbaru']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal6a0a1523cc2edf33c83fe20a5d1f7f78)): ?>
<?php $attributes = $__attributesOriginal6a0a1523cc2edf33c83fe20a5d1f7f78; ?>
<?php unset($__attributesOriginal6a0a1523cc2edf33c83fe20a5d1f7f78); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal6a0a1523cc2edf33c83fe20a5d1f7f78)): ?>
<?php $component = $__componentOriginal6a0a1523cc2edf33c83fe20a5d1f7f78; ?>
<?php unset($__componentOriginal6a0a1523cc2edf33c83fe20a5d1f7f78); ?>
<?php endif; ?>
      <a href="<?php echo e(route('berita.index')); ?>" class="reveal inline-flex items-center gap-1.5 text-sm font-semibold text-primary hover:underline">
        Lihat semua berita <?php if (isset($component)) { $__componentOriginalce262628e3a8d44dc38fd1f3965181bc = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalce262628e3a8d44dc38fd1f3965181bc = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.icon','data' => ['name' => 'arrow-right','class' => 'w-4 h-4']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'arrow-right','class' => 'w-4 h-4']); ?>
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
    </div>

    <?php if($beritaTerbaru->isNotEmpty()): ?>
      <?php $lead = $beritaTerbaru->first(); $rest = $beritaTerbaru->skip(1); ?>
      <div class="stagger-group mt-12 grid gap-6 lg:grid-cols-5">
        <a href="<?php echo e(route('berita.show', $lead->slug)); ?>" class="stagger-item news-lead p-7 sm:p-9 lg:col-span-3">
          <img src="<?php echo e(\App\Support\Site::imageUrl($lead->gambar_sampul)); ?>" alt="" loading="lazy" />
          <span class="news-tag"><?php echo e($lead->kategori); ?></span>
          <h3 class="mt-4 max-w-xl"><?php echo e($lead->judul); ?></h3>
          <p class="mt-3 line-clamp-2 max-w-xl text-sm leading-relaxed text-white/75"><?php echo e($lead->ringkasan); ?></p>
          <span class="mt-6 flex items-center justify-between gap-4 text-sm">
            <span class="text-white/70"><?php echo e(\App\Support\Site::formatTanggal($lead->tanggal)); ?></span>
            <span class="inline-flex items-center gap-1.5 font-semibold">Baca selengkapnya <?php if (isset($component)) { $__componentOriginalce262628e3a8d44dc38fd1f3965181bc = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalce262628e3a8d44dc38fd1f3965181bc = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.icon','data' => ['name' => 'arrow-right','class' => 'w-4 h-4']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'arrow-right','class' => 'w-4 h-4']); ?>
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
          </span>
        </a>

        <div class="grid content-start gap-4 lg:col-span-2">
          <?php $__currentLoopData = $rest; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $berita): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <a href="<?php echo e(route('berita.show', $berita->slug)); ?>" class="stagger-item news-row group">
              <span class="thumb"><img src="<?php echo e(\App\Support\Site::imageUrl($berita->gambar_sampul)); ?>" alt="" loading="lazy" /></span>
              <span class="min-w-0">
                <span class="news-tag"><?php echo e($berita->kategori); ?></span>
                <span class="mt-2 line-clamp-2 block font-display text-sm font-bold leading-snug text-foreground"><?php echo e($berita->judul); ?></span>
                <span class="mt-1.5 block text-xs text-muted-foreground"><?php echo e(\App\Support\Site::formatTanggal($berita->tanggal)); ?></span>
              </span>
            </a>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
      </div>
    <?php else: ?>
      <p class="mt-10 text-center text-sm text-muted-foreground">Belum ada berita.</p>
    <?php endif; ?>
  </div>
</section>


<?php if($magangJepang->isNotEmpty()): ?>
<section class="px-4 pb-4 sm:px-6 lg:px-8">
  <div class="reveal relative mx-auto max-w-6xl overflow-hidden rounded-3xl bg-navy-radial px-6 py-12 text-hero-foreground shadow-lift sm:px-12 lg:py-14">
    <div class="pointer-events-none absolute inset-0 bg-grain"></div>
    <span class="bg-orb float-y -left-10 -top-10 h-56 w-56" style="background: oklch(0.6 0.22 25 / .35);"></span>
    <span class="bg-orb float-y h-56 w-56 bg-teal/25" style="right:-3rem; bottom:-3rem; animation-delay:1s;"></span>
    <span class="pointer-events-none absolute -right-2 -top-6 select-none text-[11rem] font-extrabold leading-none text-white/[0.05]" style="font-family:'Yu Mincho','Hiragino Mincho ProN','Noto Serif JP',serif;">日本</span>

    <div class="relative grid items-center gap-8 lg:grid-cols-[1.3fr_1fr]">
      <div>
        <span class="kicker kicker--light"><i class="accent-mark" aria-hidden="true"></i>Magang Internasional</span>
        <h2 class="mt-4 font-display text-3xl font-bold leading-tight sm:text-4xl">Alumni Kami Terbang ke <span class="text-gradient-gold">Jepang</span></h2>
        <p class="mt-3 max-w-xl text-sm text-white/75 sm:text-base"><?php echo e($totalMagang); ?> alumni sudah berangkat magang ke Negeri Sakura. Tonton momen mereka dan jadilah yang berikutnya.</p>
        <a href="<?php echo e(route('magang-jepang')); ?>" class="shine mt-7 inline-flex items-center gap-2 rounded-full bg-gold-gradient px-6 py-3 text-sm font-semibold text-gold-foreground shadow-lift glow-gold transition-transform hover:-translate-y-0.5">
          Lihat Kisah Mereka <?php if (isset($component)) { $__componentOriginalce262628e3a8d44dc38fd1f3965181bc = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalce262628e3a8d44dc38fd1f3965181bc = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.icon','data' => ['name' => 'arrow-right','class' => 'w-4 h-4']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'arrow-right','class' => 'w-4 h-4']); ?>
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
      </div>
      <div class="stagger-group grid gap-3">
        <?php $__currentLoopData = $magangJepang; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $m): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <a href="<?php echo e(route('magang-jepang')); ?>" class="stagger-item glass-dark flex items-center gap-3 rounded-2xl border border-white/15 px-4 py-3 transition-transform hover:translate-x-1">
            <span class="flex h-10 w-10 shrink-0 items-center justify-center rounded-full bg-gold-gradient font-display text-sm font-extrabold text-gold-foreground"><?php echo e($m->initials()); ?></span>
            <span class="leading-tight">
              <span class="block font-display text-sm font-bold"><?php echo e($m->nama); ?></span>
              <span class="flex items-center gap-1 text-xs text-white/70"><?php if (isset($component)) { $__componentOriginalce262628e3a8d44dc38fd1f3965181bc = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalce262628e3a8d44dc38fd1f3965181bc = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.icon','data' => ['name' => 'map-pin','class' => 'w-3 h-3 text-gold']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'map-pin','class' => 'w-3 h-3 text-gold']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalce262628e3a8d44dc38fd1f3965181bc)): ?>
<?php $attributes = $__attributesOriginalce262628e3a8d44dc38fd1f3965181bc; ?>
<?php unset($__attributesOriginalce262628e3a8d44dc38fd1f3965181bc); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalce262628e3a8d44dc38fd1f3965181bc)): ?>
<?php $component = $__componentOriginalce262628e3a8d44dc38fd1f3965181bc; ?>
<?php unset($__componentOriginalce262628e3a8d44dc38fd1f3965181bc); ?>
<?php endif; ?><?php echo e($m->kota ?: 'Jepang'); ?></span>
            </span>
            <?php if (isset($component)) { $__componentOriginalce262628e3a8d44dc38fd1f3965181bc = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalce262628e3a8d44dc38fd1f3965181bc = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.icon','data' => ['name' => 'arrow-right','class' => 'ml-auto w-4 h-4 text-white/60']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'arrow-right','class' => 'ml-auto w-4 h-4 text-white/60']); ?>
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
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      </div>
    </div>
  </div>
</section>
<?php endif; ?>


<?php
  // Kartu logo mitra (dipakai bersama untuk Kerjasama Universitas & Industri).
  // Kalau logo belum diunggah (kosong), tampilkan lencana inisial nama
  // sebagai gantinya supaya kartu tetap rapi sebelum gambar ditambahkan
  // lewat panel admin (Profil Sekolah > tab Kerjasama Universitas/Industri).
?>
<?php if(!empty($site['kerjasama_universitas'])): ?>
<section class="section-pad border-t border-border bg-secondary/50 px-4 sm:px-6 lg:px-8">
  <div class="mx-auto max-w-6xl">
    <?php if (isset($component)) { $__componentOriginal6a0a1523cc2edf33c83fe20a5d1f7f78 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal6a0a1523cc2edf33c83fe20a5d1f7f78 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.section-title','data' => ['kicker' => 'Kerja Sama Universitas','title' => 'Perguruan Tinggi & Lembaga Mitra','desc' => 'SMK INFOKOM Kota Bogor menjalin kerja sama dengan berbagai perguruan tinggi untuk penyelarasan kurikulum, kunjungan edukatif, dan jalur lanjut studi.']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('section-title'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['kicker' => 'Kerja Sama Universitas','title' => 'Perguruan Tinggi & Lembaga Mitra','desc' => 'SMK INFOKOM Kota Bogor menjalin kerja sama dengan berbagai perguruan tinggi untuk penyelarasan kurikulum, kunjungan edukatif, dan jalur lanjut studi.']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal6a0a1523cc2edf33c83fe20a5d1f7f78)): ?>
<?php $attributes = $__attributesOriginal6a0a1523cc2edf33c83fe20a5d1f7f78; ?>
<?php unset($__attributesOriginal6a0a1523cc2edf33c83fe20a5d1f7f78); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal6a0a1523cc2edf33c83fe20a5d1f7f78)): ?>
<?php $component = $__componentOriginal6a0a1523cc2edf33c83fe20a5d1f7f78; ?>
<?php unset($__componentOriginal6a0a1523cc2edf33c83fe20a5d1f7f78); ?>
<?php endif; ?>

    <div class="stagger-group mt-10 flex flex-wrap justify-center gap-7">
      <?php $__currentLoopData = $site['kerjasama_universitas']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $mitra): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="stagger-item card-hover group flex aspect-[4/3] w-44 flex-col items-center justify-center gap-2 rounded-2xl border border-border bg-card p-7 shadow-soft transition-all duration-300 hover:shadow-lift sm:w-56">
          <?php if(!empty($mitra['logo'])): ?>
            <img
              src="<?php echo e(\App\Support\Site::imageUrl($mitra['logo'])); ?>"
              alt="<?php echo e($mitra['nama']); ?>"
              class="max-h-24 w-full object-contain transition-transform duration-300 ease-out group-hover:scale-110 sm:max-h-32"
              loading="lazy"
            />
          <?php else: ?>
            <span class="flex h-16 w-16 items-center justify-center rounded-2xl bg-accent text-lg font-bold text-primary sm:h-20 sm:w-20 sm:text-xl">
              <?php echo e(\Illuminate\Support\Str::of($mitra['nama'])->explode(' ')->take(2)->map(fn ($w) => mb_substr($w, 0, 1))->implode('')); ?>

            </span>
          <?php endif; ?>
          <span class="text-center text-xs font-medium text-muted-foreground"><?php echo e($mitra['nama']); ?></span>
        </div>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
  </div>
</section>
<?php endif; ?>

<?php if(!empty($site['kerjasama_industri'])): ?>
<?php
  // Marquee tak-berhenti: daftar mitra digandakan 2x supaya saat trek
  // bergeser sejauh 50% lebar totalnya, salinan kedua persis menempati
  // posisi salinan pertama semula -> perpindahan tidak pernah terlihat
  // (loop mulus, tidak ada jeda/putus). Durasi menyesuaikan jumlah mitra
  // supaya kecepatan geser terasa konsisten walau datanya bertambah.
  $mitraIndustri = $site['kerjasama_industri'];
  $partnerMarqueeDuration = max(18, count($mitraIndustri) * 3.2);
?>
<section class="section-pad overflow-x-hidden px-4 sm:px-6 lg:px-8">

  
  <div class="partner-marquee-bleed reveal mt-10" style="--partner-marquee-duration: <?php echo e($partnerMarqueeDuration); ?>s;">
    <div class="partner-marquee">
      <div class="partner-marquee__track">
        <?php for($dup = 0; $dup < 2; $dup++): ?>
          <?php $__currentLoopData = $mitraIndustri; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $mitra): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div
              class="partner-marquee__item group flex aspect-[4/3] w-44 flex-col items-center justify-center gap-2 rounded-2xl border border-border bg-card p-6 shadow-soft sm:w-56"
              <?php if($dup === 1): ?> aria-hidden="true" <?php endif; ?>
            >
              <?php if(!empty($mitra['logo'])): ?>
                <img
                  src="<?php echo e(\App\Support\Site::imageUrl($mitra['logo'])); ?>"
                  alt="<?php echo e($mitra['nama']); ?>"
                  class="max-h-20 w-full object-contain sm:max-h-28"
                  loading="lazy"
                  draggable="false"
                />
              <?php else: ?>
                <span class="flex h-14 w-14 items-center justify-center rounded-xl bg-accent text-base font-bold text-primary sm:h-[4.5rem] sm:w-[4.5rem] sm:text-lg">
                  <?php echo e(\Illuminate\Support\Str::of($mitra['nama'])->explode(' ')->take(2)->map(fn ($w) => mb_substr($w, 0, 1))->implode('')); ?>

                </span>
              <?php endif; ?>
              <span class="text-center text-[11px] font-medium leading-snug text-muted-foreground"><?php echo e($mitra['nama']); ?></span>
            </div>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php endfor; ?>
      </div>
    </div>
  </div>
</section>

<style>
  /* ===== Partner marquee: loop tak-berhenti & full-bleed untuk "Perusahaan Mitra & Partner Kami" ===== */

  /* Membentangkan elemen selebar viewport (100vw), keluar dari batas
     kontainer manapun ia berada, lalu overflow-x-hidden di <section>
     (di atas) mencegah ini memunculkan scrollbar horizontal tambahan. */
  .partner-marquee-bleed {
    position: relative;
    left: 50%;
    right: 50%;
    width: 100vw;
    margin-left: -50vw;
    margin-right: -50vw;
  }

  .partner-marquee {
    position: relative;
    overflow: hidden;
    cursor: grab;
    /* Izinkan browser tetap menangani scroll vertikal halaman (jari geser
       ke atas/bawah), sementara geser kiri/kanan kami tangani sendiri lewat
       JS (initPartnerMarquee di app.js) tanpa bentrok dengan gesture jari. */
    touch-action: pan-y;
    -webkit-mask-image: linear-gradient(to right, transparent, black 4%, black 96%, transparent);
    mask-image: linear-gradient(to right, transparent, black 4%, black 96%, transparent);
  }

  /* Saat sedang digeser (drag) oleh mouse/jari, kursor berubah jadi
     "grabbing" dan seleksi teks/gambar dimatikan supaya geseran mulus. */
  .partner-marquee.is-dragging {
    cursor: grabbing;
    -webkit-user-select: none;
    user-select: none;
  }

  .partner-marquee__track {
    display: flex;
    width: max-content;
    gap: 1.5rem;
    padding-inline: 1.5rem;
    will-change: transform;
    /* animation CSS di bawah ini hanyalah fallback jika JavaScript tidak
       aktif. Ketika app.js berhasil jalan (initPartnerMarquee), animation
       ini akan dimatikan (animation: none) dan pergeserannya diambil-alih
       sepenuhnya oleh JS lewat transform: translateX(...) supaya trek bisa
       digeser manual (drag) dan tetap bisa lanjut looping otomatis lagi. */
    animation: partner-marquee-scroll var(--partner-marquee-duration, 24s) linear infinite;
  }

  /* Trek digandakan 2x (100% + 100%) lalu digeser -50% -> tepat kembali
     ke titik awal tanpa ada frame kosong/putus, sehingga loop terasa
     menerus selamanya. */
  @keyframes partner-marquee-scroll {
    from { transform: translateX(0); }
    to { transform: translateX(-50%); }
  }

  .partner-marquee__item {
    flex: 0 0 auto;
    /* Hanya warna & border yang berubah saat hover -> logo/kartu tetap
       diam di tempat, sama sekali tidak ada efek zoom/scale/naik-turun. */
    transition: border-color 0.3s ease, box-shadow 0.3s ease, background-color 0.3s ease;
  }

  .partner-marquee__item:hover,
  .partner-marquee__item:focus-within {
    border-color: oklch(from var(--gold) l c h / 0.55);
    box-shadow: var(--shadow-lift), 0 0 24px -8px oklch(from var(--gold) l c h / 0.25);
  }

  /* Fallback CSS: dipakai kalau JS gagal/nonaktif, animasi berhenti saat
     kursor di atas trek (perilaku dasar sebelum JS mengambil-alih). */
  .partner-marquee:hover .partner-marquee__track,
  .partner-marquee:focus-within .partner-marquee__track {
    animation-play-state: paused;
  }

  /* Pengguna yang memilih "reduce motion" di sistemnya akan melihat
     baris statis (tanpa animasi) dan salinan duplikat disembunyikan. */
  @media (prefers-reduced-motion: reduce) {
    .partner-marquee {
      cursor: default;
    }
    .partner-marquee__track {
      animation: none;
      flex-wrap: wrap;
      width: auto;
      justify-content: center;
      padding-inline: 1rem;
    }
    .partner-marquee__item[aria-hidden="true"] {
      display: none;
    }
  }
</style>
<?php endif; ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\rizki\Pictures\INFOKOM-REACT\Laravel\smk-infokom\resources\views/pages/home.blade.php ENDPATH**/ ?>