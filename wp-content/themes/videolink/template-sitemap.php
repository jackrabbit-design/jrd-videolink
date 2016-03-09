<?php
/* Template Name: Sitemap */
get_header(); the_post(); ?>

<div id="int-banner" style="background-image:url('<?php $banner = get_field('banner_image'); $default = get_field('default_header_image','options'); echo ($banner ? $banner['sizes']['int-banner'] : $default['sizes']['int-banner']); ?>')">
    <span></span>
    <h2><?php the_title(); ?></h2>
</div>
<h2 id="int-logo"><?php bloginfo('name') ?></h2>

<div class="wrap int landing clearfix">
    
    <article id="article" class="sitemap">
    
        <?php wp_nav_menu(array('theme_location' => 'main-menu', 'container' => '', 'menu_class' => '', 'menu_id' => 'sitemap' )); ?>

    </article>
</div>


<?php get_footer(); ?>