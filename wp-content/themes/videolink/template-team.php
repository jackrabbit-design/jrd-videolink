<?php
/* Template Name: Team */
get_header(); the_post();
$def = get_field('default_image')?>

<div id="int-banner" style="background-image:url('<?php $banner = get_field('banner_image'); $default = get_field('default_header_image','options'); echo ($banner ? $banner['sizes']['int-banner'] : $default['sizes']['int-banner']); ?>')">
    <span></span>
    <h2><?php the_title(); ?></h2>
</div>
<h2 id="int-logo"><?php bloginfo('name') ?></h2>

<div class="wrap int clearfix">

    <?php get_sidebar('left'); ?>
    
        <article id="article" class="over-right team">

            <?php the_content(); ?>
            
            <?php query_posts(array(
                'post_type' => 'team-posts',
                'orderby' => 'menu_order',
                'order' => 'ASC'
            ));
            if(have_posts()): $c = 0 ?>
                <ul id="team">
                    <?php while(have_posts()): the_post(); $thb = get_field('bio_image'); ?>
                        <li<?php echo (++$c % 3 == 0 ? ' class="third"' : '') ?>>
                            <a href="<?php the_permalink() ?>"><img src="<?php echo ($thb ? $thb['sizes']['team-thb'] : $def['sizes']['team-thb'] ) ?>" alt="<?php the_title() ?>" /></a>
                            <p>
                                <a href="<?php the_permalink() ?>"><?php the_title() ?></a>
                                <?php the_field('company_title'); ?>
                            </p>
                        </li>
                    <?php endwhile; ?>
                </ul>
            <?php endif; wp_reset_query(); ?>
        </article>

</div>


<?php get_footer(); ?>