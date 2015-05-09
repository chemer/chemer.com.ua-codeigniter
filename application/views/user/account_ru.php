<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html;charset=utf-8"/>
        <title>Профиль пользователя</title>
        <link rel="stylesheet" type="text/css" href="/css/account.css"/>
        <script type="text/javascript" src="/js/jquery.js"></script>
        <script type="text/javascript" src="/js/default.js"></script>
        <script type="text/javascript" src="/js/account.js"></script>
    </head>
    <body>
        <div id="menu_box">
            <?php for ($i=0; $i < count($main_menu); $i++) { ?>
            <a href="<?php echo $main_menu[$i]['uri']; ?>">
                <span><?php echo $main_menu[$i]['title']; ?></span>
            </a>
            <?php } ?>
            <a id="logout" href="/user/account/logout">Log out</a>
        </div>
        
        <div id="page_title">ПРОФИЛЬ ПОЛЬЗОВАТЕЛЯ</div>
        
        <div class="notice"><b>Внимание : </b>только одно поле может быть изменено за один раз.</div>
        
        <div class="field">
            <div class="field_name">Ф.И.О. :</div>
            <div class="content_field" id="username"><?php echo $user['username']; ?></div>
        </div>
        <div class="form_box">
            <form id="change_username" action="/user/account/change_username" enctype="application/x-www-form-urlencoded" method="post">
                <img class="ajax_loader" src="/images/ajax_loader_1.gif"/>
                <div class="valid_errors message"></div>
                <div class="valid_success message"></div>
                <div class="input_box">
                    <div class="input_title">Новые Ф.И.О. :</div>
                    <input name="username" type="text"/>
                </div>
                <div class="input_box">
                    <div class="input_title">Пароль :</div>
                    <input name="password" type="password"/>
                </div>
                <div class="input_box">
                    <button class="send" type="submit">Применить</button>
                </div>
            </form>
        </div>
        
        <div class="field">
            <div class="field_name">Пароль :</div>
            <div class="content_field">********</div>
        </div>
        <div class="form_box">
            <form id="change_password" action="/user/account/change_password" enctype="application/x-www-form-urlencoded" method="post">
                <img class="ajax_loader" src="/images/ajax_loader_1.gif"/>
                <div class="valid_errors message"></div>
                <div class="valid_success message"></div>
                <div class="input_box">
                    <div class="input_title">Действующий пароль :</div>
                    <input name="password" type="password"/>
                </div>
                <div class="input_box">
                    <div class="input_title">Новый пароль :</div>
                    <input name="new_password" type="password"/>
                </div>
                <div class="input_box">
                    <div class="input_title">Подтвердите пароль :</div>
                    <input name="confirm_password" type="password"/>
                </div>
                <div class="input_box">
                    <button class="send" type="submit">Применить</button>
                </div>
            </form>
        </div>
        
        <div class="field">
            <div class="field_name">E-mail адрес :</div>
            <div class="content_field"><?php echo $user['email']; ?></div>
        </div>
        <div class="form_box">
            <form id="change_email" action="/user/account/change_email" enctype="application/x-www-form-urlencoded" method="post">
                <img class="ajax_loader" src="/images/ajax_loader_1.gif"/>
                <div class="valid_errors message"></div>
                <div class="valid_success message"></div>
                <div class="input_box">
                    <div class="input_title">Новый e-mail адрес :</div>
                    <input name="new_email" type="text"/>
                </div>
                <div class="input_box">
                    <div class="input_title">Пароль :</div>
                    <input name="password" type="password"/>
                </div>
                <div class="input_box">
                    <button class="send" type="submit">Отправить</button>
                </div>
            </form>
            <div class="note">
                <b>Примечание: </b>Если вы измените Ваш  e-mail адрес, письмо с кодом активации будет отправлено на указанный адрес электронной почты. Следуйте инструкциям в письме, чтобы активировать свой новый e-mail адрес. Пока не активируете новый адрес, используйте старый для входа.
            </div>
        </div>
        
    </body>
</html>

