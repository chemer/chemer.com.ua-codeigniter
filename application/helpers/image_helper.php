<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('new_size_image'))
{
    function new_size_image($width, $max_width, $height, $max_height)
    {
        if ($width > $max_width) {
            $new_height = $height*($max_width/$width);
            $new_width = $max_width;
            if ($new_height > $max_height) {
                $new_width = $new_width*($max_height/$new_height);
                $new_height = $max_height;
            }
        }
        elseif ($height > $max_height) {
            $new_width = $width*($max_height/$height);
            $new_height = $max_height;
        }
        else {
            $new_width = $width;
            $new_height = $height;
        }
        return array('width' => (int) $new_width, 'height' => (int) $new_height);
    }
}

if ( ! function_exists('availables_images'))
{
    function availables_images($source_dir)
    {
        $images = array();
        $fp = @opendir($source_dir);
        if ($fp) {
            $source_dir = rtrim(realpath($source_dir), DIRECTORY_SEPARATOR).DIRECTORY_SEPARATOR;
            while ( ($file = readdir($fp)) !== FALSE) {
                if ( ! @is_dir($source_dir.$file)) {
                    $extension = pathinfo($source_dir.$file, PATHINFO_EXTENSION);
                    switch ($extension) {
                        case 'jpg' :
                            $images = array_merge($images, array($file => getimagesize($source_dir.$file)));
                            break;
                        case 'png' :
                            $images = array_merge($images, array($file => getimagesize($source_dir.$file)));
                            break;
                        case 'gif' :
                            $images = array_merge($images, array($file => getimagesize($source_dir.$file)));
                            break;
                        default : 
                            break;
                    }
                }
            }
            return $images;
        }
        else {
            return FALSE;
        }
    }
}
/* End of file image_helper.php */
/* Location: ./aplication/helpers/image_helper.php */