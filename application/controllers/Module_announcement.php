<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Module_announcement extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Module_announcement_model');
        $this->load->library('form_validation');
        $this->load->library('datatables');
        
        // Check if user is logged in
        if (!$this->session->userdata('id_users')) {
            redirect('auth');
        }
        
        // Check if superadmin for management pages (except mark_as_read)
        $allowed_methods = array('mark_as_read');
        if (!in_array($this->router->method, $allowed_methods)) {
            if ($this->session->userdata('id_user_level') != 1) {
                $this->session->set_flashdata('message', 'Access denied. SuperAdmin only.');
                redirect('dashboard');
            }
        }
    }

    public function index()
    {
        $data = array(
            'page_title' => 'Module Announcements',
            'page_description' => 'Manage system-wide module announcements and updates'
        );
        
        $this->template->load('template', 'module_announcement/index', $data);
    } 
    
    public function json() {
        header('Content-Type: application/json');
        echo $this->Module_announcement_model->json();
    }

    public function read($id) 
    {
        $row = $this->Module_announcement_model->get_by_id($id);
        if ($row) {
            $stats = $this->Module_announcement_model->get_read_stats($id);
            $users_read = $this->Module_announcement_model->get_users_who_read($id);
            
            $data = array(
                'page_title' => 'View Announcement',
                'page_description' => 'Announcement details and read statistics',
                'row' => $row,
                'stats' => $stats,
                'users_read' => $users_read
            );
            $this->template->load('template', 'module_announcement/read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('module_announcement'));
        }
    }

    public function create() 
    {
        $data = array(
            'page_title' => 'Create Announcement',
            'page_description' => 'Create new module announcement',
            'button' => 'Create',
            'action' => site_url('module_announcement/create_action'),
            'id_announcement' => set_value('id_announcement'),
            'module_url' => set_value('module_url'),
            'title' => set_value('title'),
            'message' => set_value('message'),
            'announcement_type' => set_value('announcement_type', 'info'),
            'is_active' => set_value('is_active', 1),
            'priority' => set_value('priority', 0),
            'date_expire' => set_value('date_expire'),
            'require_acknowledgment' => set_value('require_acknowledgment', 1),
            'modules' => $this->Module_announcement_model->get_all_modules()
        );
        $this->template->load('template', 'module_announcement/form', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
                'module_url' => $this->input->post('module_url', TRUE),
                'title' => $this->input->post('title', TRUE),
                'message' => $this->input->post('message', TRUE),
                'announcement_type' => $this->input->post('announcement_type', TRUE),
                'is_active' => $this->input->post('is_active', TRUE) ? 1 : 0,
                'created_by' => $this->session->userdata('id_users'),
                'date_created' => date('Y-m-d H:i:s'),
                'date_expire' => $this->input->post('date_expire', TRUE) ? $this->input->post('date_expire', TRUE) : NULL,
                'priority' => $this->input->post('priority', TRUE),
                'require_acknowledgment' => $this->input->post('require_acknowledgment', TRUE) ? 1 : 0,
                'flag' => 0,
            );

            $this->Module_announcement_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('module_announcement'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Module_announcement_model->get_by_id($id);

        if ($row) {
            $data = array(
                'page_title' => 'Update Announcement',
                'page_description' => 'Update module announcement',
                'button' => 'Update',
                'action' => site_url('module_announcement/update_action'),
                'id_announcement' => set_value('id_announcement', $row->id_announcement),
                'module_url' => set_value('module_url', $row->module_url),
                'title' => set_value('title', $row->title),
                'message' => set_value('message', $row->message),
                'announcement_type' => set_value('announcement_type', $row->announcement_type),
                'is_active' => set_value('is_active', $row->is_active),
                'priority' => set_value('priority', $row->priority),
                'date_expire' => set_value('date_expire', $row->date_expire),
                'require_acknowledgment' => set_value('require_acknowledgment', $row->require_acknowledgment),
                'modules' => $this->Module_announcement_model->get_all_modules()
            );
            $this->template->load('template', 'module_announcement/form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('module_announcement'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_announcement', TRUE));
        } else {
            $data = array(
                'module_url' => $this->input->post('module_url', TRUE),
                'title' => $this->input->post('title', TRUE),
                'message' => $this->input->post('message', TRUE),
                'announcement_type' => $this->input->post('announcement_type', TRUE),
                'is_active' => $this->input->post('is_active', TRUE) ? 1 : 0,
                'date_expire' => $this->input->post('date_expire', TRUE) ? $this->input->post('date_expire', TRUE) : NULL,
                'priority' => $this->input->post('priority', TRUE),
                'require_acknowledgment' => $this->input->post('require_acknowledgment', TRUE) ? 1 : 0,
            );

            $this->Module_announcement_model->update($this->input->post('id_announcement', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('module_announcement'));
        }
    }
    
    public function delete() 
    {
        $id = $this->input->post('id', TRUE);
        
        // Soft delete
        $data = array('flag' => 1);
        $this->Module_announcement_model->update($id, $data);
        
        echo json_encode(array("status" => TRUE));
    }

    public function _rules() 
    {
        $this->form_validation->set_rules('module_url', 'Module', 'trim|required');
        $this->form_validation->set_rules('title', 'Title', 'trim|required');
        $this->form_validation->set_rules('message', 'Message', 'trim|required');
        $this->form_validation->set_rules('announcement_type', 'Type', 'trim|required');
        $this->form_validation->set_rules('priority', 'Priority', 'trim|required|numeric');

        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }
    
    // AJAX: Mark announcement as read (accessible by all users)
    public function mark_as_read() {
        $id_announcement = $this->input->post('id_announcement', TRUE);
        $user_id = $this->session->userdata('id_users');
        
        if (!$id_announcement || !$user_id) {
            echo json_encode(array('status' => 'error', 'message' => 'Invalid request'));
            return;
        }
        
        $result = $this->Module_announcement_model->mark_as_read($id_announcement, $user_id);
        
        if ($result) {
            echo json_encode(array('status' => 'success', 'message' => 'Marked as read'));
        } else {
            echo json_encode(array('status' => 'error', 'message' => 'Failed to mark as read'));
        }
    }
    
    // Toggle active status
    public function toggle_active() {
        $id = $this->input->post('id', TRUE);
        $row = $this->Module_announcement_model->get_by_id($id);
        
        if ($row) {
            $data = array('is_active' => $row->is_active == 1 ? 0 : 1);
            $this->Module_announcement_model->update($id, $data);
            echo json_encode(array('status' => 'success', 'is_active' => $data['is_active']));
        } else {
            echo json_encode(array('status' => 'error', 'message' => 'Record not found'));
        }
    }
}
