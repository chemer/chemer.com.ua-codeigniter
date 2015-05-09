<?php

class MY_Controller extends CI_Controller
{
    public $page_lang = NULL;
    
    public function __construct() {
        parent::__construct();
        
        $this->set_page_lang();
    }
    
    private function set_page_lang()
    {
        if (isset($_GET['lang']) && ($_GET['lang'] == 'ru' || $_GET['lang'] == 'en')) {
            $this->config->set_item('language', $_GET['lang']);
            $this->page_lang = $_GET['lang'];
        }
        elseif (isset($_POST['lang']) && ($_POST['lang'] == 'ru' || $_POST['lang'] == 'en')) {
            $this->config->set_item('language', $_POST['lang']);
            $this->page_lang = $_POST['lang'];
        }
        else $this->page_lang = $this->config->item('language');
    }
}

?>