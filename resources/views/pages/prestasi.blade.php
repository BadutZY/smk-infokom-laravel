@extends('layouts.app')
@section('title', 'Prestasi Sekolah')
@section('description', 'Daftar prestasi siswa dan tim SMK INFOKOM Kota Bogor di berbagai bidang lomba, tingkat kota hingga nasional.')

@section('content')

@php
  // Label & ikon per jenis peringkat (dipakai di kartu, filter, dan jendela detail).
  $medalMeta = [
    'emas' => ['label' => 'Emas', 'icon' => 'trophy'],
    'perak' => ['label' => 'Perak', 'icon' => 'award'],
    'perunggu' => ['label' => 'Perunggu', 'icon' => 'award'],
    'lainnya' => ['label' => 'Penghargaan', 'icon' => 'star'],
  ];

  // Enam angka statistik: 2x3 di ponsel, 3x2 di tablet, 1x6 di desktop (selalu simetris).
  $statItems = [
    ['value' => $stats['siswa'], 'label' => 'Siswa & Tim', 'icon' => 'users', 'tone' => ''],
    ['value' => $stats['total'], 'label' => 'Total Prestasi', 'icon' => 'layers', 'tone' => ''],
    ['value' => $stats['nasional'], 'label' => 'Tingkat Nasional', 'icon' => 'star', 'tone' => ''],
    ['value' => $stats['emas'], 'label' => 'Medali Emas', 'icon' => 'trophy', 'tone' => 'emas'],
    ['value' => $stats['perak'], 'label' => 'Medali Perak', 'icon' => 'award', 'tone' => 'perak'],
    ['value' => $stats['perunggu'], 'label' => 'Medali Perunggu', 'icon' => 'award', 'tone' => 'perunggu'],
  ];

  $totalKartu = $cards->count();
@endphp

