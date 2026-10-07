<?php
require __DIR__ . '/data.php';
require __DIR__ . '/helpers.php';

/**
 * test-matrix.php - Evidence Week 06
 *
 * Kolom ACTUAL dihitung ulang saat halaman dibuka, memakai fungsi yang sama
 * dengan process.php (validateRegistration, calculateRegistration, dll).
 * Kolom EXPECTED ditulis manual dari panduan. Status = PASS bila keduanya sama.
 */

// Data dasar yang valid; tiap skenario hanya mengubah bagian yang diuji.
$base = [
    'name'      => 'Andi',
    'email'     => 'andi@example.test',
    'course'    => 'web',
    'type'      => 'mahasiswa',
    'mode'      => 'offline',
    'packages'  => 1,
    'notes'     => '',
    'interests' => [],
];

/** Menjalankan alur process.php dan mengembalikan teks hasil singkat. */
$runTotal = function (array $in) use ($courses): string {
    $course = findCourse($courses, $in['course']);
    $errors = validateRegistration(
        $in['name'], $in['email'], $course, $in['type'], $in['mode'], $in['packages'], $in['notes']
    );
    if ($errors !== []) {
        return $errors[0];
    }
    $calc = calculateRegistration($course['fee'], $in['packages'], $in['type']);
    return formatRupiah($calc['finalTotal']);
};

$runInterests = function (array $in) use ($interestOptions): string {
    $keys = sanitizeInterests($in['interests'], $interestOptions);
    if ($keys === []) {
        return 'Belum memilih minat.';
    }
    return implode(', ', array_map(fn ($k) => $interestOptions[$k], $keys));
};

// Pemeriksaan kode sumber untuk dua skenario yang butuh HTTP / edit manual.
$processSource  = (string) file_get_contents(__DIR__ . '/process.php');
$registerSource = (string) file_get_contents(__DIR__ . '/register.php');

$hasGetGuard = str_contains($processSource, "\$_SERVER['REQUEST_METHOD'] !== 'POST'")
    && str_contains($processSource, "header('Location: register.php')");
$rendersFacilities = (bool) preg_match('/foreach\s*\(\s*\$facilities\s+as\s+\$\w+\s*\)/', $registerSource);

$scenarios = [
    ['Mahasiswa, Web Dasar, 1 paket',  $runTotal($base),                                               'Rp240.000'],
    ['Guru, PHP Dasar, 1 paket',       $runTotal([...$base, 'course' => 'php', 'type' => 'guru']),     'Rp340.000'],
    ['Umum, Laravel Dasar, 1 paket',   $runTotal([...$base, 'course' => 'laravel', 'type' => 'umum']), 'Rp500.000'],
    ['Mahasiswa, Web Dasar, 2 paket',  $runTotal([...$base, 'packages' => 2]),                         'Rp480.000'],
    ['Nama kosong',                    $runTotal([...$base, 'name' => '']),                            'Nama wajib diisi.'],
    ['Email tidak valid',              $runTotal([...$base, 'email' => 'abc']),                        'Format email tidak valid.'],
    ['Minat kosong',                   $runInterests($base),                                           'Belum memilih minat.'],
    ['3 minat',                        $runInterests([...$base, 'interests' => ['frontend', 'backend', 'database']]), 'Frontend, Backend, Database'],
    ['Metode offline',                 getLearningModeLabel('offline'),                                'Tatap Muka'],
    ['Metode hybrid',                  getLearningModeLabel('hybrid'),                                 'Hybrid'],
    ['GET process.php',                $hasGetGuard ? 'Redirect ke register.php' : 'Tidak ada redirect', 'Redirect ke register.php'],
    ['Tambah fasilitas',               $rendersFacilities ? 'Dirender otomatis dengan foreach' : 'Ditulis manual', 'Dirender otomatis dengan foreach'],
];

$rows = [];
foreach ($scenarios as $index => [$scenario, $actual, $expected]) {
    $rows[] = [
        'no'       => $index + 1,
        'scenario' => $scenario,
        'actual'   => $actual,
        'expected' => $expected,
        'pass'     => $actual === $expected,
    ];
}
$passCount = count(array_filter($rows, fn ($r) => $r['pass']));
$totalRows = count($rows);
?>
<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Test Matrix Pertemuan 6 - KursusKu</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
<header class="site-header">
    <div class="container nav-wrap">
        <a class="brand" href="index.php">KursusKu</a>
        <nav aria-label="Navigasi utama">
            <a href="index.php">Beranda</a>
            <a href="index.php#katalog">Katalog</a>
            <a href="register.php">Daftar Kursus</a>
            <a href="history.php">Riwayat</a>
            <a href="test-matrix.php" aria-current="page">Test Matrix</a>
        </nav>
    </div>
</header>

<main class="container">
    <section class="page-intro matrix-intro">
        <p class="eyebrow">Evidence Week 06</p>
        <h1>Test Matrix Pertemuan 6</h1>
        <p>Hasil pengujian skenario pendaftaran: perbandingan hasil aktual dengan hasil yang diharapkan.</p>
    </section>

    <section class="matrix-card">
        <div class="table-wrap">
            <table class="matrix-table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Skenario</th>
                        <th>Actual</th>
                        <th>Expected</th>
                        <th class="center">Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($rows as $row): ?>
                        <tr>
                            <td><?= $row['no'] ?></td>
                            <td class="strong"><?= e($row['scenario']) ?></td>
                            <td><?= e($row['actual']) ?></td>
                            <td><?= e($row['expected']) ?></td>
                            <td class="center">
                                <span class="badge <?= $row['pass'] ? 'badge-pass' : 'badge-fail' ?>">
                                    <?= $row['pass'] ? 'PASS' : 'FAIL' ?>
                                </span>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="4" class="summary-label">Ringkasan:</td>
                        <td class="center summary-value <?= $passCount === $totalRows ? 'all-pass' : 'has-fail' ?>">
                            <?= $passCount ?>/<?= $totalRows ?> Pass
                        </td>
                    </tr>
                </tfoot>
            </table>
        </div>
        <p class="note matrix-note">
            Skenario 1&ndash;10 dihitung ulang oleh fungsi di <code>helpers.php</code> setiap halaman dibuka.
            Skenario 11&ndash;12 diperiksa dari kode sumber <code>process.php</code> dan <code>register.php</code>.
        </p>
    </section>
</main>

<footer class="site-footer">
    <small>&copy; <?= date('Y') ?> KursusKu</small>
</footer>
</body>
</html>
