<?php
/* Template Name: Webcasts & Webinars */
get_header(); the_post();
?>

    <div id="video-player">
        <div class="wrap">
            <h2><?php the_title(); ?></h2>
            
            <div class="video-contents clearfix">

            </div>
            
        </div>
    </div>
    
        
    <div id="vcats" class="wrap webinars">
        
        <? query_posts(array(
            'post_type' => 'webinar-posts',
            'posts_per_page' => -1
        ));
        if(have_posts()){ $c = 1 ?>
        
            <h3></h3>
            <div class="vid-slide">
                <ul>
                    <? while(have_posts()){ the_post(); ?>
                        <?= ($c % 6 == 0 ? '</ul><ul>' : '') ?>
                        <li <?= ($c++ % 5 == 1 ? 'class="first"' : '') ?>>
                            <? if(get_field('external_url')){
                                $link = get_field('external_url') . '" class="external" target="_blank';
                            }else{
                                $link = get_permalink();
                            } ?>
                            <a href="<?= $link ?>" data-slug="<?= $post->post_name ?>">
                                <? if(get_field('video_thumbnail')){ ?>
                                    <? $thumbImg = get_field('video_thumbnail');
                                       $thb = $thumbImg['sizes']['blog-thb']; ?>
                                <? }elseif(get_field('vidyard_id')){ ?>
                                    <? $thb = '//play.vidyard.com/' . get_field('vidyard_id') . '.jpg'; ?>
                                <? }else{ ?>
                                    <? $token = get_field('brightcove_token','options') ?>
                                    <? $details = file_get_contents('http://api.brightcove.com/services/library?command=find_video_by_id&video_id='.get_field('brightcove_id').'&video_fields=videoStillURL,length&token='.$token); ?>
                                    <? $details = json_decode($details); ?>
                                    <pre>
                                    <?php print_r($details);?>
                                    </pre>
                                    <? $thb = $details->videoStillURL; ?>
                                <? } ?>
                                <img src="<?= $thb ?>" />
                                <h4><? the_title(); ?></h4>
                            </a>
                        </li>
                    <? } ?>
                </ul>
            </div>
        <? } ?>
    

        </div>
        
    </div>


<?php get_footer(); ?>