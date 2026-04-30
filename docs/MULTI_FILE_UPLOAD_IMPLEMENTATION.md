# Multi-File Upload Implementation for Supplementary Files

## Overview
Implementasi multi-file upload untuk fitur "Supplementary Files" pada modul Sample Reception. Upgrade dari single file menjadi multiple files dengan tetap menjaga backward compatibility.

## Changes Made

### 1. View Layer (application/views/sample_reception/index.php)

#### Form Input (Lines ~292-310)
**Before:**
- Single text input (readonly) untuk menampilkan nama file
- Button "Open File" dan "Delete File"

**After:**
- Hidden input `supplementary_files_data` untuk menyimpan JSON array filenames
- Display div `supplementary_files_display` untuk menampilkan badges file dengan tombol delete individual
- Button "Add File" yang selalu visible untuk menambah file baru

#### DataTables Column Rendering (Lines ~2184-2220)
**Before:**
- Menampilkan single button "View File" atau "No file yet"

**After:**
- Parse JSON array dari database
- Menampilkan multiple badges untuk setiap file
- Backward compatible: jika data bukan JSON, treat sebagai single filename
- Truncate filename panjang dengan ellipsis (...)

#### JavaScript Functions (Lines ~3330-3450)
**New Functions:**
- `getSupplementaryFilesArray()` - Get current files as array from hidden input
- `updateSupplementaryFilesDisplay(filesArray)` - Update display dan hidden input dengan array files
- `deleteSupplementaryFileByIndex(index)` - Delete file by index dengan AJAX call

**Updated Functions:**
- `openSupplementaryScanner()` - Tetap sama, untuk membuka scanner window
- `updateSupplementaryFileButtonsState()` - Simplified, hanya toggle status text
- `deleteSupplementaryFile()` - Legacy support, redirect ke delete by index

**Event Handler:**
- Updated untuk handle `scan-upload-complete-supplementary` event
- Menambahkan file baru ke array (avoid duplicates)
- Update display setelah upload

#### Form Reset & Edit (Lines ~2940-3040)
**Reset Form:**
- Call `updateSupplementaryFilesDisplay([])` untuk clear files

**Edit Form:**
- Parse `data.supplementary_files` sebagai JSON array
- Backward compatible: jika bukan JSON, treat sebagai single file
- Call `updateSupplementaryFilesDisplay(suppFiles)` untuk populate form

#### CSS Styling (Lines ~1293-1320)
**Added:**
- `#supplementary_files_display` styling untuk display area
- Flexbox layout dengan wrap untuk multiple badges
- Label styling untuk file badges

### 2. Controller Layer (application/controllers/Sample_reception.php)

**No Changes Required:**
- Controller sudah menerima POST input `supplementary_files` sebagai text
- Data disimpan langsung ke database sebagai text (JSON string)
- Tidak ada perubahan pada business logic

### 3. Model Layer (application/models/Sample_reception_model.php)

**No Changes Required:**
- Model hanya SELECT dan INSERT/UPDATE data
- Kolom `supplementary_files` tetap sebagai TEXT di database
- Tidak perlu perubahan schema database

### 4. Database Schema

**No Changes Required:**
- Kolom `supplementary_files` di tabel `sample_reception` tetap sebagai TEXT
- Data disimpan sebagai JSON string: `["file1.pdf", "file2.pdf"]`
- Backward compatible dengan data lama (single filename)

## Features

### 1. Multi-File Upload
- User dapat menambahkan multiple files melalui scanner
- Setiap file ditampilkan sebagai badge dengan nama file
- Filename panjang di-truncate dengan ellipsis

### 2. Individual File Delete
- Setiap file memiliki tombol delete (×) sendiri
- Konfirmasi SweetAlert sebelum delete
- AJAX call ke server untuk delete file fisik
- Update display setelah delete berhasil

### 3. Backward Compatibility
- Data lama (single filename) tetap bisa dibaca
- Automatic conversion: single filename → array dengan 1 element
- DataTables rendering handle both JSON array dan single filename

### 4. UI/UX Improvements
- Badge-based display untuk multiple files
- Always-visible "Add File" button
- Status text menampilkan jumlah files
- Validation tip menampilkan jumlah files ready

## Data Format

### Database Storage
```
Single File (Old): "document.pdf"
Multiple Files (New): ["document1.pdf", "document2.pdf", "document3.pdf"]
Empty: "" or "[]"
```

### JavaScript Handling
```javascript
// Get files as array
let files = getSupplementaryFilesArray(); // Returns: ["file1.pdf", "file2.pdf"]

// Update display
updateSupplementaryFilesDisplay(["file1.pdf", "file2.pdf"]);

// Delete by index
deleteSupplementaryFileByIndex(0); // Delete first file
```

### DataTables Rendering
```javascript
// Parse data
let files = JSON.parse(data); // or fallback to [data] if not JSON

// Render badges
files.map(filename => `<a href="..." class="btn btn-xs btn-info">...</a>`).join(' ');
```

## Testing Checklist

- [x] Form reset clears all files
- [x] Form edit loads existing files (single and multiple)
- [x] Add new file appends to array
- [x] Delete individual file removes from array
- [x] DataTables displays multiple files correctly
- [x] Backward compatibility with old single-file data
- [x] AJAX delete calls server endpoint
- [x] SweetAlert confirmations work
- [x] Validation tips show correct file count

## Strict Rules Compliance

✅ **No Database Schema Changes**: Kolom tetap TEXT, data disimpan sebagai JSON string
✅ **No Business Logic Changes**: Controller dan Model tidak diubah
✅ **Backward Compatible**: Data lama tetap bisa dibaca dan diproses
✅ **Unique File Naming**: Scanner sudah handle unique naming (timestamp/UUID)
✅ **View File Functionality**: Semua file bisa di-view dengan link individual

## Notes

1. **File Upload**: Actual file upload masih dilakukan oleh `scan_page` controller (existing functionality)
2. **File Storage**: Files disimpan di server dengan unique naming (handled by scanner)
3. **File Delete**: AJAX call ke `scan_page/delete_supplementary_file` untuk delete file fisik
4. **JSON Encoding**: JavaScript `JSON.stringify()` dan `JSON.parse()` untuk handle array
5. **Error Handling**: Try-catch blocks untuk handle parsing errors dan backward compatibility

## Future Enhancements (Optional)

1. Drag & drop file reordering
2. File type icons (PDF, DOC, etc.)
3. File size display
4. Bulk delete option
5. File preview modal
6. Upload progress indicator
