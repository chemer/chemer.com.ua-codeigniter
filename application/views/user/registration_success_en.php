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
        <div id="success_title">Registration was successful.</div>
        <div id="success_text">
To activate the registration, follow the instructions in the letter that was sent to your e-mail address. <br/>
If you do not receive the email within a few minutes, please check in your spam e-mails.            
        </div>
        <div id="success_thanks">Thanks for signing up.</div>
    </body>
</html>
