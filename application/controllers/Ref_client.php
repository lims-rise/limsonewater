<?php
    if(!defined('BASEPATH')) exit('No direct script access allowed');

    class Ref_client extends CI_Controller
    {
        function __construct()
        {
            parent::__construct();
            is_login();
            $this->load->model('Ref_client_model');
            $this->load->library('form_validation');
            $this->load->library('datatables');
            $this->load->library('uuid');
        }

        function index()
        {
            $this->template->load('template','Ref_client/index');
        }

        function jsonClient()
        {
            header('Content-Type: application/json');
            echo $this->Ref_client_model->jsonClientModel();
        }

        function saveClient()
        {
            $mode = $this->input->post('mode',TRUE);
            $id = $this->input->post('id_client_contact',TRUE);
            $dt = new DateTime();

            if ($mode=="insert"){
                $data = array(
                    'id_client_contact' => $this->input->post('id_client_contact',TRUE),
                    'client_name' => $this->input->post('client_name',TRUE),
                    'address' => $this->input->post('address',TRUE),
                    'phone1' => $this->input->post('phone1',TRUE),
                    'phone2' => $this->input->post('phone2',TRUE),
                    'email' => $this->input->post('email',TRUE),
                    'date_collected' => $this->input->post('date_collected',TRUE),
                    'time_collected' => $this->input->post('time_collected',TRUE),
                    'flag' => '0',
                    'uuid' => $this->uuid->v4(),
                    'user_created' => $this->session->userdata('id_users'),
                    'date_created' => $dt->format('Y-m-d H:i:s'),
                );
                // var_dump($data);
                // die();
                $this->Ref_client_model->insertClient($data);
                $this->session->set_flashdata('message', 'Create Record Success');    
            } else if ($mode == 'edit') {
                $data = array(
                    'id_client_contact' => $this->input->post('id_client_contact',TRUE),
                    'client_name' => $this->input->post('client_name',TRUE),
                    'address' => $this->input->post('address',TRUE),
                    'phone1' => $this->input->post('phone1',TRUE),
                    'phone2' => $this->input->post('phone2',TRUE),
                    'email' => $this->input->post('email',TRUE),
                    'date_collected' => $this->input->post('date_collected',TRUE),
                    'time_collected' => $this->input->post('time_collected',TRUE),
                    'flag' => '0',
                    'uuid' => $this->uuid->v4(),
                    'user_created' => $this->session->userdata('id_users'),
                    'date_created' => $dt->format('Y-m-d H:i:s'),     
                );
                $this->Ref_client_model->updateClient($id, $data);
                $this->session->set_flashdata('message', 'Update Record Success');    
            }
            redirect(site_url("Ref_client"));
        }

        function deleteClient($id)
        {
            $row = $this->Ref_client_model->getById($id);
            $data = array(
                'flag' => 1,
                );
            if ($row) {
                $this->Ref_client_model->destroyClient($id, $data);
                $this->session->set_flashdata('message', 'Delete Record Success');
                redirect(site_url("Ref_client"));
            } else {
                $this->session->set_flashdata('message', 'Delete Record Failed');
                redirect(site_url("Ref_client"));
            }
        }
    }
?>