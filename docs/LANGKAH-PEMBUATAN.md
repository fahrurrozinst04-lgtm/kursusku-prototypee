# Langkah Pembuatan KursusKu (Pertemuan 2 - 6)

Proyek tunggal: `C:\laragon\www\kursusku-prototype`. Setiap pertemuan **melanjutkan** file
pertemuan sebelumnya, tidak membuat proyek baru.

## Ringkasan Perkembangan per Pertemuan

| Pertemuan | Hasil | File utama |
|-----------|-------|------------|
| 2 | Landing page HTML semantik + PHP dasar | `index.php`, `server-time.php` |
| 3 | Kalkulator estimasi biaya + 5 test case | `fee-calculator.php` |
| 4 | Katalog data-driven, function reusable, 6 test | `helpers.php`, `test-functions.php`, `index.php` |
| 5 | Form pendaftaran (POST), CSS responsif, GET/POST, hosting | `registration.php`, `process-registration.php`, `assets/css/style.css` |
| 6 | Alur lengkap: form lanjutan, diskon (if/elseif), label (switch), looping, history dummy | `data.php`, `register.php`, `process.php`, `history.php`, `loop-lab.php` |

---

## Bagian 0 - Persiapan

1. Aktifkan **Laragon** (Start All), buka folder proyek di **VS Code** (buka *folder*, bukan satu file).
2. Backup kondisi minggu 4: `git add . ; git commit -m "backup: kondisi minggu 4"`.
3. Pastikan `index.php`, `helpers.php`, dan katalog dari Pertemuan 4 masih berjalan.
4. Buat folder: `assets/css` dan `evidence/week-05`.

## Bagian 1 - Rapikan fondasi (perbaikan dari pertemuan lama)

1. **Gambar hero**: `index.php` memanggil `assets/images/hero-kursus.jpg`, sedangkan file di folder
   bernama `hero-kursus.jpg.jpeg`. Ganti nama menjadi `hero-kursus.jpg`.
2. **Folder evidence**: `revidance/` diganti menjadi `evidence/`, dan `weak-02` menjadi `week-02`
   agar sama dengan README dan panduan.
3. **Data katalog** dipindah dari `index.php` ke `courses-data.php` supaya dipakai bersama oleh
   katalog, form, dan halaman hasil (satu sumber data, tidak duplikat).
4. `helpers.php` ditambah dua function: `e()` (escape output) dan `namaKursus()`.

## Bagian 2 - CSS global (`assets/css/style.css`)

1. Salin blok **global** (variabel warna, `container`, header, nav, `page-intro`, `eyebrow`).
2. Lanjutkan blok **form dan responsif** dari panduan (`form-card`, `form-grid`, input, `choice`,
   tombol, `alert-success`, `summary-list`, `@media (max-width: 640px)`).
3. Pindahkan seluruh `<style>` di `index.php` dan `fee-calculator.php` ke file ini, lalu ganti dengan
   `<link rel="stylesheet" href="assets/css/style.css">`. Hasilnya semua halaman memakai palet yang sama.

## Bagian 3 - Navigasi

Setiap halaman memakai header yang sama, alur **Beranda -> Katalog -> Daftar Kursus**:

```html
<nav aria-label="Navigasi utama">
  <a href="index.php">Beranda</a>
  <a href="index.php#katalog">Katalog</a>
  <a href="fee-calculator.php">Estimasi Biaya</a>
  <a href="registration.php">Daftar Kursus</a>
</nav>
```

## Bagian 4 - `registration.php` (9 kontrol form)

| No | Kontrol | Field (`name`) |
|----|---------|----------------|
| 1 | hidden | `source` (nilai `week-05`) |
| 2 | text | `name`, `study_program` |
| 3 | email | `email` |
| 4 | tel | `phone` |
| 5 | select | `course` |
| 6 | radio | `participant_type` |
| 7 | checkbox | `interests[]` |
| 8 | textarea | `note` |
| 9 | button | submit |

Aturan yang dipakai: setiap field punya `<label for>` yang cocok dengan `id`; `name` adalah key untuk
`$_POST`; `required`, `minlength`, `maxlength`, `autocomplete` dipakai secara relevan; method akhir **POST**.

Peningkatan pada proyek ini: pilihan kursus dibentuk dari katalog, kursus **Penuh** tidak bisa dipilih,
dan tautan **Daftar** di katalog (`registration.php?course=PHP-01`) memilih kursus otomatis. Ini contoh
GET yang tepat: URL dapat dibagikan dan tidak mengubah data.

## Bagian 5 - `process-registration.php`

1. Ambil data: `trim($_POST['name'] ?? '')` dan seterusnya. `?? ''` memberi nilai kosong jika key tidak ada.
2. Checkbox berupa array, digabung dengan `implode(', ', $interests)`.
3. Kode kursus diubah menjadi nama dengan `namaKursus()`.
4. Semua output dibungkus `e()` (`htmlspecialchars`) agar input seperti `<script>` tampil sebagai teks.
5. Belum ada penyimpanan database (materi setelah fondasi form).

