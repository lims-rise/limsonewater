<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
    
require 'vendor/autoload.php';
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Microbial extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        is_login();
        $this->load->model('Microbial_model');
        $this->load->library('form_validation');        
	    $this->load->library('datatables');
	    $this->load->library('uuid');
    }





    public function index()
    {
        $data['id_one'] = $this->Microbial_model->getID_one();
        $data['labtech'] = $this->Microbial_model->getLabTech();
        
        // Check if redirected from Sample Reception with specific ID
        $data['search_sample_id'] = $this->input->get('idOneWaterSample');

        $this->template->load('template','Microbial/index', $data);
    } 
    
    public function json() {
        header('Content-Type: application/json');
        echo $this->Microbial_model->json();
    }

    public function save() {
        $mode = $this->input->post('mode', TRUE);
        $dt = new DateTime();
        $id_microbial = $this->input->post('id_microbial', TRUE);
        $id_one_water_sample = $this->input->post('id_one_water_sample', TRUE);
        $idx_one_water_sample = $this->input->post('idx_one_water_sample', TRUE);
        $microbial_barcode = $this->input->post('microbial_barcode', TRUE);
        $description = $this->input->post('description', TRUE);

        // Get document filename from form (already uploaded via scan_page)
        $document_filename = $this->input->post('document_file', TRUE);

        if ($mode == "insert") {
            $data = array(
                'id_one_water_sample' => $id_one_water_sample,
                'microbial_barcode' => $microbial_barcode,
                'description' => $description,
                'document_filename' => $document_filename,
                'uuid' => $this->uuid->v4(),
                'user_created' => $this->session->userdata('id_users'),
                'date_created' => $dt->format('Y-m-d H:i:s'),
                'flag' => '0',
            );

            $this->Microbial_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');

        } else if ($mode == "edit") {
            $data = array(
                'id_one_water_sample' => $idx_one_water_sample,
                'microbial_barcode' => $microbial_barcode,
                'description' => $description,
                'user_updated' => $this->session->userdata('id_users'),
                'date_updated' => $dt->format('Y-m-d H:i:s'),
            );
            
            // Only update document filename if new file was uploaded
            if (!empty($document_filename)) {
                $data['document_filename'] = $document_filename;
            }

            $this->Microbial_model->updateMicrobialData($id_microbial, $data);
            $this->session->set_flashdata('message', 'Update Record Success');
        }
    
        redirect(site_url("Microbial"));
    }
    
    public function barcode_check() 
    {
        $id = $this->input->get('id1');
        $data = $this->Microbial_model->barcode_check($id);
        header('Content-Type: application/json');
        echo json_encode($data);
    }

    public function delete($id) 
    {
        $row = $this->Microbial_model->get_by_id($id);
        $data = array(
            'flag' => 1,
            );

        if ($row) {
            $this->Microbial_model->updateMicrobial($id, $data);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('Microbial'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('Microbial'));
        }
    }

    public function excel()
    {
        $this->load->database();
        $spreadsheet = new Spreadsheet();

        $sheets = array(
            array(
                'Microbial',
                'select a.id_one_water_sample AS ID_one_water_sample, a.microbial_barcode AS Microbial_Barcode,
                a.description AS Description, a.document_filename AS Document_Filename, 
                p.full_name AS Created_By, a.date_created AS Date_Created
                from microbial a
				left join tbl_user p on a.user_created = p.id_users
                WHERE a.flag = 0 
                ORDER BY a.date_created DESC',
                array('ID_one_water_sample', 'Microbial_Barcode', 'Description', 'Document_Filename', 'Created_By', 'Date_Created'), // Columns for Sheet1
            ),
        );
        
        $spreadsheet->removeSheetByIndex(0);

        foreach ($sheets as $sheetInfo) {
            $worksheet = $spreadsheet->createSheet();
            $worksheet->setTitle($sheetInfo[0]);
    
            $sql = $sheetInfo[1];
            $query = $this->db->query($sql);
            $result = $query->result_array();
            
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
        $filename = 'Microbial_'.$datenow.'.xlsx';
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        header('Cache-Control: max-age=0');
        
        // Save the Excel file to the output stream
        $writer->save('php://output');
    }

    public function barcode_restrict() 
    {
        $id = $this->input->get('id1');
        $data = $this->Microbial_model->barcode_restrict($id);
        header('Content-Type: application/json');
        echo json_encode($data);
    }

    public function view_document($filename) {
        // Sanitize filename
        $filename = preg_replace('/[^a-zA-Z0-9_\-\.]/', '', basename($filename));
        $file_path = 'C:\\onewater\\microbial\\' . $filename;
        
        if (file_exists($file_path)) {
            // Set headers for PDF inline viewing
            header('Content-Type: application/pdf');
            header('Content-Disposition: inline; filename="' . basename($file_path) . '"');
            header('Cache-Control: private, max-age=0, must-revalidate');
            header('Pragma: public');
            header('Content-Length: ' . filesize($file_path));
            
            // Clear output buffer
            ob_clean();
            flush();
            
            // Read and output file
            readfile($file_path);
            exit;
        } else {
            show_404();
        }
    }

    // Check if data exists for given sample ID
    public function check_exists() {
        $id_one_water_sample = $this->input->get('id_one_water_sample');
        
        if (!$id_one_water_sample) {
            echo json_encode(['exists' => false, 'message' => 'Sample ID required']);
            return;
        }
        
        $existing_data = $this->Microbial_model->get_by_sample_id($id_one_water_sample);
        
        if ($existing_data) {
            echo json_encode([
                'exists' => true, 
                'data' => $existing_data,
                'message' => 'Data already exists for this sample'
            ]);
        } else {
            echo json_encode(['exists' => false, 'message' => 'No data found']);
        }
    }

    // Delete document method for file management
    function delete_document() {
        if (!$this->input->post('filename')) {
            echo json_encode(['success' => false, 'message' => 'Filename required']);
            return;
        }
        
        $filename = $this->input->post('filename');
        $file_path = 'C:\\onewater\\microbial\\' . $filename;
        
        if (file_exists($file_path)) {
            if (unlink($file_path)) {
                echo json_encode(['success' => true, 'message' => 'Document deleted successfully']);
            } else {
                echo json_encode(['success' => false, 'message' => 'Failed to delete document']);
            }
        } else {
            echo json_encode(['success' => false, 'message' => 'Document not found']);
        }
    }

}

/* End of file Microbial.php */
/* Location: ./application/controllers/Microbial.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2022-12-14 03:38:42 */
/* http://harviacode.com */