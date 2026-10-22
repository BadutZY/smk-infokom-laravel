// ===================================================================
// SMK INFOKOM Kota Bogor — front-end interactions (v2 "Aurora Grid")
// CSS + vanilla JS. Semua animasi memakai transform/opacity (GPU) dan
// otomatis menghormati "prefers-reduced-motion".
// ===================================================================

import './ui-v3.js';

const REDUCED = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
const FINE_POINTER = window.matchMedia('(pointer: fine)').matches;
const CAN_HOVER = window.matchMedia('(hover: hover)').matches;
const root = document.documentElement;
const clamp = (v, min, max) => Math.min(Math.max(v, min), max);
const raf = (fn) => requestAnimationFrame(fn);

document.addEventListener('DOMContentLoaded', () => {
  initBoot();
  initSplitText();
  initMobileNav();
  initNavAccordion();
  initNavbarScroll();
  initNavHoverPill();
  initReveal();
  initCountUp();
  initHeroSlider();
  initPartnerMarquee();
  initTabs();
  initFilters();
  initStaffFilter();
  initStaffCardTilt();
  initLightbox();
  initPpdbForm();
  initPasswordToggles();
  initAlertAutoHide();
  initAdminSidebar();
  initAdminPopover();
  initConfirmDelete();
  initDashboardCharts();
  initAdminModal();
  initFotoCropper();
  initPasswordStrength();
  initTableRowReveal();
  initMagneticButtons();
  initSidebarActiveIndicator();
  initFormSubmitSpinner();
  initScrollTopButton();
  initReadProgress();
  initTiltGlow();
  initShareButtons();
  initCardSpotlight();
  initPointerParallax();
  initScrollParallax();
  initCursorGlow();
  initParticles();
  initLinkTransitions();
});

// ---------- Scroll state global (--scroll 0..1) untuk navbar & tombol atas ----------
let scrollTicking = false;
function updateScrollVar() {
  const max = Math.max(document.documentElement.scrollHeight - window.innerHeight, 1);
  root.style.setProperty('--scroll', clamp(window.scrollY / max, 0, 1).toFixed(4));
  scrollTicking = false;
}
window.addEventListener('scroll', () => {
  if (!scrollTicking) { scrollTicking = true; raf(updateScrollVar); }
}, { passive: true });
window.addEventListener('resize', () => raf(updateScrollVar));

// ---------- Boot: tirai transisi halaman + animasi masuk ----------
// Alur: halaman baru dimulai TERTUTUP tirai + nama halaman di tengah (class
// .pt-enter dipasang skrip kecil di <head> sebelum render pertama), lalu teks
// keluar ke atas, tirai terangkat, dan konten hero masuk (class .page-loaded).
// Panel admin (data-transition="normal") tidak punya tirai: langsung tampil.
function initBoot() {
  const curtain = document.querySelector('.pt-curtain');
  const entering = root.classList.contains('pt-enter');

  if (!entering || !curtain || REDUCED) {
    root.classList.remove('pt-enter', 'pt-intro');
    if (document.body.dataset.transition === 'normal') {
      root.classList.add('page-loaded'); // admin: tanpa jeda sama sekali
    } else {
      raf(() => setTimeout(() => root.classList.add('page-loaded'), 40));
    }
    return;
  }

  const isIntro = root.classList.contains('pt-intro');
  // Teks nama halaman dibiarkan terbaca sebentar sebelum tirai terbuka.
  const hold = isIntro ? 1500 : 320;
  const fontsReady = document.fonts && document.fonts.ready ? Promise.race([document.fonts.ready, new Promise((r) => setTimeout(r, 700))]) : Promise.resolve();

  Promise.all([fontsReady, new Promise((r) => setTimeout(r, hold))]).then(() => {
    curtain.classList.add('is-opening');
    setTimeout(() => root.classList.add('page-loaded'), 520);
    setTimeout(() => {
      curtain.classList.remove('is-opening');
      root.classList.remove('pt-enter', 'pt-intro');
    }, 1300);
  });
}

// ---------- Nama halaman tujuan (ditampilkan besar di tengah saat transisi) ----------
const PAGE_LABELS = {
  '/': 'Beranda',
  '/profil': 'Profil Sekolah',
  '/akademik': 'Akademik',
  '/guru-staff': 'Guru & Staff',
  '/berita': 'Berita',
  '/galeri': 'Galeri',
  '/prestasi': 'Prestasi Sekolah',
  '/magang-jepang': 'Magang Jepang',
  '/bkk': 'BKK',
  '/ppdb': 'PPDB',
  '/kontak': 'Kontak',
  '/login': 'Login Admin',
  '/lupa-password': 'Lupa Password',
};

function pageLabelFor(anchor, url) {
  // 1) Bisa ditentukan manual: <a data-page-label="Nama Halaman">
  const manual = anchor.getAttribute('data-page-label');
  if (manual) return manual.trim();

  // 2) Peta rute yang sudah dikenal
  const path = url.pathname.replace(/\/+$/, '') || '/';
  if (PAGE_LABELS[path]) return PAGE_LABELS[path];
  if (path.startsWith('/akademik/jurusan/')) return 'Detail Jurusan';
  if (path.startsWith('/berita/')) return 'Detail Berita';

  // 3) Cadangan: teks tautan, atau nama dari potongan URL terakhir
  const text = (anchor.textContent || '').replace(/\s+/g, ' ').trim();
  if (text && text.length <= 32) return text;
  const last = decodeURIComponent(path.split('/').filter(Boolean).pop() || '');
  const pretty = last.replace(/[-_]+/g, ' ').replace(/\b\w/g, (c) => c.toUpperCase()).trim();
  return pretty ? pretty.slice(0, 32) : 'Halaman';
}

// ---------- Transisi keluar: tirai menutup + nama halaman muncul, lalu pindah ----------
function initLinkTransitions() {
  const curtain = document.querySelector('.pt-curtain');
  // 'curtain' = halaman publik (tirai + nama halaman)
  // 'normal'  = panel admin (navigasi biasa, tanpa animasi apa pun)
  const mode = document.body.dataset.transition || 'curtain';
  const isNormal = mode === 'normal';
  let leaving = false;
  let restoreTimer = null;

  // Bar progres tipis (dipakai saat submit form)
  const bar = document.createElement('div');
  bar.className = 'page-progress';
  document.body.appendChild(bar);
  const progressStart = () => {
    bar.classList.add('is-active');
    bar.style.width = '22%';
    setTimeout(() => { bar.style.width = '68%'; }, 120);
    setTimeout(() => { bar.style.width = '88%'; }, 900);
  };
  const progressReset = () => {
    bar.style.width = '100%';
    setTimeout(() => {
      bar.classList.remove('is-active');
      setTimeout(() => { bar.style.width = '0%'; }, 320);
    }, 220);
  };
  window.__pageProgress = { start: progressStart, done: progressReset };

  const restore = () => {
    leaving = false;
    curtain?.classList.remove('is-closing');
    progressReset();
  };

  // Halaman dipulihkan dari bfcache (tombol Back/Forward): pastikan bersih.
  window.addEventListener('pageshow', (e) => {
    if (e.persisted) {
      root.classList.remove('pt-enter', 'pt-intro');
      root.classList.add('page-loaded');
      restore();
    }
  });

  document.addEventListener('submit', (e) => {
    if (e.target instanceof HTMLFormElement && !e.defaultPrevented) progressStart();
  });

  // Admin: biarkan browser menavigasi secara normal (tidak ada intercept tautan).
  if (isNormal || !curtain) return;

  const isInternalNav = (a, e) => {
    if (!a || e.defaultPrevented || e.button !== 0) return false;
    if (e.metaKey || e.ctrlKey || e.shiftKey || e.altKey) return false;
    if (a.target && a.target !== '_self') return false;
    if (a.hasAttribute('download') || a.hasAttribute('data-no-transition')) return false;
    const href = a.getAttribute('href') || '';
    if (!href || href.startsWith('#') || /^(mailto:|tel:|javascript:|sms:|whatsapp:)/i.test(href)) return false;
    let url;
    try { url = new URL(a.href, window.location.href); } catch (err) { return false; }
    if (url.origin !== window.location.origin) return false;
    // Tujuan panel admin: navigasi normal tanpa tirai
    if (/^\/admin(\/|$)/.test(url.pathname)) return false;
    // Tautan ke halaman yang sama (hanya beda hash) atau berkas non-halaman
    if (url.pathname === window.location.pathname && url.search === window.location.search) return false;
    if (/\.(pdf|zip|docx?|xlsx?|pptx?|jpe?g|png|webp|gif|svg|mp4|webm)$/i.test(url.pathname)) return false;
    if (/\/pdf\/?$/i.test(url.pathname)) return false;
    return true;
  };

  document.addEventListener('click', (e) => {
    const a = e.target.closest('a[href]');
    if (!isInternalNav(a, e) || leaving) return;
    leaving = true;
    e.preventDefault();
    const go = () => { window.location.href = a.href; };
    const label = pageLabelFor(a, new URL(a.href, window.location.href));

    try {
      sessionStorage.setItem('smk:pt', '1');
      sessionStorage.setItem('smk:pt-label', label); // dibaca halaman tujuan agar teksnya sama persis
    } catch (err) { /* private mode */ }

    if (REDUCED) { go(); return; }

    if (typeof window.__ptSetLabel === 'function') window.__ptSetLabel(label, 'Menuju');
    curtain.classList.remove('is-opening');
    curtain.classList.add('is-closing');
    setTimeout(go, 900);

    // Jika navigasi ternyata tidak berpindah halaman (mis. unduhan), pulihkan tampilan.
    clearTimeout(restoreTimer);
    restoreTimer = setTimeout(() => {
      try { sessionStorage.removeItem('smk:pt'); sessionStorage.removeItem('smk:pt-label'); } catch (err) {}
      restore();
    }, 6000);
  });
}

// ---------- Judul dipecah per kata (animasi kata naik) ----------
function initSplitText() {
  document.querySelectorAll('[data-split]').forEach((el) => {
    if (el.dataset.splitDone) return;
    const text = el.textContent;
    el.setAttribute('aria-label', text.trim().replace(/\s+/g, ' '));
    el.textContent = '';
    let w = 0;
    text.split(/(\s+)/).forEach((part) => {
      if (part === '') return;
      if (/^\s+$/.test(part)) { el.appendChild(document.createTextNode(part)); return; }
      const outer = document.createElement('span');
      outer.className = 'split-word';
      outer.setAttribute('aria-hidden', 'true');
      const inner = document.createElement('span');
      inner.className = 'split-inner';
      inner.style.setProperty('--w', String(w++));
      inner.textContent = part;
      outer.appendChild(inner);
      el.appendChild(outer);
    });
    el.dataset.splitDone = '1';
  });
}

