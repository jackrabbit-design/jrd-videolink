<?php get_header(); ?>

<div id="int-banner" style="background-image:url('<?php $banner = get_field('default_header_image','options'); echo $banner['sizes']['int-banner']; ?>')">
    <span></span>
    <h2>Search</h2>
</div>
<h2 id="int-logo"><?php bloginfo('name') ?></h2>

<div id="search-head">
    <div class="wrap">
        <?php /* if(have_posts()){ ?>
            <div class="filter">
                <h3>Sort by: <b>Relevance</b></h3>
            </div>
        <?php } */ ?>
        <p><?php echo $wp_query->found_posts ?> Results for "<?php echo get_query_var('s') ?>"</p>
    </div>
</div>

<!--
<pre>
<?php print_r($wp_query);?>
</pre>
-->

<div class="wrap int clearfix">

    <?php if(have_posts()): ?>
        <ul id="search-results" class="query-results">
            <?php while(have_posts()):
                the_post();
                $class = '';
                switch($post->post_type){

                    case 'news-posts':
                        $cat = wp_get_post_terms( $post->ID, 'news-cats');
                        $p = $cat[0]->name;
                        $r = 'Read Post';
                    break;
                    case 'team-posts':
                        $p = 'Team Member';
                        $r = 'Read Bio';
                    break;
                    case 'post':
                        $p = 'Blog Post';
                        $r = 'Read Post';
                    break;
                    case 'page':
                        $p = 'Page';
                        $r = 'View Page';
                    break;
                    case 'story-posts':
                        $p = 'Success Story';
                        $r = 'Read Story';
                    break;
                    case 'video-posts':
                        $p = 'Video';
                        $r = 'Watch Video';
                        $class = 'lb-trigger';
                    break;
                    case 'webinar-posts':
                        $p = 'Webinar';
                        $r = 'Watch Webinar';
                        $class = 'lb-trigger';
                    break;
                    default:
                        $p = '?';
                        $r = 'View Page';
                    break;

                };
                ?>
                <li>
                    <span><?php echo $p; ?></span>
                    <a href="<?php the_permalink() ?>" class="<?php echo $class ?> title"><?php the_title() ?></a>
                    <a href="<?php the_permalink() ?>" class="<?php echo $class ?> read"><?php echo $r; ?></a>
                </li>
            <?php endwhile; ?>
        </ul>
        <div class="loadmore"><?php next_posts_link('Load More') ?></div>
    <?php else:
        ?><article id="article"><h5>Sorry, your search did not yield any results.</h5></article><?php
    endif; wp_reset_query(); ?>

</div>

<div id="search-again">

    <form role="search" method="get" action="<?php echo home_url( '/' ); ?>">
        <label for="s2">Didn't find anything?</label>
        <input type="text" value="" name="s" id="s2" placeholder="Search again..." />
    </form>
</div>


<?php get_footer(); ?>
