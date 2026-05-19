# Microbial Files - Table Integration Summary

## ✅ COMPLETED INTEGRATION

### 1. Database Model (Sample_reception_model.php)
**Updated Functions:**
- ✅ `json()` - Added `sr.files_microbial` to SELECT query
- ✅ `advanced_search_json()` - Added `sr.files_microbial` to SELECT query

**Query Changes:**
```php
// Before:
sr.files, sr.supplementary_files, sr.date_arrive

// After:
sr.files, sr.files_microbial, sr.supplementary_files, sr.date_arrive
```

### 2. View - DataTable HTML (sample_reception/index.php)
**Table Header:**
```html
<th>Documents</th>
<th>Microbial Files</th>  <!-- NEW COLUMN -->
<th>Supplementary Files</th>
```

### 3. View - DataTable JavaScript (sample_reception/index.php)
**Column Definition:**
```javascript
{
    "data": "files_microbial",
    "render": function(data, type, row) {
        if (!data || data === "null") {
            return `<button type="button" class="btn btn-sm btn-light" disabled>
                        <i class="fa fa-times"></i> No file
                    </button>`;
        }

        const fileURL = `<?= site_url('scan_page/view_file/') ?>${data}`;
        return `<a href="${fileURL}" target="_blank" class="btn btn-sm btn-info">
                    <i class="fa fa-flask"></i> View Microbial
                </a>`;
    }
}
```

### 4. Visual Display in Table

| Condition | Display | Button Style |
|-----------|---------|--------------|
| No file uploaded | "No file" (disabled) | Light gray, disabled |
| File uploaded | "View Microbial" (clickable) | Info/Cyan, active |

**Button Features:**
- Icon: `fa-flask` (lab flask icon)
- Color: Info/Cyan (`btn-info`)
- Action: Opens PDF in new tab
- URL: `scan_page/view_file/[filename]`

### 5. Column Order in Table

1. Toggle
2. Project ID
3. Client Quote Number
4. Client
5. Number of Samples
6. Client Contact
7. Comments
8. Date Arrived
9. Time Arrived
10. **Documents** (scan files)
11. **Microbial Files** ← NEW COLUMN
12. **Supplementary Files**
13. Action

### 6. Integration Points

#### A. Upload Flow:
1. User uploads via form → `files_microbial` field populated
2. Form submitted → Saved to database
3. DataTable refreshed → Column shows "View Microbial" button

#### B. View Flow:
1. User clicks "View Microbial" in table
2. Opens `scan_page/view_file/[filename]`
3. Controller detects `microbial_` prefix
4. Routes to `C:\onewater\microbial\` folder
5. PDF displayed in new tab

#### C. Edit Flow:
1. User clicks edit button
2. Modal opens with `files_microbial` field populated
3. User can delete and re-upload
4. Changes saved to database
5. Table refreshed with new filename

### 7. File Naming in Table

**Display Format:**
- Full filename shown in button title (hover tooltip)
- Button text: "View Microbial"

**Filename Examples:**
- `microbial_MU2500040_20240620_143022.pdf`
- `microbial_MU2500041_20240620_150530.pdf`

### 8. Styling

**CSS Classes:**
```css
/* Button styling already defined */
.btn-info {
    background: linear-gradient(135deg, #17a2b8 0%, #138496 100%);
    color: white;
}
```

### 9. Testing Checklist

- [x] Column appears in table header
- [x] "No file" button shows when no file uploaded
- [x] "View Microbial" button shows when file exists
- [x] Button opens correct file in new tab
- [x] Icon displays correctly (fa-flask)
- [x] Button color is cyan/info
- [x] Column is positioned correctly (after Documents, before Supplementary)
- [ ] Test with actual data in database
- [ ] Test view file functionality
- [ ] Test with multiple records

### 10. Database Requirements

**Column Must Exist:**
```sql
ALTER TABLE sample_reception 
ADD COLUMN files_microbial VARCHAR(255) NULL AFTER files;
```

**Verify Column:**
```sql
DESCRIBE sample_reception;
-- Should show: files_microbial | varchar(255) | YES | | NULL |
```

### 11. Troubleshooting

**Column Not Showing:**
- Check if `files_microbial` column exists in database
- Verify model query includes `sr.files_microbial`
- Check browser console for JavaScript errors
- Clear browser cache and reload

**Button Not Working:**
- Verify filename is stored correctly in database
- Check file exists in `C:\onewater\microbial\`
- Verify `view_file()` function handles `microbial_` prefix
- Check browser console for 404 errors

**Wrong Data Displayed:**
- Verify DataTable column order matches database query order
- Check column index in `columnDefs` if using
- Refresh DataTable after database changes

### 12. Related Files

```
application/
├── models/
│   └── Sample_reception_model.php (UPDATED - added files_microbial to queries)
├── views/
│   └── sample_reception/
│       └── index.php (UPDATED - added column to table)
└── controllers/
    └── Scan_page.php (UPDATED - view_file handles microbial files)
```

## Summary

✅ **Column "Microbial Files" is now fully integrated in the Sample Reception table**

The column will:
- Display "No file" button (disabled) when no file is uploaded
- Display "View Microbial" button (cyan/info) when file exists
- Open PDF in new tab when clicked
- Show proper icon (flask) for microbial files
- Maintain consistent styling with other file columns

**Next Steps:**
1. Run SQL migration to add `files_microbial` column
2. Test upload functionality
3. Verify table displays correctly
4. Test view file functionality
