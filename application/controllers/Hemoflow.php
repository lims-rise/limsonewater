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
    
class Hemoflow extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        is_login();
        $this->load->model('Hemoflow_model');
        $this->load->library('form_validation');        
	    $this->load->library('datatables');
	    $this->load->library('uuid');
    }

    public function index()
    {
        $data['id_one'] = $this->Hemoflow_model->getID_one();
        $data['labtech'] = $this->Hemoflow_model->getLabTech();
        
        // Check if redirected from Sample Reception with specific ID
        $data['search_sample_id'] = $this->input->get('idOneWaterSample');

        $this->template->load('template','Hemoflow/index', $data);
    } 
    
    public function json() {
        header('Content-Type: application/json');
        echo $this->Hemoflow_model->json();
    }

    public function subjson() {
        $id = $this->input->get('id',TRUE);
        header('Content-Type: application/json');
        echo $this->Hemoflow_model->subjson($id);
    }

    public function subjson2() {
        $id2 = $this->input->get('id2',TRUE);

        header('Content-Type: application/json');
        echo $this->Hemoflow_model->subjson2($id2);
    }

    // public function read($id)
    // {
    //     $data['testing_type'] = $this->Hemoflow_model->getTest();
    //     $row = $this->Hemoflow_model->get_detail($id);
    //     if ($row) {
    //         $data = array(
    //             'project_id' => $row->project_id,
    //             // 'client_name' => $row->client_name,
    //             'initial' => $row->initial,
    //             'date_arrival' => $row->date_arrival,
    //             'time_arrival' => $row->time_arrival,
    //             'client_sample_id' => $row->client_sample_id,
    //             'classification_name' => $row->classification_name,
    //             'comments' => $row->comments,
    //             'testing_type' => $this->Hemoflow_model->getTest(),
    //             );
    //             $this->template->load('template','Hemoflow/index_det', $data);
    //     }
    //     else {
    //         // $this->template->load('template','Hemoflow/index_det');
    //     }
    // }  

    public function save() {
        $mode = $this->input->post('mode', TRUE);
        $dt = new DateTime();

        $id_one_water_sample = $this->input->post('id_one_water_sample', TRUE);
        $idx_one_water_sample = $this->input->post('idx_one_water_sample', TRUE);
        $id_person = $this->input->post('id_person', TRUE);
        $date_processed = $this->input->post('date_processed', TRUE);
        $time_processed = $this->input->post('time_processed', TRUE);
        $id_person_proc = $this->input->post('id_person_proc', TRUE);
        $volume_filter = $this->input->post('volume_filter', TRUE);
        $volume_eluted = $this->input->post('volume_eluted', TRUE);
        $hemoflow_barcode = $this->input->post('hemoflow_barcode', TRUE);
        $comments = $this->input->post('comments', TRUE);

        if ($mode == "insert") {
            $data = array(
                'id_one_water_sample' => $id_one_water_sample,
                'hemoflow_barcode' => $hemoflow_barcode,
                'id_person' => $id_person,
                'date_processed' => $date_processed,
                'time_processed' => $time_processed,
                'id_person_proc' => $id_person_proc,
                'volume_filter' => $volume_filter,
                'volume_eluted' => $volume_eluted,
                'comments' => $comments,
                'uuid' => $this->uuid->v4(),
                'user_created' => $this->session->userdata('id_users'),
                'date_created' => $dt->format('Y-m-d H:i:s'),
                'flag' => '0',
            );

            // var_dump($data);
            // die();
    
            $this->Hemoflow_model->insert($data);
 
            $this->session->set_flashdata('message', 'Create Record Success');

        } else if ($mode == "edit") {
            $data = array(
                'id_one_water_sample' => $idx_one_water_sample,
                'hemoflow_barcode' => $hemoflow_barcode,
                'id_person' => $id_person,
                'date_processed' => $date_processed,
                'time_processed' => $time_processed,
                'id_person_proc' => $id_person_proc,
                'volume_filter' => $volume_filter,
                'volume_eluted' => $volume_eluted,
                'comments' => $comments,
                'uuid' => $this->uuid->v4(),
                'user_created' => $this->session->userdata('id_users'),
                'date_created' => $dt->format('Y-m-d H:i:s'),
                'flag' => '0',
            );


            // var_dump($data);
            // die();
            $this->Hemoflow_model->updateHemoflow($idx_one_water_sample, $data);
            $this->session->set_flashdata('message', 'Update Record Success');
        }
    
        redirect(site_url("Hemoflow"));
    }
    
    public function barcode_check() 
    {
        $id = $this->input->get('id1');
        $data = $this->Hemoflow_model->barcode_check($id);
        header('Content-Type: application/json');
        echo json_encode($data);
    }

    public function delete($id) 
    {
        $row = $this->Hemoflow_model->get_by_id($id);
        $data = array(
            'flag' => 1,
            );

        if ($row) {
            $this->Hemoflow_model->update($id, $data);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('Hemoflow'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('Hemoflow'));
        }
    }


    // public function _rules() 
    // {
	// $this->form_validation->set_rules('delivery_number', 'delivery number', 'trim|required');
	// $this->form_validation->set_rules('date_delivery', 'date delivery', 'trim|required');
	// $this->form_validation->set_rules('id_customer', 'id customer', 'trim|required');
	// $this->form_validation->set_rules('expedisi', 'expedisi', 'trim');
	// $this->form_validation->set_rules('receipt', 'receipt', 'trim');
	// // $this->form_validation->set_rules('sj', 'sj', 'trim|required');
	// $this->form_validation->set_rules('notes', 'notes', 'trim');

	// $this->form_validation->set_rules('id_delivery', 'id_delivery', 'trim');
	// $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    // }

    public function excel()
    {
        $this->load->database();

        $spreadsheet = new Spreadsheet();

        $sheets = array(
            array(
                'Hemoflow',
                'select a.id_one_water_sample AS ID_one_water_sample, b.initial AS Lab_tech,
                d.sampletype AS Sample_Type, a.date_processed AS Date_Processed, a.time_processed AS Time_Processed, 
                e.initial AS Lab_Tech_Proc, a.volume_filter AS Volume_Filtered,
                a.volume_eluted AS Volume_Eluted, a.comments AS Comments
                from hemoflow a
				left join ref_person b on a.id_person = b.id_person
				left join sample_reception c on a.id_one_water_sample = c.id_one_water_sample
				left join ref_sampletype d on c.id_sampletype = d.id_sampletype
				left join ref_person e on a.id_person_proc = e.id_person
                WHERE a.flag = 0 
                ORDER BY a.date_processed, a.time_processed
                ',
                array('ID_one_water_sample', 'Lab_tech', 'Sample_Type', 'Date_Processed', 'Time_Processed', 
                'Lab_Tech_Proc', 'Volume_Filtered', 'Volume_Eluted', 'Comments'), // Columns for Sheet1
            ),
            // array(
            //     'Hemoflow_detail',
            //     'SELECT a.id_req AS ID_Request, a.id_reqdetail AS ID_Request_Det, a.items AS Descriptions, 
            //     a.qty AS Qty, b.unit AS Unit, a.estimate_price AS Estimate_price, a.remarks AS Remarks 
            //     FROM Hemoflow_detail a
            //     LEFT JOIN Hemoflow c ON a.id_req=c.id_req
            //     LEFT JOIN ref_unit b ON a.id_unit=b.id_unit
            //     WHERE 
            //     c.id_country = "'.$this->session->userdata('lab').'" 
            //     AND b.flag = 0 
            //     ORDER BY a.id_reqdetail ASC
            //     ', // Different columns for Sheet2
            //     array('ID_Request', 'ID_Request_Det', 'Descriptions', 'Qty', 'Unit', 'Estimate_price', 'Remarks'), // Columns for Sheet2
            // ),
            // Add more sheets as needed
        );
        
        $spreadsheet->removeSheetByIndex(0);

        foreach ($sheets as $sheetInfo) {
            // Create a new worksheet for each sheet
            $worksheet = $spreadsheet->createSheet();
            $worksheet->setTitle($sheetInfo[0]);
    
            // SQL query to fetch data for this sheet
            $sql = $sheetInfo[1];
            
            // Use the query builder to fetch data
            $query = $this->db->query($sql);
            $result = $query->result_array();
            
            // var_dump($result); 
            // Column headers for this sheet
            $columns = $sheetInfo[2];
    
            // Add column headers
            $col = 1;
            foreach ($columns as $column) {
                $worksheet->setCellValueByColumnAndRow($col, 1, $column);
                $col++;
            }
    
            // Add data rows
            $row = 2;
            foreach ($result as $row_data) {
                $col = 1;
                foreach ($columns as $column) {
                    $worksheet->setCellValueByColumnAndRow($col, $row, $row_data[$column]);
                    $col++;
                }
                $row++;
            }
        }

        // Create a new Xlsx writer
        $writer = new Xlsx($spreadsheet);
        
        // Set the HTTP headers to download the Excel file
        $datenow=date("Ymd");
        $filename = 'Hemoflow_'.$datenow.'.xlsx';
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        header('Cache-Control: max-age=0');
        
        // Save the Excel file to the output stream
        $writer->save('php://output');
    }

    public function getIdOneWaterDetails()
    {
        $idOneWaterSample = $this->input->post('id_one_water_sample');
        $oneWaterSample = $this->Hemoflow_model->getOneWaterSampleById($idOneWaterSample);
        echo json_encode($oneWaterSample);
    }

    public function barcode_restrict() 
    {
        $id = $this->input->get('id1');
        $data = $this->Hemoflow_model->barcode_restrict($id);
        header('Content-Type: application/json');
        echo json_encode($data);
    }

    public function getReviewer()
    {
        $userReview = $this->input->post('user_review');
        $reviewer = $this->Hemoflow_model->getReviewer($userReview);
        
        echo json_encode(['realname' => $reviewer, 'full_name' => $reviewer]);
    }

    public function saveReview() {
        header('Content-Type: application/json');
        
        $id = $this->input->post('id_one_water_sample', true);
        $review = $this->input->post('review', true);
        $user_review = $this->input->post('user_review', true);
        
        if (!$id || $review === null || !$user_review) {
            echo json_encode([
                'status' => 'error',
                'message' => 'Invalid request data.'
            ]);
            return;
        }
        
        try {
            $data = array(
                'review' => $review,
                'user_review' => $user_review,
                'user_updated' => $this->session->userdata('id_users'),
                'date_updated' => date('Y-m-d H:i:s')
            );

            $this->Hemoflow_model->updateHemoflowReview($id, $data);

            echo json_encode([
                'status' => 'success',
                'message' => 'Review saved successfully.'
            ]);
        } catch (Exception $e) {
            echo json_encode([
                'status' => 'error',
                'message' => 'Error saving review: ' . $e->getMessage()
            ]);
        }
    }

    public function cancelReview() {
        header('Content-Type: application/json');
        
        $id = $this->input->post('id_one_water_sample', true);
        $review = $this->input->post('review', true);
        $user_review = $this->input->post('user_review', true);
        
        if (!$id) {
            echo json_encode([
                'status' => 'error',
                'message' => 'Invalid request data.'
            ]);
            return;
        }
        
        try {
            $data = array(
                'review' => 0,
                'user_review' => null,
                'user_updated' => $this->session->userdata('id_users'),
                'date_updated' => date('Y-m-d H:i:s')
            );

            $this->Hemoflow_model->updateHemoflowReview($id, $data);

            echo json_encode([
                'status' => 'success',
                'message' => 'Review cancelled successfully.'
            ]);
        } catch (Exception $e) {
            echo json_encode([
                'status' => 'error',
                'message' => 'Error cancelling review: ' . $e->getMessage()
            ]);
        }
    }

}

/* End of file Hemoflow.php */
/* Location: ./application/controllers/Hemoflow.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2022-12-14 03:38:42 */
/* http://harviacode.com */