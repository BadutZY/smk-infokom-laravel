
<?php $__env->startSection('title', 'BKK - Bursa Kerja Khusus'); ?>
<?php $__env->startSection('description', 'BKK INFOKOM adalah unit layanan Bursa Kerja Khusus SMK INFOKOM Kota Bogor: info lowongan kerja, bimbingan karier, serta penyaluran & penempatan kerja bagi alumni.'); ?>

<?php $__env->startSection('content'); ?>

<style>
  /* ===== Halaman BKK (style khusus halaman ini) ===== */

  /* Jaringan koneksi karier yang melayang lembut di hero */
  .bkk-node {
    position: absolute; width: var(--s, 8px); height: var(--s, 8px); border-radius: 9999px;
    background: var(--gold); opacity: .55; left: var(--l); top: var(--t);
    animation: bkkFloat var(--d, 10s) ease-in-out var(--dl, 0s) infinite;
    box-shadow: 0 0 14px 2px oklch(from var(--gold) l c h / .5);
  }
  @keyframes bkkFloat {
    0%, 100% { transform: translate3d(0,0,0); opacity: .35; }
    50% { transform: translate3d(14px, -22px, 0); opacity: .8; }
  }
  .bkk-grid-glow {
    position: absolute; inset: 0; pointer-events: none;
    background-image: linear-gradient(white 1px, transparent 1px), linear-gradient(90deg, white 1px, transparent 1px);
    background-size: 46px 46px; opacity: .06;
  }

  /* ===== Kartu profil ala Instagram, diselaraskan dengan tema navy/emas situs =====
     Latar kartu memakai warna navy polos (tetap, tidak animasi/berubah warna)
     supaya senada dengan tema situs; jejak "ini Instagram" cukup ditunjukkan
     lewat garis tepi tipis bergradasi warna khas Instagram yang diam (statis). */
  .bkk-profile-card {
    position: relative; isolation: isolate; border-radius: 1.75rem; overflow: hidden;
    background: var(--gradient-navy);
    box-shadow: var(--shadow-lift);
    transition: transform .5s cubic-bezier(.22,1,.36,1), box-shadow .5s cubic-bezier(.22,1,.36,1);
  }
  .bkk-profile-card:hover { transform: translateY(-6px); box-shadow: var(--shadow-lift), 0 0 50px -12px oklch(from var(--gold) l c h / .55); }
  .bkk-profile-card::before {
    /* Garis tepi tipis warna khas Instagram (ungu-pink-oranye), statis — bukan untuk latar penuh. */
    content: ''; position: absolute; inset: 0; z-index: -1; border-radius: inherit;
    padding: 1.5px;
    background: linear-gradient(135deg, #4f5bd5, #962fbf, #d62976, #fa7e1e, #feda75);
    -webkit-mask: linear-gradient(#000 0 0) content-box, linear-gradient(#000 0 0);
    -webkit-mask-composite: xor; mask-composite: exclude;
    opacity: .9;
  }
  .bkk-profile-head { position: relative; padding: 2rem 1.75rem 1.5rem; text-align: center; }
  .bkk-avatar-ring {
    position: relative; margin: 0 auto; display: flex; height: 5.5rem; width: 5.5rem; align-items: center; justify-content: center;
    border-radius: 9999px; background: linear-gradient(135deg, #4f5bd5, #962fbf, #d62976, #fa7e1e, #feda75);
    padding: 3px;
  }
  .bkk-avatar-inner {
    display: flex; height: 100%; width: 100%; align-items: center; justify-content: center; overflow: hidden; border-radius: 9999px;
    background: oklch(0.18 0.05 262); color: var(--gold);
  }
  .bkk-avatar-inner img { height: 100%; width: 100%; object-fit: cover; border-radius: 9999px; }
  .bkk-stats-row { display: grid; grid-template-columns: repeat(3, 1fr); border-top: 1px solid rgb(255 255 255 / .1); border-bottom: 1px solid rgb(255 255 255 / .1); }
  .bkk-stats-row > div { padding: 1.1rem .5rem; text-align: center; border-right: 1px solid rgb(255 255 255 / .1); }
  .bkk-stats-row > div:last-child { border-right: 0; }
  .bkk-follow-btn {
    position: relative; display: flex; align-items: center; justify-content: center; gap: .5rem;
    margin: 1.25rem; padding: .9rem 1rem; border-radius: 1rem; overflow: hidden;
    background: white; color: oklch(0.2 0.05 262); font-weight: 700; font-size: .875rem;
    transition: transform .3s cubic-bezier(.22,1,.36,1), box-shadow .3s ease;
  }
  .bkk-follow-btn:hover { transform: translateY(-2px) scale(1.015); box-shadow: 0 10px 26px -8px rgb(0 0 0 / .45); }

  /* ===== Kartu media (foto/video/embed) — kartu biasa, bukan bentuk HP ===== */
  .bkk-card { transition: transform .4s cubic-bezier(.22,1,.36,1), box-shadow .4s cubic-bezier(.22,1,.36,1), border-color .4s cubic-bezier(.22,1,.36,1); }

  .bkk-media {
    position: relative; overflow: hidden; aspect-ratio: 4 / 3;
    background: linear-gradient(160deg, oklch(0.3 0.09 258), oklch(0.2 0.07 262));
  }
  /* Latar belakang buram (versi zoom dari foto yang sama) supaya tidak ada area kosong,
     sementara foto asli di atasnya tampil UTUH 100% tanpa terpotong/terzoom. */
  .bkk-media-bg {
    position: absolute; inset: 0; z-index: 0; width: 100%; height: 100%; object-fit: cover;
    filter: blur(26px) brightness(.55) saturate(1.15); transform: scale(1.25);
    transition: transform .8s cubic-bezier(.22,1,.36,1);
  }
  .bkk-card:hover .bkk-media-bg { transform: scale(1.35); }
  .bkk-media-img {
    position: absolute; inset: 0; z-index: 1; width: 100%; height: 100%;
    object-fit: contain; object-position: center; box-sizing: border-box; padding: .85rem;
  }
  .bkk-media-video { background: #000; object-fit: contain; }

  .bkk-chip { position: absolute; left: .9rem; top: .9rem; z-index: 3; display: inline-flex; align-items: center; gap: .35rem; border-radius: 9999px; background: rgb(255 255 255 / .18); padding: .3rem .7rem; font-size: 10px; font-weight: 600; letter-spacing: .05em; text-transform: uppercase; color: white; backdrop-filter: blur(6px); }

  .bkk-photo-trigger { position: absolute; inset: 0; z-index: 2; cursor: zoom-in; }

  .bkk-play { position: absolute; left: 50%; top: 50%; z-index: 3; display: flex; align-items: center; justify-content: center; width: 4rem; height: 4rem; transform: translate(-50%, -50%); border-radius: 9999px; background: white; color: var(--primary); box-shadow: 0 10px 30px -8px rgb(0 0 0 / .5); transition: transform .3s cubic-bezier(.22,1,.36,1); cursor: pointer; }
  .bkk-play::before, .bkk-play::after { content: ''; position: absolute; inset: 0; border-radius: inherit; border: 2px solid white; opacity: 0; animation: bkkRing 2.4s ease-out infinite; }
  .bkk-play::after { animation-delay: 1.2s; }
  @keyframes bkkRing { 0% { transform: scale(1); opacity: .7; } 100% { transform: scale(1.9); opacity: 0; } }
  .bkk-card:hover .bkk-play { transform: translate(-50%, -50%) scale(1.1); }

  .bkk-frame { position: absolute; inset: 0; z-index: 4; width: 100%; height: 100%; border: 0; background: white; }
  .bkk-loading { position: absolute; inset: 0; z-index: 3; display: none; align-items: center; justify-content: center; background: rgb(0 0 0 / .35); color: white; }
  [data-bkk-reel].is-playing .bkk-loading { display: flex; }
  [data-bkk-reel].is-playing .bkk-media-bg,
  [data-bkk-reel].is-playing .bkk-media-img,
  [data-bkk-reel].is-playing .bkk-play,
  [data-bkk-reel].is-playing .bkk-chip { visibility: hidden; }
  .bkk-stop { position: absolute; right: .7rem; top: .7rem; z-index: 6; display: none; height: 1.9rem; width: 1.9rem; align-items: center; justify-content: center; border-radius: 9999px; background: rgb(0 0 0 / .65); color: white; }
  [data-bkk-reel].is-playing .bkk-stop { display: flex; }

  .bkk-line { position: absolute; left: 1.55rem; top: 0; bottom: 0; width: 2px; background: linear-gradient(to bottom, var(--gold), var(--teal), transparent); }
  @media (min-width: 1024px) { .bkk-line { display: none; } }

  @media (prefers-reduced-motion: reduce) {
    .bkk-node, .bkk-play::before, .bkk-play::after { animation: none !important; }
    .bkk-card:hover, .bkk-profile-card:hover { transform: none; }
    .bkk-card:hover .bkk-media-bg { transform: scale(1.25); }
  }
</style>


<section class="relative overflow-hidden bg-navy-radial pb-28 pt-24 text-hero-foreground sm:pb-32 sm:pt-28">
  <div class="pointer-events-none absolute inset-0 bg-grain"></div>
  <div class="bkk-grid-glow pointer-events-none"></div>

  <div class="pointer-events-none absolute inset-0 overflow-hidden" aria-hidden="true">
    <?php for($i = 0; $i < 14; $i++): ?>
      <span class="bkk-node" style="--l:<?php echo e(($i * 7.3 + 4) % 96); ?>%; --t:<?php echo e(($i * 11.5 + 6) % 80); ?>%; --s:<?php echo e(6 + ($i % 3) * 3); ?>px; --d:<?php echo e(8 + ($i % 5) * 2); ?>s; --dl:-<?php echo e(number_format($i * 0.8, 1)); ?>s;"></span>
    <?php endfor; ?>
  </div>

  <div class="relative mx-auto max-w-4xl px-4 text-center sm:px-6 lg:px-8">
    <span class="enter-item enter-d1 kicker kicker--light">
      <?php if (isset($component)) { $__componentOriginalce262628e3a8d44dc38fd1f3965181bc = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalce262628e3a8d44dc38fd1f3965181bc = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.icon','data' => ['name' => 'briefcase','class' => 'w-3.5 h-3.5']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'briefcase','class' => 'w-3.5 h-3.5']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalce262628e3a8d44dc38fd1f3965181bc)): ?>
<?php $attributes = $__attributesOriginalce262628e3a8d44dc38fd1f3965181bc; ?>
<?php unset($__attributesOriginalce262628e3a8d44dc38fd1f3965181bc); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalce262628e3a8d44dc38fd1f3965181bc)): ?>
<?php $component = $__componentOriginalce262628e3a8d44dc38fd1f3965181bc; ?>
<?php unset($__componentOriginalce262628e3a8d44dc38fd1f3965181bc); ?>
<?php endif; ?>Bursa Kerja Khusus
    </span>
    <h1 class="enter-item enter-d2 mt-5 font-display text-4xl font-extrabold leading-[1.1] sm:text-5xl lg:text-6xl">
      BKK INFOKOM, Jembatan Menuju <span class="text-gradient-gold">Dunia Kerja</span>
    </h1>
    <p class="enter-item enter-d3 mx-auto mt-5 max-w-2xl text-base text-white/75 sm:text-lg">
      Unit layanan resmi <?php echo e($site['school']['brand_top']); ?> yang menghubungkan lulusan dengan info lowongan kerja, bimbingan karier, serta penyaluran dan penempatan tenaga kerja ke dunia industri.
    </p>
    <div class="enter-item enter-d4 mt-8 flex flex-wrap items-center justify-center gap-3">
      <a href="#profil-ig" class="shine inline-flex items-center gap-2 rounded-full bg-gold-gradient px-6 py-3 text-sm font-semibold text-gold-foreground shadow-lift glow-gold transition-transform hover:-translate-y-0.5">
        Info Loker Terbaru <?php if (isset($component)) { $__componentOriginalce262628e3a8d44dc38fd1f3965181bc = $component; } ?>
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
      <a href="<?php echo e(route('kontak')); ?>" class="inline-flex items-center gap-2 rounded-full border border-white/30 px-6 py-3 text-sm font-semibold text-white transition-colors hover:bg-white/10">
        Hubungi BKK
      </a>
    </div>
  </div>

  <span class="accent-bar absolute inset-x-0 bottom-0" aria-hidden="true"></span>
</section>


<section class="relative -mt-10 px-4 sm:px-6 lg:px-8">
  <div class="reveal-scale mx-auto max-w-4xl rounded-3xl border border-border bg-card p-7 text-center shadow-lift sm:p-10">
    <span class="mx-auto flex h-12 w-12 items-center justify-center rounded-full bg-navy-gradient text-hero-foreground"><?php if (isset($component)) { $__componentOriginalce262628e3a8d44dc38fd1f3965181bc = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalce262628e3a8d44dc38fd1f3965181bc = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.icon','data' => ['name' => 'info','class' => 'w-6 h-6']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'info','class' => 'w-6 h-6']); ?>
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
    <h2 class="mt-4 font-display text-xl font-bold text-foreground sm:text-2xl">Apa itu BKK?</h2>
    <p class="mx-auto mt-3 max-w-2xl text-sm leading-relaxed text-muted-foreground sm:text-base">
      
      <?php echo e($konten->apa_itu ?? ''); ?>

    </p>
  </div>
</section>


<section class="section-pad px-4 sm:px-6 lg:px-8">
  <div class="mx-auto max-w-6xl">
    <?php if (isset($component)) { $__componentOriginal6a0a1523cc2edf33c83fe20a5d1f7f78 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal6a0a1523cc2edf33c83fe20a5d1f7f78 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.section-title','data' => ['kicker' => 'Layanan','title' => 'Apa Saja yang BKK Bantu?','desc' => 'Empat layanan utama BKK INFOKOM untuk mempersiapkan dan menyalurkan alumni ke dunia kerja.']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('section-title'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['kicker' => 'Layanan','title' => 'Apa Saja yang BKK Bantu?','desc' => 'Empat layanan utama BKK INFOKOM untuk mempersiapkan dan menyalurkan alumni ke dunia kerja.']); ?>
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

    
    <?php if($layananList->isEmpty()): ?>
      <p class="mt-10 text-center text-sm text-muted-foreground">Belum ada data.</p>
    <?php else: ?>
    <div class="stagger-group mt-12 grid gap-6 sm:grid-cols-2 lg:grid-cols-4">
      <?php $__currentLoopData = $layananList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $layanan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="stagger-item card-hover group rounded-2xl border border-border bg-card p-6 shadow-soft">
          <span class="flex h-12 w-12 items-center justify-center rounded-xl bg-navy-gradient text-hero-foreground transition-transform duration-300 group-hover:-rotate-6 group-hover:scale-110">
            <?php if (isset($component)) { $__componentOriginalce262628e3a8d44dc38fd1f3965181bc = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalce262628e3a8d44dc38fd1f3965181bc = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.icon','data' => ['name' => $layanan->icon,'class' => 'w-6 h-6']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($layanan->icon),'class' => 'w-6 h-6']); ?>
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
          <h3 class="mt-5 font-display text-base font-bold text-foreground"><?php echo e($layanan->judul); ?></h3>
          <p class="mt-2 text-sm leading-relaxed text-muted-foreground"><?php echo e($layanan->deskripsi); ?></p>
        </div>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
    <?php endif; ?>
  </div>
</section>


<section id="profil-ig" class="section-pad scroll-mt-24 bg-secondary/50 px-4 sm:px-6 lg:px-8">
  <div class="mx-auto max-w-6xl">
    <?php if (isset($component)) { $__componentOriginal6a0a1523cc2edf33c83fe20a5d1f7f78 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal6a0a1523cc2edf33c83fe20a5d1f7f78 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.section-title','data' => ['kicker' => 'Ikuti Kami','title' => 'Update Info Loker via Instagram','desc' => 'Pantau info lowongan kerja dan kegiatan BKK terbaru langsung dari akun resmi Instagram kami.']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('section-title'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['kicker' => 'Ikuti Kami','title' => 'Update Info Loker via Instagram','desc' => 'Pantau info lowongan kerja dan kegiatan BKK terbaru langsung dari akun resmi Instagram kami.']); ?>
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

    <div class="mt-12 grid items-center gap-10 lg:grid-cols-2">
      
      <div class="reveal mx-auto w-full max-w-sm">
        <div class="bkk-profile-card">
          <div class="bkk-profile-head">
            <div class="bkk-avatar-ring">
              <span class="bkk-avatar-inner">
                
                <?php if($konten->ig_foto ?? null): ?>
                  <img src="<?php echo e(\App\Support\Site::imageUrl($konten->ig_foto)); ?>" alt="Foto profil <?php echo e($konten->ig_nama ?? 'BKK INFOKOM'); ?>" />
                <?php else: ?>
                  <?php if (isset($component)) { $__componentOriginalce262628e3a8d44dc38fd1f3965181bc = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalce262628e3a8d44dc38fd1f3965181bc = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.icon','data' => ['name' => 'briefcase','class' => 'w-8 h-8']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'briefcase','class' => 'w-8 h-8']); ?>
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
                <?php endif; ?>
              </span>
            </div>
            
            <h3 class="mt-4 font-display text-lg font-extrabold text-white"><?php echo e($konten->ig_nama ?? 'BKK INFOKOM'); ?></h3>
            <p class="mt-0.5 text-sm font-medium text-gold">&#64;<?php echo e($konten->ig_username ?? 'bkkinfokom'); ?></p>
            <p class="mx-auto mt-3 max-w-[240px] text-xs leading-relaxed text-white/60"><?php echo e($konten->ig_bio ?? ''); ?></p>
          </div>

          <div class="bkk-stats-row text-white">
            <div>
              <p class="font-display text-xl font-extrabold"><?php echo e($konten->ig_kiriman ?? 0); ?></p>
              <p class="mt-0.5 text-[10px] font-semibold uppercase tracking-wider text-white/55">Kiriman</p>
            </div>
            <div>
              <p class="font-display text-xl font-extrabold"><?php echo e($konten->ig_pengikut ?? 0); ?></p>
              <p class="mt-0.5 text-[10px] font-semibold uppercase tracking-wider text-white/55">Pengikut</p>
            </div>
            <div>
              <p class="font-display text-xl font-extrabold"><?php echo e($konten->ig_diikuti ?? 0); ?></p>
              <p class="mt-0.5 text-[10px] font-semibold uppercase tracking-wider text-white/55">Diikuti</p>
            </div>
          </div>

          <a href="<?php echo e($konten->ig_url ?? '#'); ?>" target="_blank" rel="noopener" class="bkk-follow-btn">
            <?php if (isset($component)) { $__componentOriginalce262628e3a8d44dc38fd1f3965181bc = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalce262628e3a8d44dc38fd1f3965181bc = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.icon','data' => ['name' => 'instagram','class' => 'w-4 h-4']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'instagram','class' => 'w-4 h-4']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalce262628e3a8d44dc38fd1f3965181bc)): ?>
<?php $attributes = $__attributesOriginalce262628e3a8d44dc38fd1f3965181bc; ?>
<?php unset($__attributesOriginalce262628e3a8d44dc38fd1f3965181bc); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalce262628e3a8d44dc38fd1f3965181bc)): ?>
<?php $component = $__componentOriginalce262628e3a8d44dc38fd1f3965181bc; ?>
<?php unset($__componentOriginalce262628e3a8d44dc38fd1f3965181bc); ?>
<?php endif; ?> Kunjungi Instagram <?php if (isset($component)) { $__componentOriginalce262628e3a8d44dc38fd1f3965181bc = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalce262628e3a8d44dc38fd1f3965181bc = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.icon','data' => ['name' => 'external-link','class' => 'w-3.5 h-3.5']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'external-link','class' => 'w-3.5 h-3.5']); ?>
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
      </div>

      
      <div class="reveal">
        <div class="stagger-group grid gap-5">
          <?php $__currentLoopData = $followList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $follow): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="stagger-item flex items-start gap-4 rounded-2xl border border-border bg-card p-5 shadow-soft">
              <span class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-accent text-primary"><?php if (isset($component)) { $__componentOriginalce262628e3a8d44dc38fd1f3965181bc = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalce262628e3a8d44dc38fd1f3965181bc = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.icon','data' => ['name' => $follow->icon,'class' => 'w-5 h-5']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($follow->icon),'class' => 'w-5 h-5']); ?>
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
                <h4 class="font-display text-sm font-bold text-foreground"><?php echo e($follow->judul); ?></h4>
                <p class="mt-1 text-sm leading-relaxed text-muted-foreground"><?php echo e($follow->deskripsi); ?></p>
              </div>
            </div>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
      </div>
    </div>
  </div>
</section>


<section id="media" class="section-pad scroll-mt-24 px-4 sm:px-6 lg:px-8">
  <div class="mx-auto max-w-6xl">
    <?php if (isset($component)) { $__componentOriginal6a0a1523cc2edf33c83fe20a5d1f7f78 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal6a0a1523cc2edf33c83fe20a5d1f7f78 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.section-title','data' => ['kicker' => 'Dokumentasi','title' => 'Kegiatan & Info Terbaru BKK','desc' => 'Tekan tombol putar untuk menonton, atau tekan foto untuk memperbesar.']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('section-title'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['kicker' => 'Dokumentasi','title' => 'Kegiatan & Info Terbaru BKK','desc' => 'Tekan tombol putar untuk menonton, atau tekan foto untuk memperbesar.']); ?>
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

    <?php if($media->isEmpty()): ?>
      <p class="mt-14 text-center text-sm text-muted-foreground">Belum ada media BKK. Admin dapat menambahkannya lewat panel Konten Website &gt; BKK.</p>
    <?php else: ?>
    <div class="stagger-group mt-14 grid gap-7 sm:grid-cols-2 lg:grid-cols-3">
      <?php
        $posters = [
          'from-primary via-primary-soft to-teal',
          'from-primary via-primary-soft to-[oklch(0.65_0.16_75)]',
          'from-primary via-primary-soft to-[oklch(0.55_0.1_200)]',
        ];
        $chipIcons = ['foto' => 'image', 'video_lokal' => 'video', 'youtube' => 'youtube', 'instagram' => 'instagram'];
      ?>
      <?php $__currentLoopData = $media; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $m): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php
          $isFoto = $m->isFoto();
          $poster = $m->posterUrl();
        ?>
        <article class="stagger-item bkk-card card-hover overflow-hidden rounded-2xl border border-border bg-card shadow-soft">
          <div <?php if(! $isFoto): ?> data-bkk-reel data-type="<?php echo e($m->jenis_media); ?>" data-src="<?php echo e($m->embedSrc()); ?>" <?php endif; ?>
               class="bkk-media bg-gradient-to-br <?php echo e($posters[$m->tema % 3]); ?>">
            <?php if(! $isFoto): ?>
              <button type="button" class="bkk-stop" data-bkk-reel-stop aria-label="Tutup video">
                <?php if (isset($component)) { $__componentOriginalce262628e3a8d44dc38fd1f3965181bc = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalce262628e3a8d44dc38fd1f3965181bc = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.icon','data' => ['name' => 'x','class' => 'w-4 h-4']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'x','class' => 'w-4 h-4']); ?>
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
              <span class="bkk-loading"><span class="btn-spinner" style="width:1.6rem;height:1.6rem;"></span></span>
            <?php endif; ?>

            <?php if($poster): ?>
              <img src="<?php echo e($poster); ?>" alt="" aria-hidden="true" class="bkk-media-bg" loading="lazy" />
              <img src="<?php echo e($poster); ?>" alt="<?php echo e($m->judul); ?>" class="bkk-media-img" loading="lazy" />
            <?php else: ?>
              <?php if (isset($component)) { $__componentOriginalce262628e3a8d44dc38fd1f3965181bc = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalce262628e3a8d44dc38fd1f3965181bc = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.icon','data' => ['name' => 'briefcase','class' => 'absolute right-4 top-4 h-16 w-16 text-white/10']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'briefcase','class' => 'absolute right-4 top-4 h-16 w-16 text-white/10']); ?>
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
            <?php endif; ?>

            <span class="bkk-chip"><?php if (isset($component)) { $__componentOriginalce262628e3a8d44dc38fd1f3965181bc = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalce262628e3a8d44dc38fd1f3965181bc = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.icon','data' => ['name' => $chipIcons[$m->jenis_media] ?? 'video','class' => 'w-3 h-3']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($chipIcons[$m->jenis_media] ?? 'video'),'class' => 'w-3 h-3']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalce262628e3a8d44dc38fd1f3965181bc)): ?>
<?php $attributes = $__attributesOriginalce262628e3a8d44dc38fd1f3965181bc; ?>
<?php unset($__attributesOriginalce262628e3a8d44dc38fd1f3965181bc); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalce262628e3a8d44dc38fd1f3965181bc)): ?>
<?php $component = $__componentOriginalce262628e3a8d44dc38fd1f3965181bc; ?>
<?php unset($__componentOriginalce262628e3a8d44dc38fd1f3965181bc); ?>
<?php endif; ?><?php echo e($m->jenisLabel()); ?></span>

            <?php if($isFoto): ?>
              <button type="button" data-lightbox-trigger="<?php echo e($poster); ?>" data-lightbox-caption="<?php echo e($m->judul); ?>" aria-label="Perbesar foto <?php echo e($m->judul); ?>" class="bkk-photo-trigger"></button>
            <?php else: ?>
              <button type="button" data-bkk-reel-play aria-label="Putar video <?php echo e($m->judul); ?>" class="bkk-play">
                <svg viewBox="0 0 24 24" fill="currentColor" class="ml-1 h-6 w-6" aria-hidden="true"><path d="M8 5.5v13a1 1 0 0 0 1.5.86l10.5-6.5a1 1 0 0 0 0-1.72L9.5 4.64A1 1 0 0 0 8 5.5Z"/></svg>
              </button>
            <?php endif; ?>
          </div>

          <div class="p-5">
            <h3 class="font-display text-base font-bold leading-snug text-foreground"><?php echo e($m->judul); ?></h3>
            <?php if($m->keterangan): ?>
              <p class="mt-1.5 text-sm leading-relaxed text-muted-foreground"><?php echo e($m->keterangan); ?></p>
            <?php endif; ?>
            <?php if($m->sourceUrl()): ?>
              <a href="<?php echo e($m->sourceUrl()); ?>" target="_blank" rel="noopener" class="mt-3 inline-flex items-center gap-1.5 text-sm font-semibold text-primary hover:underline">
                <?php if (isset($component)) { $__componentOriginalce262628e3a8d44dc38fd1f3965181bc = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalce262628e3a8d44dc38fd1f3965181bc = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.icon','data' => ['name' => $chipIcons[$m->jenis_media],'class' => 'w-4 h-4']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($chipIcons[$m->jenis_media]),'class' => 'w-4 h-4']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalce262628e3a8d44dc38fd1f3965181bc)): ?>
<?php $attributes = $__attributesOriginalce262628e3a8d44dc38fd1f3965181bc; ?>
<?php unset($__attributesOriginalce262628e3a8d44dc38fd1f3965181bc); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalce262628e3a8d44dc38fd1f3965181bc)): ?>
<?php $component = $__componentOriginalce262628e3a8d44dc38fd1f3965181bc; ?>
<?php unset($__componentOriginalce262628e3a8d44dc38fd1f3965181bc); ?>
<?php endif; ?><?php echo e($m->sourceLabel()); ?>

              </a>
            <?php endif; ?>
          </div>
        </article>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
    <?php endif; ?>
  </div>
</section>


<section class="section-pad bg-secondary/50 px-4 sm:px-6 lg:px-8">
  <div class="mx-auto max-w-6xl">
    <?php if (isset($component)) { $__componentOriginal6a0a1523cc2edf33c83fe20a5d1f7f78 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal6a0a1523cc2edf33c83fe20a5d1f7f78 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.section-title','data' => ['kicker' => 'Alur Layanan','title' => 'Cara Kerja Layanan BKK','desc' => 'Langkah sederhana bagi alumni untuk mendapatkan pendampingan hingga penyaluran kerja.']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('section-title'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['kicker' => 'Alur Layanan','title' => 'Cara Kerja Layanan BKK','desc' => 'Langkah sederhana bagi alumni untuk mendapatkan pendampingan hingga penyaluran kerja.']); ?>
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

    
    <?php if($langkahList->isEmpty()): ?>
      <p class="mt-10 text-center text-sm text-muted-foreground">Belum ada data.</p>
    <?php else: ?>
    <div class="relative mt-14">
      <div class="bkk-line"></div>
      <div class="stagger-group grid gap-8 lg:grid-cols-4">
        <?php $__currentLoopData = $langkahList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $langkah): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <div class="stagger-item relative pl-16 lg:pl-0 lg:text-center">
            <span class="absolute left-0 top-0 flex h-12 w-12 items-center justify-center rounded-full bg-gold-gradient font-display text-sm font-extrabold text-gold-foreground shadow-soft glow-gold lg:relative lg:mx-auto"><?php echo e($langkah->nomor); ?></span>
            <h3 class="mt-1 font-display text-base font-bold text-foreground lg:mt-4"><?php echo e($langkah->judul); ?></h3>
            <p class="mt-2 text-sm leading-relaxed text-muted-foreground"><?php echo e($langkah->deskripsi); ?></p>
          </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      </div>
    </div>
    <?php endif; ?>
  </div>
</section>


<section class="section-pad px-4 sm:px-6 lg:px-8">
  <div class="reveal relative mx-auto max-w-6xl overflow-hidden rounded-3xl bg-navy-radial px-8 py-16 text-center text-hero-foreground shadow-lift sm:px-16">
    <div class="pointer-events-none absolute inset-0 bg-grain"></div>
    <span class="bg-orb float-y -left-10 -top-10 h-52 w-52 bg-gold/25"></span>
    <span class="bg-orb float-y h-52 w-52 bg-teal/25" style="right:-2.5rem; bottom:-2.5rem; animation-delay:1s;"></span>
    <div class="relative">
      <h2 class="font-display text-3xl font-bold sm:text-4xl">Siap Melangkah ke <span class="text-gradient-gold">Dunia Kerja?</span></h2>
      <p class="mx-auto mt-3 max-w-xl text-sm text-white/75 sm:text-base">Ikuti Instagram BKK INFOKOM untuk info loker terbaru, atau hubungi kami langsung untuk konsultasi karier.</p>
      <div class="mt-8 flex flex-wrap items-center justify-center gap-3">
        <a href="<?php echo e($konten->ig_url ?? '#'); ?>" target="_blank" rel="noopener" class="shine inline-flex items-center gap-2 rounded-full bg-gold-gradient px-7 py-3 text-sm font-semibold text-gold-foreground shadow-lift glow-gold transition-transform hover:-translate-y-0.5">
          <?php if (isset($component)) { $__componentOriginalce262628e3a8d44dc38fd1f3965181bc = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalce262628e3a8d44dc38fd1f3965181bc = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.icon','data' => ['name' => 'instagram','class' => 'w-4 h-4']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'instagram','class' => 'w-4 h-4']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalce262628e3a8d44dc38fd1f3965181bc)): ?>
<?php $attributes = $__attributesOriginalce262628e3a8d44dc38fd1f3965181bc; ?>
<?php unset($__attributesOriginalce262628e3a8d44dc38fd1f3965181bc); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalce262628e3a8d44dc38fd1f3965181bc)): ?>
<?php $component = $__componentOriginalce262628e3a8d44dc38fd1f3965181bc; ?>
<?php unset($__componentOriginalce262628e3a8d44dc38fd1f3965181bc); ?>
<?php endif; ?> &#64;<?php echo e($konten->ig_username ?? 'bkkinfokom'); ?>

        </a>
        <a href="<?php echo e(route('kontak')); ?>" class="inline-flex items-center gap-2 rounded-full border border-white/30 px-7 py-3 text-sm font-semibold text-white transition-colors hover:bg-white/10">
          Hubungi BKK
        </a>
      </div>
    </div>
  </div>
</section>

<script>
  // Video dimuat hanya saat diputar (halaman tetap ringan & cepat).
  // Mendukung: video upload (tag video), YouTube dan Instagram (iframe).
  (function () {
    var cards = document.querySelectorAll('[data-bkk-reel]');

    function stop(card) {
      var f = card.querySelector('.bkk-frame');
      if (f) {
        if (typeof f.pause === 'function') f.pause();
        f.remove();
      }
      card.classList.remove('is-playing');
    }

    function start(card) {
      var type = card.dataset.type;
      var src = card.dataset.src;
      if (!src) return;
      var el;

      if (type === 'video_lokal') {
        el = document.createElement('video');
        el.className = 'bkk-frame bkk-media-video';
        el.src = src;
        el.controls = true;
        el.autoplay = true;
        el.setAttribute('playsinline', '');
        el.preload = 'metadata';
      } else {
        el = document.createElement('iframe');
        el.className = 'bkk-frame';
        el.src = src;
        el.setAttribute('scrolling', 'no');
        el.setAttribute('allowfullscreen', '');
        el.setAttribute('allow', 'autoplay; encrypted-media; picture-in-picture; fullscreen');
        el.setAttribute('title', 'Video BKK INFOKOM');
      }

      card.querySelector('.bkk-media').appendChild(el);
      card.classList.add('is-playing');
    }

    cards.forEach(function (card) {
      var play = card.querySelector('[data-bkk-reel-play]');
      var close = card.querySelector('[data-bkk-reel-stop]');

      play.addEventListener('click', function () {
        cards.forEach(function (c) { if (c !== card) stop(c); }); // hanya 1 video aktif
        start(card);
      });
      close.addEventListener('click', function () { stop(card); });
    });
  })();
</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\rizki\Pictures\INFOKOM-REACT\Laravel\smk-infokom\resources\views/pages/bkk.blade.php ENDPATH**/ ?>