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
        <div id="success_title">Регистрация прошла успешно.</div>
        <div id="success_text">
Для активации регистрации, следуйте инструкциям в письме, которое было отправлено на Ваш e-mail адрес.<br/>
Если Вы не получили письмо в течение нескольких минут, проверьте в папке спам электронной почты.            
        </div>
        <div id="success_thanks">Спасибо за регистрацию.</div>
    </body>
</html>
