<?php
/* Template Name: Who We Serve */
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
    
    <article id="article" class="<?php echo (get_field('sidebar_modules') ? '' : 'over-right') ?>">
        
        <? the_content() ?>
        
        <? if(have_rows('service')): $s = 1; while(have_rows('service')): the_row(); ?>
        
            <h3 class="service"><? the_sub_field('service_name') ?></h3>
            
<? if(is_user_logged_in()){ ?>

            <? if(have_rows('logos')){ $c = 1;  ?>
                <div class="owl-slider who-we-serve" data-cycle-slides=">.slide" data-cycle-fx="scrollHorz" data-cycle-next=".next.s<?= $s ?>" data-cycle-prev=".prev.s<?= $s ?>" data-cycle-timeout=0>
                    <? while(have_rows('logos')){ the_row(); ?>
                        <div class="slide" style="background-image:url(<? $logo = get_sub_field('logo'); echo $logo['sizes']['company-logo'] ?>);<?= ($c % 4 == 0 ? ' margin-right:0px;' : '') ?>"></div>
                    <? } ?>
                </div>
            <? } ?>


<? }else{ ?>
            
            <? if(have_rows('logos')){ $c = 1;  ?>
                <div class="cycle-slideshow who-we-serve" data-cycle-slides=">.slide" data-cycle-fx="scrollHorz" data-cycle-next=".next.s<?= $s ?>" data-cycle-prev=".prev.s<?= $s ?>" data-cycle-timeout=0>
                    <div class="slide">
                        <? while(have_rows('logos')){ the_row(); ?>
                            <div style="background-image:url(<? $logo = get_sub_field('logo'); echo $logo['sizes']['company-logo'] ?>);<?= ($c % 4 == 0 ? ' margin-right:0px;' : '') ?>"></div>
                <? if($c % 4 == 0){ ?>
                    </div><div class="slide">
                <? } ?>
                        <? $c++; } ?>
                    </div>
                </div>
                <div class="pager">
                    <span class="next s<?= $s ?>"></span>
                    <span class="prev s<?= $s ?>"></span>
                </div>
            <? } ?>
            
<? } ?>        
            
        <? $s++; endwhile; endif; ?>
    
        
    </article>
</div>


<?php get_footer(); ?>