
<?php $__env->startSection('title', 'Kunjungan Industri'); ?>
<?php $__env->startSection('description', 'Dokumentasi kunjungan industri siswa SMK INFOKOM Kota Bogor ke Yogyakarta: Universitas Amikom, Lava Tour Merapi, dan Museum Mini Sisa Hartaku.'); ?>

<?php $__env->startSection('content'); ?>

<?php
  $judul = $info->judul ?? 'Kunjungan Industri';
  $periode = $info->periode ?? null;
  $kotaTujuan = $info->kota_tujuan ?? null;
  $intro = $info->intro ?? null;
  $totalFoto = $lokasiList->sum(fn ($l) => $l->fotos->count());
  $jumlahLokasi = $lokasiList->count();
  // Kolom pada "rute perjalanan": semua destinasi sebaris bila <= 4, selain itu 3 per baris (baris terakhir tetap di tengah).
  $routeCols = $jumlahLokasi <= 4 ? max($jumlahLokasi, 1) : 3;
?>

<style>
  /* =====================================================================
     Halaman Kunjungan Industri  (style khusus halaman ini, awalan "ki-")
     Warna bawaan situs: navy + emas (+ cyan seperlunya). Semua tata letak dibuat
     simetris (rata tengah, kolom sama lebar, baris terakhir tetap di tengah).
     Foto selalu tampil UTUH (object-fit: contain) di dalam bingkai berukuran tetap.
     ===================================================================== */

  /* ---------- Pita info (menumpuk di tepi bawah hero) ---------- */
  .ki-ribbon-wrap { position: relative; z-index: 3; margin-top: -2.25rem; padding-inline: 1rem; }
  @media (min-width: 640px) { .ki-ribbon-wrap { padding-inline: 1.5rem; } }
  @media (min-width: 1024px) { .ki-ribbon-wrap { margin-top: -3.25rem; padding-inline: 2rem; } }
  .ki-ribbon {
    position: relative; display: grid; grid-template-columns: repeat(2, minmax(0, 1fr)); gap: 1px; max-width: 64rem; margin-inline: auto;
    overflow: hidden; border-radius: 1.6rem; background: var(--border);
    border: 1px solid var(--border); box-shadow: var(--shadow-lift);
  }
  @media (min-width: 1024px) { .ki-ribbon { grid-template-columns: repeat(4, minmax(0, 1fr)); } }
  .ki-ribbon::before {
    content: ''; position: absolute; inset: 0 0 auto 0; z-index: 2; height: 3px;
    background: linear-gradient(90deg, transparent, var(--gold), var(--cyan), var(--gold), transparent);
  }
  .ki-cell {
    position: relative; display: flex; flex-direction: column; align-items: center; justify-content: center; gap: .45rem;
    padding: 1.7rem 1rem 1.5rem; text-align: center; background: var(--card);
    transition: background-color .4s var(--ease-out);
  }
  .ki-cell::after {
    content: ''; position: absolute; inset: 0; pointer-events: none; opacity: 0; transition: opacity .4s;
    background: radial-gradient(70% 90% at 50% 0%, color-mix(in oklab, var(--gold) 16%, transparent), transparent 70%);
  }
  @media (hover: hover) {
    .ki-cell:hover::after { opacity: 1; }
    .ki-cell:hover .ki-cell-icon { transform: translateY(-3px) rotate(-6deg) scale(1.06); box-shadow: 0 14px 26px -12px color-mix(in oklab, var(--gold) 80%, transparent); }
  }
  .ki-cell-icon {
    position: relative; display: grid; place-items: center; width: 3rem; height: 3rem; border-radius: 1rem;
    background: var(--gradient-gold); color: var(--gold-foreground);
    box-shadow: 0 10px 22px -12px color-mix(in oklab, var(--gold) 70%, transparent);
    transition: transform .5s var(--ease-spring), box-shadow .5s var(--ease-out);
  }
  .ki-cell-icon svg { width: 1.25rem; height: 1.25rem; }
  .ki-cell-val { position: relative; display: flex; align-items: center; justify-content: center; gap: .3rem; min-height: 2.5em; font-family: var(--font-display); font-size: clamp(1.05rem, .95rem + .5vw, 1.35rem); font-weight: 800; line-height: 1.2; color: var(--primary); font-variant-numeric: tabular-nums; }
  .ki-cell-val small { font-size: .62em; font-weight: 700; letter-spacing: .02em; color: var(--muted-foreground); }
  .ki-cell-lbl { position: relative; font-size: .7rem; font-weight: 700; letter-spacing: .09em; text-transform: uppercase; color: var(--muted-foreground); }

  /* ---------- Pengantar ---------- */
  .ki-intro { padding: 4rem 1rem 1rem; }
  @media (min-width: 640px) { .ki-intro { padding-inline: 1.5rem; } }
  @media (min-width: 1024px) { .ki-intro { padding: 5rem 2rem 1.5rem; } }

  /* ---------- Rute perjalanan ---------- */
  .ki-route-wrap { margin-top: 3.25rem; }
  .ki-route-label {
    display: flex; align-items: center; justify-content: center; gap: 1rem; margin-bottom: 2rem;
    font-size: .75rem; font-weight: 700; letter-spacing: .14em; text-transform: uppercase; color: var(--muted-foreground);
  }
  .ki-route-label::before, .ki-route-label::after { content: ''; flex: 0 1 6rem; min-width: 0; height: 1px; background: linear-gradient(90deg, transparent, var(--border) 40%, var(--border)); }
  .ki-route-label::after { transform: scaleX(-1); }
  .ki-route-label span { display: inline-flex; flex: none; align-items: center; gap: .5rem; white-space: nowrap; }
  .ki-route-label svg { width: .95rem; height: .95rem; color: var(--gold); }

  .ki-route {
    --g: 1.5rem; --nd: 3.4rem;
    display: flex; flex-wrap: wrap; justify-content: center; gap: var(--g); margin: 0 auto; padding: 0; list-style: none; max-width: 64rem;
  }
  .ki-stop { position: relative; display: flex; flex: 0 0 100%; max-width: 100%; min-width: 0; }
  @media (min-width: 768px) {
    .ki-route { --g: 1.25rem; row-gap: 2.25rem; }
    .ki-stop {
      flex-basis: calc((100% - (var(--rc) - 1) * var(--g)) / var(--rc) - .5px);
      max-width: calc((100% - (var(--rc) - 1) * var(--g)) / var(--rc) - .5px);
    }
  }
  .ki-stop-link { position: relative; display: flex; flex-direction: column; align-items: center; width: 100%; color: inherit; text-decoration: none; }

  /* Garis penghubung antar titik: dasar (abu) + isian emas yang "tergambar" saat terlihat */
  .ki-stop::before, .ki-stop::after {
    content: ''; position: absolute; z-index: 0; left: 50%; top: calc(var(--nd) / 2 - 1px); width: calc(100% + var(--g)); height: 2px; border-radius: 2px;
  }
  .ki-stop::before { background: repeating-linear-gradient(90deg, var(--border) 0 6px, transparent 6px 11px); }
  .ki-stop::after { background: var(--gradient-gold); transform: scaleX(0); transform-origin: left; transition: transform 1s var(--ease-out) calc(var(--i, 0) * .22s + .45s); }
  .ki-route.is-visible .ki-stop::after { transform: scaleX(1); }
  .ki-stop:last-child::before, .ki-stop:last-child::after { display: none; }
  .ki-route.is-wrap .ki-stop:nth-child(3n)::before, .ki-route.is-wrap .ki-stop:nth-child(3n)::after { display: none; }
  @media (max-width: 767px) {
    /* ponsel: sambungan tegak pendek di antara dua kartu */
    .ki-stop::before, .ki-stop::after { left: calc(50% - 1px); top: 100%; width: 2px; height: var(--g); }
    .ki-stop::before { background: repeating-linear-gradient(180deg, var(--border) 0 5px, transparent 5px 9px); }
    .ki-stop::after { transform: scaleY(0); transform-origin: top; }
    .ki-route.is-visible .ki-stop::after { transform: scaleY(1); }
    .ki-route.is-wrap .ki-stop:nth-child(3n)::before, .ki-route.is-wrap .ki-stop:nth-child(3n)::after { display: block; }
    .ki-route.is-wrap .ki-stop:last-child::before, .ki-route.is-wrap .ki-stop:last-child::after { display: none; }
  }

  .ki-node {
    position: relative; z-index: 1; display: grid; place-items: center; width: var(--nd); height: var(--nd); border-radius: 50%;
    background: var(--card); color: var(--primary); border: 2px solid var(--border);
    box-shadow: 0 0 0 6px var(--background), var(--shadow-soft);
    transition: background-color .4s, color .4s, border-color .4s, transform .5s var(--ease-spring), box-shadow .4s;
  }
  .ki-node svg { width: 1.3rem; height: 1.3rem; }
  .ki-node i {
    position: absolute; right: -.35rem; top: -.35rem; display: grid; place-items: center; min-width: 1.4rem; height: 1.4rem; padding: 0 .3rem;
    border-radius: 999px; font-style: normal; font-family: var(--font-display); font-size: .62rem; font-weight: 800;
    background: var(--primary); color: var(--primary-foreground); border: 2px solid var(--background);
  }
  .ki-stop-card {
    position: relative; display: flex; flex: 1; flex-direction: column; align-items: center; gap: .35rem; width: 100%; margin-top: 1rem;
    padding: 1.15rem 1rem 1.2rem; text-align: center; border-radius: 1.2rem; background: var(--card); border: 1px solid var(--border);
    box-shadow: var(--shadow-soft); overflow: hidden;
    transition: transform .45s var(--ease-out), box-shadow .45s var(--ease-out), border-color .45s;
  }
  .ki-stop-card::before {
    content: ''; position: absolute; inset: 0 0 auto 0; height: 3px; background: var(--gradient-gold); transform: scaleX(0); transition: transform .55s var(--ease-out);
  }
  .ki-stop-cat { font-size: .66rem; font-weight: 700; letter-spacing: .09em; text-transform: uppercase; color: oklch(0.5 0.12 75); }
  .ki-stop-name { font-family: var(--font-display); font-size: 1.02rem; font-weight: 800; line-height: 1.25; color: var(--foreground); }
  .ki-stop-city { display: inline-flex; align-items: center; justify-content: center; gap: .3rem; font-size: .76rem; line-height: 1.4; color: var(--muted-foreground); }
  .ki-stop-city svg { flex: none; width: .8rem; height: .8rem; color: var(--gold); }
  .ki-stop-foot { margin-top: auto; padding-top: .55rem; display: inline-flex; align-items: center; gap: .35rem; font-size: .72rem; font-weight: 700; color: var(--primary); }
  .ki-stop-foot svg { width: .85rem; height: .85rem; transform: rotate(90deg); transition: transform .35s var(--ease-out); }
  @media (hover: hover) {
    .ki-stop-link:hover .ki-stop-card { transform: translateY(-5px); border-color: color-mix(in oklab, var(--gold) 60%, var(--border)); box-shadow: var(--shadow-lift), 0 0 28px -14px var(--gold); }
    .ki-stop-link:hover .ki-stop-card::before { transform: scaleX(1); }
    .ki-stop-link:hover .ki-node { transform: scale(1.08); border-color: var(--gold); }
    .ki-stop-link:hover .ki-stop-foot svg { transform: rotate(90deg) translateX(3px); }
  }
  .ki-stop-link:focus-visible { outline: none; }
  .ki-stop-link:focus-visible .ki-stop-card { box-shadow: 0 0 0 3px color-mix(in oklab, var(--ring) 45%, transparent); }
  /* Destinasi yang sedang dilihat (scroll-spy) */
  .ki-stop-link.is-active .ki-node { background: var(--gradient-gold); color: var(--gold-foreground); border-color: transparent; box-shadow: 0 0 0 6px var(--background), 0 12px 26px -10px color-mix(in oklab, var(--gold) 80%, transparent); }
  .ki-stop-link.is-active .ki-stop-card { border-color: color-mix(in oklab, var(--gold) 70%, var(--border)); }
  .ki-stop-link.is-active .ki-stop-card::before { transform: scaleX(1); }

  /* ---------- Penunjuk titik samping (desktop lebar) ---------- */
  .ki-dots {
    position: fixed; right: 1.1rem; top: 50%; z-index: 30; display: none; flex-direction: column; align-items: center; gap: .15rem; padding: .55rem .4rem;
    border-radius: 999px; background: color-mix(in oklab, var(--card) 86%, transparent); backdrop-filter: blur(14px);
    border: 1px solid var(--border); box-shadow: var(--shadow-soft);
    opacity: 0; pointer-events: none; transform: translate(14px, -50%); transition: opacity .45s var(--ease-out), transform .45s var(--ease-out);
  }
  @media (min-width: 1280px) { .ki-dots { display: flex; } }
  .ki-dots.is-on { opacity: 1; pointer-events: auto; transform: translate(0, -50%); }
  .ki-dot { position: relative; display: grid; place-items: center; width: 1.6rem; height: 1.6rem; border-radius: 999px; }
  .ki-dot::before {
    content: ''; width: .5rem; height: .5rem; border-radius: 999px; background: color-mix(in oklab, var(--primary) 28%, transparent);
    transition: height .45s var(--ease-out), background .3s, width .3s;
  }
  .ki-dot:hover::before { background: var(--primary); }
  .ki-dot.is-active::before { height: 1.25rem; background: var(--gradient-gold); }
  .ki-dot span {
    position: absolute; right: calc(100% + .7rem); top: 50%; padding: .35rem .7rem; border-radius: .6rem; white-space: nowrap;
    font-size: .74rem; font-weight: 600; color: var(--primary-foreground); background: var(--primary);
    opacity: 0; transform: translate(6px, -50%); pointer-events: none; transition: opacity .25s, transform .3s var(--ease-out);
  }
  .ki-dot:hover span, .ki-dot:focus-visible span { opacity: 1; transform: translate(0, -50%); }

  /* ---------- Section destinasi ---------- */
  .ki-section { position: relative; padding: 4.25rem 1rem; }
  @media (min-width: 640px) { .ki-section { padding-inline: 1.5rem; } }
  @media (min-width: 1024px) { .ki-section { padding: 6rem 2rem; } }
  .ki-section.is-alt {
    background: var(--gradient-mesh), color-mix(in oklab, var(--secondary) 55%, transparent);
  }

  .ki-head { position: relative; display: flex; flex-direction: column; align-items: center; text-align: center; max-width: 46rem; margin-inline: auto; isolation: isolate; }
  .ki-head > :not(.ki-ghost) { position: relative; z-index: 1; }
  .ki-ghost {
    position: absolute; z-index: 0; left: 50%; top: -2.3rem; translate: -50% 0; pointer-events: none; user-select: none;
    font-family: var(--font-display); font-weight: 800; font-size: clamp(7.5rem, 20vw, 13.5rem); line-height: .8; letter-spacing: -.05em;
    color: transparent; -webkit-text-stroke: 2px color-mix(in oklab, var(--primary) 9%, transparent);
  }

  .ki-badge {
    position: relative; display: grid; place-items: center; width: 4.25rem; height: 4.25rem; border-radius: 1.3rem; margin-block: .5rem .35rem;
    color: var(--hero-foreground, #fff); background: var(--gradient-navy);
    box-shadow: var(--shadow-lift), inset 0 1px 0 rgb(255 255 255 / .14);
  }
  .ki-badge svg { width: 1.7rem; height: 1.7rem; }
  /* Cincin putus-putus + titik emas yang mengorbit */
  .ki-badge::before, .ki-badge::after { content: ''; position: absolute; inset: -.75rem; border-radius: 50%; pointer-events: none; }
  .ki-badge::before { border: 1.5px dashed color-mix(in oklab, var(--gold) 55%, transparent); animation: kiSpin 28s linear infinite; }
  .ki-badge::after { background: radial-gradient(circle at 50% 0%, var(--gold) 0 .2rem, transparent .24rem); animation: kiSpin 9s linear infinite; }
  .ki-badge b {
    position: absolute; right: -.55rem; top: -.55rem; z-index: 2; min-width: 1.75rem; height: 1.75rem; padding: 0 .35rem; display: grid; place-items: center;
    border-radius: 999px; font-family: var(--font-display); font-size: .72rem; font-weight: 800;
    background: var(--gold); color: oklch(0.22 0.06 262); border: 2px solid var(--background);
  }
  @keyframes kiSpin { to { transform: rotate(360deg); } }

  .ki-meta { display: flex; flex-wrap: wrap; justify-content: center; gap: .5rem; margin-top: 1.1rem; }
  .ki-chip {
    display: inline-flex; align-items: center; gap: .4rem; padding: .32rem .8rem; border-radius: 999px;
    font-size: .72rem; font-weight: 700; letter-spacing: .05em; text-transform: uppercase;
    background: var(--accent); color: var(--primary);
  }
  .ki-chip svg { width: .8rem; height: .8rem; }
  .ki-chip.is-gold { background: color-mix(in oklab, var(--gold) 20%, transparent); color: oklch(0.42 0.1 80); }
  .ki-head h2 {
    margin-top: .9rem; font-size: clamp(1.75rem, 1.15rem + 2.1vw, 2.65rem); line-height: 1.1;
    font-weight: 800; letter-spacing: -0.032em; color: var(--foreground);
  }
  .ki-head h2::after {
    content: ''; display: block; width: 3.25rem; height: .3rem; margin: 1.1rem auto 0; border-radius: 999px; background: var(--gradient-gold);
    transform: scaleX(0); transition: transform .9s var(--ease-out) .35s;
  }
  .ki-head.is-visible h2::after { transform: scaleX(1); }
  .ki-head p { margin-top: 1.1rem; font-size: 1rem; line-height: 1.8; color: var(--muted-foreground); }
  .ki-points { display: grid; grid-template-columns: 1fr; gap: .65rem; width: 100%; margin-top: 1.6rem; }
  @media (min-width: 640px) { .ki-points { grid-template-columns: repeat(var(--pts, 3), minmax(0, 1fr)); } }
  .ki-point {
    display: flex; align-items: center; justify-content: center; gap: .55rem; padding: .75rem .9rem; text-align: left;
    border-radius: 1rem; border: 1px solid var(--border); background: var(--card);
    font-size: .82rem; font-weight: 600; line-height: 1.4; color: var(--foreground); box-shadow: var(--shadow-soft);
    transition: transform .4s var(--ease-out), border-color .4s, box-shadow .4s;
  }
  .ki-point svg { flex: none; width: 1.05rem; height: 1.05rem; color: var(--gold); transition: transform .4s var(--ease-spring); }
  @media (hover: hover) {
    .ki-point:hover { transform: translateY(-3px); border-color: color-mix(in oklab, var(--gold) 55%, var(--border)); box-shadow: var(--shadow-lift); }
    .ki-point:hover svg { transform: scale(1.18) rotate(-8deg); }
  }

  /* ---------- Deretan foto (selalu simetris, baris terakhir di tengah) ---------- */
  .ki-photos { --gap: 1.25rem; display: flex; flex-wrap: wrap; justify-content: center; gap: var(--gap); margin: 3rem auto 0; max-width: 72rem; }
  .ki-photo { flex: 0 0 100%; max-width: 100%; min-width: 0; margin: 0; }
  @media (min-width: 640px) {
    .ki-photo {
      flex-basis: calc((100% - (var(--cols-sm) - 1) * var(--gap)) / var(--cols-sm) - .5px);
      max-width: calc((100% - (var(--cols-sm) - 1) * var(--gap)) / var(--cols-sm) - .5px);
    }
    .ki-photos[data-n="1"] .ki-photo { flex-basis: min(100%, 46rem); max-width: 46rem; }
  }
  @media (min-width: 1024px) {
    .ki-photos { --gap: 1.5rem; }
    .ki-photo {
      flex-basis: calc((100% - (var(--cols) - 1) * var(--gap)) / var(--cols) - .5px);
      max-width: calc((100% - (var(--cols) - 1) * var(--gap)) / var(--cols) - .5px);
    }
    .ki-photos[data-n="1"] .ki-photo { flex-basis: min(100%, 46rem); max-width: 46rem; }
  }
  .ki-card {
    position: relative; display: flex; flex-direction: column; height: 100%; overflow: hidden; border-radius: 1.4rem;
    background: var(--card); border: 1px solid var(--border); box-shadow: var(--shadow-soft);
    transform: perspective(1100px) translateY(var(--lift, 0px)) rotateX(var(--rx, 0deg)) rotateY(var(--ry, 0deg));
    transition: transform .5s var(--ease-out), box-shadow .5s var(--ease-out), border-color .5s;
  }
  /* Sorotan lembut mengikuti kursor */
  .ki-card::after, .ki-vcard::after {
    content: ''; position: absolute; inset: 0; z-index: 3; pointer-events: none; opacity: 0; transition: opacity .4s;
    background: radial-gradient(360px circle at var(--mx, 50%) var(--my, 0%), rgb(255 255 255 / .16), transparent 60%);
  }
  @media (hover: hover) {
    .ki-photo:hover .ki-card { --lift: -6px; box-shadow: var(--shadow-lift), 0 0 34px -14px var(--gold); border-color: color-mix(in oklab, var(--gold) 60%, var(--border)); }
    .ki-photo:hover .ki-card::after, .ki-video:hover .ki-vcard::after { opacity: 1; }
    .ki-photo:hover .ki-zoom { opacity: 1; transform: scale(1); }
    .ki-photo:hover .ki-img { transform: scale(1.04); }
  }
  .ki-frame {
    position: relative; display: block; width: 100%; aspect-ratio: 4 / 3; overflow: hidden; padding: 0; border: 0; cursor: zoom-in;
    background: linear-gradient(145deg, oklch(0.2 0.06 262), oklch(0.28 0.08 258));
  }
  .ki-photos[data-n="1"] .ki-frame { aspect-ratio: 16 / 10; }
  /* Latar buram dari foto yang sama: mengisi sisi kosong tanpa memotong foto utama */
  .ki-frame .ki-bg {
    position: absolute; inset: 0; width: 100%; height: 100%; object-fit: cover;
    filter: blur(22px) brightness(.62) saturate(1.2); transform: scale(1.2);
  }
  .ki-frame .ki-img { position: absolute; inset: 0; width: 100%; height: 100%; object-fit: contain; object-position: center; transition: transform .9s var(--ease-out); }
  .stagger-group.is-visible .ki-img { animation: kiSettle 1.3s var(--ease-out) calc(var(--i, 0) * 80ms + 120ms) backwards; }
  @keyframes kiSettle { from { transform: scale(1.14); opacity: 0; } to { transform: none; opacity: 1; } }
  .ki-frame:focus-visible { outline: 3px solid var(--gold); outline-offset: -3px; }
  .ki-count {
    position: absolute; left: .8rem; top: .8rem; z-index: 2; padding: .25rem .65rem; border-radius: 999px;
    font-size: .68rem; font-weight: 700; letter-spacing: .04em; font-variant-numeric: tabular-nums;
    color: #fff; background: rgb(8 14 34 / .5); backdrop-filter: blur(8px); border: 1px solid rgb(255 255 255 / .16);
  }
  .ki-zoom {
    position: absolute; right: .8rem; bottom: .8rem; z-index: 2; display: grid; place-items: center; width: 2.5rem; height: 2.5rem;
    border-radius: 999px; background: rgb(8 14 34 / .55); color: #fff; backdrop-filter: blur(8px); border: 1px solid rgb(255 255 255 / .18);
    opacity: 0; transform: scale(.8); transition: opacity .3s, transform .4s var(--ease-spring);
  }
  .ki-zoom svg { width: 1rem; height: 1rem; }
  @media (hover: none) { .ki-zoom { opacity: 1; transform: none; } }
  .ki-cap {
    position: relative; display: flex; align-items: center; justify-content: center; flex: 1; gap: .55rem; padding: .95rem 1.1rem; text-align: center;
    font-size: .84rem; line-height: 1.45; color: var(--muted-foreground); border-top: 1px solid var(--border);
  }
  .ki-cap::before { content: ''; flex: none; width: .4rem; height: .4rem; border-radius: 50%; background: var(--gold); box-shadow: 0 0 0 4px color-mix(in oklab, var(--gold) 20%, transparent); }
  .ki-empty { margin: 2.5rem auto 0; max-width: 32rem; padding: 1.5rem; text-align: center; border: 1px dashed var(--border); border-radius: 1rem; font-size: .9rem; color: var(--muted-foreground); }

  /* ---------- Tombol aksi di bawah foto ---------- */
  .ki-actions { display: flex; flex-wrap: wrap; align-items: center; justify-content: center; gap: .75rem; margin-top: 2.5rem; }
  .ki-btn {
    display: inline-flex; align-items: center; gap: .6rem; padding: .75rem 1.35rem; border-radius: 999px; cursor: pointer;
    font-size: .85rem; font-weight: 700; color: var(--primary-foreground); background: var(--primary); border: 1px solid var(--primary);
    box-shadow: 0 14px 28px -16px color-mix(in oklab, var(--primary) 90%, transparent);
    transition: transform .4s var(--ease-out), box-shadow .4s, background-color .3s, color .3s, border-color .3s;
  }
  .ki-btn svg { width: 1rem; height: 1rem; color: var(--gold); transition: transform .4s var(--ease-out); }
  .ki-btn:hover { transform: translateY(-2px); box-shadow: var(--shadow-lift); }
  .ki-btn:hover svg.is-arrow { transform: translateX(3px); }
  .ki-btn.is-ghost { color: var(--primary); background: transparent; border-color: color-mix(in oklab, var(--primary) 25%, transparent); box-shadow: none; }
  .ki-btn.is-ghost:hover { background: var(--primary); color: var(--primary-foreground); border-color: var(--primary); }
  .ki-btn.is-ghost svg.is-down { transform: rotate(90deg); }
  .ki-btn.is-ghost:hover svg.is-down { transform: rotate(90deg) translateX(3px); }

  /* ---------- Video (panel gelap bergaya "bioskop") ---------- */
  .ki-videos-sec { position: relative; overflow: hidden; padding: 4.5rem 1rem; color: #fff; background: var(--gradient-navy-radial); }
  @media (min-width: 640px) { .ki-videos-sec { padding-inline: 1.5rem; } }
  @media (min-width: 1024px) { .ki-videos-sec { padding: 6.5rem 2rem; } }
  .ki-videos { display: flex; flex-wrap: wrap; justify-content: center; align-items: center; gap: 2rem; margin-top: 3.25rem; }
  .ki-video { flex: 0 0 100%; max-width: 100%; min-width: 0; display: flex; flex-direction: column; }
  @media (min-width: 768px) {
    .ki-video { flex-basis: calc(50% - 1rem - .5px); max-width: calc(50% - 1rem - .5px); }
    /* Video lebar tunggal: dibuat besar di tengah supaya jelas terlihat */
    .ki-video.is-landscape:only-child { flex-basis: min(100%, 56rem); max-width: 56rem; }
  }
  .ki-video.is-portrait { flex: 0 0 min(100%, 24rem); max-width: 24rem; }
  .ki-vcard {
    position: relative; overflow: hidden; border-radius: 1.5rem; background: rgb(255 255 255 / .06);
    border: 1px solid rgb(255 255 255 / .13); backdrop-filter: blur(12px); box-shadow: 0 30px 60px -34px rgb(0 0 0 / .7);
    transition: transform .5s var(--ease-out), box-shadow .5s var(--ease-out), border-color .5s;
  }
  @media (hover: hover) {
    .ki-video:hover .ki-vcard { transform: translateY(-6px); border-color: color-mix(in oklab, var(--gold) 65%, transparent); box-shadow: 0 40px 70px -34px rgb(0 0 0 / .85), 0 0 40px -16px var(--gold); }
    .ki-video:hover .ki-vbg:not(.is-blur) { transform: scale(1.05); }
  }
  .ki-vframe { position: relative; overflow: hidden; aspect-ratio: 16 / 9; background: #000; }
  .ki-video.is-portrait .ki-vframe { aspect-ratio: 9 / 16; }
  .ki-vposter {
    position: absolute; inset: 0; display: flex; align-items: center; justify-content: center; width: 100%; height: 100%; padding: 0; border: 0;
    color: #fff; cursor: pointer; background: radial-gradient(70% 80% at 80% 110%, oklch(0.5 0.12 195), transparent 60%), linear-gradient(145deg, oklch(0.3 0.09 258), oklch(0.2 0.07 262));
  }
  .ki-vposter .ki-vbg { position: absolute; inset: 0; width: 100%; height: 100%; object-fit: cover; transition: transform .9s var(--ease-out); }
  .ki-vposter .ki-vbg.is-blur { filter: blur(22px) brightness(.6) saturate(1.15); transform: scale(1.2); }
  .ki-vposter .ki-vimg { position: absolute; inset: 0; width: 100%; height: 100%; object-fit: contain; }
  .ki-vposter::after { content: ''; position: absolute; inset: 0; background: linear-gradient(to top, oklch(0.14 0.05 262 / .6), transparent 60%); pointer-events: none; }
  .ki-vtag {
    position: absolute; left: .85rem; top: .85rem; z-index: 2; display: inline-flex; align-items: center; gap: .35rem;
    padding: .28rem .7rem; border-radius: 999px; font-size: 10px; font-weight: 700; letter-spacing: .06em; text-transform: uppercase;
    background: rgb(255 255 255 / .18); backdrop-filter: blur(8px); border: 1px solid rgb(255 255 255 / .2);
  }
  .ki-vtag svg { width: .75rem; height: .75rem; }
  .ki-play {
    position: relative; z-index: 2; display: grid; place-items: center; width: 4.9rem; height: 4.9rem; border-radius: 999px;
    background: #fff; color: var(--primary); box-shadow: 0 14px 34px -8px rgb(0 0 0 / .6);
    transition: transform .45s var(--ease-spring), background-color .3s;
  }
  .ki-play::before, .ki-play::after { content: ''; position: absolute; inset: 0; border-radius: inherit; border: 2px solid #fff; opacity: 0; animation: kiRing 2.4s ease-out infinite; }
  .ki-play::after { animation-delay: 1.2s; }
  @keyframes kiRing { 0% { transform: scale(1); opacity: .7; } 100% { transform: scale(1.9); opacity: 0; } }
  .ki-vposter:hover .ki-play { transform: scale(1.12); background: var(--gold); }
  .ki-vplayer { position: absolute; inset: 0; z-index: 4; width: 100%; height: 100%; border: 0; background: #000; }
  .ki-vload { position: absolute; inset: 0; z-index: 3; display: none; align-items: center; justify-content: center; color: #fff; }
  [data-kvid].is-playing .ki-vload { display: flex; }
  [data-kvid].is-playing .ki-vposter { visibility: hidden; }
  .ki-vstop {
    position: absolute; right: .6rem; top: .6rem; z-index: 6; display: none; width: 2.1rem; height: 2.1rem; align-items: center; justify-content: center;
    border-radius: 999px; background: rgb(0 0 0 / .65); color: #fff; border: 1px solid rgb(255 255 255 / .2); cursor: pointer; transition: background-color .25s, transform .3s var(--ease-out);
  }
  .ki-vstop:hover { background: rgb(0 0 0 / .85); transform: rotate(90deg); }
  [data-kvid].is-playing .ki-vstop { display: flex; }
  .ki-vinfo { position: relative; z-index: 1; padding: 1.35rem 1.5rem 1.6rem; text-align: center; }
  .ki-vinfo h3 { font-family: var(--font-display); font-size: 1.15rem; font-weight: 700; color: #fff; }
  .ki-vinfo .ki-chip { margin-top: .7rem; background: rgb(255 255 255 / .12); color: #fff; }
  .ki-vinfo p { margin-top: .6rem; font-size: .86rem; line-height: 1.65; color: rgb(255 255 255 / .72); }
  .ki-vlink { display: inline-flex; align-items: center; gap: .35rem; margin-top: .85rem; font-size: .82rem; font-weight: 600; color: oklch(0.9 0.1 92); }
  .ki-vlink:hover { text-decoration: underline; }

  @media (prefers-reduced-motion: reduce) {
    .ki-badge::before, .ki-badge::after, .ki-play::before, .ki-play::after { animation: none !important; }
    .ki-stop::after, .ki-head h2::after { transition: none; transform: none; }
    .stagger-group.is-visible .ki-img { animation: none; }
    .ki-card, .ki-vcard, .ki-stop-card, .ki-point, .ki-cell-icon, .ki-btn, .ki-dots { transition: none; }
  }
</style>

<?php if (isset($component)) { $__componentOriginala9d931d4f11b4d2850df99e991db1dca = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginala9d931d4f11b4d2850df99e991db1dca = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.page-hero','data' => ['crumb' => 'Kunjungan Industri','kicker' => 'Belajar di Luar Kelas','title' => $judul,'desc' => 'Dokumentasi perjalanan siswa SMK INFOKOM Kota Bogor mengunjungi kampus, destinasi edukasi, dan tempat bersejarah.']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('page-hero'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['crumb' => 'Kunjungan Industri','kicker' => 'Belajar di Luar Kelas','title' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($judul),'desc' => 'Dokumentasi perjalanan siswa SMK INFOKOM Kota Bogor mengunjungi kampus, destinasi edukasi, dan tempat bersejarah.']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginala9d931d4f11b4d2850df99e991db1dca)): ?>
<?php $attributes = $__attributesOriginala9d931d4f11b4d2850df99e991db1dca; ?>
<?php unset($__attributesOriginala9d931d4f11b4d2850df99e991db1dca); ?>
<?php endif; ?>
<?php if (isset($__componentOriginala9d931d4f11b4d2850df99e991db1dca)): ?>
<?php $component = $__componentOriginala9d931d4f11b4d2850df99e991db1dca; ?>
<?php unset($__componentOriginala9d931d4f11b4d2850df99e991db1dca); ?>
<?php endif; ?>


<div class="ki-ribbon-wrap">
  <div class="ki-ribbon reveal-scale">
    <div class="ki-cell">
      <span class="ki-cell-icon"><?php if (isset($component)) { $__componentOriginalce262628e3a8d44dc38fd1f3965181bc = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalce262628e3a8d44dc38fd1f3965181bc = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.icon','data' => ['name' => 'map-pin']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'map-pin']); ?>
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
      <span class="ki-cell-val"><?php echo e($kotaTujuan ?: '-'); ?></span>
      <span class="ki-cell-lbl">Kota Tujuan</span>
    </div>
    <div class="ki-cell">
      <span class="ki-cell-icon"><?php if (isset($component)) { $__componentOriginalce262628e3a8d44dc38fd1f3965181bc = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalce262628e3a8d44dc38fd1f3965181bc = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.icon','data' => ['name' => 'calendar-days']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'calendar-days']); ?>
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
      <span class="ki-cell-val"><?php echo e($periode ?: '-'); ?></span>
      <span class="ki-cell-lbl">Waktu Pelaksanaan</span>
    </div>
    <div class="ki-cell">
      <span class="ki-cell-icon"><?php if (isset($component)) { $__componentOriginalce262628e3a8d44dc38fd1f3965181bc = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalce262628e3a8d44dc38fd1f3965181bc = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.icon','data' => ['name' => 'layers']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'layers']); ?>
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
      <span class="ki-cell-val"><span data-countup="<?php echo e($jumlahLokasi); ?>">0</span> <small>Lokasi</small></span>
      <span class="ki-cell-lbl">Destinasi</span>
    </div>
    <div class="ki-cell">
      <span class="ki-cell-icon"><?php if (isset($component)) { $__componentOriginalce262628e3a8d44dc38fd1f3965181bc = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalce262628e3a8d44dc38fd1f3965181bc = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.icon','data' => ['name' => 'camera']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'camera']); ?>
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
      <span class="ki-cell-val"><span data-countup="<?php echo e($totalFoto); ?>">0</span> <small>Foto</small></span>
      <span class="ki-cell-lbl">Dokumentasi</span>
    </div>
  </div>
</div>


<section class="ki-intro">
  <div class="mx-auto max-w-6xl">
    <?php if (isset($component)) { $__componentOriginal6a0a1523cc2edf33c83fe20a5d1f7f78 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal6a0a1523cc2edf33c83fe20a5d1f7f78 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.section-title','data' => ['kicker' => 'Tentang Kegiatan','title' => 'Belajar Langsung dari Dunia Nyata','desc' => $intro]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('section-title'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['kicker' => 'Tentang Kegiatan','title' => 'Belajar Langsung dari Dunia Nyata','desc' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($intro)]); ?>
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

    <?php if($jumlahLokasi > 1): ?>
      <div class="ki-route-wrap">
        <p class="ki-route-label reveal"><span><?php if (isset($component)) { $__componentOriginalce262628e3a8d44dc38fd1f3965181bc = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalce262628e3a8d44dc38fd1f3965181bc = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.icon','data' => ['name' => 'map-pin']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'map-pin']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalce262628e3a8d44dc38fd1f3965181bc)): ?>
<?php $attributes = $__attributesOriginalce262628e3a8d44dc38fd1f3965181bc; ?>
<?php unset($__attributesOriginalce262628e3a8d44dc38fd1f3965181bc); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalce262628e3a8d44dc38fd1f3965181bc)): ?>
<?php $component = $__componentOriginalce262628e3a8d44dc38fd1f3965181bc; ?>
<?php unset($__componentOriginalce262628e3a8d44dc38fd1f3965181bc); ?>
<?php endif; ?>Rute Perjalanan</span></p>
        <ol class="ki-route stagger-group <?php echo e($jumlahLokasi > 4 ? 'is-wrap' : ''); ?>" style="--rc: <?php echo e($routeCols); ?>;">
          <?php $__currentLoopData = $lokasiList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $l): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <li class="ki-stop stagger-item">
              <a href="#lokasi-<?php echo e($l->id); ?>" class="ki-stop-link" data-ki-route="<?php echo e($l->id); ?>">
                <span class="ki-node"><?php if (isset($component)) { $__componentOriginalce262628e3a8d44dc38fd1f3965181bc = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalce262628e3a8d44dc38fd1f3965181bc = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.icon','data' => ['name' => $l->icon]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($l->icon)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalce262628e3a8d44dc38fd1f3965181bc)): ?>
<?php $attributes = $__attributesOriginalce262628e3a8d44dc38fd1f3965181bc; ?>
<?php unset($__attributesOriginalce262628e3a8d44dc38fd1f3965181bc); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalce262628e3a8d44dc38fd1f3965181bc)): ?>
<?php $component = $__componentOriginalce262628e3a8d44dc38fd1f3965181bc; ?>
<?php unset($__componentOriginalce262628e3a8d44dc38fd1f3965181bc); ?>
<?php endif; ?><i><?php echo e(str_pad($i + 1, 2, '0', STR_PAD_LEFT)); ?></i></span>
                <span class="ki-stop-card">
                  <?php if($l->kategori): ?> <span class="ki-stop-cat"><?php echo e($l->kategori); ?></span> <?php endif; ?>
                  <strong class="ki-stop-name"><?php echo e($l->nama); ?></strong>
                  <?php if($l->kota): ?> <span class="ki-stop-city"><?php if (isset($component)) { $__componentOriginalce262628e3a8d44dc38fd1f3965181bc = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalce262628e3a8d44dc38fd1f3965181bc = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.icon','data' => ['name' => 'map-pin']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'map-pin']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalce262628e3a8d44dc38fd1f3965181bc)): ?>
<?php $attributes = $__attributesOriginalce262628e3a8d44dc38fd1f3965181bc; ?>
<?php unset($__attributesOriginalce262628e3a8d44dc38fd1f3965181bc); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalce262628e3a8d44dc38fd1f3965181bc)): ?>
<?php $component = $__componentOriginalce262628e3a8d44dc38fd1f3965181bc; ?>
<?php unset($__componentOriginalce262628e3a8d44dc38fd1f3965181bc); ?>
<?php endif; ?><?php echo e($l->kota); ?></span> <?php endif; ?>
                  <span class="ki-stop-foot"><?php echo e($l->fotos->count()); ?> foto <?php if (isset($component)) { $__componentOriginalce262628e3a8d44dc38fd1f3965181bc = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalce262628e3a8d44dc38fd1f3965181bc = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.icon','data' => ['name' => 'arrow-right']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'arrow-right']); ?>
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
            </li>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ol>
      </div>
    <?php endif; ?>
  </div>
</section>


<?php if($jumlahLokasi > 1): ?>
  <nav class="ki-dots" data-ki-dots aria-label="Navigasi destinasi">
    <?php $__currentLoopData = $lokasiList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $l): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
      <a href="#lokasi-<?php echo e($l->id); ?>" class="ki-dot" data-ki-dot="<?php echo e($l->id); ?>" aria-label="<?php echo e($l->nama); ?>"><span><?php echo e($l->nama); ?></span></a>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
  </nav>
<?php endif; ?>



<div data-lightbox-scope data-ki-scope>
  <?php $__empty_1 = true; $__currentLoopData = $lokasiList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $lokasi): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
    <?php
      $n = $lokasi->fotos->count();
      // Jumlah kolom disesuaikan dengan jumlah foto agar deretan selalu seimbang.
      $cols = match (true) { $n <= 1 => 1, $n === 2 => 2, $n === 3 => 3, $n === 4 => 2, default => 3 };
      $colsSm = min($cols, 2);
      $poin = $lokasi->sorotanList();
      $berikut = $lokasiList->get($i + 1);
    ?>

    <section id="lokasi-<?php echo e($lokasi->id); ?>" data-ki-section="<?php echo e($lokasi->id); ?>" class="ki-section scroll-mt-24 <?php echo e($i % 2 === 1 ? 'is-alt' : ''); ?>">
      <div class="mx-auto max-w-6xl">

        <div class="ki-head reveal">
          <span class="ki-ghost" aria-hidden="true"><?php echo e(str_pad($i + 1, 2, '0', STR_PAD_LEFT)); ?></span>
          <span class="ki-badge"><?php if (isset($component)) { $__componentOriginalce262628e3a8d44dc38fd1f3965181bc = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalce262628e3a8d44dc38fd1f3965181bc = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.icon','data' => ['name' => $lokasi->icon]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($lokasi->icon)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalce262628e3a8d44dc38fd1f3965181bc)): ?>
<?php $attributes = $__attributesOriginalce262628e3a8d44dc38fd1f3965181bc; ?>
<?php unset($__attributesOriginalce262628e3a8d44dc38fd1f3965181bc); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalce262628e3a8d44dc38fd1f3965181bc)): ?>
<?php $component = $__componentOriginalce262628e3a8d44dc38fd1f3965181bc; ?>
<?php unset($__componentOriginalce262628e3a8d44dc38fd1f3965181bc); ?>
<?php endif; ?><b><?php echo e(str_pad($i + 1, 2, '0', STR_PAD_LEFT)); ?></b></span>

          <?php if($lokasi->kategori || $lokasi->kota || $n > 0): ?>
            <div class="ki-meta">
              <?php if($lokasi->kategori): ?> <span class="ki-chip is-gold"><?php echo e($lokasi->kategori); ?></span> <?php endif; ?>
              <?php if($lokasi->kota): ?> <span class="ki-chip"><?php if (isset($component)) { $__componentOriginalce262628e3a8d44dc38fd1f3965181bc = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalce262628e3a8d44dc38fd1f3965181bc = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.icon','data' => ['name' => 'map-pin']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'map-pin']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalce262628e3a8d44dc38fd1f3965181bc)): ?>
<?php $attributes = $__attributesOriginalce262628e3a8d44dc38fd1f3965181bc; ?>
<?php unset($__attributesOriginalce262628e3a8d44dc38fd1f3965181bc); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalce262628e3a8d44dc38fd1f3965181bc)): ?>
<?php $component = $__componentOriginalce262628e3a8d44dc38fd1f3965181bc; ?>
<?php unset($__componentOriginalce262628e3a8d44dc38fd1f3965181bc); ?>
<?php endif; ?><?php echo e($lokasi->kota); ?></span> <?php endif; ?>
              <?php if($n > 0): ?> <span class="ki-chip"><?php if (isset($component)) { $__componentOriginalce262628e3a8d44dc38fd1f3965181bc = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalce262628e3a8d44dc38fd1f3965181bc = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.icon','data' => ['name' => 'camera']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'camera']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalce262628e3a8d44dc38fd1f3965181bc)): ?>
<?php $attributes = $__attributesOriginalce262628e3a8d44dc38fd1f3965181bc; ?>
<?php unset($__attributesOriginalce262628e3a8d44dc38fd1f3965181bc); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalce262628e3a8d44dc38fd1f3965181bc)): ?>
<?php $component = $__componentOriginalce262628e3a8d44dc38fd1f3965181bc; ?>
<?php unset($__componentOriginalce262628e3a8d44dc38fd1f3965181bc); ?>
<?php endif; ?><?php echo e($n); ?> Foto</span> <?php endif; ?>
            </div>
          <?php endif; ?>

          <h2><?php echo e($lokasi->nama); ?></h2>
          <?php if($lokasi->deskripsi): ?> <p><?php echo e($lokasi->deskripsi); ?></p> <?php endif; ?>

          <?php if(count($poin)): ?>
            <div class="ki-points" style="--pts: <?php echo e(min(count($poin), 3)); ?>">
              <?php $__currentLoopData = $poin; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <span class="ki-point"><?php if (isset($component)) { $__componentOriginalce262628e3a8d44dc38fd1f3965181bc = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalce262628e3a8d44dc38fd1f3965181bc = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.icon','data' => ['name' => 'check-circle']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'check-circle']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalce262628e3a8d44dc38fd1f3965181bc)): ?>
<?php $attributes = $__attributesOriginalce262628e3a8d44dc38fd1f3965181bc; ?>
<?php unset($__attributesOriginalce262628e3a8d44dc38fd1f3965181bc); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalce262628e3a8d44dc38fd1f3965181bc)): ?>
<?php $component = $__componentOriginalce262628e3a8d44dc38fd1f3965181bc; ?>
<?php unset($__componentOriginalce262628e3a8d44dc38fd1f3965181bc); ?>
<?php endif; ?><?php echo e($p); ?></span>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
          <?php endif; ?>
        </div>

        <?php if($n > 0): ?>
          <div class="ki-photos stagger-group" data-n="<?php echo e($n); ?>" style="--cols: <?php echo e($cols); ?>; --cols-sm: <?php echo e($colsSm); ?>;">
            <?php $__currentLoopData = $lokasi->fotos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $fi => $foto): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <?php
                $url = $foto->url();
                $cap = $foto->keterangan ?: $lokasi->nama;
              ?>
              <figure class="ki-photo stagger-item">
                <div class="ki-card" data-ki-tilt>
                  <button type="button" class="ki-frame" data-lightbox-trigger="<?php echo e($url); ?>" data-lightbox-caption="<?php echo e($lokasi->nama); ?> - <?php echo e($cap); ?>" aria-label="Perbesar foto: <?php echo e($cap); ?>">
                    <img src="<?php echo e($url); ?>" alt="" aria-hidden="true" class="ki-bg" loading="lazy" decoding="async" />
                    <img src="<?php echo e($url); ?>" alt="<?php echo e($cap); ?>" class="ki-img" loading="lazy" decoding="async" />
                    <?php if($n > 1): ?> <span class="ki-count" aria-hidden="true"><?php echo e($fi + 1); ?> / <?php echo e($n); ?></span> <?php endif; ?>
                    <span class="ki-zoom" aria-hidden="true"><?php if (isset($component)) { $__componentOriginalce262628e3a8d44dc38fd1f3965181bc = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalce262628e3a8d44dc38fd1f3965181bc = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.icon','data' => ['name' => 'maximize']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'maximize']); ?>
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
                  </button>
                  <figcaption class="ki-cap"><?php echo e($cap); ?></figcaption>
                </div>
              </figure>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </div>
        <?php else: ?>
          <p class="ki-empty">Foto untuk destinasi ini belum ditambahkan.</p>
        <?php endif; ?>

        <?php if($n > 1 || $berikut || $videos->isNotEmpty()): ?>
          <div class="ki-actions reveal">
            <?php if($n > 1): ?>
              <button type="button" class="ki-btn" data-ki-open="<?php echo e($lokasi->id); ?>">
                <?php if (isset($component)) { $__componentOriginalce262628e3a8d44dc38fd1f3965181bc = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalce262628e3a8d44dc38fd1f3965181bc = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.icon','data' => ['name' => 'maximize']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'maximize']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalce262628e3a8d44dc38fd1f3965181bc)): ?>
<?php $attributes = $__attributesOriginalce262628e3a8d44dc38fd1f3965181bc; ?>
<?php unset($__attributesOriginalce262628e3a8d44dc38fd1f3965181bc); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalce262628e3a8d44dc38fd1f3965181bc)): ?>
<?php $component = $__componentOriginalce262628e3a8d44dc38fd1f3965181bc; ?>
<?php unset($__componentOriginalce262628e3a8d44dc38fd1f3965181bc); ?>
<?php endif; ?> Lihat semua <?php echo e($n); ?> foto
              </button>
            <?php endif; ?>
            <?php if($berikut): ?>
              <a href="#lokasi-<?php echo e($berikut->id); ?>" class="ki-btn is-ghost">Berikutnya: <?php echo e($berikut->nama); ?> <?php if (isset($component)) { $__componentOriginalce262628e3a8d44dc38fd1f3965181bc = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalce262628e3a8d44dc38fd1f3965181bc = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.icon','data' => ['name' => 'arrow-right','class' => 'is-down']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'arrow-right','class' => 'is-down']); ?>
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
            <?php elseif($videos->isNotEmpty()): ?>
              <a href="#video" class="ki-btn is-ghost">Lanjut ke video dokumentasi <?php if (isset($component)) { $__componentOriginalce262628e3a8d44dc38fd1f3965181bc = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalce262628e3a8d44dc38fd1f3965181bc = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.icon','data' => ['name' => 'arrow-right','class' => 'is-down']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'arrow-right','class' => 'is-down']); ?>
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
            <?php endif; ?>
          </div>
        <?php endif; ?>
      </div>
    </section>
  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
    <section class="section-pad px-4">
      <p class="mx-auto max-w-md text-center text-sm text-muted-foreground">Belum ada data kunjungan industri.</p>
    </section>
  <?php endif; ?>
</div>


<?php if($videos->isNotEmpty()): ?>
<section id="video" class="ki-videos-sec scroll-mt-24">
  <div class="pointer-events-none absolute inset-0 bg-grain"></div>
  <span class="bg-orb float-y -left-16 -top-16 h-64 w-64 bg-gold/20"></span>
  <span class="bg-orb float-y h-64 w-64 bg-teal/25" style="right:-4rem; bottom:-4rem; animation-delay:1s;"></span>

  <div class="relative mx-auto" style="max-width: 80rem;">
    <?php if (isset($component)) { $__componentOriginal6a0a1523cc2edf33c83fe20a5d1f7f78 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal6a0a1523cc2edf33c83fe20a5d1f7f78 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.section-title','data' => ['kicker' => 'Video','title' => 'Video Dokumentasi','desc' => 'Tekan tombol putar untuk menonton momen kunjungan industri.','light' => true]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('section-title'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['kicker' => 'Video','title' => 'Video Dokumentasi','desc' => 'Tekan tombol putar untuk menonton momen kunjungan industri.','light' => true]); ?>
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

    <div class="ki-videos stagger-group">
      <?php $__currentLoopData = $videos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php
          $src = $v->playerSrc();
          $poster = $v->posterUrl();
          $posterIsCustom = (bool) $v->sampul;
        ?>
        <article class="ki-video stagger-item <?php echo e($v->isPortrait() ? 'is-portrait' : 'is-landscape'); ?>">
          <div class="ki-vcard" data-ki-glow>
            <div class="ki-vframe" data-kvid data-type="<?php echo e($v->playerType()); ?>" data-src="<?php echo e($src); ?>" data-title="<?php echo e($v->judul); ?>">
              <button type="button" class="ki-vstop" data-kvid-stop aria-label="Tutup video"><?php if (isset($component)) { $__componentOriginalce262628e3a8d44dc38fd1f3965181bc = $component; } ?>
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
<?php endif; ?></button>
              <span class="ki-vload"><span class="btn-spinner" style="width:1.6rem;height:1.6rem;"></span></span>

              <button type="button" class="ki-vposter" data-kvid-play aria-label="Putar video: <?php echo e($v->judul); ?>">
                <?php if($poster): ?>
                  <?php if($posterIsCustom): ?>
                    <img src="<?php echo e($poster); ?>" alt="" aria-hidden="true" class="ki-vbg is-blur" loading="lazy" />
                    <img src="<?php echo e($poster); ?>" alt="<?php echo e($v->judul); ?>" class="ki-vimg" loading="lazy" />
                  <?php else: ?>
                    <img src="<?php echo e($poster); ?>" alt="<?php echo e($v->judul); ?>" class="ki-vbg" loading="lazy" />
                  <?php endif; ?>
                <?php endif; ?>
                <span class="ki-vtag"><?php if (isset($component)) { $__componentOriginalce262628e3a8d44dc38fd1f3965181bc = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalce262628e3a8d44dc38fd1f3965181bc = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.icon','data' => ['name' => $v->icon()]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($v->icon())]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalce262628e3a8d44dc38fd1f3965181bc)): ?>
<?php $attributes = $__attributesOriginalce262628e3a8d44dc38fd1f3965181bc; ?>
<?php unset($__attributesOriginalce262628e3a8d44dc38fd1f3965181bc); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalce262628e3a8d44dc38fd1f3965181bc)): ?>
<?php $component = $__componentOriginalce262628e3a8d44dc38fd1f3965181bc; ?>
<?php unset($__componentOriginalce262628e3a8d44dc38fd1f3965181bc); ?>
<?php endif; ?><?php echo e($v->providerLabel()); ?></span>
                <span class="ki-play">
                  <svg viewBox="0 0 24 24" fill="currentColor" class="ml-1 h-7 w-7" aria-hidden="true"><path d="M8 5.5v13a1 1 0 0 0 1.5.86l10.5-6.5a1 1 0 0 0 0-1.72L9.5 4.64A1 1 0 0 0 8 5.5Z"/></svg>
                </span>
              </button>
            </div>

            <div class="ki-vinfo">
              <h3><?php echo e($v->judul); ?></h3>
              <?php if($v->lokasi): ?>
                <span class="ki-chip"><?php if (isset($component)) { $__componentOriginalce262628e3a8d44dc38fd1f3965181bc = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalce262628e3a8d44dc38fd1f3965181bc = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.icon','data' => ['name' => 'map-pin']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'map-pin']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalce262628e3a8d44dc38fd1f3965181bc)): ?>
<?php $attributes = $__attributesOriginalce262628e3a8d44dc38fd1f3965181bc; ?>
<?php unset($__attributesOriginalce262628e3a8d44dc38fd1f3965181bc); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalce262628e3a8d44dc38fd1f3965181bc)): ?>
<?php $component = $__componentOriginalce262628e3a8d44dc38fd1f3965181bc; ?>
<?php unset($__componentOriginalce262628e3a8d44dc38fd1f3965181bc); ?>
<?php endif; ?><?php echo e($v->lokasi->nama); ?></span>
              <?php endif; ?>
              <?php if($v->deskripsi): ?> <p><?php echo e($v->deskripsi); ?></p> <?php endif; ?>
              <?php if($v->source_url): ?>
                <a href="<?php echo e($v->source_url); ?>" target="_blank" rel="noopener" class="ki-vlink">Buka di sumber <?php if (isset($component)) { $__componentOriginalce262628e3a8d44dc38fd1f3965181bc = $component; } ?>
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
<?php endif; ?></a>
              <?php endif; ?>
            </div>
          </div>
        </article>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
  </div>
</section>
<?php endif; ?>


<section class="section-pad px-4 sm:px-6 lg:px-8">
  <div class="reveal relative mx-auto max-w-6xl overflow-hidden rounded-3xl bg-navy-radial px-8 py-16 text-center text-hero-foreground shadow-lift sm:px-16">
    <div class="pointer-events-none absolute inset-0 bg-grain"></div>
    <span class="bg-orb float-y -left-10 -top-10 h-52 w-52 bg-gold/25"></span>
    <span class="bg-orb float-y h-52 w-52 bg-teal/25" style="right:-2.5rem; bottom:-2.5rem; animation-delay:1s;"></span>
    <div class="relative">
      <h2 class="font-display text-3xl font-bold sm:text-4xl">Belajar, Berpetualang, <span class="text-gradient-gold">Bertumbuh</span></h2>
      <p class="mx-auto mt-3 max-w-xl text-sm text-white/75 sm:text-base">Bergabunglah bersama <?php echo e($site['school']['brand_top']); ?> dan rasakan pengalaman belajar yang tidak hanya di dalam kelas.</p>
      <div class="mt-8 flex flex-wrap items-center justify-center gap-3">
        <a href="<?php echo e(route('ppdb')); ?>" class="shine inline-flex items-center gap-2 rounded-full bg-gold-gradient px-7 py-3 text-sm font-semibold text-gold-foreground shadow-lift glow-gold transition-transform hover:-translate-y-0.5">
          Daftar PPDB <?php if (isset($component)) { $__componentOriginalce262628e3a8d44dc38fd1f3965181bc = $component; } ?>
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
        <a href="<?php echo e(route('galeri')); ?>" class="inline-flex items-center gap-2 rounded-full border border-white/30 px-7 py-3 text-sm font-semibold text-white transition-colors hover:bg-white/10">
          Lihat Galeri Sekolah
        </a>
      </div>
    </div>
  </div>
</section>

<script>
  (function () {
    var reduced = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
    var finePointer = window.matchMedia('(pointer: fine)').matches;

    // ---------- 1. Kartu foto: miring 3D halus + sorotan mengikuti kursor ----------
    if (finePointer && !reduced) {
      document.querySelectorAll('[data-ki-tilt], [data-ki-glow]').forEach(function (card) {
        var tilt = card.hasAttribute('data-ki-tilt');
        var raf = null;
        card.addEventListener('pointermove', function (e) {
          if (raf) cancelAnimationFrame(raf);
          raf = requestAnimationFrame(function () {
            var r = card.getBoundingClientRect();
            var px = (e.clientX - r.left) / r.width;
            var py = (e.clientY - r.top) / r.height;
            card.style.setProperty('--mx', (px * 100).toFixed(1) + '%');
            card.style.setProperty('--my', (py * 100).toFixed(1) + '%');
            if (tilt) {
              card.style.setProperty('--rx', ((0.5 - py) * 5).toFixed(2) + 'deg');
              card.style.setProperty('--ry', ((px - 0.5) * 6).toFixed(2) + 'deg');
            }
          });
        }, { passive: true });
        card.addEventListener('pointerleave', function () {
          if (raf) cancelAnimationFrame(raf);
          if (tilt) {
            card.style.setProperty('--rx', '0deg');
            card.style.setProperty('--ry', '0deg');
          }
        });
      });
    }

    // ---------- 2. Tombol "Lihat semua foto": buka penampil foto dari foto pertama destinasi ----------
    document.querySelectorAll('[data-ki-open]').forEach(function (btn) {
      btn.addEventListener('click', function () {
        var sec = document.querySelector('[data-ki-section="' + btn.dataset.kiOpen + '"]');
        var first = sec && sec.querySelector('[data-lightbox-trigger]');
        if (first) first.click();
      });
    });

    // ---------- 3. Scroll-spy: sorot destinasi yang sedang dibaca (rute + titik samping) ----------
    var sections = Array.prototype.slice.call(document.querySelectorAll('[data-ki-section]'));
    var routeLinks = Array.prototype.slice.call(document.querySelectorAll('[data-ki-route]'));
    var dots = Array.prototype.slice.call(document.querySelectorAll('[data-ki-dot]'));
    var dotsBox = document.querySelector('[data-ki-dots]');
    var scope = document.querySelector('[data-ki-scope]');

    function setActive(id) {
      routeLinks.forEach(function (a) { a.classList.toggle('is-active', a.dataset.kiRoute === id); });
      dots.forEach(function (a) {
        var on = a.dataset.kiDot === id;
        a.classList.toggle('is-active', on);
        if (on) a.setAttribute('aria-current', 'true'); else a.removeAttribute('aria-current');
      });
    }

    if ('IntersectionObserver' in window && sections.length) {
      var spy = new IntersectionObserver(function (entries) {
        entries.forEach(function (en) {
          if (en.isIntersecting) setActive(en.target.dataset.kiSection);
        });
      }, { rootMargin: '-42% 0px -52% 0px', threshold: 0 });
      sections.forEach(function (s) { spy.observe(s); });

      if (scope && dotsBox) {
        new IntersectionObserver(function (entries) {
          var on = entries[0].isIntersecting;
          dotsBox.classList.toggle('is-on', on);
          if (!on) setActive('');
        }, { rootMargin: '-20% 0px -20% 0px', threshold: 0 }).observe(scope);
      }
    }

    // ---------- 4. Video: dimuat hanya saat tombol putar ditekan (halaman tetap ringan) ----------
    // Mendukung video upload / link file langsung (<video>) dan embed (<iframe>).
    var cards = document.querySelectorAll('[data-kvid]');
    if (!cards.length) return;

    function stop(card) {
      var p = card.querySelector('.ki-vplayer');
      if (p) {
        if (typeof p.pause === 'function') p.pause();
        p.remove();
      }
      card.classList.remove('is-playing');
    }

    function start(card) {
      var src = card.dataset.src;
      if (!src) return;
      var el;
      if (card.dataset.type === 'video') {
        el = document.createElement('video');
        el.src = src;
        el.controls = true;
        el.autoplay = true;
        el.preload = 'metadata';
        el.setAttribute('playsinline', '');
        el.style.objectFit = 'contain';
      } else {
        el = document.createElement('iframe');
        el.src = src;
        el.setAttribute('allowfullscreen', '');
        el.setAttribute('allow', 'autoplay; encrypted-media; picture-in-picture; fullscreen');
        el.setAttribute('referrerpolicy', 'strict-origin-when-cross-origin');
        el.setAttribute('title', card.dataset.title || 'Video dokumentasi');
      }
      el.className = 'ki-vplayer';
      card.appendChild(el);
      card.classList.add('is-playing');
    }

    cards.forEach(function (card) {
      card.querySelector('[data-kvid-play]').addEventListener('click', function () {
        cards.forEach(function (c) { if (c !== card) stop(c); }); // hanya 1 video aktif
        start(card);
      });
      card.querySelector('[data-kvid-stop]').addEventListener('click', function () { stop(card); });
    });
  })();
</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\PunyaSaya\smk-infokom\resources\views/pages/kunjungan-industri.blade.php ENDPATH**/ ?>