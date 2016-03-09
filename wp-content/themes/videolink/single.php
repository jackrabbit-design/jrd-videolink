<?php get_header(); the_post(); ?>

    <div id="int-banner" style="background-image:url('<?php 
        $banner = get_field('banner_image'); 
        $default = (get_field('banner_image',49) ? get_field('banner_image',49) : get_field('default_header_image','options')); 
        echo ($banner ? $banner['sizes']['int-banner'] : $default['sizes']['int-banner']);
    ?>')">
        <span></span>
        <h2><?php echo get_the_title(49); ?></h2>
    </div>
    <h2 id="int-logo"><?php bloginfo('name') ?></h2>
    
    <?php get_template_part('blog-sort'); ?>
    
    <div class="wrap int clearfix">
    
        <aside id="left">
            
            <div id="blog-details">
                <h3>Author</h3>
                <a href="#"><?php the_author_meta('display_name',$post->post_author) ?></a>
                
                <?php
                    $cats = get_the_terms($post->ID,'category');
                    $tags = get_the_terms($post->ID,'post_tag');
                ?>
                
                <?php if($cats){ ?>
                    <h3>Category</h3>
                    <?php $c = 1; foreach($cats as $cat){
                        echo 
                            '<a href="'
                            .get_term_link($cat->slug,$cat->taxonomy)
                            .'">'
                            .$cat->name
                            .'</a>'
                            .(count($cats) > $c++ ? ', ' : '');                            
                    } ?>
                <?php } ?>
                <?php if($tags){ ?>
                    <h3>Tags</h3>
                    <?php $c = 1; foreach($tags as $tag){
                        echo 
                            '<a href="'
                            .get_term_link($tag->slug,$tag->taxonomy)
                            .'">'
                            .$tag->name
                            .'</a>';                            
                    } ?>
                <?php } ?>
                
            </div>
            
        </aside>
                
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
                <?php the_date('F j, Y') ?>
            </div>
            
            <?php if(has_post_thumbnail()) { ?>
                <?php $hide = get_field('dont_show_featured_image_on_post') ?>
                <?php if($hide == '1'){}else{ ?>
                    <div id="feat-holder">
                        <img src="<?php $img = wp_get_attachment_image_src(get_post_thumbnail_id(),'blog-feat'); echo $img[0]; ?>" alt="<?php the_title() ?>" />
                        <div><?php the_field('featured_tagline') ?></div>
                    </div>
                <?php } ?>
            <?php } ?>
            

            <?php the_content(); ?>

            
            <a href="<?php echo get_permalink(49) ?>" class="back">Back to All Blog Posts</a>
            
        </article>
    </div>
    
    <?php $related_posts = MRP_get_related_posts($post->ID, true); ?>
    <?php if($related_posts): $i = 0; ?>
        <div id="blog-rel">
            <h3>Related Posts</h3>
            <?php foreach($related_posts as $rel){
                if($i < 3) {
                    $i++;
                    $relThb = (has_post_thumbnail($rel->ID) ? wp_get_attachment_image_src(get_post_thumbnail_id($rel->ID),'blog-rel') : '');
                    ?>
                    <div <?php echo ($relThb ? 'style="background-image:url('.$relThb[0].')"' : '') ?>>
                        <a href="<?php echo get_permalink($rel->ID) ?>"><?php echo $rel->post_title ?></a>
                        <span><?php echo date('m.d.y',strtotime($rel->post_date)); ?></span>
                    </div>
                <?php }
            } ?>
            <!--                 <div><a href="#">What is Video Strategy?</a><span>09.24.13</span></div> -->
        </div>
    <?php endif; ?>


<?php get_footer(); ?>