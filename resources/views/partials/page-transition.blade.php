{{-- Tirai transisi antar-halaman PUBLIK (bukan dipakai di panel admin).
     Dikendalikan oleh initBoot() & initLinkTransitions() di app.js.
     Menampilkan teks besar di tengah = nama halaman tujuan.
     Aman: kalau JS gagal, tirai otomatis lepas sendiri lewat animasi CSS (lihat .pt-enter di app.css). --}}
@php
  $ptSchool = $site['school']['short'] ?? 'SMK INFOKOM';
  $ptTitle  = \Illuminate\Support\Str::limit(trim(strip_tags($__env->yieldContent('title'))) ?: $ptSchool, 40);
@endphp
<div class="pt-curtain" aria-hidden="true">
  <span class="pt-panel" style="--i:0"></span>
  <span class="pt-panel" style="--i:1"></span>
  <span class="pt-panel" style="--i:2"></span>
  <span class="pt-panel" style="--i:3"></span>
  <span class="pt-panel" style="--i:4"></span>
</div>
<div class="pt-stage" aria-hidden="true">
  <span class="pt-eyebrow"><i></i><b data-pt-eyebrow>Menuju</b><i></i></span>
  <span class="pt-label" data-pt-label>{{ $ptTitle }}</span>
  <span class="pt-rule"></span>
  <span class="pt-brand">
    <img src="{{ asset('images/logo.png') }}" alt="" />
    <span>{{ $ptSchool }}</span>
  </span>
</div>
<script>
  // Membagi teks jadi kata > huruf agar bisa dianimasikan satu per satu.
  // Didefinisikan di sini (bukan di app.js) supaya sudah siap sebelum render pertama,
  // dan dipakai ulang oleh app.js saat transisi keluar.
  window.__ptSetLabel = function (text, eyebrow) {
    var el = document.querySelector('[data-pt-label]');
    if (!el) return;
    var eb = document.querySelector('[data-pt-eyebrow]');
    if (eb && eyebrow) eb.textContent = eyebrow;
    text = String(text || '').replace(/\s+/g, ' ').trim();
    el.textContent = '';
    var total = text.replace(/ /g, '').length || 1;
    el.style.setProperty('--st', Math.max(10, Math.min(34, Math.round(300 / total))) + 'ms');
    el.setAttribute('data-len', total > 18 ? 'long' : total > 11 ? 'mid' : 'short');
    var c = 0;
    text.split(' ').forEach(function (word, wi, arr) {
      var w = document.createElement('span');
      w.className = 'pt-word';
      Array.from(word).forEach(function (ch) {
        var s = document.createElement('span');
        s.className = 'pt-char';
        s.style.setProperty('--c', String(c++));
        s.textContent = ch;
        w.appendChild(s);
      });
      el.appendChild(w);
      if (wi < arr.length - 1) el.appendChild(document.createTextNode(' '));
    });
  };
  (function () {
    try {
      var d = document.documentElement;
      var s = window.sessionStorage;
      var stored = s.getItem('smk:pt-label');
      s.removeItem('smk:pt-label');
      var el = document.querySelector('[data-pt-label]');
      if (!el) return;
      if (d.classList.contains('pt-intro')) {
        window.__ptSetLabel(@json($ptSchool), 'Selamat datang di');
      } else {
        window.__ptSetLabel(stored || el.textContent, 'Menuju');
      }
    } catch (e) {}
  })();
</script>