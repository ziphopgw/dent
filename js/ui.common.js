;(function($, win, doc, undefined) {

    'use strict';
    
    $plugins.common = {
 
        init: function(){
            $plugins.uiAjax({ id:'baseHeader', url:'/inc/header.html', page:true, callback:$plugins.common.header });
            $plugins.uiAjax({ id:'baseFooter', url:'/inc/footer.html', page:true, callback:$plugins.common.footer });
                        
            $(win).on('scroll', function(){
               headerChange($(win).scrollTop())
            });
            function headerChange(v){
                v > 0 ? $('body').addClass('type-mini'): $('body').removeClass('type-mini');
            }


            imgChange();
            $(win).resize(function(){
                imgChange();
            });    
           

            function imgChange(){
                $('.base-header').removeClass('ready').removeClass('open');

                if ($(win).outerWidth() > 1399) {
                    $('img').each(function(){
                        var $this = $(this);
                        $this.attr('src', $this.attr('dsrc'));
                    });
                } else {
                    $('img').each(function(){
                        var $this = $(this);
                        $this.attr('src', $this.attr('msrc'));
                    });
                }

            }
            $('.ui-tab-btn').on('click', function(){
                 $('.fadeinup').removeClass('active');
                 itemshowhie();
            });

            itemshowhie();
            $(win).scroll( function(){
               itemshowhie();
            });
            function itemshowhie(){
                 $('.fadeinup').each( function(i){
                    var bottom_of_element = $(this).offset().top + 10 ,
                        bottom_of_window = $(win).scrollTop() + $(win).height();



                    if( bottom_of_window > bottom_of_element ){
                        $(this).addClass('active');
                    } else if (bottom_of_window < bottom_of_element) {
                        $(this).removeClass('active');
                    }
                });
            }


        },
        
        header: function(){
            var timer,
                timer_m;

            $('.gnb-dep1-btn').on('mouseover focus', function(e){
                clearTimeout(timer);

                $('#baseHeader').addClass('on');
            }).on('click', function(e){
                if ($(this).next('ul').length) {
                    e.preventDefault();
                }
                
                $('.gnb-dep1 > li').removeClass('selected');
                $(this).closest('li').addClass('selected');
            });
            $('.base-header').on('mouseleave blur', function(){
                clearTimeout(timer);
                menuHide();
            });
            function menuHide(){
                timer = setTimeout(function(){
                    $('#baseHeader').removeClass('on');
                    $('.gnb-dep1 > li').removeClass('selected');
                },100);
            }


            $('.btn-menu').on('click', function(){
                $('#baseHeader').addClass('ready');
                setTimeout(function(){
                    $('#baseHeader').addClass('open');
                },10);
                
            });
            $('.btn-close').on('click', function(){
                $('#baseHeader').removeClass('open');
                setTimeout(function(){
                    $('#baseHeader').removeClass('ready');
                },150);
                
            });
            

        },
  
        footer: function(){
        }
    };

    // fadeinup
    
    //modal
    

    //page 
    $plugins.page = {}

    //callback
    $plugins.callback = {
        modal: function(modalId){
            switch(modalId) {
                case 'modalID':
                    break;     
            }
        }
    }
   
    $(doc).ready(function() {
        $plugins.common.init();
	});
})(jQuery, window, document);
