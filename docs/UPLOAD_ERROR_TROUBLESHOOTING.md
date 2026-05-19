# Upload Error Troubleshooting Guide

## Error: 400 Bad Request on Microbial File Upload

### Quick Fix

1. **Create the upload folder**:
   ```bash
   mkdir -p uploads/microbial
   chmod 755 uploads/microbial
   ```

2. **Or run the setup script**:
   ```bash
   chmod +x setup_upload_folders.sh
   ./setup_upload_folders.sh
   ```

3. **Refresh and try uploading again**

---

## Common Upload Errors

### Error: "Upload directory does not exist"

**Cause**: The folder `uploads/microbial/` doesn't exist

**Solution**:
```bash
mkdir -p uploads/microbial
```

---

### Error: "Upload directory is not writable"

**Cause**: The web server doesn't have write permissions

**Solution**:
```bash
chmod 755 uploads/microbial

# If still not working, try:
chmod 777 uploads/microbial  # Less secure, only for testing
```

---

### Error: "The upload path does not appear to be valid"

**Cause**: Path configuration is wrong

**Solution**: Check `Scan_page.php` line ~533:
```php
// Should be:
$upload_path = FCPATH . 'uploads/microbial/';

// NOT:
$upload_path = 'C:\\onewater\\microbial\\';  // This is for Windows production
```

---

### Error: "The filetype you are attempting to upload is not allowed"

**Cause**: File type not in allowed list

**Solution**: Only PDF files are allowed for microbial uploads. Make sure you're uploading a `.pdf` file.

---

### Error: "The file you are attempting to upload is larger than the permitted size"

**Cause**: File exceeds 10MB limit

**Solution**: 
1. Compress the PDF file
2. Or increase limit in `Scan_page.php`:
   ```php
   $config['max_size'] = 10240; // Change to higher value (in KB)
   ```

---

## Checking Upload Configuration

### 1. Verify Folder Exists
```bash
ls -la uploads/
# Should show:
# drwxr-xr-x  microbial
```

### 2. Verify Permissions
```bash
ls -la uploads/microbial/
# Should show: drwxr-xr-x (755)
```

### 3. Test Write Permission
```bash
touch uploads/microbial/test.txt
# If successful, you can write to the folder
rm uploads/microbial/test.txt
```

### 4. Check PHP Upload Settings
Create a file `phpinfo.php`:
```php
<?php phpinfo(); ?>
```

Look for:
- `upload_max_filesize` (should be >= 10M)
- `post_max_size` (should be >= 10M)
- `file_uploads` (should be On)

---

## Viewing Error Logs

### CodeIgniter Logs
```bash
tail -f application/logs/log-*.php
```

Look for:
- `ERROR - Microbial upload directory does not exist`
- `ERROR - Microbial upload directory is not writable`
- `ERROR - Microbial upload failed`

### Browser Console
1. Open browser DevTools (F12)
2. Go to Console tab
3. Look for error messages
4. Go to Network tab
5. Find the failed request
6. Check Response for error details

---

## Testing Upload Manually

### Using cURL
```bash
curl -X POST \
  -F "file=@/path/to/test.pdf" \
  -F "project_id=MU2600018" \
  http://localhost/limsonewater/Scan_page/do_upload_microbial
```

Expected response:
```json
{
  "filename": "microbial_MU2600018_20260514_123456.pdf",
  "extraction_success": false,
  "extraction_count": 0,
  "extraction_error": null
}
```

---

## Step-by-Step Debugging

### Step 1: Check Folder
```bash
# Does it exist?
ls -la uploads/microbial/

# If not, create it:
mkdir -p uploads/microbial
chmod 755 uploads/microbial
```

### Step 2: Check PHP Path
Add this to `Scan_page.php` temporarily:
```php
public function do_upload_microbial()
{
    $upload_path = FCPATH . 'uploads/microbial/';
    
    // DEBUG: Print path
    echo "Upload path: " . $upload_path . "\n";
    echo "Exists: " . (is_dir($upload_path) ? 'YES' : 'NO') . "\n";
    echo "Writable: " . (is_writable($upload_path) ? 'YES' : 'NO') . "\n";
    die();
    
    // ... rest of code
}
```

### Step 3: Check Upload Library
```php
if (!$this->upload->do_upload('file')) {
    $error = $this->upload->display_errors();
    
    // DEBUG: Print detailed error
    echo "Upload error: " . $error . "\n";
    print_r($this->upload);
    die();
}
```

### Step 4: Check Logs
```bash
# Watch logs in real-time
tail -f application/logs/log-$(date +%Y-%m-%d).php
```

---

## Production vs Testing Paths

### Current Configuration (Testing)
```php
// Scan_page.php line ~533
$upload_path = FCPATH . 'uploads/microbial/';
```

This resolves to:
- macOS/Linux: `/Applications/XAMPP/xamppfiles/htdocs/limsonewater/uploads/microbial/`
- Windows: `C:\xampp\htdocs\limsonewater\uploads\microbial\`

### Production Configuration
```php
// Scan_page.php line ~533
$upload_path = 'C:\\onewater\\microbial\\';
```

This is for Windows production server only.

---

## Quick Checklist

Before testing upload:
- [ ] Folder `uploads/microbial/` exists
- [ ] Folder has 755 permissions
- [ ] Web server can write to folder
- [ ] Path in code is correct (FCPATH for testing)
- [ ] PHP upload settings allow 10MB files
- [ ] Browser console is open to see errors

---

## Still Not Working?

1. **Check the exact error message** in browser console
2. **Check CodeIgniter logs** in `application/logs/`
3. **Try the setup script**: `./setup_upload_folders.sh`
4. **Test with a small PDF** (< 1MB)
5. **Verify project_id** is being passed correctly

---

## Contact

If issue persists, provide:
1. Exact error message from browser console
2. CodeIgniter log entries
3. Output of `ls -la uploads/`
4. PHP version: `php -v`
5. Operating system

---

**Last Updated**: May 14, 2026
