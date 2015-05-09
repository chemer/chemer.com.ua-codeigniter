<div id="admin_box">
    <div id="uri"><?php echo $current_page['uri'];?></div>
    <div id="page_lang"><?php echo $this->page_lang;?></div>
    <a  id="logout" href="<?php echo $current_page['uri']; ?>/admin/logout"><img src="/images/logout.jpg"/></a>
    <div id="edit_head">
        <div style="color: gold;">
            <b>Recommendations: </b> 
            to avoid incompatibilities for editing the contents of the site are constantly using the same one browser.<br/>
            We recommend Google Chrome.
        </div>
        <h6>The metadata for search engines</h6>
        <div>Enter a title for this page to display its on the browser tab:</div>
        <div id="meta_title" contenteditable="true"><?php echo $current_page['meta_title']; ?></div>
        <div>Enter a list keywords  used on this page:</div>
        <div id="keywords" contenteditable="true"><?php echo $current_page['keywords']; ?></div>
        <div>Enter a short description of the contents for this page:</div>
        <div id="description" contenteditable="true"><?php echo $current_page['description']; ?></div>
    </div>
    <div class="button_box">
        <button id="upade_metadata">Update</button>
        <img class="admin_ajax_loader" src="/images/ajax_loader.gif"/>
        <div class="admin_errors message"></div>
        <div class="admin_success message"></div>
    </div>
    <div id="available_images_box">
        <h6>The images that are available for this page</h6>
        <div class="reload">
            If you want to paste an image on this page and it absent in the available list upload its first.
            <div class="warning"><b>WARNING: </b>save your changes before loading. If this page has unsaved changes all these will be lost.</div>
            <div id="upload_image">
                <form action="/request/upload_image" method="post" enctype="multipart/form-data">
                    <input name="sender" type="hidden" value="<?php echo $current_page['uri'].'/admin/?lang='.$this->page_lang; ?>">
                    <input name="upload_dir" type="hidden" value="<?php echo '/images'.$current_page['uri']; ?>">
                    <input name="userfile" type="file"/>
                    <button type="submit">Upload image</button>
                </form> 
            </div>
        </div>
        <div>To paste an image on this page double click (to deselect one click) on the picture that you would like to insert. After to do click in the target place for image and click button "Insert image".</div>
        <div>If you not using someone of the images on this page remove its to free up space on the server. To remove double click (to deselect one click) on the picture here and then click the button "Remove image"</div>
        <div class="warning"><b>WARNING: </b>to remove the image from the page contents first delete its using the editor and save changes only then here.</div>
        <div class="button_box">
            <button class="remove_image">Remove image</button>
            <img class="admin_ajax_loader" src="/images/ajax_loader.gif"/>
            <div class="admin_errors message"></div>
            <div class="admin_success message"></div>
        </div>
        <div id="available_images">
            <?php              
                foreach ($availables_images as $key => $value) {
                    $image_size = new_size_image($value['0'], 196, $value['1'], 148);                 
                    echo '<div class="available_image_box">';
                    echo '<div class="available_image"><img src="/images'.$current_page['uri'].'/'.$key.'" style="width:'.$image_size['width'].'px;height:'.$image_size['height'].'px;"/></div>';
                    echo '<div class="available_image_title">';
                    echo '<div class="available_image_filename">'.$key.'</div>';
                    echo '<div class="available_image_size">'.$value['0'].' &times; '.$value['1'].' pixels'.'</div>';
                    echo '</div></div>';
                }
            ?>
        </div>
    </div>
</div>
