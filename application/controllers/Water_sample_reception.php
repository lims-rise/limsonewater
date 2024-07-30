<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
    require 'vendor/autoload.php';
    use PhpOffice\PhpSpreadsheet\IOFactory;
    use PhpOffice\PhpSpreadsheet\Spreadsheet;
    use PhpOffice\PhpSpreadsheet\Reader\Csv;
    use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
    use Google\Client as google_client;
    use Google\Service\Drive as google_drive;


// use PhpOffice\PhpSpreadsheet\Spreadsheet;
// use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
    
class Water_sample_reception extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        is_login();
        $this->load->model('Water_sample_reception_model');
        $this->load->library('form_validation');        
	    $this->load->library('datatables');
	    $this->load->library('uuid');
    }

    public function index()
    {
        $data['classification'] = $this->Water_sample_reception_model->getClassification();
        $data['labtech'] = $this->Water_sample_reception_model->getLabTech();
        $data['project_id'] = $this->Water_sample_reception_model->generate_project_id();
        $data['client'] = $this->Water_sample_reception_model->generate_client();
        $data['one_water_sample_id'] = $this->Water_sample_reception_model->generate_one_water_sample_id();
        $this->template->load('template','Water_sample_reception/index', $data);
    } 
    
    public function json() {
        header('Content-Type: application/json');
        echo $this->Water_sample_reception_model->json();
    }

    public function subjson() {
        $id = $this->input->get('id',TRUE);
        header('Content-Type: application/json');
        echo $this->Water_sample_reception_model->subjson($id);
    }

    public function subjson2() {
        $id2 = $this->input->get('id2',TRUE);

        header('Content-Type: application/json');
        echo $this->Water_sample_reception_model->subjson2($id2);
    }

    public function read($id)
    {
        $data['testing_type'] = $this->Water_sample_reception_model->getTest();
        $row = $this->Water_sample_reception_model->get_detail($id);
        if ($row) {
            $data = array(
                'project_id' => $row->project_id,
                'client' => $row->client,
                'one_water_sample_id' => $row->one_water_sample_id,
                'initial' => $row->initial,
                'date_arrival' => $row->date_arrival,
                'time_arrival' => $row->time_arrival,
                'date_collected' => $row->date_collected,
                'time_collected' => $row->time_collected,
                'client_sample_id' => $row->client_sample_id,
                'classification_name' => $row->classification_name,
                'comments' => $row->comments,
                'testing_type' => $this->Water_sample_reception_model->getTest(),
            );
                
            $this->template->load('template','water_sample_reception/index_det', $data);

        }
        else {
            // $this->template->load('template','Water_sample_reception/index_det', $test);
        }

    } 

    public function read2($id)
    {
        $data['test'] = $this->Water_sample_reception_model->getTest();
        $row = $this->Water_sample_reception_model->get_detail2($id);
        if ($row) {
            $data = array(
                'project_id' => $row->project_id,
                'sample_id' => $row->sample_id,
                'sample_description' => $row->sample_description,
                'test' => $this->Water_sample_reception_model->getTest(),
                );
                $this->template->load('template','water_sample_reception/index_det2', $data);
        }
        else {
            // $this->template->load('template','Water_sample_reception/index_det');
        }
    }     

    public function save() {
        $mode = $this->input->post('mode', TRUE);
        $project_id = $this->input->post('project_idx', TRUE);
        $dt = new DateTime();
    
        if ($mode == "insert") {
            $data = array(
                'id_person' => $this->input->post('id_person', TRUE),
                'date_arrival' => $this->input->post('date_arrival', TRUE),
                'time_arrival' => $this->input->post('time_arrival', TRUE),
                'client_sample_id' => $this->input->post('client_sample_id', TRUE),
                'classification_id' => $this->input->post('classification_id', TRUE),
                'comments' => trim($this->input->post('comments', TRUE)),
                'date_collected' => $this->input->post('date_collected',TRUE),
                'time_collected' => $this->input->post('time_collected',TRUE),
                'flag' => '0',
                'uuid' => $this->uuid->v4(),
                'user_created' => $this->session->userdata('id_users'),
                'date_created' => $dt->format('Y-m-d H:i:s'),
            );
    
            $this->Water_sample_reception_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');

        } else if ($mode == "edit") {
            $data = array(
                'id_person' => $this->input->post('id_person', TRUE),
                'date_arrival' => $this->input->post('date_arrival', TRUE),
                'time_arrival' => $this->input->post('time_arrival', TRUE),
                'client_sample_id' => $this->input->post('client_sample_id', TRUE),
                'classification_id' => $this->input->post('classification_id', TRUE),
                'comments' => trim($this->input->post('comments', TRUE)),
                'date_collected' => $this->input->post('date_collected',TRUE),
                'time_collected' => $this->input->post('time_collected',TRUE),
                'flag' => '0',
                'uuid' => $this->uuid->v4(),
                'user_created' => $this->session->userdata('id_users'),
                'date_created' => $dt->format('Y-m-d H:i:s'),
            );

            $this->Water_sample_reception_model->update($project_id, $data);
            $this->session->set_flashdata('message', 'Update Record Success');
        }
    
        redirect(site_url("Water_sample_reception"));
    }


        // public function savedetail() 
        // {
        //     $mode = $this->input->post('mode_det',TRUE);
        //     $sample_id = $this->input->post('sample_id',TRUE);
        //     $client_sample_id = $this->input->post('client_sample_idx',TRUE);
        //     $project_id2 = $this->input->post('project_id2',TRUE);
        //     $testing_types = $this->input->post('testing_type_id', TRUE);
    
        //     $dt = new DateTime();

        //     if ($mode=="insert"){
        //         if (is_array($testing_types)) {
        //             // Handle the case when $testing_types is an array
        //             // You can either select the first value or concatenate the values into a string
        //             // $testing_type_id = $testing_types[0]; // Assuming you want to use the first value
        //             // or
        //             $testing_type_id = implode(',', $testing_types); // Concatenate the values into a string
        //         } else {
        //             $testing_type_id = $testing_types;
        //         }
        //                 $data_sample = array(
        //                     // 'sample_id' => $this->input->post('sample_id', TRUE),
        //                     'client_sample_id' =>  $client_sample_id,
        //                     'project_id' => $this->input->post('project_id2', TRUE),
        //                     'testing_type_id' => $testing_type_id,
        //                     // 'sample_description' => $this->input->post('sample_description', TRUE),
        //                     'date_collected' => $this->input->post('date_collected', TRUE),
        //                     'time_collected' => $this->input->post('time_collected', TRUE),
        //                     // 'no_submitted' => $this->input->post('no_submitted', TRUE),
        //                     // 'sample_barcode' => $this->input->post('sample_barcode', TRUE),
        //                     'uuid' => $this->uuid->v4(),
        //                     'user_created' => $this->session->userdata('id_users'),
        //                     'date_created' => $dt->format('Y-m-d H:i:s'),
        //                 );
                
        //         $this->Water_sample_reception_model->insert_det($data_sample);
        //         $this->session->set_flashdata('message', 'Create Record Success');    
        
        //     }
        //     else if ($mode=="edit"){
        //         if (is_array($testing_types)) {
        //             // Handle the case when $testing_types is an array
        //             // You can either select the first value or concatenate the values into a string
        //             // $testing_type_id = $testing_types[0]; // Assuming you want to use the first value
        //             // or
        //             $testing_type_id = implode(',', $testing_types); // Concatenate the values into a string
        //         } else {
        //             $testing_type_id = $testing_types;
        //         }
        //         $data_sample = array(
        //             // 'sample_id' => $this->input->post('sample_id', TRUE),
        //             'client_sample_id' =>  $client_sample_id,
        //             'project_id' => $this->input->post('project_id2', TRUE),
        //             // 'testing_type_id' => $this->input->post('testing_type_id', TRUE),
        //             'testing_type_id' => $testing_type_id,
        //             // 'sample_description' => $this->input->post('sample_description', TRUE),
        //             'date_collected' => $this->input->post('date_collected', TRUE),
        //             'time_collected' => $this->input->post('time_collected', TRUE),
        //             // 'no_submitted' => $this->input->post('no_submitted', TRUE),
        //             // 'sample_barcode' => $this->input->post('sample_barcode', TRUE),
        //             'uuid' => $this->uuid->v4(),
        //             'user_created' => $this->session->userdata('id_users'),
        //             'date_created' => $dt->format('Y-m-d H:i:s'),
        //         );
        //         $this->Water_sample_reception_model->update_det($sample_id, $data_sample);
        //         $this->session->set_flashdata('message', 'Create Record Success');    
        //     }

        //     redirect(site_url("Water_sample_reception/read/".$project_id2));
        // }

        // public function savedetail() 
        // {
        //     $mode = $this->input->post('mode_det', TRUE);
        //     $sample_id = $this->input->post('sample_id', TRUE);
        //     $client_sample_id = $this->input->post('client_sample_idx', TRUE);
        //     $project_id2 = $this->input->post('project_id2', TRUE);
        //     $testing_types = $this->input->post('testing_type_id', TRUE);
        //     $sample_barcode = $this->input->post('sample_barcode', TRUE),
            
        //     $dt = new DateTime();
        
        //     if ($mode == "insert") {
        //         if (is_array($testing_types)) {
        //             foreach ($testing_types as $testing_type_id) {
        //                 $data_sample = array(
        //                     'client_sample_id' => $client_sample_id,
        //                     'project_id' => $project_id2,
        //                     'testing_type_id' => $testing_type_id,
        //                     'sample_barcode' => $sample_barcode,
        //                     'uuid' => $this->uuid->v4(),
        //                     'user_created' => $this->session->userdata('id_users'),
        //                     'date_created' => $dt->format('Y-m-d H:i:s'),
        //                 );
                        
        //                 $this->Water_sample_reception_model->insert_det($data_sample);
        //             }
        //             $this->session->set_flashdata('message', 'Create Records Success');    
        //         } else {
        //             // Handle case where testing_types is not an array
        //             $this->session->set_flashdata('message', 'No Testing Types Selected');    
        //         }
        //     } else if ($mode == "edit") {
        //         if (is_array($testing_types)) {
        //             // Assuming you want to update each testing type associated with the sample
        //             foreach ($testing_types as $testing_type_id) {
        //                 $data_sample = array(
        //                     'client_sample_id' => $client_sample_id,
        //                     'project_id' => $project_id2,
        //                     'testing_type_id' => $testing_type_id,\
        //                     'sample_barcode' => $sample_barcode,
        //                     'uuid' => $this->uuid->v4(),
        //                     'user_created' => $this->session->userdata('id_users'),
        //                     'date_created' => $dt->format('Y-m-d H:i:s'),
        //                 );
                        
        //                 $this->Water_sample_reception_model->update_det($sample_id, $data_sample);
        //             }
        //             $this->session->set_flashdata('message', 'Update Records Success');    
        //         } else {
        //             // Handle case where testing_types is not an array
        //             $this->session->set_flashdata('message', 'No Testing Types Selected');    
        //         }
        //     }
        
        //     redirect(site_url("Water_sample_reception/read/" . $project_id2));
        // }
        
        public function savedetail() {
            $mode = $this->input->post('mode_det', TRUE);
            $sample_id = $this->input->post('sample_id', TRUE);
            $client_sample_id = $this->input->post('client_sample_idx', TRUE);
            $project_id2 = $this->input->post('project_id2', TRUE);
            $testing_types = $this->input->post('testing_type_id', TRUE);
            $dt = new DateTime();
            
            if ($mode == "insert") {
                if (is_array($testing_types)) {
                    foreach ($testing_types as $testing_type_id) {
                        // Get the testing type name from the database or a predefined list
                        $testing_type_name = $this->Water_sample_reception_model->get_name_by_id($testing_type_id);
                        
                        // Generate barcode
                        $barcode = $this->Water_sample_reception_model->get_last_barcode($testing_type_name);
                        
                        $data_sample = array(
                            'client_sample_id' => $client_sample_id,
                            'project_id' => $project_id2,
                            'testing_type_id' => $testing_type_id,
                            'sample_barcode' => $barcode,
                            'uuid' => $this->uuid->v4(),
                            'user_created' => $this->session->userdata('id_users'),
                            'date_created' => $dt->format('Y-m-d H:i:s'),
                        );
                        
                        $this->Water_sample_reception_model->insert_det($data_sample);
                    }
                    $this->session->set_flashdata('message', 'Create Records Success');    
                } else {
                    $this->session->set_flashdata('message', 'No Testing Types Selected');    
                }
            } else if ($mode == "edit") {
                if (is_array($testing_types)) {
                    foreach ($testing_types as $testing_type_id) {
                        $testing_type_name = $this->Water_sample_reception_model->get_name_by_id($testing_type_id);
                        $barcode = $this->Water_sample_reception_model->get_last_barcode($testing_type_name);
                        
                        $data_sample = array(
                            'client_sample_id' => $client_sample_id,
                            'project_id' => $project_id2,
                            'testing_type_id' => $testing_type_id,
                            'sample_barcode' => $barcode,
                            'uuid' => $this->uuid->v4(),
                            'user_created' => $this->session->userdata('id_users'),
                            'date_created' => $dt->format('Y-m-d H:i:s'),
                        );
                        
                        $this->Water_sample_reception_model->update_det($sample_id, $data_sample);
                    }
                    $this->session->set_flashdata('message', 'Update Records Success');    
                } else {
                    $this->session->set_flashdata('message', 'No Testing Types Selected');    
                }
            }
            
            redirect(site_url("Water_sample_reception/read/" . $project_id2));
        }
               

    public function savedetail2() 
    {
        $mode = $this->input->post('mode_det2',TRUE); // appropiate with the name of form
        $sample_id = $this->input->post('sample_id2',TRUE);
        $testing_id = $this->input->post('testing_id',TRUE);

        $dt = new DateTime();
    
        if ($mode == "insert"){
            $data = array(
                'sample_id' => $this->input->post('sample_id2', TRUE),
                'testing_type_id' => $this->input->post('testing_type_id', TRUE),
                'date_collected' => $this->input->post('date_collected', TRUE),
                'time_collected' => $this->input->post('time_collected', TRUE),
                'no_submitted' => $this->input->post('no_submitted', TRUE),
                'sample_barcode' => $this->input->post('sample_barcode', TRUE),
                'uuid' => $this->uuid->v4(),
                'user_created' => $this->session->userdata('id_users'),
                'date_created' => $dt->format('Y-m-d H:i:s'),
            );

            $this->Water_sample_reception_model->insert_det2($data);
            $this->session->set_flashdata('message', 'Create Record Success');
                
        } else if ($mode == "edit"){
            $data = array(
                'sample_id' => $this->input->post('sample_id2', TRUE),
                'testing_type_id' => $this->input->post('testing_type_id', TRUE),
                'date_collected' => $this->input->post('date_collected', TRUE),
                'time_collected' => $this->input->post('time_collected', TRUE),
                'no_submitted' => $this->input->post('no_submitted', TRUE),
                'sample_barcode' => $this->input->post('sample_barcode', TRUE),
                'user_updated' => $this->session->userdata('id_users'),
                'date_updated' => $dt->format('Y-m-d H:i:s'),
            );
    
            $this->Water_sample_reception_model->update_det2($testing_id, $data);
            $this->session->set_flashdata('message', 'Update Record Success');    
        }
    
        redirect(site_url("Water_sample_reception/read2/".$sample_id));
    }
  

    public function delete($id) 
    {
        $row = $this->Water_sample_reception_model->get_by_id($id);
        $data = array(
            'flag' => 1,
            );

        if ($row) {
            $this->Water_sample_reception_model->update($id, $data);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('Water_sample_reception'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('Water_sample_reception'));
        }
    }

    public function delete_detail($id) 
    {
        $row = $this->Water_sample_reception_model->get_by_id_detail($id);

        if ($row) {
            $id_parent = $row->project_id; // Retrieve project_id before updating the record
            $data = array(
                'flag' => 1,
            );
    
            $this->Water_sample_reception_model->update_det($id, $data);
            $this->session->set_flashdata('message', 'Delete Record Success');
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
        }
    
        redirect(site_url('Water_sample_reception/read/'.$id_parent));
    }

    // Function delete detail 2
    // public function delete_detail2($id)
    // {
    //     $row = $this->Water_sample_reception_model->get_by_id_detail2($id);
    //     if ($row) {
    //         $id_parent = $row->sample_id;
    //         $data = array(
    //             'flag' => 1,
    //         );

    //         $this->Water_sample_reception_model->update_det2($id, $data);
    //         $this->session->set_flashdata('message', 'Delete Record Success');
    //     } else {
    //         $this->session->set_flashdata('message', 'Record Not Found');
    //     }
    //     redirect(site_url('Water_sample_reception/read2/'.$id_parent));
    // }


    public function get_confirmation_data() {
        $testing_types = $this->input->post('testing_type_id', TRUE);
    
        $data = array();
        if (is_array($testing_types)) {
            foreach ($testing_types as $testing_type_id) {
                $testing_type_name = $this->Water_sample_reception_model->get_name_by_id($testing_type_id);
                $barcode = $this->Water_sample_reception_model->get_last_barcode($testing_type_name);
    
                $data[] = array(
                    'testing_type_name' => $testing_type_name,
                    'barcode' => $barcode
                );
            }
        }
    
        echo json_encode($data);
    }
    


}

/* End of file Water_sample_reception.php */
/* Location: ./application/controllers/Water_sample_reception.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2022-12-14 03:38:42 */
/* http://harviacode.com */