/* ========================================================================= */
/* BE SURE TO COMMENT CODE/IDENTIFY PER PLUGIN CALL */
/* ========================================================================= */

jQuery(function($){

    /* ====== Twitter API Call =============================================
        Note: Script Automatically adds <li> before and after template. Don't forget to setup Auth info in /twitter/index.php */
    /*
    $('#tweets-loading').tweet({
        modpath: '/path/to/twitter/', // only needed if twitter folder is not in root
        username: 'jackrabbits',
        count: 1,
		template: '<p>{text}</p><p class="tweetlink">{time}</p>'
	});
    */

    $('.collateral-tags h3').click(function(){
        $(this).toggleClass('active').next('ul').slideToggle(200);
    })

    if (navigator.userAgent.match(/(iPod|iPhone|iPad)/)) {
        $('.home-banner').addClass('ios').css('background-attachment','scroll');
    }

    $(window).load(function(){
        $('body').addClass('ready');
        if($('#contact-form div:first').hasClass('gform_validation_error')){
            $('html,body').animate({
                "scrollTop" : $('#contact-form').offset().top - 59
            }, 200)
        }
    });

    $('#contact-form form, form.contactus').submit(function(){
        $(this).find('button[type=submit]').attr('disabled','disabled')
    });

    function homeBanner(){
        var $wh = $(window).height();
        if($wh > 550){
            $('.home-banner').css('height',$wh + 'px').children('div').css('margin-bottom',($wh/5-100)+'px');
            $('.logo-lg').css('margin-top',($wh/3)-300+'px');
        }else{
            $('.home-banner').css('height','550px').children('div').css('margin-bottom','10px');
            $('.logo-lg').css('margin-top','-116px');
        }
        $('.home-banner .more').click(function(){
            $('html,body').animate({
                "scrollTop" : ($wh > 550 ? -59 + $wh : 491)
            }, 200);
            return false;
        });
    }

    homeBanner();
    $(window).resize(function(){
        homeBanner();
    });

    $(document).scroll(function(){
        var nm = Math.ceil($("html").scrollTop());
        var nw = Math.ceil($("body").scrollTop());
        var n;
        if(nm > nw){n = nm;}else{n = nw;}

        $(".home-banner:not(.ios)").css('background-position','center -'+(n/2)+'px');

        // IF HOMEPAGE
        if($('body').hasClass('home')){
            if(n > 350){
                $('.logo-lg').css('opacity',0);
                $('#logo').addClass('active');
            }else{
                $('#logo').removeClass('active');
                $('.logo-lg').css('opacity',1);
            }
        }else{
            if(n > 45){
                $('#int-logo, #int-banner span').css('opacity',0);
                $('#logo').addClass('active');
                $('body').addClass('scrolled');
            }else{
                $('body').removeClass('scrolled');
                $('#logo').removeClass('active');
                $('#int-logo, #int-banner span').css('opacity',1);
            }
        }
    });

    $('#main-nav').hover(function(){
        $('.logo-lg').css('display','none');
        $('#int-logo, #int-banner span').css('display','none');
        $('#logo').addClass('active');
    },function(){
        $('.logo-lg').css('display','block');
        if(!$('body').hasClass('scrolled')){
            $('#logo').removeClass('active');
        };
        $('#int-logo, #int-banner span').css('display','block');
    })

    $('#sitemap .toggle').click(function(){
        $('#sitemap > ul').slideToggle(200);
        var $text = $(this).text();
        $(this).toggleClass('hide').text(($text === 'Show Sitemap' ? 'Hide Sitemap' : 'Show Sitemap'));
    });

    $('#searchbar .icon').click(function(){
        $('#sec').addClass('searched');
        $('#searchbar input').focus();
    });

    $('#searchbar .close').click(function(){
        $('#sec').removeClass('searched');
    });

    $('#contact-form select, form.contactus select').selectmenu();

    $('.ui-selectmenu-status, .ui-selectmenu-menu a').html(function(){
        return $(this).html().replace('[', '<b>').replace(']','</b>');
    });

    $('#home-tabs li').click(function(){
        $('#home-tabs li.active').removeClass('active');
        $(this).addClass('active');
        var $tab = $(this).attr('data-tabid');
        $('#tab-content .wrap>div').fadeOut()
        $('#tab-content .wrap>div[data-tabid='+$tab+']').fadeIn();
    })

    $('#tab-content .wrap>div[data-tabid=1]').show();

    $('input, textarea').placeholder();

    /* Ajax load more Pagination */
    $('.loadmore:not(.noajax) a').on('click', function(e)  {
        e.preventDefault();
       // $('.text_holder').append("<div class=\"loader\">&nbsp;</div>");
        $(this).text('Loading...').parent().addClass('loading');
        var link = jQuery(this).attr('href');

        var $content = '.query-results';
        var $nav_wrap = '.loadmore';
        var $anchor = '.loadmore a';
        var $next_href = $($anchor).attr('href'); // Get URL for the next set of posts

        $.get(link+'', function(data){
            var $timestamp = new Date().getTime();
            var $new_content = $($content, data).wrapInner('').html(); // Grab just the content
          //  alert($new_content);
          //  $('.blogPostsWrapper .loader').remove();
            $next_href = $($anchor, data).attr('href'); // Get the new href
            $('.query-results li:last-child').after($new_content); // Append the new content
           // $('#rtz-' + $timestamp).hide().fadeIn('slow'); // Animate load
            $('.loadmore a').attr('href', $next_href); // Change the next URL
            //$('.team li:last').remove(); // Remove the original navigation
            var nlink = $('.loadmore a').attr('href');
            if(nlink == link){ $('.loadmore a').hide(1); }

        }).done(function(data){
            $('.loadmore.loading').removeClass('loading');
            $('.loadmore a').text('Load More')
            initColorbox();
        });
    });

    $('#blog-sort h4').click(function(){
        $(this).parent('.sort').toggleClass('ex');
    });

    $('#blog-sort.collateral a').click(function(){
        var topic = $(this).text();
        $(this).closest('ul').siblings('h4').children('em').text(topic);
        $(this).closest('.sort').toggleClass('ex');
        if(topic == 'All'){
            $('#media.collateral li').each(function(){
                $(this).slideDown(150).fadeIn(150);
            });
        }else{
            $('#media.collateral li').each(function(){
                if($(this).data('topic') !== topic){
                    $(this).slideUp(150).fadeOut(150);
                }else{
                    $(this).slideDown(150).fadeIn(150);
                }
            });
        }
    })

    $('#int-logo').click(function(){
        window.location = $('#logo a').attr('href');
    });

    $('ul.accordion li').click(function(){
        $(this).toggleClass('active').children('div').slideToggle(100);
    })

    $('.nolink>a').click(function(){return false});

    function initColorbox(){
        $('a.lb-trigger').colorbox({
            iframe: true,
            overlayClose: false,
            width: 725,
            height:600,
            fixed:true,
            onComplete: function(){
                window.location.hash = $(this).closest('li').data('id');
            }
        });

        $('.lb-clicker').click(function(){
            $(this).closest('li').children('a.lb-trigger').trigger('click');
            return false;
        })
    };

    initColorbox();

    if($('#vidhash').length != 0){
       $('#vidhash .lb-trigger').colorbox({
            iframe: true,
            overlayClose: false,
            width: 725,
            height:600,
            fixed:true,
            open: true
       })
    }

    $('#blue-cats span').click(function(){
        var slug = $(this).data('cat');
        var dist = $('#vcats h3[data-cat='+slug+']').offset().top;
        $('html,body').animate({
            "scrollTop" : (dist - 42)
        }, 500);
        return false;
    });

    function vidClick(){
        $('#vcats a:not(.external), .up-next a').click(function(e){
            $('#vcats a.play').removeClass('play');
            $(this).addClass('play');
            window.location.hash = $(this).data('slug');
            e.preventDefault();
            $('html,body').animate({
                "scrollTop" : 0
            }, 500);
            var link = jQuery(this).attr('href');
            var html;
            $.get(link, function(data){
                html = $(data).filter('#lb-video').html();
                $('#video-player .video-contents').html(html); // Append the new content
            }).done(function(){
                vidClick();
            });
        });
    }

    vidClick();

    if($('#vcats').length != 0){
        if(window.location.hash){
            var hash = window.location.hash.substring(1);
            $('a[data-slug=' + hash + ']').trigger('click');
        }
    }


    $(".owl-slider.who-we-serve").owlCarousel({
        items: 4,
        loop: true,
        nav: true,
        slideBy: 4
    });

    $(".owl-slider.vid-slide").owlCarousel({
        items: 5,
        loop: true,
        nav: true,
        slideBy: 5,
        margin: 20,
        lazyload: false,
    });

    $('#quote-slide.slideshow').owlCarousel({
        items: 1,
        loop: true,
        nav: true,
        autoHeight: true
    })


/*

        var link = jQuery(this).attr('href');

        var $content = '.query-results';

        $.get(link+'', function(data){
            var $new_content = $($content, data).wrapInner('').html(); // Grab just the content
            $('.query-results li:last-child').after($new_content); // Append the new content

        })'
*/


});
