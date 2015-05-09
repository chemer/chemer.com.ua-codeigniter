<?php

class Registration extends MY_Controller{
    
    public function index()
    {    
        $valid_rules = array(
            array(
                'field' => 'username',
                'label' => 'lang:username',
                'rules' => 'required|trim|max_length[30]|alpha_dash',
            ),
            array(
                'field' => 'email',
                'label' => 'lang:email',
                'rules' => 'required|valid_email|callback_verify_allow_email',
            ),
            array(
                'field' => 'password',
                'label' => 'lang:password',
                'rules' => 'required|min_length[6]',
            ),
            array(
                'field' => 'confirm_password',
                'label' => 'lang:confirm_password',
                'rules' => 'callback_verify_confirm_password',
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
        $this->load->model('page_info_model');
        
        if ( ! $this->form_validation->run()) {
            $this->load->model('captcha');
            $this->captcha->set_captcha();
            $captcha = $this->captcha->get_captcha();
            $data = array(
                'main_menu' => $this->page_info_model->get_data_main_menu(),
                'captcha_img' => $captcha['image'],
            );
            $this->load->view('user/registration_'.$this->page_lang, $data);
        }
        else {
            $this->load->model('user_account_model');
            $this->load->helper('string');
            $registration_id = random_string('md5');
            $send_mail = $this->user_account_model->mail_registration($_POST['email'], $registration_id);
            $add_user = $this->user_account_model->add_user($_POST['username'], $_POST['email'], md5($_POST['password']), $registration_id);
            if (( ! $send_mail) || ( ! $add_user)) {
                header('location:'.$this->config->item('base_url'));
                    exit; // не удалось отправить письмо или записать данные пользователя в базу данных
            }
            $data = array(
                'main_menu' => $this->page_info_model->get_data_main_menu(),
            );
            $this->load->view('user/registration_success_'.$this->page_lang);
        }   
        
    }
    
    public function activate()
    {
        if (isset($_GET['email'], $_GET['id'])) {
            $this->load->model('user_account_model');
            $this->user_account_model->activate_registration($_GET['email'], $_GET['id']);
        }
        header('location:'.$this->config->item('base_url'));
            exit;
    }

    public function verify_allow_email() // функция обратного вызова для $valid_rules
    {
        $this->load->model('user_account_model');
        return ($this->user_account_model->allow_email($_POST['email'])) ? TRUE : FALSE;
    }
    
    public function verify_confirm_password() // функция обратного вызова для $valid_rules
    {
        return ($_POST['password'] === $_POST['confirm_password']) ? TRUE : FALSE;
    }
    
    public function verify_captcha() // функция обратного вызова для $valid_rules
    {     
        $this->load->model('captcha');
        return ($this->captcha->verify_captcha($_POST['captcha'])) ? TRUE : FALSE; 
    }

}

?>
