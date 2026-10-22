// ===================================================================
// SMK INFOKOM — UI v3 (interaksi tambahan)
// File ini diimpor oleh app.js. Semua fitur di sini opsional: kalau
// elemennya tidak ada di halaman, fungsinya langsung berhenti.
// ===================================================================
import '../css/ui-v3.css';

const REDUCED = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
const FINE_POINTER = window.matchMedia('(pointer: fine)').matches;

// Buang aksen supaya "sekolah" cocok dengan "Sékolah", huruf besar/kecil diabaikan
const norm = (s) => (s || '').toLowerCase().normalize('NFD').replace(/[\u0300-\u036f]/g, '').replace(/\s+/g, ' ').trim();

document.addEventListener('DOMContentLoaded', () => {
  initMajorTiles();
  initListSearch();
  initStaffSearch();
  initColorFields();
});

// ---------- Kartu jurusan: cahaya lembut berwarna jurusan mengikuti kursor ----------
function initMajorTiles() {
  if (!FINE_POINTER || REDUCED) return;
  document.querySelectorAll('.major-tile').forEach((tile) => {
    let frame = null;
    tile.addEventListener('pointermove', (e) => {
      if (frame) cancelAnimationFrame(frame);
      frame = requestAnimationFrame(() => {
        const r = tile.getBoundingClientRect();
        tile.style.setProperty('--mx', `${(e.clientX - r.left).toFixed(0)}px`);
        tile.style.setProperty('--my', `${(e.clientY - r.top).toFixed(0)}px`);
      });
    }, { passive: true });
  });
}

// ---------- Pencarian langsung (Berita, Galeri) — bisa digabung dengan filter kategori ----------
function refreshEmpty(container) {
  const empty = container.parentElement && container.parentElement.querySelector('[data-filter-empty]');
  if (!empty) return;
  const visible = container.querySelectorAll('[data-filter-item]:not(.hidden):not(.is-search-hidden)').length;
  empty.classList.toggle('is-visible', visible === 0);
}

function initListSearch() {
  document.querySelectorAll('[data-search-input]').forEach((input) => {
    const container = document.querySelector(input.dataset.searchInput);
    if (!container) return;
    const items = Array.from(container.querySelectorAll('[data-filter-item]'));
    const apply = () => {
      const q = norm(input.value);
      items.forEach((it) => {
        const hit = q === '' || norm(it.dataset.search || it.textContent).includes(q);
        it.classList.toggle('is-search-hidden', !hit);
      });
      refreshEmpty(container);
    };
    input.addEventListener('input', apply);
    // setelah tombol kategori ditekan, hitung ulang supaya pencarian tetap berlaku
    document.addEventListener('click', (e) => {
      if (e.target instanceof Element && e.target.closest('[data-filter-btn]')) requestAnimationFrame(apply);
    });
  });
}

// ---------- Pencarian Guru & Staff ----------
function initStaffSearch() {
  const input = document.querySelector('[data-staff-search]');
  if (!input) return;
  const cards = Array.from(document.querySelectorAll('.staff-card[data-name]'));
  const sections = Array.from(document.querySelectorAll('[data-staff-category]'));
  const empty = document.querySelector('[data-staff-empty]');
  const shown = document.querySelector('[data-staff-shown]');
  const select = document.querySelector('[data-staff-filter-select]');

  const apply = () => {
    const q = norm(input.value);
    cards.forEach((c) => {
      const hit = q === '' || norm(`${c.dataset.name} ${c.dataset.role || ''}`).includes(q);
      c.classList.toggle('is-search-hidden', !hit);
    });
    let total = 0;
    sections.forEach((s) => {
      const visible = s.querySelectorAll('.staff-card:not(.is-search-hidden)').length;
      s.classList.toggle('is-search-hidden', visible === 0);
      if (!s.classList.contains('is-filtered-out')) total += visible;
      const cnt = s.querySelector('[data-staff-cat-count]');
      if (cnt) cnt.textContent = `${visible} orang`;
    });
    if (empty) empty.classList.toggle('hidden', total > 0);
    if (shown) shown.textContent = String(total);
  };

  input.addEventListener('input', apply);
  if (select) select.addEventListener('change', () => requestAnimationFrame(apply));
  const form = input.closest('form');
  if (form) form.addEventListener('submit', (e) => e.preventDefault());
}

// ---------- Admin: pemilih warna identitas jurusan ----------
function initColorFields() {
  const HEX = /^#[0-9A-F]{6}$/;
  document.querySelectorAll('[data-color-field]').forEach((box) => {
    const picker = box.querySelector('[data-color-picker]');
    const text = box.querySelector('[data-color-text]');
    const preview = box.querySelector('[data-color-preview]');
    const swatches = Array.from(box.querySelectorAll('[data-color-swatch]'));
    if (!text) return;
    const fallback = (box.dataset.fallback || '#2563EB').toUpperCase();

    const paint = (hex) => {
      const valid = HEX.test(hex);
      const c = valid ? hex : fallback;
      if (preview) preview.style.setProperty('--major', c);
      if (picker) picker.value = c.toLowerCase();
      swatches.forEach((s) => s.classList.toggle('is-on', valid && s.dataset.colorSwatch.toUpperCase() === c));
    };
    const setValue = (val) => { text.value = val; paint(val); };

    text.addEventListener('input', () => {
      let v = text.value.trim().toUpperCase();
      if (v && v[0] !== '#') v = `#${v}`;
      text.value = v.slice(0, 7);
      paint(text.value);
    });
    if (picker) picker.addEventListener('input', () => setValue(picker.value.toUpperCase()));
    swatches.forEach((s) => s.addEventListener('click', () => setValue(s.dataset.colorSwatch.toUpperCase())));
    const reset = box.querySelector('[data-color-reset]');
    if (reset) reset.addEventListener('click', () => setValue(''));

    // Pratinjau ikut memakai kode & nama jurusan yang sedang diketik
    const codeEl = preview && preview.querySelector('[data-color-preview-code]');
    const nameEl = preview && preview.querySelector('[data-color-preview-name]');
    const codeInput = document.querySelector('input[name="kode"]');
    const nameInput = document.querySelector('input[name="nama"]');
    if (codeInput && codeEl) codeInput.addEventListener('input', () => { codeEl.textContent = codeInput.value || 'KODE'; });
    if (nameInput && nameEl) nameInput.addEventListener('input', () => { nameEl.textContent = nameInput.value || 'Nama jurusan'; });

    paint(text.value.trim().toUpperCase());
  });
}
