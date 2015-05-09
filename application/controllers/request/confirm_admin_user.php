<?php

class Confirm_admin_user extends MY_Controller
{
    public function index()
    {
        $this->load->library('session');
        
        $attempt = $this->session->userdata('attempt');
        
        ( ! $attempt) ? $this->session->set_userdata('attempt', 1) : $this->session->set_userdata('attempt', $attempt+1);
        
        if (( ! isset($_POST['username'], $_POST['password'], $_POST['sender'])) || ($attempt >= 3)) {
            $this->session->sess_destroy();
            header('location:'.$this->config->item('base_url'));        
                exit;
        }

        $this->load->model('admin_model');
        
        if ($this->admin_model->verify_admin_user($_POST['username'], $_POST['password'])) {
            $this->session->set_userdata('username', $_POST['username']);
            $this->session->set_userdata('password', $_POST['password']);
            $this->session->set_userdata('admin', TRUE);
        }
        
        unset($GLOBALS['_POST']['username'], $GLOBALS['_POST']['password']);
        
        header('location:'.$_POST['sender']);        
                exit;
    }
}
?>
