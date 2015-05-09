jQuery(function($){
/*
* installation "draggable" to an element.
*/
    $('#authorization_form_box').draggable({
        'containment' : 'body',
        'handle' : '#authorization_title'
    });
    $('#generation_password_box').draggable({
        'containment' : 'body',
        'handle' : '#generation_password_title'
    });
    $('#authorization_bg').click(function(){$('.ui-draggable').css({'left':0,'top':0});});
    
/* 
 * end "draggable"
 */

    lang = get_url_param('lang');
    
    authorization = {};
    
    authorization.events = function(){
        $('#authorization').click(function(){$('#authorization_wrapper').show();});
        
        $('#authorization_bg').click(function(){
            $('#authorization_wrapper').hide();
            $('#generation_password_box').hide();
            $('#authorization_form_box').show();
            $('.message').empty();
        });
        
        $('#forgot_password').click(function(){
            $('#generation_password_box').show();
            $('#authorization_form_box').hide();
        });
        
        $('#authorization_form > form').submit(function(){
            var data = {
                'lang' : lang,
                'email' : this.email.value,
                'password' : this.password.value,
                'remember' : $('#remember:checked').val() ? 'on' : false
            };
            authorization.ajax('/user/authorization', data, '#authorization_form');
            return false;
        });
        
        $('#generation_password_form > form').submit(function(){
            var data = {
                'lang' : lang,
                'email' : this.email.value,
                'captcha' : this.captcha.value
            };
            authorization.ajax('/user/authorization/generate_password', data, '#generation_password_form');
            return false;
        });
    }
    
    authorization.ajax = function(url, data, formID){
        $.ajax({
            url: url,
            type: 'POST',
            data: data,
            dataType: 'json',
            contentType: 'application/x-www-form-urlencoded',
            beforeSend: function(){
                $(formID + '>.ajax_loader').show();
                $(formID + '>.message').empty();
            },
            error: function()
            {
                $(formID + '>.error_message').html('- transmission data error.');
            },
            success: function(answer)
            {
                if (formID == '#generation_password_form') $('.captcha').html(answer.captcha_img);
                if (answer.error) {
                    $(formID + '>.error_message').html(answer.message);
                }
                else {
                    if (formID == '#generation_password_form') {
                        $(formID + '>.success_message').html(answer.message);
                    }
                    else {
                        location.reload();
                        return;
                    }
                }
            },
            complete: function(){
                $(formID + '>.ajax_loader').hide();
                if (formID == '#generation_password_form') $('input[name="captcha"]').val('');
            }
        });
    }
    
    authorization.events();
});
