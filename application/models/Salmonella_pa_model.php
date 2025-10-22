<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Salmonella_pa_model extends CI_Model
{
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

    // datatables
    function json() {
        $this->datatables->select('cbp.id_salmonella_pa, cbp.id_one_water_sample, cbp.id_person, cbp.number_of_tubes, cbp.mpn_pcr_conducted, cbp.salmonella_assay_barcode, 
        rp.initial, cbp.date_sample_processed, cbp.time_sample_processed, cbp.sample_wetweight, cbp.enrichment_media,
        cbp.id_sampletype, rs.sampletype, GROUP_CONCAT(svp.vol_sampletube ORDER BY svp.tube_number SEPARATOR ", ") AS vol_sampletube, GROUP_CONCAT(svp.tube_number ORDER BY svp.tube_number SEPARATOR ", ") AS tube_number, cbp.flag,
        cbp.date_created, cbp.date_updated, GREATEST(cbp.date_created, cbp.date_updated) AS latest_date');
        $this->datatables->from('salmonella_pa AS cbp');
        $this->datatables->join('ref_person AS rp', 'cbp.id_person = rp.id_person', 'left');
        $this->datatables->join('ref_sampletype AS rs', 'cbp.id_sampletype = rs.id_sampletype', 'left');
        $this->datatables->join('salmonella_sample_volumes_pa AS svp', 'cbp.id_salmonella_pa = svp.id_salmonella_pa', 'left');
        // $this->datatables->where('lab', $this->session->userdata('lab'));
        $this->datatables->where('cbp.flag', '0');
        // GROUP BY
        $this->datatables->group_by('cbp.id_salmonella_pa');
        $lvl = $this->session->userdata('id_user_level');
        if ($lvl == 4){
            $this->datatables->add_column('action', anchor(site_url('salmonella_pa/read/$1'),'<i class="fa fa-th-list" aria-hidden="true"></i>', array('class' => 'btn btn-warning btn-sm')), 'id_one_water_sample');
        }
        else if ($lvl == 3){
            $this->datatables->add_column('action', anchor(site_url('salmonella_pa/read/$1'),'<i class="fa fa-th-list" aria-hidden="true"></i>', array('class' => 'btn btn-warning btn-sm')) ."
                ".'<button type="button" class="btn_edit btn btn-info btn-sm" aria-hidden="true"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>', 'id_one_water_sample');
        }
        else {
            $this->datatables->add_column('action', anchor(site_url('salmonella_pa/read/$1'),'<i class="fa fa-th-list" aria-hidden="true"></i>', array('class' => 'btn btn-warning btn-sm')) ."
            ".'<button type="button" class="btn_edit btn btn-info btn-sm" aria-hidden="true"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>'." 
            ".'<button type="button" class="btn_deleteSalmonellaPA btn btn-danger btn-sm" data-id="$1" aria-hidden="true"><i class="fa fa-trash-o" aria-hidden="true"></i></button>', 'id_one_water_sample');
        }
        $this->db->order_by('latest_date', 'DESC');
        return $this->datatables->generate();
    }

    function subjsonXldAgar($id) {
        $this->datatables->select('rcp.id_result_xld_agar_pa, cbp.salmonella_assay_barcode, rcp.id_salmonella_pa, rcp.date_sample_processed, rcp.time_sample_processed,
        GROUP_CONCAT(sgpp.black_colony_plate ORDER BY sgpp.plate_number SEPARATOR ", ") AS black_colony_plate, GROUP_CONCAT(sgpp.plate_number ORDER BY sgpp.plate_number SEPARATOR ", ") AS plate_number, rcp.flag, rcp.quality_control');
        $this->datatables->from('salmonella_result_xld_agar_pa AS rcp');
        $this->datatables->join('salmonella_pa AS cbp', 'rcp.id_salmonella_pa = cbp.id_salmonella_pa', 'left');
        $this->datatables->join('salmonella_sample_black_colony_plate_xld_agar_pa AS sgpp', 'rcp.id_result_xld_agar_pa = sgpp.id_result_xld_agar_pa', 'left');
        $this->datatables->where('rcp.flag', '0');
        $this->datatables->where('rcp.id_salmonella_pa', $id);
        $this->datatables->group_by('
        rcp.id_result_xld_agar_pa, 
        cbp.salmonella_assay_barcode, 
        rcp.id_salmonella_pa, 
        rcp.date_sample_processed, 
        rcp.time_sample_processed,
        rcp.flag
        ');
        $lvl = $this->session->userdata('id_user_level');
        if ($lvl == 4){
            $this->datatables->add_column('action', '', 'id_result_xld_agar_pa');
        }
        else if ($lvl == 3){
            $this->datatables->add_column('action', '<button type="button" class="btn_edit_detResultsXldAgar btn btn-info btn-sm" aria-hidden="true"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>', 'id_result_xld_agar_pa');
        }
        else {
            $this->datatables->add_column('action', '<button type="button" class="btn_edit_detResultsXldAgar btn btn-info btn-sm" aria-hidden="true"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>'." 
                ".'<button type="button" class="btn_deleteXldAgar btn btn-danger btn-sm" data-id="$1" aria-hidden="true"><i class="fa fa-trash-o" aria-hidden="true"></i></button>', 'id_result_xld_agar_pa');
        }
        return $this->datatables->generate();
    }

    function subjsonChromagar($id) {
        $this->datatables->select('rhp.id_result_chromagar_pa, cbp.salmonella_assay_barcode, rhp.id_salmonella_pa, rhp.date_sample_processed, rhp.time_sample_processed, 
        GROUP_CONCAT(sgphp.purple_colony_plate ORDER BY sgphp.plate_number SEPARATOR ", ") AS purple_colony_plate, GROUP_CONCAT(sgphp.plate_number ORDER BY sgphp.plate_number SEPARATOR ", ") AS plate_number, rhp.flag, sgphp.id_sample_plate_chromagar_pa, rhp.quality_control');
        $this->datatables->from('salmonella_result_chromagar_pa AS rhp');
        $this->datatables->join('salmonella_pa AS cbp', 'rhp.id_salmonella_pa = cbp.id_salmonella_pa', 'left');
        $this->datatables->join('salmonella_sample_purple_colony_plate_chromagar_pa AS sgphp', 'rhp.id_result_chromagar_pa = sgphp.id_result_chromagar_pa', 'left');
        $this->datatables->where('rhp.flag', '0');
        $this->datatables->where('rhp.id_salmonella_pa', $id);
        $this->datatables->group_by('
        rhp.id_result_chromagar_pa, 
        cbp.salmonella_assay_barcode, 
        rhp.id_salmonella_pa, 
        rhp.date_sample_processed, 
        rhp.time_sample_processed,
        rhp.flag
        ');
        $lvl = $this->session->userdata('id_user_level');
        if ($lvl == 4){
            $this->datatables->add_column('action', '', 'id_result_chromagar_pa');
        }
        else if ($lvl == 3){
            $this->datatables->add_column('action', '<button type="button" class="btn_edit_detResultsChromagar btn btn-info btn-sm" aria-hidden="true"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>', 'id_result_chromagar_pa');
        }
        else {
            $this->datatables->add_column('action', '<button type="button" class="btn_edit_detResultsChromagar btn btn-info btn-sm" aria-hidden="true"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>'." 
                ".'<button type="button" class="btn_deleteChromagar btn btn-danger btn-sm" data-id="$1" aria-hidden="true"><i class="fa fa-trash-o" aria-hidden="true"></i></button>', 'id_result_chromagar_pa');
        }
        return $this->datatables->generate();
    }

    function subjsonBiochemical($id, $biochemical_tube) {

        $this->datatables->select('rbp.id_result_biochemical_pa, rbp.id_salmonella_pa, rbp.id_result_chromagar_pa, cbp.salmonella_assay_barcode, rbp.confirmation, rbp.biochemical_tube, rbp.flag');
        $this->datatables->from('salmonella_result_biochemical_pa AS rbp');
        $this->datatables->join('salmonella_pa AS cbp', 'rbp.id_salmonella_pa = cbp.id_salmonella_pa', 'left');
        $this->datatables->where('rbp.flag', '0');
        $this->datatables->where('rbp.id_salmonella_pa', $id);

        // Add condition for biochemical_tube if it exists
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

        // Step 1: Cek apakah ada data Chromagar/Biochemical
        $this->db->select('COUNT(*) as count');
        $this->db->from('salmonella_result_chromagar_pa');
        $this->db->where('id_salmonella_pa', $id);
        $has_chromagar_data = $this->db->get()->row()->count > 0;

        // Step 2: Query berdasarkan ketersediaan data
        if ($has_chromagar_data) {
            // Gunakan query lengkap seperti sekarang
            return $this->getFullConcentrationData($id);
        } else {
            // Gunakan query basic untuk menampilkan struktur table
            return $this->getBasicConcentrationData($id);
        }
    }

    private function getBasicConcentrationData($id) 
    {
        // Step 1: Get unique tube_number untuk membuat case query
        $this->db->select('tube_number');
        $this->db->distinct();
        $this->db->from('salmonella_sample_volumes_pa');
        $this->db->where('id_salmonella_pa', $id);
        $this->db->order_by('tube_number', 'ASC');
        $tube_numbers = $this->db->get()->result_array();

        // Step 2: Create case query for pivot (sama seperti di getFullConcentrationData)
        $case_statements = [];
        foreach ($tube_numbers as $row) {
            $tube_number = $row['tube_number'];
            $case_statements[] = "MAX(CASE WHEN svp1.tube_number = {$tube_number} THEN svp1.vol_sampletube END) AS `Tube {$tube_number}`";
        }
        $case_query = implode(', ', $case_statements);

        // Step 3: Query yang hanya mengambil data dari tabel utama + volumes
        // Tanpa bergantung pada Chromagar/Biochemical
        $this->db->select("cbp.id_one_water_sample, cbp.id_person, rp.initial, 
                        cbp.mpn_pcr_conducted, cbp.number_of_tubes, cbp.salmonella_assay_barcode, 
                        cbp.date_sample_processed, cbp.time_sample_processed, 
                        cbp.sample_wetweight, cbp.enrichment_media, rs.sampletype,
                        {$case_query},
                        '' AS biochemical_tube,
                        '' AS confirmation,
                        '' AS plate_numbers");
        $this->db->from('salmonella_pa AS cbp');
        $this->db->join('salmonella_sample_volumes_pa AS svp1', 'cbp.id_salmonella_pa = svp1.id_salmonella_pa', 'left');
        $this->db->join('ref_sampletype AS rs', 'cbp.id_sampletype = rs.id_sampletype', 'left');
        $this->db->join('ref_person AS rp', 'cbp.id_person = rp.id_person', 'left');
        $this->db->where('cbp.id_salmonella_pa', $id);
        $this->db->group_by('cbp.id_salmonella_pa'); // Group by main table, bukan Chromagar

        return $this->db->get()->result();
    }


    private function getFullConcentrationData($id)
    {
        $response = array();

        // Step 1: Get unique tube_number terlebih dahulu
        $this->db->select('tube_number');
        $this->db->distinct();
        $this->db->from('salmonella_sample_volumes_pa');
        $this->db->where('id_salmonella_pa', $id);
        $this->db->order_by('tube_number', 'ASC');
        $tube_numbers = $this->db->get()->result_array();

        // Check if tube numbers are empty
        if (empty($tube_numbers)) {
            return [];
        }

        // Step 2: Create case query for pivot
        $case_statements = [];
        foreach ($tube_numbers as $row) {
            $tube_number = $row['tube_number'];
            $case_statements[] = "MAX(CASE WHEN svp1.tube_number = {$tube_number} THEN svp1.vol_sampletube END) AS `Tube {$tube_number}`";
        }
        $case_query = implode(', ', $case_statements);

        // Step 3: Final query lengkap dengan semua JOIN
        $this->db->select("cbp.id_one_water_sample, cbp.id_person, rp.initial, cbp.mpn_pcr_conducted, cbp.number_of_tubes, cbp.salmonella_assay_barcode, 
                        cbp.date_sample_processed, 
                        cbp.time_sample_processed, 
                        cbp.sample_wetweight, 
                        cbp.enrichment_media, 
                        rs.sampletype,
                        $case_query, 
                        GROUP_CONCAT(DISTINCT rbp.biochemical_tube ORDER BY rbp.biochemical_tube SEPARATOR ', ') AS biochemical_tube, 
                        GROUP_CONCAT(DISTINCT CONCAT(rbp.biochemical_tube, ':', rbp.confirmation) ORDER BY rbp.biochemical_tube SEPARATOR ', ') AS confirmation,
                        GROUP_CONCAT(DISTINCT sgphp.plate_number ORDER BY sgphp.plate_number SEPARATOR ', ') AS plate_numbers");
        $this->db->from('salmonella_pa AS cbp');
        $this->db->join('salmonella_result_chromagar_pa AS rhp', 'cbp.id_salmonella_pa = rhp.id_salmonella_pa', 'left');
        $this->db->join('salmonella_sample_purple_colony_plate_chromagar_pa AS sgphp', 'rhp.id_result_chromagar_pa = sgphp.id_result_chromagar_pa', 'left');
        $this->db->join('salmonella_sample_volumes_pa AS svp1', 'rhp.id_salmonella_pa = svp1.id_salmonella_pa', 'left');
        $this->db->join('salmonella_result_biochemical_pa AS rbp', 'sgphp.id_result_chromagar_pa = rbp.id_result_chromagar_pa AND rbp.flag = 0', 'left');
        $this->db->join('ref_sampletype AS rs', 'cbp.id_sampletype = rs.id_sampletype', 'left');
        $this->db->join('ref_person AS rp',  'cbp.id_person = rp.id_person', 'left');

        // Conditions
        $this->db->where('rhp.flag', '0');
        $this->db->where('rhp.id_salmonella_pa', $id);
        $this->db->group_by('rhp.id_result_chromagar_pa');

        $q = $this->db->get();

        if ($q->num_rows() > 0) {
            $response = $q->result();
            foreach ($response as $key => $value) {
                $confirmations = !empty($value->confirmation) ? explode(',', $value->confirmation) : [];
                $biochemical_tubes = !empty($value->biochemical_tube) ? explode(',', $value->biochemical_tube) : [];

                $confirmation_array = []; // Inisialisasi array konfirmasi

                // Membuat array asosiasi untuk konfirmasi
                if (!empty($biochemical_tubes) && !empty($confirmations)) {
                    foreach ($biochemical_tubes as $index => $tube) {
                        $confirmation_array[$tube] = explode(':', $confirmations[$index] ?? 'No Purple Plate')[1] ?? 'No Purple Plate';
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
        $this->db->from('salmonella_sample_volumes_pa');
        $this->db->where('id_salmonella_pa', $id);
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
        $this->db->select("cbp.id_one_water_sample, cbp.id_person, rp.initial, cbp.mpn_pcr_conducted, cbp.number_of_tubes, cbp.salmonella_assay_barcode, cbp.date_sample_processed, cbp.time_sample_processed, cbp.sample_wetweight, cbp.enrichment_media, rs.sampletype,
                           $case_query, 
                           GROUP_CONCAT(DISTINCT rbp.biochemical_tube ORDER BY rbp.biochemical_tube SEPARATOR ', ') AS biochemical_tube, 
                           GROUP_CONCAT(DISTINCT CONCAT(rbp.biochemical_tube, ':', rbp.confirmation) ORDER BY rbp.biochemical_tube SEPARATOR ', ') AS confirmation,
                           GROUP_CONCAT(DISTINCT sgphp.plate_number ORDER BY sgphp.plate_number SEPARATOR ', ') AS plate_numbers");
        $this->db->from('salmonella_pa AS cbp');
        $this->db->join('salmonella_result_chromagar_pa AS rhp', 'cbp.id_salmonella_pa = rhp.id_salmonella_pa', 'left');
        $this->db->join('salmonella_sample_purple_colony_plate_chromagar_pa AS sgphp', 'rhp.id_result_chromagar_pa = sgphp.id_result_chromagar_pa', 'left');
        $this->db->join('salmonella_sample_volumes_pa AS svp1', 'rhp.id_salmonella_pa = svp1.id_salmonella_pa', 'left');
        $this->db->join('salmonella_result_biochemical_pa AS rbp', 'sgphp.id_result_chromagar_pa = rbp.id_result_chromagar_pa', 'left');
        $this->db->join('ref_sampletype AS rs', 'cbp.id_sampletype = rs.id_sampletype', 'left');
        $this->db->join('ref_person AS rp',  'cbp.id_person = rp.id_person', 'left');
    
        // Conditions
        $this->db->where('rbp.flag', '0');
        $this->db->where('rhp.id_salmonella_pa', $id);
        $this->db->group_by('rhp.id_result_chromagar_pa');
    
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
        $this->db->from('salmonella_sample_volumes_pa');
        $this->db->where('id_salmonella_pa IS NOT NULL');
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
        $this->db->select("cbp.id_one_water_sample, cbp.id_person, rp.initial, cbp.mpn_pcr_conducted, cbp.number_of_tubes, cbp.salmonella_assay_barcode, cbp.date_sample_processed, cbp.time_sample_processed, cbp.sample_wetweight, cbp.enrichment_media, rs.sampletype,
                           $case_query, 
                           GROUP_CONCAT(DISTINCT rbp.biochemical_tube ORDER BY rbp.biochemical_tube SEPARATOR ', ') AS biochemical_tube, 
                           GROUP_CONCAT(DISTINCT CONCAT(rbp.biochemical_tube, ':', rbp.confirmation) ORDER BY rbp.biochemical_tube SEPARATOR ', ') AS confirmation,
                           GROUP_CONCAT(DISTINCT sgphp.plate_number ORDER BY sgphp.plate_number SEPARATOR ', ') AS plate_numbers");
        $this->db->from('salmonella_pa AS cbp');
        $this->db->join('salmonella_result_chromagar_pa AS rhp', 'cbp.id_salmonella_pa = rhp.id_salmonella_pa', 'left');
        $this->db->join('salmonella_sample_purple_colony_plate_chromagar_pa AS sgphp', 'rhp.id_result_chromagar_pa = sgphp.id_result_chromagar_pa', 'left');
        $this->db->join('salmonella_sample_volumes_pa AS svp1', 'rhp.id_salmonella_pa = svp1.id_salmonella_pa', 'left');
        $this->db->join('salmonella_result_biochemical_pa AS rbp', 'sgphp.id_result_chromagar_pa = rbp.id_result_chromagar_pa', 'left');
        $this->db->join('ref_sampletype AS rs', 'cbp.id_sampletype = rs.id_sampletype', 'left');
        $this->db->join('ref_person AS rp', 'cbp.id_person = rp.id_person', 'left');
    
        // Conditions
        $this->db->where('rbp.flag', '0');
        $this->db->where('svp1.flag', '0');
        $this->db->group_by('rhp.id_result_chromagar_pa');
    
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
        return $this->db->get($this->table)->row();
    }

    function get_detail($id)
    {

      $response = array();
      $this->db->select('cbp.id_salmonella_pa, cbp.id_one_water_sample, cbp.id_person, rp.initial, cbp.number_of_tubes,
        cbp.id_sampletype, rs.sampletype, cbp.mpn_pcr_conducted, cbp.salmonella_assay_barcode, cbp.date_sample_processed,
        cbp.time_sample_processed, cbp.time_sample_processed, cbp.sample_wetweight, cbp.enrichment_media,
        cbp.user_review, 
        cbp.review, 
        user.full_name,
        cbp.user_created, 
        GROUP_CONCAT(svp.vol_sampletube ORDER BY svp.tube_number SEPARATOR ", ") AS vol_sampletube, GROUP_CONCAT(svp.tube_number ORDER BY svp.tube_number SEPARATOR ", ") AS tube_number');
      $this->db->from('salmonella_pa AS cbp');
      $this->db->join('ref_sampletype AS rs', 'cbp.id_sampletype = rs.id_sampletype', 'left');
      $this->datatables->join('salmonella_sample_volumes_pa AS svp', 'cbp.id_salmonella_pa = svp.id_salmonella_pa', 'left');
      $this->db->join('ref_person AS rp',  'cbp.id_person = rp.id_person', 'left');
      $this->db->join('tbl_user user', 'cbp.user_review = user.id_users', 'left');
      $this->db->where('cbp.id_one_water_sample', $id);
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
        SELECT id_one_water_sample FROM sample_reception_sample
        WHERE id_one_water_sample NOT IN (SELECT id_one_water_sample FROM salmonella_pa)
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
        SELECT salmonella_assay_barcode FROM salmonella_pa
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
        $this->db->where('value =', 1);
        $this->db->order_by('value');
        $labTech = $this->db->get('ref_tubes');
        $response = $labTech->result_array();
        return $response;
    }



    public function insert($data) {
        $this->db->insert('salmonella_pa', $data);
        return $this->db->insert_id(); // Return the last inserted ID
    }
    
    public function insert_sample_volume($data) {
        $this->db->insert('salmonella_sample_volumes_pa', $data);
    }

    function updateSalmonellaPA($id, $data) {
        $this->db->where('id_salmonella_pa', $id);
        $this->db->update('salmonella_pa', $data);
    }

    public function delete_sample_volumes($id_salmonella_pa) {
        $this->db->where('id_salmonella_pa', $id_salmonella_pa);
        $this->db->delete('salmonella_sample_volumes_pa');
    }

    public function insertResultsXldAgar($data) {
        $this->db->insert('salmonella_result_xld_agar_pa', $data);
        return $this->db->insert_id(); // Return the last inserted ID
    }

    public function insert_black_plate($data) {
        $this->db->insert('salmonella_sample_black_colony_plate_xld_agar_pa', $data);
    }

    function updateResultsXldAgar($id, $data) {
        $this->db->where('id_result_xld_agar_pa', $id);
        $this->db->update('salmonella_result_xld_agar_pa', $data);
    }

    public function delete_black_plates($id_result_xld_agar_pa) {
        $this->db->where('id_result_xld_agar_pa', $id_result_xld_agar_pa);
        $this->db->delete('salmonella_sample_black_colony_plate_xld_agar_pa');
    }

    function get_by_id_xld_agar($id)
    {
        $this->db->where('id_result_xld_agar_pa', $id);
        $this->db->where('flag', '0');
        return $this->db->get('salmonella_result_xld_agar_pa')->row();
    }

    function updateResultsGrowthPlate($id, $data) {
        $this->db->where('id_result_xld_agar_pa', $id);
        $this->db->update('salmonella_sample_black_colony_plate_xld_agar_pa', $data);
    }

    function updateResultsPurplePlateChromagar($id, $data) {
        $this->db->where('id_result_chromagar_pa', $id);
        $this->db->update('salmonella_sample_purple_colony_plate_chromagar_pa', $data);
    }

    function get_by_id_salmonella_pa($id)
    {
        $this->db->where('id_salmonella_pa', $id);
        $this->db->where('flag', '0');
        return $this->db->get('salmonella_pa')->row();
    }

    function updateSampleVolume($id, $data) {
        $this->db->where('id_salmonella_pa', $id);
        $this->db->update('salmonella_sample_volumes_pa', $data);
    }

    function insertResultsChromagar($data) {
        $this->db->insert('salmonella_result_chromagar_pa', $data);
        return $this->db->insert_id();
    }

    public function insert_purple_plate_chromagar($data) {
        $this->db->insert('salmonella_sample_purple_colony_plate_chromagar_pa', $data);
    }

    function updateResultsChromagar($id_result_chromagar_pa, $data) {
        $this->db->where('id_result_chromagar_pa', $id_result_chromagar_pa);
        $this->db->update('salmonella_result_chromagar_pa', $data);
    }

    public function delete_purple_plates_chromagar($id_result_chromagar_pa) {
        $this->db->where('id_result_chromagar_pa', $id_result_chromagar_pa);
        $this->db->delete('salmonella_sample_purple_colony_plate_chromagar_pa');
    }

    function get_by_id_chromagar($id)
    {
        $this->db->where('id_result_chromagar_pa', $id);
        $this->db->where('flag', '0');
        return $this->db->get('salmonella_result_chromagar_pa')->row();
    }

    function updateResultsGrowthPlateChromagar($id, $data) {
        $this->db->where('id_result_chromagar_pa', $id);
        $this->db->update('salmonella_sample_purple_colony_plate_chromagar_pa', $data);
    }

    function insertResultsBiochemical($data) {
        $this->db->insert('salmonella_result_biochemical_pa', $data);
        return $this->db->insert_id();
    }
    
    function get_by_id_biochemical($id)
    {
        $this->db->where('id_result_biochemical_pa', $id);
        $this->db->where('flag', '0');
        return $this->db->get('salmonella_result_biochemical_pa')->row();
    }

    function updateResultsBiochemical($id_result_biochemical_pa, $data) {
        $this->db->where('id_result_biochemical_pa', $id_result_biochemical_pa);
        $this->db->update('salmonella_result_biochemical_pa', $data);
    }

    function update_salmonella_pa($id_one_water_sample, $data)
    {
        $this->db->where('id_one_water_sample', $id_one_water_sample);
        $this->db->update('salmonella_pa', $data);
    }

    function updateCancel($id, $data)
    {
        $this->db->where('id_one_water_sample', $id);
        $this->db->update('salmonella_pa', $data);

        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    // Methods for autoGenerateChromagarResults functionality
    function get_black_plates_by_xld_agar($id_result_xld_agar_pa) {
        $this->db->where('id_result_xld_agar_pa', $id_result_xld_agar_pa);
        $this->db->where('flag', '0');
        return $this->db->get('salmonella_sample_black_colony_plate_xld_agar_pa')->result();
    }

    function get_chromagar_by_salmonella_pa($id_salmonella_pa) {
        $this->db->where('id_salmonella_pa', $id_salmonella_pa);
        $this->db->where('flag', '0');
        return $this->db->get('salmonella_result_chromagar_pa')->result();
    }

    // Methods for cascade delete functionality
    function get_chromagar_by_xld_agar_id($id_salmonella_pa) {
        $this->db->where('id_salmonella_pa', $id_salmonella_pa);
        $this->db->where('flag', '0');
        return $this->db->get('salmonella_result_chromagar_pa')->result();
    }

    function get_biochemical_by_chromagar_id($id_result_chromagar_pa) {
        $this->db->where('id_result_chromagar_pa', $id_result_chromagar_pa);
        $this->db->where('flag', '0');
        return $this->db->get('salmonella_result_biochemical_pa')->result();
    }

    function delete_chromagar_by_salmonella_pa($id_salmonella_pa) {
        $data = array('flag' => 1);

        // Get all Chromagar results first before updating
        $chromagar_results = $this->get_chromagar_by_salmonella_pa($id_salmonella_pa);

        // Delete Chromagar records
        $this->db->where('id_salmonella_pa', $id_salmonella_pa);
        $this->db->where('flag', '0');
        $this->db->update('salmonella_result_chromagar_pa', $data);

        // Delete Purple plates for each Chromagar using existing method
        foreach ($chromagar_results as $chromagar) {
            $this->delete_purple_plates_chromagar($chromagar->id_result_chromagar_pa);
        }

        return count($chromagar_results);
    }

    function delete_biochemical_by_chromagar_id($id_result_chromagar_pa) {
        $data = array('flag' => 1);
        $this->db->where('id_result_chromagar_pa', $id_result_chromagar_pa);
        $this->db->where('flag', '0');
        $this->db->update('salmonella_result_biochemical_pa', $data);
        return $this->db->affected_rows();
    }

    function getXldAgarResults($id_salmonella_pa) {
        $this->db->select('rxap.*, GROUP_CONCAT(sgpp.black_colony_plate ORDER BY sgpp.plate_number SEPARATOR ", ") AS black_colony_plate');
        $this->db->from('salmonella_result_xld_agar_pa AS rxap');
        $this->db->join('salmonella_sample_black_colony_plate_xld_agar_pa AS sgpp', 'rxap.id_result_xld_agar_pa = sgpp.id_result_xld_agar_pa', 'left');
        $this->db->where('rxap.id_salmonella_pa', $id_salmonella_pa);
        $this->db->where('rxap.flag', '0');
        $this->db->group_by('rxap.id_result_xld_agar_pa');
        $query = $this->db->get();
        return $query->result();
    }

    function getChromagarResults($id_salmonella_pa) {
        $this->db->select('rcap.*, GROUP_CONCAT(scpp.purple_colony_plate ORDER BY scpp.plate_number SEPARATOR ", ") AS purple_colony_plate');
        $this->db->from('salmonella_result_chromagar_pa AS rcap');
        $this->db->join('salmonella_sample_purple_colony_plate_chromagar_pa AS scpp', 'rcap.id_result_chromagar_pa = scpp.id_result_chromagar_pa', 'left');
        $this->db->where('rcap.id_salmonella_pa', $id_salmonella_pa);
        $this->db->where('rcap.flag', '0');
        $this->db->group_by('rcap.id_result_chromagar_pa');
        $query = $this->db->get();
        return $query->result();
    }

    function autoGenerateBiochemicalResults($id_salmonella_pa) {
        // Get XLD and Chromagar results
        $xld_results = $this->getXldAgarResults($id_salmonella_pa);
        $chromagar_results = $this->getChromagarResults($id_salmonella_pa);
        
        if (empty($xld_results) || empty($chromagar_results)) {
            return false; // Cannot generate without both results
        }

        // Determine if we have any positive results
        $xld_has_positive = false;
        $chromagar_has_positive = false;

        // Check XLD results for any black colony = 1
        foreach ($xld_results as $xld) {
            if (!empty($xld->black_colony_plate)) {
                $black_colonies = explode(', ', $xld->black_colony_plate);
                if (in_array('1', $black_colonies)) {
                    $xld_has_positive = true;
                    break;
                }
            }
        }

        // Check Chromagar results for any purple colony = 1
        foreach ($chromagar_results as $chromagar) {
            if (!empty($chromagar->purple_colony_plate)) {
                $purple_colonies = explode(', ', $chromagar->purple_colony_plate);
                if (in_array('1', $purple_colonies)) {
                    $chromagar_has_positive = true;
                    break;
                }
            }
        }

        // Apply business logic to determine confirmation value
        $confirmation = '';

        if (!$xld_has_positive && !$chromagar_has_positive) {
            // XLD (0) + Chromagar (0) = Not detected
            $confirmation = 'Not detected';
        } else if ($xld_has_positive && !$chromagar_has_positive) {
            // XLD (1) + Chromagar (0) = Not detected
            $confirmation = 'Not detected';
        } else if (!$xld_has_positive && $chromagar_has_positive) {
            // XLD (0) + Chromagar (1) = Not detected
            $confirmation = 'Not detected';
        } else if ($xld_has_positive && $chromagar_has_positive) {
            // XLD (1) + Chromagar (1) = Detected
            $confirmation = 'Detected';
        }

        // Check if biochemical result already exists for this salmonella_pa
        $this->db->where('id_salmonella_pa', $id_salmonella_pa);
        $this->db->where('flag', '0');
        $existing = $this->db->get('salmonella_result_biochemical_pa')->row();

        if ($existing) {
            // Update existing record
            $data = array(
                'confirmation' => $confirmation,
                'date_updated' => date('Y-m-d H:i:s'),
            );
            
            $this->db->where('id_result_biochemical_pa', $existing->id_result_biochemical_pa);
            $this->db->update('salmonella_result_biochemical_pa', $data);
            
            return 'updated';
        } else {
            // Create new record - get the first chromagar result ID for reference
            $first_chromagar = reset($chromagar_results);
            
            $data = array(
                'id_salmonella_pa' => $id_salmonella_pa,
                'id_result_chromagar_pa' => $first_chromagar->id_result_chromagar_pa,
                'confirmation' => $confirmation,
                'biochemical_tube' => '1', // Default tube number
                'flag' => '0',
                'lab' => $this->session->userdata('lab'),
                'uuid' => $this->uuid->v4(),
                'user_created' => $this->session->userdata('id_users'),
                'date_created' => date('Y-m-d H:i:s'),
            );
            
            $this->db->insert('salmonella_result_biochemical_pa', $data);
            return 'created';
        }
    }

    function checkAndAutoGenerateBiochemical($id_salmonella_pa) {
        // Check if both XLD and Chromagar results exist
        $xld_count = $this->db->where('id_salmonella_pa', $id_salmonella_pa)
                             ->where('flag', '0')
                             ->count_all_results('salmonella_result_xld_agar_pa');
                             
        $chromagar_count = $this->db->where('id_salmonella_pa', $id_salmonella_pa)
                                   ->where('flag', '0')
                                   ->count_all_results('salmonella_result_chromagar_pa');
        
        if ($xld_count > 0 && $chromagar_count > 0) {
            return $this->autoGenerateBiochemicalResults($id_salmonella_pa);
        }
        
        return false;
    }
      
}

/* End of file Tbl_delivery_model.php */
/* Location: ./application/models/Tbl_delivery_model.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2022-12-14 03:38:42 */
/* http://harviacode.com */