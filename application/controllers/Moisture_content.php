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
    
class Moisture_content extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        is_login();
        $this->load->model('Moisture_content_model');
        $this->load->library('form_validation');        
	    $this->load->library('datatables');
	    $this->load->library('uuid');
    }

    public function index()
    {
        $data['id_one'] = $this->Moisture_content_model->getID_one();
        $data['sampletype'] = $this->Moisture_content_model->getSampleType();
        $data['labtech'] = $this->Moisture_content_model->getLabTech();
        // $data['id_project'] = $this->Moisture_content_model->generate_project_id();
        // $data['client'] = $this->Moisture_content_model->generate_client();
        $data['id_one_water_sample'] = $this->Moisture_content_model->generate_one_water_sample_id();
        $this->template->load('template','Moisture_content/index', $data);
    } 
    
    public function json() {
        header('Content-Type: application/json');
        echo $this->Moisture_content_model->json();
    }

    public function subjson24() {
        $id = $this->input->get('id',TRUE);
        header('Content-Type: application/json');
        echo $this->Moisture_content_model->subjson24($id);
    }

    public function subjson2() {
        $id2 = $this->input->get('id2',TRUE);

        header('Content-Type: application/json');
        echo $this->Moisture_content_model->subjson2($id2);
    }

    public function read($id)
    {
        // $data['testing_type'] = $this->Moisture_content_model->getTest();
        // $data['barcode'] = $this->Water_sample_reception_model->getBarcode();
        // var_dump($id);
        // die();
        $row = $this->Moisture_content_model->get_detail($id);
        if ($row) {
            $data = array(
                'id_moisture' => $row->id_moisture,
                'id_one_water_sample' => $row->id_one_water_sample,
                'initial' => $row->initial,
                'date_start' => $row->date_start,
                'sampletype' => $row->sampletype,
                'barcode_moisture_content' => $row->barcode_moisture_content,
                'tray_weight' => $row->tray_weight,
                'traysample_wetweight' => $row->traysample_wetweight,
                'time_incubator' => $row->time_incubator,
                'comments' =>$row->comments,
            );


                
            $this->template->load('template','Moisture_content/index_det', $data);

        }
        else {
            // $this->template->load('template','Water_sample_reception/index_det', $test);
        }

    } 

    public function read2($id)
    {
        $data['test'] = $this->Moisture_content_model->getTest();
        $row = $this->Moisture_content_model->get_detail2($id);
        if ($row) {
            $data = array(
                'id_project' => $row->id_project,
                'id_sample' => $row->id_sample,
                'sample_description' => $row->sample_description,
                'test' => $this->Moisture_content_model->getTest(),
                );
                $this->template->load('template','Sample_reception/index_det2', $data);
        }
        else {
            // $this->template->load('template','Water_sample_reception/index_det');
        }
    }     

    public function save() {
        $mode = $this->input->post('mode', TRUE);
        $id_moisture = $this->input->post('idx_moisture', TRUE);
        $dt = new DateTime();

        $id_one_water_sample = $this->input->post('id_one_water_sample', TRUE);
        $idx_one_water_sample = $this->input->post('idx_one_water_sample', TRUE);
        $id_person = $this->input->post('id_person', TRUE);
        $date_start = $this->input->post('date_start', TRUE);
        $id_sampletype = $this->input->post('id_sampletype', TRUE);
        $barcode_moisture_content = $this->input->post('barcode_moisture_content', TRUE);
        $tray_weight = $this->input->post('tray_weight', TRUE);
        $traysample_wetweight = $this->input->post('traysample_wetweight', TRUE);
        $time_incubator = $this->input->post('time_incubator', TRUE);
        $comments = $this->input->post('comments', TRUE);
        // $date_collected = $this->input->post('date_collected',TRUE);
        // $time_collected = $this->input->post('time_collected',TRUE);
        
    
        if ($mode == "insert") {
            $data = array(
                'id_one_water_sample' => $id_one_water_sample,
                'id_person' => $id_person,
                'date_start' => $date_start,
                'id_sampletype' => $id_sampletype,
                'barcode_moisture_content' => $barcode_moisture_content,
                'tray_weight' => $tray_weight,
                'traysample_wetweight' => $traysample_wetweight,
                'time_incubator' => $time_incubator,
                'comments' => $comments,
                'flag' => '0',
                'lab' => $this->session->userdata('lab'),
                'uuid' => $this->uuid->v4(),
                'user_created' => $this->session->userdata('id_users'),
                'date_created' => $dt->format('Y-m-d H:i:s'),
            );

            // var_dump($data);
            // die();
    
            $this->Moisture_content_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');

        } else if ($mode == "edit") {
            $data = array(
                'id_one_water_sample' => $idx_one_water_sample,
                'id_person' => $id_person,
                'date_start' => $date_start,
                'id_sampletype' => $id_sampletype,
                'barcode_moisture_content' => $barcode_moisture_content,
                'tray_weight' => $tray_weight,
                'traysample_wetweight' => $traysample_wetweight,
                'time_incubator' => $time_incubator,
                'comments' => $comments,
                'flag' => '0',
                'lab' => $this->session->userdata('lab'),
                'uuid' => $this->uuid->v4(),
                'user_created' => $this->session->userdata('id_users'),
                'date_created' => $dt->format('Y-m-d H:i:s'),
            );

            // var_dump($data);
            // die();

            $this->Moisture_content_model->update($id_moisture, $data);
            $this->session->set_flashdata('message', 'Update Record Success');
        }
    
        redirect(site_url("Moisture_content"));
    }

        // public function savedetail() {
        //     $mode = $this->input->post('mode_det', TRUE);
        //     $id_sample = $this->input->post('id_sample', TRUE);
        //     $id_client_sample = $this->input->post('idx_client_sample', TRUE);
        //     $id2_project = $this->input->post('id2_project', TRUE);
        //     $testing_types = $this->input->post('id_testing_type', TRUE);
        //     $dt = new DateTime();
        
        //     if ($mode == "insert") {
        //         if (is_array($testing_types)) {

                    
        //             foreach ($testing_types as $id_testing_type) {
        //                 $testing_type_name = $this->Moisture_content_model->get_name_by_id($id_testing_type);
        //                 $barcode = $this->Moisture_content_model->get_last_barcode($testing_type_name);

        //                 $id_sample = $this->Moisture_content_model->insert_det(array(
        //                     'id_client_sample' => $id_client_sample,
        //                     'id_project' => $id2_project,
        //                     'id_testing_type' => $id_testing_type,
        //                     'uuid' => $this->uuid->v4(),
        //                     'user_created' => $this->session->userdata('id_users'),
        //                     'date_created' => $dt->format('Y-m-d H:i:s'),
        //                 ));
        
        //                 $data_barcode = array(
        //                     'id_sample' => $id_sample,
        //                     'id_testing_type' => $id_testing_type,
        //                     'barcode' => $barcode,
        //                 );

        //                 // var_dump($data_barcode);
        //                 // die();
        
        //                 $this->Moisture_content_model->insert_barcode($data_barcode);
        //             }
        //             $this->session->set_flashdata('message', 'Create Records Success');
        //         } else {
        //             $this->session->set_flashdata('message', 'No Testing Types Selected');
        //         }
        //     }else if ($mode == "edit") {
        //         if (is_array($testing_types)) {
            
        //             // Get the old data
        //             $old_data = $this->Moisture_content_model->get_sample_testing($id_sample);
            
        //             // Check if there are any changes
        //             $changed = false;
        //             foreach ($testing_types as $id_testing_type) {
        //                 $testing_type_name = $this->Moisture_content_model->get_name_by_id($id_testing_type);
        //                 $barcode = $this->Moisture_content_model->get_last_barcode($testing_type_name);
            
        //                 // Check if the testing type is already in the old data
        //                 $old_id_testing_type = array_search($testing_type_name, array_column($old_data, 'testing_type_name'));
        //                 if ($old_id_testing_type !== false) {
        //                     // Check if the barcode is different
        //                     if ($old_data[$old_id_testing_type]['barcode'] != $barcode) {
        //                         $changed = true;
        //                         break;
        //                     }
        //                 } else {
        //                     // New testing type
        //                     $changed = true;
        //                     break;
        //                 }
        //             }
            
        //             if ($changed) {
        //                 // Remove old barcodes related to this sample_id
        //                 $this->Moisture_content_model->delete_barcode($id_sample);
            
        //                 foreach ($testing_types as $id_testing_type) {
        //                     $testing_type_name = $this->Moisture_content_model->get_name_by_id($id_testing_type);
        //                     $barcode = $this->Moisture_content_model->get_last_barcode($testing_type_name);
            
        //                     // Update the sample_reception_sample with new data
        //                     $this->Moisture_content_model->update_det($id_sample, array(
        //                         'id_client_sample' => $id_client_sample,
        //                         'id_project' => $id2_project,
        //                         'id_testing_type' => $id_testing_type,
        //                         'uuid' => $this->uuid->v4(),
        //                         'user_created' => $this->session->userdata('id_users'),
        //                         'date_created' => $dt->format('Y-m-d H:i:s'),
        //                     ));
            
        //                     $data_barcode = array(
        //                         'id_sample' => $id_sample,
        //                         'id_testing_type' => $id_testing_type,
        //                         'barcode' => $barcode,
        //                     );
            
        //                     $this->Moisture_content_model->insert_barcode($data_barcode);
        //                 }
        //                 $this->session->set_flashdata('message', 'Update Records Success');
        //             } else {
        //                 $this->session->set_flashdata('message', 'No Changes Made');
        //             }
        //         } else {
        //             $this->session->set_flashdata('message', 'No Testing Types Selected');
        //         }
        //     }
        //     redirect(site_url("Sample_reception/read/" . $id2_project));
        // }
    
    public function savedetail24() {

    }
  

    public function delete($id) 
    {
        $row = $this->Moisture_content_model->get_by_id($id);
        $data = array(
            'flag' => 1,
            );

        if ($row) {
            $this->Moisture_content_model->update($id, $data);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('Moisture_content'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('Moisture_content'));
        }
    }

    public function delete_detail($id) 
    {
        $row = $this->Moisture_content_model->get_by_id_detail($id);

        if ($row) {
            $id_parent = $row->id_project; // Retrieve project_id before updating the record
            $data = array(
                'flag' => 1,
            );
    
            $this->Moisture_content_model->update_det($id, $data);
            $this->session->set_flashdata('message', 'Delete Record Success');
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
        }
    
        redirect(site_url('Sample_reception/read/'.$id_parent));
    }


    public function get_confirmation_data() {
        $testing_types = $this->input->post('id_testing_type', TRUE);
    
        $data = array();
        if (is_array($testing_types)) {
            foreach ($testing_types as $id_testing_type) {
                $testing_type_name = $this->Moisture_content_model->get_name_by_id($id_testing_type);
                $barcode = $this->Moisture_content_model->get_last_barcode($testing_type_name);
    
                $data[] = array(
                    'testing_type_name' => $testing_type_name,
                    'barcode' => $barcode
                );
            }
        }
    
        echo json_encode($data);
    
    
    }

    public function getIdOneWaterDetails()
    {
        $idOneWaterSample = $this->input->post('id_one_water_sample');
        $oneWaterSample = $this->Moisture_content_model->getOneWaterSampleById($idOneWaterSample);
        echo json_encode($oneWaterSample);
    }

    public function validate24() {
        $id = $this->input->get('id1');
        $data = $this->Moisture_content_model->validate24($id);
        header('Content-Type: application/json');
        echo json_encode($data);
    }
    


}

/* End of file Water_sample_reception.php */
/* Location: ./application/controllers/Water_sample_reception.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2022-12-14 03:38:42 */
/* http://harviacode.com */