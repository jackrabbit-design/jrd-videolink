<?php

// Team Members
$n = 'Team';
$s = 'Team Member';
$p = 'Team Members';
register_post_type(
	'team-posts', array(
		'labels' => array(
	       'name' => $n,
	       'singular_name' => $s,
	       'add_new' => 'Add a ' . $s,
	       'add_new_item' => 'Add a ' . $s,
	       'edit_item' => 'Edit ' . $s,
	       'search_items' => 'Search ' . $p,
	       'not_found' => 'No ' . $p . ' found',
	       'not_found_in_trash' => 'No ' . $p . ' found in trash'
	    ),
		'public' => true,
		'show_ui' => true,
		'capability_type' => 'post',
		'hierarchical' => true,
		'query_var' => true,
		'show_in_nav_menus' => true,
		'exclude_from_search' => false,
		'has_archive' => false,
		'supports' => array(
			'title', 
			'editor',
			'thumbnail',
			'excerpt',
			'revisions'
		)
	)
);

// Team Members
$n = 'Success Stories';
$s = 'Success Story';
$p = 'Success Stories';
register_post_type(
	'story-posts', array(
		'labels' => array(
	       'name' => $n,
	       'singular_name' => $s,
	       'add_new' => 'Add a ' . $s,
	       'add_new_item' => 'Add a ' . $s,
	       'edit_item' => 'Edit ' . $s,
	       'search_items' => 'Search ' . $p,
	       'not_found' => 'No ' . $p . ' found',
	       'not_found_in_trash' => 'No ' . $p . ' found in trash'
	    ),
		'public' => true,
		'show_ui' => true,
		'capability_type' => 'post',
		'hierarchical' => true,
		'query_var' => true,
		'show_in_nav_menus' => true,
		'exclude_from_search' => false,
		'has_archive' => false,
		'supports' => array(
			'title', 
			'editor',
			'thumbnail',
			'excerpt',
			'revisions'
		)
	)
);

// News
$n = 'News';
$s = 'News Post';
$p = 'News Posts';
register_post_type(
	'news-posts', array(
		'labels' => array(
	       'name' => $n,
	       'singular_name' => $s,
	       'add_new' => 'Add a ' . $s,
	       'add_new_item' => 'Add a ' . $s,
	       'edit_item' => 'Edit ' . $s,
	       'search_items' => 'Search ' . $p,
	       'not_found' => 'No ' . $p . ' found',
	       'not_found_in_trash' => 'No ' . $p . ' found in trash'
	    ),
		'public' => true,
		'show_ui' => true,
		'capability_type' => 'post',
		'hierarchical' => true,
		'query_var' => true,
		'show_in_nav_menus' => true,
		'exclude_from_search' => false,
		'has_archive' => false,
		'supports' => array(
			'title', 
			'editor',
			'thumbnail',
			'excerpt',
			'revisions'
		)
	)
);

// News Categories
register_taxonomy(
	'news-cats', array('news-posts'), array( 
		'hierarchical' => true, // Category or Tag functionality
		'query_var' => true,
		'rewrite' => array('slug' => 'news-cat'),
		'labels' => array(
		     'name' => 'Categories',
		     'singular_name' => 'Category',
		     'search_items' => 'Search Categories',
		     'popular_items' => 'Popular Categories',
		     'all_items' => 'All Categories',
		     'parent_item' => null,
		     'parent_item_colon' => null,
		     'edit_item' => 'Edit Category',
		     'update_item' => 'Update Category',
		     'add_new_item' => 'Add New Category',
		     'new_item_name' => 'New Category',
		     'separate_items_with_commas' => 'Separate Categories with commas',
		     'add_or_remove_items' => 'Add or remove Categories',
		     'choose_from_most_used' => 'Choose from most used Categories'
		 )
	)
);

// Videos
$n = 'Videos';
$s = 'Video';
$p = 'Videos';
register_post_type(
	'video-posts', array(
		'labels' => array(
	       'name' => $n,
	       'singular_name' => $s,
	       'add_new' => 'Add a ' . $s,
	       'add_new_item' => 'Add a ' . $s,
	       'edit_item' => 'Edit ' . $s,
	       'search_items' => 'Search ' . $p,
	       'not_found' => 'No ' . $p . ' found',
	       'not_found_in_trash' => 'No ' . $p . ' found in trash'
	    ),
		'public' => true,
		'show_ui' => true,
		'capability_type' => 'post',
		'hierarchical' => true,
		'query_var' => true,
		'show_in_nav_menus' => true,
		'exclude_from_search' => false,
		'has_archive' => false,
		'supports' => array(
			'title', 
			'editor',
			'thumbnail',
			'excerpt',
			'revisions'
		)
	)
);

// News Categories
register_taxonomy(
	'vid-cats', array('video-posts'), array( 
		'hierarchical' => true, // Category or Tag functionality
		'query_var' => true,
		'rewrite' => array('slug' => 'vid-cat'),
		'labels' => array(
		     'name' => 'Categories',
		     'singular_name' => 'Category',
		     'search_items' => 'Search Categories',
		     'popular_items' => 'Popular Categories',
		     'all_items' => 'All Categories',
		     'parent_item' => null,
		     'parent_item_colon' => null,
		     'edit_item' => 'Edit Category',
		     'update_item' => 'Update Category',
		     'add_new_item' => 'Add New Category',
		     'new_item_name' => 'New Category',
		     'separate_items_with_commas' => 'Separate Categories with commas',
		     'add_or_remove_items' => 'Add or remove Categories',
		     'choose_from_most_used' => 'Choose from most used Categories'
		 )
	)
);


