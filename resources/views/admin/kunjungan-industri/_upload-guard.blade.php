{{-- Pemeriksaan ukuran file SEBELUM form dikirim, memakai batas PHP server saat ini
     (post_max_size & upload_max_filesize). Jadi admin langsung tahu bila file terlalu besar,
     tanpa menunggu upload selesai lalu gagal. --}}
@php
  $toBytes = function ($v) {
      $v = trim((string) $v);
      if ($v === '' || $v === '-1') { return 0; }
      $n = (float) $v;
      return (int) match (strtolower(substr($v, -1))) {
          'g' => $n * 1024 ** 3,
          'm' => $n * 1024 ** 2,
          'k' => $n * 1024,
          default => $n,
      };
  };
  $postMax = $toBytes(ini_get('post_max_size'));
  $fileMax = $toBytes(ini_get('upload_max_filesize'));
@endphp

<div id="upload-guard-config" hidden
     data-post-max="{{ $postMax }}"
     data-file-max="{{ $fileMax }}"
     data-post-label="{{ ini_get('post_max_size') }}"
     data-file-label="{{ ini_get('upload_max_filesize') }}"></div>
<script>
  (function () {
    var form = document.querySelector('form[enctype="multipart/form-data"]');
    var cfg = document.getElementById('upload-guard-config');
    if (!form || !cfg) return;
    var POST_MAX = parseInt(cfg.dataset.postMax, 10) || 0;   // 0 = tanpa batas
    var FILE_MAX = parseInt(cfg.dataset.fileMax, 10) || 0;
    var POST_LABEL = cfg.dataset.postLabel;
    var FILE_LABEL = cfg.dataset.fileLabel;

    function mb(n) { return (n / 1048576).toFixed(1) + ' MB'; }

    function showError(text) {
      var box = form.querySelector('[data-upload-error]');
      if (!box) {
        box = document.createElement('div');
        box.setAttribute('data-upload-error', '');
        box.className = 'rounded-xl border border-destructive/40 bg-destructive/10 px-4 py-3 text-sm font-medium text-destructive';
        form.insertBefore(box, form.lastElementChild);
      }
      box.textContent = text;
      box.scrollIntoView({ behavior: 'smooth', block: 'center' });
    }

    form.addEventListener('submit', function (e) {
      var total = 0, msg = '';
      form.querySelectorAll('input[type="file"]').forEach(function (input) {
        Array.prototype.forEach.call(input.files || [], function (f) {
          total += f.size;
          if (!msg && FILE_MAX && f.size > FILE_MAX) {
            msg = 'File "' + f.name + '" berukuran ' + mb(f.size) + ', melebihi batas server per file (' + FILE_LABEL + '). Perkecil file tersebut atau naikkan upload_max_filesize di php.ini.';
          }
        });
      });
      if (!msg && POST_MAX && total > POST_MAX - 262144) {
        msg = 'Total file yang dipilih ' + mb(total) + ', melebihi batas kiriman server (' + POST_LABEL + '). Kurangi jumlah/ukuran file, atau naikkan post_max_size di php.ini.';
      }
      if (msg) { e.preventDefault(); showError(msg); }
    });
  })();
</script>