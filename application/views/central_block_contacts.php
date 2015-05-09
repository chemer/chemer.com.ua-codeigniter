<div id="central_block">
    <h1 id="active_title"><?php echo $current_page['active_title']; ?></h1>
    <div id="main_content_box">    
        <div id="contactsBox">
<?php for ($i=0; $i < count($contacts); $i++) { ?>
            <div class="contact_box">
                <div class="contactsName"><?php echo $contacts[$i]['name_'.$this->page_lang]; ?></div>
                <div class="contactsGroup">	
                    <div class="contactsImg"><img src="/images/telefon.jpg"/></div>
                    <div class="contact_data"><?php echo $contacts[$i]['phone']; ?></div>
                </div>
                <div class="contactsGroup">
                    <div class="contactsImg"><img src="/images/skypeLogo.jpg"/></div>
                    <div class="contact_data"><?php echo $contacts[$i]['skype']; ?></div>
                </div>
                <div class="contactsGroup">	
                    <div class="contactsImg"><img src="/images/email.jpg"/></div>
                    <div class="contact_data"><?php echo $contacts[$i]['email']; ?></div>
                </div>
            </div>
<?php } ?>
        </div>
        <div id="main_content" style="margin-left: 245px;">
            <?php echo $current_page['main_content']; ?>
        </div>
        
    </div>
</div>