// ---------- Mobile nav (animasi buka/tutup) ----------
function initMobileNav() {
  const toggle = document.querySelector('[data-nav-toggle]');
  const menu = document.querySelector('[data-nav-menu]');
  if (!toggle || !menu) return;

  menu.classList.add('nav-menu');
  Array.from(menu.children).forEach((child, i) => child.style.setProperty('--i', String(i)));
  let closeTimer = null;

  const setIcons = (open) => {
    toggle.querySelector('[data-icon-menu]')?.classList.toggle('hidden', open);
    toggle.querySelector('[data-icon-close]')?.classList.toggle('hidden', !open);
  };

  const open = () => {
    clearTimeout(closeTimer);
    menu.classList.remove('hidden');
    menu.classList.add('flex');
    void menu.offsetWidth; // paksa reflow agar transisi masuk terputar
    menu.classList.add('is-open');
    toggle.setAttribute('aria-expanded', 'true');
    setIcons(true);
    document.querySelector('[data-navbar]')?.classList.remove('is-hidden');
  };
  const close = () => {
    menu.classList.remove('is-open');
    toggle.setAttribute('aria-expanded', 'false');
    setIcons(false);
    closeTimer = setTimeout(() => {
      menu.classList.add('hidden');
      menu.classList.remove('flex');
    }, REDUCED ? 0 : 380);
  };
  const isOpen = () => menu.classList.contains('is-open');

  toggle.addEventListener('click', () => (isOpen() ? close() : open()));
  menu.querySelectorAll('a').forEach((link) => link.addEventListener('click', () => { if (isOpen()) close(); }));
  document.addEventListener('keydown', (e) => { if (e.key === 'Escape' && isOpen()) close(); });
  document.addEventListener('click', (e) => {
    if (isOpen() && !menu.contains(e.target) && !toggle.contains(e.target)) close();
  });
  window.matchMedia('(min-width: 1280px)').addEventListener('change', (e) => { if (e.matches && isOpen()) close(); });
}

// ---------- Mobile nav: accordion (tinggi dianimasikan lewat grid-rows) ----------
function initNavAccordion() {
  document.querySelectorAll('[data-nav-accordion]').forEach((wrapper) => {
    const toggle = wrapper.querySelector('[data-nav-accordion-toggle]');
    const panel = wrapper.querySelector('[data-nav-accordion-panel]');
    const chevron = wrapper.querySelector('[data-nav-accordion-chevron]');
    if (!toggle || !panel) return;

    toggle.setAttribute('aria-expanded', String(panel.classList.contains('is-open')));
    toggle.addEventListener('click', () => {
      const open = panel.classList.toggle('is-open');
      toggle.setAttribute('aria-expanded', String(open));
      chevron?.classList.toggle('rotate-180', open);
    });
  });
}

// ---------- Navbar: efek scroll, sembunyi saat turun, progres ----------
function initNavbarScroll() {
  const nav = document.querySelector('[data-navbar]');
  if (!nav) {
    updateScrollVar();
    return;
  }
  let lastY = window.scrollY;
  let ticking = false;

  const update = () => {
    const y = window.scrollY;
    const scrolled = y > 12;
    nav.setAttribute('data-scrolled', scrolled ? 'true' : 'false');

    const menuOpen = document.querySelector('[data-nav-menu].is-open');
    const delta = y - lastY;
    if (!menuOpen) {
      if (y > 320 && delta > 6) nav.classList.add('is-hidden');
      else if (delta < -4 || y < 200) nav.classList.remove('is-hidden');
    }
    if (Math.abs(delta) > 4) lastY = y;
    ticking = false;
  };
  update();
  window.addEventListener('scroll', () => {
    if (!ticking) { ticking = true; raf(update); }
  }, { passive: true });

  // Saat fokus keyboard masuk ke navbar, pastikan navbar terlihat.
  nav.addEventListener('focusin', () => nav.classList.remove('is-hidden'));
  updateScrollVar();
}

// ---------- Navbar desktop: pil hover yang meluncur antar menu ----------
function initNavHoverPill() {
  const track = document.querySelector('[data-nav-track]');
  if (!track || !CAN_HOVER) return;
  track.classList.add('nav-track');
  const pill = document.createElement('span');
  pill.className = 'nav-hover-pill';
  pill.setAttribute('aria-hidden', 'true');
  track.prepend(pill);

  const moveTo = (item) => {
    pill.style.width = `${item.offsetWidth}px`;
    pill.style.height = `${item.offsetHeight}px`;
    pill.style.transform = `translate(${item.offsetLeft}px, ${item.offsetTop}px)`;
    pill.classList.add('is-on');
  };
  const items = Array.from(track.children).filter((c) => c !== pill);
  let first = true;
  items.forEach((item) => {
    item.addEventListener('pointerenter', () => {
      if (first) {
        // Posisi awal langsung (tanpa meluncur dari 0,0)
        pill.style.transition = 'none';
        moveTo(item);
        void pill.offsetWidth;
        pill.style.transition = '';
        first = false;
      } else {
        moveTo(item);
      }
    });
  });
  track.addEventListener('pointerleave', () => { pill.classList.remove('is-on'); first = true; });
}

// ---------- Reveal saat scroll (stagger otomatis lewat --i) ----------
function initReveal() {
  const groups = document.querySelectorAll('.stagger-group');
  groups.forEach((group) => {
    let i = 0;
    group.querySelectorAll('.stagger-item').forEach((item) => {
      if (item.closest('.stagger-group') !== group) return;
      item.style.setProperty('--i', String(Math.min(i, 9)));
      i += 1;
    });
  });

  // Elemen .reveal bersaudara di dalam satu induk diberi jeda berurutan kecil
  const parents = new Map();
  document.querySelectorAll('.reveal, .reveal-left, .reveal-right, .reveal-scale').forEach((el) => {
    if (el.style.getPropertyValue('--rd')) return;
    const p = el.parentElement;
    const n = parents.get(p) || 0;
    if (n > 0) el.style.setProperty('--rd', `${Math.min(n, 4) * 90}ms`);
    parents.set(p, n + 1);
  });

  const els = document.querySelectorAll('.reveal, .reveal-left, .reveal-right, .reveal-scale, .stagger-group');
  if (!('IntersectionObserver' in window) || els.length === 0) {
    els.forEach((el) => el.classList.add('is-visible'));
    return;
  }
  const observer = new IntersectionObserver(
    (entries) => {
      entries.forEach((entry) => {
        if (entry.isIntersecting) {
          entry.target.classList.add('is-visible');
          observer.unobserve(entry.target);
        }
      });
    },
    { threshold: 0.06, rootMargin: '0px 0px -7% 0px' }
  );
  els.forEach((el) => observer.observe(el));
}

// ---------- Count up numbers (easeOutExpo, tanpa lompatan) ----------
function initCountUp() {
  const els = document.querySelectorAll('[data-countup]');
  if (els.length === 0) return;

  els.forEach((el) => { el.style.fontVariantNumeric = 'tabular-nums'; });

  const animate = (el) => {
    const target = parseInt(el.dataset.countup, 10) || 0;
    const suffix = el.dataset.suffix || '';
    if (REDUCED) { el.textContent = target + suffix; return; }
    const duration = 1800;
    const start = performance.now();

    const step = (now) => {
      const progress = Math.min((now - start) / duration, 1);
      const eased = progress === 1 ? 1 : 1 - Math.pow(2, -10 * progress);
      el.textContent = Math.round(eased * target) + suffix;
      if (progress < 1) requestAnimationFrame(step);
      else el.textContent = target + suffix;
    };
    requestAnimationFrame(step);
  };

  if (!('IntersectionObserver' in window)) {
    els.forEach(animate);
    return;
  }
  const observer = new IntersectionObserver(
    (entries) => {
      entries.forEach((entry) => {
        if (entry.isIntersecting) {
          animate(entry.target);
          observer.unobserve(entry.target);
        }
      });
    },
    { threshold: 0.4 }
  );
  els.forEach((el) => observer.observe(el));
}

// ---------- Hero slider (crossfade + teks masuk ulang + geser sentuh) ----------
function initHeroSlider() {
  const rootEl = document.querySelector('[data-hero-slider]');
  if (!rootEl) return;
  const slides = Array.from(rootEl.querySelectorAll('[data-hero-slide]'));
  const dots = Array.from(rootEl.querySelectorAll('[data-hero-dot]'));
  const DURATION = 6500;
  rootEl.style.setProperty('--hero-dur', `${DURATION}ms`);

  const setActive = (i) => {
    slides.forEach((s, si) => {
      s.classList.toggle('is-active', si === i);
      s.classList.toggle('opacity-100', si === i);
      s.classList.toggle('opacity-0', si !== i);
      s.classList.toggle('pointer-events-none', si !== i);
      s.setAttribute('aria-hidden', String(si !== i));
    });
    dots.forEach((d, di) => {
      // Bar progres: dimatikan lalu dinyalakan lagi supaya isiannya mulai dari awal
      d.classList.remove('is-on');
      if (di === i) { void d.offsetWidth; d.classList.add('is-on'); }
      d.setAttribute('aria-current', di === i ? 'true' : 'false');
    });
    const activeImg = slides[i]?.querySelector('img');
    if (activeImg) {
      activeImg.classList.remove('ken-burns');
      void activeImg.offsetWidth;
      activeImg.classList.add('ken-burns');
    }
  };

  if (slides.length <= 1) {
    if (slides[0]) slides[0].classList.add('is-active');
    return;
  }

  let index = 0;
  let timer = null;
  const show = (i) => { index = (i + slides.length) % slides.length; setActive(index); };
  const restart = () => {
    clearInterval(timer);
    if (REDUCED) return;
    timer = setInterval(() => { if (!document.hidden) show(index + 1); }, DURATION);
  };

  dots.forEach((dot, i) => dot.addEventListener('click', () => { show(i); restart(); }));

  // Geser jari kiri/kanan
  let startX = null;
  rootEl.addEventListener('touchstart', (e) => { startX = e.touches[0].clientX; }, { passive: true });
  rootEl.addEventListener('touchend', (e) => {
    if (startX === null) return;
    const dx = e.changedTouches[0].clientX - startX;
    startX = null;
    if (Math.abs(dx) > 55) { show(index + (dx < 0 ? 1 : -1)); restart(); }
  }, { passive: true });

  show(0);
  restart();
}

