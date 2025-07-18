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

    // datatables
    public function json() {
        $this->datatables->select('NULL AS toggle, sr.id_project, sr.client_quote_number, sr.client, sr.id_client_sample, cc.client_name, sr.id_client_contact, sr.number_sample, sr.comments, sr.files, sr.date_collected, sr.time_collected, 
            sr.date_created, sr.date_updated, sr.flag', FALSE);
            
        $this->datatables->from('sample_reception sr');
        $this->datatables->join('ref_client cc', 'sr.id_client_contact = cc.id_client_contact', 'left');
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
            $this->datatables->add_column('action', anchor(site_url('sample_reception/read/$1'), 
                '<i class="fa fa-th-list" aria-hidden="true"></i>', 
                array('class' => 'btn btn-warning btn-sm')), 'id_project');
        } else if ($lvl == 3) {
            $this->datatables->add_column('action', anchor(site_url('sample_reception/read/$1'), 
                '<i class="fa fa-th-list" aria-hidden="true"></i>', 
                array('class' => 'btn btn-warning btn-sm')) . "
                " . '<button type="button" class="btn_edit btn btn-info btn-sm">
                    <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                </button>', 'id_project');
        } else {
            $this->datatables->add_column('action', 
            anchor(site_url('sample_reception/rep_print/$1'), 
                '<i class="fa fa-print" aria-hidden="true"></i>', 
                array('class' => 'btn btn-warning btn-sm')) . 
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
            COALESCE(bank.user_review, campy.user_review, salmonellaL.user_review, salmonellaB.user_review, ec.user_review, el.user_review, em.user_review) AS user_review, 
            COALESCE(bank.review, campy.review, salmonellaL.review, salmonellaB.review, ec.review, el.review, em.review) AS review, 
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
        $this->datatables->join('tbl_user', 'tbl_user.id_users = COALESCE(bank.user_review, campy.user_review, salmonellaL.user_review, salmonellaB.user_review, ec.user_review, el.user_review, em.user_review)', 'left');
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
                            d.client_name, d.address, d.phone1, d.phone2, d.email, 
                            a.client_quote_number, a.po_number, 
                            DATE_FORMAT(e.from_date, "%d-%b-%Y") AS from_date,
                            DATE_FORMAT(e.to_date, "%d-%b-%Y") AS to_date,
                            b.date_arrival, b.time_arrival,
                            a.id_client_sample, b.id_one_water_sample, b.id_person, c.realname', FALSE);
        $this->db->from('sample_reception a');
        $this->db->join('sample_reception_sample b', 'a.id_project = b.id_project', 'left');
        $this->db->join('ref_person c', 'b.id_person = c.id_person', 'left');
        $this->db->join('ref_client d', 'a.id_client_contact = d.id_client_contact', 'left');
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
    
        foreach ($query as $row) {
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
    
    
    
    
    
    
    
      
}

/* End of file Tbl_delivery_model.php */
/* Location: ./application/models/Tbl_delivery_model.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2022-12-14 03:38:42 */
/* http://harviacode.com */