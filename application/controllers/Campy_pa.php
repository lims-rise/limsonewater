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
    
class Campy_pa extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        is_login();
        $this->load->model('Campy_pa_model');
        $this->load->library('form_validation');        
	    $this->load->library('datatables');
	    $this->load->library('uuid');
    }

    public function index()
    {
        $data['id_one'] = $this->Campy_pa_model->getID_one();
        $data['sampletype'] = $this->Campy_pa_model->getSampleType();
        $data['labtech'] = $this->Campy_pa_model->getLabTech();
        $data['tubes'] = $this->Campy_pa_model->getTubes();
        // var_dump($data['id_one']);
        // die();
        // $data['id_project'] = $this->Moisture_content_model->generate_project_id();
        // $data['client'] = $this->Moisture_content_model->generate_client();
        // $data['id_one_water_sample'] = $this->Moisture_content_model->generate_one_water_sample_id();
        $this->template->load('template','campy_pa/index', $data);
    } 
    
    public function json() {
        header('Content-Type: application/json');
        echo $this->Campy_pa_model->json();
    }

    public function subjsonCharcoal() {
        $id = $this->input->get('idCharcoal',TRUE);
        header('Content-Type: application/json');
        echo $this->Campy_pa_model->subjsonCharcoal($id);
    }

    public function subjsonHba() {
        $id = $this->input->get('idHba',TRUE);
        header('Content-Type: application/json');
        echo $this->Campy_pa_model->subjsonHba($id);
    }

    public function subjsonBiochemical() {
        $id = $this->input->get('idBiochemical',TRUE);
        $biochemical_tube = $this->input->get('biochemical_tube', TRUE);
        header('Content-Type: application/json');
        echo $this->Campy_pa_model->subjsonBiochemical($id, $biochemical_tube);
    }

    public function read($id)
    {
        $row = $this->Campy_pa_model->get_detail($id);

        if ($row) {
            $data = array(

                'id_campy_pa' => $row->id_campy_pa,
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
            $finalConcentration = $this->Campy_pa_model->subjsonFinalConcentration($row->id_campy_pa);
            if ($finalConcentration) {
                $data['finalConcentration'] = $finalConcentration;
            } else {
                $data['finalConcentration'] = []; // Pastikan ini tidak null
            }
            // var_dump($data);
            // die();
            $this->template->load('template','campy_pa/index_det', $data);

        }
        else {
            // $this->template->load('template','Water_sample_reception/index_det', $test);
        }

    } 

    public function read2($id)
    {
        $data['test'] = $this->Campy_pa_model->getTest();
        $row = $this->Campy_pa_model->get_detail2($id);
        if ($row) {
            $data = array(
                'id_project' => $row->id_project,
                'id_sample' => $row->id_sample,
                'sample_description' => $row->sample_description,
                'test' => $this->Campy_pa_model->getTest(),
                );
                $this->template->load('template','campy_pa/index_det2', $data);
        }
        else {
            // $this->template->load('template','Water_sample_reception/index_det');
        }
    }     


    public function save() {
        $mode = $this->input->post('mode', TRUE);
        $id_campy_pa = $this->input->post('id_campy_pa', TRUE);
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
    
            $assay_id = $this->Campy_pa_model->insert($data);
    
            // Insert sample volumes
            $number_of_tubes = $this->input->post('number_of_tubes', TRUE);
            for ($i = 1; $i <= $number_of_tubes; $i++) {
                $volume = $this->input->post("vol_sampletube{$i}", TRUE);
                if ($volume !== null) {
                    $this->Campy_pa_model->insert_sample_volume(array(
                        'id_campy_pa' => $assay_id,
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
    
            $this->Campy_pa_model->updateCampyBiosolids($id_campy_pa, $data);
    
            // Update sample volumes
            $number_of_tubes = $this->input->post('number_of_tubes1', TRUE);
            // var_dump($number_of_tubes); // var dump jumlah tube
            // die();
            $this->Campy_pa_model->delete_sample_volumes($id_campy_pa); // Hapus volume yang ada

            for ($i = 1; $i <= $number_of_tubes; $i++) {
                $volume = $this->input->post("vol_sampletube{$i}", TRUE);
                // var_dump($volume); // var dump volume pada setiap tube

                if ($volume !== null) {
                    $data_volume = array(
                        'id_campy_pa' => $id_campy_pa,
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
                    $this->Campy_pa_model->insert_sample_volume($data_volume);
                }
            }
    
            $this->session->set_flashdata('message', 'Update Record Success');
        }
    
        redirect(site_url("campy_pa"));
    }

    public function saveResultsCharcoal() {
        $mode = $this->input->post('mode_detResultsCharcoal', TRUE);
        $id_one_water_sample = $this->input->post('idCharcoal_one_water_sample', TRUE);
        $id_campy_pa = $this->input->post('id_campy_pa1', TRUE);
        $id_result_charcoal_pa = $this->input->post('id_result_charcoal_pa', TRUE);
        $dt = new DateTime();
        $date_sample_processed = $this->input->post('date_sample_processed1', TRUE);
        $time_sample_processed = $this->input->post('time_sample_processed1', TRUE);
        $quality_control = $this->input->post('quality_control', TRUE) ? 1 : 0; // Convert checkbox to integer
    
        if ($mode == "insert") {
            // Insert data into assays table
            $data = array(
                'id_campy_pa' => $id_campy_pa,
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
    
            $assay_id = $this->Campy_pa_model->insertResultsCharcoal($data);
    
            // Insert sample volumes
            $number_of_tubes = $this->input->post('number_of_tubes1', TRUE);
            for ($i = 1; $i <= $number_of_tubes; $i++) {
                $plate = $this->input->post("growth_plate{$i}", TRUE);
                if ($plate !== null) {
                    $this->Campy_pa_model->insert_growth_plate(array(
                        'id_result_charcoal_pa' => $assay_id,
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
                'id_campy_pa' => $id_campy_pa,
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
    
            $this->Campy_pa_model->updateResultsCharcoal($id_result_charcoal_pa, $data);

            // Update sample volumes
            $number_of_tubes = $this->input->post('number_of_tubes1', TRUE);
            $this->Campy_pa_model->delete_growth_plates($id_result_charcoal_pa); // Hapus volume yang ada

            for ($i = 1; $i <= $number_of_tubes; $i++) {
                $plate = $this->input->post("growth_plate{$i}", TRUE);
                if ($plate !== null) {
                    $data_plate = array(
                        'id_result_charcoal_pa' => $id_result_charcoal_pa,
                        'plate_number' => $i,
                        'growth_plate' => $plate,
                        'flag' => '0',
                        'lab' => $this->session->userdata('lab'),
                        'uuid' => $this->uuid->v4(),
                        'user_created' => $this->session->userdata('id_users'),
                        'date_created' => $dt->format('Y-m-d H:i:s'),
                    );
                    $this->Campy_pa_model->insert_growth_plate($data_plate);
                }
            }
    
            $this->session->set_flashdata('message', 'Update Record Success');
        }
    
        // Check if auto-generation of HBA results is needed
        $hba_auto_generated = false;
        if ($mode == "insert") {
            $hba_auto_generated = $this->autoGenerateHBAResults($assay_id, $id_campy_pa);
        } else if ($mode == "edit") {
            $hba_auto_generated = $this->autoGenerateHBAResults($id_result_charcoal_pa, $id_campy_pa);
        }

        // Set appropriate flash message
        if ($hba_auto_generated) {
            if ($mode == "insert") {
                $this->session->set_flashdata('message', 'Create Record Success - HBA and Biochemical Results auto-generated (Not detected)');
            } else {
                $this->session->set_flashdata('message', 'Update Record Success - HBA and Biochemical Results auto-generated (Not detected)');
            }
        }

        redirect(site_url("campy_pa/read/" . $id_one_water_sample));
    }

    /**
     * Auto-generate HBA results when all growth plates are 0
     * Based on campy_biosolids implementation
     * Returns true if HBA was auto-generated, false otherwise
     */
    private function autoGenerateHBAResults($id_result_charcoal_pa, $id_campy_pa) {
        // Get all growth plates for this charcoal result
        $growth_plates = $this->Campy_pa_model->get_growth_plates_by_charcoal($id_result_charcoal_pa);
        
        if (empty($growth_plates)) {
            return false; // No plates found, nothing to do
        }
        
        // Check if all growth plates are 0
        $all_plates_zero = true;
        foreach ($growth_plates as $plate) {
            if ($plate->growth_plate != '0') {
                $all_plates_zero = false;
                break;
            }
        }
        
        if (!$all_plates_zero) {
            return false; // Not all plates are 0, no auto-generation needed
        }
        
        // Check if HBA results already exist for this campy_pa
        $existing_hba = $this->Campy_pa_model->get_hba_by_campy_pa($id_campy_pa);
        if (!empty($existing_hba)) {
            return false; // HBA results already exist, don't auto-generate
        }
        
        $dt = new DateTime();
        
        // Auto-generate HBA result
        $hba_data = array(
            'id_campy_pa' => $id_campy_pa,
            'date_sample_processed' => date('Y-m-d'),
            'time_sample_processed' => date('H:i:s'),
            'quality_control' => 0, // Default 0 for auto-generated HBA
            'flag' => '0',
            'lab' => $this->session->userdata('lab'),
            'uuid' => $this->uuid->v4(),
            'user_created' => $this->session->userdata('id_users'),
            'date_created' => $dt->format('Y-m-d H:i:s'),
        );
        
        $hba_id = $this->Campy_pa_model->insertResultsHba($hba_data);
        
        if ($hba_id) {
            // Auto-generate HBA growth plates (all 0 since parent plates were all 0)
            $number_of_plates = count($growth_plates);
            for ($i = 1; $i <= $number_of_plates; $i++) {
                $this->Campy_pa_model->insert_growth_plate_hba(array(
                    'id_result_hba_pa' => $hba_id,
                    'plate_number' => $i,
                    'growth_plate' => '0',
                    'flag' => '0',
                    'lab' => $this->session->userdata('lab'),
                    'uuid' => $this->uuid->v4(),
                    'user_created' => $this->session->userdata('id_users'),
                    'date_created' => $dt->format('Y-m-d H:i:s'),
                ));
            }
            
            // Auto-generate biochemical results since all HBA plates are 0
            $biochemical_auto_generated = $this->autoGenerateBiochemicalResults($hba_id, $id_campy_pa, $number_of_plates);
            
            if ($biochemical_auto_generated) {
                log_message('info', "Auto-generated HBA and Biochemical results for campy_pa ID {$id_campy_pa} with {$number_of_plates} plates (all 0)");
            } else {
                log_message('info', "Auto-generated HBA results for campy_pa ID {$id_campy_pa} with {$number_of_plates} plates (all 0)");
            }
            
            return true; // Auto-generation successful
        }
        
        return false; // Auto-generation failed
    }

    /**
     * Auto-generate Biochemical results when all HBA growth plates are 0
     * This creates biochemical results with negative values indicating Not detected
     * Returns true if Biochemical was auto-generated, false otherwise
     */
    private function autoGenerateBiochemicalResults($id_result_hba_pa, $id_campy_pa, $number_of_plates) {
        // Check if biochemical results already exist for this HBA
        $existing_biochemical = $this->Campy_pa_model->get_biochemical_by_hba_id($id_result_hba_pa);
        if (!empty($existing_biochemical)) {
            return false; // Biochemical results already exist, don't auto-generate
        }
        
        $dt = new DateTime();
        
        // Auto-generate biochemical results for each tube
        for ($i = 1; $i <= $number_of_plates; $i++) {
            $biochemical_data = array(
                'id_campy_pa' => $id_campy_pa,
                'id_result_hba_pa' => $id_result_hba_pa,
                'gramlysis' => 'Negative',     // Negative gramlysis
                'oxidase' => 'Negative',         // Negative oxidase
                'catalase' => 'Negative',        // Negative catalase
                'confirmation' => 'Not detected',  // Not detected
                'sample_store' => 'No',          // No sample store
                'biochemical_tube' => $i,        // Tube number
                'flag' => '0',
                'lab' => $this->session->userdata('lab'),
                'uuid' => $this->uuid->v4(),
                'user_created' => $this->session->userdata('id_users'),
                'date_created' => $dt->format('Y-m-d H:i:s'),
            );
            
            $biochemical_id = $this->Campy_pa_model->insertResultsBiochemical($biochemical_data);
            
            if (!$biochemical_id) {
                log_message('error', "Failed to auto-generate biochemical result for tube {$i}, HBA ID {$id_result_hba_pa}");
                return false; // If any insertion fails, return false
            }
        }

        log_message('info', "Auto-generated {$number_of_plates} biochemical results for HBA ID {$id_result_hba_pa} (all Not detected)");
        return true; // Auto-generation successful
    }

    /**
     * Check HBA plates and auto-generate biochemical results if all are 0
     * This is used when HBA is manually entered (not auto-generated from charcoal)
     * Returns true if Biochemical was auto-generated, false otherwise
     */
    private function checkAndAutoGenerateBiochemicalFromHBA($id_result_hba_pa, $id_campy_pa, $number_of_tubes) {
        // Get all HBA growth plates for this HBA result
        $hba_plates = $this->Campy_pa_model->get_growth_plates_hba_by_id($id_result_hba_pa);
        
        if (empty($hba_plates)) {
            return false; // No plates found, nothing to do
        }
        
        // Check if all HBA growth plates are 0
        $all_plates_zero = true;
        foreach ($hba_plates as $plate) {
            if ($plate->growth_plate != '0') {
                $all_plates_zero = false;
                break;
            }
        }
        
        if (!$all_plates_zero) {
            return false; // Not all plates are 0, no auto-generation needed
        }
        
        // Check if biochemical results already exist for this HBA
        $existing_biochemical = $this->Campy_pa_model->get_biochemical_by_hba_id($id_result_hba_pa);
        if (!empty($existing_biochemical)) {
            return false; // Biochemical results already exist, don't auto-generate
        }
        
        // Auto-generate biochemical results using the existing function
        return $this->autoGenerateBiochemicalResults($id_result_hba_pa, $id_campy_pa, $number_of_tubes);
    }

    public function saveResultsHBA() {
        $mode = $this->input->post('mode_detResultsHBA', TRUE);
        $id_one_water_sample = $this->input->post('idHba_one_water_sample', TRUE);
        $id_campy_pa = $this->input->post('id_campy_paHBA', TRUE);
        $id_result_hba_pa = $this->input->post('id_result_hba_pa', TRUE);

        $dt = new DateTime();
        $date_sample_processed = $this->input->post('date_sample_processedHBA', TRUE);
        $time_sample_processed = $this->input->post('time_sample_processedHBA', TRUE);
        $quality_control = $this->input->post('quality_control_hba', TRUE) ? 1 : 0; // Convert checkbox to integer
    
        if ($mode == "insert") {
            // Insert data into assays table
            $data = array(
                'id_campy_pa' => $id_campy_pa,
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
    
            $assay_id = $this->Campy_pa_model->insertResultsHba($data);
    
            // Insert sample volumes
            $number_of_tubes = $this->input->post('number_of_tubesHba', TRUE);
            for ($i = 1; $i <= $number_of_tubes; $i++) {
                $plate = $this->input->post("growth_plate{$i}", TRUE);

                if ($plate !== null) {
                    $this->Campy_pa_model->insert_growth_plate_hba(array(
                        'id_result_hba_pa' => $assay_id,
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
    
            // Check if auto-generation of Biochemical results is needed for manual HBA input
            $biochemical_auto_generated = $this->checkAndAutoGenerateBiochemicalFromHBA($assay_id, $id_campy_pa, $number_of_tubes);
            
            if ($biochemical_auto_generated) {
                $this->session->set_flashdata('message', 'Create Record Success - Biochemical Results auto-generated (Not detected)');
            } else {
                $this->session->set_flashdata('message', 'Create Record Success');
            }
    
        } else if ($mode == "edit") {
            // Update data in assays table
            $data = array(
                'id_campy_pa' => $id_campy_pa,
                'date_sample_processed' => $date_sample_processed,
                'time_sample_processed' => $time_sample_processed,
                'quality_control' => $quality_control,
                'flag' => '0',
                'lab' => $this->session->userdata('lab'),
                'uuid' => $this->uuid->v4(),
                'user_updated' => $this->session->userdata('id_users'),
                'date_updated' => $dt->format('Y-m-d H:i:s'),
            );
    
            $this->Campy_pa_model->updateResultsHba($id_result_hba_pa, $data);
    
            // Update sample volumes
            $number_of_tubes = $this->input->post('number_of_tubesHba', TRUE);
            $this->Campy_pa_model->delete_growth_plates_hba($id_result_hba_pa); // Hapus volume yang ada
    
            for ($i = 1; $i <= $number_of_tubes; $i++) {
                $plate = $this->input->post("growth_plate{$i}", TRUE);
                if ($plate !== null) {
                    $data_plate = array(
                        'id_result_hba_pa' => $id_result_hba_pa,
                        'plate_number' => $i,
                        'growth_plate' => $plate,
                        'flag' => '0',
                        'lab' => $this->session->userdata('lab'),
                        'uuid' => $this->uuid->v4(),
                        'user_created' => $this->session->userdata('id_users'),
                        'date_created' => $dt->format('Y-m-d H:i:s'),
                    );
                    $this->Campy_pa_model->insert_growth_plate_hba($data_plate);
                }
            }
    
            // Check if auto-generation of Biochemical results is needed for manual HBA input
            $biochemical_auto_generated = $this->checkAndAutoGenerateBiochemicalFromHBA($id_result_hba_pa, $id_campy_pa, $number_of_tubes);
            
            if ($biochemical_auto_generated) {
                $this->session->set_flashdata('message', 'Update Record Success - Biochemical Results auto-generated (Not detected)');
            } else {
                $this->session->set_flashdata('message', 'Update Record Success');
            }
        }
    
        redirect(site_url("campy_pa/read/" . $id_one_water_sample));
    }


    public function saveBiochemical() {
        $mode = $this->input->post('mode_detResultsBiochemical', TRUE);
        $id_result_biochemical_pa = $this->input->post('id_result_biochemical_pa', TRUE);
        $id_result_hba_pa = $this->input->post('id_result_hba_pa1', TRUE);
        $id_campy_pa = $this->input->post('id_campy_paBiochemical', TRUE);
        $gramlysis = $this->input->post('gramlysis', TRUE);
        $oxidase = $this->input->post('oxidase', TRUE);
        $catalase = $this->input->post('catalase', TRUE);
        $confirmation = $this->input->post('confirmation', TRUE);
        $sample_store = $this->input->post('sample_store', TRUE);
        $biochemical_tube = $this->input->post('biochemical_tube', TRUE);
        $id_one_water_sample = $this->input->post('idBiochemical_one_water_sample', TRUE);

        if ($mode == "insert") {
            $data = array(
                'id_campy_pa' => $id_campy_pa,
                'id_result_hba_pa' => $id_result_hba_pa,
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
            // var_dump($data);
            // die();
            $this->Campy_pa_model->insertResultsBiochemical($data);
            $this->session->set_flashdata('message', 'Create Record Success');
        } else if ($mode == "edit") {
            $data = array(
                'id_result_biochemical_pa' => $id_result_biochemical_pa,
                'id_campy_pa' => $id_campy_pa,
                'id_result_hba_pa' => $id_result_hba_pa,
                'gramlysis' => $gramlysis,
                'oxidase' => $oxidase,
                'catalase' => $catalase,
                'confirmation' => $confirmation,
                'sample_store' => $sample_store,
                'biochemical_tube' => $biochemical_tube,  // Missing field added
                'flag' => '0',
                'lab' => $this->session->userdata('lab'),
                'uuid' => $this->uuid->v4(),
                'user_updated' => $this->session->userdata('id_users'),
                'date_updated' => date('Y-m-d H:i:s'),
            );

            $this->Campy_pa_model->updateResultsBiochemical($id_result_biochemical_pa, $data);
            $this->session->set_flashdata('message', 'Update Record Success');
        }

        redirect(site_url("campy_pa/read/" . $id_one_water_sample));
    }


    public function delete_campyBiosolids($id) {
        $row = $this->Campy_pa_model->get_by_id_campybiosolids($id);
        if ($row) {
            $id_parent = $row->id_result_charcoal_pa; // Retrieve project_id before updating the record
            $id_campy_pa = $row->id_campy_pa; // Get campy_pa ID for cascade delete
            $data = array(
                'flag' => 1,
            );
    
            $this->Campy_pa_model->updateCampyBiosolids($id, $data);
            $this->Campy_pa_model->updateSampleVolume($id_campy_pa, $data);
            $this->session->set_flashdata('message', 'Delete Record Success');
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
        }
    
        redirect(site_url('campy_pa/read/'.$id_parent));
    }
    
    public function delete_detailCharcoal($id) {
        $row = $this->Campy_pa_model->get_by_id_charcoal($id);
        if ($row) {
            $id_campy_pa = $row->id_campy_pa;
            $data = array(
                'flag' => 1,
            );

            // Step 1: Get all HBA results related to this campy_pa
            $hba_results = $this->Campy_pa_model->get_hba_by_charcoal_id($id_campy_pa);
            $total_biochemical_deleted = 0;
            $total_hba_deleted = 0;

            // Step 2: For each HBA, delete related biochemical results
            foreach ($hba_results as $hba) {
                $biochemical_results = $this->Campy_pa_model->get_biochemical_by_hba_id($hba->id_result_hba_pa);
                $biochemical_count = count($biochemical_results);
                
                if ($biochemical_count > 0) {
                    $this->Campy_pa_model->delete_biochemical_by_hba_id($hba->id_result_hba_pa);
                    $total_biochemical_deleted += $biochemical_count;
                    
                    // Log the cascade delete
                    log_message('info', "Cascade delete: Deleted {$biochemical_count} biochemical results for HBA ID {$hba->id_result_hba_pa}");
                }
                
                $total_hba_deleted++;
            }

            // Step 3: Delete all HBA results for this campy_pa
            if ($total_hba_deleted > 0) {
                $this->Campy_pa_model->delete_hba_by_campy_pa($id_campy_pa);
                log_message('info', "Cascade delete: Deleted {$total_hba_deleted} HBA results for campy_pa ID {$id_campy_pa}");
            }

            // Step 4: Delete the charcoal results
            $this->Campy_pa_model->updateResultsCharcoal($id, $data);
            $this->Campy_pa_model->updateResultsGrowthPlate($id, $data);
            
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

        redirect(site_url('campy_pa/read/'.$row->id_campy_pa));
    }

    public function delete_detailHba($id) {
        $row = $this->Campy_pa_model->get_by_id_hba($id);
        if ($row) {
            $id_campy_pa = $row->id_campy_pa; // Get campy_pa ID for redirect
            $data = array(
                'flag' => 1,
            );
    
            // First, check if there are any biochemical results related to this HBA
            $biochemical_results = $this->Campy_pa_model->get_biochemical_by_hba_id($id);
            $biochemical_count = count($biochemical_results);
            
            // Delete HBA results (growth plates and main record)
            $this->Campy_pa_model->updateResultsHba($id, $data);
            $this->Campy_pa_model->updateResultsGrowthPlateHba($id, $data);
            
            // Cascade delete: Delete all related biochemical results
            if ($biochemical_count > 0) {
                $biochemical_deleted = $this->Campy_pa_model->delete_biochemical_by_hba_id($id);
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
    
        redirect(site_url('campy_pa/read/'.$id_campy_pa));
    }

    public function delete_detailBiochemical($id) {
        $row = $this->Campy_pa_model->get_by_id_biochemical($id);
        if ($row) {
            $id_parent = $row->id_result_charcoal_pa; // Retrieve project_id before updating the record
            $data = array(
                'flag' => 1,
            );
    
            $this->Campy_pa_model->updateResultsBiochemical($id, $data);
            $this->session->set_flashdata('message', 'Delete Record Success');
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
        }
    
        redirect(site_url('campy_pa/read/'.$id_parent));
    }


    public function getIdOneWaterDetails()
    {
        $idOneWaterSample = $this->input->post('id_one_water_sample');
        $oneWaterSample = $this->Campy_pa_model->getOneWaterSampleById($idOneWaterSample);
        echo json_encode($oneWaterSample);
    }

    public function validate24() {
        $id = $this->input->get('id24');
        $data = $this->Campy_pa_model->validate24($id);
        header('Content-Type: application/json');
        echo json_encode($data);
    }

    public function validate72() {
        $id = $this->input->get('id72');
        $data = $this->Campy_pa_model->validate72($id);
        header('Content-Type: application/json');
        echo json_encode($data);
    }


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
        $finalConcentration = $this->Campy_pa_model->get_export($id);
    
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
        header('Content-Disposition: attachment;filename="Report_BioSolids_PA_Final_Concentrations.xlsx"');
        header('Cache-Control: max-age=0');
    
        // Output the Excel file
        $writer = new Xlsx($spreadsheet);
        $writer->save('php://output');
    }

    public function excel_all() {
        $spreadsheet = new Spreadsheet();
        $finalConcentration = $this->Campy_pa_model->get_all_export();
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
        header('Content-Disposition: attachment;filename="Report_All_BioSolids_PA_Final_Concentrations.xlsx"');
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
        $data = $this->Campy_pa_model->validateCampyAssayBarcode($id);
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
    
        $this->load->model('Campy_pa_model');
    
        try {
            $this->Campy_pa_model->update_campy_pa($id, $data);
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
        $this->load->model('Campy_pa_model');
        $updateResult = $this->Campy_pa_model->updateCancel($id, $data);

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