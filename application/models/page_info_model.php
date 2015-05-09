<?php

class Page_info_model extends CI_Model
{    
    
    public function get_data_current_page($url)
    {
        $table = $this->current_page_table($url);
        
        if ( ! $table) return FALSE;
        
        $this->load->database();
        $sql = "SELECT * FROM `$table` WHERE `uri`='$url'";
        $query = $this->db->query($sql);
        return ($query) ? $query->row_array() : FALSE;
    }

    public function get_data_main_menu()
    {
        $table = 'default_page_'.$this->page_lang;
        
        $this->load->database();
        $sql = "SELECT `uri`,`title` FROM `$table` ORDER BY `id`";
        $query = $this->db->query($sql);
        return ($query) ? $query->result_array() : FALSE;
    }
    
    public function get_data_portfolio()
    {        
        $this->load->database();
        $sql = "SELECT * FROM `portfolio` ORDER BY `item_id` DESC";
        $query = $this->db->query($sql);
        return ($query) ? $query->result_array() : FALSE;
    }
    
    public function get_data_contacts()
    {
        $this->load->database();
        $sql = "SELECT * FROM `contacts`";
        $query = $this->db->query($sql);
        return ($query) ? $query->result_array() : FALSE;
    }

    private function current_page_table($uri)
    {
        $db_uri = array(
            'default_page' => array(
                '/home',
                '/portfolio',
                '/contacts',
            ),
        );
        
        if (in_array($uri, $db_uri['default_page']) ) return 'default_page_'.$this->page_lang;
        else return FALSE;
    }
    
//    public function get_data_photo_gallery($url)
//    {
//        if (! $url) return FALSE; 
//        
//        $lang = $this->page_lang;
//        $groups_array = array(); 
//        $group_description = 'group_description_'.$lang;
//        $image_description = 'image_description_'.$lang;
//        
//        $this->load->database();
//        $sql = "SELECT `group_id`, `$group_description` FROM `gallery_group` WHERE `page_uri` = '$url' ORDER BY `group_id` DESC";
//        $query = $this->db->query($sql);
//        if ($query->num_rows() == 0) return $groups_array;
//        else {
//            $groups = $query->result();          
//            foreach ($groups as $value) {
//                $sql = "SELECT `image_id`, `small_image`, `big_image`, `$image_description` FROM `photo_gallery` WHERE `group_id` = ?  ORDER BY `image_id` DESC";
//                $query = $this->db->query($sql, array($value->group_id));
//                $images = $query->result_array();
//                $result = array(
//                    $value->group_id => array(
//                        'group_description' => $value->$group_description,
//                        'group_images' => $images,
//                    ),
//                );
//                $groups_array = $groups_array + $result;
//            }
//        }
//        return $groups_array;
//    }
//    
//    public function get_data_video_gallery($url)
//    {
//        if (! $url) return FALSE;
//        
//        $lang = $this->page_lang;
//        $groups_array = array(); 
//        $group_description = 'group_description_'.$lang;
//        
//        $this->load->database();
//        $sql = "SELECT `group_id`, `$group_description` FROM `gallery_group` WHERE `page_uri` = '$url' ORDER BY `group_id` DESC";
//        $query = $this->db->query($sql);
//        if ($query->num_rows() == 0) return $groups_array;
//        else {
//            $groups = $query->result();          
//            foreach ($groups as $value) {
//                $sql = "SELECT `video_id`, `code_video` FROM `video_gallery` WHERE `group_id` = ?  ORDER BY `video_id` DESC";
//                $query = $this->db->query($sql, array($value->group_id));
//                $movies = $query->result_array();
//                $result = array(
//                    $value->group_id => array(
//                        'group_description' => $value->$group_description,
//                        'group_movies' => $movies,
//                    ),
//                );
//                $groups_array = $groups_array + $result;
//            }
//        }
//        return $groups_array;
//    }
    
}

?>