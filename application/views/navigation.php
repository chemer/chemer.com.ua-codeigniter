<div id="novigatorBox">
    <div id="novigator">
        <div id="menu"><!--
<?php
for ($i=0; $i < count($main_menu); $i++) {
    if ($this->page_lang == 'ru') {
?>
            --><div class="<?php echo ($main_menu[$i]['uri'] == $current_page['uri']) ? 'menuItem menuItemSelected' : 'menuItem'; ?>">
                <a href="<?php echo $main_menu[$i]['uri']; ?>"><?php echo $main_menu[$i]['title']; ?></a>
            </div><!--
<?php
    } else {
?>
            --><div class="<?php echo ($main_menu[$i]['uri'] == $current_page['uri']) ? 'menuItem menuItemSelected' : 'menuItem'; ?>">
                <a href="<?php echo $main_menu[$i]['uri'].'/?lang='.$this->page_lang; ?>"><?php echo $main_menu[$i]['title']; ?></a>
            </div><!--
<?php
    }
}
?>
            
        --></div>
    </div>
</div>