<?php

class Admin_model extends CI_Model
{   
    private $answer = array(
        'success' => array(
            'error' => FALSE,
            'message' => 'success',
        ),
        'error' => array(
            'error' => TRUE,
            'message' => 'error',
        ),
        'no_param' => array(
            'error' => TRUE,
            'message' => 'no required parameters',
        ),
        'table_error' => array(
            'error' => TRUE,
            'message' => 'not defined database table for update',
        ),
    );
    
    public function verify_admin_user($username, $password)
    {
        if (( ! $username) || ( ! $password)) return FALSE;
        else {
            $this->load->database();
            $sql = "SELECT `login`, `password` FROM `admin_users` WHERE BINARY `login` = ? AND BINARY `password` = ?";
            $query = $this->db->query($sql, array($username, md5($password)));
            return ($query->num_rows() == 1) ? TRUE : FALSE;
        }
    }
    
    public function update_metadata()
    {
        if ( ! isset($_POST['meta_title'], $_POST['keywords'], $_POST['description'], $_POST['current_uri'], $_POST['lang']) || ( ! $_POST['current_uri'])) {
            echo json_encode($this->answer['no_param']);
                exit;
        }
        
        $table = $this->current_page_table($_POST['current_uri']);
        
        if ( ! $table) {
            echo json_encode($this->answer['table_error']);
                exit;
        }
        
        $table = $table.'_'.$_POST['lang'];
        $meta_title = htmlspecialchars($_POST['meta_title'], ENT_QUOTES);
        $keywords = htmlspecialchars($_POST['keywords'], ENT_QUOTES);
        $description = htmlspecialchars($_POST['description'], ENT_QUOTES);
        
        $this->load->database();
        $sql = "UPDATE `$table` SET `meta_title` = ?, `keywords` = ?, `description` = ? WHERE `uri` = ?";
        $query = $this->db->query($sql, array($meta_title, $keywords, $description, $_POST['current_uri']));
        
        echo ($query) ? json_encode($this->answer['success']) : json_encode($this->answer['error']);
    }
    
    public function update_active_title()
    {
        if ( ! isset($_POST['active_title'], $_POST['current_uri'], $_POST['lang']) || ( ! $_POST['current_uri'])) {
            echo json_encode($this->answer['no_param']);
                exit;
        }
        
        $table = $this->current_page_table($_POST['current_uri']);
        
        if ( ! $table) {
            echo json_encode($this->answer['table_error']);
                exit;
        }
        
        $table = $table.'_'.$_POST['lang'];
        
        $this->load->database();
        $sql = "UPDATE `$table` SET `active_title` = ? WHERE `uri` = ?";
        $query = $this->db->query($sql, array($_POST['active_title'], $_POST['current_uri']));
        
        echo ($query) ? json_encode($this->answer['success']) : json_encode($this->answer['error']);
    }
    
    public function update_main_content()
    {
        if ( ! isset($_POST['main_content'], $_POST['current_uri'], $_POST['lang']) || ( ! $_POST['current_uri'])) {
            echo json_encode($this->answer['no_param']);
                exit;
        }
        
        $table = $this->current_page_table($_POST['current_uri']);
        
        if ( ! $table) {
            echo json_encode($this->answer['table_error']);
                exit;
        }
        
        $table = $table.'_'.$_POST['lang'];
        
        $this->load->database();
        $sql = "UPDATE `$table` SET `main_content` = ? WHERE `uri` = ?";
        $query = $this->db->query($sql, array($_POST['main_content'], $_POST['current_uri'])); 
        
        echo ($query) ? json_encode($this->answer['success']) : json_encode($this->answer['error']);
    }
    
