<?php
/* Template Name: Protected Videos */
get_header(); the_post();
$search = (isset($_GET['vidsearch']) ? $_GET['vidsearch'] : '');
?>


    <div id="int-banner" style="background-image:url('<?php $banner = get_field('banner_image'); $default = get_field('default_header_image','options'); echo ($banner ? $banner['sizes']['int-banner'] : $default['sizes']['int-banner']); ?>')">
        <span></span>
        <h2><?php the_title(); ?></h2>
    </div>
    <h2 id="int-logo">VideoLink</h2>

    <?php if($post->ID == 44) get_template_part('vid-sort'); ?>

    <div class="wrap int clearfix landing">

    <?php
        $password = get_field('user_password'); $get = (isset($_GET['allow']) ? $_GET['allow'] : '' );
        if ($_POST['vlPassword'] != $password && $get != '1') { ?>
            <h3>This page is password-protected.</h3>

            <form name="form" class="protected" method="post" action="<?php echo get_permalink(); ?>">
                <input type="password" placeholder="Password" name="vlPassword" />
                <?php echo ($_POST['vlPassword'] ? '<p class="invalid-pass">Sorry, your password is invalid.</p>' : ''); ?>
                <button type="submit">Submit</button>
            </form>
        <?php }else{ ?>

            <?php
            $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
            query_posts(array(
                'post_type' => 'pro-videos',
                'posts_per_page' => -1,
                'post_status' => 'publish',
                'paged' => $paged,
                'orderby' => 'menu_order',
                'order' => 'ASC'
            ));
            if(have_posts()): ?>

                <ul id="blog-list" class="query-results">
                    <?php while(have_posts()): the_post();?>
                        <?php
                        $thumbImg = get_field('video_thumbnail');
                        $thumb = $thumbImg['sizes']['blog-thb'];
                        ?>
                        <li>
                            <?php if(get_field('external_url')): ?>
                                <a href="<?php the_field('external_url') ?>" target="_blank">
                                    <img src="<?php echo $thumb; ?>" alt="<?php the_title(); ?>" />
                                </a>
                                <div class="text">
                                    <h4><a href="<?php the_field('external_url') ?>" target="_blank"><?php the_title(); ?></a></h4>
                                    <?php if(get_the_excerpt()): ?>
                                        <p class="excerpt"><?php echo get_the_excerpt() ?></p>
                                    <?php else: echo '<br/>'; endif; ?>
                                    <a href="<?php the_field('external_url') ?>" target="_blank" class="go">Watch Video (offsite)</a>
                                </div>


                            <?php else: ?>
                            <? if(get_field('vidyard_id')){ ?>
                                <? $thb = '//play.vidyard.com/' . get_field('vidyard_id') . '.jpg'; ?>
                            <? }else{ ?>
                                <?php $token = get_field('brightcove_token','options') ?>
                                <?php $details = file_get_contents('http://api.brightcove.com/services/library?command=find_video_by_id&video_id='.get_field('brightcove_id').'&video_fields=videoStillURL,length&token='.$token); ?>
                                <?php $details = json_decode($details); ?>
                                <? $thb = $details->videoStillURL; ?>
                            <? } ?>
                                <a href="<?php the_permalink() ?>" class="lb-trigger" rel="video">
                                    <img src="<?php echo $thb; ?>" width="178" alt="<?php the_title(); ?>" />
                                </a>
                                <div class="text">
                                    <h4><a href="#" class="lb-clicker"><?php the_title(); ?></a></h4>
                                    <?php if(get_the_excerpt()): ?>
                                        <p class="excerpt"><?php echo get_the_excerpt() ?></p>
                                    <?php else: echo '<br/>'; endif; ?>
                                    <a href="#" class="go lb-clicker">Watch Video</a>
                                </div>
                            <?php endif; ?>

                        </li>
                    <?php endwhile; ?>
                </ul>

            <?php endif; wp_reset_postdata(); ?>
        <?php } ?>
    </div>


<?php get_footer(); ?>
