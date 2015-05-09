<?php

class Upload_image extends MY_Controller
{
    public function index()
    {
        $this->load->library('session');
        $this->load->model('admin_model');
        
        if ($this->session->userdata('admin') && 
            $this->admin_model->verify_admin_user($this->session->userdata('username'), $this->session->userdata('password')) &&
            preg_match('|^/images/(\S)+$|', $_POST['upload_dir'])) 
        {
            
            $config['upload_path'] = '.'.$_POST['upload_dir'];
            $config['allowed_types'] = 'gif|jpg|png';
            $config['max_size']	= '400';
            $config['max_width']  = '1000';
            $config['max_height']  = '900';

            $this->load->library('upload', $config);

            if ( ! $this->upload->do_upload()) {
                $data = array(
                    'sender' => $_POST['sender'],
                    'upload_data' => $this->upload->display_errors()
                );
                $this->load->view('request/upload_error', $data);
            }
            else {
                $data = array(
                    'sender' => $_POST['sender'],
                    'upload_data' => $this->upload->data()
                );
                $this->load->view('request/upload_success', $data);
            }
            
        }
        else {
            header('location:'.$this->config->item('base_url'));
                exit;
        }  
        
    }
}
?>