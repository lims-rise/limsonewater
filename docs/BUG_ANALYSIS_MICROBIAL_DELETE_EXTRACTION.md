# Bug Analysis: Microbial File Delete - Extraction Data Not Removed

## Date: May 14, 2026

---

## Bug Report

**Issue**: When deleting a microbial file, the file is deleted successfully but extraction data in `microbial_extraction_results` table is NOT removed.

**Expected Behavior**: Both file and extraction data should be deleted

**Actual Behavior**: Only file is deleted, extraction data remains in database

---

## Root Cause Analysis

### Code Review Findings

#### 1. JavaScript Function (`deleteMicrobialFile()`)
**Location**: `application/views/sample_reception/index.php` line ~3647

**Status**: ✅ **CORRECT** - Sends both filename and project_id

```javascript
const projectId = $('#idx_project').val() || '';
xhr.send('filename=' + encodeURIComponent(filename) + '&project_id=' + encodeURIComponent(projectId));
```

#### 2. PHP Controller (`delete_microbial_file()`)
**Location**: `application/controllers/Scan_page.php` line ~700

**Status**: ✅ **CORRECT** - Has logic to delete extraction data

```php
if (!empty($project_id)) {
    $this->load->model('Microbial_extraction_model');
    $extraction_count = count($this->Microbial_extraction_model->get_by_project($project_id));
    $extraction_deleted = $this->Microbial_extraction_model->delete_by_project($project_id);
}
```

#### 3. Model Function (`delete_by_project()`)
**Location**: `application/models/Microbial_extraction_model.php` line ~30

**Status**: ✅ **CORRECT** - Deletes by id_project

```php
public function delete_by_project($project_id)
{
    $this->db->where('id_project', $project_id);
    return $this->db->delete('microbial_extraction_results');
}
```

---

## Possible Causes

### Hypothesis 1: project_id Not Being Sent ❌
**Likelihood**: LOW

**Reason**: Code shows `$('#idx_project').val()` is being sent

**Test**: Check browser network tab to verify project_id in POST data

---

### Hypothesis 2: project_id Value Mismatch ⚠️
**Likelihood**: **HIGH**

**Reason**: The `project_id` sent from form might not match `id_project` in database

**Scenarios**:
1. Form field `#idx_project` contains different value than database `id_project`
2. In edit mode, field might be readonly and value not captured correctly
3. Project ID format mismatch (e.g., with/without prefix)

**Test**: 
- Check what value is in `$('#idx_project').val()`
- Compare with `id_project` in `microbial_extraction_results` table
- Check logs for actual project_id being sent

---

### Hypothesis 3: Database Column Name Mismatch ❌
**Likelihood**: LOW

**Reason**: Model uses `id_project` which should be correct

**Test**: Verify column name in `microbial_extraction_results` table

---

### Hypothesis 4: Empty project_id ⚠️
**Likelihood**: MEDIUM

**Reason**: If `$('#idx_project').val()` returns empty string, deletion is skipped

**Code**:
```php
if (!empty($project_id)) {
    // Delete extraction data
}
```

**Test**: Check if project_id field is populated when deleting

---

## Debugging Steps Added

### Enhanced Logging
Added detailed logging to `delete_microbial_file()`:

```php
// Log received parameters
log_message('debug', 'Delete microbial file - Filename: ' . $filename . ', Project ID: ' . $project_id);

// Log extraction records found
log_message('debug', 'Found ' . $extraction_count . ' extraction records for project: ' . $project_id);

// Log deletion result
log_message('debug', 'Extraction deletion result: ' . ($extraction_deleted ? 'SUCCESS' : 'FAILED'));

// Log if no project_id provided
log_message('warning', 'No project_id provided for microbial file deletion');
```

### Enhanced Response
Added more detailed response message:

```php
if ($extraction_deleted && $extraction_count > 0) {
    $message .= " and {$extraction_count} extraction records removed";
} elseif ($extraction_count > 0 && !$extraction_deleted) {
    $message .= " but failed to remove {$extraction_count} extraction records";
}
```

---

## How to Debug on Server

### Step 1: Check Logs
```bash
# View CodeIgniter logs
tail -f application/logs/log-$(date +%Y-%m-%d).php

# Look for:
# - "Delete microbial file - Filename: ..., Project ID: ..."
# - "Found X extraction records for project: ..."
# - "Extraction deletion result: SUCCESS/FAILED"
# - "No project_id provided for microbial file deletion"
```

### Step 2: Check Browser Console
```javascript
// Before deleting, check project_id value
console.log('Project ID:', $('#idx_project').val());
```

### Step 3: Check Network Tab
1. Open browser DevTools (F12)
2. Go to Network tab
3. Delete a microbial file
4. Find the `delete_microbial_file` request
5. Check Form Data:
   - `filename`: should have value
   - `project_id`: **should have value** (if empty, this is the problem!)

### Step 4: Check Database
```sql
-- Check what project IDs exist in extraction table
SELECT DISTINCT id_project FROM microbial_extraction_results;

-- Check if project_id matches what was sent
SELECT * FROM microbial_extraction_results WHERE id_project = 'YOUR_PROJECT_ID';
```

---

## Potential Solutions

### Solution 1: If project_id is Empty
**Problem**: `$('#idx_project').val()` returns empty

**Fix**: Ensure field is populated before delete
```javascript
const projectId = $('#idx_project').val() || $('#id_project').val() || '';
if (!projectId) {
    console.error('No project ID found!');
}
```

### Solution 2: If project_id Mismatch
**Problem**: Form has different ID than database

**Fix**: Extract project_id from filename
```php
// Extract project_id from filename: microbial_PROJECTID_timestamp.pdf
if (preg_match('/microbial_([^_]+)_/', $filename, $matches)) {
    $project_id_from_filename = $matches[1];
    // Use this instead
}
```

### Solution 3: If Field is Readonly Issue
**Problem**: Readonly fields might not submit value

**Fix**: Use hidden field or data attribute
```javascript
const projectId = $('#idx_project').val() || 
                  $('#idx_project').data('project-id') || 
                  $('input[name="idx_project"]').val() || '';
```

---

## Testing Checklist

After applying fix:

- [ ] Upload a microbial PDF file
- [ ] Verify extraction data is created in database
- [ ] Delete the microbial file
- [ ] Check logs for project_id value
- [ ] Check logs for extraction records found
- [ ] Check logs for deletion result
- [ ] Verify extraction data is removed from database
- [ ] Verify success message shows extraction count

---

## Recommended Next Steps

1. **Check server logs** to see what project_id is being received
2. **Check browser network tab** to see what project_id is being sent
3. **Compare** sent project_id with database id_project
4. **Apply appropriate solution** based on findings

---

## Status

**Current**: ⚠️ **DEBUGGING IN PROGRESS**

**Logging Added**: ✅ YES

**Waiting For**: Server logs to identify root cause

---

**Last Updated**: May 14, 2026
