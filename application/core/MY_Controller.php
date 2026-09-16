<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Base Controller with Module Announcement Support
 * 
 * All module controllers can extend this to automatically get announcement functionality
 */
class MY_Controller extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        
        // Load announcement model
        $this->load->model('Module_announcement_model');
    }
    
    /**
     * Load template with automatic announcement injection
     * 
     * @param string $template Template name
     * @param string $view View name
     * @param array $data Data to pass to view
     * @param string $module_url Override module URL (auto-detect if not provided)
     */
    protected function load_template_with_announcements($template, $view, $data = array(), $module_url = null) {
        // Auto-detect module URL from current controller name if not provided
        if ($module_url === null) {
            $module_url = strtolower($this->router->fetch_class());
        }
        
        // Get current user ID
        $user_id = $this->session->userdata('id_users');
        
        // Load unread announcements for this module
        if ($user_id) {
            $data['module_announcements'] = $this->Module_announcement_model->get_unread_announcements($module_url, $user_id);
        } else {
            $data['module_announcements'] = array();
        }
        
        // Load template as usual
        $this->template->load($template, $view, $data);
    }
}
