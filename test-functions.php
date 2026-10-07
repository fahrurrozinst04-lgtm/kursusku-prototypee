<?php
require_once __DIR__ . '/helpers.php';

$courses = require __DIR__ . '/courses-data.php';
require __DIR__ . '/data.php'; // Pertemuan 6: $courses diganti paket form (web/php/laravel)
$catalog = require __DIR__ . '/courses-data.php';

$tests = [
    ['Rupiah',       rupiah(250000),            'Rp 250.000'],
    ['Penuh',        statusKursus(25, 25),      'Penuh'],
    ['Tersedia',     statusKursus(30, 29),      'Tersedia'],
    ['Sisa kosong',  sisaKursi(20, 0),          20],
    ['Sisa penuh',   sisaKursi(25, 25),         0],
    ['Tanggal',      formatTanggal('2026-09-15'), '15-09-2026'],
    // Pertemuan 5
    ['Escape',       e('<b>"Andi"</b>'),       '&lt;b&gt;&quot;Andi&quot;&lt;/b&gt;'],
    ['Nama kursus',  namaKursus($catalog, 'PHP-01'), 'PHP Dasar'],
    ['Kode asing',   namaKursus($catalog, 'XXX'),    '-'],
    // Pertemuan 6
    ['formatRupiah',        formatRupiah(240000),                     'Rp240.000'],
    ['Diskon mahasiswa',    getDiscountPercent('mahasiswa'),          20],
    ['Diskon guru',         getDiscountPercent('guru'),               15],
    ['Diskon umum',         getDiscountPercent('umum'),               0],
    ['Diskon tak dikenal',  getDiscountPercent('telepati'),           0],
    ['Label offline',       getLearningModeLabel('offline'),          'Tatap Muka'],
    ['Label hybrid',        getLearningModeLabel('hybrid'),           'Hybrid'],
    ['Label tak sah',       getLearningModeLabel('telepati'),         'Tidak diketahui'],
    ['findCourse php',      findCourse($courses, 'php')['name'],      'PHP Dasar'],
    ['findCourse kosong',   findCourse($courses, 'xxx') === null ? 'null' : 'ada', 'null'],
];

foreach ($tests as [$name, $actual, $expected]) {
    $passed = $actual === $expected;
    echo $name . ': ' . ($passed ? 'PASS' : 'FAIL');
    echo ' | actual=' . $actual;
    echo ' | expected=' . $expected . '<br>';
}
