<?php $__env->startSection('title', 'Login Admin'); ?>

<?php $__env->startSection('content'); ?>

<section class="login-page relative flex min-h-screen w-full items-center justify-center overflow-hidden px-4 py-8 sm:px-6 sm:py-10 lg:px-10 lg:py-10">

  
  <div aria-hidden="true" class="login-blob login-blob-1"></div>
  <div aria-hidden="true" class="login-blob login-blob-2"></div>
  <div aria-hidden="true" class="login-blob login-blob-3"></div>
  <div aria-hidden="true" class="login-grid-overlay"></div>
  <div aria-hidden="true" class="login-noise-overlay"></div>

  <div class="login-card-wrap relative w-full max-w-[1440px]">

    
    <div aria-hidden="true" class="login-card-glow"></div>

    <div id="loginCard" class="login-card relative z-10 grid min-h-[82vh] overflow-hidden rounded-4xl border border-border bg-card shadow-lift lg:min-h-[84vh] lg:grid-cols-2">

      
      <div class="relative flex flex-col justify-center px-7 py-12 sm:px-14 sm:py-16 lg:px-16">

        <div class="enter-item enter-d2 mb-10 flex items-center gap-3">
          <span class="flex h-13 w-13 shrink-0 items-center justify-center rounded-2xl bg-navy-gradient text-hero-foreground shadow-soft">
            <img src="<?php echo e(asset('images/logo.png')); ?>" alt="Logo" class="h-7 w-7 object-contain" onerror="this.style.display='none';this.nextElementSibling.style.display='block'" />
            <?php if (isset($component)) { $__componentOriginalce262628e3a8d44dc38fd1f3965181bc = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalce262628e3a8d44dc38fd1f3965181bc = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.icon','data' => ['name' => 'school','class' => 'hidden h-6 w-6']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'school','class' => 'hidden h-6 w-6']); ?>
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
            <p class="font-display text-sm font-bold text-foreground"><?php echo e($site['school']['short'] ?? 'SMK INFOKOM'); ?></p>
            <p class="text-xs text-muted-foreground">Portal Admin Sekolah</p>
          </div>
        </div>

        <div class="enter-item enter-d2">
          <h1 class="font-display text-3xl font-extrabold tracking-tight text-foreground sm:text-5xl">Selamat Datang</h1>
          <p class="mt-3 max-w-sm text-sm leading-relaxed text-muted-foreground sm:text-base">Masuk untuk mengelola konten &amp; data <?php echo e($site['school']['short'] ?? 'sekolah'); ?>.</p>
        </div>

        <?php $__errorArgs = ['username'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
          <div class="enter-item enter-d3 mt-6 flex items-start gap-2 rounded-2xl border border-destructive/30 bg-destructive/10 px-4 py-3 text-sm text-destructive">
            <?php if (isset($component)) { $__componentOriginalce262628e3a8d44dc38fd1f3965181bc = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalce262628e3a8d44dc38fd1f3965181bc = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.icon','data' => ['name' => 'alert-circle','class' => 'mt-0.5 h-4 w-4 shrink-0']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'alert-circle','class' => 'mt-0.5 h-4 w-4 shrink-0']); ?>
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
            <span><?php echo e($message); ?></span>
          </div>
        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

        <form method="POST" action="<?php echo e(route('login.attempt')); ?>" class="mt-9 grid max-w-md gap-5">
          <?php echo csrf_field(); ?>

          <div class="enter-item enter-d3">
            <label for="username" class="text-sm font-medium text-foreground">Username</label>
            <div class="login-input-wrap mt-1.5">
              <?php if (isset($component)) { $__componentOriginalce262628e3a8d44dc38fd1f3965181bc = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalce262628e3a8d44dc38fd1f3965181bc = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.icon','data' => ['name' => 'user','class' => 'login-input-icon h-4 w-4']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'user','class' => 'login-input-icon h-4 w-4']); ?>
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
              <input
                type="text" name="username" id="username" value="<?php echo e(old('username')); ?>" autofocus
                autocomplete="username"
                class="login-input <?php $__errorArgs = ['username'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> !border-destructive <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                placeholder="Masukkan username" />
            </div>
          </div>

          <div class="enter-item enter-d4">
            <div class="flex items-center justify-between">
              <label for="password" class="text-sm font-medium text-foreground">Password</label>
              <a href="<?php echo e(route('lupa-password')); ?>" class="text-xs font-medium text-primary hover:underline">Lupa password?</a>
            </div>
            <div class="login-input-wrap mt-1.5">
              <?php if (isset($component)) { $__componentOriginalce262628e3a8d44dc38fd1f3965181bc = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalce262628e3a8d44dc38fd1f3965181bc = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.icon','data' => ['name' => 'lock','class' => 'login-input-icon h-4 w-4']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'lock','class' => 'login-input-icon h-4 w-4']); ?>
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
              <input
                type="password" name="password" id="password"
                autocomplete="current-password"
                class="login-input pr-11 <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> !border-destructive <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                placeholder="Masukkan password" />
              <button type="button" data-toggle-password="#password" class="login-input-toggle" aria-label="Tampilkan password">
                <?php if (isset($component)) { $__componentOriginalce262628e3a8d44dc38fd1f3965181bc = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalce262628e3a8d44dc38fd1f3965181bc = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.icon','data' => ['name' => 'eye','dataIconEye' => true,'class' => 'h-4 w-4']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'eye','data-icon-eye' => true,'class' => 'h-4 w-4']); ?>
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
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.icon','data' => ['name' => 'eye-off','dataIconEyeOff' => true,'class' => 'hidden h-4 w-4']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'eye-off','data-icon-eye-off' => true,'class' => 'hidden h-4 w-4']); ?>
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
            </div>
            <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="mt-1.5 text-xs text-destructive"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
          </div>

          <button type="submit" class="shine btn-premium enter-item enter-d5 group mt-3 inline-flex items-center justify-center gap-2 rounded-full bg-navy-gradient px-6 py-3.5 text-sm font-semibold text-hero-foreground shadow-lift transition-transform hover:-translate-y-0.5">
            <span class="relative z-10 inline-flex items-center gap-2">
              Masuk
              <?php if (isset($component)) { $__componentOriginalce262628e3a8d44dc38fd1f3965181bc = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalce262628e3a8d44dc38fd1f3965181bc = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.icon','data' => ['name' => 'arrow-right','class' => 'h-4 w-4 transition-transform duration-300 group-hover:translate-x-1']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'arrow-right','class' => 'h-4 w-4 transition-transform duration-300 group-hover:translate-x-1']); ?>
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
          </button>
        </form>

        <a href="<?php echo e(route('home')); ?>" class="enter-item enter-d6 mt-9 inline-flex items-center gap-1.5 text-sm font-medium text-muted-foreground transition-colors hover:text-primary">
          <?php if (isset($component)) { $__componentOriginalce262628e3a8d44dc38fd1f3965181bc = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalce262628e3a8d44dc38fd1f3965181bc = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.icon','data' => ['name' => 'arrow-left','class' => 'h-4 w-4']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'arrow-left','class' => 'h-4 w-4']); ?>
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
          Kembali ke beranda
        </a>
      </div>

      
      <div class="login-brand-panel relative hidden overflow-hidden bg-navy-gradient px-10 py-14 lg:flex lg:flex-col lg:items-center lg:justify-center lg:text-center">

        <div aria-hidden="true" class="login-brand-dotgrid"></div>
        <div aria-hidden="true" class="login-brand-glow"></div>
        <div aria-hidden="true" class="login-brand-ring login-brand-ring-1"></div>
        <div aria-hidden="true" class="login-brand-ring login-brand-ring-2"></div>

        <span aria-hidden="true" class="float-y login-brand-icon login-brand-icon-1">
          <?php if (isset($component)) { $__componentOriginalce262628e3a8d44dc38fd1f3965181bc = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalce262628e3a8d44dc38fd1f3965181bc = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.icon','data' => ['name' => 'graduation-cap','class' => 'h-5 w-5']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'graduation-cap','class' => 'h-5 w-5']); ?>
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
        <span aria-hidden="true" class="login-brand-icon login-brand-icon-2" style="animation: floatY 5.5s ease-in-out infinite 0.4s;">
          <?php if (isset($component)) { $__componentOriginalce262628e3a8d44dc38fd1f3965181bc = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalce262628e3a8d44dc38fd1f3965181bc = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.icon','data' => ['name' => 'sparkles','class' => 'h-4 w-4']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'sparkles','class' => 'h-4 w-4']); ?>
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
        <span aria-hidden="true" class="login-brand-icon login-brand-icon-3" style="animation: floatY 4s ease-in-out infinite 0.9s;">
          <?php if (isset($component)) { $__componentOriginalce262628e3a8d44dc38fd1f3965181bc = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalce262628e3a8d44dc38fd1f3965181bc = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.icon','data' => ['name' => 'shield-check','class' => 'h-4 w-4']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'shield-check','class' => 'h-4 w-4']); ?>
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

        <div class="enter-item enter-d3 relative z-10 mx-auto flex h-20 w-20 items-center justify-center rounded-3xl bg-white/10 text-hero-foreground shadow-soft backdrop-blur-sm">
          <span aria-hidden="true" class="login-brand-badge-pulse"></span>
          <?php if (isset($component)) { $__componentOriginalce262628e3a8d44dc38fd1f3965181bc = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalce262628e3a8d44dc38fd1f3965181bc = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.icon','data' => ['name' => 'school','class' => 'relative z-10 h-9 w-9']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'school','class' => 'relative z-10 h-9 w-9']); ?>
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
        </div>

        <h2 class="enter-item enter-d4 relative z-10 mt-8 font-display text-3xl font-extrabold text-hero-foreground sm:text-4xl">
          Halo, Sahabat<br class="hidden sm:block" /> INFOKOM!
        </h2>
        <p class="enter-item enter-d5 relative z-10 mt-4 max-w-sm text-sm leading-relaxed text-hero-foreground/80">
          <?php echo e($site['school']['tagline'] ?? 'Satu portal untuk mengelola berita, PPDB, galeri, dan seluruh konten website sekolah dengan mudah.'); ?>

        </p>

        <a href="<?php echo e(route('home')); ?>" class="enter-item enter-d6 relative z-10 mt-9 inline-flex items-center gap-2 rounded-full border-2 border-white/70 px-7 py-3 text-sm font-semibold tracking-wide text-hero-foreground transition-all hover:border-white hover:bg-white/10">
          Kunjungi Website
          <?php if (isset($component)) { $__componentOriginalce262628e3a8d44dc38fd1f3965181bc = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalce262628e3a8d44dc38fd1f3965181bc = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.icon','data' => ['name' => 'external-link','class' => 'h-4 w-4']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'external-link','class' => 'h-4 w-4']); ?>
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

        <div class="enter-item enter-d6 relative z-10 mt-10 flex items-center gap-6 text-hero-foreground/70">
          <div class="text-center">
            <p class="font-display text-lg font-bold text-hero-foreground">100%</p>
            <p class="text-[11px] uppercase tracking-wide">Aman</p>
          </div>
          <span class="h-8 w-px bg-white/20"></span>
          <div class="text-center">
            <p class="font-display text-lg font-bold text-hero-foreground">24/7</p>
            <p class="text-[11px] uppercase tracking-wide">Akses</p>
          </div>
          <span class="h-8 w-px bg-white/20"></span>
          <div class="text-center">
            <p class="font-display text-lg font-bold text-hero-foreground">1</p>
            <p class="text-[11px] uppercase tracking-wide">Portal</p>
          </div>
        </div>
      </div>

    </div>
  </div>
</section>


<style>
  @property --lc-angle {
    syntax: '<angle>';
    inherits: false;
    initial-value: 0deg;
  }

  .login-page {
    background:
      radial-gradient(60% 55% at 85% 15%, oklch(from var(--gold) l c h / 0.10), transparent 60%),
      radial-gradient(55% 50% at 10% 90%, oklch(from var(--primary) l c h / 0.14), transparent 60%),
      var(--color-secondary);
  }

  .login-grid-overlay {
    position: absolute;
    inset: 0;
    z-index: 0;
    opacity: 0.5;
    background-image:
      linear-gradient(oklch(from var(--foreground) l c h / 0.05) 1px, transparent 1px),
      linear-gradient(90deg, oklch(from var(--foreground) l c h / 0.05) 1px, transparent 1px);
    background-size: 42px 42px;
    -webkit-mask-image: radial-gradient(60% 60% at 50% 40%, black, transparent 85%);
    mask-image: radial-gradient(60% 60% at 50% 40%, black, transparent 85%);
    pointer-events: none;
  }

  /* Extremely subtle grain so the large ambient areas don't look flat/banded */
  .login-noise-overlay {
    position: absolute;
    inset: 0;
    z-index: 0;
    pointer-events: none;
    opacity: 0.035;
    mix-blend-mode: overlay;
    background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='120' height='120'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.9' numOctaves='2' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23n)'/%3E%3C/svg%3E");
  }

  .login-blob {
    position: absolute;
    z-index: 0;
    border-radius: 999px;
    filter: blur(70px);
    pointer-events: none;
    opacity: 0.55;
  }
  .login-blob-1 {
    top: -8%; left: -6%;
    width: 24rem; height: 24rem;
    background: var(--gradient-gold);
    animation: loginBlobFloat 12s ease-in-out infinite;
  }
  .login-blob-2 {
    bottom: -12%; right: -8%;
    width: 28rem; height: 28rem;
    background: var(--gradient-navy);
    animation: loginBlobFloat 14s ease-in-out infinite reverse;
  }
  .login-blob-3 {
    top: 45%; left: 50%;
    width: 17rem; height: 17rem;
    background: var(--gradient-gold);
    opacity: 0.22;
    animation: loginBlobFloat 10s ease-in-out infinite 1s;
  }
  @keyframes loginBlobFloat {
    0%, 100% { transform: translate(0, 0) scale(1); }
    50% { transform: translate(2.5%, -3.5%) scale(1.08); }
  }

  /* ---- Card entrance: fade + rise + soft zoom, plays once on page load ---- */
  .login-card-wrap {
    opacity: 0;
    transform: translateY(26px) scale(0.965);
    transition: opacity 0.9s cubic-bezier(0.22, 1, 0.36, 1), transform 0.9s cubic-bezier(0.22, 1, 0.36, 1);
    transition-delay: 0.05s;
  }
  .page-loaded .login-card-wrap { opacity: 1; transform: none; }

  /* ---- Soft rotating gradient halo behind the card (premium accent) ---- */
  .login-card-glow {
    position: absolute;
    inset: -1.25rem;
    z-index: 0;
    border-radius: calc(var(--radius-4xl) + 1.25rem);
    background: conic-gradient(from var(--lc-angle),
      oklch(from var(--gold) l c h / 0) 0deg,
      oklch(from var(--gold) l c h / 0.55) 60deg,
      oklch(from var(--gold) l c h / 0) 140deg,
      oklch(from var(--primary) l c h / 0) 200deg,
      oklch(from var(--primary) l c h / 0.5) 260deg,
      oklch(from var(--gold) l c h / 0) 340deg,
      oklch(from var(--gold) l c h / 0) 360deg);
    filter: blur(38px);
    opacity: 0.65;
    animation: loginGlowRotate 9s linear infinite;
    pointer-events: none;
  }
  @keyframes loginGlowRotate {
    to { --lc-angle: 360deg; }
  }

  /* ---- Interactive 3D tilt + cursor spotlight on the whole login card ---- */
  .login-card {
    --lc-tilt-x: 0deg;
    --lc-tilt-y: 0deg;
    --lc-spot-x: 30%;
    --lc-spot-y: 30%;
    transform: perspective(1800px) rotateX(var(--lc-tilt-x)) rotateY(var(--lc-tilt-y));
    transition: transform 0.5s cubic-bezier(0.22, 1, 0.36, 1), box-shadow 0.5s ease;
    will-change: transform;
  }
  .login-card::before {
    content: '';
    position: absolute;
    inset: 0;
    z-index: 1;
    border-radius: inherit;
    background: radial-gradient(520px circle at var(--lc-spot-x) var(--lc-spot-y), oklch(from var(--gold) l c h / 0.14), transparent 60%);
    opacity: 0;
    transition: opacity 0.4s ease;
    pointer-events: none;
  }
  .login-card:hover::before { opacity: 1; }

  .login-brand-panel { isolation: isolate; }

  .login-brand-dotgrid {
    position: absolute;
    inset: 0;
    z-index: 0;
    opacity: 0.16;
    background-image: radial-gradient(oklch(1 0 0 / 0.9) 1px, transparent 1.2px);
    background-size: 24px 24px;
    -webkit-mask-image: radial-gradient(70% 70% at 50% 40%, black, transparent 88%);
    mask-image: radial-gradient(70% 70% at 50% 40%, black, transparent 88%);
    pointer-events: none;
  }
  .login-brand-glow {
    position: absolute;
    inset: -20%;
    z-index: 0;
    background: radial-gradient(45% 45% at 70% 20%, oklch(from var(--gold) l c h / 0.35), transparent 65%);
    animation: loginBlobFloat 9s ease-in-out infinite;
    pointer-events: none;
  }
  .login-brand-ring {
    position: absolute;
    z-index: 0;
    border-radius: 999px;
    border: 1.5px solid oklch(from var(--gold) l c h / 0.3);
    pointer-events: none;
  }
  .login-brand-ring-1 { width: 22rem; height: 22rem; top: -10%; right: -12%; animation: loginRingSpin 40s linear infinite; }
  .login-brand-ring-2 { width: 14rem; height: 14rem; bottom: -8%; left: -8%; border-color: oklch(1 0 0 / 0.14); animation: loginRingSpin 30s linear infinite reverse; }
  @keyframes loginRingSpin {
    to { transform: rotate(360deg); }
  }

  .login-brand-icon {
    position: absolute;
    z-index: 2;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    border-radius: 9999px;
    color: var(--gold);
    background: oklch(1 0 0 / 0.1);
    backdrop-filter: blur(4px);
  }
  .login-brand-icon-1 { top: 12%; left: 12%; width: 2.75rem; height: 2.75rem; }
  .login-brand-icon-2 { top: 22%; right: 14%; width: 2.25rem; height: 2.25rem; }
  .login-brand-icon-3 { bottom: 16%; left: 18%; width: 2.25rem; height: 2.25rem; }

  /* Soft breathing pulse ring behind the central badge icon */
  .login-brand-badge-pulse {
    position: absolute;
    inset: 0;
    border-radius: inherit;
    box-shadow: 0 0 0 0 oklch(from var(--gold) l c h / 0.45);
    animation: loginBadgePulse 2.6s ease-out infinite;
  }
  @keyframes loginBadgePulse {
    0% { box-shadow: 0 0 0 0 oklch(from var(--gold) l c h / 0.45); }
    70% { box-shadow: 0 0 0 18px oklch(from var(--gold) l c h / 0); }
    100% { box-shadow: 0 0 0 0 oklch(from var(--gold) l c h / 0); }
  }

  /* ---- Inputs with a leading icon ---- */
  .login-input-wrap { position: relative; }
  .login-input-icon {
    position: absolute;
    left: 1rem;
    top: 50%;
    transform: translateY(-50%);
    color: var(--muted-foreground);
    pointer-events: none;
    transition: color 0.2s ease;
  }
  .login-input {
    display: block;
    width: 100%;
    border-radius: var(--radius-xl);
    border: 1px solid var(--border);
    background-color: var(--background);
    padding: 0.85rem 1rem 0.85rem 2.75rem;
    font-size: var(--text-sm);
    color: var(--foreground);
    outline: none;
    transition: border-color 0.2s ease, box-shadow 0.2s ease, transform 0.2s ease;
  }
  .login-input::placeholder { color: var(--muted-foreground); }
  .login-input:focus {
    border-color: var(--gold);
    box-shadow: 0 0 0 4px oklch(from var(--gold) l c h / 0.18);
    transform: translateY(-1px);
  }
  .login-input:focus ~ .login-input-icon,
  .login-input-wrap:focus-within .login-input-icon { color: var(--gold); }
  .login-input-toggle {
    position: absolute;
    inset-block: 0;
    right: 0;
    display: flex;
    width: 2.75rem;
    align-items: center;
    justify-content: center;
    color: var(--muted-foreground);
  }
  .login-input-toggle:hover { color: var(--foreground); }

  /* ---- Extra light-sweep highlight layered on top of the submit button ---- */
  .btn-premium {
    position: relative;
    overflow: hidden;
  }
  .btn-premium::after {
    content: '';
    position: absolute;
    top: 0;
    left: -60%;
    width: 45%;
    height: 100%;
    background: linear-gradient(115deg, transparent, oklch(1 0 0 / 0.35), transparent);
    transform: skewX(-18deg);
    transition: left 0.75s ease;
    pointer-events: none;
  }
  .btn-premium:hover::after { left: 130%; }

  @media (prefers-reduced-motion: reduce) {
    .login-blob, .login-brand-glow, .login-brand-icon-1, .login-brand-icon-2, .login-brand-icon-3,
    .login-card, .login-card-wrap, .login-card-glow, .login-brand-ring-1, .login-brand-ring-2,
    .login-brand-badge-pulse, .btn-premium::after {
      animation: none !important;
      transition: none !important;
      transform: none !important;
    }
    .login-card-wrap { opacity: 1; }
  }
</style>


<script>
  (function () {
    var card = document.getElementById('loginCard');
    if (!card) return;
    var reduceMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
    var isCoarsePointer = window.matchMedia('(pointer: coarse)').matches;
    if (reduceMotion || isCoarsePointer) return;

    var resetTimeout = null;

    card.addEventListener('mousemove', function (e) {
      var rect = card.getBoundingClientRect();
      var px = (e.clientX - rect.left) / rect.width;   // 0 -> 1
      var py = (e.clientY - rect.top) / rect.height;    // 0 -> 1

      var maxTilt = 3.5; // degrees, kept subtle for a professional feel
      var tiltY = (px - 0.5) * maxTilt * 2;
      var tiltX = -(py - 0.5) * maxTilt * 2;

      card.style.setProperty('--lc-tilt-x', tiltX.toFixed(2) + 'deg');
      card.style.setProperty('--lc-tilt-y', tiltY.toFixed(2) + 'deg');
      card.style.setProperty('--lc-spot-x', (px * 100).toFixed(1) + '%');
      card.style.setProperty('--lc-spot-y', (py * 100).toFixed(1) + '%');

      clearTimeout(resetTimeout);
    });

    card.addEventListener('mouseleave', function () {
      card.style.setProperty('--lc-tilt-x', '0deg');
      card.style.setProperty('--lc-tilt-y', '0deg');
    });
  })();
</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.auth', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\rizki\Pictures\INFOKOM-REACT\Laravel\smk-infokom\resources\views/pages/login.blade.php ENDPATH**/ ?>