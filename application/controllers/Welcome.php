<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

    function __construct()
    {
        parent::__construct();
        // is_login();
        $this->load->model(['Welcome_model', 'Dashboard_model']);
    }


    public function index() {
        // Get dashboard data
        $data['summary'] = $this->Dashboard_model->get_dashboard_summary();
        $data['module_statistics'] = $this->Dashboard_model->get_module_statistics();
        $data['recent_activities'] = $this->Dashboard_model->get_recent_activities(8);
        $data['workflow_status'] = $this->Dashboard_model->get_workflow_status();
        $data['monthly_statistics'] = $this->Dashboard_model->get_monthly_statistics();
        
        $this->template->load('template', 'welcome', $data);
    }

    public function form() {
        //$this->load->view('table');
        $this->template->load('template', 'form');
    }
    
    function autocomplate(){
        autocomplate_json('tbl_user', 'full_name');
    }

    function __autocomplate() {
        $this->db->like('nama_lengkap', $_GET['term']);
        $this->db->select('nama_lengkap');
        $products = $this->db->get('pegawai')->result();
        foreach ($products as $product) {
            $return_arr[] = $product->nama_lengkap;
        }

        echo json_encode($return_arr);
    }

    function pdf() {
        $this->load->library('pdf');
        $pdf = new FPDF('l', 'mm', 'A5');
        // membuat halaman baru
        $pdf->AddPage();
        // setting jenis font yang akan digunakan
        $pdf->SetFont('Arial', 'B', 16);
        // mencetak string 
        $pdf->Cell(190, 7, 'LIMS RISE', 0, 1, 'C');
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->Cell(190, 7, 'LIMS RISE', 0, 1, 'C');
        $pdf->Output();
    }

}
