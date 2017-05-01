<?php
/**
 * Adon Theme Functions and definitions
 *
 * Set up the theme and provides some helper functions, which are used in the
 * theme as custom template tags. Others are attached to action and filter
 * hooks in WordPress to change core functionality.
 *
 * When using a child theme you can override certain functions (those wrapped
 * in a function_exists() call) by defining them first in your child theme's
 * functions.php file. The child theme's functions.php file is included before
 * the parent theme's file, so the child theme functions would be used.
 *
 * @link https://codex.wordpress.org/Theme_Development
 * @link https://codex.wordpress.org/Child_Themes
 *
 * Functions that are not pluggable (not wrapped in function_exists()) are
 * instead attached to a filter or action hook.
 *
 * For more information on hooks, actions, and filters,
 * {@link https://codex.wordpress.org/Plugin_API}
 *
 * @package WordPress
 * @subpackage Adon-Theme
 * @since Adon Theme 1.0
 */

/**
 * Theme Setup.
 */
function adontheme_setup() {
	load_theme_textdomain( 'adontheme', get_template_directory() . '/languages' );
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'structured-post-formats', array( 'link', 'video' ) );
	add_theme_support( 'post-formats', array(
			'aside',
			'audio',
			'chat',
			'gallery',
			'image',
			'quote',
			'status',
		)
	);
	register_nav_menu( 'primary', __( 'Navigation Menu', 'adontheme' ) );
	add_theme_support( 'post-thumbnails' );
}

add_action( 'after_setup_theme', 'adontheme_setup' );

/**
 * Scripts & Styles.
 */
function adontheme_scripts_styles() {
	global $wp_styles;

	// Load Comments.
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	// Load Stylesheets.
	wp_enqueue_style( 'adontheme-reset', get_template_directory_uri() . '/reset.css' );
	wp_enqueue_style( 'adontheme-style', get_stylesheet_uri() );

	// Load IE Stylesheet.
	wp_enqueue_style( 'adontheme-ie', get_template_directory_uri() . '/css/ie.css', array( 'adontheme-style' ), '20130213' );
	$wp_styles->add_data( 'adontheme-ie', 'conditional', 'lt IE 9' );

	// Modernizr.
	// This is an un-minified, complete version of Modernizr. Before you move to production, you should generate a custom build that only has the detects you need.
	wp_enqueue_script( 'adontheme-modernizr', get_template_directory_uri() . '/js/modernizr-2.8.0.dev.js' );

	// Lea Verou's Prefix Free, lets you use only un-prefixed properties in yuor CSS files.
	wp_enqueue_script( 'adontheme-prefixfree', get_template_directory_uri() . '/js/prefixfree.min.js' );

	// This is where we put our custom JS functions.
	wp_enqueue_script( 'adontheme-custom', get_template_directory_uri() . '/js/functions.js', array( 'jquery' ), null, true );
}

add_action( 'wp_enqueue_scripts', 'adontheme_scripts_styles' );

/**
 * WP Title.
 *
 * @param string $title Where something interesting takes place.
 * @param string $sep Separator string.
 *
 * @return string
 */
function adontheme_wp_title( $title, $sep ) {
	global $paged, $page;

	if ( is_feed() ) {
		return $title;
	}

	// Add the site name.
	$title .= get_bloginfo( 'name' );

	// Add the site description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) ) {
		$title = "$title $sep $site_description";
	}

	// Add a page number if necessary.
	if ( $paged >= 2 || $page >= 2 ) {
		$title = "$title $sep " . sprintf( __( 'Page %s', 'adontheme' ), max( $paged, $page ) );
	}

	return $title;
}

add_filter( 'wp_title', 'adontheme_wp_title', 10, 2 );


if ( ! function_exists( 'core_mods' ) ) {
	/**
	 * Load jQuery.
	 */
	function core_mods() {
		if ( ! is_admin() ) {
			wp_deregister_script( 'jquery' );
			wp_register_script( 'jquery', ('http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js'), false );
			wp_enqueue_script( 'jquery' );
		}
	}

	add_action( 'wp_enqueue_scripts', 'core_mods' );
}

// Custom Menu.
register_nav_menu( 'primary', __( 'Navigation Menu', 'adontheme' ) );


/**
 * Navigation - update coming from twentythirteen.
 */
function post_navigation() {
	echo '<div class="navigation">';
	echo '	<div class="next-posts">' . esc_html( get_next_posts_link( '&laquo; Older Entries' ) ) . '</div>';
	echo '	<div class="prev-posts">' . esc_html( get_previous_posts_link( 'Newer Entries &raquo;' ) ) . '</div>';
	echo '</div>';
}

// Include theme options.
require_once( get_template_directory() . '/inc/options.php' );

// Widgets and Sidebars.
require_once( get_template_directory() . '/inc/widgets-sidebars.php' );

// Custom post types & Taxonomies.
require_once( get_template_directory() . '/inc/custom-post-types.php' );
require_once( get_template_directory() . '/inc/custom-taxonomies.php' );

// Filters and functions to manipulate content.
require_once( get_template_directory() . '/inc/filters.php' );

// Custom shortcodes.
require_once( get_template_directory() . '/inc/shortcodes.php' );
