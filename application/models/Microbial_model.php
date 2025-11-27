<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Microbial_model extends CI_Model
{

    public $table = 'microbial';
    public $id = 'id_one_water_sample';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

    // datatables
    function json() {
        // Simplified query for new structure
        $this->datatables->select('a.id_one_water_sample, a.id_microbial, a.microbial_barcode, a.description, a.user_created, a.date_created, p.full_name as created_by, a.document_filename');
        $this->datatables->from('microbial a');
        $this->datatables->join('tbl_user p', 'a.user_created = p.id_users', 'left');

        // Filter by specific sample ID if provided (from Sample Reception redirect)
        if ($this->input->get_post('search_sample_id')) {
            $this->datatables->like('a.id_one_water_sample', $this->input->get_post('search_sample_id'));
        }

        $this->datatables->where('a.flag', '0');
        
        $lvl = $this->session->userdata('id_user_level');
        if ($lvl == 4){
            $this->datatables->add_column('action', '', 'id_one_water_sample');
        }
        else if ($lvl == 3){
            $this->datatables->add_column('action', '<button type="button" class="btn_view_document btn btn-success btn-sm" data-filename="$8" title="View Document" style="margin-right:5px;"><i class="fa fa-file-pdf-o" aria-hidden="true"></i></button><button type="button" class="btn_edit btn btn-info btn-sm" aria-hidden="true"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>', 'id_one_water_sample, id_microbial, microbial_barcode, description, user_created, date_created, created_by, document_filename');
        }
        else {
            $this->datatables->add_column('action', '<button type="button" class="btn_view_document btn btn-success btn-sm" data-filename="$8" title="View Document" style="margin-right:5px;"><i class="fa fa-file-pdf-o" aria-hidden="true"></i></button><button type="button" class="btn_edit btn btn-info btn-sm" aria-hidden="true"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>'." 
                  ".'<button type="button" class="btn_delete btn btn-danger btn-sm" data-id="$1" aria-hidden="true"><i class="fa fa-trash-o" aria-hidden="true"></i></button>', 'id_one_water_sample, id_microbial, microbial_barcode, description, user_created, date_created, created_by, document_filename');
        }

        return $this->datatables->generate();
    }

    function getID_one(){
        $q = $this->db->query('
        SELECT id_one_water_sample FROM sample_reception_sample
        WHERE id_one_water_sample NOT IN (SELECT id_one_water_sample FROM microbial)
        AND flag = 0
        ORDER BY id_one_water_sample');        
        $response = $q->result_array();
        return $response;
      }


    function get_by_id($id)
    {
        $this->db->where($this->id, $id);
        $this->db->where('flag', '0');
        // $this->db->where('lab', $this->session->userdata('lab'));
        return $this->db->get($this->table)->row();
    }

    // Fuction insert data
    public function insert($data) {
        $this->db->insert('microbial', $data);
    }

    // Function update data
    function updateMicrobial($id_one_water_sample, $data) {
        $this->db->where('id_one_water_sample', $id_one_water_sample);
        $this->db->update('microbial', $data);
    }

    function updateMicrobialData($id_microbial, $data) {
        $this->db->where('id_microbial', $id_microbial);
        $this->db->update('microbial', $data);
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

    function barcode_check($id){
        $q = $this->db->query('
        select a.id_sampletype, b.sampletype
        from sample_reception_sample a 
        left join ref_sampletype b on a.id_sampletype = b.id_sampletype
        WHERE a.id_one_water_sample = "'.$id.'"
        ');        
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
        from microbial
        WHERE id_one_water_sample = "'.$id.'" AND flag = 0
        ');        
        $response = $q->result_array();
        return $response;
    }

    function getDryWeight($id_one_water_sample) {
        $this->db->select('m48.dry_weight_persen');
        $this->db->from('moisture_content as mc');
        $this->db->join('moisture72 as m48', 'mc.id_moisture = m48.id_moisture', 'left');
        $this->db->where('mc.id_moisture IS NOT NULL');
        $this->db->where('mc.id_one_water_sample', $id_one_water_sample);
        $this->db->where('mc.flag', '0');
        $this->db->where('m48.flag', '0'); 
        $query = $this->db->get();
        
        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return null; // Return null if no data found
        }
    }

        function getWeight($id_one_water_sample) {
        $this->db->select('eb.weight');
        $this->db->from('extraction_biosolid as eb');
        // $this->db->join('moisture72 as m48', 'eb.id_moisture = m48.id_moisture', 'left');
        $this->db->where('eb.id_one_water_sample IS NOT NULL');
        $this->db->where('eb.id_one_water_sample', $id_one_water_sample);
        $this->db->where('eb.flag', '0');
        // $this->db->where('m48.flag', '0'); 
        $query = $this->db->get();
        
        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return null; // Return null if no data found
        }
    }

    function getReviewer($user_review) {
        $this->db->select('full_name');
        $this->db->from('tbl_user');
        $this->db->where('id_users', $user_review);
        $query = $this->db->get();
        
        if ($query->num_rows() > 0) {
            return $query->row()->full_name;
        } else {
            return null;
        }
    }



      
}

/* End of file Tbl_delivery_model.php */
/* Location: ./application/models/Tbl_delivery_model.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2022-12-14 03:38:42 */
/* http://harviacode.com */