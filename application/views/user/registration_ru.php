<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html;charset=utf-8"/>
        <title>Регистрация пользователя</title>
        <link rel="stylesheet" type="text/css" href="/css/registration.css"/>
    </head>
    <body>
        <div id="menu_box">
            <?php for ($i=0; $i < count($main_menu); $i++) { ?>
            <a href="<?php echo $main_menu[$i]['uri']; ?>">
                <span><?php echo $main_menu[$i]['title']; ?></span>
            </a>
            <?php } ?>
        </div>
        <div id="page_title">РЕГИСТРАЦИЯ ПОЛЬЗОВАТЕЛЯ</div>
        <div class="notice"><b>Внимание : </b>все поля обязательны для заполнения.</div>
        
        <div class="form_box">
            <div class="valid_errors">
                <?php echo validation_errors(); ?>
            </div>
            <form action="/user/registration" enctype="application/x-www-form-urlencoded" method="post">
                <div class="input_box">
                    <div class="input_title">Ф.И.О. :</div>
                    <input name="username" type="text" value="<?php echo set_value('username'); ?>"/>
                </div>
                <div class="input_box">
                    <div class="input_title">e-mail адрес :</div>
                    <input name="email" type="text" value="<?php echo set_value('email'); ?>"/>
                </div>
                <div class="input_box">
                    <div class="input_title">пароль :</div>
                    <input name="password" type="password" value="<?php echo set_value('password'); ?>"/>
                </div>
                <div class="input_box">
                    <div class="input_title">подтвердите пароль :</div>
                    <input name="confirm_password" type="password" value="<?php echo set_value('confirm_password'); ?>"/>
                </div>
                <div id="captcha"><?php echo $captcha_img;?></div>
                <div class="input_box">
                    <div class="input_title">введите символы с картинки :</div>
                    <input name="captcha" type="text"/>
                </div>
                <div class="input_box">
                    <button class="send" type="submit">Отправить</button>
                </div>
            </form>
        </div>
        <div class="note">
            <b>Примечание: </b>письмо с кодом активации будет отправлено на указанный адрес электронной почты. Следуйте инструкциям в письме для активации регистрации.
        </div>
    </body>
</html>