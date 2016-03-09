<?php
/* Template Name: Resources */
get_header(); the_post(); ?>

<div id="int-banner" style="background-image:url('<?php $banner = get_field('banner_image'); $default = get_field('default_header_image','options'); echo ($banner ? $banner['sizes']['int-banner'] : $default['sizes']['int-banner']); ?>')">
    <span></span>
    <h2><?php the_title(); ?></h2>
</div>
<h2 id="int-logo"><?php bloginfo('name') ?></h2>

<div class="wrap int clearfix">

    <?php get_sidebar('left'); ?>

        <article id="article" class="over-right">
            <?php
                switch($post->ID){
                    case 45:
                        $pt = 'story-posts';
                    break;
                }
            ?>

            <?php $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
            query_posts(array(
                'post_type' => $pt,
                'post_status' => 'publish',
                'posts_per_page' => 10,
                'paged' => $paged,
                'orderby' => 'menu_order',
                'order' => 'ASC'
            ));
            if(have_posts()):?>
                <ul id="media" class="resources query-results">
                    <?php while(have_posts()): the_post(); $cat = wp_get_post_terms( $post->ID, 'news-cats'); ?>
                        <li>
                            <a href="<?php the_permalink() ?>" class="title"><?php the_title() ?></a>
                            <a href="<?php the_permalink() ?>" class="read">Read Story</a>
                        </li>
                    <?php endwhile; ?>
                </ul>

                <div class="loadmore"><?php next_posts_link('Load More'); ?></div>
            <?php endif; wp_reset_query(); ?>
        </article>
</div>


<?php get_footer(); ?>