<style>
  /* ===== Halaman Prestasi Sekolah (style khusus halaman ini) =====
     Warna medali (emas/perak/perunggu) hanya dipakai untuk penanda peringkat.
     Selebihnya memakai warna bawaan situs (navy + emas). */
  .pr-theme, .pr-modal {
    --pr-emas: oklch(0.8 0.165 83);
    --pr-emas-ink: oklch(0.42 0.1 80);
    --pr-perak: oklch(0.76 0.014 258);
    --pr-perak-ink: oklch(0.38 0.025 258);
    --pr-perunggu: oklch(0.62 0.1 55);
    --pr-perunggu-ink: oklch(0.42 0.09 50);
    --pr-lainnya: var(--teal);
    --pr-lainnya-ink: oklch(0.36 0.07 195);
    --pr-navy: oklch(0.17 0.075 265);
  }
  .pr-tone-emas { --pr-accent: var(--pr-emas); --pr-ink: var(--pr-emas-ink); --pr-on: oklch(0.22 0.06 262); }
  .pr-tone-perak { --pr-accent: var(--pr-perak); --pr-ink: var(--pr-perak-ink); --pr-on: oklch(0.22 0.06 262); }
  .pr-tone-perunggu { --pr-accent: var(--pr-perunggu); --pr-ink: var(--pr-perunggu-ink); --pr-on: #fff; }
  .pr-tone-lainnya { --pr-accent: var(--pr-lainnya); --pr-ink: var(--pr-lainnya-ink); --pr-on: #fff; }

  /* ---------- Hero ---------- */
  .pr-glow {
    position: absolute; left: 50%; top: 42%; width: min(620px, 92vw); aspect-ratio: 1;
    transform: translate(-50%, -50%); border-radius: 9999px; pointer-events: none;
    background: radial-gradient(circle, oklch(0.8 0.165 83 / 0.32) 0%, oklch(0.8 0.165 83 / 0.09) 45%, transparent 70%);
    animation: prGlowPulse 5s ease-in-out infinite;
  }
  @keyframes prGlowPulse {
    0%, 100% { transform: translate(-50%, -50%) scale(1); opacity: .85; }
    50% { transform: translate(-50%, -50%) scale(1.1); opacity: 1; }
  }
  .pr-trophy-watermark { position: absolute; top: 50%; translate: 0 -50%; pointer-events: none; opacity: .05; color: white; }
  .pr-trophy-watermark.is-left { left: -4rem; }
  .pr-trophy-watermark.is-right { right: -4rem; }
  .pr-trophy-watermark svg { width: 20rem; height: 20rem; }
  @media (min-width: 640px) { .pr-trophy-watermark svg { width: 25rem; height: 25rem; } }

  /* ---------- Statistik ---------- */
  .pr-stats { display: grid; grid-template-columns: repeat(2, minmax(0, 1fr)); gap: .75rem; }
  @media (min-width: 640px) { .pr-stats { grid-template-columns: repeat(3, minmax(0, 1fr)); gap: 1rem; } }
  @media (min-width: 1024px) { .pr-stats { grid-template-columns: repeat(6, minmax(0, 1fr)); } }
  .pr-stat {
    display: flex; flex-direction: column; align-items: center; justify-content: center; gap: .4rem;
    padding: 1.15rem .75rem; text-align: center; border-radius: 1.25rem;
    background: color-mix(in oklab, var(--card) 92%, transparent); backdrop-filter: blur(14px);
    border: 1px solid var(--border); box-shadow: var(--shadow-lift);
    transition: transform .4s var(--ease-out), border-color .4s;
  }
  @media (hover: hover) { .pr-stat:hover { transform: translateY(-4px); border-color: oklch(from var(--gold) l c h / .55); } }
  .pr-stat-icon {
    display: grid; place-items: center; width: 2.4rem; height: 2.4rem; border-radius: .8rem;
    background: var(--accent); color: var(--primary);
  }
  .pr-stat-icon svg { width: 1.1rem; height: 1.1rem; }
  .pr-stat-num { font-family: var(--font-display); font-size: 1.95rem; font-weight: 800; line-height: 1; color: var(--primary); }
  .pr-stat-label { font-size: .75rem; font-weight: 600; line-height: 1.3; color: var(--muted-foreground); }
  .pr-stat--emas { border-color: oklch(from var(--pr-emas) l c h / .5); }
  .pr-stat--emas .pr-stat-icon { background: oklch(from var(--pr-emas) l c h / .24); color: var(--pr-emas-ink); }
  .pr-stat--emas .pr-stat-num { color: var(--pr-emas-ink); }
  .pr-stat--perak .pr-stat-icon { background: oklch(from var(--pr-perak) l c h / .35); color: var(--pr-perak-ink); }
  .pr-stat--perak .pr-stat-num { color: var(--pr-perak-ink); }
  .pr-stat--perunggu .pr-stat-icon { background: oklch(from var(--pr-perunggu) l c h / .2); color: var(--pr-perunggu-ink); }
  .pr-stat--perunggu .pr-stat-num { color: var(--pr-perunggu-ink); }

  /* ---------- Toolbar: filter, pencarian, peringkat ---------- */
  .pr-toolbar { display: flex; flex-direction: column; align-items: center; gap: 1rem; margin-top: 2.5rem; }
  .pr-chips { display: flex; flex-wrap: wrap; justify-content: center; gap: .5rem; }
  .pr-chip-n {
    margin-left: .45rem; padding: .08rem .5rem; border-radius: 999px; font-size: .68rem; font-weight: 700;
    background: color-mix(in oklab, currentColor 15%, transparent);
  }
  .pr-tools { display: flex; flex-wrap: wrap; align-items: center; justify-content: center; gap: .75rem; width: 100%; }
  .pr-search { flex: 1 1 16rem; max-width: 22rem; }
  .pr-seg {
    display: inline-flex; gap: .15rem; padding: .25rem; border-radius: 999px;
    background: var(--secondary); border: 1px solid var(--border);
  }
  .pr-seg button {
    display: inline-flex; align-items: center; gap: .4rem; height: 2.5rem; padding: 0 .95rem; border-radius: 999px;
    font-size: .8rem; font-weight: 600; color: var(--muted-foreground);
    transition: background-color .3s, color .3s, box-shadow .3s;
  }
  .pr-seg button svg { width: .9rem; height: .9rem; }
  .pr-seg button:hover { color: var(--primary); }
  .pr-seg button.is-active { background: var(--card); color: var(--primary); box-shadow: var(--shadow-soft); }
  .pr-seg button[data-pr-medal="emas"] svg { color: var(--pr-emas-ink); }
  .pr-seg button[data-pr-medal="perak"] svg { color: var(--pr-perak-ink); }
  .pr-seg button[data-pr-medal="perunggu"] svg { color: var(--pr-perunggu-ink); }
  .pr-count { margin-top: 1.25rem; text-align: center; font-size: .85rem; color: var(--muted-foreground); }
  .pr-count b { color: var(--foreground); font-weight: 700; }

  /* ---------- Grid kartu (baris terakhir selalu di tengah) ---------- */
  .pr-grid { display: flex; flex-wrap: wrap; justify-content: center; gap: 1.5rem; margin-top: 1.75rem; }
  .pr-card { display: flex; flex: 0 0 100%; max-width: 100%; min-width: 0; }
  @media (min-width: 640px) {
    .pr-card { flex-basis: calc((100% - 1.5rem) / 2 - .5px); max-width: calc((100% - 1.5rem) / 2 - .5px); }
  }
  @media (min-width: 1024px) {
    .pr-card { flex-basis: calc((100% - 3rem) / 3 - .5px); max-width: calc((100% - 3rem) / 3 - .5px); }
  }
  .pr-card.hidden, .pr-card.is-search-hidden, .pr-card.is-medal-hidden { display: none !important; }

  .pr-card-inner {
    position: relative; isolation: isolate; display: flex; flex-direction: column; width: 100%; overflow: hidden;
    border-radius: 1.5rem; background: var(--card); border: 1px solid var(--border); box-shadow: var(--shadow-soft);
    transition: transform .45s var(--ease-out), box-shadow .45s var(--ease-out), border-color .45s;
  }
  .pr-card-inner::before {
    content: ''; position: absolute; inset: 0 0 auto 0; height: 4px; z-index: 3;
    background: linear-gradient(90deg, var(--pr-accent), transparent 130%);
  }
  @media (hover: hover) {
    .pr-card:hover .pr-card-inner {
      transform: translateY(-6px);
      box-shadow: var(--shadow-lift), 0 0 34px -14px var(--pr-accent);
      border-color: oklch(from var(--pr-accent) l c h / .6);
    }
    .pr-card:hover .pr-photo .pr-bg { transform: scale(1.4); }
    .pr-card:hover .pr-more svg { transform: translateX(4px); }
    .pr-card:hover .pr-more { color: var(--primary-soft); }
  }
  .pr-card:focus-within .pr-card-inner { border-color: oklch(from var(--pr-accent) l c h / .6); box-shadow: var(--shadow-lift), 0 0 34px -14px var(--pr-accent); }
  .pr-open { position: absolute; inset: 0; z-index: 2; border-radius: inherit; cursor: pointer; background: transparent; }
  .pr-open:focus-visible { outline: 3px solid var(--gold); outline-offset: -3px; }

  /* Foto kartu (OPSIONAL): hanya dirender bila foto ada. Rasio 3:2 supaya tidak terlalu besar / kecil.
     Foto tampil utuh 100% (tidak terpotong); sisa ruang diisi latar blur dari foto yang sama. */
  .pr-photo { position: relative; aspect-ratio: 3 / 2; overflow: hidden; background: var(--pr-navy); }
  .pr-photo .pr-bg {
    position: absolute; inset: 0; width: 100%; height: 100%; object-fit: cover;
    filter: blur(22px) saturate(1.2) brightness(.72); transform: scale(1.3);
    transition: transform .9s var(--ease-out);
  }
  .pr-photo .pr-img { position: absolute; inset: 0; width: 100%; height: 100%; object-fit: contain; }
  .pr-photo::after {
    content: ''; position: absolute; inset: auto 0 0 0; height: 30%; pointer-events: none;
    background: linear-gradient(to top, oklch(0.17 0.075 265 / .4), transparent);
  }
  .pr-chip-cat, .pr-medal-badge {
    position: absolute; top: 1rem; z-index: 2; display: inline-flex; align-items: center; gap: .4rem;
    height: 1.9rem; border-radius: 999px; font-size: .72rem; line-height: 1;
  }
  .pr-chip-cat {
    left: .85rem; max-width: 62%; padding: 0 .8rem 0 .65rem; font-weight: 600; color: #fff;
    background: oklch(0.17 0.075 265 / .55); backdrop-filter: blur(8px); border: 1px solid rgb(255 255 255 / .18);
  }
  .pr-chip-cat svg { flex: none; width: .85rem; height: .85rem; }
  .pr-chip-cat span { overflow: hidden; text-overflow: ellipsis; white-space: nowrap; }
  .pr-medal-badge {
    right: .85rem; padding: 0 .8rem 0 .6rem; font-weight: 800; letter-spacing: .02em; color: var(--pr-on);
    background: linear-gradient(150deg, var(--pr-accent), oklch(from var(--pr-accent) calc(l - .1) c h));
    box-shadow: 0 8px 18px -8px var(--pr-accent);
  }
  .pr-medal-badge svg { width: .95rem; height: .95rem; }

  /* Kartu TANPA foto: lencana bidang & peringkat dipindah ke baris atas isi kartu */
  .pr-head { display: flex; align-items: center; justify-content: space-between; gap: .5rem; }
  .pr-head .pr-chip-cat, .pr-head .pr-medal-badge { position: static; flex: none; }
  .pr-head .pr-chip-cat {
    flex: 0 1 auto; min-width: 0; max-width: 64%; color: var(--primary);
    background: var(--accent); backdrop-filter: none; border: 1px solid var(--border);
  }

  /* Isi kartu */
  .pr-body { display: flex; flex: 1; flex-direction: column; gap: .95rem; padding: 1.2rem 1.35rem 1.3rem; }
  .pr-body.is-headless { padding-top: 1.45rem; }
  .pr-name {
    min-height: 2.6em; font-family: var(--font-display); font-size: 1.08rem; font-weight: 700; line-height: 1.3; color: var(--foreground);
    display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden;
  }
  .pr-sub {
    display: flex; align-items: center; gap: .35rem .6rem; margin-top: .45rem; overflow: hidden; white-space: nowrap;
    font-size: .78rem; color: var(--muted-foreground);
  }
  .pr-sub span { display: inline-flex; align-items: center; gap: .3rem; }
  .pr-sub svg { width: .85rem; height: .85rem; color: var(--primary); }
  .pr-sub span + span::before { content: ''; width: 3px; height: 3px; margin-right: .3rem; border-radius: 50%; background: currentColor; opacity: .5; }

  .pr-feature {
    position: relative; display: flex; flex: 1; flex-direction: column; gap: .4rem; min-height: 8.6rem;
    padding: .85rem 1rem .9rem 1.15rem; border-radius: 1rem;
    background: color-mix(in oklab, var(--secondary) 62%, var(--card));
  }
  .pr-feature::before {
    content: ''; position: absolute; left: 0; top: .85rem; bottom: .85rem; width: 3px; border-radius: 3px; background: var(--pr-accent);
  }
  .pr-feature-label { font-size: .66rem; font-weight: 700; letter-spacing: .1em; text-transform: uppercase; color: var(--muted-foreground); }
  .pr-feature-title {
    font-size: .88rem; font-weight: 600; line-height: 1.42; color: var(--foreground);
    display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical; overflow: hidden;
  }
  .pr-feature-result { display: flex; align-items: flex-start; gap: .45rem; margin-top: auto; font-size: .8rem; font-weight: 700; line-height: 1.35; color: var(--pr-ink); }
  .pr-feature-result svg { flex: none; width: .95rem; height: .95rem; margin-top: .08rem; }
  .pr-feature-result span { display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; }

  .pr-foot { display: flex; align-items: center; justify-content: space-between; gap: .75rem; }
  .pr-medals { display: flex; flex-wrap: wrap; gap: .4rem; }
  .pr-mc {
    display: inline-flex; align-items: center; gap: .3rem; height: 1.75rem; padding: 0 .6rem 0 .5rem; border-radius: 999px;
    font-size: .75rem; color: var(--ci);
    background: color-mix(in oklab, var(--c) 18%, transparent); border: 1px solid color-mix(in oklab, var(--c) 48%, transparent);
  }
  .pr-mc svg { width: .85rem; height: .85rem; }
  .pr-mc b { font-weight: 800; }
  .pr-mc--emas { --c: var(--pr-emas); --ci: var(--pr-emas-ink); }
  .pr-mc--perak { --c: var(--pr-perak); --ci: var(--pr-perak-ink); }
  .pr-mc--perunggu { --c: var(--pr-perunggu); --ci: var(--pr-perunggu-ink); }
  .pr-mc--lainnya { --c: var(--pr-lainnya); --ci: var(--pr-lainnya-ink); }
  .pr-more { display: inline-flex; flex: none; align-items: center; gap: .4rem; font-size: .8rem; font-weight: 700; color: var(--primary); transition: color .3s; }
  .pr-more svg { width: .95rem; height: .95rem; transition: transform .35s var(--ease-out); }

  .pr-pop { animation: prPop .55s var(--ease-out) var(--pd, 0ms) both; }
  @keyframes prPop { from { opacity: 0; transform: translateY(14px) scale(.985); } to { opacity: 1; transform: none; } }

  .pr-empty {
    display: flex; flex-direction: column; align-items: center; gap: .75rem; margin-top: 1.5rem; padding: 3.5rem 1.5rem;
    text-align: center; border-radius: 1.75rem; border: 1px dashed var(--border); background: color-mix(in oklab, var(--secondary) 45%, transparent);
  }
  .pr-empty[hidden] { display: none; }
  .pr-empty-icon { display: grid; place-items: center; width: 3rem; height: 3rem; border-radius: 999px; background: var(--accent); color: var(--primary); }
  .pr-empty p { font-size: .9rem; font-weight: 500; color: var(--muted-foreground); }
  .pr-empty button {
    height: 2.5rem; padding: 0 1.2rem; border-radius: 999px; font-size: .8rem; font-weight: 700;
    color: var(--primary-foreground); background: var(--primary);
  }

  /* ---------- Jendela detail ---------- */
  .pr-modal { position: fixed; inset: 0; z-index: 9000; display: none; align-items: center; justify-content: center; padding: 1rem; }
  .pr-modal.is-open { display: flex; }
  .pr-modal-bg { position: absolute; inset: 0; background: oklch(0.12 0.05 262 / .74); backdrop-filter: blur(6px); animation: prFade .3s ease both; }
  .pr-panel {
    position: relative; display: flex; flex-direction: column; width: 100%; max-width: 62rem; max-height: min(92vh, 46rem);
    overflow: hidden; border-radius: 1.75rem; background: var(--card); box-shadow: 0 40px 100px -30px rgb(0 0 0 / .6);
    animation: prPanelIn .45s var(--ease-out) both;
  }
  /* Tanpa foto: jendela dipersempit supaya isinya tidak terlihat kosong */
  .pr-panel.is-compact { max-width: 40rem; }
  .pr-modal.is-closing .pr-modal-bg { animation: prFadeOut .25s ease both; }
  .pr-modal.is-closing .pr-panel { animation: prPanelOut .25s ease both; }
  @keyframes prFade { from { opacity: 0; } to { opacity: 1; } }
  @keyframes prFadeOut { from { opacity: 1; } to { opacity: 0; } }
  @keyframes prPanelIn { from { opacity: 0; transform: translateY(26px) scale(.97); } to { opacity: 1; transform: none; } }
  @keyframes prPanelOut { from { opacity: 1; transform: none; } to { opacity: 0; transform: translateY(18px) scale(.98); } }
  @keyframes prSwap { from { opacity: 0; transform: translateX(var(--sx, 18px)); } to { opacity: 1; transform: none; } }

  .pr-m-close {
    position: absolute; top: .9rem; right: .9rem; z-index: 6; display: grid; place-items: center; width: 2.5rem; height: 2.5rem;
    border-radius: 999px; color: var(--foreground); background: var(--card); border: 1px solid var(--border); box-shadow: var(--shadow-soft);
    transition: transform .3s var(--ease-out), background-color .3s;
  }
  .pr-m-close:hover { transform: rotate(90deg); background: var(--secondary); }
  .pr-m-body { display: grid; flex: 1; grid-template-columns: minmax(0, 1fr); min-height: 0; overflow-y: auto; overscroll-behavior: contain; }
  .pr-m-body.is-swap > * { animation: prSwap .4s var(--ease-out) both; }
  @media (min-width: 860px) {
    .pr-m-body { grid-template-columns: minmax(0, 6fr) minmax(0, 5fr); overflow: hidden; }
    .pr-m-content { overflow-y: auto; overscroll-behavior: contain; }
  }
  /* Tanpa foto: satu kolom penuh */
  .pr-m-body.no-media { grid-template-columns: minmax(0, 1fr); }

  .pr-m-media { position: relative; overflow: hidden; aspect-ratio: 16 / 11; background: var(--pr-navy); }
  @media (min-width: 860px) { .pr-m-media { aspect-ratio: auto; min-height: 26rem; } }
  .pr-m-media .pr-m-bg { position: absolute; inset: 0; width: 100%; height: 100%; object-fit: cover; filter: blur(26px) saturate(1.2) brightness(.72); transform: scale(1.3); }
  .pr-m-media .pr-m-img { position: absolute; inset: 0; width: 100%; height: 100%; object-fit: contain; }
  .pr-m-media .pr-medal-badge { top: 1rem; right: auto; left: 1rem; }

  .pr-m-content { display: flex; flex-direction: column; gap: 1.35rem; padding: 2rem 1.5rem 1.5rem; }
  @media (min-width: 640px) { .pr-m-content { padding: 2.25rem 2.25rem 1.75rem; } }
  .pr-m-kickrow { display: flex; flex-wrap: wrap; align-items: center; gap: .5rem .75rem; padding-right: 2.75rem; }
  .pr-m-kickrow .pr-medal-badge { position: static; }
  .pr-m-kicker { display: inline-flex; align-items: center; gap: .5rem; font-size: .75rem; font-weight: 700; letter-spacing: .08em; text-transform: uppercase; color: var(--primary-soft); }
  .pr-m-kicker svg { width: .95rem; height: .95rem; }
  .pr-m-title { margin-top: .5rem; padding-right: 2.5rem; font-family: var(--font-display); font-size: clamp(1.35rem, 1.05rem + 1vw, 1.8rem); font-weight: 800; line-height: 1.2; letter-spacing: -.02em; color: var(--foreground); }
  .pr-m-tags { display: flex; flex-wrap: wrap; gap: .5rem; margin-top: .85rem; }
  .pr-tag {
    display: inline-flex; align-items: center; gap: .35rem; height: 1.8rem; padding: 0 .75rem; border-radius: 999px;
    font-size: .75rem; font-weight: 600; color: var(--secondary-foreground); background: var(--secondary); border: 1px solid var(--border);
  }
  .pr-tag svg { width: .85rem; height: .85rem; }
  .pr-members { display: flex; flex-wrap: wrap; gap: .4rem; margin-top: .9rem; }
  .pr-member { padding: .3rem .7rem; border-radius: 999px; font-size: .78rem; font-weight: 600; color: var(--primary); background: var(--accent); }

  .pr-tiles { display: grid; grid-template-columns: repeat(auto-fit, minmax(5.5rem, 1fr)); gap: .6rem; }
  .pr-tile {
    display: flex; flex-direction: column; align-items: center; gap: .15rem; padding: .8rem .5rem; border-radius: 1rem; text-align: center;
    background: color-mix(in oklab, var(--c) 14%, var(--card)); border: 1px solid color-mix(in oklab, var(--c) 40%, transparent); color: var(--ci);
  }
  .pr-tile svg { width: 1.1rem; height: 1.1rem; }
  .pr-tile b { font-family: var(--font-display); font-size: 1.5rem; font-weight: 800; line-height: 1.1; }
  .pr-tile span { font-size: .72rem; font-weight: 600; }
  .pr-tile--emas { --c: var(--pr-emas); --ci: var(--pr-emas-ink); }
  .pr-tile--perak { --c: var(--pr-perak); --ci: var(--pr-perak-ink); }
  .pr-tile--perunggu { --c: var(--pr-perunggu); --ci: var(--pr-perunggu-ink); }
  .pr-tile--lainnya { --c: var(--pr-lainnya); --ci: var(--pr-lainnya-ink); }

  .pr-list-title { font-family: var(--font-display); font-size: .95rem; font-weight: 700; color: var(--foreground); }
  .pr-list { display: flex; flex-direction: column; gap: .7rem; margin-top: .75rem; }
  .pr-ach {
    position: relative; display: grid; grid-template-columns: 2.6rem minmax(0, 1fr); gap: .85rem; padding: .9rem 1rem .9rem 1.1rem;
    border-radius: 1.1rem; background: color-mix(in oklab, var(--secondary) 55%, var(--card)); border: 1px solid var(--border);
  }
  .pr-ach::before { content: ''; position: absolute; left: 0; top: .9rem; bottom: .9rem; width: 3px; border-radius: 3px; background: var(--pr-accent); }
  .pr-ach-medal {
    display: grid; place-items: center; width: 2.6rem; height: 2.6rem; border-radius: 999px; color: var(--pr-on);
    background: linear-gradient(150deg, var(--pr-accent), oklch(from var(--pr-accent) calc(l - .1) c h)); box-shadow: 0 8px 18px -10px var(--pr-accent);
  }
  .pr-ach-medal svg { width: 1.2rem; height: 1.2rem; }
  .pr-ach-title { font-size: .92rem; font-weight: 600; line-height: 1.45; color: var(--foreground); }
  .pr-ach-tags { display: flex; flex-wrap: wrap; align-items: center; gap: .4rem .6rem; margin-top: .55rem; }
  .pr-ach-result {
    display: inline-flex; align-items: center; padding: .28rem .7rem; border-radius: 999px; font-size: .75rem; font-weight: 700; line-height: 1.3; color: var(--pr-ink);
    background: oklch(from var(--pr-accent) l c h / .2); border: 1px solid oklch(from var(--pr-accent) l c h / .5);
  }
  .pr-ach-meta { display: inline-flex; align-items: center; gap: .3rem; font-size: .75rem; font-weight: 600; color: var(--muted-foreground); }
  .pr-ach-meta svg { width: .8rem; height: .8rem; }

  .pr-m-foot {
    display: flex; align-items: center; justify-content: space-between; gap: 1rem; padding: .7rem 1.25rem;
    border-top: 1px solid var(--border); background: color-mix(in oklab, var(--secondary) 55%, var(--card));
  }
  .pr-m-count { font-size: .8rem; font-weight: 700; color: var(--muted-foreground); }
  .pr-m-hint { display: none; font-size: .72rem; color: var(--muted-foreground); }
  @media (min-width: 860px) { .pr-m-hint { display: inline; } }
  .pr-m-nav { display: flex; gap: .5rem; }
  .pr-m-nav button {
    display: grid; place-items: center; width: 2.5rem; height: 2.5rem; border-radius: 999px; color: var(--primary);
    background: var(--card); border: 1px solid var(--border); transition: background-color .3s, color .3s, transform .3s var(--ease-out);
  }
  .pr-m-nav button:hover { background: var(--primary); color: var(--primary-foreground); transform: translateY(-2px); }
  .pr-m-nav button[hidden] { display: none; }

  /* ---------- Bidang prestasi ---------- */
  .pr-bidang { display: flex; flex-wrap: wrap; justify-content: center; gap: 1.25rem; margin-top: 3rem; }
  .pr-bidang-card {
    display: flex; flex-direction: column; align-items: center; flex: 0 0 100%; max-width: 100%; padding: 1.75rem 1.5rem; text-align: center;
    border-radius: 1.5rem; background: var(--card); border: 1px solid var(--border); box-shadow: var(--shadow-soft);
    transition: transform .4s var(--ease-out), box-shadow .4s var(--ease-out), border-color .4s;
  }
  @media (min-width: 640px) { .pr-bidang-card { flex-basis: calc((100% - 1.25rem) / 2 - .5px); max-width: calc((100% - 1.25rem) / 2 - .5px); } }
  @media (min-width: 1024px) { .pr-bidang-card { flex-basis: calc((100% - 3.75rem) / 4 - .5px); max-width: calc((100% - 3.75rem) / 4 - .5px); } }
  @media (hover: hover) { .pr-bidang-card:hover { transform: translateY(-6px); box-shadow: var(--shadow-lift); border-color: oklch(from var(--gold) l c h / .55); } }
  .pr-bidang-icon {
    display: grid; place-items: center; width: 3.4rem; height: 3.4rem; border-radius: 1.1rem; color: var(--hero-foreground);
    background: var(--gradient-navy); transition: transform .4s var(--ease-spring);
  }
  .pr-bidang-icon svg { width: 1.5rem; height: 1.5rem; }
  .pr-bidang-card:hover .pr-bidang-icon { transform: rotate(-6deg) scale(1.08); }
  .pr-bidang-card h3 { margin-top: 1.1rem; font-family: var(--font-display); font-size: 1.02rem; font-weight: 700; color: var(--foreground); }
  .pr-bidang-card p { margin-top: .55rem; font-size: .88rem; line-height: 1.65; color: var(--muted-foreground); }

  .pr-quote-name { margin-top: 1.25rem; font-size: .85rem; font-weight: 700; letter-spacing: .04em; color: var(--gold); }

  @media (prefers-reduced-motion: reduce) {
    .pr-glow, .pr-pop, .pr-modal-bg, .pr-panel, .pr-m-body.is-swap > * { animation: none !important; }
    .pr-card:hover .pr-card-inner, .pr-card:hover .pr-photo .pr-bg, .pr-bidang-card:hover, .pr-stat:hover { transform: none !important; }
  }
</style>

{{-- ===================== HERO ===================== --}}
<section class="pr-theme relative overflow-hidden bg-navy-radial pb-28 pt-24 text-hero-foreground sm:pb-32 sm:pt-28">
  <div class="pointer-events-none absolute inset-0 bg-grain"></div>
  <div class="hud-grid"></div>
  <canvas data-particles aria-hidden="true"></canvas>
  <span class="pr-glow"></span>
  <span class="pr-trophy-watermark is-left"><x-icon name="trophy" /></span>
  <span class="pr-trophy-watermark is-right"><x-icon name="trophy" /></span>

  <div class="relative mx-auto max-w-4xl px-4 text-center sm:px-6 lg:px-8">
    <span class="enter-item enter-d1 kicker kicker--light">
      <x-icon name="trophy" class="w-3.5 h-3.5" />Sekolah Pusat Keunggulan
    </span>
    <h1 class="enter-item enter-d2 mt-5 font-display text-4xl font-extrabold leading-[1.1] sm:text-5xl lg:text-6xl">
      Torehan <span class="text-gradient-gold">Prestasi</span> yang Membanggakan
    </h1>
    <p class="enter-item enter-d3 mx-auto mt-5 max-w-2xl text-base text-white/75 sm:text-lg">
      Siswa dan tim {{ $site['school']['brand_top'] }} terus mengukir juara dari tingkat kota hingga nasional di bidang akademik, olahraga, seni, hingga teknologi digital.
    </p>
    <div class="enter-item enter-d4 mt-8 flex flex-wrap items-center justify-center gap-3">
      <a href="#daftar-prestasi" class="shine inline-flex items-center gap-2 rounded-full bg-gold-gradient px-6 py-3 text-sm font-semibold text-gold-foreground shadow-lift glow-gold transition-transform hover:-translate-y-0.5">
        Lihat Semua Prestasi <x-icon name="arrow-right" class="w-4 h-4" />
      </a>
      <a href="{{ url('/magang-jepang') }}" class="inline-flex items-center gap-2 rounded-full border border-white/30 px-6 py-3 text-sm font-semibold text-white transition-colors hover:bg-white/10">
        <x-icon name="award" class="w-4 h-4" />Lihat Magang Jepang
      </a>
    </div>
  </div>

  <span class="accent-bar absolute inset-x-0 bottom-0" aria-hidden="true"></span>
</section>

{{-- ===================== STATISTIK ===================== --}}
<section class="pr-theme relative -mt-10 px-4 sm:px-6 lg:px-8">
  <div class="pr-stats stagger-group mx-auto max-w-6xl">
    @foreach ($statItems as $stat)
      <div class="stagger-item pr-stat {{ $stat['tone'] ? 'pr-stat--'.$stat['tone'] : '' }}">
        <span class="pr-stat-icon"><x-icon :name="$stat['icon']" /></span>
        <p class="pr-stat-num"><span data-countup="{{ $stat['value'] }}">0</span></p>
        <p class="pr-stat-label">{{ $stat['label'] }}</p>
      </div>
    @endforeach
  </div>
</section>

{{-- ===================== DAFTAR PRESTASI ===================== --}}
<section id="daftar-prestasi" class="pr-theme section-pad scroll-mt-24 px-4 sm:px-6 lg:px-8">
  <div class="mx-auto max-w-6xl">
    <x-section-title kicker="Hall of Fame" title="Prestasi Siswa & Tim" desc="Jelajahi prestasi per bidang lomba. Klik kartu untuk melihat foto dan seluruh daftar kejuaraan." />

    @if ($cards->isEmpty())
      <p class="mt-14 text-center text-sm text-muted-foreground">Belum ada data prestasi sekolah.</p>
    @else
      {{-- Filter bidang, pencarian, dan peringkat --}}
      <div class="pr-toolbar reveal">
        @if ($kategoriList->isNotEmpty())
          <div data-filter-group="#prestasi-grid" class="pr-chips" role="group" aria-label="Filter bidang lomba">
            <button type="button" data-filter-btn="Semua" class="chip rounded-full bg-primary px-4 py-2 text-xs font-semibold text-primary-foreground sm:text-sm">Semua<span class="pr-chip-n">{{ $totalKartu }}</span></button>
            @foreach ($kategoriList as $kategori)
              <button type="button" data-filter-btn="{{ $kategori }}" class="chip rounded-full bg-secondary px-4 py-2 text-xs font-semibold text-secondary-foreground sm:text-sm">{{ $kategori }}<span class="pr-chip-n">{{ $kategoriCounts->get($kategori, 0) }}</span></button>
            @endforeach
          </div>
        @endif

        <div class="pr-tools">
          <label class="search-field pr-search">
            <span class="sr-only">Cari prestasi</span>
            <x-icon name="search" />
            <input type="search" data-search-input="#prestasi-grid" placeholder="Cari nama atau kejuaraan..." autocomplete="off" />
          </label>

          <div class="pr-seg" role="group" aria-label="Filter peringkat">
            <button type="button" class="is-active" data-pr-medal="all" aria-pressed="true">Semua</button>
            <button type="button" data-pr-medal="emas" aria-pressed="false"><x-icon name="trophy" />Emas</button>
            <button type="button" data-pr-medal="perak" aria-pressed="false"><x-icon name="award" />Perak</button>
            <button type="button" data-pr-medal="perunggu" aria-pressed="false"><x-icon name="award" />Perunggu</button>
          </div>
        </div>
      </div>

      <p class="pr-count" aria-live="polite">Menampilkan <b data-pr-shown>{{ $totalKartu }}</b> dari {{ $totalKartu }} siswa &amp; tim</p>

      {{-- Grid kartu --}}
      <div id="prestasi-grid" class="pr-grid stagger-group">
        @foreach ($cards as $card)
          @php
            $utama = $card['utama'];
            $tone = $card['dominan'];
            $medalList = collect($card['medali'])->filter(fn ($n) => $n > 0)->keys()->implode(' ');
            $cari = mb_strtolower(
              $card['nama'].' '.$card['kategori'].' '.$card['tahun'].' '.
              $card['items']->map(fn ($i) => $i->nama_kejuaraan.' '.$i->juara.' '.$i->tingkat)->implode(' ')
            );
            $jumlahAnggota = count($card['anggota']);
            $tampilAnggota = $card['judul'] !== $card['nama'];
          @endphp
          <article class="stagger-item pr-card pr-tone-{{ $tone }}" data-pr-card data-filter-item
                   data-category="{{ $card['kategori'] }}" data-medals="{{ $medalList }}" data-search="{{ $cari }}">
            <div class="pr-card-inner">

              {{-- Foto OPSIONAL: bagian foto hanya dirender bila foto diunggah --}}
              @if ($card['foto'])
                <div class="pr-photo">
                  <img class="pr-bg" src="{{ $card['foto'] }}" alt="" aria-hidden="true" loading="lazy" decoding="async" />
                  <img class="pr-img" src="{{ $card['foto'] }}" alt="Foto {{ $card['nama'] }}" loading="lazy" decoding="async" />
                  <span class="pr-chip-cat"><x-icon :name="$card['ikon']" /><span>{{ $card['kategori'] ?: 'Prestasi' }}</span></span>
                  <span class="pr-medal-badge"><x-icon :name="$utama->peringkatIcon()" />{{ $medalMeta[$tone]['label'] }}</span>
                </div>
              @endif

              <div class="pr-body {{ $card['foto'] ? '' : 'is-headless' }}">
                @unless ($card['foto'])
                  <div class="pr-head">
                    <span class="pr-chip-cat"><x-icon :name="$card['ikon']" /><span>{{ $card['kategori'] ?: 'Prestasi' }}</span></span>
                    <span class="pr-medal-badge"><x-icon :name="$utama->peringkatIcon()" />{{ $medalMeta[$tone]['label'] }}</span>
                  </div>
                @endunless

                <div>
                  <h3 class="pr-name" title="{{ $card['nama'] }}">{{ $card['judul'] }}</h3>
                  <p class="pr-sub">
                    <span><x-icon :name="$card['tim'] ? 'users' : 'user'" />{{ $card['tim'] ? 'Tim' : 'Siswa' }}@if ($jumlahAnggota > 1) &middot; {{ $jumlahAnggota }} anggota @endif</span>
                    <span>{{ $card['jumlah'] }} prestasi</span>
                    @if ($card['tahun']) <span>{{ $card['tahun'] }}</span> @endif
                  </p>
                </div>

                <div class="pr-feature">
                  <p class="pr-feature-label">Prestasi utama</p>
                  <p class="pr-feature-title">{{ $utama->nama_kejuaraan }}</p>
                  <p class="pr-feature-result"><x-icon :name="$utama->peringkatIcon()" /><span>{{ $utama->juara }}</span></p>
                </div>

                <div class="pr-foot">
                  <div class="pr-medals">
                    @foreach ($card['medali'] as $jenis => $jumlah)
                      @if ($jumlah > 0)
                        <span class="pr-mc pr-mc--{{ $jenis }}" title="{{ $jumlah }} {{ $medalMeta[$jenis]['label'] }}">
                          <x-icon :name="$medalMeta[$jenis]['icon']" /><b>{{ $jumlah }}</b>
                          <span class="sr-only">{{ $medalMeta[$jenis]['label'] }}</span>
                        </span>
                      @endif
                    @endforeach
                  </div>
                  <span class="pr-more">Detail <x-icon name="arrow-right" /></span>
                </div>
              </div>

              <button type="button" class="pr-open" data-pr-open aria-haspopup="dialog" aria-label="Lihat detail prestasi {{ $card['nama'] }}"></button>

              {{-- Isi jendela detail (dipasang oleh JS saat kartu diklik) --}}
              <template data-pr-template>
                @if ($card['foto'])
                  <div class="pr-m-media pr-tone-{{ $tone }}">
                    <img class="pr-m-bg" src="{{ $card['foto'] }}" alt="" aria-hidden="true" />
                    <img class="pr-m-img" src="{{ $card['foto'] }}" alt="Foto {{ $card['nama'] }}" />
                    <span class="pr-medal-badge"><x-icon :name="$utama->peringkatIcon()" />{{ $medalMeta[$tone]['label'] }}</span>
                  </div>
                @endif

                <div class="pr-m-content">
                  <div>
                    @if ($card['foto'])
                      <p class="pr-m-kicker"><x-icon :name="$card['ikon']" />{{ $card['kategori'] ?: 'Prestasi' }}</p>
                    @else
                      <div class="pr-m-kickrow pr-tone-{{ $tone }}">
                        <p class="pr-m-kicker"><x-icon :name="$card['ikon']" />{{ $card['kategori'] ?: 'Prestasi' }}</p>
                        <span class="pr-medal-badge"><x-icon :name="$utama->peringkatIcon()" />{{ $medalMeta[$tone]['label'] }}</span>
                      </div>
                    @endif
                    <h2 class="pr-m-title" data-pr-title>{{ $card['judul'] }}</h2>
                    <div class="pr-m-tags">
                      <span class="pr-tag"><x-icon :name="$card['tim'] ? 'users' : 'user'" />{{ $card['tim'] ? 'Tim' : 'Siswa' }}</span>
                      <span class="pr-tag"><x-icon name="layers" />{{ $card['jumlah'] }} prestasi</span>
                      @if ($card['tahun'])
                        <span class="pr-tag"><x-icon name="calendar-days" />{{ $card['tahun'] }}</span>
                      @endif
                    </div>
                    @if ($tampilAnggota)
                      <div class="pr-members" aria-label="Anggota tim">
                        @foreach ($card['anggota'] as $anggota)
                          <span class="pr-member">{{ $anggota }}</span>
                        @endforeach
                      </div>
                    @endif
                  </div>

                  <div class="pr-tiles">
                    @foreach ($card['medali'] as $jenis => $jumlah)
                      @if ($jumlah > 0)
                        <div class="pr-tile pr-tile--{{ $jenis }}">
                          <x-icon :name="$medalMeta[$jenis]['icon']" />
                          <b>{{ $jumlah }}</b>
                          <span>{{ $medalMeta[$jenis]['label'] }}</span>
                        </div>
                      @endif
                    @endforeach
                  </div>

                  <div>
                    <h3 class="pr-list-title">Daftar Prestasi</h3>
                    <ol class="pr-list">
                      @foreach ($card['items'] as $achievement)
                        <li class="pr-ach pr-tone-{{ $achievement->peringkatTema() }}">
                          <span class="pr-ach-medal"><x-icon :name="$achievement->peringkatIcon()" /></span>
                          <div class="min-w-0">
                            <p class="pr-ach-title">{{ $achievement->nama_kejuaraan }}</p>
                            <div class="pr-ach-tags">
                              <span class="pr-ach-result">{{ $achievement->juara }}</span>
                              @if ($achievement->tingkat)
                                <span class="pr-ach-meta"><x-icon name="map-pin" />{{ $achievement->tingkat }}</span>
                              @endif
                              <span class="pr-ach-meta"><x-icon name="calendar-days" />{{ $achievement->tahun }}</span>
                            </div>
                          </div>
                        </li>
                      @endforeach
                    </ol>
                  </div>
                </div>
              </template>

            </div>
          </article>
        @endforeach
      </div>

      {{-- Ditampilkan oleh JS bila filter/pencarian tidak menghasilkan kartu --}}
      <div data-pr-empty class="pr-empty" hidden>
        <span class="pr-empty-icon"><x-icon name="search" class="w-5 h-5" /></span>
        <p>Tidak ada prestasi yang cocok dengan pilihan Anda.</p>
        <button type="button" data-pr-reset>Atur ulang filter</button>
      </div>
    @endif
  </div>
</section>

{{-- ===================== BIDANG PRESTASI ===================== --}}
<section class="pr-theme section-pad px-4 sm:px-6 lg:px-8">
  <div class="mx-auto max-w-6xl">
    <x-section-title kicker="Cakupan" title="Prestasi di Berbagai Bidang" desc="Dari akademik dan sains, olahraga, bahasa, hingga dunia digital dan e-sport." />

    @if ($bidangList->isEmpty())
      <p class="mt-10 text-center text-sm text-muted-foreground">Belum ada data bidang prestasi.</p>
    @else
      <div class="pr-bidang stagger-group">
        @foreach ($bidangList as $bidang)
          <div class="stagger-item pr-bidang-card">
            <span class="pr-bidang-icon"><x-icon :name="$bidang->icon" /></span>
            <h3>{{ $bidang->judul }}</h3>
            <p>{{ $bidang->deskripsi }}</p>
          </div>
        @endforeach
      </div>
    @endif
  </div>
</section>

{{-- ===================== CTA ===================== --}}
<section class="pr-theme px-4 pb-20 sm:px-6 sm:pb-28 lg:px-8">
  <div class="reveal relative mx-auto max-w-6xl overflow-hidden rounded-3xl bg-navy-radial px-8 py-16 text-center text-hero-foreground shadow-lift sm:px-16">
    <div class="pointer-events-none absolute inset-0 bg-grain"></div>
    <span class="bg-orb float-y -left-10 -top-10 h-52 w-52 bg-gold/25"></span>
    <span class="bg-orb float-y h-52 w-52 bg-teal/25" style="right:-2.5rem; bottom:-2.5rem; animation-delay:1s;"></span>
    <div class="relative">
      <span class="mx-auto flex h-12 w-12 items-center justify-center rounded-full bg-gold-gradient text-gold-foreground"><x-icon name="trophy" class="w-6 h-6" /></span>
      <h2 class="mt-5 font-display text-3xl font-bold sm:text-4xl">Jadilah Bagian dari <span class="text-gradient-gold">Generasi Berprestasi</span></h2>
      <p class="mx-auto mt-4 max-w-2xl text-sm leading-relaxed text-white/75 sm:text-base">
        Setiap medali dan gelar juara adalah bukti kerja keras, disiplin, dan semangat pantang menyerah siswa-siswi kami di setiap arena perlombaan.
      </p>
      <p class="pr-quote-name">Keluarga Besar {{ $site['school']['brand_top'] }}</p>
      <div class="mt-8 flex flex-wrap items-center justify-center gap-3">
        <a href="{{ route('ppdb') }}" class="shine inline-flex items-center gap-2 rounded-full bg-gold-gradient px-7 py-3 text-sm font-semibold text-gold-foreground shadow-lift glow-gold transition-transform hover:-translate-y-0.5">
          Daftar PPDB <x-icon name="arrow-right" class="w-4 h-4" />
        </a>
        <a href="{{ url('/magang-jepang') }}" class="inline-flex items-center gap-2 rounded-full border border-white/30 px-7 py-3 text-sm font-semibold text-white transition-colors hover:bg-white/10">
          <x-icon name="award" class="w-4 h-4" />Lihat Magang Jepang
        </a>
      </div>
    </div>
  </div>
</section>

{{-- ===================== JENDELA DETAIL PRESTASI ===================== --}}
<div class="pr-modal" data-pr-modal aria-hidden="true">
  <div class="pr-modal-bg" data-pr-close></div>
  <section class="pr-panel" role="dialog" aria-modal="true" aria-label="Detail prestasi" tabindex="-1" data-pr-panel>
    <button type="button" class="pr-m-close" data-pr-close aria-label="Tutup"><x-icon name="x" class="w-5 h-5" /></button>
    <div class="pr-m-body" data-pr-body></div>
    <footer class="pr-m-foot">
      <span class="pr-m-count" data-pr-count aria-live="polite"></span>
      <span class="pr-m-hint">Gunakan tombol panah untuk berpindah, Esc untuk menutup</span>
      <div class="pr-m-nav">
        <button type="button" data-pr-prev aria-label="Prestasi sebelumnya"><x-icon name="chevron-left" class="w-5 h-5" /></button>
        <button type="button" data-pr-next aria-label="Prestasi berikutnya"><x-icon name="chevron-right" class="w-5 h-5" /></button>
      </div>
    </footer>
  </div>
</div>

<script>
  (function () {
    var grid = document.getElementById('prestasi-grid');
    if (!grid) return;

    var cards = Array.prototype.slice.call(grid.querySelectorAll('[data-pr-card]'));
    var modal = document.querySelector('[data-pr-modal]');
    var panel = modal.querySelector('[data-pr-panel]');
    var body = modal.querySelector('[data-pr-body]');
    var countEl = modal.querySelector('[data-pr-count]');
    var prevBtn = modal.querySelector('[data-pr-prev]');
    var nextBtn = modal.querySelector('[data-pr-next]');
    var shownEl = document.querySelector('[data-pr-shown]');
    var emptyEl = document.querySelector('[data-pr-empty]');
    var searchEl = document.querySelector('[data-search-input="#prestasi-grid"]');
    var medalBtns = Array.prototype.slice.call(document.querySelectorAll('[data-pr-medal]'));
    var reduced = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
    var medal = 'all';

    function isShown(card) {
      return !card.classList.contains('hidden') &&
             !card.classList.contains('is-search-hidden') &&
             !card.classList.contains('is-medal-hidden');
    }

    /* ---------- Jumlah hasil, kartu kosong, dan animasi kartu yang muncul ---------- */
    var prevShown = new Set(cards.filter(isShown));

    function pop(card, i) {
      var inner = card.firstElementChild;
      if (!inner || reduced) return;
      inner.classList.remove('pr-pop');
      void inner.offsetWidth;
      inner.style.setProperty('--pd', Math.min(i, 12) * 45 + 'ms');
      inner.classList.add('pr-pop');
    }

    function sync() {
      var now = cards.filter(isShown);
      var n = 0;
      now.forEach(function (card) { if (!prevShown.has(card)) pop(card, n++); });
      prevShown = new Set(now);
      if (shownEl) shownEl.textContent = String(now.length);
      if (emptyEl) emptyEl.hidden = now.length > 0;
    }
    function syncSoon() { window.requestAnimationFrame(sync); }

    // Filter bidang (tombol chip) & pencarian ditangani script situs; di sini hanya menyegarkan hitungan.
    document.addEventListener('click', function (e) {
      if (e.target instanceof Element && e.target.closest('[data-filter-btn]')) syncSoon();
    });
    if (searchEl) searchEl.addEventListener('input', syncSoon);

    /* ---------- Filter peringkat ---------- */
    function setMedal(value) {
      medal = value;
      medalBtns.forEach(function (b) {
        var active = b.getAttribute('data-pr-medal') === value;
        b.classList.toggle('is-active', active);
        b.setAttribute('aria-pressed', active ? 'true' : 'false');
      });
      cards.forEach(function (card) {
        var list = (card.getAttribute('data-medals') || '').split(' ');
        var ok = value === 'all' || list.indexOf(value) !== -1;
        card.classList.toggle('is-medal-hidden', !ok);
      });
      sync();
    }
    medalBtns.forEach(function (b) {
      b.addEventListener('click', function () { setMedal(b.getAttribute('data-pr-medal')); });
    });

    var resetBtn = document.querySelector('[data-pr-reset]');
    if (resetBtn) {
      resetBtn.addEventListener('click', function () {
        var all = document.querySelector('[data-filter-group="#prestasi-grid"] [data-filter-btn="Semua"]');
        if (searchEl) {
          searchEl.value = '';
          searchEl.dispatchEvent(new Event('input', { bubbles: true }));
        }
        if (all) all.click();
        setMedal('all');
      });
    }

    /* ---------- Jendela detail ---------- */
    var current = null;
    var lastFocus = null;
    var closing = false;

    function visibleCards() { return cards.filter(isShown); }

    function render(direction) {
      var tpl = current.querySelector('template[data-pr-template]');
      if (!tpl) return;
      body.innerHTML = '';
      body.appendChild(tpl.content.cloneNode(true));

      // Foto opsional: tanpa foto, jendela dipersempit dan hanya satu kolom isi.
      var hasMedia = !!body.querySelector('.pr-m-media');
      body.classList.toggle('no-media', !hasMedia);
      panel.classList.toggle('is-compact', !hasMedia);
      body.scrollTop = 0;
      var content = body.querySelector('.pr-m-content');
      if (content) content.scrollTop = 0;

      var list = visibleCards();
      var index = Math.max(0, list.indexOf(current));
      countEl.textContent = list.length > 1 ? (index + 1) + ' / ' + list.length : '';
      prevBtn.hidden = nextBtn.hidden = list.length < 2;

      var title = body.querySelector('[data-pr-title]');
      panel.setAttribute('aria-label', 'Detail prestasi ' + (title ? title.textContent : ''));

      if (direction && !reduced) {
        body.style.setProperty('--sx', direction > 0 ? '22px' : '-22px');
        body.classList.remove('is-swap');
        void body.offsetWidth;
        body.classList.add('is-swap');
      }

      // Muat foto kartu tetangga lebih awal supaya perpindahan terasa mulus
      [1, -1].forEach(function (d) {
        var n = list[(index + d + list.length) % list.length];
        var t = n && n.querySelector('template[data-pr-template]');
        var img = t && t.content.querySelector('.pr-m-img');
        if (img) { var pre = new Image(); pre.src = img.src; }
      });
    }

    function open(card) {
      current = card;
      closing = false;
      lastFocus = document.activeElement;
      modal.classList.remove('is-closing');
      render(0);
      modal.classList.add('is-open');
      modal.setAttribute('aria-hidden', 'false');
      document.body.classList.add('overflow-hidden');
      var closeBtn = modal.querySelector('.pr-m-close');
      if (closeBtn) closeBtn.focus({ preventScroll: true });
    }

    function finishClose() {
      modal.classList.remove('is-open', 'is-closing');
      modal.setAttribute('aria-hidden', 'true');
      document.body.classList.remove('overflow-hidden');
      body.innerHTML = '';
      closing = false;
      if (lastFocus && lastFocus.focus) lastFocus.focus({ preventScroll: true });
    }

    function close() {
      if (closing || !modal.classList.contains('is-open')) return;
      closing = true;
      if (reduced) { finishClose(); return; }
      modal.classList.add('is-closing');
      var done = false;
      var end = function () { if (done) return; done = true; finishClose(); };
      panel.addEventListener('animationend', end, { once: true });
      window.setTimeout(end, 320);
    }

    function go(d) {
      var list = visibleCards();
      if (list.length < 2) return;
      var index = list.indexOf(current);
      current = list[(index + d + list.length) % list.length];
      render(d);
    }

    cards.forEach(function (card) {
      var btn = card.querySelector('[data-pr-open]');
      if (btn) btn.addEventListener('click', function () { open(card); });
    });
    modal.addEventListener('click', function (e) {
      if (e.target instanceof Element && e.target.closest('[data-pr-close]')) close();
    });
    prevBtn.addEventListener('click', function () { go(-1); });
    nextBtn.addEventListener('click', function () { go(1); });

    document.addEventListener('keydown', function (e) {
      if (!modal.classList.contains('is-open')) return;
      if (e.key === 'Escape') { e.preventDefault(); close(); }
      else if (e.key === 'ArrowRight') { go(1); }
      else if (e.key === 'ArrowLeft') { go(-1); }
      else if (e.key === 'Tab') {
        var f = Array.prototype.slice.call(panel.querySelectorAll('button:not([hidden]), [href], input, [tabindex]:not([tabindex="-1"])'));
        if (!f.length) return;
        var first = f[0], last = f[f.length - 1];
        if (e.shiftKey && document.activeElement === first) { e.preventDefault(); last.focus(); }
        else if (!e.shiftKey && document.activeElement === last) { e.preventDefault(); first.focus(); }
      }
    });

    // Geser jari ke kiri/kanan untuk berpindah kartu (ponsel)
    var tx = 0, ty = 0;
    panel.addEventListener('touchstart', function (e) { tx = e.touches[0].clientX; ty = e.touches[0].clientY; }, { passive: true });
    panel.addEventListener('touchend', function (e) {
      var dx = e.changedTouches[0].clientX - tx;
      var dy = e.changedTouches[0].clientY - ty;
      if (Math.abs(dx) > 70 && Math.abs(dx) > Math.abs(dy) * 1.6) go(dx < 0 ? 1 : -1);
    }, { passive: true });
  })();
</script>

@endsection