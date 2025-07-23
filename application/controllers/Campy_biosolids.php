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

    public function subjsonHba() {
        $id = $this->input->get('idHba',TRUE);
        header('Content-Type: application/json');
        echo $this->Campy_biosolids_model->subjsonHba($id);
    }

    public function subjsonBiochemical() {
        $id = $this->input->get('idBiochemical',TRUE);
        $biochemical_tube = $this->input->get('biochemical_tube', TRUE);
        header('Content-Type: application/json');
        echo $this->Campy_biosolids_model->subjsonBiochemical($id, $biochemical_tube);
    }

    public function read($id)
    {
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
                'vol_sampletube' => $row->vol_sampletube,
                'tube_number' => $row->tube_number,
                'full_name' => $row->full_name,
                'user_review' => $row->user_review,
                'review' => $row->review,
                'user_created' => $row->user_created,
                
            );
            
            // Mendapatkan final concentration
            $finalConcentration = $this->Campy_biosolids_model->subjsonFinalConcentration($id);
            if ($finalConcentration) {
                $data['finalConcentration'] = $finalConcentration;
            } else {
                $data['finalConcentration'] = []; // Pastikan ini tidak null
            }
            // var_dump($data);
            // die();
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


    public function save() {
        $mode = $this->input->post('mode', TRUE);
        $id_campy_biosolids = $this->input->post('id_campy_biosolids', TRUE);
        $dt = new DateTime();
    
        $id_one_water_sample = $this->input->post('id_one_water_sample', TRUE);
        $idx_one_water_sample = $this->input->post('idx_one_water_sample', TRUE);
        $id_person = $this->input->post('id_person', TRUE);
        $id_sampletype = $this->input->post('id_sampletype', TRUE);
        $number_of_tubes = $this->input->post('number_of_tubes', TRUE);
        $number_of_tubes1 = $this->input->post('number_of_tubes1', TRUE);
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
                'number_of_tubes' => $number_of_tubes1,
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
    
            $this->Campy_biosolids_model->updateCampyBiosolids($id_campy_biosolids, $data);
    
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
            $number_of_tubes = $this->input->post('number_of_tubes1', TRUE);
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
                if ($plate !== null) {
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
                if ($plate !== null) {
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

    public function saveResultsHBA() {
        $mode = $this->input->post('mode_detResultsHBA', TRUE);
        $id_campy_biosolids = $this->input->post('id_campy_biosolidsHBA', TRUE);
        $id_result_hba = $this->input->post('id_result_hba', TRUE);

        $dt = new DateTime();
        $date_sample_processed = $this->input->post('date_sample_processedHBA', TRUE);
        $time_sample_processed = $this->input->post('time_sample_processedHBA', TRUE);
    
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
    
            $assay_id = $this->Campy_biosolids_model->insertResultsHba($data);
    
            // Insert sample volumes
            $number_of_tubes = $this->input->post('number_of_tubesHba', TRUE);
            for ($i = 1; $i <= $number_of_tubes; $i++) {
                $plate = $this->input->post("growth_plate{$i}", TRUE);

                if ($plate !== null) {
                    $this->Campy_biosolids_model->insert_growth_plate_hba(array(
                        'id_result_hba' => $assay_id,
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
    
            $this->Campy_biosolids_model->updateResultsHba($id_result_hba, $data);
    
            // Update sample volumes
            $number_of_tubes = $this->input->post('number_of_tubesHba', TRUE);
            $this->Campy_biosolids_model->delete_growth_plates_hba($id_result_hba); // Hapus volume yang ada
    
            for ($i = 1; $i <= $number_of_tubes; $i++) {
                $plate = $this->input->post("growth_plate{$i}", TRUE);
                if ($plate !== null) {
                    $data_plate = array(
                        'id_result_hba' => $id_result_hba,
                        'plate_number' => $i,
                        'growth_plate' => $plate,
                        'flag' => '0',
                        'lab' => $this->session->userdata('lab'),
                        'uuid' => $this->uuid->v4(),
                        'user_created' => $this->session->userdata('id_users'),
                        'date_created' => $dt->format('Y-m-d H:i:s'),
                    );
                    $this->Campy_biosolids_model->insert_growth_plate_hba($data_plate);
                }
            }
    
            $this->session->set_flashdata('message', 'Update Record Success');
        }
    
        redirect(site_url("campy_biosolids/read/" . $id_campy_biosolids));
    }


    public function saveBiochemical() {
        $mode = $this->input->post('mode_detResultsBiochemical', TRUE);
        $id_result_biochemical = $this->input->post('id_result_biochemical', TRUE);
        $id_result_hba = $this->input->post('id_result_hba1', TRUE);
        $id_campy_biosolids = $this->input->post('id_campy_biosolidsBiochemical', TRUE);
        $gramlysis = $this->input->post('gramlysis', TRUE);
        $oxidase = $this->input->post('oxidase', TRUE);
        $catalase = $this->input->post('catalase', TRUE);
        $confirmation = $this->input->post('confirmation', TRUE);
        $sample_store = $this->input->post('sample_store', TRUE);
        $biochemical_tube = $this->input->post('biochemical_tube', TRUE);
    
        // Defaukt value if the attribute is null
        if ($gramlysis === null) $gramlysis = '-';
        if ($oxidase === null) $oxidase = '-';
        if ($catalase === null) $catalase = '-';
    
        if ($mode == "insert") {
            $data = array(
                'id_campy_biosolids' => $id_campy_biosolids,
                'id_result_hba' => $id_result_hba,
                'gramlysis' => $gramlysis,
                'oxidase' => $oxidase,
                'catalase' => $catalase,
                'confirmation' => $confirmation,
                'sample_store' => $sample_store,
                'biochemical_tube' => $biochemical_tube,
                'flag' => '0',
                'lab' => $this->session->userdata('lab'),
                'uuid' => $this->uuid->v4(),
                'user_created' => $this->session->userdata('id_users'),
                'date_created' => date('Y-m-d H:i:s'),
            );
            $this->Campy_biosolids_model->insertResultsBiochemical($data);
        } else if ($mode == "edit") {
            $data = array(
                'id_campy_biosolids' => $id_campy_biosolids,
                'id_result_hba' => $id_result_hba,
                'gramlysis' => $gramlysis,
                'oxidase' => $oxidase,
                'catalase' => $catalase,
                'confirmation' => $confirmation,
                'sample_store' => $sample_store,
                'flag' => '0',
                'lab' => $this->session->userdata('lab'),
                'uuid' => $this->uuid->v4(),
                'user_updated' => $this->session->userdata('id_users'),
                'date_updated' => date('Y-m-d H:i:s'),
            );
            $this->Campy_biosolids_model->updateResultsBiochemical($id_result_biochemical, $data);
        }
    
        redirect(site_url("campy_biosolids/read/" . $id_campy_biosolids));
    }
    
    

    
    // public function savedetail24() {
    //         $mode_det24 = $this->input->post('mode_det24', TRUE);
    //         $dt = new DateTime();
    //         // var_dump($id_moisture);
    //         // die();
        
    //         $id_moisture = $this->input->post('idx_moisture24', TRUE);
    //         $id_moisture24 = $this->input->post('id_moisture24', TRUE);
    //         $date_moisture24 = $this->input->post('date_moisture24', TRUE);
    //         $time_moisture24 = $this->input->post('time_moisture24', TRUE);
    //         $barcode_tray = $this->input->post('barcode_tray24', TRUE);
    //         $dry_weight24 = $this->input->post('dry_weight24', TRUE);
    //         $comments24 = $this->input->post('comments24', TRUE);
        
    //         if($mode_det24 == "insert") {
    //             $data = array(
    //                 'id_moisture' => $id_moisture,
    //                 'date_moisture24' => $date_moisture24,
    //                 'time_moisture24' => $time_moisture24,
    //                 'barcode_tray' => $barcode_tray,
    //                 'dry_weight24' => $dry_weight24,
    //                 'comments24' => $comments24,
    //                 'flag' => '0',
    //                 'lab' => $this->session->userdata('lab'),
    //                 'uuid' => $this->uuid->v4(),
    //                 'user_created' => $this->session->userdata('id_users'),
    //                 'date_created' => $dt->format('Y-m-d H:i:s'),
    //             );
    //             // var_dump($data);
    //             // die();
        
    //             $insert_id = $this->Campy_biosolids_model->insert_det24($data);
    //             if ($insert_id) {
    //                 $this->session->set_flashdata('message', 'Create Record Success');
    //             } else {
    //                 $this->session->set_flashdata('error', 'Failed to create record');
    //             }
    //         } else if($mode_det24 == "edit") {
    //             $data = array(
    //                 'date_moisture24' => $date_moisture24,
    //                 'time_moisture24' => $time_moisture24,
    //                 'barcode_tray' => $barcode_tray,
    //                 'dry_weight24' => $dry_weight24,
    //                 'comments24' => $comments24,
    //                 'flag' => '0',
    //                 'lab' => $this->session->userdata('lab'),
    //                 'uuid' => $this->uuid->v4(),
    //                 'user_created' => $this->session->userdata('id_users'),
    //                 'date_created' => $dt->format('Y-m-d H:i:s'),
    //             );
    //             // var_dump($data);
    //             // die();
    //             $result = $this->Campy_biosolids_model->update_det24($id_moisture24, $data);
    //             if ($result) {
    //                 $this->session->set_flashdata('message', 'Update Record Success');
    //             } else {
    //                 $this->session->set_flashdata('error', 'Failed to update record');
    //             }
    //         }
        
    //         redirect(site_url("campy_biosolids/read/" . $id_moisture));
    // }


    // public function savedetail72() {
    //     $mode_det72 = $this->input->post('mode_det72', TRUE);
    //     $dt = new DateTime();

    //     $id_moisture = $this->input->post('idx_moisture72', TRUE);
    //     $id_moisture72 = $this->input->post('id_moisture72', TRUE);
    //     $date_moisture72 = $this->input->post('date_moisture72', TRUE);
    //     $time_moisture72 = $this->input->post('time_moisture72', TRUE);
    //     $barcode_tray = $this->input->post('barcode_tray72', TRUE);
    //     $dry_weight72 = $this->input->post('dry_weight72', TRUE);
    //     $dry_weight_persen = $this->input->post('dry_weight_persen', TRUE);
    //     $comments72 = $this->input->post('comments72', TRUE);

    //     if($mode_det72 == "insert") {
    //         $data = array(
    //             'id_moisture' => $id_moisture,
    //             'date_moisture72' => $date_moisture72,
    //             'time_moisture72' => $time_moisture72,
    //             'barcode_tray' => $barcode_tray,
    //             'dry_weight72' => $dry_weight72,
    //             'dry_weight_persen' => $dry_weight_persen,
    //             'comments72' => $comments72,
    //             'flag' => '0',
    //             'lab' => $this->session->userdata('lab'),
    //             'uuid' => $this->uuid->v4(),
    //             'user_created' => $this->session->userdata('id_users'),
    //             'date_created' => $dt->format('Y-m-d H:i:s'),
    //         );
    //         // var_dump($data);
    //         // die();
    
    //         $insert_id = $this->Campy_biosolids_model->insert_det72($data);
    //         if ($insert_id) {
    //             $this->session->set_flashdata('message', 'Create Record Success');
    //         } else {
    //             $this->session->set_flashdata('error', 'Failed to create record');
    //         }
    //     } else if($mode_det72 == "edit") {
    //         $data = array(
    //             'date_moisture72' => $date_moisture72,
    //             'time_moisture72' => $time_moisture72,
    //             'barcode_tray' => $barcode_tray,
    //             'dry_weight72' => $dry_weight72,
    //             'dry_weight_persen' => $dry_weight_persen,
    //             'comments72' => $comments72,
    //             'flag' => '0',
    //             'lab' => $this->session->userdata('lab'),
    //             'uuid' => $this->uuid->v4(),
    //             'user_created' => $this->session->userdata('id_users'),
    //             'date_created' => $dt->format('Y-m-d H:i:s'),
    //         );
    //         // var_dump($data);
    //         // die();
    //         $result = $this->Campy_biosolids_model->update_det72($id_moisture72, $data);
    //         if ($result) {
    //             $this->session->set_flashdata('message', 'Update Record Success');
    //         } else {
    //             $this->session->set_flashdata('error', 'Failed to update record');
    //         }
    //     }
    
    //     redirect(site_url("campy_biosolids/read/" . $id_moisture));

    // }
  

    // public function delete($id) {
    //     $row = $this->Campy_biosolids_model->get_by_id($id);
    //     $data = array(
    //         'flag' => 1,
    //         );

    //     if ($row) {
    //         $this->Campy_biosolids_model->update($id, $data);
    //         $this->session->set_flashdata('message', 'Delete Record Success');
    //         redirect(site_url('campy_biosolids'));
    //     } else {
    //         $this->session->set_flashdata('message', 'Record Not Found');
    //         redirect(site_url('campy_biosolids'));
    //     }
    // }


    public function delete_campyBiosolids($id) {
        $row = $this->Campy_biosolids_model->get_by_id_campybiosolids($id);
        if ($row) {
            $id_parent = $row->id_result_charcoal; // Retrieve project_id before updating the record
            $data = array(
                'flag' => 1,
            );
    
            $this->Campy_biosolids_model->updateCampyBiosolids($id, $data);
            $this->Campy_biosolids_model->updateSampleVolume($id, $data);
            $this->session->set_flashdata('message', 'Delete Record Success');
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
        }
    
        redirect(site_url('campy_biosolids/read/'.$id_parent));
    }
    
    public function delete_detailCharcoal($id) {
        $row = $this->Campy_biosolids_model->get_by_id_charcoal($id);
        if ($row) {
            $id_parent = $row->id_result_charcoal; // Retrieve project_id before updating the record
            $data = array(
                'flag' => 1,
            );
    
            $this->Campy_biosolids_model->updateResultsCharcoal($id, $data);
            $this->Campy_biosolids_model->updateResultsGrowthPlate($id, $data);
            $this->session->set_flashdata('message', 'Delete Record Success');
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
        }
    
        redirect(site_url('campy_biosolids/read/'.$id_parent));
    }

    public function delete_detailHba($id) {
        $row = $this->Campy_biosolids_model->get_by_id_hba($id);
        if ($row) {
            $id_parent = $row->id_result_charcoal; // Retrieve project_id before updating the record
            $data = array(
                'flag' => 1,
            );
    
            $this->Campy_biosolids_model->updateResultsHba($id, $data);
            $this->Campy_biosolids_model->updateResultsGrowthPlateHba($id, $data);
            $this->session->set_flashdata('message', 'Delete Record Success');
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
        }
    
        redirect(site_url('campy_biosolids/read/'.$id_parent));
    }

    public function delete_detailBiochemical($id) {
        $row = $this->Campy_biosolids_model->get_by_id_biochemical($id);
        if ($row) {
            $id_parent = $row->id_result_charcoal; // Retrieve project_id before updating the record
            $data = array(
                'flag' => 1,
            );
    
            $this->Campy_biosolids_model->updateResultsBiochemical($id, $data);
            $this->session->set_flashdata('message', 'Delete Record Success');
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
        }
    
        redirect(site_url('campy_biosolids/read/'.$id_parent));
    }

    // public function delete_detail24($id) {
    //     $row = $this->Campy_biosolids_model->get_by_id_detail24($id);
    //     if ($row) {
    //         $id_parent = $row->id_moisture; // Retrieve project_id before updating the record
    //         $data = array(
    //             'flag' => 1,
    //         );
    
    //         $this->Campy_biosolids_model->update_det24($id, $data);
    //         $this->session->set_flashdata('message', 'Delete Record Success');
    //     } else {
    //         $this->session->set_flashdata('message', 'Record Not Found');
    //     }
    
    //     redirect(site_url('campy_biosolids/read/'.$id_parent));
    // }

    // public function delete_detail72($id) {
    //     $row = $this->Campy_biosolids_model->get_by_id_detail72($id);
    //     if ($row) {
    //         $id_parent = $row->id_moisture; // Retrieve project_id before updating the record
    //         $data = array(
    //             'flag' => 1,
    //         );
    
    //         $this->Campy_biosolids_model->update_det72($id, $data);
    //         $this->session->set_flashdata('message', 'Delete Record Success');
    //     } else {
    //         $this->session->set_flashdata('message', 'Record Not Found');
    //     }
    
    //     redirect(site_url('campy_biosolids/read/'.$id_parent));
    // }


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
    
    // public function excel($id) {
    //     $spreadsheet = new Spreadsheet();    
    //     $sheet = $spreadsheet->getActiveSheet();
    
    //     // Set the headers
    //     $sheet->setCellValue('A1', "ID One Water Sample");
    //     $sheet->setCellValue('B1', "Campy Assay Barcode");
    //     $sheet->setCellValue('C1', "Initial");
    //     $sheet->setCellValue('D1', "Sample Type");
    //     $sheet->setCellValue('E1', "Number of Tubes");
    //     $sheet->setCellValue('F1', "MPN PCR Conducted");
    //     $sheet->setCellValue('G1', "Date Sample Processed");
    //     $sheet->setCellValue('H1', "Time Sample Processed");
    //     $sheet->setCellValue('I1', "Sample Wet Weight");
    //     $sheet->setCellValue('J1', "Elution Volume");
    
    //     // Fetch the concentration data
    //     $finalConcentration = $this->Campy_biosolids_model->get_export($id);
    
    //     if (!empty($finalConcentration)) {
    //         // Initialize tube index for volumes
    //         $tubeIndex = 0;
    
    //         // Add Tube Volume headers
    //         foreach ($finalConcentration[0] as $key => $value) {
    //             if (strpos($key, 'Tube') === 0) {
    //                 $sheet->setCellValue(chr(75 + $tubeIndex) . '1', "$key Volume"); // Start from K (chr(75))
    //                 $tubeIndex++;
    //             }
    //         }
    
    //         // Add Tube Result headers
    //         $plate_numbers = explode(',', $finalConcentration[0]->plate_numbers);
    //         foreach ($plate_numbers as $plate_number) {
    //             $sheet->setCellValue(chr(75 + $tubeIndex) . '1', "Tube $plate_number Result");
    //             $tubeIndex++;
    //         }
    //     }
    
    //     // Start filling data from the second row
    //     $numrow = 2;
    //     foreach ($finalConcentration as $concentration) {
    //         // Basic information
    //         $sheet->setCellValue('A' . $numrow, $concentration->id_one_water_sample ?? '');
    //         $sheet->setCellValue('B' . $numrow, $concentration->campy_assay_barcode ?? '');
    //         $sheet->setCellValue('C' . $numrow, $concentration->initial ?? '');
    //         $sheet->setCellValue('D' . $numrow, $concentration->sampletype ?? '');
    //         $sheet->setCellValue('E' . $numrow, $concentration->number_of_tubes ?? '');
    //         $sheet->setCellValue('F' . $numrow, $concentration->mpn_pcr_conducted ?? '');
    //         $sheet->setCellValue('G' . $numrow, $concentration->date_sample_processed ?? '');
    //         $sheet->setCellValue('H' . $numrow, $concentration->time_sample_processed ?? '');
    //         $sheet->setCellValue('I' . $numrow, $concentration->sample_wetweight ?? '');
    //         $sheet->setCellValue('J' . $numrow, $concentration->elution_volume ?? '');

    //         // Fill tube volumes
    //         $tubeIndex = 0;
    //         foreach ($concentration as $key => $value) {
    //             if (strpos($key, 'Tube') === 0) {
    //                 $sheet->setCellValue(chr(75 + $tubeIndex) . $numrow, $value ?? ''); // Volume
    //                 $tubeIndex++;
    //             }
    //         }

    //         // Fill tube results
    //         $plate_numbers = explode(',', $concentration->plate_numbers);
    //         foreach ($plate_numbers as $plate_number) {
    //             // Set default value for confirmation
    //             $confirmation_value = isset($concentration->confirmation[$plate_number]) ? $concentration->confirmation[$plate_number] : 'No Growth'; 
    //             $sheet->setCellValue(chr(75 + $tubeIndex) . $numrow, $confirmation_value); // Result
    //             $tubeIndex++;
    //         }

    //         $numrow++;
    //     }

    
    //     // Set header for the Excel file
    //     header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    //     header('Content-Disposition: attachment;filename="Report_campy_biosolids.xlsx"');
    //     header('Cache-Control: max-age=0');
    
    //     // Output the Excel file
    //     $writer = new Xlsx($spreadsheet);
    //     $writer->save('php://output');
    // }

    // public function excel_all() {
    //     $spreadsheet = new Spreadsheet();
    //     $finalConcentration = $this->Campy_biosolids_model->get_all_export();
    //     $data1Tubes = [];
    //     $data5Tubes = [];
    //     $data11Tubes = [];
    
    //     foreach ($finalConcentration as $concentration) {
    //         if ($concentration->number_of_tubes == 5) {
    //             $data5Tubes[] = $concentration;
    //         } elseif ($concentration->number_of_tubes == 11) {
    //             $data11Tubes[] = $concentration;
    //         } elseif ($concentration->number_of_tubes == 1) {
    //             $data1Tubes[] = $concentration;
    //         }
    //     }
    
    //     $sheet1 = $spreadsheet->getActiveSheet();
    //     $sheet1->setTitle('5 Tubes');
    //     $this->setSheetHeaders($sheet1, $data5Tubes, 5);
    //     $this->fillSheetData($sheet1, $data5Tubes, 5);
    
    //     $sheet2 = $spreadsheet->createSheet();
    //     $sheet2->setTitle('11 Tubes');
    //     $this->setSheetHeaders($sheet2, $data11Tubes, 11);
    //     $this->fillSheetData($sheet2, $data11Tubes, 11);

    //     $sheet3 = $spreadsheet->createSheet();
    //     $sheet3->setTitle('1 Tube');
    //     $this->setSheetHeaders($sheet3, $data1Tubes, 1);
    //     $this->fillSheetData($sheet3, $data1Tubes, 1);
    
    //     header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    //     header('Content-Disposition: attachment;filename="Report_campy_biosolids.xlsx"');
    //     header('Cache-Control: max-age=0');
    
    //     ob_clean();
    //     flush();
    
    //     try {
    //         $writer = new Xlsx($spreadsheet);
    //         $writer->save('php://output');
    //     } catch (Exception $e) {
    //         echo 'Error generating file: ', $e->getMessage();
    //         return;
    //     }
    // }


    public function excel($id) {
        $spreadsheet = new Spreadsheet();    
        $sheet = $spreadsheet->getActiveSheet();
    
        // Set the headers
        $sheet->setCellValue('A1', "ID One Water Sample");
        $sheet->setCellValue('B1', "Campy Assay Barcode");
        $sheet->setCellValue('C1', "Initial");
        $sheet->setCellValue('D1', "Sample Type");
        $sheet->setCellValue('E1', "Number of Tubes");
        $sheet->setCellValue('F1', "MPN PCR Conducted");
        $sheet->setCellValue('G1', "Date Sample Processed");
        $sheet->setCellValue('H1', "Time Sample Processed");
        $sheet->setCellValue('I1', "Sample Wet Weight");
        $sheet->setCellValue('J1', "Elution Volume");
    
        // Fetch the concentration data
        $finalConcentration = $this->Campy_biosolids_model->get_export($id);
    
        if (!empty($finalConcentration)) {
            // Initialize tube index for volumes
            $tubeIndex = 0;
    
            // Add Tube Volume headers
            foreach ($finalConcentration[0] as $key => $value) {
                if (strpos($key, 'Tube') === 0) {
                    $columnLetter = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex(11 + $tubeIndex);
                    $sheet->setCellValue($columnLetter . '1', "$key Volume");
                    $tubeIndex++;
                }
            }
    
            // Add Tube Result headers
            $plate_numbers = explode(',', $finalConcentration[0]->plate_numbers);
            foreach ($plate_numbers as $plate_number) {
                $columnLetter = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex(11 + $tubeIndex);
                $sheet->setCellValue($columnLetter . '1', "Tube $plate_number Result");
                $tubeIndex++;
            }
        }
    
        // Start filling data from the second row
        $numrow = 2;
        foreach ($finalConcentration as $concentration) {
            // Basic information
            $sheet->setCellValue('A' . $numrow, $concentration->id_one_water_sample ?? '');
            $sheet->setCellValue('B' . $numrow, $concentration->campy_assay_barcode ?? '');
            $sheet->setCellValue('C' . $numrow, $concentration->initial ?? '');
            $sheet->setCellValue('D' . $numrow, $concentration->sampletype ?? '');
            $sheet->setCellValue('E' . $numrow, $concentration->number_of_tubes ?? '');
            $sheet->setCellValue('F' . $numrow, $concentration->mpn_pcr_conducted ?? '');
            $sheet->setCellValue('G' . $numrow, $concentration->date_sample_processed ?? '');
            $sheet->setCellValue('H' . $numrow, $concentration->time_sample_processed ?? '');
            $sheet->setCellValue('I' . $numrow, $concentration->sample_wetweight ?? '');
            $sheet->setCellValue('J' . $numrow, $concentration->elution_volume ?? '');
    
            // Fill tube volumes
            $tubeIndex = 0;
            foreach ($concentration as $key => $value) {
                if (strpos($key, 'Tube') === 0) {
                    $columnLetter = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex(11 + $tubeIndex);
                    $sheet->setCellValue($columnLetter . $numrow, $value ?? '');
                    $tubeIndex++;
                }
            }
    
            // Fill tube results
            $plate_numbers = explode(',', $concentration->plate_numbers);
            foreach ($plate_numbers as $plate_number) {
                // Set default value for confirmation
                $confirmation_value = isset($concentration->confirmation[$plate_number]) ? $concentration->confirmation[$plate_number] : 'No Growth'; 
                
                // Calculate the column letter dynamically
                $columnLetter = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex(11 + $tubeIndex);
                $sheet->setCellValue($columnLetter . $numrow, $confirmation_value);
                $tubeIndex++;
            }
    
            $numrow++;
        }
    
        // Set header for the Excel file
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="Report_Biosolids_Final_Concentrations.xlsx"');
        header('Cache-Control: max-age=0');
    
        // Output the Excel file
        $writer = new Xlsx($spreadsheet);
        $writer->save('php://output');
    }

    public function excel_all() {
        $spreadsheet = new Spreadsheet();
        $finalConcentration = $this->Campy_biosolids_model->get_all_export();
        // var_dump($finalConcentration);
        // die();
        // Array untuk menyimpan data berdasarkan jumlah tabung
        $dataTubes = [];
    
        // Mengelompokkan data berdasarkan number_of_tubes
        foreach ($finalConcentration as $concentration) {
            $numberOfTubes = $concentration->number_of_tubes;
            if (!isset($dataTubes[$numberOfTubes])) {
                $dataTubes[$numberOfTubes] = []; // Inisialisasi array untuk jumlah tabung ini
            }
            $dataTubes[$numberOfTubes][] = $concentration; // Tambahkan data ke array
        }
    
        // Buat sheet untuk setiap jumlah tabung yang ada
        foreach ($dataTubes as $numberOfTubes => $data) {
            $sheet = $spreadsheet->createSheet();
            $sheet->setTitle("{$numberOfTubes} Tubes");
            $this->setSheetHeaders($sheet, $data, $numberOfTubes);
            $this->fillSheetData($sheet, $data, $numberOfTubes);
        }
    
        // Set header untuk file Excel
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="Report_All_Biosolids_Final_Concentrations.xlsx"');
        header('Cache-Control: max-age=0');
    
        ob_clean();
        flush();
    
        try {
            $writer = new Xlsx($spreadsheet);
            $writer->save('php://output');
        } catch (Exception $e) {
            echo 'Error generating file: ', $e->getMessage();
            return;
        }
    }
    
    
    private function setSheetHeaders($sheet, $data, $numberOfTubes) {
        // Set the headers
        $sheet->setCellValue('A1', "ID One Water Sample");
        $sheet->setCellValue('B1', "Campy Assay Barcode");
        $sheet->setCellValue('C1', "Initial");
        $sheet->setCellValue('D1', "Sample Type");
        $sheet->setCellValue('E1', "Number of Tubes");
        $sheet->setCellValue('F1', "MPN PCR Conducted");
        $sheet->setCellValue('G1', "Date Sample Processed");
        $sheet->setCellValue('H1', "Time Sample Processed");
        $sheet->setCellValue('I1', "Sample Wet Weight");
        $sheet->setCellValue('J1', "Elution Volume");
    
        // Add Tube Volume headers
        for ($i = 1; $i <= $numberOfTubes; $i++) {
            $columnLetter = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex(10 + $i);
            $sheet->setCellValue($columnLetter . '1', "Tube $i Volume");
        }
    
        // Add Tube Result headers
        for ($i = 1; $i <= $numberOfTubes; $i++) {
            $columnLetter = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex(10 + $numberOfTubes + $i);
            $sheet->setCellValue($columnLetter . '1', "Tube $i Result");
        }
    }
    
    private function fillSheetData($sheet, $data, $numberOfTubes) {
        // Mulai mengisi data dari baris kedua
        $numrow = 2;
        foreach ($data as $concentration) {
            // Informasi dasar
            $sheet->setCellValue('A' . $numrow, $concentration->id_one_water_sample ?? '');
            $sheet->setCellValue('B' . $numrow, $concentration->campy_assay_barcode ?? '');
            $sheet->setCellValue('C' . $numrow, $concentration->initial ?? '');
            $sheet->setCellValue('D' . $numrow, $concentration->sampletype ?? '');
            $sheet->setCellValue('E' . $numrow, $concentration->number_of_tubes ?? '');
            $sheet->setCellValue('F' . $numrow, $concentration->mpn_pcr_conducted ?? '');
            $sheet->setCellValue('G' . $numrow, $concentration->date_sample_processed ?? '');
            $sheet->setCellValue('H' . $numrow, $concentration->time_sample_processed ?? '');
            $sheet->setCellValue('I' . $numrow, $concentration->sample_wetweight ?? '');
            $sheet->setCellValue('J' . $numrow, $concentration->elution_volume ?? '');
    
            // Mengisi volume tabung
            $tubeIndex = 0;
            foreach ($concentration as $key => $value) {
                if (strpos($key, 'Tube') === 0) {
                    $columnLetter = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex(11 + $tubeIndex);
                    $sheet->setCellValue($columnLetter . $numrow, $value ?? '');
                    $tubeIndex++;
                }
            }
    
        // Mengisi hasil tabung
        for ($i = 1; $i <= $numberOfTubes; $i++) {
            $columnLetter = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex(11 + $numberOfTubes + ($i - 1));

            // Mengakses nilai konfirmasi dengan indeks tabung
            $confirmation_value = $concentration->confirmation[$i] ?? 'No Growth'; // Nilai default jika tidak ada konfirmasi
            
            // Debugging: Cek nilai konfirmasi sebelum diset ke sel
            error_log("Confirmation for Tube {$i}: " . $confirmation_value);
            $sheet->setCellValue($columnLetter . $numrow, $confirmation_value);
        }
    
            $numrow++;
        }
    }

    public function validateCampyAssayBarcode() {
        $id = $this->input->get('id');
        $data = $this->Campy_biosolids_model->validateCampyAssayBarcode($id);
        header('Content-Type: application/json');
        echo json_encode($data);
    }

    public function barcode_restrict() 
    {
        $id = $this->input->get('id1');
        $data = $this->Campy_biosolids_model->barcode_restrict($id);
        header('Content-Type: application/json');
        echo json_encode($data);
    }

    public function saveReview() {
        header('Content-Type: application/json');
    
        $id = $this->input->post('id_one_water_sample', true);
        $review = $this->input->post('review', true);
        $user_review = $this->input->post('user_review', true);
    
        if (!$id || $review === null || !$user_review) {
            echo json_encode([
                'status' => false,
                'message' => 'Missing required fields.'
            ]);
            return;
        }
    
        $data = [
            'review' => $review,
            'user_review' => $user_review,
            'user_updated' => $this->session->userdata('id_users'),
            'date_updated' => date('Y-m-d H:i:s')
        ];
    
        $this->load->model('Campy_biosolids_model');
    
        try {
            $this->Campy_biosolids_model->update_campy_biosolids($id, $data);
            echo json_encode([
                'status' => true,
                'message' => 'Review saved successfully.'
            ]);
        } catch (Exception $e) {
            echo json_encode([
                'status' => false,
                'message' => 'Error saving review: ' . $e->getMessage()
            ]);
        }
    }

    public function cancelReview() {
        header('Content-Type: application/json');
    
        // Ambil data POST
        $id = $this->input->post('id_one_water_sample', true);
        $review = $this->input->post('review', true);
        $user_review = $this->input->post('user_review', true);
    
        // Debug log untuk memastikan data yang diterima
        log_message('debug', "Received data: id=$id, review=$review, user_review=$user_review");
    
        // Cek jika data yang dibutuhkan ada
        if (!$id || $review === null) {
            echo json_encode([
                'status' => false,
                'message' => 'Missing required fields.'
            ]);
            return;
        }
    
        // Data yang akan diperbarui jika review dibatalkan
        $data = [
            'review' => 0,  // Reset status review
            'user_review' => '', // Kosongkan user review
            'user_updated' => $this->session->userdata('id_users'),
            'date_updated' => date('Y-m-d H:i:s')
        ];

        // Load model dan update data review di database
        $this->load->model('Campy_biosolids_model');
        $updateResult = $this->Campy_biosolids_model->updateCancel($id, $data);
    
        // Debug log untuk memeriksa hasil update
        log_message('debug', "Update result: " . ($updateResult ? 'Success' : 'Failure'));
    
        // Cek apakah update berhasil
        if ($updateResult) {
            echo json_encode([
                'status' => true,
                'message' => 'Review canceled successfully.'
            ]);
        } else {
            echo json_encode([
                'status' => false,
                'message' => 'Failed to cancel review.'
            ]);
        }
    }

}

/* End of file Water_sample_reception.php */
/* Location: ./application/controllers/Water_sample_reception.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2022-12-14 03:38:42 */
/* http://harviacode.com */