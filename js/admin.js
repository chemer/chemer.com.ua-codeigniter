jQuery(function($){
    
    chosen_image = null;
    chosen_image_url = null; // используется в editor.js
    timeout = null;
    current_page_url = $.trim($('#uri').text());
    lang = $.trim($('#page_lang').text());
    admin = {};
    
    admin.events = function(){
        
        /*
         *  The events for a common updating.
         */
        
        $('.available_image_box').dblclick(function(){
            $('.available_image_box').removeClass('chosen_image');
            $(this).addClass('chosen_image');
            chosen_image = this;
            chosen_image_url = $(this).children('.available_image').children('img').attr('src');
        });  
        
        $('.available_image_box').click(function(){
            chosen_image = null;
            chosen_image_url = null;
            $('.available_image_box').removeClass('chosen_image');
        }); 
        
        $('.remove_image').click(function(){
            if (chosen_image_url == null) {
                clearTimeout(timeout);
                $('.message').empty().show();
                var elem = $(this).siblings('.admin_errors').html('not selected any images');
                timeout = setTimeout(function(){elem.fadeOut();}, 15000);
            }
            else {
                var data = {
                    'image_url' : chosen_image_url
                }
                admin.ajax('/request/remove_image', data, this);
            }
        });
        
        $('#upade_metadata').click(function(){
            var data = {
                'meta_title' : $.trim($('#meta_title').text()),
                'keywords' : $.trim($('#keywords').text()),
                'description' : $.trim($('#description').text()),
                'current_uri' : current_page_url,
                'lang' : lang
            }
            admin.ajax('/request/update/metadata', data, this);
        });  
        
        $('#update_active_title').click(function(){
            var data = {
                'active_title' : $.trim($('#edited_active_title').text()),
                'current_uri' : current_page_url,
                'lang' : lang
            }
            admin.ajax('/request/update/active_title', data, this);
        });
        
        $('#update_main_content').click(function(){
            var main_content = '';
            if ($.trim($('#edited_main_content').text()) != '')  main_content = $('#edited_main_content').html();
            var data = {
                'main_content' : main_content,
                'current_uri' : current_page_url,
                'lang' : lang
            }
            admin.ajax('/request/update/main_content', data, this);
        }); 
        
        $('#update_bottom_content').click(function(){
            var bottom_content = '';
            if ($.trim($('#edited_bottom_content').text()) != '')  bottom_content = $('#edited_bottom_content').html();
            var data = {
                'bottom_content' : bottom_content,
                'current_uri' : current_page_url,
                'lang' : lang
            }
            admin.ajax('/request/update/bottom_content', data, this);
        });
        
        /*
         *  The events for an editor of the contacts.
         */
        
        $('.add_contact').click(function(){
            admin.ajax('/request/update/add_contact', null, this);
        });
        
        $('.save_contact').click(function(){
            var data = {
                'contact_id' : $.trim($(this).parents('.contact_box').children('.contact_id').text()),
                'lang' : lang,
                'name' : $.trim($(this).parents('.contact_box').children('.contactsName').text()),
                'phone' : $.trim($(this).parents('.contact_box').children('.phone').children('.contact_data').text()),
                'skype' : $.trim($(this).parents('.contact_box').children('.skype').children('.contact_data').text()),
                'email' : $.trim($(this).parents('.contact_box').children('.email').children('.contact_data').text())
            }
            admin.ajax('/request/update/save_contact', data, this);
        });
        
        $('.remove_contact').click(function(){
            var data = {
                'contact_id' : $.trim($(this).parents('.contact_box').children('.contact_id').text())
            }
            admin.ajax('/request/update/remove_contact', data, this);
        });
        
        /*
         *  The events for an editor of the photo and video gallery.
         */

//        $('.create_group').click(function(){
//            var data = {
//                'current_uri' : current_page_url
//            }
//            admin.ajax('/request/update/create_group', data, this);
//        });
//        
//        $('.remove_group').click(function(){
//            var data = {
//                'group_id' : $.trim($(this).parents('.group').children('.group_id').text()),
//                'current_uri' : current_page_url
//            }
//            admin.ajax('/request/update/remove_group', data, this);
//        });
//        
//        $('.update_group_description').click(function(){
//            var data = {
//                'group_id' : $.trim($(this).parents('.group').children('.group_id').text()),
//                'group_description' : $(this).parents('.group').children('.group_description').html(),
//                'lang' : lang
//            }
//            admin.ajax('/request/update/group_description', data, this);
//        });
//        
//        $('.add_image_group').click(function(){
//            var data = {
//                'group_id' : $.trim($(this).parents('.group').children('.group_id').text())
//            }
//            admin.ajax('/request/update/add_image_group', data, this);
//        });
//        
//        $('.remove_image_group').click(function(){
//            var data = {
//                'image_id' : $.trim($(this).parents('.image_group_box').children('.image_id').text())
//            }
//            admin.ajax('/request/update/remove_image_group', data, this);
//        });
//        
//        $('.save_image_group').click(function(){
//            var data = {
//                'image_id' : $.trim($(this).parents('.image_group_box').children('.image_id').text()),
//                'small_image' : $.trim($(this).parents('.image_group_box').children('.small_image_box').children('.small_image').attr('src')),
//                'big_image' : $.trim($(this).parents('.image_group_box').children('.big_image_box').children('.big_image').attr('src')),
//                'image_description' : $.trim($(this).parents('.image_group_box').children('.image_description').text()),
//                'lang' : lang 
//            }
//            admin.ajax('/request/update/save_image_group', data, this);
//        });
//        
//        $('.insert_small_image').click(function(){
//            clearTimeout(timeout);
//            $('.message').empty().show();
//            if (chosen_image_url == null) {
//                var elem = $(this).siblings('.admin_errors').html('not selected any images');
//                timeout = setTimeout(function(){elem.fadeOut();}, 15000);
//            }
//            else {
//                var img_src = chosen_image_url;
//                var filename = $(chosen_image).children('.available_image_title').children('.available_image_filename').text();
//                var img_size = $(chosen_image).children('.available_image_title').children('.available_image_size').text();
//                $(this).parents('.small_image_box').children('.small_image').attr('src', img_src);
//                $(this).parents('.small_image_box').children('.image_filename').html(filename);
//                $(this).parents('.small_image_box').children('.image_size').html(img_size);
//            }
//        });
//        
//        $('.insert_big_image').click(function(){
//            clearTimeout(timeout);
//            $('.message').empty().show();
//            if (chosen_image_url == null) {
//                var elem = $(this).siblings('.admin_errors').html('not selected any images');
//                timeout = setTimeout(function(){elem.fadeOut();}, 15000);
//            }
//            else {
//                var img_src = chosen_image_url;
//                var filename = $(chosen_image).children('.available_image_title').children('.available_image_filename').text();
//                var img_size = $(chosen_image).children('.available_image_title').children('.available_image_size').text();
//                $(this).parents('.big_image_box').children('.big_image').attr('src', img_src);
//                $(this).parents('.big_image_box').children('.image_filename').html(filename);
//                $(this).parents('.big_image_box').children('.image_size').html(img_size);
//            }
//        });
//        
//        $('.add_video').click(function(){
//            var data = {
//                'code_video' : $.trim($(this).parents('.reload').children('.code_video').text()),
//                'group_id' : $.trim($(this).parents('.group').children('.group_id').text())
//            }
//            admin.ajax('/request/update/add_video', data, this);
//        });
//        
//        $('.remove_video').click(function(){
//           var data = {
//               'video_id' : $.trim($(this).parents('.available_video').children('.video_id').text())
//           }
//           admin.ajax('/request/update/remove_video', data, this);
//        });

        /*
         *  The events for an editor of the portfolio. 
         */

        $('.add_portfolio_item').click(function(){
            admin.ajax('/request/update/add_portfolio_item', null, this);
        });
        
        $('.insert_portfolio_image').click(function(){
            clearTimeout(timeout);
            $('.message').empty().show();
            if (chosen_image_url == null) {
                var elem = $(this).siblings('.admin_errors').html('not selected any images');
                timeout = setTimeout(function(){elem.fadeOut();}, 15000);
            }
            else {
                var img_src = chosen_image_url;
                var filename = $(chosen_image).children('.available_image_title').children('.available_image_filename').text();
                var img_size = $(chosen_image).children('.available_image_title').children('.available_image_size').text();
                $(this).parents('.portfolio_item_image').children('img').attr('src', img_src);
                $(this).parents('.portfolio_item_image').children('.image_filename').html(filename);
                $(this).parents('.portfolio_item_image').children('.image_size').html(img_size);
            }
        });
        
        $('.save_portfolio_item').click(function(){
            var data = {
                'item_id' : $.trim($(this).parents('.portfolio_item').children('.item_id').text()),
                'image' : $.trim($(this).parents('.portfolio_item').children('.portfolio_item_image').children('img').attr('src')),
                'item_link' : $.trim($(this).parents('.portfolio_item').children('.portfolio_item_link').text()),
                'item_title' : $.trim($(this).parents('.portfolio_item').children('.portfolio_item_title').text()),
                'item_description' : $.trim($(this).parents('.portfolio_item').children('.portfolio_item_description').text()),
                'lang' : lang 
            }
            admin.ajax('/request/update/save_portfolio_item', data, this);
        });
        
        $('.remove_portfolio_item').click(function(){
            var data = {
                'item_id' : $.trim($(this).parents('.portfolio_item').children('.item_id').text())
            }
            admin.ajax('/request/update/remove_portfolio_item', data, this);
        });
        
    }
    
    admin.ajax = function(url, data, submit_button){
        $.ajax({
            url: url,
            type: 'POST',
            data: data,
            dataType: 'json',
            contentType: 'application/x-www-form-urlencoded',
            beforeSend: function(){
                $('.message').empty().show();
                $(submit_button).siblings('.admin_ajax_loader').show();
                clearTimeout(timeout);
            },
            error: function(){
                var elem = $(submit_button).siblings('.admin_errors').html('transmission data error');
                timeout = setTimeout(function(){elem.fadeOut();}, 15000);
            },
            success: function(answer){
                if (answer.error) {
                    var elem = $(submit_button).siblings('.admin_errors').html(answer.message);
                    timeout = setTimeout(function(){elem.fadeOut();}, 15000);
                }
                else {
                    var elem = $(submit_button).siblings('.admin_success').html(answer.message);
                    timeout = setTimeout(function(){elem.fadeOut();}, 15000);
                    switch ($(submit_button).attr('class')) {
                        case 'remove_image':
                                chosen_image = null;
                                chosen_image_url = null;
                                $('img[src="'+answer.image_url+'"]').parents('.available_image_box').remove();
                                break;
                        case 'add_portfolio_item':
                                location.reload();
                                break;
                        case 'remove_portfolio_item':
                                $(submit_button).parents('.portfolio_item').remove();
                                break;
                        case 'add_contact':
                                location.reload();
                                break;
                        case 'remove_contact':
                                $(submit_button).parents('.contact_box').remove();
                                break;
//                        case 'create_group':
//                                location.reload();
//                                break;
//                        case 'remove_group':
//                                $(submit_button).parents('.group').remove();
//                                break;
//                        case 'add_image_group':
//                                location.reload();
//                                break;
//                        case 'remove_image_group':
//                                $(submit_button).parents('.image_group_box').remove();
//                                break;
//                        case 'add_video':
//                                location.reload();
//                                break;
//                        case 'remove_video':
//                                $(submit_button).parents('.available_video').remove();
//                                break;
                        default:
                                break;
                    }
                }
            },
            complete: function(){
                $(submit_button).siblings('.admin_ajax_loader').hide();
            }
        });
    }
    
    admin.events();
    
});