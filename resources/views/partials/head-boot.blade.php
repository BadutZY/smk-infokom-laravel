{{-- Dijalankan SEBELUM render pertama: memutuskan apakah halaman ini dimulai
     "tertutup tirai" (datang lewat transisi / kunjungan pertama sesi ini).
     Panel admin (/admin/*) SENGAJA dikecualikan: perpindahan halaman di admin
     berjalan normal tanpa tirai maupun animasi. --}}
<script>
  (function () {
    try {
      var d = document.documentElement;
      var s = window.sessionStorage;
      var isAdmin = /^\/admin(\/|$)/.test(location.pathname);
      if (isAdmin) {
        s.removeItem('smk:pt');
        s.removeItem('smk:pt-label');
        d.classList.add('page-loaded');
        return;
      }
      if (s.getItem('smk:pt') === '1') {
        s.removeItem('smk:pt');
        d.classList.add('pt-enter');
      } else if (!s.getItem('smk:intro')) {
        s.setItem('smk:intro', '1');
        d.classList.add('pt-enter', 'pt-intro');
      }
    } catch (e) {}
  })();
</script>