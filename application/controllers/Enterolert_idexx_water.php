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
    
class Enterolert_idexx_water extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        is_login();
        $this->load->model('Enterolert_idexx_water_model');
        $this->load->library('form_validation');        
	    $this->load->library('datatables');
	    $this->load->library('uuid');
    }

    public function index()
    {
        $data['id_one'] = $this->Enterolert_idexx_water_model->getID_one();
        $data['sampletype'] = $this->Enterolert_idexx_water_model->getSampleType();
        $data['labtech'] = $this->Enterolert_idexx_water_model->getLabTech();
        // $data['id_project'] = $this->Moisture_content_model->generate_project_id();
        // $data['client'] = $this->Moisture_content_model->generate_client();
        // $data['id_one_water_sample'] = $this->Moisture_content_model->generate_one_water_sample_id();
        $this->template->load('template','Enterolert_idexx_water/index', $data);
    } 
    
    public function json() {
        header('Content-Type: application/json');
        echo $this->Enterolert_idexx_water_model->json();
    }

    public function subjson() {
        $id = $this->input->get('id',TRUE);
        header('Content-Type: application/json');
        echo $this->Enterolert_idexx_water_model->subjson($id);
    }

    public function subjson72() {
        $id = $this->input->get('id72',TRUE);
        header('Content-Type: application/json');
        echo $this->Enterolert_idexx_water_model->subjson72($id);
    }

    public function read($id)
    {
        // $data['testing_type'] = $this->Moisture_content_model->getTest();
        // $data['barcode'] = $this->Water_sample_reception_model->getBarcode();
        // var_dump($id);
        // die();
        $row = $this->Enterolert_idexx_water_model->get_detail($id);
        if ($row) {
            $data = array(
                'id_enterolert_in' => $row->id_enterolert_in,
                'id_one_water_sample' => $row->id_one_water_sample,
                'initial' => $row->initial,
                'sampletype' => $row->sampletype,
                'enterolert_barcode' => $row->enterolert_barcode,
                'date_sample' => $row->date_sample,
                'time_sample' => $row->time_sample,
                'volume_bottle' => $row->volume_bottle,
                'dilution' =>$row->dilution,
            );


                
            $this->template->load('template','Enterolert_idexx_water/index_det', $data);

        }
        else {
            // $this->template->load('template','Water_sample_reception/index_det', $test);
        }

    } 

    public function read2($id)
    {
        $data['test'] = $this->Enterolert_idexx_water_model->getTest();
        $row = $this->Enterolert_idexx_water_model->get_detail2($id);
        if ($row) {
            $data = array(
                // 'id_project' => $row->id_project,
                // 'id_sample' => $row->id_sample,
                // 'sample_description' => $row->sample_description,
                'test' => $this->Enterolert_idexx_water_model->getTest(),
                );
                $this->template->load('template','Enterolert_idexx_water/index_det2', $data);
        }
        else {
            // $this->template->load('template','Water_sample_reception/index_det');
        }
    }     

    public function save() {
        $mode = $this->input->post('mode', TRUE);
        $id_enterolert = $this->input->post('idx_enterolert', TRUE);
        $dt = new DateTime();

        $id_one_water_sample = $this->input->post('id_one_water_sample', TRUE);
        $idx_one_water_sample = $this->input->post('idx_one_water_sample', TRUE);
        $id_person = $this->input->post('id_person', TRUE);
        $id_sampletype = $this->input->post('id_sampletype', TRUE);
        $enterolert_barcode = $this->input->post('enterolert_barcode', TRUE);
        $date_sample = $this->input->post('date_sample', TRUE);
        $time_sample = $this->input->post('time_sample', TRUE);
        $volume_bottle = $this->input->post('volume_bottle', TRUE);
        $dilution = $this->input->post('dilution', TRUE);
        // $date_collected = $this->input->post('date_collected',TRUE);
        // $time_collected = $this->input->post('time_collected',TRUE);
        
    
        if ($mode == "insert") {
            $data = array(
                'id_one_water_sample' => $id_one_water_sample,
                'id_person' => $id_person,
                'id_sampletype' => $id_sampletype,
                'enterolert_barcode' => $enterolert_barcode,
                'date_sample' => $date_sample,
                'time_sample' => $time_sample,
                'volume_bottle' => $volume_bottle,
                'dilution' => $dilution,
                'flag' => '0',
                'lab' => $this->session->userdata('lab'),
                'uuid' => $this->uuid->v4(),
                'user_created' => $this->session->userdata('id_users'),
                'date_created' => $dt->format('Y-m-d H:i:s'),
            );

            // var_dump($data);
            // die();
    
            $this->Enterolert_idexx_water_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');

        } else if ($mode == "edit") {
            $data = array(
                'id_one_water_sample' => $idx_one_water_sample,
                'id_person' => $id_person,
                'id_sampletype' => $id_sampletype,
                'enterolert_barcode' => $enterolert_barcode,
                'date_sample' => $date_sample,
                'time_sample' => $time_sample,
                'volume_bottle' => $volume_bottle,
                'dilution' => $dilution,
                'flag' => '0',
                'lab' => $this->session->userdata('lab'),
                // 'uuid' => $this->uuid->v4(),
                'user_updated' => $this->session->userdata('id_users'),
                'date_updated' => $dt->format('Y-m-d H:i:s'),
            );

            // var_dump($data);
            // die();

            $this->Enterolert_idexx_water_model->update($id_enterolert, $data);
            $this->session->set_flashdata('message', 'Update Record Success');
        }
    
        redirect(site_url("Enterolert_idexx_water"));
    }

    
    public function savedetail() {
            $mode_det = $this->input->post('mode_det', TRUE);
            $dt = new DateTime();
            // var_dump($id_moisture);
            // die();
        
            $id_enterolert_in = $this->input->post('idx_enterolert_in', TRUE);
            $id_enterolert_out = $this->input->post('id_enterolert_out', TRUE);
            $enterolert_barcode = $this->input->post('enterolert_barcodex', TRUE);
            $date_sample = $this->input->post('date_sample', TRUE);
            $time_sample = $this->input->post('time_sample', TRUE);
            $enterococcus_largewells = $this->input->post('enterococcus_largewells', TRUE);
            $enterococcus_smallwells = $this->input->post('enterococcus_smallwells', TRUE);
            $enterococcus = $this->input->post('enterococcus', TRUE);
            $remarks = $this->input->post('remarks', TRUE);
        
            if($mode_det == "insert") {
                $data = array(
                    'id_enterolert_in' => $id_enterolert_in,
                    'enterolert_barcode' => $enterolert_barcode,
                    'date_sample' => $date_sample,
                    'time_sample' => $time_sample,
                    'enterococcus_largewells' => $enterococcus_largewells,
                    'enterococcus_smallwells' => $enterococcus_smallwells,
                    'enterococcus' => $enterococcus,
                    'remarks' => $remarks,
                    'flag' => '0',
                    'lab' => $this->session->userdata('lab'),
                    'uuid' => $this->uuid->v4(),
                    'user_created' => $this->session->userdata('id_users'),
                    'date_created' => $dt->format('Y-m-d H:i:s'),
                );
                // var_dump($data);
                // die();
        
                $insert_id = $this->Enterolert_idexx_water_model->insert_det($data);
                if ($insert_id) {
                    $this->session->set_flashdata('message', 'Create Record Success');
                } else {
                    $this->session->set_flashdata('error', 'Failed to create record');
                }
            } else if($mode_det == "edit") {
                $data = array(
                    'enterolert_barcode' => $enterolert_barcode,
                    'date_sample' => $date_sample,
                    'time_sample' => $time_sample,
                    'enterococcus_largewells' => $enterococcus_largewells,
                    'enterococcus_smallwells' => $enterococcus_smallwells,
                    'enterococcus' => $enterococcus,
                    'remarks' => $remarks,
                    'flag' => '0',
                    'lab' => $this->session->userdata('lab'),
                    // 'uuid' => $this->uuid->v4(),
                    'user_updated' => $this->session->userdata('id_users'),
                    'date_updated' => $dt->format('Y-m-d H:i:s'),
                );
                // var_dump($data);
                // die();
                $result = $this->Enterolert_idexx_water_model->update_det($id_enterolert_out, $data);
                if ($result) {
                    $this->session->set_flashdata('message', 'Update Record Success');
                } else {
                    $this->session->set_flashdata('error', 'Failed to update record');
                }
            }
        
            redirect(site_url("Enterolert_idexx_water/read/" . $id_enterolert_in));
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
    
            $insert_id = $this->Enterolert_idexx_water_model->insert_det72($data);
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
            $result = $this->Enterolert_idexx_water_model->update_det72($id_moisture72, $data);
            if ($result) {
                $this->session->set_flashdata('message', 'Update Record Success');
            } else {
                $this->session->set_flashdata('error', 'Failed to update record');
            }
        }
    
        redirect(site_url("Moisture_content/read/" . $id_moisture));

    }
  

    public function delete($id) 
    {
        $row = $this->Enterolert_idexx_water_model->get_by_id($id);
        $data = array(
            'flag' => 1,
            );

        if ($row) {
            $this->Enterolert_idexx_water_model->update($id, $data);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('Enterolert_idexx_water'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('Enterolert_idexx_water'));
        }
    }

    public function delete_detail($id) 
    {
        $row = $this->Enterolert_idexx_water_model->get_by_id_detail($id);
        if ($row) {
            $id_parent = $row->id_enterolert_in; // Retrieve project_id before updating the record
            $data = array(
                'flag' => 1,
            );
    
            $this->Enterolert_idexx_water_model->update_det($id, $data);
            $this->session->set_flashdata('message', 'Delete Record Success');
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
        }
    
        redirect(site_url('Enterolert_idexx_water/read/'.$id_parent));
    }

    public function delete_detail72($id) 
    {
        $row = $this->Enterolert_idexx_water_model->get_by_id_detail72($id);
        if ($row) {
            $id_parent = $row->id_moisture; // Retrieve project_id before updating the record
            $data = array(
                'flag' => 1,
            );
    
            $this->Enterolert_idexx_water_model->update_det72($id, $data);
            $this->session->set_flashdata('message', 'Delete Record Success');
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
        }
    
        redirect(site_url('Moisture_content/read/'.$id_parent));
    }


    public function getIdOneWaterDetails()
    {
        $idOneWaterSample = $this->input->post('id_one_water_sample');
        $oneWaterSample = $this->Enterolert_idexx_water_model->getOneWaterSampleById($idOneWaterSample);
        echo json_encode($oneWaterSample);
    }

    public function validate24() {
        $id = $this->input->get('id24');
        $data = $this->Enterolert_idexx_water_model->validate24($id);
        header('Content-Type: application/json');
        echo json_encode($data);
    }

    public function validate72() {
        $id = $this->input->get('id72');
        $data = $this->Enterolert_idexx_water_model->validate72($id);
        header('Content-Type: application/json');
        echo json_encode($data);
    }
    
    public function excel() {
    
        $spreadsheet = new Spreadsheet();    
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setCellValue('A1', "Id Enterolert In"); 
        $sheet->setCellValue('B1', "Id One Water Sample"); 
        $sheet->setCellValue('C1', "Lab Tech"); 
        $sheet->setCellValue('D1', "Sample Type");
        $sheet->setCellValue('E1', "Enterolert Barcode");
        $sheet->setCellValue('F1', "Date Sample In");
        $sheet->setCellValue('G1', "Time Sample In");
        $sheet->setCellValue('H1', "Volume Bottle");
        $sheet->setCellValue('I1', "Dilution");
        $sheet->setCellValue('J1', "Id Enterolert Out");
        $sheet->setCellValue('K1', "Enterolert Barcode");
        $sheet->setCellValue('L1', "Date Sample Out");
        $sheet->setCellValue('M1', "Time Sample Out");
        $sheet->setCellValue('N1', "Enterococcus Large Wells");
        $sheet->setCellValue('O1', "Enterococcus Small Wells");
        $sheet->setCellValue('P1', "Enterococcus");
        $sheet->setCellValue('Q1', "Remarks");

        $moisture = $this->Enterolert_idexx_water_model->get_all();
    
        $numrow = 2;
        foreach($moisture as $data){ 

            if (property_exists($data, 'id_enterolert_in')) {
                $sheet->setCellValue('A'.$numrow, $data->id_enterolert_in);
            } else {
                $sheet->setCellValue('A'.$numrow, '');
            }

            if (property_exists($data, 'id_one_water_sample')) {
                $sheet->setCellValue('B'.$numrow, $data->id_one_water_sample);
            } else {
                $sheet->setCellValue('B'.$numrow, '');
            }
    
            if (property_exists($data, 'initial')) {
                $sheet->setCellValue('C'.$numrow, $data->initial);
            } else {
                $sheet->setCellValue('C'.$numrow, '');
            }
    
            if (property_exists($data, 'sample_type')) {
                $sheet->setCellValue('D'.$numrow, $data->sampletype);
            } else {
                $sheet->setCellValue('D'.$numrow, '');
            }
    
            if (property_exists($data, 'enterolert_barcode')) {
                $sheet->setCellValue('E'.$numrow, $data->enterolert_barcode);
            } else {
                $sheet->setCellValue('E'.$numrow, '');
            }
    
            if (property_exists($data, 'date_sample')) {
                $sheet->setCellValue('F'.$numrow, $data->date_sample);
            } else {
                $sheet->setCellValue('F'.$numrow, '');
            }
    
            if (property_exists($data, 'time_sample')) {
                $sheet->setCellValue('G'.$numrow, $data->time_sample);
            } else {
                $sheet->setCellValue('G'.$numrow, '');
            }
    
            if (property_exists($data, 'volume_bottle')) {
                $sheet->setCellValue('H'.$numrow, $data->volume_bottle);
            } else {
                $sheet->setCellValue('H'.$numrow, '');
            }
    
            if (property_exists($data, 'dilution')) {
                $sheet->setCellValue('I'.$numrow, $data->dilution);
            } else {
                $sheet->setCellValue('I'.$numrow, '');
            }

            if (property_exists($data, 'id_enterolert_out')) {
                $sheet->setCellValue('J'.$numrow, $data->id_enterolert_out);
            } else {
                $sheet->setCellValue('J'.$numrow, '');
            }
    
            if (property_exists($data, 'enterolert_barcode')) {
                $sheet->setCellValue('K'.$numrow, $data->enterolert_barcode);
            } else {
                $sheet->setCellValue('K'.$numrow, '');
            }
    
            if (property_exists($data, 'date_sample')) {
                $sheet->setCellValue('L'.$numrow, $data->date_sample);
            }  else {
                $sheet->setCellValue('L'.$numrow, '');
            }

           
            if (property_exists($data, 'time_sample')) {
                $sheet->setCellValue('M'.$numrow, $data->time_sample);
            } else {
                $sheet->setCellValue('M'.$numrow, '');
            }

            if (property_exists($data, 'enterococcus_largewells')) {
                $sheet->setCellValue('N'.$numrow, $data->enterococcus_largewells);
            } else {
                $sheet->setCellValue('N'.$numrow, '');
            }

            if (property_exists($data, 'enterococcus_smallwells')) {
                $sheet->setCellValue('O'.$numrow, $data->enterococcus_smallwells);
            } else {
                $sheet->setCellValue('O'.$numrow, '');
            }

            if (property_exists($data, 'enterococcus')) {
                $sheet->setCellValue('P'.$numrow, $data->enterococcus);
            } else {
                $sheet->setCellValue('P'.$numrow, '');
            }

            if (property_exists($data, 'remarks')) {
                $sheet->setCellValue('Q'.$numrow, $data->remarks);
            } else {
                $sheet->setCellValue('Q'.$numrow, '');
            }

            $numrow++;
        }

        // Set header untuk file excel
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="Report_enterolert_idexx_water.xlsx"');
        header('Cache-Control: max-age=0');

        // Tampilkan file excel
        $writer = new Xlsx($spreadsheet);
        $writer->save('php://output');
    }

    public function validateBarcodeMoistureContent() {
        $id = $this->input->get('id');
        $data = $this->Enterolert_idexx_water_model->validateBarcodeMoistureContent($id);
        header('Content-Type: application/json');
        echo json_encode($data);
    }

    public function data_chart() 
    {
        $valueLargeWells = $this->input->get('valueLargeWells');
        $valueSmallWells = $this->input->get('valueSmallWells');
        $data = $this->Enterolert_idexx_water_model->data_chart($valueLargeWells, $valueSmallWells);
        header('Content-Type: application/json');
        echo json_encode($data);
    }

}

/* End of file Water_sample_reception.php */
/* Location: ./application/controllers/Water_sample_reception.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2022-12-14 03:38:42 */
/* http://harviacode.com */