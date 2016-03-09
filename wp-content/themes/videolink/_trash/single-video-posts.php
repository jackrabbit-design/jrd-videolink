<!DOCTYPE html>
<html lang="en" class="lb">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=Edge"/><meta name="MSSmartTagsPreventParsing" content="true" />
    <?php if (is_front_page()) { ?><title><?php bloginfo('name'); ?></title>
    <?php } else { ?><title><?php wp_title(''); ?> | <?php bloginfo('name'); ?></title><?php }; ?>
	<link type="text/css" rel="stylesheet" media="all" href="<?php bloginfo('url') ?>/ui/css/style.css" />
    <link type="text/plain" rel="author" href="<?php bloginfo('url') ?>/authors.txt" />
    <link type="image/x-icon" rel="shortcut icon" href="<?php bloginfo('url') ?>/favicon.ico" />
    <script src="<?php bloginfo('url') ?>/ui/js/modernizr.js"></script>
    <script src="<?php bloginfo('url') ?>/ui/js/jquery.js" type="text/javascript"></script>
    <?php wp_head(); ?>
</head>
<body>

<? if(is_user_logged_in()){ ?>
    <div id="lb-video">
        <div class="video">
            <!-- Start of Brightcove Player -->
            <script language="JavaScript" type="text/javascript" src="http://admin.brightcove.com/js/BrightcoveExperiences.js"></script>
            <object id="myExperience<?= get_field('brightcove_id') ?>" class="BrightcoveExperience">
              <param name="bgcolor" value="#FFFFFF" />
              <param name="width" value="650" />
              <param name="height" value="366" />
              <param name="wmode" value="opaque" />
              <param name="playerID" value="3167640819001" />
              <param name="playerKey" value="AQ~~,AAABuqDKP9E~,asvTTGETRYhhyxAUsc_XNvjFowzEWTWK" />
              <param name="isVid" value="true" />
              <param name="isUI" value="true" />
              <param name="dynamicStreaming" value="true" />
              <param name="@videoPlayer" value="<?= get_field('brightcove_id') ?>" />
            </object>
            <script type="text/javascript">brightcove.createExperiences();</script>
            <!-- End of Brightcove Player -->
        </div>
        <div id="lb-text" class="info">
            <h3><?= get_the_title() ?></h3>
            <p><?= get_the_excerpt() ?></p>
        </div>
        <div class="up-next">
            <? $post = get_adjacent_post(false,'',true); ?>
            <? setup_postdata($post); ?>
            <a href="<?= the_permalink(); ?>" data-slug="<?= $post->post_name ?>">
                <?php $token = get_field('brightcove_token','options') ?>
                <?php $details = file_get_contents('http://api.brightcove.com/services/library?command=find_video_by_id&video_id='.get_field('brightcove_id').'&video_fields=videoStillURL,length&token='.$token); ?>
                <?php $details = json_decode($details); ?>
                <img src="<?= $details->videoStillURL ?>" />
                <h6>Up Next</h6>
                <h4><? the_title(); ?></h4>
            </a>
            <? wp_reset_postdata(); ?>
        </div>
    </div>
    
<? }else{ ?>

<?php echo '
    <div id="lb-video">
        <div style="height:407px">
            <!-- Start of Brightcove Player -->
            <script language="JavaScript" type="text/javascript" src="http://admin.brightcove.com/js/BrightcoveExperiences.js"></script>
            <object id="myExperience' . get_field('brightcove_id') . '" class="BrightcoveExperience">
              <param name="bgcolor" value="#FFFFFF" />
              <param name="width" value="725" />
              <param name="height" value="407" />
              <param name="wmode" value="opaque" />
              <param name="playerID" value="3167640819001" />
              <param name="playerKey" value="AQ~~,AAABuqDKP9E~,asvTTGETRYhhyxAUsc_XNvjFowzEWTWK" />
              <param name="isVid" value="true" />
              <param name="isUI" value="true" />
              <param name="dynamicStreaming" value="true" />
              <param name="@videoPlayer" value="' . get_field('brightcove_id') . '" />
            </object>
            <!-- <script type="text/javascript">brightcove.createExperiences();</script> -->
            <!-- End of Brightcove Player -->
        </div>
        <div id="lb-text">
            <h3>' . get_the_title() . '</h3>
            <p>' . get_the_excerpt() . '</p>
        </div>
    </div>'; ?>
<? } ?>
    
</body>

<script type="text/javascript">var isInIframe = (window.location != window.parent.location) ? true : false;
    if(isInIframe == false){
        $('#lb-video').addClass('noiframe');
    };
</script>

</html>