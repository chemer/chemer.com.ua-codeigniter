jQuery(function($){  
   
    var portfolio = {
        
        'timeout' : null,
        
        'length' : $('.gallery').children('.gallery_item').size(),
        
        'items' : function(){
                        return $('.gallery').children('.gallery_item');
                    },
                    
        'prev' : function(){
                        if (portfolio.timeout) portfolio.timeout 
                        var first = portfolio.items()[0];
                        $('.gallery').append(first);
                        portfolio.execute();
                    },
                    
        'next' : function(){
                        var last = portfolio.items()[portfolio.length-1];
                        $('.gallery').prepend(last);
                        portfolio.execute();
                    },
        'play' : function(){
                        portfolio.timeout = setInterval(portfolio.next,7000);
                    },
                    
        'pause' : function(){
                        clearTimeout(portfolio.timeout);
                    },
                    
        'events' : function(){
                        $('.roll_left').click(function(){portfolio.prev();});
                        $('.roll_right').click(function(){portfolio.next();});
                        $('.pause_play').click(function(){
                            if ($(this).hasClass('play')) {
                                $(this).attr('src','/images/play.jpg').removeClass('play');
                                portfolio.pause();
                            }
                            else {
                                $(this).attr('src','/images/pause.jpg').addClass('play');
                                portfolio.play();
                            }
                        });
                    },
                    
        'execute' : function(){
                        var options = {'duration':600, 'easing':'swing', 'complete':false, 'queue':false};
                        for(i=0; i<portfolio.length; i++) {
                            var item = portfolio.items()[i];
                            var item_title = $(item).children('.gallery_item_title');
                            var item_image = $(item).children('.gallery_item_image_box').children('.gallery_item_image');
                            var item_description = $(item).children('.gallery_item_description');
                            switch(i){
                                case 0:
                                        $(item).show('slow').animate({'left':'215px', 'top':'100px', 'z-index':'1'}, options);
                                        $(item_image).hide('slow').animate({'height':'0', 'width':'0','opacity':'0'}, options);
                                        $(item_title).hide('slow').animate({'font-size':'0', 'opacity':'0'}, options);
                                        $(item_description).hide();
                                        break;
                                case 1:
                                        $(item).show('slow').animate({'left':'5px', 'top':'30px', 'opacity':'1', 'z-index':'2'}, options);;
                                        $(item_image).show('slow').animate({'height':'160px', 'width':'205px', 'opacity':'1'}, options);
                                        $(item_title).show('slow').animate({'width':'205px', 'font-size':'16px', 'opacity':'1'}, options);
                                        $(item_description).fadeOut();
                                        break;
                                case 2:
                                        $(item).show().animate({'left':'215px', 'top':'0', 'opacity':'1', 'z-index':'3'}, options);;
                                        $(item_image).show().animate({'height':'300px', 'width':'380px', 'opacity':'1'}, options);
                                        $(item_title).show().animate({'width':'380px', 'font-size':'20px', 'opacity':'1'}, options);
                                        $(item_description).fadeIn();
                                        break;
                                case 3:
                                        $(item).show('slow').animate({'left':'600px', 'top':'30px', 'opacity':'1', 'z-index':'2'}, options);;
                                        $(item_image).show('slow').animate({'height':'160px', 'width':'205px', 'opacity':'1'}, options);
                                        $(item_title).show('slow').animate({'width':'205px', 'font-size':'16px', 'opacity':'1'}, options);
                                        $(item_description).fadeOut();
                                        break;
                                case 4:
                                        $(item).show('slow').animate({'left':'595px', 'top':'100px', 'opacity':'0', 'z-index':'1'}, options);;
                                        $(item_image).hide('slow').animate({'opacity':'0'}, options);
                                        $(item_title).hide('slow').animate({'font-size':'0', 'opacity':'0'}, options);
                                        $(item_description).hide();
                                        break;
                                default:
                                        $(item).hide();
                                        $(item_image).hide();
                                        $(item_title).hide();
                                        $(item_description).hide();
                                        break;
                            };
                        }
                    }
                    
    };
    
    portfolio.execute();
    portfolio.events();
    portfolio.play();
    
});