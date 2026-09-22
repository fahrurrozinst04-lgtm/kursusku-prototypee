<?php
/**
 * helpers.php
 * Kumpulan function reusable untuk proyek KursusKu.
 * Pertemuan 4 - Sub-CPMK3 (fungsi string, date/time, function/procedure)
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