    public function update_bottom_content()
    {
        if ( ! isset($_POST['bottom_content'], $_POST['current_uri'], $_POST['lang']) || ( ! $_POST['current_uri'])) {
            echo json_encode($this->answer['no_param']);
                exit;
        }
        
        $table = $this->current_page_table($_POST['current_uri']);
        
        if ( ! $table) {
            echo json_encode($this->answer['table_error']);
                exit;
        }
        
        $table = $table.'_'.$_POST['lang'];
        
        $this->load->database();
        $sql = "UPDATE `$table` SET `bottom_content` = ? WHERE `uri` = ?";
        $query = $this->db->query($sql, array($_POST['bottom_content'], $_POST['current_uri']));
        
        echo ($query) ? json_encode($this->answer['success']) : json_encode($this->answer['error']);
    }
    
    
    
    public function add_portfolio_item()
    {
        $this->load->database();
        $sql = "INSERT INTO `portfolio` (`item_id`) VALUES (NULL);";
        $query = $this->db->query($sql);
        
        echo ($query) ? json_encode($this->answer['success']) : json_encode($this->answer['error']);
    }
    
    public function save_portfolio_item()
    {
        if ( ! isset($_POST['item_id'], $_POST['image'], $_POST['item_link'], $_POST['item_title'], $_POST['item_description'], $_POST['lang']) || ( ! $_POST['item_id'])) {
            echo json_encode($this->answer['no_param']);
                exit;
        }

        $item_title = 'item_title_'.$_POST['lang'];
        $item_description = 'item_description_'.$_POST['lang'];
        
        $this->load->database();
        $sql = "UPDATE `portfolio` SET `image` = ?, `item_link` = ?, `$item_title` = ?, `$item_description` = ? WHERE `item_id` = ?";
        $query = $this->db->query($sql, array($_POST['image'], $_POST['item_link'], $_POST['item_title'], $_POST['item_description'], $_POST['item_id']));
        
        echo ($query) ? json_encode($this->answer['success']) : json_encode($this->answer['error']);
    }
    
    public function remove_portfolio_item()
    {
        if ( ! isset($_POST['item_id']) || ( ! $_POST['item_id'])) {          
            echo json_encode($this->answer['no_param']);
                exit;
        }
        
        $this->load->database();
        $sql = "DELETE FROM `portfolio` WHERE `item_id` = ?";
        $query = $this->db->query($sql, array($_POST['item_id']));
        
        echo ($query) ? json_encode($this->answer['success']) : json_encode($this->answer['error']);
    }
    
    public function add_contact()
    {
        $this->load->database();
        $sql = "INSERT INTO `contacts` (`id`) VALUES (NULL);";
        $query = $this->db->query($sql);
        
        echo ($query) ? json_encode($this->answer['success']) : json_encode($this->answer['error']);
    }
    
    public function save_contact()
    {
        if ( ! isset($_POST['contact_id'], $_POST['lang'], $_POST['name'], $_POST['skype'], $_POST['phone'], $_POST['email']) || ( ! $_POST['contact_id'])) {          
            echo json_encode($this->answer['no_param']);
                exit;
        }
        
        $name = 'name_'.$_POST['lang'];

        $this->load->database();
        $sql = "UPDATE `contacts` SET `$name` = ?, `phone` = ?, `skype` = ?, `email` = ? WHERE `id` = ?";
        $query = $this->db->query($sql, array($_POST['name'], $_POST['phone'], $_POST['skype'], $_POST['email'], $_POST['contact_id']));
        
        echo ($query) ? json_encode($this->answer['success']) : json_encode($this->answer['error']);
    }
    
