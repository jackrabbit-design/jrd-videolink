<?php
/* Template Name: Videos New */
get_header(); the_post();
?>

    <div id="video-player">
        <div class="wrap">
            <h2><?php the_title(); ?></h2>
            
            <div class="video-contents clearfix">

            </div>
            
        </div>
    </div>
    
    <? $cats = get_terms('vid-cats',array(
        'orderby' => 'term_order',
        'hide_empty' => false
    )); ?>
    
    <div id="blue-cats">
        <ul>
            <li><strong>Playlists:</strong></li>
            <? foreach($cats as $cat){ ?>
                <li><span data-cat="<?= $cat->slug ?>"><?= $cat->name ?></span></li>
            <? } ?>
        </ul>
    </div>
        
    <div id="vcats" class="wrap">
        
        <? foreach($cats as $cat){
            query_posts(array(
                'post_type' => 'video-posts',
                'vid-cats' => $cat->slug,
                'posts_per_page' => -1,
                'orderby' => 'menu_order',
                'order' => 'ASC'
            ));
            $t = $wp_query->post_count;
            if(have_posts()){ $c = 0 ?>
            
                <? if(is_user_logged_in()){
/* ========================================================================= */
/* !NEW CODE */
/* ========================================================================= */?>

                    <h3 data-cat="<?= $cat->slug ?>"><?= $cat->name ?></h3>
                    <div class="owl-slider vid-slide" data-cycle-slides=">.slide" data-cycle-fx="scrollHorz" data-cycle-next=".next.s<?= $s ?>" data-cycle-prev=".prev.s<?= $s ?>" data-cycle-timeout=0>
                        <? while(have_posts()){ the_post(); ?>
                            <div class="slide">
                                <a href="<?= the_permalink(); ?>" data-slug="<?= $post->post_name ?>">
                                    <? if(get_field('vidyard_id')){ ?>
                                        <span><?php the_field('video_length') ?></span>
                                        <img src="//play.vidyard.com/<? the_field('vidyard_id') ?>.jpg" />
                                    <? }else{ ?>
                                        <?php $token = get_field('brightcove_token','options') ?>
                                        <?php $details = file_get_contents('http://api.brightcove.com/services/library?command=find_video_by_id&video_id='.get_field('brightcove_id').'&video_fields=videoStillURL,length&token='.$token); ?>
                                        <?php $details = json_decode($details); ?>
                                        <span><?php the_field('video_length') ?></span>
                                        <img src="<?= $details->videoStillURL ?>" />
                                    <? } ?>
                                    <h4><? the_title(); ?></h4>
                                </a>
                            </div>
                        <? } ?>
                    </div>
                

                <?
/* ========================================================================= */
/* !END NEW CODE */
/* ========================================================================= */
                }else{

/* ========================================================================= */
/* !OLD CODE */
/* ========================================================================= */

                ?>
                    <h3 data-cat="<?= $cat->slug ?>"><?= $cat->name ?>
                        <? if($wp_query->post_count > 5){ ?>
                            <span class="prev" data-cat="<?= $cat->slug ?>"></span>
                            <span class="next" data-cat="<?= $cat->slug ?>"></span>
                        <? } ?>
                    </h3>
                    <div class="vid-slide cycle-slideshow"
                        data-cycle-slides=">ul"
                        data-cycle-prev=".prev[data-cat=<?= $cat->slug ?>]"
                        data-cycle-next=".next[data-cat=<?= $cat->slug ?>]"
                        data-cycle-timeout="0"
                        data-cycle-fx="scrollHorz"
                        data-cycle-speed=750
                    >
                        <ul>
                            <? while(have_posts()){ the_post(); ?>
                                <li <?= ($c++ % 5 == 0 ? 'class="first"' : '') ?>>
                                    <a href="<?= the_permalink(); ?>" data-slug="<?= $post->post_name ?>">
                                        <? if(get_field('vidyard_id')){ ?>
                                            <img src="//play.vidyard.com/<? the_field('vidyard_id') ?>.jpg" />
                                        <? }else{ ?>
                                            <?php $token = get_field('brightcove_token','options') ?>
                                            <?php $details = file_get_contents('http://api.brightcove.com/services/library?command=find_video_by_id&video_id='.get_field('brightcove_id').'&video_fields=videoStillURL,length&token='.$token); ?>
                                            <?php $details = json_decode($details); ?>
                                            <img src="<?= $details->videoStillURL ?>" />
                                        <? } ?>
                                        <h4><? the_title(); ?></h4>
                                    </a>
                                </li>
                                <?= ($c % 5 == 0 && $t != $c ? '</ul><ul>' : '') . " {$c}" ?>
                            <? } ?>
                        </ul>
                    </div>
<? /* ========================================================================= */
/* !END OLD CODE */
/* ========================================================================= */ ?>
                <? } ?>
            <? }
        }?>
    

        </div>
        
    </div>


<?php get_footer(); ?>