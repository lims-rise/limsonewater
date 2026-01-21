<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Colilert_idexx_water_model extends CI_Model
{

    public $table = 'colilert_water_in';
    public $id = 'id_colilert_in';
    public $tableOut = 'colilert_water_out';
    public $idOut = 'id_colilert_out';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

    // datatables
    function json() {
        $this->datatables->select('cwi.id_colilert_in, cwi.id_one_water_sample, cwi.id_person, rp.initial,
        cwi.id_sampletype, rs.sampletype, cwi.colilert_barcode, cwi.date_sample, cwi.time_sample,
        cwi.volume_bottle, cwi.dilution, cwi.date_created, cwi.date_updated, GREATEST(cwi.date_created, cwi.date_updated) AS latest_date');
        $this->datatables->from('colilert_water_in AS cwi');
        $this->datatables->join('ref_person AS rp', 'cwi.id_person = rp.id_person', 'left');
        $this->datatables->join('ref_sampletype AS rs', 'cwi.id_sampletype = rs.id_sampletype', 'left');
        $this->datatables->where('lab', $this->session->userdata('lab'));
        $this->datatables->where('cwi.flag', '0');

        $lvl = $this->session->userdata('id_user_level');

        if ($lvl == 4){
            $this->datatables->add_column('action', anchor(site_url('colilert_idexx_water/read/$1'),'<i class="fa fa-th-list" aria-hidden="true"></i>', array('class' => 'btn btn-warning btn-sm')), 'id_one_water_sample');
            // $this->datatables->add_column('action', '', 'id_one_water_sample');
        }
        else if ($lvl == 3){
            $this->datatables->add_column('action', anchor(site_url('colilert_idexx_water/read/$1'),'<i class="fa fa-th-list" aria-hidden="true"></i>', array('class' => 'btn btn-warning btn-sm')) ."
                ".'<button type="button" class="btn_edit btn btn-info btn-sm" aria-hidden="true"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>', 
            'id_one_water_sample');
        }
        else {
            $this->datatables->add_column('action', anchor(site_url('colilert_idexx_water/read/$1'),'<i class="fa fa-th-list" aria-hidden="true"></i>', array('class' => 'btn btn-warning btn-sm')) ."
            ".'<button type="button" class="btn_edit btn btn-info btn-sm" aria-hidden="true"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>'." 
            ".'<button type="button" class="btn_delete btn btn-danger btn-sm" data-id="$1" aria-hidden="true"><i class="fa fa-trash-o" aria-hidden="true"></i></button>', 'id_one_water_sample');
        }
        $this->db->order_by('latest_date', 'DESC');
        return $this->datatables->generate();
    }

    function subjson($id) {
        $this->datatables->select('cwo.id_colilert_out, cwo.colilert_barcode, cwo.date_sample, cwo.time_sample, cwo.ecoli_largewells, cwo.ecoli_smallwells, 
        cwo.ecoli, cwo.lowerdetection, cwo.coliforms_largewells, cwo.coliforms_smallwells, cwo.total_coliforms, cwo.remarks, cwo.quality_control, cwo.flag');
        $this->datatables->from('colilert_water_out AS cwo');
        // $this->datatables->join('ref_testing b', 'FIND_IN_SET(b.id_testing_type, a.id_testing_type)', 'left');
        // $this->datatables->join('ref_barcode c', 'a.sample_id = c.testing_type_id', 'left');
        $this->datatables->where('cwo.flag', '0');
        $this->datatables->where('cwo.id_colilert_in', $id);
        $this->datatables->group_by('cwo.id_colilert_out');

        $lvl = $this->session->userdata('id_user_level');

        if ($lvl == 4){
            // $this->datatables->add_column('action', anchor(site_url('colilert_idexx_water/read2/$1'),'<i class="fa fa-th-list" aria-hidden="true"></i>', array('class' => 'btn btn-info btn-sm')), 'id_colilert_out');
            $this->datatables->add_column('action', '-');
        }
        else if ($lvl == 3){
            $this->datatables->add_column('action', '<button type="button" class="btn_edit_det btn btn-info btn-sm" aria-hidden="true"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>', 'id_colilert_out');
        }
        else {
            $this->datatables->add_column('action', '<button type="button" class="btn_edit_det btn btn-info btn-sm" aria-hidden="true"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>'." 
                ".'<button type="button" class="btn_delete btn btn-danger btn-sm" data-id="$1" aria-hidden="true"><i class="fa fa-trash-o" aria-hidden="true"></i></button>', 'id_colilert_out');
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
        $this->db->where('id_colilert_out', $id);
        $this->db->where('flag', '0');
        // $this->db->where('lab', $this->session->userdata('lab'));
        return $this->db->get('colilert_water_out')->row();
    }

    function get_detail($id)
    {
      $response = array();
      $this->db->select('cwi.id_colilert_in, cwi.id_one_water_sample, cwi.id_person, rp.initial,
        cwi.user_created, 
        cwi.user_review, 
        cwi.review, 
        user.full_name,
        cwi.id_sampletype, rs.sampletype, cwi.colilert_barcode, cwi.date_sample, cwi.time_sample,
        cwi.volume_bottle, cwi.dilution');
      $this->db->from('colilert_water_in AS cwi');
      $this->db->join('ref_sampletype AS rs', 'cwi.id_sampletype = rs.id_sampletype', 'left');
      $this->db->join('ref_person AS rp',  'cwi.id_person = rp.id_person', 'left');
      $this->db->join('tbl_user user', 'cwi.user_review = user.id_users', 'left');
      $this->db->where('cwi.id_one_water_sample', $id);
      $this->db->where('cwi.flag', '0');
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
        $this->db->where('id_colilert_in', $id);
        $this->db->update($this->table, $data);
    }

    function insert_det($data) {
        $this->db->insert($this->tableOut, $data);
        return $this->db->insert_id(); // Return the ID of the newly inserted row
    }

    function update_det($id, $data) {
        $this->db->where('id_colilert_out', $id);
        $this->db->update('colilert_water_out', $data);
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
        SELECT id_one_water_sample FROM sample_reception_sample
        WHERE id_one_water_sample NOT IN (SELECT id_one_water_sample FROM colilert_water_in)
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
        $this->db->select('cwi.id_colilert_in, cwi.id_one_water_sample, rp.initial, rs.sampletype, cwi.colilert_barcode, cwi.date_sample,
            cwi.time_sample, cwi.volume_bottle,cwi.dilution, cwo.id_colilert_out, cwo.colilert_barcode, cwo.date_sample, cwo.time_sample, 
            cwo.ecoli_largewells, cwo.ecoli_smallwells,
            cwo.ecoli, cwo.lowerdetection, cwo.coliforms_largewells, cwo.coliforms_smallwells, cwo.total_coliforms, cwo.remarks');
        $this->db->from('colilert_water_in AS cwi');
        $this->db->join('ref_person AS rp', 'cwi.id_person = rp.id_person');
        $this->db->join('ref_sampletype AS rs', 'cwi.id_sampletype = rs.id_sampletype');
        $this->db->join('colilert_water_out AS cwo', 'cwi.id_colilert_in = cwo.id_colilert_in');
        $this->db->where('cwi.flag', '0');
        $this->db->order_by('cwi.id_colilert_in', 'ASC');

        return $this->db->get()->result();
    }

    function validateColilertBarcode($id){
        $q = $this->db->query('
        SELECT colilert_barcode FROM colilert_water_in
        WHERE colilert_barcode = "'.$id.'"
        AND flag = 0 
        ');        
        $response = $q->result_array();
        return $response;
    }

    function data_chart($valueLargeWells, $valueSmallWells){
        $q = $this->db->query('
        select MPN_mean, MPN_95lo FROM idexx_mpn WHERE count_large = "'.$valueLargeWells.'" AND count_small = "'.$valueSmallWells.'"
        ');        
        $response = $q->result_array();
        return $response;
    }
    
    function barcode_restrict($id){

        $q = $this->db->query('
        select id_one_water_sample
        from colilert_water_in
        WHERE id_one_water_sample = "'.$id.'"
        ');        
        $response = $q->result_array();
        return $response;
    }

    function updateCancel($id, $data)
    {
        $this->db->where('id_one_water_sample', $id);
        $this->db->update('colilert_water_in', $data);

        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    function updateSave($id, $data)
    {
        $this->db->where('id_one_water_sample', $id);
        $this->db->update('colilert_water_in', $data);
    }
}

/* End of file Tbl_delivery_model.php */
/* Location: ./application/models/Tbl_delivery_model.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2022-12-14 03:38:42 */
/* http://harviacode.com */