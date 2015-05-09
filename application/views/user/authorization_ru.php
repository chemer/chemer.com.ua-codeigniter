<?php if ( ! $logged_in) { ?>
<div id="authorization_wrapper">
    <div id="authorization_bg"></div>
    <div id="authorization_box">
        <div id="authorization_form_box">
            <div id="authorization_title">АВТОРИЗАЦИЯ ПОЛЬЗОВАТЕЛЯ</div>
            <div id="authorization_form">
                <img class="ajax_loader" src="/images/ajax_loader_1.gif"/>
                <div class="error_message message"></div>
                <form action="/user/authorization" enctype="application/x-www-form-urlencoded" method="post">
                    <div class="input_box">
                        <div class="input_title">e-mail адрес :</div>
                        <input name="email" type="text"/>
                    </div>
                    <div class="input_box">
                        <div class="input_title">пароль :</div>
                        <input name="password" type="password"/>
                    </div>
                    <div id="remember_box">
                        <input id="remember" name="remember" type="checkbox"/>
                        <label for="remember">запомнить ( для этого компьютера )</label>
                    </div>
                    <div class="input_box">
                        <button class="send" type="submit">Авторизироваться</button>
                    </div>
                </form>
            </div>
            <div id="authorization_bottom">
                <span class="authorization_bottom_link" id="forgot_password">Забыли пароль?</span>
                <a class="authorization_bottom_link" href="/user/registration">Зарегистрироваться</a>
            </div>
        </div>
        <div id="generation_password_box">
            <div id="generation_password_title">ГЕНЕРИРОВАТЬ НОВЫЙ ПАРОЛЬ</div>
            <div id="generation_password_form">
                <img class="ajax_loader" src="/images/ajax_loader_1.gif"/>
                <div class="error_message message"></div>
                <div class="success_message message"></div>
                <form action="/user/generation_password" enctype="application/x-www-form-urlencoded" method="post">
                    <div class="input_box">
                        <div class="input_title">e-mail адрес :</div>
                        <input name="email" type="text"/>
                    </div>
                    <div class="captcha"><?php echo $captcha['image']; ?></div>
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
                <b>Примечание: </b>письмо с дальнейшими инструкциями будет отправлено на указанный адрес электронной почты.
            </div>
        </div>
    </div>
</div>
<?php } ?>