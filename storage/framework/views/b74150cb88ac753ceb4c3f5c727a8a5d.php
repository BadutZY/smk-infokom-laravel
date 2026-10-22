
<?php
    $cbxSchool = $site['school']['short'] ?? 'SMK INFOKOM';
?>

<div id="cbx" class="cbx" data-endpoint="<?php echo e(route('chatbot.ask')); ?>" data-token="<?php echo e(csrf_token()); ?>" data-school="<?php echo e($cbxSchool); ?>" data-logo="<?php echo e(asset('images/logo.png')); ?>">

  
  <div class="cbx-teaser" role="status" hidden>
    <button type="button" class="cbx-teaser-x" aria-label="Tutup sapaan">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M18 6 6 18M6 6l12 12"/></svg>
    </button>
    <p><strong>Halo!</strong> Ada yang ingin ditanyakan tentang <?php echo e($cbxSchool); ?>?</p>
  </div>

  
  <section id="cbx-panel" class="cbx-panel" role="dialog" aria-label="Asisten Virtual <?php echo e($cbxSchool); ?>" inert>
    <header class="cbx-head">
      <span class="cbx-head-av">
        <img src="<?php echo e(asset('images/logo.png')); ?>" alt="" width="40" height="40" />
        <i class="cbx-online" aria-hidden="true"></i>
      </span>
      <span class="cbx-head-t">
        <strong>Asisten <?php echo e($cbxSchool); ?></strong>
        <small>Online · menjawab dari data resmi sekolah</small>
      </span>
      <button type="button" class="cbx-hbtn" data-cbx-reset aria-label="Mulai percakapan baru" title="Percakapan baru">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 12a9 9 0 1 0 9-9 9.75 9.75 0 0 0-6.74 2.74L3 8"/><path d="M3 3v5h5"/></svg>
      </button>
      <button type="button" class="cbx-hbtn" data-cbx-close aria-label="Tutup chat" title="Tutup">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 6 6 18M6 6l12 12"/></svg>
      </button>
    </header>

    <div class="cbx-bodywrap">
      <div class="cbx-body" role="log" aria-live="polite" aria-relevant="additions" tabindex="0">
        <div class="cbx-list"></div>
      </div>
      <button type="button" class="cbx-jump" aria-label="Ke pesan terbaru">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"><path d="m6 9 6 6 6-6"/></svg>
      </button>
    </div>

    <footer class="cbx-foot">
      <form class="cbx-form" novalidate>
        <div class="cbx-field">
          <textarea class="cbx-input" rows="1" maxlength="500" placeholder="Tulis pertanyaan Anda…" aria-label="Tulis pesan" autocomplete="off" enterkeyhint="send"></textarea>
          <span class="cbx-count" aria-hidden="true"></span>
        </div>
        <button type="submit" class="cbx-send" aria-label="Kirim pesan" disabled>
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="m3 3 3 9-3 9 19-9Z"/><path d="M6 12h16"/></svg>
        </button>
      </form>
      <p class="cbx-note">Dijawab oleh AI berdasarkan data resmi sekolah. Untuk info penting, konfirmasi ke pihak sekolah.</p>
    </footer>
  </section>

  
  <button type="button" class="cbx-fab" aria-label="Buka chatbot asisten sekolah" aria-expanded="false" aria-controls="cbx-panel">
    <svg class="cbx-ico cbx-ico-chat" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M7.9 20A9 9 0 1 0 4 16.1L2 22Z"/><path d="M8 12h.01M12 12h.01M16 12h.01" stroke-width="2.8"/></svg>
    <svg class="cbx-ico cbx-ico-x" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"><path d="M18 6 6 18M6 6l12 12"/></svg>
    <i class="cbx-dot" aria-hidden="true"></i>
  </button>
</div>


