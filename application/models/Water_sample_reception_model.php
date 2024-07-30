<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Water_sample_reception_model extends CI_Model
{

    public $table = 'sample_reception';
    public $id = 'project_id';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

    // datatables
    function json() {
        $this->datatables->select('sample_reception.project_id, sample_reception.client, sample_reception.one_water_sample_id, sample_reception.id_person, ref_person.initial,
        sample_reception.date_arrival, sample_reception.time_arrival,sample_reception.date_collected, sample_reception.time_collected, sample_reception.client_sample_id, ref_classification.classification_name, sample_reception.classification_id, 
        sample_reception.comments, sample_reception.flag');
        $this->datatables->from('sample_reception');
        $this->datatables->join('ref_classification', 'sample_reception.classification_id = ref_classification.classification_id', 'left');
        $this->datatables->join('ref_person', 'sample_reception.id_person = ref_person.id_person', 'left');
        // $this->datatables->where('Water_sample_reception.id_country', $this->session->userdata('lab'));
        $this->datatables->where('sample_reception.flag', '0');
        $lvl = $this->session->userdata('id_user_level');
        if ($lvl == 7){
            $this->datatables->add_column('action', anchor(site_url('Water_sample_reception/read/$1'),'<i class="fa fa-th-list" aria-hidden="true"></i>', array('class' => 'btn btn-info btn-sm')), 'project_id');
        }
        else if (($lvl == 2) | ($lvl == 3)){
            $this->datatables->add_column('action', anchor(site_url('Water_sample_reception/read/$1'),'<i class="fa fa-th-list" aria-hidden="true"></i>', array('class' => 'btn btn-info btn-sm')) ."
                ".'<button type="button" class="btn_edit btn btn-info btn-sm" aria-hidden="true"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>', 'project_id');
        }
        else {
            $this->datatables->add_column('action', anchor(site_url('Water_sample_reception/read/$1'),'<i class="fa fa-th-list" aria-hidden="true"></i>', array('class' => 'btn btn-info btn-sm')) ."
                ".'<button type="button" class="btn_edit btn btn-info btn-sm" aria-hidden="true"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>'." 
                ".anchor(site_url('Water_sample_reception/delete/$1'),'<i class="fa fa-trash-o" aria-hidden="true"></i>','class="btn btn-danger btn-sm" onclick="javasciprt: return confirm(\'Confirm deleting project ID : $1 ?\')"'), 'project_id');
        }
        return $this->datatables->generate();
    }

    function subjson($id) {
        // $this->datatables->select('a.sample_id, a.project_id, b.testing_type, a.testing_type_id, a.date_collected, a.time_collected, a.sample_barcode, a.flag');
        // $this->datatables->from('sample_reception_sample a');
        // $this->datatables->join('ref_testing b', 'a.testing_type_id = b.testing_type_id', 'right');
        // $this->datatables->where('a.flag', '0');
        // $this->datatables->where('a.project_id', $id);
        $this->datatables->select('a.sample_id, a.project_id, a.client_sample_id,  a.testing_type_id, GROUP_CONCAT(b.testing_type) AS testing_type, a.flag');
        $this->datatables->from('sample_reception_sample a');
        $this->datatables->join('ref_testing b', 'FIND_IN_SET(b.testing_type_id, a.testing_type_id)', 'left');
        $this->datatables->where('a.flag', '0');
        $this->datatables->where('a.client_sample_id', $id);
        $this->datatables->group_by('a.sample_id');
        $lvl = $this->session->userdata('id_user_level');
        if ($lvl == 7){
            $this->datatables->add_column('action', anchor(site_url('Water_sample_reception/read2/$1'),'<i class="fa fa-th-list" aria-hidden="true"></i>', array('class' => 'btn btn-info btn-sm')), 'sample_id');
        }
        else if (($lvl == 2) | ($lvl == 3)){
            $this->datatables->add_column('action', anchor(site_url('Water_sample_reception/read2/$1'),'<i class="fa fa-th-list" aria-hidden="true"></i>', array('class' => 'btn btn-info btn-sm')) ."
                ".'<button type="button" class="btn_edit_det btn btn-info btn-sm" aria-hidden="true"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>', 'sample_id');
        }
        else {
            $this->datatables->add_column('action', '<button type="button" class="btn_edit_det btn btn-info btn-sm" aria-hidden="true"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>'." 
                ".anchor(site_url('Water_sample_reception/delete_detail/$1'),'<i class="fa fa-trash-o" aria-hidden="true"></i>','class="btn btn-danger btn-sm" onclick="javasciprt: return confirm(\'Confirm deleting sample ID : $1 ?\')"'), 'sample_id');
        }
        return $this->datatables->generate();
    }

    function subjson2($id2) {
        $this->datatables->select('a.testing_id, b.testing_type, a.date_collected, a.time_collected, a.no_submitted, a.flag');
        $this->datatables->from('sample_reception_testing a');
        $this->datatables->join('ref_testing b', 'a.testing_type_id = b.testing_type_id', 'left');
        $this->datatables->where('a.sample_id', $id2);
        $this->datatables->where('a.flag', '0');

        $lvl = $this->session->userdata('id_user_level');
        if ($lvl == 7){
            $this->datatables->add_column('action', '', 'testing_id');
        }
        else if (($lvl == 2) | ($lvl == 3)){
            $this->datatables->add_column('action', '<button type="button" class="btn_edit_det btn btn-info btn-sm" aria-hidden="true"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>Update</button>', 'testing_id');
        }
        else {
            $this->datatables->add_column('action', '<button type="button" class="btn_edit_det btn btn-info btn-sm" aria-hidden="true"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>'." 
                ".anchor(site_url('Water_sample_reception/delete_detail2/$1'),'<i class="fa fa-trash-o" aria-hidden="true"></i>','class="btn btn-danger btn-sm" onclick="javasciprt: return confirm(\'Confirm deleting this sample testing ID : $1?\')"'), 'testing_id');
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
        $this->db->where('sample_id', $id);
        $this->db->where('flag', '0');
        // $this->db->where('lab', $this->session->userdata('lab'));
        return $this->db->get('sample_reception_sample')->row();
    }

    // Function get detail2 by id
    function get_by_id_detail2($id)
    {
        $this->db->where('testing_id', $id);
        $this->db->where('flag', '0');
        return $this->db->get('sample_reception_testing')->row();
    }

    function get_detail($id)
    {
      $response = array();
      $this->db->select('*');
      $this->db->join('ref_classification', 'sample_reception.classification_id=ref_classification.classification_id', 'left');
      $this->db->join('ref_person', 'sample_reception.id_person=ref_person.id_person', 'left');
      $this->db->where('sample_reception.project_id', $id);
      $this->db->where('sample_reception.flag', '0');
      $q = $this->db->get('sample_reception');
      $response = $q->row();
      return $response;
    }

    function get_detail2($id)
    {
      $response = array();
      $this->db->select('*');
      $this->db->where('sample_reception_sample.sample_id', $id);
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
        $this->db->select('project_id');
        $this->db->order_by('project_id', 'DESC');
        $this->db->limit(1);
        $query = $this->db->get('sample_reception');

        // Check if there is a previous project_id
        if ($query->num_rows() > 0) {
            return $query->row()->project_id;
        } else {
            return null;
        }
    }

    // Function to generate the next project_id
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
        $this->db->order_by('project_id', 'DESC');
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
    public function generate_client() {
        $latest_id = $this->get_latest_client();
        $prefix = 'CLT'; // Prefix consist of CLT

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

    // Function to get the latest one_water_sample_id
    public function get_latest_one_water_sample_id() {
        $this->db->select('one_water_sample_id');
        $this->db->order_by('project_id', 'DESC');
        $this->db->limit(1);
        $query = $this->db->get('sample_reception');

        // Check if there is a previous client
        if ($query->num_rows() > 0) {
            return $query->row()->one_water_sample_id;
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
        $data['project_id'] = $this->generate_project_id();
        $data['client'] = $this->generate_client();
        $data['one_water_sample_id'] = $this->generate_one_water_sample_id();
        $this->db->insert('sample_reception',  $data);
    }
    

    // Function update data
    function update($id, $data)
    {
        $this->db->where('project_id', $id);
        $this->db->update('sample_reception', $data);
    }

    function insert_det($data)
    {
        $this->db->insert('sample_reception_sample', $data);
    }

    function insert_test($data) {
        $this->db->insert('sample_reception_testing', $data);
    }
    
    function update_det($id, $data)
    {
        $this->db->where('sample_id', $id);
        $this->db->update('sample_reception_sample', $data);
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

    // Function insert detail 2
    function insert_det2($data)
    {
        $this->db->insert('sample_reception_testing', $data);
    }
    
    // Function update detail 2
    function update_det2($id, $data)
    {
        $this->db->where('testing_id', $id);
        $this->db->update('sample_reception_testing', $data);
    }

    // Function delete detail 2
    function delete_detail2($id)
    {
        $this->db->where('testing_id', $id);
        $this->db->delete('sample_reception_testing');
    }
    

    function getClassification(){
        $response = array();
        $this->db->select('*');
        $this->db->where('flag', '0');
        $this->db->order_by('classification_name');
        $q = $this->db->get('ref_classification');
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

    // public function get_last_barcode($testing_type) {
        
    //     $prefix = '';
    //     $year = date('y');
    //     switch ($testing_type) {
    //         case 'Extraction':
    //             $prefix = 'X';
    //             break;
    //         case 'Campylobacter-MPN':
    //             $prefix = 'N';
    //             break;
    //         case 'Campylobacter-PCR':
    //             $prefix = 'R';
    //             break;
    //         case 'Salmonella':
    //             $prefix = 'S';
    //             break;
    //         case 'Colilert':
    //             $prefix = 'C';
    //             break;
    //         case 'Enterolert':
    //             $prefix = 'E';
    //             break;
    //         case 'Moisture_content':
    //             $prefix = 'W';
    //             break;
    //         case 'qPCR':
    //             $prefix = 'Q';
    //             break;
    //         case 'TAC_Array':
    //             $prefix = 'T';
    //             break;
    //         default:
    //             return null;
    //     }
    
    //     $this->db->select_max('CAST(SUBSTR(sample_barcode, ' . (strlen($prefix . $year) + 1) . ') AS UNSIGNED)', 'max_barcode');
    //     $this->db->like('sample_barcode', $prefix . $year, 'after');
    //     $query = $this->db->get('sample_reception_sample');
    //     $result = $query->row();
    
    //     $next_number = $result->max_barcode + 1;
    //     $padded_number = str_pad($next_number, 5, '0', STR_PAD_LEFT);
    //     return $prefix . $year . $padded_number;
    // }

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

        $this->db->select_max('CAST(SUBSTR(sample_barcode, ' . (strlen($prefix . $year) + 1) . ') AS UNSIGNED)', 'max_barcode');
        $this->db->like('sample_barcode', $prefix . $year, 'after');
        $query = $this->db->get('sample_reception_sample');
        $result = $query->row();
    
        $next_number = $result->max_barcode + 1;
        $padded_number = str_pad($next_number, 5, '0', STR_PAD_LEFT);
        return $prefix . $year . $padded_number;
    }
    
    

    public function get_name_by_id($id) {
        $this->db->select('testing_type');
        $this->db->where('testing_type_id', $id);
        $query = $this->db->get('ref_testing');
        $result = $query->row();
        return $result ? $result->testing_type : null;
    }

      
}

/* End of file Tbl_delivery_model.php */
/* Location: ./application/models/Tbl_delivery_model.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2022-12-14 03:38:42 */
/* http://harviacode.com */