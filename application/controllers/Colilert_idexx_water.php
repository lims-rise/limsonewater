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
    
class Colilert_idexx_water extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        is_login();
        $this->load->model('Colilert_idexx_water_model');
        $this->load->library('form_validation');        
	    $this->load->library('datatables');
	    $this->load->library('uuid');
    }

    public function index()
    {
        $data['id_one'] = $this->Colilert_idexx_water_model->getID_one();
        $data['sampletype'] = $this->Colilert_idexx_water_model->getSampleType();
        $data['labtech'] = $this->Colilert_idexx_water_model->getLabTech();
        // $data['id_project'] = $this->Moisture_content_model->generate_project_id();
        // $data['client'] = $this->Moisture_content_model->generate_client();
        // $data['id_one_water_sample'] = $this->Moisture_content_model->generate_one_water_sample_id();
        $this->template->load('template','colilert_idexx_water/index', $data);
    } 
    
    public function json() {
        header('Content-Type: application/json');
        echo $this->Colilert_idexx_water_model->json();
    }

    public function subjson() {
        $id = $this->input->get('id',TRUE);
        header('Content-Type: application/json');
        echo $this->Colilert_idexx_water_model->subjson($id);
    }

    // public function subjson72() {
    //     $id = $this->input->get('id72',TRUE);
    //     header('Content-Type: application/json');
    //     echo $this->Colilert_idexx_water_model->subjson72($id);
    // }

    public function read($id)
    {
        // $data['testing_type'] = $this->Moisture_content_model->getTest();
        // $data['barcode'] = $this->Water_sample_reception_model->getBarcode();
        // var_dump($id);
        // die();
        $row = $this->Colilert_idexx_water_model->get_detail($id);
        if ($row) {
            $data = array(
                'id_colilert_in' => $row->id_colilert_in,
                'id_one_water_sample' => $row->id_one_water_sample,
                'initial' => $row->initial,
                'sampletype' => $row->sampletype,
                'colilert_barcode' => $row->colilert_barcode,
                'date_sample' => $row->date_sample,
                'time_sample' => $row->time_sample,
                // 'wet_weight' => $row->wet_weight,
                // 'elution_volume' => $row->elution_volume,
                'volume_bottle' => $row->volume_bottle,
                'dilution' =>$row->dilution,
            );


                
            $this->template->load('template','colilert_idexx_water/index_det', $data);

        }
        else {
            // $this->template->load('template','Water_sample_reception/index_det', $test);
        }

    }   

    public function save() {
        $mode = $this->input->post('mode', TRUE);
        $idx_colilert_water_in = $this->input->post('idx_colilert_water_in', TRUE);
        $dt = new DateTime();

        $id_one_water_sample = $this->input->post('id_one_water_sample', TRUE);
        $idx_one_water_sample = $this->input->post('idx_one_water_sample', TRUE);
        $id_person = $this->input->post('id_person', TRUE);
        $id_sampletype = $this->input->post('id_sampletype', TRUE);
        $colilert_barcode = $this->input->post('colilert_barcode', TRUE);
        $date_sample = $this->input->post('date_sample', TRUE);
        $time_sample = $this->input->post('time_sample', TRUE);
        $volume_bottle = $this->input->post('volume_bottle', TRUE);
        $dilution = $this->input->post('dilution', TRUE);
        
    
        if ($mode == "insert") {
            $data = array(
                'id_one_water_sample' => $id_one_water_sample,
                'id_person' => $id_person,
                'id_sampletype' => $id_sampletype,
                'colilert_barcode' => $colilert_barcode,
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
    
            $this->Colilert_idexx_water_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');

        } else if ($mode == "edit") {
            $data = array(
                'id_one_water_sample' => $idx_one_water_sample,
                'id_person' => $id_person,
                'id_sampletype' => $id_sampletype,
                'colilert_barcode' => $colilert_barcode,
                'date_sample' => $date_sample,
                'time_sample' => $time_sample,
                'volume_bottle' => $volume_bottle,
                'dilution' => $dilution,
                'flag' => '0',
                'lab' => $this->session->userdata('lab'),
                'user_updated' => $this->session->userdata('id_users'),
                'date_updated' => $dt->format('Y-m-d H:i:s'),
            );

            // var_dump($data);
            // die();

            $this->Colilert_idexx_water_model->update($idx_colilert_water_in, $data);
            $this->session->set_flashdata('message', 'Update Record Success');
        }
    
        redirect(site_url("colilert_idexx_water"));
    }

    
    public function savedetail() {
            $mode_det = $this->input->post('mode_det', TRUE);
            $dt = new DateTime();
            // var_dump($id_moisture);
            // die();
        
            $idx_colilert_in = $this->input->post('idx_colilert_in', TRUE);
            $id_colilert_out = $this->input->post('id_colilert_out', TRUE);
            $colilert_barcode = $this->input->post('colilert_barcodex', TRUE);
            $date_sample = $this->input->post('date_sample', TRUE);
            $time_sample = $this->input->post('time_sample', TRUE);
            $ecoli_largewells = $this->input->post('ecoli_largewells', TRUE);
            $ecoli_smallwells = $this->input->post('ecoli_smallwells', TRUE);
            $ecoli = $this->input->post('ecoli', TRUE);
            $lowerdetection = $this->input->post('lowerdetection', TRUE);
            $coliforms_largewells = $this->input->post('coliforms_largewells', TRUE);
            $coliforms_smallwells = $this->input->post('coliforms_smallwells', TRUE);
            $total_coliforms = $this->input->post('total_coliforms', TRUE);
            $remarks = $this->input->post('remarks', TRUE);
            $id_one_water_sample = $this->input->post('idx_one_water_sample', TRUE);

            if($mode_det == "insert") {
                $data = array(
                    'id_colilert_in' => $idx_colilert_in,
                    'colilert_barcode' => $colilert_barcode,
                    'date_sample' => $date_sample,
                    'time_sample' => $time_sample,
                    'ecoli_largewells' => $ecoli_largewells,
                    'ecoli_smallwells' => $ecoli_smallwells,
                    'ecoli' => $ecoli,
                    'lowerdetection' => $lowerdetection,
                    'coliforms_largewells' => $coliforms_largewells,
                    'coliforms_smallwells' => $coliforms_smallwells,
                    'total_coliforms' => $total_coliforms,
                    'remarks' => $remarks,
                    'flag' => '0',
                    'lab' => $this->session->userdata('lab'),
                    'uuid' => $this->uuid->v4(),
                    'user_created' => $this->session->userdata('id_users'),
                    'date_created' => $dt->format('Y-m-d H:i:s'),

                );
                // var_dump($data);
                // die();
        
                $insert_id = $this->Colilert_idexx_water_model->insert_det($data);
                if ($insert_id) {
                    $this->session->set_flashdata('message', 'Create Record Success');
                } else {
                    $this->session->set_flashdata('error', 'Failed to create record');
                }
            } else if($mode_det == "edit") {
                $data = array(
                    'colilert_barcode' => $colilert_barcode,
                    'date_sample' => $date_sample,
                    'time_sample' => $time_sample,
                    'ecoli_largewells' => $ecoli_largewells,
                    'ecoli_smallwells' => $ecoli_smallwells,
                    'ecoli' => $ecoli,
                    'lowerdetection' => $lowerdetection,
                    'coliforms_largewells' => $coliforms_largewells,
                    'coliforms_smallwells' => $coliforms_smallwells,
                    'total_coliforms' => $total_coliforms,
                    'remarks' => $remarks,
                    'flag' => '0',
                    'lab' => $this->session->userdata('lab'),
                    // 'uuid' => $this->uuid->v4(),
                    'user_updated' => $this->session->userdata('id_users'),
                    'date_updated' => $dt->format('Y-m-d H:i:s'),
                );
                // var_dump($data);
                // die();
                $result = $this->Colilert_idexx_water_model->update_det($id_colilert_out, $data);
                if ($result) {
                    $this->session->set_flashdata('message', 'Update Record Success');
                } else {
                    $this->session->set_flashdata('error', 'Failed to update record');
                }
            }
        
            redirect(site_url("colilert_idexx_water/read/" . $id_one_water_sample));
    }


    public function delete($id) 
    {
        $row = $this->Colilert_idexx_water_model->get_by_id($id);
        $data = array(
            'flag' => 1,
            );

        if ($row) {
            $this->Colilert_idexx_water_model->update($id, $data);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('colilert_idexx_water'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('colilert_idexx_water'));
        }
    }

    public function delete_detail($id) 
    {
        $row = $this->Colilert_idexx_water_model->get_by_id_detail($id);
        if ($row) {
            $id_parent = $row->id_colilert_out; // Retrieve project_id before updating the record
            $data = array(
                'flag' => 1,
            );
    
            $this->Colilert_idexx_water_model->update_det($id, $data);
            $this->session->set_flashdata('message', 'Delete Record Success');
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
        }
    
        redirect(site_url('colilert_idexx_water/read/'.$id_parent));
    }


    public function getIdOneWaterDetails()
    {
        $idOneWaterSample = $this->input->post('id_one_water_sample');
        $oneWaterSample = $this->Colilert_idexx_water_model->getOneWaterSampleById($idOneWaterSample);
        echo json_encode($oneWaterSample);
    }

    public function validate24() {
        $id = $this->input->get('id24');
        $data = $this->Colilert_idexx_water_model->validate24($id);
        header('Content-Type: application/json');
        echo json_encode($data);
    }
    
    public function excel() {
    
        $spreadsheet = new Spreadsheet();    
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setCellValue('A1', "Id Colilert In"); 
        $sheet->setCellValue('B1', "Id One Water Sample"); 
        $sheet->setCellValue('C1', "Lab Tech"); 
        $sheet->setCellValue('D1', "Sample Type");
        $sheet->setCellValue('E1', "Colilert Barcode In");
        $sheet->setCellValue('F1', "Date Sample In");
        $sheet->setCellValue('G1', "Time Sample In");
        $sheet->setCellValue('H1', "Volume Bottle");
        $sheet->setCellValue('I1', "Dilution");
        $sheet->setCellValue('J1', "Id Colilert Out");
        $sheet->setCellValue('K1', "Colilert Barcode Out");
        $sheet->setCellValue('L1', "Date Sample Out");
        $sheet->setCellValue('M1', "Time Sample Out");
        $sheet->setCellValue('N1', "E. Coli Large Wells");
        $sheet->setCellValue('O1', "E. Coli Small Wells");
        $sheet->setCellValue('P1', "Ecoli (MPN/100mL)");
        $sheet->setCellValue('Q1', "Coliforms Large Wells");
        $sheet->setCellValue('R1', "Coliforms Small Wells");
        $sheet->setCellValue('S1', "Total Coliforms (MPN/100mL)");
        $sheet->setCellValue('T1', "Remarks");
        


        $moisture = $this->Colilert_idexx_water_model->get_all();
    
        $numrow = 2;
        foreach($moisture as $data){ 

            if (property_exists($data, 'id_colilert_in')) {
                $sheet->setCellValue('A'.$numrow, $data->id_colilert_in);
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

            if (property_exists($data, 'sampletype')) {
                $sheet->setCellValue('D'.$numrow, $data->sampletype);
            } else {
                $sheet->setCellValue('D'.$numrow, '');
            }

            if (property_exists($data, 'colilert_barcode')) {
                $sheet->setCellValue('E'.$numrow, $data->colilert_barcode);
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

            if (property_exists($data, 'id_colilert_out')) {
                $sheet->setCellValue('J'.$numrow, $data->id_colilert_out);
            } else {
                $sheet->setCellValue('J'.$numrow, '');
            }

            if (property_exists($data, 'colilert_barcode')) {
                $sheet->setCellValue('K'.$numrow, $data->colilert_barcode);
            } else {
                $sheet->setCellValue('K'.$numrow, '');
            }

            if (property_exists($data, 'date_sample')) {
                $sheet->setCellValue('L'.$numrow, $data->date_sample);
            } else {
                $sheet->setCellValue('L'.$numrow, '');
            }

            if (property_exists($data, 'time_sample')) {
                $sheet->setCellValue('M'.$numrow, $data->time_sample);
            } else {
                $sheet->setCellValue('M'.$numrow, '');
            }

            if (property_exists($data, 'ecoli_largewells')) {
                $sheet->setCellValue('N'.$numrow, $data->ecoli_largewells);
            } else {
                $sheet->setCellValue('N'.$numrow, '');
            }

            if (property_exists($data, 'ecoli_smallwells')) {
                $sheet->setCellValue('O'.$numrow, $data->ecoli_smallwells);
            } else {
                $sheet->setCellValue('O'.$numrow, '');
            }

            if (property_exists($data, 'ecoli')) {
                $sheet->setCellValue('P'.$numrow, $data->ecoli);
            } else {
                $sheet->setCellValue('P'.$numrow, '');
            }

            if (property_exists($data, 'coliforms_largewells')) {
                $sheet->setCellValue('Q'.$numrow, $data->coliforms_largewells);
            } else {
                $sheet->setCellValue('Q'.$numrow, '');
            }

            if (property_exists($data, 'coliforms_smallwells')) {
                $sheet->setCellValue('R'.$numrow, $data->coliforms_smallwells);
            } else {
                $sheet->setCellValue('R'.$numrow, '');
            }

            if (property_exists($data, 'total_coliforms')) {
                $sheet->setCellValue('S'.$numrow, $data->total_coliforms);
            } else {
                $sheet->setCellValue('S'.$numrow, '');
            }

            if (property_exists($data, 'remarks')) {
                $sheet->setCellValue('T'.$numrow, $data->remarks);
            } else {
                $sheet->setCellValue('T'.$numrow, '');
            }

        
            $numrow++;
        }
        

        // Set header untuk file excel
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="Report_colilert_idexx_water.xlsx"');
        header('Cache-Control: max-age=0');

        // Tampilkan file excel
        $writer = new Xlsx($spreadsheet);
        $writer->save('php://output');
    }

    public function validateColilertBarcode() {
        $id = $this->input->get('id');
        $data = $this->Colilert_idexx_water_model->validateColilertBarcode($id);
        header('Content-Type: application/json');
        echo json_encode($data);
    }

    public function data_chart() 
    {
        $valueLargeWells = $this->input->get('valueLargeWells');
        $valueSmallWells = $this->input->get('valueSmallWells');
        $data = $this->Colilert_idexx_water_model->data_chart($valueLargeWells, $valueSmallWells);
        header('Content-Type: application/json');
        echo json_encode($data);
    }

    public function barcode_restrict() 
    {
        $id = $this->input->get('id1');
        $data = $this->Colilert_idexx_water_model->barcode_restrict($id);
        header('Content-Type: application/json');
        echo json_encode($data);
    }

}

/* End of file Water_sample_reception.php */
/* Location: ./application/controllers/Water_sample_reception.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2022-12-14 03:38:42 */
/* http://harviacode.com */