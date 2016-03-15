<?php
/*
Template Name: Home Mar 2016
*/
get_header(); the_post();
?>
    <? if($slideshow = get_field('banner_slideshow')){
        shuffle($slideshow);
        if($slideshow[0]['acf_fc_layout'] == 'image_banner'){  // IF FIRST LAYOUT IN ARRAY IS IMAGE ?>
            <div class="cycle-slideshow" data-cycle-slides=">.home-banner" data-cycle-timeout="8000" data-cycle-prev=">.pager .prev" data-cycle-next=">.pager .next">
                <? foreach($slideshow as $slide){ ?>
                    <? if($slide['acf_fc_layout'] != 'image_banner') continue; ?>
                    <div class="home-banner" style="background-image:url(<?= $slide['banner_image']['sizes']['banner-img'] ?>)">
                        <span class="grad"></span>
                        <h1 class="logo-lg">VideoLink</h1>
                        <div>
                            <h3><?= $slide['banner_headline'] ?></h3>
                            <p><?= $slide['banner_subheadline'] ?></p>
                            <a href="#" class="more"><?= $slide['cta_link_text'] ?></a>
                        </div>
                    </div>
                <? } ?>
                <div class="pager">
                    <span class="prev"></span>
                    <span class="next"></span>
                </div>
            </div>

        <? }else{ // IF FIRST LAYOUT IS VIDEO

            if($slideshow[0]['video']){
                $video = $slideshow[0]['video'];
                $video = get_field('brightcove_id',$video->ID);
            }else{
                $video = $slideshow[0]['brightcove_id'];
            } ?>

            <div class="home-banner" class="video">
<? /*                <video preload="auto" autoplay="" loop="" id="bgvid" style="position: absolute; right: 0; top: 0; min-width: 100%; min-height: 100%; width: auto; height: auto; background-size: cover;" ><source src="/assets/vlreel.mp4" type="video/mp4"></video> */ ?>
                <script language="JavaScript" type="text/javascript" src="http://admin.brightcove.com/js/BrightcoveExperiences.js"></script>
                <object id="myExperience<?php echo $video ?>" class="BrightcoveExperience">
                    <param name="bgcolor" value="#FFFFFF" />
                    <param name="playerID" value="3167640819001" />
                    <param name="playerKey" value="AQ~~,AAABuqDKP9E~,asvTTGETRYhhyxAUsc_XNvjFowzEWTWK" />
                    <param name="isVid" value="true" />
                    <param name="isUI" value="true" />
                    <param name="dynamicStreaming" value="true" />
                    <param name="autoStart" value="true" />
                    <param name="@videoPlayer" value="<?php echo $video ?>" />
                    <!-- smart player api params -->
                    <param name="includeAPI" value="true" />
                    <param name="templateLoadHandler" value="onTemplateLoad" />
                    <param name="templateReadyHandler" value="onTemplateReady" />
                </object>
                <script type="text/javascript">brightcove.createExperiences();</script>
                <script type="text/JavaScript">
                var player, APIModules, videoPlayer, android = ( navigator.userAgent.match(/Android/g) ? true : false ),
                    iOS = ( navigator.userAgent.match(/(iPad|iPhone|iPod)/g) ? true : false );

                var onTemplateLoad = function(experienceID) {
                    player = brightcove.api.getExperience(experienceID);
                    APIModules = brightcove.api.modules.APIModules;
                };

                var onTemplateReady = function(evt) {
                    videoPlayer = player.getModule(APIModules.VIDEO_PLAYER);
                    videoPlayer.play();

                    if ( iOS, android == false) {
                        videoPlayer.addEventListener(brightcove.api.events.MediaEvent.PROGRESS, onProgress);
                    }
                    else {
                        videoPlayer.addEventListener(brightcove.api.events.MediaEvent.STOP, onStop);
                    }
                };

                var onProgress = function(evt) {
                    if ( (evt.duration - evt.position) < .25 ) {
                        videoPlayer.seek(0);
                    }
                };

                var onStop = function(evt) {
                    videoPlayer.play();
                };

                </script>

                <!-- End of Brightcove Player -->

                <span class="grad"></span>
                <h1 class="logo-lg">VideoLink</h1>
                <div>
                    <h3><?php echo $slideshow[0]['banner_headline'] ?></h3>
                    <p><?php echo $slideshow[0]['banner_subheadline'] ?></p>
                    <?php if($slideshow[0]['cta_link_text']): ?><span class="more"><?php echo $slideshow[0]['cta_link_text'] ?></span><?php endif; ?>
                </div>
            </div>

        <? } ?>
    <? } ?>

    <?php if(have_rows('tabbed_module')): $c = 1; ?>
        <div id="home-tabs">
            <ul>
                <?php while(have_rows('tabbed_module')): the_row(); $ico = get_sub_field('module_icon'); ?>
                    <li <?php echo ($c == 1 ? 'class="active" ' : '') ?>data-tabid="<?php echo $c++; ?>">
                        <div class="front" style="background-image:url(<?php echo $ico['url'] ?>);"><?php the_sub_field('module_title'); ?></div>
                        <div class="back">
                            <h3><?php the_sub_field('module_title'); ?></h3>
                            <p><?php the_sub_field('module_headline'); ?></p>
                        </div>
                    </li>
                <?php endwhile; ?>
            </ul>
        </div>

        <div id="tab-content" class="clearfix newhome">
            <div class="wrap">
                <?php $c = 1; while(have_rows('tabbed_module')): the_row(); $img = get_sub_field('module_image'); ?>
                    <div <?php echo ($c == 1 ? 'class="active" ' : '') ?>data-tabid="<?php echo $c++; ?>">
                        <div class="left-img">
                            <img src="<?php echo $img['sizes']['tab-img'] ?>" alt="<?php bloginfo('name') ?>" />
                            <span></span>
                        </div>
                        <?php the_sub_field('module_body') ?>
                        <a href="<?php the_sub_field('module_cta_link') ?>"><?php the_sub_field('module_cta_text') ?></a>
                    </div>
                <?php endwhile; ?>
            </div>
        </div>
    <?php endif; ?>

    <div id="home-featured-wrap">
        <div id="home-featured" class="wrap newhome">
            <?php if(get_field('featured_video')):
                $feat = get_field('featured_video');
                if(get_field('vidyard_id',$feat->ID)){
                    $thb = '//play.vidyard.com/' . get_field('vidyard_id',$feat->ID) . '.jpg';
                }else{

                    $thb = file_get_contents('http://api.brightcove.com/services/library?command=find_video_by_id&video_id='.get_field('brightcove_id',$feat->ID).'&video_fields=videoStillURL&token='.get_field('brightcove_token','options'));
                    $thb = json_decode($thb);
                    $thb = $thb->videoStillURL;
                } ?>

                <div class="left-img">
                    <img src="<?php echo $thb ?>" width="474" alt="<?php bloginfo('name') ?>" />
                    <span>
                        <a class="play lb-trigger" href="<?php echo get_permalink($feat->ID) ?>"></a>
                    </span>
                </div>
                <h4>Featured</h4>
                <?php the_field('featured_body') ?>
                <a href="<?= ($feat ? home_url() . '/resources-support/videos/#' . $feat->ID : get_field('featured_cta_link')); ?>"><?php the_field('featured_cta_text') ?></a>


            <?php else: ?>
                <div class="left-img">
                    <img src="<?php $img = get_field('featured_image'); echo $img['sizes']['tab-img']; ?>" alt="<?php bloginfo('name') ?>" />
                    <span></span>
                </div>
                <h4>Featured</h4>
                <?php the_field('featured_body') ?>
                <a href="<?php echo (get_field('featured_cta_link') ? get_field('featured_cta_link') : get_field('featured_cta_url')) ?>"><?php the_field('featured_cta_text') ?></a>
            <?php endif; ?>
        </div>
    </div>

    <div id="home-trending" class="wrap">
        <div class="left-img">
        <?php if($vid = get_field('trending_video')){
            $img = '//play.vidyard.com/' . get_field('vidyard_id',$vid->ID) . '.jpg';
            $play = '<a class="play lb-trigger" href="' . get_permalink($vid->ID) . '"></a>';
        }else{
            $img = get_field('trending_image'); $img = $img['sizes']['tab-img'];
            $play = '';
        } ?>
        <img width="474" src="<?php echo $img ?>" alt="<?php bloginfo('name') ?>" alt="" />
        <span>
            <?php echo $play; ?>
        </span>
        </div>
        <h4><? the_field('trending_title') ?></h4>
        <h3><? the_field('trending_headline') ?></h3>
        <p><? the_field('trending_body') ?></p>

        <? if(have_rows('trending_news')){ ?>
            <div id="trending-list" class="new clearfix">
                <? $c = 1; while(have_rows('trending_news')){ the_row(); ?>
                    <div class="<?= ($c++ % 2 == 1 ? 'odd' : 'even'); ?>">
                        <? if($logo = get_sub_field('side_image')){ $logo = $logo['sizes']['trending-side']; ?>
                            <img class="logo" src="<?= $logo ?>" alt="" />
                        <? } ?>
                        <? the_sub_field('blurb') ?>
                    </div>
                <? } ?>
            </div>
        <? } ?>
    </div>

    <?php $heading = get_field('heading');
    if(have_rows('popular_content')){ ?>
        <div id="home-popular" class="wrap">
            <h2><?php echo $heading ?></h2>
            <ul id="pop-list">
                <?php while(have_rows('popular_content')){ the_row();
                    $p = get_sub_field('post') ?>
                    <li>
                        <?php $thb = get_sub_field('thumbnail'); $thb = $thb['sizes']['pop-thb']; ?>
                        <a href="<?php echo get_permalink($p->ID) ?>">
                            <img src="<?php echo $thb ?>" alt="" />
                            <h5><?php echo $p->post_title ?></h5>
                            <span class="read"><?php the_sub_field('button_label'); ?></span>
                        </a>
                    </li>
                <?php } ?>
            </ul>
        </div>
    <?php } ?>

    <?php $clheading = get_field('logo_list_heading');
    if(have_rows('logo_list')){ ?>
        <div id="home-clients">
            <div class="wrap">
                <h2><?php echo $clheading ?></h2>
                <ul id="logo-list">
                    <?php while(have_rows('logo_list')){ the_row();
                        $logo = get_sub_field('logo'); $logo = $logo['sizes']['mono-client']; ?>
                        <li style="background-image:url(<?php echo $logo ?>)"></li>
                    <?php } ?>
                </ul>
            </div>
        </div>
    <?php } ?>


    <? if(have_rows('testimonials')){
        $quotes = get_field('testimonials');
        shuffle($quotes);
        $quote = $quotes[0];
    ?>
        <div id="home-quote-new">
            <div class="wrap">
                <h4><?= strip_tags($quote['quote_body']) ?></h4>
                <h5><?= $quote['customer_name'] ?></h5>
                <p><?= $quote['customer_title'] ?></p>
            </div>
        </div>

    <? } ?>


<?php get_footer(); ?>
