<?php
/**
 * data.php - Data untuk alur pendaftaran Pertemuan 6.
 * Semua daftar yang tampil di form dan ringkasan dibaca dari array ini
 * lewat looping, jadi menambah data cukup dilakukan di satu tempat.
 *
 * File ini hanya mendefinisikan variabel dan TIDAK menghasilkan output.
 */

// Paket kursus untuk form pendaftaran. 'code' dikirim form, 'name' ditampilkan.
$courses = [
    [
        'code' => 'web',
        'name' => 'Web Dasar',
        'fee'  => 300000,
    ],
    [
        'code' => 'php',
        'name' => 'PHP Dasar',
        'fee'  => 400000,
    ],
    [
        'code' => 'laravel',
        'name' => 'Laravel Dasar',
        'fee'  => 500000,
    ],
];

// Pilihan checkbox minat: key = value yang dikirim, value = label tampilan.
$interestOptions = [
    'frontend' => 'Frontend',
    'backend'  => 'Backend',
    'database' => 'Database',
    'uiux'     => 'UI/UX',
];

// Fasilitas yang dirender dengan foreach.
$facilities = [
    'Modul digital',
    'Sertifikat penyelesaian',
    'Forum diskusi kelas',
];
