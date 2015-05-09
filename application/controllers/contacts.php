<?php

class Contacts extends MY_Controller
{
    private $uri_db = '/contacts';
    
    public function __construct() {
        parent::__construct();
        $this->load->library('session');
    }

    public function index()
    {
        $this->load->model('page_info_model');
        $this->load->model('user_account_model');
        $this->load->model('captcha');
        $this->captcha->set_captcha();
        
        $logged_in = $this->user_account_model->valid_registration($this->session->userdata('email'), $this->session->userdata('password'), $this->session->userdata('username'));
        $data = array(
            'current_page' => $this->page_info_model->get_data_current_page($this->uri_db),
            'main_menu' => $this->page_info_model->get_data_main_menu(),
            'contacts' => $this->page_info_model->get_data_contacts(),
            'logged_in' => $logged_in,
            'captcha' => $this->captcha->get_captcha(),
        );
        
        $this->load->view('head', $data);
        $this->load->view('user/authorization_'.$this->page_lang, $data);
        $this->load->view('header_content_'.$this->page_lang);
        $this->load->view('navigation', $data);
        $this->load->view('start_content');
        $this->load->view('right_block');
        $this->load->view('central_block_contacts', $data);
        $this->load->view('end_content');
        $this->load->view('footer');
    }
    
    public function admin($logout = NULL)
    {
        if ($logout == 'logout') {
            $this->session->sess_destroy(); 
            header('location:'.$this->uri_db.'/admin');        
                exit;
        }
        
        $this->load->model('admin_model');
        
        if ($this->session->userdata('admin') && $this->admin_model->verify_admin_user($this->session->userdata('username'), $this->session->userdata('password'))) {
            $this->load->model('page_info_model');
            $this->load->model('editor');
            $this->load->helper('image_helper');

            $data = array(
                'current_page' => $this->page_info_model->get_data_current_page($this->uri_db),
                'main_menu' => $this->page_info_model->get_data_main_menu(),
                'contacts' => $this->page_info_model->get_data_contacts(),
                'editor' => $this->editor,
                'availables_images' => availables_images('./images'.$this->uri_db),
            );
            
            $this->load->view('admin/head', $data);
            $this->load->view('admin/admin_box', $data);
            $this->load->view('admin/header_content_'.$this->page_lang);
            $this->load->view('admin/navigation', $data);
            $this->load->view('start_content');
            $this->load->view('admin/central_block_contacts', $data);
            $this->load->view('end_content');
            $this->load->view('footer');
        }
        else $this->load->view('request/admin_login_form', array('sender' => $this->uri_db.'/admin'));
      
    }
    
}

?>
