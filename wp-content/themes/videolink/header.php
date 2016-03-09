<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=Edge"/><meta name="MSSmartTagsPreventParsing" content="true" />
    <?php /* if (is_front_page()) { ?><title><?php bloginfo('name'); ?></title>
    <?php } else { */ ?>
    <? global $titleID; global $paged; ?>
    <title><?php echo ($titleID ? $titleID . ' | ' : ''); wp_title(''); echo ($paged > 0 ? " - Page {$paged} - " : ''); ?></title>
	<link type="text/css" rel="stylesheet" media="all" href="<?php bloginfo('url') ?>/ui/css/style.css?v=<?= date('is') ?>" />
    <link type="text/plain" rel="author" href="<?php bloginfo('url') ?>/authors.txt" />
    <link type="image/x-icon" rel="shortcut icon" href="<?php bloginfo('url') ?>/favicon.ico" />
    <script src="<?php bloginfo('url') ?>/ui/js/modernizr.js"></script>
    <script language="JavaScript" type="text/javascript" src="http://admin.brightcove.com/js/BrightcoveExperiences.js"></script>
<!--     <script src="<?php bloginfo('url') ?>/ui/js/jquery.js" type="text/javascript"></script> -->
    <script src="//play.vidyard.com/v0/api.js"></script>
    <script type="text/javascript"
      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDdYAKxs-cKYwg6JiaXqmWe6q1H78sg88U">
    </script>
    <?php gravity_form_enqueue_scripts(1, false); ?>
    <?php wp_head(); ?>
    <?php if(is_page_template('template-videos.php')): ?>
        <script>
            var hash = window.location.hash;
            if(hash !== ''){
                window.location.href = 'http://www.videolinktv.com/resources-support/videos/?vid='+hash.substr(1);
            }
        </script>
    <?php endif; ?>
    <!-- begin Google Analytics code -->
    <script>
        (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
            (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
            m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
        })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
        ga('create', 'UA-300695-4', 'auto');
        ga('send', 'pageview');
    </script>
    <!-- begin marketo code -->
	<script type="text/javascript">
	(function() {
		var didInit = false;
		function initMunchkin() {
			if(didInit === false) {
				didInit = true;
				Munchkin.init('541-WZH-565');
			}
		}
		var s = document.createElement('script');
		s.type = 'text/javascript';
		s.async = true;
		s.src = '//munchkin.marketo.net/munchkin.js';
		s.onreadystatechange = function() {
			if (this.readyState == 'complete' || this.readyState == 'loaded') {
				initMunchkin();
			}
		};
		s.onload = initMunchkin;
		document.getElementsByTagName('head')[0].appendChild(s);
		})();
	</script>
    <!-- DemandBase Code - Added 6/11/15 -->
    <script>(function(d,b,a,s,e){ var t = b.createElement(a),fs = b.getElementsByTagName(a)[0]; t.async=1; t.id=e;t.src=('https:'==document.location.protocol ? 'https://' : 'http://') + s;fs.parentNode.insertBefore(t, fs); })(window,document,'script','scripts.demandbase.com/2G94rWvN.min.js','demandbase_js_lib');</script>



</head>
<body <?php body_class((is_front_page() ? 'home' : '')); ?><?php // echo (is_front_page() ? 'class="home"' : '') ?>>
    <!--[if lte IE 7]><iframe src="<?php bloginfo('url') ?>/unsupported.html" frameborder="0" scrolling="no" id="no_ie6"></iframe><![endif]-->
    <header id="header">
        <div class="wrap">
            <nav id="main-nav">
                <?php wp_nav_menu( array('theme_location' => 'main-menu', 'container' => '', 'menu_class' => '', 'menu_id' => '', 'depth' => 2, 'walker' => new jrd_walker() )); ?>
            </nav>
            <nav id="sec">
                <ul id="sm">
<!--
                    <li><a href="https://twitter.com/intent/tweet?text=<?php echo (is_front_page() ? '' : get_the_title() . ' | ') . bloginfo('name') ?>&url=<?php bloginfo('url') ?>&via=VideoLinkLLC" target="_blank" class="social-twitter"></a></li>
                    <li><a href="http://www.facebook.com/sharer/sharer.php?u=<?php bloginfo('url') ?>" target="_blank" class="social-facebook"></a></li>
                    <li><a href="http://www.linkedin.com/shareArticle?mini=true&url=<?php bloginfo('url') ?>&title=<?php echo (is_front_page() ? '' : get_the_title() . ' | ') . bloginfo('name') ?>&source=<?php bloginfo('url') ?>" target="_blank" class="social-linkedin"></a></li>
-->
                    <li><a class="social-twitter" href="//twitter.com/<?php the_field('twitter_username','options') ?>" target="_blank"></a></li>
                    <li><a class="social-facebook" href="<?php the_field('facebook_url','options') ?>" target="_blank"></a></li>
                    <li><a class="social-linkedin" href="<?php the_field('linkedin_url','options') ?>" target="_blank"></a></li>
                    <li><a class="social-youtube" href="<?php the_field('youtube_url','options') ?>" target="_blank"></a></li>
                </ul>
                <div id="searchbar">
                    <span class="icon"></span>
                    <span class="close"></span>
                    <?php echo get_search_form(); ?>
                </div>
                <?php $phone = get_field('footer_locations','options') ?>
                <div id="phone"><?php echo str_replace('-','.',$phone[0]['phone_number']) ?></div>
                  <?php wp_nav_menu( array('menu' => 3, 'container' => '', 'menu_class' => '', 'menu_id' => 'util' )); ?>
            </nav>
            <h1 id="logo"<?= (is_page_template('template-videos-new.php') ? 'class="always"' : '') ?>><a href="<?php bloginfo('url') ?>"><?php bloginfo('name') ?></a></h1>
        </div>
    </header>
