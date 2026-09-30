<?php
require_once __DIR__ . '/helpers.php';

/**
 * fee-calculator.php - Kalkulator Estimasi Biaya KursusKu (Milestone 3)
 * Pemrograman Web III - Sub-CPMK2: variabel, tipe data, operator, aritmatika
 *
 * Catatan penting:
 * - Semua nilai uang disimpan sebagai INTEGER rupiah (350000, bukan "Rp 350.000").
 * - Format rupiah HANYA dilakukan saat output (fungsi rupiah() dari helpers.php).
 * - Nilai masih hard-code. Input dinamis dibahas pada pertemuan berikutnya.
 * - Pertemuan 5: CSS dipindah ke assets/css/style.css dan navigasi diseragamkan.
 */

/* ------------------------------------------------------------------
 * 1. VARIABEL INPUT DASAR
 * ------------------------------------------------------------------ */
$courseName       = 'Laravel Fundamental';  // string  - nama kursus
$fee              = 350000;                 // int     - biaya per peserta (rupiah)
$participantCount = 2;                      // int     - jumlah peserta
$discountPercent  = 10;                     // int     - persentase diskon
$adminFee         = 25000;                  // int     - biaya administrasi (rupiah)
$isActive         = true;                   // bool    - status kursus aktif

/* ------------------------------------------------------------------
 * 2. VARIABEL HASIL PROSES (rumus bisnis)
 *    subtotal = fee x participantCount
 *    discount = subtotal x discountPercent / 100
 *    total    = subtotal - discount + adminFee
 * ------------------------------------------------------------------ */
$subtotal = $fee * $participantCount;
$discount = intdiv($subtotal * $discountPercent, 100);
$total    = $subtotal - $discount + $adminFee;

/* ------------------------------------------------------------------
 * 3. DATA TEST CASE (untuk tabel pengujian di bawah halaman)
 *    Nilai expected dihitung manual, bukan diambil dari program.
 * ------------------------------------------------------------------ */
$testCases = [
    ['no' => 1, 'fee' => 350000,  'peserta' => 1, 'diskon' => 0,  'admin' => 25000, 'expected' => 375000],
    ['no' => 2, 'fee' => 350000,  'peserta' => 1, 'diskon' => 10, 'admin' => 25000, 'expected' => 340000],
    ['no' => 3, 'fee' => 350000,  'peserta' => 2, 'diskon' => 25, 'admin' => 25000, 'expected' => 550000],
    ['no' => 4, 'fee' => 0,       'peserta' => 1, 'diskon' => 10, 'admin' => 0,     'expected' => 0],
    ['no' => 5, 'fee' => 2500000, 'peserta' => 3, 'diskon' => 10, 'admin' => 50000, 'expected' => 6800000],
];
?>
<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Kalkulator Estimasi Biaya - <?= e($courseName) ?> - KursusKu</title>
  <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
<header class="site-header">
  <div class="container nav-wrap">
    <a class="brand" href="index.php">KursusKu</a>
    <nav aria-label="Navigasi utama">
      <a href="index.php">Beranda</a>
      <a href="index.php#katalog">Katalog</a>
      <a href="fee-calculator.php">Estimasi Biaya</a>
      <a href="registration.php">Daftar Kursus</a>
    </nav>
  </div>
</header>

<main class="container">
  <section class="calc-card">
    <p class="eyebrow">Estimasi Biaya</p>
    <h1>Kalkulator Estimasi Biaya KursusKu</h1>
    <p class="subtitle">
      Kursus: <strong><?= e($courseName) ?></strong>
      &mdash; status: <?= $isActive ? 'Aktif' : 'Nonaktif' ?>
    </p>

    <p class="formula">
      subtotal = fee &times; participantCount<br>
      discount = subtotal &times; discountPercent / 100<br>
      total&nbsp;&nbsp;&nbsp; = subtotal &minus; discount + adminFee
    </p>

    <div class="table-wrap">
      <table>
        <thead>
          <tr><th>Komponen</th><th class="num">Nilai</th></tr>
        </thead>
        <tbody>
          <tr>
            <td>Biaya per peserta</td>
            <td class="num"><?= rupiah($fee) ?></td>
          </tr>
          <tr>
            <td>Jumlah peserta</td>
            <td class="num"><?= $participantCount ?> orang</td>
          </tr>
          <tr>
            <td>Subtotal</td>
            <td class="num"><?= rupiah($subtotal) ?></td>
          </tr>
          <tr>
            <td>Diskon (<?= $discountPercent ?>%)</td>
            <td class="num">&minus; <?= rupiah($discount) ?></td>
          </tr>
          <tr>
            <td>Biaya admin</td>
            <td class="num">+ <?= rupiah($adminFee) ?></td>
          </tr>
          <tr class="total">
            <td>Total akhir</td>
            <td class="num"><?= rupiah($total) ?></td>
          </tr>
        </tbody>
      </table>
    </div>

    <p><a class="btn-link" href="registration.php">Lanjut ke Pendaftaran</a></p>
  </section>

  <section class="calc-card">
    <h2>Pengujian: Lima Test Case</h2>
    <p class="note">
      Kolom <em>Expected</em> dihitung manual di kertas. Kolom <em>Actual</em> dihitung ulang
      oleh PHP dengan rumus yang sama, lalu dibandingkan untuk menentukan status PASS/FAIL.
    </p>

    <div class="table-wrap">
      <table>
        <thead>
          <tr>
            <th>No</th>
            <th class="num">Fee</th>
            <th class="num">Peserta</th>
            <th class="num">Diskon</th>
            <th class="num">Admin</th>
            <th class="num">Expected</th>
            <th class="num">Actual</th>
            <th>Status</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($testCases as $case): ?>
            <?php
              // Hitung ulang dengan rumus yang sama persis seperti di atas
              $caseSubtotal = $case['fee'] * $case['peserta'];
              $caseDiscount = intdiv($caseSubtotal * $case['diskon'], 100);
              $caseActual   = $caseSubtotal - $caseDiscount + $case['admin'];
              $isPass       = $caseActual === $case['expected'];
            ?>
            <tr>
              <td><?= $case['no'] ?></td>
              <td class="num"><?= number_format($case['fee'], 0, ',', '.') ?></td>
              <td class="num"><?= $case['peserta'] ?></td>
              <td class="num"><?= $case['diskon'] ?>%</td>
              <td class="num"><?= number_format($case['admin'], 0, ',', '.') ?></td>
              <td class="num"><?= number_format($case['expected'], 0, ',', '.') ?></td>
              <td class="num"><?= number_format($caseActual, 0, ',', '.') ?></td>
              <td><span class="badge <?= $isPass ? 'badge-pass' : 'badge-fail' ?>"><?= $isPass ? 'PASS' : 'FAIL' ?></span></td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </section>
</main>

<footer class="site-footer">
  <small>&copy; <?= date('Y') ?> KursusKu</small>
</footer>
</body>
</html>
