<?php
require __DIR__ . '/data.php';
require __DIR__ . '/helpers.php';
?>
<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Daftar Kursus - KursusKu</title>
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
            <a href="register.php" aria-current="page">Daftar Kursus</a>
            <a href="history.php">Riwayat</a>
            <a href="test-matrix.php">Test Matrix</a>
        </nav>
    </div>
</header>

<main class="container">
    <section class="page-intro">
        <p class="eyebrow">Pendaftaran Kursus</p>
        <h1>Daftar dan hitung biaya kursus</h1>
        <p>Gunakan data latihan (email <code>@example.test</code>). Diskon dihitung otomatis dari tipe peserta.</p>
    </section>

    <section class="form-card">
        <h2 class="card-title">Fasilitas semua kursus</h2>
        <ul class="facility-list">
            <?php foreach ($facilities as $facility): ?>
                <li><?= e($facility) ?></li>
            <?php endforeach; ?>
        </ul>
    </section>

    <section class="form-card">
        <form method="POST" action="process.php" class="registration-form">
            <div class="form-grid">
                <div class="form-group">
                    <label for="name">Nama lengkap</label>
                    <input id="name" name="name" type="text"
                           maxlength="100" autocomplete="name" required>
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input id="email" name="email" type="email"
                           maxlength="120" autocomplete="email"
                           placeholder="nama@example.test" required>
                </div>
            </div>

            <div class="form-group">
                <label for="course_code">Pilih kursus</label>
                <select id="course_code" name="course_code" required>
                    <option value="">-- Pilih kursus --</option>
                    <?php foreach ($courses as $course): ?>
                        <option value="<?= e($course['code']) ?>">
                            <?= e($course['name']) ?>
                            - <?= formatRupiah($course['fee']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <fieldset class="form-group">
                <legend>Tipe peserta</legend>
                <label class="choice">
                    <input type="radio" name="participant_type"
                           value="mahasiswa" required>
                    Mahasiswa (diskon 20%)
                </label>
                <label class="choice">
                    <input type="radio" name="participant_type"
                           value="guru">
                    Guru (diskon 15%)
                </label>
                <label class="choice">
                    <input type="radio" name="participant_type"
                           value="umum">
                    Umum
                </label>
            </fieldset>

            <fieldset class="form-group">
                <legend>Minat belajar</legend>
                <?php foreach ($interestOptions as $value => $label): ?>
                    <label class="choice">
                        <input type="checkbox"
                               name="interests[]"
                               value="<?= e($value) ?>">
                        <?= e($label) ?>
                    </label>
                <?php endforeach; ?>
            </fieldset>

            <div class="form-grid">
                <div class="form-group">
                    <label for="learning_mode">Metode belajar</label>
                    <select id="learning_mode" name="learning_mode" required>
                        <option value="">-- Pilih metode --</option>
                        <option value="offline">Tatap muka</option>
                        <option value="online">Online</option>
                        <option value="hybrid">Hybrid</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="package_count">Jumlah paket</label>
                    <select id="package_count" name="package_count" required>
                        <?php for ($i = 1; $i <= 3; $i++): ?>
                            <option value="<?= $i ?>"><?= $i ?> paket</option>
                        <?php endfor; ?>
                    </select>
                </div>
            </div>

            <div class="form-group">
                <label for="notes">Catatan tambahan</label>
                <textarea id="notes" name="notes" rows="4"
                          maxlength="300" aria-describedby="notes-help"></textarea>
                <small id="notes-help" class="help">Opsional, maksimal 300 karakter.</small>
            </div>

            <button class="btn-primary" type="submit">Proses Pendaftaran</button>
        </form>
    </section>
</main>

<footer class="site-footer">
    <small>&copy; <?= date('Y') ?> KursusKu</small>
</footer>
</body>
</html>