// ---------- Tabs (Profil, Akademik) dengan indikator yang meluncur ----------
function initTabs() {
  document.querySelectorAll('[data-tabs]').forEach((group) => {
    const buttons = Array.from(group.querySelectorAll('[data-tab-btn]'));
    const panels = group.querySelectorAll('[data-tab-panel]');
    if (buttons.length === 0) return;

    const bar = buttons[0].parentElement;
    bar.classList.add('seg');
    const indicator = document.createElement('span');
    indicator.className = 'seg-indicator';
    indicator.setAttribute('aria-hidden', 'true');
    bar.prepend(indicator);

    const placeIndicator = (btn, animate = true) => {
      if (!animate) indicator.style.transition = 'none';
      indicator.style.width = `${btn.offsetWidth}px`;
      indicator.style.height = `${btn.offsetHeight}px`;
      indicator.style.transform = `translate(${btn.offsetLeft}px, ${btn.offsetTop}px)`;
      if (!animate) { void indicator.offsetWidth; indicator.style.transition = ''; }
    };

    const paint = (target, animate) => {
      buttons.forEach((b) => {
        const active = b.dataset.tabBtn === target;
        // Latar tombol aktif sekarang digambar oleh indikator yang meluncur
        b.classList.remove('bg-primary', 'shadow-soft');
        b.classList.toggle('text-primary-foreground', active);
        b.classList.toggle('text-muted-foreground', !active);
        b.setAttribute('aria-selected', String(active));
        if (active) placeIndicator(b, animate);
      });
    };

    const initial = buttons.find((b) => b.classList.contains('bg-primary') || b.classList.contains('text-primary-foreground')) || buttons[0];
    paint(initial.dataset.tabBtn, false);
    // Hitung ulang setelah font siap & saat ukuran berubah
    if (document.fonts && document.fonts.ready) document.fonts.ready.then(() => paint(group.querySelector('[data-tab-btn][aria-selected="true"]')?.dataset.tabBtn || initial.dataset.tabBtn, false));
    window.addEventListener('resize', () => {
      const cur = buttons.find((b) => b.getAttribute('aria-selected') === 'true') || initial;
      placeIndicator(cur, false);
    });

    buttons.forEach((btn) => {
      btn.addEventListener('click', () => {
        const target = btn.dataset.tabBtn;
        paint(target, true);
        panels.forEach((p) => {
          if (p.dataset.tabPanel === target) {
            p.classList.remove('hidden');
            p.classList.remove('fade-in');
            void p.offsetWidth;
            p.classList.add('fade-in');
          } else {
            p.classList.add('hidden');
            p.classList.remove('fade-in');
          }
        });
      });
    });
  });
}

// Animasi kartu yang muncul kembali setelah filter: bertahap (stagger) & mulus
function staggerIn(elements) {
  let n = 0;
  elements.forEach((el) => {
    el.classList.remove('fade-in');
    void el.offsetWidth;
    el.style.setProperty('--fd', `${Math.min(n, 12) * 45}ms`);
    el.classList.add('fade-in');
    n += 1;
  });
}

// ---------- Category filters (Berita & Galeri) ----------
function initFilters() {
  document.querySelectorAll('[data-filter-group]').forEach((group) => {
    const buttons = group.querySelectorAll('[data-filter-btn]');
    const targetSelector = group.dataset.filterGroup;
    const items = Array.from(document.querySelectorAll(targetSelector + ' [data-filter-item]'));
    const container = document.querySelector(targetSelector);
    const emptyState = container ? container.parentElement.querySelector('[data-filter-empty]') : null;

    buttons.forEach((btn) => {
      btn.addEventListener('click', () => {
        const value = btn.dataset.filterBtn;

        buttons.forEach((b) => {
          const active = b === btn;
          b.classList.toggle('bg-primary', active);
          b.classList.toggle('text-primary-foreground', active);
          b.classList.toggle('bg-secondary', !active);
          b.classList.toggle('text-secondary-foreground', !active);
        });

        const toShow = [];
        items.forEach((item) => {
          const show = value === 'Semua' || item.dataset.category === value;
          item.classList.toggle('hidden', !show);
          if (show) toShow.push(item);
        });
        staggerIn(toShow);

        if (emptyState) emptyState.classList.toggle('is-visible', toShow.length === 0);
      });
    });
  });
}

// ---------- Filter kategori Guru & Staff (dropdown) ----------
function initStaffFilter() {
  const select = document.querySelector('[data-staff-filter-select]');
  if (!select) return;
  const sections = document.querySelectorAll('[data-staff-category]');

  select.addEventListener('change', () => {
    const value = select.value;
    sections.forEach((section) => {
      const show = value === 'Semua' || section.dataset.staffCategory === value;
      section.classList.toggle('is-filtered-out', !show);
      if (show) staggerIn(Array.from(section.querySelectorAll('.staff-card')));
    });
    // Elemen judul kategori ikut muncul mulus
    sections.forEach((section) => {
      if (!section.classList.contains('is-filtered-out')) {
        const heading = section.firstElementChild;
        if (heading && !heading.classList.contains('staff-card')) staggerIn([heading]);
      }
    });
  });
}

// ---------- Lightbox for gallery / berita photos ----------
function initLightbox() {
  const overlay = document.querySelector('[data-lightbox]');
  if (!overlay) return;
  const img = overlay.querySelector('[data-lightbox-img]');
  const caption = overlay.querySelector('[data-lightbox-caption]');
  const counter = overlay.querySelector('[data-lightbox-count]');
  const closeBtn = overlay.querySelector('[data-lightbox-close]');
  const prevBtn = overlay.querySelector('[data-lightbox-prev]');
  const nextBtn = overlay.querySelector('[data-lightbox-next]');
  let closing = false;
  let list = [];
  let index = 0;
  let lastFocus = null;

  // Foto yang sedang tampil (tidak tersembunyi oleh filter kategori / pencarian)
  const visibleTriggers = (scope) => Array.from(scope.querySelectorAll('[data-lightbox-trigger]'))
    .filter((t) => !t.closest('.hidden, .is-search-hidden'));

  const render = () => {
    const t = list[index];
    if (!t) return;
    img.classList.add('is-loading');
    img.onload = () => img.classList.remove('is-loading');
    img.src = t.dataset.lightboxTrigger;
    if (img.complete) img.classList.remove('is-loading');
    caption.textContent = t.dataset.lightboxCaption || '';
    if (counter) counter.textContent = list.length > 1 ? `${index + 1} / ${list.length}` : '';
    [prevBtn, nextBtn].forEach((b) => b && b.classList.toggle('hidden', list.length < 2));
    if (list.length > 1) {
      [1, -1].forEach((d) => {
        const n = list[(index + d + list.length) % list.length];
        if (n) { const pre = new Image(); pre.src = n.dataset.lightboxTrigger; }
      });
    }
  };
  const go = (d) => {
    if (list.length < 2) return;
    index = (index + d + list.length) % list.length;
    render();
  };

  document.querySelectorAll('[data-lightbox-trigger]').forEach((trigger) => {
    trigger.addEventListener('click', () => {
      closing = false;
      lastFocus = trigger;
      overlay.classList.remove('is-closing');
      const scope = trigger.closest('[data-lightbox-scope]') || document;
      list = visibleTriggers(scope);
      index = Math.max(0, list.indexOf(trigger));
      if (list.length === 0) { list = [trigger]; index = 0; }
      render();
      overlay.classList.remove('hidden');
      overlay.classList.add('flex');
      document.body.classList.add('overflow-hidden');
      if (closeBtn) closeBtn.focus({ preventScroll: true });
    });
  });

  const close = () => {
    if (closing || overlay.classList.contains('hidden')) return;
    closing = true;
    overlay.classList.add('is-closing');
    const finalize = () => {
      overlay.classList.add('hidden');
      overlay.classList.remove('flex', 'is-closing');
      document.body.classList.remove('overflow-hidden');
      closing = false;
      if (lastFocus) lastFocus.focus({ preventScroll: true });
    };
    if (REDUCED) finalize();
    else setTimeout(finalize, 230);
  };

  closeBtn?.addEventListener('click', close);
  prevBtn?.addEventListener('click', (e) => { e.stopPropagation(); go(-1); });
  nextBtn?.addEventListener('click', (e) => { e.stopPropagation(); go(1); });
  overlay.addEventListener('click', (e) => { if (e.target === overlay) close(); });
  document.addEventListener('keydown', (e) => {
    if (overlay.classList.contains('hidden')) return;
    if (e.key === 'Escape') close();
    else if (e.key === 'ArrowLeft') go(-1);
    else if (e.key === 'ArrowRight') go(1);
  });

  // Geser jari kiri/kanan untuk pindah foto
  let sx = null;
  overlay.addEventListener('touchstart', (e) => { sx = e.touches[0].clientX; }, { passive: true });
  overlay.addEventListener('touchend', (e) => {
    if (sx === null) return;
    const dx = e.changedTouches[0].clientX - sx;
    sx = null;
    if (Math.abs(dx) > 50) go(dx < 0 ? 1 : -1);
  }, { passive: true });
}

// ---------- Auto-hide flash alerts (keluar dengan animasi) ----------
function initAlertAutoHide() {
  document.querySelectorAll('[data-alert]').forEach((alert) => {
    const dismiss = () => {
      if (alert.classList.contains('is-out')) return;
      alert.classList.add('is-out');
      setTimeout(() => alert.remove(), 460);
    };
    const timer = setTimeout(dismiss, 5000);
    alert.style.cursor = 'pointer';
    alert.addEventListener('click', () => { clearTimeout(timer); dismiss(); });
  });
}

// ---------- Admin sidebar (mobile) ----------
function initAdminSidebar() {
  const toggle = document.querySelector('[data-admin-sidebar-toggle]');
  const sidebar = document.querySelector('[data-admin-sidebar]');
  const overlay = document.querySelector('[data-admin-sidebar-overlay]');
  if (!toggle || !sidebar) return;
  let hideTimer = null;

  const open = () => {
    clearTimeout(hideTimer);
    sidebar.classList.remove('-translate-x-full');
    if (overlay) {
      overlay.classList.remove('hidden');
      overlay.classList.add('is-fading');
      void overlay.offsetWidth;
      overlay.classList.remove('is-fading');
    }
    document.body.classList.add('overflow-hidden', 'lg:overflow-auto');
  };
  const close = () => {
    sidebar.classList.add('-translate-x-full');
    if (overlay) {
      overlay.classList.add('is-fading');
      hideTimer = setTimeout(() => overlay.classList.add('hidden'), 350);
    }
    document.body.classList.remove('overflow-hidden', 'lg:overflow-auto');
  };
  toggle.addEventListener('click', open);
  overlay?.addEventListener('click', close);
  sidebar.querySelectorAll('a').forEach((a) => a.addEventListener('click', close));
  document.addEventListener('keydown', (e) => { if (e.key === 'Escape') close(); });
}

