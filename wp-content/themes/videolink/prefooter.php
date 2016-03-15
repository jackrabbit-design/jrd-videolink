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
                    <?php if($items = get_sub_field('items_to_show')){

                        foreach($items as $post){
                            setup_postdata($post);
                            $cat = wp_get_post_terms( $post->ID, 'news-cats'); ?>
                            <div class="news">
                                <span><?php echo get_the_date('m.j.y') . ($cat ? ' - ' . $cat[0]->name : '') ?></span>
                                <a href="<?php the_permalink() ?>" class="title"><?php the_title() ?></a>
                                <a href="<?php the_permalink() ?>" class="read">Read Article</a>
                            </div>
                            <?php wp_reset_postdata();
                        }

                    }else{
                        query_posts(array(
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
                        } wp_reset_query();
                    } ?>
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

        }elseif(get_row_layout() == 'media_text'){ ?>

            <div id="media-text" class="<?php the_sub_field('background_color'); ?>">
                <div class="wrap">

                    <div class="media <?php the_sub_field('media_position') ?>">

                        <?php if(get_sub_field('image_or_video') == 'image'){
                            $img = get_sub_field('image');
                            $thb = $img['sizes']['tab-img'];
                        }else{
                            $feat = get_sub_field('video');
                            $thb = '//play.vidyard.com/' . get_field('vidyard_id',$feat->ID) . '.jpg';
                        } ?>

                        <img src="<?php echo $thb; ?>" alt="<?php bloginfo('name') ?>" />
                        <span>
                            <a class="play lb-trigger" href="<?php echo get_permalink($feat->ID) ?>"></a>
                        </span>
                    </div>
                    <?php the_sub_field('content'); ?>
                </div>

            </div>

        <?php }

    }
}
}
