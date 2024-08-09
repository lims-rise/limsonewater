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
    
class Sample_extraction extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        is_login();
        $this->load->model('Sample_extraction_model');
        $this->load->library('form_validation');        
	    $this->load->library('datatables');
	    $this->load->library('uuid');
    }

    public function index()
    {
        $data['labtech'] = $this->Sample_extraction_model->getLabTech();
        $data['kit'] = $this->Sample_extraction_model->getKit();

        $data['freez1'] = $this->Sample_extraction_model->getFreezer1();
        $data['shelf1'] = $this->Sample_extraction_model->getFreezer2();
        $data['rack1'] = $this->Sample_extraction_model->getFreezer3();
        $data['draw1'] = $this->Sample_extraction_model->getFreezer4();
        $this->template->load('template','Sample_extraction/index', $data);
    } 
    
    public function json() {
        header('Content-Type: application/json');
        echo $this->Sample_extraction_model->json();
    }

    public function subjson() {
        $id = $this->input->get('id',TRUE);
        header('Content-Type: application/json');
        echo $this->Sample_extraction_model->subjson($id);
    }

    public function subjson2() {
        $id2 = $this->input->get('id2',TRUE);

        header('Content-Type: application/json');
        echo $this->Sample_extraction_model->subjson2($id2);
    }

    public function read($id)
    {
        $data['testing_type'] = $this->Sample_extraction_model->getTest();
        $row = $this->Sample_extraction_model->get_detail($id);
        if ($row) {
            $data = array(
                'project_id' => $row->project_id,
                // 'client_name' => $row->client_name,
                'initial' => $row->initial,
                'date_arrival' => $row->date_arrival,
                'time_arrival' => $row->time_arrival,
                'client_sample_id' => $row->client_sample_id,
                'classification_name' => $row->classification_name,
                'comments' => $row->comments,
                'testing_type' => $this->Sample_extraction_model->getTest(),
                );
                $this->template->load('template','Sample_extraction/index_det', $data);
        }
        else {
            // $this->template->load('template','Sample_extraction/index_det');
        }
    }  

    public function save() {
        $mode = $this->input->post('mode', TRUE);
        $barcode_sample = $this->input->post('barcode_sample', TRUE);
        $dt = new DateTime();
    
        if ($mode == "insert") {
            $data = array(
                'barcode_sample' => $this->input->post('barcode_sample', TRUE),
                'id_one_water_sample' => $this->input->post('id_one_water_sample', TRUE),
                'id_person' => $this->input->post('id_person', TRUE),
                'date_extraction' => $this->input->post('date_extraction', TRUE),
                'weight' => $this->input->post('weight', TRUE),
                'volume' => $this->input->post('volume', TRUE),
                'id_kit' => $this->input->post('id_kit', TRUE),
                'kit_lot' => $this->input->post('kit_lot', TRUE),
                'barcode_tube' => $this->input->post('barcode_tube', TRUE),
                'dna_concentration' => $this->input->post('dna_concentration', TRUE),
                'cryobox' => $this->input->post('cryobox', TRUE),
                'id_location' => $this->input->post('id_loc', TRUE),
                'comments' => $this->input->post('comments', TRUE),
                'uuid' => $this->uuid->v4(),
                'user_created' => $this->session->userdata('id_users'),
                'date_created' => $dt->format('Y-m-d H:i:s'),
                'flag' => '0',
            );
    
            $this->Sample_extraction_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');

        } else if ($mode == "edit") {
            $data = array(
                // 'client_id' => $this->input->post('client_id', TRUE),
                'id_one_water_sample' => $this->input->post('id_one_water_sample', TRUE),
                'id_person' => $this->input->post('id_person', TRUE),
                'date_extraction' => $this->input->post('date_extraction', TRUE),
                'weight' => $this->input->post('weight', TRUE),
                'volume' => $this->input->post('volume', TRUE),
                'id_kit' => $this->input->post('id_kit', TRUE),
                'kit_lot' => $this->input->post('kit_lot', TRUE),
                'barcode_tube' => $this->input->post('barcode_tube', TRUE),
                'dna_concentration' => $this->input->post('dna_concentration', TRUE),
                'cryobox' => $this->input->post('cryobox', TRUE),
                'id_location' => $this->input->post('id_loc', TRUE),
                'comments' => $this->input->post('comments', TRUE),
                'user_updated' => $this->session->userdata('id_users'),
                'date_updated' => $dt->format('Y-m-d H:i:s'),
            );

            $this->Sample_extraction_model->update($barcode_sample, $data);
            $this->session->set_flashdata('message', 'Update Record Success');
        }
    
        redirect(site_url("Sample_extraction"));
    }


    // public function savedetail() 
    // {
    //     $mode = $this->input->post('mode_det',TRUE);
    //     $sample_id = $this->input->post('sample_id',TRUE);
    //     $project_id2 = $this->input->post('project_id2',TRUE);
    //     $dt = new DateTime();

    //     if ($mode=="insert"){
    //         $data = array(
    //             'sample_id' => $this->input->post('sample_id',TRUE),
    //             'project_id' => $this->input->post('project_id2',TRUE),
    //             'sample_description' => $this->input->post('sample_description',TRUE),
    //             'uuid' => $this->uuid->v4(),
    //             // 'lab' => $this->session->userdata('lab'),
    //             'user_created' => $this->session->userdata('id_users'),
    //             'date_created' => $dt->format('Y-m-d H:i:s'),
    //             );

    //         $this->Sample_extraction_model->insert_det($data);
    //         $this->session->set_flashdata('message', 'Create Record Success');    
      
    //     }
    //     else if ($mode=="edit"){
    //         $data = array(
    //             'sample_id' => $this->input->post('sample_id',TRUE),
    //             'project_id' => $this->input->post('project_id2',TRUE),
    //             'sample_description' => $this->input->post('sample_description',TRUE),
    //             // 'uuid' => $this->uuid->v4(),
    //             // 'lab' => $this->session->userdata('lab'),
    //             'user_updated' => $this->session->userdata('id_users'),
    //             'date_updated' => $dt->format('Y-m-d H:i:s'),
    //             );

    
    //         $this->Sample_extraction_model->update_det($sample_id, $data);
    //         $this->session->set_flashdata('message', 'Create Record Success');    
    //     }

    //     redirect(site_url("Sample_extraction/read/".$project_id2));
    // }

    //     public function savedetail() 
    // {
    //     $mode = $this->input->post('mode_det',TRUE);
    //     $sample_id = $this->input->post('sample_id',TRUE);
    //     $project_id2 = $this->input->post('project_id2',TRUE);
    //     $testing_types = $this->input->post('testing_type_id', TRUE);
    //     $dt = new DateTime();

    //     if ($mode=="insert"){
    //                 $data_sample = array(
    //                     // 'sample_id' => $this->input->post('sample_id', TRUE),
    //                     'project_id' => $this->input->post('project_id2', TRUE),
    //                     'testing_type_id' => $this->input->post('testing_type_id', TRUE),
    //                     // 'sample_description' => $this->input->post('sample_description', TRUE),
    //                     'date_collected' => $this->input->post('date_collected', TRUE),
    //                     'time_collected' => $this->input->post('time_collected', TRUE),
    //                     // 'no_submitted' => $this->input->post('no_submitted', TRUE),
    //                     'sample_barcode' => $this->input->post('sample_barcode', TRUE),
    //                     'uuid' => $this->uuid->v4(),
    //                     'user_created' => $this->session->userdata('id_users'),
    //                     'date_created' => $dt->format('Y-m-d H:i:s'),
    //                 );

    //         $this->Sample_extraction_model->insert_det($data_sample);
    //         $this->session->set_flashdata('message', 'Create Record Success');    
      
    //     }
    //     else if ($mode=="edit"){
    //         $data_sample = array(
    //             // 'sample_id' => $this->input->post('sample_id', TRUE),
    //             'project_id' => $this->input->post('project_id2', TRUE),
    //             'testing_type_id' => $this->input->post('testing_type_id', TRUE),
    //             // 'sample_description' => $this->input->post('sample_description', TRUE),
    //             'date_collected' => $this->input->post('date_collected', TRUE),
    //             'time_collected' => $this->input->post('time_collected', TRUE),
    //             // 'no_submitted' => $this->input->post('no_submitted', TRUE),
    //             'sample_barcode' => $this->input->post('sample_barcode', TRUE),
    //             'uuid' => $this->uuid->v4(),
    //             'user_created' => $this->session->userdata('id_users'),
    //             'date_created' => $dt->format('Y-m-d H:i:s'),
    //         );
    //         $this->Sample_extraction_model->update_det($sample_id, $data_sample);
    //         $this->session->set_flashdata('message', 'Create Record Success');    
    //     }

    //     redirect(site_url("Sample_extraction/read/".$project_id2));
    // }

    // public function savedetail2() 
    // {
    //     $mode = $this->input->post('mode_det2',TRUE); // appropiate with the name of form
    //     $sample_id = $this->input->post('sample_id2',TRUE);
    //     $testing_id = $this->input->post('testing_id',TRUE);

    //     $dt = new DateTime();
    
    //     if ($mode == "insert"){
    //         $data = array(
    //             'sample_id' => $this->input->post('sample_id2', TRUE),
    //             'testing_type_id' => $this->input->post('testing_type_id', TRUE),
    //             'date_collected' => $this->input->post('date_collected', TRUE),
    //             'time_collected' => $this->input->post('time_collected', TRUE),
    //             'no_submitted' => $this->input->post('no_submitted', TRUE),
    //             'sample_barcode' => $this->input->post('sample_barcode', TRUE),
    //             'uuid' => $this->uuid->v4(),
    //             'user_created' => $this->session->userdata('id_users'),
    //             'date_created' => $dt->format('Y-m-d H:i:s'),
    //         );

    //         $this->Sample_extraction_model->insert_det2($data);
    //         $this->session->set_flashdata('message', 'Create Record Success');
                
    //     } else if ($mode == "edit"){
    //         $data = array(
    //             'sample_id' => $this->input->post('sample_id2', TRUE),
    //             'testing_type_id' => $this->input->post('testing_type_id', TRUE),
    //             'date_collected' => $this->input->post('date_collected', TRUE),
    //             'time_collected' => $this->input->post('time_collected', TRUE),
    //             'no_submitted' => $this->input->post('no_submitted', TRUE),
    //             'sample_barcode' => $this->input->post('sample_barcode', TRUE),
    //             'user_updated' => $this->session->userdata('id_users'),
    //             'date_updated' => $dt->format('Y-m-d H:i:s'),
    //         );
    
    //         $this->Sample_extraction_model->update_det2($testing_id, $data);
    //         $this->session->set_flashdata('message', 'Update Record Success');    
    //     }
    
    //     redirect(site_url("Sample_extraction/read2/".$sample_id));
    // }
    

    public function load_freez() 
    {
        $id = $this->input->get('id1');
        $data = $this->Sample_extraction_model->load_freez($id);
        header('Content-Type: application/json');
        echo json_encode($data);
    }

    public function get_freez() 
    {
        $id1 = $this->input->get('id1');
        $id2 = $this->input->get('id2');
        $id3 = $this->input->get('id3');
        $id4 = $this->input->get('id4');
        $data = $this->Sample_extraction_model->get_freez($id1, $id2, $id3, $id4);
        header('Content-Type: application/json');
        echo json_encode($data);
    }

    public function budreq_print($id) 
    {
        // $row = $this->Sample_extraction_model->get_rep($id);
        // if ($row) {
        //     $data = array(
        //     'id_req' => $row->id_req,
        //     'date_req' => $row->date_req,
        //     'realname' => $row->realname,
        //     'objective' => $row->objective,
        //     'title' => $row->title,
        //     'periode' => $row->periode,
        //     'budget_req' => $row->budget_req,
        //     'reviewed' => $row->reviewed,
        //     'approved' => $row->approved,
        //     'comments' => $row->comments,
        //     );
        // // $data['items'] = $this->Tbl_receive_old_model->getItems();
        //     $this->template->load('template','Sample_extraction/index_rep', $data);
        // } else {
        //     $this->session->set_flashdata('message', 'Record Not Found');
        //     redirect(site_url("Sample_extraction/read/".$id));
        // }
    }

    public function update_bud_req($id, $breq) 
    {
        // $row = $this->Sample_extraction_model->get_by_id($id);
        // $data = array(
        //     'budget_req' => $breq,
        //     );

        // if ($row) {
        //     $this->Sample_extraction_model->update($id, $data);
        // } else {
        // }
    }    

    public function delete($id) 
    {
        $row = $this->Sample_extraction_model->get_by_id($id);
        $data = array(
            'flag' => 1,
            );

        if ($row) {
            $this->Sample_extraction_model->update($id, $data);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('Sample_extraction'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('Sample_extraction'));
        }
    }

    public function delete_detail($id) 
    {
        $row = $this->Sample_extraction_model->get_by_id_detail($id);

        if ($row) {
            $id_parent = $row->project_id; // Retrieve project_id before updating the record
            $data = array(
                'flag' => 1,
            );
    
            $this->Sample_extraction_model->update_det($id, $data);
            $this->session->set_flashdata('message', 'Delete Record Success');
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
        }
    
        redirect(site_url('Sample_extraction/read/'.$id_parent));
    }

    // Function delete detail 2
    public function delete_detail2($id)
    {
        $row = $this->Sample_extraction_model->get_by_id_detail2($id);
        if ($row) {
            $id_parent = $row->sample_id;
            $data = array(
                'flag' => 1,
            );

            $this->Sample_extraction_model->update_det2($id, $data);
            $this->session->set_flashdata('message', 'Delete Record Success');
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
        }
        redirect(site_url('Sample_extraction/read2/'.$id_parent));
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
            // array(
            //     'Sample_extraction',
            //     'SELECT a.id_req AS ID_Request, a.date_req AS Date_Request, c.objective AS Objective, 
            //     a.title AS Title, b.realname AS Requested, a.budget_req AS Budget_req, a.comments AS Comments
            //     FROM sample_reception a
            //     LEFT JOIN ref_person b ON a.id_person=b.id_person
            //     LEFT JOIN ref_objective c ON a.id_objective=c.id_objective                
            //     -- WHERE a.id_country = "'.$this->session->userdata('lab').'" 
            //     AND a.flag = 0 
            //     ORDER BY a.date_req, a.id_req
            //     ',
            //     array('ID_Request', 'Date_Request', 'Objective', 'Title', 'Requested', 
            //     'Budget_req', 'Comments'), // Columns for Sheet1
            // ),
            // array(
            //     'Sample_extraction_detail',
            //     'SELECT a.id_req AS ID_Request, a.id_reqdetail AS ID_Request_Det, a.items AS Descriptions, 
            //     a.qty AS Qty, b.unit AS Unit, a.estimate_price AS Estimate_price, a.remarks AS Remarks 
            //     FROM Sample_extraction_detail a
            //     LEFT JOIN Sample_extraction c ON a.id_req=c.id_req
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
        $filename = 'Sample_extraction_'.$datenow.'.xlsx';
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        header('Cache-Control: max-age=0');
        
        // Save the Excel file to the output stream
        $writer->save('php://output');
    }

    public function excel_print($id)
	{
        /* Data */
        $data = $this->Sample_extraction_model->get_all_with_detail_excel($id);

        /* Spreadsheet Init */
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $hcolumn = 'A';
        $hrow = 1;

        $sheet->getColumnDimension('A')->setWidth(5); // Set width for column A
        $sheet->getColumnDimension('B')->setWidth(30); // Set width for column B
        $sheet->getColumnDimension('C')->setWidth(5); // Set width for column B
        $sheet->getColumnDimension('D')->setWidth(7); // Set width for column B
        $sheet->getColumnDimension('E')->setWidth(15); // Set width for column B
        $sheet->getColumnDimension('F')->setWidth(17); // Set width for column B
        $sheet->getColumnDimension('G')->setWidth(30); // Set width for column B

        //logo
        $drawing = new \PhpOffice\PhpSpreadsheet\Worksheet\Drawing();
        $drawing->setName('Monash');
        $drawing->setDescription('Monash');
        $drawing->setPath('img/rise_logo_x.jpg'); // put your path and image here
        $drawing->setCoordinates('A1');
        $drawing->setOffsetX(10);
        // $drawing->setRotation(25);
        // $drawing->getShadow()->setVisible(true);
        // $drawing->getShadow()->setDirection(45);
        $drawing->setWorksheet($spreadsheet->getActiveSheet());

        $drawing = new \PhpOffice\PhpSpreadsheet\Worksheet\Drawing();
        $drawing->setName('Monash2');
        $drawing->setDescription('Monash2');
        $drawing->setPath('img/monash.png'); // put your path and image here
        $drawing->setCoordinates('G1');
        $drawing->setOffsetX(70);
        $drawing->setOffsetY(0); // Adjust the vertical offset

        // $drawing->setRotation(25);
        // $drawing->getShadow()->setVisible(true);
        // $drawing->getShadow()->setDirection(45);
        $drawing->setWorksheet($spreadsheet->getActiveSheet());
        
        // $sheet->setCellValue('C2', "RISE Makassar | Budget Request ");
        // $sheet->setCellValue('C3', $data->objective);
        // $sheet->setCellValue('C4', $data->title);
        // $sheet->setCellValue('F6', "RISE - " . date('Y-m-d'));

        /* Excel Header */
        $start = 8;
        $sheet->getStyle($hcolumn.$start)->getFont()->setBold(true);        
        $sheet->getStyle($hcolumn.$start)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);        
        $sheet->setCellValue($hcolumn++ . $start, "No");
        $sheet->getStyle($hcolumn.$start)->getFont()->setBold(true);        
        $sheet->getStyle($hcolumn.$start)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);        
        $sheet->setCellValue($hcolumn++ . $start, "Description");
        $sheet->getStyle($hcolumn.$start)->getFont()->setBold(true);        
        $sheet->getStyle($hcolumn.$start)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);        
        $sheet->setCellValue($hcolumn++ . $start, "Qty");
        $sheet->getStyle($hcolumn.$start)->getFont()->setBold(true);        
        $sheet->getStyle($hcolumn.$start)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);        
        $sheet->setCellValue($hcolumn++ . $start, "Unit");
        $sheet->getStyle($hcolumn.$start)->getFont()->setBold(true);        
        $sheet->getStyle($hcolumn.$start)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);        
        $sheet->setCellValue($hcolumn++ . $start, "Unit Price IDR");
        $sheet->getStyle($hcolumn.$start)->getFont()->setBold(true);        
        $sheet->getStyle($hcolumn.$start)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);        
        $sheet->setCellValue($hcolumn++ . $start, "Total Price IDR");
        $sheet->getStyle($hcolumn.$start)->getFont()->setBold(true);        
        $sheet->getStyle($hcolumn.$start)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);        
        $sheet->setCellValue($hcolumn++ . $start, "Remark");
        
        /* Excel Data */
        $row_number = $start+1;

        foreach($data as $key => $row)
        {
            $obj = $row->objective;
            $sheet->getStyle('C2')->getFont()->setBold(true);        
            $sheet->setCellValue('C2', "RISE Makassar | Budget Request");
            $sheet->getStyle('C3')->getFont()->setBold(true);        
            $sheet->setCellValue('C3', $row->objective);
            $sheet->getStyle('C4')->getFont()->setBold(true);        
            $sheet->setCellValue('C4', $row->title);
            $sheet->setCellValue('G6', "Date : " . $row->date_req);

            $column = 'A';
            $sheet->setCellValue($column++ .$row_number, $key+1);
            $sheet->setCellValue($column++ .$row_number, $row->items);
            $sheet->setCellValue($column++ .$row_number, $row->qty);
            $sheet->setCellValue($column++ .$row_number, $row->unit);
            $sheet->getStyle($column.$row_number)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT);
            $sheet->setCellValue($column++ .$row_number, $row->estimate_price);
            $sheet->getStyle($column.$row_number)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT);
            $sheet->setCellValue($column++ .$row_number, $row->total);
            $sheet->setCellValue($column++ .$row_number, $row->remarks);
            $row_number++;
        }
        $sheet->getStyle('F' .$row_number)->getFont()->setBold(true);        
        $sheet->setCellValue('F' .$row_number, $row->sum_tot);
        $row_number++;

        $row_ex = $row_number+1;
        $sheet->getStyle('A' .$row_ex)->getFont()->setBold(true);        
        $sheet->setCellValue('A' .$row_ex, "Prepared,");
        $sheet->getStyle('D' .$row_ex)->getFont()->setBold(true);        
        $sheet->setCellValue('D' .$row_ex, "Reviewed,");
        $sheet->getStyle('G' .$row_ex)->getFont()->setBold(true);        
        $sheet->setCellValue('G' .$row_ex, "Approved,");

        $row_ex2 = $row_ex+4;
        $sheet->setCellValue('A' .$row_ex2, $row->realname);
        $sheet->setCellValue('D' .$row_ex2, $row->reviewed);
        $sheet->setCellValue('G' .$row_ex2, $row->approved);

        $row_number--;
        $sheet->getStyle("A8:G".$row_number)->applyFromArray(
            array(
                'borders' => [
                    'allBorders' => [
                        'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                        // 'color' => ['argb' => '000000'],
                    ],
                ],
            )
        );

        /* Excel File Format */
        $writer = new Xlsx($spreadsheet);
        ob_clean();
        $filename = 'Sample_extraction_'. $obj .'_'. date('Ymd');
        
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="'. $filename .'.xlsx"'); 
        header('Cache-Control: max-age=0');

        $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
        $writer->save('php://output');
    }

}

/* End of file Sample_extraction.php */
/* Location: ./application/controllers/Sample_extraction.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2022-12-14 03:38:42 */
/* http://harviacode.com */