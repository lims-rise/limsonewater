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
        rp.initial, sl.date_sample_processed, sl.time_sample_processed, sl.sample_wetweight, sl.elution_volume, sl.enrichment_media, sl.user_created,
        sl.user_review,
        sl.review,
        user.full_name,
        sl.id_sampletype, rs.sampletype, GROUP_CONCAT(ssvl.vol_sampletube ORDER BY ssvl.tube_number SEPARATOR ", ") AS vol_sampletube, GROUP_CONCAT(ssvl.tube_number ORDER BY ssvl.tube_number SEPARATOR ", ") AS tube_number, sl.flag,
        sl.date_created, sl.date_updated, GREATEST(sl.date_created, sl.date_updated) AS latest_date');
        $this->datatables->from('salmonella_liquids AS sl');
        $this->datatables->join('ref_person AS rp', 'sl.id_person = rp.id_person', 'left');
        $this->datatables->join('ref_sampletype AS rs', 'sl.id_sampletype = rs.id_sampletype', 'left');
        $this->datatables->join('salmonella_sample_volumes_liquids AS ssvl', 'sl.id_salmonella_liquids = ssvl.id_salmonella_liquids', 'left');
        $this->datatables->join('tbl_user user', 'sl.user_review = user.id_users', 'left');
        // $this->datatables->where('lab', $this->session->userdata('lab'));
        $this->datatables->where('sl.flag', '0');
        // GROUP BY
        $this->datatables->group_by('sl.id_salmonella_liquids');
        $lvl = $this->session->userdata('id_user_level');
        if ($lvl == 4){
            $this->datatables->add_column('action', anchor(site_url('salmonella_liquids/read/$1'),'<i class="fa fa-th-list" aria-hidden="true"></i>', array('class' => 'btn btn-warning btn-sm')), 'id_one_water_sample');
        }
        else if ($lvl == 3){
            $this->datatables->add_column('action', anchor(site_url('salmonella_liquids/read/$1'),'<i class="fa fa-th-list" aria-hidden="true"></i>', array('class' => 'btn btn-warning btn-sm')) ."
                ".'<button type="button" class="btn_edit btn btn-info btn-sm" aria-hidden="true"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>', 'id_one_water_sample');
        }
        else {
            $this->datatables->add_column('action', anchor(site_url('salmonella_liquids/read/$1'),'<i class="fa fa-th-list" aria-hidden="true"></i>', array('class' => 'btn btn-warning btn-sm')) ."
            ".'<button type="button" class="btn_edit btn btn-info btn-sm" aria-hidden="true"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>'." 
            ".'<button type="button" class="btn_deleteSalmonellaLiquids btn btn-danger btn-sm" data-id="$1" aria-hidden="true"><i class="fa fa-trash-o" aria-hidden="true"></i></button>', 'id_one_water_sample');
        }
        $this->db->order_by('latest_date', 'DESC');
        return $this->datatables->generate();
    }

    function subjsonXld($id) {
        $this->datatables->select('srxl.id_result_xld, sl.salmonella_assay_barcode, srxl.id_salmonella_liquids, srxl.date_sample_processed, srxl.time_sample_processed,
        GROUP_CONCAT(sspcpl.black_colony_plate ORDER BY sspcpl.plate_number SEPARATOR ", ") AS black_colony_plate, GROUP_CONCAT(sspcpl.plate_number ORDER BY sspcpl.plate_number SEPARATOR ", ") AS plate_number, srxl.flag');
        $this->datatables->from('salmonella_result_xld_liquids AS srxl');
        $this->datatables->join('salmonella_liquids AS sl', 'srxl.id_salmonella_liquids = sl.id_salmonella_liquids', 'left');
        $this->datatables->join('salmonella_sample_black_colony_plate_liquids AS sspcpl', 'srxl.id_result_xld = sspcpl.id_result_xld', 'left');
        $this->datatables->where('srxl.flag', '0');
        $this->datatables->where('srxl.id_salmonella_liquids', $id);
        $this->datatables->group_by('
        srxl.id_result_xld, 
        sl.salmonella_assay_barcode, 
        srxl.id_salmonella_liquids, 
        srxl.date_sample_processed, 
        srxl.time_sample_processed,
        srxl.flag
        ');
        $lvl = $this->session->userdata('id_user_level');
        if ($lvl == 4){
            $this->datatables->add_column('action', '', 'id_result_xld');
        }
        else if ($lvl == 3){
            $this->datatables->add_column('action', '<button type="button" class="btn_edit_detResultsXld btn btn-info btn-sm" aria-hidden="true"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>', 'id_result_xld');
        }
        else {
            $this->datatables->add_column('action', '<button type="button" class="btn_edit_detResultsXld btn btn-info btn-sm" aria-hidden="true"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>'." 
                ".'<button type="button" class="btn_deleteXld btn btn-danger btn-sm" data-id="$1" aria-hidden="true"><i class="fa fa-trash-o" aria-hidden="true"></i></button>', 'id_result_xld');
        }
        return $this->datatables->generate();
    }

    function subjsonChroMagar($id) {
        $this->datatables->select('srcl.id_result_chromagar, sl.salmonella_assay_barcode, srcl.id_salmonella_liquids, srcl.date_sample_processed, srcl.time_sample_processed, 
        GROUP_CONCAT(ssbcpcl.purple_colony_plate ORDER BY ssbcpcl.plate_number SEPARATOR ", ") AS purple_colony_plate, GROUP_CONCAT(ssbcpcl.plate_number ORDER BY ssbcpcl.plate_number SEPARATOR ", ") AS plate_number, srcl.flag, ssbcpcl.id_sample_purple_plate');
        $this->datatables->from('salmonella_result_chromagar_liquids AS srcl');
        $this->datatables->join('salmonella_liquids AS sl', 'srcl.id_salmonella_liquids = sl.id_salmonella_liquids', 'left');
        $this->datatables->join('salmonella_sample_purple_colony_plate_liquids AS ssbcpcl', 'srcl.id_result_chromagar = ssbcpcl.id_result_chromagar', 'left');
        $this->datatables->where('srcl.flag', '0');
        $this->datatables->where('srcl.id_salmonella_liquids', $id);
        $this->datatables->group_by('
        srcl.id_result_chromagar, 
        sl.salmonella_assay_barcode, 
        srcl.id_salmonella_liquids, 
        srcl.date_sample_processed, 
        srcl.time_sample_processed,
        srcl.flag
        ');
        $lvl = $this->session->userdata('id_user_level');
        if ($lvl == 4){
            $this->datatables->add_column('action', '', 'id_result_chromagar');
        }
        else if ($lvl == 3){
            $this->datatables->add_column('action', '<button type="button" class="btn_edit_detResultsChromagar btn btn-info btn-sm" aria-hidden="true"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>', 'id_result_chromagar');
        }
        else {
            $this->datatables->add_column('action', '<button type="button" class="btn_edit_detResultsChromagar btn btn-info btn-sm" aria-hidden="true"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>'." 
                ".'<button type="button" class="btn_deleteChromagar btn btn-danger btn-sm" data-id="$1" aria-hidden="true"><i class="fa fa-trash-o" aria-hidden="true"></i></button>', 'id_result_chromagar');
        }
        return $this->datatables->generate();
    }

    function subjsonBiochemical($id, $biochemical_tube) {

        $this->datatables->select('srbl.id_result_biochemical, srbl.id_salmonella_liquids, srbl.id_result_chromagar, sl.salmonella_assay_barcode, srbl.oxidase, srbl.catalase, srbl.confirmation, srbl.sample_store, srbl.biochemical_tube, srbl.flag');
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
        $this->db->select("sl.id_one_water_sample, sl.id_person, rp.initial, sl.mpn_pcr_conducted, sl.number_of_tubes, 
                        sl.salmonella_assay_barcode, 
                        sl.date_sample_processed, 
                        sl.time_sample_processed, 
                        sl.sample_wetweight, 
                        sl.elution_volume, 
                        rs.sampletype, 
                        sl.enrichment_media,
                        srml.mpn_concentration,
                        srml.upper_ci,
                        srml.lower_ci,
                        $case_query,
                        GROUP_CONCAT(DISTINCT srbl.biochemical_tube ORDER BY srbl.biochemical_tube SEPARATOR ', ') AS biochemical_tube, 
                        GROUP_CONCAT(DISTINCT CONCAT(srbl.biochemical_tube, ':', srbl.confirmation) ORDER BY srbl.biochemical_tube SEPARATOR ', ') AS confirmation,
                        GROUP_CONCAT(DISTINCT ssbcpcl.plate_number ORDER BY ssbcpcl.plate_number SEPARATOR ', ') AS plate_numbers");
        $this->db->from('salmonella_liquids AS sl');
        $this->db->join('salmonella_result_chromagar_liquids AS srcl', 'sl.id_salmonella_liquids = srcl.id_salmonella_liquids', 'left');
        $this->db->join('salmonella_sample_purple_colony_plate_liquids AS ssbcpcl', 'srcl.id_result_chromagar = ssbcpcl.id_result_chromagar', 'left');
        $this->db->join('salmonella_sample_volumes_liquids AS ssvl1', 'srcl.id_salmonella_liquids = ssvl1.id_salmonella_liquids', 'left');
        $this->db->join('salmonella_result_biochemical_liquids AS srbl', 'ssbcpcl.id_result_chromagar = srbl.id_result_chromagar  AND srbl.flag = 0', 'left');
        $this->db->join('salmonella_result_mpn_liquids AS srml', 'sl.id_salmonella_liquids = srml.id_salmonella_liquids', 'left');
        $this->db->join('ref_sampletype AS rs', 'sl.id_sampletype = rs.id_sampletype', 'left');
        $this->db->join('ref_person AS rp',  'sl.id_person = rp.id_person', 'left');

        // Conditions
        // $this->db->where('srbl.flag', '0');
        $this->db->where('srcl.id_salmonella_liquids', $id);
        $this->db->group_by('srcl.id_result_chromagar');

        $q = $this->db->get();

        if ($q->num_rows() > 0) {
            $response = $q->result(); // Fetch all results if available
            foreach ($response as $key => $value) {
                $confirmations = explode(',', $value->confirmation);
                $biochemical_tubes = explode(',', $value->biochemical_tube);
                $confirmation_array = []; // Inisialisasi array konfirmasi

                // Membuat array asosiasi untuk konfirmasi
                foreach ($biochemical_tubes as $index => $tube) {
                    $confirmation_array[$tube] = explode(':', $confirmations[$index] ?? 'No Colony Plate')[1] ?? 'No Colony Plate'; // Menyediakan default
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
        $this->db->select("sl.id_one_water_sample, sl.id_person, rp.initial, sl.mpn_pcr_conducted, sl.number_of_tubes, sl.salmonella_assay_barcode, sl.date_sample_processed, sl.time_sample_processed, sl.sample_wetweight, sl.elution_volume, rs.sampletype, sl.enrichment_media,
                           $case_query, 
                           GROUP_CONCAT(DISTINCT srbl.biochemical_tube ORDER BY srbl.biochemical_tube SEPARATOR ', ') AS biochemical_tube, 
                           GROUP_CONCAT(DISTINCT CONCAT(srbl.biochemical_tube, ':', srbl.confirmation) ORDER BY srbl.biochemical_tube SEPARATOR ', ') AS confirmation,
                           GROUP_CONCAT(DISTINCT ssbcpcl.plate_number ORDER BY ssbcpcl.plate_number SEPARATOR ', ') AS plate_numbers");
        $this->db->from('salmonella_liquids AS sl');
        $this->db->join('salmonella_result_chromagar_liquids AS srcl', 'sl.id_salmonella_liquids = srcl.id_salmonella_liquids', 'left');
        $this->db->join('salmonella_sample_purple_colony_plate_liquids AS ssbcpcl', 'srcl.id_result_chromagar = ssbcpcl.id_result_chromagar', 'left');
        $this->db->join('salmonella_sample_volumes_liquids AS ssvl1', 'srcl.id_salmonella_liquids = ssvl1.id_salmonella_liquids', 'left');
        $this->db->join('salmonella_result_biochemical_liquids AS srbl', 'ssbcpcl.id_result_chromagar = srbl.id_result_chromagar', 'left');
        $this->db->join('ref_sampletype AS rs', 'sl.id_sampletype = rs.id_sampletype', 'left');
        $this->db->join('ref_person AS rp',  'sl.id_person = rp.id_person', 'left');
    
        // Conditions
        $this->db->where('srbl.flag', '0');
        $this->db->where('srcl.id_salmonella_liquids', $id);
        $this->db->group_by('srcl.id_result_chromagar');
    
        $q = $this->db->get();
    
        if ($q->num_rows() > 0) {
            $response = $q->result(); // Fetch all results if available
            foreach ($response as $key => $value) {
                $confirmations = explode(',', $value->confirmation);
                $biochemical_tubes = explode(',', $value->biochemical_tube);
                $plate_numbers = explode(',', $value->plate_numbers);
    
                // Initialize confirmation array for each plate_number
                $confirmation_array = array_fill_keys($plate_numbers, 'No Colony Plate'); // Default to "No Colony Plate"
    
                // Fill in confirmation values from biochemical_tubes
                foreach ($biochemical_tubes as $tube) {
                    $index = array_search($tube, $biochemical_tubes);
                    if ($index !== false) {
                        $confirmation_value = explode(':', $confirmations[$index] ?? 'No Colony Plate')[1] ?? 'No Colony Plate'; // Default if not set
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
        $this->db->select("sl.id_one_water_sample, sl.id_person, rp.initial, sl.mpn_pcr_conducted, sl.number_of_tubes, sl.salmonella_assay_barcode, sl.date_sample_processed, sl.time_sample_processed, sl.sample_wetweight, sl.elution_volume, rs.sampletype, sl.enrichment_media,
                           $case_query, 
                           GROUP_CONCAT(DISTINCT srbl.biochemical_tube ORDER BY srbl.biochemical_tube SEPARATOR ', ') AS biochemical_tube, 
                           GROUP_CONCAT(DISTINCT CONCAT(srbl.biochemical_tube, ':', srbl.confirmation) ORDER BY srbl.biochemical_tube SEPARATOR ', ') AS confirmation,
                           GROUP_CONCAT(DISTINCT ssbcpcl.plate_number ORDER BY ssbcpcl.plate_number SEPARATOR ', ') AS plate_numbers");
        $this->db->from('salmonella_liquids AS sl');
        $this->db->join('salmonella_result_chromagar_liquids AS srcl', 'sl.id_salmonella_liquids = srcl.id_salmonella_liquids', 'left');
        $this->db->join('salmonella_sample_purple_colony_plate_liquids AS ssbcpcl', 'srcl.id_result_chromagar = ssbcpcl.id_result_chromagar', 'left');
        $this->db->join('salmonella_sample_volumes_liquids AS ssvl1', 'srcl.id_salmonella_liquids = ssvl1.id_salmonella_liquids', 'left');
        $this->db->join('salmonella_result_biochemical_liquids AS srbl', 'ssbcpcl.id_result_chromagar = srbl.id_result_chromagar', 'left');
        $this->db->join('ref_sampletype AS rs', 'sl.id_sampletype = rs.id_sampletype', 'left');
        $this->db->join('ref_person AS rp', 'sl.id_person = rp.id_person', 'left');
    
        // Conditions
        $this->db->where('srbl.flag', '0');
        $this->db->where('ssvl1.flag', '0');
        $this->db->group_by('srcl.id_result_chromagar');
    
        $q = $this->db->get();
    
        if ($q->num_rows() > 0) {
            $response = $q->result();
            foreach ($response as $value) {
                // Memproses konfirmasi
                $confirmations = explode(',', $value->confirmation);
                $biochemical_tubes = explode(',', $value->biochemical_tube);
                $plate_numbers = explode(',', $value->plate_numbers);
    
                // Inisialisasi array konfirmasi dengan kunci sesuai dengan jumlah tabung
                $confirmation_array = array_fill_keys($tube_numbers_list, 'No Colony Plate'); // Default ke "No Colony Plate"
    
                // Mengisi nilai konfirmasi berdasarkan indeks tabung
                foreach ($biochemical_tubes as $index => $tube) {
                    $confirmation_value = explode(':', $confirmations[$index] ?? 'No Colony Plate')[1] ?? 'No Colony Plate';
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
        sl.user_review, 
        sl.review, 
        user.full_name,
        sl.user_created, 
        sl.time_sample_processed, sl.time_sample_processed, sl.sample_wetweight, sl.elution_volume, sl.enrichment_media,
        GROUP_CONCAT(ssvl.vol_sampletube ORDER BY ssvl.tube_number SEPARATOR ", ") AS vol_sampletube, GROUP_CONCAT(ssvl.tube_number ORDER BY ssvl.tube_number SEPARATOR ", ") AS tube_number');
      $this->db->from('salmonella_liquids AS sl');
      $this->db->join('ref_sampletype AS rs', 'sl.id_sampletype = rs.id_sampletype', 'left');
      $this->datatables->join('salmonella_sample_volumes_liquids AS ssvl', 'sl.id_salmonella_liquids = ssvl.id_salmonella_liquids', 'left');
      $this->db->join('ref_person AS rp',  'sl.id_person = rp.id_person', 'left');
      $this->db->join('tbl_user user', 'sl.user_review = user.id_users', 'left');
      $this->db->where('sl.id_one_water_sample', $id);
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
        SELECT id_one_water_sample FROM sample_reception_sample
        WHERE id_one_water_sample NOT IN (SELECT id_one_water_sample FROM salmonella_liquids)
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
    
    function updateSalmonellaLiquids($id, $data) {
        $this->db->where('id_salmonella_liquids', $id);
        $this->db->update('salmonella_liquids', $data);
    }

    public function delete_sample_volumes($id_salmonella_liquids) {
        $this->db->where('id_salmonella_liquids', $id_salmonella_liquids);
        $this->db->delete('salmonella_sample_volumes_liquids');
    }

    public function insertResultsXld($data) {
        $this->db->insert('salmonella_result_xld_liquids', $data);
        return $this->db->insert_id(); // Return the last inserted ID
    }

    public function insert_purple_colony_plate($data) {
        $this->db->insert('salmonella_sample_purple_colony_plate_liquids', $data);
    }

    function updateResultsXld($id, $data) {
        $this->db->where('id_result_xld', $id);
        $this->db->update('salmonella_result_xld_liquids', $data);
    }

    public function delete_purple_colony_plates($id_result_chromagar) {
        $this->db->where('id_result_chromagar', $id_result_chromagar);
        $this->db->delete('salmonella_sample_purple_colony_plate_liquids');
    }

    function get_by_id_xld($id)
    {
        $this->db->where('id_result_xld', $id);
        $this->db->where('flag', '0');
        return $this->db->get('salmonella_result_xld_liquids')->row();
    }

    function updateResultsPurpleColonyPlate($id, $data) {
        $this->db->where('id_result_xld', $id);
        $this->db->update('salmonella_sample_purple_colony_plate_liquids', $data);
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

    function insertResultsChroMagar($data) {
        $this->db->insert('salmonella_result_chromagar_liquids', $data);
        return $this->db->insert_id();
    }

    public function insert_black_colony_plate_chromagar($data) {
        $this->db->insert('salmonella_sample_black_colony_plate_liquids', $data);
    }

    function updateResultsChroMagar($id_result_chromagar, $data) {
        $this->db->where('id_result_chromagar', $id_result_chromagar);
        $this->db->update('salmonella_result_chromagar_liquids', $data);
    }

    public function delete_black_colony_plates_chromagar($id_result_xld) {
        $this->db->where('id_result_xld', $id_result_xld);
        $this->db->delete('salmonella_sample_black_colony_plate_liquids');
    }

    function get_by_id_chromagar($id)
    {
        $this->db->where('id_result_chromagar', $id);
        $this->db->where('flag', '0');
        return $this->db->get('salmonella_result_chromagar_liquids')->row();
    }

    function updateResultsBlackColonyPlateChroMagar($id, $data) {
        $this->db->where('id_result_chromagar', $id);
        $this->db->update('salmonella_sample_black_colony_plate_liquids', $data);
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

    function barcode_restrict($id){

        $q = $this->db->query('
        select id_one_water_sample
        from salmonella_liquids
        WHERE id_one_water_sample = "'.$id.'"
        ');        
        $response = $q->result_array();
        return $response;
      } 

    function update_salmonella_liquids($id_one_water_sample, $data)
    {
        $this->db->where('id_one_water_sample', $id_one_water_sample);
        $this->db->update('salmonella_liquids', $data);
    }

    function updateCancel($id, $data)
    {
        $this->db->where('id_one_water_sample', $id);
        $this->db->update('salmonella_liquids', $data);

        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    function get_calculate_mpn_by_salmonella_liquids($id_salmonella_liquids) {
        $this->db->where('id_salmonella_liquids', $id_salmonella_liquids);
        $this->db->where('flag', '0');
        return $this->db->get('salmonella_result_mpn_liquids')->row();
    }

    function insertCalculateMPN($data) {
        $this->db->insert('salmonella_result_mpn_liquids', $data);

        if ($this->db->affected_rows() > 0) {
            return $this->db->insert_id();
        } else {
            // Log the error for debugging
            log_message('error', 'Failed to insert MPN calculation: ' . $this->db->last_query());
            log_message('error', 'Database error: ' . print_r($this->db->error(), true));
            return false;
        }
    }

    function updateCalculateMPN($id_salmonella_result_mpn_liquids, $data) {
        $this->db->where('id_salmonella_result_mpn_liquids', $id_salmonella_result_mpn_liquids);
        $this->db->update('salmonella_result_mpn_liquids', $data);

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

    /**
     * Check if a specific tube already has biochemical data
     */
    function checkTubeExists($id_salmonella_liquids, $biochemical_tube) {
        $this->db->where('id_salmonella_liquids', $id_salmonella_liquids);
        $this->db->where('biochemical_tube', $biochemical_tube);
        $this->db->where('flag', '0');
        $query = $this->db->get('salmonella_result_biochemical_liquids');
        
        return $query->num_rows() > 0;
    }

    /**
     * Check if a specific tube needs update (exists but with different confirmation value)
     */
    function checkTubeNeedsUpdate($id_salmonella_liquids, $biochemical_tube, $expected_confirmation) {
        $this->db->select('confirmation, id_result_biochemical');
        $this->db->where('id_salmonella_liquids', $id_salmonella_liquids);
        $this->db->where('biochemical_tube', $biochemical_tube);
        $this->db->where('flag', '0');
        $query = $this->db->get('salmonella_result_biochemical_liquids');
        
        if ($query->num_rows() > 0) {
            $result = $query->row();
            // Return true if current confirmation is different from expected
            return [
                'exists' => true,
                'needs_update' => $result->confirmation !== $expected_confirmation,
                'current_confirmation' => $result->confirmation,
                'id_result_biochemical' => $result->id_result_biochemical
            ];
        }
        
        return [
            'exists' => false,
            'needs_update' => false,
            'current_confirmation' => null,
            'id_result_biochemical' => null
        ];
    }

    /**
     * Check if any tube has biochemical data for monitoring sync status
     */
    function checkAnyTubeExists($id_salmonella_liquids) {
        $this->db->where('id_salmonella_liquids', $id_salmonella_liquids);
        $this->db->where('flag', '0');
        $query = $this->db->get('salmonella_result_biochemical_liquids');
        
        return $query->num_rows() > 0;
    }
    

      
}

/* End of file Tbl_delivery_model.php */
/* Location: ./application/models/Tbl_delivery_model.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2022-12-14 03:38:42 */
/* http://harviacode.com */