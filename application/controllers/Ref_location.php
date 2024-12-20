<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
    
class Ref_location extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        is_login();
        $this->load->model('Ref_location_model');
        $this->load->library('form_validation');        
	    $this->load->library('datatables');
	    $this->load->library('uuid');
    }

    public function index()
    {
        // $this->load->model('Ref_location_model');
        // $data['person'] = $this->Ref_location_model->getLabtech();
        // $data['type'] = $this->Ref_location_model->getSampleType();
        // $this->template->load('template','Ref_location/index', $data);
        $this->template->load('template','Ref_location/index');
    } 
    
    public function json() {
        header('Content-Type: application/json');
        echo $this->Ref_location_model->json();
    }

    public function save() 
    {
        $mode = $this->input->post('mode',TRUE);
        $id = $this->input->post('id_location',TRUE);
        $dt = new DateTime();

        if ($mode=="insert"){
            $data = array(
            'id_location' => $this->input->post('id_location',TRUE),
            'freezer' => $this->input->post('freezer',TRUE),
            'shelf' => $this->input->post('shelf',TRUE),
            'rack' => $this->input->post('rack',TRUE),
            'tray' => $this->input->post('tray',TRUE),
            'uuid' => $this->uuid->v4(),
            'user_created' => $this->session->userdata('id_users'),
            'date_created' => $dt->format('Y-m-d H:i:s'),
            );
 
            $this->Ref_location_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');    
        }
        else if ($mode=="edit"){
            $data = array(
            'id_location' => $this->input->post('id_location',TRUE),
            'freezer' => $this->input->post('freezer',TRUE),
            'shelf' => $this->input->post('shelf',TRUE),
            'rack' => $this->input->post('rack',TRUE),
            'tray' => $this->input->post('tray',TRUE),
            // 'uuid' => $this->uuid->v4(),
            'user_updated' => $this->session->userdata('id_users'),
            'date_updated' => $dt->format('Y-m-d H:i:s'),
            );

            $this->Ref_location_model->update($id, $data);
            $this->session->set_flashdata('message', 'Create Record Success');    
        }

        redirect(site_url("Ref_location"));
    }

    public function delete($id) 
    {
        $row = $this->Ref_location_model->get_by_id($id);
        // $id_user = $this->input->get('id', TRUE);
        // $lab = $this->input->post('id_lab');
        $data = array(
            'flag' => 1,
            );

        if ($row) {
            // $this->Ref_location_model->delete($id);
            $this->Ref_location_model->update($id, $data);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('Ref_location'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('Ref_location'));
        }
    }

    public function valid_bs() 
    {
        $id = $this->input->get('id1');
        // echo $id;
        $data = $this->Ref_location_model->validate1($id);

        header('Content-Type: application/json');
        echo json_encode($data);
        // return $this->response->setJSON($data);
        // $data['location'] = $this->O3_filter_paper_model->find_loc($id);
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
                'Freezer_location',
                'SELECT id_location AS ID_location, freezer AS Freezer, shelf AS Shelf, 
                        rack AS Rack, tray AS Tray
                        FROM ref_location
                ',
                array('ID_location', 'Freezer', 'Shelf', 'Rack', 'Tray'), // Columns for Sheet1
            ),
            // array(
            //     'Extraction_biosolid_detail',
            //     'SELECT a.id_req AS ID_Request, a.id_reqdetail AS ID_Request_Det, a.items AS Descriptions, 
            //     a.qty AS Qty, b.unit AS Unit, a.estimate_price AS Estimate_price, a.remarks AS Remarks 
            //     FROM Extraction_biosolid_detail a
            //     LEFT JOIN Extraction_biosolid c ON a.id_req=c.id_req
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
        $filename = 'MASTER_freezer_location_'.$datenow.'.xlsx';
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        header('Cache-Control: max-age=0');
        
        // Save the Excel file to the output stream
        $writer->save('php://output');
    }

    // public function excel()
    // {
    //     // $date1=$this->input->get('date1');
    //     // $date2=$this->input->get('date2');

    //     $spreadsheet = new Spreadsheet();    
    //     $sheet = $spreadsheet->getActiveSheet();
    //     $sheet->setCellValue('A1', "ID"); 
    //     $sheet->setCellValue('B1', "Freezer"); 
    //     $sheet->setCellValue('C1', "Shelf");
    //     $sheet->setCellValue('D1', "Rack");
    //     $sheet->setCellValue('E1', "Drawer");
    //     // $sheet->getStyle('A1:H1')->getFont()->setBold(true); // Set bold kolom A1

    //     // Panggil function view yang ada di SiswaModel untuk menampilkan semua data siswanya
    //     $rdeliver = $this->Ref_location_model->get_all();
    
    //     // $no = 1; // Untuk penomoran tabel, di awal set dengan 1
    //     $numrow = 2; // Set baris pertama untuk isi tabel adalah baris ke 4
    //     foreach($rdeliver as $data){ // Lakukan looping pada variabel siswa
    //       $sheet->setCellValue('A'.$numrow, $data->id_location);
    //       $sheet->setCellValue('B'.$numrow, $data->freezer);
    //       $sheet->setCellValue('C'.$numrow, $data->shelf);
    //       $sheet->setCellValue('D'.$numrow, $data->rack);
    //       $sheet->setCellValue('E'.$numrow, $data->tray);
    //     //   $no++; // Tambah 1 setiap kali looping
    //       $numrow++; // Tambah 1 setiap kali looping
    //     }
    // $writer = new \PhpOffice\PhpSpreadsheet\Writer\Csv($spreadsheet);
    // $datenow=date("Ymd");
    // $fileName = 'MASTER_freezer_location_'.$datenow.'.csv';

    // header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    // header("Content-Disposition: attachment; filename=$fileName"); // Set nama file excel nya
    // header('Cache-Control: max-age=0');

    // // $this->output->set_header('Content-Type: application/vnd.ms-excel');
    // // $this->output->set_header("Content-type: application/csv");
    // // $this->output->set_header('Cache-Control: max-age=0');
    // $writer->save('php://output');
    // //     $writer->save($fileName); 
    // // //redirect(HTTP_UPLOAD_PATH.$fileName); 
    // // $filepath = file_get_contents($fileName);
    // // force_download($fileName, $filepath);

    //     // // Set height semua kolom menjadi auto (mengikuti height isi dari kolommnya, jadi otomatis)
    //     // $sheet->getDefaultRowDimension()->setRowHeight(-1);
    
    //     // // Set orientasi kertas jadi LANDSCAPE
    //     // $sheet->getPageSetup()->setOrientation(\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::ORIENTATION_LANDSCAPE);
    
    //     // // Set judul file excel nya
    //     // $sheet->setTitle("Delivery Reports");
    
    //     // // Proses file excel
    //     // header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    //     // header('Content-Disposition: attachment; filename="Delivery_Reports.xlsx"'); // Set nama file excel nya
    //     // header('Cache-Control: max-age=0');
    
    //     // // $writer = new Xlsx($spreadsheet);
    //     // $writer = new \PhpOffice\PhpSpreadsheet\Writer\Csv($spreadsheet);
    //     // // $fileName = $fileName.'.csv';
    //     // $writer->save('php://output');
           
    // }
}

/* End of file Ref_location.php */
/* Location: ./application/controllers/Ref_location.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2022-12-14 03:38:42 */
/* http://harviacode.com */