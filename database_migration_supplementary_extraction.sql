-- Table to store extracted supplementary data from PDF
CREATE TABLE IF NOT EXISTS `supplementary_extraction_results` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `id_project` VARCHAR(50) NOT NULL COMMENT 'Project ID (e.g., MU2500040)',
  `id_one_water_sample` VARCHAR(50) NOT NULL COMMENT 'Sample ID (e.g., P2500212)',
  `table_name` VARCHAR(100) NOT NULL COMMENT 'Table name from PDF (Table 1, 2, or 3)',
  `source_name` VARCHAR(50) NOT NULL COMMENT 'Source name (Human, Bird, Dog, etc.)',
  `percentage_value` DECIMAL(10,2) DEFAULT NULL COMMENT 'Percentage value',
  `page_source` INT(11) DEFAULT NULL COMMENT 'PDF page number',
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `idx_project` (`id_project`),
  KEY `idx_sample` (`id_one_water_sample`),
  KEY `idx_project_sample` (`id_project`, `id_one_water_sample`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Stores extracted data from supplementary PDF files';
