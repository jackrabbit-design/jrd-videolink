<?php
/* Template Name: FAQs */
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
        
        <?php
        if(have_rows('faqs')):
            while(have_rows('faqs')): the_row();
                echo '<h3>' . get_sub_field('category_title') . '</h3>';
                if(get_sub_field('category_faqs')):
                    echo '<ul class="accordion">';
                    while(has_sub_field('category_faqs')):
                        echo '<li><h4>'.get_sub_field('question').'</h4><div>'.get_sub_field('answer').'</div></li>';
                    endwhile;
                    echo '</ul>';
                endif;
            endwhile;
        endif;
        ?>

        
    </article>
</div>


<?php get_footer(); ?>