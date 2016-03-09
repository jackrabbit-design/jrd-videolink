<?php get_header(); the_post(); ?>

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
    
        <?php if($post->ID !== 50): ?>
            <?php the_content(); ?>
            
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
            
        <?php else: ?>
            <?php if(!isset($_COOKIE['pardot_3'])): ?>
                <?php the_content(); ?>
             <?php else: ?>
                <h4>Thank you for contacting us. We will be in touch shortly.</h4>
             <?php endif; ?>
        <?php endif; ?>
    </article>
</div>


<?php get_footer(); ?>