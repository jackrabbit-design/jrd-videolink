<?php

/* ========================================================================= */
/* !WORDPRESS EXTERNAL FILES     */
/* ========================================================================= */

include_once 'functions/functions-post-types.php';
include_once 'functions/functions-widgets.php';
//include_once 'functions/functions-comments.php';


/* ========================================================================= */
/* !WORDPRESS SECURITY */
/* ========================================================================= */

remove_action( 'wp_head', 'feed_links_extra', 3 ); // Display the links to the extra feeds such as category feeds
remove_action( 'wp_head', 'feed_links', 2 ); // Display the links to the general feeds: Post and Comment Feed
remove_action( 'wp_head', 'rsd_link' ); // Display the link to the Really Simple Discovery service endpoint, EditURI link
remove_action( 'wp_head', 'wlwmanifest_link' ); // Display the link to the Windows Live Writer manifest file.
remove_action( 'wp_head', 'index_rel_link' ); // index link
remove_action( 'wp_head', 'parent_post_rel_link', 10, 0 ); // prev link
remove_action( 'wp_head', 'start_post_rel_link', 10, 0 ); // start link
remove_action( 'wp_head', 'adjacent_posts_rel_link', 10, 0 ); // Display relational links for the posts adjacent to the current post.
remove_action( 'wp_head', 'wp_generator' ); // Display the XHTML generator that is generated on the wp_head hook, WP version

/* Prevent Login Errors for Security */
add_filter('login_errors',create_function('$a', "return null;"));

/* Hide Admin Bar */
 add_filter('show_admin_bar', '__return_false');



/* ========================================================================= */
/* !WORDPRESS CUSTOMIZATION & SETUP */
/* ========================================================================= */

/* Post Thumbnail Sizes */
add_theme_support( 'post-thumbnails' );
set_post_thumbnail_size( 64, 64, true );
add_image_size( 'banner-img', 1400, 1400, false);
add_image_size( 'tab-img', 474, 266, true);
add_image_size( 'int-banner', 1200, 247, true);
add_image_size( 'landing-banner', 1200, 450, true);
add_image_size( 'team-thb', 250, 155, true);
add_image_size( 'landing', 269, 172, true);
add_image_size( 'bio-img', 385, 216, true);
add_image_size( 'blog-feat', 455, 303, true);
add_image_size( 'blog-thb', 176, 117, true);
add_image_size( 'blog-rel', 70, 70, true);
add_image_size( 'quote-logo', 210, 100, false);
add_image_size( 'quote-photo', 250, 140, true);
add_image_size( 'partner-logo', 168, 92, false);
add_image_size( 'inline-video', 530, 300, true);
add_image_size( 'feat-logo', 180, 50, false);
add_image_size( 'company-logo', 130, 50, false);
add_image_size( 'trending-logo', 85, 50, false);
add_image_size( 'trending-side', 200, 400, false);
add_image_size( 'pop-thb', 240, 135, true);
add_image_size( 'mono-client', 160, 80, false);

/* Declare Nav Menu Areas */
if ( function_exists( 'register_nav_menus' ) ) {
	register_nav_menus(
		array(
               'main-menu' => 'Main Menu',
               'footer-menu' => 'Footer Menu'
		)
	);
}

/* Add a Stylesheet for Admin Content Area */
function admin_font_setup(){
    add_editor_style( array( 'editor-style.css', '/' ) );
}
add_action( 'after_setup_theme', 'admin_font_setup' );


