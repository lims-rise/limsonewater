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
    
class Sample_reception extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        is_login();
        $this->load->model('Sample_reception_model');
        $this->load->library('form_validation');        
	    $this->load->library('datatables');
	    $this->load->library('uuid');
    }

    public function index()
    {
        $data['sampletype'] = $this->Sample_reception_model->getSampleType();
        $data['labtech'] = $this->Sample_reception_model->getLabTech();
        $data['id_project'] = $this->Sample_reception_model->generate_project_id();
        $data['clientcontact'] = $this->Sample_reception_model->getClientContact();
    
        // Default value if you want to preselect a client, else keep it empty
        $data['selected_client_id'] = '';
    
        $this->template->load('template', 'sample_reception/index', $data);
    }
    
    
    public function json() {
        header('Content-Type: application/json');
        echo $this->Sample_reception_model->json();
    }

    public function subjson() {
        $id = $this->input->get('id',TRUE);
        header('Content-Type: application/json');
        echo $this->Sample_reception_model->subjson($id);
    }

    public function subjson2() {
        $id2 = $this->input->get('id2',TRUE);

        header('Content-Type: application/json');
        echo $this->Sample_reception_model->subjson2($id2);
    }

    public function read($id)
    {
        $data['testing_type'] = $this->Sample_reception_model->getTest();
        // $data['barcode'] = $this->Water_sample_reception_model->getBarcode();
        $row = $this->Sample_reception_model->get_detail($id);
        if ($row) {
            $data = array(
                'id_sample' => $row->id_sample,
                'id_project' => $row->id_project,
                'id_one_water_sample' => $row->id_one_water_sample,
                'initial' => $row->initial,
                'date_arrival' => $row->date_arrival,
                'time_arrival' => $row->time_arrival,
                'date_collected' => $row->date_collected,
                'time_collected' => $row->time_collected,
                'sampletype' => $row->sampletype,
                'quality_check' => $row->quality_check,
                'comments' => $row->comments,
                'testing_type' => $this->Sample_reception_model->getTest(),
                // 'barcode' => $this->Water_sample_reception_model->getBarcode(),
            );
                
            $this->template->load('template','sample_reception/index_det', $data);

        }
        else {
            // $this->template->load('template','Water_sample_reception/index_det', $test);
        }

    } 

    public function read2($id)
    {
        $data['test'] = $this->Sample_reception_model->getTest();
        $row = $this->Sample_reception_model->get_detail2($id);
        if ($row) {
            $data = array(
                'id_project' => $row->id_project,
                'id_testing' => $row->id_testing,
                'sample_description' => $row->sample_description,
                'test' => $this->Sample_reception_model->getTest(),
                );
                $this->template->load('template','sample_reception/index_det2', $data);
        }
        else {
            // $this->template->load('template','Water_sample_reception/index_det');
        }
    }     

    // public function rep_print($id) 
    // {
    //     $row = $this->Sample_reception_model->get_rep($id);
    //     if ($row) {
    //         $data = array(
    //         'report_number' => $row->report_number,
    //         'report_date' => $row->report_date,
    //         'id_project' => $row->id_project,
    //         'client' => $row->client,
    //         'client_name' => $row->client_name,
    //         'address' => $row->address,
    //         'phone1' => $row->phone1,
    //         'phone2' => $row->phone2,
    //         'email' => $row->email,
    //         'client_quote_number' => $row->client_quote_number,
    //         'po_number' => $row->po_number,
    //         'id_client_sample' => $row->id_client_sample,
    //         'from_date' => $row->from_date,
    //         'to_date' => $row->to_date,
    //         'date_arrival' => $row->date_arrival,
    //         'time_arrival' => $row->time_arrival,
    //         'id_person' => $row->id_person,
    //         'realname' => $row->realname,
    //         );
    //     // $data['items'] = $this->Tbl_receive_old_model->getItems();
    //         $this->template->load('template','sample_reception/index_rep', $data);
    //     } else {
    //         $this->session->set_flashdata('message', 'Record Not Found');
    //         redirect(site_url("sample_reception/read/".$id));
    //     }
    // }

    public function rep_print($id) 
    {
        $row = $this->Sample_reception_model->get_rep($id);
        if ($row) {
            $data = array(
                'report_number' => $row->report_number,
                'report_date' => $row->report_date,
                'id_project' => $row->id_project,
                'client' => $row->client,
                'client_name' => $row->client_name,
                'address' => $row->address,
                'phone1' => $row->phone1,
                'phone2' => $row->phone2,
                'email' => $row->email,
                'client_quote_number' => $row->client_quote_number,
                'po_number' => $row->po_number,
                'id_client_sample' => $row->id_client_sample,
                'from_date' => $row->from_date,
                'to_date' => $row->to_date,
                'date_arrival' => $row->date_arrival,
                'time_arrival' => $row->time_arrival,
                'id_person' => $row->id_person,
                'realname' => $row->realname,
            );
            $needs_generation_and_save = (
                empty($data['report_number']) || $data['report_number'] === null || $data['report_number'] === '' ||
                empty($data['report_date']) || $data['report_date'] === null || $data['report_date'] === '' || trim($data['report_date']) === '0000-00-00'
            );

            if ($needs_generation_and_save) {
                $data['report_date_display'] = date('d-M-Y'); 
                $data['report_number_display'] = $this->Sample_reception_model->generate_new_report_number();
                
                $data['report_date_to_send_ajax'] = $data['report_date_display'];
                $data['report_number_to_send_ajax'] = $data['report_number_display'];
            } else {

                $date_obj_from_db = DateTime::createFromFormat('Y-m-d', $data['report_date']);
                if ($date_obj_from_db) {
                    $data['report_date_display'] = $date_obj_from_db->format('d-M-Y');
                } else {

                    $data['report_date_display'] = $data['report_date']; 
                    log_message('error', 'Could not convert DB date "' . $data['report_date'] . '" to DD-Mon-YYYY format for display in rep_print.');
                }
                $data['report_number_display'] = $data['report_number'];
                
                $data['report_date_to_send_ajax'] = ''; 
                $data['report_number_to_send_ajax'] = ''; 
            }
            
            $this->template->load('template','sample_reception/index_rep', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url("sample_reception/read/".$id));
        }
    }

    public function rep_print2($id) 
    {
        $row = $this->Sample_reception_model->get_rep($id);
        if ($row) {
            $data = array(
                'report_number' => $row->report_number,
                'report_date' => $row->report_date,
                'id_project' => $row->id_project,
                'client' => $row->client,
                'client_name' => $row->client_name,
                'address' => $row->address,
                'phone1' => $row->phone1,
                'phone2' => $row->phone2,
                'email' => $row->email,
                'client_quote_number' => $row->client_quote_number,
                'po_number' => $row->po_number,
                'id_client_sample' => $row->id_client_sample,
                'from_date' => $row->from_date,
                'to_date' => $row->to_date,
                'date_arrival' => $row->date_arrival,
                'time_arrival' => $row->time_arrival,
                'id_person' => $row->id_person,
                'realname' => $row->realname,
            );
            $needs_generation_and_save = (
                empty($data['report_number']) || $data['report_number'] === null || $data['report_number'] === '' ||
                empty($data['report_date']) || $data['report_date'] === null || $data['report_date'] === '' || trim($data['report_date']) === '0000-00-00'
            );

            if ($needs_generation_and_save) {
                $data['report_date_display'] = date('d-M-Y'); 
                $data['report_number_display'] = $this->Sample_reception_model->generate_new_report_number();
                
                $data['report_date_to_send_ajax'] = $data['report_date_display'];
                $data['report_number_to_send_ajax'] = $data['report_number_display'];
            } else {

                $date_obj_from_db = DateTime::createFromFormat('Y-m-d', $data['report_date']);
                if ($date_obj_from_db) {
                    $data['report_date_display'] = $date_obj_from_db->format('d-M-Y');
                } else {

                    $data['report_date_display'] = $data['report_date']; 
                    log_message('error', 'Could not convert DB date "' . $data['report_date'] . '" to DD-Mon-YYYY format for display in rep_print2.');
                }
                $data['report_number_display'] = $data['report_number'];
                
                $data['report_date_to_send_ajax'] = ''; 
                $data['report_number_to_send_ajax'] = ''; 
            }
            
            // Get export data for the view
            $data['export_data'] = $this->Sample_reception_model->get_export_data($id);
            
            $this->template->load('template','sample_reception/index_rep2', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url("sample_reception/read/".$id));
        }
    }

    public function save_report_details_ajax() {
        if (!$this->input->is_ajax_request() || !$this->input->method('post')) {
            echo json_encode(['status' => 'error', 'message' => 'Invalid request.']);
            return;
        }

        $id_project = $this->input->post('id_project', TRUE);
        $report_number_to_save = $this->input->post('report_number', TRUE);
        $report_date_from_frontend = $this->input->post('report_date', TRUE); 

        if (empty($id_project) || empty($report_number_to_save) || empty($report_date_from_frontend)) {
            echo json_encode(['status' => 'error', 'message' => 'Missing data for saving report details.']);
            return;
        }

        $date_obj = DateTime::createFromFormat('d-M-Y', $report_date_from_frontend);
        
       
        if ($date_obj) {
            $report_date_for_db = $date_obj->format('Y-m-d'); 
        } else {
            log_message('error', 'Failed to parse date from frontend: ' . $report_date_from_frontend);
            echo json_encode(['status' => 'error', 'message' => 'Invalid date format received.']);
            return;
        }

        $success = $this->Sample_reception_model->update_report_details_if_empty($id_project, $report_number_to_save, $report_date_for_db);

        if ($success) {
            echo json_encode(['status' => 'success', 'message' => 'Report details saved successfully.']);
        } else {
            echo json_encode(['status' => 'info', 'message' => 'Report details already exist or could not be updated.']);
        }
    }

    // public function save() {
    //     $mode = $this->input->post('mode', TRUE);
    //     $dt = new DateTime();
    //     $id_project = $this->input->post('idx_project', TRUE);
    //     $client_quote_number = $this->input->post('client_quote_number', TRUE);
    //     $client = $this->input->post('client', TRUE);
    //     $clientx = $this->input->post('clientx', TRUE);
    //     $number_sample = $this->input->post('number_sample', TRUE);
    //     $id_client_sample = $this->input->post('id_client_sample', TRUE);
    //     $comments = $this->input->post('comments', TRUE);
    //     $date_collected = $this->input->post('date_collected',TRUE);
    //     $time_collected = $this->input->post('time_collected',TRUE);
        
    
    //     if ($mode == "insert") {
    //         $data = array(
    //             'client_quote_number' => $client_quote_number,
    //             'client' => $client,
    //             'id_client_sample' => $id_client_sample,
    //             'number_sample' => $number_sample,
    //             'date_collected' => $date_collected,
    //             'time_collected' => $time_collected,
    //             'comments' => $comments,
    //             'flag' => '0',
    //             'uuid' => $this->uuid->v4(),
    //             'user_created' => $this->session->userdata('id_users'),
    //             'date_created' => $dt->format('Y-m-d H:i:s'),
    //         );
    
    //         $this->Sample_reception_model->insert($data);
    //         $this->session->set_flashdata('message', 'Create Record Success');

    //     } else if ($mode == "edit") {
    //         $data = array(
    //             'client_quote_number' => $client_quote_number,
    //             'client' => $client,
    //             'id_client_sample' => $id_client_sample,
    //             'number_sample' => $number_sample,
    //             'date_collected' => $date_collected,
    //             'time_collected' => $time_collected,
    //             'comments' => $comments,
    //             'flag' => '0',
    //             // 'uuid' => $this->uuid->v4(),
    //             'user_updated' => $this->session->userdata('id_users'),
    //             'date_updated' => $dt->format('Y-m-d H:i:s'),
    //         );

    //         $this->Sample_reception_model->update($id_project, $data);
    //         $this->session->set_flashdata('message', 'Update Record Success');
    //     }
    
    //     redirect(site_url("sample_reception"));
    // }

    public function save() {
        $mode = $this->input->post('mode', TRUE);
        $dt = new DateTime();
        $id_project = $this->input->post('idx_project', TRUE);
        $client_quote_number = $this->input->post('client_quote_number', TRUE);
        $client = $this->input->post('client', TRUE);
        $clientx = $this->input->post('clientx', TRUE);
        $id_client_contact = $this->input->post('id_client_contact', TRUE);
        $number_sample = (int) $this->input->post('number_sample', TRUE);
        $id_client_sample = $this->input->post('id_client_sample', TRUE);
        $comments = $this->input->post('comments', TRUE);
        $date_collected = $this->input->post('date_collected', TRUE);
        $time_collected = $this->input->post('time_collected', TRUE);
        $files =  $this->input->post('files', TRUE);
    
        if ($mode == "insert") {
            // Insert ke sample_reception
            $data = array(
                'client_quote_number' => $client_quote_number,
                'client' => $client,
                'id_client_sample' => $id_client_sample,
                'id_client_contact' => $id_client_contact,
                'number_sample' => $number_sample,
                'date_collected' => $date_collected,
                'time_collected' => $time_collected,
                'files' => $files,
                'comments' => $comments,
                'flag' => '0',
                'uuid' => $this->uuid->v4(),
                'user_created' => $this->session->userdata('id_users'),
                'date_created' => $dt->format('Y-m-d H:i:s'),
            );

            // var_dump($data);
            // die();
    
            $id_project = $this->Sample_reception_model->insert($data);
    
            // Generate dan insert ke sample_reception_sample sesuai number_sample
            for ($i = 0; $i < $number_sample; $i++) {
                $id_one_water_sample = $this->Sample_reception_model->generate_one_water_sample_id();
                $sample_data = array(
                    'id_project' => $id_project,
                    'id_one_water_sample' => $id_one_water_sample,
                    'flag' => '0',
                    'uuid' => $this->uuid->v4(),
                    'user_created' => $this->session->userdata('id_users'),
                    'date_created' => $dt->format('Y-m-d H:i:s'),
                );
                $this->Sample_reception_model->insert_sample($sample_data);
            }
            
            $this->session->set_flashdata('message', 'Create Record Success');
        } else if($mode == "edit") {
            // Update ke sample_reception
                $data = array(
                            'client_quote_number' => $client_quote_number,
                            'client' => $clientx,
                            'id_client_contact' => $id_client_contact,
                            'id_client_sample' => $id_client_sample,
                            'number_sample' => $number_sample,
                            'date_collected' => $date_collected,
                            'time_collected' => $time_collected,
                            'files' => $files,
                            'comments' => $comments,
                            'flag' => '0',
                            'uuid' => $this->uuid->v4(),
                            'user_updated' => $this->session->userdata('id_users'),
                            'date_updated' => $dt->format('Y-m-d H:i:s'),
                );
                // var_dump($data);
                // die();
                $this->Sample_reception_model->update($id_project, $data);
        }
        
        redirect(site_url("sample_reception"));
    }

    public function update_sample() {
        $mode = $this->input->post('mode_sample', TRUE);
        $id_project = $this->input->post('id_project', TRUE);
        $id_one_water_sample = $this->input->post('id_one_water_sample', TRUE);
        $id_person = $this->input->post('id_person', TRUE);
        $id_sampletype = $this->input->post('id_sampletype', TRUE);
        $date_arrival = $this->input->post('date_arrival_sample', TRUE);
        $time_arrival = $this->input->post('time_arrival_sample', TRUE);
        $date_collected = $this->input->post('date_collected_sample',TRUE);
        $time_collected = $this->input->post('time_collected_sample',TRUE);
        $quality_check = $this->input->post('quality_check', TRUE);
        $comments = $this->input->post('comments_sample', TRUE);
        $dt = new DateTime();
    
        if ($mode == "edit") {
            if (!$id_one_water_sample) {
                echo json_encode(["status" => "error", "message" => "Sample ID is missing."]);
                return;
            }
        
            $data = array(
                'id_sampletype' => $id_sampletype,
                'id_person' => $id_person,
                'date_arrival' => $date_arrival,
                'time_arrival' => $time_arrival,
                'date_collected' => $date_collected,
                'time_collected' => $time_collected,
                'quality_check' => $quality_check,
                'comments' => $comments,
                'flag' => '0',
                'user_created' => $this->session->userdata('id_users'),
                'date_created' => $dt->format('Y-m-d H:i:s'),
            );
        
            // var_dump($data);
            // die();
            $this->load->model('Sample_reception_model');
            $update = $this->Sample_reception_model->update_sample($id_one_water_sample, $data);
        
            if ($update) {
                echo json_encode(["status" => "success", "message" => "Sample updated successfully."]);
            } else {
                echo json_encode(["status" => "error", "message" => "Failed to update sample."]);
            }
        }
        
        redirect(site_url("sample_reception"));
    }
    
    


    public function get_samples_by_project($id_project) {
        $samples = $this->Sample_reception_model->get_samples_by_project($id_project);
        echo json_encode($samples);
    }
    
    public function get_sample_detail($id_one_water_sample) {
        $samples_detail = $this->Sample_reception_model->get_sample_detail($id_one_water_sample);
        echo json_encode($samples_detail);
    }

        public function savedetail() {
            $mode = $this->input->post('mode_det', TRUE);
            $id_testing = $this->input->post('id_testing', TRUE);
            $id_one_water_sample = $this->input->post('idx_one_water_sample', TRUE);
            $id2_sample = $this->input->post('id2_sample', TRUE);
            $testing_types = $this->input->post('id_testing_type', TRUE);
            $dt = new DateTime();
        
            if ($mode == "insert") {
                if (is_array($testing_types)) {

                    
                    foreach ($testing_types as $id_testing_type) {
                        $testing_type_name = $this->Sample_reception_model->get_name_by_id($id_testing_type);
                        $barcode = $this->Sample_reception_model->get_last_barcode($testing_type_name);

                        $id_testing = $this->Sample_reception_model->insert_det(array(
                            // 'id_client_sample' => $id_client_sample,
                            'id_sample' => $id2_sample,
                            'id_testing_type' => $id_testing_type,
                            'barcode' => $barcode,
                            'uuid' => $this->uuid->v4(),
                            'user_created' => $this->session->userdata('id_users'),
                            'date_created' => $dt->format('Y-m-d H:i:s'),
                        ));
        
                        // $data_barcode = array(
                        //     'id_testing' => $id_testing,
                        //     'id_testing_type' => $id_testing_type,
                        //     'barcode' => $barcode,
                        // );

                        // var_dump($data_barcode);
                        // die();
        
                        // $this->Sample_reception_model->insert_barcode($data_barcode);
                    }
                    $this->session->set_flashdata('message', 'Create Records Success');
                } else {
                    $this->session->set_flashdata('message', 'No Testing Types Selected');
                }
            }else if ($mode == "edit") {
                if (is_array($testing_types)) {
            
                    // Get the old data
                    $old_data = $this->Sample_reception_model->get_sample_testing($id_testing);
            
                    // Check if there are any changes
                    $changed = false;
                    foreach ($testing_types as $id_testing_type) {
                        $testing_type_name = $this->Sample_reception_model->get_name_by_id($id_testing_type);
                        $barcode = $this->Sample_reception_model->get_last_barcode($testing_type_name);
            
                        // Check if the testing type is already in the old data
                        $old_id_testing_type = array_search($testing_type_name, array_column($old_data, 'testing_type_name'));
                        if ($old_id_testing_type !== false) {
                            // Check if the barcode is different
                            if ($old_data[$old_id_testing_type]['barcode'] != $barcode) {
                                $changed = true;
                                break;
                            }
                        } else {
                            // New testing type
                            $changed = true;
                            break;
                        }
                    }
            
                    if ($changed) {
                        // Remove old barcodes related to this sample_id
                        $this->Sample_reception_model->delete_barcode($id_testing);
            
                        foreach ($testing_types as $id_testing_type) {
                            $testing_type_name = $this->Sample_reception_model->get_name_by_id($id_testing_type);
                            $barcode = $this->Sample_reception_model->get_last_barcode($testing_type_name);
            
                            // Update the sample_reception_sample with new data
                            $this->Sample_reception_model->update_det($id_testing, array(
                                // 'id_client_sample' => $id_client_sample,
                                'id_sample' => $id2_sample,
                                'id_testing_type' => $id_testing_type,
                                'barcode' => $barcode,
                                // 'uuid' => $this->uuid->v4(),
                                'user_updated' => $this->session->userdata('id_users'),
                                'date_updated' => $dt->format('Y-m-d H:i:s'),
                            ));
            
                            // $data_barcode = array(
                            //     'id_testing' => $id_testing,
                            //     'id_testing_type' => $id_testing_type,
                            //     'barcode' => $barcode,
                            // );
            
                            // $this->Sample_reception_model->insert_barcode($data_barcode);
                        }
                        $this->session->set_flashdata('message', 'Update Records Success');
                    } else {
                        $this->session->set_flashdata('message', 'No Changes Made');
                    }
                } else {
                    $this->session->set_flashdata('message', 'No Testing Types Selected');
                }
            }
            redirect(site_url("sample_reception/read/" . $id_one_water_sample));
        }
  

    public function delete($id) 
    {
        $row = $this->Sample_reception_model->get_by_id($id);
        $data = array(
            'flag' => 1,
            );

        if ($row) {
            $this->Sample_reception_model->update($id, $data);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('sample_reception'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('sample_reception'));
        }
    }

    public function delete_sample($id_one_water_sample) {
        $row = $this->Sample_reception_model->get_by_id_sample($id_one_water_sample);
        $data = array(
            'flag' => 1,
            );

        if ($row) {
            $this->Sample_reception_model->update_sample($id_one_water_sample, $data);
            $this->session->set_flashdata('message', 'Delete Record Success');    
            redirect(site_url('sample_reception'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('sample_reception'));
        }
    }

    public function delete_detail($id) 
    {
        $row = $this->Sample_reception_model->get_by_id_detail($id);

        if ($row) {
            $id_parent = $row->id_project; // Retrieve project_id before updating the record
            $data = array(
                'flag' => 1,
            );
    
            $this->Sample_reception_model->update_det($id, $data);
            $this->session->set_flashdata('message', 'Delete Record Success');
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
        }
    
        redirect(site_url('sample_reception/read/'.$id_parent));
    }


    public function get_confirmation_data() {
        $testing_types = $this->input->post('id_testing_type', TRUE);
    
        $data = array();
        if (is_array($testing_types)) {
            foreach ($testing_types as $id_testing_type) {
                $testing_type_name = $this->Sample_reception_model->get_name_by_id($id_testing_type);
                $barcode = $this->Sample_reception_model->get_last_barcode($testing_type_name);
    
                $data[] = array(
                    'testing_type_name' => $testing_type_name,
                    'barcode' => $barcode
                );
            }
        }
    
        echo json_encode($data);
    }

    public function check_existing_data() {
        header('Content-Type: application/json');
        
        $id_one_water_sample = $this->input->post('id_one_water_sample', TRUE);
        $id_testing_type = $this->input->post('id_testing_type', TRUE);
        $url = $this->input->post('url', TRUE);
        
        // Validate input
        if (empty($id_one_water_sample) || empty($url)) {
            echo json_encode(['exists' => false, 'error' => 'Missing required parameters', 'status' => 'error']);
            return;
        }
        
        try {
            // Check if data exists based on URL/module
            $exists = $this->Sample_reception_model->check_data_exists($id_one_water_sample, $id_testing_type, $url);
            
            echo json_encode([
                'exists' => $exists,
                'id_one_water_sample' => $id_one_water_sample,
                'id_testing_type' => $id_testing_type,
                'url' => $url,
                'status' => 'success'
            ]);
        } catch (Exception $e) {
            echo json_encode([
                'exists' => false, 
                'error' => 'Database error occurred',
                'status' => 'error'
            ]);
        }
    }



    public function validateIdClientSample() {
        $id = $this->input->get('id');
        $data = $this->Sample_reception_model->validateIdClientSample($id);
        header('Content-Type: application/json');
        echo json_encode($data);
    }

    public function excel() {
        $spreadsheet = new Spreadsheet();    
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setCellValue('A1', "Coc"); 
        $sheet->setCellValue('B1', "Client Quote Number"); 
        $sheet->setCellValue('C1', "Client as on Coc");
        $sheet->setCellValue('D1', "Client ID");
        $sheet->setCellValue('E1', "One Water Sampe ID");
        $sheet->setCellValue('F1', "Time of Sample");
        $sheet->setCellValue('G1', "Receiving Lab");
        $sheet->setCellValue('H1', "Date Arrival");
        $sheet->setCellValue('I1', "Time Arrival");
        $sheet->setCellValue('J1', "Date Collected");
        $sheet->setCellValue('K1', "Time Collected");
        $sheet->setCellValue('L1', "Note");
        $sheet->setCellValue('M1', "Quality Check");
        $sheet->setCellValue('N1', "Barcode");
        $sheet->setCellValue('O1', "Testing Type");

        $sample_reception = $this->Sample_reception_model->get_all();
    
        $numrow = 2;
        foreach($sample_reception as $data){ 
            if (property_exists($data, 'id_project')) {
                $sheet->setCellValue('A'.$numrow, $data->id_project);
            } else {
                $sheet->setCellValue('A'.$numrow, '');
            }
    
            if (property_exists($data, 'client_quote_number')) {
                $sheet->setCellValue('B'.$numrow, $data->client_quote_number);
            } else {
                $sheet->setCellValue('B'.$numrow, '');
            }
    
            if (property_exists($data, 'client')) {
                $sheet->setCellValue('C'.$numrow, $data->client);
            } else {
                $sheet->setCellValue('C'.$numrow, '');
            }
    
            if (property_exists($data, 'id_client_sample')) {
                $sheet->setCellValue('D'.$numrow, $data->id_client_sample);
            } else {
                $sheet->setCellValue('D'.$numrow, '');
            }

            if (property_exists($data, 'id_one_water_sample')) {
                $sheet->setCellValue('E'.$numrow, $data->id_one_water_sample);
            } else {
                $sheet->setCellValue('E'.$numrow, '');
            }
    
            if (property_exists($data, 'sampletype')) {
                $sheet->setCellValue('F'.$numrow, $data->sampletype);
            } else {
                $sheet->setCellValue('F'.$numrow, '');
            }
    
            if (property_exists($data, 'initial')) {
                $sheet->setCellValue('G'.$numrow, $data->initial);
            } else {
                $sheet->setCellValue('G'.$numrow, '');
            }
    
            if (property_exists($data, 'date_arrival')) {
                $sheet->setCellValue('H'.$numrow, $data->date_arrival);
            } else {
                $sheet->setCellValue('H'.$numrow, '');
            }
    
            if (property_exists($data, 'time_arrival')) {
                $sheet->setCellValue('I'.$numrow, $data->time_arrival);
            } else {
                $sheet->setCellValue('I'.$numrow, '');
            }
    
            if (property_exists($data, 'date_collected')) {
                $sheet->setCellValue('J'.$numrow, $data->date_collected);
            } else {
                $sheet->setCellValue('J'.$numrow, '');
            }

            if (property_exists($data, 'time_collected')) {
                $sheet->setCellValue('K'.$numrow, $data->time_collected);
            } else {
                $sheet->setCellValue('K'.$numrow, '');
            }

            if (property_exists($data, 'note')) {
                $sheet->setCellValue('L'.$numrow, $data->note);
            } else {
                $sheet->setCellValue('L'.$numrow, '');
            }

            if (property_exists($data, 'quality_checked')) {
                $sheet->setCellValue('M'.$numrow, $data->quality_checked);
            } else {
                $sheet->setCellValue('M'.$numrow, '');
            }

            if (property_exists($data, 'barcode')) {
                $sheet->setCellValue('N'.$numrow, $data->barcode);
            } else {
                $sheet->setCellValue('N'.$numrow, '');
            }

            if (property_exists($data, 'testing_type')) {
                $sheet->setCellValue('O'.$numrow, $data->testing_type);
            } else {
                $sheet->setCellValue('O'.$numrow, '');
            }
            $numrow++;
        }

        // Set header untuk file excel
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="Report_sample_reception.xlsx"');
        header('Cache-Control: max-age=0');

        // Tampilkan file excel
        $writer = new Xlsx($spreadsheet);
        $writer->save('php://output');
    }
    
    // Export CSV function for OWL Report
    public function export_csv($id_project = null) {
        if (!$id_project) {
            show_404();
            return;
        }
        
        // Get export data from model
        $data = $this->Sample_reception_model->get_export_data($id_project);
        
        if (empty($data)) {
            show_error('No data found for this project', 404);
            return;
        }
        
        // Set filename
        $filename = 'OWL_Report_' . $id_project . '_' . date('Y-m-d') . '.csv';
        
        // Set headers for CSV download
        header('Content-Type: text/csv; charset=utf-8');
        header('Content-Disposition: attachment; filename="' . $filename . '"');
        header('Cache-Control: max-age=0');
        
        // Create file pointer
        $output = fopen('php://output', 'w');
        
        // Define field order as requested
        $fieldOrder = [
            'EDDVERSION', 'CLIENTNAME', 'SITEAREA', 'PROGRAM', 'WorkOrderNo', 'SUBMISSION', 
            'SAMPLINGPROVIDER', 'SamplerName', 'SamplingRunRef', 'LOCATIONCODE', 'LocationDescription', 
            'AnalysisPO', 'LABCODE', 'LABSAMPLEID', 'SAMPLETYPE', 'SUBMITTEDMATRIX', 'ANALYSISMATRIX', 
            'ANALYSISSUBMATRIX', 'ANALYSISMETHODCATEGORY', 'ANALYSISMETHOD', 'SAMPLEDATE', 
            'LABREGISTRATIONDATE', 'AnalysisDate', 'ANALYSISCOMPLETIONDATE', 'ParameterCode', 
            'PARAMETERNAME', 'TEST_KEY_CODE', 'RESULT', 'Units', 'POSITIVECONTROL%', 'SAMPLEVOLUME', 
            'SAMPLEVOLUMEUNITS', 'SAMPLEPROCESSED%', 'ConfirmedRaw', 'PresumptiveRaw', 'PathogenID', 
            'LOR', 'MeasurementOfUncertainty', 'SURROGATE', 'RPD', 'RESULTCOMMENT', 'RESULTSTATUS', 
            'LabCOANo', 'LabCOADate', 'LabQAQCNo', 'LabQAQCDate', 'ReportComment', 'SiteComment', 'License'
        ];
        
        // Write header row
        fputcsv($output, $fieldOrder, '|');
        
        // Write data rows
        foreach ($data as $row) {
            $csvRow = [];
            foreach ($fieldOrder as $field) {
                $csvRow[] = isset($row[$field]) ? $row[$field] : '';
            }
            fputcsv($output, $csvRow, '|');
        }
        
        // Close file pointer
        fclose($output);
        exit();
    }
}

/* End of file Water_sample_reception.php */
/* Location: ./application/controllers/Water_sample_reception.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2022-12-14 03:38:42 */
/* http://harviacode.com */