<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Sample_reception_model extends CI_Model
{

    public $table = 'sample_reception';
    public $id = 'id_project';
    public $order = 'DESC';
    function __construct()
    {
        parent::__construct();
    }

    public function json() {
        $this->datatables->select('NULL AS toggle, sr.id_project, sr.client_quote_number, sr.client, sr.id_client_sample, COALESCE(cc.client_name, sr.client, "Unknown Client") as client_name, sr.id_client_contact, sr.number_sample, sr.comments, sr.files, sr.date_collected, sr.time_collected, 
            sr.date_created, sr.date_updated, sr.flag', FALSE);
            
        $this->datatables->from('sample_reception sr');
        $this->datatables->join('ref_client cc', 'sr.id_client_contact = cc.id_client_contact AND cc.flag = 0', 'left');
        $this->datatables->where('sr.flag', '0');
    
        $lvl = $this->session->userdata('id_user_level');
    
        // Kolom Toggle (Sisi Kiri)
        $this->datatables->add_column('toggle', 
            '<button type="button" class="btn btn-sm btn-primary toggle-child">
                <i class="fa fa-plus-square"></i>
            </button>', 
        'id_project');
    
        // Kolom Action
        if ($lvl == 4) {
            // Level 4 (ViewOnly) - Tidak ada button yang bisa diakses
            $this->datatables->add_column('action', '-', 'id_project');
        } else if ($lvl == 3) {
            // Level 3 (User) - Bisa akses print dan edit, tapi tidak delete
            $this->datatables->add_column('action', 
            anchor(site_url('sample_reception/rep_print/$1'), 
                '<i class="fa fa-print" aria-hidden="true"></i>', 
                array('class' => 'btn btn-warning btn-sm')) . 
            "
                " . anchor(site_url('sample_reception/rep_print2/$1'), 
                '<i class="fa fa-print" aria-hidden="true"></i>', 
                array('class' => 'btn btn-success btn-sm')) . 
            "
                " . '<button type="button" class="btn_edit btn btn-info btn-sm">
                    <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                </button>', 'id_project');
        } else {
            // Level 1 (Super Admin) dan Level 2 (Admin) - Bisa akses semua button
            $this->datatables->add_column('action', 
            anchor(site_url('sample_reception/rep_print/$1'), 
                '<i class="fa fa-print" aria-hidden="true"></i>', 
                array('class' => 'btn btn-warning btn-sm')) . 
            "
                " . anchor(site_url('sample_reception/rep_print2/$1'), 
                '<i class="fa fa-print" aria-hidden="true"></i>', 
                array('class' => 'btn btn-success btn-sm')) . 
            "
                " . '<button type="button" class="btn_edit btn btn-info btn-sm">
                    <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                </button>' . " 
                " . '<button type="button" class="btn_delete btn btn-danger btn-sm" data-id="$1">
                    <i class="fa fa-trash-o" aria-hidden="true"></i>
                </button>', 'id_project');
        }
    
        $this->db->order_by('sr.date_created', 'DESC');
    
        return $this->datatables->generate();
    }

    function subjson($id) {
            $this->datatables->select("
            testing.id_testing, 
            testing.id_sample, 
            testing.id_testing_type, 
            sample.id_one_water_sample, 
            testing.barcode, 
            retest.testing_type AS testing_type, 
            retest.url, 
            COALESCE(bank.user_review, campy.user_review, salmonellaL.user_review, salmonellaB.user_review, ec.user_review, el.user_review, em.user_review, cb.user_review, mc.user_review, ewi.user_review, ebi.user_review, cbi.user_review, cwi.user_review, pr.user_review) AS user_review, 
            COALESCE(bank.review, campy.review, salmonellaL.review, salmonellaB.review, ec.review, el.review, em.review, cb.review, mc.review, ewi.review, ebi.review, cbi.review, cwi.review, pr.review) AS review, 
            tbl_user.full_name, 
            testing.flag
        ");
        $this->datatables->from('sample_reception_testing testing');
        $this->datatables->join('ref_testing retest', 'FIND_IN_SET(retest.id_testing_type, testing.id_testing_type)', 'left');
        $this->datatables->join('sample_reception_sample sample', 'sample.id_sample = testing.id_sample', 'left');
        $this->datatables->join('biobank_in bank', 'bank.biobankin_barcode = testing.barcode', 'left');
        $this->datatables->join('campy_liquids campy', 'campy.campy_assay_barcode = testing.barcode', 'left');
        $this->datatables->join('salmonella_liquids salmonellaL', 'salmonellaL.salmonella_assay_barcode = testing.barcode', 'left');
        $this->datatables->join('salmonella_biosolids salmonellaB', 'salmonellaB.salmonella_assay_barcode = testing.barcode', 'left');
        $this->datatables->join('extraction_culture ec', 'ec.extraction_barcode = testing.barcode', 'left');
        $this->datatables->join('extraction_liquid el', 'el.extraction_barcode = testing.barcode', 'left');
        $this->datatables->join('extraction_metagenome em', 'em.extraction_barcode = testing.barcode', 'left');
        $this->datatables->join('campy_biosolids cb', 'cb.campy_assay_barcode = testing.barcode', 'left');
        $this->datatables->join('moisture_content mc', 'mc.barcode_moisture_content = testing.barcode', 'left');
        $this->datatables->join('enterolert_water_in ewi', 'ewi.enterolert_barcode = testing.barcode', 'left');
        $this->datatables->join('enterolert_biosolids_in ebi', 'ebi.enterolert_barcode = testing.barcode', 'left');
        $this->datatables->join('colilert_biosolids_in cbi', 'cbi.colilert_barcode = testing.barcode', 'left');
        $this->datatables->join('colilert_water_in cwi', 'cwi.colilert_barcode = testing.barcode', 'left');
        $this->datatables->join('protozoa pr', 'pr.protozoa_barcode = testing.barcode', 'left');
        $this->datatables->join('tbl_user', 'tbl_user.id_users = COALESCE(bank.user_review, campy.user_review, salmonellaL.user_review, salmonellaB.user_review, ec.user_review, el.user_review, em.user_review, cb.user_review, mc.user_review, ewi.user_review, ebi.user_review, cbi.user_review, cwi.user_review, pr.user_review)', 'left');
        $this->datatables->where('testing.flag', '0');
        $this->datatables->where('testing.id_sample', $id);
        $this->datatables->group_by('testing.id_testing');
        $lvl = $this->session->userdata('id_user_level');
        if ($lvl == 4){
            $this->datatables->add_column('action', '-', 'id_testing');
        }
        else if ($lvl == 3){
            $this->datatables->add_column('action', '-', 'id_testing');
            // $this->datatables->add_column('action', '<button type="button" class="btn_edit_det btn btn-info btn-sm" aria-hidden="true"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>', 'id_testing');
        }
        else {
            $this->datatables->add_column('action', ''." 
               ".'<button type="button" class="btn_delete btn btn-danger btn-sm" data-id="$1" aria-hidden="true"><i class="fa fa-trash-o" aria-hidden="true"></i></button>', 'id_testing');
               
        }
        return $this->datatables->generate();
    }

    // function get_rep($id)
    // {
    //     $q = $this->db->query('SELECT a.report_number, a.report_date, a.id_project, a.client, 
    //     d.client_name, d.address, d.phone1, d.phone2, d.email, 
    //     a.client_quote_number, a.po_number, 
    //     DATE_FORMAT(e.from_date, "%d-%b-%Y") AS from_date,
    //     DATE_FORMAT(e.to_date, "%d-%b-%Y") AS to_date,
    //     b.date_arrival, b.time_arrival,
    //     a.id_client_sample, b.id_one_water_sample,  b.id_person, c.realname
    //     FROM sample_reception a
    //     LEFT JOIN sample_reception_sample b ON a.id_project = b.id_project
    //     LEFT JOIN ref_person c ON b.id_person = c.id_person
    // 			LEFT JOIN ref_client d ON a.id_client_contact = d.id_client_contact
    // 			LEFT JOIN 
    // 			(SELECT id_project, MIN(date_arrival) AS from_date, MAX(date_arrival) AS to_date 
    // 				FROM sample_reception_sample
    // 				GROUP BY id_project) e ON e.id_project = b.id_project
    //     WHERE a.id_project="'.$id.'"
    //     AND a.flag = 0 
    //     ');        
    //     $response = $q->row();
    //     return $response;
    //   }

    function get_rep($id)
    {
        $this->db->select('a.report_number, a.report_date, a.id_project, a.client, 
                            COALESCE(d.client_name, a.client, "Unknown Client") as client_name, d.address, d.phone1, d.phone2, d.email, 
                            a.client_quote_number, a.po_number, 
                            DATE_FORMAT(e.from_date, "%d-%b-%Y") AS from_date,
                            DATE_FORMAT(e.to_date, "%d-%b-%Y") AS to_date,
                            b.date_arrival, b.time_arrival,
                            a.id_client_sample, b.id_one_water_sample, b.id_person, c.realname', FALSE);
        $this->db->from('sample_reception a');
        $this->db->join('sample_reception_sample b', 'a.id_project = b.id_project', 'left');
        $this->db->join('ref_person c', 'b.id_person = c.id_person', 'left');
        $this->db->join('ref_client d', 'a.id_client_contact = d.id_client_contact AND d.flag = 0', 'left');
        $this->db->join('(SELECT id_project, MIN(date_arrival) AS from_date, MAX(date_arrival) AS to_date 
                           FROM sample_reception_sample
                           GROUP BY id_project) e', 'e.id_project = a.id_project', 'left');
        $this->db->where('a.id_project', $id);
        $this->db->where('a.flag', '0');
        $q = $this->db->get(); 
        $response = $q->row();
        return $response;
    }

    function generate_new_report_number() {
        $current_year_short = date('y');
        $prefix = 'M' . $current_year_short;

    
        $this->db->select('MAX(CAST(SUBSTRING(report_number, 5) AS UNSIGNED)) AS max_sequence');
        $this->db->where('report_number REGEXP "^M[0-9]{2}-[0-9]{5}$"'); 

        $this->db->where('SUBSTRING(report_number, 2, 2) =', $current_year_short); 


        $query = $this->db->get($this->table);
        $result = $query->row();

        $next_sequence = 1;
        if ($result && $result->max_sequence !== null) {
            $next_sequence = $result->max_sequence + 1;
        }
        return $prefix . '-' . sprintf('%05d', $next_sequence);
    }

    function update_report_details_if_empty($id_project, $report_number_to_save, $report_date_to_save) {
        $this->db->select('report_number, report_date');
        $this->db->where($this->id, $id_project);
        $query = $this->db->get($this->table);
        $row = $query->row();
    
        if ($row) {
            $update_data = array(); 
            $needs_update = false;
    
            if (empty($row->report_number) || $row->report_number === null || $row->report_number === '') {
                $update_data['report_number'] = $report_number_to_save;
                $needs_update = true; 
            }
            if (empty($row->report_date) || $row->report_date === null || $row->report_date === '' || trim($row->report_date) === '0000-00-00') {
                $update_data['report_date'] = $report_date_to_save; 
                $needs_update = true; 
            }

            if ($needs_update) {
                $this->db->where($this->id, $id_project);
                $this->db->update($this->table, $update_data); 
                return $this->db->affected_rows() > 0; 
            }
        }
        
        return false; 
    }
    
    function get_by_id($id)
    {
        $this->db->where($this->id, $id);
        $this->db->where('flag', '0');
        // $this->db->where('lab', $this->session->userdata('lab'));
        return $this->db->get($this->table)->row();
    }

    function get_by_id_sample($id_one_water_sample)
    {
        $this->db->where('id_one_water_sample', $id_one_water_sample);
        $this->db->where('flag', '0');
        // $this->db->where('lab', $this->session->userdata('lab'));
        return $this->db->get('sample_reception_sample')->row();
    }

    function get_by_id_detail($id)
    {
        $this->db->where('id_testing', $id);
        $this->db->where('flag', '0');
        // $this->db->where('lab', $this->session->userdata('lab'));
        return $this->db->get('sample_reception_testing')->row();
    }

    // Function get detail2 by id
    // function get_by_id_detail2($id)
    // {
    //     $this->db->where('testing_id', $id);
    //     $this->db->where('flag', '0');
    //     return $this->db->get('sample_reception_testing')->row();
    // }

    function get_detail($id)
    {
      $response = array();
      $this->db->select('sample_reception_sample.id_sample, sample_reception_sample.id_project,sample_reception_sample.id_one_water_sample, sample_reception_sample.date_collected, sample_reception_sample.time_collected, sample_reception_sample.date_created,
        ref_person.initial, ref_sampletype.sampletype, sample_reception_sample.quality_check, sample_reception_sample.comments, sample_reception_sample.date_arrival, sample_reception_sample.time_arrival');
      $this->db->join('ref_sampletype', 'sample_reception_sample.id_sampletype = ref_sampletype.id_sampletype', 'left');
      $this->db->join('ref_person', 'sample_reception_sample.id_person=ref_person.id_person', 'left');
      $this->db->where('sample_reception_sample.id_one_water_sample', $id);
      $this->db->where('sample_reception_sample.flag', '0');
      $q = $this->db->get('sample_reception_sample');
      $response = $q->row();
      return $response;
    }

    function get_detail2($id)
    {
      $response = array();
      $this->db->select('*');
      $this->db->where('sample_reception_testing.id_testing', $id);
      $this->db->where('sample_reception_testing.flag', '0');
      $q = $this->db->get('sample_reception_testing');
      $response = $q->row();
      return $response;
    }
   
    // Function to get the latest project_id
    // public function generate_project_id() {
    //     $latest_id = $this->get_latest_project_id();
    //     if ($latest_id) {
    //         $parts = explode('-', $latest_id);
    //         $number = intval($parts[1]) + 1;
    //         $new_id = sprintf('%s-%05d', '24', $number);
    //         return $new_id;
    //     } else {
    //         // If there is no previous project_id, start from '24-00001'
    //         return '24-00001';
    //     }
    // }
    public function get_latest_project_id() {
        $this->db->select('id_project');
        $this->db->order_by('id_project', 'DESC');
        $this->db->limit(1);
        $query = $this->db->get('sample_reception');

        if ($query->num_rows() > 0) {
            return $query->row()->id_project;
        } else {
            return null;
        }
    }

    // Function to generate the next id_project
    public function generate_project_id() {
        $latest_id = $this->get_latest_project_id();
        $current_year = date('y'); // Get two last digits of current year
        $prefix = 'MU' . $current_year; // Prefix consist of MU and two last digits of current year
    
        if ($latest_id) {
            if (strpos($latest_id, $prefix) === 0) {
                $number = intval(substr($latest_id, strlen($prefix))) + 1;
            } else {
                $number = 1;
            }
        } else {
            $number = 1;
        }
        $new_id = sprintf('%s%05d', $prefix, $number);
        return $new_id;
    }

    // Function to get the latest client
    public function get_latest_client() {
        $this->db->select('client');
        $this->db->order_by('id_project', 'DESC');
        $this->db->limit(1);
        $query = $this->db->get('sample_reception');

        // Check if there is a previous client
        if ($query->num_rows() > 0) {
            return $query->row()->client;
        } else {
            return null;
        }
    }

    // Function to generate the next client
    // public function generate_client() {
    //     $latest_id = $this->get_latest_client();
    //     $prefix = 'CLT'; // Prefix consist of CLT

    //     if ($latest_id) {
    //         if (strpos($latest_id, $prefix) === 0) {
    //             $number = intval(substr($latest_id, strlen($prefix))) + 1;
    //         } else {
    //             $number = 1;
    //         }
    //     } else {
    //         $number = 1;
    //     }
    //     $new_id = sprintf('%s%05d', $prefix, $number);
    //     return $new_id;

    // }

    // Function to get the latest id_one_water_sample
    public function get_latest_one_water_sample_id() {
        // Ambil tahun saat ini (dua digit terakhir)
        $current_year = date('y');
    
        // Query SQL dinamis berdasarkan tahun saat ini
        $sql = "SELECT id_one_water_sample
                FROM sample_reception_sample
                WHERE flag = '0'
                  AND id_one_water_sample LIKE CONCAT('P', ?, '%')
                ORDER BY CAST(SUBSTRING(id_one_water_sample, 4) AS UNSIGNED) DESC
                LIMIT 1";
    
        // Menjalankan query dengan parameter tahun dinamis
        $query = $this->db->query($sql, array($current_year));
    
        // Memeriksa apakah ada hasil
        if ($query->num_rows() > 0) {
            return $query->row()->id_one_water_sample;
        } else {
            return null;
        }
    }

    // Function to generate the next one_water_sample_id
    public function generate_one_water_sample_id() {
        $latest_id = $this->get_latest_one_water_sample_id();
        $current_year = date('y'); // Get two last digits of current year
        $prefix = 'P' . $current_year; // Prefix consist of P and two last digits of current year

        if ($latest_id) {
            if (strpos($latest_id, $prefix) === 0) {
                $number = intval(substr($latest_id, strlen($prefix))) + 1;
            } else {
                $number = 1;
            }
        } else {
            $number = 1;
        }
        $new_id = sprintf('%s%05d', $prefix, $number);
        return $new_id;

    }
    

    // Fuction insert data
    // public function insert($data) {
    //     $data['id_project'] = $this->generate_project_id();
    //     $this->db->insert('sample_reception',  $data);
    // }
    
    public function insert($data) {
        $data['id_project'] = $this->generate_project_id();
        $this->db->insert('sample_reception', $data);
        return $data['id_project']; // Mengembalikan ID project yang baru dibuat
    }
    
    public function insert_sample($data) {
        $this->db->insert('sample_reception_sample', $data);
    }

    // Function update data
    function update($id, $data)
    {
        $this->db->where('id_project', $id);
        $this->db->update('sample_reception', $data);
    }

    // function update_sample($id_one_water_sample, $data)
    // {
    //     $this->db->where('id_one_water_sample', $id_one_water_sample);
    //     $this->db->update('sample_reception_sample', $data);
    // }

    public function update_sample($id_one_water_sample, $data) {
        $this->db->where('id_one_water_sample', $id_one_water_sample);
        $this->db->update('sample_reception_sample', $data);
        
        return $this->db->affected_rows() > 0; // Return true jika update berhasil
    }
    

    // function insert_det($data)
    // {
    //     $this->db->insert('sample_reception_sample', $data);
    // }

    // function insert_barcode($data) {
    //     $this->db->insert('ref_barcode', $data);
    // }
    
    // function update_det($id, $data)
    // {
    //     $this->db->where('sample_id', $id);
    //     $this->db->update('sample_reception_sample', $data);
    // }

    // function update_barcode($id, $data)
    // {
    //     $this->db->where('barcode_id', $id);
    //     $this->db->update('ref_barcode', $data);
    // }

    function insert_det($data) {
        $this->db->insert('sample_reception_testing', $data);
        return $this->db->insert_id(); // Return the ID of the newly inserted row
    }

    function update_det($id, $data) {
        $this->db->where('id_testing', $id);
        $this->db->update('sample_reception_testing', $data);
    }

    function insert_barcode($data) {
        $this->db->insert('ref_barcode', $data);
    }

    function update_barcode($id_testing, $id_testing_type, $data) {
        $this->db->where('id_testing', $id_testing);
        $this->db->where('id_testing_type', $id_testing_type);
        $this->db->update('ref_barcode', $data);
    }

    function delete_barcode($id_testing) {
        $this->db->delete('ref_barcode', array('id_testing' => $id_testing));
    }


    // delete data
    function delete($id)
    {
        $this->db->where($this->id, $id);
        $this->db->delete($this->table);
    }

    function delete_detail($id)
    {
        $this->db->where($this->id, $id);
        $this->db->delete($this->table);
    }
    

    function getSampleType(){
        $response = array();
        $this->db->select('*');
        $this->db->where('flag', '0');
        $this->db->order_by('id_sampletype', 'ASC');
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

      function getTest(){
        $response = array();
        $this->db->select('*');
        $this->db->where('flag', '0');
        $q = $this->db->get('ref_testing');
        $response = $q->result_array();
        return $response; 

        // $response = array();
        // $this->db->select('rt.testing_type_id, rt.testing_type');
        // $this->db->from('ref_testing rt');
        // $this->db->join('sample_reception_sample srs', 'rt.testing_type_id = srs.testing_type_id', 'left');
        // $this->db->where('rt.flag', '0');
        // // $this->db->where('srs.testing_type_id IS NULL');
        // $q = $this->db->get();
        // $response = $q->result_array();
        // return $response;
      }

    public function get_last_barcode($testing_type) {
        // Get prefix and format from database
        $this->db->select('prefix');
        $this->db->where('testing_type', $testing_type);
        $query = $this->db->get('ref_testing');
        $result = $query->row();

        if (!$result || $result->prefix === null) {
            return null; // Testing type not found or prefix is null
        }
        $prefix = $result->prefix;
        
        // Get the current year
        $year = date('y');

        $this->db->select_max('CAST(SUBSTR(barcode, ' . (strlen($prefix . $year) + 1) . ') AS UNSIGNED)', 'max_barcode');
        $this->db->like('barcode', $prefix . $year, 'after');
        // $query = $this->db->get('ref_barcode');
        $query = $this->db->get('sample_reception_testing');
        $result = $query->row();
    
        $next_number = $result->max_barcode + 1;
        $padded_number = str_pad($next_number, 5, '0', STR_PAD_LEFT);
        return $prefix . $year . $padded_number;
    }
    
    

    public function get_name_by_id($id) {
        $this->db->select('testing_type');
        $this->db->where('id_testing_type', $id);
        $query = $this->db->get('ref_testing');
        $result = $query->row();
        return $result ? $result->testing_type : null;
    }


    public function get_sample_testing($id) {
        $response = array();
        $this->db->select('*');
        $this->db->where('id_testing', $id);
        $query = $this->db->get('sample_reception_testing');
        $response = $query->result_array();
        return $response; 
    }

    function validateIdClientSample($id){
        $q = $this->db->query('
        SELECT id_client_sample FROM sample_reception
        WHERE id_client_sample = "'.$id.'"
        AND flag = 0 
        ');        
        $response = $q->result_array();
        return $response;
    }

    function get_all() {
        $this->db->select('
            sr.id_project,
            sr.client_quote_number, 
            sr.client, 
            sr.id_client_sample,
            srs.id_one_water_sample,
            rs.sampletype, 
            rp.initial,
            srs.date_arrival, 
            srs.time_arrival, 
            srs.date_collected, 
            srs.time_collected, 
            srs.comments as note,
            (CASE srs.quality_check WHEN 0 THEN "unchecked" WHEN 1 THEN "checked" WHEN 2 THEN "crossed" ELSE "unknown" END) AS quality_checked,
            srt.barcode, 
            rt.testing_type
        ');
        $this->db->from('sample_reception AS sr');
        $this->db->join('sample_reception_sample AS srs', 'sr.id_project = srs.id_project', 'LEFT');
        $this->db->join('ref_person AS rp', 'srs.id_person = rp.id_person', 'LEFT');
        $this->db->join('ref_sampletype AS rs', 'srs.id_sampletype = rs.id_sampletype', 'LEFT');
        $this->db->join('sample_reception_testing AS srt', 'srs.id_sample = srt.id_sample', 'LEFT');
        $this->db->join('ref_testing AS rt', 'srt.id_testing_type = rt.id_testing_type', 'LEFT');
        $this->db->where('srs.flag', 0);
        $this->db->where('sr.flag', 0);
        $this->db->order_by('sr.id_project', 'DESC');
        return $this->db->get()->result();
    }


    // public function get_samples_by_project($id_project) {
    //     $this->db->select('id_one_water_sample, date_collected, time_collected, date_created');
    //     $this->db->from('sample_reception_sample');
    //     $this->db->where('id_project', $id_project);
    //     return $this->db->get()->result();
    // }

    public function get_samples_by_project($id_project) {
        $this->db->select('sample_reception_sample.id_one_water_sample, sample_reception_sample.id_project, sample_reception_sample.date_collected, sample_reception_sample.time_collected, sample_reception_sample.date_created,
        ref_person.initial, ref_sampletype.sampletype, sample_reception_sample.quality_check, sample_reception_sample.comments, sample_reception_sample.date_arrival, sample_reception_sample.time_arrival');
        $this->db->join('ref_sampletype', 'sample_reception_sample.id_sampletype = ref_sampletype.id_sampletype', 'left');
        $this->db->join('ref_person', 'sample_reception_sample.id_person=ref_person.id_person', 'left');
        $this->db->from('sample_reception_sample');
        $this->db->where('sample_reception_sample.id_project', $id_project);
        $this->db->where('sample_reception_sample.flag', '0');
        $this->db->order_by('sample_reception_sample.id_sample', 'ASC');
        $query = $this->db->get()->result();
    
        $lvl = $this->session->userdata('id_user_level');
    
        foreach ($query as $row) {
            if ($lvl == 4) {
                // Level 4 (ViewOnly) - Tidak ada button yang bisa diakses
                $row->action = '
                    <a href="' . site_url('sample_reception/read/' . $row->id_one_water_sample) . '" class="btn btn-warning btn-sm">
                        <i class="fa fa-eye"></i>
                    </a>';
            } else if ($lvl == 3) {
                // Level 3 (User) - Bisa akses view dan edit, tapi tidak delete
                $row->action = '
                    <a href="' . site_url('sample_reception/read/' . $row->id_one_water_sample) . '" class="btn btn-warning btn-sm">
                        <i class="fa fa-eye"></i>
                    </a>
                    <button class="btn btn-info btn-sm btn_edit_sample" data-id="' . $row->id_one_water_sample . '">
                        <i class="fa fa-pencil"></i>
                    </button>';
            } else {
                // Level 1 (Super Admin) dan Level 2 (Admin) - Bisa akses semua button
                $row->action = '
                    <a href="' . site_url('sample_reception/read/' . $row->id_one_water_sample) . '" class="btn btn-warning btn-sm">
                        <i class="fa fa-eye"></i>
                    </a>
                    <button class="btn btn-info btn-sm btn_edit_sample" data-id="' . $row->id_one_water_sample . '">
                        <i class="fa fa-pencil"></i>
                    </button>
                    <button class="btn btn-danger btn-sm btn_delete_sample" data-id="' . $row->id_one_water_sample . '">
                        <i class="fa fa-trash"></i>
                    </button>';
            }
        }
    
        return $query;
    }


    public function get_sample_detail($id_one_water_sample) {
        $this->db->select('srs.id_one_water_sample, srs.date_arrival, srs.time_arrival,  srs.date_collected, srs.time_collected,
            srs.quality_check, srs.comments, srs.id_sampletype, 
            rst.sampletype, srs.id_person, rp.initial');
        $this->db->from('sample_reception_sample srs');
        $this->db->join('ref_sampletype rst', 'srs.id_sampletype = rst.id_sampletype', 'left');
        $this->db->join('ref_person rp', 'srs.id_person = rp.id_person', 'left');
        $this->db->where('srs.id_one_water_sample', $id_one_water_sample);
        $this->db->where('srs.flag', '0');
        
        $query = $this->db->get();
    
        if ($query->num_rows() > 0) {
            echo json_encode($query->row());
        } else {
            echo json_encode(["error" => "Data tidak ditemukan"]);
        }
    
        exit; // **Tambahkan ini untuk mencegah output tambahan**
    }


    function getClientContact() {
        $this->db->select('*');
        $this->db->where('flag', '0');
        $this->db->order_by('client_name');
        return $this->db->get('ref_client')->result_array();
    }
    
    
    
    
    
    // Get export data for CSV with real data from database
    public function get_export_data($id_project) {
        // First get basic project info
        $this->db->select('sr.*, COALESCE(cc.client_name, sr.client, "Unknown Client") as client_name, cc.address, cc.phone1, cc.email');
        $this->db->from('sample_reception sr');
        $this->db->join('ref_client cc', 'sr.id_client_contact = cc.id_client_contact AND cc.flag = 0', 'left');
        $this->db->where('sr.id_project', $id_project);
        $this->db->where('sr.flag', '0');
        $project = $this->db->get()->row_array();
        
        if (!$project) {
            return [];
        }

        // Get sample data with testing information
        $this->db->select('
            srs.id_one_water_sample,
            srs.date_collected,
            srs.time_collected,
            srs.date_arrival,
            srs.time_arrival,
            COALESCE(rst.sampletype, "Unknown Sample") as sampletype,
            COALESCE(rp.initial, "Unknown") as initial,
            srt.barcode,
            srt.id_testing_type,
            COALESCE(rt.testing_type, "Unknown Test") as testing_type,
            rt.prefix,
            cb.date_sample_processed, 
            cb.time_sample_processed
        ');
        $this->db->from('sample_reception_sample srs');
        $this->db->join('campy_biosolids cb', 'srs.id_one_water_sample = cb.id_one_water_sample AND cb.flag = 0', 'left');
        $this->db->join('ref_sampletype rst', 'srs.id_sampletype = rst.id_sampletype AND rst.flag = 0', 'left');
        $this->db->join('ref_person rp', 'srs.id_person = rp.id_person AND rp.flag = 0', 'left');
        $this->db->join('sample_reception_testing srt', 'srs.id_sample = srt.id_sample AND srt.flag = 0', 'left');
        $this->db->join('ref_testing rt', 'srt.id_testing_type = rt.id_testing_type AND rt.flag = 0', 'left');
        $this->db->where('srs.id_project', $id_project);
        $this->db->where('srs.flag', '0');
        $samples = $this->db->get()->result_array();

        $exportData = [];
        
        // If no samples found, create at least one row with project data to ensure CSV export works
        if (empty($samples)) {
            $samples = [[
                'id_one_water_sample' => $project['id_project'] ?? 'NO_SAMPLES', 
                'sampletype' => 'No Samples', 
                'testing_type' => 'No Testing',
                'initial' => 'Unknown',
                'date_collected' => null,
                'date_arrival' => null,
                'time_arrival' => null,
                'time_collected' => null,
                'date_sample_processed' => null,
                'time_sample_processed' => null
            ]];
        }

        foreach ($samples as $i => $sample) {
                $submittedMatrix = isset($sample['submitted_matrix']) ? $sample['submitted_matrix'] : $this->getSubmittedMatrix($sample['sampletype'] ?? '');
                $analysisMatrix = isset($sample['analysis_matrix']) ? $sample['analysis_matrix'] : $this->getAnalysisMatrix($sample['sampletype'] ?? '');
                $analysisMethodCategory = isset($sample['analysis_method_category']) ? $sample['analysis_method_category'] : $this->getAnalysisMethodCategory($sample['testing_type'] ?? '');
                $parameterName = isset($sample['parameter_name']) ? $sample['parameter_name'] : $this->getParameterName($sample['testing_type'] ?? '');
                $testKeyCode = substr($submittedMatrix, 0, 1) . '=' . substr($analysisMatrix, 0, 1) . '-' . $analysisMethodCategory . '/' . $parameterName;
            $row = [
                'ConfirmedRaw' => isset($sample['confirmed_raw']) ? $sample['confirmed_raw'] : '',
                'PresumptiveRaw' => isset($sample['presumptive_raw']) ? $sample['presumptive_raw'] : '',
                // 'PathogenID' => isset($sample['pathogen_id']) ? $sample['pathogen_id'] : 'EC00' . ($i + 1),
                'PathogenID' =>  '',
                'LOR' => isset($sample['lor']) ? $sample['lor'] : '',
                // 'MeasurementOfUncertainty' => isset($sample['measurement_uncertainty']) ? $sample['measurement_uncertainty'] : '±' . rand(15, 25) . '%',
                'MeasurementOfUncertainty' => '',
                // 'SURROGATE' => isset($sample['surrogate']) ? $sample['surrogate'] : rand(85, 115) . '%',
                'SURROGATE' => '',
                // 'RPD' => isset($sample['rpd']) ? $sample['rpd'] : rand(5, 15) . '%',
                'RPD' => '',
                // 'RESULTCOMMENT' => isset($sample['result_comment']) ? $sample['result_comment'] : 'Results within acceptable limits',
                'RESULTCOMMENT' => '',
                'RESULTSTATUS' => isset($sample['result_status']) ? $sample['result_status'] : '',
                // 'LabCOANo' => isset($sample['lab_coa_no']) ? $sample['lab_coa_no'] : 'COA-' . date('Y') . '-' . str_pad(rand(1, 999), 3, '0', STR_PAD_LEFT),
                'LabCOANo' => '',
                // 'LabCOADate' => isset($sample['lab_coa_date']) ? date('d-M-Y', strtotime($sample['lab_coa_date'])) : date('d-M-Y'),
                'LabCOADate' => '',
                // 'LabQAQCNo' => isset($sample['lab_qaqc_no']) ? $sample['lab_qaqc_no'] : 'QAQC-' . date('Y') . '-' . str_pad(rand(1, 99), 2, '0', STR_PAD_LEFT),
                'LabQAQCNo' => '',
                // 'LabQAQCDate' => isset($sample['lab_qaqc_date']) ? date('d-M-Y', strtotime($sample['lab_qaqc_date'])) : date('d-M-Y'),
                'LabQAQCDate' => '',
                // 'ReportComment' => isset($sample['report_comment']) ? $sample['report_comment'] : 'All analysis completed within specified timeframes. Results validated according to laboratory QA/QC procedures.',
                'ReportComment' => '',
                // 'SiteComment' => isset($sample['site_comment']) ? $sample['site_comment'] : 'Sampling conducted during normal flow conditions.',
                'SiteComment' => '',
                // 'License' => isset($sample['license']) ? $sample['license'] : 'NATA-' . rand(10000, 99999),
                'License' => '',
                'ANALYSISMETHODCATEGORY' => isset($sample['analysis_method_category']) ? $sample['analysis_method_category'] : $this->getAnalysisMethodCategory($sample['testing_type'] ?? ''),
                // 'ANALYSISMETHOD' =>  '-',
                'ANALYSISMETHOD' => isset($sample['analysis_method']) ? $sample['analysis_method'] : $this->getAnalysisMethod($sample['testing_type'] ?? ''),
                // 'SAMPLEDATE' => isset($sample['time_collected']) ? $sample['time_collected'] : '',
                'SAMPLEDATE' => (isset($sample['date_collected']) && isset($sample['time_collected']) && $sample['date_collected'] && $sample['time_collected']) ? 
                    date('d/m/Y H:i', strtotime($sample['date_collected'] . ' ' . $sample['time_collected'])) : '',
                'LABREGISTRATIONDATE' => (isset($sample['date_arrival']) && isset($sample['time_arrival']) && $sample['date_arrival'] && $sample['time_arrival']) ? 
                    date('d/m/Y H:i', strtotime($sample['date_arrival'] . ' ' . $sample['time_arrival'])) : '',
                'AnalysisDate' => (isset($sample['date_sample_processed']) && isset($sample['time_sample_processed']) && $sample['date_sample_processed'] && $sample['time_sample_processed'])
                    ? date('d/m/Y H:i', strtotime($sample['date_sample_processed'] . ' ' . $sample['time_sample_processed']))
                    : (isset($sample['date_sample_processed']) ? date('d/m/Y', strtotime($sample['date_sample_processed'])) : ''),
                'ANALYSISCOMPLETIONDATE' => (isset($sample['date_sample_processed']) && isset($sample['time_sample_processed']) && $sample['date_sample_processed'] && $sample['time_sample_processed'])
                    ? date('d/m/Y H:i', strtotime($sample['date_sample_processed'] . ' ' . $sample['time_sample_processed']))
                    : (isset($sample['date_sample_processed']) ? date('d/m/Y', strtotime($sample['date_sample_processed'])) : ''),
                // 'ParameterCode' => isset($sample['parameter_code']) ? $sample['parameter_code'] : $this->getParameterCode($sample['testing_type'] ?? ''),
                'ParameterCode' => '',
                'PARAMETERNAME' => isset($sample['parameter_name']) ? $sample['parameter_name'] : $this->getParameterName($sample['testing_type'] ?? ''),
                'TEST_KEY_CODE' => $testKeyCode,
                // 'TEST_KEY_CODE' => isset($sample['test_key_code']) ? $sample['test_key_code'] : '-',
                'RESULT' => isset($sample['result']) ? $sample['result'] : '-',
                'Units' => isset($sample['units']) ? $sample['units'] : $this->getUnits($sample['testing_type'] ?? ''),
                // 'POSITIVECONTROL%' => isset($sample['positive_control']) ? $sample['positive_control'] : rand(95, 105) . '%',
                'POSITIVECONTROL%' => '',
                'SAMPLEVOLUME' => isset($sample['sample_volume']) ? $sample['sample_volume'] : '',
                'SAMPLEVOLUMEUNITS' => isset($sample['sample_volume_units']) ? $sample['sample_volume_units'] : '',
                // 'SAMPLEPROCESSED%' => isset($sample['sample_processed']) ? $sample['sample_processed'] : rand(88, 100) . '%',
                'SAMPLEPROCESSED%' => '',
                'EDDVERSION' => '3.1',
                // 'CLIENTNAME' => $project['client_name'] ?? '-',
                'CLIENTNAME' => 'Melbourne Water',
                // 'SITEAREA' => isset($sample['site_area']) ? $sample['site_area'] : $this->generateSiteAreaCode($project['client_name'] ?? ''),
                'SITEAREA' => 'Water Supply',
                'PROGRAM' => isset($sample['program']) ? $sample['program'] : 'Scat Sampling',
                'WorkOrderNo' => '',
                // 'WorkOrderNo' => $project['client_quote_number'] ?? 'WO' . date('y') . str_pad(rand(1, 999), 3, '0', STR_PAD_LEFT),
                'SUBMISSION' => $project['id_project'] ?? '',
                'SAMPLINGPROVIDER' => isset($sample['sampling_provider']) ? $sample['sampling_provider'] : 'Monash OWL',
                // 'SamplerName' => $sample['initial'] ?? 'Lab Tech',
                'SamplerName' => '',
                // 'SamplingRunRef' => isset($sample['sampling_run_ref']) ? $sample['sampling_run_ref'] : 'SR' . date('ymd') . '-' . rand(10, 99),
                'SamplingRunRef' => '',
                // 'LOCATIONCODE' => isset($sample['location_code']) ? $sample['location_code'] : 'LOC00' . ($i + 1),
                'LOCATIONCODE' => isset($sample['location_code']) ? $sample['location_code'] : '',
                'LocationDescription' => isset($sample['location_description']) ? $sample['location_description'] : '',
                // 'LocationDescription' => isset($sample['location_description']) ? $sample['location_description'] : 'Sample Location ' . ($i + 1),
                // 'AnalysisPO' => isset($sample['analysis_po']) ? $sample['analysis_po'] : 'PO' . rand(1000, 9999),
                'AnalysisPO' => '',
                'LABCODE' => '',
                'LABSAMPLEID' => $sample['id_one_water_sample'] ?? 'LAB' . str_pad(rand(1000, 9999), 4, '0', STR_PAD_LEFT),
                // 'SAMPLETYPE' => $sample['sampletype'] ?? 'SAMPLE',
                'SAMPLETYPE' => 'Research',
                'SUBMITTEDMATRIX' => isset($sample['submitted_matrix']) ? $sample['submitted_matrix'] : $this->getSubmittedMatrix($sample['sampletype'] ?? ''),
                'ANALYSISMATRIX' => isset($sample['analysis_matrix']) ? $sample['analysis_matrix'] : $this->getAnalysisMatrix($sample['sampletype'] ?? ''),
                // 'ANALYSISSUBMATRIX' => isset($sample['analysis_submatrix']) ? $sample['analysis_submatrix'] : $this->getAnalysisSubMatrix($sample['sampletype'] ?? '')
                 'ANALYSISSUBMATRIX' => ''
            ];
            
            $exportData[] = $row;
        }
        
        return $exportData;
    }
    
    // Helper functions for data generation based on testing type
    private function getAnalysisMethodCategory($testing_type) {
        $categories = [
            'Biobank-In' => 'Biobank',
            'Colilert-Idexx-Water' => 'Colilert-Idexx-Water',
            'Enterolert-Idexx-Water' => 'Enterolert-Idexx-Water',
            'Moisture_content' => 'Moisture_content',
            'Homeflow' => 'Homeflow',
            'Colilert-Idexx-Biosolids' => 'Colilert-Idexx-Biosolids',
            'Enterolert-Idexx-Biosolids' => 'Enterolert-Idexx-Biosolids',
            'Extraction-Metagenome' => 'Extraction-Metagenome',
            'Extraction-Culture-Plate' => 'Extraction-Culture-Plate',
            'Extraction-Liquids' => 'Extraction-Liquids',
            'Campylobacter-Biosolids' => 'Campylobacter-Biosolids',
            'Salmonella-Biosolids' => 'Salmonella-Biosolids',
            'Extraction-Biosolids' => 'Extraction-Biosolids',
            'Salmonella-Liquids' => 'Salmonella-Liquids',
            'Campylobacter-Liquids' => 'Campylobacter-Liquids',
            'Campylobacter-QPCR' => 'Campylobacter-QPCR',
            'Campylobacter-P/A' => 'Campylobacter-P/A',
            'Campylobacter-MPN' => 'Campylobacter-MPN'
        ];

        
        foreach ($categories as $test => $category) {
            if (stripos($testing_type, $test) !== false) {
                return $category;
            }
        }
        return 'MICROBIOLOGICAL_INDICATORS';
    }
    
    private function getAnalysisMethod($testing_type) {
        $methods = [
            'Biobank-In' => 'BIOBANKING_STORAGE',
            'Colilert-Idexx-Water' => 'COLILERT_MPN_WATER',
            'Enterolert-Idexx-Water' => 'ENTEROLERT_MPN_WATER',
            'Moisture_content' => 'GRAVIMETRIC_105C',
            'Homeflow' => 'FLOW_MEASUREMENT',
            'Colilert-Idexx-Biosolids' => 'COLILERT_MPN_BIOSOLIDS',
            'Enterolert-Idexx-Biosolids' => 'ENTEROLERT_MPN_BIOSOLIDS',
            'Extraction-Metagenome' => 'DNA_EXTRACTION_METAGENOME',
            'Extraction-Culture-Plate' => 'DNA_EXTRACTION_CULTURE',
            'Extraction-Liquids' => 'DNA_EXTRACTION_LIQUID',
            'Campylobacter-Biosolids' => 'CULTURE_METHOD_BIOSOLIDS',
            'Salmonella-Biosolids' => 'CULTURE_METHOD_BIOSOLIDS',
            'Extraction-Biosolids' => 'DNA_EXTRACTION_BIOSOLIDS',
            'Salmonella-Liquids' => 'CULTURE_METHOD_LIQUID',
            'Campylobacter-Liquids' => 'CULTURE_METHOD_LIQUID',
            'Campylobacter-QPCR' => 'qPCR_REAL_TIME',
            'Campylobacter-P/A' => 'PRESENCE_ABSENCE_METHOD',
            'Campylobacter-MPN' => 'MPN_METHOD'
        ];
        
        foreach ($methods as $test => $method) {
            if (stripos($testing_type, $test) !== false) {
                return $method;
            }
        }
        return 'STANDARD_METHOD';
    }
    
    private function getParameterCode($testing_type) {
        $codes = [
            'Biobank-In' => 'BIO',
            'Colilert-Idexx-Water' => 'ECOLI_W',
            'Enterolert-Idexx-Water' => 'ENTERO_W',
            'Moisture_content' => 'MOIST',
            'Homeflow' => 'FLOW',
            'Colilert-Idexx-Biosolids' => 'ECOLI_B',
            'Enterolert-Idexx-Biosolids' => 'ENTERO_B',
            'Extraction-Metagenome' => 'META_EXT',
            'Extraction-Culture-Plate' => 'CULT_EXT',
            'Extraction-Liquids' => 'LIQ_EXT',
            'Campylobacter-Biosolids' => 'CAMPY_B',
            'Salmonella-Biosolids' => 'SALM_B',
            'Extraction-Biosolids' => 'BIO_EXT',
            'Salmonella-Liquids' => 'SALM_L',
            'Campylobacter-Liquids' => 'CAMPY_L',
            'Campylobacter-QPCR' => 'CAMPY_QPCR',
            'Campylobacter-P/A' => 'CAMPY_PA',
            'Campylobacter-MPN' => 'CAMPY_MPN'
        ];
        
        foreach ($codes as $test => $code) {
            if (stripos($testing_type, $test) !== false) {
                return $code;
            }
        }
        return 'PARAM';
    }
    
    private function getParameterName($testing_type) {
        $names = [
            'Biobank-In' => 'Biobank Storage',
            'Colilert-Idexx-Water' => 'Escherichia coli',
            'Enterolert-Idexx-Water' => 'Enterococci',
            'Moisture_content' => 'Moisture Content',
            'Homeflow' => 'Flow Rate',
            'Colilert-Idexx-Biosolids' => 'Escherichia coli',
            'Enterolert-Idexx-Biosolids' => 'Enterococci',
            'Extraction-Metagenome' => 'Metagenome DNA Extraction',
            'Extraction-Culture-Plate' => 'Culture Plate DNA Extraction',
            'Extraction-Liquids' => 'Liquid Sample DNA Extraction',
            'Campylobacter-Biosolids' => 'Campylobacter spp.',
            'Salmonella-Biosolids' => 'Salmonella spp.',
            'Extraction-Biosolids' => 'Biosolid DNA Extraction',
            'Salmonella-Liquids' => 'Salmonella spp.',
            'Campylobacter-Liquids' => 'Campylobacter spp.',
            'Campylobacter-QPCR' => 'Campylobacter spp. (qPCR)',
            'Campylobacter-P/A' => 'Campylobacter spp. (Presence/Absence)',
            'Campylobacter-MPN' => 'Campylobacter spp. (MPN)'
        ];
        
        foreach ($names as $test => $name) {
            if (stripos($testing_type, $test) !== false) {
                return $name;
            }
        }
        return 'Parameter';
    }
    
    private function getUnits($testing_type) {
        $units = [
            'Colilert' => 'MPN/100mL',
            'Enterolert' => 'MPN/100mL',
            'Campylobacter' => 'copies/g',
            'Salmonella' => '-',
            'Moisture' => '%'
        ];
        
        foreach ($units as $test => $unit) {
            if (stripos($testing_type, $test) !== false) {
                return $unit;
            }
        }
        return 'MPN/100mL';
    }
    
    private function getSubmittedMatrix($sampletype) {
        $matrices = [
            'Faeces' => 'Faeces',
            'Water' => 'Water',
            'Soil' => 'Soil',
            'Sediment' => 'Sediment',
            'Sewage_liquid' => 'Wastewater',
            'Bird_carcass' => 'Tissue',
            'Culture' => 'Culture',
            'Culture_plate' => 'Culture Plate',
            'Purified DNA' => 'Purified DNA',
            'Sawage_biosolid' => 'Sawage_biosolid',
            'Biosolid' => 'Biosolid',
            'Liquid' => 'Liquid',
            'Wastewater' => 'Wastewater'
        ];
        
        foreach ($matrices as $type => $matrix) {
            if (stripos($sampletype, $type) !== false) {
                return $matrix;
            }
        }
        return 'UNKNOWN_MATRIX';
    }
    
    private function getAnalysisMatrix($sampletype) {
        $matrices = [
            'Faeces' => 'Faeces',
            'Water' => 'Water',
            'Soil' => 'Soil',
            'Sediment' => 'Sediment',
            'Sewage_liquid' => 'Sewage_liquid',
            'Bird_carcass' => 'Bird_carcass',
            'Culture' => 'Culture',
            'Culture_plate' => 'Culture_plate',
            'Purified DNA' => 'Purified DNA',
            'Sawage_biosolid' => 'Sawage_biosolid',
            'Biosolid' => 'Biosolid',
            'Liquid' => 'Liquid',
            'Wastewater' => 'Wastewater'
        ];
        
        foreach ($matrices as $type => $matrix) {
            if (stripos($sampletype, $type) !== false) {
                return $matrix;
            }
        }
        return 'UNKNOWN_MATRIX';
    }
    
    private function getAnalysisSubMatrix($sampletype) {
        $subMatrices = [
            'Faeces' => 'HUMAN_FECAL',
            'Water' => 'FRESHWATER',
            'Soil' => 'ENVIRONMENTAL_SOIL',
            'Sediment' => 'AQUATIC_SEDIMENT',
            'Sewage_liquid' => 'RAW_WASTEWATER',
            'Bird_carcass' => 'AVIAN_TISSUE',
            'Culture' => 'BACTERIAL_CULTURE',
            'Culture_plate' => 'AGAR_CULTURE',
            'Purified DNA' => 'EXTRACTED_DNA',
            'Sawage_biosolid' => 'TREATED_BIOSOLID',
            'Biosolid' => 'TREATED_SLUDGE',
            'Liquid' => 'WASTEWATER',
            'Wastewater' => 'EFFLUENT'
        ];
        
        foreach ($subMatrices as $type => $subMatrix) {
            if (stripos($sampletype, $type) !== false) {
                return $subMatrix;
            }
        }
        return 'UNKNOWN_SUBMATRIX';
    }
    
    private function generateSiteAreaCode($client_name) {
        if (empty($client_name) || $client_name === '-') {
            return 'UNK';
        }
        
        // Split by spaces and get first letter of each word
        $words = explode(' ', trim($client_name));
        $abbreviation = '';
        
        foreach ($words as $word) {
            if (!empty(trim($word))) {
                $abbreviation .= strtoupper(substr(trim($word), 0, 1));
            }
        }
        
        // If no abbreviation generated, return first 3 characters
        if (empty($abbreviation)) {
            return strtoupper(substr($client_name, 0, 3));
        }
        
        return $abbreviation;
    }

    /**
     * Check if data already exists for a specific id_one_water_sample in testing module
     * @param string $id_one_water_sample
     * @param string $id_testing_type
     * @param string $url
     * @return boolean
     */
    function check_data_exists($id_one_water_sample, $id_testing_type, $url) {
        // Map URL to corresponding table names
        $table_mapping = array(
            'biobankin' => 'biobank_in',
            'colilert_idexx_water' => 'colilert_water_in',
            'colilert_idexx_biosolids' => 'colilert_biosolids_in',
            'enterolert_idexx_water' => 'enterolert_water_in',
            'enterolert_idexx_biosolids' => 'enterolert_biosolids_in',
            'campy_biosolids' => 'campy_biosolids',
            'campy_liquids' => 'campy_liquids',
            'moisture_content' => 'moisture_content',
            'salmonella_biosolids' => 'salmonella_biosolids',
            'salmonella_liquids' => 'salmonella_liquids',
            'extraction_metagenome' => 'extraction_metagenome',
            'extraction_culture' => 'extraction_culture',
            'extraction_liquid' => 'extraction_liquid',
            'extraction_biosolid' => 'extraction_biosolid',
            'hemoflow' => 'hemoflow',
            'campy_biosolids_qpcr' => 'campy_biosolids_qpcr',
            'campy_biosolids_pa' => 'campy_biosolids_pa',
            'freezer_in' => 'freezer_in',
            'freezer_out' => 'freezer_out',
            'protozoa' => 'protozoa'
        );

        // Extract table name from URL
        $table_name = null;
        foreach ($table_mapping as $url_key => $table) {
            if (strpos($url, $url_key) !== false) {
                $table_name = $table;
                break;
            }
        }

        // If no matching table found, return false
        if (!$table_name || !$this->db->table_exists($table_name)) {
            return false;
        }

        // Check if data exists in the corresponding table
        try {
            $this->db->reset_query();
            $this->db->select('COUNT(*) as count');
            $this->db->from($table_name);
            $this->db->where('id_one_water_sample', $id_one_water_sample);
            $this->db->where('flag', '0');
            
            $query = $this->db->get();
            
            if (!$query) {
                return false;
            }
            
            $result = $query->row();
            return ($result && $result->count > 0);
            
        } catch (Exception $e) {
            return false;
        }
    }
}

/* End of file Tbl_delivery_model.php */
/* Location: ./application/models/Tbl_delivery_model.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2022-12-14 03:38:42 */
/* http://harviacode.com */