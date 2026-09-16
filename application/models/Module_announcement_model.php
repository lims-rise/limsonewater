<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Module_announcement_model extends CI_Model
{
    public $table = 'module_announcements';
    public $id = 'id_announcement';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

    // Get unread announcements for specific module and user
    public function get_unread_announcements($module_url, $user_id) {
        $this->db->select('ma.*, u.full_name as created_by_name');
        $this->db->from('module_announcements ma');
        $this->db->join('tbl_user u', 'ma.created_by = u.id_users', 'left');
        $this->db->where('ma.module_url', $module_url);
        $this->db->where('ma.is_active', 1);
        $this->db->where('ma.flag', 0);
        
        // Check if not expired
        $this->db->where('(ma.date_expire IS NULL OR ma.date_expire > NOW())');
        
        // Check if not read by this user
        $this->db->where("NOT EXISTS (
            SELECT 1 FROM module_announcements_read mar 
            WHERE mar.id_announcement = ma.id_announcement 
            AND mar.id_user = {$user_id}
        )");
        
        $this->db->order_by('ma.priority DESC, ma.date_created DESC');
        
        return $this->db->get()->result();
    }
    
    // Mark announcement as read
    public function mark_as_read($id_announcement, $user_id) {
        $data = array(
            'id_announcement' => $id_announcement,
            'id_user' => $user_id,
            'date_read' => date('Y-m-d H:i:s')
        );
        
        // Check if already exists
        $this->db->where('id_announcement', $id_announcement);
        $this->db->where('id_user', $user_id);
        $existing = $this->db->get('module_announcements_read')->row();
        
        if (!$existing) {
            return $this->db->insert('module_announcements_read', $data);
        }
        
        return true; // Already marked as read
    }
    
    // Datatables
    function json() {
        $this->datatables->select('ma.id_announcement, ma.module_url, tm.title as module_name, ma.title as announcement_title, ma.announcement_type, ma.is_active, ma.priority, ma.date_created, u.full_name as created_by_name, ma.flag');
        $this->datatables->from('module_announcements ma');
        $this->datatables->join('tbl_user u', 'ma.created_by = u.id_users', 'left');
        $this->datatables->join('tbl_menu tm', 'ma.module_url = tm.url', 'left');
        $this->datatables->where('ma.flag', 0);
        $this->datatables->add_column('action', 
            anchor(site_url('module_announcement/read/$1'),'<i class="fa fa-eye"></i>', array('class' => 'btn btn-info btn-sm', 'title' => 'View')) . ' ' .
            anchor(site_url('module_announcement/update/$1'),'<i class="fa fa-pencil-square-o"></i>', array('class' => 'btn btn-warning btn-sm', 'title' => 'Edit')) . ' ' . 
            '<button class="btn btn-danger btn-sm btn_delete" data-id="$1" title="Delete"><i class="fa fa-trash"></i></button>', 
            'id_announcement');
        return $this->datatables->generate();
    }

    // get total rows
    function total_rows($q = NULL) {
        $this->db->like('id_announcement', $q);
        $this->db->or_like('module_url', $q);
        $this->db->or_like('title', $q);
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // get data by id
    function get_by_id($id)
    {
        $this->db->where($this->id, $id);
        return $this->db->get($this->table)->row();
    }
    
    // get all
    function get_all()
    {
        $this->db->order_by($this->id, $this->order);
        $this->db->where('flag', 0);
        return $this->db->get($this->table)->result();
    }

    // insert
    function insert($data)
    {
        $this->db->insert($this->table, $data);
    }

    // update data
    function update($id, $data)
    {
        $this->db->where($this->id, $id);
        $this->db->update($this->table, $data);
    }

    // delete data
    function delete($id)
    {
        $this->db->where($this->id, $id);
        $this->db->delete($this->table);
    }
    
    // Get read statistics
    function get_read_stats($id_announcement) {
        // Total users (exclude superadmin)
        $this->db->where('id_user_level !=', 1);
        $total_users = $this->db->count_all_results('tbl_user');
        
        // Users who read
        $this->db->where('id_announcement', $id_announcement);
        $read_users = $this->db->count_all_results('module_announcements_read');
        
        return array(
            'total_users' => $total_users,
            'read_users' => $read_users,
            'read_percentage' => $total_users > 0 ? round(($read_users / $total_users) * 100, 1) : 0
        );
    }
    
    // Get list of users who read
    function get_users_who_read($id_announcement) {
        $this->db->select('mar.date_read, u.full_name, u.email');
        $this->db->from('module_announcements_read mar');
        $this->db->join('tbl_user u', 'mar.id_user = u.id_users');
        $this->db->where('mar.id_announcement', $id_announcement);
        $this->db->order_by('mar.date_read', 'DESC');
        return $this->db->get()->result();
    }
    
    // Get all modules from tbl_menu
    function get_all_modules() {
        $this->db->select('id_menu, title as menu_name, url');
        $this->db->from('tbl_menu');
        $this->db->where('is_aktif', 'y');
        $this->db->where('url IS NOT NULL');
        $this->db->where('url !=', '');
        $this->db->order_by('title', 'ASC');
        return $this->db->get()->result();
    }
}
