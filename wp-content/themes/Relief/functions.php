<?php



/* ------------------------------------------------
	Theme Setup
------------------------------------------------ */

if ( ! isset( $content_width ) ) $content_width = 640;

add_action( 'after_setup_theme', 'qns_setup' );

if ( ! function_exists( 'qns_setup' ) ):

function qns_setup() {

	add_theme_support( 'post-thumbnails' );
	
	if ( function_exists( 'add_theme_support' ) ) {
		add_theme_support( 'post-thumbnails' );
	        set_post_thumbnail_size( "100", "100" );  
	}

	if ( function_exists( 'add_image_size' ) ) { 
		add_image_size( 'recent-posts-widget', 66, 66, true );
		add_image_size( 'blog-thumb-small', 205, 107, true );
		add_image_size( 'blog-thumb-large', 632, 107, true );
		add_image_size( 'sponsor-thumb', 9999, 77 );
		add_image_size( 'photo-gallery', 298, 115, true );
	}
	
	add_theme_support( 'automatic-feed-links' );
	
	load_theme_textdomain( 'qns', TEMPLATEPATH . '/languages' );

	$locale = get_locale();
	$locale_file = TEMPLATEPATH . "/languages/$locale.php";
	if ( is_readable( $locale_file ) ) require_once( $locale_file );

	register_nav_menus( array(
		'primary' => __( 'Primary Navigation', 'qns' ),
	) );

}
endif;



/* ------------------------------------------------
	Comments Template
------------------------------------------------ */

if( ! function_exists( 'qns_comments' ) ) {
	function qns_comments($comment, $args, $depth) {
	   $path = get_template_directory_uri();
	   $GLOBALS['comment'] = $comment;
	   ?>
	
		<li <?php comment_class('comment_list'); ?> id="li-comment-<?php comment_ID(); ?>">
			<div id="comment-<?php comment_ID(); ?>" class="comment-wrapper">
				<div class="author-image">
					<?php echo get_avatar( $comment, 32 ); ?>
				</div>
				
				<?php if ( $comment->comment_approved == '0' ) : ?>
					<div class="msg success clearfix"><p><?php _e( 'Your comment is awaiting moderation.', 'qns' ); ?></p></div>
				<?php endif; ?>
				
				<h6><?php printf( __( '%s', 'qns' ), sprintf( '%s', get_comment_author_link() ) ); ?>
				<span>
					<a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>">
						<?php printf( __( '%1$s at %2$s', 'qns' ), get_comment_date(),  get_comment_time() ); ?>
					</a>
				</span></h6>
				
				<?php comment_text(); ?>
				
				<p><span class="reply">
					<?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
					<?php edit_comment_link( __( '(Edit)', 'qns' ), ' ' ); ?>
				</span></p>
				
			</div>			

	<?php
	}
}



/* ------------------------------------------------
   Options Panel
------------------------------------------------ */

require_once ('admin/index.php');



/* ------------------------------------------------
	Register Sidebars
------------------------------------------------ */

function qns_widgets_init() {

	// Area 1, located at the top of the sidebar.
	register_sidebar( array(
		'name' => __( 'Primary Widget Area', 'qns' ),
		'id' => 'primary-widget-area',
		'description' => __( 'The primary widget area', 'qns' ),
		'before_widget' => '<div class="widget">',
		'after_widget' => '</div>',
		'before_title' => '<div class="widget-title"><h4>',
		'after_title' => '</h4></div>',
	) );
	
	// Area 2, located in the footer. Empty by default.
	register_sidebar( array(
		'name' => __( 'Footer Widget Area One', 'qns' ),
		'id' => 'footer-widget-area-one',
		'description' => __( 'Footer widget area one', 'qns' ),
		'before_widget' => '<div class="widget">',
		'after_widget' => '</div>',
		'before_title' => '<div class="widget-title"><h4>',
		'after_title' => '</h4></div>',
	) );
	
	// Area 3, located in the footer. Empty by default.
	register_sidebar( array(
		'name' => __( 'Footer Widget Area Two', 'qns' ),
		'id' => 'footer-widget-area-two',
		'description' => __( 'Footer widget area two', 'qns' ),
		'before_widget' => '<div class="widget">',
		'after_widget' => '</div>',
		'before_title' => '<div class="widget-title"><h4>',
		'after_title' => '</h4></div>',
	) );
	
	// Area 4, located in the footer. Empty by default.
	register_sidebar( array(
		'name' => __( 'Footer Widget Area Three', 'qns' ),
		'id' => 'footer-widget-area-three',
		'description' => __( 'Footer widget area three', 'qns' ),
		'before_widget' => '<div class="widget">',
		'after_widget' => '</div>',
		'before_title' => '<div class="widget-title"><h4>',
		'after_title' => '</h4></div>',
	) );

}

