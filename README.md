# Lab9Web
 Lab9Web - Aplikasi PHP Modular (CRUD & Routing)

Repository ini berisi hasil pengerjaan **Praktikum 9: Pemrograman Web (PHP Modular)**. Project ini menerapkan konsep modularisasi program dengan memisahkan konfigurasi database, template antarmuka (*views*), fungsi bantuan (*helpers*), modul fitur CRUD, serta sistem *routing* berbasis parameter URL yang aman (*whitelist*).

---

## 🎯 Tujuan Project

1. Menerapkan teknik modularisasi program PHP untuk memisahkan tanggung jawab setiap bagian kode.
2. Menggunakan konstruksi pemanggilan file PHP (`require_once`, `include`) secara tepat.
3. Membangun komponen template bersama (`header.php` dan `footer.php`) agar tampilan konsisten di seluruh halaman.
4. Membuat dan menggunakan kembali *function* PHP dengan parameter dan nilai kembalian (*return*) pada file *helper*.
5. Menata struktur direktori aplikasi web agar terorganisir dan mudah dipelihara.
6. Menerapkan *routing* sederhana berbasis URL (`index.php?page=...`) menggunakan validasi *whitelist* serta penanganan halaman `404 Not Found`.
7. Mengintegrasikan konsep modularisasi ke dalam aplikasi database CRUD.

---

## 🛠️ Kebutuhan Perangkat

Untuk menjalankan aplikasi ini secara lokal, dibutuhkan perangkat lunak berikut:
* **Web Server:** Apache (melalui XAMPP, Laragon, atau sejenisnya) dengan dukungan `mod_rewrite`.
* **PHP:** Versi 7.4 atau 8.x.
* **Database:** MySQL / MariaDB.
* **Browser:** Google Chrome, Mozilla Firefox, Microsoft Edge, dll.
* **Code Editor:** Visual Studio Code atau sejenisnya.

---

## 📁 Struktur Direktori Aplikasi

Struktur direktori pada project ini disusun mengikuti acuan modularisasi standar (Bagian F):

```text
Lab9Web/
├── index.php               # Titik masuk utama aplikasi dan pengatur routing (router)
├── .htaccess               # (Opsional) Konfigurasi URL rewrite agar URL lebih ringkas
├── config/
│   └── database.php        # Konfigurasi dan koneksi ke database MySQL
├── views/
│   ├── header.php          # Template bagian atas (HTML head, judul, navigasi)
│   ├── footer.php          # Template bagian bawah (penutup HTML & copyright)
│   ├── dashboard.php       # Halaman utama / beranda aplikasi
│   └── 404.php             # Halaman pesan error jika rute tidak ditemukan
├── helpers/
│   └── functions.php       # Kumpulan fungsi umum (format rupiah, escaping, validasi, dll.)
├── modules/
│   ├── user/               # Modul fitur manajemen data pengguna (CRUD)
│   │   ├── list.php        # Menampilkan daftar data pengguna (Read)
│   │   ├── add.php         # Form dan proses tambah data pengguna (Create)
│   │   ├── edit.php        # Form dan proses ubah data pengguna (Update)
│   │   └── delete.php      # Proses hapus data pengguna (Delete)
│   └── auth/               # Modul autentikasi pengguna
│       ├── login.php       # Halaman dan proses login
│       └── logout.php      # Proses logout dan hapus sesi
├── assets/
│   ├── css/
│   │   └── style.css       # File stylesheet utama
│   └── js/                 # File JavaScript pendukung
└── screenshots/            # Folder dokumentasi gambar hasil praktikum
```

---

## 🚦 Daftar Rute (*Routing*)

Aplikasi menggunakan pola URL `index.php?page=<nama_rute>` yang divalidasi melalui array *whitelist* pada `index.php`:

| Parameter `page` | File Target | Keterangan |
| :--- | :--- | :--- |
| *(kosong)* / `dashboard` | `views/dashboard.php` | Menampilkan halaman utama / beranda |
| `user/list` | `modules/user/list.php` | Menampilkan daftar pengguna dari database |
| `user/add` | `modules/user/add.php` | Menampilkan form tambah pengguna baru |
| `user/edit` | `modules/user/edit.php` | Menampilkan form edit data pengguna |
| `user/delete` | `modules/user/delete.php` | Memproses penghapusan data pengguna |
| `auth/login` | `modules/auth/login.php` | Menampilkan halaman login |
| `auth/logout` | `modules/auth/logout.php` | Mengakhiri sesi login pengguna |
| *(Rute tidak terdaftar)* | `views/404.php` | Menampilkan status HTTP 404 Not Found |

---

## 🚀 Cara Menjalankan Aplikasi

1. **Clone atau Salin Repository**
   Letakkan folder `Lab9Web` ke dalam direktori *docroot* web server Anda (misalnya `C:\xampp\htdocs\Lab9Web` atau `C:\laragon\www\Lab9Web`).
