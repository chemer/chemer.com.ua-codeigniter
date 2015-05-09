function get_url_param(param)
{
    var get = [];
    if(location.search) {
        var arrayVariables = (location.search.substr(1)).split('&');
        for(var i = 0; i < arrayVariables.length; i ++) {
            var itemArrayVariables = arrayVariables[i].split('=');
            get[itemArrayVariables[0]] = itemArrayVariables[1];
        }
    }
    return get[param];
}

jQuery(function($){
/*
 * execute for right block
 */
    $('.subContentShow').prev().hide().end().css({'display':'inline'}).empty().append('...show');
    $('.subContentShow').click(function(event){
            if (this == event.target) {
                    if ($(this).prev().is(':hidden')) {
                            $('.subContentShow').prev().hide().end().empty().append('...show');
                            $(this).prev().css('height','auto').slideDown('normal').end().empty().append('...hide');
                            }
                    else {$(this).prev().hide().end().empty().append('...show');
                    }
            }
            return false;
    });
    
});