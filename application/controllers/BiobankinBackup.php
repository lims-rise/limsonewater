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
    
class Biobankin extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        is_login();
        $this->load->model('Biobankin_model');
        $this->load->library('form_validation');        
	    $this->load->library('datatables');
	    $this->load->library('uuid');
    }

    public function index()
    {
        $data['id_one'] = $this->Biobankin_model->getID_one();
        $data['sampletype'] = $this->Biobankin_model->getSampleType();
        $data['labtech'] = $this->Biobankin_model->getLabTech()
        // $data['id_project'] = $this->Biobankin_model->generate_project_id();
        // $data['client'] = $this->Biobankin_model->generate_client();
        // $data['id_one_water_sample'] = $this->Biobankin_model->generate_one_water_sample_id();
        $this->template->load('template','Biobankin/index', $data);
    } 
    
    public function json() {
        header('Content-Type: application/json');
        echo $this->Biobankin_model->json();
    }

    public function subjson() {
        $id = $this->input->get('id',TRUE);
        header('Content-Type: application/json');
        echo $this->Biobankin_model->subjson($id);
    }

    public function subjson2() {
        $id2 = $this->input->get('id2',TRUE);

        header('Content-Type: application/json');
        echo $this->Biobankin_model->subjson2($id2);
    }

    public function read($id)
    {
        $row = $this->Biobankin_model->get_detail($id);
        if ($row) {
            $data = array(
                'id_one_water_sample' => $row->id_one_water_sample,
                'sampletype' => $row->sampletype,
                'sampletypecombination' => $row->sampletypecombination,
                'date_conduct' => $row->date_conduct,
                'replicates' => $row->replicates,
                'initial' => $row->initial,
                'id_person' => $row->id_person,
                'realname' => $row->realname,
                'comments' => $row->comments,
                'full_name' => $row->full_name,
                'user_review' => $row->user_review,
                'review' => $row->review,
                'user_created'  => $row->user_created,
                'culture' => $this->Biobankin_model->getCulture(),
                'freez1' => $this->Biobankin_model->getFreezer1(),
                'shelf1' => $this->Biobankin_model->getFreezer2(),
                'rack1' => $this->Biobankin_model->getFreezer3(),
                'tray1' => $this->Biobankin_model->getFreezer4(),
                'row1' => $this->Biobankin_model->getPos1(),
                'col1' => $this->Biobankin_model->getPos2(),
                // 'testing_type' => $this->Biobankin_model->getTest(),
                // 'barcode' => $this->Water_Biobankin_model->getBarcode(),
            );
                
            $this->template->load('template','Biobankin/index_det', $data);

        }
        else {
            if (!$data) {
                // Jika data tidak ditemukan, tampilkan halaman dengan pesan
                $this->load->view('errors/custom_not_found', [
                    'message' => 'No detail data available for this sample ID.',
                    'sample_id' => $id
                ]);
                return;
            }
        }

    } 

    public function save() {
        $mode = $this->input->post('mode', TRUE);
        // $id_one_water_sample_list = $this->input->post('id_one_water_sample_list', TRUE);
        $id_one_water_sample = $this->input->post('id_one_water_sample', TRUE);
        $idx_one_water_sample = $this->input->post('idx_one_water_sample', TRUE);
        $biobankin_barcode = $this->input->post('biobankin_barcode', TRUE);
        $biobankinx_barcode = $this->input->post('biobankinx_barcode', TRUE);
        $dt = new DateTime();

        $id_sampletype = $this->input->post('id_sampletype', TRUE);
        // $combination_type = $this->input->post('combination_type', TRUE);
        $id_person = $this->input->post('id_person', TRUE);
        $date_conduct = $this->input->post('date_conduct', TRUE);
        $replicates = $this->input->post('replicates', TRUE);
        $comments = $this->input->post('comments', TRUE);
        $review = $this->input->post('review', TRUE);
        $user_review = $this->input->post('user_review', TRUE);      
    
        if ($mode == "insert") {
            $data = array(
                'id_one_water_sample' => $id_one_water_sample,
                'biobankin_barcode' => $biobankin_barcode,
                'id_sampletype' => $id_sampletype,
                // 'combination_type' => $combination_type,
                'date_conduct' => $date_conduct,
                'replicates' => $replicates,
                'id_person' => $id_person,
                'comments' => $comments,
                'flag' => '0',
                'uuid' => $this->uuid->v4(),
                'user_created' => $this->session->userdata('id_users'),
                'date_created' => $dt->format('Y-m-d H:i:s'),
            );

            // var_dump($data);
            // die();
    
            $this->Biobankin_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');

        } else if ($mode == "edit") {
            $data = array(
                'id_one_water_sample' => $idx_one_water_sample,
                'biobankin_barcode' => $biobankinx_barcode,
                'id_sampletype' => $id_sampletype,
                // 'combination_type' => $combination_type,
                'date_conduct' => $date_conduct,
                'replicates' => $replicates,
                'id_person' => $id_person,
                'comments' => $comments,
                'user_review' => $user_review,
                'flag' => '0',
                // 'uuid' => $this->uuid->v4(),
                'user_updated' => $this->session->userdata('id_users'),
                'date_updated' => $dt->format('Y-m-d H:i:s'),
            );

            // var_dump($data);
            // die();
            $this->Biobankin_model->update($idx_one_water_sample, $data);
            $this->session->set_flashdata('message', 'Update Record Success');
        }
    
        redirect(site_url("Biobankin"));
    }

    // public function saveReview()
    // {
    //     $this->load->model('Biobankin_model');
    //     header('Content-Type: application/json'); // Tambahkan ini

    //     // Ambil data dari POST
    //     $id_one_water_sample = $this->input->post('id_one_water_sample', true);
    //     $review              = $this->input->post('review', true);
    //     $user_review         = $this->input->post('user_review', true);

    //     // Validasi data minimal
    //     if (!$id_one_water_sample || $review === null || !$user_review) {
    //         echo json_encode([
    //             'status' => false,
    //             'message' => 'Missing required fields.'
    //         ]);
    //         return;
    //     }

    //     // Siapkan data untuk update
    //     $data = [
    //         'review' => $review,
    //         'user_review' => $user_review,
    //         'user_updated' => $this->session->userdata('id_users'),
    //         'date_updated' => date('Y-m-d H:i:s')
    //     ];

    //     // var_dump($data);
    //     // die();

    //     // Proses update via model
    //     $this->Biobankin_model->update($id_one_water_sample, $data);

    //     // Response JSON
    //     echo json_encode([
    //         'status' => true,
    //         'message' => 'Review updated successfully.'
    //     ]);

    //     redirect(site_url("Biobankin/read/" . $id_one_water_sample));
    // }

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
    
        $this->load->model('Biobankin_model');
        $this->Biobankin_model->update($id, $data);
    
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
    
        // Debug log untuk memastikan data yang diterima
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
            'review' => 0,  // Reset status review
            'user_review' => '', // Kosongkan user review
            'user_updated' => $this->session->userdata('id_users'),
            'date_updated' => date('Y-m-d H:i:s')
        ];

        // Pastikan update pada `Biobankin_model->update` mengubah review status menjadi 'reviewed' jika sudah ada review.
        // $data = [
        //     'review' => 1,  // Set status menjadi reviewed
        //     'user_review' => $loggedInUser,  // Menyimpan user yang melakukan review
        //     'user_updated' => $this->session->userdata('id_users'),
        //     'date_updated' => date('Y-m-d H:i:s')
        // ];

    
        // Load model dan update data review di database
        $this->load->model('Biobankin_model');
        $updateResult = $this->Biobankin_model->updateCancel($id, $data);
    
        // Debug log untuk memeriksa hasil update
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
    
    

    
    

    public function savedetail() {

        $date_conduct = $this->input->post('date_conduct2', TRUE);
        $id_person = $this->input->post('id_person', TRUE);

        $mode = $this->input->post('mode_det', TRUE);
        $id_one_water_sample = $this->input->post('id_one_water_samplex', TRUE);
        $dt = new DateTime();

        $barcode_water = $this->input->post('barcode_water', TRUE);
        $weight = $this->input->post('weight', TRUE);
        $concentration_dna = $this->input->post('concentration_dna', TRUE);
        $volume = $this->input->post('volume', TRUE);
        $id_culture = $this->input->post('id_culture', TRUE);
        $barcode_tube = $this->input->post('barcode_tube', TRUE);
        $cryobox = $this->input->post('cryobox', TRUE);

        $id_freez = $this->input->post('id_freez', TRUE);
        $id_shelf = $this->input->post('id_shelf', TRUE);
        $id_rack = $this->input->post('id_rack', TRUE);
        $id_tray = $this->input->post('id_tray', TRUE);

        $id_row = $this->input->post('id_row', TRUE);
        $id_col = $this->input->post('id_col', TRUE);

        $comments = $this->input->post('comments', TRUE);        

        $loc_obj = $this->Biobankin_model->get_freezx($id_freez, $id_shelf, $id_rack, $id_tray);
        $pos_obj = $this->Biobankin_model->get_posx($id_row, $id_col);

        $id_loc = $loc_obj->id_location;
        $id_pos = $pos_obj->id_pos;        

        if ($mode == "insert") {
            $data = array(
                'barcode_water' => $barcode_water,
                'id_one_water_sample' => $id_one_water_sample,
                'weight' => $weight,
                'concentration_dna' => $concentration_dna,
                'volume' => $volume,
                'id_culture' => $id_culture,
                'barcode_tube' => $barcode_tube,
                'cryobox' => $cryobox,
                'id_location' => $id_loc,
                'id_pos' => $id_pos,
                'comments' => $comments,
                'flag' => '0',
                'uuid' => $this->uuid->v4(),
                'user_created' => $this->session->userdata('id_users'),
                'date_created' => $dt->format('Y-m-d H:i:s'),
            );

            $this->Biobankin_model->insert_det($data);

            $data_freez = array(
                'date_in' => $date_conduct,
                'time_in' => $dt->format('H:i:s'),
                'id_person' => $id_person,
                'barcode_sample' => $barcode_water,
                'barcode_tube' => $barcode_tube,
                'cryobox' => $cryobox,
                'id_location' => $id_loc,
                'comments' => $comments . ' POS: ' . $id_row . $id_col,
                'uuid' => $this->uuid->v4(),
                'user_created' => $this->session->userdata('id_users'),
                'date_created' => $dt->format('Y-m-d H:i:s'),
                'flag' => '0',
            );
            $this->Biobankin_model->insert_freez($data_freez);               

            $this->session->set_flashdata('message', 'Create Record Success');

        } else if ($mode == "edit") {
            $data = array(
                'barcode_water' => $barcode_water,
                'id_one_water_sample' => $id_one_water_sample,
                'weight' => $weight,
                'concentration_dna' => $concentration_dna,
                'volume' => $volume,
                'id_culture' => $id_culture,
                'barcode_tube' => $barcode_tube,
                'cryobox' => $cryobox,
                'id_location' => $id_loc,
                'id_pos' => $id_pos,
                'comments' => $comments,
                 'flag' => '0',
                // 'uuid' => $this->uuid->v4(),
                'user_updated' => $this->session->userdata('id_users'),
                'date_updated' => $dt->format('Y-m-d H:i:s'),
            );
            $this->Biobankin_model->update_det($barcode_water, $data);

            $data_freez = array(
                'date_in' => $date_conduct,
                'time_in' => $dt->format('H:i:s'),
                'id_person' => $id_person,
                'barcode_tube' => $barcode_tube,
                'cryobox' => $cryobox,
                'id_location' => $id_loc,
                'comments' => $comments . ' POS: ' . $id_row . $id_col,
                'uuid' => $this->uuid->v4(),
                'user_created' => $this->session->userdata('id_users'),
                'date_created' => $dt->format('Y-m-d H:i:s'),
                'flag' => '0',
            );
            $this->Biobankin_model->update_freez($barcode_water, $data_freez);                
            $this->session->set_flashdata('message', 'Update Record Success');
        }
    
        redirect(site_url("Biobankin/read/" . $id_one_water_sample));
    }


    public function delete($id) 
    {
        $row = $this->Biobankin_model->get_by_id($id);
        $data = array(
            'flag' => 1,
            );

        if ($row) {
            $this->Biobankin_model->update($id, $data);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('Biobankin'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('Biobankin'));
        }
    }

    public function delete_detail($id) 
    {
        $row = $this->Biobankin_model->get_by_id_detail($id);

        if ($row) {
            $id_parent = $row->id_one_water_sample; // Retrieve project_id before updating the record
            $data = array(
                'flag' => 1,
            );
    
            $this->Biobankin_model->update_det($id, $data);
            $this->session->set_flashdata('message', 'Delete Record Success');
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
        }
    
        redirect(site_url('Biobankin/read/'.$id_parent));
    }

    public function samplecheck() 
    {
        $id = $this->input->get('id1');
        $data = $this->Biobankin_model->samplecheck($id);
        header('Content-Type: application/json');
        echo json_encode($data);
    }

    public function get_confirmation_data() {
        $testing_types = $this->input->post('id_testing_type', TRUE);
    
        $data = array();
        if (is_array($testing_types)) {
            foreach ($testing_types as $id_testing_type) {
                $testing_type_name = $this->Biobankin_model->get_name_by_id($id_testing_type);
                $barcode = $this->Biobankin_model->get_last_barcode($testing_type_name);
    
                $data[] = array(
                    'testing_type_name' => $testing_type_name,
                    'barcode' => $barcode
                );
            }
        }
    
        echo json_encode($data);
    }
    
    public function load_freezz() 
    {
        $id = $this->input->get('id_loc');
        $data = $this->Biobankin_model->load_freezzz($id);
        header('Content-Type: application/json');
        echo json_encode($data);
    }

    public function get_freez() 
    {
        $id1 = $this->input->get('id1');
        $id2 = $this->input->get('id2');
        $id3 = $this->input->get('id3');
        $id4 = $this->input->get('id4');
        
        $data = $this->Biobankin_model->get_freezz($id1, $id2, $id3, $id4);
        
        // Debugging output
        header('Content-Type: application/json');
        echo json_encode($data);
        exit; // Ensure no extra output after JSON
    }

    public function getIdOneWaterDetails()
    {
        $idOneWaterSample = $this->input->post('id_one_water_sample');
        $oneWaterSample = $this->Biobankin_model->getOneWaterSampleById($idOneWaterSample);
        echo json_encode($oneWaterSample);
    }

    public function barcode_restrict() 
    {
        $id = $this->input->get('id1');
        $data = $this->Biobankin_model->barcode_restrict($id);
        header('Content-Type: application/json');
        echo json_encode($data);
    }
    

}

/* End of file Water_Biobankin.php */
/* Location: ./application/controllers/Water_Biobankin.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2022-12-14 03:38:42 */
/* http://harviacode.com */