<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Campy_biosolids_model extends CI_Model
{
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

    // datatables
    function json() {
        $this->datatables->select('cb.id_campy_biosolids, cb.id_one_water_sample, cb.id_person, cb.number_of_tubes, cb.mpn_pcr_conducted, cb.campy_assay_barcode, 
        cb.user_review,
        cb.review,
        user.full_name,
        cb.dry_weight_persen,
        cb.sample_dryweight,
        rp.initial, cb.date_sample_processed, cb.time_sample_processed, cb.sample_wetweight, cb.elution_volume,
        cb.id_sampletype, rs.sampletype, GROUP_CONCAT(sv.vol_sampletube ORDER BY sv.tube_number SEPARATOR ", ") AS vol_sampletube, GROUP_CONCAT(sv.tube_number ORDER BY sv.tube_number SEPARATOR ", ") AS tube_number, cb.flag,
        cb.date_created, cb.date_updated, GREATEST(cb.date_created, cb.date_updated) AS latest_date');
        $this->datatables->from('campy_biosolids AS cb');
        $this->datatables->join('ref_person AS rp', 'cb.id_person = rp.id_person', 'left');
        $this->datatables->join('ref_sampletype AS rs', 'cb.id_sampletype = rs.id_sampletype', 'left');
        $this->datatables->join('campy_sample_volumes AS sv', 'cb.id_campy_biosolids = sv.id_campy_biosolids', 'left');
        $this->datatables->join('tbl_user user', 'cb.user_review = user.id_users', 'left');
        // $this->datatables->where('lab', $this->session->userdata('lab'));
        $this->datatables->where('cb.flag', '0');
        // GROUP BY
        $this->datatables->group_by('cb.id_campy_biosolids');
        $lvl = $this->session->userdata('id_user_level');
        if ($lvl == 4){
            $this->datatables->add_column('action', anchor(site_url('campy_biosolids/read/$1'),'<i class="fa fa-th-list" aria-hidden="true"></i>', array('class' => 'btn btn-warning btn-sm')), 'id_one_water_sample');
        }
        else if ($lvl == 3){
            $this->datatables->add_column('action', anchor(site_url('campy_biosolids/read/$1'),'<i class="fa fa-th-list" aria-hidden="true"></i>', array('class' => 'btn btn-warning btn-sm')) ."
                ".'<button type="button" class="btn_edit btn btn-info btn-sm" aria-hidden="true"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>', 'id_one_water_sample');
        }
        else {
            $this->datatables->add_column('action', anchor(site_url('campy_biosolids/read/$1'),'<i class="fa fa-th-list" aria-hidden="true"></i>', array('class' => 'btn btn-warning btn-sm')) ."
            ".'<button type="button" class="btn_edit btn btn-info btn-sm" aria-hidden="true"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>'." 
            ".'<button type="button" class="btn_deleteCampyBiosolids btn btn-danger btn-sm" data-id="$1" aria-hidden="true"><i class="fa fa-trash-o" aria-hidden="true"></i></button>', 'id_one_water_sample');
        }
        $this->db->order_by('latest_date', 'DESC');
        return $this->datatables->generate();
    }

    function subjsonCharcoal($id) {
        $this->datatables->select('rc.id_result_charcoal, cb.campy_assay_barcode, rc.id_campy_biosolids, rc.date_sample_processed, rc.time_sample_processed,
        GROUP_CONCAT(sgp.growth_plate ORDER BY sgp.plate_number SEPARATOR ", ") AS growth_plate, GROUP_CONCAT(sgp.plate_number ORDER BY sgp.plate_number SEPARATOR ", ") AS plate_number, rc.flag');
        $this->datatables->from('campy_result_charcoal AS rc');
        $this->datatables->join('campy_biosolids AS cb', 'rc.id_campy_biosolids = cb.id_campy_biosolids', 'left');
        $this->datatables->join('campy_sample_growth_plate AS sgp', 'rc.id_result_charcoal = sgp.id_result_charcoal', 'left');
        $this->datatables->where('rc.flag', '0');
        $this->datatables->where('rc.id_campy_biosolids', $id);
        $this->datatables->group_by('
        rc.id_result_charcoal, 
        cb.campy_assay_barcode, 
        rc.id_campy_biosolids, 
        rc.date_sample_processed, 
        rc.time_sample_processed,
        rc.flag
        ');
        $lvl = $this->session->userdata('id_user_level');
        if ($lvl == 4){
            $this->datatables->add_column('action', '', 'id_result_charcoal');
        }
        else if ($lvl == 3){
            $this->datatables->add_column('action', '<button type="button" class="btn_edit_detResultsCharcoal btn btn-info btn-sm" aria-hidden="true"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>', 'id_result_charcoal');
        }
        else {
            $this->datatables->add_column('action', '<button type="button" class="btn_edit_detResultsCharcoal btn btn-info btn-sm" aria-hidden="true"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>'." 
                ".'<button type="button" class="btn_deleteCharcoal btn btn-danger btn-sm" data-id="$1" aria-hidden="true"><i class="fa fa-trash-o" aria-hidden="true"></i></button>', 'id_result_charcoal');
        }
        return $this->datatables->generate();
    }

    function subjsonHba($id) {
        $this->datatables->select('rh.id_result_hba, cb.campy_assay_barcode, rh.id_campy_biosolids, rh.date_sample_processed, rh.time_sample_processed, 
        GROUP_CONCAT(sgph.growth_plate ORDER BY sgph.plate_number SEPARATOR ", ") AS growth_plate, GROUP_CONCAT(sgph.plate_number ORDER BY sgph.plate_number SEPARATOR ", ") AS plate_number, rh.flag, sgph.id_sample_plate_hba');
        $this->datatables->from('campy_result_hba AS rh');
        $this->datatables->join('campy_biosolids AS cb', 'rh.id_campy_biosolids = cb.id_campy_biosolids', 'left');
        $this->datatables->join('campy_sample_growth_plate_hba AS sgph', 'rh.id_result_hba = sgph.id_result_hba', 'left');
        $this->datatables->where('rh.flag', '0');
        $this->datatables->where('rh.id_campy_biosolids', $id);
        $this->datatables->group_by('
        rh.id_result_hba, 
        cb.campy_assay_barcode, 
        rh.id_campy_biosolids, 
        rh.date_sample_processed, 
        rh.time_sample_processed,
        rh.flag
        ');
        $lvl = $this->session->userdata('id_user_level');
        if ($lvl == 4){
            $this->datatables->add_column('action', '', 'id_result_hba');
        }
        else if ($lvl == 3){
            $this->datatables->add_column('action', '<button type="button" class="btn_edit_detResultsHba btn btn-info btn-sm" aria-hidden="true"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>', 'id_result_hba');
        }
        else {
            $this->datatables->add_column('action', '<button type="button" class="btn_edit_detResultsHba btn btn-info btn-sm" aria-hidden="true"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>'." 
                ".'<button type="button" class="btn_deleteHba btn btn-danger btn-sm" data-id="$1" aria-hidden="true"><i class="fa fa-trash-o" aria-hidden="true"></i></button>', 'id_result_hba');
        }
        return $this->datatables->generate();
    }

    function subjsonBiochemical($id, $biochemical_tube) {

        $this->datatables->select('rb.id_result_biochemical, rb.id_campy_biosolids, rb.id_result_hba, cb.campy_assay_barcode, rb.gramlysis, rb.oxidase, rb.catalase, rb.confirmation, rb.sample_store, rb.biochemical_tube, rb.flag');
        $this->datatables->from('campy_result_biochemical AS rb');
        $this->datatables->join('campy_biosolids AS cb', 'rb.id_campy_biosolids = cb.id_campy_biosolids', 'left');
        $this->datatables->where('rb.flag', '0');
        $this->datatables->where('rb.id_campy_biosolids', $id);
        
       // Add condition for biochemical_tube if it exists
        if (!empty($biochemical_tube)) {
            $this->datatables->where('rb.biochemical_tube', $biochemical_tube);
        }
    
        $lvl = $this->session->userdata('id_user_level');
        if ($lvl == 4){
            $this->datatables->add_column('action', '', 'id_result_biochemical');
        } else if ($lvl == 3){
            $this->datatables->add_column('action', '<button type="button" class="btn_edit_detResultsBiochemical btn btn-info btn-sm" aria-hidden="true"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>', 'id_result_biochemical');
        } else {
            $this->datatables->add_column('action', '<button type="button" class="btn_edit_detResultsBiochemical btn btn-info btn-sm" aria-hidden="true"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>'." 
                ".'<button type="button" class="btn_deleteBiochemical btn btn-danger btn-sm" data-id="$1" aria-hidden="true"><i class="fa fa-trash-o" aria-hidden="true"></i></button>', 'id_result_biochemical');
        }
        return $this->datatables->generate();
    }

    function subjsonFinalConcentration($id)
    {
        $response = array();
    
        // Step 1: Get unique tube_number
        $this->db->select('tube_number');
        $this->db->distinct();
        $this->db->from('campy_sample_volumes');
        $this->db->where('id_campy_biosolids', $id);
        $this->db->order_by('tube_number', 'ASC'); // Tambahkan pengurutan
        $tube_numbers = $this->db->get()->result_array();
    
        // Check if tube numbers are empty
        if (empty($tube_numbers)) {
            return []; // Handle case where no tube numbers found
        }
    
        // Step 2: Create case query for pivot
        $case_statements = [];
        foreach ($tube_numbers as $row) {
            $tube_number = $row['tube_number'];
            $case_statements[] = "MAX(CASE WHEN sv1.tube_number = {$tube_number} THEN sv1.vol_sampletube END) AS `Tube {$tube_number}`";
        }
        $case_query = implode(', ', $case_statements);
    
        // Final query
        $this->db->select("cb.id_one_water_sample, cb.id_person, rp.initial, cb.mpn_pcr_conducted, cb.number_of_tubes, cb.campy_assay_barcode, cb.date_sample_processed, 
                        cb.time_sample_processed, 
                        cb.sample_wetweight, 
                        cb.elution_volume, 
                        rs.sampletype,
                        rm.mpn_concentration,
                        rm.upper_ci,
                        rm.lower_ci,
                        rm.mpn_concentration_dw,
                        rm.upper_ci_dw,
                        rm.lower_ci_dw,
                           $case_query, 
                           GROUP_CONCAT(DISTINCT rb.biochemical_tube ORDER BY rb.biochemical_tube SEPARATOR ', ') AS biochemical_tube, 
                           GROUP_CONCAT(DISTINCT CONCAT(rb.biochemical_tube, ':', rb.confirmation) ORDER BY rb.biochemical_tube SEPARATOR ', ') AS confirmation,
                           GROUP_CONCAT(DISTINCT sgph.plate_number ORDER BY sgph.plate_number SEPARATOR ', ') AS plate_numbers");
        $this->db->from('campy_biosolids AS cb');
        $this->db->join('campy_result_hba AS rh', 'cb.id_campy_biosolids = rh.id_campy_biosolids', 'left');
        $this->db->join('campy_sample_growth_plate_hba AS sgph', 'rh.id_result_hba = sgph.id_result_hba', 'left');
        $this->db->join('campy_sample_volumes AS sv1', 'rh.id_campy_biosolids = sv1.id_campy_biosolids', 'left');
        $this->db->join('campy_result_biochemical AS rb', 'sgph.id_result_hba = rb.id_result_hba AND rb.flag = 0', 'left');
        $this->db->join('campy_result_mpn AS rm', 'cb.id_campy_biosolids = rm.id_campy_biosolids', 'left');
        $this->db->join('ref_sampletype AS rs', 'cb.id_sampletype = rs.id_sampletype', 'left');
        $this->db->join('ref_person AS rp',  'cb.id_person = rp.id_person', 'left');
    
        // Conditions
        $this->db->where('rh.id_campy_biosolids', $id);
        $this->db->group_by('rh.id_result_hba');
    
        $q = $this->db->get();
    
        if ($q->num_rows() > 0) {
            $response = $q->result(); // Fetch all results if available
            foreach ($response as $key => $value) {
                $confirmations = !empty($value->confirmation) ? explode(',', $value->confirmation) : [];
                $biochemical_tubes = !empty($value->biochemical_tube) ? explode(',', $value->biochemical_tube) : [];
    
                $confirmation_array = []; // Inisialisasi array konfirmasi

                // Membuat array asosiasi untuk konfirmasi
                if (!empty($biochemical_tubes) && !empty($confirmations)) {
                    foreach ($biochemical_tubes as $index => $tube) {
                        $confirmation_array[$tube] = explode(':', $confirmations[$index] ?? 'No Growth Plate')[1] ?? 'No Growth Plate'; // Menyediakan default
                    }
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
        $this->db->from('campy_sample_volumes');
        $this->db->where('id_campy_biosolids', $id);
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
            $case_statements[] = "MAX(CASE WHEN sv1.tube_number = {$tube_number} THEN sv1.vol_sampletube END) AS `Tube {$tube_number}`";
        }
        $case_query = implode(', ', $case_statements);
    
        // Final query
        $this->db->select("cb.id_one_water_sample, cb.id_person, rp.initial, cb.mpn_pcr_conducted, cb.number_of_tubes, 
                        cb.campy_assay_barcode, 
                        cb.date_sample_processed, 
                        cb.time_sample_processed, 
                        cb.sample_wetweight, 
                        cb.elution_volume, 
                        rs.sampletype,
                        rm.mpn_concentration,
                        rm.upper_ci,
                        rm.lower_ci,
                        rm.mpn_concentration_dw,
                        rm.upper_ci_dw,
                        rm.lower_ci_dw,
                           $case_query, 
                           GROUP_CONCAT(DISTINCT rb.biochemical_tube ORDER BY rb.biochemical_tube SEPARATOR ', ') AS biochemical_tube, 
                           GROUP_CONCAT(DISTINCT CONCAT(rb.biochemical_tube, ':', rb.confirmation) ORDER BY rb.biochemical_tube SEPARATOR ', ') AS confirmation,
                           GROUP_CONCAT(DISTINCT sgph.plate_number ORDER BY sgph.plate_number SEPARATOR ', ') AS plate_numbers");
        $this->db->from('campy_biosolids AS cb');
        $this->db->join('campy_result_hba AS rh', 'cb.id_campy_biosolids = rh.id_campy_biosolids', 'left');
        $this->db->join('campy_sample_growth_plate_hba AS sgph', 'rh.id_result_hba = sgph.id_result_hba', 'left');
        $this->db->join('campy_sample_volumes AS sv1', 'rh.id_campy_biosolids = sv1.id_campy_biosolids', 'left');
        $this->db->join('campy_result_biochemical AS rb', 'sgph.id_result_hba = rb.id_result_hba AND rb.flag = 0', 'left');
        $this->db->join('campy_result_mpn AS rm', 'cb.id_campy_biosolids = rm.id_campy_biosolids', 'left');
        $this->db->join('ref_sampletype AS rs', 'cb.id_sampletype = rs.id_sampletype', 'left');
        $this->db->join('ref_person AS rp',  'cb.id_person = rp.id_person', 'left');
    
        // Conditions
        // $this->db->where('rb.flag', '0');
        $this->db->where('rh.id_campy_biosolids', $id);
        $this->db->group_by('rh.id_result_hba');
    
        $q = $this->db->get();
    
        if ($q->num_rows() > 0) {
            $response = $q->result(); // Fetch all results if available
            foreach ($response as $key => $value) {
                $confirmations = !empty($value->confirmation) ? explode(',', $value->confirmation) : [];
                $biochemical_tubes = !empty($value->biochemical_tube) ? explode(',', $value->biochemical_tube) : [];
    
                $confirmation_array = []; // Inisialisasi array konfirmasi

                // Membuat array asosiasi untuk konfirmasi
                if (!empty($biochemical_tubes) && !empty($confirmations)) {
                    foreach ($biochemical_tubes as $index => $tube) {
                        $confirmation_array[$tube] = explode(':', $confirmations[$index] ?? 'No Growth Plate')[1] ?? 'No Growth Plate'; // Menyediakan default
                    }
                }
                $value->confirmation = $confirmation_array; // Assign confirmation yang sudah diproses
            }
        }
    
        return $response;
    }
    
    function get_all_export() {
        $response = array();
    
        // Step 1: Get unique tube_number
        $this->db->select('tube_number');
        $this->db->distinct();
        $this->db->from('campy_sample_volumes');
        $this->db->where('id_campy_biosolids IS NOT NULL');
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
            $case_statements[] = "MAX(CASE WHEN sv1.tube_number = {$tube_number} THEN sv1.vol_sampletube END) AS `Tube {$tube_number}`";
        }
        $case_query = implode(', ', $case_statements);
    
        // Final query
        $this->db->select("cb.id_one_water_sample, cb.id_person, rp.initial, cb.mpn_pcr_conducted, cb.number_of_tubes, cb.campy_assay_barcode, cb.date_sample_processed, 
                        cb.time_sample_processed, 
                        cb.sample_wetweight, 
                        cb.elution_volume, 
                        rs.sampletype,
                        rm.mpn_concentration,
                        rm.upper_ci,
                        rm.lower_ci,
                        rm.mpn_concentration_dw,
                        rm.upper_ci_dw,
                        rm.lower_ci_dw,
                           $case_query, 
                           GROUP_CONCAT(DISTINCT rb.biochemical_tube ORDER BY rb.biochemical_tube SEPARATOR ', ') AS biochemical_tube, 
                           GROUP_CONCAT(DISTINCT CONCAT(rb.biochemical_tube, ':', rb.confirmation) ORDER BY rb.biochemical_tube SEPARATOR ', ') AS confirmation,
                           GROUP_CONCAT(DISTINCT sgph.plate_number ORDER BY sgph.plate_number SEPARATOR ', ') AS plate_numbers");
        $this->db->from('campy_biosolids AS cb');
        $this->db->join('campy_result_hba AS rh', 'cb.id_campy_biosolids = rh.id_campy_biosolids', 'left');
        $this->db->join('campy_sample_growth_plate_hba AS sgph', 'rh.id_result_hba = sgph.id_result_hba', 'left');
        $this->db->join('campy_sample_volumes AS sv1', 'rh.id_campy_biosolids = sv1.id_campy_biosolids', 'left');
        $this->db->join('campy_result_biochemical AS rb', 'sgph.id_result_hba = rb.id_result_hba AND rb.flag = 0', 'left');
        $this->db->join('campy_result_mpn AS rm', 'cb.id_campy_biosolids = rm.id_campy_biosolids', 'left');
        $this->db->join('ref_sampletype AS rs', 'cb.id_sampletype = rs.id_sampletype', 'left');
        $this->db->join('ref_person AS rp', 'cb.id_person = rp.id_person', 'left');
    
        // Conditions
        // $this->db->where('rb.flag', '0');
        $this->db->where('sv1.flag', '0');
        $this->db->group_by('rh.id_result_hba');
    
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
        return $this->db->get($this->table)->row();
    }

    function get_detail($id)
    {

      $response = array();
      $this->db->select('cb.id_campy_biosolids, cb.id_one_water_sample, cb.id_person, rp.initial, cb.number_of_tubes,
        cb.id_sampletype, rs.sampletype, cb.mpn_pcr_conducted, cb.campy_assay_barcode, cb.date_sample_processed,
        cb.dry_weight_persen, cb.sample_dryweight, cb.sample_dryweight_old,
        cb.user_review, 
        cb.review, 
        user.full_name,
        cb.user_created, 
        cb.time_sample_processed, cb.time_sample_processed, cb.sample_wetweight, cb.elution_volume,
        GROUP_CONCAT(sv.vol_sampletube ORDER BY sv.tube_number SEPARATOR ", ") AS vol_sampletube, GROUP_CONCAT(sv.tube_number ORDER BY sv.tube_number SEPARATOR ", ") AS tube_number');
      $this->db->from('campy_biosolids AS cb');
      $this->db->join('ref_sampletype AS rs', 'cb.id_sampletype = rs.id_sampletype', 'left');
      $this->datatables->join('campy_sample_volumes AS sv', 'cb.id_campy_biosolids = sv.id_campy_biosolids', 'left');
      $this->db->join('ref_person AS rp',  'cb.id_person = rp.id_person', 'left');
      $this->db->join('tbl_user user', 'cb.user_review = user.id_users', 'left');
      $this->db->where('cb.id_one_water_sample', $id);
      $this->db->where('cb.flag', '0');
      $q = $this->db->get();

      if ($q->num_rows() > 0) {
        $response = $q->row();
      }
    
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
        WHERE id_one_water_sample NOT IN (SELECT id_one_water_sample FROM campy_biosolids)
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
        SELECT campy_assay_barcode FROM campy_biosolids
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
        $this->db->insert('campy_biosolids', $data);
        return $this->db->insert_id(); // Return the last inserted ID
    }
    
    public function insert_sample_volume($data) {
        $this->db->insert('campy_sample_volumes', $data);
    }
    
    function updateCampyBiosolids($id, $data) {
        $this->db->where('id_campy_biosolids', $id);
        $this->db->update('campy_biosolids', $data);
    }

    public function delete_sample_volumes($id_campy_biosolids) {
        $this->db->where('id_campy_biosolids', $id_campy_biosolids);
        $this->db->delete('campy_sample_volumes');
    }

    public function insertResultsCharcoal($data) {
        $this->db->insert('campy_result_charcoal', $data);
        return $this->db->insert_id(); // Return the last inserted ID
    }

    public function insert_growth_plate($data) {
        $this->db->insert('campy_sample_growth_plate', $data);
    }

    function updateResultsCharcoal($id, $data) {
        $this->db->where('id_result_charcoal', $id);
        $this->db->update('campy_result_charcoal', $data);
    }

    public function delete_growth_plates($id_result_charcoal) {
        $this->db->where('id_result_charcoal', $id_result_charcoal);
        $this->db->delete('campy_sample_growth_plate');
    }

    function get_by_id_charcoal($id)
    {
        $this->db->where('id_result_charcoal', $id);
        $this->db->where('flag', '0');
        return $this->db->get('campy_result_charcoal')->row();
    }

    function updateResultsGrowthPlate($id, $data) {
        $this->db->where('id_result_charcoal', $id);
        $this->db->update('campy_sample_growth_plate', $data);
    }

    function get_by_id_campybiosolids($id)
    {
        $this->db->where('id_campy_biosolids', $id);
        $this->db->where('flag', '0');
        return $this->db->get('campy_biosolids')->row();
    }

    function updateSampleVolume($id, $data) {
        $this->db->where('id_campy_biosolids', $id);
        $this->db->update('campy_sample_volumes', $data);
    }

    function insertResultsHba($data) {
        $this->db->insert('campy_result_hba', $data);
        return $this->db->insert_id();
    }

    public function insert_growth_plate_hba($data) {
        $this->db->insert('campy_sample_growth_plate_hba', $data);
    }

    function updateResultsHba($id_result_hba, $data) {
        $this->db->where('id_result_hba', $id_result_hba);
        $this->db->update('campy_result_hba', $data);
    }

    public function delete_growth_plates_hba($id_result_hba) {
        $this->db->where('id_result_hba', $id_result_hba);
        $this->db->delete('campy_sample_growth_plate_hba');
    }

    function get_by_id_hba($id)
    {
        $this->db->where('id_result_hba', $id);
        $this->db->where('flag', '0');
        return $this->db->get('campy_result_hba')->row();
    }

    function updateResultsGrowthPlateHba($id, $data) {
        $this->db->where('id_result_hba', $id);
        $this->db->update('campy_sample_growth_plate_hba', $data);
    }

    function insertResultsBiochemical($data) {
        $this->db->insert('campy_result_biochemical', $data);
        return $this->db->insert_id();
    }
    
    function get_by_id_biochemical($id)
    {
        $this->db->where('id_result_biochemical', $id);
        $this->db->where('flag', '0');
        return $this->db->get('campy_result_biochemical')->row();
    }

    function updateResultsBiochemical($id_result_biochemical, $data) {
        $this->db->where('id_result_biochemical', $id_result_biochemical);
        $this->db->update('campy_result_biochemical', $data);
    }

    function barcode_restrict($id){

        $q = $this->db->query('
        select id_one_water_sample
        from campy_biosolids
        WHERE id_one_water_sample = "'.$id.'" AND flag = 0
        ');        
        $response = $q->result_array();
        return $response;
    }

    function update_campy_biosolids($id_one_water_sample, $data)
    {
        $this->db->where('id_one_water_sample', $id_one_water_sample);
        $this->db->update('campy_biosolids', $data);
    }

    function updateCancel($id, $data)
    {
        $this->db->where('id_one_water_sample', $id);
        $this->db->update('campy_biosolids', $data);

        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    function insertCalculateMPN($data) {
        $this->db->insert('campy_result_mpn', $data);
        
        if ($this->db->affected_rows() > 0) {
            return $this->db->insert_id();
        } else {
            // Log the error for debugging
            log_message('error', 'Failed to insert MPN calculation: ' . $this->db->last_query());
            log_message('error', 'Database error: ' . print_r($this->db->error(), true));
            return false;
        }
    }

    function updateCalculateMPN($id, $data) {
        $this->db->where('id_campy_result_mpn', $id);
        $this->db->update('campy_result_mpn', $data);
        
        // Check if update was successful
        if ($this->db->affected_rows() >= 0) { // Changed from > 0 to >= 0 to handle cases where data is the same
            return true;
        } else {
            // Log the error for debugging
            log_message('error', 'Failed to update MPN calculation: ' . $this->db->last_query());
            log_message('error', 'Database error: ' . print_r($this->db->error(), true));
            return false;
        }
    }

    function get_by_id_calculate_mpn($id) {
        $this->db->where('id_campy_result_mpn', $id);
        $this->db->where('flag', '0');
        return $this->db->get('campy_result_mpn')->row();
    }

    function delete_calculate_mpn($id) {
        $data = array('flag' => 1);
        $this->db->where('id_campy_result_mpn', $id);
        $this->db->update('campy_result_mpn', $data);
        
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    function get_calculate_mpn_by_campy_biosolids($id_campy_biosolids) {
        $this->db->where('id_campy_biosolids', $id_campy_biosolids);
        $this->db->where('flag', '0');
        return $this->db->get('campy_result_mpn')->row();
    }

    function getDryWeight($id_one_water_sample) {
        $this->db->select('m48.dry_weight_persen');
        $this->db->from('moisture_content as mc');
        $this->db->join('moisture72 as m48', 'mc.id_moisture = m48.id_moisture', 'left');
        $this->db->where('mc.id_moisture IS NOT NULL');
        $this->db->where('mc.id_one_water_sample', $id_one_water_sample);
        $this->db->where('mc.flag', '0');
        $this->db->where('m48.flag', '0'); 
        $query = $this->db->get();
        
        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return null; // Return null if no data found
        }
    }
    

      
}

/* End of file Tbl_delivery_model.php */
/* Location: ./application/models/Tbl_delivery_model.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2022-12-14 03:38:42 */
/* http://harviacode.com */