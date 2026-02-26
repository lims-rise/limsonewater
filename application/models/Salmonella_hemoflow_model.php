<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Salmonella_hemoflow_model extends CI_Model
{

    function __construct()
    {
        parent::__construct();
    }

    // datatables
    function json() {
        $this->datatables->select('sh.id_salmonella_hemoflow, sh.id_one_water_sample, sh.id_person, sh.number_of_tubes, sh.mpn_pcr_conducted, sh.salmonella_assay_barcode, 
        rp.initial, sh.date_sample_processed, sh.time_sample_processed, sh.sample_wetweight, sh.elution_volume,sh.enrichment_media, sh.user_created, 
        sh.user_review,
        sh.review,
        user.full_name,
        sh.id_sampletype, rs.sampletype, GROUP_CONCAT(shsv.vol_sampletube ORDER BY shsv.tube_number SEPARATOR ", ") AS vol_sampletube, GROUP_CONCAT(shsv.tube_number ORDER BY shsv.tube_number SEPARATOR ", ") AS tube_number, sh.flag,
        sh.date_created, sh.date_updated, GREATEST(sh.date_created, sh.date_updated) AS latest_date');
        $this->datatables->from('salmonella_hemoflow AS sh');
        $this->datatables->join('ref_person AS rp', 'sh.id_person = rp.id_person', 'left');
        $this->datatables->join('ref_sampletype AS rs', 'sh.id_sampletype = rs.id_sampletype', 'left');
        $this->datatables->join('salmonella_hemoflow_sample_volumes AS shsv', 'sh.id_salmonella_hemoflow = shsv.id_salmonella_hemoflow', 'left');
        $this->datatables->join('tbl_user user', 'sh.user_review = user.id_users', 'left');
        // $this->datatables->where('lab', $this->session->userdata('lab'));
        $this->datatables->where('sh.flag', '0');
        // GROUP BY
        $this->datatables->group_by('sh.id_salmonella_hemoflow');
        $lvl = $this->session->userdata('id_user_level');
        if ($lvl == 4){
            $this->datatables->add_column('action', anchor(site_url('salmonella_hemoflow/read/$1'),'<i class="fa fa-th-list" aria-hidden="true"></i>', array('class' => 'btn btn-warning btn-sm')), 'id_one_water_sample');
        }
        else if ($lvl == 3){
            $this->datatables->add_column('action', anchor(site_url('salmonella_hemoflow/read/$1'),'<i class="fa fa-th-list" aria-hidden="true"></i>', array('class' => 'btn btn-warning btn-sm')) ."
                ".'<button type="button" class="btn_edit btn btn-info btn-sm" aria-hidden="true"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>', 'id_one_water_sample');
        }
        else {
            $this->datatables->add_column('action', anchor(site_url('salmonella_hemoflow/read/$1'),'<i class="fa fa-th-list" aria-hidden="true"></i>', array('class' => 'btn btn-warning btn-sm')) ."
            ".'<button type="button" class="btn_edit btn btn-info btn-sm" aria-hidden="true"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>'." 
            ".'<button type="button" class="btn_deleteSalmonellaHemoflow btn btn-danger btn-sm" data-id="$1" aria-hidden="true"><i class="fa fa-trash-o" aria-hidden="true"></i></button>', 'id_one_water_sample');
        }
        $this->db->order_by('latest_date', 'DESC');
        return $this->datatables->generate();
    }

    function subjsonXld($id) {
        $this->datatables->select('shrx.id_salmonella_hemoflow_result_xld, sh.salmonella_assay_barcode, shrx.id_salmonella_hemoflow, shrx.date_sample_processed, shrx.time_sample_processed, shrx.quality_control,
        GROUP_CONCAT(shsbcp.black_colony_plate ORDER BY shsbcp.plate_number SEPARATOR ", ") AS black_colony_plate, GROUP_CONCAT(shsbcp.plate_number ORDER BY shsbcp.plate_number SEPARATOR ", ") AS plate_number, shrx.flag');
        $this->datatables->from('salmonella_hemoflow_result_xld AS shrx');
        $this->datatables->join('salmonella_hemoflow AS sh', 'shrx.id_salmonella_hemoflow = sh.id_salmonella_hemoflow', 'left');
        $this->datatables->join('salmonella_hemoflow_sample_black_colony_plate AS shsbcp', 'shrx.id_salmonella_hemoflow_result_xld = shsbcp.id_salmonella_hemoflow_result_xld', 'left');
        $this->datatables->where('shrx.flag', '0');
        $this->datatables->where('shrx.id_salmonella_hemoflow', $id);
        $this->datatables->group_by('
        shrx.id_salmonella_hemoflow_result_xld, 
        sh.salmonella_assay_barcode, 
        shrx.id_salmonella_hemoflow, 
        shrx.date_sample_processed, 
        shrx.time_sample_processed,
        shrx.flag
        ');
        $lvl = $this->session->userdata('id_user_level');
        if ($lvl == 4){
            $this->datatables->add_column('action', '', 'id_salmonella_hemoflow_result_xld');
        }
        else if ($lvl == 3){
            $this->datatables->add_column('action', '<button type="button" class="btn_edit_detResultsXld btn btn-info btn-sm" aria-hidden="true"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>', 'id_salmonella_hemoflow_result_xld');
        }
        else {
            $this->datatables->add_column('action', '<button type="button" class="btn_edit_detResultsXld btn btn-info btn-sm" aria-hidden="true"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>'." 
                ".'<button type="button" class="btn_deleteXld btn btn-danger btn-sm" data-id="$1" aria-hidden="true"><i class="fa fa-trash-o" aria-hidden="true"></i></button>', 'id_salmonella_hemoflow_result_xld');
        }
        return $this->datatables->generate();
    }

    function subjsonChroMagar($id) {
        $this->datatables->select('shrc.id_salmonella_hemoflow_result_chromagar, sh.salmonella_assay_barcode, shrc.id_salmonella_hemoflow, shrc.date_sample_processed, shrc.time_sample_processed, shrc.quality_control,
        GROUP_CONCAT(shspcp.purple_colony_plate ORDER BY shspcp.plate_number SEPARATOR ", ") AS purple_colony_plate, GROUP_CONCAT(shspcp.plate_number ORDER BY shspcp.plate_number SEPARATOR ", ") AS plate_number, shrc.flag, shspcp.id_salmonella_hemoflow_sample_purple_plate');
        $this->datatables->from('salmonella_hemoflow_result_chromagar AS shrc');
        $this->datatables->join('salmonella_hemoflow AS sh', 'shrc.id_salmonella_hemoflow = sh.id_salmonella_hemoflow', 'left');
        $this->datatables->join('salmonella_hemoflow_sample_purple_colony_plate AS shspcp', 'shrc.id_salmonella_hemoflow_result_chromagar = shspcp.id_salmonella_hemoflow_result_chromagar', 'left');
        $this->datatables->where('shrc.flag', '0');
        $this->datatables->where('shrc.id_salmonella_hemoflow', $id);
        $this->datatables->group_by('
        shrc.id_salmonella_hemoflow_result_chromagar, 
        sh.salmonella_assay_barcode, 
        shrc.id_salmonella_hemoflow, 
        shrc.date_sample_processed, 
        shrc.time_sample_processed,
        shrc.flag
        ');
        $lvl = $this->session->userdata('id_user_level');
        if ($lvl == 4){
            $this->datatables->add_column('action', '', 'id_salmonella_hemoflow_result_chromagar');
        }
        else if ($lvl == 3){
            $this->datatables->add_column('action', '<button type="button" class="btn_edit_detResultsChromagar btn btn-info btn-sm" aria-hidden="true"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>', 'id_salmonella_hemoflow_result_chromagar');
        }
        else {
            $this->datatables->add_column('action', '<button type="button" class="btn_edit_detResultsChromagar btn btn-info btn-sm" aria-hidden="true"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>'." 
                ".'<button type="button" class="btn_deleteChromagar btn btn-danger btn-sm" data-id="$1" aria-hidden="true"><i class="fa fa-trash-o" aria-hidden="true"></i></button>', 'id_salmonella_hemoflow_result_chromagar');
        }
        return $this->datatables->generate();
    }

    function subjsonBiochemical($id, $biochemical_tube) {

        $this->datatables->select('shrb.id_salmonella_hemoflow_result_biochemical, shrb.id_salmonella_hemoflow, shrb.id_salmonella_hemoflow_result_chromagar, sh.salmonella_assay_barcode, shrb.oxidase, shrb.catalase, shrb.confirmation, shrb.sample_store, shrb.biochemical_tube, shrb.flag');
        $this->datatables->from('salmonella_hemoflow_result_biochemical AS shrb');
        $this->datatables->join('salmonella_hemoflow AS sh', 'shrb.id_salmonella_hemoflow = sh.id_salmonella_hemoflow', 'left');
        $this->datatables->where('shrb.flag', '0');
        $this->datatables->where('shrb.id_salmonella_hemoflow', $id);

       // Add condition for biochemical_tube if it exists
        if (!empty($biochemical_tube)) {
            $this->datatables->where('shrb.biochemical_tube', $biochemical_tube);
        }
    
        $lvl = $this->session->userdata('id_user_level');
        if ($lvl == 4){
            $this->datatables->add_column('action', '', 'id_salmonella_hemoflow_result_biochemical');
        } else if ($lvl == 3){
            $this->datatables->add_column('action', '<button type="button" class="btn_edit_detResultsBiochemical btn btn-info btn-sm" aria-hidden="true"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>', 'id_salmonella_hemoflow_result_biochemical');
        } else {
            $this->datatables->add_column('action', '<button type="button" class="btn_edit_detResultsBiochemical btn btn-info btn-sm" aria-hidden="true"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>'." 
                ".'<button type="button" class="btn_deleteBiochemical btn btn-danger btn-sm" data-id="$1" aria-hidden="true"><i class="fa fa-trash-o" aria-hidden="true"></i></button>', 'id_salmonella_hemoflow_result_biochemical');
        }
        return $this->datatables->generate();
    }

    function subjsonFinalCalculation($id)
    {
        $response = array();

        // Step 1: Get unique tube_number
        $this->db->select('tube_number');
        $this->db->distinct();
        $this->db->from('salmonella_hemoflow_sample_volumes');
        $this->db->where('id_salmonella_hemoflow', $id);
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
            $case_statements[] = "MAX(CASE WHEN shsv1.tube_number = {$tube_number} THEN shsv1.vol_sampletube END) AS `Tube {$tube_number}`";
        }
        $case_query = implode(', ', $case_statements);

        // Final query
        $this->db->select("sh.id_one_water_sample, sh.id_person, rp.initial, sh.mpn_pcr_conducted, 
                        sh.number_of_tubes, 
                        sh.salmonella_assay_barcode, 
                        sh.date_sample_processed, 
                        sh.time_sample_processed, 
                        sh.sample_wetweight, 
                        sh.elution_volume, 
                        rs.sampletype, 
                        sh.enrichment_media,
                        hm.volume_filter,
                        hm.volume_eluted,
                        shrm.mpn_concentration,
                        shrm.upper_ci,
                        shrm.lower_ci,
                        CASE 
                            WHEN shrm.mpn_concentration IS NOT NULL AND hm.volume_eluted IS NOT NULL THEN
                                CASE 
                                    WHEN shrm.mpn_concentration LIKE '>%' THEN CONCAT('>', ROUND((CAST(SUBSTRING(shrm.mpn_concentration, 2) AS DECIMAL(10,2)) / 1000) * hm.volume_eluted, 2))
                                    WHEN shrm.mpn_concentration LIKE '<%' THEN CONCAT('<', ROUND((CAST(SUBSTRING(shrm.mpn_concentration, 2) AS DECIMAL(10,2)) / 1000) * hm.volume_eluted, 2))
                                    ELSE ROUND((CAST(shrm.mpn_concentration AS DECIMAL(10,2)) / 1000) * hm.volume_eluted, 2)
                                END
                            ELSE NULL 
                        END as total_salmonella,
                        CASE 
                            WHEN shrm.mpn_concentration IS NOT NULL AND hm.volume_eluted IS NOT NULL AND hm.volume_filter IS NOT NULL AND hm.volume_filter > 0 THEN
                                CASE 
                                    WHEN shrm.mpn_concentration LIKE '>%' THEN CONCAT('>', ROUND(((CAST(SUBSTRING(shrm.mpn_concentration, 2) AS DECIMAL(10,2)) / 1000) * hm.volume_eluted / hm.volume_filter), 2))
                                    WHEN shrm.mpn_concentration LIKE '<%' THEN CONCAT('<', ROUND(((CAST(SUBSTRING(shrm.mpn_concentration, 2) AS DECIMAL(10,2)) / 1000) * hm.volume_eluted / hm.volume_filter), 2))
                                    ELSE ROUND(((CAST(shrm.mpn_concentration AS DECIMAL(10,2)) / 1000) * hm.volume_eluted / hm.volume_filter), 2)
                                END
                            ELSE NULL 
                        END as concentration_mpn_l,
                        CASE 
                            WHEN shrm.upper_ci IS NOT NULL AND hm.volume_eluted IS NOT NULL AND hm.volume_filter IS NOT NULL AND hm.volume_filter > 0 THEN
                                CASE 
                                    WHEN shrm.upper_ci LIKE '>%' THEN CONCAT('>', ROUND((CAST(SUBSTRING(shrm.upper_ci, 2) AS DECIMAL(10,2)) / 1000) * hm.volume_eluted / hm.volume_filter, 2))
                                    WHEN shrm.upper_ci LIKE '<%' THEN CONCAT('<', ROUND((CAST(SUBSTRING(shrm.upper_ci, 2) AS DECIMAL(10,2)) / 1000) * hm.volume_eluted / hm.volume_filter, 2))
                                    ELSE ROUND((CAST(shrm.upper_ci AS DECIMAL(10,2)) / 1000) * hm.volume_eluted / hm.volume_filter, 2)
                                END
                            ELSE NULL 
                        END as concentration_upper_ci,
                        CASE 
                            WHEN shrm.lower_ci IS NOT NULL AND hm.volume_eluted IS NOT NULL AND hm.volume_filter IS NOT NULL AND hm.volume_filter > 0 THEN
                                CASE 
                                    WHEN shrm.lower_ci LIKE '>%' THEN CONCAT('>', ROUND((CAST(SUBSTRING(shrm.lower_ci, 2) AS DECIMAL(10,2)) / 1000) * hm.volume_eluted / hm.volume_filter, 2))
                                    WHEN shrm.lower_ci LIKE '<%' THEN CONCAT('<', ROUND((CAST(SUBSTRING(shrm.lower_ci, 2) AS DECIMAL(10,2)) / 1000) * hm.volume_eluted / hm.volume_filter, 2))
                                    ELSE ROUND((CAST(shrm.lower_ci AS DECIMAL(10,2)) / 1000) * hm.volume_eluted / hm.volume_filter, 2)
                                END
                            ELSE NULL 
                        END as concentration_lower_ci,
                        $case_query,
                        GROUP_CONCAT(DISTINCT shrb.biochemical_tube ORDER BY shrb.biochemical_tube SEPARATOR ', ') AS biochemical_tube, 
                        GROUP_CONCAT(DISTINCT CONCAT(shrb.biochemical_tube, ':', shrb.confirmation) ORDER BY shrb.biochemical_tube SEPARATOR ', ') AS confirmation,
                        GROUP_CONCAT(DISTINCT shspcp.plate_number ORDER BY shspcp.plate_number SEPARATOR ', ') AS plate_numbers");
        $this->db->from('salmonella_hemoflow AS sh');
        $this->db->join('hemoflow AS hm', 'sh.id_one_water_sample = hm.id_one_water_sample AND hm.flag = "0"', 'left');
        $this->db->join('salmonella_hemoflow_result_chromagar AS shrc', 'sh.id_salmonella_hemoflow = shrc.id_salmonella_hemoflow', 'left');
        $this->db->join('salmonella_hemoflow_sample_purple_colony_plate AS shspcp', 'shrc.id_salmonella_hemoflow_result_chromagar = shspcp.id_salmonella_hemoflow_result_chromagar', 'left');
        $this->db->join('salmonella_hemoflow_sample_volumes AS shsv1', 'shrc.id_salmonella_hemoflow = shsv1.id_salmonella_hemoflow', 'left');
        $this->db->join('salmonella_hemoflow_result_biochemical AS shrb', 'shspcp.id_salmonella_hemoflow_result_chromagar = shrb.id_salmonella_hemoflow_result_chromagar AND shrb.flag = 0', 'left');
        $this->db->join('salmonella_hemoflow_result_mpn AS shrm', 'sh.id_salmonella_hemoflow = shrm.id_salmonella_hemoflow', 'left');
        $this->db->join('ref_sampletype AS rs', 'sh.id_sampletype = rs.id_sampletype', 'left');
        $this->db->join('ref_person AS rp',  'sh.id_person = rp.id_person', 'left');

        // Conditions
        $this->db->where('shrc.flag', '0');
        $this->db->where('shrc.id_salmonella_hemoflow', $id);
        $this->db->group_by('shrc.id_salmonella_hemoflow_result_chromagar');

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
        $this->db->from('salmonella_hemoflow_sample_volumes');
        $this->db->where('id_salmonella_hemoflow', $id);
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
            $case_statements[] = "MAX(CASE WHEN shsv1.tube_number = {$tube_number} THEN shsv1.vol_sampletube END) AS `Tube {$tube_number}`";
        }
        $case_query = implode(', ', $case_statements);
    
        // Final query
        $this->db->select("sh.id_one_water_sample, sh.id_person, rp.initial, sh.mpn_pcr_conducted, sh.number_of_tubes, sh.salmonella_assay_barcode, sh.date_sample_processed, sh.time_sample_processed, sh.sample_wetweight, sh.elution_volume, rs.sampletype, sh.enrichment_media,
                           $case_query, 
                           GROUP_CONCAT(DISTINCT shrb.biochemical_tube ORDER BY shrb.biochemical_tube SEPARATOR ', ') AS biochemical_tube, 
                           GROUP_CONCAT(DISTINCT CONCAT(shrb.biochemical_tube, ':', shrb.confirmation) ORDER BY shrb.biochemical_tube SEPARATOR ', ') AS confirmation,
                           GROUP_CONCAT(DISTINCT shspcp.plate_number ORDER BY shspcp.plate_number SEPARATOR ', ') AS plate_numbers");
        $this->db->from('salmonella_hemoflow AS sh');
        $this->db->join('salmonella_hemoflow_result_chromagar AS shrc', 'sh.id_salmonella_hemoflow = shrc.id_salmonella_hemoflow', 'left');
        $this->db->join('salmonella_hemoflow_sample_purple_colony_plate AS shspcp', 'shrc.id_salmonella_hemoflow_result_chromagar = shspcp.id_salmonella_hemoflow_result_chromagar', 'left');
        $this->db->join('salmonella_hemoflow_sample_volumes AS shsv1', 'shrc.id_salmonella_hemoflow = shsv1.id_salmonella_hemoflow', 'left');
        $this->db->join('salmonella_hemoflow_result_biochemical AS shrb', 'shspcp.id_salmonella_hemoflow_result_chromagar = shrb.id_salmonella_hemoflow_result_chromagar', 'left');
        $this->db->join('ref_sampletype AS rs', 'sh.id_sampletype = rs.id_sampletype', 'left');
        $this->db->join('ref_person AS rp', 'sh.id_person = rp.id_person', 'left');
    
        // Conditions
        $this->db->where('shrb.flag', '0');
        $this->db->where('shrc.id_salmonella_hemoflow', $id);
        $this->db->group_by('shrc.id_salmonella_hemoflow_result_chromagar');

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
        $this->db->from('salmonella_hemoflow_sample_volumes');
        $this->db->where('id_salmonella_hemoflow IS NOT NULL');
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
            $case_statements[] = "MAX(CASE WHEN shsv1.tube_number = {$tube_number} THEN shsv1.vol_sampletube END) AS `Tube {$tube_number}`";
        }
        $case_query = implode(', ', $case_statements);
    
        // Final query
        $this->db->select("sh.id_one_water_sample, sh.id_person, rp.initial, sh.mpn_pcr_conducted, sh.number_of_tubes, sh.salmonella_assay_barcode, sh.date_sample_processed, sh.time_sample_processed, sh.sample_wetweight, sh.elution_volume, rs.sampletype, sh.enrichment_media,
                           $case_query, 
                           GROUP_CONCAT(DISTINCT shrb.biochemical_tube ORDER BY shrb.biochemical_tube SEPARATOR ', ') AS biochemical_tube, 
                           GROUP_CONCAT(DISTINCT CONCAT(shrb.biochemical_tube, ':', shrb.confirmation) ORDER BY shrb.biochemical_tube SEPARATOR ', ') AS confirmation,
                           GROUP_CONCAT(DISTINCT shspcp.plate_number ORDER BY shspcp.plate_number SEPARATOR ', ') AS plate_numbers");
        $this->db->from('salmonella_hemoflow AS sh');
        $this->db->join('salmonella_hemoflow_result_chromagar AS shrc', 'sh.id_salmonella_hemoflow = shrc.id_salmonella_hemoflow', 'left');
        $this->db->join('salmonella_hemoflow_sample_purple_colony_plate AS shspcp', 'shrc.id_salmonella_hemoflow_result_chromagar = shspcp.id_salmonella_hemoflow_result_chromagar', 'left');
        $this->db->join('salmonella_hemoflow_sample_volumes AS shsv1', 'shrc.id_salmonella_hemoflow = shsv1.id_salmonella_hemoflow', 'left');
        $this->db->join('salmonella_hemoflow_result_biochemical AS shrb', 'shspcp.id_salmonella_hemoflow_result_chromagar = shrb.id_salmonella_hemoflow_result_chromagar', 'left');
        $this->db->join('ref_sampletype AS rs', 'sh.id_sampletype = rs.id_sampletype', 'left');
        $this->db->join('ref_person AS rp', 'sh.id_person = rp.id_person', 'left');
    
        // Conditions
        $this->db->where('shrb.flag', '0');
        $this->db->where('shsv1.flag', '0');
        $this->db->group_by('shrc.id_salmonella_hemoflow_result_chromagar');
    
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
      $this->db->select('sh.id_salmonella_hemoflow, sh.id_one_water_sample, sh.id_person, rp.initial, sh.number_of_tubes,
        sh.id_sampletype, rs.sampletype, sh.mpn_pcr_conducted, sh.salmonella_assay_barcode, sh.date_sample_processed,
        sh.user_review, 
        sh.review, 
        user.full_name,
        sh.user_created, 
        sh.time_sample_processed, sh.sample_wetweight, sh.elution_volume, sh.enrichment_media,
        GROUP_CONCAT(shsv.vol_sampletube ORDER BY shsv.tube_number SEPARATOR ", ") AS vol_sampletube, GROUP_CONCAT(shsv.tube_number ORDER BY shsv.tube_number SEPARATOR ", ") AS tube_number');
      $this->db->from('salmonella_hemoflow AS sh');
      $this->db->join('ref_sampletype AS rs', 'sh.id_sampletype = rs.id_sampletype', 'left');
      $this->datatables->join('salmonella_hemoflow_sample_volumes AS shsv', 'sh.id_salmonella_hemoflow = shsv.id_salmonella_hemoflow', 'left');
      $this->db->join('ref_person AS rp',  'sh.id_person = rp.id_person', 'left');
      $this->db->join('tbl_user user', 'sh.user_review = user.id_users', 'left');
      $this->db->where('sh.id_one_water_sample', $id);
      $this->db->where('sh.flag', '0');
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
        WHERE id_one_water_sample NOT IN (SELECT id_one_water_sample FROM salmonella_hemoflow)
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
        SELECT salmonella_assay_barcode FROM salmonella_hemoflow
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
        $this->db->insert('salmonella_hemoflow', $data);
        return $this->db->insert_id(); // Return the last inserted ID
    }
    
    public function insert_sample_volume($data) {
        $this->db->insert('salmonella_hemoflow_sample_volumes', $data);
    }
    
    function updateSalmonellaHemoflow($id, $data) {
        $this->db->where('id_one_water_sample', $id);
        $this->db->where('flag', '0');
        $this->db->update('salmonella_hemoflow', $data);
    }

    public function delete_sample_volumes($id_salmonella_hemoflow) {
        $this->db->where('id_salmonella_hemoflow', $id_salmonella_hemoflow);
        $this->db->delete('salmonella_hemoflow_sample_volumes');
    }

    public function insertResultsXld($data) {
        $this->db->insert('salmonella_hemoflow_result_xld', $data);
        return $this->db->insert_id(); // Return the last inserted ID
    }

    public function insert_purple_colony_plate($data) {
        $this->db->insert('salmonella_hemoflow_sample_purple_colony_plate', $data);
    }

    function updateResultsXld($id, $data) {
        $this->db->where('id_salmonella_hemoflow_result_xld', $id);
        $this->db->update('salmonella_hemoflow_result_xld', $data);
    }

    public function delete_purple_colony_plates($id_salmonella_hemoflow_result_chromagar) {
        $this->db->where('id_salmonella_hemoflow_result_chromagar', $id_salmonella_hemoflow_result_chromagar);
        $this->db->delete('salmonella_hemoflow_sample_purple_colony_plate');
    }

    function get_by_id_xld($id)
    {
        $this->db->where('id_salmonella_hemoflow_result_xld', $id);
        $this->db->where('flag', '0');
        return $this->db->get('salmonella_hemoflow_result_xld')->row();
    }

    function updateResultsPurpleColonyPlate($id, $data) {
        $this->db->where('id_salmonella_hemoflow_result_xld', $id);
        $this->db->update('salmonella_hemoflow_sample_purple_colony_plate', $data);
    }

    function get_by_id_salmonella_hemoflow($id)
    {
        $this->db->where('id_one_water_sample', $id);
        $this->db->where('flag', '0');
        return $this->db->get('salmonella_hemoflow')->row();
    }

    function updateSampleVolume($id, $data) {
        $this->db->where('id_salmonella_hemoflow', $id);
        $this->db->where('flag', '0');
        $this->db->update('salmonella_hemoflow_sample_volumes', $data);
    }

    function insertResultsChroMagar($data) {
        $this->db->insert('salmonella_hemoflow_result_chromagar', $data);
        return $this->db->insert_id();
    }

    public function insert_black_colony_plate_chromagar($data) {
        $this->db->insert('salmonella_hemoflow_sample_black_colony_plate', $data);
    }

    function updateResultsChroMagar($id_salmonella_hemoflow_result_chromagar, $data) {
        $this->db->where('id_salmonella_hemoflow_result_chromagar', $id_salmonella_hemoflow_result_chromagar);
        $this->db->update('salmonella_hemoflow_result_chromagar', $data);
    }

    public function delete_black_colony_plates_chromagar($id_salmonella_hemoflow_result_xld) {
        $this->db->where('id_salmonella_hemoflow_result_xld', $id_salmonella_hemoflow_result_xld);
        $this->db->delete('salmonella_hemoflow_sample_black_colony_plate');
    }

    function get_by_id_chromagar($id)
    {
        $this->db->where('id_salmonella_hemoflow_result_chromagar', $id);
        $this->db->where('flag', '0');
        return $this->db->get('salmonella_hemoflow_result_chromagar')->row();
    }

    function updateResultsBlackColonyPlateChroMagar($id, $data) {
        $this->db->where('id_salmonella_hemoflow_result_chromagar', $id);
        $this->db->update('salmonella_hemoflow_sample_black_colony_plate', $data);
    }

    function insertResultsBiochemical($data) {
        $this->db->insert('salmonella_hemoflow_result_biochemical', $data);
        return $this->db->insert_id();
    }
    
    function get_by_id_biochemical($id)
    {
        $this->db->where('id_salmonella_hemoflow_result_biochemical', $id);
        $this->db->where('flag', '0');
        return $this->db->get('salmonella_hemoflow_result_biochemical')->row();
    }

    function updateResultsBiochemical($id_salmonella_hemoflow_result_biochemical, $data) {
        $this->db->where('id_salmonella_hemoflow_result_biochemical', $id_salmonella_hemoflow_result_biochemical);
        $this->db->update('salmonella_hemoflow_result_biochemical', $data);
    }
    
    function barcode_restrict($id){

        $q = $this->db->query('
        select id_one_water_sample
        from salmonella_hemoflow
        WHERE id_one_water_sample = "'.$id.'" and flag = 0
        ');        
        $response = $q->result_array();
        return $response;
      }

    function update_salmonella_hemoflow($id_one_water_sample, $data)
    {
        $this->db->where('id_one_water_sample', $id_one_water_sample);
        $this->db->update('salmonella_hemoflow', $data);
    }

    function updateCancel($id, $data)
    {
        $this->db->where('id_one_water_sample', $id);
        $this->db->update('salmonella_hemoflow', $data);

        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

        function get_calculate_mpn_by_salmonella_hemoflow($id_salmonella_hemoflow) {
        $this->db->where('id_salmonella_hemoflow', $id_salmonella_hemoflow);
        $this->db->where('flag', '0');
        return $this->db->get('salmonella_hemoflow_result_mpn')->row();
    }

    function insertCalculateMPN($data) {
        $this->db->insert('salmonella_hemoflow_result_mpn', $data);

        if ($this->db->affected_rows() > 0) {
            return $this->db->insert_id();
        } else {
            // Log the error for debugging
            log_message('error', 'Failed to insert MPN calculation: ' . $this->db->last_query());
            log_message('error', 'Database error: ' . print_r($this->db->error(), true));
            return false;
        }
    }

    function updateCalculateMPN($id_salmonella_hemoflow_result_mpn, $data) {
        $this->db->where('id_salmonella_hemoflow_result_mpn', $id_salmonella_hemoflow_result_mpn);
        $this->db->update('salmonella_hemoflow_result_mpn', $data);

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

    // CASCADE DELETE METHODS
    
    function get_chromagar_by_salmonella_hemoflow($id_salmonella_hemoflow) {
        $this->db->where('id_salmonella_hemoflow', $id_salmonella_hemoflow);
        $this->db->where('flag', '0');
        return $this->db->get('salmonella_hemoflow_result_chromagar')->result();
    }

    function updateResultsPurplePlate($id_salmonella_hemoflow_result_chromagar, $data) {
        $this->db->where('id_salmonella_hemoflow_result_chromagar', $id_salmonella_hemoflow_result_chromagar);
        $this->db->update('salmonella_hemoflow_sample_purple_colony_plate', $data);
        return $this->db->affected_rows();
    }

    function updateResultsBiochemicalByChromagar($id_salmonella_hemoflow_result_chromagar, $data) {
        $this->db->where('id_salmonella_hemoflow_result_chromagar', $id_salmonella_hemoflow_result_chromagar);
        $this->db->update('salmonella_hemoflow_result_biochemical', $data);
        return $this->db->affected_rows();
    }

    // Method untuk update black colony plates XLD berdasarkan XLD result ID
    function updateResultsBlackColonyPlateXLD($id_salmonella_hemoflow_result_xld, $data) {
        $this->db->where('id_salmonella_hemoflow_result_xld', $id_salmonella_hemoflow_result_xld);
        $this->db->update('salmonella_hemoflow_sample_black_colony_plate', $data);
        return $this->db->affected_rows();
    }

        /**
     * Check if a specific tube already has biochemical data
     */
    function checkTubeExists($id_salmonella_hemoflow, $biochemical_tube) {
        $this->db->where('id_salmonella_hemoflow', $id_salmonella_hemoflow);
        $this->db->where('biochemical_tube', $biochemical_tube);
        $this->db->where('flag', '0');
        $query = $this->db->get('salmonella_hemoflow_result_biochemical');

        return $query->num_rows() > 0;
    }

    /**
     * Check if a specific tube needs update (exists but with different confirmation value)
     */
    function checkTubeNeedsUpdate($id_salmonella_hemoflow, $biochemical_tube, $expected_confirmation) {
        $this->db->select('confirmation, id_salmonella_hemoflow_result_biochemical');
        $this->db->where('id_salmonella_hemoflow', $id_salmonella_hemoflow);
        $this->db->where('biochemical_tube', $biochemical_tube);
        $this->db->where('flag', '0');
        $query = $this->db->get('salmonella_hemoflow_result_biochemical');
        
        if ($query->num_rows() > 0) {
            $result = $query->row();
            // Return true if current confirmation is different from expected
            return [
                'exists' => true,
                'needs_update' => $result->confirmation !== $expected_confirmation,
                'current_confirmation' => $result->confirmation,
                'id_salmonella_hemoflow_result_biochemical' => $result->id_salmonella_hemoflow_result_biochemical
            ];
        }
        
        return [
            'exists' => false,
            'needs_update' => false,
            'current_confirmation' => null,
            'id_salmonella_hemoflow_result_biochemical' => null
        ];
    }

    /**
     * Check if any tube has biochemical data for monitoring sync status
     */
    function checkAnyTubeExists($id_salmonella_hemoflow) {
        $this->db->where('id_salmonella_hemoflow', $id_salmonella_hemoflow);
        $this->db->where('flag', '0');
        $query = $this->db->get('salmonella_hemoflow_result_biochemical');

        return $query->num_rows() > 0;
    }

    /**
     * Get XLD results for a specific sample
     */
    function getXldResults($id_salmonella_hemoflow) {
        $this->db->select('shsbcp.plate_number, shsbcp.black_colony_plate as colony_plate');
        $this->db->from('salmonella_hemoflow_result_xld AS shrx');
        $this->db->join('salmonella_hemoflow_sample_black_colony_plate AS shsbcp', 'shrx.id_salmonella_hemoflow_result_xld = shsbcp.id_salmonella_hemoflow_result_xld', 'left');
        $this->db->where('shrx.id_salmonella_hemoflow', $id_salmonella_hemoflow);
        $this->db->where('shrx.flag', '0');
        $this->db->where('shsbcp.flag', '0');
        $query = $this->db->get();
        return $query->result();
    }

    /**
     * Get purple colony plates for a specific ChroMagar result
     */
    function getPurpleColonyPlates($id_salmonella_hemoflow_result_chromagar) {
        $this->db->select('plate_number, purple_colony_plate');
        $this->db->where('id_salmonella_hemoflow_result_chromagar', $id_salmonella_hemoflow_result_chromagar);
        $this->db->where('flag', '0');
        $query = $this->db->get('salmonella_hemoflow_sample_purple_colony_plate');
        return $query->result();
    }

    /**
     * Get all ChroMagar results for a specific sample
     */
    function getAllChroMagarResults($id_salmonella_hemoflow) {
        $this->db->select('id_salmonella_hemoflow_result_chromagar');
        $this->db->where('id_salmonella_hemoflow', $id_salmonella_hemoflow);
        $this->db->where('flag', '0');
        $query = $this->db->get('salmonella_hemoflow_result_chromagar');
        return $query->result();
    }

    /**
     * Check if biochemical result exists for a specific tube
     */
    function checkBiochemicalExists($id_salmonella_hemoflow, $id_salmonella_hemoflow_result_chromagar, $biochemical_tube) {
        $this->db->where('id_salmonella_hemoflow', $id_salmonella_hemoflow);
        $this->db->where('id_salmonella_hemoflow_result_chromagar', $id_salmonella_hemoflow_result_chromagar);
        $this->db->where('biochemical_tube', $biochemical_tube);
        $this->db->where('flag', '0');
        $query = $this->db->get('salmonella_hemoflow_result_biochemical');
        return $query->row();
    }

    /**
     * Update biochemical result
     */
    function updateBiochemicalResult($id_salmonella_hemoflow_result_biochemical, $data) {
        $this->db->where('id_salmonella_hemoflow_result_biochemical', $id_salmonella_hemoflow_result_biochemical);
        $this->db->update('salmonella_hemoflow_result_biochemical', $data);
        return $this->db->affected_rows();
    }
      
}

/* End of file Tbl_delivery_model.php */
/* Location: ./application/models/Tbl_delivery_model.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2022-12-14 03:38:42 */
/* http://harviacode.com */