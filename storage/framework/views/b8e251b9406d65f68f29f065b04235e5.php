<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="utf-8">
<title>Formulir PPDB - <?php echo e($p->nama); ?></title>
<style>
  /* Catatan: dompdf hanya mendukung sebagian CSS (tanpa flexbox/grid modern),
     jadi layout di bawah sengaja memakai <table> agar hasil cetak konsisten. */
  @page { margin: 26px 34px; }
  body { font-family: "Helvetica", Arial, sans-serif; font-size: 11px; color: #1c1c22; line-height: 1.5; }

  .header-table { width: 100%; border-bottom: 2.5px solid #16213e; padding-bottom: 10px; margin-bottom: 14px; }
  .school-name { font-size: 16px; font-weight: bold; color: #16213e; margin: 0; }
  .school-meta { font-size: 9.5px; color: #555; margin: 2px 0 0; }
  .doc-badge { text-align: right; font-size: 9px; color: #777; }
  .doc-badge strong { display: block; font-size: 12px; color: #b8860b; font-family: "Courier New", monospace; }

  .title { text-align: center; font-size: 14px; font-weight: bold; text-transform: uppercase; letter-spacing: .5px; margin: 4px 0 2px; color: #16213e; }
  .subtitle { text-align: center; font-size: 10px; color: #666; margin: 0 0 16px; }

  .section-title {
    background: #16213e; color: #ffffff; font-size: 10px; font-weight: bold; text-transform: uppercase;
    letter-spacing: .4px; padding: 5px 10px; margin: 14px 0 0;
  }
  table.data-table { width: 100%; border-collapse: collapse; margin-bottom: 2px; }
  table.data-table td { padding: 6px 10px; border: 1px solid #dcdce2; vertical-align: top; }
  table.data-table td.label { width: 34%; background: #f4f5f9; font-weight: bold; color: #444; }
  table.data-table td.value { width: 66%; color: #1c1c22; }

  .footer-note { margin-top: 16px; font-size: 8.5px; color: #999; text-align: center; }

  .ttd-table { width: 100%; margin-top: 34px; }
  .ttd-table td { width: 50%; text-align: center; font-size: 10px; vertical-align: top; }
  .ttd-space { display: block; height: 60px; }
  .ttd-line { border-top: 1px solid #1c1c22; display: inline-block; padding-top: 4px; min-width: 180px; font-weight: bold; }
</style>
</head>
<body>

  <table class="header-table">
    <tr>
      <td style="width: 65%;">
        <p class="school-name"><?php echo e($school['name'] ?: 'SMK INFOKOM Kota Bogor'); ?></p>
        <p class="school-meta">
          <?php echo e($school['address'] ?? ''); ?>

          <?php if(!empty($school['phone'])): ?> &middot; Telp. <?php echo e($school['phone']); ?> <?php endif; ?>
          <?php if(!empty($school['email'])): ?> &middot; <?php echo e($school['email']); ?> <?php endif; ?>
        </p>
      </td>
      <td class="doc-badge" style="width: 35%;">
        No. Pendaftaran
        <strong><?php echo e($p->nomor_pendaftaran); ?></strong>
      </td>
    </tr>
  </table>

  <p class="title">Formulir Pendaftaran PPDB <?php echo e($tahunAjaran); ?></p>
  <p class="subtitle">Terdaftar pada <?php echo e(\App\Support\Site::formatTanggalPanjang((string) $p->created_at)); ?></p>

  <p class="section-title">Data Diri Siswa</p>
  <table class="data-table">
    <tr>
      <td class="label">Nama Lengkap</td>
      <td class="value"><?php echo e($p->nama); ?></td>
    </tr>
    <tr>
      <td class="label">NISN</td>
      <td class="value"><?php echo e($p->nisn); ?></td>
    </tr>
    <tr>
      <td class="label">Jenis Kelamin</td>
      <td class="value"><?php echo e($p->jenis_kelamin); ?></td>
    </tr>
    <tr>
      <td class="label">Tempat, Tanggal Lahir</td>
      <td class="value"><?php echo e($p->tempat_lahir ?: '-'); ?>, <?php echo e($p->tanggal_lahir ? \App\Support\Site::formatTanggal((string) $p->tanggal_lahir) : '-'); ?></td>
    </tr>
    <tr>
      <td class="label">Agama</td>
      <td class="value"><?php echo e($p->agama ?: '-'); ?></td>
    </tr>
    <tr>
      <td class="label">Asal Sekolah</td>
      <td class="value"><?php echo e($p->asal_sekolah); ?></td>
    </tr>
  </table>

  <p class="section-title">Data Orang Tua / Wali</p>
  <table class="data-table">
    <tr>
      <td class="label">Nama Orang Tua/Wali</td>
      <td class="value"><?php echo e($p->nama_orang_tua ?: '-'); ?></td>
    </tr>
    <tr>
      <td class="label">No. Telepon Orang Tua/Wali</td>
      <td class="value"><?php echo e($p->telepon_orang_tua ?: '-'); ?></td>
    </tr>
    <tr>
      <td class="label">Pekerjaan Orang Tua/Wali</td>
      <td class="value"><?php echo e($p->pekerjaan_orang_tua ?: '-'); ?></td>
    </tr>
  </table>

  <p class="section-title">Kontak &amp; Alamat</p>
  <table class="data-table">
    <tr>
      <td class="label">Email</td>
      <td class="value"><?php echo e($p->email); ?></td>
    </tr>
    <tr>
      <td class="label">Nomor Telepon Siswa</td>
      <td class="value"><?php echo e($p->telepon); ?></td>
    </tr>
    <tr>
      <td class="label">Alamat Lengkap</td>
      <td class="value"><?php echo e($p->alamat); ?></td>
    </tr>
  </table>

  <p class="section-title">Pilihan Jurusan</p>
  <table class="data-table">
    <tr>
      <td class="label">Pilihan 1</td>
      <td class="value"><?php echo e($p->pilihan1); ?></td>
    </tr>
    <tr>
      <td class="label">Pilihan 2</td>
      <td class="value"><?php echo e($p->pilihan2 ?: '-'); ?></td>
    </tr>
  </table>

  <p class="section-title">Dokumen Pendukung</p>
  <table class="data-table">
    <tr>
      <td class="label">Status Berkas</td>
      <td class="value">
        <?php if($p->dokumen): ?>
          Sudah diunggah oleh pendaftar (disertakan terpisah dalam berkas ZIP unduhan ini).
        <?php else: ?>
          Belum diunggah oleh pendaftar.
        <?php endif; ?>
      </td>
    </tr>
  </table>

  <table class="ttd-table">
    <tr>
      <td>
        Bogor, <?php echo e(\App\Support\Site::formatTanggalPanjang(now()->toDateString())); ?><br>
        Pendaftar
        <span class="ttd-space"></span>
        <span class="ttd-line"><?php echo e($p->nama); ?></span>
      </td>
      <td>
        Mengetahui,<br>
        Panitia PPDB
        <span class="ttd-space"></span>
        <span class="ttd-line">&nbsp;</span>
      </td>
    </tr>
  </table>

  <p class="footer-note">Dokumen ini dibuat otomatis oleh sistem PPDB <?php echo e($school['name'] ?: 'sekolah'); ?> pada <?php echo e(\App\Support\Site::formatTanggalPanjang(now()->toDateString())); ?> dan sah tanpa cap basah selama data sesuai sistem.</p>

</body>
</html><?php /**PATH C:\Users\rizki\Pictures\INFOKOM-REACT\Laravel\smk-infokom\resources\views/admin/ppdb/pdf.blade.php ENDPATH**/ ?>