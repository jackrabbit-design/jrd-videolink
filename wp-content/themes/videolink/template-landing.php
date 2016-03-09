<?php
/* Template Name: Landing */
get_header(); the_post(); ?>

<div id="int-banner" style="background-image:url('<?php $banner = get_field('banner_image'); $default = get_field('default_header_image','options'); echo ($banner ? $banner['sizes']['int-banner'] : $default['sizes']['int-banner']); ?>')">
    <span></span>
    <h2><?php the_title(); ?></h2>
</div>
<h2 id="int-logo"><?php bloginfo('name') ?></h2>

<div class="wrap int landing clearfix">

    <?php the_content(); ?>    
    
    <?php if(have_rows('sub_pages')): ?>
        <ul id="landing-grid">
            <?php while(have_rows('sub_pages')): the_row(); $thb = get_sub_field('subpage_image'); $link = (get_sub_field('subpage_link') ? get_sub_field('subpage_link') : get_sub_field('external_link') . '" target="blank' ); ?>
                <li class="<?php echo (get_sub_field('subpage_title') ? 'flip' : 'noflip') ?>">
                    <div class="front" style="background-image:url(<?php echo $thb['sizes']['landing'] ?>);">
                        <h4><?php the_sub_field('subpage_title') ?></h4>
                    </div>
                    <div class="back">
                        <h4><?php the_sub_field('subpage_title') ?></h4>
                        <p><?php the_sub_field('subpage_description') ?></p>
                        <a href="<?php echo $link ?>">Continue</a>
                    </div>
                </li>
            <?php endwhile; ?>
        </ul>
    <?php endif; ?>

</div>


<?php get_footer(); ?>