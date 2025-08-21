<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Campy_liquids_model extends CI_Model
{

    function __construct()
    {
        parent::__construct();
    }

// datatables
    function json() {
        $this->datatables->select('cl.id_campy_liquids, cl.id_one_water_sample, cl.id_person, cl.number_of_tubes, cl.mpn_pcr_conducted, cl.campy_assay_barcode, 
        rp.initial, cl.date_sample_processed, cl.time_sample_processed, cl.elution_volume, cl.user_created, 
        cl.user_review,
        cl.review,
        user.full_name,
        cl.id_sampletype, rs.sampletype, GROUP_CONCAT(svl.vol_sampletube ORDER BY svl.tube_number SEPARATOR ", ") AS vol_sampletube, GROUP_CONCAT(svl.tube_number ORDER BY svl.tube_number SEPARATOR ", ") AS tube_number, cl.flag,
        cl.date_created, cl.date_updated, GREATEST(cl.date_created, cl.date_updated) AS latest_date');
        $this->datatables->from('campy_liquids AS cl');
        $this->datatables->join('ref_person AS rp', 'cl.id_person = rp.id_person', 'left');
        $this->datatables->join('ref_sampletype AS rs', 'cl.id_sampletype = rs.id_sampletype', 'left');
        $this->datatables->join('campy_sample_volumes_liquids AS svl', 'cl.id_campy_liquids = svl.id_campy_liquids', 'left');
        $this->datatables->join('tbl_user user', 'cl.user_review = user.id_users', 'left');
        // $this->datatables->where('lab', $this->session->userdata('lab'));
        $this->datatables->where('cl.flag', '0');
        // GROUP BY
        $this->datatables->group_by('cl.id_campy_liquids');
        $lvl = $this->session->userdata('id_user_level');
        if ($lvl == 4){
            $this->datatables->add_column('action', anchor(site_url('campy_liquids/read/$1'),'<i class="fa fa-th-list" aria-hidden="true"></i>', array('class' => 'btn btn-warning btn-sm')), 'id_one_water_sample');
        }
        else if ($lvl == 3){
            $this->datatables->add_column('action', anchor(site_url('campy_liquids/read/$1'),'<i class="fa fa-th-list" aria-hidden="true"></i>', array('class' => 'btn btn-warning btn-sm')) ."
                ".'<button type="button" class="btn_edit btn btn-info btn-sm" aria-hidden="true"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>', 'id_one_water_sample');
        }
        else {
            $this->datatables->add_column('action', anchor(site_url('campy_liquids/read/$1'),'<i class="fa fa-th-list" aria-hidden="true"></i>', array('class' => 'btn btn-warning btn-sm')) ."
            ".'<button type="button" class="btn_edit btn btn-info btn-sm" aria-hidden="true"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>'." 
            ".'<button type="button" class="btn_deleteCampyLiquids btn btn-danger btn-sm" data-id="$1" aria-hidden="true"><i class="fa fa-trash-o" aria-hidden="true"></i></button>', 'id_one_water_sample');
        }
        $this->db->order_by('latest_date', 'DESC');
        return $this->datatables->generate();
    }

    function subjsonCharcoal($id) {
        $this->datatables->select('rcl.id_result_charcoal_liquids, cl.campy_assay_barcode, rcl.id_campy_liquids, rcl.date_sample_processed, rcl.time_sample_processed,
        GROUP_CONCAT(sgpl.growth_plate ORDER BY sgpl.plate_number SEPARATOR ", ") AS growth_plate, GROUP_CONCAT(sgpl.plate_number ORDER BY sgpl.plate_number SEPARATOR ", ") AS plate_number, rcl.flag');
        $this->datatables->from('campy_result_charcoal_liquids AS rcl');
        $this->datatables->join('campy_liquids AS cl', 'rcl.id_campy_liquids = cl.id_campy_liquids', 'left');
        $this->datatables->join('campy_sample_growth_plate_liquids AS sgpl', 'rcl.id_result_charcoal_liquids = sgpl.id_result_charcoal_liquids', 'left');
        $this->datatables->where('rcl.flag', '0');
        $this->datatables->where('rcl.id_campy_liquids', $id);
        $this->datatables->group_by('
        rcl.id_result_charcoal_liquids, 
        cl.campy_assay_barcode, 
        rcl.id_campy_liquids, 
        rcl.date_sample_processed, 
        rcl.time_sample_processed,
        rcl.flag
        ');
        $lvl = $this->session->userdata('id_user_level');
        if ($lvl == 4){
            $this->datatables->add_column('action', '', 'id_result_charcoal_liquids');
        }
        else if ($lvl == 3){
            $this->datatables->add_column('action', '<button type="button" class="btn_edit_detResultsCharcoal btn btn-info btn-sm" aria-hidden="true"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>', 'id_result_charcoal_liquids');
        }
        else {
            $this->datatables->add_column('action', '<button type="button" class="btn_edit_detResultsCharcoal btn btn-info btn-sm" aria-hidden="true"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>'." 
                ".'<button type="button" class="btn_deleteCharcoal btn btn-danger btn-sm" data-id="$1" aria-hidden="true"><i class="fa fa-trash-o" aria-hidden="true"></i></button>', 'id_result_charcoal_liquids');
        }
        return $this->datatables->generate();
    }

    function subjsonHba($id) {
        $this->datatables->select('rhl.id_result_hba_liquids, cl.campy_assay_barcode, rhl.id_campy_liquids, rhl.date_sample_processed, rhl.time_sample_processed, 
        GROUP_CONCAT(sgphl.growth_plate ORDER BY sgphl.plate_number SEPARATOR ", ") AS growth_plate, GROUP_CONCAT(sgphl.plate_number ORDER BY sgphl.plate_number SEPARATOR ", ") AS plate_number, rhl.flag, sgphl.id_sample_plate_hba_liquids');
        $this->datatables->from('campy_result_hba_liquids AS rhl');
        $this->datatables->join('campy_liquids AS cl', 'rhl.id_campy_liquids = cl.id_campy_liquids', 'left');
        $this->datatables->join('campy_sample_growth_plate_hba_liquids AS sgphl', 'rhl.id_result_hba_liquids = sgphl.id_result_hba_liquids', 'left');
        $this->datatables->where('rhl.flag', '0');
        $this->datatables->where('rhl.id_campy_liquids', $id);
        $this->datatables->group_by('
        rhl.id_result_hba_liquids, 
        cl.campy_assay_barcode, 
        rhl.id_campy_liquids, 
        rhl.date_sample_processed, 
        rhl.time_sample_processed,
        rhl.flag
        ');
        $lvl = $this->session->userdata('id_user_level');
        if ($lvl == 4){
            $this->datatables->add_column('action', '', 'id_result_hba_liquids');
        }
        else if ($lvl == 3){
            $this->datatables->add_column('action', '<button type="button" class="btn_edit_detResultsHba btn btn-info btn-sm" aria-hidden="true"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>', 'id_result_hba_liquids');
        }
        else {
            $this->datatables->add_column('action', '<button type="button" class="btn_edit_detResultsHba btn btn-info btn-sm" aria-hidden="true"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>'." 
                ".'<button type="button" class="btn_deleteHba btn btn-danger btn-sm" data-id="$1" aria-hidden="true"><i class="fa fa-trash-o" aria-hidden="true"></i></button>', 'id_result_hba_liquids');
        }
        return $this->datatables->generate();
    }

    function subjsonBiochemical($id, $biochemical_tube) {

        $this->datatables->select('rbl.id_result_biochemical_liquids, rbl.id_campy_liquids, rbl.id_result_hba_liquids, cl.campy_assay_barcode, rbl.gramlysis, rbl.oxidase, rbl.catalase, rbl.confirmation, rbl.sample_store, rbl.biochemical_tube, rbl.flag');
        $this->datatables->from('campy_result_biochemical_liquids AS rbl');
        $this->datatables->join('campy_liquids AS cl', 'rbl.id_campy_liquids = cl.id_campy_liquids', 'left');
        $this->datatables->where('rbl.flag', '0');
        $this->datatables->where('rbl.id_campy_liquids', $id);
        
        // Add condition for biochemical_tube if it exists
        if (!empty($biochemical_tube)) {
            $this->datatables->where('rbl.biochemical_tube', $biochemical_tube);
        }
    
        $lvl = $this->session->userdata('id_user_level');
        if ($lvl == 4){
            $this->datatables->add_column('action', '', 'id_result_biochemical_liquids');
        } else if ($lvl == 3){
            $this->datatables->add_column('action', '<button type="button" class="btn_edit_detResultsBiochemical btn btn-info btn-sm" aria-hidden="true"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>', 'id_result_biochemical_liquids');
        } else {
            $this->datatables->add_column('action', '<button type="button" class="btn_edit_detResultsBiochemical btn btn-info btn-sm" aria-hidden="true"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>'." 
                ".'<button type="button" class="btn_deleteBiochemical btn btn-danger btn-sm" data-id="$1" aria-hidden="true"><i class="fa fa-trash-o" aria-hidden="true"></i></button>', 'id_result_biochemical_liquids');
        }
        return $this->datatables->generate();
    }

    function subjsonFinalConcentration($id)
    {
        $response = array();
    
        // Step 1: Get unique tube_number
        $this->db->select('tube_number');
        $this->db->distinct();
        $this->db->from('campy_sample_volumes_liquids');
        $this->db->where('id_campy_liquids', $id);
        $this->db->order_by('tube_number', 'ASC');
        $tube_numbers = $this->db->get()->result_array();
    
        // Check if tube numbers are empty
        if (empty($tube_numbers)) {
            return []; // Handle case where no tube numbers found
        }
    
        // Step 2: Create case query for pivot
        $case_statements = [];
        foreach ($tube_numbers as $row) {
            $tube_number = $row['tube_number'];
            $case_statements[] = "MAX(CASE WHEN svl1.tube_number = {$tube_number} THEN svl1.vol_sampletube END) AS `Tube {$tube_number}`";
        }
        $case_query = implode(', ', $case_statements);
    
        // Final query
        $this->db->select("cl.id_one_water_sample, cl.id_person, rp.initial, cl.mpn_pcr_conducted, cl.number_of_tubes, cl.campy_assay_barcode, cl.date_sample_processed, cl.time_sample_processed, cl.elution_volume, rs.sampletype,
                           $case_query, 
                           GROUP_CONCAT(DISTINCT rbl.biochemical_tube ORDER BY rbl.biochemical_tube SEPARATOR ', ') AS biochemical_tube, 
                           GROUP_CONCAT(DISTINCT CONCAT(rbl.biochemical_tube, ':', rbl.confirmation) ORDER BY rbl.biochemical_tube SEPARATOR ', ') AS confirmation,
                           GROUP_CONCAT(DISTINCT sgphl.plate_number ORDER BY sgphl.plate_number SEPARATOR ', ') AS plate_numbers");
        $this->db->from('campy_liquids AS cl');
        $this->db->join('campy_result_hba_liquids AS rhl', 'cl.id_campy_liquids = rhl.id_campy_liquids', 'left');
        $this->db->join('campy_sample_growth_plate_hba_liquids AS sgphl', 'rhl.id_result_hba_liquids = sgphl.id_result_hba_liquids', 'left');
        $this->db->join('campy_sample_volumes_liquids AS svl1', 'rhl.id_campy_liquids = svl1.id_campy_liquids', 'left');
        $this->db->join('campy_result_biochemical_liquids AS rbl', 'sgphl.id_result_hba_liquids = rbl.id_result_hba_liquids', 'left');
        $this->db->join('ref_sampletype AS rs', 'cl.id_sampletype = rs.id_sampletype', 'left');
        $this->db->join('ref_person AS rp',  'cl.id_person = rp.id_person', 'left');
    
        // Conditions
        $this->db->where('rbl.flag', '0');
        $this->db->where('rhl.id_campy_liquids', $id);
        $this->db->group_by('rhl.id_result_hba_liquids');
    
        $q = $this->db->get();
    
        if ($q->num_rows() > 0) {
            $response = $q->result(); // Fetch all results if available
            foreach ($response as $key => $value) {
                $confirmations = explode(',', $value->confirmation);
                $biochemical_tubes = explode(',', $value->biochemical_tube);
    
                $confirmation_array = []; // Inisialisasi array konfirmasi

                // Creating an associative array for confirmation
                foreach ($biochemical_tubes as $index => $tube) {
                    $confirmation_array[$tube] = explode(':', $confirmations[$index] ?? 'No Growth Plate')[1] ?? 'No Growth Plate'; // Default to "No Growth"
                }
                $value->confirmation = $confirmation_array; // Assign confirmation yang sudah diproses
            }
        }
    
        return $response;
    }

    
    
     

    function get_export($id) {
        $response = array();
    
        // Step 1: Get unique tube_number
        $this->db->select('tube_number');
        $this->db->distinct();
        $this->db->from('campy_sample_volumes_liquids');
        $this->db->where('id_campy_liquids', $id);
        $this->db->order_by('tube_number', 'ASC');
        $tube_numbers = $this->db->get()->result_array();
    
        // Check if tube numbers are empty
        if (empty($tube_numbers)) {
            return []; // Handle case where no tube numbers found
        }
    
        // Store unique tube numbers for further processing
        $tube_numbers_list = array_column($tube_numbers, 'tube_number');
    
        // Step 2: Create case query for pivot
        $case_statements = [];
        foreach ($tube_numbers as $row) {
            $tube_number = $row['tube_number'];
            $case_statements[] = "MAX(CASE WHEN svl1.tube_number = {$tube_number} THEN svl1.vol_sampletube END) AS `Tube {$tube_number}`";
        }
        $case_query = implode(', ', $case_statements);
    
        // Final query
        $this->db->select("cl.id_one_water_sample, cl.id_person, rp.initial, cl.mpn_pcr_conducted, cl.number_of_tubes, cl.campy_assay_barcode, cl.date_sample_processed, cl.time_sample_processed, cl.elution_volume, rs.sampletype,
                           $case_query, 
                           GROUP_CONCAT(DISTINCT rbl.biochemical_tube ORDER BY rbl.biochemical_tube SEPARATOR ', ') AS biochemical_tube, 
                           GROUP_CONCAT(DISTINCT CONCAT(rbl.biochemical_tube, ':', rbl.confirmation) ORDER BY rbl.biochemical_tube SEPARATOR ', ') AS confirmation,
                           GROUP_CONCAT(DISTINCT sgphl.plate_number ORDER BY sgphl.plate_number SEPARATOR ', ') AS plate_numbers");
        $this->db->from('campy_liquids AS cl');
        $this->db->join('campy_result_hba_liquids AS rhl', 'cl.id_campy_liquids = rhl.id_campy_liquids', 'left');
        $this->db->join('campy_sample_growth_plate_hba_liquids AS sgphl', 'rhl.id_result_hba_liquids = sgphl.id_result_hba_liquids', 'left');
        $this->db->join('campy_sample_volumes_liquids AS svl1', 'rhl.id_campy_liquids = svl1.id_campy_liquids', 'left');
        $this->db->join('campy_result_biochemical_liquids AS rbl', 'sgphl.id_result_hba_liquids = rbl.id_result_hba_liquids', 'left');
        $this->db->join('ref_sampletype AS rs', 'cl.id_sampletype = rs.id_sampletype', 'left');
        $this->db->join('ref_person AS rp',  'cl.id_person = rp.id_person', 'left');
    
        // Conditions
        $this->db->where('rbl.flag', '0');
        $this->db->where('rhl.id_campy_liquids', $id);
        $this->db->group_by('rhl.id_result_hba_liquids');
    
        $q = $this->db->get();
    
        if ($q->num_rows() > 0) {
            $response = $q->result(); // Fetch all results if available
            foreach ($response as $key => $value) {
                $confirmations = explode(',', $value->confirmation);
                $biochemical_tubes = explode(',', $value->biochemical_tube);
                $plate_numbers = explode(',', $value->plate_numbers);
    
                // Initialize confirmation array for each plate_number
                $confirmation_array = array_fill_keys($plate_numbers, 'No Growth'); // Default to "No Growth"
    
                // Fill in confirmation values from biochemical_tubes
                foreach ($biochemical_tubes as $tube) {
                    $index = array_search($tube, $biochemical_tubes);
                    if ($index !== false) {
                        $confirmation_value = explode(':', $confirmations[$index] ?? 'No Growth')[1] ?? 'No Growth'; // Default if not set
                        $confirmation_array[$tube] = $confirmation_value;
                    }
                }
    
                $value->confirmation = $confirmation_array; // Assign processed confirmation
            }
        }
    
        return $response;
    }
    
    function get_all_export() {
        $response = array();
    
        // Step 1: Get unique tube_number
        $this->db->select('tube_number');
        $this->db->distinct();
        $this->db->from('campy_sample_volumes_liquids');
        $this->db->where('id_campy_liquids IS NOT NULL');
        $this->db->order_by('tube_number', 'ASC');
        $tube_numbers = $this->db->get()->result_array();
    
        // Debugging: Cek apakah tube numbers ditemukan
        if (empty($tube_numbers)) {
            echo "No tube numbers found.";
            return []; // Handle case where no tube numbers found
        }
    
        // Store unique tube numbers for further processing
        $tube_numbers_list = array_column($tube_numbers, 'tube_number');
    
        // Step 2: Create case query for pivot
        $case_statements = [];
        foreach ($tube_numbers_list as $tube_number) {
            $case_statements[] = "MAX(CASE WHEN svl1.tube_number = {$tube_number} THEN svl1.vol_sampletube END) AS `Tube {$tube_number}`";
        }
        $case_query = implode(', ', $case_statements);
    
        // Final query
        $this->db->select("cl.id_one_water_sample, cl.id_person, rp.initial, cl.mpn_pcr_conducted, cl.number_of_tubes, cl.campy_assay_barcode, cl.date_sample_processed, cl.time_sample_processed, cl.elution_volume, rs.sampletype,
                           $case_query, 
                           GROUP_CONCAT(DISTINCT rbl.biochemical_tube ORDER BY rbl.biochemical_tube SEPARATOR ', ') AS biochemical_tube, 
                           GROUP_CONCAT(DISTINCT CONCAT(rbl.biochemical_tube, ':', rbl.confirmation) ORDER BY rbl.biochemical_tube SEPARATOR ', ') AS confirmation,
                           GROUP_CONCAT(DISTINCT sgphl.plate_number ORDER BY sgphl.plate_number SEPARATOR ', ') AS plate_numbers");
        $this->db->from('campy_liquids AS cl');
        $this->db->join('campy_result_hba_liquids AS rhl', 'cl.id_campy_liquids = rhl.id_campy_liquids', 'left');
        $this->db->join('campy_sample_growth_plate_hba_liquids AS sgphl', 'rhl.id_result_hba_liquids = sgphl.id_result_hba_liquids', 'left');
        $this->db->join('campy_sample_volumes_liquids AS svl1', 'rhl.id_campy_liquids = svl1.id_campy_liquids', 'left');
        $this->db->join('campy_result_biochemical_liquids AS rbl', 'sgphl.id_result_hba_liquids = rbl.id_result_hba_liquids', 'left');
        $this->db->join('ref_sampletype AS rs', 'cl.id_sampletype = rs.id_sampletype', 'left');
        $this->db->join('ref_person AS rp', 'cl.id_person = rp.id_person', 'left');
    
        // Conditions
        $this->db->where('rbl.flag', '0');
        $this->db->where('svl1.flag', '0');
        $this->db->group_by('rhl.id_result_hba_liquids');
    
        $q = $this->db->get();
    
        if ($q->num_rows() > 0) {
            $response = $q->result();
            foreach ($response as $value) {
                // Memproses konfirmasi
                $confirmations = explode(',', $value->confirmation);
                $biochemical_tubes = explode(',', $value->biochemical_tube);
                $plate_numbers = explode(',', $value->plate_numbers);
    
                // Inisialisasi array konfirmasi dengan kunci sesuai dengan jumlah tabung
                $confirmation_array = array_fill_keys($tube_numbers_list, 'No Growth'); // Default ke "No Growth"
    
                // Mengisi nilai konfirmasi berdasarkan indeks tabung
                foreach ($biochemical_tubes as $index => $tube) {
                    $confirmation_value = explode(':', $confirmations[$index] ?? 'No Growth')[1] ?? 'No Growth';
                    $confirmation_array[(int)$tube] = $confirmation_value; // Gunakan kunci tabung sebagai index
                }
    
                // Assign konfirmasi yang sudah diproses
                $value->confirmation = $confirmation_array;
            }
        } else {
            echo "No data found for the given query.";
        }
    
        return $response;
    }
    
    
    

    function get_by_id($id)
    {
        $this->db->where($this->id, $id);
        $this->db->where('flag', '0');
        // $this->db->where('lab', $this->session->userdata('lab'));
        return $this->db->get($this->table)->row();
    }

    function get_detail($id)
    {
      $response = array();
      $this->db->select('cl.id_campy_liquids, cl.id_one_water_sample, cl.id_person, rp.initial, cl.number_of_tubes,
        cl.id_sampletype, rs.sampletype, cl.mpn_pcr_conducted, cl.campy_assay_barcode, cl.date_sample_processed,
        cl.user_review, 
        cl.review, 
        user.full_name,
        cl.user_created, 
        cl.time_sample_processed, cl.time_sample_processed, cl.elution_volume,
        GROUP_CONCAT(svl.vol_sampletube ORDER BY svl.tube_number SEPARATOR ", ") AS vol_sampletube, 
        GROUP_CONCAT(svl.tube_number ORDER BY svl.tube_number SEPARATOR ", ") AS tube_number');
      $this->db->from('campy_liquids AS cl');
      $this->db->join('ref_sampletype AS rs', 'cl.id_sampletype = rs.id_sampletype', 'left');
      $this->db->join('campy_sample_volumes_liquids AS svl', 'cl.id_campy_liquids = svl.id_campy_liquids', 'left');
      $this->db->join('ref_person AS rp', 'cl.id_person = rp.id_person', 'left');
      $this->db->join('tbl_user user', 'cl.user_review = user.id_users', 'left');
      $this->db->where('cl.id_one_water_sample', $id);
      $this->db->where('cl.flag', 0);
      $query = $this->db->get();
      
      if ($query->num_rows() > 0) {
        $response = $query->row();
      }
      
      return $response;
    }
    

    function get_detail2($id)
    {
      $response = array();
      $this->db->select('*');
      $this->db->where('sample_reception_sample.id_sample', $id);
      $this->db->where('sample_reception_sample.flag', '0');
      $q = $this->db->get('sample_reception_sample');
      $response = $q->row();
      return $response;
    }
    

    function getSampleType(){
        $response = array();
        $this->db->select('*');
        $this->db->where('flag', '0');
        $this->db->order_by('sampletype', 'DESC');
        $q = $this->db->get('ref_sampletype');
        $response = $q->result_array();
        return $response;
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

      function getID_one(){
        $q = $this->db->query('
        SELECT id_one_water_sample FROM sample_reception_sample
        WHERE id_one_water_sample NOT IN (SELECT id_one_water_sample FROM campy_liquids)
        AND flag = 0');       
        $response = $q->result_array();
        return $response;
    }

    function getOneWaterSampleById($idOneWaterSample)
    {
        $this->db->select('sr.id_sampletype, rs.sampletype');
        $this->db->from('sample_reception_sample sr');
        $this->db->join('ref_sampletype rs', 'sr.id_sampletype = rs.id_sampletype', 'left');
        $this->db->where('sr.id_one_water_sample', $idOneWaterSample);
        $query = $this->db->get();
        return $query->row_array();
    }

    function validateCampyAssayBarcode($id){
        $q = $this->db->query('
        SELECT campy_assay_barcode FROM campy_liquids
        WHERE campy_assay_barcode = "'.$id.'"
        AND flag = 0 
        ');        
        $response = $q->result_array();
        return $response;
    }

    function getTubes() {
        $response = array();
        $this->db->select('*');
        $this->db->where('flag', '0');
        $this->db->where('value !=', 1);
        $this->db->order_by('value');
        $labTech = $this->db->get('ref_tubes');
        $response = $labTech->result_array();
        return $response;
    }



    public function insert($data) {
        $this->db->insert('campy_liquids', $data);
        return $this->db->insert_id(); // Return the last inserted ID
    }
    
    public function insert_sample_volume_liquids($data) {
        $this->db->insert('campy_sample_volumes_liquids', $data);
    }
    
    function updateCampyLiquids($id, $data) {
        $this->db->where('id_campy_liquids', $id);
        $this->db->update('campy_liquids', $data);
    }

    public function delete_sample_volumes_liquids($id_campy_liquids) {
        $this->db->where('id_campy_liquids', $id_campy_liquids);
        $this->db->delete('campy_sample_volumes_liquids');
    }

    public function insertResultsCharcoal($data) {
        $this->db->insert('campy_result_charcoal_liquids', $data);
        return $this->db->insert_id(); // Return the last inserted ID
    }

    public function insert_growth_plate($data) {
        $this->db->insert('campy_sample_growth_plate_liquids', $data);
    }

    function updateResultsCharcoal($id, $data) {
        $this->db->where('id_result_charcoal_liquids', $id);
        $this->db->update('campy_result_charcoal_liquids', $data);
    }

    public function delete_growth_plates($id_result_charcoal_liquids) {
        $this->db->where('id_result_charcoal_liquids', $id_result_charcoal_liquids);
        $this->db->delete('campy_sample_growth_plate_liquids');
    }

    function get_by_id_charcoal($id)
    {
        $this->db->where('id_result_charcoal', $id);
        $this->db->where('flag', '0');
        return $this->db->get('result_charcoal')->row();
    }

    function updateResultsGrowthPlate($id, $data) {
        $this->db->where('id_result_charcoal', $id);
        $this->db->update('sample_growth_plate', $data);
    }

    function get_by_id_campyliquids($id)
    {
        $this->db->where('id_campy_liquids', $id);
        $this->db->where('flag', '0');
        return $this->db->get('campy_liquids')->row();
    }

    function updateSampleVolume($id, $data) {
        $this->db->where('id_campy_liquids', $id);
        $this->db->update('sample_volumes', $data);
    }

    function insertResultsHba($data) {
        $this->db->insert('campy_result_hba_liquids', $data);
        return $this->db->insert_id();
    }

    public function insert_growth_plate_hba($data) {
        $this->db->insert('campy_sample_growth_plate_hba_liquids', $data);
    }

    function updateResultsHba($id_result_hba_liquids, $data) {
        $this->db->where('id_result_hba_liquids', $id_result_hba_liquids);
        $this->db->update('campy_result_hba_liquids', $data);
    }

    public function delete_growth_plates_hba($id_result_hba_liquids) {
        $this->db->where('id_result_hba_liquids', $id_result_hba_liquids);
        $this->db->delete('campy_sample_growth_plate_hba_liquids');
    }

    function get_by_id_hba($id)
    {
        $this->db->where('id_result_hba', $id);
        $this->db->where('flag', '0');
        return $this->db->get('result_hba')->row();
    }

    function updateResultsGrowthPlateHba($id, $data) {
        $this->db->where('id_result_hba', $id);
        $this->db->update('sample_growth_plate_hba', $data);
    }

    function insertResultsBiochemical($data) {
        $this->db->insert('campy_result_biochemical_liquids', $data);
        return $this->db->insert_id();
    }
    
    function get_by_id_biochemical($id)
    {
        $this->db->where('id_result_biochemical_liquids', $id);
        $this->db->where('flag', '0');
        return $this->db->get('campy_result_biochemical_liquids')->row();
    }

    function updateResultsBiochemical($id_result_biochemical_liquids, $data) {
        $this->db->where('id_result_biochemical_liquids', $id_result_biochemical_liquids);
        $this->db->update('campy_result_biochemical_liquids', $data);
    }

    function barcode_restrict($id){

        $q = $this->db->query('
        select id_one_water_sample
        from campy_liquids
        WHERE id_one_water_sample = "'.$id.'"
        ');        
        $response = $q->result_array();
        return $response;
      } 
    
    function update_campy_liquids($id_one_water_sample, $data)
    {
        $this->db->where('id_one_water_sample', $id_one_water_sample);
        $this->db->update('campy_liquids', $data);
    }

    function updateCancel($id, $data)
    {
        $this->db->where('id_one_water_sample', $id);
        $this->db->update('campy_liquids', $data);

        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

      
}

/* End of file Tbl_delivery_model.php */
/* Location: ./application/models/Tbl_delivery_model.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2022-12-14 03:38:42 */
/* http://harviacode.com */