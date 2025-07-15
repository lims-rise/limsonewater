<?php
    if(!defined('BASEPATH')) exit('No direct script access allowed');

    class Ref_client_model extends CI_Model
    {

        public $table = 'ref_client';
        public $id = 'id_client_contact';
        public $order = 'DESC';

        function __construct()
        {
            parent::__construct();
        }

        function jsonClientModel()
        {
            $this->datatables->select('id_client_contact, client_name, address, phone1, phone2, email, date_collected, time_collected');
            $this->datatables->from('ref_client');
            $this->datatables->where('flag', '0');
            $lvl = $this->session->userdata('id_user_level');
            if ($lvl == 4){
                $this->datatables->add_column('action', '', 'id_client_contact');
            }
            else if (($lvl == 2) | ($lvl == 3)){
                $this->datatables->add_column('action', '<button type="button" class="btn_edit btn btn-info btn-sm" aria-hidden="true"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>Update</button>', 'id_client_contact');
            }
            else {
                $this->datatables->add_column('action', '<button type="button" class="btn_edit btn btn-info btn-sm" aria-hidden="true"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>Update</button>'." 
                    ".anchor(site_url('Ref_client/deleteClient/$1'),'<i class="fa fa-trash-o" aria-hidden="true"></i>','class="btn btn-danger btn-sm" onclick="javasciprt: return confirm(\'Confirm deleting sample : $1 ?\')"'), 'id_client_contact');
            }
            return $this->datatables->generate();

        }

        function insertClient($data)
        {
            $this->db->insert('ref_client', $data);

        }

        function updateClient($id, $data)
        {
            $this->db->where('id_client_contact', $id);
            $this->db->update('ref_client', $data);
        }

        function getById($id)
        {
            $this->db->where('id_client_contact', $id);
            $this->db->where('flag', '0');
            return $this->db->get($this->table)->row();
        }

        function destroyClient($id, $data)
        {
            $this->db->where('id_client_contact', $id);
            $this->db->update('ref_client', $data);
        }
    }
?>