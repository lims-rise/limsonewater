<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Campy_hemoflow_model extends CI_Model
{
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

    // datatables
    function json() {
        $this->datatables->select('ch.id_campy_hemoflow, ch.id_one_water_sample, ch.id_person, ch.number_of_tubes, ch.mpn_pcr_conducted, ch.campy_assay_barcode, 
        ch.user_review,
        ch.review,
        user.full_name,
        rp.initial, ch.date_sample_processed, ch.time_sample_processed, ch.filtration_volume,
        ch.id_sampletype, rs.sampletype, GROUP_CONCAT(chsv.vol_sampletube ORDER BY chsv.tube_number SEPARATOR ", ") AS vol_sampletube, GROUP_CONCAT(chsv.tube_number ORDER BY chsv.tube_number SEPARATOR ", ") AS tube_number, ch.flag,
        ch.date_created, ch.date_updated, GREATEST(ch.date_created, ch.date_updated) AS latest_date');
        $this->datatables->from('campy_hemoflow AS ch');
        $this->datatables->join('ref_person AS rp', 'ch.id_person = rp.id_person', 'left');
        $this->datatables->join('ref_sampletype AS rs', 'ch.id_sampletype = rs.id_sampletype', 'left');
        $this->datatables->join('campy_hemoflow_sample_volumes AS chsv', 'ch.id_campy_hemoflow = chsv.id_campy_hemoflow', 'left');
        $this->datatables->join('tbl_user user', 'ch.user_review = user.id_users', 'left');
        // $this->datatables->where('lab', $this->session->userdata('lab'));
        $this->datatables->where('ch.flag', '0');
        // GROUP BY
        $this->datatables->group_by('ch.id_campy_hemoflow');
        $lvl = $this->session->userdata('id_user_level');
        if ($lvl == 4){
            $this->datatables->add_column('action', anchor(site_url('campy_hemoflow/read/$1'),'<i class="fa fa-th-list" aria-hidden="true"></i>', array('class' => 'btn btn-warning btn-sm')), 'id_one_water_sample');
        }
        else if ($lvl == 3){
            $this->datatables->add_column('action', anchor(site_url('campy_hemoflow/read/$1'),'<i class="fa fa-th-list" aria-hidden="true"></i>', array('class' => 'btn btn-warning btn-sm')) ."
                ".'<button type="button" class="btn_edit btn btn-info btn-sm" aria-hidden="true"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>', 'id_one_water_sample');
        }
        else {
            $this->datatables->add_column('action', anchor(site_url('campy_hemoflow/read/$1'),'<i class="fa fa-th-list" aria-hidden="true"></i>', array('class' => 'btn btn-warning btn-sm')) ."
            ".'<button type="button" class="btn_edit btn btn-info btn-sm" aria-hidden="true"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>'." 
            ".'<button type="button" class="btn_deleteCampyHemoflow btn btn-danger btn-sm" data-id="$1" aria-hidden="true"><i class="fa fa-trash-o" aria-hidden="true"></i></button>', 'id_one_water_sample');
        }
        $this->db->order_by('latest_date', 'DESC');
        return $this->datatables->generate();
    }

    function subjsonCharcoal($id) {
        $this->datatables->select('chrc.id_chrc, ch.campy_assay_barcode, chrc.id_campy_hemoflow, chrc.date_sample_processed, chrc.time_sample_processed,
        GROUP_CONCAT(chsgp.growth_plate ORDER BY chsgp.plate_number SEPARATOR ", ") AS growth_plate, GROUP_CONCAT(chsgp.plate_number ORDER BY chsgp.plate_number SEPARATOR ", ") AS plate_number, chrc.flag, chrc.quality_control');
        $this->datatables->from('campy_hemoflow_result_charcoal AS chrc');
        $this->datatables->join('campy_hemoflow AS ch', 'chrc.id_campy_hemoflow = ch.id_campy_hemoflow', 'left');
        $this->datatables->join('campy_hemoflow_sample_growth_plate AS chsgp', 'chrc.id_chrc = chsgp.id_chrc', 'left');
        $this->datatables->where('chrc.flag', '0');
        $this->datatables->where('chrc.id_campy_hemoflow', $id);
        $this->datatables->group_by('
        chrc.id_chrc, 
        ch.campy_assay_barcode, 
        chrc.id_campy_hemoflow, 
        chrc.date_sample_processed, 
        chrc.time_sample_processed,
        chrc.flag
        ');
        $lvl = $this->session->userdata('id_user_level');
        if ($lvl == 4){
            $this->datatables->add_column('action', '', 'id_chrc');
        }
        else if ($lvl == 3){
            $this->datatables->add_column('action', '<button type="button" class="btn_edit_detResultsCharcoal btn btn-info btn-sm" aria-hidden="true"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>', 'id_chrc');
        }
        else {
            $this->datatables->add_column('action', '<button type="button" class="btn_edit_detResultsCharcoal btn btn-info btn-sm" aria-hidden="true"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>'." 
                ".'<button type="button" class="btn_deleteCharcoal btn btn-danger btn-sm" data-id="$1" aria-hidden="true"><i class="fa fa-trash-o" aria-hidden="true"></i></button>', 'id_chrc');
        }
        return $this->datatables->generate();
    }

    function subjsonHba($id) {
        $this->datatables->select('chrh.id_campy_hemoflow_result_hba, ch.campy_assay_barcode, chrh.id_campy_hemoflow, chrh.date_sample_processed, chrh.time_sample_processed, 
        GROUP_CONCAT(chsgplh.growth_plate ORDER BY chsgplh.plate_number SEPARATOR ", ") AS growth_plate, GROUP_CONCAT(chsgplh.plate_number ORDER BY chsgplh.plate_number SEPARATOR ", ") AS plate_number, chrh.flag, chsgplh.id_campy_hemoflow_sample_plate_hba, chrh.quality_control');
        $this->datatables->from('campy_hemoflow_result_hba AS chrh');
        $this->datatables->join('campy_hemoflow AS ch', 'chrh.id_campy_hemoflow = ch.id_campy_hemoflow', 'left');
        $this->datatables->join('campy_hemoflow_sample_growth_plate_hba AS chsgplh', 'chrh.id_campy_hemoflow_result_hba = chsgplh.id_campy_hemoflow_result_hba', 'left');
        $this->datatables->where('chrh.flag', '0');
        $this->datatables->where('chrh.id_campy_hemoflow', $id);
        $this->datatables->group_by('
        chrh.id_campy_hemoflow_result_hba, 
        ch.campy_assay_barcode, 
        chrh.id_campy_hemoflow, 
        chrh.date_sample_processed, 
        chrh.time_sample_processed,
        chrh.flag
        ');
        $lvl = $this->session->userdata('id_user_level');
        if ($lvl == 4){
            $this->datatables->add_column('action', '', 'id_campy_hemoflow_result_hba');
        }
        else if ($lvl == 3){
            $this->datatables->add_column('action', '<button type="button" class="btn_edit_detResultsHba btn btn-info btn-sm" aria-hidden="true"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>', 'id_campy_hemoflow_result_hba');
        }
        else {
            $this->datatables->add_column('action', '<button type="button" class="btn_edit_detResultsHba btn btn-info btn-sm" aria-hidden="true"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>'." 
                ".'<button type="button" class="btn_deleteHba btn btn-danger btn-sm" data-id="$1" aria-hidden="true"><i class="fa fa-trash-o" aria-hidden="true"></i></button>', 'id_campy_hemoflow_result_hba');
        }
        return $this->datatables->generate();
    }

    function subjsonBiochemical($id, $biochemical_tube) {

        $this->datatables->select('chrb.id_campy_hemoflow_result_biochemical, chrb.id_campy_hemoflow, chrb.id_campy_hemoflow_result_hba, ch.campy_assay_barcode, chrb.gramlysis, chrb.oxidase, chrb.catalase, chrb.confirmation, chrb.sample_store, chrb.biochemical_tube, chrb.flag');
        $this->datatables->from('campy_hemoflow_result_biochemical AS chrb');
        $this->datatables->join('campy_hemoflow AS ch', 'chrb.id_campy_hemoflow = ch.id_campy_hemoflow', 'left');
        $this->datatables->where('chrb.flag', '0');
        $this->datatables->where('chrb.id_campy_hemoflow', $id);

       // Add condition for biochemical_tube if it exists
        if (!empty($biochemical_tube)) {
            $this->datatables->where('chrb.biochemical_tube', $biochemical_tube);
        }
    
        $lvl = $this->session->userdata('id_user_level');
        if ($lvl == 4){
            $this->datatables->add_column('action', '', 'id_campy_hemoflow_result_biochemical');
        } else if ($lvl == 3){
            $this->datatables->add_column('action', '<button type="button" class="btn_edit_detResultsBiochemical btn btn-info btn-sm" aria-hidden="true"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>', 'id_campy_hemoflow_result_biochemical');
        } else {
            $this->datatables->add_column('action', '<button type="button" class="btn_edit_detResultsBiochemical btn btn-info btn-sm" aria-hidden="true"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>'." 
                ".'<button type="button" class="btn_deleteBiochemical btn btn-danger btn-sm" data-id="$1" aria-hidden="true"><i class="fa fa-trash-o" aria-hidden="true"></i></button>', 'id_campy_hemoflow_result_biochemical');
        }
        return $this->datatables->generate();
    }

    function subjsonFinalCalculation($id)
    {
        $response = array();
    
        // Step 1: Get unique tube_number
        $this->db->select('tube_number');
        $this->db->distinct();
        $this->db->from('campy_hemoflow_sample_volumes');
        $this->db->where('id_campy_hemoflow', $id);
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
            $case_statements[] = "MAX(CASE WHEN chsv1.tube_number = {$tube_number} THEN chsv1.vol_sampletube END) AS `Tube {$tube_number}`";
        }
        $case_query = implode(', ', $case_statements);
    
        // Final query with improved structure and array result
        $this->db->select("
            ch.id_campy_hemoflow,
            ch.id_one_water_sample, 
            ch.campy_assay_barcode,
            ch.id_person, 
            rp.initial, 
            rs.sampletype,
            ch.mpn_pcr_conducted, 
            ch.number_of_tubes, 
            ch.date_sample_processed, 
            ch.time_sample_processed, 
            ch.filtration_volume,
            hm.volume_filter,
            hm.volume_eluted,
            chrm.mpn_concentration,
            chrm.upper_ci,
            chrm.lower_ci,
            chrm.mpn_concentration_dw,
            chrm.upper_ci_dw,
            chrm.lower_ci_dw,
            CASE 
                WHEN chrm.mpn_concentration IS NOT NULL AND hm.volume_eluted IS NOT NULL THEN
                    CASE 
                        WHEN chrm.mpn_concentration LIKE '>%' THEN CONCAT('>', ROUND((CAST(SUBSTRING(chrm.mpn_concentration, 2) AS DECIMAL(10,2)) / 1000) * hm.volume_eluted, 2))
                        WHEN chrm.mpn_concentration LIKE '<%' THEN CONCAT('<', ROUND((CAST(SUBSTRING(chrm.mpn_concentration, 2) AS DECIMAL(10,2)) / 1000) * hm.volume_eluted, 2))
                        ELSE ROUND((CAST(chrm.mpn_concentration AS DECIMAL(10,2)) / 1000) * hm.volume_eluted, 2)
                    END
                ELSE NULL 
            END as total_campylobacter,
            CASE 
                WHEN chrm.mpn_concentration IS NOT NULL AND hm.volume_eluted IS NOT NULL AND hm.volume_filter IS NOT NULL AND hm.volume_filter > 0 THEN
                    CASE 
                        WHEN chrm.mpn_concentration LIKE '>%' THEN CONCAT('>', ROUND(((CAST(SUBSTRING(chrm.mpn_concentration, 2) AS DECIMAL(10,2)) / 1000) * hm.volume_eluted / hm.volume_filter), 2))
                        WHEN chrm.mpn_concentration LIKE '<%' THEN CONCAT('<', ROUND(((CAST(SUBSTRING(chrm.mpn_concentration, 2) AS DECIMAL(10,2)) / 1000) * hm.volume_eluted / hm.volume_filter), 2))
                        ELSE ROUND(((CAST(chrm.mpn_concentration AS DECIMAL(10,2)) / 1000) * hm.volume_eluted / hm.volume_filter), 2)
                    END
                ELSE NULL 
            END as concentration_mpn_l,
            CASE 
                WHEN chrm.upper_ci IS NOT NULL AND hm.volume_eluted IS NOT NULL AND hm.volume_filter IS NOT NULL AND hm.volume_filter > 0 THEN
                    CASE 
                        WHEN chrm.upper_ci LIKE '>%' THEN CONCAT('>', ROUND((CAST(SUBSTRING(chrm.upper_ci, 2) AS DECIMAL(10,2)) / 1000) * hm.volume_eluted / hm.volume_filter, 2))
                        WHEN chrm.upper_ci LIKE '<%' THEN CONCAT('<', ROUND((CAST(SUBSTRING(chrm.upper_ci, 2) AS DECIMAL(10,2)) / 1000) * hm.volume_eluted / hm.volume_filter, 2))
                        ELSE ROUND((CAST(chrm.upper_ci AS DECIMAL(10,2)) / 1000) * hm.volume_eluted / hm.volume_filter, 2)
                    END
                ELSE NULL 
            END as upper_ci_new,
            CASE 
                WHEN chrm.lower_ci IS NOT NULL AND hm.volume_eluted IS NOT NULL AND hm.volume_filter IS NOT NULL AND hm.volume_filter > 0 THEN
                    CASE 
                        WHEN chrm.lower_ci LIKE '>%' THEN CONCAT('>', ROUND((CAST(SUBSTRING(chrm.lower_ci, 2) AS DECIMAL(10,2)) / 1000) * hm.volume_eluted / hm.volume_filter, 2))
                        WHEN chrm.lower_ci LIKE '<%' THEN CONCAT('<', ROUND((CAST(SUBSTRING(chrm.lower_ci, 2) AS DECIMAL(10,2)) / 1000) * hm.volume_eluted / hm.volume_filter, 2))
                        ELSE ROUND((CAST(chrm.lower_ci AS DECIMAL(10,2)) / 1000) * hm.volume_eluted / hm.volume_filter, 2)
                    END
                ELSE NULL 
            END as lower_ci_new,
            $case_query, 
            GROUP_CONCAT(DISTINCT chrb.biochemical_tube ORDER BY chrb.biochemical_tube SEPARATOR ', ') AS biochemical_tube, 
            GROUP_CONCAT(DISTINCT CONCAT(chrb.biochemical_tube, ':', chrb.confirmation) ORDER BY chrb.biochemical_tube SEPARATOR ', ') AS confirmation,
            GROUP_CONCAT(DISTINCT chsgplh.plate_number ORDER BY chsgplh.plate_number SEPARATOR ', ') AS plate_numbers
        ");
        $this->db->from('campy_hemoflow AS ch');
        $this->db->join('hemoflow hm', 'ch.id_one_water_sample = hm.id_one_water_sample AND hm.flag = "0"', 'left');
        $this->db->join('campy_hemoflow_result_hba AS chrh', 'ch.id_campy_hemoflow = chrh.id_campy_hemoflow', 'left');
        $this->db->join('campy_hemoflow_sample_growth_plate_hba AS chsgplh', 'chrh.id_campy_hemoflow_result_hba = chsgplh.id_campy_hemoflow_result_hba', 'left');
        $this->db->join('campy_hemoflow_sample_volumes AS chsv1', 'chrh.id_campy_hemoflow = chsv1.id_campy_hemoflow', 'left');
        $this->db->join('campy_hemoflow_result_biochemical AS chrb', 'chsgplh.id_campy_hemoflow_result_hba = chrb.id_campy_hemoflow_result_hba AND chrb.flag = 0', 'left');
        $this->db->join('campy_hemoflow_result_mpn AS chrm', 'ch.id_campy_hemoflow = chrm.id_campy_hemoflow', 'left');
        $this->db->join('ref_sampletype AS rs', 'ch.id_sampletype = rs.id_sampletype', 'left');
        $this->db->join('ref_person AS rp',  'ch.id_person = rp.id_person', 'left');

        // Conditions
        $this->db->where('chrh.flag', '0');
        $this->db->where('chrh.id_campy_hemoflow', $id);
        $this->db->group_by('chrh.id_campy_hemoflow_result_hba');
    
        $q = $this->db->get();
    
        if ($q->num_rows() > 0) {
            $response = $q->result_array(); // Changed to result_array() for consistency
            foreach ($response as $key => $value) {
                $confirmations = !empty($value['confirmation']) ? explode(',', $value['confirmation']) : [];
                $biochemical_tubes = !empty($value['biochemical_tube']) ? explode(',', $value['biochemical_tube']) : [];
    
                $confirmation_array = []; // Inisialisasi array konfirmasi

                // Membuat array asosiasi untuk konfirmasi
                if (!empty($biochemical_tubes) && !empty($confirmations)) {
                    foreach ($biochemical_tubes as $index => $tube) {
                        $confirmation_array[$tube] = explode(':', $confirmations[$index] ?? 'No Growth Plate')[1] ?? 'No Growth Plate'; // Menyediakan default
                    }
                }
                $response[$key]['confirmation'] = $confirmation_array; // Assign confirmation yang sudah diproses
            }
        }
    
        return $response;
    }


    function get_export($id) {
        $response = array();
    
        // Step 1: Get unique tube_number
        $this->db->select('tube_number');
        $this->db->distinct();
        $this->db->from('campy_hemoflow_sample_volumes');
        $this->db->where('id_campy_hemoflow', $id);
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
            $case_statements[] = "MAX(CASE WHEN chsv1.tube_number = {$tube_number} THEN chsv1.vol_sampletube END) AS `Tube {$tube_number}`";
        }
        $case_query = implode(', ', $case_statements);
    
        // Final query
        $this->db->select("ch.id_one_water_sample, ch.id_person, rp.initial, ch.mpn_pcr_conducted, ch.number_of_tubes, 
                        ch.campy_assay_barcode, 
                        ch.date_sample_processed, 
                        ch.time_sample_processed, 
                        ch.filtration_volume, 
                        rs.sampletype,
                        chrm.mpn_concentration,
                        chrm.upper_ci,
                        chrm.lower_ci,
                        chrm.mpn_concentration_dw,
                        chrm.upper_ci_dw,
                        chrm.lower_ci_dw,
                           $case_query, 
                           GROUP_CONCAT(DISTINCT chrb.biochemical_tube ORDER BY chrb.biochemical_tube SEPARATOR ', ') AS biochemical_tube, 
                           GROUP_CONCAT(DISTINCT CONCAT(chrb.biochemical_tube, ':', chrb.confirmation) ORDER BY chrb.biochemical_tube SEPARATOR ', ') AS confirmation,
                           GROUP_CONCAT(DISTINCT chsgplh.plate_number ORDER BY chsgplh.plate_number SEPARATOR ', ') AS plate_numbers");
        $this->db->from('campy_hemoflow AS ch');
        $this->db->join('campy_hemoflow_result_hba AS chrh', 'ch.id_campy_hemoflow = chrh.id_campy_hemoflow', 'left');
        $this->db->join('campy_hemoflow_sample_growth_plate_hba AS chsgplh', 'chrh.id_campy_hemoflow_result_hba = chsgplh.id_campy_hemoflow_result_hba', 'left');
        $this->db->join('campy_hemoflow_sample_volumes AS chsv1', 'chrh.id_campy_hemoflow = chsv1.id_campy_hemoflow', 'left');
        $this->db->join('campy_hemoflow_result_biochemical AS chrb', 'chsgplh.id_campy_hemoflow_result_hba = chrb.id_campy_hemoflow_result_hba AND chrb.flag = 0', 'left');
        $this->db->join('campy_hemoflow_result_mpn AS chrm', 'ch.id_campy_hemoflow = chrm.id_campy_hemoflow', 'left');
        $this->db->join('ref_sampletype AS rs', 'ch.id_sampletype = rs.id_sampletype', 'left');
        $this->db->join('ref_person AS rp',  'ch.id_person = rp.id_person', 'left');

        // Conditions
        // $this->db->where('rb.flag', '0');
        $this->db->where('chrh.id_campy_hemoflow', $id);
        $this->db->group_by('chrh.id_campy_hemoflow_result_hba');
    
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
        $this->db->from('campy_hemoflow_sample_volumes');
        $this->db->where('id_campy_hemoflow IS NOT NULL');
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
            $case_statements[] = "MAX(CASE WHEN chsv1.tube_number = {$tube_number} THEN chsv1.vol_sampletube END) AS `Tube {$tube_number}`";
        }
        $case_query = implode(', ', $case_statements);
    
        // Final query
        $this->db->select("ch.id_one_water_sample, ch.id_person, rp.initial, ch.mpn_pcr_conducted, ch.number_of_tubes, ch.campy_assay_barcode, ch.date_sample_processed, 
                        ch.time_sample_processed, 
                        ch.filtration_volume, 
                        rs.sampletype,
                        chrm.mpn_concentration,
                        chrm.upper_ci,
                        chrm.lower_ci,
                        chrm.mpn_concentration_dw,
                        chrm.upper_ci_dw,
                        chrm.lower_ci_dw,
                           $case_query, 
                           GROUP_CONCAT(DISTINCT chrb.biochemical_tube ORDER BY chrb.biochemical_tube SEPARATOR ', ') AS biochemical_tube, 
                           GROUP_CONCAT(DISTINCT CONCAT(chrb.biochemical_tube, ':', chrb.confirmation) ORDER BY chrb.biochemical_tube SEPARATOR ', ') AS confirmation,
                           GROUP_CONCAT(DISTINCT chsgplh.plate_number ORDER BY chsgplh.plate_number SEPARATOR ', ') AS plate_numbers");
        $this->db->from('campy_hemoflow AS ch');
        $this->db->join('campy_hemoflow_result_hba AS chrh', 'ch.id_campy_hemoflow = chrh.id_campy_hemoflow', 'left');
        $this->db->join('campy_hemoflow_sample_growth_plate_hba AS chsgplh', 'chrh.id_campy_hemoflow_result_hba = chsgplh.id_campy_hemoflow_result_hba', 'left');
        $this->db->join('campy_hemoflow_sample_volumes AS chsv1', 'chrh.id_campy_hemoflow = chsv1.id_campy_hemoflow', 'left');
        $this->db->join('campy_hemoflow_result_biochemical AS chrb', 'chsgplh.id_campy_hemoflow_result_hba = chrb.id_campy_hemoflow_result_hba AND chrb.flag = 0', 'left');
        $this->db->join('campy_hemoflow_result_mpn AS chrm', 'ch.id_campy_hemoflow = chrm.id_campy_hemoflow', 'left');
        $this->db->join('ref_sampletype AS rs', 'ch.id_sampletype = rs.id_sampletype', 'left');
        $this->db->join('ref_person AS rp', 'ch.id_person = rp.id_person', 'left');

        // Conditions
        // $this->db->where('rb.flag', '0');
        $this->db->where('sv1.flag', '0');
        $this->db->group_by('chrh.id_campy_hemoflow_result_hba');
    
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
      $this->db->select('ch.id_campy_hemoflow, ch.id_one_water_sample, ch.id_person, rp.initial, ch.number_of_tubes,
        ch.id_sampletype, rs.sampletype, ch.mpn_pcr_conducted, ch.campy_assay_barcode, ch.date_sample_processed,
        ch.sample_dryweight_old,
        ch.user_review, 
        ch.review, 
        user.full_name,
        ch.user_created, 
        ch.time_sample_processed, ch.time_sample_processed, ch.filtration_volume,
        GROUP_CONCAT(chsv.vol_sampletube ORDER BY chsv.tube_number SEPARATOR ", ") AS vol_sampletube, GROUP_CONCAT(chsv.tube_number ORDER BY chsv.tube_number SEPARATOR ", ") AS tube_number');
      $this->db->from('campy_hemoflow AS ch');
      $this->db->join('ref_sampletype AS rs', 'ch.id_sampletype = rs.id_sampletype', 'left');
      $this->datatables->join('campy_hemoflow_sample_volumes AS chsv', 'ch.id_campy_hemoflow = chsv.id_campy_hemoflow', 'left');
      $this->db->join('ref_person AS rp',  'ch.id_person = rp.id_person', 'left');
      $this->db->join('tbl_user user', 'ch.user_review = user.id_users', 'left');
      $this->db->where('ch.id_one_water_sample', $id);
      $this->db->where('ch.flag', '0');
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
        WHERE id_one_water_sample NOT IN (SELECT id_one_water_sample FROM campy_hemoflow)
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
        SELECT campy_assay_barcode FROM campy_hemoflow
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
        $this->db->insert('campy_hemoflow', $data);
        return $this->db->insert_id(); // Return the last inserted ID
    }
    
    public function insert_sample_volume($data) {
        $this->db->insert('campy_hemoflow_sample_volumes', $data);
    }
    
    function updateCampyHemoflow($id, $data) {
        $this->db->where('id_one_water_sample', $id);
        $this->db->update('campy_hemoflow', $data);
    }

    public function delete_sample_volumes($id_campy_hemoflow) {
        $this->db->where('id_campy_hemoflow', $id_campy_hemoflow);
        $this->db->delete('campy_hemoflow_sample_volumes');
    }

    public function insertResultsCharcoal($data) {
        $this->db->insert('campy_hemoflow_result_charcoal', $data);
        return $this->db->insert_id(); // Return the last inserted ID
    }

    public function insert_growth_plate($data) {
        $this->db->insert('campy_hemoflow_sample_growth_plate', $data);
    }

    function updateResultsCharcoal($id, $data) {
        $this->db->where('id_chrc', $id);
        $this->db->update('campy_hemoflow_result_charcoal', $data);
    }

    public function delete_growth_plates($id_chrc) {
        $this->db->where('id_chrc', $id_chrc);
        $this->db->delete('campy_hemoflow_sample_growth_plate');
    }

    function get_by_id_charcoal($id)
    {
        $this->db->where('id_chrc', $id);
        $this->db->where('flag', '0');
        return $this->db->get('campy_hemoflow_result_charcoal')->row();
    }

    function updateResultsGrowthPlate($id, $data) {
        $this->db->where('id_chrc', $id);
        $this->db->update('campy_hemoflow_sample_growth_plate', $data);
    }

    function get_by_id_campyhemoflow($id)
    {
        $this->db->where('id_one_water_sample', $id);
        $this->db->where('flag', '0');
        return $this->db->get('campy_hemoflow')->row();
    }

    function updateSampleVolume($id, $data) {
        $this->db->where('id_campy_hemoflow', $id);
        $this->db->where('flag', '0');
        $this->db->update('campy_hemoflow_sample_volumes', $data);
    }

    function insertResultsHba($data) {
        $this->db->insert('campy_hemoflow_result_hba', $data);
        return $this->db->insert_id();
    }

    public function insert_growth_plate_hba($data) {
        $this->db->insert('campy_hemoflow_sample_growth_plate_hba', $data);
    }

    function updateResultsHba($id_campy_hemoflow_result_hba, $data) {
        $this->db->where('id_campy_hemoflow_result_hba', $id_campy_hemoflow_result_hba);
        $this->db->update('campy_hemoflow_result_hba', $data);
    }

    public function delete_growth_plates_hba($id_campy_hemoflow_result_hba) {
        $this->db->where('id_campy_hemoflow_result_hba', $id_campy_hemoflow_result_hba);
        $this->db->delete('campy_hemoflow_sample_growth_plate_hba');
    }

    function get_by_id_hba($id)
    {
        $this->db->where('id_campy_hemoflow_result_hba', $id);
        $this->db->where('flag', '0');
        return $this->db->get('campy_hemoflow_result_hba')->row();
    }

    function updateResultsGrowthPlateHba($id, $data) {
        $this->db->where('id_campy_hemoflow_result_hba', $id);
        $this->db->update('campy_hemoflow_sample_growth_plate_hba', $data);
    }

    function insertResultsBiochemical($data) {
        $this->db->insert('campy_hemoflow_result_biochemical', $data);
        return $this->db->insert_id();
    }
    
    function get_by_id_biochemical($id)
    {
        $this->db->where('id_campy_hemoflow_result_biochemical', $id);
        $this->db->where('flag', '0');
        return $this->db->get('campy_hemoflow_result_biochemical')->row();
    }

    function updateResultsBiochemical($id_campy_hemoflow_result_biochemical, $data) {
        $this->db->where('id_campy_hemoflow_result_biochemical', $id_campy_hemoflow_result_biochemical);
        $this->db->update('campy_hemoflow_result_biochemical', $data);
    }

    function barcode_restrict($id){

        $q = $this->db->query('
        select id_one_water_sample
        from campy_hemoflow
        WHERE id_one_water_sample = "'.$id.'" AND flag = 0
        ');        
        $response = $q->result_array();
        return $response;
    }

    function update_campy_hemoflow($id_one_water_sample, $data)
    {
        $this->db->where('id_one_water_sample', $id_one_water_sample);
        $this->db->update('campy_hemoflow', $data);
    }

    function updateCancel($id, $data)
    {
        $this->db->where('id_one_water_sample', $id);
        $this->db->update('campy_hemoflow', $data);

        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    function insertCalculateMPN($data) {
        $this->db->insert('campy_hemoflow_result_mpn', $data);
        
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
        $this->db->where('id_campy_hemoflow_result_mpn', $id);
        $this->db->update('campy_hemoflow_result_mpn', $data);
        
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
        $this->db->where('id_campy_hemoflow_result_mpn', $id);
        $this->db->where('flag', '0');
        return $this->db->get('campy_hemoflow_result_mpn')->row();
    }

    function delete_calculate_mpn($id) {
        $data = array('flag' => 1);
        $this->db->where('id_campy_hemoflow_result_mpn', $id);
        $this->db->update('campy_hemoflow_result_mpn', $data);

        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    function get_calculate_mpn_by_campy_hemoflow($id_campy_hemoflow) {
        $this->db->where('id_campy_hemoflow', $id_campy_hemoflow);
        $this->db->where('flag', '0');
        return $this->db->get('campy_hemoflow_result_mpn')->row();
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

    /**
     * Get HBA results by campy_hemoflow ID
     * Used to check if HBA data already exists before auto-generation
     */
    function get_hba_by_campy_hemoflow($id_campy_hemoflow) {
        $this->db->where('id_campy_hemoflow', $id_campy_hemoflow);
        $this->db->where('flag', '0');
        return $this->db->get('campy_hemoflow_result_hba')->row();
    }

    /**
     * Get biochemical results by HBA ID
     * Used for cascade delete when HBA is deleted
     */
    function get_biochemical_by_hba_id($id_campy_hemoflow_result_hba) {
        $this->db->where('id_campy_hemoflow_result_hba', $id_campy_hemoflow_result_hba);
        $this->db->where('flag', '0');
        return $this->db->get('campy_hemoflow_result_biochemical')->result();
    }

    /**
     * Delete biochemical results by HBA ID (cascade delete)
     * Sets flag = 1 for all biochemical results related to specific HBA
     */
    function delete_biochemical_by_hba_id($id_campy_hemoflow_result_hba) {
        $data = array('flag' => 1);
        $this->db->where('id_campy_hemoflow_result_hba', $id_campy_hemoflow_result_hba);
        $this->db->update('campy_hemoflow_result_biochemical', $data);
        
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Get HBA results by Charcoal ID
     * Used for cascade delete when Charcoal is deleted
     */
    function get_hba_by_charcoal_id($id_campy_hemoflow) {
        $this->db->where('id_campy_hemoflow', $id_campy_hemoflow);
        $this->db->where('flag', '0');
        return $this->db->get('campy_hemoflow_result_hba')->result();
    }

    /**
     * Delete HBA results by campy_hemoflow ID (cascade delete)
     * Sets flag = 1 for all HBA results related to specific campy_hemoflow
     */
    function delete_hba_by_campy_hemoflow($id_campy_hemoflow) {
        $data = array('flag' => 1);
        $this->db->where('id_campy_hemoflow', $id_campy_hemoflow);
        $this->db->update('campy_hemoflow_result_hba', $data);
        
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