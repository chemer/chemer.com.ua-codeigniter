<?php

class Captcha extends CI_Model
{
    private $captcha = array(); // array('word' => $word, 'time' => $now, 'image' => $img);
    
    private $captcha_data = array(
        'img_path' => './images/captcha/',
        'img_url' => '/images/captcha/',
        'img_width' => 154,
        'img_height' => 34,
        'expiration' => 300,
    );

    public function get_captcha()
    {
        return $this->captcha;
    }
    
    public function set_captcha()
    {
        $this->load->helper('captcha');
        $this->load->database();        
        $captcha = create_captcha($this->captcha_data);
              
        $data = array(
            'captcha_time' => $captcha['time'],
            'ip_address' => $this->input->ip_address(),
            'word' => $captcha['word'],
        );      
        $sql = "INSERT INTO `captcha` (`captcha_time`, `ip_address`, `word`) VALUES (?, ?, ?)";
        $this->db->query($sql, $data);
        
        $this->captcha = $captcha;
    }
    
    public function verify_captcha($word)
    {   
        $this->load->database();
    // удалить старую капчу
        $expiration = time()-3600;
        $this->db->query("DELETE FROM `captcha` WHERE `captcha_time` < ".$expiration);        
    // проверить существование капчи
        if ( ! $word) return FALSE;
        
        $sql = "SELECT COUNT(*) AS `count` FROM `captcha` WHERE `captcha_time` > ? AND `ip_address` = ? AND `word` = ?";
        $data = array(
            'captcha_time' => $expiration,
            'ip_address' => $this->input->ip_address(),
            'word' => $word,
        );
        $query = $this->db->query($sql, $data);  
        return $query->row()->count == 0 ? FALSE : TRUE;
    }
    
}

?>
