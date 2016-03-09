    <?php get_template_part('prefooter'); ?>

    <?php if(!get_field('hide_contact_form') && !is_search()): ?>
        <div id="contact-form">
            <?php if(!isset($_COOKIE['pardot_2'])): ?>

                <?php gravity_form(2, true, false, false, null, false, 1); ?>
                <div id="cf-wrapper"></div>
            <?php else: ?>

                <div id="cf-wrapper" style="padding-bottom:0px !important;"><p style="text-align:center; padding:65px 0 0; color:#fff; font-size:26px; font-weight:300;">Thank you for contacting us. We will be in touch shortly.</p></div>

            <?php endif; ?>

        </div>

    <?php endif; ?>

    <footer id="footer">
        <div id="sitemap">
            <span class="toggle">Show Sitemap</span>
            <?php wp_nav_menu( array('theme_location' => 'main-menu', 'container' => '', 'menu_class' => '', 'menu_id' => '', 'depth' => 2 )); ?>
        </div>

        <ul id="locs">
            <?php if(have_rows('footer_locations','options')){ $c = 1;
                while(have_rows('footer_locations','options')){ the_row(); ?>
                    <li>
                        <strong><?php the_sub_field('location_name') ?></strong>
                        <?php the_sub_field('phone_number') ?>
                        <a href="<?php the_sub_field('link_url') ?>">More Information</a>
                    </li>
                <?php }
            } ?>
        </ul>

        <hr />

        <div class="wrap">
            <ul id="utility">
                    <li><a class="social-twitter" href="//twitter.com/<?php the_field('twitter_username','options') ?>" target="_blank"></a></li>
                    <li><a class="social-facebook" href="<?php the_field('facebook_url','options') ?>" target="_blank"></a></li>
                    <li><a class="social-linkedin" href="<?php the_field('linkedin_url','options') ?>" target="_blank"></a></li>
                <?php wp_nav_menu( array('menu' => 3, 'container' => '', 'items_wrap' => '%3$s')); ?>
            </ul>
            <p class="credits">&copy; <?php echo date('Y') ?> <a class="vl" href="<?php bloginfo('url') ?>"><?php bloginfo('name') ?></a>. All rights reserved.
                <?php $credits = wp_get_nav_menu_items( 5 ); ?>
                <?php foreach ($credits as $credit){
                    echo '<a class="cr" href="'.$credit->url.'">'.$credit->title.'</a>';
                }; ?>
                <span class="jrd"><a href="http://www.jumpingjackrabbit.com" title="Web Design by Jackrabbit" target="_blank">Web Design</a> by <a href="http://www.jumpingjackrabbit.com" title="Web Design by Jackrabbit" target="_blank">Jackrabbit</a></span>
            </p>
        </div>

    </footer>
    <script src="<?php bloginfo('url') ?>/ui/js/jquery.plugins.js" type="text/javascript"></script>
    <script src="<?php bloginfo('url') ?>/ui/js/jquery.ui.js" type="text/javascript"></script>
<!--
    <script src="<?php bloginfo('url') ?>/ui/js/jquery.ui.core.js" type="text/javascript"></script>
    <script src="<?php bloginfo('url') ?>/ui/js/jquery.ui.position.js" type="text/javascript"></script>
    <script src="<?php bloginfo('url') ?>/ui/js/jquery.ui.widget.js" type="text/javascript"></script>
    <script src="<?php bloginfo('url') ?>/ui/js/jquery.ui.selectmenu.js" type="text/javascript"></script>
-->
    <script src="<?php bloginfo('url') ?>/ui/js/jquery.init.js" type="text/javascript"></script>

<?php wp_footer(); ?>
</body>
</html>