/* Globally Hide Admin Meta Boxes */
function hide_meta_boxes() {
     remove_meta_box('postcustom','post','normal'); // custom fields post
     remove_meta_box('postcustom','page','normal'); // custom fields page

     //remove_meta_box('commentstatusdiv','post','normal'); // discussion post
     remove_meta_box('commentstatusdiv','page','normal'); // discussion page

     //remove_meta_box('commentsdiv','post','normal'); // comments post
     //remove_meta_box('commentsdiv','page','normal'); // comments page

     //remove_meta_box('authordiv','post','normal'); // author post
     remove_meta_box('authordiv','page','normal'); // author page

     //remove_meta_box('revisionsdiv','post','normal'); // revisions post
     //remove_meta_box('revisionsdiv','page','normal'); // revisions page

     //remove_meta_box('postimagediv','post','normal'); // featured image post
     remove_meta_box('postimagediv','page','normal'); // featured image page

     //remove_meta_box('pageparentdiv','page','normal'); // page attributes

     //remove_meta_box('tagsdiv-post-tag','post','normal'); // post tags
     //remove_meta_box('categorydiv','post','normal'); // post categories
     //remove_meta_box('postexcerpt','post','normal'); // post excerpt
     remove_meta_box('trackbacksdiv','post','normal'); // track backs
}
add_action('admin_init', 'hide_meta_boxes');


/* Hide Wordpress Default Dashboard Widgets */
function remove_dashboard_widgets() {

	global $wp_meta_boxes;

	unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_quick_press']);
	unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_incoming_links']);

	//unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_right_now']);
	unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_plugins']);

	unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_recent_drafts']);
	unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_recent_comments']);

	unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_primary']);
	unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_secondary']);

}

add_action('wp_dashboard_setup', 'remove_dashboard_widgets' );


/* ========================================================================= */
/* !GRAVITY FORM CUSTOMIZATIONS */
/* ========================================================================= */

add_filter("gform_submit_button", "form_submit_button", 10, 2);
function form_submit_button($button, $form){
  $button_array = $form["button"];
  $button_text = $button_array["text"];
    return "<button type='submit' class='submit' id='gform_submit_button_{" . $form["id"] . "}'><span>$button_text</span></button>";
}



function load_jquery() {
    if (!is_admin()) {
        wp_deregister_script('jquery');
        wp_register_script('jquery', site_url().'/ui/js/jquery.js', false, '1.10.2');
        wp_enqueue_script('jquery');
    }

}

add_action('template_redirect', 'load_jquery');


/* ========================================================================= */
/* !CLASSES FOR NEXT AND PREVIOUS POSTS LINKS */
/* ========================================================================= */

add_filter('next_posts_link_attributes', 'next_link_attributes');

function next_link_attributes() {
    return 'class="next-link"';
}

add_filter('previous_posts_link_attributes', 'prev_link_attributes');

function prev_link_attributes() {
    return 'class="prev-link"';
}



/* ========================================================================= */
/* !WORDPRESS SUBPAGE SIDEBAR MENU */
/* ========================================================================= */

function jrd_tertiary_menu( $args )
{
	include_once 'functions/class-walker-tertiary-menu.php';
	$uri_parts = explode('/', $_SERVER['REQUEST_URI']);
	$args['ancestor'] = get_page_by_path($uri_parts[1]);
	$args['echo'] = false;
	$args['walker'] = new Walker_Tertiary_Menu();
	return wp_nav_menu($args);
}


function check_is_subpage() {
    global $post;                                 // load details about this page
    if ( is_page() && $post->post_parent ) {      // test to see if the page has a parent
           return $post->post_parent;             // return the ID of the parent post
    } else {                                      // there is no parent so...
           return false;                          // ...the answer to the question is false
    }
}


/* HOW TO USE
   Plug this code below into your submenu sidebar and set the theme location to use the menu you want to reference. This code checks whether the page is a subpage.
   If page is a subpage it echos the children menu items of it. If page is not it then echos the top level pages of the menu.

<?php if(check_is_subpage() == false){ ?>
    <h3><?php bloginfo('name'); ?></h3>
    <div class="submenu-widget">
        <?php wp_nav_menu(array('theme_location' => 'main-menu', 'container' => '', 'menu_class' => 'menu', 'menu_id' => '', 'depth' => 2)); ?>
    </div>
<?php } else { ?>
    <h3><?php $anc = get_ancestors(get_the_ID(),'page'); $count = count($anc); if($count > 0){ $anc_pg = get_post($anc[($count - 1)]); echo $anc_pg->post_title; } else the_title(); ?></h3>
    <div class="submenu-widget">
        <?php echo jrd_tertiary_menu(array('theme_location' => 'main-menu', 'container' => '', 'menu_class' => 'menu', 'menu_id' => '', 'depth' => 3)); ?>
    </div>
<?php } ?>
*/


