<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Biobankin_model extends CI_Model
{

    public $table = 'biobank_in';
    public $id_table = 'id_one_water_sample';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

    // datatables
    function json($highlight_sample_id = null) {
        $this->datatables->select("
            biobank_in.id_one_water_sample, 
            biobank_in.date_conduct, 
            ref_person.initial, 
            biobank_in.biobankin_barcode,
            biobank_in.comments, 
            biobank_in.id_person, 
            biobank_in.flag, 
            biobank_in.user_created, 
            biobank_in.user_review,
            biobank_in.review, 
            user.full_name
        ");

        $this->datatables->from('biobank_in');
        $this->datatables->join('sample_reception_sample', 'biobank_in.id_one_water_sample = sample_reception_sample.id_one_water_sample', 'left');
        // $this->datatables->join('ref_sampletype', 'biobank_in.id_sampletype = ref_sampletype.id_sampletype', 'left');
        $this->datatables->join('ref_person', 'biobank_in.id_person = ref_person.id_person', 'left');
        $this->datatables->join('tbl_user user', 'biobank_in.user_review = user.id_users', 'left');
        // $this->datatables->where('Water_sample_reception.id_country', $this->session->userdata('lab'));
        $this->datatables->where('biobank_in.flag', '0');
        $lvl = $this->session->userdata('id_user_level');
        if ($lvl == 4){
            $this->datatables->add_column('action', anchor(site_url('Biobankin/read/$1'),'<i class="fa fa-th-list" aria-hidden="true"></i>', array('class' => 'btn btn-warning btn-sm')), 'id_one_water_sample');
        }
        else if ($lvl == 3){
            $this->datatables->add_column('action', anchor(site_url('Biobankin/read/$1'),'<i class="fa fa-th-list" aria-hidden="true"></i>', array('class' => 'btn btn-warning btn-sm')) ."
                ".'<button type="button" class="btn_edit btn btn-info btn-sm" aria-hidden="true"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>', 'id_one_water_sample');
        }
        else {
            $this->datatables->add_column('action', anchor(site_url('Biobankin/read/$1'),'<i class="fa fa-th-list" aria-hidden="true"></i>', array('class' => 'btn btn-warning btn-sm')) ."
                ".'<button type="button" class="btn_edit btn btn-info btn-sm" aria-hidden="true"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>'." 
                ".'<button type="button" class="btn_delete btn btn-danger btn-sm" data-id="$1" aria-hidden="true"><i class="fa fa-trash-o" aria-hidden="true"></i></button>', 'id_one_water_sample');
        }
        $this->db->order_by('id_one_water_sample', 'DESC');
        return $this->datatables->generate();
    }

    //   $this->db->select('a.barcode_water, a.id_one_water_sample, a.weight,
    //                         a.concentration_dna, a.volume, b.culture, 
    //                         a.barcode_tube, a.cryobox, 
    //                         concat("F",c.freezer,"-","S",c.shelf,"-","R",c.rack,"-","DRW",c.rack_level) AS location,
    //                         a.id_culture, a.id_location');
    //   $this->db->join('ref_culture', 'biobank_in_detail.id_culture=ref_culture.id_culture', 'left');
    //   $this->db->join('ref_location', 'biobank_in_detail.id_location=ref_location.id_location', 'left');
    //   $this->db->where('biobank_in_detail.id_one_water_sample', $id);
    //   $this->db->where('biobank_in_detail.flag', '0');
    //   $q = $this->db->get('biobank_in_detail');

    function subjson($id) {
        $this->datatables->select('a.id_biobankin_detail, a.id_sampletype, b.sampletype,
                             a.id_one_water_sample, a.replicates, a.comments');
        $this->datatables->from('biobank_in_detail a');
        $this->datatables->join('ref_sampletype b', 'a.id_sampletype = b.id_sampletype', 'left');
        $this->datatables->join('biobank_in c', 'a.id_one_water_sample = c.id_one_water_sample', 'left');
        $this->datatables->where('a.flag', '0');
        $this->datatables->where('a.id_one_water_sample', $id);
        // $this->datatables->where('a.id_one_water_sample', $id);
        // $this->datatables->group_by('a.id_sample');
        $lvl = $this->session->userdata('id_user_level');
        if ($lvl == 4){
            $this->datatables->add_column('action', anchor(site_url('Biobankin/read2/$1'),'<i class="fa fa-th-list" aria-hidden="true"></i>', array('class' => 'btn btn-warning btn-sm')), 'id_biobankin_detail');
        }
        else if ($lvl == 3){
            $this->datatables->add_column('action', anchor(site_url('Biobankin/read2/$1'),'<i class="fa fa-th-list" aria-hidden="true"></i>', array('class' => 'btn btn-warning btn-sm')) ."
            ".'<button type="button" class="btn_edit_det btn btn-info btn-sm" aria-hidden="true"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>', 'id_biobankin_detail');
            // $this->datatables->add_column('action', '<button type="button" class="btn_edit_det btn btn-info btn-sm" aria-hidden="true"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>', 'barcode_water');
        }
        else {
            // $this->datatables->add_column('action', '<button type="button" class="btn_edit_det btn btn-info btn-sm" aria-hidden="true"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>'." 
            //    ".'<button type="button" class="btn_delete btn btn-danger btn-sm" data-id="$1" aria-hidden="true"><i class="fa fa-trash-o" aria-hidden="true"></i></button>', 'barcode_water');

               $this->datatables->add_column('action', anchor(site_url('Biobankin/read2/$1'),'<i class="fa fa-th-list" aria-hidden="true"></i>', array('class' => 'btn btn-warning btn-sm')) ."
               ".'<button type="button" class="btn_edit_det btn btn-info btn-sm" aria-hidden="true"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>'." 
               ".'<button type="button" class="btn_delete btn btn-danger btn-sm" data-id="$1" aria-hidden="true"><i class="fa fa-trash-o" aria-hidden="true"></i></button>', 'id_biobankin_detail');
        }
        return $this->datatables->generate();
    }

    function subjsonreplicate($id) {
        $this->datatables->select('a.id_biobankin_replicate, a.id_biobankin_detail, a.barcode_water, e.id_one_water_sample, a.weight,
                             a.concentration_dna, a.volume, b.culture, a.comments,
                             a.barcode_tube, a.cryobox, 
                             concat("F",c.freezer,"-","S",c.shelf,"-","R",c.rack,"-","T",c.tray) AS location,
                             a.comments, a.id_culture, a.id_location, a.id_pos, 
                             c.freezer,c.shelf,c.rack,c.tray, d.rows1, d.columns1
                             ');
        $this->datatables->from('biobank_in_replicate a');
        $this->datatables->join('ref_culture b', 'a.id_culture=b.id_culture', 'left');
        $this->datatables->join('ref_location c', 'a.id_location=c.id_location', 'left');
        $this->datatables->join('ref_position d', 'a.id_pos=d.id_pos', 'left');
        $this->datatables->join('biobank_in_detail e', 'a.id_biobankin_detail=e.id_biobankin_detail', 'left');
        $this->datatables->where('a.flag', '0');
        $this->datatables->where('a.id_biobankin_detail', $id);
        // $this->datatables->group_by('a.id_sample');
        $lvl = $this->session->userdata('id_user_level');
        if ($lvl == 4){
            $this->datatables->add_column('action', '', 'barcode_water');
        }
        else if ($lvl == 3){
            $this->datatables->add_column('action', '<button type="button" class="btn_edit_det btn btn-info btn-sm" aria-hidden="true"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>', 'barcode_water');
        }
        else {
            $this->datatables->add_column('action', '<button type="button" class="btn_edit_det btn btn-info btn-sm" aria-hidden="true"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>'." 
               ".'<button type="button" class="btn_delete btn btn-danger btn-sm" data-id="$1" aria-hidden="true"><i class="fa fa-trash-o" aria-hidden="true"></i></button>', 'barcode_water');
        }
        return $this->datatables->generate();
    }

    function get_by_id($id)
    {
        $this->db->where($this->id_table, $id);
        $this->db->where('flag', '0');
        // $this->db->where('lab', $this->session->userdata('lab'));
        return $this->db->get($this->table)->row();
    }

    function get_by_id_detail($id)
    {
        $this->db->where('barcode_water', $id);
        $this->db->where('flag', '0');
        // $this->db->where('lab', $this->session->userdata('lab'));
        return $this->db->get('biobank_in_detail')->row();
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
    
        $this->db->select("
            biobank_in.id_one_water_sample, 
            biobank_in.date_conduct, 
            ref_person.initial, 
            ref_person.realname, 
            biobank_in.comments, 
            biobank_in.id_person, 
            biobank_in.flag, 
            biobank_in.user_created, 
            biobank_in.user_review, 
            biobank_in.review, 
            user.full_name
        ");
    
        $this->db->from('biobank_in');
        // $this->db->join('ref_sampletype', 'biobank_in.id_sampletype = ref_sampletype.id_sampletype', 'left');
        $this->db->join('ref_person', 'biobank_in.id_person = ref_person.id_person', 'left');
        $this->db->join('tbl_user user', 'biobank_in.user_review = user.id_users', 'left');
        $this->db->where('biobank_in.id_one_water_sample', $id);
        $this->db->where('biobank_in.flag', '0');
    
        $query = $this->db->get();
        return $query->row();
    }

    function get_detail_replicate($id)
    {
        $response = array();
    
        $this->db->select("
            biobank_in.id_one_water_sample, 
            ref_sampletype.id_sampletype, 
            ref_sampletype.sampletype AS sampletypecombination, 
            biobank_in.date_conduct,
            biobank_in_detail.replicates, 
            biobank_in_detail.id_biobankin_detail,
            ref_person.initial, 
            ref_person.realname, 
            biobank_in.comments, 
            biobank_in.id_person, 
            biobank_in.flag, 
            biobank_in.user_created, 
            biobank_in.user_review, 
            biobank_in.review, 
            user.full_name,
    
            (
                SELECT GROUP_CONCAT(CONCAT(ref_sampletype.sampletype) SEPARATOR ', ')
                FROM sample_reception_sample AS srs
                LEFT JOIN ref_sampletype ON srs.id_sampletype = ref_sampletype.id_sampletype
                WHERE srs.id_one_water_sample = biobank_in.id_one_water_sample
            ) AS sampletype
        ");
    
        $this->db->from('biobank_in');
        $this->db->join('ref_person', 'biobank_in.id_person = ref_person.id_person', 'left');
        $this->db->join('biobank_in_detail', 'biobank_in.id_one_water_sample = biobank_in_detail.id_one_water_sample', 'left');
        $this->db->join('ref_sampletype', 'biobank_in_detail.id_sampletype = ref_sampletype.id_sampletype', 'left');
        $this->db->join('tbl_user user', 'biobank_in.user_review = user.id_users', 'left');
        $this->db->where('biobank_in_detail.id_biobankin_detail', $id);
        $this->db->where('biobank_in.flag', '0');
    
        $query = $this->db->get();
        return $query->row();
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

    function getID_one(){
        $q = $this->db->query('
        SELECT id_one_water_sample FROM sample_reception_sample
        WHERE id_one_water_sample NOT IN (SELECT id_one_water_sample FROM biobank_in)
        AND flag = 0
        ORDER BY id_one_water_sample');        
        $response = $q->result_array();
        return $response;
      }


      function samplecheck($id){
        $q = $this->db->query('
        select sample_reception_sampe.id_one_water_sample, ref_sampletype.sampletype
        from sample_reception_sampe
        left join ref_sampletype on sample_reception_sampe.id_sampletype = ref_sampletype.id_sampletype
        WHERE sample_reception_sampe.id_one_water_sample = "'.$id.'"
        ');        
        $response = $q->result_array();
        return $response;
      }    


    // Fuction insert data
    public function insert($data) {
        $this->db->insert($this->table, $data);
    }

    public function insert_freez($data_freez) {
        $this->db->insert('freezer_in', $data_freez);
    }    

    // Function update data
    function update($id, $data)
    {
        $this->db->where($this->id_table, $id);
        $this->db->update($this->table, $data);
    }

    function updateCancel($id, $data)
    {
        // Eksekusi query update
        $this->db->where($this->id_table, $id);
        $this->db->update($this->table, $data);

        // Cek apakah ada baris yang diubah
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }


    function update_freez($id, $data_freez)
    {
        $this->db->where('barcode_sample', $id);
        $this->db->update('freezer_in', $data_freez);
    }


    function insert_det($data)
    {
        $this->db->insert('biobank_in_detail', $data);
    }

    function insert_rep($data)
    {
        $this->db->insert('biobank_in_replicate', $data);
    }
    
    function update_det($id, $data)
    {
        $this->db->where('id_biobankin_detail', $id);
        $this->db->update('biobank_in_detail', $data);
    }

    function update_rep($id, $data)
    {
        $this->db->where('id_biobankin_replicate', $id);
        $this->db->update('biobank_in_replicate', $data);
    }

    // function update_barcode($id, $data)
    // {
    //     $this->db->where('barcode_id', $id);
    //     $this->db->update('ref_barcode', $data);
    // }

    // function insert_barcode($data) {
    //     $this->db->insert('ref_barcode', $data);
    // }

    // function update_barcode($id_sample, $id_testing_type, $data) {
    //     $this->db->where('id_sample', $id_sample);
    //     $this->db->where('id_testing_type', $id_testing_type);
    //     $this->db->update('ref_barcode', $data);
    // }

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

      function getCulture(){
        $response = array();
        $this->db->select('*');
        $this->db->where('flag', '0');
        $q = $this->db->get('ref_culture');
        $response = $q->result_array();
        return $response; 
      }


      function load_freezzz($id){
        $response = array();
        $this->db->select('*');
        $this->db->where('id_location', $id);
        $q = $this->db->get('ref_location');
        $response = $q->result_array();
        return $response; 

        // $q = $this->db->query('
        // SELECT freezer, shelf, rack, tray FROM ref_location
        // WHERE id_location = "'.$id.'"
        // ');        
        // $response = $q->result_array();
        // return $response;
      }      

    //   function load_freez($id){
    //     $q = $this->db->query('
    //     SELECT freezer, shelf, rack, tray FROM ref_location
    //     WHERE id_location = "'.$id.'"
    //     ');        
    //     $response = $q->result_array();
    //     return $response;
    //   }      

    //   function get_freezz($id1, $id2, $id3, $id4) {
    //     $sql = 'SELECT id_location FROM ref_location
    //             WHERE freezer = ? 
    //             AND shelf = ? 
    //             AND rack = ? 
    //             AND tray = ?
    //             AND flag = 0';
        
    //     $q = $this->db->query($sql, array($id1, $id2, $id3, $id4));        
    //     $response = $q->result_array();
    //     return $response;
    // }      

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
    // function get_freezz($id1, $id2, $id3, $id4){
    //     $q = $this->db->query('
    //     SELECT id_location FROM ref_location
    //     WHERE freezer = "'.$id1.'"
    //     AND shelf = "'.$id2.'"
    //     AND rack = "'.$id3.'"
    //     AND rack_level = "'.$id4.'"
    //     AND flag = 0 
    //     ');        
    //     $response = $q->result_array();
    //     return $response;
    //   }            

      function getFreezer1(){
        $response = array();
        // $this->db->select('freezer');
        // $q = $this->db->get('ref_location');
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

      function getPos1(){
        $response = array();
        $q = $this->db->query('
            SELECT DISTINCT rows1 FROM ref_position
            WHERE flag = 0 
        ');
        $response = $q->result_array();    
        return $response;
      }

      function getPos2(){
        $response = array();
        $q = $this->db->query('
            SELECT DISTINCT columns1 FROM ref_position
            WHERE flag = 0 
        ');

        $response = $q->result_array();    
        return $response;
      }      
    //   function getTest(){
    //     $response = array();
    //     $this->db->select('*');
    //     $this->db->where('flag', '0');
    //     $q = $this->db->get('ref_culture');
    //     $response = $q->result_array();
    //     return $response; 

    //     // $response = array();
    //     // $this->db->select('rt.testing_type_id, rt.testing_type');
    //     // $this->db->from('ref_testing rt');
    //     // $this->db->join('sample_reception_sample srs', 'rt.testing_type_id = srs.testing_type_id', 'left');
    //     // $this->db->where('rt.flag', '0');
    //     // // $this->db->where('srs.testing_type_id IS NULL');
    //     // $q = $this->db->get();
    //     // $response = $q->result_array();
    //     // return $response;
    //   }

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


    function getOneWaterSampleById($idOneWaterSample)
    {
        $this->db->select('sr.id_sampletype, rs.sampletype');
        $this->db->from('sample_reception_sample sr');
        $this->db->join('ref_sampletype rs', 'sr.id_sampletype = rs.id_sampletype', 'left');
        $this->db->where('sr.id_one_water_sample', $idOneWaterSample);
        $query = $this->db->get();
        return $query->row_array();
    }

    function barcode_restrict($id){

        $q = $this->db->query('
        select id_one_water_sample
        from biobank_in
        WHERE id_one_water_sample = "'.$id.'"
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