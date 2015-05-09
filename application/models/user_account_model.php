<?php

class User_account_model extends CI_Model
{
    
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->clear_db();
    }
    
    public function get_username($email)
    {
        if ( ! $email) return FALSE;
        
        $sql = "SELECT `username` FROM `users` WHERE BINARY `email` = ?";
        $query = $this->db->query($sql, array($email));
        return ($query) ? $query->row()->username : FALSE;       
    }
    
    public function valid_registration($email, $password, $username)
    {
        if (( ! $email) || ( ! $password) || ( ! $username)) return FALSE;
        
        $sql = "SELECT COUNT(*) AS `count` FROM `users` WHERE BINARY `email` = ? AND BINARY `password` = ? AND BINARY `username` = ? AND `activation` = 1";
        $query = $this->db->query($sql, array($email, $password, $username));
        return ($query->row()->count == 0) ? FALSE : TRUE;
    }
    
    public function valid_authorization($email, $password)
    {
        if (( ! $email) || ( ! $password)) return FALSE;
        
        $sql = "SELECT COUNT(*) AS `count` FROM `users` WHERE BINARY `email` = ? AND BINARY `password` = ? AND `activation` = 1";
        $query = $this->db->query($sql, array($email, $password));
        return ($query->row()->count == 0) ? FALSE : TRUE;
    }
    
    public function activation_status($email)
    {
        if (( ! $email)) return FALSE;
        
        $sql = "SELECT COUNT(*) AS `count` FROM `users` WHERE BINARY `email` = ? AND BINARY `activation` = 1";
        $query = $this->db->query($sql, array($email));
        return ($query->row()->count == 0) ? FALSE : TRUE;
    }

    public function allow_email($email)
    {   
        if (( ! $email)) return FALSE;
        
        $sql = "SELECT COUNT(*) AS `count` FROM `users` WHERE BINARY `email` = ?";
        $query = $this->db->query($sql, array($email));     
        return ($query->row()->count == 0) ? TRUE : FALSE;
    }
    
    public function change_username($email, $password, $new_name)
    {
        if (( ! $email) || ( ! $password)) return FALSE;
        
        $sql = "UPDATE `users` SET `username` = ? WHERE BINARY `email` = ? AND BINARY `password` = ? AND `activation` = 1";
        $query = $this->db->query($sql, array($new_name, $email, $password));
        return ($query) ? TRUE : FALSE;
    }
    
    public function change_password($email, $old_password, $new_password)
    {
        if (( ! $email) || ( ! $old_password)) return FALSE;
        
        $sql = "UPDATE `users` SET `password` = ? WHERE BINARY `email` = ? AND BINARY `password` = ? AND `activation` = 1";
        $query = $this->db->query($sql, array($new_password, $email, $old_password));
        return ($query) ? TRUE : FALSE;
    }

    public function add_user($username, $email, $password, $tmp)
    {   
        $sql = "INSERT INTO `users` (`username`, `email`, `password`, `tmp`, `date`) VALUES (?, ?, ?, ?, ?)";
        $query = $this->db->query($sql, array($username, $email, $password, $tmp, time()));
        return ($query) ? TRUE : FALSE;
    }
    
    public function activate_registration($email, $tmp)
    {
        if (( ! $email) || ( ! $tmp)) return FALSE;
        
        $sql = "UPDATE `users` SET `activation` = 1, `tmp` = 0 WHERE BINARY `email` = ? AND BINARY `tmp` = ? AND `activation` = 0";
        $query = $this->db->query($sql, array($email, $tmp));
        return ($query) ? TRUE : FALSE;
    }
    
    public function perform_forgot_password($email)
    {
        if (( ! $email)) return FALSE;
        
        $this->load->helper('string');
        $data = array(
            'generated_password' => random_string('alnum'),
            'tmp' => random_string('md5'),
            'forgot_date' => time(),
            'forgot_status' => 1,
            'email' => $email,
        );
        $sql = "UPDATE `users` SET `generated_password` = ?, `tmp` = ?, `forgot_date` = ?, `forgot_status` = ? WHERE BINARY `email` = ? AND `activation` = 1";
        $query = $this->db->query($sql, $data);
        if ($query) {
            return ($this->mail_forgot_password($email, $data['tmp'], $data['generated_password'])) ? TRUE : FALSE;
        }
        else return FALSE;
    }
    
    public function perform_change_email($email, $password, $new_email)
    {
        if (( ! $email) || ( ! $password)) return FALSE;
        
        $this->load->helper('string');
        $data = array(
            'tmp' => random_string('md5'),
            'new_email' => $new_email,
            'new_email_date' => time(),
            'new_email_status' => 1,
            'email' => $email,
            'password' => $password,
        );
        $sql = "UPDATE `users` SET `tmp` = ?, `new_email` = ?, `new_email_date` = ?, `new_email_status` = ? WHERE BINARY `email` = ? AND BINARY `password` = ? AND `activation` = 1";
        $query = $this->db->query($sql, $data);
        if ($query) {
            return ($this->mail_change_email($email, $new_email, $data['tmp'])) ? TRUE : FALSE;
        }
        else return FALSE;
    }

    public function activate_generated_password($email, $id)
    {
        if (( ! $email) || ( ! $id)) return FALSE;
        
        $sql = "SELECT `id`, `generated_password` FROM `users` WHERE BINARY `email` = ? AND BINARY `tmp` = ? AND `forgot_status` = 1";
        $query = $this->db->query($sql, array($email, $id));
        if ($query->num_rows() == 0) return FALSE;
        $new_password = $query->row()->generated_password;
        $field_id = $query->row()->id;
        $sql = "UPDATE `users` SET `password` = ?, `generated_password` = 0, `forgot_status` = 0 WHERE `id` = ?";
        $query = $this->db->query($sql, array(md5($new_password), $field_id));
        return ($query) ? TRUE : FALSE;
    }
    
    public function activate_new_email($email, $id)
    {
        if (( ! $email) || ( ! $id) || $this->allow_email($email)) return FALSE;
        
        $sql = "SELECT `id`, `new_email` FROM `users` WHERE BINARY `email` = ? AND BINARY `tmp` = ? AND `new_email_status` = 1";
        $query = $this->db->query($sql, array($email, $id));   
        if ($query->num_rows() == 0) return FALSE;
        else {
            $new_email = $query->row()->new_email;
            $field_id = $query->row()->id;
            $sql = "UPDATE `users` SET `email` = ?, `new_email` = 0, `new_email_status` = 0 WHERE `id` = ?";
            $query = $this->db->query($sql, array($new_email, $field_id));
            return ($query) ? TRUE : FALSE;
        } 
    }
    
    public function mail_registration($email, $id)
    {
        $link = $this->config->item('base_url').'user/registration/activate/?email='.$email.'&amp;id='.$id;
        $to = $email;
        $subject = 'Подтверждение регистрации на сайте dentexpres.com';
        $headers = 
            'MIME-Version: 1.0' . "\r\n" . 
            'Content-type: text/html; charset=utf-8' . "\r\n";
        $message = 'Для подтверждения регистрации перейдите по ссылке <a href="'.$link.'">'.$link.'</a> <br/>Ссылка действует в течении суток с момента регистрации.';

        return (@mail($to, $subject, $message, $headers)) ? TRUE : FALSE;
    }

    public function mail_ask_question($question, $sender_email, $sender_name)
    {
        $to = 'dentexpres@ya.ru';
        $subject = 'Вопрос пользователя на сайте dentexpres.com';
        $headers = 
            'MIME-Version: 1.0' . "\r\n" . 
            'Content-type: text/html; charset=utf-8' . "\r\n";
        $message = '<b>Ф.И.О. пользователя : </b>'.$sender_name.
                '<br/><b>e-mail адрес пользователя : </b>'.$sender_email.
                '<br/><b>вопрос пользователя :</b><br/>'.$question;

        return (@mail($to, $subject, $message, $headers)) ? TRUE : FALSE;
    }
    
    private function mail_forgot_password($email, $id, $password)
    {
        $link = $this->config->item('base_url').'user/authorization/activate_generated_password/?email='.$email.'&amp;id='.$id;
        $to = $email;
        $subject = 'Генерация нового пароля на сайте dentexpres.com';
        $headers = 
            'MIME-Version: 1.0' . "\r\n" . 
            'Content-type: text/html; charset=utf-8' . "\r\n";
        $message = 'Для подтверждения активации сгенерированного пароля перейдите по ссылке <a href="'.$link.'">'.$link.
                '</a><br>Новый <b>пароль : </b> '.$password.'<br/>Ссылка действует в течении суток с момента генерации пароля.';

        return (@mail($to, $subject, $message, $headers)) ? TRUE : FALSE;
    }
    
    private function mail_change_email($old_email, $new_email, $id)
    {
        $link = $this->config->item('base_url').'user/account/activate_new_email/?old_email='.$old_email.'&amp;id='.$id;
        $to = $new_email;
        $subject = 'Замена e-mail адреса пользователя на сайте dentexpres.com';
        $headers = 
            'MIME-Version: 1.0' . "\r\n" . 
            'Content-type: text/html; charset=utf-8' . "\r\n";
        $message = 'Для подтверждения замены e-mail адреса '.$old_email.' на '.$new_email.' перейдите по ссылке <a href="'.$link.'">'.$link.
                '</a><br/>Ссылка действует в течении суток с момента отправки запроса.';

        return (@mail($to, $subject, $message, $headers)) ? TRUE : FALSE;
    }
    
    private function clear_db() // удальнить пользователя, который не активировался в течении суток
    {
        $sql = "DELETE FROM `users` WHERE `date` < ? AND `activation` = 0";
        $this->db->query($sql, array(time()-60*60*24));
        
        $sql = "UPDATE `users` SET `forgot_status` = 0 WHERE `forgot_status` = 1 AND `forgot_date` < ?";
        $this->db->query($sql, array(time()-60*60*24));
        
        $sql = "UPDATE `users` SET `new_email_status` = 0 WHERE `new_email_status` = 1 AND `new_email_date` < ?";
        $this->db->query($sql, array(time()-60*60*24));
    }
    
}

?>
