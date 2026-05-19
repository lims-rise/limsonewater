# Extraction Feature Migration - From Supplementary to Microbial Files

## Overview
Fungsi extraction PDF telah berhasil dipindahkan dari **Supplementary Files** ke **Microbial Files**. Supplementary Files sekarang menjadi upload biasa tanpa extraction, sama seperti Filename upload.

---

## 🔄 CHANGES SUMMARY

### Before (OLD):
- ❌ **Supplementary Files**: Upload PDF → Extract data → Save to `supplementary_extraction_results`
- ❌ **Microbial Files**: Simple upload only (no extraction)

### After (NEW):
- ✅ **Microbial Files**: Upload PDF → Extract data → Save to `microbial_extraction_results`
- ✅ **Supplementary Files**: Simple upload only (no extraction)

---

## 📁 FILES MODIFIED

### 1. **Models**
#### NEW FILE: `application/models/Microbial_extraction_model.php`
- Replaces: `Supplementary_extraction_model.php` functionality
- Table: `microbial_extraction_results`
- Methods:
  - `insert_batch($data)` - Insert extraction results
  - `delete_by_project($project_id)` - Delete by project
  - `get_by_project($project_id)` - Get all results
  - `get_by_project_and_sample($project_id, $sample_id)` - Get by sample
  - `get_by_project_and_table($project_id, $table_name)` - Get by table
  - `has_extraction_results($project_id)` - Check if exists
  - `get_extraction_stats($project_id)` - Get statistics

### 2. **Controllers**

#### A. `application/controllers/Scan_page.php`

**UPDATED: `do_upload_microbial()`**
- ✅ Added PDF extraction logic
- ✅ Calls Python script `extract_pdf_tables.py`
- ✅ Saves to `microbial_extraction_results` table
- ✅ Returns extraction success/error info
- ✅ Windows server Python path configured

**NEW: `delete_microbial_file()`**
- ✅ Deletes microbial PDF file
- ✅ Deletes associated extraction data
- ✅ Returns deletion count

**UPDATED: `do_upload_supplementary()`**
- ❌ Removed all extraction logic
- ✅ Now simple file upload only
- ✅ Returns only filename

**UPDATED: `delete_supplementary_file()`**
- ❌ Removed extraction data deletion
- ✅ Now simple file deletion only

#### B. `application/controllers/Microbial.php`

**UPDATED: Populate function (get extraction data)**
- ✅ Changed from `Supplementary_extraction_model` to `Microbial_extraction_model`
- ✅ Updated error messages to reference "microbial extraction data"
- ✅ All populate functionality now uses microbial extraction table

### 3. **Views**

#### A. `application/views/scan_page/microbial.php`
**UPDATED: Upload success handling**
- ✅ Shows extraction success/failure info
- ✅ Displays extraction count
- ✅ Shows extraction errors if any
- ✅ Sends extraction info to parent window

#### B. `application/views/scan_page/supplementary.php`
**UPDATED: Upload success handling**
- ❌ Removed extraction info display
- ✅ Simple success message only

#### C. `application/views/sample_reception/index.php`

**UPDATED: `deleteMicrobialFile()` function**
- ✅ Changed endpoint to `scan_page/delete_microbial_file`
- ✅ Sends `project_id` for extraction deletion
- ✅ Shows extraction deletion count in success message

**UPDATED: Event listener `scan-upload-complete-microbial`**
- ✅ Receives extraction info from upload
- ✅ Displays extraction success/count
- ✅ Shows extraction errors if any

---

## 🗄️ DATABASE CHANGES

### Table Rename
```sql
RENAME TABLE supplementary_extraction_results TO microbial_extraction_results;
```

**Migration File**: `database_migration_rename_extraction_table.sql`

### Table Structure (Unchanged)
```sql
microbial_extraction_results (
    id INT PRIMARY KEY AUTO_INCREMENT,
    id_project VARCHAR(50),
    id_one_water_sample VARCHAR(50),
    table_name VARCHAR(100),
    source_name VARCHAR(255),
    value DECIMAL(10,2),
    -- other columns...
)
```

---

## 🔧 PYTHON SCRIPT

### `scripts/extract_pdf_tables.py`
- ✅ No changes needed
- ✅ Still extracts 3 tables from PDF
- ✅ Returns JSON with extracted data
- ✅ Works with both Mac and Windows paths

**Usage**:
```bash
python extract_pdf_tables.py <pdf_path> <project_id>
```

**Output**:
```json
{
    "success": true,
    "count": 37,
    "data": [
        {
            "id_project": "MU2500040",
            "id_one_water_sample": "P2600037",
            "table_name": "Table1",
            "source_name": "Dog",
            "value": 46.34
        },
        ...
    ]
}
```

---

## 🔄 WORKFLOW CHANGES

### OLD WORKFLOW (Supplementary Files):
1. User uploads supplementary PDF
2. System extracts data automatically
3. Data saved to `supplementary_extraction_results`
4. User clicks "Populate" in Microbial testing
5. Data populated from `supplementary_extraction_results`

### NEW WORKFLOW (Microbial Files):
1. User uploads **microbial PDF** (not supplementary)
2. System extracts data automatically
3. Data saved to `microbial_extraction_results`
4. User clicks "Populate" in Microbial testing
5. Data populated from `microbial_extraction_results`

