<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Hemoflow_model extends CI_Model
{

    public $table = 'hemoflow';
    public $id = 'id_one_water_sample';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

    // datatables
    function json() {
        $this->datatables->select('a.id_one_water_sample, b.initial,
        d.sampletype, a.date_processed, a.time_processed, e.initial AS initial_proc, a.volume_filter,
        a.volume_eluted, a.comments, a.flag, 
        a.id_person, a.id_person_proc
        ');
        $this->datatables->from('hemoflow a');
        $this->datatables->join('ref_person b', 'a.id_person = b.id_person', 'left');
        $this->datatables->join('sample_reception_sample c', 'a.id_one_water_sample = c.id_one_water_sample', 'left');
        $this->datatables->join('ref_sampletype d', 'c.id_sampletype = d.id_sampletype', 'left');
        $this->datatables->join('ref_person e', 'a.id_person_proc = e.id_person', 'left');
        // $this->datatables->where('Hemoflow.id_country', $this->session->userdata('lab'));
        $this->datatables->where('a.flag', '0');
        $lvl = $this->session->userdata('id_user_level');
        if ($lvl == 4){
            $this->datatables->add_column('action', 'id_one_water_sample');
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

    function getID_one(){
        $q = $this->db->query('
        SELECT id_one_water_sample FROM sample_reception_sample
        WHERE id_one_water_sample NOT IN (SELECT id_one_water_sample FROM hemoflow)
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
        $this->db->insert('Hemoflow', $data);
    }

    // Function update data
    function update($id, $data)
    {
        $this->db->where('id_one_water_sample', $id);
        $this->db->update('Hemoflow', $data);
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

      
}

/* End of file Tbl_delivery_model.php */
/* Location: ./application/models/Tbl_delivery_model.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2022-12-14 03:38:42 */
/* http://harviacode.com */