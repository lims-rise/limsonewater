# 🚀 QUICK START - Deployment to Windows Server

## 📦 Sebelum Push (Di Mac)

```bash
# 1. Prepare for deployment
php prepare_for_deployment.php

# 2. Commit & Push
git add .
git commit -m "feat: Add supplementary PDF extraction"
git push origin main
```

---

## 🖥️ Di Server Windows

### 1. Install Python (One-time)
```cmd
# Download dari: https://www.python.org/downloads/windows/
# ⚠️ Centang "Add Python to PATH" saat install

# Verify
python --version
```

### 2. Install Library (One-time)
```cmd
python -m pip install pdfplumber
```

### 3. Setup Folder (One-time)
```cmd
mkdir C:\onewater\supplementary
icacls C:\onewater\supplementary /grant "IIS_IUSRS:(OI)(CI)F" /T
```

### 4. Deploy Code
```cmd
cd C:\path\to\project
git pull origin main
```

### 5. Database Migration (One-time)
```sql
-- Run: database_migration_supplementary_extraction.sql
CREATE TABLE supplementary_extraction_results (...);
```

### 6. Test
```cmd
# Test Python
python scripts\extract_pdf_tables.py C:\onewater\supplementary\test.pdf MU2500040

# Test Web
# 1. Upload PDF di Sample Reception
# 2. Populate di form Microbial
```

---

## 🔙 Setelah Pull (Di Mac)

```bash
php restore_mac_version.php
```

---

## 🆘 Quick Fix

**Python not found?**
```cmd
where python
# Update path di Scan_page.php line ~478
```

**pdfplumber error?**
```cmd
python -m pip install pdfplumber
```

**Permission error?**
```cmd
icacls C:\onewater\supplementary /grant "IIS_IUSRS:(OI)(CI)F" /T
```

---

## 📚 Full Documentation

- `DEPLOYMENT_SUMMARY.md` - Complete overview
- `DEPLOYMENT_GUIDE.md` - Detailed step-by-step
- `database_migration_supplementary_extraction.sql` - SQL script

---

**Total Time**: ~40 minutes  
**One-time Setup**: Python + Library + Folder  
**Per Deployment**: Pull + Test (~5 minutes)
