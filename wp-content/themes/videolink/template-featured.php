<?php
/* Template Name: Featured */
get_header(); the_post(); ?>

<div id="int-banner" style="background-image:url('<?php $banner = get_field('banner_image'); $default = get_field('default_header_image','options'); echo ($banner ? $banner['sizes']['int-banner'] : $default['sizes']['int-banner']); ?>')">
    <span></span>
    <h2><?php the_title(); ?></h2>
</div>
<h2 id="int-logo"><?php bloginfo('name') ?></h2>

<div class="wrap int clearfix">

    <?php get_sidebar('left'); ?>

    <?php get_sidebar('right'); ?>
    
    <article id="article">

        <?php the_content() ?>
        
        <?php if($file = get_field('collateral_file')):
            echo '<a href="'.$file['url'].'" class="btn">'.get_field('collateral_button_text').'</a>';
        endif; ?>
        
        <?php if(have_rows('accordion')):
            echo '<ul class="accordion">';
            while(have_rows('accordion')): the_row();
                    echo
                        '<li><h4>'
                        . get_sub_field('accordion_title')
                        . '</h4><div>'
                        . get_sub_field('accordion_text')
                        . '</div></li>'
                    ;
                endwhile;
            echo '</ul>';
        endif; ?>

    </article>
</div>


<?php get_footer(); ?>