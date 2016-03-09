<?php get_header(); the_post(); ?>

<div id="int-banner" style="background-image:url('<?php
    $banner = get_field('banner_image');
    $default = (get_field('banner_image',20) ? get_field('banner_image',20) : get_field('default_header_image','options')); 
    echo (
        $banner ? $banner['sizes']['int-banner'] : $default['sizes']['int-banner']); ?>')">
    <span></span>
    <h2>News</h2>
</div>
<h2 id="int-logo"><?php bloginfo('name') ?></h2>

<div class="wrap int clearfix">

    <?php get_sidebar('left'); ?>

        <article id="article" class="over-right blog">

            <h2><?php the_title() ?></h2>
            <div class="details">
                <p class="share">
                    Share this Article
                    <a target="_blank" href="http://www.facebook.com/sharer/sharer.php?u=<?php the_permalink() ?>" class="social-facebook"></a>
                    <a target="_blank" href="https://twitter.com/intent/tweet?text=<?php the_title() ?>&url=<?php the_permalink() ?>&via=VideoLinkLLC" class="social-twitter"></a>
                    <a target="_blank" href="http://www.linkedin.com/shareArticle?mini=true&url=<?php the_permalink() ?>&title=<?php echo get_the_title() . ' | ' . bloginfo('name') ?>&source=<?php bloginfo('url') ?>" class="social-linkedin"></a>
                    <a href="mailto:?subject=<?php the_title() ?>&body=<?php the_permalink() ?>" class="social-email"></a>
                    
                </p>
                <?php echo get_the_date('F j, Y') . (get_field('location') ? ' &mdash; ' . get_field('location') : '') ?>
            </div>
            
            <?php the_content() ?>
            
            <?php if(get_field('external_link')) echo '<br/><a class="btn" href="'.get_field('external_link').'">View Article</a><br/>'; ?>
            
            <div class="media-contact">
                <h5>VideoLink Media Contact</h5>
                <p>
                    <strong>Marianne Rocco</strong><br/>
                    Marketing Director<br/>
                    VideoLink LLC<br/>
                    617-340-4202
                </p>
            </div>
            
            <a href="#" class="back">Back to All News</a>

        </article>

</div>


<?php get_footer(); ?>