<style>
  /* ============ Chatbot — semua kelas berawalan .cbx- agar tidak bentrok ============ */
  .cbx {
    --cbx-r: calc(1.1rem - 0.125rem);   /* sejajar tengah dengan tombol "kembali ke atas" */
    --cbx-b: 1.1rem;
    --cbx-lift: 0rem;
    --cbx-ease: var(--ease-out, cubic-bezier(0.22, 1, 0.36, 1));
    --cbx-spring: var(--ease-spring, cubic-bezier(0.34, 1.4, 0.64, 1));
    --cbx-navy: var(--primary, #14285f);
    --cbx-navy-soft: var(--primary-soft, #27479a);
    --cbx-gold: var(--gold, #f2b705);
    --cbx-gold-fg: var(--gold-foreground, #14285f);
    --cbx-card: var(--card, #fff);
    --cbx-bg: var(--background, #f4f6fb);
    --cbx-fg: var(--foreground, #101a3a);
    --cbx-muted: var(--muted-foreground, #5b6788);
    --cbx-border: var(--border, #dbe1ef);
    --cbx-sec: var(--secondary, #e9edf6);
    position: fixed;
    right: var(--cbx-r);
    bottom: calc(var(--cbx-b) + var(--cbx-lift));
    z-index: 47; /* di atas tombol atas (45) & navbar (40), di bawah lightbox (50) & tirai halaman */
    font-family: var(--font-sans, 'Plus Jakarta Sans', ui-sans-serif, system-ui, sans-serif);
    transition: bottom 0.55s var(--cbx-ease);
  }
  @media (min-width: 640px) { .cbx { --cbx-r: calc(1.75rem - 0.125rem); --cbx-b: 1.75rem; } }
  /* Tombol "kembali ke atas" (3.25rem) tampil -> naik di atasnya + jarak 0.85rem */
  .cbx.is-lifted { --cbx-lift: 4.1rem; }
  .cbx *, .cbx *::before, .cbx *::after { box-sizing: border-box; }
  :where(.cbx) button, :where(.cbx) textarea { font: inherit; }
  .cbx svg { display: block; }

  /* ---------- Tombol pembuka ---------- */
  .cbx-fab {
    position: relative; display: flex; width: 3.5rem; height: 3.5rem; align-items: center; justify-content: center;
    border: 0; padding: 0; cursor: pointer; border-radius: 9999px; color: #fff;
    background-image: var(--gradient-navy, linear-gradient(135deg, #0d1a3d, #1d3a86 50%, #14285f));
    box-shadow: var(--shadow-lift, 0 20px 40px -18px rgba(13, 26, 61, 0.6)), inset 0 0 0 1px rgba(255, 255, 255, 0.1);
    transition: transform 0.45s var(--cbx-spring), box-shadow 0.3s ease, opacity 0.3s ease;
    -webkit-tap-highlight-color: transparent;
  }
  .cbx-fab::after { /* cincin denyut emas */
    content: ''; position: absolute; inset: -3px; border-radius: inherit; border: 2px solid var(--cbx-gold); opacity: 0; pointer-events: none;
  }
  .cbx:not(.is-seen) .cbx-fab::after { animation: cbx-ring 2.8s var(--cbx-ease) infinite; }
  @keyframes cbx-ring { 0% { transform: scale(0.92); opacity: 0.7; } 70%, 100% { transform: scale(1.38); opacity: 0; } }
  @media (hover: hover) {
    .cbx-fab:hover { transform: translateY(-3px) scale(1.06); box-shadow: var(--shadow-lift, 0 20px 40px -18px rgba(13, 26, 61, 0.6)), 0 0 28px -4px oklch(from var(--cbx-gold) l c h / 0.65); }
  }
  .cbx-fab:active { transform: scale(0.93); }
  .cbx-fab:focus-visible, .cbx button:focus-visible { outline: 3px solid var(--cbx-gold); outline-offset: 2px; }
  .cbx-ico { position: absolute; width: 1.65rem; height: 1.65rem; transition: transform 0.5s var(--cbx-spring), opacity 0.25s ease; }
  .cbx-ico-x { opacity: 0; transform: rotate(-90deg) scale(0.4); }
  .cbx.is-open .cbx-ico-chat { opacity: 0; transform: rotate(90deg) scale(0.4); }
  .cbx.is-open .cbx-ico-x { opacity: 1; transform: none; }
  .cbx-dot {
    position: absolute; top: 0.05rem; right: 0.05rem; width: 0.85rem; height: 0.85rem; border-radius: 9999px;
    background: var(--cbx-gold); box-shadow: 0 0 0 2px var(--cbx-navy); transition: transform 0.3s var(--cbx-spring), opacity 0.3s;
  }
  .cbx-dot::after { content: ''; position: absolute; inset: 0; border-radius: inherit; background: var(--cbx-gold); animation: cbx-ping 1.8s ease-out infinite; }
  @keyframes cbx-ping { 0% { transform: scale(1); opacity: 0.8; } 100% { transform: scale(2.6); opacity: 0; } }
  .cbx.is-seen .cbx-dot { transform: scale(0); opacity: 0; }

  /* ---------- Sapaan kecil ---------- */
  .cbx-teaser {
    position: absolute; right: 0; bottom: calc(100% + 0.8rem); width: max-content; max-width: min(16.5rem, calc(100vw - 2.5rem));
    padding: 0.8rem 2rem 0.8rem 0.95rem; border-radius: 1.1rem 1.1rem 0.3rem 1.1rem; background: var(--cbx-card);
    border: 1px solid var(--cbx-border); color: var(--cbx-fg); font-size: 0.82rem; line-height: 1.45;
    box-shadow: var(--shadow-lift, 0 24px 50px -24px rgba(13, 26, 61, 0.5)); transform-origin: bottom right; z-index: 1;
  }
  .cbx-teaser[hidden] { display: none; }
  .cbx-teaser p { margin: 0; }
  .cbx-teaser.is-in { animation: cbx-pop 0.55s var(--cbx-spring) both; }
  .cbx-teaser.is-out { animation: cbx-pop-out 0.28s ease forwards; }
  .cbx-teaser-x {
    position: absolute; top: 0.4rem; right: 0.4rem; display: flex; width: 1.4rem; height: 1.4rem; align-items: center; justify-content: center;
    border: 0; border-radius: 9999px; background: transparent; color: var(--cbx-muted); cursor: pointer; transition: background 0.2s;
  }
  .cbx-teaser-x:hover { background: var(--cbx-sec); }
  .cbx-teaser-x svg { width: 0.8rem; height: 0.8rem; }
  @keyframes cbx-pop { from { opacity: 0; transform: translateY(10px) scale(0.85); } to { opacity: 1; transform: none; } }
  @keyframes cbx-pop-out { to { opacity: 0; transform: translateY(6px) scale(0.92); } }

  /* ---------- Jendela chat ---------- */
  .cbx-panel {
    position: absolute; right: 0; bottom: calc(100% + 0.9rem);
    display: flex; flex-direction: column; overflow: hidden;
    width: min(24.5rem, calc(100vw - 2.5rem));
    /* tinggi dihitung dgn jarak maksimum (tombol atas aktif) agar tidak melompat saat scroll */
    height: min(36rem, max(20rem, calc(100dvh - 15.75rem)));
    border-radius: 1.6rem; background: var(--cbx-card); border: 1px solid var(--cbx-border);
    box-shadow: 0 40px 90px -30px rgba(13, 26, 61, 0.55), 0 8px 24px -12px rgba(13, 26, 61, 0.25);
    transform-origin: bottom right; opacity: 0; visibility: hidden; transform: translateY(18px) scale(0.88);
    transition: opacity 0.25s ease, transform 0.35s var(--cbx-ease), visibility 0s linear 0.35s;
  }
  .cbx.is-open .cbx-panel {
    opacity: 1; visibility: visible; transform: none;
    transition: opacity 0.3s ease, transform 0.55s var(--cbx-spring), visibility 0s;
  }

  /* Header */
  .cbx-head {
    position: relative; isolation: isolate; overflow: hidden; display: flex; align-items: center; gap: 0.7rem; flex-shrink: 0;
    padding: 0.95rem 0.9rem 0.95rem 1rem; color: #fff;
    background-image: var(--gradient-navy, linear-gradient(135deg, #0d1a3d, #1d3a86 50%, #14285f));
  }
  .cbx-head::before, .cbx-head::after { content: ''; position: absolute; z-index: -1; border-radius: 9999px; filter: blur(22px); pointer-events: none; }
  .cbx-head::before { width: 9rem; height: 9rem; right: -2rem; top: -4rem; background: oklch(from var(--cbx-gold) l c h / 0.35); animation: cbx-drift 9s ease-in-out infinite alternate; }
  .cbx-head::after { width: 8rem; height: 8rem; left: 20%; bottom: -5rem; background: oklch(0.7 0.12 215 / 0.35); animation: cbx-drift 11s ease-in-out infinite alternate-reverse; }
  @keyframes cbx-drift { from { transform: translate(0, 0) scale(1); } to { transform: translate(-18px, 14px) scale(1.25); } }
  .cbx-head-av { position: relative; display: flex; width: 2.7rem; height: 2.7rem; flex-shrink: 0; align-items: center; justify-content: center; border-radius: 9999px; background: rgba(255, 255, 255, 0.14); padding: 0.35rem; }
  .cbx-head-av img { width: 100%; height: 100%; object-fit: contain; }
  .cbx-online { position: absolute; right: -0.05rem; bottom: -0.05rem; width: 0.8rem; height: 0.8rem; border-radius: 9999px; background: #34d399; box-shadow: 0 0 0 2.5px var(--cbx-navy); }
  .cbx-online::after { content: ''; position: absolute; inset: 0; border-radius: inherit; background: #34d399; animation: cbx-ping 2.2s ease-out infinite; }
  .cbx-head-t { display: flex; min-width: 0; flex: 1; flex-direction: column; line-height: 1.25; }
  .cbx-head-t strong { font-family: var(--font-display, 'Sora', sans-serif); font-size: 0.95rem; font-weight: 700; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
  .cbx-head-t small { margin-top: 0.15rem; font-size: 0.7rem; color: rgba(255, 255, 255, 0.72); white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
  .cbx-hbtn {
    display: flex; width: 2.1rem; height: 2.1rem; flex-shrink: 0; align-items: center; justify-content: center; border: 0; padding: 0; cursor: pointer;
    border-radius: 9999px; background: rgba(255, 255, 255, 0.12); color: #fff; transition: background 0.25s, transform 0.4s var(--cbx-spring);
  }
  .cbx-hbtn svg { width: 1.05rem; height: 1.05rem; }
  .cbx-hbtn:hover { background: rgba(255, 255, 255, 0.24); }
  .cbx-hbtn[data-cbx-reset]:hover { transform: rotate(-200deg); }
  .cbx-hbtn[data-cbx-close]:hover { transform: rotate(90deg); }

  /* Badan pesan */
  .cbx-bodywrap { position: relative; display: flex; min-height: 0; flex: 1; }
  .cbx-body {
    flex: 1; overflow-y: auto; overscroll-behavior: contain; padding: 1rem 0.9rem 0.6rem; outline: none;
    background: var(--gradient-mesh, none), var(--cbx-bg); scrollbar-width: thin; scrollbar-color: var(--cbx-border) transparent;
  }
  .cbx-body::-webkit-scrollbar { width: 6px; }
  .cbx-body::-webkit-scrollbar-thumb { background: var(--cbx-border); border-radius: 9999px; }
  .cbx-row { display: flex; align-items: flex-end; gap: 0.5rem; margin-bottom: 0.8rem; }
  .cbx-row.is-user { justify-content: flex-end; }
  .cbx-av { width: 1.75rem; height: 1.75rem; flex-shrink: 0; border-radius: 9999px; background: var(--cbx-card); border: 1px solid var(--cbx-border); padding: 0.2rem; object-fit: contain; margin-bottom: 1.3rem; }
  .cbx-col { display: flex; min-width: 0; max-width: calc(100% - 2.4rem); flex-direction: column; align-items: flex-start; }
  .cbx-row.is-user .cbx-col { max-width: 86%; align-items: flex-end; }
  .cbx-bubble {
    max-width: 100%; padding: 0.65rem 0.9rem; border-radius: 1.15rem 1.15rem 1.15rem 0.35rem; font-size: 0.875rem; line-height: 1.6;
    overflow-wrap: anywhere; word-break: break-word; background: var(--cbx-card); color: var(--cbx-fg); border: 1px solid var(--cbx-border);
    box-shadow: var(--shadow-soft, 0 6px 16px -10px rgba(13, 26, 61, 0.35)); transform-origin: bottom left;
  }
  .cbx-row.is-user .cbx-bubble {
    border-radius: 1.15rem 1.15rem 0.35rem 1.15rem; border-color: transparent; color: #fff; transform-origin: bottom right;
    background-image: var(--gradient-navy, linear-gradient(135deg, #0d1a3d, #1d3a86)); white-space: pre-wrap;
  }
  .cbx-row.is-user .cbx-bubble a { color: inherit; }
  .cbx-bubble.is-error { background: oklch(0.97 0.02 25); border-color: oklch(0.85 0.08 25); color: oklch(0.42 0.15 27); }
  .cbx-row.is-in { animation: cbx-in 0.5s var(--cbx-spring) both; }
  .cbx-row.is-user.is-in { transform-origin: bottom right; }
  .cbx-row.is-out { animation: cbx-out 0.28s ease forwards; }
  @keyframes cbx-in { from { opacity: 0; transform: translateY(14px) scale(0.94); } to { opacity: 1; transform: none; } }
  @keyframes cbx-out { to { opacity: 0; transform: translateY(-8px) scale(0.96); } }
  .cbx-meta { display: flex; align-items: center; gap: 0.5rem; margin-top: 0.25rem; padding: 0 0.3rem; font-size: 0.66rem; color: var(--cbx-muted); }
  .cbx-copy {
    display: inline-flex; align-items: center; gap: 0.25rem; border: 0; background: transparent; padding: 0.1rem 0.25rem; border-radius: 0.4rem;
    color: var(--cbx-muted); font-size: 0.66rem; cursor: pointer; opacity: 0; transition: opacity 0.2s, background 0.2s, color 0.2s;
  }
  .cbx-copy svg { width: 0.72rem; height: 0.72rem; }
  .cbx-row:hover .cbx-copy, .cbx-copy:focus-visible, .cbx-copy.is-done { opacity: 1; }
  .cbx-copy:hover { background: var(--cbx-sec); color: var(--cbx-fg); }
  .cbx-copy.is-done { color: #059669; }
  @media (hover: none) { .cbx-copy { opacity: 0.75; } }

  /* Isi markdown di dalam gelembung bot */
  .cbx-bubble p { margin: 0 0 0.5em; } .cbx-bubble p:last-child { margin-bottom: 0; }
  .cbx-bubble p.cbx-h { font-weight: 700; color: var(--cbx-navy); font-family: var(--font-display, 'Sora', sans-serif); font-size: 0.9rem; }
  .cbx-bubble ul, .cbx-bubble ol { margin: 0.1em 0 0.55em; padding-left: 1.15rem; } .cbx-bubble ul:last-child, .cbx-bubble ol:last-child { margin-bottom: 0; }
  .cbx-bubble ul { list-style: disc; } .cbx-bubble ol { list-style: decimal; }
  .cbx-bubble li { margin: 0.18em 0; padding-left: 0.1rem; } .cbx-bubble li::marker { color: var(--cbx-navy-soft); font-weight: 700; }
  .cbx-bubble strong { font-weight: 700; color: var(--cbx-navy); }
  .cbx-row.is-user .cbx-bubble strong { color: inherit; }
  .cbx-bubble em { font-style: italic; }
  .cbx-bubble code { padding: 0.08em 0.35em; border-radius: 0.35rem; background: var(--cbx-sec); font-size: 0.85em; }
  .cbx-bubble a { color: var(--cbx-navy-soft); font-weight: 600; text-decoration: underline; text-decoration-color: var(--cbx-gold); text-decoration-thickness: 2px; text-underline-offset: 3px; transition: color 0.2s; }
  .cbx-bubble a:hover { color: var(--cbx-navy); }
  .cbx-bubble a .cbx-w { text-decoration: inherit; }
  .cbx-w { display: inline-block; animation: cbx-w 0.42s var(--cbx-ease) both; }
  @keyframes cbx-w { from { opacity: 0; transform: translateY(5px); } to { opacity: 1; transform: none; } }

  /* Tombol tindakan di gelembung error */
  .cbx-retry {
    display: inline-flex; align-items: center; gap: 0.35rem; margin-top: 0.5rem; padding: 0.3rem 0.7rem; border: 1px solid currentColor; border-radius: 9999px;
    background: transparent; font-size: 0.75rem; font-weight: 700; cursor: pointer; transition: background 0.2s, color 0.2s;
  }
  .cbx-retry:hover { background: oklch(0.42 0.15 27); color: #fff; }

  /* Indikator mengetik */
  .cbx-typing { display: flex; align-items: center; gap: 0.28rem; padding: 0.8rem 0.95rem; }
  .cbx-typing i { width: 0.45rem; height: 0.45rem; border-radius: 9999px; background: var(--cbx-navy-soft); animation: cbx-bounce 1.15s ease-in-out infinite; }
  .cbx-typing i:nth-child(2) { animation-delay: 0.16s; } .cbx-typing i:nth-child(3) { animation-delay: 0.32s; }
  @keyframes cbx-bounce { 0%, 60%, 100% { transform: translateY(0); opacity: 0.45; } 30% { transform: translateY(-5px); opacity: 1; } }
  .cbx-typing-t { margin-left: 0.4rem; font-size: 0.72rem; color: var(--cbx-muted); animation: cbx-fade 0.4s ease both; }
  @keyframes cbx-fade { from { opacity: 0; transform: translateX(-4px); } to { opacity: 1; transform: none; } }

  /* Pilihan cepat */
  .cbx-chips { display: flex; flex-wrap: wrap; gap: 0.4rem; margin: -0.1rem 0 0.8rem 2.25rem; transition: opacity 0.3s, transform 0.3s; }
  .cbx-chips.is-out { opacity: 0; transform: translateY(-6px); pointer-events: none; }
  .cbx-chip {
    border: 1px solid var(--cbx-border); background: var(--cbx-card); color: var(--cbx-navy); padding: 0.4rem 0.75rem; border-radius: 9999px;
    font-size: 0.78rem; font-weight: 600; line-height: 1.2; cursor: pointer; animation: cbx-chip 0.5s var(--cbx-spring) both; animation-delay: calc(var(--i, 0) * 70ms + 250ms);
    transition: background 0.25s, color 0.25s, border-color 0.25s, transform 0.3s var(--cbx-spring), box-shadow 0.25s;
  }
  @keyframes cbx-chip { from { opacity: 0; transform: translateY(10px) scale(0.85); } to { opacity: 1; transform: none; } }
  @media (hover: hover) {
    .cbx-chip:hover { background: var(--cbx-navy); color: #fff; border-color: var(--cbx-navy); transform: translateY(-2px); box-shadow: var(--shadow-soft, 0 8px 18px -10px rgba(13, 26, 61, 0.5)); }
  }
  .cbx-chip:active { transform: scale(0.95); }

  /* Tombol "ke pesan terbaru" */
  .cbx-jump {
    position: absolute; left: 50%; bottom: 0.7rem; display: flex; width: 2.1rem; height: 2.1rem; align-items: center; justify-content: center;
    border: 1px solid var(--cbx-border); border-radius: 9999px; background: var(--cbx-card); color: var(--cbx-navy); cursor: pointer;
    box-shadow: var(--shadow-soft, 0 8px 18px -8px rgba(13, 26, 61, 0.4)); opacity: 0; transform: translate(-50%, 10px) scale(0.8); pointer-events: none;
    transition: opacity 0.25s, transform 0.4s var(--cbx-spring);
  }
  .cbx-jump.is-on { opacity: 1; transform: translate(-50%, 0); pointer-events: auto; }
  .cbx-jump svg { width: 1.1rem; height: 1.1rem; }

  /* Kolom tulis pesan */
  .cbx-foot { flex-shrink: 0; padding: 0.7rem 0.8rem 0.55rem; border-top: 1px solid var(--cbx-border); background: var(--cbx-card); }
  .cbx-form { display: flex; align-items: flex-end; gap: 0.5rem; }
  .cbx-field {
    position: relative; flex: 1; border: 1.5px solid transparent; border-radius: 1.2rem; background: var(--cbx-sec);
    transition: border-color 0.25s, box-shadow 0.25s, background 0.25s;
  }
  .cbx-field:focus-within { border-color: var(--cbx-gold); background: var(--cbx-card); box-shadow: 0 0 0 4px oklch(from var(--cbx-gold) l c h / 0.22); }
  .cbx-input {
    display: block; width: 100%; max-height: 7rem; min-height: 2.6rem; resize: none; border: 0; outline: 0; background: transparent;
    padding: 0.66rem 0.95rem; font-size: 0.875rem; line-height: 1.4; color: var(--cbx-fg);
  }
  .cbx-input::placeholder { color: var(--cbx-muted); opacity: 0.85; }
  .cbx-count { position: absolute; right: 0.7rem; bottom: 0.15rem; font-size: 0.62rem; color: var(--cbx-muted); opacity: 0; transition: opacity 0.2s; pointer-events: none; }
  .cbx-count.is-on { opacity: 1; } .cbx-count.is-warn { color: oklch(0.55 0.2 27); font-weight: 700; }
  .cbx-send {
    display: flex; width: 2.7rem; height: 2.7rem; flex-shrink: 0; align-items: center; justify-content: center; border: 0; padding: 0; cursor: pointer;
    border-radius: 9999px; color: var(--cbx-gold-fg); background-image: var(--gradient-gold, linear-gradient(135deg, #f7d94a, #e8a317));
    box-shadow: var(--shadow-glow-gold, 0 10px 24px -10px rgba(232, 163, 23, 0.7)); transition: transform 0.35s var(--cbx-spring), opacity 0.25s, filter 0.25s;
  }
  .cbx-send svg { width: 1.2rem; height: 1.2rem; transition: transform 0.35s var(--cbx-ease); }
  .cbx-send:disabled { opacity: 0.4; cursor: not-allowed; box-shadow: none; filter: grayscale(0.4); }
  @media (hover: hover) { .cbx-send:not(:disabled):hover { transform: scale(1.1) rotate(-6deg); } .cbx-send:not(:disabled):hover svg { transform: translate(2px, -2px); } }
  .cbx-send:not(:disabled):active { transform: scale(0.9); }
  .cbx-send.is-fly svg { animation: cbx-fly 0.55s var(--cbx-ease); }
  @keyframes cbx-fly { 0% { transform: none; opacity: 1; } 45% { transform: translate(14px, -14px) scale(0.6); opacity: 0; } 55% { transform: translate(-14px, 14px) scale(0.6); opacity: 0; } 100% { transform: none; opacity: 1; } }
  .cbx-note { margin: 0.45rem 0 0; text-align: center; font-size: 0.64rem; line-height: 1.35; color: var(--cbx-muted); }

  /* ---------- Layar kecil: chat penuh layar ---------- */
  @media (max-width: 639px) {
    .cbx-panel {
      position: fixed; inset: 0; width: auto; height: auto; border: 0; border-radius: 0; transform-origin: bottom right;
      transform: translateY(40px) scale(0.96);
    }
    .cbx.is-open .cbx-panel { transform: none; }
    .cbx-head { padding-top: calc(0.95rem + env(safe-area-inset-top, 0px)); }
    .cbx-foot { padding-bottom: calc(0.55rem + env(safe-area-inset-bottom, 0px)); }
    .cbx-input { font-size: 16px; } /* mencegah zoom otomatis di iOS */
    .cbx.is-open .cbx-fab { transform: scale(0); opacity: 0; pointer-events: none; }
    .cbx-teaser { max-width: min(15rem, calc(100vw - 2rem)); }
    html.cbx-lock, html.cbx-lock body { overflow: hidden !important; }
  }
  @media (max-height: 560px) and (min-width: 640px) { .cbx-panel { height: calc(100dvh - 10.5rem); min-height: 0; } }

  @media (prefers-reduced-motion: reduce) {
    .cbx, .cbx *, .cbx *::before, .cbx *::after { animation-duration: 0.001ms !important; animation-iteration-count: 1 !important; transition-duration: 0.001ms !important; transition-delay: 0s !important; }
  }
  @media print { .cbx { display: none !important; } }
</style>

<script>
(function () {
  'use strict';

  var root = document.getElementById('cbx');
  if (!root) return;

  var $ = function (sel) { return root.querySelector(sel); };
  var fab = $('.cbx-fab'), panel = $('.cbx-panel'), body = $('.cbx-body'), list = $('.cbx-list'),
      form = $('.cbx-form'), input = $('.cbx-input'), sendBtn = $('.cbx-send'), count = $('.cbx-count'),
      jump = $('.cbx-jump'), teaser = $('.cbx-teaser');

  var ENDPOINT = root.dataset.endpoint, TOKEN = root.dataset.token, SCHOOL = root.dataset.school || 'SMK INFOKOM', LOGO = root.dataset.logo || '';
  var MAX = 500, KEY = 'smk:chat:v1', SEEN = 'smk:chat:seen', TEASED = 'smk:chat:teased';
  var REDUCED = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
  var MOBILE = window.matchMedia('(max-width: 639px)');
  var TOUCH = window.matchMedia('(pointer: coarse)').matches;

  var state = { open: false, busy: false, stick: true, msgs: [], rendered: false };

  /* ---------------- Util ---------------- */
  var EMOJI = /[\u{1F000}-\u{1FAFF}\u{2600}-\u{27BF}\u{2B00}-\u{2BFF}\u{FE0F}\u{200D}]/gu;
  var noEmoji = function (t) { return String(t).replace(EMOJI, '').replace(/[ \t]{2,}/g, ' '); };
  var esc = function (s) { return String(s).replace(/[&<>"']/g, function (c) { return { '&': '&amp;', '<': '&lt;', '>': '&gt;', '"': '&quot;', "'": '&#39;' }[c]; }); };
  var mk = function (tag, cls, html) { var e = document.createElement(tag); if (cls) e.className = cls; if (html != null) e.innerHTML = html; return e; };
  var ss = {
    get: function (k) { try { return sessionStorage.getItem(k); } catch (e) { return null; } },
    set: function (k, v) { try { sessionStorage.setItem(k, v); } catch (e) {} }
  };
  var clock = function (t) { try { return new Date(t).toLocaleTimeString('id-ID', { hour: '2-digit', minute: '2-digit' }); } catch (e) { return ''; } };

  function save() { ss.set(KEY, JSON.stringify({ m: state.msgs.slice(-30) })); }
  function load() {
    try { var d = JSON.parse(ss.get(KEY) || 'null'); return d && Array.isArray(d.m) ? d.m.filter(function (m) { return m && (m.role === 'user' || m.role === 'model') && typeof m.text === 'string'; }) : []; }
    catch (e) { return []; }
  }

  /* ---------------- Markdown ringan (aman: HTML di-escape dulu) ---------------- */
  function linkTpl(text, url) {
    if (url.indexOf('//') === 0) return text;                 // cegah protocol-relative
    var internal = url.charAt(0) === '/' || url.indexOf(location.origin) === 0;
    return '<a href="' + url + '"' + (internal ? '' : ' target="_blank" rel="noopener noreferrer"') + '>' + text + '</a>';
  }
  function inline(s) {
    return esc(s)
      .replace(/`([^`]+)`/g, '<code>$1</code>')
      .replace(/\*\*([^*]+)\*\*/g, '<strong>$1</strong>')
      .replace(/(^|[^*\w])\*([^*\s][^*]*?)\*(?![*\w])/g, '$1<em>$2</em>')
      .replace(/\[([^\]]+)\]\(((?:https?:\/\/|\/)[^\s)]+)\)/g, function (m, t, u) { return linkTpl(t, u); })
      .replace(/(^|[\s(])(https?:\/\/[^\s<)]*[^\s<).,;:!?])/g, function (m, p, u) { return p + linkTpl(u, u); });
  }
  function render(md) {
    var lines = String(md).replace(/\r/g, '').split('\n'), html = '', list = null, para = [], m;
    var flushP = function () { if (para.length) { html += '<p>' + para.map(inline).join('<br>') + '</p>'; para = []; } };
    var flushL = function () { if (list) { html += '</' + list + '>'; list = null; } };
    lines.forEach(function (raw) {
      var line = raw.replace(/\s+$/, '');
      if (!line.trim()) { flushP(); flushL(); return; }
      if ((m = line.match(/^\s*[-*•]\s+(.*)$/))) { flushP(); if (list !== 'ul') { flushL(); html += '<ul>'; list = 'ul'; } html += '<li>' + inline(m[1]) + '</li>'; return; }
      if ((m = line.match(/^\s*(\d+)[.)]\s+(.*)$/))) { flushP(); if (list !== 'ol') { flushL(); html += '<ol start="' + parseInt(m[1], 10) + '">'; list = 'ol'; } html += '<li>' + inline(m[2]) + '</li>'; return; }
      if ((m = line.match(/^#{1,4}\s+(.*)$/))) { flushP(); flushL(); html += '<p class="cbx-h">' + inline(m[1]) + '</p>'; return; }
      flushL(); para.push(line.trim());
    });
    flushP(); flushL();
    return html;
  }

  /* Animasi muncul kata demi kata (mirip mengetik, tetap mulus & aman untuk HTML) */
  function revealWords(node, budget) {
    var walker = document.createTreeWalker(node, NodeFilter.SHOW_TEXT), texts = [], n = 0;
    while (walker.nextNode()) texts.push(walker.currentNode);
    texts.forEach(function (t) { n += (t.nodeValue.match(/\S+/g) || []).length; });
    if (!n || n > 260) return 0;
    var step = Math.min(32, budget / n), i = 0;
    texts.forEach(function (t) {
      var frag = document.createDocumentFragment();
      t.nodeValue.split(/(\s+)/).forEach(function (part) {
        if (!part) return;
        if (/^\s+$/.test(part)) { frag.appendChild(document.createTextNode(part)); return; }
        var s = mk('span', 'cbx-w'); s.style.animationDelay = (i++ * step) + 'ms'; s.textContent = part; frag.appendChild(s);
      });
      t.parentNode.replaceChild(frag, t);
    });
    return n * step + 420;
  }

  /* ---------------- Scroll ---------------- */
  function toBottom(smooth) {
    body.scrollTo({ top: body.scrollHeight, behavior: smooth && !REDUCED ? 'smooth' : 'auto' });
  }
  function followWhile(ms) {
    var end = Date.now() + ms;
    (function tick() { if (state.stick) body.scrollTop = body.scrollHeight; if (Date.now() < end) requestAnimationFrame(tick); })();
  }
  body.addEventListener('scroll', function () {
    var gap = body.scrollHeight - body.scrollTop - body.clientHeight;
    state.stick = gap < 70;
    jump.classList.toggle('is-on', gap > 140);
  }, { passive: true });
  jump.addEventListener('click', function () { state.stick = true; toBottom(true); });

  /* ---------------- Pesan ---------------- */
  var ICON_COPY = '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="14" height="14" x="8" y="8" rx="2"/><path d="M4 16c-1.1 0-2-.9-2-2V4c0-1.1.9-2 2-2h10c1.1 0 2 .9 2 2"/></svg>';
  var ICON_OK = '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6 9 17l-5-5"/></svg>';

  function avatar() { return '<img class="cbx-av" src="' + esc(LOGO) + '" alt="" />'; }

  function addRow(role, text, opts) {
    opts = opts || {};
    if (role !== 'user') text = noEmoji(text);
    var animate = opts.animate !== false;
    var row = mk('div', 'cbx-row ' + (role === 'user' ? 'is-user' : 'is-bot') + (animate ? ' is-in' : ''));
    if (role !== 'user') row.insertAdjacentHTML('beforeend', avatar());
    var col = mk('div', 'cbx-col');
    var bubble = mk('div', 'cbx-bubble' + (opts.error ? ' is-error' : ''));

    if (role === 'user') bubble.textContent = text;
    else bubble.innerHTML = opts.error ? '<p>' + esc(text) + '</p>' : render(text);
    col.appendChild(bubble);

    var meta = mk('div', 'cbx-meta', '<span>' + clock(opts.time || Date.now()) + '</span>');
    if (role !== 'user' && !opts.error) {
      var cp = mk('button', 'cbx-copy', ICON_COPY + '<span>Salin</span>');
      cp.type = 'button'; cp.setAttribute('aria-label', 'Salin jawaban');
      cp.addEventListener('click', function () {
        var done = function () {
          cp.classList.add('is-done'); cp.innerHTML = ICON_OK + '<span>Tersalin</span>';
          setTimeout(function () { cp.classList.remove('is-done'); cp.innerHTML = ICON_COPY + '<span>Salin</span>'; }, 1600);
        };
        if (navigator.clipboard && navigator.clipboard.writeText) navigator.clipboard.writeText(text).then(done, function () {});
      });
      meta.appendChild(cp);
    }
    col.appendChild(meta);
    row.appendChild(col);
    list.appendChild(row);

    if (role !== 'user' && !opts.error && animate && !REDUCED) {
      var dur = revealWords(bubble, 1500);
      if (dur) followWhile(dur);
    }
    if (animate) { state.stick = state.stick || role === 'user'; if (state.stick) toBottom(true); }
    return { row: row, bubble: bubble };
  }

  function showTyping() {
    var row = mk('div', 'cbx-row is-bot is-in');
    row.insertAdjacentHTML('beforeend', avatar());
    var col = mk('div', 'cbx-col');
    var b = mk('div', 'cbx-bubble cbx-typing', '<i></i><i></i><i></i>');
    var label = mk('span', 'cbx-typing-t'); label.hidden = true; b.appendChild(label);
    col.appendChild(b); row.appendChild(col); list.appendChild(row);
    state.stick = true; toBottom(true);
    var steps = [[1400, 'Membaca data sekolah…'], [4200, 'Menyusun jawaban…'], [10000, 'Sedikit lagi ya…']];
    var timers = steps.map(function (s) { return setTimeout(function () { label.hidden = false; label.textContent = s[1]; label.style.animation = 'none'; void label.offsetWidth; label.style.animation = ''; }, s[0]); });
    return function () { timers.forEach(clearTimeout); row.remove(); };
  }

  var CHIPS = [
    ['Jurusan', 'Apa saja kompetensi keahlian di ' + SCHOOL + '?'],
    ['Biaya PPDB', 'Berapa rincian biaya PPDB?'],
    ['Syarat pendaftaran', 'Apa saja syarat pendaftaran siswa baru?'],
    ['Kontak sekolah', 'Bagaimana cara menghubungi sekolah?'],
    ['Prestasi', 'Prestasi apa saja yang pernah diraih sekolah?'],
    ['Ekstrakurikuler', 'Ekstrakurikuler apa saja yang tersedia?'],
    ['BKK', 'Apa itu BKK dan layanan apa yang diberikan?']
  ];
  var WELCOME = 'Halo! Saya **Asisten Virtual ' + SCHOOL + '**.\n\nSaya siap membantu info seputar jurusan, PPDB & biaya, guru & staff, fasilitas, ekstrakurikuler, prestasi, BKK, Magang Jepang, dan kunjungan industri.\n\nPilih topik di bawah atau ketik pertanyaan Anda.';

  function renderAll() {
    list.innerHTML = '';
    var welcomeAnimated = !state.rendered && !state.msgs.length;
    addRow('model', WELCOME, { animate: welcomeAnimated, time: Date.now() });
    if (!state.msgs.length) {
      var chips = mk('div', 'cbx-chips');
      CHIPS.forEach(function (c, i) {
        var b = mk('button', 'cbx-chip'); b.type = 'button'; b.textContent = c[0]; b.style.setProperty('--i', i);
        b.addEventListener('click', function () { ask(c[1]); });
        chips.appendChild(b);
      });
      list.appendChild(chips);
    }
    state.msgs.forEach(function (m) { addRow(m.role, m.text, { animate: false, time: m.t }); });
    state.rendered = true;
    state.stick = state.msgs.length > 0;
    requestAnimationFrame(function () { if (state.msgs.length) toBottom(false); else body.scrollTop = 0; });
  }

  function hideChips() {
    var c = list.querySelector('.cbx-chips');
    if (c) { c.classList.add('is-out'); setTimeout(function () { c.remove(); }, 320); }
  }

  /* ---------------- Kirim & terima ---------------- */
  function setBusy(b) {
    state.busy = b;
    root.classList.toggle('is-busy', b);
    sync();
  }
  function sync() {
    var len = input.value.length;
    sendBtn.disabled = state.busy || input.value.trim() === '';
    count.textContent = len + '/' + MAX;
    count.classList.toggle('is-on', len > 380);
    count.classList.toggle('is-warn', len >= MAX - 10);
    input.style.height = 'auto';
    input.style.height = Math.min(input.scrollHeight, 112) + 'px';
  }

  function ask(text, retry) {
    text = String(text || '').trim();
    if (!text || state.busy) return;
    if (text.length > MAX) text = text.slice(0, MAX);

    if (!retry) {
      state.stick = true;
      hideChips();
      state.msgs.push({ role: 'user', text: text, t: Date.now() });
      save();
      addRow('user', text);
    }
    input.value = ''; sync();
    sendBtn.classList.remove('is-fly'); void sendBtn.offsetWidth; sendBtn.classList.add('is-fly');
    setBusy(true);
    var stopTyping = showTyping();

    var history = state.msgs.slice(0, -1).slice(-8).map(function (m) { return { role: m.role, text: m.text.slice(0, 1500) }; });
    var ctrl = new AbortController();
    var to = setTimeout(function () { ctrl.abort(); }, 50000);

    fetch(ENDPOINT, {
      method: 'POST',
      signal: ctrl.signal,
      headers: { 'Content-Type': 'application/json', 'Accept': 'application/json', 'X-CSRF-TOKEN': TOKEN, 'X-Requested-With': 'XMLHttpRequest' },
      body: JSON.stringify({ message: text, history: history }),
      credentials: 'same-origin'
    }).then(function (res) {
      return res.json().catch(function () { return null; }).then(function (data) { return { res: res, data: data }; });
    }).then(function (r) {
      stopTyping();
      if (r.res.ok && r.data && r.data.reply) {
        state.msgs.push({ role: 'model', text: r.data.reply, t: Date.now() });
        save();
        addRow('model', r.data.reply);
      } else {
        var msg = (r.data && (r.data.message || (r.data.errors && Object.values(r.data.errors)[0] && Object.values(r.data.errors)[0][0]))) || '';
        if (r.res.status === 419) fail('Sesi halaman sudah kedaluwarsa. Muat ulang halaman, lalu coba lagi.', text, true);
        else if (r.res.status === 429) fail(msg || 'Terlalu banyak pesan dalam waktu singkat. Tunggu sebentar ya.', text);
        else fail(msg || 'Maaf, asisten sedang tidak dapat menjawab. Silakan coba lagi.', text);
      }
    }).catch(function (err) {
      stopTyping();
      fail(err && err.name === 'AbortError' ? 'Jawaban terlalu lama. Silakan coba lagi.' : 'Tidak ada koneksi internet atau server tidak merespons. Periksa jaringan Anda.', text);
    }).then(function () {
      clearTimeout(to);
      setBusy(false);
      if (state.open && !TOUCH) input.focus({ preventScroll: true });
    });
  }

  function fail(message, text, reload) {
    var r = addRow('model', message, { error: true });
    var btn = mk('button', 'cbx-retry', reload ? 'Muat ulang halaman' : 'Coba lagi');
    btn.type = 'button';
    btn.addEventListener('click', function () {
      if (reload) { location.reload(); return; }
      r.row.classList.add('is-out');
      setTimeout(function () { r.row.remove(); ask(text, true); }, 260);
    });
    r.bubble.appendChild(btn);
  }

  function reset() {
    if (state.busy) return;
    var rows = list.querySelectorAll('.cbx-row, .cbx-chips');
    rows.forEach(function (r) { r.classList.add('is-out'); });
    setTimeout(function () {
      state.msgs = []; save(); state.rendered = false; renderAll();
      if (!TOUCH) input.focus({ preventScroll: true });
    }, REDUCED ? 0 : 260);
  }

  /* ---------------- Buka / tutup ---------------- */
  function fit() { // layar kecil: ikuti tinggi area terlihat (keyboard HP)
    var vv = window.visualViewport;
    if (state.open && MOBILE.matches && vv) { panel.style.top = vv.offsetTop + 'px'; panel.style.height = vv.height + 'px'; panel.style.bottom = 'auto'; }
    else { panel.style.top = panel.style.height = panel.style.bottom = ''; }
  }
  function open() {
    if (state.open) return;
    state.open = true;
    root.classList.add('is-open', 'is-seen');
    panel.inert = false;
    fab.setAttribute('aria-expanded', 'true'); fab.setAttribute('aria-label', 'Tutup chatbot');
    ss.set(SEEN, '1');
    hideTeaser();
    if (!state.rendered) renderAll(); else { state.stick = true; requestAnimationFrame(function () { if (state.msgs.length) toBottom(false); else body.scrollTop = 0; }); }
    if (MOBILE.matches) document.documentElement.classList.add('cbx-lock');
    fit();
    setTimeout(function () { if (!TOUCH) input.focus({ preventScroll: true }); }, REDUCED ? 0 : 380);
  }
  function close() {
    if (!state.open) return;
    state.open = false;
    root.classList.remove('is-open');
    panel.inert = true;
    fab.setAttribute('aria-expanded', 'false'); fab.setAttribute('aria-label', 'Buka chatbot asisten sekolah');
    document.documentElement.classList.remove('cbx-lock');
    fit();
    fab.focus({ preventScroll: true });
  }
  fab.addEventListener('click', function () { state.open ? close() : open(); });
  root.querySelector('[data-cbx-close]').addEventListener('click', close);
  root.querySelector('[data-cbx-reset]').addEventListener('click', reset);
  document.addEventListener('keydown', function (e) { if (e.key === 'Escape' && state.open) close(); });
  document.addEventListener('click', function (e) { // tombol lain di halaman: <a data-chatbot-open>
    var t = e.target.closest && e.target.closest('[data-chatbot-open]');
    if (t) { e.preventDefault(); open(); }
  });
  window.SmkChatbot = { open: open, close: close };
  if (window.visualViewport) { window.visualViewport.addEventListener('resize', fit); window.visualViewport.addEventListener('scroll', fit); }
  MOBILE.addEventListener && MOBILE.addEventListener('change', function () { if (!MOBILE.matches) document.documentElement.classList.remove('cbx-lock'); else if (state.open) document.documentElement.classList.add('cbx-lock'); fit(); });

  /* ---------------- Form ---------------- */
  input.addEventListener('input', sync);
  input.addEventListener('keydown', function (e) {
    if (e.key === 'Enter' && !e.shiftKey && !e.isComposing) { e.preventDefault(); form.requestSubmit ? form.requestSubmit() : ask(input.value); }
  });
  form.addEventListener('submit', function (e) { e.preventDefault(); ask(input.value); });

  /* ---------------- Sapaan kecil ---------------- */
  function hideTeaser() {
    if (teaser.hidden) return;
    teaser.classList.remove('is-in'); teaser.classList.add('is-out');
    setTimeout(function () { teaser.hidden = true; teaser.classList.remove('is-out'); }, 300);
  }
  teaser.querySelector('.cbx-teaser-x').addEventListener('click', function (e) { e.stopPropagation(); hideTeaser(); });
  teaser.addEventListener('click', function () { open(); });
  if (!ss.get(TEASED) && !ss.get(SEEN)) {
    setTimeout(function () {
      if (state.open) return;
      ss.set(TEASED, '1'); teaser.hidden = false; teaser.classList.add('is-in');
      setTimeout(hideTeaser, 9000);
    }, 3500);
  }
  if (ss.get(SEEN)) root.classList.add('is-seen');

  /* ---------------- Tidak bertabrakan dgn tombol "kembali ke atas" ---------------- */
  // Tombol atas (.scroll-top-btn) dibuat oleh app.js & mendapat class .is-visible setelah scroll > 520px.
  // Saat tampil, widget ini naik 4.1rem (tinggi tombol + jarak) dengan animasi halus; saat hilang turun lagi.
  var liftRaf = 0;
  function syncLift() {
    cancelAnimationFrame(liftRaf);
    liftRaf = requestAnimationFrame(function () {
      var b = document.querySelector('.scroll-top-btn');
      root.classList.toggle('is-lifted', b ? b.classList.contains('is-visible') : window.scrollY > 520);
    });
  }
  window.addEventListener('scroll', syncLift, { passive: true });
  window.addEventListener('resize', syncLift);
  window.addEventListener('load', syncLift);
  window.addEventListener('pageshow', syncLift);
  document.addEventListener('DOMContentLoaded', syncLift);
  syncLift();

  /* ---------------- Awal ---------------- */
  state.msgs = load();
  sync();
})();
</script>
<?php /**PATH C:\PunyaSaya\smk-infokom\resources\views/partials/chatbot.blade.php ENDPATH**/ ?>