## Bagian 6 - Eksperimen GET vs POST (wajib, untuk evidence)

1. Ubah sementara `method="POST"` menjadi `method="GET"` di `registration.php`, isi data latihan, kirim.
2. Amati address bar: data muncul setelah tanda `?`. Screenshot menjadi `04-get-url.png`.
3. **Kembalikan ke POST**, kirim lagi, URL tidak lagi memuat data.
4. Ingat: POST tidak otomatis terenkripsi. Kerahasiaan saat transit membutuhkan HTTPS.

## Bagian 7 - Pengujian dan evidence

1. Jalankan `test-functions.php` (sekarang 9 test, semua harus PASS) dan `fee-calculator.php` (5 PASS).
2. Isi `evidence/week-05/test-matrix.txt` **setelah** menguji sendiri di browser (status Lulus / Perlu Perbaikan).
3. Uji mobile: F12 -> Device Toolbar -> sekitar 360 px. Form harus satu kolom dan tanpa horizontal scroll.
4. Screenshot ke `evidence/week-05/`:

```
01-form-desktop.png   02-form-mobile.png   03-post-result.png
04-get-url.png        05-navigation.png
```

5. Lengkapi `local-vs-hosting.txt` dengan kata-kata sendiri; isi `ai-usage-log.txt` bila memakai AI.
6. Commit: `git add . ; git commit -m "milestone 5: form pendaftaran, css responsif, get/post"` lalu `git push`.

## Bagian 8 - Checklist akhir Milestone 5

- [ ] `registration.php` terbuka, semua field utama punya label
- [ ] Minimal 6 jenis kontrol form (proyek ini: 9)
- [ ] Method akhir POST
- [ ] `process-registration.php` menampilkan data sesuai input, di-escape dengan `e()`
- [ ] CSS konsisten di semua halaman dan responsif di 360 px
- [ ] Evidence week-05 lengkap
- [ ] Bisa menjelaskan tanpa membaca: `name` vs `id`, GET vs POST, local vs hosting

## Troubleshooting cepat

| Gejala | Periksa |
|--------|---------|
| PHP tampil sebagai teks | Buka lewat `http://kursusku-prototype.test/`, bukan `file:///` |
| CSS tidak berubah | Path `assets/css/style.css`, refresh `Ctrl+F5` |
| Data kosong di hasil | `name` di form harus sama dengan key `$_POST[...]` |
| Checkbox hanya satu nilai | Pastikan `name="interests[]"` |
| Data terlihat di URL | Method masih GET, kembalikan ke POST |
| Gambar hero tidak muncul | Nama file harus `hero-kursus.jpg` |


---

# PERTEMUAN 6 - Percabangan, Looping, dan Form Lanjutan

Alur akhir: `index.php` -> `register.php` -> `process.php` (validasi + hitung) -> ringkasan -> `history.php`.
Tanpa database.

## Bagian P6-0 - Persiapan

1. Backup kondisi minggu 5: `git add . ; git commit -m "backup: kondisi minggu 5"`.
2. Buat folder `evidence/week-06`.
3. Pertemuan 5 tetap utuh sebagai arsip (`registration.php`, `process-registration.php`). Alur utama
   sekarang memakai `register.php` dan `process.php`; seluruh tautan navigasi sudah diarahkan ke sana.

## Bagian P6-1 - `data.php` (array + looping)

Pindahkan data ke array: `$courses` (code, name, fee), `$interestOptions` (key => label), `$facilities`.
Prinsip: ubah data di satu tempat, tampilan ikut berubah karena dirender dengan `foreach`.
*Checkpoint:* ubah nama satu kursus, refresh `register.php`, nama ikut berubah.

## Bagian P6-2 - Tambah fungsi di `helpers.php` (satu per satu, jalankan tiap selesai)

| Fungsi | Latihan | Catatan |
|--------|---------|---------|
| `formatRupiah()` | format output | hasil `Rp240.000` (tanpa spasi, beda dengan `rupiah()` P4) |
| `findCourse()` | `foreach` + `return` | `null` jika kode tidak ada |
| `getDiscountPercent()` | `if / elseif / else` | mahasiswa 20, guru 15, lainnya 0 |
| `getLearningModeLabel()` | `switch` | `default` untuk nilai tak sah |
| `postString()` | `??` + `trim` | tambahan: aman jika field dikirim sebagai array |

## Bagian P6-3 - `register.php` (form lanjutan)

| Kontrol | `name` | Catatan |
|---------|--------|---------|
| text, email | `name`, `email` | `required` |
| select (foreach) | `course_code` | opsi dari `$courses` |
| radio | `participant_type` | satu `name` untuk satu grup, `required` |
| checkbox (foreach) | `interests[]` | `[]` agar PHP menerima array |
| select | `learning_mode` | offline / online / hybrid |
| select (for) | `package_count` | angka 1-3 dari `for ($i = 1; $i <= 3; $i++)` |
| textarea | `notes` | `maxlength="300"` |

