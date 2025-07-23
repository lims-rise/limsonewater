<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Salmonella_biosolids_model extends CI_Model
{

    function __construct()
    {
        parent::__construct();
    }

    // datatables
    function json() {
        $this->datatables->select('sb.id_salmonella_biosolids, sb.id_one_water_sample, sb.id_person, sb.number_of_tubes, sb.mpn_pcr_conducted, sb.salmonella_assay_barcode, 
        rp.initial, sb.date_sample_processed, sb.time_sample_processed, sb.sample_wetweight, sb.elution_volume,sb.enrichment_media, sb.user_created, 
        sb.user_review,
        sb.review,
        user.full_name,
        sb.id_sampletype, rs.sampletype, GROUP_CONCAT(ssv.vol_sampletube ORDER BY ssv.tube_number SEPARATOR ", ") AS vol_sampletube, GROUP_CONCAT(ssv.tube_number ORDER BY ssv.tube_number SEPARATOR ", ") AS tube_number, sb.flag,
        sb.date_created, sb.date_updated, GREATEST(sb.date_created, sb.date_updated) AS latest_date');
        $this->datatables->from('salmonella_biosolids AS sb');
        $this->datatables->join('ref_person AS rp', 'sb.id_person = rp.id_person', 'left');
        $this->datatables->join('ref_sampletype AS rs', 'sb.id_sampletype = rs.id_sampletype', 'left');
        $this->datatables->join('salmonella_sample_volumes AS ssv', 'sb.id_salmonella_biosolids = ssv.id_salmonella_biosolids', 'left');
        $this->datatables->join('tbl_user user', 'sb.user_review = user.id_users', 'left');
        // $this->datatables->where('lab', $this->session->userdata('lab'));
        $this->datatables->where('sb.flag', '0');
        // GROUP BY
        $this->datatables->group_by('sb.id_salmonella_biosolids');
        $lvl = $this->session->userdata('id_user_level');
        if ($lvl == 4){
            $this->datatables->add_column('action', anchor(site_url('salmonella_biosolids/read/$1'),'<i class="fa fa-th-list" aria-hidden="true"></i>', array('class' => 'btn btn-warning btn-sm')), 'id_salmonella_biosolids');
        }
        else if ($lvl == 3){
            $this->datatables->add_column('action', anchor(site_url('salmonella_biosolids/read/$1'),'<i class="fa fa-th-list" aria-hidden="true"></i>', array('class' => 'btn btn-warning btn-sm')) ."
                ".'<button type="button" class="btn_edit btn btn-info btn-sm" aria-hidden="true"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>', 'id_salmonella_biosolids');
        }
        else {
            $this->datatables->add_column('action', anchor(site_url('salmonella_biosolids/read/$1'),'<i class="fa fa-th-list" aria-hidden="true"></i>', array('class' => 'btn btn-warning btn-sm')) ."
            ".'<button type="button" class="btn_edit btn btn-info btn-sm" aria-hidden="true"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>'." 
            ".'<button type="button" class="btn_deleteSalmonellaBiosolids btn btn-danger btn-sm" data-id="$1" aria-hidden="true"><i class="fa fa-trash-o" aria-hidden="true"></i></button>', 'id_salmonella_biosolids');
        }
        $this->db->order_by('latest_date', 'DESC');
        return $this->datatables->generate();
    }

    function subjsonXld($id) {
        $this->datatables->select('srx.id_result_xld, sb.salmonella_assay_barcode, srx.id_salmonella_biosolids, srx.date_sample_processed, srx.time_sample_processed,
        GROUP_CONCAT(sspcl.black_colony_plate ORDER BY sspcl.plate_number SEPARATOR ", ") AS black_colony_plate, GROUP_CONCAT(sspcl.plate_number ORDER BY sspcl.plate_number SEPARATOR ", ") AS plate_number, srx.flag');
        $this->datatables->from('salmonella_result_xld AS srx');
        $this->datatables->join('salmonella_biosolids AS sb', 'srx.id_salmonella_biosolids = sb.id_salmonella_biosolids', 'left');
        $this->datatables->join('salmonella_sample_black_colony_plate AS sspcl', 'srx.id_result_xld = sspcl.id_result_xld', 'left');
        $this->datatables->where('srx.flag', '0');
        $this->datatables->where('srx.id_salmonella_biosolids', $id);
        $this->datatables->group_by('
        srx.id_result_xld, 
        sb.salmonella_assay_barcode, 
        srx.id_salmonella_biosolids, 
        srx.date_sample_processed, 
        srx.time_sample_processed,
        srx.flag
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
        $this->datatables->select('src.id_result_chromagar, sb.salmonella_assay_barcode, src.id_salmonella_biosolids, src.date_sample_processed, src.time_sample_processed, 
        GROUP_CONCAT(ssbcpc.purple_colony_plate ORDER BY ssbcpc.plate_number SEPARATOR ", ") AS purple_colony_plate, GROUP_CONCAT(ssbcpc.plate_number ORDER BY ssbcpc.plate_number SEPARATOR ", ") AS plate_number, src.flag, ssbcpc.id_sample_purple_plate');
        $this->datatables->from('salmonella_result_chromagar AS src');
        $this->datatables->join('salmonella_biosolids AS sb', 'src.id_salmonella_biosolids = sb.id_salmonella_biosolids', 'left');
        $this->datatables->join('salmonella_sample_purple_colony_plate AS ssbcpc', 'src.id_result_chromagar = ssbcpc.id_result_chromagar', 'left');
        $this->datatables->where('src.flag', '0');
        $this->datatables->where('src.id_salmonella_biosolids', $id);
        $this->datatables->group_by('
        src.id_result_chromagar, 
        sb.salmonella_assay_barcode, 
        src.id_salmonella_biosolids, 
        src.date_sample_processed, 
        src.time_sample_processed,
        src.flag
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

        $this->datatables->select('srb.id_result_biochemical, srb.id_salmonella_biosolids, srb.id_result_chromagar, sb.salmonella_assay_barcode, srb.oxidase, srb.catalase, srb.confirmation, srb.sample_store, srb.biochemical_tube, srb.flag');
        $this->datatables->from('salmonella_result_biochemical AS srb');
        $this->datatables->join('salmonella_biosolids AS sb', 'srb.id_salmonella_biosolids = sb.id_salmonella_biosolids', 'left');
        $this->datatables->where('srb.flag', '0');
        $this->datatables->where('srb.id_salmonella_biosolids', $id);
        
       // Add condition for biochemical_tube if it exists
        if (!empty($biochemical_tube)) {
            $this->datatables->where('srb.biochemical_tube', $biochemical_tube);
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
        $this->db->from('salmonella_sample_volumes');
        $this->db->where('id_salmonella_biosolids', $id);
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
            $case_statements[] = "MAX(CASE WHEN ssv1.tube_number = {$tube_number} THEN ssv1.vol_sampletube END) AS `Tube {$tube_number}`";
        }
        $case_query = implode(', ', $case_statements);

        // Final query
        $this->db->select("sb.id_one_water_sample, sb.id_person, rp.initial, sb.mpn_pcr_conducted, sb.number_of_tubes, sb.salmonella_assay_barcode, sb.date_sample_processed, sb.time_sample_processed, sb.sample_wetweight, sb.elution_volume, rs.sampletype, sb.enrichment_media,
                        $case_query,
                        GROUP_CONCAT(DISTINCT srb.biochemical_tube ORDER BY srb.biochemical_tube SEPARATOR ', ') AS biochemical_tube, 
                        GROUP_CONCAT(DISTINCT CONCAT(srb.biochemical_tube, ':', srb.confirmation) ORDER BY srb.biochemical_tube SEPARATOR ', ') AS confirmation,
                        GROUP_CONCAT(DISTINCT ssbcpc.plate_number ORDER BY ssbcpc.plate_number SEPARATOR ', ') AS plate_numbers");
        $this->db->from('salmonella_biosolids AS sb');
        $this->db->join('salmonella_result_chromagar AS src', 'sb.id_salmonella_biosolids = src.id_salmonella_biosolids', 'left');
        $this->db->join('salmonella_sample_purple_colony_plate AS ssbcpc', 'src.id_result_chromagar = ssbcpc.id_result_chromagar', 'left');
        $this->db->join('salmonella_sample_volumes AS ssv1', 'src.id_salmonella_biosolids = ssv1.id_salmonella_biosolids', 'left');
        $this->db->join('salmonella_result_biochemical AS srb', 'ssbcpc.id_result_chromagar = srb.id_result_chromagar', 'left');
        $this->db->join('ref_sampletype AS rs', 'sb.id_sampletype = rs.id_sampletype', 'left');
        $this->db->join('ref_person AS rp',  'sb.id_person = rp.id_person', 'left');

        // Conditions
        $this->db->where('srb.flag', '0');
        $this->db->where('src.id_salmonella_biosolids', $id);
        $this->db->group_by('src.id_result_chromagar');

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
        $this->db->from('salmonella_sample_volumes');
        $this->db->where('id_salmonella_biosolids', $id);
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
            $case_statements[] = "MAX(CASE WHEN ssv1.tube_number = {$tube_number} THEN ssv1.vol_sampletube END) AS `Tube {$tube_number}`";
        }
        $case_query = implode(', ', $case_statements);
    
        // Final query
        $this->db->select("sb.id_one_water_sample, sb.id_person, rp.initial, sb.mpn_pcr_conducted, sb.number_of_tubes, sb.salmonella_assay_barcode, sb.date_sample_processed, sb.time_sample_processed, sb.sample_wetweight, sb.elution_volume, rs.sampletype, sb.enrichment_media,
                           $case_query, 
                           GROUP_CONCAT(DISTINCT srb.biochemical_tube ORDER BY srb.biochemical_tube SEPARATOR ', ') AS biochemical_tube, 
                           GROUP_CONCAT(DISTINCT CONCAT(srb.biochemical_tube, ':', srb.confirmation) ORDER BY srb.biochemical_tube SEPARATOR ', ') AS confirmation,
                           GROUP_CONCAT(DISTINCT ssbcpc.plate_number ORDER BY ssbcpc.plate_number SEPARATOR ', ') AS plate_numbers");
        $this->db->from('salmonella_biosolids AS sb');
        $this->db->join('salmonella_result_chromagar AS src', 'sb.id_salmonella_biosolids = src.id_salmonella_biosolids', 'left');
        $this->db->join('salmonella_sample_purple_colony_plate AS ssbcpc', 'src.id_result_chromagar = ssbcpc.id_result_chromagar', 'left');
        $this->db->join('salmonella_sample_volumes AS ssv1', 'src.id_salmonella_biosolids = ssv1.id_salmonella_biosolids', 'left');
        $this->db->join('salmonella_result_biochemical AS srb', 'ssbcpc.id_result_chromagar = srb.id_result_chromagar', 'left');
        $this->db->join('ref_sampletype AS rs', 'sb.id_sampletype = rs.id_sampletype', 'left');
        $this->db->join('ref_person AS rp',  'sb.id_person = rp.id_person', 'left');
    
        // Conditions
        $this->db->where('srb.flag', '0');
        $this->db->where('src.id_salmonella_biosolids', $id);
        $this->db->group_by('src.id_result_chromagar');
    
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
        $this->db->from('salmonella_sample_volumes');
        $this->db->where('id_salmonella_biosolids IS NOT NULL');
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
            $case_statements[] = "MAX(CASE WHEN ssv1.tube_number = {$tube_number} THEN ssv1.vol_sampletube END) AS `Tube {$tube_number}`";
        }
        $case_query = implode(', ', $case_statements);
    
        // Final query
        $this->db->select("sb.id_one_water_sample, sb.id_person, rp.initial, sb.mpn_pcr_conducted, sb.number_of_tubes, sb.salmonella_assay_barcode, sb.date_sample_processed, sb.time_sample_processed, sb.sample_wetweight, sb.elution_volume, rs.sampletype, sb.enrichment_media,
                           $case_query, 
                           GROUP_CONCAT(DISTINCT srb.biochemical_tube ORDER BY srb.biochemical_tube SEPARATOR ', ') AS biochemical_tube, 
                           GROUP_CONCAT(DISTINCT CONCAT(srb.biochemical_tube, ':', srb.confirmation) ORDER BY srb.biochemical_tube SEPARATOR ', ') AS confirmation,
                           GROUP_CONCAT(DISTINCT ssbcpc.plate_number ORDER BY ssbcpc.plate_number SEPARATOR ', ') AS plate_numbers");
        $this->db->from('salmonella_biosolids AS sb');
        $this->db->join('salmonella_result_chromagar AS src', 'sb.id_salmonella_biosolids = src.id_salmonella_biosolids', 'left');
        $this->db->join('salmonella_sample_purple_colony_plate AS ssbcpc', 'src.id_result_chromagar = ssbcpc.id_result_chromagar', 'left');
        $this->db->join('salmonella_sample_volumes AS ssv1', 'src.id_salmonella_biosolids = ssv1.id_salmonella_biosolids', 'left');
        $this->db->join('salmonella_result_biochemical AS srb', 'ssbcpc.id_result_chromagar = srb.id_result_chromagar', 'left');
        $this->db->join('ref_sampletype AS rs', 'sb.id_sampletype = rs.id_sampletype', 'left');
        $this->db->join('ref_person AS rp', 'sb.id_person = rp.id_person', 'left');
    
        // Conditions
        $this->db->where('srb.flag', '0');
        $this->db->where('ssv1.flag', '0');
        $this->db->group_by('src.id_result_chromagar');
    
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
      $this->db->select('sb.id_salmonella_biosolids, sb.id_one_water_sample, sb.id_person, rp.initial, sb.number_of_tubes,
        sb.id_sampletype, rs.sampletype, sb.mpn_pcr_conducted, sb.salmonella_assay_barcode, sb.date_sample_processed,
        sb.user_review, 
        sb.review, 
        user.full_name,
        sb.user_created, 
        sb.time_sample_processed, sb.time_sample_processed, sb.sample_wetweight, sb.elution_volume, sb.enrichment_media,
        GROUP_CONCAT(ssv.vol_sampletube ORDER BY ssv.tube_number SEPARATOR ", ") AS vol_sampletube, GROUP_CONCAT(ssv.tube_number ORDER BY ssv.tube_number SEPARATOR ", ") AS tube_number');
      $this->db->from('salmonella_biosolids AS sb');
      $this->db->join('ref_sampletype AS rs', 'sb.id_sampletype = rs.id_sampletype', 'left');
      $this->datatables->join('salmonella_sample_volumes AS ssv', 'sb.id_salmonella_biosolids = ssv.id_salmonella_biosolids', 'left');
      $this->db->join('ref_person AS rp',  'sb.id_person = rp.id_person', 'left');
      $this->db->join('tbl_user user', 'sb.user_review = user.id_users', 'left');
      $this->db->where('sb.id_salmonella_biosolids', $id);
      $this->db->where('sb.flag', '0');
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
        WHERE id_one_water_sample NOT IN (SELECT id_one_water_sample FROM salmonella_biosolids)
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
        SELECT salmonella_assay_barcode FROM salmonella_biosolids
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
        $this->db->insert('salmonella_biosolids', $data);
        return $this->db->insert_id(); // Return the last inserted ID
    }
    
    public function insert_sample_volume($data) {
        $this->db->insert('salmonella_sample_volumes', $data);
    }
    
    function updateSalmonellaBiosolids($id, $data) {
        $this->db->where('id_salmonella_biosolids', $id);
        $this->db->update('salmonella_biosolids', $data);
    }

    public function delete_sample_volumes($id_salmonella_biosolids) {
        $this->db->where('id_salmonella_biosolids', $id_salmonella_biosolids);
        $this->db->delete('salmonella_sample_volumes');
    }

    public function insertResultsXld($data) {
        $this->db->insert('salmonella_result_xld', $data);
        return $this->db->insert_id(); // Return the last inserted ID
    }

    public function insert_purple_colony_plate($data) {
        $this->db->insert('salmonella_sample_purple_colony_plate', $data);
    }

    function updateResultsXld($id, $data) {
        $this->db->where('id_result_xld', $id);
        $this->db->update('salmonella_result_xld', $data);
    }

    public function delete_purple_colony_plates($id_result_chromagar) {
        $this->db->where('id_result_chromagar', $id_result_chromagar);
        $this->db->delete('salmonella_sample_purple_colony_plate');
    }

    function get_by_id_xld($id)
    {
        $this->db->where('id_result_xld', $id);
        $this->db->where('flag', '0');
        return $this->db->get('salmonella_result_xld')->row();
    }

    function updateResultsPurpleColonyPlate($id, $data) {
        $this->db->where('id_result_xld', $id);
        $this->db->update('salmonella_sample_purple_colony_plate', $data);
    }

    function get_by_id_salmonella_biosolids($id)
    {
        $this->db->where('id_salmonella_biosolids', $id);
        $this->db->where('flag', '0');
        return $this->db->get('salmonella_biosolids')->row();
    }

    function updateSampleVolume($id, $data) {
        $this->db->where('id_salmonella_biosolids', $id);
        $this->db->update('salmonella_sample_volumes', $data);
    }

    function insertResultsChroMagar($data) {
        $this->db->insert('salmonella_result_chromagar', $data);
        return $this->db->insert_id();
    }

    public function insert_black_colony_plate_chromagar($data) {
        $this->db->insert('salmonella_sample_black_colony_plate', $data);
    }

    function updateResultsChroMagar($id_result_chromagar, $data) {
        $this->db->where('id_result_chromagar', $id_result_chromagar);
        $this->db->update('salmonella_result_chromagar', $data);
    }

    public function delete_black_colony_plates_chromagar($id_result_xld) {
        $this->db->where('id_result_xld', $id_result_xld);
        $this->db->delete('salmonella_sample_black_colony_plate');
    }

    function get_by_id_chromagar($id)
    {
        $this->db->where('id_result_chromagar', $id);
        $this->db->where('flag', '0');
        return $this->db->get('salmonella_result_chromagar')->row();
    }

    function updateResultsBlackColonyPlateChroMagar($id, $data) {
        $this->db->where('id_result_chromagar', $id);
        $this->db->update('salmonella_sample_black_colony_plate', $data);
    }

    function insertResultsBiochemical($data) {
        $this->db->insert('salmonella_result_biochemical', $data);
        return $this->db->insert_id();
    }
    
    function get_by_id_biochemical($id)
    {
        $this->db->where('id_result_biochemical', $id);
        $this->db->where('flag', '0');
        return $this->db->get('salmonella_result_biochemical')->row();
    }

    function updateResultsBiochemical($id_result_biochemical, $data) {
        $this->db->where('id_result_biochemical', $id_result_biochemical);
        $this->db->update('salmonella_result_biochemical', $data);
    }
    
    function barcode_restrict($id){

        $q = $this->db->query('
        select id_one_water_sample
        from salmonella_biosolids
        WHERE id_one_water_sample = "'.$id.'"
        ');        
        $response = $q->result_array();
        return $response;
      }

    function update_salmonella_biosolids($id_one_water_sample, $data)
    {
        $this->db->where('id_one_water_sample', $id_one_water_sample);
        $this->db->update('salmonella_biosolids', $data);
    }

    function updateCancel($id, $data)
    {
        $this->db->where('id_one_water_sample', $id);
        $this->db->update('salmonella_biosolids', $data);

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