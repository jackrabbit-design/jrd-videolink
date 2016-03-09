<aside id="left">
    <h3 class="subnav-title"><?php $anc = get_ancestors(get_the_ID(),'page'); $count = count($anc); if($count > 0){ $anc_pg = get_post($anc[($count - 1)]); ?>
        <?php echo '<a href="' . get_permalink($anc_pg->ID) . '">' . $anc_pg->post_title . '</a>'; } else the_title(); ?>
    </h3>
    <?php wp_nav_menu(array('theme_location' => 'main-menu', 'container' => '', 'menu_class' => 'menu', 'menu_id' => 'subnav', 'depth' => 3)); ?>
</aside>