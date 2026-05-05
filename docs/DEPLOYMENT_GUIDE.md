# Deployment Guide - Supplementary PDF Extraction Feature

## 🎯 Overview
Fitur ini mengekstrak data dari PDF supplementary menggunakan Python script dan menyimpannya ke database untuk auto-populate form Microbial.

---

## ⚠️ PERUBAHAN YANG PERLU DILAKUKAN SEBELUM PUSH KE SERVER

### 1. **Kembalikan Path Upload ke Windows Path**

**File**: `application/controllers/Scan_page.php`

**Baris ~431** - Ubah dari:
```php
$upload_path = './uploads/supplementary/';
```

**Menjadi**:
```php
$upload_path = 'C:\\onewater\\supplementary\\';
```

**Baris ~479** - Ubah PYTHONPATH dari:
```php
$pythonpath = '/Users/dhiyaulhaq/Library/Python/3.9/lib/python/site-packages';
```

**Menjadi** (sesuaikan dengan lokasi Python di server):
```php
$pythonpath = 'C:\\Python39\\Lib\\site-packages';
```

**Baris ~478** - Ubah Python path dari:
```php
$python_path = '/usr/bin/python3';
```

**Menjadi**:
```php
$python_path = 'C:\\Python39\\python.exe';
```

---

## 🖥️ INSTALASI DI SERVER WINDOWS

### Step 1: Install Python 3.9+

1. **Download Python**
   - Kunjungi: https://www.python.org/downloads/windows/
   - Download Python 3.9 atau lebih baru (64-bit recommended)

2. **Install Python**
   - ✅ **PENTING**: Centang "Add Python to PATH"
   - Pilih "Install Now" atau "Customize installation"
   - Lokasi default: `C:\Python39\` atau `C:\Users\[Username]\AppData\Local\Programs\Python\Python39\`

3. **Verifikasi Instalasi**
   ```cmd
   python --version
   ```
   Seharusnya menampilkan: `Python 3.9.x`

### Step 2: Install Library Python yang Dibutuhkan

Buka Command Prompt (CMD) sebagai Administrator:

```cmd
python -m pip install --upgrade pip
python -m pip install pdfplumber
```

**Verifikasi instalasi**:
```cmd
python -c "import pdfplumber; print('pdfplumber version:', pdfplumber.__version__)"
```

Seharusnya menampilkan: `pdfplumber version: 0.11.8` (atau versi terbaru)

### Step 3: Cek Lokasi Python dan Library

```cmd
where python
python -m pip show pdfplumber
```

Catat lokasi:
- **Python executable**: Contoh `C:\Python39\python.exe`
- **Site-packages**: Contoh `C:\Python39\Lib\site-packages`

### Step 4: Update Path di Code

Edit file `application/controllers/Scan_page.php`:

```php
// Line ~478
$python_path = 'C:\\Python39\\python.exe'; // Sesuaikan dengan hasil 'where python'

