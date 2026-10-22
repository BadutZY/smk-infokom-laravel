<header data-navbar class="sticky top-0 z-40 px-3 pt-3 sm:px-4">
  <nav class="site-nav glass relative mx-auto flex h-[68px] max-w-7xl items-center justify-between rounded-2xl border border-border/70 px-4 shadow-soft sm:px-5">
    <a href="<?php echo e(route('home')); ?>" class="group flex shrink-0 items-center gap-3">
      <span class="relative flex h-11 w-11 items-center justify-center rounded-xl bg-navy-gradient text-hero-foreground shadow-soft transition-transform duration-500 group-hover:-rotate-6 group-hover:scale-105">
        <span class="pointer-events-none absolute -inset-0.5 rounded-xl bg-gold/40 opacity-0 blur-md transition-opacity duration-300 group-hover:opacity-100"></span>
        <img src="<?php echo e(asset('images/logo.png')); ?>" alt="Logo <?php echo e($site['school']['brand_top'] ?? 'Sekolah'); ?>" class="relative">
      </span>
      <span class="leading-tight">
        <span class="block font-display text-sm font-bold tracking-wide text-primary sm:text-base"><?php echo e($site['school']['brand_top']); ?></span>
        <span class="block text-[11px] font-semibold tracking-[0.2em] text-gold sm:text-xs"><?php echo e($site['school']['brand_bottom']); ?></span>
      </span>
    </a>

    <div data-nav-track class="relative hidden items-center gap-1 rounded-full border border-border/60 bg-background/40 p-1 xl:flex">
      <?php $__currentLoopData = $site['nav_links']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $link): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php if(! empty($link['children'])): ?>
          <?php
            $active = collect($link['children'])->contains(function ($child) {
              $to = ltrim($child['to'], '/');
              return request()->is($to) || request()->is($to.'/*');
            });
          ?>
          <div class="group/nav relative">
            <button type="button"
                    class="relative flex items-center gap-1.5 rounded-full px-3 py-2 text-sm font-medium 2xl:px-4 transition-colors duration-200 <?php echo e($active ? 'bg-navy-gradient text-hero-foreground shadow-soft' : 'text-muted-foreground hover:text-primary'); ?>">
              <?php echo e($link['label']); ?>

              <?php if (isset($component)) { $__componentOriginalce262628e3a8d44dc38fd1f3965181bc = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalce262628e3a8d44dc38fd1f3965181bc = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.icon','data' => ['name' => 'chevron-down','class' => 'w-3.5 h-3.5 transition-transform duration-300 group-hover/nav:rotate-180']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'chevron-down','class' => 'w-3.5 h-3.5 transition-transform duration-300 group-hover/nav:rotate-180']); ?>
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

            
            <div class="nav-dropdown invisible absolute left-1/2 top-full z-50 w-72 -translate-x-1/2 pt-3 opacity-0 translate-y-1 group-hover/nav:visible group-hover/nav:opacity-100 group-hover/nav:translate-y-0 group-focus-within/nav:visible group-focus-within/nav:opacity-100 group-focus-within/nav:translate-y-0">
              <div class="glass overflow-hidden rounded-2xl border border-border/70 p-2 shadow-lift">
                <?php $__currentLoopData = $link['children']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $child): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <?php
                    $childTo = ltrim($child['to'], '/');
                    $childActive = request()->is($childTo) || request()->is($childTo.'/*');
                  ?>
                  <a href="<?php echo e(url($child['to'])); ?>"
                     class="flex items-center gap-3 rounded-xl px-3 py-2.5 text-sm transition-colors <?php echo e($childActive ? 'bg-accent text-primary' : 'text-foreground hover:bg-secondary'); ?>">
                    <span class="flex h-9 w-9 shrink-0 items-center justify-center rounded-lg bg-navy-gradient text-hero-foreground">
                      <?php if (isset($component)) { $__componentOriginalce262628e3a8d44dc38fd1f3965181bc = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalce262628e3a8d44dc38fd1f3965181bc = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.icon','data' => ['name' => $child['icon'] ?? 'chevron-right','class' => 'w-4 h-4']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($child['icon'] ?? 'chevron-right'),'class' => 'w-4 h-4']); ?>
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
                    <span class="leading-tight">
                      <span class="block font-semibold"><?php echo e($child['label']); ?></span>
                      <?php if(! empty($child['desc'])): ?>
                        <span class="block text-xs text-muted-foreground"><?php echo e($child['desc']); ?></span>
                      <?php endif; ?>
                    </span>
                  </a>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              </div>
            </div>
          </div>
        <?php else: ?>
          <?php
            $to = ltrim($link['to'], '/');
            $active = $to === '' ? request()->is('/') : (request()->is($to) || request()->is($to.'/*'));
          ?>
          <a href="<?php echo e($link['to'] === '/' ? route('home') : url($link['to'])); ?>"
             class="relative rounded-full px-3 py-2 text-sm font-medium 2xl:px-4 transition-colors duration-200 <?php echo e($active ? 'bg-navy-gradient text-hero-foreground shadow-soft' : 'text-muted-foreground hover:text-primary'); ?>">
            <?php echo e($link['label']); ?>

          </a>
        <?php endif; ?>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>

    <div class="hidden items-center gap-3 xl:flex">
      <a href="<?php echo e(route('ppdb')); ?>" class="shine inline-flex items-center gap-2 rounded-full bg-gold-gradient px-5 py-2.5 text-sm font-semibold text-gold-foreground shadow-soft transition-transform hover:-translate-y-0.5">
        Daftar PPDB <?php if (isset($component)) { $__componentOriginalce262628e3a8d44dc38fd1f3965181bc = $component; } ?>
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
<?php endif; ?>
      </a>
    </div>

    <button type="button" data-nav-toggle aria-expanded="false" class="flex h-10 w-10 items-center justify-center rounded-full border border-border text-primary xl:hidden">
      <?php if (isset($component)) { $__componentOriginalce262628e3a8d44dc38fd1f3965181bc = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalce262628e3a8d44dc38fd1f3965181bc = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.icon','data' => ['name' => 'menu','dataIconMenu' => true,'class' => 'w-5 h-5']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'menu','data-icon-menu' => true,'class' => 'w-5 h-5']); ?>
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
      <?php if (isset($component)) { $__componentOriginalce262628e3a8d44dc38fd1f3965181bc = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalce262628e3a8d44dc38fd1f3965181bc = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.icon','data' => ['name' => 'x','dataIconClose' => true,'class' => 'hidden w-5 h-5']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'x','data-icon-close' => true,'class' => 'hidden w-5 h-5']); ?>
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

    <span data-nav-progress class="nav-scroll-progress" aria-hidden="true"></span>
  </nav>

  <div data-nav-menu class="glass mx-auto mt-2 hidden max-w-7xl flex-col gap-1 rounded-2xl border border-border/70 p-3 shadow-soft xl:hidden">
    <?php $__currentLoopData = $site['nav_links']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $link): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
      <?php if(! empty($link['children'])): ?>
        <?php
          $active = collect($link['children'])->contains(function ($child) {
            $to = ltrim($child['to'], '/');
            return request()->is($to) || request()->is($to.'/*');
          });
        ?>
        <div data-nav-accordion class="overflow-hidden rounded-xl <?php echo e($active ? 'bg-accent/60' : ''); ?>">
          <button type="button" data-nav-accordion-toggle class="flex w-full items-center justify-between rounded-xl px-4 py-3 text-sm font-medium <?php echo e($active ? 'text-primary' : 'text-muted-foreground'); ?>">
            <?php echo e($link['label']); ?>

            <?php if (isset($component)) { $__componentOriginalce262628e3a8d44dc38fd1f3965181bc = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalce262628e3a8d44dc38fd1f3965181bc = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.icon','data' => ['name' => 'chevron-down','class' => 'w-4 h-4 transition-transform duration-300 '.e($active ? 'rotate-180' : '').'','dataNavAccordionChevron' => true]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'chevron-down','class' => 'w-4 h-4 transition-transform duration-300 '.e($active ? 'rotate-180' : '').'','data-nav-accordion-chevron' => true]); ?>
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
          <div data-nav-accordion-panel class="nav-acc-panel <?php echo e($active ? 'is-open' : ''); ?>"><div><div class="grid gap-1 px-2 pb-2">
            <?php $__currentLoopData = $link['children']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $child): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <?php
                $childTo = ltrim($child['to'], '/');
                $childActive = request()->is($childTo) || request()->is($childTo.'/*');
              ?>
              <a href="<?php echo e(url($child['to'])); ?>"
                 class="flex items-center gap-3 rounded-lg px-3 py-2.5 text-sm font-medium <?php echo e($childActive ? 'bg-navy-gradient text-hero-foreground' : 'bg-card text-foreground'); ?>">
                <?php if (isset($component)) { $__componentOriginalce262628e3a8d44dc38fd1f3965181bc = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalce262628e3a8d44dc38fd1f3965181bc = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.icon','data' => ['name' => $child['icon'] ?? 'chevron-right','class' => 'w-4 h-4']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($child['icon'] ?? 'chevron-right'),'class' => 'w-4 h-4']); ?>
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
                <?php echo e($child['label']); ?>

              </a>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </div></div></div>
        </div>
      <?php else: ?>
        <?php
          $to = ltrim($link['to'], '/');
          $active = $to === '' ? request()->is('/') : (request()->is($to) || request()->is($to.'/*'));
        ?>
        <a href="<?php echo e($link['to'] === '/' ? route('home') : url($link['to'])); ?>"
           class="rounded-xl px-4 py-3 text-sm font-medium <?php echo e($active ? 'bg-navy-gradient text-hero-foreground' : 'text-muted-foreground'); ?>">
          <?php echo e($link['label']); ?>

        </a>
      <?php endif; ?>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <a href="<?php echo e(route('ppdb')); ?>" class="mt-1 inline-flex items-center justify-center gap-2 rounded-xl bg-gold-gradient px-4 py-3 text-sm font-semibold text-gold-foreground">
      Daftar PPDB <?php if (isset($component)) { $__componentOriginalce262628e3a8d44dc38fd1f3965181bc = $component; } ?>
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
<?php endif; ?>
    </a>
  </div>
</header><?php /**PATH C:\PunyaSaya\smk-infokom\resources\views/partials/navbar.blade.php ENDPATH**/ ?>