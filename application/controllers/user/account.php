<?php

class Account extends MY_Controller
{
    
    public function __construct() {
        parent::__construct();
        $this->load->library('session');
    }

    public function index()
    {
        $this->load->model('user_account_model');
        $logged_in = $this->user_account_model->valid_registration($this->session->userdata('email'), $this->session->userdata('password'), $this->session->userdata('username'));
        
        if ( ! $logged_in) {
            header('location:'.$this->config->item('base_url'));
                exit;
        }
        
        $this->load->model('page_info_model');
        $data = array(
            'main_menu' => $this->page_info_model->get_data_main_menu(),
            'user' => array(
                'username' => $this->session->userdata('username'),
                'email' => $this->session->userdata('email'),
            ),
        );
        $this->load->view('user/account_'.$this->page_lang, $data);
    }
    
    public function change_username()
    {       
        if ( ! isset($_POST['username'], $_POST['password'])) {
            header('location:'.$this->config->item('base_url'));
                exit;
        }
        
        $valid_rules = array(
            array(
                'field' => 'username',
                'label' => 'lang:username',
                'rules' => 'required|trim|max_length[30]|alpha_dash',
            ),
            array(
                'field' => 'password',
                'label' => 'lang:password',
                'rules' => 'required|max_length[20]|callback_verify_password',
            ),
        );
        
        $this->load->library('form_validation');
        $this->form_validation->set_rules($valid_rules);
        $this->form_validation->set_error_delimiters('<div>', '</div>');
        
        if ( ! $this->form_validation->run()) {
            $answer = array(
                'error' => TRUE,
                'message' => validation_errors(),
            );
        }
        else {
            $this->load->model('user_account_model');
            if ($this->user_account_model->change_username($this->session->userdata('email'), md5($_POST['password']), $_POST['username'])) {
                $this->session->set_userdata('username', $_POST['username']);
                
                $message_ru = '- поле <b>Ф.И.О.</b> успешно изменнено.';
                $message_en = '- the <b>username</b> field has been successfully changed.';
                
                $answer = array(
                    'error' => FALSE,
                    'message' => ${'message_'.$this->page_lang},
                    'username' => $_POST['username'],
                );
            }
            else {
                
                $message_ru = '- не удалось изменить Ф.И.О.';
                $message_en = '- failed to change the username.';
                
                $answer = array(
                    'error' => TRUE,
                    'message' => ${'message_'.$this->page_lang},
                );
            }
        }
        echo json_encode($answer);
    }
    
    public function change_password()
    {       
        if ( ! isset($_POST['password'], $_POST['new_password'], $_POST['confirm_password'])) {
            header('location:'.$this->config->item('base_url'));
                exit;
        }
        
        $valid_rules = array(
            array(
                'field' => 'password',
                'label' => 'lang:password',
                'rules' => 'required|max_length[20]|callback_verify_password',
            ),
            array(
                'field' => 'new_password',
                'label' => 'lang:new_password',
                'rules' => 'required|min_length[6]',
            ),
            array(
                'field' => 'confirm_password',
                'label' => 'lang:confirm_password',
                'rules' => 'callback_verify_confirm_password',
            ),
        );
        
        $this->load->library('form_validation');
        $this->form_validation->set_rules($valid_rules);
        $this->form_validation->set_error_delimiters('<div>', '</div>');
        
        if ( ! $this->form_validation->run()) {
            $answer = array(
                'error' => TRUE,
                'message' => validation_errors(),
            );
        }
        else {
            $this->load->model('user_account_model');
            if ($this->user_account_model->change_password($this->session->userdata('email'), md5($_POST['password']), md5($_POST['new_password']))) {
                $this->session->set_userdata('password', md5($_POST['new_password']));
                
                $message_ru = '- поле <b>пароль</b> успешно изменнено.';
                $message_en = '- the <b>password</b> field has been successfully changed.';
                
                $answer = array(
                    'error' => FALSE,
                    'message' => ${'message_'.$this->page_lang},
                );
            }
            else {
                
                $message_ru = '- не удалось изменить пароль';
                $message_en = '- failed to change the password.';
                
                $answer = array(
                    'error' => TRUE,
                    'message' => ${'message_'.$this->page_lang},
                );
            }
        }
        echo json_encode($answer);
    }
    
