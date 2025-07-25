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
        // $data['id_one_water_sample'] = $this->Moisture_content_model->generate_one_water_sample_id();
        $this->template->load('template','moisture_content/index', $data);
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
                // 'uuid' => $this->uuid->v4(),
                'user_updated' => $this->session->userdata('id_users'),
                'date_updated' => $dt->format('Y-m-d H:i:s'),
            );

            // var_dump($data);
            // die();

            $this->Moisture_content_model->update($id_moisture, $data);
            $this->session->set_flashdata('message', 'Update Record Success');
        }
    
        redirect(site_url("moisture_content"));
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
        
            redirect(site_url("moisture_content/read/" . $id_moisture));
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
    
        redirect(site_url("moisture_content/read/" . $id_moisture));

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
            $id_parent = $row->id_moisture; // Retrieve project_id before updating the record
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

        $moisture = $this->Moisture_content_model->get_all();
    
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
        header('Content-Disposition: attachment;filename="Report_moisture_content.xlsx"');
        header('Cache-Control: max-age=0');

        // Tampilkan file excel
        $writer = new Xlsx($spreadsheet);
        $writer->save('php://output');
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

}

/* End of file Water_sample_reception.php */
/* Location: ./application/controllers/Water_sample_reception.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2022-12-14 03:38:42 */
/* http://harviacode.com */