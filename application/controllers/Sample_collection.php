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
    
class Sample_collection extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        is_login();
        $this->load->model('Sample_collection_model');
        $this->load->library('form_validation');        
	    $this->load->library('datatables');
	    $this->load->library('uuid');
    }

    public function index()
    {
        $data['id_one'] = $this->Sample_collection_model->getID_one();
        $data['sampletype'] = $this->Sample_collection_model->getSampleType();
        $data['labtech'] = $this->Sample_collection_model->getLabTech();
        // $data['id_project'] = $this->Sample_collection_model->generate_project_id();
        // $data['client'] = $this->Sample_collection_model->generate_client();
        // $data['id_one_water_sample'] = $this->Sample_collection_model->generate_one_water_sample_id();
        $this->template->load('template','sample_collection/index', $data);
    } 
    
    public function json() {
        header('Content-Type: application/json');
        echo $this->Sample_collection_model->json();
    }

    public function subjson() {
        $id = $this->input->get('id_sample_collection',TRUE);
        header('Content-Type: application/json');
        echo $this->Sample_collection_model->subjson($id);
    }

    public function subjson72() {
        $id = $this->input->get('id72',TRUE);
        header('Content-Type: application/json');
        echo $this->Sample_collection_model->subjson72($id);
    }

    public function read($id)
    {
        // $data['testing_type'] = $this->Sample_collection_model->getTest();
        // $data['barcode'] = $this->Water_sample_reception_model->getBarcode();
        // var_dump($id);
        // die();
        $row = $this->Sample_collection_model->get_detail($id);
        $return_url = $this->input->get('return_url', TRUE);

        if (!$this->is_valid_return_url($return_url)) {
            $return_url = site_url("sample_collection");
        }

        if ($row) {
            $data = array(
                'id_sample_collection' => $row->id_sample_collection,
                'id_one_water_sample' => $row->id_one_water_sample,
                'initial' => $row->initial,
                'date_processing' => $row->date_processing,
                'sampletype' => $row->sampletype,
                'barcode_sample_collection' => $row->barcode_sample_collection,
                'weight' => $row->weight,
                'volume' => $row->volume,
                'quantity' => $row->quantity,
                'completed' => $row->completed,
                'comments' =>$row->comments,
                'full_name' => $row->full_name,
                'user_review' => $row->user_review,
                'review' => $row->review,
                'user_created'  => $row->user_created,
                'return_url' => $return_url,
            );

            $data['kit'] = $this->Sample_collection_model->getKit();
            
            // Load freezer location dropdown data
            $data['freez1'] = $this->Sample_collection_model->getFreezer1();
            $data['shelf1'] = $this->Sample_collection_model->getFreezer2();
            $data['rack1'] = $this->Sample_collection_model->getFreezer3();
            $data['tray1'] = $this->Sample_collection_model->getFreezer4();
            
            // Load position dropdown data
            $data['row1'] = $this->Sample_collection_model->getPos1();
            $data['col1'] = $this->Sample_collection_model->getPos2();

                
            $this->template->load('template','sample_collection/index_det', $data);

        }
        else {
            // $this->template->load('template','Water_sample_reception/index_det', $test);
        }

    } 

    public function read2($id)
    {
        $data['test'] = $this->Sample_collection_model->getTest();
        $row = $this->Sample_collection_model->get_detail2($id);
        if ($row) {
            $data = array(
                'id_project' => $row->id_project,
                'id_sample' => $row->id_sample,
                'sample_description' => $row->sample_description,
                'test' => $this->Sample_collection_model->getTest(),
                );
                $this->template->load('template','Sample_reception/index_det2', $data);
        }
        else {
            // $this->template->load('template','Water_sample_reception/index_det');
        }
    }     

    public function save() {
        $mode = $this->input->post('mode', TRUE);
        $id_sample_collection = $this->input->post('idx_sample_collection', TRUE);
        $return_url = $this->input->post('return_url', TRUE);
        $dt = new DateTime();

        $id_one_water_sample = $this->input->post('id_one_water_sample', TRUE);
        $idx_one_water_sample = $this->input->post('idx_one_water_sample', TRUE);
        $id_person = $this->input->post('id_person', TRUE);
        $date_processing = $this->input->post('date_processing', TRUE);
        $id_sampletype = $this->input->post('id_sampletype', TRUE);
        $barcode_sample_collection = $this->input->post('barcode_sample_collection', TRUE);
        $weight = $this->input->post('weight', TRUE);
        $volume = $this->input->post('volume', TRUE);
        $quantity = $this->input->post('quantity', TRUE);
        $completed = $this->input->post('completed', TRUE);
        $comments = $this->input->post('comments', TRUE);
        // $date_collected = $this->input->post('date_collected',TRUE);
        // $time_collected = $this->input->post('time_collected',TRUE);
        
    
        if ($mode == "insert") {
            $data = array(
                'id_one_water_sample' => $id_one_water_sample,
                'barcode_sample_collection' => $barcode_sample_collection,
                'id_person' => $id_person,
                'id_sampletype' => $id_sampletype,
                'date_processing' => $date_processing,
                'weight' => $weight,
                'volume' => $volume,
                'quantity' => $quantity,
                'completed' => $completed,
                'comments' => $comments,
                'flag' => '0',
                'lab' => $this->session->userdata('lab'),
                'uuid' => $this->uuid->v4(),
                'user_created' => $this->session->userdata('id_users'),
                'date_created' => $dt->format('Y-m-d H:i:s'),
            );

            // var_dump($data);
            // die();
    
            $this->Sample_collection_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');

        } else if ($mode == "edit") {
            $data = array(
                'id_one_water_sample' => $idx_one_water_sample,
                'barcode_sample_collection' => $barcode_sample_collection,
                'id_person' => $id_person,
                'id_sampletype' => $id_sampletype,
                'date_processing' => $date_processing,
                'weight' => $weight,
                'volume' => $volume,
                'quantity' => $quantity,
                'completed' => $completed,
                'comments' => $comments,
                'flag' => '0',
                'lab' => $this->session->userdata('lab'),
                // 'uuid' => $this->uuid->v4(),
                'user_updated' => $this->session->userdata('id_users'),
                'date_updated' => $dt->format('Y-m-d H:i:s'),
            );

            // var_dump($data);
            // die();

            $this->Sample_collection_model->update($id_sample_collection, $data);
            $this->session->set_flashdata('message', 'Update Record Success');
        }
    
        if ($this->is_valid_return_url($return_url)) {
            redirect($return_url);
            return;
        }

        redirect(site_url("sample_collection"));
    }

    private function is_valid_return_url($url)
    {
        if (empty($url)) {
            return false;
        }

        $url = trim($url);

        if (preg_match('/[\r\n]/', $url)) {
            return false;
        }

        $parsed_url = parse_url($url);
        if ($parsed_url === false) {
            return false;
        }

        if (isset($parsed_url['scheme'])) {
            if (!in_array(strtolower($parsed_url['scheme']), ['http', 'https'])) {
                return false;
            }

            $base_host = parse_url(base_url(), PHP_URL_HOST);
            $url_host = isset($parsed_url['host']) ? $parsed_url['host'] : '';

            return !empty($base_host) && $url_host === $base_host;
        }

        return true;
    }

    
    public function savedetail() {
            $mode_det = $this->input->post('mode_det', TRUE);
            $dt = new DateTime();
            $return_url = $this->input->post('return_url', TRUE);
            // var_dump($id_sample_collection);
            // die();
            $id_one_water_sample = $this->input->post('idx_one_water_sample', TRUE);
            $idx_sample_collection = $this->input->post('idx_sample_collection', TRUE);
            $id_sample_collection_detail = $this->input->post('id_sample_collection_detail', TRUE);
            $date_received = $this->input->post('date_received', TRUE);
            $volume = $this->input->post('volume_detail', TRUE);
            $date_extraction = $this->input->post('date_extraction', TRUE);
            $id_kit = $this->input->post('id_kit', TRUE);
            $other_kit = $this->input->post('other_kit', TRUE); // Add other_kit field
            $kit_lot = $this->input->post('kit_lot', TRUE);
            $tube_barcode = $this->input->post('tube_barcode', TRUE);
            $dna_concentration = $this->input->post('dna_concentration', TRUE);
            $cryobox_number = $this->input->post('cryobox_number', TRUE);
            $comments = $this->input->post('comments_detail', TRUE);


            $id_freez = $this->input->post('id_freez', TRUE);
            $id_shelf = $this->input->post('id_shelf', TRUE);
            $id_rack = $this->input->post('id_rack', TRUE);
            $id_tray = $this->input->post('id_tray', TRUE);

            $id_row = $this->input->post('id_row', TRUE);
            $id_col = $this->input->post('id_col', TRUE);

            $loc_obj = $this->Sample_collection_model->get_freezx($id_freez, $id_shelf, $id_rack, $id_tray);
            $pos_obj = $this->Sample_collection_model->get_posx($id_row, $id_col);
            $id_loc = $loc_obj->id_location;
            $id_pos = $pos_obj->id_pos;  
        
            if($mode_det == "insert") {
                $data = array(
                    'id_sample_collection' => $idx_sample_collection,
                    'date_received' => $date_received,
                    'volume' => $volume,
                    'date_extraction' => $date_extraction,
                    'id_kit' => $id_kit,
                    'other_kit' => $other_kit, // Add other_kit to insert data
                    'kit_lot' => $kit_lot,
                    'tube_barcode' => $tube_barcode,
                    'dna_concentration' => $dna_concentration,
                    'cryobox_number' => $cryobox_number,
                    'id_location' => $id_loc,
                    'id_pos' => $id_pos,
                    'comments' => $comments,
                    'flag' => '0',
                    'lab' => $this->session->userdata('lab'),
                    'uuid' => $this->uuid->v4(),
                    'user_created' => $this->session->userdata('id_users'),
                    'date_created' => $dt->format('Y-m-d H:i:s'),
                );
                // var_dump($data);
                // die();
        
                $insert_id = $this->Sample_collection_model->insert_detail($data);
                if ($insert_id) {
                    $this->session->set_flashdata('message', 'Create Record Success');
                } else {
                    $this->session->set_flashdata('error', 'Failed to create record');
                }
                
            } else if($mode_det == "edit") {
                $data = array(
                    'id_sample_collection' => $idx_sample_collection,
                    'date_received' => $date_received,
                    'volume' => $volume,
                    'date_extraction' => $date_extraction,
                    'id_kit' => $id_kit,
                    'other_kit' => $other_kit, // Add other_kit to update data
                    'kit_lot' => $kit_lot,
                    'tube_barcode' => $tube_barcode,
                    'dna_concentration' => $dna_concentration,
                    'cryobox_number' => $cryobox_number,
                    'id_location' => $id_loc,
                    'id_pos' => $id_pos,
                    'comments' => $comments,
                    'flag' => '0',
                    'lab' => $this->session->userdata('lab'),
                    'uuid' => $this->uuid->v4(),
                    'user_created' => $this->session->userdata('id_users'),
                    'date_created' => $dt->format('Y-m-d H:i:s'),
                );
                // var_dump($data);
                // die();
                $result = $this->Sample_collection_model->update_detail($id_sample_collection_detail, $data);
                if ($result) {
                    $this->session->set_flashdata('message', 'Update Record Success');
                } else {
                    $this->session->set_flashdata('error', 'Failed to update record');
                }
            }
        
            $redirect_url = site_url("sample_collection/read/" . $id_one_water_sample);
            if ($this->is_valid_return_url($return_url)) {
                $redirect_url .= '?return_url=' . rawurlencode($return_url);
            }

            redirect($redirect_url);
    }


    public function savedetail72() {
        $mode_det72 = $this->input->post('mode_det72', TRUE);
        $dt = new DateTime();
        $return_url = $this->input->post('return_url', TRUE);
        $id_one_water_sample = $this->input->post('id27_one_water_sample', TRUE);
        $id_sample_collection = $this->input->post('idx_sample_collection72', TRUE);
        $id_sample_collection72 = $this->input->post('id_sample_collection72', TRUE);
        $date_moisture72 = $this->input->post('date_moisture72', TRUE);
        $time_moisture72 = $this->input->post('time_moisture72', TRUE);
        $barcode_tray = $this->input->post('barcode_tray72', TRUE);
        $dry_weight72 = $this->input->post('dry_weight72', TRUE);
        $moisture_content_persen = $this->input->post('moisture_content_persen', TRUE);
        $dry_weight_persen = $this->input->post('dry_weight_persen', TRUE);
        $comments72 = $this->input->post('comments72', TRUE);

        if($mode_det72 == "insert") {
            $data = array(
                'id_sample_collection' => $id_sample_collection,
                'date_moisture72' => $date_moisture72,
                'time_moisture72' => $time_moisture72,
                'barcode_tray' => $barcode_tray,
                'dry_weight72' => $dry_weight72,
                'moisture_content_persen' => $moisture_content_persen,
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
    
            $insert_id = $this-> Sample_collection_model->insert_det72($data);
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
                'moisture_content_persen' => $moisture_content_persen,
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
            $result = $this->Sample_collection_model->update_det72($id_sample_collection72, $data);
            if ($result) {
                $this->session->set_flashdata('message', 'Update Record Success');
            } else {
                $this->session->set_flashdata('error', 'Failed to update record');
            }
        }
    
        $redirect_url = site_url("sample_collection/read/" . $id_one_water_sample);
        if ($this->is_valid_return_url($return_url)) {
            $redirect_url .= '?return_url=' . rawurlencode($return_url);
        }

        redirect($redirect_url);

    }
  

    public function delete($id) 
    {
        $row = $this->Sample_collection_model->get_by_id($id);
        
        if ($row) {
            $id_sample_collection = $row->id_sample_collection;
            
            // Cascade delete: soft delete all moisture24 and moisture72 records
            $this->Sample_collection_model->cascade_delete_moisture24_72($id_sample_collection);
            
            // Soft-delete the sample_collection record
            $data = array(
                'flag' => 1,
            );
            $this->Sample_collection_model->update($id, $data);
            
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('sample_collection'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('sample_collection'));
        }
    }

    public function delete_detail($id) 
    {
        $row = $this->Sample_collection_model->get_by_id_detail($id);
        if ($row) {
            $id_parent = $row->id_sample_collection; // Retrieve id_sample_collection before updating the record
            
            // Cascade delete: soft delete all moisture72 records with same id_sample_collection
            $this->Sample_collection_model->cascade_delete_moisture72($id_parent);
            
            // Soft-delete the moisture24 record
            $data = array(
                'flag' => 1,
            );
    
            $this->Sample_collection_model->update_det24($id, $data);
            $this->session->set_flashdata('message', 'Delete Record Success');
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
        }
    
        redirect(site_url('sample_collection/read/'.$id_parent));
    }

    public function delete_detail72($id) 
    {
        $row = $this->Sample_collection_model->get_by_id_detail72($id);
        if ($row) {
            $id_parent = $row->id_sample_collection; // Retrieve project_id before updating the record
            $data = array(
                'flag' => 1,
            );
    
            $this->Sample_collection_model->update_det72($id, $data);
            $this->session->set_flashdata('message', 'Delete Record Success');
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
        }
    
        redirect(site_url('sample_collection/read/'.$id_parent));
    }


    public function getIdOneWaterDetails()
    {
        $idOneWaterSample = $this->input->post('id_one_water_sample');
        $oneWaterSample = $this->Sample_collection_model->getOneWaterSampleById($idOneWaterSample);
        echo json_encode($oneWaterSample);
    }

    public function validate24() {
        $id = $this->input->get('id24');
        $data = $this->Sample_collection_model->validate24($id);
        header('Content-Type: application/json');
        echo json_encode($data);
    }

    public function validate72() {
        $id = $this->input->get('id72');
        $data = $this->Sample_collection_model->validate72($id);
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

        $moisture = $this->Sample_collection_model->get_all();
    
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
        header('Content-Disposition: attachment;filename="Report_sample_collection.xlsx"');
        header('Cache-Control: max-age=0');

        // Tampilkan file excel
        $writer = new Xlsx($spreadsheet);
        $writer->save('php://output');
    }

    public function validateBarcodeMoistureContent() {
        $id = $this->input->get('id');
        $data = $this->Sample_collection_model->validateBarcodeMoistureContent($id);
        header('Content-Type: application/json');
        echo json_encode($data);
    }

    public function barcode_restrict() 
    {
        $id = $this->input->get('id1');
        $data = $this->Sample_collection_model->barcode_restrict($id);
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
    
        $this->load->model('Sample_collection_model');
        $this->Sample_collection_model->updateSave($id, $data);
        echo json_encode([
            'status' => true,
            'message' => 'Review saved successfully.'
        ]);
    }


    public function cancelReview()
    {
        header('Content-Type: application/json');
    
        // Ambil data POST
        $id = $this->input->post('id_one_water_sample', true);
        $review = $this->input->post('review', true);
        $user_review = $this->input->post('user_review', true);
    
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
            'review' => 0, 
            'user_review' => '', 
            'user_updated' => $this->session->userdata('id_users'),
            'date_updated' => date('Y-m-d H:i:s')
        ];
        // Load model dan update data review di database
        $this->load->model('Sample_collection_model');
        $updateResult = $this->Sample_collection_model->updateCancel($id, $data);

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