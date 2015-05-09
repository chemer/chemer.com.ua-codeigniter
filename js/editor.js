jQuery(function($){
    editor = {};
    editor.toolbarID = null;
    editor.stateCommands = ['bold', 'italic', 'underline', 'JustifyLeft', 'JustifyCenter', 'JustifyCenter', 'JustifyRight', 'InsertUnorderedList'];
    
    editor.queryState = function(){
        for (var i = 0; i < editor.stateCommands.length; i++) {
            if (document.queryCommandState(editor.stateCommands[i])) {
                $('#'+editor.toolbarID).children('.'+editor.stateCommands[i]).addClass('editor_active');
            }
            else $('#'+editor.toolbarID).children('.'+editor.stateCommands[i]).removeClass('editor_active');
        }
    }
    
    editor.queryColor = function(){
        var color = document.queryCommandValue('foreColor');
        if ( ! color ) color = 'transparent';
        $('#'+editor.toolbarID+' .foreColor_title_color').css({'display':'block', 'background-color':color});
    }
    
    editor.querySize = function(){
        var size = document.queryCommandValue('fontSize');
        if ( ! size ) size = '';
        $('#'+editor.toolbarID+' .fontSize_title_int').empty().text(size);
    }
    
    editor.queryFamily = function(){
        var family = document.queryCommandValue('fontName');
        if ( ! family ) family = 'Family';
        $('#'+editor.toolbarID+' .fontName_title').empty().text(family);
    }
    
    editor.eventsStateCommands = function(){
        for (var i = 0; i < editor.stateCommands.length; i++) {
            $('.'+editor.stateCommands[i]).click(
                function(){
                    var command = $(this).removeClass('editor_active').attr('class');
                    if (editor.conformity(this)) {
                        document.execCommand(command, false, null);
                        editor.queryState();
                    }
                }
            );
        }    
    };
    
    editor.eventCreatLink = function(){
        $('.createLink').click(
            function(){
                if (editor.conformity(this)) {
                    var href = prompt('Enter the location reference:', 'http://');
                    if ( href == null || href == undefined || $.trim(href) == '') return;
                    else document.execCommand('createLink', false, href);
                }
            }
        );
    };
    
    editor.eventUnlink = function(){
        $('.unlink').click(
            function(){
                if (editor.conformity(this)) {
                    document.execCommand('unlink', false, null);
                }
            }
        );
    };
    
    editor.eventInsertImage = function(){
        $('.insertImage').click(
            function(){
                if (editor.conformity(this)) {
                    var src = chosen_image_url;
                    if ( src == null || src == undefined ) return;
                    else document.execCommand('insertImage', false, src);
                }
            }
        );
    }
    
    editor.eventForeColor = function(){
        $('.foreColor_overhead').click(function(){$(this).next().show();});
        $('.foreColor_dropbox').mouseleave(function(){$(this).fadeOut();});
        $('.foreColor').click(
            function(){
                if (editor.conformity(this)) {
                    var color = $(this).css('background-color');
                    document.execCommand('foreColor', false, color);
                    editor.queryColor();
                }
            }
        );
    };
    
    editor.eventFontSize = function(){
        $('.fontSize_overhead').click(function(){$(this).next().show();});
        $('.fontSize_dropbox').mouseleave(function(){$(this).fadeOut();});
        $('.fontSize').click(
            function(){
                if (editor.conformity(this)) {
                    var size = $(this).parents('.fontSize_dropbox_item').text().substr(-1,1);
                    document.execCommand('fontSize', false, size);
                    editor.querySize();
                }
            }
        );
    };
    
    editor.eventsFontName = function(){
        $('.fontName_overhead').click(function(){$(this).next().show();});
        $('.fontName_dropbox').mouseleave(function(){$(this).fadeOut();});
        $('.fontName').click(
            function(){
                if (editor.conformity(this)) {
                    var style = $(this).parents('.fontName_dropbox_item').text();
                    document.execCommand('fontName', false, style);
                    editor.queryFamily();
                }
            }
        );
    };
    
    editor.eventsContenteditable = function(){
        $('.editor_toolbar').next().attr('contenteditable', 'true').each(
            function(){
                var setToolbarID = function (elem) {editor.toolbarID = $(elem).prev('.editor_toolbar').attr('id');};
                $(this).click(
                    function(){
                        setToolbarID(this);
                        editor.queryState();
                        editor.queryColor();
                        editor.querySize();
                        editor.queryFamily();
                    }
                );
                $(this).keyup(
                    function(){
                        setToolbarID(this);
                        editor.queryState();
                        editor.queryColor();
                        editor.querySize();
                        editor.queryFamily();
                    }
                );
                $(this).mousedown(
                    function(){
                        setToolbarID(this);
                        $('*').removeClass('editor_active');
                        $('.foreColor_title_color').css({'display':'none'});
                        $('.fontSize_title_int').empty();
                        $('.fontName_title').empty().text('Family');
                    }
                );
                $(this).blur(
                    function(){
                        $('*').removeClass('editor_active');
                        $('.foreColor_title_color').css({'display':'none'});
                        $('.fontSize_title_int').empty();
                        $('.fontName_title').empty().text('Family');
                    }
                );
            }
        );
    };
    
    editor.conformity = function(elem){
        return $(elem).parents('.editor_toolbar').attr('id') == editor.toolbarID ? true : false;
    }
    
    editor.setToolbarCSS = function(){
        $('.editor_toolbar').each(
            function (){
                var w = $(this).next().outerWidth(true)-2;
                var f = $(this).next().css('float');
                var p = $(this).next().css('position');
                $(this).css({'width':w, 'float':f});
                if (p == 'absolute') {
                    var t = $(this).next().offset().top - $(this).outerHeight(true);
                    var b = $(this).next().offset().bottom + $(this).outerHeight(true);
                    var l = $(this).next().offset().left;
                    var r = $(this).next().offset().right;
                    var z = $(this).next().css('z-index')+1;
                    $(this).css({'position':'absolute', 'top':t, 'bottom':b, 'left':l, 'right':r, 'z-index':z});
                }
            }
        )
    };
    
    editor.eventsStateCommands();
    editor.eventCreatLink();
    editor.eventUnlink();
    editor.eventForeColor();
    editor.eventFontSize();
    editor.eventsFontName();
    editor.eventInsertImage();
    editor.eventsContenteditable();
    editor.setToolbarCSS();
    $(window).resize(editor.setToolbarCSS);
    
});
