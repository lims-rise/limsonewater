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
    
class Moisture_content extends MY_Controller
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
        // $data['id_one_water_sample'] = $this->Moisture_content_model->generate_one_water_sample_id();
        $this->load_template_with_announcements('template', 'moisture_content/index', $data);
    } 
    
    public function json() {
        header('Content-Type: application/json');
        echo $this->Moisture_content_model->json();
    }

    public function subjson24() {
        $id = $this->input->get('id24',TRUE);
        header('Content-Type: application/json');
        echo $this->Moisture_content_model->subjson24($id);
    }

    public function subjson72() {
        $id = $this->input->get('id72',TRUE);
        header('Content-Type: application/json');
        echo $this->Moisture_content_model->subjson72($id);
    }

    public function read($id)
    {
        // $data['testing_type'] = $this->Moisture_content_model->getTest();
        // $data['barcode'] = $this->Water_sample_reception_model->getBarcode();
        // var_dump($id);
        // die();
        $row = $this->Moisture_content_model->get_detail($id);
        $return_url = $this->input->get('return_url', TRUE);

        if (!$this->is_valid_return_url($return_url)) {
            $return_url = site_url("moisture_content");
        }

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
                'date_incubator' => $row->date_incubator,
                'time_incubator' => $row->time_incubator,
                'comments' =>$row->comments,
                'full_name' => $row->full_name,
                'user_review' => $row->user_review,
                'review' => $row->review,
                'user_created'  => $row->user_created,
                'return_url' => $return_url,
            );


                
            $this->template->load('template','moisture_content/index_det', $data);

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
        $return_url = $this->input->post('return_url', TRUE);
        $dt = new DateTime();

        $id_one_water_sample = $this->input->post('id_one_water_sample', TRUE);
        $idx_one_water_sample = $this->input->post('idx_one_water_sample', TRUE);
        $id_person = $this->input->post('id_person', TRUE);
        $date_start = $this->input->post('date_start', TRUE);
        $id_sampletype = $this->input->post('id_sampletype', TRUE);
        $barcode_moisture_content = $this->input->post('barcode_moisture_content', TRUE);
        $tray_weight = $this->input->post('tray_weight', TRUE);
        $traysample_wetweight = $this->input->post('traysample_wetweight', TRUE);
        $date_incubator = $this->input->post('date_incubator', TRUE);
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
                'date_incubator' => $date_incubator,
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
                'date_incubator' => $date_incubator,
                'time_incubator' => $time_incubator,
                'comments' => $comments,
                'flag' => '0',
                'lab' => $this->session->userdata('lab'),
                // 'uuid' => $this->uuid->v4(),
                'user_updated' => $this->session->userdata('id_users'),
                'date_updated' => $dt->format('Y-m-d H:i:s'),
            );

            // var_dump($data);
            // die();

            $this->Moisture_content_model->update($id_moisture, $data);
            $this->session->set_flashdata('message', 'Update Record Success');
        }
    
        if ($this->is_valid_return_url($return_url)) {
            redirect($return_url);
            return;
        }

        redirect(site_url("moisture_content"));
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

    
    public function savedetail24() {
            $mode_det24 = $this->input->post('mode_det24', TRUE);
            $dt = new DateTime();
            $return_url = $this->input->post('return_url', TRUE);
            // var_dump($id_moisture);
            // die();
            $id_one_water_sample = $this->input->post('id24_one_water_sample', TRUE);
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
        
                $insert_id = $this->Moisture_content_model->insert_det24($data);
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
                $result = $this->Moisture_content_model->update_det24($id_moisture24, $data);
                if ($result) {
                    $this->session->set_flashdata('message', 'Update Record Success');
                } else {
                    $this->session->set_flashdata('error', 'Failed to update record');
                }
            }
        
            $redirect_url = site_url("moisture_content/read/" . $id_one_water_sample);
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
        $id_moisture = $this->input->post('idx_moisture72', TRUE);
        $id_moisture72 = $this->input->post('id_moisture72', TRUE);
        $date_moisture72 = $this->input->post('date_moisture72', TRUE);
        $time_moisture72 = $this->input->post('time_moisture72', TRUE);
        $barcode_tray = $this->input->post('barcode_tray72', TRUE);
        $dry_weight72 = $this->input->post('dry_weight72', TRUE);
        $moisture_content_persen = $this->input->post('moisture_content_persen', TRUE);
        $dry_weight_persen = $this->input->post('dry_weight_persen', TRUE);
        $comments72 = $this->input->post('comments72', TRUE);

        if($mode_det72 == "insert") {
            $data = array(
                'id_moisture' => $id_moisture,
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
    
            $insert_id = $this->Moisture_content_model->insert_det72($data);
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
            $result = $this->Moisture_content_model->update_det72($id_moisture72, $data);
            if ($result) {
                $this->session->set_flashdata('message', 'Update Record Success');
            } else {
                $this->session->set_flashdata('error', 'Failed to update record');
            }
        }
    
        $redirect_url = site_url("moisture_content/read/" . $id_one_water_sample);
        if ($this->is_valid_return_url($return_url)) {
            $redirect_url .= '?return_url=' . rawurlencode($return_url);
        }

        redirect($redirect_url);

    }
  

    public function delete($id) 
    {
        $row = $this->Moisture_content_model->get_by_id($id);
        
        if ($row) {
            $id_moisture = $row->id_moisture;
            
            // Cascade delete: soft delete all moisture24 and moisture72 records
            $this->Moisture_content_model->cascade_delete_moisture24_72($id_moisture);
            
            // Soft-delete the moisture_content record
            $data = array(
                'flag' => 1,
            );
            $this->Moisture_content_model->delete_moisture_content($id, $data);
            
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('moisture_content'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('moisture_content'));
        }
    }

    public function delete_detail24($id) 
    {
        $row = $this->Moisture_content_model->get_by_id_detail24($id);
        if ($row) {
            $id_parent = $row->id_moisture; // Retrieve id_moisture before updating the record
            
            // Cascade delete: soft delete all moisture72 records with same id_moisture
            $this->Moisture_content_model->cascade_delete_moisture72($id_parent);
            
            // Soft-delete the moisture24 record
            $data = array(
                'flag' => 1,
            );
    
            $this->Moisture_content_model->update_det24($id, $data);
            $this->session->set_flashdata('message', 'Delete Record Success');
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
        }
    
        redirect(site_url('Moisture_content/read/'.$id_parent));
    }

    public function delete_detail72($id) 
    {
        $row = $this->Moisture_content_model->get_by_id_detail72($id);
        if ($row) {
            $id_parent = $row->id_moisture; // Retrieve project_id before updating the record
            $data = array(
                'flag' => 1,
            );
    
            $this->Moisture_content_model->update_det72($id, $data);
            $this->session->set_flashdata('message', 'Delete Record Success');
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
        }
    
        redirect(site_url('moisture_content/read/'.$id_parent));
    }


    public function getIdOneWaterDetails()
    {
        $idOneWaterSample = $this->input->post('id_one_water_sample');
        $oneWaterSample = $this->Moisture_content_model->getOneWaterSampleById($idOneWaterSample);
        echo json_encode($oneWaterSample);
    }

    public function validate24() {
        $id = $this->input->get('id24');
        $data = $this->Moisture_content_model->validate24($id);
        header('Content-Type: application/json');
        echo json_encode($data);
    }

    public function validate72() {
        $id = $this->input->get('id72');
        $data = $this->Moisture_content_model->validate72($id);
        header('Content-Type: application/json');
        echo json_encode($data);
    }

    public function excel() 
    {
        $this->load->database();
    
        $spreadsheet = new Spreadsheet();    
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setCellValue('A1', "Id One Water Sample"); 
        $sheet->setCellValue('B1', "Lab Tech"); 
        $sheet->setCellValue('C1', "Date Assay Start");
        $sheet->setCellValue('D1', "Sample Type");
        $sheet->setCellValue('E1', "Barcode Moisture Content");
        $sheet->setCellValue('F1', "Tray Weight (g)");
        $sheet->setCellValue('G1', "Tray sample(g) wet weight");
        $sheet->setCellValue('H1', "Time Incubator");
        $sheet->setCellValue('I1', "Comments");
        $sheet->setCellValue('J1', "Date Moisture 24");
        $sheet->setCellValue('K1', "Time Moisture 24");
        $sheet->setCellValue('L1', "Barcode Tray 24");
        $sheet->setCellValue('M1', "Dry Weight 24 (g)");
        $sheet->setCellValue('N1', "Comments 24");
        $sheet->setCellValue('O1', "Date Moisture 48");
        $sheet->setCellValue('P1', "Time Moisture 48");
        $sheet->setCellValue('Q1', "Barcode Tray 48");
        $sheet->setCellValue('R1', "Dry Weight 48 (g)");
        $sheet->setCellValue('S1', "Moisture content (%)");
        $sheet->setCellValue('T1', "Comments 48");

        $moisture = $this->Moisture_content_model->get_all();
    
        $numrow = 2;
        foreach($moisture as $data){ 
            // Id One Water Sample
            $sheet->setCellValue('A'.$numrow, property_exists($data, 'id_one_water_sample') ? $data->id_one_water_sample : '');
            
            // Lab Tech
            $sheet->setCellValue('B'.$numrow, property_exists($data, 'initial') ? $data->initial : '');
            
            // Date Assay Start
            $sheet->setCellValue('C'.$numrow, property_exists($data, 'date_start') ? $data->date_start : '');
            
            // Sample Type
            $sheet->setCellValue('D'.$numrow, property_exists($data, 'sampletype') ? $data->sampletype : '');
            
            // Barcode Moisture Content
            $sheet->setCellValue('E'.$numrow, property_exists($data, 'barcode_moisture_content') ? $data->barcode_moisture_content : '');
            
            // Tray Weight (g)
            $sheet->setCellValue('F'.$numrow, property_exists($data, 'tray_weight') ? $data->tray_weight : '');
            
            // Tray sample(g) wet weight
            $sheet->setCellValue('G'.$numrow, property_exists($data, 'traysample_wetweight') ? $data->traysample_wetweight : '');
            
            // Time Incubator
            $sheet->setCellValue('H'.$numrow, property_exists($data, 'time_incubator') ? $data->time_incubator : '');
            
            // Comments
            $sheet->setCellValue('I'.$numrow, property_exists($data, 'comments') ? $data->comments : '');
            
            // Date Moisture 24
            $sheet->setCellValue('J'.$numrow, property_exists($data, 'date_moisture24') ? $data->date_moisture24 : '');
            
            // Time Moisture 24
            $sheet->setCellValue('K'.$numrow, property_exists($data, 'time_moisture24') ? $data->time_moisture24 : '');
            
            // Barcode Tray 24
            $sheet->setCellValue('L'.$numrow, property_exists($data, 'barcode_tray24') ? $data->barcode_tray24 : '');
            
            // Dry Weight 24 (g)
            $sheet->setCellValue('M'.$numrow, property_exists($data, 'dry_weight24') ? $data->dry_weight24 : '');
            
            // Comments 24
            $sheet->setCellValue('N'.$numrow, property_exists($data, 'comments24') ? $data->comments24 : '');
            
            // Date Moisture 48 (was 72)
            $sheet->setCellValue('O'.$numrow, property_exists($data, 'date_moisture72') ? $data->date_moisture72 : '');
            
            // Time Moisture 48 (was 72)
            $sheet->setCellValue('P'.$numrow, property_exists($data, 'time_moisture72') ? $data->time_moisture72 : '');
            
            // Barcode Tray 48
            $sheet->setCellValue('Q'.$numrow, property_exists($data, 'barcode_tray72') ? $data->barcode_tray72 : '');
            
            // Dry Weight 48 (g) (was 72)
            $sheet->setCellValue('R'.$numrow, property_exists($data, 'dry_weight72') ? $data->dry_weight72 : '');
            
            // Moisture content (%)
            $sheet->setCellValue('S'.$numrow, property_exists($data, 'dry_weight_persen') ? $data->dry_weight_persen : '');
            
            // Comments 48 (was 72)
            $sheet->setCellValue('T'.$numrow, property_exists($data, 'comments72') ? $data->comments72 : '');

            $numrow++;
        }

        // Clear any output before sending file
        if (ob_get_level()) {
            ob_end_clean();
        }

        // Set header untuk file excel
        $datenow = date("Ymd");
        $filename = 'Report_moisture_content_'.$datenow.'.xlsx';
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="'.$filename.'"');
        header('Cache-Control: max-age=0');
        header('Cache-Control: max-age=1');
        header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
        header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT');
        header('Cache-Control: cache, must-revalidate');
        header('Pragma: public');

        // Tampilkan file excel
        $writer = new Xlsx($spreadsheet);
        $writer->save('php://output');
        exit;
    }

    public function csv()
    {
        $this->load->database();

        $moisture = $this->Moisture_content_model->get_all();

        // Column headers
        $columns = array(
            'Id One Water Sample', 'Lab Tech', 'Date Assay Start', 'Sample Type', 
            'Barcode Moisture Content', 'Tray Weight (g)', 'Tray sample(g) wet weight', 
            'Time Incubator', 'Comments', 'Date Moisture 24', 'Time Moisture 24', 
            'Barcode Tray 24', 'Dry Weight 24 (g)', 'Comments 24', 'Date Moisture 48', 
            'Time Moisture 48', 'Barcode Tray 48', 'Dry Weight 48 (g)', 'Moisture content (%)', 
            'Comments 48'
        );

        // Clear any output before sending file
        if (ob_get_level()) {
            ob_end_clean();
        }

        // Set headers for CSV download
        $datenow = date("Ymd");
        $filename = 'Report_moisture_content_'.$datenow.'.csv';
        
        header('Content-Type: text/csv; charset=utf-8');
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        header('Cache-Control: max-age=0');
        header('Pragma: public');

        // Open output stream
        $output = fopen('php://output', 'w');

        // Add BOM to fix UTF-8 in Excel
        fprintf($output, chr(0xEF).chr(0xBB).chr(0xBF));

        // Add column headers
        fputcsv($output, $columns);

        // Add data rows
        foreach ($moisture as $data) {
            $row = array(
                property_exists($data, 'id_one_water_sample') ? $data->id_one_water_sample : '',
                property_exists($data, 'initial') ? $data->initial : '',
                property_exists($data, 'date_start') ? $data->date_start : '',
                property_exists($data, 'sampletype') ? $data->sampletype : '',
                property_exists($data, 'barcode_moisture_content') ? $data->barcode_moisture_content : '',
                property_exists($data, 'tray_weight') ? $data->tray_weight : '',
                property_exists($data, 'traysample_wetweight') ? $data->traysample_wetweight : '',
                property_exists($data, 'time_incubator') ? $data->time_incubator : '',
                property_exists($data, 'comments') ? $data->comments : '',
                property_exists($data, 'date_moisture24') ? $data->date_moisture24 : '',
                property_exists($data, 'time_moisture24') ? $data->time_moisture24 : '',
                property_exists($data, 'barcode_tray24') ? $data->barcode_tray24 : '',
                property_exists($data, 'dry_weight24') ? $data->dry_weight24 : '',
                property_exists($data, 'comments24') ? $data->comments24 : '',
                property_exists($data, 'date_moisture72') ? $data->date_moisture72 : '',
                property_exists($data, 'time_moisture72') ? $data->time_moisture72 : '',
                property_exists($data, 'barcode_tray72') ? $data->barcode_tray72 : '',
                property_exists($data, 'dry_weight72') ? $data->dry_weight72 : '',
                property_exists($data, 'dry_weight_persen') ? $data->dry_weight_persen : '',
                property_exists($data, 'comments72') ? $data->comments72 : ''
            );
            fputcsv($output, $row);
        }

        fclose($output);
        exit;
    }

    public function validateBarcodeMoistureContent() {
        $id = $this->input->get('id');
        $data = $this->Moisture_content_model->validateBarcodeMoistureContent($id);
        header('Content-Type: application/json');
        echo json_encode($data);
    }

    public function barcode_restrict() 
    {
        $id = $this->input->get('id1');
        $data = $this->Moisture_content_model->barcode_restrict($id);
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
    
        $this->load->model('Moisture_content_model');
        $this->Moisture_content_model->updateSave($id, $data);
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
        $this->load->model('Moisture_content_model');
        $updateResult = $this->Moisture_content_model->updateCancel($id, $data);

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