Daftar fasilitas juga ditampilkan dengan `foreach`.

## Bagian P6-4 - `process.php` (urutan kerja)

1. **Guard:** jika bukan POST -> `header('Location: register.php'); exit;` (sebelum ada output HTML).
2. **Baca input:** `postString()`; `package_count` di-cast `(int)`; `interests` dipastikan array lalu
   disaring dengan `array_intersect` terhadap key yang diizinkan.
3. **Validasi:** kumpulkan pesan ke `$errors` (nama, email, kursus, tipe, metode, paket, panjang catatan).
4. **Jika `$errors !== []`:** tampilkan daftar dengan `foreach`, lalu `exit` agar perhitungan tidak jalan
   dengan data rusak.
5. **Hitung biaya:** biaya satuan -> jumlah paket -> subtotal (`$grossTotal`) -> persen diskon ->
   nilai diskon (`intdiv`) -> total akhir.
6. **Ringkasan:** tampil data peserta, rincian biaya, dan minat; semua teks lewat `e()`.

Contoh: PHP Dasar, Mahasiswa, 1 paket -> 400.000 - 20% = **Rp320.000**.

## Bagian P6-5 - `history.php` dan `loop-lab.php`

- `history.php`: array dummy 3 record, ditampilkan dengan `foreach ($history as $index => $item)`.
- `loop-lab.php`: `for`, `while`, `do-while` (batas `$limit = 5`; ganti ke 3 lalu jelaskan bagian
  yang menghentikan loop), plus perbandingan do-while minimal berjalan sekali, dan `foreach`.

## Bagian P6-6 - Pengujian dan evidence

1. Buka `test-functions.php`: 19 test, semua harus PASS.
2. Jalankan 12 skenario di `evidence/week-06/test-matrix.txt`. Kolom "Uji otomatis" sudah terisi dari
   pengecekan skrip; kolom "Status browser" Anda isi sendiri.
3. Screenshot minimum di `evidence/week-06/`: form lengkap, ringkasan mahasiswa, ringkasan guru/umum,
   beberapa checkbox, minat kosong tanpa warning, history dummy.
4. Isi `refleksi.txt` (bahasa sendiri) dan `ai-usage-log.txt` bila memakai AI.
5. Commit: `git add . ; git commit -m "milestone 6: percabangan, looping, form lanjutan"` lalu `git push`.

## Bagian P6-7 - Halaman `test-matrix.php` (menu Test Matrix)

1. Pindahkan validasi dan hitung biaya dari `process.php` ke `helpers.php`:
   `validateRegistration()`, `calculateRegistration()`, `sanitizeInterests()`.
   `process.php` dan `test-matrix.php` memakai fungsi yang sama.
2. Di `test-matrix.php`, tulis 12 skenario sebagai array `[skenario, actual, expected]`.
   *Actual* dihitung dari fungsi, *expected* ditulis manual dari panduan.
3. Status: `PASS` bila `$actual === $expected`, selain itu `FAIL`. Ringkasan dihitung dengan `count(array_filter(...))`.
4. Skenario 11 (redirect GET) dan 12 (fasilitas lewat foreach) diperiksa dari kode sumber; keduanya tetap
   perlu Anda coba sendiri di browser untuk screenshot.
5. Menu **Test Matrix** dan **Riwayat** ditambahkan di navigasi semua halaman.

## Checklist akhir Milestone 6

- [ ] Form POST ke `process.php`; radio grup bekerja; checkbox `interests[]`
- [ ] Kursus dan jumlah paket dirender dari loop
- [ ] Diskon mahasiswa/guru/umum benar; `switch` dipakai untuk metode belajar
- [ ] Minat kosong tanpa warning; output di-escape
- [ ] `history.php` dan `loop-lab.php` berjalan
- [ ] Evidence week-06 lengkap; bisa menjelaskan: radio vs checkbox, kenapa `[]`, kenapa `foreach`,
      urutan hitung total, fungsi `??`, `htmlspecialchars()`, alasan belum memakai database

## Troubleshooting P6

| Gejala | Periksa |
|--------|---------|
| `Undefined array key "interests"` | pakai `$_POST['interests'] ?? []` |
| `foreach() argument must be of type array` | `name="interests[]"` dan cek `is_array()` |
| `Call to undefined function` | `require __DIR__ . '/helpers.php';` belum ada |
| Semua peserta diskon sama | `value` radio dan operator `===` |
| Total salah | `$packageCount` harus integer |
| Warning `headers already sent` | redirect harus sebelum HTML/echo |
| `Kursus tidak ditemukan` | `value` option harus sama dengan `code` di `data.php` |
