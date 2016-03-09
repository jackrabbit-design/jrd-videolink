<?php
/*
Template Name: Home
*/
get_header(); the_post();
?>

    <?php if(get_field('banner_slideshow')): 
        $repeater = get_field( 'banner_slideshow' ); 
        $random_row = array_rand( $repeater, 1 );
        $layout = $repeater[$random_row]['acf_fc_layout'];
        
        if($layout == 'image_banner'):
        
            $bannerImg = $repeater[$random_row]['banner_image'];
            ?>
            
            <div class="home-banner" style="background-image:url(<?php echo $bannerImg['sizes']['banner-img'] ?>);">
                <span class="grad"></span>
                <h1 class="logo-lg">VideoLink</h1>
                <div>
                    <h3><?php echo $repeater[$random_row]['banner_headline'] ?></h3>
                    <p><?php echo $repeater[$random_row]['banner_subheadline'] ?></p>
                    <span class="more"><?php echo $repeater[$random_row]['cta_link_text'] ?></span>
                </div>
            </div>
            
        <?php else:
            if($repeater[$random_row]['video']){
                $video = $repeater[$random_row]['video'];
                $video = get_field('brightcove_id',$video->ID);
            }else{
                $video = $repeater[$random_row]['brightcove_id'];
            }
        ?>
        
            <div class="home-banner" class="video">
                                
                
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
    
    <!-- 
    This script tag will cause the Brightcove Players defined above it to be created as soon
    as the line is read by the browser. If you wish to have the player instantiated only after
    the rest of the HTML is processed and the page load is complete, remove the line.
    -->
    <script type="text/javascript">brightcove.createExperiences();</script>
    
<script type="text/JavaScript">
      var player,
        APIModules,
        videoPlayer,
        android = ( navigator.userAgent.match(/Android/g) ? true : false ),
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
                    <h3><?php echo $repeater[$random_row]['banner_headline'] ?></h3>
                    <p><?php echo $repeater[$random_row]['banner_subheadline'] ?></p>
                    <?php if($repeater[$random_row]['cta_link_text']): ?><span class="more"><?php echo $repeater[$random_row]['cta_link_text'] ?></span><?php endif; ?>
                </div>
            </div>
    
        <?php endif;
    endif; ?>

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
    
    <?php if(get_field('testimonials')): ?>
    <div id="home-quote">
        <div class="wrap">
            <?php
            $default = get_field('default_thumbnail');
            $repeater = get_field( 'testimonials' ); 
            $random_row = array_rand( $repeater, 1 );
            $img = $repeater[$random_row]['quote_image']; ?>
            <div>
                <div class="quote-img">
                
                    <?php if($repeater[$random_row]['video']): ?>
                        
                        <?php $tv = $repeater[$random_row]['video'] ?>
                        <?php
                            $thb = file_get_contents('http://api.brightcove.com/services/library?command=find_video_by_id&video_id='.get_field('brightcove_id',$tv->ID).'&video_fields=videoStillURL&token='.get_field('brightcove_token','options'));
                            $thb = json_decode($thb);
                        ?>
                        
                        <div style="background-image:url(<?php echo $thb->videoStillURL ?>); background-size:474px auto;" class="noimg">
                            <a class="play lb-trigger" href="<?php echo $tv->guid ?>"></a>
                        </div>
                        <span></span>

                        
                        
                        
                    <?php else: ?>
                        <?php if($repeater[$random_row]['image_type'] == 'Photo'): ?>
                            <img src="<?php echo ($img ? $img['sizes']['tab-img'] : $default['sizes']['tab-img']) ?>" alt="<?php echo $repeater[$random_row]['customer_name'] ?>" />
                        <?php else: ?>
                            <div style="background-image:url(<?php echo $img['sizes']['tab-img'] ?>);" class="noimg"></div>
                        <?php endif; ?>
                        <span></span>
                    <?php endif; ?>
                </div>
                <h3><?php echo $repeater[$random_row]['quote_body'] ?></h3>
                <blockquote>
                    <?php if($repeater[$random_row]['customer_name']): ?>
                        <cite><?php echo $repeater[$random_row]['customer_name'] ?>
                            <small><?php echo $repeater[$random_row]['customer_title'] ?></small>
                        </cite>
                    <?php endif; ?>
                </blockquote>
                <? if($link = $repeater[$random_row]['cta_link']){ ?>
                <p><a href="<?= $link ?>"><?= ($repeater[$random_row]['cta_text'] ? $repeater[$random_row]['cta_text'] : 'Learn More Now') ?></a></p>
                <? } ?>
            </div>
        </div>
    </div>
    <?php endif; ?>
    
    <div id="home-featured" class="wrap">
        <?php if(get_field('featured_video')):
            $feat = get_field('featured_video');
            $thb = file_get_contents('http://api.brightcove.com/services/library?command=find_video_by_id&video_id='.get_field('brightcove_id',$feat->ID).'&video_fields=videoStillURL&token='.get_field('brightcove_token','options'));
            $thb = json_decode($thb);
            ?>
        
            <div class="left-img">
                <img src="<?php echo $thb->videoStillURL ?>" width="474" alt="<?php bloginfo('name') ?>" />
                <span></span>
                <a class="play lb-trigger" href="<?php echo $feat->guid ?>"></a>
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