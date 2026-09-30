<?php
/**
 * helpers.php
 * Kumpulan function reusable untuk proyek KursusKu.
 * Pertemuan 4 - Sub-CPMK3 (fungsi string, date/time, function/procedure)
 * Pertemuan 5 - ditambah e() dan namaKursus()
 *
 * Catatan: file ini TIDAK boleh menghasilkan output sendiri ketika di-include.
 */

function rupiah(int $amount): string
{
    return 'Rp ' . number_format($amount, 0, ',', '.');
}

function statusKursus(int $quota, int $registered): string
{
    return $registered >= $quota ? 'Penuh' : 'Tersedia';
}

function sisaKursi(int $quota, int $registered): int
{
    return max(0, $quota - $registered);
}

function formatTanggal(string $date): string
{
    $value = new DateTimeImmutable($date);
    return $value->format('d-m-Y');
}

/**
 * Pertemuan 5: escaping output agar data dari pengguna aman ditampilkan di HTML.
 */
function e($value): string
{
    return htmlspecialchars((string) $value, ENT_QUOTES, 'UTF-8');
}

/**
 * Pertemuan 5: mengubah kode kursus (mis. PHP-01) menjadi nama kursus.
 * Jika kode tidak ditemukan, dikembalikan tanda strip.
 */
function namaKursus(array $courses, string $code): string
{
    return array_column($courses, 'name', 'code')[$code] ?? '-';
}
