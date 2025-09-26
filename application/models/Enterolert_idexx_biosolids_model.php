<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Enterolert_idexx_biosolids_model extends CI_Model
{

    public $table = 'enterolert_biosolids_in';
    public $tableOut = 'enterolert_biosolids_out';
    public $id = 'id_enterolert_bio_in';
    public $idOut = 'id_enterolert_bio_out';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

    // datatables
    function json() {
        $this->datatables->select('enterolert_biosolids_in.id_enterolert_bio_in, enterolert_biosolids_in.id_one_water_sample, enterolert_biosolids_in.id_person, ref_person.initial,
        enterolert_biosolids_in.id_sampletype, ref_sampletype.sampletype, enterolert_biosolids_in.enterolert_barcode, enterolert_biosolids_in.date_sample, enterolert_biosolids_in.time_sample,
        enterolert_biosolids_in.wet_weight, enterolert_biosolids_in.dry_weight_persen, enterolert_biosolids_in.sample_dry_weight, enterolert_biosolids_in.elution_volume, enterolert_biosolids_in.volume_bottle, enterolert_biosolids_in.dilution,
        enterolert_biosolids_in.date_created, enterolert_biosolids_in.date_updated, GREATEST(enterolert_biosolids_in.date_created, enterolert_biosolids_in.date_updated) AS latest_date');
        $this->datatables->from($this->table);
        $this->datatables->join('ref_person', 'enterolert_biosolids_in.id_person = ref_person.id_person', 'left');
        $this->datatables->join('ref_sampletype', 'enterolert_biosolids_in.id_sampletype = ref_sampletype.id_sampletype', 'left');
        $this->datatables->where('lab', $this->session->userdata('lab'));
        $this->datatables->where('enterolert_biosolids_in.flag', '0');

        $lvl = $this->session->userdata('id_user_level');

        if ($lvl == 4){
            $this->datatables->add_column('action', anchor(site_url('enterolert_idexx_biosolids/read/$1'),'<i class="fa fa-th-list" aria-hidden="true"></i>', array('class' => 'btn btn-warning btn-sm')), 'id_one_water_sample');
            // $this->datatables->add_column('action', '', 'id_one_water_sample');
        }
        else if ($lvl == 3){
            $this->datatables->add_column('action', anchor(site_url('enterolert_idexx_biosolids/read/$1'),'<i class="fa fa-th-list" aria-hidden="true"></i>', array('class' => 'btn btn-warning btn-sm')) ."
                ".'<button type="button" class="btn_edit btn btn-info btn-sm" aria-hidden="true"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>', 
            'id_one_water_sample');
        }
        else {
            $this->datatables->add_column('action', anchor(site_url('enterolert_idexx_biosolids/read/$1'),'<i class="fa fa-th-list" aria-hidden="true"></i>', array('class' => 'btn btn-warning btn-sm')) ."
            ".'<button type="button" class="btn_edit btn btn-info btn-sm" aria-hidden="true"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>'." 
            ".'<button type="button" class="btn_delete btn btn-danger btn-sm" data-id="$1" aria-hidden="true"><i class="fa fa-trash-o" aria-hidden="true"></i></button>', 'id_one_water_sample');
        }
        $this->db->order_by('latest_date', 'DESC');
        return $this->datatables->generate();
    }

    function subjson($id) {
        $this->datatables->select('ebo.id_enterolert_bio_out, ebo.enterolert_barcode, ebo.date_sample, ebo.time_sample, ebo.enterococcus_largewells,
        ebo.enterococcus_smallwells, ebo.enterococcus, ebo.ecoli_dryweight, ebo.lowerdetection_dryweight, ebo.remarks, ebo.quality_control, ebo.flag');
        $this->datatables->from('enterolert_biosolids_out AS ebo');
        // $this->datatables->join('ref_testing b', 'FIND_IN_SET(b.id_testing_type, a.id_testing_type)', 'left');
        // $this->datatables->join('ref_barcode c', 'a.sample_id = c.testing_type_id', 'left');
        $this->datatables->where('ebo.flag', '0');
        $this->datatables->where('ebo.id_enterolert_bio_in', $id);
        $this->datatables->group_by('ebo.id_enterolert_bio_out');

        $lvl = $this->session->userdata('id_user_level');

        if ($lvl == 4){
            // $this->datatables->add_column('action', anchor(site_url('enterolert_idexx_biosolids/read2/$1'),'<i class="fa fa-th-list" aria-hidden="true"></i>', array('class' => 'btn btn-info btn-sm')), 'id_enterolert_bio_out');
            $this->datatables->add_column('action', '-');
        }
        else if ($lvl == 3){
            $this->datatables->add_column('action', '<button type="button" class="btn_edit_det btn btn-info btn-sm" aria-hidden="true"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>', 'id_enterolert_bio_out');
        }
        else {
            $this->datatables->add_column('action', '<button type="button" class="btn_edit_det btn btn-info btn-sm" aria-hidden="true"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>'." 
                ".'<button type="button" class="btn_delete btn btn-danger btn-sm" data-id="$1" aria-hidden="true"><i class="fa fa-trash-o" aria-hidden="true"></i></button>', 'id_enterolert_bio_out');
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
        $this->db->where('id_enterolert_bio_out', $id);
        $this->db->where('flag', '0');
        // $this->db->where('lab', $this->session->userdata('lab'));
        return $this->db->get('enterolert_biosolids_out')->row();
    }

    function get_detail($id)
    {
      $response = array();
      $this->db->select('ebi.id_enterolert_bio_in, ebi.id_one_water_sample, ebi.id_person, rp.initial,
        ebi.user_created, 
        ebi.user_review, 
        ebi.review, 
        user.full_name,
        ebi.id_sampletype, rs.sampletype, ebi.enterolert_barcode, ebi.date_sample, ebi.time_sample,
        ebi.wet_weight, ebi.sample_dry_weight, ebi.sample_dry_weight, ebi.elution_volume, ebi.volume_bottle, ebi.dilution');
      $this->db->from('enterolert_biosolids_in AS ebi');
      $this->db->join('ref_sampletype AS rs', 'ebi.id_sampletype = rs.id_sampletype', 'left');
      $this->db->join('ref_person AS rp',  'ebi.id_person = rp.id_person', 'left');
      $this->db->join('tbl_user user', 'ebi.user_review = user.id_users', 'left');
      $this->db->where('ebi.id_one_water_sample', $id);
      $this->db->where('ebi.flag', '0');
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
        $this->db->where('id_enterolert_bio_in', $id);
        $this->db->update($this->table, $data);
    }

    function insert_det($data) {
        $this->db->insert($this->tableOut, $data);
        return $this->db->insert_id(); // Return the ID of the newly inserted row
    }

    function update_det($id, $data) {
        $this->db->where('id_enterolert_bio_out', $id);
        $this->db->update('enterolert_biosolids_out', $data);
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
        WHERE id_one_water_sample NOT IN (SELECT id_one_water_sample FROM enterolert_biosolids_in)
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
        $this->db->select('ebi.id_enterolert_bio_in, ebi.id_one_water_sample, rp.initial, rs.sampletype, ebi.enterolert_barcode, ebi.date_sample,
        ebi.time_sample, ebi.wet_weight, ebi.elution_volume, ebi.volume_bottle, ebi.dilution, ebo.id_enterolert_bio_out, ebo.enterolert_barcode, ebo.date_sample, ebo.time_sample, ebo.enterococcus_largewells,
        ebo.enterococcus_smallwells, ebo.enterococcus, ebo.remarks');
        $this->db->from('enterolert_biosolids_in AS ebi');
        $this->db->join('ref_person AS rp', 'ebi.id_person = rp.id_person');
        $this->db->join('ref_sampletype AS rs', 'ebi.id_sampletype = rs.id_sampletype');
        $this->db->join('enterolert_biosolids_out AS ebo', 'ebi.id_enterolert_bio_in = ebo.id_enterolert_bio_in');
        $this->db->where('ebi.flag', '0');
        $this->db->order_by('ebi.id_enterolert_bio_in', 'ASC');

        return $this->db->get()->result();
    }

    function validateEnterolertBarcode($id){
        $q = $this->db->query('
        SELECT enterolert_barcode FROM enterolert_biosolids_in
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
        from enterolert_biosolids_in
        WHERE id_one_water_sample = "'.$id.'"
        ');        
        $response = $q->result_array();
        return $response;
    } 
    
    function updateCancel($id, $data)
    {
        $this->db->where('id_one_water_sample', $id);
        $this->db->update('enterolert_biosolids_in', $data);

        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    function updateSave($id, $data)
    {
        $this->db->where('id_one_water_sample', $id);
        $this->db->update('enterolert_biosolids_in', $data);
    }

      
}

/* End of file Tbl_delivery_model.php */
/* Location: ./application/models/Tbl_delivery_model.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2022-12-14 03:38:42 */
/* http://harviacode.com */