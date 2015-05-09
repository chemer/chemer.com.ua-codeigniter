<?php

class Update extends MY_Controller
{
    
    public function __construct()
    {
        parent::__construct();
        
        $this->load->library('session');
        $this->load->model('admin_model');
        
        if ( ! $this->session->userdata('admin') && ! $this->admin_model->verify_admin_user($this->session->userdata('username'), $this->session->userdata('password'))) {
            header('location:'.$this->config->item('base_url'));
                exit;
        }
    }
    
    public function metadata()
    {    
        $this->admin_model->update_metadata();
    }
    
    public function active_title()
    {    
        $this->admin_model->update_active_title();
    }
    
    public function main_content()
    {
        $this->admin_model->update_main_content();
    }
    
    public function bottom_content()
    {
        $this->admin_model->update_bottom_content();
    }
    
    public function add_portfolio_item()
    {
        $this->admin_model->add_portfolio_item();
    }
    
    public function save_portfolio_item()
    {
        $this->admin_model->save_portfolio_item();
    }
    
    public function remove_portfolio_item()
    {
        $this->admin_model->remove_portfolio_item();
    }
    
    public function add_contact()
    {
        $this->admin_model->add_contact();
    }
    
    public function save_contact()
    {
        $this->admin_model->save_contact();
    }
    
    public function remove_contact()
    {
        $this->admin_model->remove_contact();
    }
    
//    public function create_group()
//    {
//        $this->admin_model->create_group();
//    }
//    
//    public function remove_group()
//    {
//        $this->admin_model->remove_group();
//    }
//    
//    public function group_description()
//    {
//        $this->admin_model->update_group_description();
//    }
//    
//    public function add_image_group()
//    {
//        $this->admin_model->add_image_group();
//    }
//    
//    public function remove_image_group()
//    {
//        $this->admin_model->remove_image_group();
//    }
//    
//    public function save_image_group()
//    {
//        $this->admin_model->save_image_group();
//    }
//    
//    public function add_video()
//    {
//        $this->admin_model->add_video();
//    }
//    
//    public function remove_video()
//    {
//        $this->admin_model->remove_video();
//    }
    
}

?>
