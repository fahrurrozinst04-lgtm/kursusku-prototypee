<?php
require_once __DIR__ . '/helpers.php';

// Nilai dasar situs (Pertemuan 2)
$siteName = 'KursusKu';
$tagline  = 'Belajar, daftar, dan kelola kursus dalam satu tempat.';
$year     = date('Y');

// Data katalog kursus (Pertemuan 4) - dipindah ke file data bersama (Pertemuan 5)
$courses = require __DIR__ . '/courses-data.php';
?>
<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= e($siteName) ?> - Kursus Teknologi untuk Mahasiswa</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
<header class="site-header">
    <div class="container nav-wrap">
        <a class="brand" href="index.php"><?= e($siteName) ?></a>
        <nav aria-label="Navigasi utama">
            <a href="index.php">Beranda</a>
            <a href="index.php#katalog">Katalog</a>
            <a href="fee-calculator.php">Estimasi Biaya</a>
            <a href="registration.php">Daftar Kursus</a>
        </nav>
    </div>
</header>

<main class="container">
    <section class="hero" id="hero">
        <h1><?= e($tagline) ?></h1>
        <p>Temukan kursus teknologi yang relevan untuk meningkatkan keterampilan Anda.</p>
        <div class="hero-actions">
            <a class="btn-primary" href="registration.php">Daftar Kursus</a>
            <a class="btn-outline" href="#katalog">Lihat Katalog</a>
            <a class="btn-outline" href="fee-calculator.php">Estimasi Biaya</a>
        </div>
    </section>

    <section class="section" id="keunggulan">
        <h2>Mengapa Memilih KursusKu?</h2>
        <div class="card-grid">
            <article class="card">
                <h3>Materi Terarah</h3>
                <p>Materi disusun bertahap dari dasar hingga praktik.</p>
            </article>
            <article class="card">
                <h3>Belajar dengan Proyek</h3>
                <p>Setiap tahap menghasilkan bagian nyata dari aplikasi.</p>
            </article>
            <article class="card">
                <h3>Pendampingan Praktik</h3>
                <p>Mahasiswa belajar melalui demonstrasi, latihan, dan evaluasi.</p>
            </article>
        </div>
    </section>

    <section class="section" id="katalog">
        <h2>Katalog Kursus</h2>
        <div class="table-wrap">
            <table>
                <thead>
                    <tr>
                        <th>Kode</th>
                        <th>Nama</th>
                        <th class="num">Biaya</th>
                        <th>Mulai</th>
                        <th class="num">Sisa</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($courses as $course): ?>
                        <?php
                        $status = statusKursus($course['quota'], $course['registered']);
                        $isFull = $status === 'Penuh';
                        $statusClass = $isFull ? 'badge-full' : 'badge-available';
                        ?>
                        <tr>
                            <td><?= e($course['code']) ?></td>
                            <td><?= e(trim($course['name'])) ?></td>
                            <td class="num"><?= rupiah($course['fee']) ?></td>
                            <td><?= formatTanggal($course['start_date']) ?></td>
                            <td class="num"><?= sisaKursi($course['quota'], $course['registered']) ?></td>
                            <td><span class="badge <?= $statusClass ?>"><?= $status ?></span></td>
                            <td>
                                <?php if ($isFull): ?>
                                    <span class="link-disabled">Tidak tersedia</span>
                                <?php else: ?>
                                    <a href="registration.php?course=<?= urlencode($course['code']) ?>">Daftar</a>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </section>

    <section class="section" id="alur">
        <h2>Cara Mendaftar</h2>
        <ol class="steps">
            <li>Pilih kursus yang diminati.</li>
            <li>Isi form pendaftaran.</li>
            <li>Periksa kembali data.</li>
            <li>Kirim pendaftaran dan tunggu konfirmasi.</li>
        </ol>
        <a class="btn-primary" href="registration.php">Mulai Daftar</a>
    </section>

    <section class="section" id="media">
        <h2>Kenali Program Kami</h2>
        <figure class="media-figure">
            <img
                src="assets/images/hero-kursus.jpg"
                alt="Mahasiswa sedang mengikuti kegiatan kursus komputer"
                width="640">
        </figure>
        <h3>Video Singkat</h3>
        <video controls preload="metadata">
            <source src="assets/video/intro-kursus.mp4" type="video/mp4">
            Browser Anda tidak mendukung video HTML5.
        </video>
        <p>
            Pelajari juga
            <a href="https://www.php.net/" target="_blank" rel="noopener">dokumentasi PHP</a>.
        </p>
    </section>

    <section class="section" id="kontak">
        <h2>Kontak</h2>
        <p>Email: fahrurrozinst04@gmail.com</p>
        <p>Alamat: HUTABANGUN MY DESA</p>
    </section>
</main>

<footer class="site-footer">
    <small>&copy; <?= e($year) ?> <?= e($siteName) ?></small>
</footer>
</body>
</html>
