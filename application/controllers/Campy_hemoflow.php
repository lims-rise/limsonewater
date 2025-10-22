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
    
class Campy_hemoflow extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        is_login();
        $this->load->model('Campy_hemoflow_model');
        $this->load->library('form_validation');        
	    $this->load->library('datatables');
	    $this->load->library('uuid');
    }

    public function index()
    {
        // Redirect ke halaman under construction untuk sementara
        $this->load->view('underconstruction/underconstruction');
    }
    public function development_index()
    {
        $data['id_one'] = $this->Campy_hemoflow_model->getID_one();
        $data['sampletype'] = $this->Campy_hemoflow_model->getSampleType();
        $data['labtech'] = $this->Campy_hemoflow_model->getLabTech();
        $data['tubes'] = $this->Campy_hemoflow_model->getTubes();
        // var_dump($data['id_one']);
        // die();
        // $data['id_project'] = $this->Moisture_content_model->generate_project_id();
        // $data['client'] = $this->Moisture_content_model->generate_client();
        // $data['id_one_water_sample'] = $this->Moisture_content_model->generate_one_water_sample_id();
        $this->template->load('template','campy_hemoflow/index', $data);
    } 
    
    public function json() {
        header('Content-Type: application/json');
        echo $this->Campy_hemoflow_model->json();
    }

    public function subjsonCharcoal() {
        $id = $this->input->get('idCharcoal',TRUE);
        header('Content-Type: application/json');
        echo $this->Campy_hemoflow_model->subjsonCharcoal($id);
    }

    public function subjsonHba() {
        $id = $this->input->get('idHba',TRUE);
        header('Content-Type: application/json');
        echo $this->Campy_hemoflow_model->subjsonHba($id);
    }

    public function subjsonBiochemical() {
        $id = $this->input->get('idBiochemical',TRUE);
        $biochemical_tube = $this->input->get('biochemical_tube', TRUE);
        header('Content-Type: application/json');
        echo $this->Campy_hemoflow_model->subjsonBiochemical($id, $biochemical_tube);
    }

    public function read($id)
    {
        $row = $this->Campy_hemoflow_model->get_detail($id);

        if ($row) {
            $data = array(
                'id_campy_hemoflow' => $row->id_campy_hemoflow,
                'id_one_water_sample' => $row->id_one_water_sample,
                'initial' => $row->initial,
                'sampletype' => $row->sampletype,
                'number_of_tubes' => $row->number_of_tubes,
                'mpn_pcr_conducted' => $row->mpn_pcr_conducted,
                'campy_assay_barcode' => $row->campy_assay_barcode,
                'date_sample_processed' => $row->date_sample_processed,
                'time_sample_processed' => $row->time_sample_processed,
                'sample_wetweight' => $row->sample_wetweight,
                'dry_weight_persen' => $row->dry_weight_persen,
                'sample_dryweight' => $row->sample_dryweight,
                'sample_dryweight_old' => $row->sample_dryweight_old,
                'elution_volume' => $row->elution_volume,
                'vol_sampletube' => $row->vol_sampletube,
                'tube_number' => $row->tube_number,
                'full_name' => $row->full_name,
                'user_review' => $row->user_review,
                'review' => $row->review,
                'user_created' => $row->user_created,
            );

            // Mendapatkan final concentration dengan id_campy_hemoflow
            $finalConcentration = $this->Campy_hemoflow_model->subjsonFinalConcentration($row->id_campy_hemoflow);
            if ($finalConcentration) {
                $data['finalConcentration'] = $finalConcentration;
            } else {
                $data['finalConcentration'] = [];
            }
            // var_dump($data);
            // die();
            $this->template->load('template','campy_hemoflow/index_det', $data);

        }
        else {
            // $this->template->load('template','Water_sample_reception/index_det', $test);
        }
    }

    public function read2($id)
    {
        $data['test'] = $this->Campy_hemoflow_model->getTest();
        $row = $this->Campy_hemoflow_model->get_detail2($id);
        if ($row) {
            $data = array(
                'id_project' => $row->id_project,
                'id_sample' => $row->id_sample,
                'sample_description' => $row->sample_description,
                'test' => $this->Campy_hemoflow_model->getTest(),
                );
                $this->template->load('template','campy_hemoflow/index_det2', $data);
        }
        else {
            // $this->template->load('template','Water_sample_reception/index_det');
        }
    }     


    public function save() {
        $mode = $this->input->post('mode', TRUE);
        $id_campy_hemoflow = $this->input->post('id_campy_hemoflow', TRUE);
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
        $dry_weight_persen = $this->input->post('dry_weight_persen', TRUE);
        $sample_dryweight = $this->input->post('sample_dryweight', TRUE);

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
                'dry_weight_persen' => $dry_weight_persen,
                'sample_dryweight' => $sample_dryweight,
                'sample_dryweight_old' => $sample_dryweight,
                'elution_volume' => $elution_volume,
                'flag' => '0',
                'lab' => $this->session->userdata('lab'),
                'uuid' => $this->uuid->v4(),
                'user_created' => $this->session->userdata('id_users'),
                'date_created' => $dt->format('Y-m-d H:i:s'),
            );

            $assay_id = $this->Campy_hemoflow_model->insert($data);

            // Insert sample volumes
            $number_of_tubes = $this->input->post('number_of_tubes', TRUE);
            for ($i = 1; $i <= $number_of_tubes; $i++) {
                $volume = $this->input->post("vol_sampletube{$i}", TRUE);
                if ($volume) {
                    $this->Campy_hemoflow_model->insert_sample_volume(array(
                        'id_campy_hemoflow' => $assay_id,
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
                'dry_weight_persen' => $dry_weight_persen,
                'sample_dryweight' => $sample_dryweight,
                'elution_volume' => $elution_volume,
                'flag' => '0',
                'lab' => $this->session->userdata('lab'),
                'uuid' => $this->uuid->v4(),
                'user_updated' => $this->session->userdata('id_users'),
                'date_updated' => $dt->format('Y-m-d H:i:s'),
            );

            // var_dump($data);
            // die();

            $this->Campy_hemoflow_model->updateCampyHemoflow($id_campy_hemoflow, $data);

            // // Update sample volumes
            // $number_of_tubes = $this->input->post('number_of_tubes', TRUE);
            // $this->Campy_hemoflow_model->delete_sample_volumes($id_moisture); // Hapus volume yang ada
    
            // for ($i = 1; $i <= $number_of_tubes; $i++) {
            //     $volume = $this->input->post("vol_sampletube{$i}", TRUE);
            //     var_dump($volume);
            //     if ($volume) {
            //         $this->Campy_hemoflow_model->insert_sample_volume(array(
            //             'id_campy_hemoflow' => $assay_id,
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
            $this->Campy_hemoflow_model->delete_sample_volumes($id_campy_hemoflow); // Hapus volume yang ada

            for ($i = 1; $i <= $number_of_tubes; $i++) {
                $volume = $this->input->post("vol_sampletube{$i}", TRUE);
                // var_dump($volume); // var dump volume pada setiap tube

                if ($volume) {
                    $data_volume = array(
                        'id_campy_hemoflow' => $id_campy_hemoflow,
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
                    $this->Campy_hemoflow_model->insert_sample_volume($data_volume);
                }
            }
    
            $this->session->set_flashdata('message', 'Update Record Success');
        }
    
        redirect(site_url("campy_hemoflow"));
    }

    public function saveResultsCharcoal() {
        $mode = $this->input->post('mode_detResultsCharcoal', TRUE);
        $id_one_water_sample = $this->input->post('idCharcoal_one_water_sample', TRUE);
        $id_campy_hemoflow = $this->input->post('id_campy_hemoflow1', TRUE);
        $id_result_charcoal = $this->input->post('id_result_charcoal', TRUE);
        $dt = new DateTime();
        $date_sample_processed = $this->input->post('date_sample_processed1', TRUE);
        $time_sample_processed = $this->input->post('time_sample_processed1', TRUE);
        $quality_control = $this->input->post('quality_control', TRUE) ? 1 : 0; // Convert checkbox to integer
    
        if ($mode == "insert") {
            // Insert data into assays table
            $data = array(
                'id_campy_hemoflow' => $id_campy_hemoflow,
                'date_sample_processed' => $date_sample_processed,
                'time_sample_processed' => $time_sample_processed,
                'quality_control' => $quality_control,
                'flag' => '0',
                'lab' => $this->session->userdata('lab'),
                'uuid' => $this->uuid->v4(),
                'user_created' => $this->session->userdata('id_users'),
                'date_created' => $dt->format('Y-m-d H:i:s'),
            );

            // var_dump($data);
            // die();
    
            $assay_id = $this->Campy_hemoflow_model->insertResultsCharcoal($data);
    
            // Insert sample volumes and check if all growth plates are 0
            $number_of_tubes = $this->input->post('number_of_tubes1', TRUE);
            $all_plates_zero = true;
            $growth_plate_data = array();
            
            for ($i = 1; $i <= $number_of_tubes; $i++) {
                $plate = $this->input->post("growth_plate{$i}", TRUE);
                if ($plate !== null) {
                    $growth_plate_data[$i] = $plate;
                    
                    // Check if this plate is not zero
                    if ($plate != '0') {
                        $all_plates_zero = false;
                    }
                    
                    $this->Campy_hemoflow_model->insert_growth_plate(array(
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
            
            // Auto-generate HBA results if all growth plates are 0
            if ($all_plates_zero && count($growth_plate_data) > 0) {
                try {
                    $hba_result = $this->autoGenerateHBAResults($id_campy_hemoflow, $assay_id, $date_sample_processed, $time_sample_processed, $growth_plate_data, $dt);
                    if ($hba_result) {
                        $this->session->set_flashdata('message', 'Create Record Success - HBA Results auto-generated');
                    } else {
                        $this->session->set_flashdata('message', 'Create Record Success - Note: HBA auto-generation failed, please create manually');
                    }
                } catch (Exception $e) {
                    log_message('error', 'HBA auto-generation failed: ' . $e->getMessage());
                    $this->session->set_flashdata('message', 'Create Record Success - Note: HBA auto-generation failed, please create manually');
                }
            } else {
                $this->session->set_flashdata('message', 'Create Record Success');
            }
    
        } else if ($mode == "edit") {
            // Update data in assays table
            $data = array(
                'id_campy_hemoflow' => $id_campy_hemoflow,
                'date_sample_processed' => $date_sample_processed,
                'time_sample_processed' => $time_sample_processed,
                'quality_control' => $quality_control,
                'flag' => '0',
                'lab' => $this->session->userdata('lab'),
                'uuid' => $this->uuid->v4(),
                'user_updated' => $this->session->userdata('id_users'),
                'date_updated' => $dt->format('Y-m-d H:i:s'),
            );

            // var_dump($data);
            // die();
    
            $this->Campy_hemoflow_model->updateResultsCharcoal($id_result_charcoal, $data);

            // Update sample volumes and check if all growth plates are 0
            $number_of_tubes = $this->input->post('number_of_tubes1', TRUE);
            $this->Campy_hemoflow_model->delete_growth_plates($id_result_charcoal); // Hapus volume yang ada

            $all_plates_zero = true;
            $growth_plate_data = array();
            
            for ($i = 1; $i <= $number_of_tubes; $i++) {
                $plate = $this->input->post("growth_plate{$i}", TRUE);
                if ($plate !== null) {
                    $growth_plate_data[$i] = $plate;
                    
                    // Check if this plate is not zero
                    if ($plate != '0') {
                        $all_plates_zero = false;
                    }
                    
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
                    $this->Campy_hemoflow_model->insert_growth_plate($data_plate);
                }
            }
            
            // Auto-generate or update HBA results if all growth plates are 0
            if ($all_plates_zero && count($growth_plate_data) > 0) {
                // Check if HBA data already exists for this charcoal result
                $existing_hba = $this->Campy_hemoflow_model->get_hba_by_campy_hemoflow($id_campy_hemoflow);
                
                if (!$existing_hba) {
                    try {
                        // Auto-generate new HBA results
                        $hba_result = $this->autoGenerateHBAResults($id_campy_hemoflow, $id_result_charcoal, $date_sample_processed, $time_sample_processed, $growth_plate_data, $dt);
                        if ($hba_result) {
                            $this->session->set_flashdata('message', 'Update Record Success - HBA Results auto-generated');
                        } else {
                            $this->session->set_flashdata('message', 'Update Record Success - Note: HBA auto-generation failed, please create manually');
                        }
                    } catch (Exception $e) {
                        log_message('error', 'HBA auto-generation failed in edit mode: ' . $e->getMessage());
                        $this->session->set_flashdata('message', 'Update Record Success - Note: HBA auto-generation failed, please create manually');
                    }
                } else {
                    $this->session->set_flashdata('message', 'Update Record Success');
                }
            } else {
                $this->session->set_flashdata('message', 'Update Record Success');
            }
        }

        redirect(site_url("campy_hemoflow/read/" . $id_one_water_sample));
    }

    /**
     * Auto-generate HBA results when all growth plates in Charcoal are 0
     * This improves efficiency by eliminating the need for manual HBA data entry
     * when the outcome is predictable (all zeros)
     */
    private function autoGenerateHBAResults($id_campy_hemoflow, $id_result_charcoal, $date_sample_processed, $time_sample_processed, $growth_plate_data, $dt) {
        try {
            // Insert HBA result with same basic data as Charcoal (without campy_assay_barcode)
            $hba_data = array(
                'id_campy_hemoflow' => $id_campy_hemoflow,
                'date_sample_processed' => $date_sample_processed,
                'time_sample_processed' => $time_sample_processed,
                'flag' => '0',
                'lab' => $this->session->userdata('lab'),
                'uuid' => $this->uuid->v4(),
                'user_created' => $this->session->userdata('id_users'),
                'date_created' => $dt->format('Y-m-d H:i:s'),
            );
            
            $hba_assay_id = $this->Campy_hemoflow_model->insertResultsHba($hba_data);
            
            // Insert HBA growth plates (all will be 0 since Charcoal was all 0)
            foreach ($growth_plate_data as $plate_number => $plate_value) {
                $hba_plate_data = array(
                    'id_result_hba' => $hba_assay_id,
                    'plate_number' => $plate_number,
                    'growth_plate' => '0', // Always 0 when auto-generated
                    'flag' => '0',
                    'lab' => $this->session->userdata('lab'),
                    'uuid' => $this->uuid->v4(),
                    'user_created' => $this->session->userdata('id_users'),
                    'date_created' => $dt->format('Y-m-d H:i:s'),
                );
                $this->Campy_hemoflow_model->insert_growth_plate_hba($hba_plate_data);
            }
            
            // Log the auto-generation for audit purposes
            log_message('info', "Auto-generated HBA results for Campy Hemoflow ID: {$id_campy_hemoflow}");
            
            return $hba_assay_id;
            
        } catch (Exception $e) {
            // Log error but don't break the main process
            log_message('error', "Failed to auto-generate HBA results: " . $e->getMessage());
            throw $e; // Re-throw to be caught by calling method
        }
    }

    public function saveResultsHBA() {
        $mode = $this->input->post('mode_detResultsHBA', TRUE);
        $id_one_water_sample = $this->input->post('idHba_one_water_sample', TRUE);
        $id_campy_hemoflow = $this->input->post('id_campy_hemoflowHBA', TRUE);
        $id_result_hba = $this->input->post('id_result_hba', TRUE);

        $dt = new DateTime();
        $date_sample_processed = $this->input->post('date_sample_processedHBA', TRUE);
        $time_sample_processed = $this->input->post('time_sample_processedHBA', TRUE);
        $quality_control = $this->input->post('quality_control_hba', TRUE) ? 1 : 0; // Convert checkbox to integer
    
        if ($mode == "insert") {
            // Insert data into assays table
            $data = array(
                'id_campy_hemoflow' => $id_campy_hemoflow,
                'date_sample_processed' => $date_sample_processed,
                'time_sample_processed' => $time_sample_processed,
                'quality_control' => $quality_control,
                'flag' => '0',
                'lab' => $this->session->userdata('lab'),
                'uuid' => $this->uuid->v4(),
                'user_created' => $this->session->userdata('id_users'),
                'date_created' => $dt->format('Y-m-d H:i:s'),
            );

            // var_dump($data);
            // die();
    
            $assay_id = $this->Campy_hemoflow_model->insertResultsHba($data);
    
            // Insert sample volumes
            $number_of_tubes = $this->input->post('number_of_tubesHba', TRUE);
            for ($i = 1; $i <= $number_of_tubes; $i++) {
                $plate = $this->input->post("growth_plate{$i}", TRUE);

                if ($plate !== null) {
                    $this->Campy_hemoflow_model->insert_growth_plate_hba(array(
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
                'id_campy_hemoflow' => $id_campy_hemoflow,
                'date_sample_processed' => $date_sample_processed,
                'time_sample_processed' => $time_sample_processed,
                'quality_control' => $quality_control,
                'flag' => '0',
                'lab' => $this->session->userdata('lab'),
                'uuid' => $this->uuid->v4(),
                'user_updated' => $this->session->userdata('id_users'),
                'date_updated' => $dt->format('Y-m-d H:i:s'),
            );
    
            $this->Campy_hemoflow_model->updateResultsHba($id_result_hba, $data);
    
            // Update sample volumes
            $number_of_tubes = $this->input->post('number_of_tubesHba', TRUE);
            $this->Campy_hemoflow_model->delete_growth_plates_hba($id_result_hba); // Hapus volume yang ada
    
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
                    $this->Campy_hemoflow_model->insert_growth_plate_hba($data_plate);
                }
            }
    
            $this->session->set_flashdata('message', 'Update Record Success');
        }

        redirect(site_url("campy_hemoflow/read/" . $id_one_water_sample));
    }


    public function saveBiochemical() {
        $mode = $this->input->post('mode_detResultsBiochemical', TRUE);
        $id_result_biochemical = $this->input->post('id_result_biochemical', TRUE);
        $id_result_hba = $this->input->post('id_result_hba1', TRUE);
        $id_campy_hemoflow = $this->input->post('id_campy_hemoflowBiochemical', TRUE);
        $gramlysis = $this->input->post('gramlysis', TRUE);
        $oxidase = $this->input->post('oxidase', TRUE);
        $catalase = $this->input->post('catalase', TRUE);
        $confirmation = $this->input->post('confirmation', TRUE);
        $sample_store = $this->input->post('sample_store', TRUE);
        $biochemical_tube = $this->input->post('biochemical_tube', TRUE);
        $id_one_water_sample = $this->input->post('idBiochemical_one_water_sample', TRUE);
    
        // Defaukt value if the attribute is null
        if ($gramlysis === null) $gramlysis = '-';
        if ($oxidase === null) $oxidase = '-';
        if ($catalase === null) $catalase = '-';
    
        if ($mode == "insert") {
            $data = array(
                'id_campy_hemoflow' => $id_campy_hemoflow,
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
            $this->Campy_hemoflow_model->insertResultsBiochemical($data);
        } else if ($mode == "edit") {
            $data = array(
                'id_campy_hemoflow' => $id_campy_hemoflow,
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
            $this->Campy_hemoflow_model->updateResultsBiochemical($id_result_biochemical, $data);
        }

        redirect(site_url("campy_hemoflow/read/" . $id_one_water_sample));
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
        
    //             $insert_id = $this->Campy_hemoflow_model->insert_det24($data);
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
    //             $result = $this->Campy_hemoflow_model->update_det24($id_moisture24, $data);
    //             if ($result) {
    //                 $this->session->set_flashdata('message', 'Update Record Success');
    //             } else {
    //                 $this->session->set_flashdata('error', 'Failed to update record');
    //             }
    //         }

    //         redirect(site_url("campy_hemoflow/read/" . $id_moisture));
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
    
    //         $insert_id = $this->Campy_hemoflow_model->insert_det72($data);
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
    //         $result = $this->Campy_hemoflow_model->update_det72($id_moisture72, $data);
    //         if ($result) {
    //             $this->session->set_flashdata('message', 'Update Record Success');
    //         } else {
    //             $this->session->set_flashdata('error', 'Failed to update record');
    //         }
    //     }

    //     redirect(site_url("campy_hemoflow/read/" . $id_moisture));

    // }
  

    // public function delete($id) {
    //     $row = $this->Campy_hemoflow_model->get_by_id($id);
    //     $data = array(
    //         'flag' => 1,
    //         );

    //     if ($row) {
    //         $this->Campy_hemoflow_model->update($id, $data);
    //         $this->session->set_flashdata('message', 'Delete Record Success');
    //         redirect(site_url('campy_hemoflow'));
    //     } else {
    //         $this->session->set_flashdata('message', 'Record Not Found');
    //         redirect(site_url('campy_hemoflow'));
    //     }
    // }


    public function delete_campyBiosolids($id) {
        $row = $this->Campy_hemoflow_model->get_by_id_campybiosolids($id);
        if ($row) {
            $id_parent = $row->id_result_charcoal; // Retrieve project_id before updating the record
            $data = array(
                'flag' => 1,
            );
    
            $this->Campy_hemoflow_model->updateCampyBiosolids($id, $data);
            $this->Campy_hemoflow_model->updateSampleVolume($id, $data);
            $this->session->set_flashdata('message', 'Delete Record Success');
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
        }

        redirect(site_url('campy_hemoflow/read/'.$id_parent));
    }
    
    public function delete_detailCharcoal($id) {
        $row = $this->Campy_hemoflow_model->get_by_id_charcoal($id);
        if ($row) {
            $id_campy_hemoflow = $row->id_campy_hemoflow;
            $data = array(
                'flag' => 1,
            );

            // Step 1: Get all HBA results related to this campy_hemoflow
            $hba_results = $this->Campy_hemoflow_model->get_hba_by_charcoal_id($id_campy_hemoflow);
            $total_biochemical_deleted = 0;
            $total_hba_deleted = 0;

            // Step 2: For each HBA, delete related biochemical results
            foreach ($hba_results as $hba) {
                $biochemical_results = $this->Campy_hemoflow_model->get_biochemical_by_hba_id($hba->id_result_hba);
                $biochemical_count = count($biochemical_results);
                
                if ($biochemical_count > 0) {
                    $this->Campy_hemoflow_model->delete_biochemical_by_hba_id($hba->id_result_hba);
                    $total_biochemical_deleted += $biochemical_count;
                    
                    // Log the cascade delete
                    log_message('info', "Cascade delete: Deleted {$biochemical_count} biochemical results for HBA ID {$hba->id_result_hba}");
                }
                
                $total_hba_deleted++;
            }

            // Step 3: Delete all HBA results for this campy_hemoflow
            if ($total_hba_deleted > 0) {
                $this->Campy_hemoflow_model->delete_hba_by_campy_hemoflow($id_campy_hemoflow);
                log_message('info', "Cascade delete: Deleted {$total_hba_deleted} HBA results for campy_hemoflow ID {$id_campy_hemoflow}");
            }

            // Step 4: Delete the charcoal results
            $this->Campy_hemoflow_model->updateResultsCharcoal($id, $data);
            $this->Campy_hemoflow_model->updateResultsGrowthPlate($id, $data);
            
            // Create detailed success message
            $message = 'Charcoal result deleted successfully';
            if ($total_hba_deleted > 0) {
                $message .= " (Also deleted {$total_hba_deleted} HBA result(s)";
                if ($total_biochemical_deleted > 0) {
                    $message .= " and {$total_biochemical_deleted} biochemical result(s)";
                }
                $message .= ')';
            }
            
            $this->session->set_flashdata('message', $message);
            log_message('info', "Cascade delete completed: Charcoal ID {$id} - {$message}");
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
        }

        redirect(site_url('campy_hemoflow/read/'.$row->id_campy_hemoflow));
    }

    public function delete_detailHba($id) {
        $row = $this->Campy_hemoflow_model->get_by_id_hba($id);
        if ($row) {
            $id_parent = $row->id_result_charcoal; // Retrieve project_id before updating the record
            $data = array(
                'flag' => 1,
            );
    
            // First, check if there are any biochemical results related to this HBA
            $biochemical_results = $this->Campy_hemoflow_model->get_biochemical_by_hba_id($id);
            $biochemical_count = count($biochemical_results);
            
            // Delete HBA results (growth plates and main record)
            $this->Campy_hemoflow_model->updateResultsHba($id, $data);
            $this->Campy_hemoflow_model->updateResultsGrowthPlateHba($id, $data);
            
            // Cascade delete: Delete all related biochemical results
            if ($biochemical_count > 0) {
                $biochemical_deleted = $this->Campy_hemoflow_model->delete_biochemical_by_hba_id($id);
                if ($biochemical_deleted) {
                    $this->session->set_flashdata('message', 
                        "Delete Record Success - HBA and {$biochemical_count} related Biochemical test(s) deleted to maintain data integrity");
                } else {
                    $this->session->set_flashdata('message', 
                        'HBA deleted successfully, but failed to delete related Biochemical tests. Please check data consistency.');
                }
            } else {
                $this->session->set_flashdata('message', 'Delete Record Success');
            }
            
            // Log the cascade delete for audit purposes
            log_message('info', "HBA Record deleted (ID: {$id}) with cascade delete of {$biochemical_count} biochemical records");
            
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
        }

        redirect(site_url('campy_hemoflow/read/'.$id_parent));
    }

    public function delete_detailBiochemical($id) {
        $row = $this->Campy_hemoflow_model->get_by_id_biochemical($id);
        if ($row) {
            $id_parent = $row->id_result_charcoal; // Retrieve project_id before updating the record
            $data = array(
                'flag' => 1,
            );
    
            $this->Campy_hemoflow_model->updateResultsBiochemical($id, $data);
            $this->session->set_flashdata('message', 'Delete Record Success');
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
        }

        redirect(site_url('campy_hemoflow/read/'.$id_parent));
    }

    // public function delete_detail24($id) {
    //     $row = $this->Campy_hemoflow_model->get_by_id_detail24($id);
    //     if ($row) {
    //         $id_parent = $row->id_moisture; // Retrieve project_id before updating the record
    //         $data = array(
    //             'flag' => 1,
    //         );
    
    //         $this->Campy_hemoflow_model->update_det24($id, $data);
    //         $this->session->set_flashdata('message', 'Delete Record Success');
    //     } else {
    //         $this->session->set_flashdata('message', 'Record Not Found');
    //     }

    //     redirect(site_url('campy_hemoflow/read/'.$id_parent));
    // }

    // public function delete_detail72($id) {
    //     $row = $this->Campy_hemoflow_model->get_by_id_detail72($id);
    //     if ($row) {
    //         $id_parent = $row->id_moisture; // Retrieve project_id before updating the record
    //         $data = array(
    //             'flag' => 1,
    //         );
    
    //         $this->Campy_hemoflow_model->update_det72($id, $data);
    //         $this->session->set_flashdata('message', 'Delete Record Success');
    //     } else {
    //         $this->session->set_flashdata('message', 'Record Not Found');
    //     }
    
    //     redirect(site_url('campy_hemoflow/read/'.$id_parent));
    // }


    public function getIdOneWaterDetails()
    {
        $idOneWaterSample = $this->input->post('id_one_water_sample');
        $oneWaterSample = $this->Campy_hemoflow_model->getOneWaterSampleById($idOneWaterSample);
        echo json_encode($oneWaterSample);
    }

    public function validate24() {
        $id = $this->input->get('id24');
        $data = $this->Campy_hemoflow_model->validate24($id);
        header('Content-Type: application/json');
        echo json_encode($data);
    }

    public function validate72() {
        $id = $this->input->get('id72');
        $data = $this->Campy_hemoflow_model->validate72($id);
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
    //     $finalConcentration = $this->Campy_hemoflow_model->get_export($id);
    
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
    //     header('Content-Disposition: attachment;filename="Report_campy_hemoflow.xlsx"');
    //     header('Cache-Control: max-age=0');
    
    //     // Output the Excel file
    //     $writer = new Xlsx($spreadsheet);
    //     $writer->save('php://output');
    // }

    // public function excel_all() {
    //     $spreadsheet = new Spreadsheet();
    //     $finalConcentration = $this->Campy_hemoflow_model->get_all_export();
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
    //     header('Content-Disposition: attachment;filename="Report_campy_hemoflow.xlsx"');
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
        $finalConcentration = $this->Campy_hemoflow_model->get_export($id);
    
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
            
            // Add MPN calculation headers after tube results
            $columnLetter = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex(11 + $tubeIndex);
            $sheet->setCellValue($columnLetter . '1', "MPN Concentration");
            $tubeIndex++;
            
            $columnLetter = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex(11 + $tubeIndex);
            $sheet->setCellValue($columnLetter . '1', "Upper CI");
            $tubeIndex++;
            
            $columnLetter = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex(11 + $tubeIndex);
            $sheet->setCellValue($columnLetter . '1', "Lower CI");
            $tubeIndex++;

            $columnLetter = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex(11 + $tubeIndex);
            $sheet->setCellValue($columnLetter . '1', "Calculation MPN/g Dw");
            $tubeIndex++; 

            $columnLetter = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex(11 + $tubeIndex);
            $sheet->setCellValue($columnLetter . '1', "Upper CI MPN/g Dw");
            $tubeIndex++;

            $columnLetter = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex(11 + $tubeIndex);
            $sheet->setCellValue($columnLetter . '1', "Lower CI MPN/g Dw");
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
                $plate_number = trim($plate_number); // Remove any spaces
                
                // Check confirmation array for this plate number
                $confirmation_value = 'No Growth'; // Default value
                
                if (isset($concentration->confirmation[$plate_number])) {
                    $confirmation_value = $concentration->confirmation[$plate_number];
                } else {
                    // Try with space prefix (karena ada spasi di key confirmation)
                    $spaced_key = ' ' . $plate_number;
                    if (isset($concentration->confirmation[$spaced_key])) {
                        $confirmation_value = $concentration->confirmation[$spaced_key];
                    }
                }
                
                // Calculate the column letter dynamically
                $columnLetter = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex(11 + $tubeIndex);
                $sheet->setCellValue($columnLetter . $numrow, $confirmation_value);
                $tubeIndex++;
            }
            
            // Fill MPN calculation data after tube results
            $columnLetter = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex(11 + $tubeIndex);
            $sheet->setCellValue($columnLetter . $numrow, $concentration->mpn_concentration ?? '');
            $tubeIndex++;
            
            $columnLetter = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex(11 + $tubeIndex);
            $sheet->setCellValue($columnLetter . $numrow, $concentration->upper_ci ?? '');
            $tubeIndex++;
            
            $columnLetter = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex(11 + $tubeIndex);
            $sheet->setCellValue($columnLetter . $numrow, $concentration->lower_ci ?? '');
            $tubeIndex++;

            $columnLetter = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex(11 + $tubeIndex);
            $sheet->setCellValue($columnLetter . $numrow, $concentration->mpn_concentration_dw ?? '');
            $tubeIndex++;   

            $columnLetter = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex(11 + $tubeIndex);
            $sheet->setCellValue($columnLetter . $numrow, $concentration->upper_ci_dw ?? '');
            $tubeIndex++;

            $columnLetter = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex(11 + $tubeIndex);
            $sheet->setCellValue($columnLetter . $numrow, $concentration->lower_ci_dw ?? '');
    
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
        $finalConcentration = $this->Campy_hemoflow_model->get_all_export();
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
        
        // Add MPN calculation headers after tube results
        $mpnStartIndex = 10 + ($numberOfTubes * 2) + 1;
        
        $columnLetter = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex($mpnStartIndex);
        $sheet->setCellValue($columnLetter . '1', "MPN Concentration");
        
        $columnLetter = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex($mpnStartIndex + 1);
        $sheet->setCellValue($columnLetter . '1', "Upper CI");
        
        $columnLetter = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex($mpnStartIndex + 2);
        $sheet->setCellValue($columnLetter . '1', "Lower CI");

        $columnLetter = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex($mpnStartIndex + 3);
        $sheet->setCellValue($columnLetter . '1', "Concentration MPN/g Dw");

        $columnLetter = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex($mpnStartIndex + 4);
        $sheet->setCellValue($columnLetter . '1', "Upper CI MPN/g Dw");

        $columnLetter = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex($mpnStartIndex + 5);
        $sheet->setCellValue($columnLetter . '1', "Lower CI MPN/g Dw");
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
        
        // Fill MPN calculation data after tube results
        $mpnStartIndex = 10 + ($numberOfTubes * 2) + 1;
        
        $columnLetter = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex($mpnStartIndex);
        $sheet->setCellValue($columnLetter . $numrow, $concentration->mpn_concentration ?? '');
        
        $columnLetter = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex($mpnStartIndex + 1);
        $sheet->setCellValue($columnLetter . $numrow, $concentration->upper_ci ?? '');
        
        $columnLetter = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex($mpnStartIndex + 2);
        $sheet->setCellValue($columnLetter . $numrow, $concentration->lower_ci ?? '');

        $columnLetter = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex($mpnStartIndex + 3);
        $sheet->setCellValue($columnLetter . $numrow, $concentration->mpn_concentration_dw ?? '');

        $columnLetter = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex($mpnStartIndex + 4);
        $sheet->setCellValue($columnLetter . $numrow, $concentration->upper_ci_dw ?? '');

        $columnLetter = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex($mpnStartIndex + 5);
        $sheet->setCellValue($columnLetter . $numrow, $concentration->lower_ci_dw ?? '');
    
            $numrow++;
        }
    }

    public function validateCampyAssayBarcode() {
        $id = $this->input->get('id');
        $data = $this->Campy_hemoflow_model->validateCampyAssayBarcode($id);
        header('Content-Type: application/json');
        echo json_encode($data);
    }

    public function barcode_restrict() 
    {
        $id = $this->input->get('id1');
        $data = $this->Campy_hemoflow_model->barcode_restrict($id);
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
    
        $this->load->model('Campy_hemoflow_model');
    
        try {
            $this->Campy_hemoflow_model->update_campy_hemoflow($id, $data);
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
        $this->load->model('Campy_hemoflow_model');
        $updateResult = $this->Campy_hemoflow_model->updateCancel($id, $data);
    
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

    public function testCalculateMPN() {
        header('Content-Type: application/json');
        
        try {
            echo json_encode([
                'status' => 'success',
                'message' => 'Test endpoint working',
                'session_data' => [
                    'user_id' => $this->session->userdata('id_users'),
                    'lab' => $this->session->userdata('lab')
                ]
            ]);
        } catch (Exception $e) {
            echo json_encode([
                'status' => 'error',
                'message' => 'Test failed: ' . $e->getMessage()
            ]);
        }
    }

    public function testUpdateMPN() {
        header('Content-Type: application/json');
        
        // Test method to check if update works
        $id_campy_result_mpn = $this->input->get('id', TRUE);
        
        if (!$id_campy_result_mpn) {
            echo json_encode([
                'status' => 'error',
                'message' => 'ID required for test'
            ]);
            return;
        }
        
        // Get current data
        $current_data = $this->Campy_hemoflow_model->get_by_id_calculate_mpn($id_campy_result_mpn);
        
        if (!$current_data) {
            echo json_encode([
                'status' => 'error',
                'message' => 'Data not found'
            ]);
            return;
        }
        
        // Try simple update
        $test_data = array(
            'mpn_concentration' => '999.99'
        );
        
        $result = $this->Campy_hemoflow_model->updateCalculateMPN($id_campy_result_mpn, $test_data);
        
        echo json_encode([
            'status' => 'success',
            'message' => 'Test update result: ' . ($result ? 'SUCCESS' : 'FAILED'),
            'current_data' => $current_data,
            'test_data' => $test_data
        ]);
    }

    // public function saveCalculateMPN() {
    //     header('Content-Type: application/json');
        
    //     try {
    //         // Get form data
    //         $mode = $this->input->post('mode_calculateMPN', TRUE);
    //         $id_campy_hemoflow = $this->input->post('id_campy_hemoflow_mpn', TRUE);
    //         $mpn_concentration = $this->input->post('mpn_concentration', FALSE);
    //         $upper_ci = $this->input->post('upper_ci', FALSE);
    //         $lower_ci = $this->input->post('lower_ci', FALSE);
    //         $mpn_concentration_dw = $this->input->post('mpn_concentration_dw', TRUE);
    //         $upper_ci_dw = $this->input->post('upper_ci_dw', TRUE);
    //         $lower_ci_dw = $this->input->post('lower_ci_dw', TRUE);
    //         $current_sample_dryweight = $this->input->post('current_sample_dryweight', TRUE);
            
    //         // Validation
    //         if (!$mode || !in_array($mode, ['insert', 'edit'])) {
    //             echo json_encode([
    //                 'status' => 'error',
    //                 'message' => 'Invalid operation mode.'
    //             ]);
    //             return;
    //         }
            
    //         if (!$id_campy_hemoflow || !$mpn_concentration || !$upper_ci || !$lower_ci) {
    //             echo json_encode([
    //                 'status' => 'error',
    //                 'message' => 'All fields are required.'
    //             ]);
    //             return;
    //         }
            
    //         $dt = new DateTime();
    //         $user_id = $this->session->userdata('id_users');
    //         $lab = $this->session->userdata('lab');
            
    //         if ($mode === 'insert') {
    //             // Insert mode
    //             $data = array(
    //                 'id_campy_hemoflow' => $id_campy_hemoflow,
    //                 'mpn_concentration' => $mpn_concentration,
    //                 'upper_ci' => $upper_ci,
    //                 'lower_ci' => $lower_ci,
    //                 'mpn_concentration_dw' => $mpn_concentration_dw,
    //                 'upper_ci_dw' => $upper_ci_dw,
    //                 'lower_ci_dw' => $lower_ci_dw,
    //                 'flag' => '0',
    //                 'lab' => $lab ? $lab : '1',
    //                 'uuid' => $this->uuid->v4(),
    //                 'user_created' => $user_id,
    //                 'date_created' => $dt->format('Y-m-d H:i:s'),
    //             );
                
    //             $insert_id = $this->Campy_hemoflow_model->insertCalculateMPN($data);
                
    //             if ($insert_id) {
    //                 echo json_encode([
    //                     'status' => 'success',
    //                     'message' => 'MPN calculation saved successfully.',
    //                     'id' => $insert_id
    //                 ]);
    //             } else {
    //                 echo json_encode([
    //                     'status' => 'error',
    //                     'message' => 'Failed to save MPN calculation.'
    //                 ]);
    //             }
                
    //         } else if ($mode === 'edit') {
    //             // Edit mode
    //             $id_campy_result_mpn = $this->input->post('id_campy_result_mpn', TRUE);
                
    //             if (!$id_campy_result_mpn) {
    //                 echo json_encode([
    //                     'status' => 'error',
    //                     'message' => 'MPN calculation ID is required for update.'
    //                 ]);
    //                 return;
    //             }
                
    //             // Only update the fields that exist in the table
    //             $data = array(
    //                 'id_campy_hemoflow' => $id_campy_hemoflow,
    //                 'mpn_concentration' => $mpn_concentration,
    //                 'upper_ci' => $upper_ci,
    //                 'lower_ci' => $lower_ci,
    //                 'mpn_concentration_dw' => $mpn_concentration_dw,
    //                 'upper_ci_dw' => $upper_ci_dw,
    //                 'lower_ci_dw' => $lower_ci_dw,
    //                 'flag' => '0',
    //                 'lab' => $lab ? $lab : '1',
    //                 'uuid' => $this->uuid->v4(),
    //                 // Remove date_updated and user_updated as they don't exist in the table
    //             );
                
    //             $update_result = $this->Campy_hemoflow_model->updateCalculateMPN($id_campy_result_mpn, $data);
                
    //             if ($update_result) {
    //                 echo json_encode([
    //                     'status' => 'success',
    //                     'message' => 'MPN calculation updated successfully.'
    //                 ]);
    //             } else {
    //                 echo json_encode([
    //                     'status' => 'error',
    //                     'message' => 'Failed to update MPN calculation. No changes detected.'
    //                 ]);
    //             }
    //         }
            
    //     } catch (Exception $e) {
    //         echo json_encode([
    //             'status' => 'error',
    //             'message' => 'Error: ' . $e->getMessage()
    //         ]);
    //     }
    // }
    public function saveCalculateMPN() {
        header('Content-Type: application/json');
        
        try {
            // Get form data
            $mode = $this->input->post('mode_calculateMPN', TRUE);
            $id_campy_hemoflow = $this->input->post('id_campy_hemoflow_mpn', TRUE);
            $mpn_concentration = $this->input->post('mpn_concentration', FALSE);
            $upper_ci = $this->input->post('upper_ci', TRUE);
            $lower_ci = $this->input->post('lower_ci', TRUE);
            $mpn_concentration_dw = $this->input->post('mpn_concentration_dw', TRUE);
            $upper_ci_dw = $this->input->post('upper_ci_dw', TRUE);
            $lower_ci_dw = $this->input->post('lower_ci_dw', TRUE);
            $current_sample_dryweight = $this->input->post('current_sample_dryweight', TRUE);
            
            // Validation
            if (!$mode || !in_array($mode, ['insert', 'edit'])) {
                echo json_encode([
                    'status' => 'error',
                    'message' => 'Invalid operation mode.'
                ]);
                return;
            }
            
            if (!$id_campy_hemoflow || !$mpn_concentration || !$upper_ci || !$lower_ci || !$mpn_concentration_dw || !$upper_ci_dw || !$lower_ci_dw) {
                echo json_encode([
                    'status' => 'error',
                    'message' => 'All fields are required.'
                ]);
                return;
            }
            
            $dt = new DateTime();
            $user_id = $this->session->userdata('id_users');
            $lab = $this->session->userdata('lab');
            
            if ($mode === 'insert') {
                // Insert mode
                $data = array(
                    'id_campy_hemoflow' => $id_campy_hemoflow,
                    'mpn_concentration' => $mpn_concentration,
                    'upper_ci' => $upper_ci,
                    'lower_ci' => $lower_ci,
                    'mpn_concentration_dw' => $mpn_concentration_dw,
                    'upper_ci_dw' => $upper_ci_dw,
                    'lower_ci_dw' => $lower_ci_dw,
                    'flag' => '0',
                    'lab' => $lab ? $lab : '1',
                    'uuid' => $this->uuid->v4(),
                    'user_created' => $user_id,
                    'date_created' => $dt->format('Y-m-d H:i:s'),
                );
                
                $insert_id = $this->Campy_hemoflow_model->insertCalculateMPN($data);
                
                if ($insert_id) {
                    // Update sample_dryweight_old in campy_hemoflow table to sync with current value
                    if ($current_sample_dryweight) {
                        $update_hemoflow_data = array(
                            'sample_dryweight_old' => $current_sample_dryweight
                        );
                        $this->Campy_hemoflow_model->updateCampyHemoflow($id_campy_hemoflow, $update_hemoflow_data);
                    }
                    
                    echo json_encode([
                        'status' => 'success',
                        'message' => 'MPN calculation saved successfully.',
                        'id' => $insert_id
                    ]);
                } else {
                    echo json_encode([
                        'status' => 'error',
                        'message' => 'Failed to save MPN calculation.'
                    ]);
                }
                
            } else if ($mode === 'edit') {
                // Edit mode
                $id_campy_result_mpn = $this->input->post('id_campy_result_mpn', TRUE);
                
                if (!$id_campy_result_mpn) {
                    echo json_encode([
                        'status' => 'error',
                        'message' => 'MPN calculation ID is required for update.'
                    ]);
                    return;
                }
                
                // Only update the fields that exist in the table
                $data = array(
                    'id_campy_hemoflow' => $id_campy_hemoflow,
                    'mpn_concentration' => $mpn_concentration,
                    'upper_ci' => $upper_ci,
                    'lower_ci' => $lower_ci,
                    'mpn_concentration_dw' => $mpn_concentration_dw,
                    'upper_ci_dw' => $upper_ci_dw,
                    'lower_ci_dw' => $lower_ci_dw,
                    'flag' => '0',
                    'lab' => $lab ? $lab : '1',
                    'uuid' => $this->uuid->v4(),
                    // Remove date_updated and user_updated as they don't exist in the table
                );
                
                // Debug logging - you can remove this later
                log_message('debug', 'Update MPN Data: ' . json_encode($data));
                log_message('debug', 'Update MPN ID: ' . $id_campy_result_mpn);
                
                $update_result = $this->Campy_hemoflow_model->updateCalculateMPN($id_campy_result_mpn, $data);
                
                if ($update_result) {
                    // Update sample_dryweight_old in campy_hemoflow table to sync with current value
                    if ($current_sample_dryweight) {
                        $update_hemoflow_data = array(
                            'sample_dryweight_old' => $current_sample_dryweight
                        );
                        $this->Campy_hemoflow_model->updateCampyHemoflow($id_campy_hemoflow, $update_hemoflow_data);
                    }
                    
                    echo json_encode([
                        'status' => 'success',
                        'message' => 'MPN calculation updated successfully.'
                    ]);
                } else {
                    echo json_encode([
                        'status' => 'error',
                        'message' => 'Failed to update MPN calculation. No changes detected.'
                    ]);
                }
            }
            
        } catch (Exception $e) {
            echo json_encode([
                'status' => 'error',
                'message' => 'Error: ' . $e->getMessage()
            ]);
        }
    }

    public function getCalculateMPN() {
        header('Content-Type: application/json');
        
        $id_campy_hemoflow = $this->input->get('id_campy_hemoflow', TRUE);
        
        if (!$id_campy_hemoflow) {
            echo json_encode([
                'status' => 'error',
                'message' => 'ID Campy Hemoflow is required.'
            ]);
            return;
        }
        
        try {
            $mpn_data = $this->Campy_hemoflow_model->get_calculate_mpn_by_campy_hemoflow($id_campy_hemoflow);
            
            if ($mpn_data) {
                echo json_encode([
                    'status' => 'success',
                    'data' => $mpn_data
                ]);
            } else {
                echo json_encode([
                    'status' => 'not_found',
                    'message' => 'No MPN calculation found.'
                ]);
            }
        } catch (Exception $e) {
            echo json_encode([
                'status' => 'error',
                'message' => 'Error retrieving MPN calculation: ' . $e->getMessage()
            ]);
        }
    }

    public function getDryWeight()
    {
        $idOneWaterSample = $this->input->post('id_one_water_sample');
        $oneWaterSample = $this->Campy_hemoflow_model->getDryWeight($idOneWaterSample);
        
        // Handle null response properly
        if ($oneWaterSample) {
            echo json_encode($oneWaterSample);
        } else {
            // Return a proper JSON structure when no data is found
            echo json_encode(['dry_weight_persen' => null]);
        }
    }
}
/* End of file Campy_hemoflow.php */
/* Location: ./application/controllers/Campy_hemoflow.php */

/* End of file Water_sample_reception.php */
/* Location: ./application/controllers/Water_sample_reception.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2022-12-14 03:38:42 */
/* http://harviacode.com */