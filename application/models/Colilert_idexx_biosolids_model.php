<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Colilert_idexx_biosolids_model extends CI_Model
{

    public $table = 'colilert_biosolids_in';
    public $id = 'id_colilert_bio_in';
    public $tableOut = 'colilert_biosolids_out';
    public $idOut = 'id_colilert_bio_out';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

    // datatables
    function json() {
        $this->datatables->select('cbi.id_colilert_bio_in, cbi.id_one_water_sample, cbi.id_person, rp.initial,
        cbi.id_sampletype, rs.sampletype, cbi.colilert_barcode, cbi.date_sample, cbi.time_sample, cbi.wet_weight, cbi.dry_weight_persen, cbi.sample_dry_weight, cbi.elution_volume,
        cbi.volume_bottle, cbi.dilution, cbi.date_created, cbi.date_updated, GREATEST(cbi.date_created, cbi.date_updated) AS latest_date');
        $this->datatables->from('colilert_biosolids_in AS cbi');
        $this->datatables->join('ref_person AS rp', 'cbi.id_person = rp.id_person', 'left');
        $this->datatables->join('ref_sampletype AS rs', 'cbi.id_sampletype = rs.id_sampletype', 'left');
        $this->datatables->where('lab', $this->session->userdata('lab'));
        $this->datatables->where('cbi.flag', '0');

        $lvl = $this->session->userdata('id_user_level');

        if ($lvl == 4){
            $this->datatables->add_column('action', anchor(site_url('colilert_idexx_biosolids/read/$1'),'<i class="fa fa-th-list" aria-hidden="true"></i>', array('class' => 'btn btn-warning btn-sm')), 'id_one_water_sample');
            // $this->datatables->add_column('action', '', 'id_one_water_sample');
        }
        else if ($lvl == 3){
            $this->datatables->add_column('action', anchor(site_url('colilert_idexx_biosolids/read/$1'),'<i class="fa fa-th-list" aria-hidden="true"></i>', array('class' => 'btn btn-warning btn-sm')) ."
                ".'<button type="button" class="btn_edit btn btn-info btn-sm" aria-hidden="true"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>', 
            'id_one_water_sample');
        }
        else {
            $this->datatables->add_column('action', anchor(site_url('colilert_idexx_biosolids/read/$1'),'<i class="fa fa-th-list" aria-hidden="true"></i>', array('class' => 'btn btn-warning btn-sm')) ."
            ".'<button type="button" class="btn_edit btn btn-info btn-sm" aria-hidden="true"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>'." 
            ".'<button type="button" class="btn_delete btn btn-danger btn-sm" data-id="$1" aria-hidden="true"><i class="fa fa-trash-o" aria-hidden="true"></i></button>', 'id_one_water_sample');
        }
        $this->db->order_by('latest_date', 'DESC');
        return $this->datatables->generate();
    }

    function subjson($id) {
        $this->datatables->select('cbo.id_colilert_bio_out, cbo.colilert_barcode, cbo.date_sample, cbo.time_sample, cbo.ecoli_largewells, cbo.ecoli_smallwells, 
        cbo.ecoli, cbo.lowerdetection, cbo.ecoli_dryweight, cbo.lowerdetection_dryweight, cbo.coliforms_largewells, cbo.coliforms_smallwells, cbo.total_coliforms, cbo.remarks, cbo.quality_control, cbo.flag');
        $this->datatables->from('colilert_biosolids_out AS cbo');
        // $this->datatables->join('ref_testing b', 'FIND_IN_SET(b.id_testing_type, a.id_testing_type)', 'left');
        // $this->datatables->join('ref_barcode c', 'a.sample_id = c.testing_type_id', 'left');
        $this->datatables->where('cbo.flag', '0');
        $this->datatables->where('cbo.id_colilert_bio_in', $id);
        $this->datatables->group_by('cbo.id_colilert_bio_out');

        $lvl = $this->session->userdata('id_user_level');

        if ($lvl == 4){
            // $this->datatables->add_column('action', anchor(site_url('colilert_idexx_biosolids/read2/$1'),'<i class="fa fa-th-list" aria-hidden="true"></i>', array('class' => 'btn btn-info btn-sm')), 'id_colilert_bio_out');
            $this->datatables->add_column('action', '-');
        }
        else if ($lvl == 3){
            $this->datatables->add_column('action', '<button type="button" class="btn_edit_det btn btn-info btn-sm" aria-hidden="true"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>', 'id_colilert_bio_out');
        }
        else {
            $this->datatables->add_column('action', '<button type="button" class="btn_edit_det btn btn-info btn-sm" aria-hidden="true"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>'." 
                ".'<button type="button" class="btn_delete btn btn-danger btn-sm" data-id="$1" aria-hidden="true"><i class="fa fa-trash-o" aria-hidden="true"></i></button>', 'id_colilert_bio_out');
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
        $this->db->where('id_colilert_bio_out', $id);
        $this->db->where('flag', '0');
        // $this->db->where('lab', $this->session->userdata('lab'));
        return $this->db->get('colilert_biosolids_out')->row();
    }

    function get_detail($id)
    {
      $response = array();
      $this->db->select('cbi.id_colilert_bio_in, cbi.id_one_water_sample, cbi.id_person, rp.initial,
        cbi.user_created, 
        cbi.user_review, 
        cbi.review, 
        user.full_name,
        cbi.id_sampletype, rs.sampletype, cbi.colilert_barcode, cbi.date_sample, cbi.time_sample, cbi.wet_weight, cbi.dry_weight_persen, cbi.sample_dry_weight, cbi.elution_volume,
        cbi.volume_bottle, cbi.dilution');
      $this->db->from('colilert_biosolids_in AS cbi');
      $this->db->join('ref_sampletype AS rs', 'cbi.id_sampletype = rs.id_sampletype', 'left');
      $this->db->join('ref_person AS rp',  'cbi.id_person = rp.id_person', 'left');
      $this->db->join('tbl_user user', 'cbi.user_review = user.id_users', 'left');
      $this->db->where('cbi.id_one_water_sample', $id);
      $this->db->where('cbi.flag', '0');
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
        $this->db->where('id_colilert_bio_in', $id);
        $this->db->update($this->table, $data);
    }

    function insert_det($data) {
        $this->db->insert($this->tableOut, $data);
        return $this->db->insert_id(); // Return the ID of the newly inserted row
    }

    function update_det($id, $data) {
        $this->db->where('id_colilert_bio_out', $id);
        $this->db->update('colilert_biosolids_out', $data);
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
        WHERE id_one_water_sample NOT IN (SELECT id_one_water_sample FROM colilert_biosolids_in)
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
        $this->db->select('cbi.id_colilert_bio_in, cbi.id_one_water_sample, rp.initial, rs.sampletype, cbi.colilert_barcode, cbi.date_sample,
        cbi.time_sample, cbi.wet_weight, cbi.elution_volume, cbi.volume_bottle, cbi.dilution, cbo.id_colilert_bio_out, cbo.colilert_barcode, cbo.date_sample, cbo.time_sample,
        cbo.ecoli_largewells, cbo.ecoli_smallwells, cbo.ecoli, cbo.coliforms_largewells, cbo.coliforms_smallwells, cbo.total_coliforms, cbo.remarks');
        $this->db->from('colilert_biosolids_in AS cbi');
        $this->db->join('ref_person AS rp', 'cbi.id_person = rp.id_person');
        $this->db->join('ref_sampletype AS rs', 'cbi.id_sampletype = rs.id_sampletype');
        $this->db->join('colilert_biosolids_out AS cbo', 'cbi.id_colilert_bio_in = cbo.id_colilert_bio_in');
        $this->db->where('cbi.flag', '0');
        $this->db->order_by('cbi.id_colilert_bio_in', 'ASC');

        return $this->db->get()->result();
    }

    function validateColilertBarcode($id){
        $q = $this->db->query('
        SELECT colilert_barcode FROM colilert_biosolids_in
        WHERE colilert_barcode = "'.$id.'"
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

    function getDryWeight(){
        $response = array();
        $this->db->select('mc.id_moisture, m72.dry_weight_persen');
        $this->db->join('moisture24 AS m24', 'mc.id_moisture = m24.id_moisture', 'left');
        $this->db->join('moisture72 AS m72', 'mc.id_moisture = m72.id_moisture', 'left');
        $this->db->where('mc.flag', '0');
        $this->db->where('m72.dry_weight_persen IS NOT NULL', null, false);
        $this->db->order_by('mc.id_moisture', 'ASC');
        $dryWeight = $this->db->get('moisture_content AS mc');
        $response = $dryWeight->result_array();
        return $response;
    }
    
    function barcode_restrict($id){

        $q = $this->db->query('
        select id_one_water_sample
        from colilert_biosolids_in
        WHERE id_one_water_sample = "'.$id.'"
        ');        
        $response = $q->result_array();
        return $response;
    }

    function updateCancel($id, $data)
    {
        $this->db->where('id_one_water_sample', $id);
        $this->db->update('colilert_biosolids_in', $data);

        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    function updateSave($id, $data)
    {
        $this->db->where('id_one_water_sample', $id);
        $this->db->update('colilert_biosolids_in', $data);
    }

      
}

/* End of file Tbl_delivery_model.php */
/* Location: ./application/models/Tbl_delivery_model.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2022-12-14 03:38:42 */
/* http://harviacode.com */