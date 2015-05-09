<div id="central_block">
    <h1 id="active_title">
        <div id="edited_active_title" contenteditable="true">
            <?php echo $current_page['active_title'];?>
        </div>
        <div class="button_box">
            <button id="update_active_title">Update</button>
            <img class="admin_ajax_loader" src="/images/ajax_loader.gif"/>
            <div class="admin_errors message"></div>
            <div class="admin_success message"></div>
        </div>
    </h1>
    <div id="main_content_box">
        <div id="main_content">
            <?php $editor->addToolbar();?>
            <div id="edited_main_content">
                <?php echo $current_page['main_content'];?>
            </div>
            <div class="button_box">
                <button id="update_main_content">Update</button>
                <img class="admin_ajax_loader" src="/images/ajax_loader_1.gif"/>
                <div class="admin_errors message"></div>
                <div class="admin_success message"></div>
            </div>
        </div>
        
        <div id="portfolio">    
                
        <!-- START: block for editing portfolio. -->

            <div id="edit_portfolio">
                <h6>This block for editing your portfolio.</h6>
                <div class="reload">
                    To add the portfolio element click "Add portfolio item". After this you can editing this element.
                    <div class="warning">
                        <b>WARNING: </b>save your changes before clicking "Add item". If this page has unsaved changes all these will be lost.
                    </div>
                    <div>
                        <button class="add_portfolio_item">Add portfolio item</button>
                        <img class="admin_ajax_loader" src="/images/ajax_loader.gif"/>
                        <div class="admin_errors message"></div>
                        <div class="admin_success message"></div>
                    </div>
                </div>
<?php 
    for ($i=0; $i < count($portfolio); $i++) {
        $image_size = getimagesize('.'.$portfolio[$i]['image']);
?>
                <div class="portfolio_item">
                    <div class="item_id"><?php echo $portfolio[$i]['item_id']; ?></div>
                    <div class="portfolio_item_image">
                        <img src="<?php echo $portfolio[$i]['image']; ?>"/>
                        <div class="note_size">Recommended values ​​for the size image: 380 &times; 300 pixels.</div>
                        <div class="image_filename"><?php echo basename($portfolio[$i]['image']); ?></div>
                        <div class="image_size"><?php echo $image_size['0'].' &times; '.$image_size['1'].' pixels'; ?></div>
                        <div style="clear: both;">
                            <button class="insert_portfolio_image">Insert image</button>
                            <div class="admin_errors message"></div>
                        </div>
                    </div>
                    <div>Enter a reference for the element portfolio:</div>
                    <div class="portfolio_item_link" contenteditable="true"><?php echo $portfolio[$i]['item_link']; ?></div>
                    <div>Enter a title for the element portfolio:</div>
                    <div class="portfolio_item_title" contenteditable="true"><?php echo $portfolio[$i]['item_title_'.$this->page_lang]; ?></div>
                    <div>Enter a description for the element portfolio:</div>
                    <div class="portfolio_item_description" contenteditable="true"><?php echo $portfolio[$i]['item_description_'.$this->page_lang]; ?></div>
                    <div>
                        <button class="save_portfolio_item">Save item</button>
                        <img class="admin_ajax_loader" src="/images/ajax_loader.gif"/>
                        <div class="admin_errors message"></div>
                        <div class="admin_success message"></div>
                    </div>
                    <div>To removing this item portfolio click "Remove item".</div>
                    <div>
                        <button class="remove_portfolio_item">Remove item</button>
                        <img class="admin_ajax_loader" src="/images/ajax_loader.gif"/>
                        <div class="admin_errors message"></div>
                        <div class="admin_success message"></div>
                    </div>
                </div>
<?php } ?> 
            </div>

        <!-- END: block for editing portfolio. -->
         
        </div>
        
    </div>
</div>