<?php
    if(!defined('BASEPATH')) exit('No direct script access allowed');

    class Ref_classification extends CI_Controller
    {
        function __construct()
        {
            parent::__construct();
            is_login();
            $this->load->model('Ref_classification_model');
            $this->load->library('form_validation');
            $this->load->library('datatables');
            $this->load->library('uuid');
        }

        function index()
        {
            $this->template->load('template','Ref_classification/index');
        }

        function jsonClassification()
        {
            header('Content-Type: application/json');
            echo $this->Ref_classification_model->jsonClassificationModel();
        }

        function saveClassification()
        {
            $mode = $this->input->post('mode',TRUE);
            $id = $this->input->post('classification_id',TRUE);
            $dt = new DateTime();

            if ($mode=="insert"){
                $data = array(
                    'classification_id' => $this->input->post('classification_id',TRUE),
                    'classification_name' => $this->input->post('classification_name',TRUE),
                    'date_collected' => $this->input->post('date_collected',TRUE),
                    'time_collected' => $this->input->post('time_collected',TRUE),
                    'flag' => '0',
                    'uuid' => $this->uuid->v4(),
                    'user_created' => $this->session->userdata('id_users'),
                    'date_created' => $dt->format('Y-m-d H:i:s'),
                );
                $this->Ref_classification_model->insertClassification($data);
                $this->session->set_flashdata('message', 'Create Record Success');    
            } else if ($mode == 'edit') {
                $data = array(
                    'classification_id' => $this->input->post('classification_id',TRUE),
                    'classification_name' => $this->input->post('classification_name',TRUE),
                    'date_collected' => $this->input->post('date_collected',TRUE),
                    'time_collected' => $this->input->post('time_collected',TRUE),
                    'flag' => '0',
                    'uuid' => $this->uuid->v4(),
                    'user_created' => $this->session->userdata('id_users'),
                    'date_created' => $dt->format('Y-m-d H:i:s'),     
                );
                $this->Ref_classification_model->updateClassification($id, $data);
                $this->session->set_flashdata('message', 'Update Record Success');    
            }
            redirect(site_url("Ref_classification"));
        }

        function deleteClassification($id)
        {
            $row = $this->Ref_classification_model->getById($id);
            $data = array(
                'flag' => 1,
                );
            if ($row) {
                $this->Ref_classification_model->destroyClassification($id, $data);
                $this->session->set_flashdata('message', 'Delete Record Success');
                redirect(site_url("Ref_classification"));
            } else {
                $this->session->set_flashdata('message', 'Delete Record Failed');
                redirect(site_url("Ref_classification"));
            }
        }
    }
?>