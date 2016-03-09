<?php get_header();  ?>

<div id="int-banner" style="background-image:url('<?php $banner = get_field('banner_image'); $default = get_field('default_header_image','options'); echo ($banner ? $banner['sizes']['int-banner'] : $default['sizes']['int-banner']); ?>')">
    <span></span>
    <h2>404: Not Found</h2>
</div>
<h2 id="int-logo"><?php bloginfo('name') ?></h2>

<div class="wrap int clearfix">


    <?php if(get_field('sidebar_modules')): ?>
        <?php get_sidebar('right'); ?>
    <?php endif; ?>
    
    <article id="article" <?php echo (get_field('sidebar_modules') ? '' : ' class="over-right"') ?>>

        <h3>We're sorry, the page you are looking for could not be found.</h3>
        <p><a href="<?php bloginfo('url') ?>">Take me back home.</a></p>
            
    </article>
</div>


<?php get_footer(); ?>