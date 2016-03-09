<?php
/*
Template Name: Home New
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
    
        <div id="tab-content" class="clearfix">
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
    
    <?php if(have_rows('testimonials')): ?>
        <div id="home-quote"><div class="wrap cycle-slideshow" data-cycle-slides=">.slide" data-cycle-timeout="0" data-cycle-prev=">.control.prev" data-cycle-next=">.control.next">
            <span class="control prev"></span><span class="control next"></span>
            <? while(have_rows('testimonials')): the_row(); ?>
                <div class="slide">
                    <?php
                    $default = get_field('default_thumbnail');
                    $img = get_sub_field('quote_image'); ?>
                    <div>
                        <div class="quote-img">
                        
                            <?php if(get_sub_field('video')): ?>
                                
                                <?php $tv = get_sub_field('video') ?>
                                <?php if(get_field('vidyard_id',$tv->ID)){
                                    $thb = '//play.vidyard.com/' . get_field('vidyard_id',$tv->ID) . '.jpg';
                                }else{
                                    $thb = file_get_contents('http://api.brightcove.com/services/library?command=find_video_by_id&video_id='.get_field('brightcove_id',$tv->ID).'&video_fields=videoStillURL&token='.get_field('brightcove_token','options'));
                                    $thb = json_decode($thb);
                                    $thb = $thb->videoStillURL;
                                }
                                ?>
                                
                                <div style="background-image:url(<?php echo $thb ?>); background-size:474px auto;" class="noimg">
                                    <a class="play lb-trigger" href="<?php echo get_permalink($tv->ID) ?>"></a>
                                </div>
                                <span></span>
        
                                
                                
                                
                            <?php else: ?>
                                <?php if(get_sub_field('image_type') == 'Photo'): ?>
                                    <img src="<?php echo ($img ? $img['sizes']['tab-img'] : $default['sizes']['tab-img']) ?>" alt="<?php echo get_sub_field('customer_name') ?>" />
                                <?php else: ?>
                                    <div style="background-image:url(<?php echo $img['sizes']['tab-img'] ?>);" class="noimg"></div>
                                <?php endif; ?>
                                <span></span>
                            <?php endif; ?>
                        </div>
                        <h3><?php echo get_sub_field('quote_body') ?></h3>
                        <blockquote>
                            <?php if(get_sub_field('customer_name')): ?>
                                <cite><?php echo get_sub_field('customer_name') ?>
                                    <small><?php echo get_sub_field('customer_title') ?></small>
                                </cite>
                            <?php endif; ?>
                        </blockquote>
                        <? if($link = get_sub_field('cta_link')){ ?>
                        <p><a href="<?= $link ?>"><?= (get_sub_field('cta_text') ? get_sub_field('cta_text') : 'Learn More Now') ?></a></p>
                        <? } ?>
                    </div>
                </div>
            <? endwhile; ?>
        </div></div>
    <?php endif; ?>
    
    <div id="home-featured" class="wrap">
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
                <span></span>
                <a class="play lb-trigger" href="<?php echo get_permalink($feat->ID) ?>"></a>
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


<?php get_footer(); ?>