add_action( 'widgets_init', 'qns_widgets_init' );



/* ------------------------------------------------
	Register Menu
------------------------------------------------ */

if( !function_exists( 'qns_register_menu' ) ) {
	function qns_register_menu() {

		register_nav_menus(
		    array(
				'primary' => __( 'Primary Navigation','qns' ),
				'secondary' => __( 'Secondary Navigation','qns' ),
				'footer' => __( 'Footer Navigation','qns' )
		    )
		  );
		
	}

	add_action('init', 'qns_register_menu');
}



/* ------------------------------------------------
	Breadcrumbs
------------------------------------------------ */

function dimox_breadcrumbs() {
 
  $showOnHome = 0; // 1 - show breadcrumbs on the homepage, 0 - don't show
  $delimiter = '<span class="breadcrumbs-arrow"></span>'; // delimiter between crumbs
  $home = 'Home'; // text for the 'Home' link
  $showCurrent = 1; // 1 - show current post/page title in breadcrumbs, 0 - don't show
  $before = ''; // tag before the current crumb
  $after = ''; // tag after the current crumb
 
  global $post;
  $homeLink = home_url();
 
  if (is_home() || is_front_page()) {
 
    if ($showOnHome == 1) echo '<div class="breadcrumbs"><a href="' . $homeLink . '">' . $home . '</a></div>';
 
  } else {
 
    echo '<div class="breadcrumbs"><a href="' . $homeLink . '">' . $home . '</a> ' . $delimiter . ' ';
 
    if ( is_category() ) {
      $thisCat = get_category(get_query_var('cat'), false);
      if ($thisCat->parent != 0) echo get_category_parents($thisCat->parent, TRUE, ' ' . $delimiter . ' ');
      echo $before . 'Archive by category "' . single_cat_title('', false) . '"' . $after;
 
    } elseif ( is_search() ) {
      echo $before . 'Search results for "' . get_search_query() . '"' . $after;
 
    } elseif ( is_day() ) {
      echo '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ' . $delimiter . ' ';
      echo '<a href="' . get_month_link(get_the_time('Y'),get_the_time('m')) . '">' . get_the_time('F') . '</a> ' . $delimiter . ' ';
      echo $before . get_the_time('d') . $after;
 
    } elseif ( is_month() ) {
      echo '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ' . $delimiter . ' ';
      echo $before . get_the_time('F') . $after;
 
    } elseif ( is_year() ) {
      echo $before . get_the_time('Y') . $after;
 
    } elseif ( is_single() && !is_attachment() ) {
      if ( get_post_type() != 'post' ) {
        $post_type = get_post_type_object(get_post_type());
        $slug = $post_type->rewrite;
        echo '<a href="' . $homeLink . '/' . $slug['slug'] . '/">' . $post_type->labels->singular_name . '</a>';
        if ($showCurrent == 1) echo ' ' . $delimiter . ' ' . $before . get_the_title() . $after;
      } else {
        $cat = get_the_category(); $cat = $cat[0];
        $cats = get_category_parents($cat, TRUE, ' ' . $delimiter . ' ');
        if ($showCurrent == 0) $cats = preg_replace("#^(.+)\s$delimiter\s$#", "$1", $cats);
        echo $before . $cats . $after;
        if ($showCurrent == 1) echo $before . get_the_title() . $after;
      }
 
    } elseif ( !is_single() && !is_page() && get_post_type() != 'post' && !is_404() ) {
      $post_type = get_post_type_object(get_post_type());
      echo $before . $post_type->labels->singular_name . $after;
 
    } elseif ( is_attachment() ) {
      $parent = get_post($post->post_parent);
      $cat = get_the_category($parent->ID); $cat = $cat[0];
      echo get_category_parents($cat, TRUE, ' ' . $delimiter . ' ');
      echo '<a href="' . get_permalink($parent) . '">' . $parent->post_title . '</a>';
      if ($showCurrent == 1) echo ' ' . $delimiter . ' ' . $before . get_the_title() . $after;
 
    } elseif ( is_page() && !$post->post_parent ) {
      if ($showCurrent == 1) echo $before . get_the_title() . $after;
 
    } elseif ( is_page() && $post->post_parent ) {
      $parent_id  = $post->post_parent;
      $breadcrumbs = array();
      while ($parent_id) {
        $page = get_page($parent_id);
        $breadcrumbs[] = '<a href="' . get_permalink($page->ID) . '">' . get_the_title($page->ID) . '</a>';
        $parent_id  = $page->post_parent;
      }
      $breadcrumbs = array_reverse($breadcrumbs);
      for ($i = 0; $i < count($breadcrumbs); $i++) {
        echo $breadcrumbs[$i];
        if ($i != count($breadcrumbs)-1) echo ' ' . $delimiter . ' ';
      }
      if ($showCurrent == 1) echo ' ' . $delimiter . ' ' . $before . get_the_title() . $after;
 
    } elseif ( is_tag() ) {
      echo $before . 'Posts tagged "' . single_tag_title('', false) . '"' . $after;
 
    } elseif ( is_author() ) {
       global $author;
      $userdata = get_userdata($author);
      echo $before . 'Articles posted by ' . $userdata->display_name . $after;
 
    } elseif ( is_404() ) {
      echo $before . 'Error 404' . $after;
    }
 
    if ( get_query_var('paged') ) {
      if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ' (';
      echo '' . __('Page', 'qns') . ' ' . get_query_var('paged') . '';
      if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ')';
    }
 
    echo '</div>';
 
  }
} // end dimox_breadcrumbs()



