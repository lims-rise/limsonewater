<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Campy_biosolids_model extends CI_Model
{

    public $table = 'moisture_content';
    public $table24 = 'moisture24';
    public $table72 = 'moisture72';
    public $id = 'id_moisture';
    public $id24 = 'id_moisture24';
    public $id72 = 'id_moisture72';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

    // datatables
// datatables
    function json() {
        $this->datatables->select('cb.id_campy_biosolids, cb.id_one_water_sample, cb.id_person, cb.number_of_tubes, cb.mpn_pcr_conducted, cb.campy_assay_barcode, 
        rp.initial, cb.date_sample_processed, cb.time_sample_processed, cb.sample_wetweight, cb.elution_volume,
        cb.id_sampletype, rs.sampletype, GROUP_CONCAT(sv.vol_sampletube ORDER BY sv.tube_number SEPARATOR ", ") AS vol_sampletube, GROUP_CONCAT(sv.tube_number ORDER BY sv.tube_number SEPARATOR ", ") AS tube_number, cb.flag');
        $this->datatables->from('campy_biosolids AS cb');
        $this->datatables->join('ref_person AS rp', 'cb.id_person = rp.id_person', 'left');
        $this->datatables->join('ref_sampletype AS rs', 'cb.id_sampletype = rs.id_sampletype', 'left');
        $this->datatables->join('sample_volumes AS sv', 'cb.id_campy_biosolids = sv.id_campy_biosolids', 'left');
        // $this->datatables->where('lab', $this->session->userdata('lab'));
        $this->datatables->where('cb.flag', '0');
        $this->db->group_by('
            cb.id_campy_biosolids, 
            cb.id_one_water_sample, 
            cb.id_person, 
            cb.number_of_tubes, 
            cb.mpn_pcr_conducted, 
            cb.campy_assay_barcode, 
            rp.initial, 
            cb.date_sample_processed, 
            cb.time_sample_processed, 
            cb.sample_wetweight, 
            cb.elution_volume,
            cb.id_sampletype, 
            rs.sampletype, 
            cb.flag');
        $lvl = $this->session->userdata('id_user_level');
        if ($lvl == 4){
            $this->datatables->add_column('action', anchor(site_url('campy_biosolids/read/$1'),'<i class="fa fa-th-list" aria-hidden="true"></i>', array('class' => 'btn btn-warning btn-sm')), 'id_campy_biosolids');
        }
        else if ($lvl == 3){
            $this->datatables->add_column('action', anchor(site_url('campy_biosolids/read/$1'),'<i class="fa fa-th-list" aria-hidden="true"></i>', array('class' => 'btn btn-warning btn-sm')) ."
                ".'<button type="button" class="btn_edit btn btn-info btn-sm" aria-hidden="true"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>', 'id_campy_biosolids');
        }
        else {
            $this->datatables->add_column('action', anchor(site_url('campy_biosolids/read/$1'),'<i class="fa fa-th-list" aria-hidden="true"></i>', array('class' => 'btn btn-warning btn-sm')) ."
            ".'<button type="button" class="btn_edit btn btn-info btn-sm" aria-hidden="true"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>'." 
            ".'<button type="button" class="btn_delete btn btn-danger btn-sm" data-id="$1" aria-hidden="true"><i class="fa fa-trash-o" aria-hidden="true"></i></button>', 'id_campy_biosolids');
        }
        return $this->datatables->generate();
    }

    function subjsonCharcoal($id) {
        $this->datatables->select('rc.id_result_charcoal, cb.campy_assay_barcode, rc.id_campy_biosolids, rc.date_sample_processed, rc.time_sample_processed,
        GROUP_CONCAT(sgp.growth_plate ORDER BY sgp.plate_number SEPARATOR ", ") AS growth_plate, GROUP_CONCAT(sgp.plate_number ORDER BY sgp.plate_number SEPARATOR ", ") AS plate_number, rc.flag');
        $this->datatables->from('result_charcoal AS rc');
        $this->datatables->join('campy_biosolids AS cb', 'rc.id_campy_biosolids = cb.id_campy_biosolids', 'left');
        $this->datatables->join('sample_growth_plate AS sgp', 'rc.id_result_charcoal = sgp.id_result_charcoal', 'left');
        // $this->datatables->join('ref_testing b', 'FIND_IN_SET(b.id_testing_type, a.id_testing_type)', 'left');
        // $this->datatables->join('ref_barcode c', 'a.sample_id = c.testing_type_id', 'left');
        $this->datatables->where('rc.flag', '0');
        $this->datatables->where('rc.id_campy_biosolids', $id);
        $this->datatables->group_by('
        rc.id_result_charcoal, 
        cb.campy_assay_barcode, 
        rc.id_campy_biosolids, 
        rc.date_sample_processed, 
        rc.time_sample_processed,
        rc.flag
        ');
        $lvl = $this->session->userdata('id_user_level');
        if ($lvl == 4){
            $this->datatables->add_column('action', '', 'id_result_charcoal');
        }
        else if ($lvl == 3){
            $this->datatables->add_column('action', '<button type="button" class="btn_edit_detResultsCharcoal btn btn-info btn-sm" aria-hidden="true"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>', 'id_result_charcoal');
        }
        else {
            $this->datatables->add_column('action', '<button type="button" class="btn_edit_detResultsCharcoal btn btn-info btn-sm" aria-hidden="true"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>'." 
                ".'<button type="button" class="btn_delete24 btn btn-danger btn-sm" data-id="$1" aria-hidden="true"><i class="fa fa-trash-o" aria-hidden="true"></i></button>', 'id_result_charcoal');
        }
        return $this->datatables->generate();
    }

    function subjson72($id) {
        $this->datatables->select('m72.id_moisture72, m72.id_moisture, m72.date_moisture72, m72.time_moisture72, m72.barcode_tray, m72.dry_weight72, m72.dry_weight_persen, m72.comments72, m72.flag');
        $this->datatables->from('moisture72 AS m72');
        // $this->datatables->join('ref_testing b', 'FIND_IN_SET(b.id_testing_type, a.id_testing_type)', 'left');
        // $this->datatables->join('ref_barcode c', 'a.sample_id = c.testing_type_id', 'left');
        $this->datatables->where('m72.flag', '0');
        $this->datatables->where('m72.id_moisture', $id);
        $this->datatables->group_by('m72.id_moisture72');
        $lvl = $this->session->userdata('id_user_level');
        if ($lvl == 4){
            $this->datatables->add_column('action', '', 'id_moisture72');
        }
        else if ($lvl == 3){
            $this->datatables->add_column('action', '<button type="button" class="btn_edit_det72 btn btn-info btn-sm" aria-hidden="true"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>', 'id_moisture72');
        }
        else {
            $this->datatables->add_column('action', '<button type="button" class="btn_edit_det72 btn btn-info btn-sm" aria-hidden="true"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>'." 
                     ".'<button type="button" class="btn_delete72 btn btn-danger btn-sm" data-id="$1" aria-hidden="true"><i class="fa fa-trash-o" aria-hidden="true"></i></button>', 'id_moisture72');
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

    function get_by_id_detail24($id)
    {
        $this->db->where('id_moisture24', $id);
        $this->db->where('flag', '0');
        // $this->db->where('lab', $this->session->userdata('lab'));
        return $this->db->get('moisture24')->row();
    }

    function get_by_id_detail72($id)
    {
        $this->db->where('id_moisture72', $id);
        $this->db->where('flag', '0');
        // $this->db->where('lab', $this->session->userdata('lab'));
        return $this->db->get('moisture72')->row();
    }

    function get_detail($id)
    {

      $response = array();
      $this->db->select('cb.id_campy_biosolids, cb.id_one_water_sample, cb.id_person, rp.initial, cb.number_of_tubes,
        cb.id_sampletype, rs.sampletype, cb.mpn_pcr_conducted, cb.campy_assay_barcode, cb.date_sample_processed,
        cb.time_sample_processed, cb.time_sample_processed, cb.sample_wetweight, cb.elution_volume');
      $this->db->from('campy_biosolids AS cb');
      $this->db->join('ref_sampletype AS rs', 'cb.id_sampletype = rs.id_sampletype', 'left');
      $this->db->join('ref_person AS rp',  'cb.id_person = rp.id_person', 'left');
      $this->db->where('cb.id_campy_biosolids', $id);
      $this->db->where('cb.flag', '0');
      $q = $this->db->get();

      if ($q->num_rows() > 0) {
        $response = $q->row();
      }
    
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

    // Fuction insert data
    // public function insert($data) {
    //     $this->db->insert($this->table,  $data);
    // }

    // // Function update data
    // function update($id, $data)
    // {
    //     $this->db->where('id_moisture', $id);
    //     $this->db->update($this->table, $data);
    // }

    function insert_det24($data) {
        $this->db->insert($this->table24, $data);
        return $this->db->insert_id(); // Return the ID of the newly inserted row
    }

    function update_det24($id, $data) {
        $this->db->where('id_moisture24', $id);
        $this->db->update('moisture24', $data);
    }

    function insert_det72($data) {
        $this->db->insert($this->table72, $data);
        return $this->db->insert_id(); // Return the ID of the newly inserted row
    }

    function update_det72($id, $data) {
        $this->db->where('id_moisture72', $id);
        $this->db->update('moisture72', $data);
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
        WHERE id_one_water_sample NOT IN (SELECT id_one_water_sample FROM campy_biosolids)
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

    function validate72($id){
        $q = $this->db->query('
        SELECT barcode_tray FROM moisture24
        WHERE barcode_tray = "'.$id.'"
        AND flag = 0 
        ');        
        $response = $q->result_array();
        return $response;
    }

    function get_all()
    {
        $this->db->select('mc.id_one_water_sample, rp.initial, mc.date_start, rs.sampletype, mc.barcode_moisture_content, mc.tray_weight,
        mc.traysample_wetweight, mc.time_incubator,mc.comments, m24.date_moisture24, m24.time_moisture24, m24.dry_weight24, m24.comments24,
        m72.date_moisture72, m72.time_moisture72, m72.dry_weight72, m72.dry_weight_persen, m72.comments72');
        $this->db->from('moisture_content AS mc');
        $this->db->join('ref_person AS rp', 'mc.id_person = rp.id_person');
        $this->db->join('ref_sampletype AS rs', 'mc.id_sampletype = rs.id_sampletype');
        $this->db->join('moisture24 AS m24', 'mc.id_moisture = m24.id_moisture');
        $this->db->join('moisture72 AS m72', 'mc.id_moisture = m72.id_moisture');
        $this->db->where('mc.flag', '0');
        $this->db->order_by('mc.date_start', 'ASC');

        return $this->db->get()->result();
    }

    function validateBarcodeMoistureContent($id){
        $q = $this->db->query('
        SELECT barcode_moisture_content FROM moisture_content
        WHERE barcode_moisture_content = "'.$id.'"
        AND flag = 0 
        ');        
        $response = $q->result_array();
        return $response;
    }

    function getTubes() {
        $response = array();
        $this->db->select('*');
        $this->db->where('flag', '0');
        $this->db->order_by('value');
        $labTech = $this->db->get('ref_tubes');
        $response = $labTech->result_array();
        return $response;
    }



    public function insert($data) {
        $this->db->insert('campy_biosolids', $data);
        return $this->db->insert_id(); // Return the last inserted ID
    }
    
    public function insert_sample_volume($data) {
        $this->db->insert('sample_volumes', $data);
    }
    
    function update($id, $data) {
        $this->db->where('id_campy_biosolids', $id);
        $this->db->update('campy_biosolids', $data);
    }

    public function delete_sample_volumes($id_campy_biosolids) {
        $this->db->where('id_campy_biosolids', $id_campy_biosolids);
        $this->db->delete('sample_volumes');
    }

    public function insertResultsCharcoal($data) {
        $this->db->insert('result_charcoal', $data);
        return $this->db->insert_id(); // Return the last inserted ID
    }

    public function insert_growth_plate($data) {
        $this->db->insert('sample_growth_plate', $data);
    }

    function updateResultsCharcoal($id, $data) {
        $this->db->where('id_result_charcoal', $id);
        $this->db->update('result_charcoal', $data);
    }

    public function delete_growth_plates($id_result_charcoal) {
        $this->db->where('id_result_charcoal', $id_result_charcoal);
        $this->db->delete('sample_growth_plate');
    }
    
    

      
}

/* End of file Tbl_delivery_model.php */
/* Location: ./application/models/Tbl_delivery_model.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2022-12-14 03:38:42 */
/* http://harviacode.com */