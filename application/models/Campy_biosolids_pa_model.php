<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Campy_biosolids_pa_model extends CI_Model
{
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

    // datatables
// datatables
    function json() {
        $this->datatables->select('cbp.id_campy_biosolids_pa, cbp.id_one_water_sample, cbp.id_person, cbp.number_of_tubes, cbp.mpn_pcr_conducted, cbp.campy_assay_barcode, 
        rp.initial, cbp.date_sample_processed, cbp.time_sample_processed, cbp.sample_wetweight, cbp.elution_volume,
        cbp.id_sampletype, rs.sampletype, GROUP_CONCAT(svp.vol_sampletube ORDER BY svp.tube_number SEPARATOR ", ") AS vol_sampletube, GROUP_CONCAT(svp.tube_number ORDER BY svp.tube_number SEPARATOR ", ") AS tube_number, cbp.flag,
        cbp.date_created, cbp.date_updated, GREATEST(cbp.date_created, cbp.date_updated) AS latest_date');
        $this->datatables->from('campy_biosolids_pa AS cbp');
        $this->datatables->join('ref_person AS rp', 'cbp.id_person = rp.id_person', 'left');
        $this->datatables->join('ref_sampletype AS rs', 'cbp.id_sampletype = rs.id_sampletype', 'left');
        $this->datatables->join('sample_volumes_pa AS svp', 'cbp.id_campy_biosolids_pa = svp.id_campy_biosolids_pa', 'left');
        // $this->datatables->where('lab', $this->session->userdata('lab'));
        $this->datatables->where('cbp.flag', '0');
        // GROUP BY
        $this->datatables->group_by('cbp.id_campy_biosolids_pa');
        $lvl = $this->session->userdata('id_user_level');
        if ($lvl == 4){
            $this->datatables->add_column('action', anchor(site_url('campy_biosolids_pa/read/$1'),'<i class="fa fa-th-list" aria-hidden="true"></i>', array('class' => 'btn btn-warning btn-sm')), 'id_campy_biosolids_pa');
        }
        else if ($lvl == 3){
            $this->datatables->add_column('action', anchor(site_url('campy_biosolids_pa/read/$1'),'<i class="fa fa-th-list" aria-hidden="true"></i>', array('class' => 'btn btn-warning btn-sm')) ."
                ".'<button type="button" class="btn_edit btn btn-info btn-sm" aria-hidden="true"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>', 'id_campy_biosolids_pa');
        }
        else {
            $this->datatables->add_column('action', anchor(site_url('campy_biosolids_pa/read/$1'),'<i class="fa fa-th-list" aria-hidden="true"></i>', array('class' => 'btn btn-warning btn-sm')) ."
            ".'<button type="button" class="btn_edit btn btn-info btn-sm" aria-hidden="true"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>'." 
            ".'<button type="button" class="btn_deleteCampyBiosolids btn btn-danger btn-sm" data-id="$1" aria-hidden="true"><i class="fa fa-trash-o" aria-hidden="true"></i></button>', 'id_campy_biosolids_pa');
        }
        $this->db->order_by('latest_date', 'DESC');
        return $this->datatables->generate();
    }

    function subjsonCharcoal($id) {
        $this->datatables->select('rcp.id_result_charcoal_pa, cbp.campy_assay_barcode, rcp.id_campy_biosolids_pa, rcp.date_sample_processed, rcp.time_sample_processed,
        GROUP_CONCAT(sgpp.growth_plate ORDER BY sgpp.plate_number SEPARATOR ", ") AS growth_plate, GROUP_CONCAT(sgpp.plate_number ORDER BY sgpp.plate_number SEPARATOR ", ") AS plate_number, rcp.flag');
        $this->datatables->from('result_charcoal_pa AS rcp');
        $this->datatables->join('campy_biosolids_pa AS cbp', 'rcp.id_campy_biosolids_pa = cbp.id_campy_biosolids_pa', 'left');
        $this->datatables->join('sample_growth_plate_pa AS sgpp', 'rcp.id_result_charcoal_pa = sgpp.id_result_charcoal_pa', 'left');
        // $this->datatables->join('ref_testing b', 'FIND_IN_SET(b.id_testing_type, a.id_testing_type)', 'left');
        // $this->datatables->join('ref_barcode c', 'a.sample_id = c.testing_type_id', 'left');
        $this->datatables->where('rcp.flag', '0');
        $this->datatables->where('rcp.id_campy_biosolids_pa', $id);
        $this->datatables->group_by('
        rcp.id_result_charcoal_pa, 
        cbp.campy_assay_barcode, 
        rcp.id_campy_biosolids_pa, 
        rcp.date_sample_processed, 
        rcp.time_sample_processed,
        rcp.flag
        ');
        $lvl = $this->session->userdata('id_user_level');
        if ($lvl == 4){
            $this->datatables->add_column('action', '', 'id_result_charcoal_pa');
        }
        else if ($lvl == 3){
            $this->datatables->add_column('action', '<button type="button" class="btn_edit_detResultsCharcoal btn btn-info btn-sm" aria-hidden="true"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>', 'id_result_charcoal_pa');
        }
        else {
            $this->datatables->add_column('action', '<button type="button" class="btn_edit_detResultsCharcoal btn btn-info btn-sm" aria-hidden="true"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>'." 
                ".'<button type="button" class="btn_deleteCharcoal btn btn-danger btn-sm" data-id="$1" aria-hidden="true"><i class="fa fa-trash-o" aria-hidden="true"></i></button>', 'id_result_charcoal_pa');
        }
        return $this->datatables->generate();
    }

    function subjsonHba($id) {
        $this->datatables->select('rhp.id_result_hba_pa, cbp.campy_assay_barcode, rhp.id_campy_biosolids_pa, rhp.date_sample_processed, rhp.time_sample_processed, 
        GROUP_CONCAT(sgphp.growth_plate ORDER BY sgphp.plate_number SEPARATOR ", ") AS growth_plate, GROUP_CONCAT(sgphp.plate_number ORDER BY sgphp.plate_number SEPARATOR ", ") AS plate_number, rhp.flag, sgphp.id_sample_plate_hba_pa');
        $this->datatables->from('result_hba_pa AS rhp');
        $this->datatables->join('campy_biosolids_pa AS cbp', 'rhp.id_campy_biosolids_pa = cbp.id_campy_biosolids_pa', 'left');
        $this->datatables->join('sample_growth_plate_hba_pa AS sgphp', 'rhp.id_result_hba_pa = sgphp.id_result_hba_pa', 'left');
        $this->datatables->where('rhp.flag', '0');
        $this->datatables->where('rhp.id_campy_biosolids_pa', $id);
        $this->datatables->group_by('
        rhp.id_result_hba_pa, 
        cbp.campy_assay_barcode, 
        rhp.id_campy_biosolids_pa, 
        rhp.date_sample_processed, 
        rhp.time_sample_processed,
        rhp.flag
        ');
        $lvl = $this->session->userdata('id_user_level');
        if ($lvl == 4){
            $this->datatables->add_column('action', '', 'id_result_hba_pa');
        }
        else if ($lvl == 3){
            $this->datatables->add_column('action', '<button type="button" class="btn_edit_detResultsHba btn btn-info btn-sm" aria-hidden="true"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>', 'id_result_hba_pa');
        }
        else {
            $this->datatables->add_column('action', '<button type="button" class="btn_edit_detResultsHba btn btn-info btn-sm" aria-hidden="true"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>'." 
                ".'<button type="button" class="btn_deleteHba btn btn-danger btn-sm" data-id="$1" aria-hidden="true"><i class="fa fa-trash-o" aria-hidden="true"></i></button>', 'id_result_hba_pa');
        }
        return $this->datatables->generate();
    }

    function subjsonBiochemical($id, $biochemical_tube) {

        $this->datatables->select('rbp.id_result_biochemical_pa, rbp.id_campy_biosolids_pa, rbp.id_result_hba_pa, cbp.campy_assay_barcode, rbp.oxidase, rbp.catalase, rbp.confirmation, rbp.sample_store, rbp.biochemical_tube, rbp.flag');
        $this->datatables->from('result_biochemical_pa AS rbp');
        $this->datatables->join('campy_biosolids_pa AS cbp', 'rbp.id_campy_biosolids_pa = cbp.id_campy_biosolids_pa', 'left');
        $this->datatables->where('rbp.flag', '0');
        $this->datatables->where('rbp.id_campy_biosolids_pa', $id);
        
        // Tambahkan kondisi untuk biochemical_tube jika ada
        if (!empty($biochemical_tube)) {
            $this->datatables->where('rbp.biochemical_tube', $biochemical_tube);
        }
    
        $lvl = $this->session->userdata('id_user_level');
        if ($lvl == 4){
            $this->datatables->add_column('action', '', 'id_result_biochemical_pa');
        } else if ($lvl == 3){
            $this->datatables->add_column('action', '<button type="button" class="btn_edit_detResultsBiochemical btn btn-info btn-sm" aria-hidden="true"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>', 'id_result_biochemical_pa');
        } else {
            $this->datatables->add_column('action', '<button type="button" class="btn_edit_detResultsBiochemical btn btn-info btn-sm" aria-hidden="true"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>'." 
                ".'<button type="button" class="btn_deleteBiochemical btn btn-danger btn-sm" data-id="$1" aria-hidden="true"><i class="fa fa-trash-o" aria-hidden="true"></i></button>', 'id_result_biochemical_pa');
        }
        return $this->datatables->generate();
    }

    function subjsonFinalConcentration($id)
    {
        $response = array();
    
        // Step 1: Get unique tube_number
        $this->db->select('tube_number');
        $this->db->distinct();
        $this->db->from('sample_volumes_pa');
        $this->db->where('id_campy_biosolids_pa', $id);
        $tube_numbers = $this->db->get()->result_array();
    
        // Check if tube numbers are empty
        if (empty($tube_numbers)) {
            return []; // Handle case where no tube numbers found
        }
    
        // Step 2: Create case query for pivot
        $case_statements = [];
        foreach ($tube_numbers as $row) {
            $tube_number = $row['tube_number'];
            $case_statements[] = "MAX(CASE WHEN svp1.tube_number = {$tube_number} THEN svp1.vol_sampletube END) AS `Tube {$tube_number}`";
        }
        $case_query = implode(', ', $case_statements);
    
        // Final query
        $this->db->select("cbp.id_one_water_sample, cbp.id_person, rp.initial, cbp.mpn_pcr_conducted, cbp.number_of_tubes, cbp.campy_assay_barcode, cbp.date_sample_processed, cbp.time_sample_processed, cbp.sample_wetweight, cbp.elution_volume, rs.sampletype,
                           $case_query, 
                           GROUP_CONCAT(DISTINCT rbp.biochemical_tube ORDER BY rbp.biochemical_tube SEPARATOR ', ') AS biochemical_tube, 
                           GROUP_CONCAT(DISTINCT CONCAT(rbp.biochemical_tube, ':', rbp.confirmation) ORDER BY rbp.biochemical_tube SEPARATOR ', ') AS confirmation,
                           GROUP_CONCAT(DISTINCT sgphp.plate_number ORDER BY sgphp.plate_number SEPARATOR ', ') AS plate_numbers");
        $this->db->from('campy_biosolids_pa AS cbp');
        $this->db->join('result_hba_pa AS rhp', 'cbp.id_campy_biosolids_pa = rhp.id_campy_biosolids_pa', 'left');
        $this->db->join('sample_growth_plate_hba_pa AS sgphp', 'rhp.id_result_hba_pa = sgphp.id_result_hba_pa', 'left');
        $this->db->join('sample_volumes_pa AS svp1', 'rhp.id_campy_biosolids_pa = svp1.id_campy_biosolids_pa', 'left');
        $this->db->join('result_biochemical_pa AS rbp', 'sgphp.id_result_hba_pa = rbp.id_result_hba_pa', 'left');
        $this->db->join('ref_sampletype AS rs', 'cbp.id_sampletype = rs.id_sampletype', 'left');
        $this->db->join('ref_person AS rp',  'cbp.id_person = rp.id_person', 'left');
    
        // Conditions
        $this->db->where('rbp.flag', '0');
        $this->db->where('rhp.id_campy_biosolids_pa', $id);
        $this->db->group_by('rhp.id_result_hba_pa');
    
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
        $this->db->from('sample_volumes_pa');
        $this->db->where('id_campy_biosolids_pa', $id);
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
            $case_statements[] = "MAX(CASE WHEN svp1.tube_number = {$tube_number} THEN svp1.vol_sampletube END) AS `Tube {$tube_number}`";
        }
        $case_query = implode(', ', $case_statements);
    
        // Final query
        $this->db->select("cbp.id_one_water_sample, cbp.id_person, rp.initial, cbp.mpn_pcr_conducted, cbp.number_of_tubes, cbp.campy_assay_barcode, cbp.date_sample_processed, cbp.time_sample_processed, cbp.sample_wetweight, cbp.elution_volume, rs.sampletype,
                           $case_query, 
                           GROUP_CONCAT(DISTINCT rbp.biochemical_tube ORDER BY rbp.biochemical_tube SEPARATOR ', ') AS biochemical_tube, 
                           GROUP_CONCAT(DISTINCT CONCAT(rbp.biochemical_tube, ':', rbp.confirmation) ORDER BY rbp.biochemical_tube SEPARATOR ', ') AS confirmation,
                           GROUP_CONCAT(DISTINCT sgphp.plate_number ORDER BY sgphp.plate_number SEPARATOR ', ') AS plate_numbers");
        $this->db->from('campy_biosolids_pa AS cbp');
        $this->db->join('result_hba_pa AS rhp', 'cbp.id_campy_biosolids_pa = rhp.id_campy_biosolids_pa', 'left');
        $this->db->join('sample_growth_plate_hba_pa AS sgphp', 'rhp.id_result_hba_pa = sgphp.id_result_hba_pa', 'left');
        $this->db->join('sample_volumes_pa AS svp1', 'rhp.id_campy_biosolids_pa = svp1.id_campy_biosolids_pa', 'left');
        $this->db->join('result_biochemical_pa AS rbp', 'sgphp.id_result_hba_pa = rbp.id_result_hba_pa', 'left');
        $this->db->join('ref_sampletype AS rs', 'cbp.id_sampletype = rs.id_sampletype', 'left');
        $this->db->join('ref_person AS rp',  'cbp.id_person = rp.id_person', 'left');
    
        // Conditions
        $this->db->where('rbp.flag', '0');
        $this->db->where('rhp.id_campy_biosolids_pa', $id);
        $this->db->group_by('rhp.id_result_hba_pa');
    
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
    
    function get_all_export() {
        $response = array();
    
        // Step 1: Get unique tube_number
        $this->db->select('tube_number');
        $this->db->distinct();
        $this->db->from('sample_volumes_pa');
        $this->db->where('id_campy_biosolids_pa IS NOT NULL');
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
            $case_statements[] = "MAX(CASE WHEN svp1.tube_number = {$tube_number} THEN svp1.vol_sampletube END) AS `Tube {$tube_number}`";
        }
        $case_query = implode(', ', $case_statements);
    
        // Final query
        $this->db->select("cbp.id_one_water_sample, cbp.id_person, rp.initial, cbp.mpn_pcr_conducted, cbp.number_of_tubes, cbp.campy_assay_barcode, cbp.date_sample_processed, cbp.time_sample_processed, cbp.sample_wetweight, cbp.elution_volume, rs.sampletype,
                           $case_query, 
                           GROUP_CONCAT(DISTINCT rbp.biochemical_tube ORDER BY rbp.biochemical_tube SEPARATOR ', ') AS biochemical_tube, 
                           GROUP_CONCAT(DISTINCT CONCAT(rbp.biochemical_tube, ':', rbp.confirmation) ORDER BY rbp.biochemical_tube SEPARATOR ', ') AS confirmation,
                           GROUP_CONCAT(DISTINCT sgphp.plate_number ORDER BY sgphp.plate_number SEPARATOR ', ') AS plate_numbers");
        $this->db->from('campy_biosolids_pa AS cbp');
        $this->db->join('result_hba_pa AS rhp', 'cbp.id_campy_biosolids_pa = rhp.id_campy_biosolids_pa', 'left');
        $this->db->join('sample_growth_plate_hba_pa AS sgphp', 'rhp.id_result_hba_pa = sgphp.id_result_hba_pa', 'left');
        $this->db->join('sample_volumes_pa AS svp1', 'rhp.id_campy_biosolids_pa = svp1.id_campy_biosolids_pa', 'left');
        $this->db->join('result_biochemical_pa AS rbp', 'sgphp.id_result_hba_pa = rbp.id_result_hba_pa', 'left');
        $this->db->join('ref_sampletype AS rs', 'cbp.id_sampletype = rs.id_sampletype', 'left');
        $this->db->join('ref_person AS rp', 'cbp.id_person = rp.id_person', 'left');
    
        // Conditions
        $this->db->where('rbp.flag', '0');
        $this->db->group_by('rhp.id_result_hba_pa');
    
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

    function get_detail($id)
    {

      $response = array();
      $this->db->select('cbp.id_campy_biosolids_pa, cbp.id_one_water_sample, cbp.id_person, rp.initial, cbp.number_of_tubes,
        cbp.id_sampletype, rs.sampletype, cbp.mpn_pcr_conducted, cbp.campy_assay_barcode, cbp.date_sample_processed,
        cbp.time_sample_processed, cbp.time_sample_processed, cbp.sample_wetweight, cbp.elution_volume,
        GROUP_CONCAT(svp.vol_sampletube ORDER BY svp.tube_number SEPARATOR ", ") AS vol_sampletube, GROUP_CONCAT(svp.tube_number ORDER BY svp.tube_number SEPARATOR ", ") AS tube_number');
      $this->db->from('campy_biosolids_pa AS cbp');
      $this->db->join('ref_sampletype AS rs', 'cbp.id_sampletype = rs.id_sampletype', 'left');
      $this->datatables->join('sample_volumes_pa AS svp', 'cbp.id_campy_biosolids_pa = svp.id_campy_biosolids_pa', 'left');
      $this->db->join('ref_person AS rp',  'cbp.id_person = rp.id_person', 'left');
      $this->db->where('cbp.id_campy_biosolids_pa', $id);
      $this->db->where('cbp.flag', '0');
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
        WHERE id_one_water_sample NOT IN (SELECT id_one_water_sample FROM campy_biosolids_pa)
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
        SELECT campy_assay_barcode FROM campy_biosolids_pa
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
        $this->db->where('value =', 1);
        $this->db->order_by('value');
        $labTech = $this->db->get('ref_tubes');
        $response = $labTech->result_array();
        return $response;
    }



    public function insert($data) {
        $this->db->insert('campy_biosolids_pa', $data);
        return $this->db->insert_id(); // Return the last inserted ID
    }
    
    public function insert_sample_volume($data) {
        $this->db->insert('sample_volumes_pa', $data);
    }
    
    function updateCampyBiosolids($id, $data) {
        $this->db->where('id_campy_biosolids_pa', $id);
        $this->db->update('campy_biosolids_pa', $data);
    }

    public function delete_sample_volumes($id_campy_biosolids_pa) {
        $this->db->where('id_campy_biosolids_pa', $id_campy_biosolids_pa);
        $this->db->delete('sample_volumes_pa');
    }

    public function insertResultsCharcoal($data) {
        $this->db->insert('result_charcoal_pa', $data);
        return $this->db->insert_id(); // Return the last inserted ID
    }

    public function insert_growth_plate($data) {
        $this->db->insert('sample_growth_plate_pa', $data);
    }

    function updateResultsCharcoal($id, $data) {
        $this->db->where('id_result_charcoal_pa', $id);
        $this->db->update('result_charcoal_pa', $data);
    }

    public function delete_growth_plates($id_result_charcoal_pa) {
        $this->db->where('id_result_charcoal_pa', $id_result_charcoal_pa);
        $this->db->delete('sample_growth_plate_pa');
    }

    function get_by_id_charcoal($id)
    {
        $this->db->where('id_result_charcoal_pa', $id);
        $this->db->where('flag', '0');
        // $this->db->where('lab', $this->session->userdata('lab'));
        return $this->db->get('result_charcoal_pa')->row();
    }

    function updateResultsGrowthPlate($id, $data) {
        $this->db->where('id_result_charcoal_pa', $id);
        $this->db->update('sample_growth_plate_pa', $data);
    }

    function get_by_id_campybiosolids($id)
    {
        $this->db->where('id_campy_biosolids_pa', $id);
        $this->db->where('flag', '0');
        // $this->db->where('lab', $this->session->userdata('lab'));
        return $this->db->get('campy_biosolids_pa')->row();
    }

    function updateSampleVolume($id, $data) {
        $this->db->where('id_campy_biosolids_pa', $id);
        $this->db->update('sample_volumes_pa', $data);
    }

    function insertResultsHba($data) {
        $this->db->insert('result_hba_pa', $data);
        return $this->db->insert_id();
    }

    public function insert_growth_plate_hba($data) {
        $this->db->insert('sample_growth_plate_hba_pa', $data);
    }

    function updateResultsHba($id_result_hba_pa, $data) {
        $this->db->where('id_result_hba_pa', $id_result_hba_pa);
        $this->db->update('result_hba_pa', $data);
    }

    public function delete_growth_plates_hba($id_result_hba_pa) {
        $this->db->where('id_result_hba_pa', $id_result_hba_pa);
        $this->db->delete('sample_growth_plate_hba_pa');
    }

    function get_by_id_hba($id)
    {
        $this->db->where('id_result_hba_pa', $id);
        $this->db->where('flag', '0');
        // $this->db->where('lab', $this->session->userdata('lab'));
        return $this->db->get('result_hba_pa')->row();
    }

    function updateResultsGrowthPlateHba($id, $data) {
        $this->db->where('id_result_hba_pa', $id);
        $this->db->update('sample_growth_plate_hba_pa', $data);
    }

    function insertResultsBiochemical($data) {
        $this->db->insert('result_biochemical_pa', $data);
        return $this->db->insert_id();
    }
    
    function get_by_id_biochemical($id)
    {
        $this->db->where('id_result_biochemical_pa', $id);
        $this->db->where('flag', '0');
        // $this->db->where('lab', $this->session->userdata('lab'));
        return $this->db->get('result_biochemical_pa')->row();
    }

    function updateResultsBiochemical($id_result_biochemical_pa, $data) {
        $this->db->where('id_result_biochemical_pa', $id_result_biochemical_pa);
        $this->db->update('result_biochemical_pa', $data);
    }

      
}

/* End of file Tbl_delivery_model.php */
/* Location: ./application/models/Tbl_delivery_model.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2022-12-14 03:38:42 */
/* http://harviacode.com */