// ---------- Admin popover (notifikasi & profil) ----------
function initAdminPopover() {
  const panels = [];
  document.querySelectorAll('[data-popover-toggle]').forEach((btn) => {
    const panel = document.querySelector(btn.dataset.popoverToggle);
    if (!panel) return;
    panels.push(panel);
    panel.classList.add('popover-anim');

    const closePanel = () => { panel.classList.add('hidden'); panel.classList.remove('is-open'); };
    btn.addEventListener('click', (e) => {
      e.stopPropagation();
      const willOpen = panel.classList.contains('hidden');
      panels.forEach((p) => { if (p !== panel) { p.classList.add('hidden'); p.classList.remove('is-open'); } });
      if (willOpen) {
        panel.classList.remove('hidden');
        panel.classList.remove('is-open');
        void panel.offsetWidth;
        panel.classList.add('is-open');
      } else {
        closePanel();
      }
    });
    document.addEventListener('click', (e) => {
      if (!panel.contains(e.target) && !btn.contains(e.target)) closePanel();
    });
    document.addEventListener('keydown', (e) => { if (e.key === 'Escape') closePanel(); });
  });
}

// ---------- Konfirmasi hapus: dialog kustom beranimasi (pengganti confirm() bawaan) ----------
function initConfirmDelete() {
  const ask = (message) => new Promise((resolve) => {
    const overlay = document.createElement('div');
    overlay.className = 'confirm-overlay';
    overlay.setAttribute('role', 'alertdialog');
    overlay.setAttribute('aria-modal', 'true');
    overlay.innerHTML = `
      <div class="confirm-panel">
        <div class="confirm-icon"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" width="26" height="26"><path d="M3 6h18"/><path d="M8 6V4h8v2"/><path d="M19 6l-1 14H6L5 6"/><path d="M10 11v6M14 11v6"/></svg></div>
        <h3 class="confirm-title">Konfirmasi Tindakan</h3>
        <p class="confirm-text"></p>
        <div class="confirm-actions">
          <button type="button" class="confirm-cancel">Batal</button>
          <button type="button" class="confirm-ok">Ya, Lanjutkan</button>
        </div>
      </div>`;
    overlay.querySelector('.confirm-text').textContent = message;
    document.body.appendChild(overlay);
    document.body.classList.add('overflow-hidden');
    const okBtn = overlay.querySelector('.confirm-ok');
    okBtn.focus({ preventScroll: true });

    const finish = (result) => {
      document.removeEventListener('keydown', onKey);
      overlay.classList.add('is-closing');
      setTimeout(() => {
        overlay.remove();
        document.body.classList.remove('overflow-hidden');
        resolve(result);
      }, REDUCED ? 0 : 230);
    };
    const onKey = (e) => {
      if (e.key === 'Escape') finish(false);
      if (e.key === 'Tab') { e.preventDefault(); (document.activeElement === okBtn ? overlay.querySelector('.confirm-cancel') : okBtn).focus(); }
    };
    document.addEventListener('keydown', onKey);
    okBtn.addEventListener('click', () => finish(true));
    overlay.querySelector('.confirm-cancel').addEventListener('click', () => finish(false));
    overlay.addEventListener('click', (e) => { if (e.target === overlay) finish(false); });
  });

  document.querySelectorAll('[data-confirm]').forEach((form) => {
    let confirmed = false;
    form.addEventListener('submit', async (e) => {
      if (confirmed) return;
      e.preventDefault();
      const ok = await ask(form.dataset.confirm || 'Anda yakin?');
      if (!ok) return;
      confirmed = true;
      window.__pageProgress?.start();
      const btn = form.querySelector('button[type="submit"]');
      if (btn) { btn.disabled = true; btn.style.opacity = '0.7'; }
      HTMLFormElement.prototype.submit.call(form);
    });
  });
}

// ---------- Tombol utama: efek riak saat ditekan + "magnet" halus ----------
function initMagneticButtons() {
  const buttons = document.querySelectorAll('.shine');
  buttons.forEach((btn) => {
    btn.addEventListener('pointerdown', (e) => {
      if (REDUCED) return;
      const rect = btn.getBoundingClientRect();
      const size = Math.max(rect.width, rect.height) * 2;
      const ripple = document.createElement('span');
      ripple.className = 'ripple';
      ripple.style.width = ripple.style.height = `${size}px`;
      ripple.style.left = `${e.clientX - rect.left - size / 2}px`;
      ripple.style.top = `${e.clientY - rect.top - size / 2}px`;
      btn.appendChild(ripple);
      ripple.addEventListener('animationend', () => ripple.remove());
    });
  });

  if (!FINE_POINTER || REDUCED) return;
  buttons.forEach((btn) => {
    let tx = 0, ty = 0, cx = 0, cy = 0, running = false;
    const loop = () => {
      cx += (tx - cx) * 0.18;
      cy += (ty - cy) * 0.18;
      btn.style.setProperty('--mag-x', `${cx.toFixed(2)}px`);
      btn.style.setProperty('--mag-y', `${cy.toFixed(2)}px`);
      if (Math.abs(tx - cx) > 0.05 || Math.abs(ty - cy) > 0.05) requestAnimationFrame(loop);
      else running = false;
    };
    const kick = () => { if (!running) { running = true; requestAnimationFrame(loop); } };
    btn.addEventListener('pointermove', (e) => {
      const rect = btn.getBoundingClientRect();
      tx = ((e.clientX - rect.left) / rect.width - 0.5) * 8;
      ty = ((e.clientY - rect.top) / rect.height - 0.5) * 8;
      kick();
    });
    btn.addEventListener('pointerleave', () => { tx = 0; ty = 0; kick(); });
  });
}

// ---------- Spinner submit: ukuran tombol dikunci supaya tidak "loncat" ----------
function initFormSubmitSpinner() {
  const restoreAll = () => {
    document.querySelectorAll('button[data-original-html]').forEach((btn) => {
      btn.innerHTML = btn.dataset.originalHtml;
      btn.disabled = false;
      btn.style.opacity = '';
      btn.style.width = '';
      btn.style.height = '';
      delete btn.dataset.originalHtml;
    });
  };
  window.addEventListener('pageshow', (e) => { if (e.persisted) restoreAll(); });

  document.querySelectorAll('form').forEach((form) => {
    form.addEventListener('submit', (e) => {
      if (form.dataset.confirm || e.defaultPrevented) return;
      const btn = form.querySelector('button[type="submit"]');
      if (!btn || btn.disabled) return;
      const rect = btn.getBoundingClientRect();
      btn.dataset.originalHtml = btn.innerHTML;
      btn.style.width = `${rect.width}px`;
      btn.style.height = `${rect.height}px`;
      btn.disabled = true;
      btn.style.opacity = '0.8';
      btn.innerHTML = '<span class="btn-spinner"></span>';
    });
  });
}

// ---------- Tombol scroll-to-top dengan cincin progres ----------
function initScrollTopButton() {
  const btn = document.createElement('button');
  btn.type = 'button';
  btn.className = 'scroll-top-btn';
  btn.setAttribute('aria-label', 'Kembali ke atas');
  btn.innerHTML = '<svg class="ring" viewBox="0 0 48 48"><circle class="track" cx="24" cy="24" r="21" pathLength="100"/><circle class="bar" cx="24" cy="24" r="21" pathLength="100"/></svg><svg class="arrow h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="m18 15-6-6-6 6"/></svg>';
  document.body.appendChild(btn);

  const onScroll = () => btn.classList.toggle('is-visible', window.scrollY > 520);
  onScroll();
  window.addEventListener('scroll', onScroll, { passive: true });
  btn.addEventListener('click', () => window.scrollTo({ top: 0, behavior: REDUCED ? 'auto' : 'smooth' }));
}

// ---------- Progres bacaan artikel (transform, bukan width) ----------
function initReadProgress() {
  const article = document.querySelector('[data-read-progress]');
  const bar = document.querySelector('[data-read-progress-bar]');
  if (!article || !bar) return;

  let frame = null;
  const update = () => {
    const rect = article.getBoundingClientRect();
    const total = rect.height - window.innerHeight;
    const scrolled = Math.min(Math.max(-rect.top, 0), Math.max(total, 1));
    const pct = total > 0 ? scrolled / total : 1;
    bar.style.transform = `scaleX(${clamp(pct, 0, 1).toFixed(4)})`;
  };
  const onScroll = () => {
    if (frame) cancelAnimationFrame(frame);
    frame = requestAnimationFrame(update);
  };
  update();
  window.addEventListener('scroll', onScroll, { passive: true });
  window.addEventListener('resize', onScroll);
}

// ---------- Spotlight kursor pada semua .card-hover (satu listener terdelegasi) ----------
function initCardSpotlight() {
  if (!FINE_POINTER || REDUCED) return;
  let frame = null;
  let last = null;
  document.addEventListener('pointermove', (e) => {
    const card = e.target instanceof Element ? e.target.closest('.card-hover') : null;
    if (!card) return;
    last = { card, x: e.clientX, y: e.clientY };
    if (frame) return;
    frame = requestAnimationFrame(() => {
      frame = null;
      if (!last) return;
      const rect = last.card.getBoundingClientRect();
      last.card.style.setProperty('--mx', `${last.x - rect.left}px`);
      last.card.style.setProperty('--my', `${last.y - rect.top}px`);
    });
  }, { passive: true });
}

