<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Campy_biosolids_model extends CI_Model
{

    public $table = 'moisture_content';
    public $table24 = 'moisture24';
    public $table72 = 'moisture72';
    public $id = 'id_moisture';
    public $id24 = 'id_moisture24';
    public $id72 = 'id_moisture72';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

    // datatables
// datatables
    function json() {
        $this->datatables->select('cb.id_campy_biosolids, cb.id_one_water_sample, cb.id_person, cb.number_of_tubes, cb.mpn_pcr_conducted, cb.campy_assay_barcode, 
        rp.initial, cb.date_sample_processed, cb.time_sample_processed, cb.sample_wetweight, cb.elution_volume,
        cb.id_sampletype, rs.sampletype, GROUP_CONCAT(sv.vol_sampletube ORDER BY sv.tube_number SEPARATOR ", ") AS vol_sampletube, GROUP_CONCAT(sv.tube_number ORDER BY sv.tube_number SEPARATOR ", ") AS tube_number, cb.flag,
        cb.date_created, cb.date_updated, GREATEST(cb.date_created, cb.date_updated) AS latest_date');
        $this->datatables->from('campy_biosolids AS cb');
        $this->datatables->join('ref_person AS rp', 'cb.id_person = rp.id_person', 'left');
        $this->datatables->join('ref_sampletype AS rs', 'cb.id_sampletype = rs.id_sampletype', 'left');
        $this->datatables->join('sample_volumes AS sv', 'cb.id_campy_biosolids = sv.id_campy_biosolids', 'left');
        // $this->datatables->where('lab', $this->session->userdata('lab'));
        $this->datatables->where('cb.flag', '0');
        // GROUP BY
        $this->datatables->group_by('cb.id_campy_biosolids');
        $lvl = $this->session->userdata('id_user_level');
        if ($lvl == 4){
            $this->datatables->add_column('action', anchor(site_url('campy_biosolids/read/$1'),'<i class="fa fa-th-list" aria-hidden="true"></i>', array('class' => 'btn btn-warning btn-sm')), 'id_campy_biosolids');
        }
        else if ($lvl == 3){
            $this->datatables->add_column('action', anchor(site_url('campy_biosolids/read/$1'),'<i class="fa fa-th-list" aria-hidden="true"></i>', array('class' => 'btn btn-warning btn-sm')) ."
                ".'<button type="button" class="btn_edit btn btn-info btn-sm" aria-hidden="true"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>', 'id_campy_biosolids');
        }
        else {
            $this->datatables->add_column('action', anchor(site_url('campy_biosolids/read/$1'),'<i class="fa fa-th-list" aria-hidden="true"></i>', array('class' => 'btn btn-warning btn-sm')) ."
            ".'<button type="button" class="btn_edit btn btn-info btn-sm" aria-hidden="true"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>'." 
            ".'<button type="button" class="btn_deleteCampyBiosolids btn btn-danger btn-sm" data-id="$1" aria-hidden="true"><i class="fa fa-trash-o" aria-hidden="true"></i></button>', 'id_campy_biosolids');
        }
        $this->db->order_by('latest_date', 'DESC');
        return $this->datatables->generate();
    }

    function subjsonCharcoal($id) {
        $this->datatables->select('rc.id_result_charcoal, cb.campy_assay_barcode, rc.id_campy_biosolids, rc.date_sample_processed, rc.time_sample_processed,
        GROUP_CONCAT(sgp.growth_plate ORDER BY sgp.plate_number SEPARATOR ", ") AS growth_plate, GROUP_CONCAT(sgp.plate_number ORDER BY sgp.plate_number SEPARATOR ", ") AS plate_number, rc.flag');
        $this->datatables->from('result_charcoal AS rc');
        $this->datatables->join('campy_biosolids AS cb', 'rc.id_campy_biosolids = cb.id_campy_biosolids', 'left');
        $this->datatables->join('sample_growth_plate AS sgp', 'rc.id_result_charcoal = sgp.id_result_charcoal', 'left');
        // $this->datatables->join('ref_testing b', 'FIND_IN_SET(b.id_testing_type, a.id_testing_type)', 'left');
        // $this->datatables->join('ref_barcode c', 'a.sample_id = c.testing_type_id', 'left');
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
        $this->datatables->from('result_hba AS rh');
        $this->datatables->join('campy_biosolids AS cb', 'rh.id_campy_biosolids = cb.id_campy_biosolids', 'left');
        $this->datatables->join('sample_growth_plate_hba AS sgph', 'rh.id_result_hba = sgph.id_result_hba', 'left');
        // $this->datatables->join('ref_testing b', 'FIND_IN_SET(b.id_testing_type, a.id_testing_type)', 'left');
        // $this->datatables->join('ref_barcode c', 'a.sample_id = c.testing_type_id', 'left');
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

        $this->datatables->select('rb.id_result_biochemical, rb.id_campy_biosolids, rb.id_result_hba, cb.campy_assay_barcode, rb.oxidase, rb.catalase, rb.confirmation, rb.sample_store, rb.biochemical_tube, rb.flag');
        $this->datatables->from('result_biochemical AS rb');
        $this->datatables->join('campy_biosolids AS cb', 'rb.id_campy_biosolids = cb.id_campy_biosolids', 'left');
        $this->datatables->where('rb.flag', '0');
        $this->datatables->where('rb.id_campy_biosolids', $id);
        
        // Tambahkan kondisi untuk biochemical_tube jika ada
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

    // function subjsonFinalConcentration($id)
    // {
    //     $response = array();
    
    //     // Step 1: Get unique tube_number
    //     $this->db->select('tube_number');
    //     $this->db->distinct();
    //     $this->db->from('sample_volumes');
    //     $this->db->where('id_campy_biosolids', $id);
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
    //     $this->db->select("$case_query, GROUP_CONCAT(DISTINCT rb.biochemical_tube ORDER BY rb.biochemical_tube SEPARATOR ', ') AS biochemical_tube, GROUP_CONCAT(DISTINCT CONCAT(rb.biochemical_tube, ':', rb.confirmation) ORDER BY rb.biochemical_tube SEPARATOR ', ') AS confirmation");
    //     $this->db->from('campy_biosolids AS cb');
    //     $this->db->join('result_hba AS rh', 'cb.id_campy_biosolids = rh.id_campy_biosolids', 'left');
    //     $this->db->join('sample_growth_plate_hba AS sgph', 'rh.id_result_hba = sgph.id_result_hba', 'left');
    //     $this->db->join('sample_volumes AS sv1', 'rh.id_campy_biosolids = sv1.id_campy_biosolids', 'left');
    //     $this->db->join('result_biochemical AS rb', 'sgph.id_result_hba = rb.id_result_hba', 'left');
    
    //     // Conditions
    //     $this->db->where('rh.flag', '0');
    //     $this->db->where('rh.id_campy_biosolids', $id);
    //     $this->db->group_by('rh.id_result_hba'); // Group by id_result_hba
    
    //     $q = $this->db->get();
    
    //     if ($q->num_rows() > 0) {
    //         $response = $q->result(); // Fetch all results if available
    //         foreach ($response as $key => $value) {
    //             $confirmations = explode(',', $value->confirmation);
    //             $biochemical_tubes = explode(',', $value->biochemical_tube);
    //             var_dump($biochemical_tubes);
    //             die();
    //             $confirmation_array = [];
    //             foreach ($biochemical_tubes as $tube) {
    //                 $index = array_search($tube, $biochemical_tubes);
    //                 $confirmation_array[$tube] = explode(':', $confirmations[$index])[1];
    //             }
    //             $response[$key]->confirmation = $confirmation_array;
    //         }
    //     }
    
    //     return $response;
    // }
    function subjsonFinalConcentration($id)
    {
        $response = array();
    
        // Step 1: Get unique tube_number
        $this->db->select('tube_number');
        $this->db->distinct();
        $this->db->from('sample_volumes');
        $this->db->where('id_campy_biosolids', $id);
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
        $this->db->select("cb.id_one_water_sample, cb.id_person, rp.initial, cb.mpn_pcr_conducted, cb.number_of_tubes, cb.campy_assay_barcode, cb.date_sample_processed, cb.time_sample_processed, cb.sample_wetweight, cb.elution_volume, rs.sampletype,
                           $case_query, 
                           GROUP_CONCAT(DISTINCT rb.biochemical_tube ORDER BY rb.biochemical_tube SEPARATOR ', ') AS biochemical_tube, 
                           GROUP_CONCAT(DISTINCT CONCAT(rb.biochemical_tube, ':', rb.confirmation) ORDER BY rb.biochemical_tube SEPARATOR ', ') AS confirmation,
                           GROUP_CONCAT(DISTINCT sgph.plate_number ORDER BY sgph.plate_number SEPARATOR ', ') AS plate_numbers");
        $this->db->from('campy_biosolids AS cb');
        $this->db->join('result_hba AS rh', 'cb.id_campy_biosolids = rh.id_campy_biosolids', 'left');
        $this->db->join('sample_growth_plate_hba AS sgph', 'rh.id_result_hba = sgph.id_result_hba', 'left');
        $this->db->join('sample_volumes AS sv1', 'rh.id_campy_biosolids = sv1.id_campy_biosolids', 'left');
        $this->db->join('result_biochemical AS rb', 'sgph.id_result_hba = rb.id_result_hba', 'left');
        $this->db->join('ref_sampletype AS rs', 'cb.id_sampletype = rs.id_sampletype', 'left');
        $this->db->join('ref_person AS rp',  'cb.id_person = rp.id_person', 'left');
    
        // Conditions
        $this->db->where('rb.flag', '0');
        $this->db->where('rh.id_campy_biosolids', $id);
        $this->db->group_by('rh.id_result_hba');
    
        $q = $this->db->get();
    
        if ($q->num_rows() > 0) {
            $response = $q->result(); // Fetch all results if available
            foreach ($response as $key => $value) {
                $confirmations = explode(',', $value->confirmation);
                $biochemical_tubes = explode(',', $value->biochemical_tube);
                // $plate_numbers = explode(',', $value->plate_numbers);
                // var_dump($plate_numbers);
                // die();
    
                // Inisialisasi confirmation array untuk tiap plate_number
                // $confirmation_array = array_fill_keys($plate_numbers, '');
    
                foreach ($biochemical_tubes as $tube) {
                    $index = array_search($tube, $biochemical_tubes);
                    $confirmation_array[$tube] = explode(':', $confirmations[$index])[1] ?? 'No Growth Plate'; // Menyediakan default
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
        $this->db->from('sample_volumes');
        $this->db->where('id_campy_biosolids', $id);
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
        $this->db->select("cb.id_one_water_sample, cb.id_person, rp.initial, cb.mpn_pcr_conducted, cb.number_of_tubes, cb.campy_assay_barcode, cb.date_sample_processed, cb.time_sample_processed, cb.sample_wetweight, cb.elution_volume, rs.sampletype,
                           $case_query, 
                           GROUP_CONCAT(DISTINCT rb.biochemical_tube ORDER BY rb.biochemical_tube SEPARATOR ', ') AS biochemical_tube, 
                           GROUP_CONCAT(DISTINCT CONCAT(rb.biochemical_tube, ':', rb.confirmation) ORDER BY rb.biochemical_tube SEPARATOR ', ') AS confirmation,
                           GROUP_CONCAT(DISTINCT sgph.plate_number ORDER BY sgph.plate_number SEPARATOR ', ') AS plate_numbers");
        $this->db->from('campy_biosolids AS cb');
        $this->db->join('result_hba AS rh', 'cb.id_campy_biosolids = rh.id_campy_biosolids', 'left');
        $this->db->join('sample_growth_plate_hba AS sgph', 'rh.id_result_hba = sgph.id_result_hba', 'left');
        $this->db->join('sample_volumes AS sv1', 'rh.id_campy_biosolids = sv1.id_campy_biosolids', 'left');
        $this->db->join('result_biochemical AS rb', 'sgph.id_result_hba = rb.id_result_hba', 'left');
        $this->db->join('ref_sampletype AS rs', 'cb.id_sampletype = rs.id_sampletype', 'left');
        $this->db->join('ref_person AS rp',  'cb.id_person = rp.id_person', 'left');
    
        // Conditions
        $this->db->where('rb.flag', '0');
        $this->db->where('rh.id_campy_biosolids', $id);
        $this->db->group_by('rh.id_result_hba');
    
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
                        $confirmation_value = explode(':', $confirmations[$index])[1] ?? 'No Growth'; // Default if not set
                        $confirmation_array[$tube] = $confirmation_value;
                    }
                }
    
                $value->confirmation = $confirmation_array; // Assign processed confirmation
            }
        }
    
        return $response;
    }

    // function get_all_export() {
    //     $response = array();
    
    //     // Step 1: Get unique tube_number
    //     $this->db->select('tube_number');
    //     $this->db->distinct();
    //     $this->db->from('sample_volumes');
    //     $this->db->where('id_campy_biosolids IS NOT NULL'); // Pastikan ada kondisi yang benar
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
    //     $this->db->from('campy_biosolids AS cb');
    //     $this->db->join('result_hba AS rh', 'cb.id_campy_biosolids = rh.id_campy_biosolids', 'left');
    //     $this->db->join('sample_growth_plate_hba AS sgph', 'rh.id_result_hba = sgph.id_result_hba', 'left');
    //     $this->db->join('sample_volumes AS sv1', 'rh.id_campy_biosolids = sv1.id_campy_biosolids', 'left');
    //     $this->db->join('result_biochemical AS rb', 'sgph.id_result_hba = rb.id_result_hba', 'left');
    //     $this->db->join('ref_sampletype AS rs', 'cb.id_sampletype = rs.id_sampletype', 'left');
    //     $this->db->join('ref_person AS rp',  'cb.id_person = rp.id_person', 'left');
    
    //     // Conditions
    //     $this->db->where('rb.flag', '0');
    //     $this->db->group_by('rh.id_result_hba');
    
    //     $q = $this->db->get();
    
    //     // Debugging: Cek hasil query
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
    //                     $confirmation_value = explode(':', $confirmations[$index])[1] ?? 'No Growth'; // Default if not set
    //                     $confirmation_array[$tube] = $confirmation_value;
    //                 }
    //             }
    
    //             $value->confirmation = $confirmation_array; // Assign processed confirmation
    //         }
    //     } else {
    //         echo "No data found for the given query.";
    //     }
    
    //     return $response;
    // }
    
    function get_all_export() {
        $response = array();
    
        // Step 1: Get unique tube_number
        $this->db->select('tube_number');
        $this->db->distinct();
        $this->db->from('sample_volumes');
        $this->db->where('id_campy_biosolids IS NOT NULL');
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
        $this->db->select("cb.id_one_water_sample, cb.id_person, rp.initial, cb.mpn_pcr_conducted, cb.number_of_tubes, cb.campy_assay_barcode, cb.date_sample_processed, cb.time_sample_processed, cb.sample_wetweight, cb.elution_volume, rs.sampletype,
                           $case_query, 
                           GROUP_CONCAT(DISTINCT rb.biochemical_tube ORDER BY rb.biochemical_tube SEPARATOR ', ') AS biochemical_tube, 
                           GROUP_CONCAT(DISTINCT CONCAT(rb.biochemical_tube, ':', rb.confirmation) ORDER BY rb.biochemical_tube SEPARATOR ', ') AS confirmation,
                           GROUP_CONCAT(DISTINCT sgph.plate_number ORDER BY sgph.plate_number SEPARATOR ', ') AS plate_numbers");
        $this->db->from('campy_biosolids AS cb');
        $this->db->join('result_hba AS rh', 'cb.id_campy_biosolids = rh.id_campy_biosolids', 'left');
        $this->db->join('sample_growth_plate_hba AS sgph', 'rh.id_result_hba = sgph.id_result_hba', 'left');
        $this->db->join('sample_volumes AS sv1', 'rh.id_campy_biosolids = sv1.id_campy_biosolids', 'left');
        $this->db->join('result_biochemical AS rb', 'sgph.id_result_hba = rb.id_result_hba', 'left');
        $this->db->join('ref_sampletype AS rs', 'cb.id_sampletype = rs.id_sampletype', 'left');
        $this->db->join('ref_person AS rp', 'cb.id_person = rp.id_person', 'left');
    
        // Conditions
        $this->db->where('rb.flag', '0');
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
                $confirmation_array = array_fill_keys(range(1, count($biochemical_tubes)), 'No Growth'); // Default ke "No Growth"
    
                // Mengisi nilai konfirmasi berdasarkan indeks tabung
                foreach ($biochemical_tubes as $index => $tube) {
                    $confirmation_value = explode(':', $confirmations[$index])[1] ?? 'No Growth';
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

    function get_by_id_detail24($id)
    {
        $this->db->where('id_moisture24', $id);
        $this->db->where('flag', '0');
        // $this->db->where('lab', $this->session->userdata('lab'));
        return $this->db->get('moisture24')->row();
    }

    function get_by_id_detail72($id)
    {
        $this->db->where('id_moisture72', $id);
        $this->db->where('flag', '0');
        // $this->db->where('lab', $this->session->userdata('lab'));
        return $this->db->get('moisture72')->row();
    }

    function get_detail($id)
    {

      $response = array();
      $this->db->select('cb.id_campy_biosolids, cb.id_one_water_sample, cb.id_person, rp.initial, cb.number_of_tubes,
        cb.id_sampletype, rs.sampletype, cb.mpn_pcr_conducted, cb.campy_assay_barcode, cb.date_sample_processed,
        cb.time_sample_processed, cb.time_sample_processed, cb.sample_wetweight, cb.elution_volume,
        GROUP_CONCAT(sv.vol_sampletube ORDER BY sv.tube_number SEPARATOR ", ") AS vol_sampletube, GROUP_CONCAT(sv.tube_number ORDER BY sv.tube_number SEPARATOR ", ") AS tube_number');
      $this->db->from('campy_biosolids AS cb');
      $this->db->join('ref_sampletype AS rs', 'cb.id_sampletype = rs.id_sampletype', 'left');
      $this->datatables->join('sample_volumes AS sv', 'cb.id_campy_biosolids = sv.id_campy_biosolids', 'left');
      $this->db->join('ref_person AS rp',  'cb.id_person = rp.id_person', 'left');
      $this->db->where('cb.id_campy_biosolids', $id);
      $this->db->where('cb.flag', '0');
      $q = $this->db->get();

      if ($q->num_rows() > 0) {
        $response = $q->row();
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

    // Fuction insert data
    // public function insert($data) {
    //     $this->db->insert($this->table,  $data);
    // }

    // // Function update data
    // function update($id, $data)
    // {
    //     $this->db->where('id_moisture', $id);
    //     $this->db->update($this->table, $data);
    // }

    // function insert_det24($data) {
    //     $this->db->insert($this->table24, $data);
    //     return $this->db->insert_id(); // Return the ID of the newly inserted row
    // }

    // function update_det24($id, $data) {
    //     $this->db->where('id_moisture24', $id);
    //     $this->db->update('moisture24', $data);
    // }

    // function insert_det72($data) {
    //     $this->db->insert($this->table72, $data);
    //     return $this->db->insert_id(); // Return the ID of the newly inserted row
    // }

    // function update_det72($id, $data) {
    //     $this->db->where('id_moisture72', $id);
    //     $this->db->update('moisture72', $data);
    // }

    // delete data
    // function delete($id) {
    //     $this->db->where($this->id, $id);
    //     $this->db->delete($this->table);
    // }

    // function delete_detail($id) {
    //     $this->db->where($this->id, $id);
    //     $this->db->delete($this->table);
    // }
    

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

    function validate24($id){
        $q = $this->db->query('
        SELECT barcode_moisture_content FROM moisture_content
        WHERE barcode_moisture_content = "'.$id.'"
        AND barcode_moisture_content NOT IN (SELECT barcode_tray FROM moisture24 WHERE flag IN (0))
        ');        
        $response = $q->result_array();
        return $response;
    }

    function validate72($id){
        $q = $this->db->query('
        SELECT barcode_tray FROM moisture24
        WHERE barcode_tray = "'.$id.'"
        AND flag = 0 
        ');        
        $response = $q->result_array();
        return $response;
    }

    function get_all()
    {
        $this->db->select('mc.id_one_water_sample, rp.initial, mc.date_start, rs.sampletype, mc.barcode_moisture_content, mc.tray_weight,
        mc.traysample_wetweight, mc.time_incubator,mc.comments, m24.date_moisture24, m24.time_moisture24, m24.dry_weight24, m24.comments24,
        m72.date_moisture72, m72.time_moisture72, m72.dry_weight72, m72.dry_weight_persen, m72.comments72');
        $this->db->from('moisture_content AS mc');
        $this->db->join('ref_person AS rp', 'mc.id_person = rp.id_person');
        $this->db->join('ref_sampletype AS rs', 'mc.id_sampletype = rs.id_sampletype');
        $this->db->join('moisture24 AS m24', 'mc.id_moisture = m24.id_moisture');
        $this->db->join('moisture72 AS m72', 'mc.id_moisture = m72.id_moisture');
        $this->db->where('mc.flag', '0');
        $this->db->order_by('mc.date_start', 'ASC');

        return $this->db->get()->result();
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
        $this->db->insert('sample_volumes', $data);
    }
    
    function updateCampyBiosolids($id, $data) {
        $this->db->where('id_campy_biosolids', $id);
        $this->db->update('campy_biosolids', $data);
    }

    public function delete_sample_volumes($id_campy_biosolids) {
        $this->db->where('id_campy_biosolids', $id_campy_biosolids);
        $this->db->delete('sample_volumes');
    }

    public function insertResultsCharcoal($data) {
        $this->db->insert('result_charcoal', $data);
        return $this->db->insert_id(); // Return the last inserted ID
    }

    public function insert_growth_plate($data) {
        $this->db->insert('sample_growth_plate', $data);
    }

    function updateResultsCharcoal($id, $data) {
        $this->db->where('id_result_charcoal', $id);
        $this->db->update('result_charcoal', $data);
    }

    public function delete_growth_plates($id_result_charcoal) {
        $this->db->where('id_result_charcoal', $id_result_charcoal);
        $this->db->delete('sample_growth_plate');
    }

    function get_by_id_charcoal($id)
    {
        $this->db->where('id_result_charcoal', $id);
        $this->db->where('flag', '0');
        // $this->db->where('lab', $this->session->userdata('lab'));
        return $this->db->get('result_charcoal')->row();
    }

    function updateResultsGrowthPlate($id, $data) {
        $this->db->where('id_result_charcoal', $id);
        $this->db->update('sample_growth_plate', $data);
    }

    function get_by_id_campybiosolids($id)
    {
        $this->db->where('id_campy_biosolids', $id);
        $this->db->where('flag', '0');
        // $this->db->where('lab', $this->session->userdata('lab'));
        return $this->db->get('campy_biosolids')->row();
    }

    function updateSampleVolume($id, $data) {
        $this->db->where('id_campy_biosolids', $id);
        $this->db->update('sample_volumes', $data);
    }

    function insertResultsHba($data) {
        $this->db->insert('result_hba', $data);
        return $this->db->insert_id();
    }

    public function insert_growth_plate_hba($data) {
        $this->db->insert('sample_growth_plate_hba', $data);
    }

    function updateResultsHba($id_result_hba, $data) {
        $this->db->where('id_result_hba', $id_result_hba);
        $this->db->update('result_hba', $data);
    }

    public function delete_growth_plates_hba($id_result_hba) {
        $this->db->where('id_result_hba', $id_result_hba);
        $this->db->delete('sample_growth_plate_hba');
    }

    function get_by_id_hba($id)
    {
        $this->db->where('id_result_hba', $id);
        $this->db->where('flag', '0');
        // $this->db->where('lab', $this->session->userdata('lab'));
        return $this->db->get('result_hba')->row();
    }

    function updateResultsGrowthPlateHba($id, $data) {
        $this->db->where('id_result_hba', $id);
        $this->db->update('sample_growth_plate_hba', $data);
    }

    function insertResultsBiochemical($data) {
        $this->db->insert('result_biochemical', $data);
        return $this->db->insert_id();
    }
    
    function get_by_id_biochemical($id)
    {
        $this->db->where('id_result_biochemical', $id);
        $this->db->where('flag', '0');
        // $this->db->where('lab', $this->session->userdata('lab'));
        return $this->db->get('result_biochemical')->row();
    }

    function updateResultsBiochemical($id_result_biochemical, $data) {
        $this->db->where('id_result_biochemical', $id_result_biochemical);
        $this->db->update('result_biochemical', $data);
    }
    

      
}

/* End of file Tbl_delivery_model.php */
/* Location: ./application/models/Tbl_delivery_model.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2022-12-14 03:38:42 */
/* http://harviacode.com */