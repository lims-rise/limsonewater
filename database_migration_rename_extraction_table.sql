-- Migration SQL untuk rename table extraction dari supplementary ke microbial
-- Jalankan query ini di database Anda

-- STEP 1: Rename table dari supplementary_extraction_results ke microbial_extraction_results
RENAME TABLE supplementary_extraction_results TO microbial_extraction_results;

-- STEP 2: Verifikasi table sudah direname
SHOW TABLES LIKE '%extraction%';

-- STEP 3: Verifikasi struktur table
DESCRIBE microbial_extraction_results;

-- STEP 4: Verifikasi data masih ada (optional)
SELECT COUNT(*) as total_records FROM microbial_extraction_results;

-- Catatan:
-- 1. Table supplementary_extraction_results akan direname menjadi microbial_extraction_results
-- 2. Semua data existing akan tetap ada
-- 3. Semua indexes dan constraints akan tetap ada
-- 4. Extraction sekarang dilakukan dari Microbial Files, bukan Supplementary Files
-- 5. Supplementary Files sekarang hanya upload biasa tanpa extraction

-- Rollback (jika diperlukan):
-- RENAME TABLE microbial_extraction_results TO supplementary_extraction_results;