// ---------- Parallax pointer: orb & lapisan dekoratif di hero ikut bergerak halus ----------
function initPointerParallax() {
  if (!FINE_POINTER || REDUCED) return;
  document.querySelectorAll('section.bg-navy-radial, [data-hero-slider]').forEach((section) => {
    const orbs = Array.from(section.querySelectorAll(':scope .bg-orb'));
    const media = Array.from(section.querySelectorAll('[data-depth]'));
    const layers = [...orbs.map((el, i) => ({ el, depth: 26 + i * 14 })), ...media.map((el) => ({ el, depth: Number(el.dataset.depth) || 12 }))];
    if (layers.length === 0) return;

    let tx = 0, ty = 0, cx = 0, cy = 0, running = false, visible = true;
    new IntersectionObserver(([entry]) => { visible = entry.isIntersecting; }, { threshold: 0 }).observe(section);

    const loop = () => {
      cx += (tx - cx) * 0.07;
      cy += (ty - cy) * 0.07;
      layers.forEach(({ el, depth }) => { el.style.translate = `${(cx * depth).toFixed(2)}px ${(cy * depth).toFixed(2)}px`; });
      if (visible && (Math.abs(tx - cx) > 0.002 || Math.abs(ty - cy) > 0.002)) requestAnimationFrame(loop);
      else running = false;
    };
    const kick = () => { if (!running) { running = true; requestAnimationFrame(loop); } };

    section.addEventListener('pointermove', (e) => {
      const rect = section.getBoundingClientRect();
      tx = (e.clientX - rect.left) / rect.width - 0.5;
      ty = (e.clientY - rect.top) / rect.height - 0.5;
      kick();
    }, { passive: true });
    section.addEventListener('pointerleave', () => { tx = 0; ty = 0; kick(); });
  });
}

// ---------- Parallax scroll: [data-parallax="0.15"] ----------
function initScrollParallax() {
  const els = Array.from(document.querySelectorAll('[data-parallax]'));
  if (els.length === 0 || REDUCED) return;
  let ticking = false;
  const update = () => {
    const vh = window.innerHeight;
    els.forEach((el) => {
      const rect = el.parentElement.getBoundingClientRect();
      if (rect.bottom < -100 || rect.top > vh + 100) return;
      const speed = parseFloat(el.dataset.parallax) || 0.15;
      const offset = (rect.top + rect.height / 2 - vh / 2) * speed;
      el.style.translate = `0 ${(-offset).toFixed(1)}px`;
    });
    ticking = false;
  };
  update();
  window.addEventListener('scroll', () => { if (!ticking) { ticking = true; raf(update); } }, { passive: true });
}

// ---------- Cahaya ambient mengikuti kursor (hanya mouse/trackpad) ----------
function initCursorGlow() {
  if (!FINE_POINTER || !CAN_HOVER || REDUCED) return;
  if (document.body.dataset.transition === 'normal') return; // panel admin: tanpa efek ambient
  const glow = document.createElement('div');
  glow.className = 'cursor-glow';
  glow.setAttribute('aria-hidden', 'true');
  document.body.appendChild(glow);

  let tx = -999, ty = -999, cx = -999, cy = -999, running = false;
  const loop = () => {
    cx += (tx - cx) * 0.12;
    cy += (ty - cy) * 0.12;
    glow.style.transform = `translate3d(${cx.toFixed(1)}px, ${cy.toFixed(1)}px, 0)`;
    if (Math.abs(tx - cx) > 0.4 || Math.abs(ty - cy) > 0.4) requestAnimationFrame(loop);
    else running = false;
  };
  window.addEventListener('pointermove', (e) => {
    if (cx === -999) { cx = e.clientX; cy = e.clientY; }
    tx = e.clientX; ty = e.clientY;
    glow.classList.add('is-on');
    if (!running) { running = true; requestAnimationFrame(loop); }
  }, { passive: true });
  document.addEventListener('pointerleave', () => glow.classList.remove('is-on'));
}

// ---------- Jaringan partikel di hero (canvas ringan, berhenti saat tak terlihat) ----------
function initParticles() {
  const canvases = document.querySelectorAll('canvas[data-particles]');
  if (canvases.length === 0 || REDUCED) return;

  canvases.forEach((canvas) => {
    const ctx = canvas.getContext('2d');
    if (!ctx) return;
    const host = canvas.parentElement;
    let w = 0, h = 0, dpr = 1, nodes = [], visible = true, running = false;
    const mouse = { x: -9999, y: -9999 };
    const LINK = 130;

    const resize = () => {
      dpr = Math.min(window.devicePixelRatio || 1, 2);
      w = host.clientWidth; h = host.clientHeight;
      canvas.width = w * dpr; canvas.height = h * dpr;
      ctx.setTransform(dpr, 0, 0, dpr, 0, 0);
      const count = clamp(Math.round((w * h) / 20000), 14, 54);
      nodes = Array.from({ length: count }, () => ({
        x: Math.random() * w, y: Math.random() * h,
        vx: (Math.random() - 0.5) * 0.28, vy: (Math.random() - 0.5) * 0.28,
        r: Math.random() * 1.6 + 0.8, gold: Math.random() < 0.3,
      }));
    };

    const draw = () => {
      ctx.clearRect(0, 0, w, h);
      for (let i = 0; i < nodes.length; i += 1) {
        const a = nodes[i];
        a.x += a.vx; a.y += a.vy;
        if (a.x < -10) a.x = w + 10; else if (a.x > w + 10) a.x = -10;
        if (a.y < -10) a.y = h + 10; else if (a.y > h + 10) a.y = -10;
        const mdx = a.x - mouse.x, mdy = a.y - mouse.y;
        const md = Math.hypot(mdx, mdy);
        if (md < 120 && md > 0) { a.x += (mdx / md) * 0.6; a.y += (mdy / md) * 0.6; }

        for (let j = i + 1; j < nodes.length; j += 1) {
          const b = nodes[j];
          const d = Math.hypot(a.x - b.x, a.y - b.y);
          if (d < LINK) {
            ctx.strokeStyle = `rgba(255,255,255,${(1 - d / LINK) * 0.16})`;
            ctx.lineWidth = 1;
            ctx.beginPath(); ctx.moveTo(a.x, a.y); ctx.lineTo(b.x, b.y); ctx.stroke();
          }
        }
        ctx.fillStyle = a.gold ? 'rgba(250,204,21,0.85)' : 'rgba(255,255,255,0.6)';
        ctx.beginPath(); ctx.arc(a.x, a.y, a.r, 0, Math.PI * 2); ctx.fill();
      }
    };

    const loop = () => {
      if (!visible || document.hidden) { running = false; return; }
      draw();
      requestAnimationFrame(loop);
    };
    const start = () => { if (!running) { running = true; requestAnimationFrame(loop); } };

    resize();
    let resizeTimer;
    window.addEventListener('resize', () => { clearTimeout(resizeTimer); resizeTimer = setTimeout(resize, 150); });
    new IntersectionObserver(([entry]) => { visible = entry.isIntersecting; if (visible) start(); }, { threshold: 0 }).observe(host);
    document.addEventListener('visibilitychange', () => { if (!document.hidden) start(); });
    host.addEventListener('pointermove', (e) => {
      const rect = host.getBoundingClientRect();
      mouse.x = e.clientX - rect.left; mouse.y = e.clientY - rect.top;
    }, { passive: true });
    host.addEventListener('pointerleave', () => { mouse.x = -9999; mouse.y = -9999; });
    start();
  });
}

// ===================================================================
// Bagian di bawah dipertahankan dari versi sebelumnya (fungsi & perilaku
// tetap sama), dengan penyesuaian kecil agar animasinya lebih mulus.
// ===================================================================

// ---------- Marquee "Perusahaan Mitra & Partner Kami" (bisa digeser) ----------
// Mengambil-alih pergeseran trek dari animasi CSS murni menjadi loop
// requestAnimationFrame supaya bisa digeser manual pakai mouse/jari
// (drag/swipe kiri-kanan), tetap berhenti sejenak saat di-hover, dan
// otomatis lanjut looping/marquee lagi begitu tidak lagi disentuh/hover.
function initPartnerMarquee() {
  const wrappers = document.querySelectorAll('.partner-marquee');
  if (wrappers.length === 0) return;

  const reduceMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
  if (reduceMotion || !('requestAnimationFrame' in window)) {
    // Biarkan fallback CSS statis (lihat @media prefers-reduced-motion di
    // home.blade.php) yang bekerja; JS tidak perlu mengambil alih apa pun.
    return;
  }

  wrappers.forEach((wrapper) => {
    const track = wrapper.querySelector('.partner-marquee__track');
    if (!track) return;

    // Durasi asal diambil dari CSS var yang sudah dihitung dari jumlah
    // mitra (lihat $partnerMarqueeDuration di home.blade.php), supaya
    // kecepatan geser otomatis versi JS ini tetap konsisten dengan versi
    // CSS fallback-nya.
    const bleed = wrapper.closest('.partner-marquee-bleed');
    const durationRaw = bleed
      ? getComputedStyle(bleed).getPropertyValue('--partner-marquee-duration')
      : '';
    const durationSeconds = parseFloat(durationRaw) || 24;

    // Matikan animasi CSS: mulai dari sini pergeseran trek sepenuhnya
    // dikendalikan lewat transform inline (translateX) di bawah.
    track.style.animation = 'none';

    let halfWidth = track.scrollWidth / 2; // lebar satu set logo (sebelum digandakan 2x)
    let speed = halfWidth / durationSeconds; // px per detik
    let offset = 0; // seberapa jauh trek sudah bergeser ke kiri
    let paused = false;
    let dragging = false;
    let pointerId = null;
    let dragStartX = 0;
    let dragStartOffset = 0;
    let lastTime = null;

    const recalc = () => {
      halfWidth = track.scrollWidth / 2;
      speed = halfWidth / durationSeconds;
    };
    window.addEventListener('resize', recalc);

    const applyOffset = () => {
      // Normalisasi ke rentang [0, halfWidth) -> begitu mencapai ujung
      // salinan pertama, otomatis "meloncat" balik ke awal salinan kedua
      // yang identik, sehingga loop terlihat menerus tanpa putus.
      if (halfWidth > 0) {
        offset = ((offset % halfWidth) + halfWidth) % halfWidth;
      }
      track.style.transform = `translateX(${-offset}px)`;
    };

    const step = (time) => {
      if (lastTime === null) lastTime = time;
      // Dibatasi agar tidak "melompat" setelah tab tersembunyi lalu dibuka lagi.
      const dt = Math.min((time - lastTime) / 1000, 0.05);
      lastTime = time;
      if (!paused && !dragging) {
        offset += speed * dt;
        applyOffset();
      }
      requestAnimationFrame(step);
    };
    requestAnimationFrame(step);

    // Jeda otomatis saat hover/fokus (mouse/keyboard), lanjut lagi saat
    // tidak lagi di-hover dan tidak sedang digeser manual.
    wrapper.addEventListener('mouseenter', () => { paused = true; });
    wrapper.addEventListener('mouseleave', () => { if (!dragging) paused = false; });
    wrapper.addEventListener('focusin', () => { paused = true; });
    wrapper.addEventListener('focusout', () => { if (!dragging) paused = false; });

    // ----- geser manual kiri/kanan lewat mouse & sentuhan (Pointer Events) -----
    const onPointerDown = (e) => {
      dragging = true;
      paused = true;
      wrapper.classList.add('is-dragging');
      pointerId = e.pointerId;
      if (wrapper.setPointerCapture) {
        try { wrapper.setPointerCapture(pointerId); } catch (err) { /* noop */ }
      }
      dragStartX = e.clientX;
      dragStartOffset = offset;
    };

    const onPointerMove = (e) => {
      if (!dragging) return;
      const delta = e.clientX - dragStartX;
      // Geser ke kanan (delta > 0) -> trek ikut bergerak ke kanan (offset berkurang).
      offset = dragStartOffset - delta;
      applyOffset();
    };

    const endDrag = (e) => {
      if (!dragging) return;
      dragging = false;
      wrapper.classList.remove('is-dragging');
      if (pointerId !== null && wrapper.releasePointerCapture) {
        try { wrapper.releasePointerCapture(pointerId); } catch (err) { /* noop */ }
      }
      pointerId = null;
      // Lanjut looping/marquee otomatis lagi, kecuali kursor mouse masih
      // berada tepat di atas komponen (berarti masih dianggap hover).
      if (!wrapper.matches(':hover')) {
        paused = false;
      }
    };

    wrapper.addEventListener('pointerdown', onPointerDown);
    wrapper.addEventListener('pointermove', onPointerMove);
    wrapper.addEventListener('pointerup', endDrag);
    wrapper.addEventListener('pointercancel', endDrag);
    wrapper.addEventListener('pointerleave', (e) => { if (dragging) endDrag(e); });
  });
}

