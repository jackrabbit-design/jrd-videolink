<?php get_header(); the_post(); ?>

    <div id="int-banner" style="background-image:url('<?php $banner = get_field('banner_image'); $default = get_field('default_header_image','options'); echo ($banner ? $banner['sizes']['int-banner'] : $default['sizes']['int-banner']); ?>')">
        <span></span>
        <h2><?php echo get_the_title(45); ?></h2>
    </div>
    <h2 id="int-logo"><?php bloginfo('name') ?></h2>
    
    <div class="wrap int clearfix">
    
        <aside id="left">
            
        <h3 class="subnav-title"><a href="<?php echo get_permalink(45) ?>"><?php echo get_the_title(45) ?></a></h3>
        <?php query_posts(array(
            'post_type' => 'story-posts',
            'orderby' => 'date',
            'order' => 'DESC'
        ));
        if(have_posts()): $postID = $post->ID;?>
            <ul id="subnav"><li class="current-menu-item"><ul>
                <?php while(have_posts()): the_post(); ?>
                    <li<?php echo ($postID == $post->ID ? ' class="current-menu-item"' : '') ?>><a href="<?php the_permalink(); ?>"><?php the_title() ?></a>
                <?php endwhile; ?>
            </li></li></ul>
        <?php endif; wp_reset_query(); ?>

            
        </aside>
                
        <article id="article" class="over-right blog">

            <h2><?php the_title() ?></h2>

            <div class="details">
                <p class="share">
                    Share this Story
                    <a target="_blank" href="http://www.facebook.com/sharer/sharer.php?u=<?php the_permalink() ?>" class="social-facebook"></a>
                    <a target="_blank" href="https://twitter.com/intent/tweet?text=<?php the_title() ?>&url=<?php the_permalink() ?>&via=VideoLinkLLC" class="social-twitter"></a>
                    <a target="_blank" href="http://www.linkedin.com/shareArticle?mini=true&url=<?php the_permalink() ?>&title=<?php echo get_the_title() . ' | ' . bloginfo('name') ?>&source=<?php bloginfo('url') ?>" class="social-linkedin"></a>
                    <a href="mailto:?subject=<?php the_title() ?>&body=<?php the_permalink() ?>" class="social-email"></a>
                    
                </p>
            </div>
            
            <?php if(has_post_thumbnail()) { ?>
                <div id="feat-holder">
                    <img src="<?php $img = wp_get_attachment_image_src(get_post_thumbnail_id(),'blog-feat'); echo $img[0]; ?>" alt="<?php the_title() ?>" />
                    <div><?php the_excerpt() ?></div>
                </div>
            <?php } ?>
            

            <?php the_content(); ?>
            
            <?php if($pdf = get_field('success_story_pdf')) echo '<a href="'.$pdf['url'].'" class="btn">View Story</a>'; ?>

            
            <a href="<?php echo get_permalink(45) ?>" class="back">Back to All Success Stories</a>
            
        </article>
    </div>

<?php get_footer(); ?>