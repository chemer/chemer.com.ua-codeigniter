<?php

class Remove_image extends MY_Controller
{   
    public function index()
    {
        $this->load->library('session');
        $this->load->model('admin_model');
        
        if ($this->session->userdata('admin') && 
            $this->admin_model->verify_admin_user($this->session->userdata('username'), $this->session->userdata('password')) &&
            preg_match('|^/images/(\S)+$|', $_POST['image_url'])) 
        {
         
            if (unlink('.'.$_POST['image_url'])) {
                $answer = array(
                    'error' => FALSE,
                    'message' => 'success removing',
                    'image_url' => $_POST['image_url']
                );
            }
            else {
                $answer = array(
                    'error' => TRUE,
                    'message' => 'error removing'
                );
            }

            echo json_encode($answer);
        }
        else {
            header('location:'.$this->config->item('base_url'));
                exit;
        }
        
    }
    
}

?>