/* ------------------------------------------------
	Get Post Type
------------------------------------------------ */

function is_post_type($type){
    global $wp_query;
    if($type == get_post_type($wp_query->post->ID)) return true;
    return false;
}



/* ------------------------------------------------
   Register Dependant Javascript Files
------------------------------------------------ */

add_action('wp_enqueue_scripts', 'qns_load_js');

if( ! function_exists( 'qns_load_js' ) ) {
	function qns_load_js() {

		if ( is_admin() ) {

		}
		
		else {
			
			// Load JS
			wp_register_script( 'jquery_ui', 'http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.min.js',  array( 'jquery' ), '1.8', true );
			wp_register_script( 'prettyphoto', get_template_directory_uri() . '/js/jquery.prettyPhoto.js', array( 'jquery' ), '3.1.4', true );
			wp_register_script( 'superfish', get_template_directory_uri() . '/js/superfish.js', array( 'jquery' ), '1.4.8', true );
			wp_register_script( 'flexslider', get_template_directory_uri() . '/js/jquery.flexslider-min.js', array( 'jquery' ), '2.1', true );
			wp_register_script( 'jcarousel', get_template_directory_uri() . '/js/jquery.jcarousel.min.js', array( 'jquery' ), '0.2.8', true );
			wp_register_script( 'selectivizr', get_template_directory_uri() . '/js/selectivizr-min.js', array( 'jquery' ), '1.0.2', true );
			wp_register_script( 'custom', get_template_directory_uri() . '/js/scripts.js', array( 'jquery' ), '1', true );

			wp_enqueue_script( array( 'jquery_ui', 'prettyphoto', 'superfish', 'flexslider', 'jcarousel', 'custom' ) );
			if( is_single() ) wp_enqueue_script( 'comment-reply' );
			
			global $is_IE;
			
			if( $is_IE ) wp_enqueue_script( 'selectivizr' );
			
			// Load CSS
			wp_enqueue_style('superfish', get_template_directory_uri() .'/css/superfish.css');
			wp_enqueue_style('prettyPhoto', get_template_directory_uri() .'/css/prettyPhoto.css');
			wp_enqueue_style('flexslider', get_template_directory_uri() .'/css/flexslider.css');
			wp_enqueue_style('responsive', get_template_directory_uri() .'/css/responsive.css');
			
			global $data; //fetch options stored in $data
			
			if ( $data['base_color'] == 'Black' ) :
				wp_enqueue_style('color', get_template_directory_uri() .'/css/colours/black.css');
			elseif ( $data['base_color'] == 'Blue' ) :
				wp_enqueue_style('color', get_template_directory_uri() .'/css/colours/blue.css');
			elseif ( $data['base_color'] == 'Dark Blue' ) :
				wp_enqueue_style('color', get_template_directory_uri() .'/css/colours/dark-blue.css');
			elseif ( $data['base_color'] == 'Green' ) :
				wp_enqueue_style('color', get_template_directory_uri() .'/css/colours/green.css');
			elseif ( $data['base_color'] == 'Red' ) :
				wp_enqueue_style('color', get_template_directory_uri() .'/css/colours/red.css');
			else : 
				wp_enqueue_style('color', get_template_directory_uri() .'/css/colours/green.css');
			endif;
			
		}
	}
}

