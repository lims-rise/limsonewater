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
    
class Campy_biosolids extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        is_login();
        $this->load->model('Campy_biosolids_model');
        $this->load->library('form_validation');        
	    $this->load->library('datatables');
	    $this->load->library('uuid');
    }

    public function index()
    {
        $data['id_one'] = $this->Campy_biosolids_model->getID_one();
        $data['sampletype'] = $this->Campy_biosolids_model->getSampleType();
        $data['labtech'] = $this->Campy_biosolids_model->getLabTech();
        $data['tubes'] = $this->Campy_biosolids_model->getTubes();
        // var_dump($data['id_one']);
        // die();
        // $data['id_project'] = $this->Moisture_content_model->generate_project_id();
        // $data['client'] = $this->Moisture_content_model->generate_client();
        // $data['id_one_water_sample'] = $this->Moisture_content_model->generate_one_water_sample_id();
        $this->template->load('template','campy_biosolids/index', $data);
    } 
    
    public function json() {
        header('Content-Type: application/json');
        echo $this->Campy_biosolids_model->json();
    }

    public function subjsonCharcoal() {
        $id = $this->input->get('idCharcoal',TRUE);
        header('Content-Type: application/json');
        echo $this->Campy_biosolids_model->subjsonCharcoal($id);
    }

    public function subjson72() {
        $id = $this->input->get('id72',TRUE);
        header('Content-Type: application/json');
        echo $this->Campy_biosolids_model->subjson72($id);
    }

    public function read($id)
    {
        // $data['testing_type'] = $this->Campy_biosolids_model->getTest();
        // $data['barcode'] = $this->Water_sample_reception_model->getBarcode();
        // var_dump($id);
        // die();
        $row = $this->Campy_biosolids_model->get_detail($id);
        if ($row) {
            $data = array(

                'id_campy_biosolids' => $row->id_campy_biosolids,
                'id_one_water_sample' => $row->id_one_water_sample,
                'initial' => $row->initial,
                'sampletype' => $row->sampletype,
                'number_of_tubes' => $row->number_of_tubes,
                'mpn_pcr_conducted' => $row->mpn_pcr_conducted,
                'campy_assay_barcode' => $row->campy_assay_barcode,
                'date_sample_processed' => $row->date_sample_processed,
                'time_sample_processed' => $row->time_sample_processed,
                'sample_wetweight' => $row->sample_wetweight,
                'elution_volume' => $row->elution_volume,
            );


                
            $this->template->load('template','campy_biosolids/index_det', $data);

        }
        else {
            // $this->template->load('template','Water_sample_reception/index_det', $test);
        }

    } 

    public function read2($id)
    {
        $data['test'] = $this->Campy_biosolids_model->getTest();
        $row = $this->Campy_biosolids_model->get_detail2($id);
        if ($row) {
            $data = array(
                'id_project' => $row->id_project,
                'id_sample' => $row->id_sample,
                'sample_description' => $row->sample_description,
                'test' => $this->Campy_biosolids_model->getTest(),
                );
                $this->template->load('template','campy_biosolids/index_det2', $data);
        }
        else {
            // $this->template->load('template','Water_sample_reception/index_det');
        }
    }     

    // public function save() {
    //     $mode = $this->input->post('mode', TRUE);
    //     $id_moisture = $this->input->post('idx_moisture', TRUE);
    //     $dt = new DateTime();

    //     $id_one_water_sample = $this->input->post('id_one_water_sample', TRUE);
    //     $idx_one_water_sample = $this->input->post('idx_one_water_sample', TRUE);
    //     $id_person = $this->input->post('id_person', TRUE);
    //     $date_start = $this->input->post('date_start', TRUE);
    //     $id_sampletype = $this->input->post('id_sampletype', TRUE);
    //     $barcode_moisture_content = $this->input->post('barcode_moisture_content', TRUE);
    //     $tray_weight = $this->input->post('tray_weight', TRUE);
    //     $traysample_wetweight = $this->input->post('traysample_wetweight', TRUE);
    //     $time_incubator = $this->input->post('time_incubator', TRUE);
    //     $comments = $this->input->post('comments', TRUE);
    //     // $date_collected = $this->input->post('date_collected',TRUE);
    //     // $time_collected = $this->input->post('time_collected',TRUE);
        
    
    //     if ($mode == "insert") {
    //         $data = array(
    //             'id_one_water_sample' => $id_one_water_sample,
    //             'id_person' => $id_person,
    //             'date_start' => $date_start,
    //             'id_sampletype' => $id_sampletype,
    //             'barcode_moisture_content' => $barcode_moisture_content,
    //             'tray_weight' => $tray_weight,
    //             'traysample_wetweight' => $traysample_wetweight,
    //             'time_incubator' => $time_incubator,
    //             'comments' => $comments,
    //             'flag' => '0',
    //             'lab' => $this->session->userdata('lab'),
    //             'uuid' => $this->uuid->v4(),
    //             'user_created' => $this->session->userdata('id_users'),
    //             'date_created' => $dt->format('Y-m-d H:i:s'),
    //         );

    //         // var_dump($data);
    //         // die();
    
    //         $this->Campy_biosolids_model->insert($data);
    //         $this->session->set_flashdata('message', 'Create Record Success');

    //     } else if ($mode == "edit") {
    //         $data = array(
    //             'id_one_water_sample' => $idx_one_water_sample,
    //             'id_person' => $id_person,
    //             'date_start' => $date_start,
    //             'id_sampletype' => $id_sampletype,
    //             'barcode_moisture_content' => $barcode_moisture_content,
    //             'tray_weight' => $tray_weight,
    //             'traysample_wetweight' => $traysample_wetweight,
    //             'time_incubator' => $time_incubator,
    //             'comments' => $comments,
    //             'flag' => '0',
    //             'lab' => $this->session->userdata('lab'),
    //             'uuid' => $this->uuid->v4(),
    //             'user_created' => $this->session->userdata('id_users'),
    //             'date_created' => $dt->format('Y-m-d H:i:s'),
    //         );

    //         // var_dump($data);
    //         // die();

    //         $this->Campy_biosolids_model->update($id_moisture, $data);
    //         $this->session->set_flashdata('message', 'Update Record Success');
    //     }
    
    //     redirect(site_url("campy_biosolids"));
    // }

    public function save() {
        $mode = $this->input->post('mode', TRUE);
        $id_campy_biosolids = $this->input->post('id_campy_biosolids', TRUE);
        $dt = new DateTime();
    
        $id_one_water_sample = $this->input->post('id_one_water_sample', TRUE);
        $idx_one_water_sample = $this->input->post('idx_one_water_sample', TRUE);
        $id_person = $this->input->post('id_person', TRUE);
        $id_sampletype = $this->input->post('id_sampletype', TRUE);
        $number_of_tubes = $this->input->post('number_of_tubes', TRUE);
        $mpn_pcr_conducted = $this->input->post('mpn_pcr_conducted', TRUE);
        $campy_assay_barcode = $this->input->post('campy_assay_barcode', TRUE);
        $date_sample_processed = $this->input->post('date_sample_processed', TRUE);
        $time_sample_processed = $this->input->post('time_sample_processed', TRUE);
        $sample_wetweight = $this->input->post('sample_wetweight', TRUE);
        $elution_volume = $this->input->post('elution_volume', TRUE);
    
        if ($mode == "insert") {
            // Insert data into assays table
            $data = array(
                'id_one_water_sample' => $id_one_water_sample,
                'id_person' => $id_person,
                'id_sampletype' => $id_sampletype,
                'number_of_tubes' => $number_of_tubes,
                'mpn_pcr_conducted' => $mpn_pcr_conducted,
                'campy_assay_barcode' => $campy_assay_barcode,
                'date_sample_processed' => $date_sample_processed,
                'time_sample_processed' => $time_sample_processed,
                'sample_wetweight' => $sample_wetweight,
                'elution_volume' => $elution_volume,
                'flag' => '0',
                'lab' => $this->session->userdata('lab'),
                'uuid' => $this->uuid->v4(),
                'user_created' => $this->session->userdata('id_users'),
                'date_created' => $dt->format('Y-m-d H:i:s'),
            );

            // var_dump($data);
            // die();
    
            $assay_id = $this->Campy_biosolids_model->insert($data);
    
            // Insert sample volumes
            $number_of_tubes = $this->input->post('number_of_tubes', TRUE);
            for ($i = 1; $i <= $number_of_tubes; $i++) {
                $volume = $this->input->post("vol_sampletube{$i}", TRUE);
                if ($volume) {
                    $this->Campy_biosolids_model->insert_sample_volume(array(
                        'id_campy_biosolids' => $assay_id,
                        'tube_number' => $i,
                        'vol_sampletube' => $volume,
                        'flag' => '0',
                        'lab' => $this->session->userdata('lab'),
                        'uuid' => $this->uuid->v4(),
                        'user_created' => $this->session->userdata('id_users'),
                        'date_created' => $dt->format('Y-m-d H:i:s'),
                    ));
                }
            }
    
            $this->session->set_flashdata('message', 'Create Record Success');
    
        } else if ($mode == "edit") {
            // Update data in assays table
            $data = array(
                'id_one_water_sample' => $idx_one_water_sample,
                'id_person' => $id_person,
                'id_sampletype' => $id_sampletype,
                'number_of_tubes' => $number_of_tubes,
                'mpn_pcr_conducted' => $mpn_pcr_conducted,
                'campy_assay_barcode' => $campy_assay_barcode,
                'date_sample_processed' => $date_sample_processed,
                'time_sample_processed' => $time_sample_processed,
                'sample_wetweight' => $sample_wetweight,
                'elution_volume' => $elution_volume,
                'flag' => '0',
                'lab' => $this->session->userdata('lab'),
                'uuid' => $this->uuid->v4(),
                'user_updated' => $this->session->userdata('id_users'),
                'date_updated' => $dt->format('Y-m-d H:i:s'),
            );

            // var_dump($data);
            // die();
    
            $this->Campy_biosolids_model->update($id_campy_biosolids, $data);
    
            // // Update sample volumes
            // $number_of_tubes = $this->input->post('number_of_tubes', TRUE);
            // $this->Campy_biosolids_model->delete_sample_volumes($id_moisture); // Hapus volume yang ada
    
            // for ($i = 1; $i <= $number_of_tubes; $i++) {
            //     $volume = $this->input->post("vol_sampletube{$i}", TRUE);
            //     var_dump($volume);
            //     if ($volume) {
            //         $this->Campy_biosolids_model->insert_sample_volume(array(
            //             'id_campy_biosolids' => $assay_id,
            //             'tube_number' => $i,
            //             'vol_sampletube' => $volume,
            //             'flag' => '0',
            //             'lab' => $this->session->userdata('lab'),
            //             'uuid' => $this->uuid->v4(),
            //             'user_created' => $this->session->userdata('id_users'),
            //             'date_created' => $dt->format('Y-m-d H:i:s'),
            //         ));
            //     }
            // }
            // Update sample volumes
            $number_of_tubes = $this->input->post('number_of_tubes', TRUE);
            // var_dump($number_of_tubes); // var dump jumlah tube
            // die();
            $this->Campy_biosolids_model->delete_sample_volumes($id_campy_biosolids); // Hapus volume yang ada

            for ($i = 1; $i <= $number_of_tubes; $i++) {
                $volume = $this->input->post("vol_sampletube{$i}", TRUE);
                // var_dump($volume); // var dump volume pada setiap tube

                if ($volume) {
                    $data_volume = array(
                        'id_campy_biosolids' => $id_campy_biosolids,
                        'tube_number' => $i,
                        'vol_sampletube' => $volume,
                        'flag' => '0',
                        'lab' => $this->session->userdata('lab'),
                        'uuid' => $this->uuid->v4(),
                        'user_created' => $this->session->userdata('id_users'),
                        'date_created' => $dt->format('Y-m-d H:i:s'),
                    );
                    // var_dump($data_volume); // var dump data volume sebelum diinsert
                    // die();
                    $this->Campy_biosolids_model->insert_sample_volume($data_volume);
                }
            }
    
            $this->session->set_flashdata('message', 'Update Record Success');
        }
    
        redirect(site_url("campy_biosolids"));
    }

    public function saveResultsCharcoal() {
        $mode = $this->input->post('mode_detResultsCharcoal', TRUE);
        $id_campy_biosolids = $this->input->post('id_campy_biosolids1', TRUE);
        $id_result_charcoal = $this->input->post('id_result_charcoal', TRUE);
        $dt = new DateTime();
        $date_sample_processed = $this->input->post('date_sample_processed1', TRUE);
        $time_sample_processed = $this->input->post('time_sample_processed1', TRUE);
    
        if ($mode == "insert") {
            // Insert data into assays table
            $data = array(
                'id_campy_biosolids' => $id_campy_biosolids,
                'date_sample_processed' => $date_sample_processed,
                'time_sample_processed' => $time_sample_processed,
                'flag' => '0',
                'lab' => $this->session->userdata('lab'),
                'uuid' => $this->uuid->v4(),
                'user_created' => $this->session->userdata('id_users'),
                'date_created' => $dt->format('Y-m-d H:i:s'),
            );

            // var_dump($data);
            // die();
    
            $assay_id = $this->Campy_biosolids_model->insertResultsCharcoal($data);
    
            // Insert sample volumes
            $number_of_tubes = $this->input->post('number_of_tubes1', TRUE);
            for ($i = 1; $i <= $number_of_tubes; $i++) {
                $plate = $this->input->post("growth_plate{$i}", TRUE);
                if ($plate) {
                    $this->Campy_biosolids_model->insert_growth_plate(array(
                        'id_result_charcoal' => $assay_id,
                        'plate_number' => $i,
                        'growth_plate' => $plate,
                        'flag' => '0',
                        'lab' => $this->session->userdata('lab'),
                        'uuid' => $this->uuid->v4(),
                        'user_created' => $this->session->userdata('id_users'),
                        'date_created' => $dt->format('Y-m-d H:i:s'),
                    ));
                }
            }
    
            $this->session->set_flashdata('message', 'Create Record Success');
    
        } else if ($mode == "edit") {
            // Update data in assays table
            $data = array(
                'id_campy_biosolids' => $id_campy_biosolids,
                'date_sample_processed' => $date_sample_processed,
                'time_sample_processed' => $time_sample_processed,
                'flag' => '0',
                'lab' => $this->session->userdata('lab'),
                'uuid' => $this->uuid->v4(),
                'user_updated' => $this->session->userdata('id_users'),
                'date_updated' => $dt->format('Y-m-d H:i:s'),
            );

            // var_dump($data);
            // die();
    
            $this->Campy_biosolids_model->updateResultsCharcoal($id_result_charcoal, $data);

            // Update sample volumes
            $number_of_tubes = $this->input->post('number_of_tubes1', TRUE);
            $this->Campy_biosolids_model->delete_growth_plates($id_result_charcoal); // Hapus volume yang ada

            for ($i = 1; $i <= $number_of_tubes; $i++) {
                $plate = $this->input->post("growth_plate{$i}", TRUE);
                if ($plate) {
                    $data_plate = array(
                        'id_result_charcoal' => $id_result_charcoal,
                        'plate_number' => $i,
                        'growth_plate' => $plate,
                        'flag' => '0',
                        'lab' => $this->session->userdata('lab'),
                        'uuid' => $this->uuid->v4(),
                        'user_created' => $this->session->userdata('id_users'),
                        'date_created' => $dt->format('Y-m-d H:i:s'),
                    );
                    $this->Campy_biosolids_model->insert_growth_plate($data_plate);
                }
            }
    
            $this->session->set_flashdata('message', 'Update Record Success');
        }
    
        redirect(site_url("campy_biosolids/read/" . $id_campy_biosolids));
    }
    

    
    public function savedetail24() {
            $mode_det24 = $this->input->post('mode_det24', TRUE);
            $dt = new DateTime();
            // var_dump($id_moisture);
            // die();
        
            $id_moisture = $this->input->post('idx_moisture24', TRUE);
            $id_moisture24 = $this->input->post('id_moisture24', TRUE);
            $date_moisture24 = $this->input->post('date_moisture24', TRUE);
            $time_moisture24 = $this->input->post('time_moisture24', TRUE);
            $barcode_tray = $this->input->post('barcode_tray24', TRUE);
            $dry_weight24 = $this->input->post('dry_weight24', TRUE);
            $comments24 = $this->input->post('comments24', TRUE);
        
            if($mode_det24 == "insert") {
                $data = array(
                    'id_moisture' => $id_moisture,
                    'date_moisture24' => $date_moisture24,
                    'time_moisture24' => $time_moisture24,
                    'barcode_tray' => $barcode_tray,
                    'dry_weight24' => $dry_weight24,
                    'comments24' => $comments24,
                    'flag' => '0',
                    'lab' => $this->session->userdata('lab'),
                    'uuid' => $this->uuid->v4(),
                    'user_created' => $this->session->userdata('id_users'),
                    'date_created' => $dt->format('Y-m-d H:i:s'),
                );
                // var_dump($data);
                // die();
        
                $insert_id = $this->Campy_biosolids_model->insert_det24($data);
                if ($insert_id) {
                    $this->session->set_flashdata('message', 'Create Record Success');
                } else {
                    $this->session->set_flashdata('error', 'Failed to create record');
                }
            } else if($mode_det24 == "edit") {
                $data = array(
                    'date_moisture24' => $date_moisture24,
                    'time_moisture24' => $time_moisture24,
                    'barcode_tray' => $barcode_tray,
                    'dry_weight24' => $dry_weight24,
                    'comments24' => $comments24,
                    'flag' => '0',
                    'lab' => $this->session->userdata('lab'),
                    'uuid' => $this->uuid->v4(),
                    'user_created' => $this->session->userdata('id_users'),
                    'date_created' => $dt->format('Y-m-d H:i:s'),
                );
                // var_dump($data);
                // die();
                $result = $this->Campy_biosolids_model->update_det24($id_moisture24, $data);
                if ($result) {
                    $this->session->set_flashdata('message', 'Update Record Success');
                } else {
                    $this->session->set_flashdata('error', 'Failed to update record');
                }
            }
        
            redirect(site_url("campy_biosolids/read/" . $id_moisture));
    }


    public function savedetail72() {
        $mode_det72 = $this->input->post('mode_det72', TRUE);
        $dt = new DateTime();

        $id_moisture = $this->input->post('idx_moisture72', TRUE);
        $id_moisture72 = $this->input->post('id_moisture72', TRUE);
        $date_moisture72 = $this->input->post('date_moisture72', TRUE);
        $time_moisture72 = $this->input->post('time_moisture72', TRUE);
        $barcode_tray = $this->input->post('barcode_tray72', TRUE);
        $dry_weight72 = $this->input->post('dry_weight72', TRUE);
        $dry_weight_persen = $this->input->post('dry_weight_persen', TRUE);
        $comments72 = $this->input->post('comments72', TRUE);

        if($mode_det72 == "insert") {
            $data = array(
                'id_moisture' => $id_moisture,
                'date_moisture72' => $date_moisture72,
                'time_moisture72' => $time_moisture72,
                'barcode_tray' => $barcode_tray,
                'dry_weight72' => $dry_weight72,
                'dry_weight_persen' => $dry_weight_persen,
                'comments72' => $comments72,
                'flag' => '0',
                'lab' => $this->session->userdata('lab'),
                'uuid' => $this->uuid->v4(),
                'user_created' => $this->session->userdata('id_users'),
                'date_created' => $dt->format('Y-m-d H:i:s'),
            );
            // var_dump($data);
            // die();
    
            $insert_id = $this->Campy_biosolids_model->insert_det72($data);
            if ($insert_id) {
                $this->session->set_flashdata('message', 'Create Record Success');
            } else {
                $this->session->set_flashdata('error', 'Failed to create record');
            }
        } else if($mode_det72 == "edit") {
            $data = array(
                'date_moisture72' => $date_moisture72,
                'time_moisture72' => $time_moisture72,
                'barcode_tray' => $barcode_tray,
                'dry_weight72' => $dry_weight72,
                'dry_weight_persen' => $dry_weight_persen,
                'comments72' => $comments72,
                'flag' => '0',
                'lab' => $this->session->userdata('lab'),
                'uuid' => $this->uuid->v4(),
                'user_created' => $this->session->userdata('id_users'),
                'date_created' => $dt->format('Y-m-d H:i:s'),
            );
            // var_dump($data);
            // die();
            $result = $this->Campy_biosolids_model->update_det72($id_moisture72, $data);
            if ($result) {
                $this->session->set_flashdata('message', 'Update Record Success');
            } else {
                $this->session->set_flashdata('error', 'Failed to update record');
            }
        }
    
        redirect(site_url("campy_biosolids/read/" . $id_moisture));

    }
  

    public function delete($id) 
    {
        $row = $this->Campy_biosolids_model->get_by_id($id);
        $data = array(
            'flag' => 1,
            );

        if ($row) {
            $this->Campy_biosolids_model->update($id, $data);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('campy_biosolids'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('campy_biosolids'));
        }
    }

    public function delete_detail24($id) 
    {
        $row = $this->Campy_biosolids_model->get_by_id_detail24($id);
        if ($row) {
            $id_parent = $row->id_moisture; // Retrieve project_id before updating the record
            $data = array(
                'flag' => 1,
            );
    
            $this->Campy_biosolids_model->update_det24($id, $data);
            $this->session->set_flashdata('message', 'Delete Record Success');
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
        }
    
        redirect(site_url('campy_biosolids/read/'.$id_parent));
    }

    public function delete_detail72($id) 
    {
        $row = $this->Campy_biosolids_model->get_by_id_detail72($id);
        if ($row) {
            $id_parent = $row->id_moisture; // Retrieve project_id before updating the record
            $data = array(
                'flag' => 1,
            );
    
            $this->Campy_biosolids_model->update_det72($id, $data);
            $this->session->set_flashdata('message', 'Delete Record Success');
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
        }
    
        redirect(site_url('campy_biosolids/read/'.$id_parent));
    }


    public function getIdOneWaterDetails()
    {
        $idOneWaterSample = $this->input->post('id_one_water_sample');
        $oneWaterSample = $this->Campy_biosolids_model->getOneWaterSampleById($idOneWaterSample);
        echo json_encode($oneWaterSample);
    }

    public function validate24() {
        $id = $this->input->get('id24');
        $data = $this->Campy_biosolids_model->validate24($id);
        header('Content-Type: application/json');
        echo json_encode($data);
    }

    public function validate72() {
        $id = $this->input->get('id72');
        $data = $this->Campy_biosolids_model->validate72($id);
        header('Content-Type: application/json');
        echo json_encode($data);
    }
    
    public function excel() {
    
        $spreadsheet = new Spreadsheet();    
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setCellValue('A1', "Id One Water Sample"); 
        $sheet->setCellValue('B1', "Lab Tech"); 
        $sheet->setCellValue('C1', "Date Assay Start");
        $sheet->setCellValue('D1', "Sample Type");
        $sheet->setCellValue('E1', "Barcode Moisture Content");
        $sheet->setCellValue('F1', "Tray Weight");
        $sheet->setCellValue('G1', "Tray sample (wet weight)");
        $sheet->setCellValue('H1', "Time Incubator");
        $sheet->setCellValue('I1', "Comments");
        $sheet->setCellValue('J1', "Date Moisture 24");
        $sheet->setCellValue('K1', "Time Moisture 24");
        $sheet->setCellValue('L1', "Dry Weight 24");
        $sheet->setCellValue('M1', "Comments 24");
        $sheet->setCellValue('N1', "Date Moisture 72");
        $sheet->setCellValue('O1', "Time Moisture 72");
        $sheet->setCellValue('P1', "Dry Weight 72");
        $sheet->setCellValue('Q1', "Dry Weight Percentage");
        $sheet->setCellValue('R1', "Comments 72");

        $moisture = $this->Campy_biosolids_model->get_all();
    
        $numrow = 2;
        foreach($moisture as $data){ 
            if (property_exists($data, 'id_one_water_sample')) {
                $sheet->setCellValue('A'.$numrow, $data->id_one_water_sample);
            } else {
                $sheet->setCellValue('A'.$numrow, '');
            }
    
            if (property_exists($data, 'initial')) {
                $sheet->setCellValue('B'.$numrow, $data->initial);
            } else {
                $sheet->setCellValue('B'.$numrow, '');
            }
    
            if (property_exists($data, 'date_start')) {
                $sheet->setCellValue('C'.$numrow, $data->date_start);
            } else {
                $sheet->setCellValue('C'.$numrow, '');
            }
    
            if (property_exists($data, 'sample_type')) {
                $sheet->setCellValue('D'.$numrow, $data->sampletype);
            } else {
                $sheet->setCellValue('D'.$numrow, '');
            }
    
            if (property_exists($data, 'barcode_moisture_content')) {
                $sheet->setCellValue('E'.$numrow, $data->barcode_moisture_content);
            } else {
                $sheet->setCellValue('E'.$numrow, '');
            }
    
            if (property_exists($data, 'tray_weight')) {
                $sheet->setCellValue('F'.$numrow, $data->tray_weight);
            } else {
                $sheet->setCellValue('F'.$numrow, '');
            }
    
            if (property_exists($data, 'traysample_wetweight')) {
                $sheet->setCellValue('G'.$numrow, $data->traysample_wetweight);
            } else {
                $sheet->setCellValue('G'.$numrow, '');
            }
    
            if (property_exists($data, 'time_incubator')) {
                $sheet->setCellValue('H'.$numrow, $data->time_incubator);
            } else {
                $sheet->setCellValue('H'.$numrow, '');
            }
    
            if (property_exists($data, 'comments')) {
                $sheet->setCellValue('I'.$numrow, $data->comments);
            } else {
                $sheet->setCellValue('I'.$numrow, '');
            }
    
            if (property_exists($data, 'date_moisture24')) {
                $sheet->setCellValue('J'.$numrow, $data->date_moisture24);
            } else {
                $sheet->setCellValue('J'.$numrow, '');
            }
    
            if (property_exists($data, 'time_moisture24')) {
                $sheet->setCellValue('K'.$numrow, $data->time_moisture24);
            }

           
            if (property_exists($data, 'dry_weight24')) {
                $sheet->setCellValue('L'.$numrow, $data->dry_weight24);
            } else {
                $sheet->setCellValue('L'.$numrow, '');
            }

            if (property_exists($data, 'comments24')) {
                $sheet->setCellValue('M'.$numrow, $data->comments24);
            } else {
                $sheet->setCellValue('M'.$numrow, '');
            }

            if (property_exists($data, 'date_moisture72')) {
                $sheet->setCellValue('N'.$numrow, $data->date_moisture72);
            } else {
                $sheet->setCellValue('N'.$numrow, '');
            }

            if (property_exists($data, 'time_moisture72')) {
                $sheet->setCellValue('O'.$numrow, $data->time_moisture72);
            } else {
                $sheet->setCellValue('O'.$numrow, '');
            }

            if (property_exists($data, 'dry_weight72')) {
                $sheet->setCellValue('P'.$numrow, $data->dry_weight72);
            } else {
                $sheet->setCellValue('P'.$numrow, '');
            }

            if (property_exists($data, 'dry_weight_persen')) {
                $sheet->setCellValue('Q'.$numrow, $data->dry_weight_persen);
            } else {
                $sheet->setCellValue('Q'.$numrow, '');
            }

            if (property_exists($data, 'comments72')) {
                $sheet->setCellValue('R'.$numrow, $data->comments72);
            } else {
                $sheet->setCellValue('R'.$numrow, '');
            }

            $numrow++;
        }

        // Set header untuk file excel
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="Report_campy_biosolids.xlsx"');
        header('Cache-Control: max-age=0');

        // Tampilkan file excel
        $writer = new Xlsx($spreadsheet);
        $writer->save('php://output');
    }

    public function validateBarcodeMoistureContent() {
        $id = $this->input->get('id');
        $data = $this->Campy_biosolids_model->validateBarcodeMoistureContent($id);
        header('Content-Type: application/json');
        echo json_encode($data);
    }

}

/* End of file Water_sample_reception.php */
/* Location: ./application/controllers/Water_sample_reception.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2022-12-14 03:38:42 */
/* http://harviacode.com */