<?php if(is_user_logged_in()){
if(have_rows('pre_footer_fields')){
    while(have_rows('pre_footer_fields')){ the_row();

        if(get_row_layout() == 'testimonials'){

            if($quotes = get_sub_field('testimonials')){
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

            <? }

        }elseif(get_row_layout() == 'news_events'){

            ?>
            <div id="pre-news">
                <div class="wrap">
                    <h3>News &amp; Events</h3>
                    <?php query_posts(array(
                        'post_type' => 'news-posts',
                        'post_status' => 'publish',
                        'posts_per_page' => 3
                    ));
                    if(have_posts()){ ?>
                        <?php while(have_posts()){ the_post(); $cat = wp_get_post_terms( $post->ID, 'news-cats'); ?>
                            <div class="news">
                                <span><?php echo get_the_date('m.j.y') . ($cat ? ' - ' . $cat[0]->name : '') ?></span>
                                <a href="<?php the_permalink() ?>" class="title"><?php the_title() ?></a>
                                <a href="<?php the_permalink() ?>" class="read">Read Article</a>
                            </div>
                        <?php }
                    } wp_reset_query(); ?>
                </div>
            </div>
            <?

        }elseif(get_row_layout() == 'related_videos'){

            ?>
            <div id="pre-videos">
                <div class="wrap">
                    <h3>Related Videos</h3>

                    <?php if($vids = get_sub_field('related_videos')){
                        foreach($vids as $post){
                            setup_postdata($post);

                            ?>
                            <div class="vid">

                                <a href="<?= get_permalink(3651) . '#' . basename(get_permalink()); ?>" data-slug="<?= $v->post_name ?>">
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
                            <?
                        wp_reset_postdata(); }
                    } ?>
                </div>
            </div>
            <?php

        }

    }
}
}