if( !function_exists( 'custom_js' ) ) {

    function custom_js() {
		//Add Custom JS
    }

}

add_action('wp_footer', 'custom_js');



/* ------------------------------------------------
   Load Files
------------------------------------------------ */

// Meta Boxes
include 'functions/events_meta.php';
include 'functions/gallery_meta.php';
include 'functions/post_meta.php';

// Shortcodes
include 'functions/shortcodes/slideshow.php';
include 'functions/shortcodes/accordion.php';
include 'functions/shortcodes/googlemap.php';
include 'functions/shortcodes/toggle.php';
include 'functions/shortcodes/list.php';
include 'functions/shortcodes/button.php';
include 'functions/shortcodes/columns.php';
include 'functions/shortcodes/video.php';
include 'functions/shortcodes/title.php';
include 'functions/shortcodes/message.php';
include 'functions/shortcodes/dropcap.php';
include 'functions/shortcodes/tabs.php';
include 'functions/shortcodes/sponsors.php';


// Widgets
include 'functions/widgets/widget-flickr.php';
include 'functions/widgets/widget-tags.php';
include 'functions/widgets/widget-recent-posts.php';



/* ------------------------------------------------
	Custom CSS
------------------------------------------------ */

function custom_css() {
	
	global $data; //fetch options stored in $data
	
	// Set Font Family
	if ( !$data['custom_font'] ) { 
		$custom_font = "'Bitter', Helvetica, Arial, sans-serif"; } 
	else { 
		$custom_font =  $data['custom_font']; 
	}
	
	// Output Custom CSS
	$output = '<style type="text/css">
	
	h1, h2, h3, h4, h5, h6, #main-menu, .flex-caption p, .button1, .button2, .button3, #submit, .msg1 p, #tabs .nav li, table th, .comment-count h3 .comments-off {
		font-family: ' . $custom_font . ';
	}
	
	' . $data['custom_css'] . '
	
	</style>';
	
  return $output;
}

function admin_style() {
	wp_enqueue_style('admin-css', get_template_directory_uri().'/css/admin.css');
}



/* -------------------------------------------------------
	Remove width / height attributes from gallery images
------------------------------------------------------- */

add_filter('wp_get_attachment_link', 'remove_img_width_height', 10, 1);

function remove_img_width_height($html) {
    $html = preg_replace( '/(width|height)=\"\d*\"\s/', "", $html );
    return $html;
}



/* ------------------------------------------------
	Remove rel attribute from the category list
------------------------------------------------ */

function remove_category_list_rel($output)
{
  $output = str_replace(' rel="category"', '', $output);
  return $output;
}
add_filter('wp_list_categories', 'remove_category_list_rel');
add_filter('the_category', 'remove_category_list_rel');



/* -----------------------------------------------------
	Remove <p> / <br> tags from nested shortcode tags
----------------------------------------------------- */

add_filter('the_content', 'shortcode_fix');
function shortcode_fix($content)
{   
    $array = array (
        '<p>[' => '[', 
        ']</p>' => ']', 
        ']<br />' => ']'
    );

    $content = strtr($content, $array);

	return $content;
}



/* ------------------------------------------------
	Excerpt Length
------------------------------------------------ */

function qns_excerpt_length( $length ) {
	return 25;
}
add_filter( 'excerpt_length', 'qns_excerpt_length' );



/* ------------------------------------------------
	Excerpt More Link
------------------------------------------------ */

function qns_continue_reading_link() {
	
	// Don't Display Read More Button On Search Results / Archive Pages
	if ( !is_search() && !is_archive() ) {
		return ' <p><a href="'. get_permalink() . '"' . __( ' class="button1">Read More &raquo;</a></p>', 'qns' );
	}
	
}

function qns_auto_excerpt_more( $more ) {
	return qns_continue_reading_link();
}
add_filter( 'excerpt_more', 'qns_auto_excerpt_more' );



/* ------------------------------------------------
	The Title
------------------------------------------------ */