// Webcasts
$n = 'Webcasts & Webinars';
$s = 'Webcast';
$p = 'Webcasts';
register_post_type(
	'webinar-posts', array(
		'labels' => array(
	       'name' => $n,
	       'singular_name' => $s,
	       'add_new' => 'Add a ' . $s,
	       'add_new_item' => 'Add a ' . $s,
	       'edit_item' => 'Edit ' . $s,
	       'search_items' => 'Search ' . $p,
	       'not_found' => 'No ' . $p . ' found',
	       'not_found_in_trash' => 'No ' . $p . ' found in trash'
	    ),
		'public' => true,
		'show_ui' => true,
		'capability_type' => 'post',
		'hierarchical' => true,
		'query_var' => true,
		'show_in_nav_menus' => true,
		'exclude_from_search' => false,
		'has_archive' => false,
		'supports' => array(
			'title', 
			'editor',
			'thumbnail',
			'excerpt',
			'revisions'
		)
	)
);

// Videos
$n = 'Protected Videos';
$s = 'Protected Video';
$p = 'Protected Videos';
register_post_type(
	'pro-videos', array(
		'labels' => array(
	       'name' => $n,
	       'singular_name' => $s,
	       'add_new' => 'Add a ' . $s,
	       'add_new_item' => 'Add a ' . $s,
	       'edit_item' => 'Edit ' . $s,
	       'search_items' => 'Search ' . $p,
	       'not_found' => 'No ' . $p . ' found',
	       'not_found_in_trash' => 'No ' . $p . ' found in trash'
	    ),
		'public' => true,
		'show_ui' => true,
		'capability_type' => 'post',
		'hierarchical' => true,
		'query_var' => true,
		'show_in_nav_menus' => true,
		'exclude_from_search' => false,
		'has_archive' => false,
		'supports' => array(
			'title', 
			'editor',
			'thumbnail',
			'excerpt',
			'revisions'
		)
	)
);

// Videos
$n = 'Internal Videos';
$s = 'Internal Video';
$p = 'Internal Videos';
register_post_type(
	'int-videos', array(
		'labels' => array(
	       'name' => $n,
	       'singular_name' => $s,
	       'add_new' => 'Add a ' . $s,
	       'add_new_item' => 'Add a ' . $s,
	       'edit_item' => 'Edit ' . $s,
	       'search_items' => 'Search ' . $p,
	       'not_found' => 'No ' . $p . ' found',
	       'not_found_in_trash' => 'No ' . $p . ' found in trash'
	    ),
		'public' => true,
		'show_ui' => true,
		'capability_type' => 'post',
		'hierarchical' => true,
		'query_var' => true,
		'show_in_nav_menus' => true,
		'exclude_from_search' => false,
		'has_archive' => false,
		'supports' => array(
			'title', 
			'editor',
			'thumbnail',
			'excerpt',
			'revisions'
		)
	)
);

// News Categories
register_taxonomy(
	'int-cats', array('int-videos'), array( 
		'hierarchical' => true, // Category or Tag functionality
		'query_var' => true,
		'rewrite' => array('slug' => 'int-cat'),
		'labels' => array(
		     'name' => 'Categories',
		     'singular_name' => 'Category',
		     'search_items' => 'Search Categories',
		     'popular_items' => 'Popular Categories',
		     'all_items' => 'All Categories',
		     'parent_item' => null,
		     'parent_item_colon' => null,
		     'edit_item' => 'Edit Category',
		     'update_item' => 'Update Category',
		     'add_new_item' => 'Add New Category',
		     'new_item_name' => 'New Category',
		     'separate_items_with_commas' => 'Separate Categories with commas',
		     'add_or_remove_items' => 'Add or remove Categories',
		     'choose_from_most_used' => 'Choose from most used Categories'
		 )
	)
);



/*
// Sample Register Post
register_post_type(
	'newsroom-article', array(
		'labels' => array(
	       'name' => 'Newsroom',
	       'singular_name' => 'Newsroom Article',
	       'add_new' => 'Add an Article',
	       'add_new_item' => 'Add an Article',
	       'edit_item' => 'Edit an Article',
	       'search_items' => 'Search Articles',
	       'not_found' => 'No Articles found',
	       'not_found_in_trash' => 'No Articles found in trash'
	    ),
		'public' => true,
		'show_ui' => true,
		'capability_type' => 'post',
		'hierarchical' => false,
		'query_var' => true,
		'show_in_nav_menus' => true,
		'exclude_from_search' => false,
		'has_archive' => false,
		'supports' => array(
			'title', 
			'editor',
			'thumbnail',
			'excerpt'
		)
	)
);

// Sample Register Taxonomy
register_taxonomy(
	'industries', array('transactions'), array( 
		'hierarchical' => true, // Category or Tag functionality
		'query_var' => true,
		'rewrite' => array('slug' => 'industry'),
		'labels' => array(
		     'name' => 'Industries',
		     'singular_name' => 'Industry',
		     'search_items' => 'Search Industries',
		     'popular_items' => 'Popular Industries',
		     'all_items' => 'All Industries',
		     'parent_item' => null,
		     'parent_item_colon' => null,
		     'edit_item' => 'Edit Industry',
		     'update_item' => 'Update Industry',
		     'add_new_item' => 'Add New Industry',
		     'new_item_name' => 'New Industry',
		     'separate_items_with_commas' => 'Separate Industries with commas',
		     'add_or_remove_items' => 'Add or remove Industries',
		     'choose_from_most_used' => 'Choose from most used Industries'
		 )
	)
);

*/