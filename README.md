# LIMS One Water

LIMS (Laboratory Information Management System) One Water adalah sistem informasi laboratorium berbasis web yang dibangun untuk mengelola siklus hidup pengujian sampel lingkungan dan air. Sistem ini mencakup mulai dari penerimaan sampel (Sample Reception), penyimpanan (Biobanking), hingga berbagai macam pengujian mikrobiologi dan analisa konten.

Sistem ini dikembangkan menggunakan kerangka kerja **CodeIgniter 3 (PHP)** dengan antarmuka berbasis **AdminLTE** dan menggunakan **DataTables** untuk penyajian data sisi server (server-side).

---

## 🏗 Arsitektur & Teknologi Utama
*   **Framework:** CodeIgniter 3
*   **Frontend:** Bootstrap 3, AdminLTE Template
*   **Data Grid:** DataTables (Server-side processing)
*   **Konsep Navigasi:** Sistem ini banyak menggunakan model hirarki/nested views (contoh: *Index -> Detail -> Replikasi*).

### 🔄 Alur Navigasi (Best Practice)
Sistem ini menggunakan parameter **`return_url`** pada URL untuk mempertahankan status halaman navigasi lapis banyak (multi-layer). Hal ini mempermudah pengguna untuk kembali ke halaman sebelumnya secara akurat tanpa *broken link*.
*   **Client-Side:** View hanya perlu menyertakan parameter `return_url` yang disisipkan melalui JavaScript atau URL saat berpindah antar modul.
*   **Server-Side:** Controller bertanggung jawab mengumpulkan Entity ID terkait, lalu menyusun URL perantara (seperti `detail_url`) sebelum menampilkan tampilan di layar atau menyimpan data. Hal ini membuat URL transisi menjadi lebih pendek dan aman.

---

## 🧪 Alur Sistem & Modul Utama

Sistem ini dirancang untuk mengikuti alur fisik operasional laboratorium:

### 1. Sample Reception (Penerimaan Sampel)
*   Modul awal tempat sampel masuk, dicatat barcode/ID-nya, asal, dan tipe sampelnya.
*   Controller: `Sample_reception.php`

### 2. Biobankin & Biobankin Backup
*   Modul untuk mengelola penyimpanan (storage) sampel di laboratorium, termasuk manajemen lokasi rak, freezer, hingga alokasi barcode sekunder dan replikasi.
*   Controller: `Biobankin.php`, `BiobankinBackup.php`

### 3. Modul Pengujian (Assays & Tests)
Sistem memisahkan uji secara spesifik berdasarkan parameter biologis dan jenis matrik sampelnya:

*   **Uji Colilert:** `Colilert_hemoflow`, `Colilert_idexx_biosolids`, `Colilert_idexx_water`
*   **Uji Enterolert:** `Enterolert_hemoflow`, `Enterolert_idexx_biosolids`, `Enterolert_idexx_water`
*   **Uji Campylobacter (Campy):** `Campy_biosolids`, `Campy_biosolids_qpcr`, `Campy_hemoflow`, `Campy_hemoflow_qpcr`, `Campy_liquids`, `Campy_pa`
*   **Uji Salmonella:** `Salmonella_biosolids`, `Salmonella_hemoflow`, `Salmonella_liquids`, `Salmonella_pa`
*   **Analisa Lain:** `Moisture_content`, uji Ekstraksi (`Extraction_*`), dan `Sequencing`.

Setiap pengujian biasanya memiliki alur bertingkat: **Daftar Sampel > Detail Pengukuran Tabel > Form Input / Replikasi**.

### 4. Inventaris (Consumables)
*   Modul manajemen stok barang laboratorium (kit, reagen, bahan habis pakai).
*   Controller: `Consumables_in_stock`, `Consumables_new_order`, dll.

### 5. Master Data (Referensi)
*   Data statis dasar untuk dropdown dan preferensi.
*   Controller dimulai dengan awalan `Ref_` (misalnya: `Ref_client`, `Ref_location`, `Ref_sampletype`, `Ref_consumables`).

---

## 🛠 Panduan Developer (Standar & Ekstensi Sistem)
Bagi yang melanjutkan atau menambah fitur baru, mohon perhatikan standarisasi berikut:

1.  **Form & Aksi Kembali (Batal/Close):** 
    Pastikan semua tombol kembali menggunakan parameter URL *state* yang telah ditangkap, misalnya `$this->input->get('return_url')`. Jangan menulis paksa (hardcode) URL jika halaman ini dapat diakses dari halaman lain secara dinamis.
2.  **Controller Action:** 
    Gunakan `urldecode()` dan `urlencode()` secara bijak jika menangani state pada form submit lapis dalam.
3.  **CRUD Generator:** 
    Struktur dasar awal aplikasi ini dibantu dengan Garuda/HarviaCode Generator. Semua file terpusat mengikuti kaidah CodeIgniter MVC.

## 💾 Instalasi Lokal (Setup)
1.  **Clone repositori ini** ke folder *htdocs* atau *www* server lokal Anda (contoh XAMPP/MAMP).
2.  Lakukan instalasi melalui *composer*: `composer install`.
3.  Sesuaikan **Base URL** Anda pada `application/config/config.php`.
4.  Sesuaikan kredensial koneksi pangkalan data (database) pada konfigurasi `application/config/database.php`.
5.  Impor file `.sql` *(jika tersedia dalam dokumentasi serah terima project)*.

