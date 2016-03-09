<?php
/* Template Name: Collateral */
get_header(); the_post(); ?>

<div id="int-banner" style="background-image:url('<?php $banner = get_field('banner_image'); $default = get_field('default_header_image','options'); echo ($banner ? $banner['sizes']['int-banner'] : $default['sizes']['int-banner']); ?>')">
    <span></span>
    <h2><?php the_title(); ?></h2>
</div>
<h2 id="int-logo"><?php bloginfo('name') ?></h2>

<?php
$topics = array();
while(the_repeater_field('collateral')):
    $v = get_sub_field('collateral_tag');
    if(!in_array($v, $topics)) array_push($topics, $v);
endwhile;
sort($topics);
?>

<? if(!is_user_logged_in()){ ?>
    <div id="blog-sort" class="collateral">
        <div class="sort cats">
            <h4>Topic: <em>All</em></h4>
            <ul>
                <li><a onclick="return false">All</a></li>
                <?php foreach($topics as $t): ?>
                    <li><a onclick="return false"><?php echo $t ?></a></li>
                <?php endforeach; ?>
            </ul>
        </div>        
    </div>
<? } ?>

<div class="wrap int clearfix">

    <?php get_sidebar('left'); ?>
    
        <article id="article" class="over-right">
            
            <?php the_content(); ?>
        
            <? /* if(!is_user_logged_in()){ ?>
                <?php if(have_rows('collateral')): ?>
                    <ul id="media" class="collateral">
                        <?php while(have_rows('collateral')): the_row(); $file = get_sub_field('collateral_file'); ?>
                            <li data-topic="<?php the_sub_field('collateral_tag'); ?>">
                                <span><?php the_sub_field('collateral_tag') ?></span>
                                <a target="_blank" href="<?php echo $file['url'] ?>" class="title"><?php the_sub_field('collateral_name') ?></a>
                                <a target="_blank" href="<?php echo $file['url'] ?>" class="read">Download File</a>
                            </li>
                        <?php endwhile; ?>
                    </ul>
                <?php endif; ?>
            <? }else{ */ ?>
            
            
                <?
                $cols = get_field('collateral');
                $tags = array();
                
                foreach($cols as $col){
                    if(!in_array($col['collateral_tag'], $tags)) $tags[] = $col['collateral_tag'];
                }
                sort($tags);
                
                foreach($tags as $tag){
                    echo "<div class=\"collateral-tags\">";
                        echo "<h3>{$tag}</h3>";
                        echo "<ul>";
                        while(have_rows('collateral')){ the_row();
                            if(get_sub_field('collateral_tag') == $tag){
                                $file = get_sub_field('collateral_file');
                                $ext = strtoupper(array_pop(explode('/',$file['mime_type'])));
                                $file = $file['url'];
                                $name = get_sub_field('collateral_name');
                                echo "<li>";
                                    echo "<a target=\"_blank\" href=\"{$file}\"><span>{$ext}</span>{$name}</a>";
                                echo "</li>";
                            }
                        }
                        echo "</ul>";
                    echo "</div>";
                }
                
                ?>
                
            
            <? // } ?>
        </article>
</div>


<?php get_footer(); ?>