    public function change_email()
    {
        if ( ! isset($_POST['new_email'], $_POST['password'])) {
            header('location:'.$this->config->item('base_url'));
                exit;
        }
        
        $valid_rules = array(
            array(
                'field' => 'new_email',
                'label' => 'lang:new_email',
                'rules' => 'required|valid_email|callback_verify_allow_email',
            ),
            array(
                'field' => 'password',
                'label' => 'lang:password',
                'rules' => 'required|max_length[20]|callback_verify_password',
            ),
        );
        
        $this->load->library('form_validation');
        $this->form_validation->set_rules($valid_rules);
        $this->form_validation->set_error_delimiters('<div>', '</div>');
        
        if ( ! $this->form_validation->run()) {
            $answer = array(
                'error' => TRUE,
                'message' => validation_errors(),
            );
        }
        else {
            $this->load->model('user_account_model');
            if ($this->user_account_model->perform_change_email($this->session->userdata('email'), md5($_POST['password']), $_POST['new_email'])) {               
                
                $message_ru = '- письмо успешно отправлено.';
                $message_en = '- email has been sent.';
                
                $answer = array(
                    'error' => FALSE,
                    'message' => ${'message_'.$this->page_lang},
                );
            }
            else {
                
                $message_ru = '- не удалось отправить письмо или ошибка в базе данных.';
                $message_en = '- failed to send email or an error in the database.';
                
                $answer = array(
                    'error' => TRUE,
                    'message' => ${'message_'.$this->page_lang},
                );
            }
        }
        echo json_encode($answer);
    }
    
//    public function ask_question()
//    {
//        if ( ! isset($_POST['question'], $_POST['captcha'])) {
//            header('location:'.$this->config->item('base_url'));
//                exit;
//        }
//        
//        $valid_rules = array(
//            array(
//                'field' => 'question',
//                'label' => '',
//                'rules' => 'callback_verify_question',
//            ),
//            array(
//                'field' => 'captcha',
//                'label' => 'lang:captcha',
//                'rules' => 'required|callback_verify_captcha',
//            ),
//        );
//        
//        $this->load->library('form_validation');
//        $this->form_validation->set_rules($valid_rules);
//        $this->form_validation->set_error_delimiters('<div>', '</div>');      
//        $this->load->model('captcha');
//        $this->captcha->set_captcha();
//        $captcha = $this->captcha->get_captcha();
//        
//        if ( ! $this->form_validation->run()) {
//            $answer = array(
//                'error' => TRUE,
//                'message' => validation_errors(),
//                'captcha_img' => $captcha['image'],
//            );
//        }
//        else {
//            $question = htmlspecialchars($_POST['question'], ENT_QUOTES);
//            $sender_email = $this->session->userdata('email');
//            $sender_name = $this->session->userdata('username');
//            
//            $this->load->model('user_account_model');
//            if ($this->user_account_model->mail_ask_question($question, $sender_email, $sender_name)) {
//                $answer = array(
//                    'error' => FALSE,
//                    'message' => '- письмо успешно отправлено. Спасибо за вопрос.',
//                    'captcha_img' => $captcha['image'],
//                );
//            }
//            else {
//                $answer = array(
//                    'error' => TRUE,
//                    'message' => '- не удалось отправить письмо.',
//                    'captcha_img' => $captcha['image'],
//                );
//            }
//        }
//        echo json_encode($answer);
//    }
    
    public function verify_password() // callback-function for $valid_rules
    {       
        $this->load->model('user_account_model');
        return ($this->user_account_model->valid_registration($this->session->userdata('email'), md5($_POST['password']), $this->session->userdata('username'))) ? TRUE : FALSE; 
    }
        
    public function verify_allow_email() // функция обратного вызова для $valid_rules
    {      
        $this->load->model('user_account_model');
        return ($this->user_account_model->allow_email($_POST['new_email'])) ? TRUE : FALSE; 
    }
    
    public function verify_confirm_password() // функция обратного вызова для $valid_rules
    {     
        return ($_POST['new_password'] === $_POST['confirm_password']) ? TRUE : FALSE;
    }
    
//    public function verify_captcha() // функция обратного вызова для $valid_rules
//    {    
//        $this->load->model('captcha');
//        return ($this->captcha->verify_captcha($_POST['captcha'])) ? TRUE : FALSE;
//    }
    
//    public function verify_question() // функция обратного вызова для $valid_rules
//    {
//        if (trim($_POST['question']) == '') {
//            $this->form_validation->set_message('verify_question', '- вы хотите отправить пустое письмо.');
//            return FALSE;
//        }
//        else return TRUE;
//    }
    
    public function activate_new_email()
    {
        if ( isset($_GET['old_email'], $_GET['id']))  {
            $this->load->model('user_account_model');
            $this->user_account_model->activate_new_email($_GET['old_email'], $_GET['id']);          
        }
        header('location:'.$this->config->item('base_url'));
            exit;
    }
    
    public function logout()
    {
        $this->session->sess_destroy();     
        if (isset($_GET['url'])) {
            header('location:'.$_GET['url']);
                exit;
        }
        elseif (isset($_GET['lang'])) {
            header('location:'.$this->config->item('base_url').'?lang='.$this->page_lang);
                exit;
        }
        else {
            header('location:'.$this->config->item('base_url'));        
                exit;
        }
    }

}

?>