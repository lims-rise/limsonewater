<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Sequencing_model extends CI_Model
{

    public $table = 'sequencing';
    public $id = 'id_one_water_sample';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

    // datatables - Show sequencing data from sequencing table only
    function json() {
        // Show data from sequencing table with aggregated sequence counts from extraction_culture_plate
        $this->datatables->select('NULL AS toggle, s.id_one_water_sample, s.sequencing_barcode,
            (SELECT COUNT(DISTINCT ecp.barcode_tube) FROM extraction_culture_plate ecp WHERE ecp.id_one_water_sample = s.id_one_water_sample AND ecp.flag = 0 AND ecp.barcode_tube IS NOT NULL AND ecp.barcode_tube != "") as tube_count,
            (SELECT SUM(CASE WHEN ecp.sequence = "1" OR ecp.sequence = 1 THEN 1 ELSE 0 END) FROM extraction_culture_plate ecp WHERE ecp.id_one_water_sample = s.id_one_water_sample AND ecp.flag = 0) as sequence_count', FALSE);
        $this->datatables->from('sequencing s');
        
        // Filter by specific sample ID if provided (from Sample Reception redirect)
        if ($this->input->get_post('search_sample_id')) {
            $this->datatables->like('s.id_one_water_sample', $this->input->get_post('search_sample_id'));
        }

        $this->datatables->where('s.flag', '0');
        
        // No action column needed for parent table

        return $this->datatables->generate();
    }

    // subjson for child data (tubes detail) - Simple approach without datatables library
    function subjson($id) {
        try {
            $this->db->select('
                ecp.id_extraction_culture_plate,
                ecp.barcode_sample, 
                ecp.barcode_tube,
                ecp.sequence,
                rs.sequence_type,
                ecp.custom_sequence_type,
                ecp.species_id,
                ecp.comments
            ');
            $this->db->from('extraction_culture_plate ecp');
            $this->db->join('ref_sequence rs', 'ecp.sequence_id = rs.sequence_id', 'left');
            $this->db->where('ecp.id_one_water_sample', $id);
            $this->db->where('ecp.flag', '0');
            $this->db->where('ecp.barcode_tube IS NOT NULL');
            $this->db->where('ecp.barcode_tube !=', '');
            $this->db->order_by('ecp.barcode_tube', 'ASC');
            
            $query = $this->db->get();
            $data = array();
            
            if ($query->num_rows() > 0) {
                foreach ($query->result_array() as $row) {
                    // No action buttons needed for sequencing module
                    $data[] = $row;
                }
            }
            
            // Return DataTables compatible JSON
            return json_encode(array(
                'draw' => 1,
                'recordsTotal' => count($data),
                'recordsFiltered' => count($data),
                'data' => $data
            ));
            
        } catch (Exception $e) {
            log_message('error', 'Subjson error: ' . $e->getMessage());
            return json_encode(array(
                'draw' => 1,
                'recordsTotal' => 0,
                'recordsFiltered' => 0,
                'data' => array(),
                'error' => $e->getMessage()
            ));
        }
    }

    function getID_one(){
        $q = $this->db->query('
        SELECT id_one_water_sample FROM sample_reception_sample
        WHERE id_one_water_sample NOT IN (SELECT id_one_water_sample FROM sequencing)
        AND flag = 0
        ORDER BY id_one_water_sample');        
        $response = $q->result_array();
        return $response;
      }


    function get_by_id($id)
    {
        $this->db->where($this->id, $id);
        $this->db->where('flag', '0');
        // $this->db->where('lab', $this->session->userdata('lab'));
        return $this->db->get($this->table)->row();
    }

    // Fuction insert data
    public function insert($data) {
        // Ensure is_status is set to 1 (Completed) for all new sequencing records
        if (!isset($data['is_status'])) {
            $data['is_status'] = 1;
        }
        $this->db->insert('sequencing', $data);
    }



    function updateSequencingData($id_sequencing, $data) {
        // Ensure is_status is set to 1 (Completed) for all sequencing updates
        if (!isset($data['is_status'])) {
            $data['is_status'] = 1;
        }
        $this->db->where('id_sequencing', $id_sequencing);
        $this->db->update('sequencing', $data);
    }



    // delete data
    function delete($id)
    {
        $this->db->where($this->id, $id);
        $this->db->delete($this->table);
    }



    

      function getLabtech() {
        $response = array();
        $this->db->select('*');
        $this->db->where('flag', '0');
        $this->db->order_by('realname');
        $labTech = $this->db->get('ref_person');
        $response = $labTech->result_array();
        return $response;
      }







    // ============ SEQUENCE FUNCTIONS ============

    // Method to get available barcode tubes from extraction_culture_plate
    function getExtractionCultureBarcodeTubes($id_one_water_sample) {
        try {
            // Use the same structure as Sample_reception_model (working version)
            $this->db->select('extraction_culture_plate.barcode_tube, extraction_culture_plate.barcode_sample, extraction_culture_plate.sequence, extraction_culture_plate.sequence_id, rs.sequence_type, extraction_culture_plate.custom_sequence_type, extraction_culture_plate.species_id');
            $this->db->from('extraction_culture_plate');
            $this->db->join('ref_sequence rs', 'extraction_culture_plate.sequence_id = rs.sequence_id', 'left');
            $this->db->where('extraction_culture_plate.id_one_water_sample', $id_one_water_sample);
            $this->db->where('extraction_culture_plate.flag', '0');
            $this->db->where('extraction_culture_plate.barcode_tube IS NOT NULL');
            $this->db->where('extraction_culture_plate.barcode_tube != ""');
            $this->db->order_by('extraction_culture_plate.barcode_tube', 'ASC');
            
            $query = $this->db->get();
            
            if (!$query) {
                log_message('error', 'Database query failed in getExtractionCultureBarcodeTubes');
                return array();
            }
            
            $result = $query->result_array();
            
            // Add sequence_status field
            foreach ($result as &$row) {
                $row['sequence_status'] = ($row['sequence'] == 1) ? 'Has Sequence' : 'No Sequence';
            }
            
            return $result;
            
        } catch (Exception $e) {
            log_message('error', 'Exception in getExtractionCultureBarcodeTubes: ' . $e->getMessage());
            return array();
        }
    }

    // Method to get extraction culture data by barcode for relational IDs
    function getExtractionCultureDataByBarcode($barcode_tube, $barcode_sample = null) {
        $this->db->select('ecp.id_extraction_culture_plate, ecp.barcode_sample, ecp.barcode_tube');
        $this->db->from('extraction_culture_plate ecp');
        $this->db->where('ecp.barcode_tube', $barcode_tube);
        
        if (!empty($barcode_sample)) {
            $this->db->where('ecp.barcode_sample', $barcode_sample);
        }
        
        $this->db->where('ecp.flag', '0');
        $this->db->order_by('ecp.id_extraction_culture_plate', 'DESC');
        $query = $this->db->get();
        
        if ($query->num_rows() > 0) {
            return $query->row();
        }
        return false;
    }

    // Method to get sequence data by barcode tube (same as Sample Reception)
    function getSequenceDataByBarcodeTube($barcode_tube, $barcode_sample = null) {
        $this->db->select('ecp.barcode_sample, ecp.barcode_tube, ecp.sequence, ecp.sequence_id, rs.sequence_type, ecp.custom_sequence_type, ecp.species_id');
        $this->db->from('extraction_culture_plate ecp');
        $this->db->join('ref_sequence rs', 'ecp.sequence_id = rs.sequence_id', 'left');
        $this->db->where('ecp.barcode_tube', $barcode_tube);
        
        if (!empty($barcode_sample)) {
            $this->db->where('ecp.barcode_sample', $barcode_sample);
        }
        
        $this->db->where('ecp.flag', '0');
        $this->db->order_by('ecp.id_extraction_culture_plate', 'DESC');
        $query = $this->db->get();
        
        if ($query->num_rows() > 0) {
            return $query->row();
        }
        return false;
    }

    // Method to get sequence types from ref_sequence
    function getSequenceTypes() {
        $this->db->select('sequence_id, sequence_type');
        $this->db->from('ref_sequence');
        $this->db->where('flag', 0);
        $this->db->order_by('sequence_id', 'ASC');
        
        $query = $this->db->get();
        return $query->result_array();
    }

    // Method to get existing sequencing record by barcode
    // Function to get sequencing record by sample and sequencing_barcode
    function getSequencingRecord($id_one_water_sample, $sequencing_barcode) {
        $this->db->where('id_one_water_sample', $id_one_water_sample);
        $this->db->where('sequencing_barcode', $sequencing_barcode);
        $this->db->where('flag', '0');
        $query = $this->db->get('sequencing');
        
        if ($query->num_rows() > 0) {
            return $query->row();
        }
        return false;
    }

    // Method to update sequence data in extraction_culture_plate using barcode
    function updateSequenceDataByBarcode($barcode_sample, $data) {
        $this->db->where('barcode_sample', $barcode_sample);
        $this->db->where('flag', 0);
        $this->db->update('extraction_culture_plate', $data);
        return $this->db->affected_rows() > 0;
    }

      
}

/* End of file Tbl_delivery_model.php */
/* Location: ./application/models/Tbl_delivery_model.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2022-12-14 03:38:42 */
/* http://harviacode.com */