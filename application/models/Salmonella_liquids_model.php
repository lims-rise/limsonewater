<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Salmonella_liquids_model extends CI_Model
{

    function __construct()
    {
        parent::__construct();
    }

    // datatables
    function json() {
        $this->datatables->select('sl.id_salmonella_liquids, sl.id_one_water_sample, sl.id_person, sl.number_of_tubes, sl.mpn_pcr_conducted, sl.salmonella_assay_barcode, 
        rp.initial, sl.date_sample_processed, sl.time_sample_processed, sl.sample_wetweight, sl.elution_volume,
        sl.id_sampletype, rs.sampletype, GROUP_CONCAT(ssvl.vol_sampletube ORDER BY ssvl.tube_number SEPARATOR ", ") AS vol_sampletube, GROUP_CONCAT(ssvl.tube_number ORDER BY ssvl.tube_number SEPARATOR ", ") AS tube_number, sl.flag,
        sl.date_created, sl.date_updated, GREATEST(sl.date_created, sl.date_updated) AS latest_date');
        $this->datatables->from('salmonella_liquids AS sl');
        $this->datatables->join('ref_person AS rp', 'sl.id_person = rp.id_person', 'left');
        $this->datatables->join('ref_sampletype AS rs', 'sl.id_sampletype = rs.id_sampletype', 'left');
        $this->datatables->join('salmonella_sample_volumes_liquids AS ssvl', 'sl.id_salmonella_liquids = ssvl.id_salmonella_liquids', 'left');
        // $this->datatables->where('lab', $this->session->userdata('lab'));
        $this->datatables->where('sl.flag', '0');
        // GROUP BY
        $this->datatables->group_by('sl.id_salmonella_liquids');
        $lvl = $this->session->userdata('id_user_level');
        if ($lvl == 4){
            $this->datatables->add_column('action', anchor(site_url('salmonella_liquids/read/$1'),'<i class="fa fa-th-list" aria-hidden="true"></i>', array('class' => 'btn btn-warning btn-sm')), 'id_salmonella_liquids');
        }
        else if ($lvl == 3){
            $this->datatables->add_column('action', anchor(site_url('salmonella_liquids/read/$1'),'<i class="fa fa-th-list" aria-hidden="true"></i>', array('class' => 'btn btn-warning btn-sm')) ."
                ".'<button type="button" class="btn_edit btn btn-info btn-sm" aria-hidden="true"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>', 'id_salmonella_liquids');
        }
        else {
            $this->datatables->add_column('action', anchor(site_url('salmonella_liquids/read/$1'),'<i class="fa fa-th-list" aria-hidden="true"></i>', array('class' => 'btn btn-warning btn-sm')) ."
            ".'<button type="button" class="btn_edit btn btn-info btn-sm" aria-hidden="true"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>'." 
            ".'<button type="button" class="btn_deleteSalmonellaLiquids btn btn-danger btn-sm" data-id="$1" aria-hidden="true"><i class="fa fa-trash-o" aria-hidden="true"></i></button>', 'id_salmonella_liquids');
        }
        $this->db->order_by('latest_date', 'DESC');
        return $this->datatables->generate();
    }

    function subjsonCharcoal($id) {
        $this->datatables->select('srcl.id_result_charcoal, sl.salmonella_assay_barcode, srcl.id_salmonella_liquids, srcl.date_sample_processed, srcl.time_sample_processed,
        GROUP_CONCAT(ssgpl.growth_plate ORDER BY ssgpl.plate_number SEPARATOR ", ") AS growth_plate, GROUP_CONCAT(ssgpl.plate_number ORDER BY ssgpl.plate_number SEPARATOR ", ") AS plate_number, srcl.flag');
        $this->datatables->from('salmonella_result_charcoal_liquids AS srcl');
        $this->datatables->join('salmonella_liquids AS sl', 'srcl.id_salmonella_liquids = sl.id_salmonella_liquids', 'left');
        $this->datatables->join('salmonella_sample_growth_plate_liquids AS ssgpl', 'srcl.id_result_charcoal = ssgpl.id_result_charcoal', 'left');
        $this->datatables->where('srcl.flag', '0');
        $this->datatables->where('srcl.id_salmonella_liquids', $id);
        $this->datatables->group_by('
        srcl.id_result_charcoal, 
        sl.salmonella_assay_barcode, 
        srcl.id_salmonella_liquids, 
        srcl.date_sample_processed, 
        srcl.time_sample_processed,
        srcl.flag
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
        $this->datatables->select('srhl.id_result_hba, sl.salmonella_assay_barcode, srhl.id_salmonella_liquids, srhl.date_sample_processed, srhl.time_sample_processed, 
        GROUP_CONCAT(ssgphl.growth_plate ORDER BY ssgphl.plate_number SEPARATOR ", ") AS growth_plate, GROUP_CONCAT(ssgphl.plate_number ORDER BY ssgphl.plate_number SEPARATOR ", ") AS plate_number, srhl.flag, ssgphl.id_sample_plate_hba');
        $this->datatables->from('salmonella_result_hba_liquids AS srhl');
        $this->datatables->join('salmonella_liquids AS sl', 'srhl.id_salmonella_liquids = sl.id_salmonella_liquids', 'left');
        $this->datatables->join('salmonella_sample_growth_plate_hba_liquids AS ssgphl', 'srhl.id_result_hba = ssgphl.id_result_hba', 'left');
        $this->datatables->where('srhl.flag', '0');
        $this->datatables->where('srhl.id_salmonella_liquids', $id);
        $this->datatables->group_by('
        srhl.id_result_hba, 
        sl.salmonella_assay_barcode, 
        srhl.id_salmonella_liquids, 
        srhl.date_sample_processed, 
        srhl.time_sample_processed,
        srhl.flag
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

        $this->datatables->select('srbl.id_result_biochemical, srbl.id_salmonella_liquids, srbl.id_result_hba, sl.salmonella_assay_barcode, srbl.oxidase, srbl.catalase, srbl.confirmation, srbl.sample_store, srbl.biochemical_tube, srbl.flag');
        $this->datatables->from('salmonella_result_biochemical_liquids AS srbl');
        $this->datatables->join('salmonella_liquids AS sl', 'srbl.id_salmonella_liquids = sl.id_salmonella_liquids', 'left');
        $this->datatables->where('srbl.flag', '0');
        $this->datatables->where('srbl.id_salmonella_liquids', $id);
        
       // Add condition for biochemical_tube if it exists
        if (!empty($biochemical_tube)) {
            $this->datatables->where('srbl.biochemical_tube', $biochemical_tube);
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
        $this->db->from('salmonella_sample_volumes_liquids');
        $this->db->where('id_salmonella_liquids', $id);
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
            $case_statements[] = "MAX(CASE WHEN ssvl1.tube_number = {$tube_number} THEN ssvl1.vol_sampletube END) AS `Tube {$tube_number}`";
        }
        $case_query = implode(', ', $case_statements);

        // Final query
        $this->db->select("sl.id_one_water_sample, sl.id_person, rp.initial, sl.mpn_pcr_conducted, sl.number_of_tubes, sl.salmonella_assay_barcode, sl.date_sample_processed, sl.time_sample_processed, sl.sample_wetweight, sl.elution_volume, rs.sampletype,
                        $case_query,
                        GROUP_CONCAT(DISTINCT srbl.biochemical_tube ORDER BY srbl.biochemical_tube SEPARATOR ', ') AS biochemical_tube, 
                        GROUP_CONCAT(DISTINCT CONCAT(srbl.biochemical_tube, ':', srbl.confirmation) ORDER BY srbl.biochemical_tube SEPARATOR ', ') AS confirmation,
                        GROUP_CONCAT(DISTINCT ssgphl.plate_number ORDER BY ssgphl.plate_number SEPARATOR ', ') AS plate_numbers");
        $this->db->from('salmonella_liquids AS sl');
        $this->db->join('salmonella_result_hba_liquids AS srhl', 'sl.id_salmonella_liquids = srhl.id_salmonella_liquids', 'left');
        $this->db->join('salmonella_sample_growth_plate_hba_liquids AS ssgphl', 'srhl.id_result_hba = ssgphl.id_result_hba', 'left');
        $this->db->join('salmonella_sample_volumes_liquids AS ssvl1', 'srhl.id_salmonella_liquids = ssvl1.id_salmonella_liquids', 'left');
        $this->db->join('salmonella_result_biochemical_liquids AS srbl', 'ssgphl.id_result_hba = srbl.id_result_hba', 'left');
        $this->db->join('ref_sampletype AS rs', 'sl.id_sampletype = rs.id_sampletype', 'left');
        $this->db->join('ref_person AS rp',  'sl.id_person = rp.id_person', 'left');

        // Conditions
        $this->db->where('srbl.flag', '0');
        $this->db->where('srhl.id_salmonella_liquids', $id);
        $this->db->group_by('srhl.id_result_hba');

        $q = $this->db->get();

        if ($q->num_rows() > 0) {
            $response = $q->result(); // Fetch all results if available
            foreach ($response as $key => $value) {
                $confirmations = explode(',', $value->confirmation);
                $biochemical_tubes = explode(',', $value->biochemical_tube);
                $confirmation_array = []; // Inisialisasi array konfirmasi

                // Membuat array asosiasi untuk konfirmasi
                foreach ($biochemical_tubes as $index => $tube) {
                    $confirmation_array[$tube] = explode(':', $confirmations[$index] ?? 'No Growth Plate')[1] ?? 'No Growth Plate'; // Menyediakan default
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
        $this->db->from('salmonella_sample_volumes_liquids');
        $this->db->where('id_salmonella_liquids', $id);
        $this->db->order_by('tube_number', 'ASC'); // Tambahkan pengurutan
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
            $case_statements[] = "MAX(CASE WHEN ssvl1.tube_number = {$tube_number} THEN ssvl1.vol_sampletube END) AS `Tube {$tube_number}`";
        }
        $case_query = implode(', ', $case_statements);
    
        // Final query
        $this->db->select("sl.id_one_water_sample, sl.id_person, rp.initial, sl.mpn_pcr_conducted, sl.number_of_tubes, sl.salmonella_assay_barcode, sl.date_sample_processed, sl.time_sample_processed, sl.sample_wetweight, sl.elution_volume, rs.sampletype,
                           $case_query, 
                           GROUP_CONCAT(DISTINCT srbl.biochemical_tube ORDER BY srbl.biochemical_tube SEPARATOR ', ') AS biochemical_tube, 
                           GROUP_CONCAT(DISTINCT CONCAT(srbl.biochemical_tube, ':', srbl.confirmation) ORDER BY srbl.biochemical_tube SEPARATOR ', ') AS confirmation,
                           GROUP_CONCAT(DISTINCT ssgphl.plate_number ORDER BY ssgphl.plate_number SEPARATOR ', ') AS plate_numbers");
        $this->db->from('salmonella_liquids AS sl');
        $this->db->join('salmonella_result_hba_liquids AS srhl', 'sl.id_salmonella_liquids = srhl.id_salmonella_liquids', 'left');
        $this->db->join('salmonella_sample_growth_plate_hba_liquids AS ssgphl', 'srhl.id_result_hba = ssgphl.id_result_hba', 'left');
        $this->db->join('salmonella_sample_volumes_liquids AS ssvl1', 'srhl.id_salmonella_liquids = ssvl1.id_salmonella_liquids', 'left');
        $this->db->join('salmonella_result_biochemical_liquids AS srbl', 'ssgphl.id_result_hba = srbl.id_result_hba', 'left');
        $this->db->join('ref_sampletype AS rs', 'sl.id_sampletype = rs.id_sampletype', 'left');
        $this->db->join('ref_person AS rp',  'sl.id_person = rp.id_person', 'left');
    
        // Conditions
        $this->db->where('srbl.flag', '0');
        $this->db->where('srhl.id_salmonella_liquids', $id);
        $this->db->group_by('srhl.id_result_hba');
    
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
        $this->db->from('salmonella_sample_volumes_liquids');
        $this->db->where('id_salmonella_liquids IS NOT NULL');
        $this->db->order_by('tube_number', 'ASC'); // Tambahkan pengurutan
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
            $case_statements[] = "MAX(CASE WHEN ssvl1.tube_number = {$tube_number} THEN ssvl1.vol_sampletube END) AS `Tube {$tube_number}`";
        }
        $case_query = implode(', ', $case_statements);
    
        // Final query
        $this->db->select("sl.id_one_water_sample, sl.id_person, rp.initial, sl.mpn_pcr_conducted, sl.number_of_tubes, sl.salmonella_assay_barcode, sl.date_sample_processed, sl.time_sample_processed, sl.sample_wetweight, sl.elution_volume, rs.sampletype,
                           $case_query, 
                           GROUP_CONCAT(DISTINCT srbl.biochemical_tube ORDER BY srbl.biochemical_tube SEPARATOR ', ') AS biochemical_tube, 
                           GROUP_CONCAT(DISTINCT CONCAT(srbl.biochemical_tube, ':', srbl.confirmation) ORDER BY srbl.biochemical_tube SEPARATOR ', ') AS confirmation,
                           GROUP_CONCAT(DISTINCT ssgphl.plate_number ORDER BY ssgphl.plate_number SEPARATOR ', ') AS plate_numbers");
        $this->db->from('salmonella_liquids AS sl');
        $this->db->join('salmonella_result_hba_liquids AS srhl', 'sl.id_salmonella_liquids = srhl.id_salmonella_liquids', 'left');
        $this->db->join('salmonella_sample_growth_plate_hba_liquids AS ssgphl', 'srhl.id_result_hba = ssgphl.id_result_hba', 'left');
        $this->db->join('salmonella_sample_volumes_liquids AS ssvl1', 'srhl.id_salmonella_liquids = ssvl1.id_salmonella_liquids', 'left');
        $this->db->join('salmonella_result_biochemical_liquids AS srbl', 'ssgphl.id_result_hba = srbl.id_result_hba', 'left');
        $this->db->join('ref_sampletype AS rs', 'sl.id_sampletype = rs.id_sampletype', 'left');
        $this->db->join('ref_person AS rp', 'sl.id_person = rp.id_person', 'left');
    
        // Conditions
        $this->db->where('srbl.flag', '0');
        $this->db->where('ssvl1.flag', '0');
        $this->db->group_by('srhl.id_result_hba');
    
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
      $this->db->select('sl.id_salmonella_liquids, sl.id_one_water_sample, sl.id_person, rp.initial, sl.number_of_tubes,
        sl.id_sampletype, rs.sampletype, sl.mpn_pcr_conducted, sl.salmonella_assay_barcode, sl.date_sample_processed,
        sl.time_sample_processed, sl.time_sample_processed, sl.sample_wetweight, sl.elution_volume,
        GROUP_CONCAT(ssvl.vol_sampletube ORDER BY ssvl.tube_number SEPARATOR ", ") AS vol_sampletube, GROUP_CONCAT(ssvl.tube_number ORDER BY ssvl.tube_number SEPARATOR ", ") AS tube_number');
      $this->db->from('salmonella_liquids AS sl');
      $this->db->join('ref_sampletype AS rs', 'sl.id_sampletype = rs.id_sampletype', 'left');
      $this->datatables->join('salmonella_sample_volumes_liquids AS ssvl', 'sl.id_salmonella_liquids = ssvl.id_salmonella_liquids', 'left');
      $this->db->join('ref_person AS rp',  'sl.id_person = rp.id_person', 'left');
      $this->db->where('sl.id_salmonella_liquids', $id);
      $this->db->where('sl.flag', '0');
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
        WHERE id_one_water_sample NOT IN (SELECT id_one_water_sample FROM salmonella_liquids)
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


    function validateSalmonellaAssayBarcode($id){
        $q = $this->db->query('
        SELECT salmonella_assay_barcode FROM salmonella_liquids
        WHERE salmonella_assay_barcode = "'.$id.'"
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
        $this->db->insert('salmonella_liquids', $data);
        return $this->db->insert_id(); // Return the last inserted ID
    }
    
    public function insert_sample_volume($data) {
        $this->db->insert('salmonella_sample_volumes_liquids', $data);
    }
    
    function updateSalmonellaBiosolids($id, $data) {
        $this->db->where('id_salmonella_liquids', $id);
        $this->db->update('salmonella_liquids', $data);
    }

    public function delete_sample_volumes($id_salmonella_liquids) {
        $this->db->where('id_salmonella_liquids', $id_salmonella_liquids);
        $this->db->delete('salmonella_sample_volumes_liquids');
    }

    public function insertResultsCharcoal($data) {
        $this->db->insert('salmonella_result_charcoal_liquids', $data);
        return $this->db->insert_id(); // Return the last inserted ID
    }

    public function insert_growth_plate($data) {
        $this->db->insert('salmonella_sample_growth_plate_liquids', $data);
    }

    function updateResultsCharcoal($id, $data) {
        $this->db->where('id_result_charcoal', $id);
        $this->db->update('salmonella_result_charcoal_liquids', $data);
    }

    public function delete_growth_plates($id_result_charcoal) {
        $this->db->where('id_result_charcoal', $id_result_charcoal);
        $this->db->delete('salmonella_sample_growth_plate_liquids');
    }

    function get_by_id_charcoal($id)
    {
        $this->db->where('id_result_charcoal', $id);
        $this->db->where('flag', '0');
        return $this->db->get('salmonella_result_charcoal_liquids')->row();
    }

    function updateResultsGrowthPlate($id, $data) {
        $this->db->where('id_result_charcoal', $id);
        $this->db->update('salmonella_sample_growth_plate_liquids', $data);
    }

    function get_by_id_salmonella_liquids($id)
    {
        $this->db->where('id_salmonella_liquids', $id);
        $this->db->where('flag', '0');
        return $this->db->get('salmonella_liquids')->row();
    }

    function updateSampleVolume($id, $data) {
        $this->db->where('id_salmonella_liquids', $id);
        $this->db->update('salmonella_sample_volumes_liquids', $data);
    }

    function insertResultsHba($data) {
        $this->db->insert('salmonella_result_hba_liquids', $data);
        return $this->db->insert_id();
    }

    public function insert_growth_plate_hba($data) {
        $this->db->insert('salmonella_sample_growth_plate_hba_liquids', $data);
    }

    function updateResultsHba($id_result_hba, $data) {
        $this->db->where('id_result_hba', $id_result_hba);
        $this->db->update('salmonella_result_hba_liquids', $data);
    }

    public function delete_growth_plates_hba($id_result_hba) {
        $this->db->where('id_result_hba', $id_result_hba);
        $this->db->delete('salmonella_sample_growth_plate_hba_liquids');
    }

    function get_by_id_hba($id)
    {
        $this->db->where('id_result_hba', $id);
        $this->db->where('flag', '0');
        return $this->db->get('salmonella_result_hba_liquids')->row();
    }

    function updateResultsGrowthPlateHba($id, $data) {
        $this->db->where('id_result_hba', $id);
        $this->db->update('salmonella_sample_growth_plate_hba_liquids', $data);
    }

    function insertResultsBiochemical($data) {
        $this->db->insert('salmonella_result_biochemical_liquids', $data);
        return $this->db->insert_id();
    }
    
    function get_by_id_biochemical($id)
    {
        $this->db->where('id_result_biochemical', $id);
        $this->db->where('flag', '0');
        return $this->db->get('salmonella_result_biochemical_liquids')->row();
    }

    function updateResultsBiochemical($id_result_biochemical, $data) {
        $this->db->where('id_result_biochemical', $id_result_biochemical);
        $this->db->update('salmonella_result_biochemical_liquids', $data);
    }
    

      
}

/* End of file Tbl_delivery_model.php */
/* Location: ./application/models/Tbl_delivery_model.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2022-12-14 03:38:42 */
/* http://harviacode.com */