2. **Konfigurasi Database**
   * Jalankan layanan **Apache** dan **MySQL** melalui panel kontrol XAMPP/Laragon.
   * Buka `phpMyAdmin` (`http://localhost/phpmyadmin`), lalu buat database baru (misalnya `db_latihan`).
   * Import file SQL dari praktikum sebelumnya atau buat tabel pengguna yang sesuai.
   * Sesuaikan kredensial database (`$host`, `$db`, `$user`, `$pass`) di dalam file `config/database.php`.
3. **Akses Melalui Browser**
   * Buka browser dan kunjungi: `http://localhost/Lab9Web/index.php`
   * Gunakan menu navigasi untuk menguji fitur Dashboard, Daftar Pengguna, Tambah, Ubah, dan Hapus data.

---

## 📝 Langkah-Langkah Praktikum

1. **Inisialisasi Direktori:** Membuat struktur folder utama (`config`, `views`, `helpers`, `modules`, `assets`) di dalam repository `Lab9Web`.
2. **Pembuatan Template Layout:** Memisahkan bagian pembuka HTML beserta navigasi ke `views/header.php` dan bagian penutup ke `views/footer.php`, serta menambahkan styling pada `assets/css/style.css`.
3. **Pembuatan Library Function:** Membuat fungsi-fungsi yang dapat digunakan ulang (seperti `formatRupiah()`, `hitungDiskon()`, `validasiEmail()`, `ringkasTeks()`, dan fungsi keamanan `e()`) di dalam `helpers/functions.php`.
4. **Implementasi Router Aman:** Membangun sistem *routing* pada `index.php` menggunakan daftar *whitelist* rute dan menyiapkan halaman `views/404.php` untuk menangani parameter URL yang tidak valid.
5. **Integrasi Aplikasi CRUD:** Memindahkan file koneksi database ke `config/database.php`, memecah fitur CRUD ke dalam folder `modules/user/`, dan memperbarui seluruh tautan aksi (`href` dan `action`) agar mengarah ke `index.php?page=...`.
6. **Pengujian:** Memastikan seluruh halaman tampil konsisten dengan satu template, operasi CRUD berjalan normal, serta pengujian keamanan rute ilegal menampilkan halaman 404.

---

## 📸 Dokumentasi & Screenshot

> *Catatan: Pastikan Anda menyimpan file gambar hasil tangkapan layar ke dalam folder `screenshots/` sesuai nama file di bawah ini sebelum melakukan commit.*

* **Struktur Direktori Project**
  ![Struktur Direktori](screenshots/01-struktur-direktori.png)
* **Tampilan Halaman Dashboard & Template**
  ![Halaman Dashboard](screenshots/02-dashboard.png)
* **Pengujian Routing & Halaman 404**
  ![Halaman 404](screenshots/03-routing-404.png)
* **Hasil Pengujian Fitur CRUD (List, Tambah, Edit, Hapus)**
  ![Halaman CRUD](screenshots/04-crud-list.png)

---

## 🐛 Kendala yang Ditemukan dan Cara Mengatasinya

| No | Kendala yang Ditemukan | Penyebab | Cara Mengatasi |
| :--- | :--- | :--- | :--- |
| 1 | **Error `Failed opening required`** saat memanggil file dari dalam folder `modules/` | Penggunaan path relatif (`../`) menjadi tidak konsisten ketika file dipanggil melalui `index.php`. | Menggunakan konstanta magic `__DIR__` (contoh: `require_once __DIR__ . '/config/database.php';`) agar path selalu merujuk pada lokasi absolut direktori file. |
| 2 | **Error `Cannot redeclare function`** pada `helpers/functions.php` | File `functions.php` dipanggil lebih dari satu kali oleh `index.php` dan file modul secara bersamaan. | Mengganti pemanggilan `include` atau `require` menjadi `require_once` untuk mencegah deklarasi ulang fungsi. |
| 3 | **File CSS tidak termuat** saat mengakses rute modul | Path relatif menuju file CSS berubah saat struktur URL diakses dari lokasi berbeda. | Menggunakan path yang konsisten dari *root* project (misalnya `assets/css/style.css`) pada `views/header.php`. |

---

## 📚 Jawaban Pertanyaan Pemahaman (Bagian L)

Berikut adalah jawaban lengkap untuk pertanyaan evaluasi pada **Bagian L**:

1. **Jelaskan pengertian modularisasi program dan minimal tiga manfaatnya.**
   * **Pengertian:** Modularisasi program adalah teknik memecah atau membagi sebuah aplikasi besar menjadi bagian-bagian kecil (modul) yang independen, di mana setiap file/modul memiliki fungsi dan tanggung jawab yang spesifik.
   * **Manfaat:**
     1. *Reusability (Dapat digunakan ulang):* Komponen seperti header, footer, koneksi database, dan fungsi validasi cukup ditulis satu kali dan dapat dipanggil di banyak halaman.
     2. *Maintainability (Kemudahan pemeliharaan):* Jika terjadi perubahan tampilan atau perbaikan *bug*, cukup mengubah satu file modul terkait tanpa harus menyunting seluruh halaman.
     3. *Kolaborasi Tim & Keterbacaan Kode:* Kode lebih rapi, terstruktur, dan memudahkan pembagian tugas antar-developer tanpa risiko konflik pada satu file raksasa.

