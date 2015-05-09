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
        <div id="contactsBox">
            <div class="reload">
                <div class="warning">
                    <b>WARNING: </b>save your changes before clicking "Add contact". If this page has unsaved changes all these will be lost.
                </div>
                <div>
                    <button class="add_contact">Add contact</button>
                    <img class="admin_ajax_loader" src="/images/ajax_loader.gif"/>
                    <div class="admin_errors message"></div>
                    <div class="admin_success message"></div>
                </div>
            </div>
<?php for ($i=0; $i < count($contacts); $i++) { ?>
            <div class="contact_box" style="border:1px #999999 solid; margin-bottom:5px;">
                <div class="contact_id" style="display:none;"><?php echo $contacts[$i]['id']; ?></div>
                <div class="contactsName" contenteditable="true"><?php echo $contacts[$i]['name_'.$this->page_lang]; ?></div>
                <div class="contactsGroup phone">	
                    <div class="contactsImg"><img src="/images/telefon.jpg"/></div>
                    <div class="contact_data" contenteditable="true"><?php echo $contacts[$i]['phone']; ?></div>
                </div>
                <div class="contactsGroup skype">
                    <div class="contactsImg"><img src="/images/skypeLogo.jpg"/></div>
                    <div class="contact_data" contenteditable="true"><?php echo $contacts[$i]['skype']; ?></div>
                </div>
                <div class="contactsGroup email">	
                    <div class="contactsImg"><img src="/images/email.jpg"/></div>
                    <div class="contact_data" contenteditable="true"><?php echo $contacts[$i]['email']; ?></div>
                </div>
                <div>
                    <button class="save_contact">Save contact</button>
                    <img class="admin_ajax_loader" src="/images/ajax_loader_1.gif"/>
                    <div class="admin_errors message"></div>
                    <div class="admin_success message"></div>
                </div>
                <div>
                    <button class="remove_contact">Remove contact</button>
                    <img class="admin_ajax_loader" src="/images/ajax_loader_1.gif"/>
                    <div class="admin_errors message"></div>
                    <div class="admin_success message"></div>
                </div>
            </div>
<?php } ?>
        </div>
        <div id="main_content" style="margin-left: 245px;">
            <?php $editor->addToolbar(); ?>
            <div id="edited_main_content">
                <?php echo $current_page['main_content']; ?>
            </div>
            <div class="button_box">
                <button id="update_main_content">Update</button>
                <img class="admin_ajax_loader" src="/images/ajax_loader_1.gif"/>
                <div class="admin_errors message"></div>
                <div class="admin_success message"></div>
            </div>
        </div>
        
    </div>
</div>