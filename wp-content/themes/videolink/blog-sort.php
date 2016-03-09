    <div id="blog-sort">
        <div class="sort cats">
            <h4>Category: <em><?php echo (get_query_var('category_name') ? $wp_query->queried_object->name : 'All') ?></em></h4>
            <ul>
                <li><a href="<?php echo get_permalink(49) ?>">All</a></li>
                <?php
                    wp_list_categories(array(
                        'taxonomy' => 'category',
                        'title_li' =>'',
                        'show_option_none'=>'<li><a class="none" href="#" onclick="return false">No Categories</a></li>'
                    )); 
                ?>
            </ul>
        </div>
        
        <div class="sort cats">
            <h4>Topic: <em><?php echo (get_query_var('tag') ? $wp_query->queried_object->name : 'All') ?></em></h4>
            <ul>
                <li><a href="<?php echo get_permalink(49) ?>">All</a></li>
                <?php
                    wp_list_categories(array(
                        'taxonomy' => 'post_tag',
                        'title_li' =>'',
                        'show_option_none'=>'<li><a class="none" href="#" onclick="return false">No Tags</a></li>'
                    )); 
                ?>
            </ul>
        </div>
        
        <div class="sort authors">
            <h4>Author: <em><?php echo (isset($_GET['auth']) ? get_the_author_meta('display_name',$_GET['auth']) : 'All'); ?></em></h4>
            <ul>
                <li><a href="<?php echo get_permalink(49) ?>">All</a></li>
                <?php jrd_list_authors(); ?>
            </ul>
        </div>
        
        <a class="rss" href="<?php bloginfo('rss2_url'); ?>">Subscribe<span class="social-rss"></span></a>
        
    </div>