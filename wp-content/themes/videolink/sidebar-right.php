<?php if(get_field('sidebar_modules') || is_page_template('template-featured.php')): ?>
    <aside id="right">
    
        <?php if(is_page_template('template-featured.php')): ?>
            <div id="feat-nav">
                <?php if($sbLogo = get_field('sidebar_logo')):
                    echo '<img src="'.$sbLogo['sizes']['feat-logo'].'" alt="'.get_field('sidebar_title').'" />';
                else:
                    echo '<h3>'.get_field('sidebar_title').'</h3>';
                endif; ?>
                <hr />
                <h4><?php the_field('sidebar_subtitle') ?></h4>
                <?php if(have_rows('links')):
                    echo '<ul>';
                    while(have_rows('links')): the_row();
                        echo '<li><a href="'.get_sub_field('link_url').'">'.get_sub_field('link_title').'</a></li>';
                    endwhile;
                    echo '</ul>';
                endif; ?>
            </div>
        <?php endif; ?>
    
        <?php while(has_sub_field('sidebar_modules')): $module = get_row_layout(); ?>
            <?php switch($module){

                case 'recent_news':
                    ?>
                    <div id="recent-news">
                        <h3><a href="<?php echo get_permalink(20) ?>">&#8226; &#8226; &#8226;</a>Recent News</h3>
                        <?php query_posts('posts_per_page=3&post_type=post&post_status=publish'); ?>
                        <?php if(have_posts()): ?>
                        <ul>
                            <?php while(have_posts()): the_post(); ?>
                            <li>
                                <a href="<?php the_permalink() ?>"><?php the_title(); ?></a>
                                <small><?php echo get_the_date('m.d.y'); ?></small>
                            </li>
                            <?php endwhile; ?>
                        </ul>
                        <?php endif; wp_reset_query(); ?>
                    </div>
                    <?php
                break;
                
                case 'testimonials':
                    
                    continue; //CONTINUE TO NEXT
                    
                	$repeater = get_sub_field( 'testimonials' );
                	$random_rows = array_rand( $repeater, 1 );
                    //echo 'Sub Field 1: ' . $repeater[$random_rows]['sub_field_1'] . '<br/>';

                    ?>
                    <?php $vid = $repeater[$random_rows]['video_testimonial']; ?>
                    <div id="side-quote">
                    
                        <?php if($vid): ?>
                            <?php $img = get_field('video_thumbnail',$vid->ID) ?>
                            <div class="quote-img">
                                <? if(get_field('vidyard_id', $vid->ID)){ ?>
                                    <? $thb = '//play.vidyard.com/' . get_field('vidyard_id',$vid->ID) . '.jpg'; ?>
                                <? }else{ ?>
                                    <?php $token = get_field('brightcove_token','options') ?>
                                    <?php $details = file_get_contents('http://api.brightcove.com/services/library?command=find_video_by_id&video_id='.get_field('brightcove_id',$vid->ID).'&video_fields=videoStillURL&token='.$token); ?>
                                    <?php $details = json_decode($details); ?>
                                    <? $thb = $details->videoStillURL; ?>
                                <? } ?>
                                <a href="<?php echo get_permalink($vid->ID) ?>" class="lb-trigger testimonial">
                                    <img src="<?php echo $thb; ?>" width="250" alt="<?php echo $vid->post_title ?>" />
                                </a>
                                <span></span>

                                <span></span>
                            </div>
                            <?php echo ($repeater[$random_rows]['heading'] ? '<h4>' . $repeater[$random_rows]['heading'] . '</h4>' : '<h4>'.$vid->post_title.'</h4>' ) ?>
                            <blockquote><?php echo ($repeater[$random_rows]['body'] ? $repeater[$random_rows]['body'] : $vid->post_excerpt) ?>
                                <cite>
                                    <?php echo $repeater[$random_rows]['client_name'] ?>
                                    <small><?php echo $repeater[$random_rows]['client_title'] ?></small>
                                </cite>
                            </blockquote>
                            
                    
                        <?php else: ?>
                            <?php $img = $repeater[$random_rows]['image']['sizes']; ?>
                            <div class="quote-img<?php echo ($img ? '' : ' noimg') ?>">
                                <?php if($img){ ?>
                                    <?php $type = $repeater[$random_rows]['image_type']; ?>
                                    <img src="<?php echo $img[($type == 'Logo' ? 'quote-logo' : 'quote-photo')]; ?>" style="<?php echo ($type == 'Logo' ? 'padding:20px; background:#fff;' : '') ?>" alt="<?php echo $repeater[$random_rows]['client_name'] ?>" />
                                    <span></span>
                                <?php } ?>
                            </div>
                            <?php echo ($repeater[$random_rows]['heading'] ? '<h4>' . $repeater[$random_rows]['heading'] . '</h4>' : '' ) ?>
                            <blockquote><?php echo $repeater[$random_rows]['body'] ?>
                                <cite>
                                    <?php echo $repeater[$random_rows]['client_name'] ?>
                                    <small><?php echo $repeater[$random_rows]['client_title'] ?></small>
                                </cite>
                            </blockquote>
                        <?php endif; ?>
                    </div>
                    <?php
                break;
                
                case 'featured_content':
                    ?>
                    <div id="side-video">
                        <?php $feat = get_sub_field('featured_video'); ?>
                        <? if(get_field('vidyard_id', $feat->ID)){ ?>
                            <? $thb = '//play.vidyard.com/' . get_field('vidyard_id',$feat->ID) . '.jpg'; ?>
                        <? }else{ ?>
                            <?php $token = get_field('brightcove_token','options') ?>
                            <?php $details = file_get_contents('http://api.brightcove.com/services/library?command=find_video_by_id&video_id='.get_field('brightcove_id',$feat->ID).'&video_fields=videoStillURL&token='.$token); ?>
                            <?php $details = json_decode($details); ?>
                            <? $thb = $details->videoStillURL; ?>
                        <? } ?>
                        <a href="<?= get_permalink($feat->ID) ?>" class="lb-trigger">
                            <img src="<?php echo $thb ?>" width="250" />
                        </a>
                        <p>
                            <?php echo $feat->post_excerpt; ?>
                            <a href="<?= get_permalink($feat->ID) ?>" class="lb-trigger">Watch Video</a>
                        </p>                        
                    </div>
                    <?php
                break;
                
                case 'contact':
                    echo 'Future home of Contact';
                break;
                
                case 'quotes_new':
                    if(have_rows('quotes')){ 
                        $t = 0; while(have_rows('quotes')){ the_row(); $t++; };
                        $class = ($t > 1 ? 'class="slideshow"' : '');
                    ?>
                       
                       <div id="quote-slide" <?= $class ?>>
                           <? while(have_rows('quotes')){ the_row() ?>
                               <div class="slide">
                                   <h5><? the_sub_field('quote_title') ?></h5>
                                   <p><? the_sub_field('quote_body') ?></p>
                                   <h6><? the_sub_field('customer_name') ?></h6>
                                   <p><? the_sub_field('customer_title') ?></p>
                               </div>
                            <? } ?>
                       </div>
                        
                    <? }
                break;
                default:
                break;
            } ?>
            
        <?php endwhile; ?>    
    </aside>
<?php endif; ?>
