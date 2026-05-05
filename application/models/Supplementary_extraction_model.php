<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Supplementary_extraction_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Insert batch of extraction results
     * @param array $data Array of extraction records
     * @return bool Success status
     */
    public function insert_batch($data)
    {
        if (empty($data)) {
            return false;
        }

        return $this->db->insert_batch('supplementary_extraction_results', $data);
    }

    /**
     * Delete extraction results by project ID
     * @param string $project_id Project ID
     * @return bool Success status
     */
    public function delete_by_project($project_id)
    {
        $this->db->where('id_project', $project_id);
        return $this->db->delete('supplementary_extraction_results');
    }

    /**
     * Get extraction results by project ID
     * @param string $project_id Project ID
     * @return array Extraction results
     */
    public function get_by_project($project_id)
    {
        $this->db->where('id_project', $project_id);
        $this->db->order_by('table_name', 'ASC');
        $this->db->order_by('id_one_water_sample', 'ASC');
        $this->db->order_by('source_name', 'ASC');
        $query = $this->db->get('supplementary_extraction_results');
        return $query->result_array();
    }

    /**
     * Get extraction results by project ID and sample ID
     * @param string $project_id Project ID
     * @param string $sample_id Sample ID
     * @return array Extraction results
     */
    public function get_by_project_and_sample($project_id, $sample_id)
    {
        $this->db->where('id_project', $project_id);
        $this->db->where('id_one_water_sample', $sample_id);
        $this->db->order_by('table_name', 'ASC');
        $this->db->order_by('source_name', 'ASC');
        $query = $this->db->get('supplementary_extraction_results');
        return $query->result_array();
    }

    /**
     * Get extraction results by project ID and table name
     * @param string $project_id Project ID
     * @param string $table_name Table name
     * @return array Extraction results
     */
    public function get_by_project_and_table($project_id, $table_name)
    {
        $this->db->where('id_project', $project_id);
        $this->db->where('table_name', $table_name);
        $this->db->order_by('id_one_water_sample', 'ASC');
        $this->db->order_by('source_name', 'ASC');
        $query = $this->db->get('supplementary_extraction_results');
        return $query->result_array();
    }

    /**
     * Check if extraction results exist for a project
     * @param string $project_id Project ID
     * @return bool True if results exist
     */
    public function has_extraction_results($project_id)
    {
        $this->db->where('id_project', $project_id);
        $count = $this->db->count_all_results('supplementary_extraction_results');
        return $count > 0;
    }

    /**
     * Get extraction statistics by project
     * @param string $project_id Project ID
     * @return array Statistics
     */
    public function get_extraction_stats($project_id)
    {
        $this->db->select('table_name, COUNT(*) as record_count, COUNT(DISTINCT id_one_water_sample) as sample_count');
        $this->db->where('id_project', $project_id);
        $this->db->group_by('table_name');
        $query = $this->db->get('supplementary_extraction_results');
        return $query->result_array();
    }
}