// Line ~479
$pythonpath = 'C:\\Python39\\Lib\\site-packages'; // Sesuaikan dengan hasil 'pip show pdfplumber'
```

### Step 5: Buat Folder Upload di Server

```cmd
mkdir C:\onewater\supplementary
```

Atau buat manual melalui Windows Explorer.

**Set Permissions**:
- Klik kanan folder → Properties → Security
- Pastikan user web server (IIS_IUSRS atau NETWORK SERVICE) punya akses Write

### Step 6: Upload Files ke Server

Upload file-file berikut:
```
/scripts/extract_pdf_tables.py
/application/controllers/Scan_page.php
/application/controllers/Microbial.php
/application/models/Supplementary_extraction_model.php
/application/views/microbial/index.php
/application/views/scan_page/supplementary.php
```

### Step 7: Jalankan Database Migration

Jalankan SQL berikut di database server:

```sql
CREATE TABLE IF NOT EXISTS `supplementary_extraction_results` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `id_project` VARCHAR(50) NOT NULL COMMENT 'Project ID (e.g., MU2500040)',
  `id_one_water_sample` VARCHAR(50) NOT NULL COMMENT 'Sample ID (e.g., P2500212)',
  `table_name` VARCHAR(100) NOT NULL COMMENT 'Table name from PDF (Table 1, 2, or 3)',
  `source_name` VARCHAR(50) NOT NULL COMMENT 'Source name (Human, Bird, Dog, etc.)',
  `percentage_value` DECIMAL(10,2) DEFAULT NULL COMMENT 'Percentage value',
  `page_source` INT(11) DEFAULT NULL COMMENT 'PDF page number',
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `idx_project` (`id_project`),
  KEY `idx_sample` (`id_one_water_sample`),
  KEY `idx_project_sample` (`id_project`, `id_one_water_sample`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Stores extracted data from supplementary PDF files';
```

### Step 8: Test di Server

1. **Test Python Script Manual**
   ```cmd
   cd C:\path\to\project
   python scripts\extract_pdf_tables.py C:\onewater\supplementary\test.pdf MU2500040
   ```

2. **Test Upload PDF**
   - Buka Sample Reception
   - Upload PDF supplementary
   - Check log untuk error

3. **Test Populate**
   - Buka form Microbial
   - Pilih sample yang sudah ada PDF-nya
   - Klik "Populate Supplementary"

---

## 🔧 TROUBLESHOOTING

### Problem 1: "Python not found"
**Solution**:
- Pastikan Python sudah di-install
- Cek path di `Scan_page.php` sudah benar
- Gunakan full path: `C:\\Python39\\python.exe`

### Problem 2: "pdfplumber not installed"
**Solution**:
```cmd
python -m pip install pdfplumber
```

Jika masih error, install dengan full path:
```cmd
C:\Python39\python.exe -m pip install pdfplumber
```

### Problem 3: "Permission denied" saat upload
**Solution**:
- Pastikan folder `C:\onewater\supplementary\` ada
- Set permissions untuk IIS user:
  ```cmd
  icacls C:\onewater\supplementary /grant "IIS_IUSRS:(OI)(CI)F" /T
  ```

### Problem 4: "No data extracted"
**Solution**:
- Cek format PDF apakah sesuai
- Test script Python manual
- Cek log di `application/logs/`

### Problem 5: Architecture mismatch (32-bit vs 64-bit)
**Solution**:
- Pastikan Python dan PHP sama-sama 64-bit atau 32-bit
- Reinstall Python dengan arsitektur yang sesuai

---

## 📝 CHECKLIST SEBELUM DEPLOYMENT

- [ ] Kembalikan path upload ke `C:\\onewater\\supplementary\\`
- [ ] Update Python path ke Windows path
- [ ] Update PYTHONPATH ke Windows path
- [ ] Test semua perubahan di local (Mac) masih berfungsi
- [ ] Commit dan push ke repository
- [ ] Backup database production
- [ ] Install Python di server
- [ ] Install pdfplumber di server
- [ ] Buat folder upload di server
- [ ] Set permissions folder
- [ ] Upload files ke server
- [ ] Jalankan database migration
- [ ] Test upload PDF di server
- [ ] Test populate data di server
- [ ] Monitor log untuk error

---

## 📂 FILES YANG DIUBAH/DITAMBAHKAN

### New Files:
- `scripts/extract_pdf_tables.py` - Python script untuk ekstraksi PDF
- `application/models/Supplementary_extraction_model.php` - Model untuk data extraction
- `database_migration_supplementary_extraction.sql` - SQL migration

### Modified Files:
- `application/controllers/Scan_page.php` - Upload & extraction logic
- `application/controllers/Microbial.php` - API endpoint & populate logic
- `application/views/microbial/index.php` - Form fields & JavaScript
- `application/views/scan_page/supplementary.php` - Upload interface

---

## 🔐 SECURITY NOTES

1. **Python Execution**: Script Python dijalankan via PHP `exec()` - pastikan input di-sanitize
2. **File Upload**: Validasi file type dan size
3. **Database**: Gunakan prepared statements (sudah implemented di model)
4. **Permissions**: Minimal permissions untuk folder upload

---

## 📞 SUPPORT

Jika ada masalah saat deployment:
1. Check log di `application/logs/log-YYYY-MM-DD.php`
2. Test Python script manual
3. Verifikasi permissions folder
4. Check PHP error log

---

## 🎉 SETELAH DEPLOYMENT BERHASIL

Fitur yang tersedia:
- ✅ Upload PDF supplementary di Sample Reception
- ✅ Auto-extract data dari PDF (3 tabel)
- ✅ Simpan ke database
- ✅ Populate form Microbial dengan 1 klik
- ✅ 37 field data terisi otomatis

---

**Last Updated**: 2026-05-04
**Version**: 1.0
