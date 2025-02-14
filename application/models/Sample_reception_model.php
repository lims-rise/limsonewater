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
    function json() {
        $this->datatables->select('sr.id_project, sr.client_quote_number, sr.client, sr.id_one_water_sample, sr.id_person, rp.initial,
        sr.date_arrival, sr.time_arrival, sr.date_collected, sr.time_collected, sr.date_created, sr.date_updated, sr.id_client_sample, rst.sampletype, sr.id_sampletype, 
        sr.quality_check, sr.comments, sr.flag, GREATEST(sr.date_created, sr.date_updated) AS latest_date');
    
        
        // Subquery untuk mendapatkan date_created dan date_updated
        $this->datatables->from('sample_reception sr');
        $this->datatables->join('ref_sampletype rst', 'sr.id_sampletype = rst.id_sampletype', 'left');
        $this->datatables->join('ref_person rp', 'sr.id_person = rp.id_person', 'left');
        
        // Menambahkan kondisi untuk mengambil data yang flag-nya 0
        $this->datatables->where('sr.flag', '0');
        
        // Tambahkan kondisi untuk level user
        $lvl = $this->session->userdata('id_user_level');
        if ($lvl == 4) {
            $this->datatables->add_column('action', anchor(site_url('sample_reception/read/$1'), '<i class="fa fa-th-list" aria-hidden="true"></i>', array('class' => 'btn btn-warning btn-sm')), 'id_project');
        } else if ($lvl == 3) {
            $this->datatables->add_column('action', anchor(site_url('sample_reception/read/$1'), '<i class="fa fa-th-list" aria-hidden="true"></i>', array('class' => 'btn btn-warning btn-sm')) . "
                " . '<button type="button" class="btn_edit btn btn-info btn-sm" aria-hidden="true"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>', 'id_project');
        } else {
            $this->datatables->add_column('action', anchor(site_url('sample_reception/read/$1'), '<i class="fa fa-th-list" aria-hidden="true"></i>', array('class' => 'btn btn-warning btn-sm')) . "
                " . '<button type="button" class="btn_edit btn btn-info btn-sm" aria-hidden="true"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>' . " 
                " . '<button type="button" class="btn_delete btn btn-danger btn-sm" data-id="$1" aria-hidden="true"><i class="fa fa-trash-o" aria-hidden="true"></i></button>', 'id_project');
        }
    
        // Mengatur pengurutan berdasarkan tanggal terbaru
        $this->db->order_by('latest_date', 'DESC');

    
        return $this->datatables->generate();
    }
    

    function subjson($id) {
        // $this->datatables->select('a.sample_id, a.project_id, b.testing_type, a.testing_type_id, a.date_collected, a.time_collected, a.sample_barcode, a.flag');
        // $this->datatables->from('sample_reception_sample a');
        // $this->datatables->join('ref_testing b', 'a.testing_type_id = b.testing_type_id', 'right');
        // $this->datatables->where('a.flag', '0');
        // $this->datatables->where('a.project_id', $id);
        $this->datatables->select('a.id_sample, a.id_project, a.id_client_sample,  a.id_testing_type, a.barcode, b.testing_type AS testing_type, b.url, a.flag');
        $this->datatables->from('sample_reception_sample a');
        $this->datatables->join('ref_testing b', 'FIND_IN_SET(b.id_testing_type, a.id_testing_type)', 'left');
        // $this->datatables->join('ref_barcode c', 'a.sample_id = c.testing_type_id', 'left');
        $this->datatables->where('a.flag', '0');
        $this->datatables->where('a.id_client_sample', $id);
        $this->datatables->group_by('a.id_sample');
        $lvl = $this->session->userdata('id_user_level');
        if ($lvl == 4){
            $this->datatables->add_column('action', '', 'id_sample');
        }
        else if ($lvl == 3){
            $this->datatables->add_column('action', '<button type="button" class="btn_edit_det btn btn-info btn-sm" aria-hidden="true"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>', 'id_sample');
        }
        else {
            $this->datatables->add_column('action', '<button type="button" class="btn_edit_det btn btn-info btn-sm" aria-hidden="true"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>'." 
               ".'<button type="button" class="btn_delete btn btn-danger btn-sm" data-id="$1" aria-hidden="true"><i class="fa fa-trash-o" aria-hidden="true"></i></button>', 'id_sample');
        }
        return $this->datatables->generate();
    }


    function get_by_id($id)
    {
        $this->db->where($this->id, $id);
        $this->db->where('flag', '0');
        // $this->db->where('lab', $this->session->userdata('lab'));
        return $this->db->get($this->table)->row();
    }

    function get_by_id_detail($id)
    {
        $this->db->where('id_sample', $id);
        $this->db->where('flag', '0');
        // $this->db->where('lab', $this->session->userdata('lab'));
        return $this->db->get('sample_reception_sample')->row();
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
      $this->db->select('*');
      $this->db->join('ref_sampletype', 'sample_reception.id_sampletype=ref_sampletype.id_sampletype', 'left');
      $this->db->join('ref_person', 'sample_reception.id_person=ref_person.id_person', 'left');
      $this->db->where('sample_reception.id_project', $id);
      $this->db->where('sample_reception.flag', '0');
      $q = $this->db->get('sample_reception');
      $response = $q->row();
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

        // Check if there is a previous id_project
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
        $this->db->select('id_one_water_sample');
        $this->db->order_by('id_project', 'DESC');
        $this->db->limit(1);
        $query = $this->db->get('sample_reception');

        // Check if there is a previous client
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
    public function insert($data) {
        $data['id_project'] = $this->generate_project_id();
        // $data['client'] = $this->generate_client();
        $data['id_one_water_sample'] = $this->generate_one_water_sample_id();
        $this->db->insert('sample_reception',  $data);
    }
    

    // Function update data
    function update($id, $data)
    {
        $this->db->where('id_project', $id);
        $this->db->update('sample_reception', $data);
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
        $this->db->insert('sample_reception_sample', $data);
        return $this->db->insert_id(); // Return the ID of the newly inserted row
    }

    function update_det($id, $data) {
        $this->db->where('id_sample', $id);
        $this->db->update('sample_reception_sample', $data);
    }

    function insert_barcode($data) {
        $this->db->insert('ref_barcode', $data);
    }

    function update_barcode($id_sample, $id_testing_type, $data) {
        $this->db->where('id_sample', $id_sample);
        $this->db->where('id_testing_type', $id_testing_type);
        $this->db->update('ref_barcode', $data);
    }

    function delete_barcode($id_sample) {
        $this->db->delete('ref_barcode', array('id_sample' => $id_sample));
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
        $query = $this->db->get('sample_reception_sample');
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
        $this->db->where('id_sample', $id);
        $query = $this->db->get('sample_reception_sample');
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
        $this->db->select('sr.id_project, sr.client, sr.id_client_sample, sr.id_one_water_sample, rp.initial, rs.sampletype,
        sr.date_arrival, sr.time_arrival, sr.comments, rt.testing_type');
        $this->db->from('sample_reception AS sr');
        $this->db->join('ref_person AS rp', 'sr.id_person = rp.id_person');
        $this->db->join('ref_sampletype AS rs', 'sr.id_sampletype = rs.id_sampletype');
        $this->db->join('sample_reception_sample AS srs', 'sr.id_project = srs.id_project');
        $this->db->join('ref_testing AS rt', 'srs.id_testing_type = rt.id_testing_type');
        $this->db->where('sr.flag', '0');
        $this->db->order_by('sr.id_project', 'ASC');
        return $this->db->get()->result();
    }
      
}

/* End of file Tbl_delivery_model.php */
/* Location: ./application/models/Tbl_delivery_model.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2022-12-14 03:38:42 */
/* http://harviacode.com */