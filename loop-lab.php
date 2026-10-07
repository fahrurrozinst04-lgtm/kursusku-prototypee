<?php
require __DIR__ . '/helpers.php';

// Batas loop dijadikan variabel supaya mudah diubah saat latihan (5 -> 3).
$limit = 5;
?>
<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Loop Lab - KursusKu</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
<header class="site-header">
    <div class="container nav-wrap">
        <a class="brand" href="index.php">KursusKu</a>
        <nav aria-label="Navigasi utama">
            <a href="index.php">Beranda</a>
            <a href="register.php">Daftar Kursus</a>
            <a href="history.php">Riwayat</a>
            <a href="test-matrix.php">Test Matrix</a>
            <a href="loop-lab.php" aria-current="page">Loop Lab</a>
        </nav>
    </div>
</header>

<main class="container">
    <section class="page-intro">
        <p class="eyebrow">Latihan Wajib</p>
        <h1>Loop Lab: for, while, do-while</h1>
        <p>Setiap loop berhenti ketika <code>$i</code> melewati <code>$limit</code> (sekarang <?= $limit ?>). Ubah nilainya di file untuk berlatih.</p>
    </section>

    <section class="calc-card">
        <h2>A. for</h2>
        <p class="note">Counter jelas, jumlah iterasi sudah diketahui.</p>
        <div class="loop-output">
            <?php for ($i = 1; $i <= $limit; $i++) {
                echo 'Pertemuan ke-' . $i . '<br>';
            } ?>
        </div>
    </section>

    <section class="calc-card">
        <h2>B. while</h2>
        <p class="note">Kondisi dicek sebelum blok dijalankan.</p>
        <div class="loop-output">
            <?php
            $i = 1;
            while ($i <= $limit) {
                echo 'Nomor antrean: ' . $i . '<br>';
                $i++; // tanpa baris ini loop tidak akan pernah berhenti
            }
            ?>
        </div>
    </section>

    <section class="calc-card">
        <h2>C. do-while</h2>
        <p class="note">Blok dijalankan dulu, baru kondisi dicek, jadi minimal tampil sekali.</p>
        <div class="loop-output">
            <?php
            $i = 1;
            do {
                echo 'Percobaan ke-' . $i . '<br>';
                $i++;
            } while ($i <= $limit);
            ?>
        </div>
    </section>

    <section class="calc-card">
        <h2>D. Perbandingan do-while vs while</h2>
        <p class="note">Kondisi awal sengaja salah (<code>$n = 10</code>, batas <code>$n &lt;= 3</code>).</p>
        <div class="loop-output">
            <?php
            $n = 10;
            $whileCount = 0;
            while ($n <= 3) {
                $whileCount++;
                $n++;
            }
            $n = 10;
            $doCount = 0;
            do {
                $doCount++;
                $n++;
            } while ($n <= 3);
            ?>
            while berjalan <strong><?= $whileCount ?>x</strong>,
            do-while berjalan <strong><?= $doCount ?>x</strong>.
        </div>
    </section>

    <section class="calc-card">
        <h2>E. foreach</h2>
        <p class="note">Membaca setiap item array.</p>
        <?php $topics = ['Form', 'Percabangan', 'Looping']; ?>
        <ul class="facility-list">
            <?php foreach ($topics as $topic): ?>
                <li><?= e($topic) ?></li>
            <?php endforeach; ?>
        </ul>
    </section>
</main>

<footer class="site-footer">
    <small>&copy; <?= date('Y') ?> KursusKu</small>
</footer>
</body>
</html>
