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
    
class Salmonella_liquids extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        is_login();
        $this->load->model('Salmonella_liquids_model');
        $this->load->library('form_validation');        
	    $this->load->library('datatables');
	    $this->load->library('uuid');
    }

    public function index()
    {
        $data['id_one'] = $this->Salmonella_liquids_model->getID_one();
        $data['sampletype'] = $this->Salmonella_liquids_model->getSampleType();
        $data['labtech'] = $this->Salmonella_liquids_model->getLabTech();
        $data['tubes'] = $this->Salmonella_liquids_model->getTubes();
        $this->template->load('template','salmonella_liquids/index', $data);
    } 
    
    public function json() {
        header('Content-Type: application/json');
        echo $this->Salmonella_liquids_model->json();
    }

    public function subjsonXld() {
        $id = $this->input->get('idXld',TRUE);
        header('Content-Type: application/json');
        echo $this->Salmonella_liquids_model->subjsonXld($id);
    }

    public function subjsonChromagar() {
        $id = $this->input->get('idChromagar',TRUE);
        header('Content-Type: application/json');
        echo $this->Salmonella_liquids_model->subjsonChromagar($id);
    }

    public function subjsonBiochemical() {
        $id = $this->input->get('idBiochemical',TRUE);
        $biochemical_tube = $this->input->get('biochemical_tube', TRUE);
        header('Content-Type: application/json');
        echo $this->Salmonella_liquids_model->subjsonBiochemical($id, $biochemical_tube);
    }

    public function read($id)
    {
        $row = $this->Salmonella_liquids_model->get_detail($id);

        if ($row) {
            $data = array(

                'id_salmonella_liquids' => $row->id_salmonella_liquids,
                'id_one_water_sample' => $row->id_one_water_sample,
                'initial' => $row->initial,
                'sampletype' => $row->sampletype,
                'number_of_tubes' => $row->number_of_tubes,
                'mpn_pcr_conducted' => $row->mpn_pcr_conducted,
                'salmonella_assay_barcode' => $row->salmonella_assay_barcode,
                'date_sample_processed' => $row->date_sample_processed,
                'time_sample_processed' => $row->time_sample_processed,
                // 'sample_wetweight' => $row->sample_wetweight,
                'elution_volume' => $row->elution_volume,
                'enrichment_media' => $row->enrichment_media,
                'vol_sampletube' => $row->vol_sampletube,
                'tube_number' => $row->tube_number,
                'full_name' => $row->full_name,
                'user_review' => $row->user_review,
                'review' => $row->review,
                'user_created' => $row->user_created,
                
            );
            
            // Mendapatkan final concentration
            $finalConcentration = $this->Salmonella_liquids_model->subjsonFinalConcentration($row->id_salmonella_liquids);
            if ($finalConcentration) {
                $data['finalConcentration'] = $finalConcentration;
            } else {
                $data['finalConcentration'] = []; // Pastikan ini tidak null
            }
            // var_dump($data);
            // die();
            $this->template->load('template','salmonella_liquids/index_det', $data);

        }
        else {
            // $this->template->load('template','Water_sample_reception/index_det', $test);
        }

    } 

    public function read2($id)
    {
        $data['test'] = $this->Salmonella_liquids_model->getTest();
        $row = $this->Salmonella_liquids_model->get_detail2($id);
        if ($row) {
            $data = array(
                'id_project' => $row->id_project,
                'id_sample' => $row->id_sample,
                'sample_description' => $row->sample_description,
                'test' => $this->Salmonella_liquids_model->getTest(),
                );
                $this->template->load('template','salmonella_liquids/index_det2', $data);
        }
        else {
            // $this->template->load('template','Water_sample_reception/index_det');
        }
    }     


    public function save() {
        $mode = $this->input->post('mode', TRUE);
        $id_salmonella_liquids = $this->input->post('id_salmonella_liquids', TRUE);
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
        // $sample_wetweight = $this->input->post('sample_wetweight', TRUE);
        $elution_volume = $this->input->post('elution_volume', TRUE);
        $enrichment_media = $this->input->post('enrichment_media', TRUE) ? '1' : '0';
        $review = $this->input->post('review', TRUE);
        $user_review = $this->input->post('user_review', TRUE);
    
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
                // 'sample_wetweight' => $sample_wetweight,
                'elution_volume' => $elution_volume,
                'enrichment_media' => $enrichment_media,
                'flag' => '0',
                'lab' => $this->session->userdata('lab'),
                'uuid' => $this->uuid->v4(),
                'user_created' => $this->session->userdata('id_users'),
                'date_created' => $dt->format('Y-m-d H:i:s'),
            );

            // var_dump($data);
            // die();
    
            $assay_id = $this->Salmonella_liquids_model->insert($data);
    
            // Insert sample volumes
            $number_of_tubes = $this->input->post('number_of_tubes', TRUE);
            for ($i = 1; $i <= $number_of_tubes; $i++) {
                $volume = $this->input->post("vol_sampletube{$i}", TRUE);
                if ($volume) {
                    $this->Salmonella_liquids_model->insert_sample_volume(array(
                        'id_salmonella_liquids' => $assay_id,
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
                // 'sample_wetweight' => $sample_wetweight,
                'elution_volume' => $elution_volume,
                'enrichment_media' => $enrichment_media,
                // 'review' => $review,
                // 'user_review' => $user_review,
                'flag' => '0',
                'lab' => $this->session->userdata('lab'),
                'uuid' => $this->uuid->v4(),
                'user_updated' => $this->session->userdata('id_users'),
                'date_updated' => $dt->format('Y-m-d H:i:s'),
            );

            // var_dump($data);
            // die();
    
            $this->Salmonella_liquids_model->updateSalmonellaLiquids($id_salmonella_liquids, $data);
    
            // Update sample volumes
            $number_of_tubes = $this->input->post('number_of_tubes1', TRUE);
            // var_dump($number_of_tubes); // var dump jumlah tube
            // die();
            $this->Salmonella_liquids_model->delete_sample_volumes($id_salmonella_liquids); // Hapus volume yang ada

            for ($i = 1; $i <= $number_of_tubes; $i++) {
                $volume = $this->input->post("vol_sampletube{$i}", TRUE);
                // var_dump($volume); // var dump volume pada setiap tube

                if ($volume) {
                    $data_volume = array(
                        'id_salmonella_liquids' => $id_salmonella_liquids,
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
                    $this->Salmonella_liquids_model->insert_sample_volume($data_volume);
                }
            }
    
            $this->session->set_flashdata('message', 'Update Record Success');
        }
    
        redirect(site_url("salmonella_liquids"));
    }

    // public function saveResultsXld() {
    //     $mode = $this->input->post('mode_detResultsXld', TRUE);
    //     $id_salmonella_liquids = $this->input->post('id_salmonella_liquids1', TRUE);
    //     $id_result_xld = $this->input->post('id_result_xld', TRUE);
    //     $dt = new DateTime();
    //     $date_sample_processed = $this->input->post('date_sample_processed1', TRUE);
    //     $time_sample_processed = $this->input->post('time_sample_processed1', TRUE);
    
    //     if ($mode == "insert") {
    //         // Insert data into assays table
    //         $data = array(
    //             'id_salmonella_liquids' => $id_salmonella_liquids,
    //             'date_sample_processed' => $date_sample_processed,
    //             'time_sample_processed' => $time_sample_processed,
    //             'flag' => '0',
    //             'lab' => $this->session->userdata('lab'),
    //             'uuid' => $this->uuid->v4(),
    //             'user_created' => $this->session->userdata('id_users'),
    //             'date_created' => $dt->format('Y-m-d H:i:s'),
    //         );

    //         // var_dump($data);
    //         // die();
    
    //         $assay_id = $this->Salmonella_liquids_model->insertResultsXld($data);
    
    //         // Insert sample volumes
    //         $number_of_tubes = $this->input->post('number_of_tubes1', TRUE);
    //         for ($i = 1; $i <= $number_of_tubes; $i++) {
    //             $plate = $this->input->post("colony_plate{$i}", TRUE);
    //             if ($plate !== null) {
    //                 $this->Salmonella_liquids_model->insert_purple_colony_plate(array(
    //                     'id_result_xld' => $assay_id,
    //                     'plate_number' => $i,
    //                     'purple_colony_plate' => $plate,
    //                     'flag' => '0',
    //                     'lab' => $this->session->userdata('lab'),
    //                     'uuid' => $this->uuid->v4(),
    //                     'user_created' => $this->session->userdata('id_users'),
    //                     'date_created' => $dt->format('Y-m-d H:i:s'),
    //                 ));
    //             }
    //         }
    
    //         $this->session->set_flashdata('message', 'Create Record Success');
    
    //     } else if ($mode == "edit") {
    //         // Update data in assays table
    //         $data = array(
    //             'id_salmonella_liquids' => $id_salmonella_liquids,
    //             'date_sample_processed' => $date_sample_processed,
    //             'time_sample_processed' => $time_sample_processed,
    //             'flag' => '0',
    //             'lab' => $this->session->userdata('lab'),
    //             'uuid' => $this->uuid->v4(),
    //             'user_updated' => $this->session->userdata('id_users'),
    //             'date_updated' => $dt->format('Y-m-d H:i:s'),
    //         );

    //         // var_dump($data);
    //         // die();
    
    //         $this->Salmonella_liquids_model->updateResultsXld($id_result_xld, $data);

    //         // Update sample volumes
    //         $number_of_tubes = $this->input->post('number_of_tubes1', TRUE);
    //         $this->Salmonella_liquids_model->delete_purple_colony_plates($id_result_xld); // Hapus volume yang ada

    //         for ($i = 1; $i <= $number_of_tubes; $i++) {
    //             $plate = $this->input->post("purple_colony_plate{$i}", TRUE);
    //             if ($plate !== null) {
    //                 $data_plate = array(
    //                     'id_result_xld' => $id_result_xld,
    //                     'plate_number' => $i,
    //                     'purple_colony_plate' => $plate,
    //                     'flag' => '0',
    //                     'lab' => $this->session->userdata('lab'),
    //                     'uuid' => $this->uuid->v4(),
    //                     'user_created' => $this->session->userdata('id_users'),
    //                     'date_created' => $dt->format('Y-m-d H:i:s'),
    //                 );
    //                 $this->Salmonella_liquids_model->insert_purple_colony_plate($data_plate);
    //             }
    //         }
    
    //         $this->session->set_flashdata('message', 'Update Record Success');
    //     }
    
    //     redirect(site_url("salmonella_liquids/read/" . $id_salmonella_liquids));
    // }

    public function saveResultsXld() {
        $mode = $this->input->post('mode_detResultsXld', TRUE);
        $id_one_water_sample = $this->input->post('idXld_one_water_sample', TRUE);
        $id_salmonella_liquids = $this->input->post('id_salmonella_liquids1', TRUE);
        $id_result_xld = $this->input->post('id_result_xld', TRUE);
        $dt = new DateTime();
        $date_sample_processed = $this->input->post('date_sample_processed1', TRUE);
        $time_sample_processed = $this->input->post('time_sample_processed1', TRUE);
        $quality_control = $this->input->post('quality_control_xld', TRUE) ? 1 : 0; // Convert checkbox to integer
    
        if ($mode == "insert") {
            // Insert data into assays table
            $data = array(
                'id_salmonella_liquids' => $id_salmonella_liquids,
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
    
            $assay_id = $this->Salmonella_liquids_model->insertResultsXld($data);
    
            // Insert sample volumes
            $number_of_tubes = $this->input->post('number_of_tubes1', TRUE);
            for ($i = 1; $i <= $number_of_tubes; $i++) {
                $plate = $this->input->post("colony_plate{$i}", TRUE);
                if ($plate !== null) {
                    $this->Salmonella_liquids_model->insert_black_colony_plate_chromagar(array(
                        'id_result_xld' => $assay_id,
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

            // Check if all XLD results are 0 for auto-save ChroMagar logic
            $this->autoSaveChromagarIfAllZero($id_salmonella_liquids, $number_of_tubes, $date_sample_processed, $time_sample_processed);

            // Auto-update biochemical results when XLD data is created
            $this->autoUpdateBiochemicalFromXldChange($id_salmonella_liquids, $number_of_tubes);
    
        } else if ($mode == "edit") {
            // Update data in assays table
            $data = array(
                'id_salmonella_liquids' => $id_salmonella_liquids,
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
    
            $this->Salmonella_liquids_model->updateResultsXld($id_result_xld, $data);

            // Update sample volumes
            $number_of_tubes = $this->input->post('number_of_tubes1', TRUE);
            $this->Salmonella_liquids_model->delete_black_colony_plates_chromagar($id_result_xld); // Hapus volume yang ada

            for ($i = 1; $i <= $number_of_tubes; $i++) {
                $plate = $this->input->post("black_colony_plate{$i}", TRUE);
                if ($plate !== null) {
                    $data_plate = array(
                        'id_result_xld' => $id_result_xld,
                        'plate_number' => $i,
                        'black_colony_plate' => $plate,
                        'flag' => '0',
                        'lab' => $this->session->userdata('lab'),
                        'uuid' => $this->uuid->v4(),
                        'user_created' => $this->session->userdata('id_users'),
                        'date_created' => $dt->format('Y-m-d H:i:s'),
                    );
                    $this->Salmonella_liquids_model->insert_black_colony_plate_Chromagar($data_plate);
                }
            }
    
            $this->session->set_flashdata('message', 'Update Record Success');
        }

        // Check if all XLD results are 0 for auto-save ChroMagar logic
        $this->autoSaveChromagarIfAllZero($id_salmonella_liquids, $number_of_tubes, $date_sample_processed, $time_sample_processed);

        // Auto-update biochemical results when XLD data changes
        $this->autoUpdateBiochemicalFromXldChange($id_salmonella_liquids, $number_of_tubes);
    
        redirect(site_url("salmonella_liquids/read/" . $id_one_water_sample));
    }

    // public function saveResultsChromagar() {
    //     $mode = $this->input->post('mode_detResultsChromagar', TRUE);
    //     $id_salmonella_liquids = $this->input->post('id_salmonella_liquidsChromagar', TRUE);
    //     $id_result_chromagar = $this->input->post('id_result_chromagar', TRUE);

    //     $dt = new DateTime();
    //     $date_sample_processed = $this->input->post('date_sample_processedChromagar', TRUE);
    //     $time_sample_processed = $this->input->post('time_sample_processedChromagar', TRUE);
    
    //     if ($mode == "insert") {
    //         // Insert data into assays table
    //         $data = array(
    //             'id_salmonella_liquids' => $id_salmonella_liquids,
    //             'date_sample_processed' => $date_sample_processed,
    //             'time_sample_processed' => $time_sample_processed,
    //             'flag' => '0',
    //             'lab' => $this->session->userdata('lab'),
    //             'uuid' => $this->uuid->v4(),
    //             'user_created' => $this->session->userdata('id_users'),
    //             'date_created' => $dt->format('Y-m-d H:i:s'),
    //         );

    //         // var_dump($data);
    //         // die();
    
    //         $assay_id = $this->Salmonella_liquids_model->insertResultsChromagar($data);
    
    //         // Insert sample volumes
    //         $number_of_tubes = $this->input->post('number_of_tubesChromagar', TRUE);
    //         for ($i = 1; $i <= $number_of_tubes; $i++) {
    //             $plate = $this->input->post("black_colony_plate{$i}", TRUE);

    //             if ($plate) {
    //                 $this->Salmonella_liquids_model->insert_black_colony_plate_chromagar(array(
    //                     'id_result_chromagar' => $assay_id,
    //                     'plate_number' => $i,
    //                     'black_colony_plate' => $plate,
    //                     'flag' => '0',
    //                     'lab' => $this->session->userdata('lab'),
    //                     'uuid' => $this->uuid->v4(),
    //                     'user_created' => $this->session->userdata('id_users'),
    //                     'date_created' => $dt->format('Y-m-d H:i:s'),
    //                 ));
    //             }

    //         }
    
    //         $this->session->set_flashdata('message', 'Create Record Success');
    
    //     } else if ($mode == "edit") {
    //         // Update data in assays table
    //         $data = array(
    //             'id_salmonella_liquids' => $id_salmonella_liquids,
    //             'date_sample_processed' => $date_sample_processed,
    //             'time_sample_processed' => $time_sample_processed,
    //             'flag' => '0',
    //             'lab' => $this->session->userdata('lab'),
    //             'uuid' => $this->uuid->v4(),
    //             'user_updated' => $this->session->userdata('id_users'),
    //             'date_updated' => $dt->format('Y-m-d H:i:s'),
    //         );
    
    //         $this->Salmonella_liquids_model->updateResultsChromagar($id_result_chromagar, $data);
    
    //         // Update sample volumes
    //         $number_of_tubes = $this->input->post('number_of_tubesChromagar', TRUE);
    //         $this->Salmonella_liquids_model->delete_black_colony_plates_chromagar($id_result_chromagar); // Hapus volume yang ada
    
    //         for ($i = 1; $i <= $number_of_tubes; $i++) {
    //             $plate = $this->input->post("black_colony_plate{$i}", TRUE);
    //             if ($plate) {
    //                 $data_plate = array(
    //                     'id_result_chromagar' => $id_result_chromagar,
    //                     'plate_number' => $i,
    //                     'black_colony_plate' => $plate,
    //                     'flag' => '0',
    //                     'lab' => $this->session->userdata('lab'),
    //                     'uuid' => $this->uuid->v4(),
    //                     'user_created' => $this->session->userdata('id_users'),
    //                     'date_created' => $dt->format('Y-m-d H:i:s'),
    //                 );
    //                 $this->Salmonella_liquids_model->insert_black_colony_plate_Chromagar($data_plate);
    //             }
    //         }
    
    //         $this->session->set_flashdata('message', 'Update Record Success');
    //     }
    
    //     redirect(site_url("salmonella_liquids/read/" . $id_salmonella_liquids));
    // }
    public function saveResultsChromagar() {
        $mode = $this->input->post('mode_detResultsChromagar', TRUE);
        $id_one_water_sample = $this->input->post('idChromagar_one_water_sample', TRUE);
        $id_salmonella_liquids = $this->input->post('id_salmonella_liquidsChromagar', TRUE);
        $id_result_chromagar = $this->input->post('id_result_chromagar', TRUE);

        $dt = new DateTime();
        $date_sample_processed = $this->input->post('date_sample_processedChromagar', TRUE);
        $time_sample_processed = $this->input->post('time_sample_processedChromagar', TRUE);
        $quality_control = $this->input->post('quality_control_chromagar', TRUE) ? 1 : 0; // Convert checkbox to integer
    
        if ($mode == "insert") {
            // Insert data into assays table
            $data = array(
                'id_salmonella_liquids' => $id_salmonella_liquids,
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
    
            $assay_id = $this->Salmonella_liquids_model->insertResultsChromagar($data);
    
            // Insert sample volumes
            $number_of_tubes = $this->input->post('number_of_tubesChromagar', TRUE);
            for ($i = 1; $i <= $number_of_tubes; $i++) {
                $plate = $this->input->post("purple_colony_plate{$i}", TRUE);

                if ($plate !== null) {
                    $this->Salmonella_liquids_model->insert_purple_colony_plate(array(
                        'id_result_chromagar' => $assay_id,
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
                'id_salmonella_liquids' => $id_salmonella_liquids,
                'date_sample_processed' => $date_sample_processed,
                'time_sample_processed' => $time_sample_processed,
                'quality_control' => $quality_control,
                'flag' => '0',
                'lab' => $this->session->userdata('lab'),
                'uuid' => $this->uuid->v4(),
                'user_updated' => $this->session->userdata('id_users'),
                'date_updated' => $dt->format('Y-m-d H:i:s'),
            );
    
            $this->Salmonella_liquids_model->updateResultsChromagar($id_result_chromagar, $data);
    
            // Update sample volumes
            $number_of_tubes = $this->input->post('number_of_tubesChromagar', TRUE);
            $this->Salmonella_liquids_model->delete_purple_colony_plates($id_result_chromagar); // Hapus volume yang ada
    
            for ($i = 1; $i <= $number_of_tubes; $i++) {
                $plate = $this->input->post("purple_colony_plate{$i}", TRUE);
                if ($plate !== null) {
                    $data_plate = array(
                        'id_result_chromagar' => $id_result_chromagar,
                        'plate_number' => $i,
                        'purple_colony_plate' => $plate,
                        'flag' => '0',
                        'lab' => $this->session->userdata('lab'),
                        'uuid' => $this->uuid->v4(),
                        'user_created' => $this->session->userdata('id_users'),
                        'date_created' => $dt->format('Y-m-d H:i:s'),
                    );
                    $this->Salmonella_liquids_model->insert_purple_colony_plate($data_plate);
                }
            }
    
            $this->session->set_flashdata('message', 'Update Record Success');
        }

        // Auto-generate biochemical results after ChroMagar data is saved
        if ($mode == "insert") {
            $this->autoGenerateBiochemicalResults($id_salmonella_liquids, $assay_id, $number_of_tubes);
        } else if ($mode == "edit") {
            $this->autoGenerateBiochemicalResults($id_salmonella_liquids, $id_result_chromagar, $number_of_tubes);
        }
    
        redirect(site_url("salmonella_liquids/read/" . $id_one_water_sample));
    }


    public function saveBiochemical() {
        // Set JSON header for AJAX requests
        if ($this->input->is_ajax_request()) {
            header('Content-Type: application/json');
        }
        
        $mode = $this->input->post('mode_detResultsBiochemical', TRUE);
        $id_one_water_sample = $this->input->post('idBiochemical_one_water_sample', TRUE);
        $id_result_biochemical = $this->input->post('id_result_biochemical', TRUE);
        $id_result_chromagar = $this->input->post('id_result_chromagar1', TRUE);
        $id_salmonella_liquids = $this->input->post('id_salmonella_liquidsBiochemical', TRUE);
        $confirmation = $this->input->post('confirmation', TRUE);
        $sample_store = $this->input->post('sample_store', TRUE);
        $biochemical_tube = $this->input->post('biochemical_tube', TRUE);

        // Check if this is an AJAX request
        $is_ajax = $this->input->is_ajax_request();

        // Validation for required fields
        if (!$mode || !$id_salmonella_liquids || !$confirmation || !$biochemical_tube) {
            if ($is_ajax) {
                echo json_encode([
                    'status' => 'error',
                    'message' => 'Missing required fields.',
                    'tube' => $biochemical_tube,
                    'debug' => [
                        'mode' => $mode,
                        'id_salmonella_liquids' => $id_salmonella_liquids,
                        'confirmation' => $confirmation,
                        'biochemical_tube' => $biochemical_tube
                    ]
                ]);
                return;
            } else {
                $this->session->set_flashdata('error', 'Missing required fields.');
                redirect(site_url("salmonella_liquids/read/" . $id_one_water_sample));
                return;
            }
        }

        try {
            if ($mode == "insert") {
                $data = array(
                    'id_salmonella_liquids' => $id_salmonella_liquids,
                    'id_result_chromagar' => $id_result_chromagar,
                    'confirmation' => $confirmation,
                    // 'sample_store' => $sample_store,
                    'biochemical_tube' => $biochemical_tube,
                    'flag' => '0',
                    'lab' => $this->session->userdata('lab'),
                    'uuid' => $this->uuid->v4(),
                    'user_created' => $this->session->userdata('id_users'),
                    'date_created' => date('Y-m-d H:i:s'),
                );
                
                $result = $this->Salmonella_liquids_model->insertResultsBiochemical($data);
                
                if ($is_ajax) {
                    if ($result && $result > 0) {
                        echo json_encode([
                            'status' => 'success',
                            'message' => 'Biochemical result saved successfully.',
                            'tube' => $biochemical_tube,
                            'id' => $result
                        ]);
                    } else {
                        echo json_encode([
                            'status' => 'error',
                            'message' => 'Failed to save biochemical result.',
                            'tube' => $biochemical_tube
                        ]);
                    }
                    return;
                }
                
            } else if ($mode == "edit") {
                $data = array(
                    'id_salmonella_liquids' => $id_salmonella_liquids,
                    'id_result_chromagar' => $id_result_chromagar,
                    'confirmation' => $confirmation,
                    // 'sample_store' => $sample_store,
                    'flag' => '0',
                    'lab' => $this->session->userdata('lab'),
                    'uuid' => $this->uuid->v4(),
                    'user_updated' => $this->session->userdata('id_users'),
                    'date_updated' => date('Y-m-d H:i:s'),
                );

                $this->Salmonella_liquids_model->updateResultsBiochemical($id_result_biochemical, $data);
                
                if ($is_ajax) {
                    echo json_encode([
                        'status' => 'success',
                        'message' => 'Biochemical result updated successfully.',
                        'tube' => $biochemical_tube
                    ]);
                    return;
                }
            }

            // For non-AJAX requests (traditional form submission)
            redirect(site_url("salmonella_liquids/read/" . $id_one_water_sample));
            
        } catch (Exception $e) {
            if ($is_ajax) {
                echo json_encode([
                    'status' => 'error',
                    'message' => 'Error saving biochemical result: ' . $e->getMessage(),
                    'tube' => $biochemical_tube
                ]);
                return;
            } else {
                $this->session->set_flashdata('error', 'Error saving biochemical result: ' . $e->getMessage());
                redirect(site_url("salmonella_liquids/read/" . $id_one_water_sample));
            }
        }
    }

    /**
     * Auto-generate biochemical results based on XLD and ChroMagar data
     */
    private function autoGenerateBiochemicalResults($id_salmonella_liquids, $id_result_chromagar, $number_of_tubes) {
        $dt = new DateTime();
        
        // Get XLD results for this sample
        $xld_results = $this->Salmonella_liquids_model->getXldResults($id_salmonella_liquids);
        
        // Get ChroMagar results for this result set
        $chromagar_results = $this->Salmonella_liquids_model->getPurpleColonyPlates($id_result_chromagar);
        
        for ($tube = 1; $tube <= $number_of_tubes; $tube++) {
            // Get XLD value for this tube
            $xld_value = 0;
            foreach ($xld_results as $xld) {
                if ($xld->plate_number == $tube) {
                    $xld_value = $xld->colony_plate;
                    break;
                }
            }
            
            // Get ChroMagar value for this tube (plate)
            $chromagar_value = 0;
            foreach ($chromagar_results as $chromagar) {
                if ($chromagar->plate_number == $tube) {
                    $chromagar_value = $chromagar->purple_colony_plate;
                    break;
                }
            }
            
            // Calculate confirmation based on XLD + ChroMagar logic
            $confirmation = $this->calculateConfirmation($xld_value, $chromagar_value);
            
            // Check if biochemical result already exists for this tube
            $existing = $this->Salmonella_liquids_model->checkBiochemicalExists($id_salmonella_liquids, $id_result_chromagar, $tube);
            
            if (!$existing) {
                // Insert new biochemical result with default oxidase/catalase values for auto-processing
                $data = array(
                    'id_salmonella_liquids' => $id_salmonella_liquids,
                    'id_result_chromagar' => $id_result_chromagar,
                    'confirmation' => $confirmation,
                    'biochemical_tube' => $tube,
                    'oxidase' => '',  // Salmonella is typically oxidase negative
                    'catalase' => '', // Salmonella is typically catalase positive
                    'sample_store' => '',     // Empty string instead of null
                    'flag' => '0',
                    'lab' => $this->session->userdata('lab'),
                    'uuid' => $this->uuid->v4(),
                    'user_created' => $this->session->userdata('id_users'),
                    'date_created' => $dt->format('Y-m-d H:i:s'),
                );
                
                $this->Salmonella_liquids_model->insertResultsBiochemical($data);
            } else {
                // Update existing biochemical result with new confirmation
                $data = array(
                    'confirmation' => $confirmation,
                    'user_updated' => $this->session->userdata('id_users'),
                    'date_updated' => $dt->format('Y-m-d H:i:s'),
                );
                
                $this->Salmonella_liquids_model->updateBiochemicalResult($existing->id_result_biochemical, $data);
            }
        }
    }

    /**
     * Auto-update biochemical results when XLD data changes
     */
    private function autoUpdateBiochemicalFromXldChange($id_salmonella_liquids, $number_of_tubes) {
        $dt = new DateTime();
        
        // Get all ChroMagar results for this sample
        $chromagar_results_list = $this->Salmonella_liquids_model->getAllChroMagarResults($id_salmonella_liquids);
        
        if (empty($chromagar_results_list)) {
            // No ChroMagar data exists yet, nothing to update
            return;
        }
        
        // Get updated XLD results
        $xld_results = $this->Salmonella_liquids_model->getXldResults($id_salmonella_liquids);
        
        // Process each ChroMagar result set
        foreach ($chromagar_results_list as $chromagar_result) {
            $id_result_chromagar = $chromagar_result->id_result_chromagar;
            
            // Get ChroMagar plates for this specific result
            $chromagar_plates = $this->Salmonella_liquids_model->getPurpleColonyPlates($id_result_chromagar);
            
            // Update biochemical results for all tubes
            for ($tube = 1; $tube <= $number_of_tubes; $tube++) {
                // Get XLD value for this tube
                $xld_value = 0;
                foreach ($xld_results as $xld) {
                    if ($xld->plate_number == $tube) {
                        $xld_value = $xld->colony_plate;
                        break;
                    }
                }
                
                // Get ChroMagar value for this tube
                $chromagar_value = 0;
                foreach ($chromagar_plates as $chromagar) {
                    if ($chromagar->plate_number == $tube) {
                        $chromagar_value = $chromagar->purple_colony_plate;
                        break;
                    }
                }
                
                // Calculate new confirmation
                $confirmation = $this->calculateConfirmation($xld_value, $chromagar_value);
                
                // Check if biochemical result exists for this tube and ChroMagar result
                $existing = $this->Salmonella_liquids_model->checkBiochemicalExists($id_salmonella_liquids, $id_result_chromagar, $tube);
                
                if ($existing) {
                    // Update existing biochemical result with new confirmation
                    $data = array(
                        'confirmation' => $confirmation,
                        'user_updated' => $this->session->userdata('id_users'),
                        'date_updated' => $dt->format('Y-m-d H:i:s'),
                    );
                    
                    $this->Salmonella_liquids_model->updateBiochemicalResult($existing->id_result_biochemical, $data);
                }
                // Note: We don't create new biochemical results here since they should only be created when ChroMagar is saved
            }
        }
    }

    /**
     * Auto-save ChroMagar if all XLD results are 0
     */
    private function autoSaveChromagarIfAllZero($id_salmonella_liquids, $number_of_tubes, $date_sample_processed, $time_sample_processed) {
        $dt = new DateTime();
        
        // Get current XLD results
        $xld_results = $this->Salmonella_liquids_model->getXldResults($id_salmonella_liquids);
        
        if (empty($xld_results)) {
            return; // No XLD data, nothing to process
        }
        
        // Check if ALL XLD results are 0
        $all_zero = true;
        foreach ($xld_results as $xld) {
            if ($xld->colony_plate != '0') {
                $all_zero = false;
                break;
            }
        }
        
        // If all XLD results are 0, auto-save ChroMagar with same values
        if ($all_zero) {
            // Check if ChroMagar data already exists
            $existing_chromagar = $this->Salmonella_liquids_model->getAllChroMagarResults($id_salmonella_liquids);
            
            if (empty($existing_chromagar)) {
                // Create new ChroMagar record
                $chromagar_data = array(
                    'id_salmonella_liquids' => $id_salmonella_liquids,
                    'date_sample_processed' => $date_sample_processed,
                    'time_sample_processed' => $time_sample_processed,
                    'flag' => '0',
                    'lab' => $this->session->userdata('lab'),
                    'uuid' => $this->uuid->v4(),
                    'user_created' => $this->session->userdata('id_users'),
                    'date_created' => $dt->format('Y-m-d H:i:s'),
                );
                
                $chromagar_id = $this->Salmonella_liquids_model->insertResultsChromagar($chromagar_data);
                
                // Insert purple colony plates with value 0 for all tubes
                for ($i = 1; $i <= $number_of_tubes; $i++) {
                    $plate_data = array(
                        'id_result_chromagar' => $chromagar_id,
                        'plate_number' => $i,
                        'purple_colony_plate' => '0', // Auto-set to 0 since all XLD are 0
                        'flag' => '0',
                        'lab' => $this->session->userdata('lab'),
                        'uuid' => $this->uuid->v4(),
                        'user_created' => $this->session->userdata('id_users'),
                        'date_created' => $dt->format('Y-m-d H:i:s'),
                    );
                    $this->Salmonella_liquids_model->insert_purple_colony_plate($plate_data);
                }
                
                // Auto-generate biochemical results
                $this->autoGenerateBiochemicalResults($id_salmonella_liquids, $chromagar_id, $number_of_tubes);
                
                // Set flash message to indicate auto-save
                $this->session->set_flashdata('auto_chromagar', 'ChroMagar results auto-saved with value 0 (all XLD results are 0)');
            }
        }
    }

    /**
     * Calculate confirmation based on XLD and ChroMagar values
     */
    private function calculateConfirmation($xld_value, $chromagar_value) {
        // Convert to integers
        $xld = intval($xld_value);
        $chromagar = intval($chromagar_value);
        
        // Apply the same logic as in salmonella_liquids
        if ($xld === 0 && $chromagar === 0) {
            return 'Not Salmonella';
        } else if ($xld === 1 && $chromagar === 0) {
            return 'Not Salmonella';
        } else if ($xld === 1 && $chromagar === 1) {
            return 'Salmonella';
        } else {
            // Default to "Not Salmonella" for unexpected cases
            return 'Not Salmonella';
        }
    }


    public function delete_salmonellaLiquids($id) {
        $row = $this->Salmonella_liquids_model->get_by_id_salmonella_liquids($id);
        if ($row) {
            $id_parent = $row->id_result_xld; // Retrieve project_id before updating the record
            $data = array(
                'flag' => 1,
            );
    
            $this->Salmonella_liquids_model->updateSalmonellaLiquids($id, $data);
            $this->Salmonella_liquids_model->updateSampleVolume($id, $data);
            $this->session->set_flashdata('message', 'Delete Record Success');
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
        }
    
        redirect(site_url('salmonella_liquids/read/'.$id_parent));
    }
    
    public function delete_detailXld($id) {
        $row = $this->Salmonella_liquids_model->get_by_id_xld($id);
        if ($row) {
            $id_parent = $row->id_result_xld; // Retrieve project_id before updating the record
            $data = array(
                'flag' => 1,
            );
    
            $this->Salmonella_liquids_model->updateResultsXld($id, $data);
            $this->Salmonella_liquids_model->updateResultsGrowthPlate($id, $data);
            $this->session->set_flashdata('message', 'Delete Record Success');
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
        }
    
        redirect(site_url('salmonella_liquids/read/'.$id_parent));
    }

    public function delete_detailChromagar($id) {
        $row = $this->Salmonella_liquids_model->get_by_id_chromagar($id);
        if ($row) {
            $id_parent = $row->id_result_xld; // Retrieve project_id before updating the record
            $data = array(
                'flag' => 1,
            );
    
            $this->Salmonella_liquids_model->updateResultsChromagar($id, $data);
            $this->Salmonella_liquids_model->updateResultsBlackColonyPlateChromagar($id, $data);
            $this->session->set_flashdata('message', 'Delete Record Success');
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
        }
    
        redirect(site_url('salmonella_liquids/read/'.$id_parent));
    }

    public function delete_detailBiochemical($id) {
        $row = $this->Salmonella_liquids_model->get_by_id_biochemical($id);
        if ($row) {
            $id_parent = $row->id_result_xld; // Retrieve project_id before updating the record
            $data = array(
                'flag' => 1,
            );
    
            $this->Salmonella_liquids_model->updateResultsBiochemical($id, $data);
            $this->session->set_flashdata('message', 'Delete Record Success');
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
        }
    
        redirect(site_url('salmonella_liquids/read/'.$id_parent));
    }

    public function getIdOneWaterDetails()
    {
        $idOneWaterSample = $this->input->post('id_one_water_sample');
        $oneWaterSample = $this->Salmonella_liquids_model->getOneWaterSampleById($idOneWaterSample);
        echo json_encode($oneWaterSample);
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
        $sheet->setCellValue('J1', "Filtration  Volume(mL)");
        $sheet->setCellValue('K1', "Enrichment Media");
    
        // Fetch the concentration data
        $finalConcentration = $this->Salmonella_liquids_model->get_export($id);
    
        if (!empty($finalConcentration)) {
            // Initialize tube index for volumes
            $tubeIndex = 0;
    
            // Add Tube Volume headers
            foreach ($finalConcentration[0] as $key => $value) {
                if (strpos($key, 'Tube') === 0) {
                    $columnLetter = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex(12 + $tubeIndex);
                    $sheet->setCellValue($columnLetter . '1', "$key Volume");
                    $tubeIndex++;
                }
            }
    
            // Add Tube Result headers
            $plate_numbers = explode(',', $finalConcentration[0]->plate_numbers);
            foreach ($plate_numbers as $plate_number) {
                $columnLetter = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex(12 + $tubeIndex);
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
            $sheet->setCellValue('J' . $numrow, $concentration->elution_volume ?? '');
            $sheet->setCellValue('K' . $numrow, $concentration->enrichment_media ?? '');
    
            // Fill tube volumes
            $tubeIndex = 0;
            foreach ($concentration as $key => $value) {
                if (strpos($key, 'Tube') === 0) {
                    $columnLetter = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex(12 + $tubeIndex);
                    $sheet->setCellValue($columnLetter . $numrow, $value ?? '');
                    $tubeIndex++;
                }
            }
    
            // Fill tube results
            $plate_numbers = explode(',', $concentration->plate_numbers);
            foreach ($plate_numbers as $plate_number) {
                // Set default value for confirmation
                $confirmation_value = isset($concentration->confirmation[$plate_number]) ? $concentration->confirmation[$plate_number] : 'No Colony Plate'; 
                
                // Calculate the column letter dynamically
                $columnLetter = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex(12 + $tubeIndex);
                $sheet->setCellValue($columnLetter . $numrow, $confirmation_value);
                $tubeIndex++;
            }
    
            $numrow++;
        }
    
        // Set header for the Excel file
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="Report_Salmonella_Liquids_Final_Concentrations.xlsx"');
        header('Cache-Control: max-age=0');
    
        // Output the Excel file
        $writer = new Xlsx($spreadsheet);
        $writer->save('php://output');
    }

    public function excel_all() {
        $spreadsheet = new Spreadsheet();
        $finalConcentration = $this->Salmonella_liquids_model->get_all_export();
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
        header('Content-Disposition: attachment;filename="Report_All_Salmonella_Liquids_Final_Concentrations.xlsx"');
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
        $sheet->setCellValue('J1', "Filtration  Volume(mL)");
        $sheet->setCellValue('K1', "Enrichment Media");
    
        // Add Tube Volume headers
        for ($i = 1; $i <= $numberOfTubes; $i++) {
            $columnLetter = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex(11 + $i);
            $sheet->setCellValue($columnLetter . '1', "Tube $i Volume");
        }
    
        // Add Tube Result headers
        for ($i = 1; $i <= $numberOfTubes; $i++) {
            $columnLetter = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex(11 + $numberOfTubes + $i);
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
            $sheet->setCellValue('J' . $numrow, $concentration->elution_volume ?? '');
            $sheet->setCellValue('K' . $numrow, $concentration->enrichment_media ?? '');
    
            // Mengisi volume tabung
            $tubeIndex = 0;
            foreach ($concentration as $key => $value) {
                if (strpos($key, 'Tube') === 0) {
                    $columnLetter = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex(12 + $tubeIndex);
                    $sheet->setCellValue($columnLetter . $numrow, $value ?? '');
                    $tubeIndex++;
                }
            }
    
        // Mengisi hasil tabung
        for ($i = 1; $i <= $numberOfTubes; $i++) {
            $columnLetter = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex(12 + $numberOfTubes + ($i - 1));

            // Mengakses nilai konfirmasi dengan indeks tabung
            $confirmation_value = $concentration->confirmation[$i] ?? 'No Colony Plate'; // Nilai default jika tidak ada konfirmasi
            
            // Debugging: Cek nilai konfirmasi sebelum diset ke sel
            error_log("Confirmation for Tube {$i}: " . $confirmation_value);
            $sheet->setCellValue($columnLetter . $numrow, $confirmation_value);
        }
    
            $numrow++;
        }
    }


    public function validateSalmonellaAssayBarcode() {
        $id = $this->input->get('id');
        $data = $this->Salmonella_liquids_model->validateSalmonellaAssayBarcode($id);
        header('Content-Type: application/json');
        echo json_encode($data);
    }

    public function barcode_restrict() 
    {
        $id = $this->input->get('id1');
        $data = $this->Salmonella_liquids_model->barcode_restrict($id);
        header('Content-Type: application/json');
        echo json_encode($data);
    }

    public function saveReview()
    {
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
    
        $this->load->model('Salmonella_liquids_model');
    
        try {
            $this->Salmonella_liquids_model->update_salmonella_liquids($id, $data);
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

    public function cancelReview()
    {
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
        $this->load->model('Salmonella_liquids_model');
        $updateResult = $this->Salmonella_liquids_model->updateCancel($id, $data);
    
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

    public function getCalculateMPN() {
        header('Content-Type: application/json');
        
        $id_salmonella_liquids = $this->input->get('id_salmonella_liquids', TRUE);

        if (!$id_salmonella_liquids) {
            echo json_encode([
                'status' => 'error',
                'message' => 'ID Salmonella Liquids is required.'
            ]);
            return;
        }
        
        try {
            $mpn_data = $this->Salmonella_liquids_model->get_calculate_mpn_by_salmonella_liquids($id_salmonella_liquids);

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

    public function saveCalculateMPN() {
        header('Content-Type: application/json');
        
        try {
            // Get form data
            $mode = $this->input->post('mode_calculateMPN', TRUE);
            $id_salmonella_liquids = $this->input->post('id_salmonella_liquids_mpn', TRUE);
            $mpn_concentration = $this->input->post('mpn_concentration', FALSE);
            $upper_ci = $this->input->post('upper_ci', FALSE);
            $lower_ci = $this->input->post('lower_ci', FALSE);
            $mpn_concentration_dw = $this->input->post('mpn_concentration_dw', TRUE);
            $upper_ci_dw = $this->input->post('upper_ci_dw', TRUE);
            $lower_ci_dw = $this->input->post('lower_ci_dw', TRUE);
            
            // Validation
            if (!$mode || !in_array($mode, ['insert', 'edit'])) {
                echo json_encode([
                    'status' => 'error',
                    'message' => 'Invalid operation mode.'
                ]);
                return;
            }
            
            if (!$id_salmonella_liquids || !$mpn_concentration || !$upper_ci || !$lower_ci) {
                echo json_encode([
                    'status' => 'error',
                    'message' => 'Required fields are missing.'
                ]);
                return;
            }
            
            $dt = new DateTime();
            $user_id = $this->session->userdata('id_users');
            $lab = $this->session->userdata('lab');
            
            if ($mode === 'insert') {
                // Insert mode
                $data = array(
                    'id_salmonella_liquids' => $id_salmonella_liquids,
                    'mpn_concentration' => $mpn_concentration,
                    'upper_ci' => $upper_ci,
                    'lower_ci' => $lower_ci,
                    'mpn_concentration_dw' => $mpn_concentration_dw ?: null,
                    'upper_ci_dw' => $upper_ci_dw ?: null,
                    'lower_ci_dw' => $lower_ci_dw ?: null,
                    'flag' => '0',
                    'lab' => $lab ? $lab : '1',
                    'uuid' => $this->uuid->v4(),
                    'user_created' => $user_id,
                    'date_created' => $dt->format('Y-m-d H:i:s'),
                );

                $insert_id = $this->Salmonella_liquids_model->insertCalculateMPN($data);

                if ($insert_id) {
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
                $id_salmonella_result_mpn_liquids = $this->input->post('id_salmonella_result_mpn_liquids', TRUE);
                
                if (!$id_salmonella_result_mpn_liquids) {
                    echo json_encode([
                        'status' => 'error',
                        'message' => 'MPN calculation ID is required for update.'
                    ]);
                    return;
                }
                
                $data = array(
                    'id_salmonella_liquids' => $id_salmonella_liquids,
                    'mpn_concentration' => $mpn_concentration,
                    'upper_ci' => $upper_ci,
                    'lower_ci' => $lower_ci,
                    'mpn_concentration_dw' => $mpn_concentration_dw ?: null,
                    'upper_ci_dw' => $upper_ci_dw ?: null,
                    'lower_ci_dw' => $lower_ci_dw ?: null,
                    'flag' => '0',
                    'lab' => $lab ? $lab : '1',
                    'uuid' => $this->uuid->v4(),
                );

                $result = $this->Salmonella_liquids_model->updateCalculateMPN($id_salmonella_result_mpn_liquids, $data);

                if ($result) {
                    echo json_encode([
                        'status' => 'success',
                        'message' => 'MPN calculation updated successfully.'
                    ]);
                } else {
                    echo json_encode([
                        'status' => 'error',
                        'message' => 'Failed to update MPN calculation.'
                    ]);
                }
            }
            
        } catch (Exception $e) {
            echo json_encode([
                'status' => 'error',
                'message' => 'Error saving MPN calculation: ' . $e->getMessage()
            ]);
        }
    }

    /**
     * Check if a specific tube already has biochemical data
     */
    public function checkTubeExists() {
        try {
            $id_salmonella_liquids = $this->input->post('id_salmonella_liquids');
            $biochemical_tube = $this->input->post('biochemical_tube');
            
            if (!$id_salmonella_liquids || !$biochemical_tube) {
                echo json_encode([
                    'status' => 'error',
                    'message' => 'Missing required parameters.',
                    'exists' => false
                ]);
                return;
            }
            
            $exists = $this->Salmonella_liquids_model->checkTubeExists($id_salmonella_liquids, $biochemical_tube);
            
            echo json_encode([
                'status' => 'success',
                'exists' => $exists
            ]);
            
        } catch (Exception $e) {
            echo json_encode([
                'status' => 'error',
                'message' => 'Error checking tube existence: ' . $e->getMessage(),
                'exists' => false
            ]);
        }
    }

    /**
     * Check if a specific tube needs update based on new confirmation value
     */
    public function checkTubeNeedsUpdate() {
        header('Content-Type: application/json');
        
        try {
            $id_salmonella_liquids = $this->input->post('id_salmonella_liquids');
            $biochemical_tube = $this->input->post('biochemical_tube');
            $expected_confirmation = $this->input->post('expected_confirmation');
            
            if (!$id_salmonella_liquids || !$biochemical_tube || !$expected_confirmation) {
                echo json_encode([
                    'status' => 'error',
                    'message' => 'Missing required parameters.',
                    'exists' => false,
                    'needs_update' => false
                ]);
                return;
            }
            
            $result = $this->Salmonella_liquids_model->checkTubeNeedsUpdate($id_salmonella_liquids, $biochemical_tube, $expected_confirmation);
            
            echo json_encode([
                'status' => 'success',
                'exists' => $result['exists'],
                'needs_update' => $result['needs_update'],
                'current_confirmation' => $result['current_confirmation'],
                'id_result_biochemical' => $result['id_result_biochemical']
            ]);
            
        } catch (Exception $e) {
            echo json_encode([
                'status' => 'error',
                'message' => 'Error checking tube update status: ' . $e->getMessage(),
                'exists' => false,
                'needs_update' => false
            ]);
        }
    }

    /**
     * Check if any tube has biochemical data for monitoring sync status
     */
    public function checkAnyTubeExists() {
        try {
            $id_salmonella_liquids = $this->input->post('id_salmonella_liquids');
            
            if (!$id_salmonella_liquids) {
                echo json_encode([
                    'status' => 'error',
                    'message' => 'Missing required parameters.',
                    'hasData' => false
                ]);
                return;
            }
            
            $hasData = $this->Salmonella_liquids_model->checkAnyTubeExists($id_salmonella_liquids);
            
            echo json_encode([
                'status' => 'success',
                'hasData' => $hasData
            ]);
            
        } catch (Exception $e) {
            echo json_encode([
                'status' => 'error',
                'message' => 'Error checking tube data: ' . $e->getMessage(),
                'hasData' => false
            ]);
        }
    }

}

/* End of file Water_sample_reception.php */
/* Location: ./application/controllers/Water_sample_reception.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2022-12-14 03:38:42 */
/* http://harviacode.com */