    public function remove_contact()
    {
        if ( ! isset($_POST['contact_id']) || ( ! $_POST['contact_id'])) {          
            echo json_encode($this->answer['no_param']);
                exit;
        }
        
        $this->load->database();
        $sql = "DELETE FROM `contacts` WHERE `id` = ?";
        $query = $this->db->query($sql, array($_POST['contact_id']));
        
        echo ($query) ? json_encode($this->answer['success']) : json_encode($this->answer['error']);
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
        
        if (in_array($uri, $db_uri['default_page']) ) return 'default_page';
        else return FALSE;
    }
    
    
//    public function create_group()
//    {
//        if ( ! isset($_POST['current_uri']) || ( ! $_POST['current_uri'])) {
//            $answer = array(
//                'error' => TRUE,
//                'message' => 'no required parameters',
//            );
//            echo json_encode($answer);
//                exit;
//        }
//        
//        $table = $this->current_page_table($_POST['current_uri']);
//        
//        if ( ! $table) {
//            $answer = array(
//                'error' => TRUE,
//                'message' => 'not defined database table for update',
//            );
//            echo json_encode($answer);
//                exit;
//        }
//        
//        $this->load->database();
//        $sql = "INSERT INTO `gallery_group` (`page_uri`) VALUES (?)";
//        $query = $this->db->query($sql, array($_POST['current_uri']));
//        if ($query) {
//            $answer = array(
//                'error' => FALSE,
//                'message' => 'success create group',
//            );
//        }
//        else {
//            $answer = array(
//                'error' => TRUE,
//                'message' => 'error create group',
//            );
//        }
//            echo json_encode($answer);
//    }
//    
//    public function add_image_group()
//    {
//        if ( ! isset($_POST['group_id']) || ( ! $_POST['group_id'])) {
//            $answer = array(
//                'error' => TRUE,
//                'message' => 'no required parameters',
//            );
//            echo json_encode($answer);
//                exit;
//        }
//        
//        $this->load->database();
//        $sql = "INSERT INTO `photo_gallery` (`group_id`) VALUES (?)";
//        $query = $this->db->query($sql, array($_POST['group_id']));
//        if ($query) {
//            $answer = array(
//                'error' => FALSE,
//                'message' => 'success add image group',
//            );
//        }
//        else {
//            $answer = array(
//                'error' => TRUE,
//                'message' => 'error add image group',
//            );
//        }
//            echo json_encode($answer);
//    }
//    
//    public function remove_group()
//    {       
//        if ( ! isset($_POST['current_uri'], $_POST['group_id']) || ( ! $_POST['group_id'])) {          
//            $answer = array(
//                'error' => TRUE,
//                'message' => 'no required parameters',
//            );
//            echo json_encode($answer);
//                exit;
//        }
//        $table = FALSE;
//        if ($_POST['current_uri'] == '/gallery/photo') $table = 'photo_gallery';
//        if ($_POST['current_uri'] == '/gallery/video') $table = 'video_gallery';
//        if ( ! $table) {
//            $answer = array(
//                'error' => TRUE,
//                'message' => 'is absent gallery table\'s in database for this page',
//            );
//            echo json_encode($answer);
//                exit;
//        }
//        
//        $this->load->database();
//        $sql = "DELETE FROM `gallery_group` WHERE `group_id` = ?";
//        $query1 = $this->db->query($sql, array($_POST['group_id']));
//        $sql = "DELETE FROM `$table` WHERE `group_id` = ?";
//        $query2 = $this->db->query($sql, array($_POST['group_id']));
//        if ($query1 && $query2) {
//            $answer = array(
//                'error' => FALSE,
//                'message' => 'success remove group',
//            );
//        }
//        else {
//            $answer = array(
//                'error' => TRUE,
//                'message' => 'error remove group',
//            );
//        }
//            echo json_encode($answer);
//    }
//    
//    public function update_group_description()
//    {
//        if ( ! isset($_POST['group_description'], $_POST['group_id'], $_POST['lang']) || ( ! $_POST['group_id'])) {          
//            $answer = array(
//                'error' => TRUE,
//                'message' => 'no required parameters',
//            );
//            echo json_encode($answer);
//                exit;
//        }
//        
//        $group_description = 'group_description_'.$_POST['lang'];
//        
//        $this->load->database();
//        $sql = "UPDATE `gallery_group` SET `$group_description` = ? WHERE `group_id` = ?";
//        $query = $this->db->query($sql, array($_POST['group_description'], $_POST['group_id']));
//        if ($query) {
//            $answer = array(
//                'error' => FALSE,
//                'message' => 'success update group description',
//            );
//        }
//        else {
//            $answer = array(
//                'error' => TRUE,
//                'message' => 'error update group description',
//            );
//        }
//            echo json_encode($answer);
//    }
//
//    public function save_image_group()
//    {
//        if ( ! isset($_POST['image_id'], $_POST['small_image'], $_POST['big_image'], $_POST['image_description'], $_POST['lang']) || ( ! $_POST['image_id'])) {          
//            $answer = array(
//                'error' => TRUE,
//                'message' => 'no required parameters',
//            );
//            echo json_encode($answer);
//                exit;
//        }
//        
//        $image_description = 'image_description_'.$_POST['lang'];
//        
//        $this->load->database();
//        $sql = "UPDATE `photo_gallery` SET `small_image` = ?, `big_image` = ?, `$image_description` = ? WHERE `image_id` = ?";
//        $query = $this->db->query($sql, array($_POST['small_image'], $_POST['big_image'], $_POST['image_description'], $_POST['image_id']));
//        if ($query) {
//            $answer = array(
//                'error' => FALSE,
//                'message' => 'success save image group',
//            );
//        }
//        else {
//            $answer = array(
//                'error' => TRUE,
//                'message' => 'error save image group',
//            );
//        }
//            echo json_encode($answer);
//    }
//    
//    public function remove_image_group()
//    {
//        if ( ! isset($_POST['image_id']) || ( ! $_POST['image_id'])) {          
//            $answer = array(
//                'error' => TRUE,
//                'message' => 'no required parameters',
//            );
//            echo json_encode($answer);
//                exit;
//        }
//        
//        $this->load->database();
//        $sql = "DELETE FROM `photo_gallery` WHERE `image_id` = ?";
//        $query = $this->db->query($sql, array($_POST['image_id']));
//        if ($query) {
//            $answer = array(
//                'error' => FALSE,
//                'message' => 'success remove image group',
//            );
//        }
//        else {
//            $answer = array(
//                'error' => TRUE,
//                'message' => 'error remove image group',
//            );
//        }
//            echo json_encode($answer);
//    }
//    
//    public function add_video()
//    {
//        if ( ! isset($_POST['group_id'], $_POST['code_video']) || ($_POST['code_video'] == '')) {          
//            $answer = array(
//                'error' => TRUE,
//                'message' => 'no required parameters',
//            );
//            echo json_encode($answer);
//                exit;
//        }
//        
//        $this->load->database();
//        $sql = "INSERT INTO `video_gallery` (`group_id`, `code_video`) VALUES (?,?)";
//        $query = $this->db->query($sql, array($_POST['group_id'], $_POST['code_video']));
//        if ($query) {
//            $answer = array(
//                'error' => FALSE,
//                'message' => 'success add video',
//            );
//        }
//        else {
//            $answer = array(
//                'error' => TRUE,
//                'message' => 'error add video',
//            );
//        }
//            echo json_encode($answer);
//    }
//    
//    public function remove_video()
//    {
//        if ( ! isset($_POST['video_id']) || ( ! $_POST['video_id'])) {          
//            $answer = array(
//                'error' => TRUE,
//                'message' => 'no required parameters',
//            );
//            echo json_encode($answer);
//                exit;
//        }
//        
//        $this->load->database();
//        $sql = "DELETE FROM `video_gallery` WHERE `video_id` = ?";
//        $query = $this->db->query($sql, array($_POST['video_id']));
//        if ($query) {
//            $answer = array(
//                'error' => FALSE,
//                'message' => 'success remove video',
//            );
//        }
//        else {
//            $answer = array(
//                'error' => TRUE,
//                'message' => 'error remove video',
//            );
//        }
//            echo json_encode($answer);
//    }
    
}

?>