// ---------- Tilt 3D + spotlight kursor untuk kartu Guru & Staff ----------
// Menggantikan efek "cincin berputar" versi sebelumnya yang dirasa
// mengganggu. Efek ini hanya bergerak selama kursor/jari benar-benar
// berada di atas kartu — diam total saat tidak disentuh, dan otomatis
// nonaktif untuk layar sentuh maupun preferensi "reduce motion".
function initStaffCardTilt() {
  const cards = document.querySelectorAll('.staff-card');
  if (cards.length === 0) return;
  if (window.matchMedia('(prefers-reduced-motion: reduce)').matches) return;
  if (!window.matchMedia('(pointer: fine)').matches) return;

  const MAX_TILT = 7; // derajat kemiringan maksimum, dibuat halus & tidak berlebihan

  cards.forEach((card) => {
    let frame = null;

    const onMove = (e) => {
      const rect = card.getBoundingClientRect();
      const px = (e.clientX - rect.left) / rect.width;
      const py = (e.clientY - rect.top) / rect.height;

      if (frame) cancelAnimationFrame(frame);
      frame = requestAnimationFrame(() => {
        const rotateY = (px - 0.5) * MAX_TILT * 2;
        const rotateX = (0.5 - py) * MAX_TILT * 2;
        card.style.setProperty('--tilt-x', `${rotateX.toFixed(2)}deg`);
        card.style.setProperty('--tilt-y', `${rotateY.toFixed(2)}deg`);
        card.style.setProperty('--spot-x', `${(px * 100).toFixed(1)}%`);
        card.style.setProperty('--spot-y', `${(py * 100).toFixed(1)}%`);
      });
    };

    const onLeave = () => {
      if (frame) cancelAnimationFrame(frame);
      card.style.setProperty('--tilt-x', '0deg');
      card.style.setProperty('--tilt-y', '0deg');
    };

    card.addEventListener('pointermove', onMove);
    card.addEventListener('pointerleave', onLeave);
  });
}

// ---------- PPDB form: pilihan2 tidak boleh sama dengan pilihan1 ----------
function initPpdbForm() {
  const p1 = document.querySelector('[name="pilihan1"]');
  const p2 = document.querySelector('[name="pilihan2"]');
  if (!p1 || !p2) return;

  const sync = () => {
    Array.from(p2.options).forEach((opt) => {
      opt.disabled = opt.value !== '' && opt.value === p1.value;
      if (opt.disabled && opt.selected) p2.value = '';
    });
  };
  p1.addEventListener('change', sync);
  sync();
}

// ---------- Show/hide password ----------
function initPasswordToggles() {
  document.querySelectorAll('[data-toggle-password]').forEach((btn) => {
    btn.addEventListener('click', () => {
      const input = document.querySelector(btn.dataset.togglePassword);
      if (!input) return;
      input.type = input.type === 'password' ? 'text' : 'password';
      btn.querySelector('[data-icon-eye]')?.classList.toggle('hidden');
      btn.querySelector('[data-icon-eye-off]')?.classList.toggle('hidden');
    });
  });
}

// ---------- Admin dashboard charts (Chart.js) ----------
function initDashboardCharts() {
  const kategoriEl = document.getElementById('chartKategori');
  const statusEl = document.getElementById('chartStatus');
  const aktivitasEl = document.getElementById('chartAktivitas');
  if ((!kategoriEl && !statusEl && !aktivitasEl) || typeof Chart === 'undefined') return;

  // Warna diambil dari CSS variables tema agar tetap konsisten dgn light/dark mode.
  const cssVar = (name, fallback) => {
    const value = getComputedStyle(document.documentElement).getPropertyValue(name).trim();
    return value || fallback;
  };
  const navy = cssVar('--primary', 'oklch(0.32 0.105 258)');
  const navySoft = cssVar('--primary-soft', 'oklch(0.45 0.115 258)');
  const gold = cssVar('--gold', 'oklch(0.83 0.16 85)');
  const border = cssVar('--border', 'oklch(0.915 0.012 252)');
  const muted = cssVar('--muted-foreground', 'oklch(0.52 0.03 258)');
  const cardBg = cssVar('--card', 'oklch(1 0 0)');

  Chart.defaults.font.family = "'Plus Jakarta Sans', ui-sans-serif, system-ui, sans-serif";
  Chart.defaults.color = muted;

  const sharedTooltip = {
    backgroundColor: navy,
    titleColor: cardBg,
    bodyColor: cardBg,
    padding: 10,
    cornerRadius: 10,
    displayColors: false,
    titleFont: { weight: '700', size: 12 },
    bodyFont: { size: 12 },
  };

  // ---------- Bar chart: Berita per Kategori ----------
  if (kategoriEl) {
    const labels = JSON.parse(kategoriEl.dataset.labels || '[]');
    const values = JSON.parse(kategoriEl.dataset.values || '[]');
    const ctx = kategoriEl.getContext('2d');
    const gradient = ctx.createLinearGradient(0, 0, 0, 220);
    gradient.addColorStop(0, navySoft);
    gradient.addColorStop(1, navy);

    new Chart(kategoriEl, {
      type: 'bar',
      data: {
        labels,
        datasets: [{
          label: 'Jumlah Berita',
          data: values,
          backgroundColor: gradient,
          hoverBackgroundColor: gold,
          borderRadius: { topLeft: 10, topRight: 10 },
          borderSkipped: false,
          maxBarThickness: 38,
        }],
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        animation: { duration: 900, easing: 'easeOutQuart' },
        plugins: {
          legend: { display: false },
          tooltip: { ...sharedTooltip, callbacks: { label: (item) => ` ${item.formattedValue} berita` } },
        },
        scales: {
          y: { beginAtZero: true, ticks: { precision: 0, font: { size: 11 } }, grid: { color: border } },
          x: { ticks: { font: { size: 11, weight: '600' } }, grid: { display: false } },
        },
      },
    });
  }

  // ---------- Doughnut chart: Status Pesan Masuk ----------
  if (statusEl) {
    const labels = JSON.parse(statusEl.dataset.labels || '[]');
    const values = JSON.parse(statusEl.dataset.values || '[]');
    new Chart(statusEl, {
      type: 'doughnut',
      data: {
        labels,
        datasets: [{
          data: values,
          backgroundColor: [gold, navy],
          hoverBackgroundColor: [gold, navySoft],
          borderColor: cardBg,
          borderWidth: 3,
          hoverOffset: 6,
        }],
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        animation: { duration: 900, easing: 'easeOutQuart' },
        plugins: {
          legend: {
            position: 'bottom',
            labels: { boxWidth: 10, boxHeight: 10, padding: 16, font: { size: 12, weight: '600' }, usePointStyle: true, pointStyle: 'circle' },
          },
          tooltip: sharedTooltip,
        },
        cutout: '72%',
      },
    });
  }

  // ---------- Line/area chart: Aktivitas 7 hari terakhir ----------
  if (aktivitasEl) {
    const labels = JSON.parse(aktivitasEl.dataset.labels || '[]');
    const dataPpdb = JSON.parse(aktivitasEl.dataset.ppdb || '[]');
    const dataKontak = JSON.parse(aktivitasEl.dataset.kontak || '[]');
    const ctx = aktivitasEl.getContext('2d');

    const navyFill = ctx.createLinearGradient(0, 0, 0, 240);
    navyFill.addColorStop(0, 'oklch(0.45 0.115 258 / 0.35)');
    navyFill.addColorStop(1, 'oklch(0.45 0.115 258 / 0)');

    const goldFill = ctx.createLinearGradient(0, 0, 0, 240);
    goldFill.addColorStop(0, 'oklch(0.83 0.16 85 / 0.4)');
    goldFill.addColorStop(1, 'oklch(0.83 0.16 85 / 0)');

    new Chart(aktivitasEl, {
      type: 'line',
      data: {
        labels,
        datasets: [
          {
            label: 'Pendaftar PPDB',
            data: dataPpdb,
            borderColor: navy,
            backgroundColor: navyFill,
            pointBackgroundColor: cardBg,
            pointBorderColor: navy,
            pointBorderWidth: 2,
            pointRadius: 4,
            pointHoverRadius: 6,
            fill: true,
            tension: 0.4,
          },
          {
            label: 'Pesan Masuk',
            data: dataKontak,
            borderColor: gold,
            backgroundColor: goldFill,
            pointBackgroundColor: cardBg,
            pointBorderColor: gold,
            pointBorderWidth: 2,
            pointRadius: 4,
            pointHoverRadius: 6,
            fill: true,
            tension: 0.4,
          },
        ],
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        animation: { duration: 1100, easing: 'easeOutQuart' },
        interaction: { mode: 'index', intersect: false },
        plugins: {
          legend: { display: false },
          tooltip: {
            ...sharedTooltip,
            displayColors: true,
            callbacks: {
              title: (items) => `Hari ${items[0].label}`,
            },
          },
        },
        scales: {
          y: { beginAtZero: true, ticks: { precision: 0, font: { size: 11 } }, grid: { color: border } },
          x: { ticks: { font: { size: 11, weight: '600' } }, grid: { display: false } },
        },
      },
    });
  }
}

