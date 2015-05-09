<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html;charset=utf-8"/>
        <title>User registration</title>
        <link rel="stylesheet" type="text/css" href="/css/registration.css"/>
    </head>
    <body>
        <div id="menu_box">
            <?php for ($i=0; $i < count($main_menu); $i++) { ?>
            <a href="<?php echo $main_menu[$i]['uri']; ?>/?lang=en">
                <span><?php echo $main_menu[$i]['title']; ?></span>
            </a>
            <?php } ?>
        </div>
        <div id="page_title">USER REGISTRATION</div>
        <div class="notice"><b>Attention: </b>all fields are required.</div>
        
        <div class="form_box">
            <div class="valid_errors">
                <?php echo validation_errors(); ?>
            </div>
            <form action="/user/registration/?lang=<?php echo $this->page_lang; ?>" enctype="application/x-www-form-urlencoded" method="post">
                <div class="input_box">
                    <div class="input_title">user name :</div>
                    <input name="username" type="text" value="<?php echo set_value('username'); ?>"/>
                </div>
                <div class="input_box">
                    <div class="input_title">e-mail address :</div>
                    <input name="email" type="text" value="<?php echo set_value('email'); ?>"/>
                </div>
                <div class="input_box">
                    <div class="input_title">password :</div>
                    <input name="password" type="password" value="<?php echo set_value('password'); ?>"/>
                </div>
                <div class="input_box">
                    <div class="input_title">confirm  password :</div>
                    <input name="confirm_password" type="password" value="<?php echo set_value('confirm_password'); ?>"/>
                </div>
                <div id="captcha"><?php echo $captcha_img;?></div>
                <div class="input_box">
                    <div class="input_title">enter the characters from the image:</div>
                    <input name="captcha" type="text"/>
                </div>
                <div class="input_box">
                    <button class="send" type="submit">Send</button>
                </div>
            </form>
        </div>
        <div class="note">
            <b>Note: </b>The activation email will be sent to the specified email address. Follow the instructions in the email to activate registration.
        </div>
    </body>
</html>