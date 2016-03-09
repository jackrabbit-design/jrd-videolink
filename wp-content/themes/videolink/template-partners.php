<?php
/* Template Name: Partners */
get_header(); the_post(); ?>

<div id="int-banner" style="background-image:url('<?php $banner = get_field('banner_image'); $default = get_field('default_header_image','options'); echo ($banner ? $banner['sizes']['int-banner'] : $default['sizes']['int-banner']); ?>')">
    <span></span>
    <h2><?php the_title(); ?></h2>
</div>
<h2 id="int-logo"><?php bloginfo('name') ?></h2>

<div class="wrap int clearfix">

    <?php get_sidebar('left'); ?>

    <?php if(get_field('sidebar_modules')): ?>
        <?php get_sidebar('right'); ?>
    <?php endif; ?>
    
    <article id="article" <?php echo (get_field('sidebar_modules') ? '' : ' class="over-right"') ?>>
    
        <?php the_content(); ?>
        
        <?php if(have_rows('partners')): $c = 0; while(have_rows('partners')): the_row(); $logo = get_sub_field('partner_logo') ?>
            <div class="partner <?php echo ($c++ == 0 ? 'first' : '') ?>">
                <a href="http://<?php the_sub_field('partner_website') ?>" class="logo" target="_blank" style="background-image:url(<?php echo $logo['sizes']['partner-logo'] ?>)"></a>
                <div class="text">
                    <h5><?php the_sub_field('partner_name') ?></h5>
                    <p><?php the_sub_field('partner_description') ?></p>
                    <a href="http://<?php the_sub_field('partner_website') ?>" target="_blank"><?php the_sub_field('partner_website') ?></a>
                </div>
            </div>
        <?php endwhile; endif; ?>

    </article>
</div>


<?php get_footer(); ?>