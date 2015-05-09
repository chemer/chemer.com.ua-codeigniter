<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html;charset=utf-8"/>
        <title>User account</title>
        <link rel="stylesheet" type="text/css" href="/css/account.css"/>
        <script type="text/javascript" src="/js/jquery.js"></script>
        <script type="text/javascript" src="/js/default.js"></script>
        <script type="text/javascript" src="/js/account.js"></script>
    </head>
    <body>
        <div id="menu_box">
            <?php for ($i=0; $i < count($main_menu); $i++) { ?>
            <a href="<?php echo $main_menu[$i]['uri'].'/?lang=en'; ?>">
                <span><?php echo $main_menu[$i]['title']; ?></span>
            </a>
            <?php } ?>
            <a id="logout" href="/user/account/logout/?lang=en">Log out</a>
        </div>
        
        <div id="page_title">USER ACCOUNT</div>
        
        <div class="notice"><b>Attention: </b> only one field can be changed at once.</div>
        
        <div class="field">
            <div class="field_name">User name :</div>
            <div class="content_field" id="username"><?php echo $user['username']; ?></div>
        </div>
        <div class="form_box">
            <form id="change_username" action="/user/account/change_username" enctype="application/x-www-form-urlencoded" method="post">
                <img class="ajax_loader" src="/images/ajax_loader_1.gif"/>
                <div class="valid_errors message"></div>
                <div class="valid_success message"></div>
                <div class="input_box">
                    <div class="input_title">New user name :</div>
                    <input name="username" type="text"/>
                </div>
                <div class="input_box">
                    <div class="input_title">Password :</div>
                    <input name="password" type="password"/>
                </div>
                <div class="input_box">
                    <button class="send" type="submit">Apply</button>
                </div>
            </form>
        </div>
        
        <div class="field">
            <div class="field_name">Password :</div>
            <div class="content_field">********</div>
        </div>
        <div class="form_box">
            <form id="change_password" action="/user/account/change_password" enctype="application/x-www-form-urlencoded" method="post">
                <img class="ajax_loader" src="/images/ajax_loader_1.gif"/>
                <div class="valid_errors message"></div>
                <div class="valid_success message"></div>
                <div class="input_box">
                    <div class="input_title">Password :</div>
                    <input name="password" type="password"/>
                </div>
                <div class="input_box">
                    <div class="input_title">New password :</div>
                    <input name="new_password" type="password"/>
                </div>
                <div class="input_box">
                    <div class="input_title">Confirm password :</div>
                    <input name="confirm_password" type="password"/>
                </div>
                <div class="input_box">
                    <button class="send" type="submit">Apply</button>
                </div>
            </form>
        </div>
        
        <div class="field">
            <div class="field_name">E-mail address :</div>
            <div class="content_field"><?php echo $user['email']; ?></div>
        </div>
        <div class="form_box">
            <form id="change_email" action="/user/account/change_email" enctype="application/x-www-form-urlencoded" method="post">
                <img class="ajax_loader" src="/images/ajax_loader_1.gif"/>
                <div class="valid_errors message"></div>
                <div class="valid_success message"></div>
                <div class="input_box">
                    <div class="input_title">New e-mail address :</div>
                    <input name="new_email" type="text"/>
                </div>
                <div class="input_box">
                    <div class="input_title">Password :</div>
                    <input name="password" type="password"/>
                </div>
                <div class="input_box">
                    <button class="send" type="submit">Send</button>
                </div>
            </form>
            <div class="note">
                <b>Note: </b> If you change your e-mail address, an email with an activation code will be sent to the specified email address. Follow the instructions in the email to activate your new e-mail address. Until you activate the new address, use old to login.
            </div>
        </div>
        
    </body>
</html>

