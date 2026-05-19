# Path Configuration - Local Testing vs Production

## Date: May 14, 2026

---

## Overview
This document tracks path configurations that need to be changed between local testing and production deployment.

---

## Microbial Files Upload Paths

### 1. View File Function (Line ~250)
**File**: `application/controllers/Scan_page.php`

**LOCAL TESTING (Current)**:
```php
} elseif (strpos($filename, 'microbial_') === 0) {
    // Microbial files path - LOCAL TESTING
    $basePath = FCPATH . 'uploads/microbial/';
    // PRODUCTION: $basePath = 'C:\\onewater\\microbial\\';
    $fileType = 'microbial file';
}
```

**PRODUCTION**:
```php
} elseif (strpos($filename, 'microbial_') === 0) {
    // Microbial files path - PRODUCTION
    $basePath = 'C:\\onewater\\microbial\\';
    $fileType = 'microbial file';
}
```

---

### 2. Upload Microbial Function (Line ~533)
**File**: `application/controllers/Scan_page.php`

**LOCAL TESTING (Current)**:
```php
public function do_upload_microbial()
{
    // Use local path for microbial uploads - LOCAL TESTING
    $upload_path = FCPATH . 'uploads/microbial/';
    // PRODUCTION: $upload_path = 'C:\\onewater\\microbial\\';
```

**PRODUCTION**:
```php
public function do_upload_microbial()
{
    // Use server path for microbial uploads - PRODUCTION
    $upload_path = 'C:\\onewater\\microbial\\';
```

---

### 3. Delete Microbial File Function (Line ~696)
**File**: `application/controllers/Scan_page.php`

**LOCAL TESTING (Current)**:
```php
public function delete_microbial_file()
{
    // Local path for microbial files - LOCAL TESTING
    $upload_path = FCPATH . 'uploads/microbial/';
    // PRODUCTION: $upload_path = 'C:\\onewater\\microbial\\';
```

**PRODUCTION**:
```php
public function delete_microbial_file()
{
    // Windows server path for microbial files - PRODUCTION
    $upload_path = 'C:\\onewater\\microbial\\';
```

---

## Python Script Configuration

### 4. Python Executable Path (Line ~580)
**File**: `application/controllers/Scan_page.php`

**LOCAL TESTING (Current)**:
```php
// Call Python script to extract tables
$python_script = FCPATH . 'scripts/extract_pdf_tables.py';

// LOCAL TESTING: Use system python3
$python_path = 'python3';
// PRODUCTION: Windows server Python path
// $python_path = 'C:\\Users\\mgr-zhan0022\\AppData\\Local\\Programs\\Python\\Python310\\python.exe';
```

**PRODUCTION**:
```php
// Call Python script to extract tables
$python_script = FCPATH . 'scripts/extract_pdf_tables.py';

// PRODUCTION: Windows server Python path
$python_path = 'C:\\Users\\mgr-zhan0022\\AppData\\Local\\Programs\\Python\\Python310\\python.exe';
```

---

## Local Testing Setup

### Required Folder Structure
```
project_root/
├── uploads/
│   └── microbial/          <- Create this folder
│       └── (uploaded PDFs will be stored here)
├── scripts/
│   └── extract_pdf_tables.py
└── application/
    └── controllers/
        └── Scan_page.php
```

### Folder Permissions
```bash
# Make sure uploads/microbial folder is writable
chmod 755 uploads/microbial
```

### Python Requirements
```bash
# Make sure Python 3 is installed and accessible
python3 --version

# Install required packages
pip3 install pdfplumber pandas openpyxl
```

---

## Production Deployment Checklist

When deploying to production Windows server:

### Step 1: Update Microbial Upload Paths
- [ ] Line ~250: Change to `'C:\\onewater\\microbial\\'`
- [ ] Line ~533: Change to `'C:\\onewater\\microbial\\'`
- [ ] Line ~696: Change to `'C:\\onewater\\microbial\\'`

### Step 2: Update Python Path
- [ ] Line ~580: Uncomment Windows Python path
- [ ] Line ~580: Comment out `'python3'` line

### Step 3: Verify Windows Folder
- [ ] Ensure `C:\onewater\microbial\` folder exists
- [ ] Ensure folder has write permissions for web server user

### Step 4: Test Python Script
- [ ] Test Python script execution on Windows server
- [ ] Verify all required Python packages are installed

---

## Quick Switch Commands

### Switch to LOCAL TESTING:
```bash
# In Scan_page.php, use these values:
$upload_path = FCPATH . 'uploads/microbial/';
$python_path = 'python3';
```

### Switch to PRODUCTION:
```bash
# In Scan_page.php, use these values:
$upload_path = 'C:\\onewater\\microbial\\';
$python_path = 'C:\\Users\\mgr-zhan0022\\AppData\\Local\\Programs\\Python\\Python310\\python.exe';
```

---

## Testing Instructions

### Test Microbial File Upload
1. Go to Sample Reception
2. Click "Add" button
3. Fill in required fields
4. Click "Open File" for Microbial Files
5. Upload a PDF file
6. Verify file is saved to `uploads/microbial/` folder
7. Verify extraction runs (if PDF has tables)
8. Check for success/error message

### Test Microbial File Delete
1. Open existing record with microbial file
2. Click "Delete File" button
3. Confirm deletion
4. Verify file is removed from `uploads/microbial/` folder
5. Verify extraction data is deleted from database

### Test Microbial File View
1. In DataTable, find record with microbial file
2. Click the file view button
3. Verify file opens in new tab

---

## Troubleshooting

### Issue: File upload fails
**Check**:
- Folder `uploads/microbial/` exists
- Folder has write permissions
- PHP upload settings (max file size, etc.)

### Issue: Python extraction fails
**Check**:
- Python 3 is installed: `python3 --version`
- Required packages installed: `pip3 list | grep pdfplumber`
- Python script path is correct
- PDF file exists at the specified path

### Issue: File not found when viewing
**Check**:
- File exists in `uploads/microbial/` folder
- Filename in database matches actual file
- Path configuration in `view_file()` function

---

## Notes

- All path changes are clearly marked with comments: `// LOCAL TESTING` or `// PRODUCTION`
- Use Find & Replace to quickly switch between configurations
- Always test after switching configurations
- Keep this document updated if paths change

---

## Current Configuration
**Status**: ✅ LOCAL TESTING
**Date**: May 14, 2026
**Modified By**: Kiro AI Assistant

All paths are currently configured for local testing on macOS/Linux system.
