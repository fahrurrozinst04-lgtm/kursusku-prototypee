<?php
require __DIR__ . '/data.php';
require __DIR__ . '/helpers.php';

// Halaman ini hanya untuk request POST. Akses langsung (GET) dikembalikan ke form.
// Redirect harus dijalankan sebelum ada output HTML apa pun.
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: register.php');
    exit;
}

/* ------------------------------------------------------------------
 * 1. MEMBACA DATA POST (dengan nilai default agar tidak ada warning)
 * ------------------------------------------------------------------ */
$name            = postString('name');
$email           = postString('email');
$courseCode      = postString('course_code');
$participantType = postString('participant_type');
$learningMode    = postString('learning_mode');
$packageCount    = (int) postString('package_count', '1');
$notes           = postString('notes');

// Checkbox: key 'interests' tidak dikirim sama sekali bila tidak ada yang dipilih.
$interests = sanitizeInterests($_POST['interests'] ?? [], $interestOptions);

/* ------------------------------------------------------------------
 * 2. VALIDASI FUNDAMENTAL
 * ------------------------------------------------------------------ */
$course = findCourse($courses, $courseCode);

$errors = validateRegistration(
    $name, $email, $course, $participantType, $learningMode, $packageCount, $notes
);

/* ------------------------------------------------------------------
 * 3. JIKA ADA ERROR: tampilkan pesan lalu HENTIKAN proses (exit)
 * ------------------------------------------------------------------ */
if ($errors !== []) {
    http_response_code(422);
    ?>
<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Data Belum Valid - KursusKu</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
<main class="container">
    <section class="alert-error" role="alert">
        <h1>Data belum dapat diproses</h1>
        <ul class="error-list">
            <?php foreach ($errors as $error): ?>
                <li><?= e($error) ?></li>
            <?php endforeach; ?>
        </ul>
        <a class="btn-link" href="register.php">Kembali ke form</a>
    </section>
</main>
</body>
</html>
    <?php
    exit;
}

/* ------------------------------------------------------------------
 * 4. PERHITUNGAN BIAYA (urutan: biaya satuan -> paket -> subtotal
 *    -> persen diskon -> nilai diskon -> total akhir)
 * ------------------------------------------------------------------ */
$calc            = calculateRegistration($course['fee'], $packageCount, $participantType);
$discountPercent = $calc['discountPercent'];
$grossTotal      = $calc['grossTotal'];
$discountAmount  = $calc['discountAmount'];
$finalTotal      = $calc['finalTotal'];
$learningModeLabel = getLearningModeLabel($learningMode);
?>
<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Ringkasan Pendaftaran - KursusKu</title>
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
            <a href="register.php">Daftar Kursus</a>
            <a href="history.php">Riwayat</a>
            <a href="test-matrix.php">Test Matrix</a>
        </nav>
    </div>
</header>

<main class="container result-page">
    <section class="alert-success" role="status">
        <h1>Pendaftaran Berhasil Diproses</h1>
        <p>Periksa kembali data latihan berikut.</p>
    </section>

    <section class="summary-card">
        <h2 class="card-title">Data Peserta</h2>
        <dl class="summary-list">
            <dt>Nama</dt><dd><?= e($name) ?></dd>
            <dt>Email</dt><dd><?= e($email) ?></dd>
            <dt>Kursus</dt><dd><?= e($course['name']) ?></dd>
            <dt>Tipe peserta</dt><dd><?= e(getParticipantTypeLabel($participantType)) ?></dd>
            <dt>Metode</dt><dd><?= e($learningModeLabel) ?></dd>
            <dt>Jumlah paket</dt><dd><?= $packageCount ?></dd>
            <dt>Catatan</dt><dd><?= $notes === '' ? '-' : e($notes) ?></dd>
        </dl>

        <h2 class="card-title">Rincian Biaya</h2>
        <div class="table-wrap">
            <table>
                <tbody>
                    <tr>
                        <td>Biaya per paket</td>
                        <td class="num"><?= formatRupiah($course['fee']) ?></td>
                    </tr>
                    <tr>
                        <td>Subtotal (<?= $packageCount ?> paket)</td>
                        <td class="num"><?= formatRupiah($grossTotal) ?></td>
                    </tr>
                    <tr>
                        <td>Diskon <?= $discountPercent ?>%</td>
                        <td class="num">&minus;<?= formatRupiah($discountAmount) ?></td>
                    </tr>
                    <tr class="total">
                        <td>Total akhir</td>
                        <td class="num"><?= formatRupiah($finalTotal) ?></td>
                    </tr>
                </tbody>
            </table>
        </div>

        <h2 class="card-title">Minat</h2>
        <ul class="facility-list">
            <?php if ($interests === []): ?>
                <li>Belum memilih minat.</li>
            <?php else: ?>
                <?php foreach ($interests as $interest): ?>
                    <?php $label = $interestOptions[$interest] ?? $interest; ?>
                    <li><?= e($label) ?></li>
                <?php endforeach; ?>
            <?php endif; ?>
        </ul>

        <a class="btn-link" href="register.php">Daftar Lagi</a>
    </section>
</main>

<footer class="site-footer">
    <small>&copy; <?= date('Y') ?> KursusKu</small>
</footer>
</body>
</html>