// ---------- Admin detail modals (PPDB, Pesan Masuk, dll) ----------
function initAdminModal() {
  const openModal = (modal) => {
    modal.classList.remove('hidden');
    modal.classList.add('flex');
    document.body.classList.add('overflow-hidden');
  };
  const closeModal = (modal) => {
    modal.classList.add('is-closing');
    const finalize = () => {
      modal.classList.add('hidden');
      modal.classList.remove('flex', 'is-closing');
      document.body.classList.remove('overflow-hidden');
    };
    // Let the pop-out/fade-out keyframes finish before actually hiding it.
    if (REDUCED) {
      finalize();
    } else {
      setTimeout(finalize, 200);
    }
  };

  document.querySelectorAll('[data-modal-open]').forEach((btn) => {
    const modal = document.querySelector(btn.dataset.modalOpen);
    if (!modal) return;

    btn.addEventListener('click', () => {
      Object.keys(btn.dataset).forEach((key) => {
        if (key === 'modalOpen') return;
        const value = btn.dataset[key];
        const display = value && value.trim() !== '' ? value : '-';

        modal.querySelectorAll(`[data-field="${key}"]`).forEach((field) => {
          field.textContent = display;
        });

        // Elemen seperti <a data-href-field="email" data-href-prefix="mailto:">
        // otomatis diisi hrefnya, misal untuk tombol "kirim email" / "telepon".
        modal.querySelectorAll(`[data-href-field="${key}"]`).forEach((field) => {
          const prefix = field.dataset.hrefPrefix || '';
          if (value && value.trim() !== '' && value !== '-') {
            field.setAttribute('href', prefix + value);
            field.classList.remove('pointer-events-none', 'opacity-40');
          } else {
            field.setAttribute('href', '#');
            field.classList.add('pointer-events-none', 'opacity-40');
          }
        });
      });
      openModal(modal);
    });
  });

  document.querySelectorAll('[data-modal]').forEach((modal) => {
    modal.addEventListener('click', (e) => {
      if (e.target === modal) closeModal(modal);
    });
    modal.querySelectorAll('[data-modal-close]').forEach((btn) => {
      btn.addEventListener('click', () => closeModal(modal));
    });
  });

  document.addEventListener('keydown', (e) => {
    if (e.key !== 'Escape') return;
    document.querySelectorAll('[data-modal]:not(.hidden)').forEach(closeModal);
  });
}

// ---------- Auto stagger-in for every data table's rows (admin panel) ----------
// Works on any table across the whole app without needing per-page markup changes.
function initTableRowReveal() {
  document.querySelectorAll('table tbody').forEach((tbody) => {
    const rows = Array.from(tbody.children).filter((r) => r.tagName === 'TR');
    rows.forEach((row, i) => {
      row.classList.add('row-reveal');
      row.style.animationDelay = `${Math.min(i, 14) * 45}ms`;
    });
  });
}

// ---------- Animated active-state indicator for the admin sidebar ----------
function initSidebarActiveIndicator() {
  document.querySelectorAll('[data-admin-sidebar] nav a').forEach((link) => {
    link.classList.add('sidebar-link');
  });
}

// ---------- Indikator kekuatan password (halaman Ganti Password) ----------
function initPasswordStrength() {
  const input = document.querySelector('[data-password-strength-input]');
  const wrap = document.querySelector('[data-password-strength]');
  if (!input || !wrap) return;

  const bars = Array.from(wrap.querySelectorAll('[data-strength-bar]'));
  const label = wrap.querySelector('[data-strength-label]');

  const levels = [
    { text: 'Sangat lemah', color: 'bg-destructive' },
    { text: 'Lemah', color: 'bg-destructive' },
    { text: 'Cukup', color: 'bg-gold' },
    { text: 'Kuat', color: 'bg-emerald-500' },
    { text: 'Sangat kuat', color: 'bg-emerald-500' },
  ];

  const scorePassword = (value) => {
    let score = 0;
    if (value.length >= 6) score += 1;
    if (value.length >= 10) score += 1;
    if (/[A-Z]/.test(value) && /[a-z]/.test(value)) score += 1;
    if (/\d/.test(value)) score += 1;
    if (/[^A-Za-z0-9]/.test(value)) score += 1;
    return Math.min(score, 4);
  };

  input.addEventListener('input', () => {
    const value = input.value;

    if (value.length === 0) {
      wrap.classList.add('hidden');
      return;
    }
    wrap.classList.remove('hidden');

    const score = scorePassword(value);
    const level = levels[score];

    bars.forEach((bar, i) => {
      bar.classList.remove('bg-destructive', 'bg-gold', 'bg-emerald-500', 'bg-border');
      bar.classList.add(i <= score ? level.color : 'bg-border');
    });

    label.textContent = level.text;
    label.className = 'mt-1.5 text-xs font-medium ' + (
      score <= 1 ? 'text-destructive' : score === 2 ? 'text-gold-foreground' : 'text-emerald-600'
    );
  });

  // Validasi kecocokan konfirmasi password secara langsung
  const confirmInput = document.querySelector('[data-password-confirm-input]');
  const matchLabel = document.querySelector('[data-password-match]');
  if (!confirmInput || !matchLabel) return;

  const checkMatch = () => {
    if (confirmInput.value.length === 0) {
      matchLabel.classList.add('hidden');
      return;
    }
    const isMatch = confirmInput.value === input.value;
    matchLabel.classList.remove('hidden');
    matchLabel.classList.toggle('flex', true);
    matchLabel.classList.toggle('text-emerald-600', isMatch);
    matchLabel.classList.toggle('text-destructive', !isMatch);
    matchLabel.innerHTML = isMatch
      ? '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-3.5 h-3.5"><path d="M22 11.1V12a10 10 0 1 1-5.9-9.1"/><path d="m9 11 3 3L22 4"/></svg> Password cocok'
      : '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-3.5 h-3.5"><path d="M18 6 6 18M6 6l12 12"/></svg> Password tidak sama';
  };

  input.addEventListener('input', checkMatch);
  confirmInput.addEventListener('input', checkMatch);
}

