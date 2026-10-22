<?php $__env->startSection('title', 'Lupa Password'); ?>

<?php $__env->startSection('content'); ?>

<section class="relative flex min-h-[80vh] items-center justify-center overflow-hidden bg-navy-radial px-4 py-16 sm:px-6 lg:px-8">
  <div class="pointer-events-none absolute inset-0 bg-grain"></div>
  <div class="hud-grid"></div>
  <canvas data-particles aria-hidden="true"></canvas>
  <span class="bg-orb float-y -left-16 -top-10 h-64 w-64 bg-gold/20"></span>
  <span class="bg-orb float-y h-72 w-72 bg-teal/20" style="right:-4rem; bottom:-3rem; animation-delay:1.2s;"></span>

  <div class="enter-item enter-d1 relative w-full max-w-md">
    <div class="text-center text-hero-foreground">
      <span class="mx-auto flex h-14 w-14 items-center justify-center rounded-2xl bg-white/10 text-gold shadow-lift">
        <?php if (isset($component)) { $__componentOriginalce262628e3a8d44dc38fd1f3965181bc = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalce262628e3a8d44dc38fd1f3965181bc = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.icon','data' => ['name' => 'lock','class' => 'w-6 h-6']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'lock','class' => 'w-6 h-6']); ?>
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
      <h1 class="mt-4 font-display text-2xl font-bold">Lupa Password</h1>
      <p class="mt-1 text-sm text-white/70">Masukkan kode pemulihan untuk mengatur ulang password admin</p>
    </div>

    <div class="mt-8 rounded-3xl border border-border bg-card p-7 shadow-lift sm:p-9">
      <form method="POST" action="<?php echo e(route('lupa-password.submit')); ?>" class="grid gap-5">
        <?php echo csrf_field(); ?>
        <div>
          <label for="username" class="text-sm font-medium text-foreground">Username</label>
          <input type="text" name="username" id="username" value="<?php echo e(old('username')); ?>" class="input-field" placeholder="Username admin" />
          <?php $__errorArgs = ['username'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="mt-1 text-xs text-destructive"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>
        <div>
          <label for="kode_pemulihan" class="text-sm font-medium text-foreground">Kode Pemulihan</label>
          <input type="text" name="kode_pemulihan" id="kode_pemulihan" class="input-field" placeholder="Kode pemulihan rahasia" />
          <?php $__errorArgs = ['kode_pemulihan'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="mt-1 text-xs text-destructive"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>
        <div>
          <label for="password_baru" class="text-sm font-medium text-foreground">Password Baru</label>
          <input type="password" name="password_baru" id="password_baru" class="input-field" placeholder="Minimal 6 karakter" />
          <?php $__errorArgs = ['password_baru'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="mt-1 text-xs text-destructive"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>
        <div>
          <label for="konfirmasi_password" class="text-sm font-medium text-foreground">Konfirmasi Password</label>
          <input type="password" name="konfirmasi_password" id="konfirmasi_password" class="input-field" placeholder="Ulangi password baru" />
          <?php $__errorArgs = ['konfirmasi_password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="mt-1 text-xs text-destructive"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>
        <button type="submit" class="shine mt-2 inline-flex items-center justify-center gap-2 rounded-full bg-navy-gradient px-6 py-3.5 text-sm font-semibold text-hero-foreground shadow-lift transition-transform hover:-translate-y-0.5">
          Atur Ulang Password
        </button>
      </form>
      <a href="<?php echo e(route('login')); ?>" class="mt-5 block text-center text-sm font-medium text-primary hover:underline">Kembali ke halaman login</a>
    </div>
  </div>
</section>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\PunyaSaya\smk-infokom\resources\views/pages/lupa-password.blade.php ENDPATH**/ ?>