/* ========================================================================= */
/* !CUSTOM SEARCH */
/* ========================================================================= */



/* ========================================================================= */
/* !WORDPRESS PAGINATION SCRIPT */
/* ========================================================================= */
/*
function jrd_paginate() {
	global $wp_query, $wp_rewrite;
	$wp_query->query_vars['paged'] > 1 ? $current = $wp_query->query_vars['paged'] : $current = 1;

	$pagination = array(
		'base' => @add_query_arg('page','%#%'),
		'format' => '',
		'total' => $wp_query->max_num_pages,
		'current' => $current,
		'show_all' => false,
		'mid_size' => 1,
		'end_size' => 3,
		'type' => 'list',
		'next_text' => 'Older &raquo;',
		'prev_text' => '&laquo; Newer'
		);

	if( $wp_rewrite->using_permalinks() )
		$pagination['base'] = user_trailingslashit( trailingslashit( remove_query_arg( 's', get_pagenum_link( 1 ) ) ) . 'page/%#%/', 'paged' );

	if( !empty($wp_query->query_vars['s']) )
		$pagination['add_args'] = array( 's' => urlencode(get_query_var( 's' )) );

	echo '<div class="pagination">';
	echo paginate_links( $pagination );
	echo '</div>';
}
*/


/* ========================================================================= */
/* !SHORTCUT CODES */
/* ========================================================================= */
/*
function morelink($atts, $content = null) {
    extract(shortcode_atts(array(
        "link" => '',
        "target" => ''
    ), $atts));
    return '<a href="'.$link.'" class="button btn-read-more" target="'.$target.'">'.$content.'</a>';
}
add_shortcode('button', 'morelink');
*/

function bcVideo() {
    $vid = get_field('inline_video');
    if($vid):
        if(get_field('vidyard_id',$vid->ID)){
            $thb = '//play.vidyard.com/' . get_field('vidyard_id',$vid->ID) . '.jpg';
            return '
            <div id="feat-vid">
                <a class="vid-time lb-trigger" href="'.get_permalink($vid->ID).'">' . get_field('video_length',$vid->ID) . '</a>
                <img src="' . $thb . '" alt="'.$vid->post_title.'" />
            </div>';
        }else{
            $token = get_field('brightcove_token','options');
            $details = file_get_contents('http://api.brightcove.com/services/library?command=find_video_by_id&video_id='.get_field('brightcove_id',$vid->ID).'&video_fields=videoStillURL,length&token='.$token);
            $details = json_decode($details);
            $input = $details->length;
            $input = floor($input / 1000);
            $seconds = $input % 60;
            $input = floor($input / 60);
            $minutes = $input % 60;
            return '
            <div id="feat-vid">
                <a class="vid-time lb-trigger" href="'.get_permalink($vid->ID).'">' . $minutes . ':' . (strlen($seconds) == 1 ? '0' : '') . $seconds . '</a>
                <img src="' . $details->videoStillURL . '" alt="'.$vid->post_title.'" />
            </div>';
        }
    endif;
}


add_shortcode('video', 'bcVideo');




/* ========================================================================= */
/* !TINYMCE SELECT DROPDOWN CLASS SETUP CODES */
/* ========================================================================= */

add_filter( 'mce_buttons_2', 'my_mce_buttons_2' );

function my_mce_buttons_2( $buttons ) {
    array_unshift( $buttons, 'styleselect' );
    return $buttons;
}

add_filter( 'tiny_mce_before_init', 'my_mce_before_init' );

