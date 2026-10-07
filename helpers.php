<?php
/**
 * helpers.php
 * Kumpulan function reusable untuk proyek KursusKu.
 * Pertemuan 4 - Sub-CPMK3 (fungsi string, date/time, function/procedure)
 * Pertemuan 5 - ditambah e() dan namaKursus()
 * Pertemuan 6 - ditambah formatRupiah(), findCourse(), getDiscountPercent(),
 *               getLearningModeLabel(), postString()
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

/* ==========================================================================
 * PERTEMUAN 6
 * ========================================================================== */

/**
 * Format rupiah gaya panduan Pertemuan 6 (tanpa spasi): Rp240.000
 */
function formatRupiah(int $amount): string
{
    return 'Rp' . number_format($amount, 0, ',', '.');
}

/**
 * Mencari satu kursus berdasarkan 'code' dengan foreach.
 * Mengembalikan array kursus, atau null jika tidak ditemukan.
 */
function findCourse(array $courses, string $code): ?array
{
    foreach ($courses as $course) {
        if ($course['code'] === $code) {
            return $course;
        }
    }

    return null;
}

/**
 * Aturan diskon (if/elseif): mahasiswa 20%, guru 15%, selain itu 0%.
 */
function getDiscountPercent(string $participantType): int
{
    if ($participantType === 'mahasiswa') {
        return 20;
    } elseif ($participantType === 'guru') {
        return 15;
    }

    return 0;
}

/**
 * Label metode belajar (switch).
 */
function getLearningModeLabel(string $mode): string
{
    switch ($mode) {
        case 'offline':
            return 'Tatap Muka';
        case 'online':
            return 'Online';
        case 'hybrid':
            return 'Hybrid';
        default:
            return 'Tidak diketahui';
    }
}

/**
 * Label tipe peserta untuk tampilan ringkasan.
 */
function getParticipantTypeLabel(string $type): string
{
    switch ($type) {
        case 'mahasiswa':
            return 'Mahasiswa';
        case 'guru':
            return 'Guru';
        case 'umum':
            return 'Umum';
        default:
            return 'Tidak diketahui';
    }
}

/**
 * Membaca satu field POST sebagai string yang sudah di-trim.
 * Aman terhadap key yang tidak ada ( ?? ) dan nilai yang bukan string
 * (mis. name[]=x dikirim manual), sehingga tidak muncul warning/TypeError.
 */
function postString(string $key, string $default = ''): string
{
    $value = $_POST[$key] ?? $default;

    return is_string($value) ? trim($value) : $default;
}

/**
 * Validasi pendaftaran (dipakai process.php dan test-matrix.php).
 * Mengembalikan daftar pesan error; array kosong berarti data valid.
 */
function validateRegistration(
    string $name,
    string $email,
    ?array $course,
    string $participantType,
    string $learningMode,
    int $packageCount,
    string $notes
): array {
    $errors = [];

    if ($name === '') {
        $errors[] = 'Nama wajib diisi.';
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = 'Format email tidak valid.';
    }

    if ($course === null) {
        $errors[] = 'Kursus tidak ditemukan.';
    }

    if (!in_array($participantType, ['mahasiswa', 'guru', 'umum'], true)) {
        $errors[] = 'Tipe peserta tidak valid.';
    }

    if (!in_array($learningMode, ['offline', 'online', 'hybrid'], true)) {
        $errors[] = 'Metode belajar tidak valid.';
    }

    if (!in_array($packageCount, [1, 2, 3], true)) {
        $errors[] = 'Jumlah paket tidak valid.';
    }

    if (mb_strlen($notes) > 300) {
        $errors[] = 'Catatan maksimal 300 karakter.';
    }

    return $errors;
}

/**
 * Perhitungan biaya: subtotal -> persen diskon -> nilai diskon -> total akhir.
 * Semua nilai integer rupiah.
 */
function calculateRegistration(int $fee, int $packageCount, string $participantType): array
{
    $discountPercent = getDiscountPercent($participantType);
    $grossTotal      = $fee * $packageCount;
    $discountAmount  = intdiv($grossTotal * $discountPercent, 100);

    return [
        'discountPercent' => $discountPercent,
        'grossTotal'      => $grossTotal,
        'discountAmount'  => $discountAmount,
        'finalTotal'      => $grossTotal - $discountAmount,
    ];
}

/**
 * Menyaring minat: hanya string dan hanya key yang ada di $options.
 * Mengembalikan array key valid (boleh kosong).
 */
function sanitizeInterests($raw, array $options): array
{
    if (!is_array($raw)) {
        return [];
    }

    return array_values(array_intersect(array_filter($raw, 'is_string'), array_keys($options)));
}
