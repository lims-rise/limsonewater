<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Enterolert_idexx_water_model extends CI_Model
{

    public $table = 'enterolert_water_in';
    public $tableOut = 'enterolert_water_out';
    public $id = 'id_enterolert_in';
    public $idOut = 'id_enterolert_out';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

    // datatables
    function json() {
        $this->datatables->select('enterolert_water_in.id_enterolert_in, enterolert_water_in.id_one_water_sample, enterolert_water_in.id_person, ref_person.initial,
        enterolert_water_in.id_sampletype, ref_sampletype.sampletype, enterolert_water_in.enterolert_barcode, enterolert_water_in.date_sample, enterolert_water_in.time_sample,
        enterolert_water_in.volume_bottle, enterolert_water_in.dilution');
        $this->datatables->from($this->table);
        $this->datatables->join('ref_person', 'enterolert_water_in.id_person = ref_person.id_person', 'left');
        $this->datatables->join('ref_sampletype', 'enterolert_water_in.id_sampletype = ref_sampletype.id_sampletype', 'left');
        $this->datatables->where('lab', $this->session->userdata('lab'));
        $this->datatables->where('enterolert_water_in.flag', '0');

        $lvl = $this->session->userdata('id_user_level');

        if ($lvl == 4){
            // $this->datatables->add_column('action', anchor(site_url('enterolert_idexx_water/read/$1'),'<i class="fa fa-th-list" aria-hidden="true"></i>', array('class' => 'btn btn-info btn-sm')), 'id_enterolert_in');
            $this->datatables->add_column('action', '', 'id_enterolert_in');
        }
        else if ($lvl == 3){
            // $this->datatables->add_column('action', anchor(site_url('enterolert_idexx_water/read/$1'),'<i class="fa fa-th-list" aria-hidden="true"></i>', array('class' => 'btn btn-info btn-sm')) ."
            //     ".'<button type="button" class="btn_edit btn btn-info btn-sm" aria-hidden="true"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>', 'id_enterolert_in');
            $this->datatables->add_column('action', 
            '<button type="button" class="btn_edit btn btn-info btn-sm" aria-hidden="true"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>', 
            'id_enterolert_in');
        }
        else {
            $this->datatables->add_column('action', anchor(site_url('enterolert_idexx_water/read/$1'),'<i class="fa fa-th-list" aria-hidden="true"></i>', array('class' => 'btn btn-warning btn-sm')) ."
            ".'<button type="button" class="btn_edit btn btn-info btn-sm" aria-hidden="true"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>'." 
            ".'<button type="button" class="btn_delete btn btn-danger btn-sm" data-id="$1" aria-hidden="true"><i class="fa fa-trash-o" aria-hidden="true"></i></button>', 'id_enterolert_in');
        }
        return $this->datatables->generate();
    }

    function subjson($id) {
        $this->datatables->select('ewo.id_enterolert_out, ewo.enterolert_barcode, ewo.date_sample, ewo.time_sample, ewo.enterococcus_largewells,  ewo.enterococcus_smallwells, ewo.enterococcus, ewo.remarks, ewo.flag');
        $this->datatables->from('enterolert_water_out AS ewo');
        // $this->datatables->join('ref_testing b', 'FIND_IN_SET(b.id_testing_type, a.id_testing_type)', 'left');
        // $this->datatables->join('ref_barcode c', 'a.sample_id = c.testing_type_id', 'left');
        $this->datatables->where('ewo.flag', '0');
        $this->datatables->where('ewo.id_enterolert_in', $id);
        $this->datatables->group_by('ewo.id_enterolert_out');
        $lvl = $this->session->userdata('id_user_level');
        if ($lvl == 4){
            $this->datatables->add_column('action', anchor(site_url('enterolert_idexx_water/read2/$1'),'<i class="fa fa-th-list" aria-hidden="true"></i>', array('class' => 'btn btn-info btn-sm')), 'id_enterolert_out');
        }
        else if ($lvl == 3){
            $this->datatables->add_column('action', anchor(site_url('enterolert_idexx_water/read2/$1'),'<i class="fa fa-th-list" aria-hidden="true"></i>', array('class' => 'btn btn-info btn-sm')) ."
                ".'<button type="button" class="btn_edit_det btn btn-info btn-sm" aria-hidden="true"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>', 'id_enterolert_out');
        }
        else {
            $this->datatables->add_column('action', '<button type="button" class="btn_edit_det btn btn-info btn-sm" aria-hidden="true"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>'." 
                ".'<button type="button" class="btn_delete btn btn-danger btn-sm" data-id="$1" aria-hidden="true"><i class="fa fa-trash-o" aria-hidden="true"></i></button>', 'id_enterolert_out');
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
        $this->db->where('id_enterolert_out', $id);
        $this->db->where('flag', '0');
        // $this->db->where('lab', $this->session->userdata('lab'));
        return $this->db->get('enterolert_water_out')->row();
    }

    function get_detail($id)
    {
      $response = array();
      $this->db->select('ewi.id_enterolert_in, ewi.id_one_water_sample, ewi.id_person, rp.initial,
        ewi.id_sampletype, rs.sampletype, ewi.enterolert_barcode, ewi.date_sample, ewi.time_sample,
        ewi.volume_bottle, ewi.dilution');
      $this->db->from('enterolert_water_in AS ewi');
      $this->db->join('ref_sampletype AS rs', 'ewi.id_sampletype = rs.id_sampletype', 'left');
      $this->db->join('ref_person AS rp',  'ewi.id_person = rp.id_person', 'left');
      $this->db->where('ewi.id_enterolert_in', $id);
      $this->db->where('ewi.flag', '0');
      $q = $this->db->get();

      if ($q->num_rows() > 0) {
        $response = $q->row();
      }
    
      return $response;
    }

    // Fuction insert data
    public function insert($data) {
        $this->db->insert($this->table,  $data);
    }

    // Function update data
    function update($id, $data)
    {
        $this->db->where('id_enterolert_in', $id);
        $this->db->update($this->table, $data);
    }

    function insert_det($data) {
        $this->db->insert($this->tableOut, $data);
        return $this->db->insert_id(); // Return the ID of the newly inserted row
    }

    function update_det($id, $data) {
        $this->db->where('id_enterolert_out', $id);
        $this->db->update('enterolert_water_out', $data);
    }

    // delete data
    function delete($id)
    {
        $this->db->where($this->id, $id);
        $this->db->delete($this->table);
    }

    function delete_detail($id)
    {
        $this->db->where('id_enterolert_out', $id);
        $this->db->delete('enterolert_water_out');
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
        SELECT id_one_water_sample FROM sample_reception
        WHERE id_one_water_sample NOT IN (SELECT id_one_water_sample FROM enterolert_water_in)
        AND flag = 0');       
        $response = $q->result_array();
        return $response;
    }

    function getOneWaterSampleById($idOneWaterSample)
    {
        $this->db->select('sr.id_sampletype, rs.sampletype');
        $this->db->from('sample_reception sr');
        $this->db->join('ref_sampletype rs', 'sr.id_sampletype = rs.id_sampletype', 'left');
        $this->db->where('sr.id_one_water_sample', $idOneWaterSample);
        $query = $this->db->get();
        return $query->row_array();
    }

    function validate24($id){
        $q = $this->db->query('
        SELECT barcode_moisture_content FROM moisture_content
        WHERE barcode_moisture_content = "'.$id.'"
        AND barcode_moisture_content NOT IN (SELECT barcode_tray FROM moisture24 WHERE flag IN (0))
        ');        
        $response = $q->result_array();
        return $response;
    }

    function get_all()
    {
        $this->db->select('ewi.id_enterolert_in, ewi.id_one_water_sample, rp.initial, rs.sampletype, ewi.enterolert_barcode, ewi.date_sample,
        ewi.time_sample, ewi.volume_bottle,ewi.dilution, ewo.id_enterolert_out, ewo.enterolert_barcode, ewo.date_sample, ewo.time_sample, ewo.enterococcus_largewells,
        ewo.enterococcus_smallwells, ewo.enterococcus, ewo.remarks');
        $this->db->from('enterolert_water_in AS ewi');
        $this->db->join('ref_person AS rp', 'ewi.id_person = rp.id_person');
        $this->db->join('ref_sampletype AS rs', 'ewi.id_sampletype = rs.id_sampletype');
        $this->db->join('enterolert_water_out AS ewo', 'ewi.id_enterolert_in = ewo.id_enterolert_in');
        $this->db->where('ewi.flag', '0');
        $this->db->order_by('ewi.id_enterolert_in', 'ASC');

        return $this->db->get()->result();
    }

    function validateEnterolertBarcode($id){
        $q = $this->db->query('
        SELECT enterolert_barcode FROM enterolert_water_in
        WHERE enterolert_barcode = "'.$id.'"
        AND flag = 0 
        ');        
        $response = $q->result_array();
        return $response;
    }

    function data_chart($valueLargeWells, $valueSmallWells){
        $q = $this->db->query('
        select mpn FROM idexxchart WHERE big = "'.$valueLargeWells.'" AND small = "'.$valueSmallWells.'"
        ');        
        $response = $q->result_array();
        return $response;
      }
    

      
}

/* End of file Tbl_delivery_model.php */
/* Location: ./application/models/Tbl_delivery_model.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2022-12-14 03:38:42 */
/* http://harviacode.com */