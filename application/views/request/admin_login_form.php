<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html;charset=utf-8"/>
        <title>Admin panel</title>
        <link rel="stylesheet" type="text/css" href="/css/admin_login_form.css"/>
    </head>
    <body>
        <div id="form_box">
            <div id="form_title">Admin panel</div>
            <form action="/request/confirm_admin_user" enctype="application/x-www-form-urlencoded" method="post">
                <input name="sender" type="hidden" value="<?php echo $sender;?>">
                <div class="input_title">Username:</div>
                <input name="username" type="text">
                <div class="input_title">Password:</div>
                <input name="password" type="password">
                <input id="submit" type="submit" value="Log in">
            </form>
        </div>
    </body>
</html>