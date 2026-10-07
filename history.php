<?php
require __DIR__ . '/helpers.php';

// Data dummy (belum ada database) untuk melatih foreach.
$history = [
    ['name' => 'Alya',  'course' => 'Web Dasar',     'total' => 240000],
    ['name' => 'Bima',  'course' => 'PHP Dasar',     'total' => 340000],
    ['name' => 'Citra', 'course' => 'Laravel Dasar', 'total' => 500000],
];
?>
<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Riwayat - KursusKu</title>
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
            <a href="history.php" aria-current="page">Riwayat</a>
            <a href="test-matrix.php">Test Matrix</a>
        </nav>
    </div>
</header>

<main class="container">
    <section class="page-intro">
        <p class="eyebrow">Latihan Looping</p>
        <h1>Riwayat Pendaftaran (Dummy)</h1>
        <p>Data berikut berasal dari array, bukan database. Halaman ini hanya latihan <code>foreach</code>.</p>
    </section>

    <section class="calc-card">
        <div class="table-wrap">
            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Kursus</th>
                        <th class="num">Total</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($history as $index => $item): ?>
                        <tr>
                            <td><?= $index + 1 ?></td>
                            <td><?= e($item['name']) ?></td>
                            <td><?= e($item['course']) ?></td>
                            <td class="num"><?= formatRupiah($item['total']) ?></td>
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
