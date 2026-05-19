# Microbial Upload - Windows Production Path Update

## Date: May 14, 2026

---

## Changes Made

All microbial file upload paths have been updated from local testing paths to Windows production paths.

---

## Updated Functions

### 1. `do_upload_microbial()` (Line ~531)

**Before (Local Testing)**:
```php
$upload_path = FCPATH . 'uploads/microbial/';
$python_path = 'python3';
```

**After (Windows Production)**:
```php
$upload_path = 'C:\\onewater\\microbial\\';
$python_path = 'C:\\Users\\mgr-zhan0022\\AppData\\Local\\Programs\\Python\\Python310\\python.exe';
$pythonpath = 'C:\\Users\\mgr-zhan0022\\AppData\\Local\\Programs\\Python\\Python310\\Lib\\site-packages';
```

**Key Changes**:
- ✅ Upload path: `C:\onewater\microbial\`
- ✅ Auto-create directory if not exists
- ✅ Python executable: Full Windows path
- ✅ PYTHONPATH: Windows site-packages
- ✅ Command syntax: Windows `set` command

---

### 2. `view_file()` - Microbial Section (Line ~250)

**Before (Local Testing)**:
```php
} elseif (strpos($filename, 'microbial_') === 0) {
    $basePath = FCPATH . 'uploads/microbial/';
    $fileType = 'microbial file';
}
```

**After (Windows Production)**:
```php
} elseif (strpos($filename, 'microbial_') === 0) {
    $basePath = 'C:\\onewater\\microbial\\';
    $fileType = 'microbial file';
}
```

---

### 3. `delete_microbial_file()` (Line ~696)

**Before (Local Testing)**:
```php
$upload_path = FCPATH . 'uploads/microbial/';
```

**After (Windows Production)**:
```php
$upload_path = 'C:\\onewater\\microbial\\';
```

---

## Python Extraction Configuration

### Command Structure
```php
$command = 'set PYTHONPATH=' . escapeshellarg($pythonpath) . ' && ' . 
           escapeshellarg($python_path) . ' ' . 
           escapeshellarg($python_script) . ' ' . 
           escapeshellarg($full_path) . ' ' . 
           escapeshellarg($barcode) . ' 2>&1';
```

### Environment Variables
- **PYTHONPATH**: `C:\Users\mgr-zhan0022\AppData\Local\Programs\Python\Python310\Lib\site-packages`
- **Python Executable**: `C:\Users\mgr-zhan0022\AppData\Local\Programs\Python\Python310\python.exe`

---

## Directory Structure (Windows Server)

```
C:\onewater\
├── scan\              (existing - for filename uploads)
├── supplementary\     (existing - for supplementary files)
└── microbial\         (for microbial files with extraction)
    └── microbial_PROJECTID_YYYYMMDD_HHMMSS.pdf
```

---

## Other Upload Paths (Unchanged)

### Filename Upload
```php
$upload_path = 'C:\\onewater\\scan\\';  // Already production
```

### Supplementary Files Upload
```php
$upload_path = 'C:\\onewater\\supplementary\\';  // Already production
```

---

## Verification Checklist

Before deploying to production:

### Server Setup
- [ ] Folder `C:\onewater\microbial\` exists
- [ ] Folder has write permissions for web server user
- [ ] Python installed at: `C:\Users\mgr-zhan0022\AppData\Local\Programs\Python\Python310\python.exe`
- [ ] Python packages installed: `pdfplumber`, `pandas`, `openpyxl`

### Testing
- [ ] Upload a PDF file
- [ ] Verify file saved to `C:\onewater\microbial\`
- [ ] Verify extraction runs successfully
- [ ] Check extraction data in `microbial_extraction_results` table
- [ ] Test view file functionality
- [ ] Test delete file functionality

### Logs
- [ ] Check CodeIgniter logs for any errors
- [ ] Verify Python command execution logs
- [ ] Check extraction success/failure messages

---

## Rollback Instructions

If issues occur, revert to local testing paths:

```php
// In do_upload_microbial()
$upload_path = FCPATH . 'uploads/microbial/';
$python_path = 'python3';
// Remove PYTHONPATH and use simple command
```

---

## Notes

- All changes are isolated to microbial upload functions
- Filename and Supplementary uploads remain unchanged
- Auto-directory creation included for safety
- Full Windows command syntax with PYTHONPATH
- Logging enabled for debugging

---

**Status**: ✅ UPDATED TO PRODUCTION PATHS  
**Environment**: Windows Server  
**Ready for**: Production Deployment