function my_mce_before_init( $settings ) {

    $style_formats = array(
    	array(
    		'title' => 'Orange Button',
    		'selector' => 'a',
    		'classes' => 'btn'
        ),
        array(
            'title' => 'Small',
            'selector' => 'p',
            'classes' => 'small'
        )
    );

    $settings['style_formats'] = json_encode( $style_formats );

    return $settings;

}


/* ========================================================================= */
/* !WORDPRESS CUSTOM THEME FUNCTIONS */
/* ========================================================================= */

/* ----- SHOW FUTURE POSTS FOR EVENT CUSTOM POST TYPES ----- */
/*
function show_future_posts($posts) {
   global $wp_query, $wpdb;
   if(is_single() && $wp_query->post_count == 0)
   {
      $posts = $wpdb->get_results($wp_query->request);
   }
   return $posts;
}
add_filter('the_posts', 'show_future_posts');
*/

/* ----- Get File Extension (ex: PDF, DOC) ----- */
/*
function jrd_get_file_ext($file_url){
	return pathinfo($file_url, PATHINFO_EXTENSION);
}
*/

/* Custom Excerpt for Blog */

function custom_excerpt_length( $length ) {
	return 25;
}
add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );

function new_excerpt_more( $more ) {
	return '...';
}
add_filter('excerpt_more', 'new_excerpt_more');


/* ========================================================================= */
/* !JRD NAV WALKER */
/* ========================================================================= */


// The actual walker
class jrd_walker extends Walker_Nav_Menu
{

    // Edit to core to add div before ul.sub-menu
    function start_lvl( &$output, $depth = 0, $args = array() ) {
    	$indent = str_repeat("\t", $depth);
    	$output .= "\n$indent<div><ul class=\"sub-menu\">\n";
    }

    function end_lvl( &$output, $depth = 0, $args = array() ) {
    	$indent = str_repeat("\t", $depth);
    	$output .= "$indent</ul></div>\n";
    }

    function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0) {
        $classes = empty ( $item->classes ) ? array () : (array) $item->classes;
        $class_names = join(' ', apply_filters('nav_menu_css_class',array_filter( $classes ), $item));

        ! empty ( $class_names )
        and $class_names = ' class="'. esc_attr( $class_names ) . '"';
        $output .= "<li id='menu-item-$item->ID' $class_names>";

        $attributes  = '';

        ! empty( $item->attr_title )
            and $attributes .= ' title="'  . esc_attr( $item->attr_title ) .'"';
        ! empty( $item->target )
            and $attributes .= ' target="' . esc_attr( $item->target     ) .'"';
        ! empty( $item->xfn )
            and $attributes .= ' rel="'    . esc_attr( $item->xfn        ) .'"';
        ! empty( $item->url )
            and $attributes .= ' href="'   . esc_attr( $item->url        ) .'"';

        $submenus = $depth == 0 ? get_posts( array( 'post_type' => 'nav_menu_item', 'numberposts' => -1, 'orderby' => 'menu_order', 'order' => 'ASC', 'meta_query' => array( array( 'key' => '_menu_item_menu_item_parent', 'value' => $item->ID ) ) ) ) : false;

        $title = apply_filters( 'the_title', $item->title, $item->ID );
        $item_output = $args->before
            . "<a $attributes>"
            . $args->link_before
            . $title
            . '</a> '
            . $args->link_after
            . $args->after;

        if($depth != 0){
            $item_output = $args->before
                . "<a $attributes>"
                . $args->link_before
                . '<h3>'.$title.'</h3>'
                . '<p>' . $item->description . '</p><span>Continue</span>'
                . '</a>'
                . $args->link_after
                . $args->after;
        }

        // Since $output is called by reference we don't need to return anything.
        $output .= apply_filters(
            'walker_nav_menu_start_el',
            $item_output,
            $item,
            $depth,
            $args
        );
    }
}


