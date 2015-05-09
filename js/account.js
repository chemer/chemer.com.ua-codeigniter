jQuery(function($){
    
    lang = get_url_param('lang');
    
    account = {};
    account.timeout = null;
    
    account.events = function(){
        $('#change_username').submit(function(){
            var data = {
                'lang' : lang,
                'username' : this.username.value,
                'password' : this.password.value
            };
            account.ajax('/user/account/change_username', data, '#change_username');
            return false;
        });
        $('#change_password').submit(function(){
            var data = {
                'lang' : lang,
                'password' : this.password.value,
                'new_password' : this.new_password.value,
                'confirm_password' : this.confirm_password.value
            };
            account.ajax('/user/account/change_password', data, '#change_password');
            return false;
        });
        $('#change_email').submit(function(){
            var data = {
                'lang' : lang,
                'password' : this.password.value,
                'new_email' : this.new_email.value
            };
            account.ajax('/user/account/change_email', data, '#change_email');
            return false;
        });
//        $('#user_question_form').submit(function(){
//            var data = {
//                'lang' : lang,
//                'question' : this.question.value,
//                'captcha' : this.captcha.value
//            };
//            account.ajax('/user/account/ask_question', data, '#user_question_form');
//            return false;
//        });
    }
    
    account.ajax = function(url, data, formID){
        $.ajax({
            url: url,
            type: 'POST',
            data: data,
            dataType: 'json',
            contentType: 'application/x-www-form-urlencoded',
            beforeSend: function(){
                $(formID + '>.ajax_loader').show();
                $('.message').empty().show();
                clearTimeout(account.timeout);
            },
            error: function(){
                alert('transmission data error');
            },
            success: function(answer){
                if (formID == '#user_question_form') $('.captcha').html(answer.captcha_img);
                if (answer.error) {
                    var message_box = formID + ' > .valid_errors';
                    $(message_box).html(answer.message);
                    account.timeout = setTimeout(function(){$(message_box).fadeOut();}, 30000);
                }
                else {
                    var message_box = formID + ' > .valid_success';
                    $(message_box).html(answer.message);
                    account.timeout = setTimeout(function(){$(message_box).fadeOut();}, 30000);
                    $('input:password').val('');
                    if (formID == '#change_username') {
                        $('#username').html(answer.username);
                    }
                }
            },
            complete: function(){
                $(formID + '>.ajax_loader').hide();
                if (formID == '#user_question_form') $('input[name="captcha"]').val('');
            }
        });
    }
    
    account.events();
    
});
