<?php
require_once __DIR__ . '/helpers.php';

// Nilai dasar situs (Pertemuan 2)
$siteName = 'KursusKu';
$tagline  = 'Belajar, daftar, dan kelola kursus dalam satu tempat.';
$year     = date('Y');

// Data katalog kursus (Pertemuan 4) - minimal 6 record, key konsisten
$courses = [
    ['code' => 'WEB-01', 'name' => 'Web Dasar',           'fee' => 200000, 'quota' => 30, 'registered' => 12, 'start_date' => '2026-09-21'],
    ['code' => 'PHP-01', 'name' => 'PHP Dasar',           'fee' => 250000, 'quota' => 30, 'registered' => 18, 'start_date' => '2026-09-22'],
    ['code' => 'PHP-02', 'name' => 'PHP Lanjutan',        'fee' => 300000, 'quota' => 25, 'registered' => 24, 'start_date' => '2026-09-24'],
    ['code' => 'LAR-01', 'name' => 'Laravel Fundamental', 'fee' => 350000, 'quota' => 25, 'registered' => 25, 'start_date' => '2026-09-28'],
    ['code' => 'DB-01',  'name' => 'MySQL Dasar',         'fee' => 275000, 'quota' => 20, 'registered' => 0,  'start_date' => '2026-10-01'],
    ['code' => 'UI-01',  'name' => 'UI Web Dasar',        'fee' => 225000, 'quota' => 35, 'registered' => 9,  'start_date' => '2026-10-03'],
];
?>
<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= htmlspecialchars($siteName) ?></title>
    <style>
        body{font-family:Arial,sans-serif;margin:0;padding:0;color:#16332c;background:#f5f7f6}
        header{background:#0f766e;padding:16px 24px}
        header nav a{color:#fff;text-decoration:none;margin-right:16px;font-size:14px}
        header nav a:first-child{font-weight:700;font-size:18px}
        main{max-width:960px;margin:0 auto;padding:24px}
        section{margin-bottom:40px}
        #hero{background:#eaf7f3;padding:32px;border-radius:16px;text-align:center}
        #hero h1{margin-top:0}
        table{width:100%;border-collapse:collapse;background:#fff}
        th,td{border-bottom:1px solid #ddd;padding:10px;text-align:left;font-size:14px}
        .badge-available,.badge-full{display:inline-block;padding:4px 8px;border-radius:999px;font-weight:700;font-size:12px}
        .badge-available{background:#e7f8ef;color:#146c43}
        .badge-full{background:#fdeaea;color:#a61b1b}
        footer{text-align:center;padding:16px;color:#666;font-size:13px}
        a.button{display:inline-block;background:#0f766e;color:#fff;padding:10px 18px;border-radius:8px;text-decoration:none;margin-top:8px}
    </style>
</head>
<body>
<header>
    <nav aria-label="Navigasi utama">
        <a href="index.php"><strong><?= htmlspecialchars($siteName) ?></strong></a>
        <a href="#keunggulan">Keunggulan</a>
        <a href="#katalog">Katalog</a>
        <a href="#alur">Cara Daftar</a>
        <a href="#kontak">Kontak</a>
    </nav>
</header>

<main>
    <section id="hero">
        <h1><?= htmlspecialchars($tagline) ?></h1>
        <p>Temukan kursus teknologi yang relevan untuk meningkatkan keterampilan Anda.</p>
        <a href="#katalog">Lihat Katalog Kursus</a>
        <br>
        <a class="button" href="fee-calculator.php">Lihat Estimasi Biaya</a>
    </section>

    <section id="keunggulan">
        <h2>Mengapa Memilih KursusKu?</h2>
        <article>
            <h3>Materi Terarah</h3>
            <p>Materi disusun bertahap dari dasar hingga praktik.</p>
        </article>
        <article>
            <h3>Belajar dengan Proyek</h3>
            <p>Setiap tahap menghasilkan bagian nyata dari aplikasi.</p>
        </article>
        <article>
            <h3>Pendampingan Praktik</h3>
            <p>Mahasiswa belajar melalui demonstrasi, latihan, dan evaluasi.</p>
        </article>
    </section>

    <section id="katalog">
        <h2>Katalog Kursus</h2>
        <table>
            <thead>
                <tr>
                    <th>Kode</th>
                    <th>Nama</th>
                    <th>Biaya</th>
                    <th>Mulai</th>
                    <th>Sisa</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($courses as $course): ?>
                    <?php
                    $status = statusKursus($course['quota'], $course['registered']);
                    $statusClass = $status === 'Penuh' ? 'badge-full' : 'badge-available';
                    ?>
                    <tr>
                        <td><?= htmlspecialchars($course['code']) ?></td>
                        <td><?= htmlspecialchars(trim($course['name'])) ?></td>
                        <td><?= rupiah($course['fee']) ?></td>
                        <td><?= formatTanggal($course['start_date']) ?></td>
                        <td><?= sisaKursi($course['quota'], $course['registered']) ?></td>
                        <td><span class="<?= $statusClass ?>"><?= $status ?></span></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </section>

    <section id="alur">
        <h2>Cara Mendaftar</h2>
        <ol>
            <li>Pilih kursus yang diminati.</li>
            <li>Isi form pendaftaran.</li>
            <li>Periksa kembali data.</li>
            <li>Kirim pendaftaran dan tunggu konfirmasi.</li>
        </ol>
    </section>

    <section id="media">
        <h2>Kenali Program Kami</h2>
        <img
            src="assets/images/hero-kursus.jpg"
            alt="Mahasiswa sedang mengikuti kegiatan kursus komputer"
            width="640">
        <h3>Video Singkat</h3>
        <video controls width="640">
            <source src="assets/video/intro-kursus.mp4" type="video/mp4">
            Browser Anda tidak mendukung video HTML5.
        </video>
        <p>
            Pelajari juga
            <a href="https://www.php.net/" target="_blank" rel="noopener">dokumentasi PHP</a>.
        </p>
    </section>

    <section id="kontak">
        <h2>Kontak</h2>
        <p>Email: fahrurrozinst04@gmail.com</p>
        <p>Alamat: HUTABANGUN MY DESA</p>
    </section>
</main>

<footer>
    <small>&copy; <?= $year ?> <?= htmlspecialchars($siteName) ?></small>
</footer>
</body>
</html>
