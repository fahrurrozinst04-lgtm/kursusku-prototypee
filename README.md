# KursusKu - Proyek Semester Pemrograman Web III

Prototype aplikasi kursus berbasis PHP. Berjalan melalui Laragon di
`C:\laragon\www\kursusku-prototype` (URL: `http://kursusku-prototype.test/`).

## Alur Halaman

```
Landing (index.php) -> Daftar (register.php) -> Proses (process.php) -> Ringkasan -> History (history.php)
                   \-> Estimasi Biaya (fee-calculator.php)
```

## Struktur Proyek

```
kursusku-prototype/
|-- index.php                 (P2 + P4 + P5: landing page + katalog data-driven)
|-- fee-calculator.php        (P3: kalkulator biaya + 5 test case)
|-- registration.php          (P5, arsip: form pendaftaran 9 kontrol)
|-- process-registration.php  (P5, arsip: menampilkan ulang data POST)
|-- register.php              (P6: form lanjutan, kursus/minat/paket dari loop)
|-- process.php               (P6: validasi, diskon if/elseif, switch, ringkasan)
|-- data.php                  (P6: array courses, interestOptions, facilities)
|-- history.php               (P6: history dummy + foreach)
|-- loop-lab.php              (P6: for, while, do-while, foreach)
|-- test-matrix.php          (P6: halaman evidence, 12 skenario dihitung ulang tiap dibuka)
|-- helpers.php               (P4-P6: rupiah, statusKursus, sisaKursi, formatTanggal, e, namaKursus,
|                             formatRupiah, findCourse, getDiscountPercent, getLearningModeLabel, postString)
|-- courses-data.php          (P4: data 6 kursus, dipakai bersama)
|-- server-time.php           (P2)
|-- test-functions.php        (P4-P6: 19 test case function)
|-- docs/LANGKAH-PEMBUATAN.md (langkah pembuatan Pertemuan 2-6)
|-- assets/
|   |-- css/style.css         (P5: satu stylesheet untuk semua halaman)
|   |-- images/hero-kursus.jpg
|   `-- video/intro-kursus.mp4
`-- evidence/
    |-- week-02/ week-03/ week-04/   (screenshot pertemuan sebelumnya)
    |-- week-05/                     (test-matrix, local-vs-hosting, ai-usage-log, screenshot)
    `-- week-06/                     (test-matrix, refleksi, ai-usage-log, screenshot)
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
- Milestone 6: Alur pendaftaran lengkap tanpa database (validasi, diskon, switch, looping, history dummy).

## Batas Pertemuan 6

Belum ada: penyimpanan MySQL, CRUD, login, Laravel MVC, Ajax. Laravel dimulai Pertemuan 7.

## Catatan Data

`courses-data.php` (katalog 6 kursus, P4) dipakai untuk tabel katalog di `index.php`.
`data.php` (3 paket kursus) dipakai untuk form pendaftaran P6 sesuai panduan.
