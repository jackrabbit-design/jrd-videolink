    <div id="blog-sort">
        <div class="sort cats">
            <h4>Category: <em><?php echo (get_query_var('vid-cats') ? $wp_query->queried_object->name : 'All') ?></em></h4>
            <ul>
                <li><a href="<?php echo get_permalink(44) ?>">All</a></li>
                <?php
                    wp_list_categories(array(
                        'taxonomy' => 'vid-cats',
                        'title_li' =>'',
                        'show_option_none'=>'<li><a class="none" href="#" onclick="return false">No Categories</a></li>'
                    )); 
                ?>
            </ul>
        </div>
        
        <div id="vid-search">
            <form name="search" action="<?php echo get_permalink(44) ?>" method="GET">
                <input type="text" placeholder="Search" name="vidsearch" id="vidsearch" value="" />
            </form>
        </div>
        
    </div>