### Supplementary Files (NEW):
1. User uploads supplementary file
2. File saved (no extraction)
3. File can be viewed/deleted
4. **No populate functionality**

---

## 📊 FEATURE COMPARISON

| Feature | Supplementary Files (OLD) | Supplementary Files (NEW) | Microbial Files (NEW) |
|---------|---------------------------|---------------------------|------------------------|
| Upload PDF | ✅ | ✅ | ✅ |
| Extract Data | ✅ | ❌ | ✅ |
| Save to DB | ✅ | ❌ | ✅ |
| Populate Button | ✅ | ❌ | ✅ |
| Multi-file | ✅ | ✅ | ❌ |
| View File | ✅ | ✅ | ✅ |
| Delete File | ✅ | ✅ | ✅ |
| Delete Extraction | ✅ | ❌ | ✅ |

---

## 🎯 TESTING CHECKLIST

### Microbial Files (WITH Extraction):
- [ ] Upload microbial PDF file
- [ ] Verify extraction success message shows
- [ ] Verify extraction count displayed
- [ ] Check `microbial_extraction_results` table has data
- [ ] Test "Populate" button in Microbial testing
- [ ] Verify data populates correctly
- [ ] Delete microbial file
- [ ] Verify extraction data also deleted
- [ ] Test with invalid PDF (should show error)
- [ ] Test with non-PDF file (should reject)

### Supplementary Files (WITHOUT Extraction):
- [ ] Upload supplementary PDF file
- [ ] Verify simple success message (no extraction info)
- [ ] Check `microbial_extraction_results` table (should NOT have new data)
- [ ] Verify file can be viewed
- [ ] Delete supplementary file
- [ ] Verify only file deleted (no extraction data)
- [ ] Test multi-file upload
- [ ] Test with various file types

### Populate Button:
- [ ] Click populate without microbial file (should show error)
- [ ] Upload microbial file with extraction
- [ ] Click populate (should work)
- [ ] Verify correct data populated
- [ ] Test with multiple samples

---

## ⚠️ BREAKING CHANGES

### For Users:
1. **Supplementary files no longer extract data**
   - Users must upload to **Microbial Files** for extraction
   - Old supplementary files won't trigger extraction

2. **Populate button now uses microbial extraction data**
   - Must upload microbial PDF file first
   - Supplementary files won't work with populate

### For Developers:
1. **Model name changed**
   - `Supplementary_extraction_model` → `Microbial_extraction_model`
   - Update any custom code using old model

2. **Table name changed**
   - `supplementary_extraction_results` → `microbial_extraction_results`
   - Update any direct SQL queries

3. **Endpoint changed for microbial deletion**
   - `scan_page/delete_file` → `scan_page/delete_microbial_file`

---

## 🚀 DEPLOYMENT STEPS

### 1. Database Migration
```sql
-- Run this first
RENAME TABLE supplementary_extraction_results TO microbial_extraction_results;
```

### 2. File Deployment
- Upload all modified files to server
- Ensure Python script is accessible
- Verify folder permissions: `C:\onewater\microbial\`

### 3. Python Configuration
- Verify Python path: `C:\Users\mgr-zhan0022\AppData\Local\Programs\Python\Python310\python.exe`
- Test Python script manually
- Check required libraries installed

### 4. Testing
- Test microbial file upload with extraction
- Test supplementary file upload (simple)
- Test populate button functionality
- Test file deletion

### 5. User Communication
- Inform users about the change
- Update user documentation
- Provide training if needed

---

## 🔙 ROLLBACK PLAN

If issues occur, rollback steps:

### 1. Database
```sql
RENAME TABLE microbial_extraction_results TO supplementary_extraction_results;
```

### 2. Code
- Restore old controller files
- Restore old model files
- Restore old view files

### 3. Testing
- Verify supplementary extraction works
- Verify populate button works

---

## 📝 NOTES

1. **Data Preservation**: All existing extraction data is preserved during table rename
2. **Backward Compatibility**: Old supplementary files in database still viewable
3. **No Data Loss**: Rename operation is atomic and safe
4. **Performance**: No performance impact, same extraction logic
5. **Security**: Same security measures apply

---

## 🆘 TROUBLESHOOTING

### Extraction Not Working
- Check Python path is correct
- Verify Python script exists
- Check folder permissions
- Review error logs

### Populate Button Not Working
- Verify microbial file uploaded
- Check extraction data exists in DB
- Verify model loaded correctly
- Check project_id matches

### File Upload Fails
- Check folder exists: `C:\onewater\microbial\`
- Verify folder writable
- Check file size < 10MB
- Ensure PDF format

---

## 📞 SUPPORT

For issues or questions:
1. Check error logs: `application/logs/`
2. Review Python output in logs
3. Verify database table exists
4. Contact development team

---

## ✅ COMPLETION STATUS

- [x] Model created: `Microbial_extraction_model.php`
- [x] Controller updated: `Scan_page.php`
- [x] Controller updated: `Microbial.php`
- [x] View updated: `microbial.php`
- [x] View updated: `supplementary.php`
- [x] View updated: `sample_reception/index.php`
- [x] SQL migration created
- [x] Documentation created
- [ ] Database migration executed
- [ ] Testing completed
- [ ] Deployment completed

---

**Last Updated**: 2024
**Version**: 1.0
**Status**: Ready for Testing
