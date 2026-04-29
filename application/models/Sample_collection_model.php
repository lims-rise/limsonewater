<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Sample_collection_model extends CI_Model
{

    public $table = 'sample_collection';
    public $table_detail = 'sample_collection_detail';
    public $id = 'id_sample_collection';
    public $id_detail = 'id_sample_collection_detail';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

    // datatables
    function json() {
        $this->datatables->select('sample_collection.id_sample_collection, sample_collection.id_one_water_sample, sample_collection.id_person, ref_person.initial, sample_collection.date_processing,
        sample_collection.id_sampletype, ref_sampletype.sampletype, sample_collection.barcode_sample_collection, sample_collection.weight, sample_collection.volume,
        sample_collection.quantity, sample_collection.completed, sample_collection.comments, sample_collection.date_created, sample_collection.date_updated, GREATEST(sample_collection.date_created, sample_collection.date_updated) AS latest_date');
        $this->datatables->from($this->table);
        $this->datatables->join('ref_person', 'sample_collection.id_person = ref_person.id_person', 'left');
        $this->datatables->join('ref_sampletype', 'sample_collection.id_sampletype = ref_sampletype.id_sampletype', 'left');
        // $this->datatables->where('lab', $this->session->userdata('lab'));
        $this->datatables->where('sample_collection.flag', '0');
        $lvl = $this->session->userdata('id_user_level');
        if ($lvl == 4){
            $this->datatables->add_column('action', anchor(site_url('sample_collection/read/$1'),'<i class="fa fa-th-list" aria-hidden="true"></i>', array('class' => 'btn btn-warning btn-sm')), 'id_one_water_sample');
        }
        else if ($lvl == 3){
            $this->datatables->add_column('action', anchor(site_url('sample_collection/read/$1'),'<i class="fa fa-th-list" aria-hidden="true"></i>', array('class' => 'btn btn-warning btn-sm')) ."
                ".'<button type="button" class="btn_edit btn btn-info btn-sm" aria-hidden="true"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>', 'id_one_water_sample');
        }
        else {
            $this->datatables->add_column('action', anchor(site_url('sample_collection/read/$1'),'<i class="fa fa-th-list" aria-hidden="true"></i>', array('class' => 'btn btn-warning btn-sm')) ."
            ".'<button type="button" class="btn_edit btn btn-info btn-sm" aria-hidden="true"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>'." 
            ".'<button type="button" class="btn_delete btn btn-danger btn-sm" data-id="$1" aria-hidden="true"><i class="fa fa-trash-o" aria-hidden="true"></i></button>', 'id_one_water_sample');
        }
        $this->db->order_by('latest_date', 'DESC');
        return $this->datatables->generate();
    }

    function subjson($id) {
        $this->datatables->select('scd.id_sample_collection_detail, scd.date_received, scd.volume, scd.date_extraction, 
        scd.id_kit, scd.other_kit, scd.kit_lot, scd.tube_barcode, scd.dna_concentration, scd.cryobox_number, scd.id_location, 
        ref_location.freezer,ref_location.shelf,ref_location.rack,ref_location.tray, 
        ref_position.rows1, ref_position.columns1,
        CONCAT("F",ref_location.freezer,"-","S",ref_location.shelf,"-","R",ref_location.rack,"-","T",ref_location.tray,"-","R",ref_position.rows1,"-","C",ref_position.columns1) AS location,
        scd.comments, scd.flag');
        $this->datatables->from('sample_collection_detail AS scd');
        $this->datatables->join('ref_kit', 'scd.id_kit = ref_kit.id_kit', 'left');
        $this->datatables->join('ref_location', 'scd.id_location = ref_location.id_location', 'left');
        $this->datatables->join('ref_position', 'scd.id_pos = ref_position.id_pos', 'left');
        // $this->datatables->join('ref_testing b', 'FIND_IN_SET(b.id_testing_type, a.id_testing_type)', 'left');
        // $this->datatables->join('ref_barcode c', 'a.sample_id = c.testing_type_id', 'left');
        $this->datatables->where('scd.flag', '0');
        $this->datatables->where('scd.id_sample_collection', $id);
        $this->datatables->group_by('scd.id_sample_collection_detail');
        $lvl = $this->session->userdata('id_user_level');
        if ($lvl == 4){
            $this->datatables->add_column('action', '', 'id_sample_collection_detail');
        }
        else if ($lvl == 3){
            $this->datatables->add_column('action', '<button type="button" class="btn_edit_det btn btn-info btn-sm" aria-hidden="true"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>', 'id_sample_collection_detail');
        }
        else {
            $this->datatables->add_column('action', '<button type="button" class="btn_edit_det btn btn-info btn-sm" aria-hidden="true"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>'." 
                ".'<button type="button" class="btn_delete_detail btn btn-danger btn-sm" data-id="$1" aria-hidden="true"><i class="fa fa-trash-o" aria-hidden="true"></i></button>', 'id_sample_collection_detail');
        }
        return $this->datatables->generate();
    }

    // function subjson72($id) {
    //     $this->datatables->select('m72.id_moisture72, m72.id_moisture, m72.date_moisture72, m72.time_moisture72, m72.barcode_tray, m72.dry_weight72, m72.moisture_content_persen, m72.dry_weight_persen, m72.comments72, m72.flag');
    //     $this->datatables->from('moisture72 AS m72');
    //     // $this->datatables->join('ref_testing b', 'FIND_IN_SET(b.id_testing_type, a.id_testing_type)', 'left');
    //     // $this->datatables->join('ref_barcode c', 'a.sample_id = c.testing_type_id', 'left');
    //     $this->datatables->where('m72.flag', '0');
    //     $this->datatables->where('m72.id_moisture', $id);
    //     $this->datatables->group_by('m72.id_moisture72');
    //     $lvl = $this->session->userdata('id_user_level');
    //     if ($lvl == 4){
    //         $this->datatables->add_column('action', '', 'id_moisture72');
    //     }
    //     else if ($lvl == 3){
    //         $this->datatables->add_column('action', '<button type="button" class="btn_edit_det72 btn btn-info btn-sm" aria-hidden="true"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>', 'id_moisture72');
    //     }
    //     else {
    //         $this->datatables->add_column('action', '<button type="button" class="btn_edit_det72 btn btn-info btn-sm" aria-hidden="true"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>'." 
    //                  ".'<button type="button" class="btn_delete72 btn btn-danger btn-sm" data-id="$1" aria-hidden="true"><i class="fa fa-trash-o" aria-hidden="true"></i></button>', 'id_moisture72');
    //     }
    //     return $this->datatables->generate();
    // }

    function get_by_id($id)
    {
        $this->db->where('id_one_water_sample', $id);
        $this->db->where('flag', '0');
        // $this->db->where('lab', $this->session->userdata('lab'));
        return $this->db->get('sample_collection')->row();
    }

    function get_by_id_detail($id)
    {
        $this->db->where('id_sample_collection_detail', $id);
        $this->db->where('flag', '0');
        // $this->db->where('lab', $this->session->userdata('lab'));
        return $this->db->get('sample_collection_detail')->row();
    }

    // function get_by_id_detail72($id)
    // {
    //     $this->db->where('id_moisture72', $id);
    //     $this->db->where('flag', '0');
    //     // $this->db->where('lab', $this->session->userdata('lab'));
    //     return $this->db->get('moisture72')->row();
    // }

    function get_detail($id)
    {
      $response = array();
      $this->db->select('sc.id_sample_collection, sc.id_one_water_sample, sc.id_person, rp.initial, sc.date_processing,
        sc.user_created, 
        sc.user_review, 
        sc.review, 
        user.full_name,
        sc.id_sampletype, rs.sampletype, sc.barcode_sample_collection, sc.weight, sc.volume,
        sc.quantity, sc.completed, sc.comments');
      $this->db->from('sample_collection AS sc');
      $this->db->join('ref_sampletype AS rs', 'sc.id_sampletype = rs.id_sampletype', 'left');
      $this->db->join('ref_person AS rp',  'sc.id_person = rp.id_person', 'left');
      $this->db->join('tbl_user user', 'sc.user_review = user.id_users', 'left');
      $this->db->where('sc.id_one_water_sample', $id);
      $this->db->where('sc.flag', '0');
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
    public function insert($data) {
        $this->db->insert($this->table,  $data);
    }

    // Function update data
    function update($id, $data)
    {
        $this->db->where('id_sample_collection', $id);
        $this->db->where('flag', '0');
        $this->db->update('sample_collection', $data);
    }

    function insert_detail($data) {
        $this->db->insert($this->table_detail, $data);
        return $this->db->insert_id(); // Return the ID of the newly inserted row
    }

    function update_detail($id, $data) {
        $this->db->where('id_sample_collection_detail', $id);
        $this->db->update('sample_collection_detail', $data);
    }

    function insert_det72($data) {
        $this->db->insert($this->table72, $data);
        return $this->db->insert_id(); // Return the ID of the newly inserted row
    }

    function update_det72($id, $data) {
        $this->db->where('id_moisture72', $id);
        $this->db->update('moisture72', $data);
    }

    /**
     * Cascade soft delete moisture72 records when moisture24 is deleted
     * @param int $id_moisture The id_moisture (parent ID)
     * @return bool Success status
     */
    function cascade_delete_moisture72($id_moisture) {
        if (empty($id_moisture)) {
            return false;
        }
        
        // Soft delete all moisture72 records with matching id_moisture
        $this->db->where('id_moisture', $id_moisture);
        $this->db->where('flag', '0');
        $this->db->update('moisture72', array('flag' => '1'));
        
        return true;
    }

    /**
     * Cascade soft delete moisture24 and moisture72 when parent sample_collection is deleted
     * @param int $id_moisture The id_moisture (parent ID from sample_collection)
     * @return bool Success status
     */
    function cascade_delete_moisture24_72($id_moisture) {
        if (empty($id_moisture)) {
            return false;
        }
        
        // Soft delete all moisture24 records with matching id_moisture
        $this->db->where('id_moisture', $id_moisture);
        $this->db->where('flag', '0');
        $this->db->update('moisture24', array('flag' => '1'));
        
        // Soft delete all moisture72 records with matching id_moisture
        $this->db->where('id_moisture', $id_moisture);
        $this->db->where('flag', '0');
        $this->db->update('moisture72', array('flag' => '1'));
        
        return true;
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
        SELECT id_one_water_sample FROM sample_reception_sample
        WHERE id_one_water_sample NOT IN (SELECT id_one_water_sample FROM sample_collection)
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
        $sql = 'SELECT barcode_moisture_content FROM moisture_content
                WHERE barcode_moisture_content = ?
                AND barcode_moisture_content NOT IN (SELECT barcode_tray FROM moisture24 WHERE flag IN (0))';
        $q = $this->db->query($sql, array($id));
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

    function barcode_restrict($id){

        $q = $this->db->query('
        select id_one_water_sample
        from sample_collection
        WHERE id_one_water_sample = "'.$id.'" and flag = "0"
        ');        
        $response = $q->result_array();
        return $response;
    }
    
    function updateCancel($id, $data)
    {
        $this->db->where('id_one_water_sample', $id);
        $this->db->update('sample_collection', $data);

        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    function updateSave($id, $data)
    {
        $this->db->where('id_one_water_sample', $id);
        $this->db->update('sample_collection', $data);
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

    function get_freezx($id1, $id2, $id3, $id4) {
        $sql = 'SELECT id_location FROM ref_location
                WHERE freezer = ? 
                AND shelf = ? 
                AND rack = ? 
                AND tray = ?
                AND flag = 0';
        
        $q = $this->db->query($sql, array($id1, $id2, $id3, $id4));        
        $response = $q->row();
        return $response;
    }

    function get_posx($id1, $id2) {
        $sql = 'SELECT id_pos FROM ref_position
                WHERE rows1 = ? 
                AND columns1 = ? 
                AND flag = 0';
        
        $q = $this->db->query($sql, array($id1, $id2));        
        $response = $q->row();
        return $response;
    }

    // Get distinct freezer values for dropdown
    function getFreezer1(){
        $response = array();
        $q = $this->db->query('
            SELECT DISTINCT freezer FROM ref_location
            WHERE flag = 0 
        ');
        $response = $q->result_array();    
        return $response;
    }

    // Get distinct shelf values for dropdown
    function getFreezer2(){
        $response = array();
        $q = $this->db->query('
            SELECT DISTINCT shelf FROM ref_location
            WHERE flag = 0 
        ');
        $response = $q->result_array();    
        return $response;
    }

    // Get distinct rack values for dropdown
    function getFreezer3(){
        $response = array();
        $q = $this->db->query('
            SELECT DISTINCT rack FROM ref_location
            WHERE flag = 0 
        ');
        $response = $q->result_array();    
        return $response;
    }

    // Get distinct tray values for dropdown
    function getFreezer4(){
        $response = array();
        $q = $this->db->query('
            SELECT DISTINCT tray FROM ref_location
            WHERE flag = 0 
        ');
        $response = $q->result_array();    
        return $response;
    }

    // Get distinct row values for dropdown
    function getPos1(){
        $response = array();
        $q = $this->db->query('
            SELECT DISTINCT rows1 FROM ref_position
            WHERE flag = 0 
        ');
        $response = $q->result_array();    
        return $response;
    }

    // Get distinct column values for dropdown
    function getPos2(){
        $response = array();
        $q = $this->db->query('
            SELECT DISTINCT columns1 FROM ref_position
            WHERE flag = 0 
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