function jrd_list_authors($args = '') {
	global $wpdb;

	$defaults = array(
		'orderby'       => 'name',
		'order'         => 'ASC',
		'number'        => '',
		'optioncount'   => false,
		'exclude_admin' => true,
		'show_fullname' => false,
		'hide_empty'    => true,
		'feed'          => '',
		'feed_image'    => '',
		'feed_type'     => '',
		'echo'          => true,
		'style'         => 'list',
		'html'          => true
	);

	$args = wp_parse_args( $args, $defaults );
	extract( $args, EXTR_SKIP );

	$return = '';

	$query_args = wp_array_slice_assoc( $args, array( 'orderby', 'order', 'number' ) );
	$query_args['fields'] = 'ids';
	$authors = get_users( $query_args );

	$author_count = array();
	foreach ( (array) $wpdb->get_results("SELECT DISTINCT post_author, COUNT(ID) AS count FROM $wpdb->posts WHERE post_type = 'post' AND " . get_private_posts_cap_sql( 'post' ) . " GROUP BY post_author") as $row )
		$author_count[$row->post_author] = $row->count;

	foreach ( $authors as $author_id ) {
		$author = get_userdata( $author_id );

		if ( $exclude_admin && 'admin' == $author->display_name )
			continue;

		$posts = isset( $author_count[$author->ID] ) ? $author_count[$author->ID] : 0;

		if ( !$posts && $hide_empty )
			continue;

		$link = '';

		if ( $show_fullname && $author->first_name && $author->last_name )
			$name = "$author->first_name $author->last_name";
		else
			$name = $author->display_name;

		if ( !$html ) {
			$return .= $name . ', ';

			continue; // No need to go further to process HTML.
		}

		if ( 'list' == $style ) {
			$return .= '<li>';
		}

		$link = '<a href="?auth='.$author->ID.'">' . $name . '</a>';

		if ( !empty( $feed_image ) || !empty( $feed ) ) {
			$link .= ' ';
			if ( empty( $feed_image ) ) {
				$link .= '(';
			}

			$link .= '<a href="' . get_author_feed_link( $author->ID ) . '"';

			$alt = $title = '';
			if ( !empty( $feed ) ) {
				$title = ' title="' . esc_attr( $feed ) . '"';
				$alt = ' alt="' . esc_attr( $feed ) . '"';
				$name = $feed;
				$link .= $title;
			}

			$link .= '>';

			$link .= $name;

			$link .= '</a>';

			if ( empty( $feed_image ) )
				$link .= ')';
		}

		if ( $optioncount )
			$link .= ' ('. $posts . ')';

		$return .= $link;
		$return .= ( 'list' == $style ) ? '</li>' : ', ';
	}

	$return = rtrim($return, ', ');

	if ( !$echo )
		return $return;

	echo $return;
}


function after_submission_2(){
    setcookie('pardot_2',true,time() + (86400));
}
add_action("gform_after_submission_2", "after_submission_2", 10, 2);

function after_submission_3(){
    setcookie('pardot_3',true,time() + (86400));
}
add_action("gform_after_submission_3", "after_submission_3", 10, 2);



/* ========================================================================= */
/* !YOAST ANALYZE CUSTOM FIELDS */
/* ========================================================================= */
if ( is_admin() ) {
	function add_custom_to_yoast( $content ) {
		global $post;
		$pid = $post->ID;
		$custom = get_post_custom($pid);
		unset($custom['_yoast_wpseo_focuskw']);
		foreach( $custom as $key => $value ) {
			if( substr( $key, 0, 1 ) != '_' && substr( $value[0], -1) != '}' && !is_array($value[0]) && !empty($value[0])) {
			  $custom_content .= $value[0] . ' ';
			}
		}
		$content = $content . ' ' . $custom_content;
		return $content;
		remove_filter('wpseo_pre_analysis_post_content', 'add_custom_to_yoast'); // don't let WP execute this twice
	}
	add_filter('wpseo_pre_analysis_post_content', 'add_custom_to_yoast');
}


/* ========================================================================= */
/* !EASY PRINTR() */
/* ========================================================================= */
function printr($var){ echo '<pre>'; print_r($var); echo '</pre>'; };
