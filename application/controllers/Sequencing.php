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

class Sequencing extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        is_login();
        $this->load->model('Sequencing_model');
        $this->load->library('form_validation');        
	    $this->load->library('datatables');
	    $this->load->library('uuid');
    }

    public function index()
    {
        $data['id_one'] = $this->Sequencing_model->getID_one();
        $data['labtech'] = $this->Sequencing_model->getLabTech();
        
        // Check if redirected from Sample Reception with specific ID
        $data['search_sample_id'] = $this->input->get('idOneWaterSample');

        $this->template->load('template','Sequencing/index', $data);
    } 
    
    public function json() {
        header('Content-Type: application/json');
        echo $this->Sequencing_model->json();
    }

    public function subjson() {
        try {
            $id = $this->input->get('id',TRUE);
            
            // Debug log
            log_message('debug', 'Subjson called with ID: ' . $id);
            
            if (empty($id)) {
                header('Content-Type: application/json');
                echo json_encode(array(
                    'draw' => 1,
                    'recordsTotal' => 0,
                    'recordsFiltered' => 0,
                    'data' => array(),
                    'error' => 'No ID provided'
                ));
                return;
            }
            
            header('Content-Type: application/json');
            $result = $this->Sequencing_model->subjson($id);
            echo $result;
            
        } catch (Exception $e) {
            header('Content-Type: application/json');
            echo json_encode(array(
                'draw' => 1,
                'recordsTotal' => 0,
                'recordsFiltered' => 0,
                'data' => array(),
                'error' => $e->getMessage()
            ));
        }
    }



  


    


    public function delete($id) 
    {
        $row = $this->Sequencing_model->get_by_id($id);
        $data = array(
            'flag' => 1,
            );

        if ($row) {
            $this->Sequencing_model->updateSequencing($id, $data);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('Sequencing'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('Sequencing'));
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

    // ============ SEQUENCE FUNCTIONS ============
    
    // Method to get available barcode tubes for sequence from extraction_culture_plate
    public function get_barcode_tubes_for_sequence()
    {
        header('Content-Type: application/json');
        
        try {
            $id_one_water_sample = $this->input->post('id_one_water_sample');
            
            if (empty($id_one_water_sample)) {
                echo json_encode(array(
                    'status' => 'error',
                    'message' => 'Sample ID is required'
                ));
                return;
            }

            // Get barcode tubes from model
            $barcode_tubes = $this->Sequencing_model->getExtractionCultureBarcodeTubes($id_one_water_sample);
            
            echo json_encode(array(
                'status' => 'success',
                'data' => $barcode_tubes,
                'message' => 'Barcode tubes retrieved successfully'
            ));

        } catch (Exception $e) {
            echo json_encode(array(
                'status' => 'error',
                'message' => 'Exception: ' . $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ));
        }
    }

    // Method to save sequence data (same functionality as Sample Reception modal)
    public function save_sequence_data()
    {
        header('Content-Type: application/json');
        
        try {
            // Get form data
            $id_one_water_sample = $this->input->post('id_one_water_sample');
            $barcode_tube = $this->input->post('barcode_tube');
            $barcode_sample = $this->input->post('barcode_sample');
            $sequence = $this->input->post('sequence'); 
            // $sequence_id = $this->input->post('sequence_id'); // COMMENTED FOR FUTURE USE
            // $other_sequence_name = $this->input->post('other_sequence_name'); // COMMENTED FOR FUTURE USE
            $species_id = $this->input->post('species_id');
            
            // Validate required fields
            if (empty($barcode_tube)) {
                echo json_encode(array(
                    'status' => 'error',
                    'message' => 'Barcode Tube is required'
                ));
                return;
            }

            // Get extraction culture data for relational IDs
            $extraction_data = $this->Sequencing_model->getExtractionCultureDataByBarcode($barcode_tube, $barcode_sample);
            
            if (!$extraction_data) {
                echo json_encode(array(
                    'status' => 'error',
                    'message' => 'Extraction culture data not found for this barcode'
                ));
                return;
            }

            // Check if sequence data already exists for this barcode combination
            $existingSequenceData = $this->Sequencing_model->getSequenceDataByBarcodeTube($barcode_tube, $barcode_sample);
            $isUpdate = $existingSequenceData !== false;

            // Prepare data for extraction_culture_plate update
            $dt = new DateTime();
            $extraction_update_data = array(
                'sequence' => $sequence,
                'species_id' => $species_id,
                'user_updated' => $this->session->userdata('id_users'),
                'date_updated' => $dt->format('Y-m-d H:i:s')
            );

            // Handle sequence type - COMMENTED FOR FUTURE USE
            // if ($sequence_id === 'other' && !empty($other_sequence_name)) {
            //     $extraction_update_data['sequence_id'] = null;
            //     $extraction_update_data['custom_sequence_type'] = $other_sequence_name;
            // } else if (!empty($sequence_id) && $sequence_id !== 'other') {
            //     $extraction_update_data['sequence_id'] = $sequence_id;
            //     $extraction_update_data['custom_sequence_type'] = null;
            // } else {
            //     $extraction_update_data['sequence_id'] = null;
            //     $extraction_update_data['custom_sequence_type'] = null;
            // }

            // Update extraction_culture_plate table (same as Sample_reception approach)
            $this->db->where('barcode_sample', $barcode_sample);
            $this->db->where('flag', 0);
            $result = $this->db->update('extraction_culture_plate', $extraction_update_data);
            
            if ($result) {
                // Also save to sequencing table for tracking
                $sequencing_barcode = $this->input->post('sequencing_barcode');
                
                // Debug log untuk melihat sequencing_barcode
                log_message('debug', 'Sequencing barcode dari POST: ' . $sequencing_barcode);
                log_message('debug', 'All POST data: ' . print_r($_POST, true));
                
                // Prepare sequencing table data (basic fields only)
                $sequencing_data = array(
                    'id_one_water_sample' => $id_one_water_sample,
                    'sequencing_barcode' => $sequencing_barcode
                );

                // Check if sequencing record already exists
                $existing_sequencing = $this->Sequencing_model->getSequencingRecord($id_one_water_sample, $sequencing_barcode);
                
                if ($existing_sequencing) {
                    // Update existing sequencing record with minimal fields
                    $update_data = array(
                        'user_updated' => $this->session->userdata('id_users'),
                        'date_updated' => $dt->format('Y-m-d H:i:s')
                    );
                    $this->db->where('id_sequencing', $existing_sequencing->id_sequencing);
                    $this->db->update('sequencing', $update_data);
                } else {
                    // Insert new sequencing record with minimal required fields
                    $insert_data = array(
                        'id_one_water_sample' => $id_one_water_sample,
                        'sequencing_barcode' => $sequencing_barcode,
                        'user_created' => $this->session->userdata('id_users'),
                        'date_created' => $dt->format('Y-m-d H:i:s'),
                        'flag' => '0'
                    );
                    $this->db->insert('sequencing', $insert_data);
                }
                
                $action = $isUpdate ? 'updated' : 'saved';
                echo json_encode(array(
                    'status' => 'success',
                    'message' => "Sequence data {$action} successfully",
                    'action' => $action
                ));
            } else {
                echo json_encode(array(
                    'status' => 'error',
                    'message' => 'Failed to save sequence data'
                ));
            }

        } catch (Exception $e) {
            echo json_encode(array(
                'status' => 'error',
                'message' => 'An error occurred while saving sequence data: ' . $e->getMessage()
            ));
        }
    }

    // Method to get sequence types for dropdown
    public function get_sequence_types()
    {
        header('Content-Type: application/json');
        
        try {
            $sequence_types = $this->Sequencing_model->getSequenceTypes();
            
            echo json_encode(array(
                'status' => 'success',
                'data' => $sequence_types,
                'message' => 'Sequence types retrieved successfully'
            ));

        } catch (Exception $e) {
            echo json_encode(array(
                'status' => 'error',
                'message' => 'An error occurred while fetching sequence types'
            ));
        }
    }

    public function excel()
    {
        $this->load->database();

        $spreadsheet = new Spreadsheet();

        $sheets = array(
            array(
                'Sequencing',
                'select a.id_one_water_sample AS ID_one_water_sample, b.initial AS Lab_tech,
                d.sampletype AS Sample_Type, a.date_processed AS Date_Processed, a.time_processed AS Time_Processed, 
                e.initial AS Lab_Tech_Proc, a.volume_filter AS Volume_Filtered,
                a.volume_eluted AS Volume_Eluted, a.comments AS Comments
                from sequencing a
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
            //     LEFT JOIN Sequencing c ON a.id_req=c.id_req
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










}

/* End of file Sequencing.php */
/* Location: ./application/controllers/Sequencing.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2022-12-14 03:38:42 */
/* http://harviacode.com */