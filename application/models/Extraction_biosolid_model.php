<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Extraction_biosolid_model extends CI_Model
{

    public $table = 'extraction_biosolid';
    public $id = 'barcode_sample';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

    // datatables
    function json() {
        $this->datatables->select('NULL AS toggle, extraction_biosolid.id_extraction_biosolid, extraction_biosolid.number_sample, extraction_biosolid.id_one_water_sample, ref_person.initial, extraction_biosolid.user_created, ref_person.realname,
        extraction_biosolid.id_person, extraction_biosolid.flag, extraction_biosolid.user_review,
        extraction_biosolid.review, user.full_name, extraction_biosolid.date_created, extraction_biosolid.date_updated,
        (SELECT COUNT(*) FROM extraction_biosolid_detail WHERE extraction_biosolid_detail.id_extraction_biosolid = extraction_biosolid.id_extraction_biosolid AND extraction_biosolid_detail.flag = "0") AS active_samples,
        ', FALSE);
        $this->datatables->from('extraction_biosolid');
        $this->datatables->join('ref_person', 'extraction_biosolid.id_person = ref_person.id_person', 'left');
        $this->datatables->join('tbl_user user', 'extraction_biosolid.user_review = user.id_users', 'left');
        // $this->datatables->join('ref_sampletype', 'extractextraction_biosolidion_culture.id_sampletype = ref_sampletype.id_sampletype', 'left');

        // Filter by specific sample ID if provided (from Sample Reception redirect)
        if ($this->input->get_post('search_sample_id')) {
            $this->datatables->like('extraction_biosolid.id_one_water_sample', $this->input->get_post('search_sample_id'));
        }

        $this->datatables->where('extraction_biosolid.flag', '0');
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

        $this->db->order_by('extraction_biosolid.id_extraction_biosolid', 'DESC');

        return $this->datatables->generate();
    }

    function get_by_id_extraction($id_extraction_biosolid)
    {
        $this->db->where('id_extraction_biosolid', $id_extraction_biosolid);
        $this->db->where('flag', '0');
        // $this->db->where('lab', $this->session->userdata('lab'));
        return $this->db->get('extraction_biosolid')->row();
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
        $query = $this->db->get('extraction_biosolid_detail');
        $result = $query->row();
    
        $next_number = $result->max_barcode + 1;
        $padded_number = str_pad($next_number, 5, '0', STR_PAD_LEFT);
        return $prefix . $year . $padded_number;
    }

    // Generate barcode for biosolid samples with simple prefix
    public function generate_barcode_sample_simple($prefix = 'BS') {
        // Get the current year (2 digits)
        $year = date('y');
        
        // Get max barcode number for this year and prefix
        $this->db->select_max('CAST(SUBSTR(barcode_sample, ' . (strlen($prefix . $year) + 1) . ') AS UNSIGNED)', 'max_barcode');
        $this->db->like('barcode_sample', $prefix . $year, 'after');
        $this->db->where('flag', '0');
        $query = $this->db->get('extraction_biosolid_detail');
        $result = $query->row();
        
        $next_number = ($result->max_barcode ? $result->max_barcode : 0) + 1;
        $padded_number = str_pad($next_number, 5, '0', STR_PAD_LEFT);
        
        return $prefix . $year . $padded_number;
    }

    public function get_extractions_by_project($id_extraction_biosolid) {
        $this->db->select('
            extraction_biosolid_detail.id_extraction_biosolid_detail, 
            extraction_biosolid_detail.id_extraction_biosolid,
            extraction_biosolid_detail.barcode_sample, 
            extraction_biosolid_detail.date_extraction, 
            extraction_biosolid_detail.weight,
            extraction_biosolid_detail.volume,
            extraction_biosolid_detail.dilution,
            extraction_biosolid_detail.kit_lot,
            extraction_biosolid_detail.comments,
            extraction_biosolid_detail.barcode_tube,
            extraction_biosolid_detail.dna_concentration,
            extraction_biosolid_detail.cryobox,
            extraction_biosolid_detail.id_kit,
            extraction_biosolid_detail.other_kit,
            extraction_biosolid_detail.id_location,
            extraction_biosolid_detail.id_pos,
            ref_sampletype.sampletype,
            ref_sampletype.id_sampletype,
            ref_location.freezer,
            ref_location.shelf,
            ref_location.rack,
            ref_location.tray,
            ref_position.rows1,
            ref_position.columns1
        ');
        $this->db->from('extraction_biosolid_detail');
        $this->db->join('ref_sampletype', 'extraction_biosolid_detail.id_sampletype = ref_sampletype.id_sampletype', 'left');
        $this->db->join('ref_location', 'extraction_biosolid_detail.id_location = ref_location.id_location', 'left');
        $this->db->join('ref_position', 'extraction_biosolid_detail.id_pos = ref_position.id_pos', 'left');
        $this->db->where('extraction_biosolid_detail.id_extraction_biosolid', $id_extraction_biosolid);
        $this->db->where('extraction_biosolid_detail.flag', '0');
        $query = $this->db->get()->result();
    
        // Add action buttons based on user level
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
   
    // Function insert parent data
    public function insert_parent($data) {
        $this->db->insert('extraction_biosolid', $data);
        return $this->db->insert_id(); // Return the auto-increment ID
    }

    // Function insert child/detail data
    public function insert_extraction_detail($data) {
        $this->db->insert('extraction_biosolid_detail', $data);
    }

    // Fuction insert data (legacy - kept for compatibility)
    public function insert($data) {
        $this->db->insert('extraction_biosolid', $data);
        return $data['id_one_water_sample']; // Mengembalikan ID project yang baru dibuat
    }

    public function insert_extraction($data) {
        $this->db->insert('extraction_biosolid_detail', $data);
    }

    public function insert_freez($data_freez) {
        $this->db->insert('freezer_in', $data_freez);
    }
    

    // Function update data
    function update_extraction($id_extraction_biosolid, $data)
    {
        $this->db->where('id_extraction_biosolid', $id_extraction_biosolid);
        $this->db->update('extraction_biosolid', $data);
    }

    function update_child($id, $data)
    {
        $this->db->where('barcode_sample', $id);
        $this->db->update('extraction_biosolid_detail', $data);
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
        from extraction_biosolid
        WHERE id_one_water_sample = "'.$id.'" and flag = "0"
        ');        
        $response = $q->result_array();
        return $response;
      }    


    function barcode_check($id){
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
        WHERE id_one_water_sample NOT IN (SELECT id_one_water_sample FROM extraction_biosolid)
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

    public function get_extraction_child($barcode_sample) {
        $this->db->select('
            ecp.id_one_water_sample, 
            ecp.barcode_sample, 
            rst.sampletype, 
            ecp.id_sampletype,
            ecp.id_location,
            ecp.date_extraction,
            ecp.weight,
            ecp.id_kit,
            ecp.kit_lot,
            ecp.barcode_tube,
            ecp.dna_concentration,
            ecp.cryobox,
            loc.freezer,
            loc.shelf,
            loc.rack,
            loc.tray,
            pos.columns1,
            pos.rows1,  
            ecp.comments,
            ecp.user_created,
            ecp.user_review,
            ecp.review,
            user.full_name,
            ecp.other_kit
        ');
        $this->db->from('extraction_biosolid_detail ecp');
        $this->db->join('ref_sampletype rst', 'ecp.id_sampletype = rst.id_sampletype', 'left');
        $this->db->join('ref_kit kit', 'ecp.id_kit = kit.id_kit', 'left');
        $this->db->join('ref_location loc', 'ecp.id_location = loc.id_location', 'left');
        $this->db->join('ref_position pos', 'ecp.id_pos = pos.id_pos', 'left');
        // $this->db->join('ref_sequence rs', 'ecp.sequence_id = rs.sequence_id', 'left');
        $this->db->join('tbl_user user', 'ecp.user_review = user.id_users', 'left');
        // $this->db->join('ref_person rp', 'ecp.id_person = rp.id_person', 'left');
        $this->db->where('ecp.barcode_sample', $barcode_sample);
        $this->db->where('ecp.flag', '0');
        
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

    function get_by_id_extraction_child($barcode_sample)
    {
        $this->db->where('barcode_sample', $barcode_sample);
        $this->db->where('flag', '0');
        // $this->db->where('lab', $this->session->userdata('lab'));
        return $this->db->get('extraction_biosolid_detail')->row();
    }

    public function update_extraction_child($barcode_sample, $data) {
        $this->db->where('barcode_sample', $barcode_sample);
        $this->db->update('extraction_biosolid_detail', $data);
        
        return $this->db->affected_rows() > 0; // Return true jika update berhasil
    }

    // function getSequenceType() {
    //     try {
    //         $this->db->select('sequence_id, sequence_type');
    //         $this->db->from('ref_sequence');
    //         $this->db->where('flag', 0);
    //         $this->db->where_in('is_custom', [0, 1]);
    //         $this->db->order_by('sequence_id', 'ASC');
        
    //         $query = $this->db->get();
    //         return $query->result_array();
    //     } catch (Exception $e) {
    //         log_message('error', 'Error in getSequenceType: ' . $e->getMessage());
    //         return array(); // Return empty array on error
    //     }
    // }
    
    function updateCancel($id_extraction_biosolid, $data)
    {
        $this->db->where('id_extraction_biosolid', $id_extraction_biosolid);
        $this->db->update('extraction_biosolid', $data);

        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function get_extraction_by_id($id_one_water_sample) {
        $this->db->select('
            extraction_biosolid_detail.id_extraction_biosolid_detail, 
            extraction_biosolid_detail.id_one_water_sample, 
            extraction_biosolid_detail.barcode_sample, 
            extraction_biosolid_detail.date_extraction, 
            extraction_biosolid_detail.weight,
            ref_sampletype.sampletype,
            extraction_biosolid_detail.barcode_tube,
            extraction_biosolid_detail.cryobox,
            extraction_biosolid_detail.kit_lot,
            extraction_biosolid_detail.comments
        ');
        $this->db->from('extraction_biosolid_detail');
        $this->db->join('ref_sampletype', 'extraction_biosolid_detail.id_sampletype = ref_sampletype.id_sampletype', 'left');
        // $this->db->join('ref_sequence', 'extraction_biosolid_detail.sequence_id = ref_sequence.sequence_id', 'left');
        $this->db->where('extraction_biosolid_detail.id_one_water_sample', $id_one_water_sample);
        $this->db->where('extraction_biosolid_detail.flag', '0');
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
    
    /**
     * Get the first child barcode for a given id_extraction_biosolid
     * Used to determine the prefix for generating new barcodes in edit mode
     */
    public function get_first_child_barcode($id_extraction_biosolid) {
        $this->db->select('barcode_sample');
        $this->db->where('id_extraction_biosolid', $id_extraction_biosolid);
        $this->db->where('flag', '0');
        $this->db->order_by('id_extraction_biosolid_detail', 'ASC');
        $this->db->limit(1);
        $result = $this->db->get('extraction_biosolid_detail')->row();
        
        if ($result) {
            return $result->barcode_sample;
        }
        return null;
    }
    
    /**
     * Generate barcode based on existing prefix from another barcode
     * Simply get the max barcode and increment it
     */
    public function generate_barcode_from_existing($existing_barcode, $prefix = 'EBS') {
        if (empty($existing_barcode)) {
            // If no existing barcode, use generate_barcode_sample_simple
            return $this->generate_barcode_sample_simple($prefix);
        }
        
        // Get the current year (2 digits)
        $year = date('y');
        
        // Get max barcode number for this year and prefix from all extraction_biosolid_detail records
        $this->db->select_max('CAST(SUBSTR(barcode_sample, ' . (strlen($prefix . $year) + 1) . ') AS UNSIGNED)', 'max_barcode');
        $this->db->like('barcode_sample', $prefix . $year, 'after');
        $this->db->where('flag', '0');
        $query = $this->db->get('extraction_biosolid_detail');
        $result = $query->row();
        
        $next_number = ($result->max_barcode ? $result->max_barcode : 0) + 1;
        $padded_number = str_pad($next_number, 5, '0', STR_PAD_LEFT);
        
        return $prefix . $year . $padded_number;
    }
      
}

/* End of file Tbl_delivery_model.php */
/* Location: ./application/models/Tbl_delivery_model.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2022-12-14 03:38:42 */
/* http://harviacode.com */