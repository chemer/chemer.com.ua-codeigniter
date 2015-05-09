<div id="headerTop"></div>
<div id="header">
    <div id="hat">
        <?php if ($logged_in) { ?>
        <div id="user_menu">
            <a href="/user/account"><?php echo $this->session->userdata('username'); ?></a>
            <a href="/user/account/logout/?url=<?php echo $current_page['uri']; ?>">Выход</a>
        </div>
        <?php }else{ ?>
        <div id="user_menu">
            <span id="authorization">Вход</span>
            <a href="/user/registration">Регистрация</a>
        </div>
        <?php } ?>
        <div id="choice_lang">
            <a href="<?php echo $current_page['uri']; ?>"><img src="/images/flag_ru.jpg" id="active_flag"/></a>
            <a href="<?php echo $current_page['uri']; ?>/?lang=en"><img src="/images/flag_en.jpg"/></a>
        </div>
        <object id="logo" type="application/x-shockwave-flash" data="/images/logo.swf" width="288px" height="180px">
                <param name="movie" value="/images/logo.swf">
                <param name="wmode" value="transparent">
                <param name="play" value="true">
                <param name="quality" value="best">
                <param name="loop" value="false">
                <param name="menu" value="false">
                <img src="/images/logo.png"/>
        </object>
    </div>
</div>