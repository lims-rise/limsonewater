<?php
    if(!defined('BASEPATH')) exit('No direct script access allowed');

    class Ref_classification_model extends CI_Model
    {

        public $table = 'ref_classification';
        public $id = 'classification_id';
        public $order = 'DESC';

        function __construct()
        {
            parent::__construct();
        }

        function jsonClassificationModel()
        {
            $this->datatables->select('classification_id, classification_name, date_collected, time_collected');
            $this->datatables->from('ref_classification');
            $this->datatables->where('flag', '0');
            $lvl = $this->session->userdata('id_user_level');
            if ($lvl == 7){
                $this->datatables->add_column('action', '', 'classification_id');
            }
            else if (($lvl == 2) | ($lvl == 3)){
                $this->datatables->add_column('action', '<button type="button" class="btn_edit btn btn-info btn-sm" aria-hidden="true"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>Update</button>', 'classification_id');
            }
            else {
                $this->datatables->add_column('action', '<button type="button" class="btn_edit btn btn-info btn-sm" aria-hidden="true"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>Update</button>'." 
                    ".anchor(site_url('Ref_classification/deleteClassification/$1'),'<i class="fa fa-trash-o" aria-hidden="true"></i>','class="btn btn-danger btn-sm" onclick="javasciprt: return confirm(\'Confirm deleting sample : $1 ?\')"'), 'classification_id');
            }
            return $this->datatables->generate();

        }

        function insertClassification($data)
        {
            $this->db->insert('ref_classification', $data);

        }

        function updateClassification($id, $data)
        {
            $this->db->where('classification_id', $id);
            $this->db->update('ref_classification', $data);
        }

        function getById($id)
        {
            $this->db->where('classification_id', $id);
            $this->db->where('flag', '0');
            return $this->db->get($this->table)->row();
        }

        function destroyClassification($id, $data)
        {
            $this->db->where('classification_id', $id);
            $this->db->update('ref_classification', $data);
        }
    }
?>