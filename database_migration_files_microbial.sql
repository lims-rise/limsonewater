-- Migration SQL untuk menambahkan kolom files_microbial di tabel sample_reception
-- Jalankan query ini di database Anda

-- Tambahkan kolom files_microbial setelah kolom files
ALTER TABLE sample_reception 
ADD COLUMN files_microbial VARCHAR(255) NULL AFTER files;

-- Verifikasi kolom sudah ditambahkan
DESCRIBE sample_reception;

-- Catatan:
-- Kolom ini akan menyimpan nama file microbial yang diupload
-- Format: microbial_[barcode]_[timestamp].pdf
-- Contoh: microbial_MU2500040_20240620_143022.pdf
