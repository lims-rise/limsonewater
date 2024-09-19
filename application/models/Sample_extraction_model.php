<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Sample_extraction_model extends CI_Model
{

    public $table = 'sample_extraction';
    public $id = 'barcode_sample';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

    // datatables
    function json() {
        $this->datatables->select('sample_extraction.barcode_sample, sample_extraction.id_one_water_sample, ref_person.initial,
        ref_sampletype.sampletype, sample_extraction.date_extraction, sample_extraction.weight, sample_extraction.volume, 
        ref_kit.kit, sample_extraction.kit_lot, sample_extraction.barcode_tube, sample_extraction.dna_concentration, 
        sample_extraction.cryobox, sample_extraction.id_location, sample_extraction.comments, sample_extraction.flag, 
        sample_extraction.id_person, sample_extraction.id_kit, sample_extraction.id_location');
        $this->datatables->from('sample_extraction');
        $this->datatables->join('ref_person', 'sample_extraction.id_person = ref_person.id_person', 'left');
        $this->datatables->join('ref_barcode', 'ref_barcode.barcode = sample_extraction.barcode_sample', 'left');
        $this->datatables->join('sample_reception_sample', 'ref_barcode.id_sample = sample_reception_sample.id_sample', 'left');
        $this->datatables->join('sample_reception', 'sample_reception_sample.id_project = sample_reception.id_project', 'left');
        $this->datatables->join('ref_sampletype', 'sample_reception.id_sampletype = ref_sampletype.id_sampletype', 'left');
        $this->datatables->join('ref_kit', 'sample_extraction.id_kit = ref_kit.id_kit', 'left');
        // $this->datatables->where('Sample_extraction.id_country', $this->session->userdata('lab'));
        $this->datatables->where('sample_extraction.flag', '0');
        $lvl = $this->session->userdata('id_user_level');
        if ($lvl == 4){
            $this->datatables->add_column('action', 'barcode_sample');
        }
        else if ($lvl == 3){
            $this->datatables->add_column('action', '<button type="button" class="btn_edit btn btn-info btn-sm" aria-hidden="true"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>', 'barcode_sample');
        }
        else {
            $this->datatables->add_column('action', '<button type="button" class="btn_edit btn btn-info btn-sm" aria-hidden="true"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>'." 
                  ".'<button type="button" class="btn_delete btn btn-danger btn-sm" data-id="$1" aria-hidden="true"><i class="fa fa-trash-o" aria-hidden="true"></i></button>', 'barcode_sample');
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
   
    // Fuction insert data
    public function insert($data) {
        $this->db->insert('sample_extraction', $data);
    }

    public function insert_freez($data_freez) {
        $this->db->insert('freezer_in', $data_freez);
    }
    

    // Function update data
    function update($id, $data)
    {
        $this->db->where('barcode_sample', $id);
        $this->db->update('sample_extraction', $data);
    }

    function update_freez($id, $data_freez)
    {
        $this->db->where('barcode_sample', $id);
        $this->db->update('freezer_in', $data_freez);
    }


    function insert_det($data) {
        $this->db->insert('sample_reception_sample', $data);
        return $this->db->insert_id(); // Return the ID of the newly inserted row
    }

    function update_det($id, $data) {
        $this->db->where('sample_id', $id);
        $this->db->update('sample_reception_sample', $data);
    }

    function insert_barcode($data) {
        $this->db->insert('ref_barcode', $data);
    }

    function update_barcode($sample_id, $testing_type_id, $data) {
        $this->db->where('sample_id', $sample_id);
        $this->db->where('testing_type_id', $testing_type_id);
        $this->db->update('ref_barcode', $data);
    }

    function delete_barcode($sample_id) {
        $this->db->delete('ref_barcode', array('sample_id' => $sample_id));
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

    function barcode_check($id){
        $q = $this->db->query('
        select ref_barcode.barcode, ref_sampletype.sampletype
        from ref_barcode 
        left join sample_reception_sample on ref_barcode.id_sample = sample_reception_sample.id_sample
        left join sample_reception on sample_reception_sample.id_project = sample_reception.id_project
        left join ref_sampletype on sample_reception.id_sampletype = ref_sampletype.id_sampletype
        WHERE ref_barcode.barcode = "'.$id.'"
        AND ref_barcode.barcode NOT IN (SELECT barcode_sample FROM sample_extraction)
        ');        
        $response = $q->result_array();
        return $response;
      }    

    function load_freez($id){
        $q = $this->db->query('
        SELECT freezer, shelf, rack, tray FROM ref_location
        WHERE id_location = "'.$id.'"
        ');        
        $response = $q->result_array();
        return $response;
      }    

      function get_freez($freez, $shelf, $rack, $tray){
        $q = $this->db->query('
        SELECT id_location FROM ref_location
        WHERE freezer = "'.$freez.'"
        AND shelf = "'.$shelf.'"
        AND rack = "'.$rack.'"
        AND tray = "'.$tray.'"
        AND flag = 0 
        ');        
        $response = $q->result_array();
        return $response;
      } 

      function getID_one(){
        $q = $this->db->query('
        SELECT id_one_water_sample FROM sample_reception
        WHERE id_one_water_sample NOT IN (SELECT id_one_water_sample FROM sample_extraction)
        AND flag = 0
        ORDER BY id_one_water_sample');        
        $response = $q->result_array();
        return $response;
      }

      function getKit(){
        $response = array();
        $this->db->select('*');
        $this->db->where('flag', '0');
        $this->db->order_by('id_kit');
        $q = $this->db->get('ref_kit');
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

      function getFreezer1(){
        $response = array();
        $q = $this->db->query('
            SELECT DISTINCT freezer FROM ref_location
            WHERE flag = 0 
        ');
        $response = $q->result_array();    
        return $response;
      }

      function getFreezer2(){
        $response = array();
        $q = $this->db->query('
            SELECT DISTINCT shelf FROM ref_location
            WHERE flag = 0 
        ');
        $response = $q->result_array();    
        return $response;
      }

      function getFreezer3(){
        $response = array();
        $q = $this->db->query('
            SELECT DISTINCT rack FROM ref_location
            WHERE flag = 0 
        ');
        $response = $q->result_array();    
        return $response;
      }

      function getFreezer4(){
        $response = array();
        $q = $this->db->query('
            SELECT DISTINCT tray FROM ref_location
            WHERE flag = 0 
        ');
        $response = $q->result_array();    
        return $response;
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
        $query = $this->db->get('ref_barcode');
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


    public function get_sample_testing($id) {
        $response = array();
        $this->db->select('*');
        $this->db->where('sample_id', $id);
        $query = $this->db->get('sample_reception_sample');
        $response = $query->result_array();
        return $response; 
    }

      
}

/* End of file Tbl_delivery_model.php */
/* Location: ./application/models/Tbl_delivery_model.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2022-12-14 03:38:42 */
/* http://harviacode.com */