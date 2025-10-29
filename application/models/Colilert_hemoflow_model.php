<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Colilert_hemoflow_model extends CI_Model
{

    public $table = 'colilert_hemoflow';
    public $id = 'id_colilert_hemoflow';
    public $tableOut = 'colilert_hemoflow_detail';
    public $idOut = 'id_colilert_hemoflow_detail';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

    // datatables
    function json() {
        $this->datatables->select('chf.id_colilert_hemoflow, chf.id_one_water_sample, chf.id_person, rp.initial,
        chf.id_sampletype, rs.sampletype, chf.colilert_hemoflow_barcode, chf.date_sample, chf.time_sample,
        chf.volume_bottle, chf.dilution, chf.date_created, chf.date_updated, GREATEST(chf.date_created, chf.date_updated) AS latest_date');
        $this->datatables->from('colilert_hemoflow AS chf');
        $this->datatables->join('ref_person AS rp', 'chf.id_person = rp.id_person', 'left');
        $this->datatables->join('ref_sampletype AS rs', 'chf.id_sampletype = rs.id_sampletype', 'left');
        $this->datatables->where('lab', $this->session->userdata('lab'));
        $this->datatables->where('chf.flag', '0');

        $lvl = $this->session->userdata('id_user_level');

        if ($lvl == 4){
            $this->datatables->add_column('action', anchor(site_url('colilert_hemoflow/read/$1'),'<i class="fa fa-th-list" aria-hidden="true"></i>', array('class' => 'btn btn-warning btn-sm')), 'id_one_water_sample');
            // $this->datatables->add_column('action', '', 'id_one_water_sample');
        }
        else if ($lvl == 3){
            $this->datatables->add_column('action', anchor(site_url('colilert_hemoflow/read/$1'),'<i class="fa fa-th-list" aria-hidden="true"></i>', array('class' => 'btn btn-warning btn-sm')) ."
                ".'<button type="button" class="btn_edit btn btn-info btn-sm" aria-hidden="true"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>', 
            'id_one_water_sample');
        }
        else {
            $this->datatables->add_column('action', anchor(site_url('colilert_hemoflow/read/$1'),'<i class="fa fa-th-list" aria-hidden="true"></i>', array('class' => 'btn btn-warning btn-sm')) ."
            ".'<button type="button" class="btn_edit btn btn-info btn-sm" aria-hidden="true"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>'." 
            ".'<button type="button" class="btn_delete btn btn-danger btn-sm" data-id="$1" aria-hidden="true"><i class="fa fa-trash-o" aria-hidden="true"></i></button>', 'id_one_water_sample');
        }
        $this->db->order_by('latest_date', 'DESC');
        return $this->datatables->generate();
    }

    function subjson($id) {
        $this->datatables->select('chd.id_colilert_hemoflow_detail, chd.colilert_hemoflow_barcode, chd.date_sample, chd.time_sample, chd.ecoli_largewells, chd.ecoli_smallwells, 
        chd.ecoli, chd.lowerconfidence, chd.coliforms_largewells, chd.coliforms_smallwells, chd.coliforms, chd.remarks, chd.quality_control, chd.flag');
        $this->datatables->from('colilert_hemoflow_detail AS chd');
        // $this->datatables->join('ref_testing b', 'FIND_IN_SET(b.id_testing_type, a.id_testing_type)', 'left');
        // $this->datatables->join('ref_barcode c', 'a.sample_id = c.testing_type_id', 'left');
        $this->datatables->where('chd.flag', '0');
        $this->datatables->where('chd.id_colilert_hemoflow', $id);
        $this->datatables->group_by('chd.id_colilert_hemoflow_detail');

        $lvl = $this->session->userdata('id_user_level');

        if ($lvl == 4){
            // $this->datatables->add_column('action', anchor(site_url('colilert_hemoflow/read2/$1'),'<i class="fa fa-th-list" aria-hidden="true"></i>', array('class' => 'btn btn-info btn-sm')), 'id_colilert_hemoflow_detail');
            $this->datatables->add_column('action', '-');
        }
        else if ($lvl == 3){
            $this->datatables->add_column('action', '<button type="button" class="btn_edit_det btn btn-info btn-sm" aria-hidden="true"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>', 'id_colilert_hemoflow_detail');
        }
        else {
            $this->datatables->add_column('action', '<button type="button" class="btn_edit_det btn btn-info btn-sm" aria-hidden="true"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>'." 
                ".'<button type="button" class="btn_delete btn btn-danger btn-sm" data-id="$1" aria-hidden="true"><i class="fa fa-trash-o" aria-hidden="true"></i></button>', 'id_colilert_hemoflow_detail');
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
        $this->db->where('id_colilert_hemoflow_detail', $id);
        $this->db->where('flag', '0');
        // $this->db->where('lab', $this->session->userdata('lab'));
        return $this->db->get('colilert_hemoflow_detail')->row();
    }

    function get_detail($id)
    {
      $response = array();
      $this->db->select('chf.id_colilert_hemoflow, chf.id_one_water_sample, chf.id_person, rp.initial,
        chf.user_created, 
        chf.user_review, 
        chf.review, 
        user.full_name,
        chf.id_sampletype, rs.sampletype, chf.colilert_hemoflow_barcode, chf.date_sample, chf.time_sample,
        chf.volume_bottle, chf.dilution');
      $this->db->from('colilert_hemoflow AS chf');
      $this->db->join('ref_sampletype AS rs', 'chf.id_sampletype = rs.id_sampletype', 'left');
      $this->db->join('ref_person AS rp',  'chf.id_person = rp.id_person', 'left');
      $this->db->join('tbl_user user', 'chf.user_review = user.id_users', 'left');
      $this->db->where('chf.id_one_water_sample', $id);
      $this->db->where('chf.flag', '0');
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
        $this->db->where('id_colilert_hemoflow', $id);
        $this->db->update($this->table, $data);
    }

    function insert_det($data) {
        $this->db->insert($this->tableOut, $data);
        return $this->db->insert_id(); // Return the ID of the newly inserted row
    }

    function update_det($id, $data) {
        $this->db->where('id_colilert_hemoflow_detail', $id);
        $this->db->update('colilert_hemoflow_detail', $data);
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
        WHERE id_one_water_sample NOT IN (SELECT id_one_water_sample FROM colilert_hemoflow)
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
        $this->db->select('chf.id_colilert_hemoflow, chf.id_one_water_sample, rp.initial, rs.sampletype, chf.colilert_hemoflow_barcode, chf.date_sample,
            chf.time_sample, chf.volume_bottle, chf.dilution, chd.id_colilert_hemoflow_detail, chd.colilert_hemoflow_barcode, chd.date_sample, chd.time_sample, 
            chd.ecoli_largewells, chd.ecoli_smallwells,
            chd.ecoli, chd.lowerconfidence, chd.coliforms_largewells, chd.coliforms_smallwells, chd.coliforms, chd.remarks');
        $this->db->from('colilert_hemoflow AS chf');
        $this->db->join('ref_person AS rp', 'chf.id_person = rp.id_person');
        $this->db->join('ref_sampletype AS rs', 'chf.id_sampletype = rs.id_sampletype');
        $this->db->join('colilert_hemoflow_detail AS chd', 'chf.id_colilert_hemoflow = chd.id_colilert_hemoflow');
        $this->db->where('chf.flag', '0');
        $this->db->order_by('chf.id_colilert_hemoflow', 'ASC');

        return $this->db->get()->result();
    }

    function validateColilertBarcode($id){
        $q = $this->db->query('
        SELECT colilert_hemoflow_barcode FROM colilert_hemoflow
        WHERE colilert_hemoflow_barcode = "'.$id.'"
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
    
    function barcode_restrict($id){

        $q = $this->db->query('
        select id_one_water_sample
        from colilert_hemoflow
        WHERE id_one_water_sample = "'.$id.'"
        ');        
        $response = $q->result_array();
        return $response;
    }

    function updateCancel($id, $data)
    {
        $this->db->where('id_one_water_sample', $id);
        $this->db->update('colilert_hemoflow', $data);

        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    function updateSave($id, $data)
    {
        $this->db->where('id_one_water_sample', $id);
        $this->db->update('colilert_hemoflow', $data);
    }

    function subjsonFinalCalculation($id)
    {
        $response = array();

        // Get data with proper column specification and calculate all required fields
        $this->db->select('
        chf.id_colilert_hemoflow, 
        chf.id_one_water_sample, 
        chf.colilert_hemoflow_barcode, 
        rp.initial, 
        rs.sampletype, 
        hm.volume_filter, 
        hm.volume_eluted,
        chd.ecoli as ecoli_raw,
        chd.lowerconfidence as lowerconfidence_raw,
        chd.coliforms as coliforms_raw,
        chd.id_colilert_hemoflow_detail,
        CASE 
            WHEN chd.ecoli IS NOT NULL AND hm.volume_eluted IS NOT NULL 
            THEN ROUND((chd.ecoli / 100) * hm.volume_eluted, 2)
            ELSE NULL 
        END as total_ecoli,
        CASE 
            WHEN chd.ecoli IS NOT NULL AND hm.volume_eluted IS NOT NULL AND hm.volume_filter IS NOT NULL AND hm.volume_filter > 0
            THEN ROUND(((chd.ecoli / 100) * hm.volume_eluted / hm.volume_filter / 10), 2)
            ELSE NULL 
        END as ecolimpn,
        CASE 
            WHEN chd.lowerconfidence IS NOT NULL AND hm.volume_eluted IS NOT NULL AND hm.volume_filter IS NOT NULL AND hm.volume_filter > 0
            THEN ROUND((chd.lowerconfidence / 100) * hm.volume_eluted / hm.volume_filter / 10, 2)
            ELSE NULL 
        END as lowermpn,
        CASE
            WHEN chd.coliforms IS NOT NULL AND hm.volume_eluted IS NOT NULL
            THEN ROUND((chd.coliforms / 100) * hm.volume_eluted, 2)
            ELSE NULL 
        END as totalcoliforms,
        CASE
            WHEN chd.coliforms IS NOT NULL AND hm.volume_eluted IS NOT NULL AND hm.volume_filter IS NOT NULL AND hm.volume_filter > 0
            THEN ROUND(((chd.coliforms / 100) * hm.volume_eluted / hm.volume_filter / 10), 2)
            ELSE NULL 
        END as coliformmpn
        ');
        $this->db->from('colilert_hemoflow chf');
        $this->db->join('hemoflow hm', 'chf.id_one_water_sample = hm.id_one_water_sample AND hm.flag = "0"', 'left');
        $this->db->join('colilert_hemoflow_detail AS chd', 'chf.id_colilert_hemoflow = chd.id_colilert_hemoflow');
        $this->db->join('ref_sampletype AS rs', 'chf.id_sampletype = rs.id_sampletype', 'left');
        $this->db->join('ref_person AS rp',  'chf.id_person = rp.id_person', 'left');
        $this->db->where('chf.id_colilert_hemoflow', $id);
        $this->db->where('chd.flag', '0');
        $this->db->order_by('chd.id_colilert_hemoflow_detail', 'ASC');

        $query = $this->db->get();
        $response = $query->result_array();

        return $response;
    }
      
}

/* End of file Tbl_delivery_model.php */
/* Location: ./application/models/Tbl_delivery_model.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2022-12-14 03:38:42 */
/* http://harviacode.com */