function qns_filter_wp_title( $title, $separator ) {
	
	if ( is_feed() )
		return $title;

	global $paged, $page;

	if ( is_search() ) {
		$title = sprintf( __( 'Search results for %s', 'qns' ), '"' . get_search_query() . '"' );
		if ( $paged >= 2 )
			$title .= " $separator " . sprintf( __( 'Page %s', 'qns' ), $paged );
		$title .= " $separator " . home_url( 'name', 'display' );
		return $title;
	}

	$title .= get_bloginfo( 'name', 'display' );

	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		$title .= " $separator " . $site_description;

	if ( $paged >= 2 || $page >= 2 )
		$title .= " $separator " . sprintf( __( 'Page %s', 'qns' ), max( $paged, $page ) );

	return $title;
}
add_filter( 'wp_title', 'qns_filter_wp_title', 10, 2 );



/* ------------------------------------------------
	Display Breadcrumbs
------------------------------------------------ */

function display_breadcrumbs() {
	
	global $data; //fetch options stored in $data
	
	if ( $data['breadcrumbs'] == '' or $data['breadcrumbs'] == '1' ) { 
		$output = dimox_breadcrumbs();
	}
	
	return $output;

}



/* ------------------------------------------------
	Sidebar Position
------------------------------------------------ */

function sidebar_position( $position ) {
	
	global $data; //fetch options stored in $data
	
	if ( $data['sidebar_position'] ) { 
		$sidebar = $data['sidebar_position']; 
	}

	else { 
		$sidebar = 'right';
	}
	
	if ( $sidebar == 'left' && $position == 'primary-content' ) {
		$output = 'two-thirds-right last-col';
	}
	
	if ( $sidebar == 'right' && $position == 'primary-content' ) {
		$output = 'two-thirds';
	}
	
	if ( $sidebar == 'left' && $position == 'secondary-content' ) {
		$output = 'one-third-left';
	}
	
	if ( $sidebar == 'right' && $position == 'secondary-content' ) {
		$output = 'one-third last-col';
	}
	
	if ( $sidebar == 'none' && $position == 'primary-content' ) {
		$output = 'full-width';
	}
	
	if ( $sidebar == 'none' && $position == 'secondary-content' ) {
		$output = 'full-width';
	}
	
	return $output;

}



/* ------------------------------------------------
	Menu Fallback
------------------------------------------------ */

function wp_page_menu_qns( $args = array() ) {
	$defaults = array('sort_column' => 'menu_order, post_title', 'menu_class' => 'menu', 'echo' => true, 'link_before' => '', 'link_after' => '');
	$args = wp_parse_args( $args, $defaults );
	$args = apply_filters( 'wp_page_menu_qns_args', $args );

	$menu = '';

	$list_args = $args;

	// Show Home in the menu
	if ( ! empty($args['show_home']) ) {
		if ( true === $args['show_home'] || '1' === $args['show_home'] || 1 === $args['show_home'] )
			$text = __('Home','qns');
		else
			$text = $args['show_home'];
		$class = '';
		if ( is_front_page() && !is_paged() )
			$class = 'class="current_page_item"';
		$menu .= '<li ' . $class . '><a href="' . home_url( '/' ) . '" title="' . esc_attr($text) . '">' . $args['link_before'] . $text . $args['link_after'] . '</a></li>';
		// If the front page is a page, add it to the exclude list
		if (get_option('show_on_front') == 'page') {
			if ( !empty( $list_args['exclude'] ) ) {
				$list_args['exclude'] .= ',';
			} else {
				$list_args['exclude'] = '';
			}
			$list_args['exclude'] .= get_option('page_on_front');
		}
	}

	$list_args['echo'] = false;
	$list_args['title_li'] = '';
	$menu .= str_replace( array( "\r", "\n", "\t" ), '', wp_list_pages($list_args) );

	if ( $menu )
		$menu = '<ul id="main-menu" class="fl">' . $menu . '</ul>';

	$menu = $menu . "\n";
	$menu = apply_filters( 'wp_page_menu_qns', $menu, $args );
	if ( $args['echo'] )
		echo $menu;
	else
		return $menu;
}



/* ------------------------------------------------
	Password Protected Post Form
------------------------------------------------ */

add_filter( 'the_password_form', 'qns_password_form' );