2. **Apa perbedaan `include` dan `require` ketika file yang dipanggil tidak ditemukan?**
   * **`include`:** Menghasilkan pesan peringatan (*E_WARNING*), tetapi eksekusi skrip PHP tetap dilanjutkan hingga baris terakhir.
   * **`require`:** Menghasilkan kesalahan fatal (*E_COMPILE_ERROR*), dan eksekusi skrip PHP langsung dihentikan seketika pada baris tersebut.

3. **Mengapa `require_once` sesuai digunakan untuk memuat konfigurasi database?**
   * Karena koneksi database adalah komponen inti yang **wajib ada** agar aplikasi berjalan (sehingga harus menggunakan `require`), sekaligus **tidak boleh dimuat lebih dari sekali** (sehingga membutuhkan `_once`) agar tidak memboroskan sumber daya koneksi atau memicu error pendefinisian ulang variabel/konstanta.

4. **Jelaskan perbedaan parameter, argumen, dan nilai return pada function.**
   * **Parameter:** Variabel placeholder yang ditulis di dalam tanda kurung saat *mendeklarasikan* sebuah function.
   * **Argumen:** Nilai atau data nyata yang dikirimkan ke dalam function saat function tersebut *dipanggil*.
   * **Nilai Return:** Hasil akhir pemrosesan yang dikembalikan oleh function ke bagian kode pemanggilnya menggunakan kata kunci `return`, sehingga nilainya dapat disimpan ke dalam variabel atau diolah kembali.

5. **Mengapa header dan footer sebaiknya dipisahkan dari konten halaman?**
   * Karena header dan footer merupakan elemen antarmuka yang sama dan berulang di setiap halaman. Memisahkannya menghindari duplikasi kode, menjaga konsistensi desain antarmuka, dan mempermudah pembaruan menu navigasi atau informasi *copyright* dari satu tempat saja.

6. **Apa fungsi `index.php` pada pola routing yang dipraktikkan?**
   * `index.php` berfungsi sebagai **titik masuk tunggal (*single entry point* / *front controller*)** sekaligus **router**. File ini bertugas membaca parameter URL (`$_GET['page']`), memvalidasi rute tujuan, lalu menyusun halaman utuh dengan menggabungkan `header.php`, file konten modul yang diminta, dan `footer.php`.

7. **Mengapa router sebaiknya menggunakan whitelist rute?**
   * Untuk memastikan hanya daftar halaman resmi yang telah didefinisikan oleh pengembang saja yang boleh diakses oleh pengguna. Jika parameter URL tidak ada dalam daftar *whitelist*, aplikasi dapat menolaknya secara aman dengan menampilkan halaman `404 Not Found`.

8. **Apa risiko jika input `page` langsung digabungkan menjadi path file yang di-`require`?**
   * Berisiko tinggi membuka celah keamanan **Local File Inclusion (LFI) / Path Traversal** (misalnya pengguna memasukkan parameter `?page=../../etc/passwd` atau mengakses file konfigurasi sensitif di server), serta berpotensi memicu error sistem jika file tidak ada.

9. **Apa fungsi aturan `RewriteCond` dan `RewriteRule` pada `.htaccess`?**
   * **`RewriteCond` (Rewrite Condition):** Menetapkan syarat atau kondisi sebelum aturan pengalihan dijalankan. Contohnya `%{REQUEST_FILENAME} !-f` dan `!-d` memastikan bahwa jika pengguna meminta file statis (seperti gambar/CSS) atau direktori yang benar-benar ada secara fisik, Apache akan langsung melayaninya tanpa dialihkan.
   * **`RewriteRule` (Rewrite Rule):** Menentukan pola URL dan tujuan pengalihannya. Contohnya `^(.+)$ index.php?page=$1 [QSA,L]` mengalihkan seluruh permintaan URL yang rapi (seperti `/user/list`) ke `index.php?page=user/list` di balik layar.

10. **Sebutkan bagian aplikasi CRUD yang paling tepat dipindahkan ke `config`, `views`, `helpers`, dan `modules`.**
    * **`config`:** Pengaturan kredensial dan skrip koneksi database (`database.php`) serta konstanta pengaturan aplikasi.
    * **`views`:** Komponen antarmuka yang bersifat umum/statis seperti `header.php`, `footer.php`, `dashboard.php`, dan halaman error `404.php`.
    * **`helpers`:** Fungsi-fungsi bantuan umum yang dapat dipakai di berbagai fitur, seperti fungsi *escaping* HTML (`e()`), format mata uang (`formatRupiah()`), format tanggal, atau validasi input (`functions.php`).
    * **`modules`:** File-file yang menangani logika bisnis spesifik per fitur/entitas, seperti halaman tampilan data (`list.php`), form dan proses tambah (`add.php`), edit (`edit.php`), dan hapus (`delete.php`) di dalam `modules/user/`.
