<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Freezer_in_model extends CI_Model
{

    public $table = 'freezer_in';
    public $id = 'id';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

    // datatables
    function json() {
        $this->datatables->select('a.barcode_tube, a.barcode_sample, a.id, a.date_in, DATE_FORMAT(a.time_in, "%H:%i") AS time_in, b.initial,  
        a.cryobox, concat("F",d.freezer,"-","S",d.shelf,"-","R",d.rack,"-","T",d.tray) AS location, a.comments,
        a.id_person, a.id_location, a.flag');
        $this->datatables->from('freezer_in a');
        $this->datatables->join('ref_person b', 'a.id_person=b.id_person', 'left');
        $this->datatables->join('ref_location d', 'a.id_location=d.id_location', 'left');
        $this->datatables->where('a.flag', '0');

        $lvl = $this->session->userdata('id_user_level');
        if ($lvl == 4){
            $this->datatables->add_column('action', '', 'id');
        }
        else if (($lvl == 2) | ($lvl == 3)){
            $this->datatables->add_column('action', '<button type="button" class="btn_edit btn btn-info btn-sm" aria-hidden="true"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>Update</button>', 'id');
        }
        else {
            $this->datatables->add_column('action', '<button type="button" class="btn_edit btn btn-info btn-sm" aria-hidden="true"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>Update</button>'." 
                ".anchor(site_url('Freezer_in/delete/$1'),'<i class="fa fa-trash-o" aria-hidden="true"></i>','class="btn btn-danger btn-sm" onclick="javasciprt: return confirm(\'Confirm deleting sample : $1 ?\')"'), 'id');
        }
        return $this->datatables->generate();
    }

    function get_all()
    {
      $q = $this->db->query('SELECT 
      a.id, a.date_in, DATE_FORMAT(a.time_in, "%H:%i") AS time_in, b.initial, a.barcode_sample, a.barcode_tube, 
      concat("F",d.freezer,"-","S",d.shelf,"-","R",d.rack,"-","DRW",d.tray) AS location, a.comments,
      a.id_person, a.id_location, a.cryobox, a.flag
      FROM freezer_in a
      LEFT JOIN ref_person b ON a.id_person=b.id_person
      LEFT JOIN ref_location d ON a.id_location=d.id_location
      WHERE a.flag = 0
      ORDER BY a.id
      ');
      $response = $q->result();
      return $response;

      // $this->db->order_by('date_in, id', 'ASC');
        // $this->db->where('lab', $this->session->userdata('lab'));
        // $this->db->where('flag', '0');
        // return $this->db->get('v_freez_in')->result();
    }

    function get_by_id($id)
    {
        $this->db->where($this->id, $id);
        // $this->db->where('lab', $this->session->userdata('lab'));
        return $this->db->get($this->table)->row();
    }

    // insert data
    function insert($data)
    {
        $this->db->insert($this->table, $data);
    }
    
    // update data
    function update($id, $data)
    {
        $this->db->where('barcode_sample', $id);
        $this->db->update($this->table, $data);
    }

    function update_delete($id, $data)
    {
        $this->db->where($this->id, $id);
        $this->db->update($this->table, $data);
    }

    function barcode_check($id, $id2){
      $q = $this->db->query('
      SELECT * FROM
      (SELECT barcode_tube, barcode_sample FROM sample_extraction
      UNION ALL
      SELECT barcode_tube, barcode_water AS barcode_sample
      FROM sample_biobank_detail) x
      WHERE barcode_tube = "'.$id.'"
      AND barcode_tube NOT IN (SELECT barcode_tube FROM freezer_in WHERE barcode_sample <> "'.$id2.'")
      ');        
      $response = $q->result_array();
      return $response;
    }        

    function getLabtech(){
        $response = array();
        $this->db->select('*');
        $q = $this->db->get('ref_person');
        $response = $q->result_array();
    
        return $response;
      }

      function getFreezer(){
        $response = array();
        $this->db->select('freezer');
        $this->db->distinct();
        $this->db->where('flag', '0');
        $q = $this->db->get('ref_location');
        $response = $q->result_array();
        return $response;
      }

      function getShelf(){
        $response = array();
        $this->db->select('shelf');
        $this->db->distinct();
        $this->db->where('flag', '0');
        $q = $this->db->get('ref_location');
        $response = $q->result_array();
        return $response;
      }

      function getRack(){
        $response = array();
        $this->db->select('rack');
        $this->db->distinct();
        $this->db->where('flag', '0');
        $q = $this->db->get('ref_location');
        $response = $q->result_array();
        return $response;
      }
      
      function getTray(){
        $response = array();
        $this->db->select('tray');
        $this->db->distinct();
        $this->db->where('flag', '0');
        $q = $this->db->get('ref_location');
        $response = $q->result_array();
        return $response;
      }

      function find_freez($id){
        $q = $this->db->query('
        SELECT id_location, freezer, shelf, rack, tray
        FROM ref_location
        WHERE id_location = '.$id);
        $response = $q->result_array();
        return $response;    
      }

      function getFreezLoc($f,$s,$r,$rl){
        $this->db->select('id_location');
        $this->db->where('freezer', $f);
        $this->db->where('shelf', $s);
        $this->db->where('rack', $r);
        $this->db->where('tray', $rl);
        $this->db->where('flag', '0');
        return $this->db->get('ref_location')->row();
      }

    //   function validate1($id){
    //     $this->db->where('barcode_dna', $id);
    //     // $this->db->where('lab', $this->session->userdata('lab'));
    //     $q = $this->db->get($this->table);
    //     $response = $q->result_array();
    //     return $response;
    //     // return $this->db->get('ref_location_80')->row();
    //   }

}

/* End of file Tbl_delivery_model.php */
/* Location: ./application/models/Tbl_delivery_model.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2022-12-14 03:38:42 */
/* http://harviacode.com */