function qns_password_form() {
	
	global $post;
	$label = 'pwbox-'.( empty( $post->ID ) ? rand() : $post->ID );
	$form = '<div class="msg fail clearfix"><p class="nopassword">' . __( 'This post is password protected. To view it please enter your password below', 'qns' ) . '</p></div>
<form class="protected-post-form" action="' . get_option('siteurl') . '/wp-pass.php" method="post"><label for="' . $label . '">' . __( 'Password', 'qns' ) . ' </label><input name="post_password" id="' . $label . '" type="password" size="20" /><div class="clearboth"></div><input id="submit" type="submit" value="' . esc_attr__( "Submit" ) . '" name="submit"></form>';
	return $form;
	
}



/* ------------------------------------------------
	Tagline Position Fix
------------------------------------------------ */

function tagline_position() {
	
	global $data; //fetch options stored in $data
	
	if ( $data['image_logo'] ) {
	
		if ( $data['image_logo_height'] ) :
			$height = $data['image_logo_height'];
	
			if ( $height > 30 ) :
				$height_fixed = $height / 2 - 6.5;
			else : 
				$height_fixed = 7;
			endif;
	
			$image_logo_height_fixed = 'style="position:relative;top:-' . $height_fixed . 'px;"'; 
		
			return $image_logo_height_fixed;
		
		endif;
		
	}
	
}



/* ------------------------------------------------
	Donate Button Position Fix
------------------------------------------------ */

function donate_position() {
	
	global $data; //fetch options stored in $data
	
	if ( $data['image_logo'] ) {
	
		if ( $data['image_logo_height'] ) :
			$height = $data['image_logo_height'];
	
			if ( $height > 39 ) :
				$height_fixed = $height / 2 - 13.5;
			else : 
				$height_fixed = 0;
			endif;
	
			$image_logo_height_fixed = 'style="position:relative;top:' . $height_fixed . 'px;"'; 
		
			return $image_logo_height_fixed;
		
		endif;
		
	}
	
}


/* ------------------------------------------------
	Add additional buttons to the WYSIWYG Editor
------------------------------------------------ */

function enable_more_buttons($buttons) {
  $buttons[] = 'hr';
  $buttons[] = 'del';
  $buttons[] = 'sub';
  $buttons[] = 'sup';
  $buttons[] = 'anchor';
  $buttons[] = 'small';
  $buttons[] = 'fontsizeselect';
  
  return $buttons;
}
add_filter("mce_buttons_3", "enable_more_buttons"); 


// Add custom text sizes in the font size drop down list of the rich text editor (TinyMCE) in WordPress
// $initArray is a variable of type array that contains all default TinyMCE parameters.
// Value 'theme_advanced_font_sizes' needs to be added, if an overwrite to the default font sizes in the list, is needed.

function customize_text_sizes($initArray){
   $initArray['theme_advanced_font_sizes'] = "11px,12px,14px,16px,18px";
   return $initArray;
}

// Assigns customize_text_sizes() to "tiny_mce_before_init" filter
add_filter('tiny_mce_before_init', 'customize_text_sizes');


/* ------------------------------------------------
	Google Fonts
------------------------------------------------ */

function google_fonts() {
	
	global $data; //fetch options stored in $data
	
	$output = "<link href='http://fonts.googleapis.com/css?family=Nothing+You+Could+Do' rel='stylesheet' type='text/css'>";
	
	if ( !$data['custom_font_code'] ) {
		$output .= "<link href='http://fonts.googleapis.com/css?family=Bitter:400,400italic,700' rel='stylesheet' type='text/css'>"; 
	}

	else { 
		$output .= $data['custom_font_code']; 
	}
	
	return $output;
	
}



/* ------------------------------------------------
	Page Header
------------------------------------------------ */

function page_header( $url ) {
	
	global $data; //fetch options stored in $data
	
	// If custom page header is set
	if ( $url != '' ) {
		$header_url = $url;
	}
	
	// If default page header is set and custom header is not set
	if ( $data['default_header_url'] && $url == '' ) {
		$header_url = $data['default_header_url'];
	}
	
	// If either of the above is set
	if ( $header_url != '' ) :
		$output = '';	
		$output .= '<!-- BEGIN #page-header -->';
		$output .= '<div id="page-header">';
		$output .= '<img src="' . $header_url . '" alt="" />';
		$output .= '<!-- END #page-header -->';
		$output .= '</div>';
		return $output;
	endif;
	
}

/* ------------------------------------------------
	Strip out Height & Width on Images
------------------------------------------------ */

