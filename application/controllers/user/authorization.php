<?php

class Authorization extends MY_Controller
{      
    public function index()
    {
        if ( ! isset($_POST['email'], $_POST['password'], $_POST['remember'])) {
            header('location:'.$this->config->item('base_url'));
                exit;
        }
        
        $error_message_ru = '- неверный <b>e-mail адрес</b> или <b>пароль</b>.';
        $error_message_en = '- incorrect <b>e-mail address</b> or <b>password</b>.';
        
        $answer = array(
            'error' => TRUE,
            'message' => ${'error_message_'.$this->page_lang},
        );
        $email = trim($_POST['email']);
        $password = trim($_POST['password']);
        $remember = $_POST['remember'];
        
        if ($email == '' || $password == '') {
            echo json_encode($answer);
        }
        else {
            $this->load->model('user_account_model');
            
            if ($this->user_account_model->valid_authorization($email, md5($password))) {
                $answer = array('error' => FALSE);
                $remember = ($remember == 'on') ? TRUE : FALSE;
                ($remember) ? $this->config->set_item('sess_expiration', 0) : $this->config->set_item('sess_expire_on_close', TRUE);
                $this->load->library('session');
                $userdata = array(
                    'username' => $this->user_account_model->get_username($email),
                    'email' => $email,
                    'password' => md5($password),
                );
                $this->session->set_userdata($userdata);
            }
            echo json_encode($answer);
            return;
        }
        
    }
    
    public function generate_password()
    {
        if ( ! isset($_POST['email'], $_POST['captcha'])) {
            header('location:'.$this->config->item('base_url'));
                exit;
        }
        
        $valid_rules = array(
            array(
                'field' => 'email',
                'label' => 'lang:e-mail',
                'rules' => 'required|valid_email|callback_verify_activation_status',
            ),
            array(
                'field' => 'captcha',
                'label' => 'lang:captcha',
                'rules' => 'required|callback_verify_captcha',
            ),
        );
        
        $this->load->library('form_validation');
        $this->form_validation->set_rules($valid_rules);
        $this->form_validation->set_error_delimiters('<div>', '</div>');      
        $this->load->model('captcha');
        $this->captcha->set_captcha();
        $captcha = $this->captcha->get_captcha();
        
        if ( ! $this->form_validation->run()) {
            $answer = array(
                'error' => TRUE,
                'message' => validation_errors(),
                'captcha_img' => $captcha['image'],
            );
        }
        else {
            $error_message_ru = '- не удалось отправить письмо.';
            $error_message_en = '- error email sending.';
            $success_message_ru = '- письмо успешно отправлено.';
            $success_message_en = '- success email sending.';
            
            $this->load->model('user_account_model');
            if ($this->user_account_model->perform_forgot_password($_POST['email'])) {
                $answer = array(
                    'error' => FALSE,
                    'message' => ${'success_message_'.$this->page_lang},
                    'captcha_img' => $captcha['image'],
                );
            }
            else {
                $answer = array(
                    'error' => TRUE,
                    'message' => ${'error_message_'.$this->page_lang},
                    'captcha_img' => $captcha['image'],
                );
            }
        }
        echo json_encode($answer);
    }
    
    public function verify_activation_status() // функция обратного вызова для $valid_rules
    {
        $this->load->model('user_account_model');
        return ($this->user_account_model->activation_status($_POST['email'])) ? TRUE : FALSE;
    }
    
    public function verify_captcha() // функция обратного вызова для $valid_rules
    {      
        $this->load->model('captcha');
        return ($this->captcha->verify_captcha($_POST['captcha'])) ? TRUE : FALSE; 
    }
    
    public function activate_generated_password()
    {
        if (isset($_GET['email'], $_GET['id'])) {
            $this->load->model('user_account_model');
            $this->user_account_model->activate_generated_password($_GET['email'], $_GET['id']);
        }
        header('location:'.$this->config->item('base_url'));
            exit;
    }
    
}

?>