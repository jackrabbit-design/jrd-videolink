<?php get_header(); the_post(); ?>

<div id="int-banner" style="background-image:url('<?php $banner = get_field('banner_image',17); $default = get_field('default_header_image','options'); echo ($banner ? $banner['sizes']['int-banner'] : $default['sizes']['int-banner']); ?>')">
    <span></span>
    <h2><?php the_title(); ?></h2>
</div>
<h2 id="int-logo"><?php bloginfo('name') ?></h2>

<div class="wrap int clearfix">

    <aside id="left">
        <h3 class="subnav-title"><a href="<?php echo get_permalink(17) ?>"><?php echo get_the_title(17) ?></a></h3>
        <?php query_posts(array(
            'post_type' => 'team-posts',
            'orderby' => 'menu_order',
            'order' => 'ASC'
        ));
        if(have_posts()): $postID = $post->ID;?>
            <ul id="subnav"><li class="current-menu-item"><ul>
                <?php while(have_posts()): the_post(); ?>
                    <li<?php echo ($postID == $post->ID ? ' class="current-menu-item"' : '') ?>><a href="<?php the_permalink(); ?>"><?php the_title() ?></a>
                <?php endwhile; ?>
            </li></li></ul>
        <?php endif; wp_reset_query(); ?>
    </aside>
    
    <article id="article" class="over-right bio">

        <h3><?php the_title() ?></h3>
        <h4><?php the_field('company_title') ?><?php if(get_field('email_address')){ ?> <span>&#8226;</span> <a href="mailto:<?php the_field('email_address') ?>">Send an Email</a><?php } ?></h4>
        <?php $headshot = get_field('bio_image'); ?>
        <?php if($headshot): ?>
            <div id="bio-vid">
                <? if(get_field('vidyard_id') != ''){ ?>
                    <a class="vid-time lb-trigger" href="/ui/inc/vidyard.php?id=<?php the_field('vidyard_id') ?>&name=<?php the_title(); ?>"><?php the_field('video_length') ?></a>
                <? }else{ ?>
                    <?php if(get_field('video_id')): ?>
                        <?php $token = get_field('brightcove_token','options') ?>
                        <?php $details = file_get_contents('http://api.brightcove.com/services/library?command=find_video_by_id&video_id='.get_field('video_id').'&video_fields=length,videoStillURL&token='.$token); ?>
                        <?php $details = json_decode($details);
                        $input = $details->length;
                        $input = floor($input / 1000);
                        $seconds = $input % 60;
                        $input = floor($input / 60);
                        $minutes = $input % 60;
                        ?>
                        <a class="vid-time lb-trigger" href="/ui/inc/video.php?id=<?php the_field('video_id') ?>&name=<?php the_title(); ?>"><?php echo $minutes . ':' . $seconds; ?></a>
                    <?php endif; ?>
                <? } ?>
                <img src="<?php echo $headshot['sizes']['bio-img'] ?>" alt="<?php the_title() ?>" />
            </div>
        
        
            <div id="bio-text">
                <?php the_content() ?>
            </div>
            <div class="clearfix"></div>
        <?php else: the_content(); endif; ?>
        
    </article>
        
    <div style="display:none">
        <div id="lb-video">
            <div style="height:407px">
                <? if(get_field('vidyard_id') != ''){ ?>
                
                    <script type="text/javascript" id="vidyard_embed_code_<? the_field('vidyard_id') ?>" src="//play.vidyard.com/<? the_field('vidyard_id') ?>.js?v=3.1&type=inline&width=725&height=407"></script>
                    <script src="//play.vidyard.com/v0/google-analytics.js"></script>
                
                <? }else{ ?>

                
                    <!-- Start of Brightcove Player -->
                    <script language="JavaScript" type="text/javascript" src="http://admin.brightcove.com/js/BrightcoveExperiences.js"></script>
                    <object id="myExperience<?php the_field('video_id') ?>" class="BrightcoveExperience">
                      <param name="bgcolor" value="#FFFFFF" />
                      <param name="width" value="725" />
                      <param name="height" value="407" />
                      <param name="wmode" value="opaque" />
                      <param name="playerID" value="3167640819001" />
                      <param name="playerKey" value="AQ~~,AAABuqDKP9E~,asvTTGETRYhhyxAUsc_XNvjFowzEWTWK" />
                      <param name="isVid" value="true" />
                      <param name="isUI" value="true" />
                      <param name="dynamicStreaming" value="true" />
                      <param name="@videoPlayer" value="<?php the_field('video_id') ?>" />
                    </object>
                    <!-- <script type="text/javascript">brightcove.createExperiences();</script> -->
                    <!-- End of Brightcove Player -->
                <? } ?>
            </div>
            <div id="lb-text">
                <h3><?php the_title() ?></h3>
                <?php the_content() ?>
            </div>
        </div>
    </div>

</div>


<?php get_footer(); ?>