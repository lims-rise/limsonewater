# Microbial Files Upload Feature - Documentation

## Overview
Fitur upload file microbial telah berhasil ditambahkan ke module Sample Reception. Fitur ini memungkinkan user untuk mengupload file PDF khusus untuk analisis microbial, terpisah dari file scan biasa.

## Changes Made

### 1. Database Changes
**File:** `database_migration_files_microbial.sql`

Tambahkan kolom baru di tabel `sample_reception`:
```sql
ALTER TABLE sample_reception 
ADD COLUMN files_microbial VARCHAR(255) NULL AFTER files;
```

### 2. Controller Changes

#### A. Scan_page.php
**Fungsi Baru:**
- `do_upload_microbial()` - Handle upload file microbial ke `C:\onewater\microbial\`
- Format filename: `microbial_[barcode]_[timestamp].pdf`

**Fungsi Diupdate:**
- `view_file()` - Ditambahkan support untuk view microbial files berdasarkan prefix `microbial_`

#### B. Sample_reception.php
**Fungsi Diupdate:**
- `save()` - Ditambahkan field `files_microbial` untuk insert dan update

### 3. View Changes

#### A. scan_page/microbial.php (NEW FILE)
View baru untuk upload microbial files dengan:
- Drag & drop interface
- PDF preview
- Green color theme (berbeda dari scan biasa)
- Upload ke endpoint `Scan_page/do_upload_microbial`
- Mengirim message type: `scan-upload-complete-microbial`

#### B. sample_reception/index.php

**HTML Form:**
- Ditambahkan komponen upload baru dengan ID unik:
  - `#files_microbial` - Input field
  - `#btn-open-scanner-microbial` - Button upload
  - `#btn-delete-file-microbial` - Button delete
  - `#file-status-text-microbial` - Status text

**JavaScript Functions (NEW):**
1. `openMicrobialScanner()` - Membuka popup scanner microbial
2. `updateMicrobialFileButtonsState()` - Update state button (show/hide)
3. `deleteMicrobialFile()` - Delete file microbial dari server

**Event Listener:**
- Ditambahkan listener untuk `scan-upload-complete-microbial` message

**DataTable:**
- Ditambahkan column "Microbial Files" di table
- Render button "View Microbial" untuk file yang ada

**CSS Styling:**
- Button microbial menggunakan cyan/info color scheme
- Gradient background untuk visual distinction

### 4. File Structure

```
application/
├── controllers/
│   ├── Scan_page.php (updated)
│   └── Sample_reception.php (updated)
├── views/
│   ├── scan_page/
│   │   ├── index.php (existing)
│   │   ├── supplementary.php (existing)
│   │   └── microbial.php (NEW)
│   └── sample_reception/
│       └── index.php (updated)
```

## Upload Paths

### Development (Mac):
- Scan files: `C:\onewater\scan\`
- Microbial files: `C:\onewater\microbial\`
- Supplementary files: `./uploads/supplementary/`

### Production (Windows Server):
- Scan files: `C:\onewater\scan\`
- Microbial files: `C:\onewater\microbial\`
- Supplementary files: `C:\onewater\supplementary\`

## File Naming Convention

| Type | Prefix | Example |
|------|--------|---------|
| Scan | `sample_` | `sample_MU2500040.pdf` |
| Microbial | `microbial_` | `microbial_MU2500040_20240620_143022.pdf` |
| Supplementary | `supplementary_` | `supplementary_MU2500040.pdf` |

## Features

### Add Mode:
1. User klik "Open File" button
2. Popup scanner microbial terbuka
3. User drag & drop atau pilih PDF file
4. File preview ditampilkan
5. User klik "Upload"
6. File tersimpan dengan nama `microbial_[barcode]_[timestamp].pdf`
7. Filename otomatis terisi di form
8. Button berubah menjadi "Delete File"

### Edit Mode:
1. File yang sudah diupload ditampilkan (readonly)
2. Button "Delete File" tersedia
3. User bisa delete dan upload file baru
4. Perubahan tersimpan saat save form

### View Mode (DataTable):
1. Column "Microbial Files" menampilkan status file
2. Jika ada file: Button "View Microbial" (cyan/info color)
3. Jika tidak ada: Button disabled "No file"
4. Klik "View Microbial" membuka PDF di tab baru

## Integration Points

### 1. Form Submission
Field `files_microbial` dikirim bersama form data lainnya ke `Sample_reception/save`

### 2. File Viewing
URL: `scan_page/view_file/[filename]`
- Otomatis detect prefix `microbial_` dan route ke path yang benar

### 3. File Deletion
Endpoint: `scan_page/delete_file`
- Menggunakan endpoint yang sama dengan scan files
- Filename dengan prefix `microbial_` akan dihapus dari folder microbial

## Security Considerations

1. **File Type Validation**: Hanya PDF yang diperbolehkan
2. **Filename Sanitization**: Karakter special dihapus dari project_id
3. **Path Traversal Prevention**: Menggunakan `basename()` untuk filename
4. **File Size Limit**: 10MB max (configurable di `do_upload_microbial`)

## Testing Checklist

- [ ] Upload microbial file di mode add
- [ ] Upload microbial file di mode edit
- [ ] View microbial file dari DataTable
- [ ] Delete microbial file
- [ ] Verify file tersimpan di `C:\onewater\microbial\`
- [ ] Verify filename format correct
- [ ] Verify database column `files_microbial` terisi
- [ ] Test dengan file non-PDF (should reject)
- [ ] Test dengan file > 10MB (should reject)
- [ ] Test concurrent uploads
- [ ] Test edit existing record dengan microbial file

## Known Limitations

1. Hanya support single file (tidak multi-file seperti supplementary)
2. Hanya support PDF format
3. Tidak ada extraction otomatis seperti supplementary files
4. Folder `C:\onewater\microbial\` harus sudah exist dan writable

## Future Enhancements

1. Multi-file support untuk microbial files
2. Auto-extraction data dari microbial PDF
3. File versioning
4. File preview di modal tanpa buka tab baru
5. Batch upload multiple microbial files

## Troubleshooting

### Upload Failed
- Check folder `C:\onewater\microbial\` exists
- Check folder permissions (writable)
- Check file size < 10MB
- Check file type is PDF

### File Not Found When Viewing
- Verify file exists in `C:\onewater\microbial\`
- Check filename in database matches actual file
- Verify network path accessible (if on network drive)

### Button Not Showing
- Check JavaScript console for errors
- Verify `updateMicrobialFileButtonsState()` is called
- Check element IDs are unique (no conflicts with other file inputs)

## Contact
For issues or questions, contact the development team.
