<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Extraction_liquid_model extends CI_Model
{

    public $table = 'extraction_liquid';
    public $id = 'barcode_sample';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

    // datatables
    function json() {
        $this->datatables->select('NULL AS toggle, extraction_liquid.id_extraction_liquid, extraction_liquid.number_sample, extraction_liquid.id_one_water_sample, ref_person.initial, ref_person.realname, 
        extraction_liquid.user_created, extraction_liquid.id_person, extraction_liquid.flag, extraction_liquid.user_review,
        extraction_liquid.review, user.full_name
        ', FALSE);
        $this->datatables->from('extraction_liquid');
        $this->datatables->join('ref_person', 'extraction_liquid.id_person = ref_person.id_person', 'left');
        $this->datatables->join('tbl_user user', 'extraction_liquid.user_review = user.id_users', 'left');
        // $this->datatables->join('ref_sampletype', 'extraction_liquid.id_sampletype = ref_sampletype.id_sampletype', 'left');

        // Filter by specific sample ID if provided (from Sample Reception redirect)
        if ($this->input->get_post('search_sample_id')) {
            $this->datatables->like('extraction_liquid.id_one_water_sample', $this->input->get_post('search_sample_id'));
        }

        $this->datatables->where('extraction_liquid.flag', '0');
        $lvl = $this->session->userdata('id_user_level');

        // Kolom Toggle (Sisi Kiri)
        $this->datatables->add_column('toggle', 
            '<button type="button" class="btn btn-sm btn-primary toggle-child">
                <i class="fa fa-plus-square"></i>
            </button>', 
        'id_one_water_sample');

        if ($lvl == 4){
            $this->datatables->add_column('action', '-');
        }
        else if ($lvl == 3){
            $this->datatables->add_column('action', '<button type="button" class="btn_edit btn btn-info btn-sm" aria-hidden="true"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>', 'id_one_water_sample');
        }
        else {
            $this->datatables->add_column('action', '<button type="button" class="btn_edit btn btn-info btn-sm" aria-hidden="true"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>'." 
                  ".'<button type="button" class="btn_delete btn btn-danger btn-sm" data-id="$1" aria-hidden="true"><i class="fa fa-trash-o" aria-hidden="true"></i></button>', 'id_one_water_sample');
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
    // public function insert($data) {
    //     $this->db->insert('extraction_liquid', $data);
    // }

    public function insert($data) {
        $this->db->insert('extraction_liquid', $data);
        return $data['id_one_water_sample']; // Mengembalikan ID project yang baru dibuat
    }

    public function insert_freez($data_freez) {
        $this->db->insert('freezer_in', $data_freez);
    }
    

    // Function update data
    function update($id, $data)
    {
        $this->db->where('barcode_sample', $id);
        $this->db->update('extraction_liquid', $data);
    }

    function update_freez($barcode_sample, $data_freez)
    {
        $this->db->where('barcode_sample', $barcode_sample);
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

    function barcode_restrict($id){

        $q = $this->db->query('
        select id_one_water_sample
        from extraction_liquid
        WHERE id_one_water_sample = "'.$id.'" and flag = 0
        ');        
        $response = $q->result_array();
        return $response;
      }    

    function barcode_check($id){
        // select ref_barcode.barcode, ref_sampletype.sampletype
        // from ref_barcode 
        // left join sample_reception_sample on ref_barcode.id_sample = sample_reception_sample.id_sample
        // left join sample_reception on sample_reception_sample.id_project = sample_reception.id_project
        // left join ref_sampletype on sample_reception.id_sampletype = ref_sampletype.id_sampletype
        // WHERE ref_barcode.barcode = "'.$id.'"
        // AND ref_barcode.barcode NOT IN (SELECT barcode_sample FROM extraction_liquid)

        $q = $this->db->query('
        select ref_sampletype.sampletype
        from sample_reception_sample 
        left join ref_sampletype on sample_reception_sample.id_sampletype = ref_sampletype.id_sampletype
        WHERE sample_reception_sample.id_one_water_sample = "'.$id.'"');        
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
        SELECT id_one_water_sample FROM sample_reception_sample
        WHERE id_one_water_sample NOT IN (SELECT id_one_water_sample FROM extraction_liquid)
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
        $this->db->where('sample_id', $id);
        $query = $this->db->get('sample_reception_sample');
        $response = $query->result_array();
        return $response; 
    }

    public function generate_barcode_sample($testing_type) {
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

        $this->db->select_max('CAST(SUBSTR(barcode_sample, ' . (strlen($prefix . $year) + 1) . ') AS UNSIGNED)', 'max_barcode');
        $this->db->like('barcode_sample', $prefix . $year, 'after');
        // $query = $this->db->get('ref_barcode');
        $query = $this->db->get('extraction_liquid_detail');
        $result = $query->row();
    
        $next_number = $result->max_barcode + 1;
        $padded_number = str_pad($next_number, 5, '0', STR_PAD_LEFT);
        return $prefix . $year . $padded_number;
    }

    public function insert_extraction($data) {
        $this->db->insert('extraction_liquid_detail', $data);
    }

    function update_extraction($id_one_water_sample, $data)
    {
        $this->db->where('id_one_water_sample', $id_one_water_sample);
        $this->db->update('extraction_liquid', $data);
    }

    public function get_extractions_by_project($id_one_water_sample) {
        $this->db->select('
            extraction_liquid_detail.id_extraction_liquid_detail, 
            extraction_liquid_detail.id_one_water_sample, 
            extraction_liquid_detail.barcode_sample, 
            extraction_liquid_detail.date_extraction, 
            ref_sampletype.sampletype,
            extraction_liquid_detail.barcode_tube,
            extraction_liquid_detail.cryobox,
            extraction_liquid_detail.kit_lot,
            extraction_liquid_detail.comments
        ');
        $this->db->from('extraction_liquid_detail');
        $this->db->join('ref_sampletype', 'extraction_liquid_detail.id_sampletype = ref_sampletype.id_sampletype', 'left');
        $this->db->where('extraction_liquid_detail.id_one_water_sample', $id_one_water_sample);
        $this->db->where('extraction_liquid_detail.flag', '0');
        $query = $this->db->get()->result();
    
        $lvl = $this->session->userdata('id_user_level');
        foreach ($query as $row) {
            if ($lvl == 4) {
                // Level 4 (read-only) gets no action buttons
                $row->action = '-';
            } else if ($lvl == 3) {
                // Level 3 (user) gets only edit button
                $row->action = '
                    <button class="btn btn-info btn-sm btn_edit_child" data-id="' . $row->barcode_sample . '">
                        <i class="fa fa-pencil"></i>
                    </button>';
            } else {
                // Level 1-2 (admin/manager) get both edit and delete buttons
                $row->action = '
                    <button class="btn btn-info btn-sm btn_edit_child" data-id="' . $row->barcode_sample . '">
                        <i class="fa fa-pencil"></i>
                    </button>
                    <button class="btn btn-danger btn-sm btn_delete_child" data-id="' . $row->barcode_sample . '">
                        <i class="fa fa-trash"></i>
                    </button>';
            }
        }
    
        return $query;
    }

    public function get_extraction_child($barcode_sample) {
        $this->db->select('
            eld.id_one_water_sample, 
            eld.barcode_sample, 
            rst.sampletype, 
            srs.id_sampletype,
            eld.id_location,
            eld.date_extraction,
            eld.membrane_filter,
            eld.filtration_volume,
            eld.id_kit,
            eld.kit_lot,
            eld.barcode_tube,
            eld.fin_volume,
            eld.dna_concentration,
            eld.cryobox,
            loc.freezer,
            loc.shelf,
            loc.rack,
            loc.tray,
            pos.columns1,
            pos.rows1,  
            eld.comments,
            eld.user_created,
            eld.other_kit
        ');
        $this->db->from('extraction_liquid_detail eld');
        $this->db->join('sample_reception_sample srs', 'eld.id_one_water_sample = srs.id_one_water_sample', 'left');
        $this->db->join('ref_sampletype rst', 'srs.id_sampletype = rst.id_sampletype', 'left');
        $this->db->join('ref_kit kit', 'eld.id_kit = kit.id_kit', 'left');
        $this->db->join('ref_location loc', 'eld.id_location = loc.id_location', 'left');
        $this->db->join('ref_position pos', 'eld.id_pos = pos.id_pos', 'left');
        // $this->db->join('tbl_user user', 'eld.user_review = user.id_users', 'left');
        // $this->db->join('ref_person rp', 'eld.id_person = rp.id_person', 'left');
        $this->db->where('eld.barcode_sample', $barcode_sample);
        $this->db->where('eld.flag', '0');
        
        $query = $this->db->get();
    
        if ($query->num_rows() > 0) {
            echo json_encode($query->row());
        } else {
            echo json_encode(["error" => "Data tidak ditemukan"]);
        }
    
        exit; // **Tambahkan ini untuk mencegah output tambahan**
    }

    function getSampleType(){
        $response = array();
        $this->db->select('*');
        $this->db->where('flag', '0');
        $this->db->order_by('id_sampletype', 'ASC');
        $q = $this->db->get('ref_sampletype');
        $response = $q->result_array();
        return $response;
    }

    function update_child($id, $data)
    {
        $this->db->where('barcode_sample', $id);
        $this->db->update('extraction_liquid_detail', $data);
    }

    function get_by_id_extraction($id_one_water_sample)
    {
        $this->db->where('id_one_water_sample', $id_one_water_sample);
        $this->db->where('flag', '0');
        // $this->db->where('lab', $this->session->userdata('lab'));
        return $this->db->get('extraction_liquid')->row();
    }

    public function update_extraction_child($barcode_sample, $data) {
        $this->db->where('barcode_sample', $barcode_sample);
        $this->db->update('extraction_liquid_detail', $data);
        
        return $this->db->affected_rows() > 0; // Return true jika update berhasil
    }

    function get_by_id_extraction_child($barcode_sample)
    {
        $this->db->where('barcode_sample', $barcode_sample);
        $this->db->where('flag', '0');
        // $this->db->where('lab', $this->session->userdata('lab'));
        return $this->db->get('extraction_liquid_detail')->row();
    }

    function updateCancel($id, $data)
    {
        $this->db->where('id_one_water_sample', $id);
        $this->db->update('extraction_liquid', $data);

        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }


    public function get_extraction_by_id($id_one_water_sample) {
        $this->db->select('
            extraction_liquid_detail.id_extraction_liquid_detail, 
            extraction_liquid_detail.id_one_water_sample, 
            extraction_liquid_detail.barcode_sample, 
            extraction_liquid_detail.date_extraction, 
            ref_sampletype.sampletype,
            extraction_liquid_detail.barcode_tube,
            extraction_liquid_detail.cryobox,
            extraction_liquid_detail.kit_lot,
            extraction_liquid_detail.comments
        ');
        $this->db->from('extraction_liquid_detail');
        $this->db->join('ref_sampletype', 'extraction_liquid_detail.id_sampletype = ref_sampletype.id_sampletype', 'left');
        $this->db->where('extraction_liquid_detail.id_one_water_sample', $id_one_water_sample);
        $this->db->where('extraction_liquid_detail.flag', '0');
        $query = $this->db->get()->result();
    
        $lvl = $this->session->userdata('id_user_level');
        foreach ($query as $row) {
            if ($lvl == 4) {
                // Level 4 (read-only) gets no action buttons
                $row->action = '-';
            } else if ($lvl == 3) {
                // Level 3 (user) gets only edit button
                $row->action = '
                    <button class="btn btn-info btn-sm btn_edit_child" data-id="' . $row->barcode_sample . '">
                        <i class="fa fa-pencil"></i>
                    </button>';
            } else {
                // Level 1-2 (admin/manager) get both edit and delete buttons
                $row->action = '
                    <button class="btn btn-info btn-sm btn_edit_child" data-id="' . $row->barcode_sample . '">
                        <i class="fa fa-pencil"></i>
                    </button>
                    <button class="btn btn-danger btn-sm btn_delete_child" data-id="' . $row->barcode_sample . '">
                        <i class="fa fa-trash"></i>
                    </button>';
            }
        }
    
        return $query;
    }

      
}

/* End of file Tbl_delivery_model.php */
/* Location: ./application/models/Tbl_delivery_model.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2022-12-14 03:38:42 */
/* http://harviacode.com */