// ---------- Admin: potong foto sebelum diunggah (mis. form Guru & Staff) ----------
// Alur: file dipilih lewat <input type="file" data-foto-input> di dalam sebuah
// wrapper [data-foto-uploader] -> modal #modal-crop-foto otomatis terbuka ->
// user menggeser/memperbesar -> hasil potongan (canvas -> Blob) ditulis balik
// ke input file yang sama lewat DataTransfer, sehingga proses submit form dan
// validasi di backend tidak perlu diubah sama sekali.
function initFotoCropper() {
  const modal = document.getElementById('modal-crop-foto');
  const uploaders = document.querySelectorAll('[data-foto-uploader]');
  if (!modal || uploaders.length === 0) return;

  const frame = modal.querySelector('[data-crop-frame]');
  const cropImg = modal.querySelector('[data-crop-image]');
  const zoomInput = modal.querySelector('[data-crop-zoom]');
  const confirmBtn = modal.querySelector('[data-foto-crop-confirm]');
  if (!frame || !cropImg || !zoomInput || !confirmBtn) return;

  const OUTPUT_SIZE = 640; // resolusi hasil potongan (persegi), dalam piksel
  const MAX_ZOOM_RATIO = 3; // seberapa jauh boleh memperbesar dari ukuran "cover"

  let activeUploader = null;
  // Tipe MIME file asli yang sedang dipotong. Dipakai supaya hasil potongan
  // memakai format yang tepat (lihat catatan di confirmBtn di bawah).
  let sourceMimeType = '';
  let naturalW = 0;
  let naturalH = 0;
  let baseScale = 1;
  let zoomFactor = 1;
  let offsetX = 0;
  let offsetY = 0;
  let frameSize = 288;
  let dragging = false;
  let dragStartX = 0;
  let dragStartY = 0;
  let dragStartOffsetX = 0;
  let dragStartOffsetY = 0;

  const openModal = () => {
    modal.classList.remove('hidden');
    modal.classList.add('flex');
    document.body.classList.add('overflow-hidden');
  };

  // Modal ditutup lewat mekanisme [data-modal-close] / klik overlay / tombol Esc
  // yang sudah ditangani oleh initAdminModal(); fungsi ini hanya dipakai saat
  // menutup modal dari tombol "Gunakan Foto" (bukan tombol [data-modal-close]).
  const closeModal = () => {
    modal.classList.add('is-closing');
    const finalize = () => {
      modal.classList.add('hidden');
      modal.classList.remove('flex', 'is-closing');
      document.body.classList.remove('overflow-hidden');
    };
    if (REDUCED) {
      finalize();
    } else {
      setTimeout(finalize, 200);
    }
  };

  const clampOffsets = () => {
    const scale = baseScale * zoomFactor;
    const dispW = naturalW * scale;
    const dispH = naturalH * scale;
    const maxOffsetX = Math.max(0, (dispW - frameSize) / 2);
    const maxOffsetY = Math.max(0, (dispH - frameSize) / 2);
    offsetX = Math.min(maxOffsetX, Math.max(-maxOffsetX, offsetX));
    offsetY = Math.min(maxOffsetY, Math.max(-maxOffsetY, offsetY));
  };

  const render = () => {
    clampOffsets();
    const scale = baseScale * zoomFactor;
    cropImg.style.width = `${naturalW * scale}px`;
    cropImg.style.height = `${naturalH * scale}px`;
    cropImg.style.transform = `translate(-50%, -50%) translate(${offsetX}px, ${offsetY}px)`;
  };

  const resetForImage = () => {
    frameSize = frame.getBoundingClientRect().width || frameSize;
    baseScale = Math.max(frameSize / naturalW, frameSize / naturalH);
    zoomFactor = 1;
    offsetX = 0;
    offsetY = 0;
    zoomInput.value = 0;
    render();
  };

  // ----- geser foto (mouse & sentuhan, lewat Pointer Events) -----
  const pointerDown = (e) => {
    dragging = true;
    frame.setPointerCapture(e.pointerId);
    dragStartX = e.clientX;
    dragStartY = e.clientY;
    dragStartOffsetX = offsetX;
    dragStartOffsetY = offsetY;
  };
  const pointerMove = (e) => {
    if (!dragging) return;
    offsetX = dragStartOffsetX + (e.clientX - dragStartX);
    offsetY = dragStartOffsetY + (e.clientY - dragStartY);
    render();
  };
  const pointerUp = (e) => {
    dragging = false;
    if (frame.hasPointerCapture && frame.hasPointerCapture(e.pointerId)) {
      frame.releasePointerCapture(e.pointerId);
    }
  };
  frame.addEventListener('pointerdown', pointerDown);
  frame.addEventListener('pointermove', pointerMove);
  frame.addEventListener('pointerup', pointerUp);
  frame.addEventListener('pointercancel', pointerUp);
  frame.addEventListener('pointerleave', (e) => { if (dragging) pointerUp(e); });

  // ----- slider zoom -----
  zoomInput.addEventListener('input', () => {
    const t = Number(zoomInput.value) / 100; // 0..1
    zoomFactor = 1 + t * (MAX_ZOOM_RATIO - 1);
    render();
  });

  // ----- scroll/roda mouse untuk memperbesar dengan cepat (progressive enhancement) -----
  frame.addEventListener('wheel', (e) => {
    e.preventDefault();
    const t = Number(zoomInput.value) / 100;
    const next = Math.min(100, Math.max(0, t * 100 - e.deltaY * 0.1));
    zoomInput.value = next;
    zoomInput.dispatchEvent(new Event('input'));
  }, { passive: false });

  const openCropperFor = (uploader, file) => {
    activeUploader = uploader;
    sourceMimeType = file.type || '';
    const reader = new FileReader();
    reader.onload = () => {
      cropImg.src = reader.result;
      cropImg.onload = () => {
        naturalW = cropImg.naturalWidth;
        naturalH = cropImg.naturalHeight;
        openModal();
        requestAnimationFrame(resetForImage);
      };
    };
    reader.readAsDataURL(file);
  };

  // Membatalkan proses potong: kembalikan input file ke kosong supaya berkas
  // asli (belum dipotong) tidak ikut tersubmit begitu saja.
  const cancelCrop = () => {
    if (activeUploader) {
      activeUploader.input.value = '';
    }
    activeUploader = null;
  };

  modal.querySelectorAll('[data-modal-close]').forEach((btn) => {
    btn.addEventListener('click', cancelCrop);
  });
  modal.addEventListener('click', (e) => {
    if (e.target === modal) cancelCrop();
  });
  document.addEventListener('keydown', (e) => {
    if (e.key === 'Escape' && !modal.classList.contains('hidden')) cancelCrop();
  });

  confirmBtn.addEventListener('click', () => {
    if (!activeUploader) { closeModal(); return; }

    const scale = baseScale * zoomFactor;
    const cropSize = frameSize / scale;
    const sx = naturalW / 2 - (frameSize / 2 + offsetX) / scale;
    const sy = naturalH / 2 - (frameSize / 2 + offsetY) / scale;

    const canvas = document.createElement('canvas');
    canvas.width = OUTPUT_SIZE;
    canvas.height = OUTPUT_SIZE;
    const ctx = canvas.getContext('2d');
    ctx.imageSmoothingQuality = 'high';
    // Canvas kosong bersifat transparan secara default (rgba(0,0,0,0)) — sengaja
    // TIDAK diisi warna latar apa pun di sini, supaya foto PNG transparan tetap
    // transparan setelah dipotong.
    ctx.drawImage(cropImg, sx, sy, cropSize, cropSize, 0, 0, OUTPUT_SIZE, OUTPUT_SIZE);

    // PENTING (perbaikan bug "foto jadi ada background hitam"):
    // JPEG tidak punya kanal transparansi. Sebelumnya hasil potongan SELALU
    // diekspor sebagai JPEG, jadi area transparan pada foto PNG (nilai piksel
    // rgba(0,0,0,0) — hitam dengan alpha 0) ikut diekspor tapi kanal alpha-nya
    // dibuang, sehingga yang tersisa cuma nilai RGB-nya: hitam pekat.
    // Perbaikannya: kalau file aslinya bertipe yang mendukung transparansi
    // (PNG/WEBP/GIF), ekspor hasil potongan sebagai PNG (lossless, kanal alpha
    // tetap ada) supaya transparansinya ikut terbawa. Foto biasa (JPG dari HP/
    // kamera, tanpa transparansi) tetap diekspor sebagai JPEG seperti semula
    // agar ukuran filenya tetap kecil.
    const supportsAlpha = /^image\/(png|webp|gif)$/i.test(sourceMimeType);
    const outputType = supportsAlpha ? 'image/png' : 'image/jpeg';
    const outputExt = supportsAlpha ? 'png' : 'jpg';
    const outputQuality = supportsAlpha ? undefined : 0.92; // diabaikan otomatis oleh PNG

    canvas.toBlob((blob) => {
      if (!blob) { closeModal(); return; }

      const uploader = activeUploader;
      const baseName = (uploader.input.dataset.originalName || 'foto').replace(/\.[^./\\]+$/, '');
      const croppedFile = new File([blob], `${baseName}-crop.${outputExt}`, { type: outputType });

      const dt = new DataTransfer();
      dt.items.add(croppedFile);
      uploader.input.files = dt.files;

      uploader.preview.src = canvas.toDataURL(outputType, outputQuality);
      uploader.preview.classList.remove('hidden');
      if (uploader.placeholder) uploader.placeholder.classList.add('hidden');
      if (uploader.clearBtn) uploader.clearBtn.classList.remove('hidden');
      if (uploader.triggerLabel) uploader.triggerLabel.textContent = 'Ganti Foto';

      activeUploader = null;
      closeModal();
    }, outputType, outputQuality);
  });

  uploaders.forEach((wrapper) => {
    const input = wrapper.querySelector('[data-foto-input]');
    const preview = wrapper.querySelector('[data-foto-preview]');
    const placeholder = wrapper.querySelector('[data-foto-placeholder]');
    const clearBtn = wrapper.querySelector('[data-foto-clear]');
    const triggerBtn = wrapper.querySelector('[data-foto-trigger]');
    const triggerLabel = wrapper.querySelector('[data-foto-trigger-label]');
    if (!input || !preview) return;

    // Simpan kondisi awal (foto lama, jika sedang mengedit) supaya bisa
    // dikembalikan saat pengguna klik "Batalkan foto baru".
    const originalPreviewSrc = preview.getAttribute('src') || '';
    const hadOriginalPhoto = !preview.classList.contains('hidden');
    const originalTriggerLabel = triggerLabel ? triggerLabel.textContent : '';

    const uploader = { input, preview, placeholder, clearBtn, triggerLabel };

    if (triggerBtn) triggerBtn.addEventListener('click', () => input.click());

    input.addEventListener('change', () => {
      const file = input.files && input.files[0];
      if (!file) return;
      if (!file.type.startsWith('image/')) {
        window.alert('Berkas yang dipilih harus berupa gambar.');
        input.value = '';
        return;
      }
      input.dataset.originalName = file.name;
      openCropperFor(uploader, file);
    });

    if (clearBtn) {
      clearBtn.addEventListener('click', () => {
        input.value = '';
        if (hadOriginalPhoto) {
          preview.src = originalPreviewSrc;
          preview.classList.remove('hidden');
          if (placeholder) placeholder.classList.add('hidden');
        } else {
          preview.classList.add('hidden');
          preview.removeAttribute('src');
          if (placeholder) placeholder.classList.remove('hidden');
        }
        clearBtn.classList.add('hidden');
        if (triggerLabel) triggerLabel.textContent = originalTriggerLabel;
      });
    }
  });
}

// ---------- Kartu "tilt + spotlight" generik ----------
// Versi ringan dari efek staff-card, dipakai pada kartu konten biasa lewat
// class ".tilt-glow" (mis. kartu kontak, kartu berita). Nonaktif otomatis di
// perangkat sentuh & saat prefers-reduced-motion aktif.
function initTiltGlow() {
  const cards = document.querySelectorAll('.tilt-glow');
  if (cards.length === 0) return;
  if (window.matchMedia('(prefers-reduced-motion: reduce)').matches) return;
  if (!window.matchMedia('(pointer: fine)').matches) return;

  const MAX_TILT = 4; // lebih halus dari staff-card, supaya tidak berlebihan

  cards.forEach((card) => {
    let frame = null;

    const onMove = (e) => {
      const rect = card.getBoundingClientRect();
      const px = (e.clientX - rect.left) / rect.width;
      const py = (e.clientY - rect.top) / rect.height;

      if (frame) cancelAnimationFrame(frame);
      frame = requestAnimationFrame(() => {
        const rotateY = (px - 0.5) * MAX_TILT * 2;
        const rotateX = (0.5 - py) * MAX_TILT * 2;
        card.style.setProperty('--tg-rx', `${rotateX.toFixed(2)}deg`);
        card.style.setProperty('--tg-ry', `${rotateY.toFixed(2)}deg`);
        card.style.setProperty('--tg-x', `${(px * 100).toFixed(1)}%`);
        card.style.setProperty('--tg-y', `${(py * 100).toFixed(1)}%`);
      });
    };

    const onLeave = () => {
      if (frame) cancelAnimationFrame(frame);
      card.style.setProperty('--tg-rx', '0deg');
      card.style.setProperty('--tg-ry', '0deg');
    };

    card.addEventListener('pointermove', onMove);
    card.addEventListener('pointerleave', onLeave);
  });
}

// ---------- Tombol berbagi (share) ----------
// Elemen dengan [data-share="whatsapp|facebook|twitter|copy"] akan otomatis
// membuka jendela share yang sesuai, memakai judul & URL halaman saat ini.
function initShareButtons() {
  const buttons = document.querySelectorAll('[data-share]');
  if (buttons.length === 0) return;

  const url = window.location.href;
  const title = document.title;

  buttons.forEach((btn) => {
    btn.addEventListener('click', async () => {
      const type = btn.dataset.share;

      if (type === 'copy') {
        try {
          await navigator.clipboard.writeText(url);
          const original = btn.innerHTML;
          btn.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" class="h-4 w-4"><path d="M20 6 9 17l-5-5"/></svg><span>Tersalin!</span>';
          setTimeout(() => { btn.innerHTML = original; }, 1800);
        } catch (e) {
          window.prompt('Salin tautan berikut:', url);
        }
        return;
      }

      const shareUrls = {
        whatsapp: `https://api.whatsapp.com/send?text=${encodeURIComponent(title + ' - ' + url)}`,
        facebook: `https://www.facebook.com/sharer/sharer.php?u=${encodeURIComponent(url)}`,
        twitter: `https://twitter.com/intent/tweet?text=${encodeURIComponent(title)}&url=${encodeURIComponent(url)}`,
      };
      const target = shareUrls[type];
      if (target) window.open(target, '_blank', 'noopener,noreferrer,width=600,height=500');
    });
  });
}