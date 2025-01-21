<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Campy_biosolids_qpcr_model extends CI_Model
{
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

    // datatables
    function json() {
        $this->datatables->select('cb.id_campy_biosolids_qpcr, cb.id_one_water_sample, cb.id_person, cb.number_of_tubes, cb.mpn_pcr_conducted, cb.campy_assay_barcode, 
        rp.initial, cb.date_sample_processed, cb.time_sample_processed, cb.sample_wetweight, cb.elution_volume,
        cb.id_sampletype, rs.sampletype, GROUP_CONCAT(sv.vol_sampletube ORDER BY sv.tube_number SEPARATOR ", ") AS vol_sampletube, GROUP_CONCAT(sv.tube_number ORDER BY sv.tube_number SEPARATOR ", ") AS tube_number, cb.flag,
        cb.date_created, cb.date_updated, GREATEST(cb.date_created, cb.date_updated) AS latest_date');
        $this->datatables->from('campy_biosolids_qpcr AS cb');
        $this->datatables->join('ref_person AS rp', 'cb.id_person = rp.id_person', 'left');
        $this->datatables->join('ref_sampletype AS rs', 'cb.id_sampletype = rs.id_sampletype', 'left');
        $this->datatables->join('campy_sample_volumes_qpcr AS sv', 'cb.id_campy_biosolids_qpcr = sv.id_campy_biosolids_qpcr', 'left');
        // $this->datatables->where('lab', $this->session->userdata('lab'));
        $this->datatables->where('cb.flag', '0');
        // GROUP BY
        $this->datatables->group_by('cb.id_campy_biosolids_qpcr');
        $lvl = $this->session->userdata('id_user_level');
        if ($lvl == 4){
            $this->datatables->add_column('action', anchor(site_url('campy_biosolids_qpcr/read/$1'),'<i class="fa fa-th-list" aria-hidden="true"></i>', array('class' => 'btn btn-warning btn-sm')), 'id_campy_biosolids_qpcr');
        }
        else if ($lvl == 3){
            $this->datatables->add_column('action', anchor(site_url('campy_biosolids_qpcr/read/$1'),'<i class="fa fa-th-list" aria-hidden="true"></i>', array('class' => 'btn btn-warning btn-sm')) ."
                ".'<button type="button" class="btn_edit btn btn-info btn-sm" aria-hidden="true"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>', 'id_campy_biosolids_qpcr');
        }
        else {
            $this->datatables->add_column('action', anchor(site_url('campy_biosolids_qpcr/read/$1'),'<i class="fa fa-th-list" aria-hidden="true"></i>', array('class' => 'btn btn-warning btn-sm')) ."
            ".'<button type="button" class="btn_edit btn btn-info btn-sm" aria-hidden="true"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>'." 
            ".'<button type="button" class="btn_deleteCampyBiosolids btn btn-danger btn-sm" data-id="$1" aria-hidden="true"><i class="fa fa-trash-o" aria-hidden="true"></i></button>', 'id_campy_biosolids_qpcr');
        }
        $this->db->order_by('latest_date', 'DESC');
        return $this->datatables->generate();
    }

    function subjsonResultQpcr($id) {
        $this->datatables->select('rc.id_result_qpcr, cb.campy_assay_barcode, rc.id_campy_biosolids_qpcr, rc.date_sample_processed, rc.time_sample_processed,
        GROUP_CONCAT(sgp.pcr_tube ORDER BY sgp.plate_number SEPARATOR ", ") AS pcr_tube, GROUP_CONCAT(sgp.plate_number ORDER BY sgp.plate_number SEPARATOR ", ") AS plate_number, rc.flag');
        $this->datatables->from('campy_result_qpcr AS rc');
        $this->datatables->join('campy_biosolids_qpcr AS cb', 'rc.id_campy_biosolids_qpcr = cb.id_campy_biosolids_qpcr', 'left');
        $this->datatables->join('campy_sample_qpcr_tube AS sgp', 'rc.id_result_qpcr = sgp.id_result_qpcr', 'left');
        $this->datatables->where('rc.flag', '0');
        $this->datatables->where('rc.id_campy_biosolids_qpcr', $id);
        $this->datatables->group_by('
        rc.id_result_qpcr, 
        cb.campy_assay_barcode, 
        rc.id_campy_biosolids_qpcr, 
        rc.date_sample_processed, 
        rc.time_sample_processed,
        rc.flag
        ');
        $lvl = $this->session->userdata('id_user_level');
        if ($lvl == 4){
            $this->datatables->add_column('action', '', 'id_result_qpcr');
        }
        else if ($lvl == 3){
            $this->datatables->add_column('action', '<button type="button" class="btn_edit_detResultsCharcoal btn btn-info btn-sm" aria-hidden="true"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>', 'id_result_qpcr');
        }
        else {
            $this->datatables->add_column('action', '<button type="button" class="btn_edit_detResultsCharcoal btn btn-info btn-sm" aria-hidden="true"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>'." 
                ".'<button type="button" class="btn_deleteCharcoal btn btn-danger btn-sm" data-id="$1" aria-hidden="true"><i class="fa fa-trash-o" aria-hidden="true"></i></button>', 'id_result_qpcr');
        }
        return $this->datatables->generate();
    }

    // function subjsonHba($id) {
    //     $this->datatables->select('rh.id_result_hba_qpcr, cb.campy_assay_barcode, rh.id_campy_biosolids_qpcr, rh.date_sample_processed, rh.time_sample_processed, 
    //     GROUP_CONCAT(sgph.growth_plate ORDER BY sgph.plate_number SEPARATOR ", ") AS growth_plate, GROUP_CONCAT(sgph.plate_number ORDER BY sgph.plate_number SEPARATOR ", ") AS plate_number, rh.flag, sgph.id_sample_plate_hba_qpcr');
    //     $this->datatables->from('campy_result_hba_qpcr AS rh');
    //     $this->datatables->join('campy_biosolids_qpcr AS cb', 'rh.id_campy_biosolids_qpcr = cb.id_campy_biosolids_qpcr', 'left');
    //     $this->datatables->join('campy_sample_growth_plate_hba_qpcr AS sgph', 'rh.id_result_hba_qpcr = sgph.id_result_hba_qpcr', 'left');
    //     $this->datatables->where('rh.flag', '0');
    //     $this->datatables->where('rh.id_campy_biosolids_qpcr', $id);
    //     $this->datatables->group_by('
    //     rh.id_result_hba_qpcr, 
    //     cb.campy_assay_barcode, 
    //     rh.id_campy_biosolids_qpcr, 
    //     rh.date_sample_processed, 
    //     rh.time_sample_processed,
    //     rh.flag
    //     ');
    //     $lvl = $this->session->userdata('id_user_level');
    //     if ($lvl == 4){
    //         $this->datatables->add_column('action', '', 'id_result_hba_qpcr');
    //     }
    //     else if ($lvl == 3){
    //         $this->datatables->add_column('action', '<button type="button" class="btn_edit_detResultsHba btn btn-info btn-sm" aria-hidden="true"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>', 'id_result_hba_qpcr');
    //     }
    //     else {
    //         $this->datatables->add_column('action', '<button type="button" class="btn_edit_detResultsHba btn btn-info btn-sm" aria-hidden="true"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>'." 
    //             ".'<button type="button" class="btn_deleteHba btn btn-danger btn-sm" data-id="$1" aria-hidden="true"><i class="fa fa-trash-o" aria-hidden="true"></i></button>', 'id_result_hba_qpcr');
    //     }
    //     return $this->datatables->generate();
    // }

    // function subjsonBiochemical($id, $biochemical_tube) {

    //     $this->datatables->select('rb.id_result_biochemical_qpcr, rb.id_campy_biosolids_qpcr, rb.id_result_hba_qpcr, cb.campy_assay_barcode, rb.gramlysis, rb.oxidase, rb.catalase, rb.confirmation, rb.sample_store, rb.biochemical_tube, rb.flag');
    //     $this->datatables->from('campy_result_biochemical_qpcr AS rb');
    //     $this->datatables->join('campy_biosolids_qpcr AS cb', 'rb.id_campy_biosolids_qpcr = cb.id_campy_biosolids_qpcr', 'left');
    //     $this->datatables->where('rb.flag', '0');
    //     $this->datatables->where('rb.id_campy_biosolids_qpcr', $id);
        
    //    // Add condition for biochemical_tube if it exists
    //     if (!empty($biochemical_tube)) {
    //         $this->datatables->where('rb.biochemical_tube', $biochemical_tube);
    //     }
    
    //     $lvl = $this->session->userdata('id_user_level');
    //     if ($lvl == 4){
    //         $this->datatables->add_column('action', '', 'id_result_biochemical_qpcr');
    //     } else if ($lvl == 3){
    //         $this->datatables->add_column('action', '<button type="button" class="btn_edit_detResultsBiochemical btn btn-info btn-sm" aria-hidden="true"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>', 'id_result_biochemical_qpcr');
    //     } else {
    //         $this->datatables->add_column('action', '<button type="button" class="btn_edit_detResultsBiochemical btn btn-info btn-sm" aria-hidden="true"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>'." 
    //             ".'<button type="button" class="btn_deleteBiochemical btn btn-danger btn-sm" data-id="$1" aria-hidden="true"><i class="fa fa-trash-o" aria-hidden="true"></i></button>', 'id_result_biochemical_qpcr');
    //     }
    //     return $this->datatables->generate();
    // }

    // function subjsonFinalConcentration($id)
    // {
    //     $response = array();
    
    //     // Step 1: Get unique tube_number
    //     $this->db->select('tube_number');
    //     $this->db->distinct();
    //     $this->db->from('campy_sample_volumes_qpcr');
    //     $this->db->where('id_campy_biosolids_qpcr', $id);
    //     $this->db->order_by('tube_number', 'ASC'); // Tambahkan pengurutan
    //     $tube_numbers = $this->db->get()->result_array();
    
    //     // Check if tube numbers are empty
    //     if (empty($tube_numbers)) {
    //         return []; // Handle case where no tube numbers found
    //     }
    
    //     // Step 2: Create case query for pivot
    //     $case_statements = [];
    //     foreach ($tube_numbers as $row) {
    //         $tube_number = $row['tube_number'];
    //         $case_statements[] = "MAX(CASE WHEN sv1.tube_number = {$tube_number} THEN sv1.vol_sampletube END) AS `Tube {$tube_number}`";
    //     }
    //     $case_query = implode(', ', $case_statements);
    
    //     // Final query
    //     $this->db->select("cb.id_one_water_sample, cb.id_person, rp.initial, cb.mpn_pcr_conducted, cb.number_of_tubes, cb.campy_assay_barcode, cb.date_sample_processed, cb.time_sample_processed, cb.sample_wetweight, cb.elution_volume, rs.sampletype,
    //                        $case_query, 
    //                        GROUP_CONCAT(DISTINCT rb.biochemical_tube ORDER BY rb.biochemical_tube SEPARATOR ', ') AS biochemical_tube, 
    //                        GROUP_CONCAT(DISTINCT CONCAT(rb.biochemical_tube, ':', rb.confirmation) ORDER BY rb.biochemical_tube SEPARATOR ', ') AS confirmation,
    //                        GROUP_CONCAT(DISTINCT sgph.plate_number ORDER BY sgph.plate_number SEPARATOR ', ') AS plate_numbers");
    //     $this->db->from('campy_biosolids_qpcr AS cb');
    //     $this->db->join('campy_result_hba_qpcr AS rh', 'cb.id_campy_biosolids_qpcr = rh.id_campy_biosolids_qpcr', 'left');
    //     $this->db->join('campy_sample_growth_plate_hba_qpcr AS sgph', 'rh.id_result_hba_qpcr = sgph.id_result_hba_qpcr', 'left');
    //     $this->db->join('campy_sample_volumes_qpcr AS sv1', 'rh.id_campy_biosolids_qpcr = sv1.id_campy_biosolids_qpcr', 'left');
    //     $this->db->join('campy_result_biochemical_qpcr AS rb', 'sgph.id_result_hba_qpcr = rb.id_result_hba_qpcr', 'left');
    //     $this->db->join('ref_sampletype AS rs', 'cb.id_sampletype = rs.id_sampletype', 'left');
    //     $this->db->join('ref_person AS rp',  'cb.id_person = rp.id_person', 'left');
    
    //     // Conditions
    //     $this->db->where('rb.flag', '0');
    //     $this->db->where('rh.id_campy_biosolids_qpcr', $id);
    //     $this->db->group_by('rh.id_result_hba_qpcr');
    
    //     $q = $this->db->get();
    
    //     if ($q->num_rows() > 0) {
    //         $response = $q->result(); // Fetch all results if available
    //         foreach ($response as $key => $value) {
    //             $confirmations = explode(',', $value->confirmation);
    //             $biochemical_tubes = explode(',', $value->biochemical_tube);
    
    //             $confirmation_array = []; // Inisialisasi array konfirmasi

    //             // Membuat array asosiasi untuk konfirmasi
    //             foreach ($biochemical_tubes as $index => $tube) {
    //                 $confirmation_array[$tube] = explode(':', $confirmations[$index] ?? 'No Growth Plate')[1] ?? 'No Growth Plate'; // Menyediakan default
    //             }
    //             $value->confirmation = $confirmation_array; // Assign confirmation yang sudah diproses
    //         }
    //     }
    
    //     return $response;
    // }


    // function get_export($id) {
    //     $response = array();
    
    //     // Step 1: Get unique tube_number
    //     $this->db->select('tube_number');
    //     $this->db->distinct();
    //     $this->db->from('campy_sample_volumes_qpcr');
    //     $this->db->where('id_campy_biosolids_qpcr', $id);
    //     $this->db->order_by('tube_number', 'ASC');
    //     $tube_numbers = $this->db->get()->result_array();
    
    //     // Check if tube numbers are empty
    //     if (empty($tube_numbers)) {
    //         return []; // Handle case where no tube numbers found
    //     }
    
    //     // Store unique tube numbers for further processing
    //     $tube_numbers_list = array_column($tube_numbers, 'tube_number');
    
    //     // Step 2: Create case query for pivot
    //     $case_statements = [];
    //     foreach ($tube_numbers as $row) {
    //         $tube_number = $row['tube_number'];
    //         $case_statements[] = "MAX(CASE WHEN sv1.tube_number = {$tube_number} THEN sv1.vol_sampletube END) AS `Tube {$tube_number}`";
    //     }
    //     $case_query = implode(', ', $case_statements);
    
    //     // Final query
    //     $this->db->select("cb.id_one_water_sample, cb.id_person, rp.initial, cb.mpn_pcr_conducted, cb.number_of_tubes, cb.campy_assay_barcode, cb.date_sample_processed, cb.time_sample_processed, cb.sample_wetweight, cb.elution_volume, rs.sampletype,
    //                        $case_query, 
    //                        GROUP_CONCAT(DISTINCT rb.biochemical_tube ORDER BY rb.biochemical_tube SEPARATOR ', ') AS biochemical_tube, 
    //                        GROUP_CONCAT(DISTINCT CONCAT(rb.biochemical_tube, ':', rb.confirmation) ORDER BY rb.biochemical_tube SEPARATOR ', ') AS confirmation,
    //                        GROUP_CONCAT(DISTINCT sgph.plate_number ORDER BY sgph.plate_number SEPARATOR ', ') AS plate_numbers");
    //     $this->db->from('campy_biosolids_qpcr AS cb');
    //     $this->db->join('campy_result_hba_qpcr AS rh', 'cb.id_campy_biosolids_qpcr = rh.id_campy_biosolids_qpcr', 'left');
    //     $this->db->join('campy_sample_growth_plate_hba_qpcr AS sgph', 'rh.id_result_hba_qpcr = sgph.id_result_hba_qpcr', 'left');
    //     $this->db->join('campy_sample_volumes_qpcr AS sv1', 'rh.id_campy_biosolids_qpcr = sv1.id_campy_biosolids_qpcr', 'left');
    //     $this->db->join('campy_result_biochemical_qpcr AS rb', 'sgph.id_result_hba_qpcr = rb.id_result_hba_qpcr', 'left');
    //     $this->db->join('ref_sampletype AS rs', 'cb.id_sampletype = rs.id_sampletype', 'left');
    //     $this->db->join('ref_person AS rp',  'cb.id_person = rp.id_person', 'left');
    
    //     // Conditions
    //     $this->db->where('rb.flag', '0');
    //     $this->db->where('rh.id_campy_biosolids_qpcr', $id);
    //     $this->db->group_by('rh.id_result_hba_qpcr');
    
    //     $q = $this->db->get();
    
    //     if ($q->num_rows() > 0) {
    //         $response = $q->result(); // Fetch all results if available
    //         foreach ($response as $key => $value) {
    //             $confirmations = explode(',', $value->confirmation);
    //             $biochemical_tubes = explode(',', $value->biochemical_tube);
    //             $plate_numbers = explode(',', $value->plate_numbers);
    
    //             // Initialize confirmation array for each plate_number
    //             $confirmation_array = array_fill_keys($plate_numbers, 'No Growth'); // Default to "No Growth"
    
    //             // Fill in confirmation values from biochemical_tubes
    //             foreach ($biochemical_tubes as $tube) {
    //                 $index = array_search($tube, $biochemical_tubes);
    //                 if ($index !== false) {
    //                     $confirmation_value = explode(':', $confirmations[$index] ?? 'No Growth')[1] ?? 'No Growth'; // Default if not set
    //                     $confirmation_array[$tube] = $confirmation_value;
    //                 }
    //             }
    
    //             $value->confirmation = $confirmation_array; // Assign processed confirmation
    //         }
    //     }
    
    //     return $response;
    // }
    
    // function get_all_export() {
    //     $response = array();
    
    //     // Step 1: Get unique tube_number
    //     $this->db->select('tube_number');
    //     $this->db->distinct();
    //     $this->db->from('campy_sample_volumes_qpcr');
    //     $this->db->where('id_campy_biosolids_qpcr IS NOT NULL');
    //     $this->db->order_by('tube_number', 'ASC');
    //     $tube_numbers = $this->db->get()->result_array();
    
    //     // Debugging: Cek apakah tube numbers ditemukan
    //     if (empty($tube_numbers)) {
    //         echo "No tube numbers found.";
    //         return []; // Handle case where no tube numbers found
    //     }
    
    //     // Store unique tube numbers for further processing
    //     $tube_numbers_list = array_column($tube_numbers, 'tube_number');
    
    //     // Step 2: Create case query for pivot
    //     $case_statements = [];
    //     foreach ($tube_numbers_list as $tube_number) {
    //         $case_statements[] = "MAX(CASE WHEN sv1.tube_number = {$tube_number} THEN sv1.vol_sampletube END) AS `Tube {$tube_number}`";
    //     }
    //     $case_query = implode(', ', $case_statements);
    
    //     // Final query
    //     $this->db->select("cb.id_one_water_sample, cb.id_person, rp.initial, cb.mpn_pcr_conducted, cb.number_of_tubes, cb.campy_assay_barcode, cb.date_sample_processed, cb.time_sample_processed, cb.sample_wetweight, cb.elution_volume, rs.sampletype,
    //                        $case_query, 
    //                        GROUP_CONCAT(DISTINCT rb.biochemical_tube ORDER BY rb.biochemical_tube SEPARATOR ', ') AS biochemical_tube, 
    //                        GROUP_CONCAT(DISTINCT CONCAT(rb.biochemical_tube, ':', rb.confirmation) ORDER BY rb.biochemical_tube SEPARATOR ', ') AS confirmation,
    //                        GROUP_CONCAT(DISTINCT sgph.plate_number ORDER BY sgph.plate_number SEPARATOR ', ') AS plate_numbers");
    //     $this->db->from('campy_biosolids_qpcr AS cb');
    //     $this->db->join('campy_result_hba_qpcr AS rh', 'cb.id_campy_biosolids_qpcr = rh.id_campy_biosolids_qpcr', 'left');
    //     $this->db->join('campy_sample_growth_plate_hba_qpcr AS sgph', 'rh.id_result_hba_qpcr = sgph.id_result_hba_qpcr', 'left');
    //     $this->db->join('campy_sample_volumes_qpcr AS sv1', 'rh.id_campy_biosolids_qpcr = sv1.id_campy_biosolids_qpcr', 'left');
    //     $this->db->join('campy_result_biochemical_qpcr AS rb', 'sgph.id_result_hba_qpcr = rb.id_result_hba_qpcr', 'left');
    //     $this->db->join('ref_sampletype AS rs', 'cb.id_sampletype = rs.id_sampletype', 'left');
    //     $this->db->join('ref_person AS rp', 'cb.id_person = rp.id_person', 'left');
    
    //     // Conditions
    //     $this->db->where('rb.flag', '0');
    //     $this->db->where('sv1.flag', '0');
    //     $this->db->group_by('rh.id_result_hba_qpcr');
    
    //     $q = $this->db->get();
    
    //     if ($q->num_rows() > 0) {
    //         $response = $q->result();
    //         foreach ($response as $value) {
    //             // Memproses konfirmasi
    //             $confirmations = explode(',', $value->confirmation);
    //             $biochemical_tubes = explode(',', $value->biochemical_tube);
    //             $plate_numbers = explode(',', $value->plate_numbers);
    
    //             // Inisialisasi array konfirmasi dengan kunci sesuai dengan jumlah tabung
    //             $confirmation_array = array_fill_keys($tube_numbers_list, 'No Growth'); // Default ke "No Growth"
    
    //             // Mengisi nilai konfirmasi berdasarkan indeks tabung
    //             foreach ($biochemical_tubes as $index => $tube) {
    //                 $confirmation_value = explode(':', $confirmations[$index] ?? 'No Growth')[1] ?? 'No Growth';
    //                 $confirmation_array[(int)$tube] = $confirmation_value; // Gunakan kunci tabung sebagai index
    //             }
    
    //             // Assign konfirmasi yang sudah diproses
    //             $value->confirmation = $confirmation_array;
    //         }
    //     } else {
    //         echo "No data found for the given query.";
    //     }
    
    //     return $response;
    // }
    
    
    

    function get_by_id($id)
    {
        $this->db->where($this->id, $id);
        $this->db->where('flag', '0');
        return $this->db->get($this->table)->row();
    }

    function get_detail($id)
    {

      $response = array();
      $this->db->select('cb.id_campy_biosolids_qpcr, cb.id_one_water_sample, cb.id_person, rp.initial, cb.number_of_tubes,
        cb.id_sampletype, rs.sampletype, cb.mpn_pcr_conducted, cb.campy_assay_barcode, cb.date_sample_processed,
        cb.time_sample_processed, cb.time_sample_processed, cb.sample_wetweight, cb.elution_volume,
        GROUP_CONCAT(sv.vol_sampletube ORDER BY sv.tube_number SEPARATOR ", ") AS vol_sampletube, GROUP_CONCAT(sv.tube_number ORDER BY sv.tube_number SEPARATOR ", ") AS tube_number');
      $this->db->from('campy_biosolids_qpcr AS cb');
      $this->db->join('ref_sampletype AS rs', 'cb.id_sampletype = rs.id_sampletype', 'left');
      $this->datatables->join('campy_sample_volumes_qpcr AS sv', 'cb.id_campy_biosolids_qpcr = sv.id_campy_biosolids_qpcr', 'left');
      $this->db->join('ref_person AS rp',  'cb.id_person = rp.id_person', 'left');
      $this->db->where('cb.id_campy_biosolids_qpcr', $id);
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
        SELECT id_one_water_sample FROM sample_reception
        WHERE id_one_water_sample NOT IN (SELECT id_one_water_sample FROM campy_biosolids)
        AND flag = 0');       
        $response = $q->result_array();
        return $response;
    }

    function getOneWaterSampleById($idOneWaterSample)
    {
        $this->db->select('sr.id_sampletype, rs.sampletype');
        $this->db->from('sample_reception sr');
        $this->db->join('ref_sampletype rs', 'sr.id_sampletype = rs.id_sampletype', 'left');
        $this->db->where('sr.id_one_water_sample', $idOneWaterSample);
        $query = $this->db->get();
        return $query->row_array();
    }

    function validateCampyAssayBarcode($id){
        $q = $this->db->query('
        SELECT campy_assay_barcode FROM campy_biosolids_qpcr
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
        $this->db->insert('campy_biosolids_qpcr', $data);
        return $this->db->insert_id(); // Return the last inserted ID
    }
    
    public function insert_sample_volume($data) {
        $this->db->insert('campy_sample_volumes_qpcr', $data);
    }
    
    function updateCampyBiosolids($id, $data) {
        $this->db->where('id_campy_biosolids_qpcr', $id);
        $this->db->update('campy_biosolids_qpcr', $data);
    }

    public function delete_sample_volumes($id_campy_biosolids_qpcr) {
        $this->db->where('id_campy_biosolids_qpcr', $id_campy_biosolids_qpcr);
        $this->db->delete('campy_sample_volumes_qpcr');
    }

    public function insertResultsQpcr($data) {
        $this->db->insert('campy_result_qpcr', $data);
        return $this->db->insert_id(); // Return the last inserted ID
    }

    public function insert_growth_plate($data) {
        // var_dump($data);
        // die();
        $this->db->insert('campy_sample_qpcr_tube', $data);
    }

    function updateResultsQpcr($id, $data) {
        $this->db->where('id_result_qpcr', $id);
        $this->db->update('campy_result_qpcr', $data);
    }

    public function delete_growth_plates($id_result_qpcr) {
        $this->db->where('id_result_qpcr', $id_result_qpcr);
        $this->db->delete('campy_sample_qpcr_tube');
    }

    function get_by_id_qpcr($id)
    {
        $this->db->where('id_result_qpcr', $id);
        $this->db->where('flag', '0');
        return $this->db->get('campy_result_qpcr')->row();
    }

    function updateResultsGrowthPlate($id, $data) {
        $this->db->where('id_result_qpcr', $id);
        $this->db->update('campy_sample_qpcr_tube', $data);
    }

    function get_by_id_campybiosolids($id)
    {
        $this->db->where('id_campy_biosolids_qpcr', $id);
        $this->db->where('flag', '0');
        return $this->db->get('campy_biosolids_qpcr')->row();
    }

    function updateSampleVolume($id, $data) {
        $this->db->where('id_campy_biosolids_qpcr', $id);
        $this->db->update('campy_sample_volumes_qpcr', $data);
    }

    // function insertResultsHba($data) {
    //     $this->db->insert('campy_result_hba_qpcr', $data);
    //     return $this->db->insert_id();
    // }

    // public function insert_growth_plate_hba($data) {
    //     $this->db->insert('campy_sample_growth_plate_hba_qpcr', $data);
    // }

    // function updateResultsHba($id_result_hba_qpcr, $data) {
    //     $this->db->where('id_result_hba_qpcr', $id_result_hba_qpcr);
    //     $this->db->update('campy_result_hba_qpcr', $data);
    // }

    // public function delete_growth_plates_hba($id_result_hba_qpcr) {
    //     $this->db->where('id_result_hba_qpcr', $id_result_hba_qpcr);
    //     $this->db->delete('campy_sample_growth_plate_hba_qpcr');
    // }

    // function get_by_id_hba($id)
    // {
    //     $this->db->where('id_result_hba_qpcr', $id);
    //     $this->db->where('flag', '0');
    //     return $this->db->get('campy_result_hba_qpcr')->row();
    // }

    // function updateResultsGrowthPlateHba($id, $data) {
    //     $this->db->where('id_result_hba_qpcr', $id);
    //     $this->db->update('campy_sample_growth_plate_hba_qpcr', $data);
    // }

    // function insertResultsBiochemical($data) {
    //     $this->db->insert('campy_result_biochemical_qpcr', $data);
    //     return $this->db->insert_id();
    // }
    
    function get_by_id_biochemical($id)
    {
        $this->db->where('id_result_biochemical_qpcr', $id);
        $this->db->where('flag', '0');
        return $this->db->get('campy_result_biochemical_qpcr')->row();
    }

    // function updateResultsBiochemical($id_result_biochemical_qpcr, $data) {
    //     $this->db->where('id_result_biochemical_qpcr', $id_result_biochemical_qpcr);
    //     $this->db->update('campy_result_biochemical_qpcr', $data);
    // }
    

      
}

/* End of file Tbl_delivery_model.php */
/* Location: ./application/models/Tbl_delivery_model.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2022-12-14 03:38:42 */
/* http://harviacode.com */