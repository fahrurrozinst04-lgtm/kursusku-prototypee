# KursusKu - Proyek Semester Pemrograman Web III

Prototype aplikasi kursus berbasis PHP. Berjalan melalui Laragon di
`C:\laragon\www\kursusku-prototype` (URL: `http://kursusku-prototype.test/`).

## Alur Halaman

```
Landing (index.php) -> Katalog (#katalog) -> Daftar (registration.php) -> Hasil (process-registration.php)
                   \-> Estimasi Biaya (fee-calculator.php)
```

## Struktur Proyek

```
kursusku-prototype/
|-- index.php                 (P2 + P4 + P5: landing page + katalog data-driven)
|-- fee-calculator.php        (P3: kalkulator biaya + 5 test case)
|-- registration.php          (P5: form pendaftaran, 9 kontrol form)
|-- process-registration.php  (P5: menerima $_POST dan menampilkan ringkasan)
|-- helpers.php               (P4 + P5: rupiah, statusKursus, sisaKursi, formatTanggal, e, namaKursus)
|-- courses-data.php          (P4: data 6 kursus, dipakai bersama)
|-- server-time.php           (P2)
|-- test-functions.php        (P4: 6 test case function)
|-- docs/LANGKAH-PEMBUATAN.md (langkah pembuatan Pertemuan 2-5)
|-- assets/
|   |-- css/style.css         (P5: satu stylesheet untuk semua halaman)
|   |-- images/hero-kursus.jpg
|   `-- video/intro-kursus.mp4
`-- evidence/
    |-- week-02/ week-03/ week-04/   (screenshot pertemuan sebelumnya)
    `-- week-05/                     (test-matrix, local-vs-hosting, ai-usage-log, screenshot)
```

## Rumus Biaya (Pertemuan 3)

```
subtotal = fee x participantCount
discount = subtotal x discountPercent / 100
total    = subtotal - discount + adminFee
```

Semua nilai uang disimpan sebagai integer rupiah; format `Rp` hanya saat output.

## Milestone

- Milestone 2: Landing Page KursusKu (HTML semantik + PHP dasar).
- Milestone 3: Kalkulator estimasi biaya, tervalidasi 5 test case.
- Milestone 4: Katalog data-driven (array 6 kursus + foreach + function reusable + 6 test).
- Milestone 5: Form Pendaftaran (POST), CSS responsif, eksperimen GET/POST, konsep hosting.

## Batas Pertemuan 5

Belum ada: penyimpanan MySQL, CRUD, login, Laravel MVC, Ajax, validasi server dengan percabangan
(dibahas mulai Pertemuan 6).
