<div id="central_block">
    <h1 id="active_title"><?php echo $current_page['active_title']; ?></h1>
    <div id="main_content_box">   
        <div id="main_content">
            <?php echo $current_page['main_content']; ?>
        </div>
        
        <div id="portfolio">    
            <div class="gallery">
                <div class="roll_box">
                    <img class="roll roll_left" src="/images/rollLeft.jpg"/>
                    <img class="roll pause_play play" src="/images/pause.jpg"/>
                    <img class="roll roll_right" src="/images/rollRight.jpg"/>
                </div>
<?php for ($i=0; $i < count($portfolio); $i++) { ?>
                <div class="gallery_item">
                    <a class="gallery_item_title" href="<?php echo $portfolio[$i]['item_link']; ?>" target="_blank">
                        <?php echo $portfolio[$i]['item_title_'.$this->page_lang]; ?>
                    </a>
                    <a class="gallery_item_image_box" href="<?php echo $portfolio[$i]['item_link']; ?>" target="_blank">
                        <img class="gallery_item_image" src="<?php echo $portfolio[$i]['image']; ?>"/>
                    </a>
                    <div class="gallery_item_description">
                        <?php echo $portfolio[$i]['item_description_'.$this->page_lang]; ?>
                    </div>
                </div>
<?php } ?>                 
            </div>           
        </div>
        
    </div>
</div>