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

class Salmonella_pa extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        is_login();
        $this->load->model('Salmonella_pa_model');
        $this->load->library('form_validation');        
	    $this->load->library('datatables');
	    $this->load->library('uuid');
    }

    public function index()
    {
        $data['id_one'] = $this->Salmonella_pa_model->getID_one();
        $data['sampletype'] = $this->Salmonella_pa_model->getSampleType();
        $data['labtech'] = $this->Salmonella_pa_model->getLabTech();
        $data['tubes'] = $this->Salmonella_pa_model->getTubes();
        // var_dump($data['id_one']);
        // die();
        // $data['id_project'] = $this->Moisture_content_model->generate_project_id();
        // $data['client'] = $this->Moisture_content_model->generate_client();
        // $data['id_one_water_sample'] = $this->Moisture_content_model->generate_one_water_sample_id();
        $this->template->load('template','salmonella_pa/index', $data);
    } 
    
    public function json() {
        header('Content-Type: application/json');
        echo $this->Salmonella_pa_model->json();
    }

    public function subjsonXldAgar() {
        $id = $this->input->get('idXldAgar',TRUE);
        header('Content-Type: application/json');
        echo $this->Salmonella_pa_model->subjsonXldAgar($id);
    }

    public function subjsonChromagar() {
        $id = $this->input->get('idChromagar',TRUE);
        header('Content-Type: application/json');
        echo $this->Salmonella_pa_model->subjsonChromagar($id);
    }

    public function subjsonBiochemical() {
        $id = $this->input->get('idBiochemical',TRUE);
        $biochemical_tube = $this->input->get('biochemical_tube', TRUE);
        header('Content-Type: application/json');
        echo $this->Salmonella_pa_model->subjsonBiochemical($id, $biochemical_tube);
    }

    public function read($id)
    {
        $row = $this->Salmonella_pa_model->get_detail($id);

        if ($row) {
            $data = array(

                'id_salmonella_pa' => $row->id_salmonella_pa,
                'id_one_water_sample' => $row->id_one_water_sample,
                'initial' => $row->initial,
                'sampletype' => $row->sampletype,
                'number_of_tubes' => $row->number_of_tubes,
                'mpn_pcr_conducted' => $row->mpn_pcr_conducted,
                'salmonella_assay_barcode' => $row->salmonella_assay_barcode,
                'date_sample_processed' => $row->date_sample_processed,
                'time_sample_processed' => $row->time_sample_processed,
                'sample_wetweight' => $row->sample_wetweight,
                // 'elution_volume' => $row->elution_volume,
                'enrichment_media' => $row->enrichment_media,
                'vol_sampletube' => $row->vol_sampletube,
                'tube_number' => $row->tube_number,
                'full_name' => $row->full_name,
                'user_review' => $row->user_review,
                'review' => $row->review,
                'user_created' => $row->user_created,
                
            );
            
            // Mendapatkan final concentration
            $finalConcentration = $this->Salmonella_pa_model->subjsonFinalConcentration($row->id_salmonella_pa);
            if ($finalConcentration) {
                $data['finalConcentration'] = $finalConcentration;
            } else {
                $data['finalConcentration'] = []; // Pastikan ini tidak null
            }
            // var_dump($data);
            // die();
            $this->template->load('template','salmonella_pa/index_det', $data);

        }
        else {
            // $this->template->load('template','Water_sample_reception/index_det', $test);
        }

    } 

    public function read2($id)
    {
        $data['test'] = $this->Salmonella_pa_model->getTest();
        $row = $this->Salmonella_pa_model->get_detail2($id);
        if ($row) {
            $data = array(
                'id_project' => $row->id_project,
                'id_sample' => $row->id_sample,
                'sample_description' => $row->sample_description,
                'test' => $this->Salmonella_pa_model->getTest(),
                );
                $this->template->load('template','salmonella_pa/index_det2', $data);
        }
        else {
            // $this->template->load('template','Water_sample_reception/index_det');
        }
    }     


    public function save() {
        $mode = $this->input->post('mode', TRUE);
        $id_salmonella_pa = $this->input->post('id_salmonella_pa', TRUE);
        $dt = new DateTime();
    
        $id_one_water_sample = $this->input->post('id_one_water_sample', TRUE);
        $idx_one_water_sample = $this->input->post('idx_one_water_sample', TRUE);
        $id_person = $this->input->post('id_person', TRUE);
        $id_sampletype = $this->input->post('id_sampletype', TRUE);
        $number_of_tubes = $this->input->post('number_of_tubes', TRUE);
        $number_of_tubes1 = $this->input->post('number_of_tubes1', TRUE);
        $mpn_pcr_conducted = $this->input->post('mpn_pcr_conducted', TRUE);
        $salmonella_assay_barcode = $this->input->post('salmonella_assay_barcode', TRUE);
        $date_sample_processed = $this->input->post('date_sample_processed', TRUE);
        $time_sample_processed = $this->input->post('time_sample_processed', TRUE);
        $sample_wetweight = $this->input->post('sample_wetweight', TRUE);
        // $elution_volume = $this->input->post('elution_volume', TRUE);
        $enrichment_media = $this->input->post('enrichment_media', TRUE) ? '1' : '0';
    
        if ($mode == "insert") {
            // Insert data into assays table
            $data = array(
                'id_one_water_sample' => $id_one_water_sample,
                'id_person' => $id_person,
                'id_sampletype' => $id_sampletype,
                'number_of_tubes' => $number_of_tubes,
                'mpn_pcr_conducted' => $mpn_pcr_conducted,
                'salmonella_assay_barcode' => $salmonella_assay_barcode,
                'date_sample_processed' => $date_sample_processed,
                'time_sample_processed' => $time_sample_processed,
                'sample_wetweight' => $sample_wetweight,
                // 'elution_volume' => $elution_volume,
                'enrichment_media' => $enrichment_media,
                'flag' => '0',
                'lab' => $this->session->userdata('lab'),
                'uuid' => $this->uuid->v4(),
                'user_created' => $this->session->userdata('id_users'),
                'date_created' => $dt->format('Y-m-d H:i:s'),
            );

            // var_dump($data);
            // die();
    
            $assay_id = $this->Salmonella_pa_model->insert($data);
    
            // Insert sample volumes
            $number_of_tubes = $this->input->post('number_of_tubes', TRUE);
            for ($i = 1; $i <= $number_of_tubes; $i++) {
                $volume = $this->input->post("vol_sampletube{$i}", TRUE);
                if ($volume !== null) {
                    $this->Salmonella_pa_model->insert_sample_volume(array(
                        'id_salmonella_pa' => $assay_id,
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
                'salmonella_assay_barcode' => $salmonella_assay_barcode,
                'date_sample_processed' => $date_sample_processed,
                'time_sample_processed' => $time_sample_processed,
                'sample_wetweight' => $sample_wetweight,
                // 'elution_volume' => $elution_volume,
                'enrichment_media' => $enrichment_media,
                'flag' => '0',
                'lab' => $this->session->userdata('lab'),
                'uuid' => $this->uuid->v4(),
                'user_updated' => $this->session->userdata('id_users'),
                'date_updated' => $dt->format('Y-m-d H:i:s'),
            );

            // var_dump($data);
            // die();

            $this->Salmonella_pa_model->updateSalmonella($id_salmonella_pa, $data);

            // Update sample volumes
            $number_of_tubes = $this->input->post('number_of_tubes1', TRUE);
            // var_dump($number_of_tubes); // var dump jumlah tube
            // die();
            $this->Salmonella_pa_model->delete_sample_volumes($id_salmonella_pa); // Hapus volume yang ada

            for ($i = 1; $i <= $number_of_tubes; $i++) {
                $volume = $this->input->post("vol_sampletube{$i}", TRUE);
                // var_dump($volume); // var dump volume pada setiap tube

                if ($volume !== null) {
                    $data_volume = array(
                        'id_salmonella_pa' => $id_salmonella_pa,
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
                    $this->Salmonella_pa_model->insert_sample_volume($data_volume);
                }
            }
    
            $this->session->set_flashdata('message', 'Update Record Success');
        }

        redirect(site_url("salmonella_pa"));
    }

    public function saveResultsXldAgar() {
        $mode = $this->input->post('mode_detResultsXldAgar', TRUE);
        $id_one_water_sample = $this->input->post('idXldAgar_one_water_sample', TRUE);
        $id_salmonella_pa = $this->input->post('id_salmonella_pa1', TRUE);
        $id_result_xld_agar_pa = $this->input->post('id_result_xld_agar_pa', TRUE);
        $dt = new DateTime();
        $date_sample_processed = $this->input->post('date_sample_processed1', TRUE);
        $time_sample_processed = $this->input->post('time_sample_processed1', TRUE);
        $quality_control = $this->input->post('quality_control', TRUE) ? 1 : 0; // Convert checkbox to integer
    
        if ($mode == "insert") {
            // Insert data into assays table
            $data = array(
                'id_salmonella_pa' => $id_salmonella_pa,
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

            $assay_id = $this->Salmonella_pa_model->insertResultsXldAgar($data);

            // Insert sample volumes
            $number_of_tubes = $this->input->post('number_of_tubes1', TRUE);
            for ($i = 1; $i <= $number_of_tubes; $i++) {
                $plate = $this->input->post("colony_plate{$i}", TRUE);
                if ($plate !== null) {
                    $this->Salmonella_pa_model->insert_black_plate(array(
                        'id_result_xld_agar_pa' => $assay_id,
                        'plate_number' => $i,
                        'black_colony_plate' => $plate,
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
                'id_salmonella_pa' => $id_salmonella_pa,
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

            $this->Salmonella_pa_model->updateResultsXldAgar($id_result_xld_agar_pa, $data);

            // Update sample volumes
            $number_of_tubes = $this->input->post('number_of_tubes1', TRUE);
            $this->Salmonella_pa_model->delete_black_plates($id_result_xld_agar_pa); // Hapus volume yang ada

            for ($i = 1; $i <= $number_of_tubes; $i++) {
                $plate = $this->input->post("black_colony_plate{$i}", TRUE);
                if ($plate !== null) {
                    $data_plate = array(
                        'id_result_xld_agar_pa' => $id_result_xld_agar_pa,
                        'plate_number' => $i,
                        'black_colony_plate' => $plate,
                        'flag' => '0',
                        'lab' => $this->session->userdata('lab'),
                        'uuid' => $this->uuid->v4(),
                        'user_created' => $this->session->userdata('id_users'),
                        'date_created' => $dt->format('Y-m-d H:i:s'),
                    );
                    $this->Salmonella_pa_model->insert_black_plate($data_plate);
                }
            }
    
            $this->session->set_flashdata('message', 'Update Record Success');
        }
    
        // Check if auto-generation of Chromagar results is needed
        $chromagar_auto_generated = false;
        if ($mode == "insert") {
            $chromagar_auto_generated = $this->autoGenerateChromagarResults($assay_id, $id_salmonella_pa);
        } else if ($mode == "edit") {
            $chromagar_auto_generated = $this->autoGenerateChromagarResults($id_result_xld_agar_pa, $id_salmonella_pa);
        }

        // Set appropriate flash message
        if ($chromagar_auto_generated) {
            if ($mode == "insert") {
                $this->session->set_flashdata('message', 'Create Record Success - Chromagar Results auto-generated');
            } else {
                $this->session->set_flashdata('message', 'Update Record Success - Chromagar Results auto-generated');
            }
        }

        // Try to auto-generate biochemical results if both XLD and Chromagar data exist
        $biochemical_result = $this->Salmonella_pa_model->checkAndAutoGenerateBiochemical($id_salmonella_pa);
        if ($biochemical_result) {
            if ($chromagar_auto_generated) {
                // Update flash message to include biochemical auto-generation
                if ($mode == "insert") {
                    $this->session->set_flashdata('message', 'Create Record Success - Chromagar and Biochemical Results auto-generated');
                } else {
                    $this->session->set_flashdata('message', 'Update Record Success - Chromagar and Biochemical Results auto-generated');
                }
            } else {
                // Just biochemical was auto-generated
                if ($mode == "insert") {
                    $this->session->set_flashdata('message', 'Create Record Success - Biochemical Results auto-generated');
                } else {
                    $this->session->set_flashdata('message', 'Update Record Success - Biochemical Results auto-generated');
                }
            }
        }

        redirect(site_url("salmonella_pa/read/" . $id_one_water_sample));
    }

    /**
     * Auto-generate Chromagar results when all purple plates are 0
     * Based on salmonella_pa implementation
     * Returns true if Chromagar was auto-generated, false otherwise
     */
    private function autoGenerateChromagarResults($id_result_xld_agar_pa, $id_salmonella_pa) {
        // Get all purple plates for this xld agar result
        $black_plates = $this->Salmonella_pa_model->get_black_plates_by_xld_agar($id_result_xld_agar_pa);

        if (empty($black_plates)) {
            return false; // No plates found, nothing to do
        }

        // Check if all black plates are 0
        $all_plates_zero = true;
        foreach ($black_plates as $plate) {
            if ($plate->black_colony_plate != '0') {
                $all_plates_zero = false;
                break;
            }
        }
        
        if (!$all_plates_zero) {
            return false; // Not all plates are 0, no auto-generation needed
        }

        // Check if Chromagar results already exist for this salmonella_pa
        $existing_chromagar = $this->Salmonella_pa_model->get_chromagar_by_salmonella_pa($id_salmonella_pa);
        if (!empty($existing_chromagar)) {
            return false; // Chromagar results already exist, don't auto-generate
        }
        
        $dt = new DateTime();

        // Auto-generate Chromagar result
        $chromagar_data = array(
            'id_salmonella_pa' => $id_salmonella_pa,
            'date_sample_processed' => date('Y-m-d'),
            'time_sample_processed' => date('H:i:s'),
            'quality_control' => 0, // Default 0 for auto-generated Chromagar
            'flag' => '0',
            'lab' => $this->session->userdata('lab'),
            'uuid' => $this->uuid->v4(),
            'user_created' => $this->session->userdata('id_users'),
            'date_created' => $dt->format('Y-m-d H:i:s'),
        );

        $chromagar_id = $this->Salmonella_pa_model->insertResultsChromagar($chromagar_data);

        if ($chromagar_id) {
            // Auto-generate Chromagar black plates (all 0 since parent plates were all 0)
            $number_of_plates = count($black_plates);
            for ($i = 1; $i <= $number_of_plates; $i++) {
                $this->Salmonella_pa_model->insert_purple_plate_chromagar(array(
                    'id_result_chromagar_pa' => $chromagar_id,
                    'plate_number' => $i,
                    'purple_colony_plate' => '0',
                    'flag' => '0',
                    'lab' => $this->session->userdata('lab'),
                    'uuid' => $this->uuid->v4(),
                    'user_created' => $this->session->userdata('id_users'),
                    'date_created' => $dt->format('Y-m-d H:i:s'),
                ));
            }

            log_message('info', "Auto-generated Chromagar results for salmonella_pa ID {$id_salmonella_pa} with {$number_of_plates} plates (all 0)");
            return true; // Auto-generation successful
        }
        
        return false; // Auto-generation failed
    }

    public function saveResultsChromagar() {
        $mode = $this->input->post('mode_detResultsChromagar', TRUE);
        $id_one_water_sample = $this->input->post('idChromagar_one_water_sample', TRUE);
        $id_salmonella_pa = $this->input->post('id_salmonella_paChromagar', TRUE);
        $id_result_chromagar_pa = $this->input->post('id_result_chromagar_pa', TRUE);

        $dt = new DateTime();
        $date_sample_processed = $this->input->post('date_sample_processedChromagar', TRUE);
        $time_sample_processed = $this->input->post('time_sample_processedChromagar', TRUE);
        $quality_control = $this->input->post('quality_control_chromagar', TRUE) ? 1 : 0; // Convert checkbox to integer
    
        if ($mode == "insert") {
            // Insert data into assays table
            $data = array(
                'id_salmonella_pa' => $id_salmonella_pa,
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

            $assay_id = $this->Salmonella_pa_model->insertResultsChromagar($data);

            // Insert sample volumes
            $number_of_tubes = $this->input->post('number_of_tubesChromagar', TRUE);
            for ($i = 1; $i <= $number_of_tubes; $i++) {
                $plate = $this->input->post("purple_colony_plate{$i}", TRUE);

                if ($plate !== null) {
                    $this->Salmonella_pa_model->insert_purple_plate_chromagar(array(
                        'id_result_chromagar_pa' => $assay_id,
                        'plate_number' => $i,
                        'purple_colony_plate' => $plate,
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
                'id_salmonella_pa' => $id_salmonella_pa,
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

            $this->Salmonella_pa_model->updateResultsChromagar($id_result_chromagar_pa, $data);

            // Update sample volumes
            $number_of_tubes = $this->input->post('number_of_tubesChromagar', TRUE);
            $this->Salmonella_pa_model->delete_purple_plates_chromagar($id_result_chromagar_pa); // Hapus volume yang ada

            for ($i = 1; $i <= $number_of_tubes; $i++) {
                $plate = $this->input->post("purple_colony_plate{$i}", TRUE);
                if ($plate !== null) {
                    $data_plate = array(
                        'id_result_chromagar_pa' => $id_result_chromagar_pa,
                        'plate_number' => $i,
                        'purple_colony_plate' => $plate,
                        'flag' => '0',
                        'lab' => $this->session->userdata('lab'),
                        'uuid' => $this->uuid->v4(),
                        'user_created' => $this->session->userdata('id_users'),
                        'date_created' => $dt->format('Y-m-d H:i:s'),
                    );
                    $this->Salmonella_pa_model->insert_purple_plate_chromagar($data_plate);
                }
            }
    
            $this->session->set_flashdata('message', 'Update Record Success');
        }

        // Try to auto-generate biochemical results if both XLD and Chromagar data exist
        $biochemical_result = $this->Salmonella_pa_model->checkAndAutoGenerateBiochemical($id_salmonella_pa);
        if ($biochemical_result) {
            // Update flash message to include biochemical auto-generation
            if ($mode == "insert") {
                $this->session->set_flashdata('message', 'Create Record Success - Biochemical Results auto-generated');
            } else {
                $this->session->set_flashdata('message', 'Update Record Success - Biochemical Results auto-generated');
            }
        }

        redirect(site_url("salmonella_pa/read/" . $id_one_water_sample));
    }


    public function saveBiochemical() {
        $mode = $this->input->post('mode_detResultsBiochemical', TRUE);
        $id_result_biochemical_pa = $this->input->post('id_result_biochemical_pa', TRUE);
        $id_result_chromagar_pa = $this->input->post('id_result_chromagar_pa1', TRUE);
        $id_salmonella_pa = $this->input->post('id_salmonella_paBiochemical', TRUE);
        $confirmation = $this->input->post('confirmation', TRUE);
        $biochemical_tube = $this->input->post('biochemical_tube', TRUE);
        $id_one_water_sample = $this->input->post('idBiochemical_one_water_sample', TRUE);

        if ($mode == "insert") {
            $data = array(
                'id_salmonella_pa' => $id_salmonella_pa,
                'id_result_chromagar_pa' => $id_result_chromagar_pa,
                'confirmation' => $confirmation,
                'biochemical_tube' => $biochemical_tube,
                'flag' => '0',
                'lab' => $this->session->userdata('lab'),
                'uuid' => $this->uuid->v4(),
                'user_created' => $this->session->userdata('id_users'),
                'date_created' => date('Y-m-d H:i:s'),
            );
            // var_dump($data);
            // die();
            $this->Salmonella_pa_model->insertResultsBiochemical($data);
        } else if ($mode == "edit") {
            $data = array(
                'id_salmonella_pa' => $id_salmonella_pa,
                'id_result_chromagar_pa' => $id_result_chromagar_pa,
                'confirmation' => $confirmation,
                'flag' => '0',
                'lab' => $this->session->userdata('lab'),
                'uuid' => $this->uuid->v4(),
                'user_updated' => $this->session->userdata('id_users'),
                'date_updated' => date('Y-m-d H:i:s'),
            );

            // var_dump($data);
            // die();
            $this->Salmonella_pa_model->updateResultsBiochemical($id_result_biochemical_pa, $data);
        }

        redirect(site_url("salmonella_pa/read/" . $id_one_water_sample));
    }

    public function getBiochemicalData() {
        $id_salmonella_pa = $this->input->post('id_salmonella_pa', TRUE);
        
        if (empty($id_salmonella_pa)) {
            echo json_encode(array('success' => false, 'message' => 'Missing Salmonella PA ID'));
            return;
        }

        try {
            // Get XLD Agar results (black colony values)
            $xld_results = $this->Salmonella_pa_model->getXldAgarResults($id_salmonella_pa);
            
            // Get Chromagar results (purple colony values)  
            $chromagar_results = $this->Salmonella_pa_model->getChromagarResults($id_salmonella_pa);
            
            if (empty($xld_results) || empty($chromagar_results)) {
                echo json_encode(array(
                    'success' => false, 
                    'message' => 'Missing XLD Agar or Chromagar results. Please complete these first.'
                ));
                return;
            }

            // Get the first result as we need one to determine biochemical values
            $xld_black_colony = 0;
            $chrom_purple_colony = 0;

            // Check if any XLD result has black colony = 1
            foreach ($xld_results as $xld) {
                if (!empty($xld->black_colony_plate)) {
                    $black_colonies = explode(', ', $xld->black_colony_plate);
                    if (in_array('1', $black_colonies)) {
                        $xld_black_colony = 1;
                        break;
                    }
                }
            }

            // Check if any Chromagar result has purple colony = 1  
            foreach ($chromagar_results as $chromagar) {
                if (!empty($chromagar->purple_colony_plate)) {
                    $purple_colonies = explode(', ', $chromagar->purple_colony_plate);
                    if (in_array('1', $purple_colonies)) {
                        $chrom_purple_colony = 1;
                        break;
                    }
                }
            }

            echo json_encode(array(
                'success' => true,
                'xld_black_colony' => $xld_black_colony,
                'chrom_purple_colony' => $chrom_purple_colony,
                'message' => 'Data retrieved successfully'
            ));

        } catch (Exception $e) {
            echo json_encode(array(
                'success' => false, 
                'message' => 'Error fetching data: ' . $e->getMessage()
            ));
        }
    }

    public function triggerBiochemicalAutoGeneration() {
        $id_salmonella_pa = $this->input->post('id_salmonella_pa', TRUE);
        
        if (empty($id_salmonella_pa)) {
            echo json_encode(array('success' => false, 'message' => 'Missing Salmonella PA ID'));
            return;
        }

        $result = $this->Salmonella_pa_model->checkAndAutoGenerateBiochemical($id_salmonella_pa);
        
        if ($result) {
            echo json_encode(array(
                'success' => true, 
                'message' => 'Biochemical results auto-generated successfully',
                'action' => $result
            ));
        } else {
            echo json_encode(array(
                'success' => false, 
                'message' => 'Cannot auto-generate biochemical results. Both XLD and Chromagar results are required.'
            ));
        }
    }


    public function delete_salmonellaPA($id) {
        $row = $this->Salmonella_pa_model->get_by_id_salmonella_pa($id);
        if ($row) {
            $id_parent = $row->id_result_xld_agar_pa; // Retrieve project_id before updating the record
            $data = array(
                'flag' => 1,
            );

            $this->Salmonella_pa_model->updateSalmonellaPA($id, $data);
            $this->Salmonella_pa_model->updateSampleVolume($id, $data);
            $this->session->set_flashdata('message', 'Delete Record Success');
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
        }

        redirect(site_url('salmonella_pa/read/'.$id_parent));
    }

    public function delete_detailXldAgar($id) {
        $row = $this->Salmonella_pa_model->get_by_id_xld_agar($id);
        if ($row) {
            $id_salmonella_pa = $row->id_salmonella_pa;
            $data = array(
                'flag' => 1,
            );

            // Step 1: Get all Chromagar results related to this salmonella_pa
            $chromagar_results = $this->Salmonella_pa_model->get_chromagar_by_xld_agar_id($id_salmonella_pa);
            $total_biochemical_deleted = 0;
            $total_chromagar_deleted = 0;

            // Step 2: For each Chromagar, delete related biochemical results
            foreach ($chromagar_results as $chromagar) {
                $biochemical_results = $this->Salmonella_pa_model->get_biochemical_by_chromagar_id($chromagar->id_result_chromagar_pa);
                $biochemical_count = count($biochemical_results);
                
                if ($biochemical_count > 0) {
                    $this->Salmonella_pa_model->delete_biochemical_by_chromagar_id($chromagar->id_result_chromagar_pa);
                    $total_biochemical_deleted += $biochemical_count;
                    
                    // Log the cascade delete
                    log_message('info', "Cascade delete: Deleted {$biochemical_count} biochemical results for Chromagar ID {$chromagar->id_result_chromagar_pa}");
                }

                $total_chromagar_deleted++;
            }

            // Step 3: Delete all Chromagar results for this salmonella_pa
            if ($total_chromagar_deleted > 0) {
                $this->Salmonella_pa_model->delete_chromagar_by_salmonella_pa($id_salmonella_pa);
                log_message('info', "Cascade delete: Deleted {$total_chromagar_deleted} Chromagar results for salmonella_pa ID {$id_salmonella_pa}");
            }

            // Step 4: Delete the xld_agar results
            $this->Salmonella_pa_model->updateResultsXldAgar($id, $data);
            $this->Salmonella_pa_model->updateResultsGrowthPlate($id, $data);
            
            // Create detailed success message
            $message = 'XLD Agar result deleted successfully';
            if ($total_chromagar_deleted > 0) {
                $message .= " (Also deleted {$total_chromagar_deleted} Chromagar result(s)";
                if ($total_biochemical_deleted > 0) {
                    $message .= " and {$total_biochemical_deleted} biochemical result(s)";
                }
                $message .= ')';
            }
            
            $this->session->set_flashdata('message', $message);
            log_message('info', "Cascade delete completed: XldAgar ID {$id} - {$message}");
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
        }

        redirect(site_url('salmonella_pa/read/'.$row->id_salmonella_pa));
    }

    public function delete_detailChromagar($id) {
        $row = $this->Salmonella_pa_model->get_by_id_chromagar($id);
        if ($row) {
            $id_salmonella_pa = $row->id_salmonella_pa; // Get salmonella_pa ID for redirect
            $data = array(
                'flag' => 1,
            );

            // First, check if there are any biochemical results related to this Chromagar
            $biochemical_results = $this->Salmonella_pa_model->get_biochemical_by_chromagar_id($id);
            $biochemical_count = count($biochemical_results);

            // Delete Chromagar results (purple plates and main record)
            $this->Salmonella_pa_model->updateResultsChromagar($id, $data);
            $this->Salmonella_pa_model->updateResultsPurplePlateChromagar($id, $data);

            // Cascade delete: Delete all related biochemical results
            if ($biochemical_count > 0) {
                $biochemical_deleted = $this->Salmonella_pa_model->delete_biochemical_by_chromagar_id($id);
                if ($biochemical_deleted) {
                    $this->session->set_flashdata('message', 
                        "Delete Record Success - Chromagar and {$biochemical_count} related Biochemical test(s) deleted to maintain data integrity");
                } else {
                    $this->session->set_flashdata('message', 
                        'Chromagar deleted successfully, but failed to delete related Biochemical tests. Please check data consistency.');
                }
            } else {
                $this->session->set_flashdata('message', 'Delete Record Success');
            }
            
            // Log the cascade delete for audit purposes
            log_message('info', "Chromagar Record deleted (ID: {$id}) with cascade delete of {$biochemical_count} biochemical records");
            
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
        }

        redirect(site_url('salmonella_pa/read/'.$id_salmonella_pa));
    }

    public function delete_detailBiochemical($id) {
        $row = $this->Salmonella_pa_model->get_by_id_biochemical($id);
        if ($row) {
            $id_parent = $row->id_result_xld_agar_pa; // Retrieve project_id before updating the record
            $data = array(
                'flag' => 1,
            );
    
            $this->Salmonella_pa_model->updateResultsBiochemical($id, $data);
            $this->session->set_flashdata('message', 'Delete Record Success');
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
        }

        redirect(site_url('salmonella_pa/read/'.$id_parent));
    }


    public function getIdOneWaterDetails()
    {
        $idOneWaterSample = $this->input->post('id_one_water_sample');
        $oneWaterSample = $this->Salmonella_pa_model->getOneWaterSampleById($idOneWaterSample);
        echo json_encode($oneWaterSample);
    }

    public function validate24() {
        $id = $this->input->get('id24');
        $data = $this->Salmonella_pa_model->validate24($id);
        header('Content-Type: application/json');
        echo json_encode($data);
    }

    public function validate72() {
        $id = $this->input->get('id72');
        $data = $this->Salmonella_pa_model->validate72($id);
        header('Content-Type: application/json');
        echo json_encode($data);
    }


    public function excel($id) {
        $spreadsheet = new Spreadsheet();    
        $sheet = $spreadsheet->getActiveSheet();
    
        // Set the headers
        $sheet->setCellValue('A1', "ID One Water Sample");
        $sheet->setCellValue('B1', "Salmonella Assay Barcode");
        $sheet->setCellValue('C1', "Initial");
        $sheet->setCellValue('D1', "Sample Type");
        $sheet->setCellValue('E1', "Number of Tubes");
        $sheet->setCellValue('F1', "MPN PCR Conducted");
        $sheet->setCellValue('G1', "Date Sample Processed");
        $sheet->setCellValue('H1', "Time Sample Processed");
        $sheet->setCellValue('I1', "Sample Wet Weight");
        $sheet->setCellValue('J1', "Elution Volume");
    
        // Fetch the concentration data
        $finalConcentration = $this->Salmonella_pa_model->get_export($id);
    
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
            $sheet->setCellValue('B' . $numrow, $concentration->salmonella_assay_barcode ?? '');
            $sheet->setCellValue('C' . $numrow, $concentration->initial ?? '');
            $sheet->setCellValue('D' . $numrow, $concentration->sampletype ?? '');
            $sheet->setCellValue('E' . $numrow, $concentration->number_of_tubes ?? '');
            $sheet->setCellValue('F' . $numrow, $concentration->mpn_pcr_conducted ?? '');
            $sheet->setCellValue('G' . $numrow, $concentration->date_sample_processed ?? '');
            $sheet->setCellValue('H' . $numrow, $concentration->time_sample_processed ?? '');
            $sheet->setCellValue('I' . $numrow, $concentration->sample_wetweight ?? '');
            $sheet->setCellValue('J' . $numrow, $concentration->enrichment_media ?? '');
    
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
        header('Content-Disposition: attachment;filename="Report_PA_Final_Concentrations.xlsx"');
        header('Cache-Control: max-age=0');
    
        // Output the Excel file
        $writer = new Xlsx($spreadsheet);
        $writer->save('php://output');
    }

    public function excel_all() {
        $spreadsheet = new Spreadsheet();
        $finalConcentration = $this->Salmonella_pa_model->get_all_export();
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
        header('Content-Disposition: attachment;filename="Report_All_PA_Final_Concentrations.xlsx"');
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
        $sheet->setCellValue('B1', "Salmonella Assay Barcode");
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
            $sheet->setCellValue('B' . $numrow, $concentration->salmonella_assay_barcode ?? '');
            $sheet->setCellValue('C' . $numrow, $concentration->initial ?? '');
            $sheet->setCellValue('D' . $numrow, $concentration->sampletype ?? '');
            $sheet->setCellValue('E' . $numrow, $concentration->number_of_tubes ?? '');
            $sheet->setCellValue('F' . $numrow, $concentration->mpn_pcr_conducted ?? '');
            $sheet->setCellValue('G' . $numrow, $concentration->date_sample_processed ?? '');
            $sheet->setCellValue('H' . $numrow, $concentration->time_sample_processed ?? '');
            $sheet->setCellValue('I' . $numrow, $concentration->sample_wetweight ?? '');
            $sheet->setCellValue('J' . $numrow, $concentration->enrichment_media ?? '');
    
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

    public function validateSalmonellaAssayBarcode() {
        $id = $this->input->get('id');
        $data = $this->Salmonella_pa_model->validateSalmonellaAssayBarcode($id);
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

        $this->load->model('Salmonella_pa_model');

        try {
            $this->Salmonella_pa_model->update_salmonella_pa($id, $data);
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
        $this->load->model('Salmonella_pa_model');
        $updateResult = $this->Salmonella_pa_model->updateCancel($id, $data);

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