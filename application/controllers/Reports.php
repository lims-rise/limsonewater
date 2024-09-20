<?php
class Reports extends CI_Controller{
    
    
    function index(){
        // redirect(base_url('index.php/auth'));
        $this->load->view('auth/blokir_akses');
    }
}