<?php
/* Template Name: Blog Overview */
if(isset($_GET['auth'])) {
    $authID = $_GET['auth'];
    $titleID = 'Entries by ' . get_the_author_meta('display_name',$authID);
    global $titleID;
}
get_header(); the_post();
?>


    <div id="int-banner" style="background-image:url(<? $banner = get_field('banner_image'); $default = get_field('default_header_image','options'); echo ($banner ? $banner['sizes']['int-banner'] : $default['sizes']['int-banner']); ?>)">
        <span></span>
        <h2><?php the_title(); ?></h2>
    </div>
    <h2 id="int-logo">VideoLink</h2>
    
    <?php get_template_part('blog-sort') ?>
        
    <div class="wrap int clearfix">

        <?php
        $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
        query_posts(array(
            'post_type' => 'post',
            'posts_per_page' => 6,
            'post_status' => 'publish',
            'paged' => $paged,
            'author' => (isset($_GET['auth']) ? $authID : '')
        ));
        if(have_posts()): ?>

            <ul id="blog-list" class="query-results">
                <?php while(have_posts()): the_post();?>
                    <?php if(has_post_thumbnail()) {
                        $thumbImg = wp_get_attachment_image_src(get_post_thumbnail_id(),'blog-thb');
                        $thumb = $thumbImg[0];
                    }else{
                        $thumbImg = get_field('default_blog_thumbnail',49);
                        $thumb = $thumbImg['sizes']['blog-thb'];
                    } ?>
                    <li>
                        <a href="<?php the_permalink() ?>">
                            <img src="<?php echo $thumb; ?>" alt="<?php the_title() ?>" />
                        </a>
                        <div class="text">
                            <p class="date-auth"><strong><?php the_date('m.d.y') ?></strong> - <a href="<?php echo get_permalink(49) . '?auth=' . $post->post_author ?>"><?php the_author_meta('display_name',$post->post_author) ?></a></p>
                            <h4><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h4>
                            <p class="date-auth">
                                <?php
                                $tags = get_the_terms($post->ID,'post_tag');
                                if($tags){ ?>
                                    <?php $c = 1; foreach($tags as $tag){
                                        echo 
                                            '<a href="'
                                            .get_term_link($tag->slug,$tag->taxonomy)
                                            .'">'
                                            .$tag->name
                                            .'</a>'
                                            .(count($tags) > $c++ ? ', ' : '');                            
                                    }
                                } ?>
                            </p>
                            <p class="excerpt"><?php echo get_the_excerpt() ?></p>
                            <a href="<?php the_permalink() ?>" class="go">Continue Reading</a>
                        </div>
                    </li>
                <?php endwhile; ?>
            </ul>
            
            <div class="loadmore"><?php next_posts_link('Load More'); ?></div>
        <?php endif; wp_reset_postdata(); ?>

    </div>


<?php get_footer(); ?>