add_filter( 'post_thumbnail_html', 'remove_width_attribute', 10 );
add_filter( 'image_send_to_editor', 'remove_width_attribute', 10 );

function remove_width_attribute( $html ) {
   $html = preg_replace( '/(width|height)="\d*"\s/', "", $html );
   return $html;
}

/* ------------------------------------------------
	Social Icons
------------------------------------------------ */

function no_icons() {
	
	global $data; //fetch options stored in $data
	
	if( $data['social_twitter'] ) { $twitter = $data['social_twitter']; }
	else { $twitter = ''; }

	if( $data['social_facebook'] ) { $facebook = $data['social_facebook']; }
	else { $facebook = ''; }

	if( $data['social_googleplus'] ) { $googleplus = $data['social_googleplus']; }
	else { $googleplus = ''; }

	if( $data['social_skype'] ) { $skype = $data['social_skype']; }
	else { $skype = ''; }

	if( $data['social_flickr'] ) { $flickr = $data['social_flickr']; }
	else { $flickr = ''; }

	if( $data['social_linkedin'] ) { $linkedin = $data['social_linkedin']; }
	else { $linkedin = ''; }

	if( $data['social_vimeo'] ) { $vimeo = $data['social_vimeo']; }
	else { $vimeo = ''; }

	if( $data['social_youtube'] ) { $youtube = $data['social_youtube']; }
	else { $youtube = ''; }

	if( $data['social_rss'] ) { $rss = $data['social_rss']; }
	else { $rss = ''; }
	
	if ( $twitter == '' && $facebook == '' && $googleplus == '' && $skype == '' && $flickr == '' && $linkedin == '' && $vimeo == '' && $youtube == '' && $rss == '' ) {
		return true;
	}
}

function display_social() {
	
	global $data; //fetch options stored in $data
	
	if( $data['social_twitter'] ) { $twitter = $data['social_twitter']; }
	else { $twitter = ''; }

	if( $data['social_facebook'] ) { $facebook = $data['social_facebook']; }
	else { $facebook = ''; }

	if( $data['social_googleplus'] ) { $googleplus = $data['social_googleplus']; }
	else { $googleplus = ''; }

	if( $data['social_skype'] ) { $skype = $data['social_skype']; }
	else { $skype = ''; }

	if( $data['social_flickr'] ) { $flickr = $data['social_flickr']; }
	else { $flickr = ''; }

	if( $data['social_linkedin'] ) { $linkedin = $data['social_linkedin']; }
	else { $linkedin = ''; }

	if( $data['social_vimeo'] ) { $vimeo = $data['social_vimeo']; }
	else { $vimeo = ''; }

	if( $data['social_youtube'] ) { $youtube = $data['social_youtube']; }
	else { $youtube = ''; }

	if( $data['social_rss'] ) { $rss = $data['social_rss']; }
	else { $rss = ''; }
	
	$output = '';
	
	if ( no_icons() !== true ) {
		$output .= '<ul class="social-icons fl">';
	}	

	if( $twitter !== '' ) {
		$output .= '<li><a href="' . $twitter . '"><span id="twitter_icon"></span></a></li>';
	}

	if( $facebook !== '' ) {
		$output .= '<li><a href="' . $facebook . '"><span id="facebook_icon"></span></a></li>';
	}

	if( $googleplus !== '' ) {
		$output .= '<li><a href="' . $googleplus . '"><span id="googleplus_icon"></span></a></li>';
	}

	if( $skype !== '' ) {
		$output .= '<li><a href="' . $skype . '"><span id="skype_icon"></span></a></li>';
	 }

	if( $flickr !== '' ) {
		$output .= '<li><a href="' . $flickr . '"><span id="flickr_icon"></span></a></li>';
	}

	if( $linkedin !== '' ) {
		$output .= '<li><a href="' . $linkedin . '"><span id="linkedin_icon"></span></a></li>';
	}

	if( $vimeo !== '' ) {
		$output .= '<li><a href="' . $vimeo . '"><span id="vimeo_icon"></span></a></li>';
	}

	if( $youtube !== '' ) {
		$output .= '<li><a href="' . $youtube . '"><span id="youtube_icon"></span></a></li>';
	}

	if( $rss !== '' ) {
		$output .= '<li><a href="' . $rss . '"><span id="rss_icon"></span></a></li>';
	}

	if ( no_icons() !== true ) {
		$output .= '</ul>';
	}
	
	return $output;
	
}