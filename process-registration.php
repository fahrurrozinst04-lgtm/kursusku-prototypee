<?php
require_once __DIR__ . '/helpers.php';

$courses = require __DIR__ . '/courses-data.php';

// Membaca data POST. Key harus sama persis dengan atribut name pada form.
$name            = trim($_POST['name'] ?? '');
$email           = trim($_POST['email'] ?? '');
$phone           = trim($_POST['phone'] ?? '');
$studyProgram    = trim($_POST['study_program'] ?? '');
$course          = $_POST['course'] ?? '';
$participantType = $_POST['participant_type'] ?? '';
$interests       = $_POST['interests'] ?? [];
$note            = trim($_POST['note'] ?? '');
$source          = $_POST['source'] ?? '';

// Checkbox dikirim sebagai array, digabung menjadi satu teks.
$interestText = implode(', ', $interests);

// Kode kursus (mis. PHP-01) diubah menjadi nama agar mudah dibaca.
$courseText = namaKursus($courses, $course);
?>
<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Hasil Pendaftaran - KursusKu</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
<main class="container result-page">
    <section class="alert-success" role="status">
        <h1>Pendaftaran Diterima untuk Diproses</h1>
        <p>Periksa kembali data latihan berikut.</p>
    </section>

    <section class="summary-card">
        <dl class="summary-list">
            <dt>Nama</dt><dd><?= e($name) ?></dd>
            <dt>Email</dt><dd><?= e($email) ?></dd>
            <dt>Nomor HP</dt><dd><?= e($phone) ?></dd>
            <dt>Program Studi</dt><dd><?= e($studyProgram) ?></dd>
            <dt>Kursus</dt><dd><?= e($courseText) ?> (<?= e($course) ?>)</dd>
            <dt>Jenis Peserta</dt><dd><?= e($participantType) ?></dd>
            <dt>Minat</dt><dd><?= e($interestText ?: '-') ?></dd>
            <dt>Catatan</dt><dd><?= e($note ?: '-') ?></dd>
            <dt>Sumber</dt><dd><?= e($source) ?></dd>
        </dl>
        <a class="btn-link" href="registration.php">Kembali ke Form</a>
    </section>
</main>
</body>
</html>
