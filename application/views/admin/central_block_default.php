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
    </div>
</div>