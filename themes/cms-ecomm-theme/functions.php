<?php
/**
 * CMS2 eCOMM Theme functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package CMS2_eCOMM_Theme
 */

if ( ! defined( 'cms-ecomm_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( 'cms-ecomm_VERSION', '1.0.0' );
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function cms_ecomm_setup() {
	/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on CMS2 eCOMM Theme, use a find and replace
		* to change 'cms-ecomm' to the name of your theme in all the template files.
		*/
	load_theme_textdomain( 'cms-ecomm', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
		* Let WordPress manage the document title.
		* By adding theme support, we declare that this theme does not use a
		* hard-coded <title> tag in the document head, and expect WordPress to
		* provide it for us.
		*/
	add_theme_support( 'title-tag' );

	/*
		* Enable support for Post Thumbnails on posts and pages.
		*
		* @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		*/
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in two locations.
	register_nav_menus(
		array(
			'menu-header' => esc_html__( 'Header Menu', 'cms-ecomm' ),
			'menu-footer' => esc_html__( 'Footer Menu', 'cms-ecomm' ),
		)
	);

	/*
		* Switch default core markup for search form, comment form, and comments
		* to output valid HTML5.
		*/
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	/**
	 * Add support for core custom logo.
	 *
	 * @link https://codex.wordpress.org/Theme_Logo
	 */
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 512,
			'width'       => 512,
			'flex-width'  => true,
			'flex-height' => true,
		)
	);

	remove_theme_support('core-block-patterns');

	// apply styles to embedded content to reflect the aspect ratio of content that is embedded in an iFrame
	add_theme_support( 'responsive-embeds' );

	add_theme_support( 'wp-block-styles' );
}
add_action( 'after_setup_theme', 'cms_ecomm_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function cms_ecomm_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'cms_ecomm_content_width', 960 );
}
add_action( 'after_setup_theme', 'cms_ecomm_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function cms_ecomm_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'cms-ecomm' ),
			'id'            => 'sidebar-main',
			'description'   => esc_html__( 'Add widgets here.', 'cms-ecomm' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'cms_ecomm_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function cms_ecomm_scripts() {
	
	wp_enqueue_style( 
		'cms-ecomm-style', 
		get_stylesheet_uri(), 
		array(), 
		'cms-ecomm_VERSION'
	);

	wp_enqueue_script( 
		'what-input-script', 
		get_template_directory_uri() . '/assets/js/vendor/what-input.js', 
		array( 'jquery' ), 
		'5.2.10',
		true
	);

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'cms_ecomm_scripts' );

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';


/**
 * Block Editor additions.
 */
require get_template_directory() . '/inc/block-editor.php';

/**
 * Custom Post Type additions.
 */
require get_template_directory() . '/inc/post-types.php';


/**
 * Add class to hide entry header and entry footer titles on pages
 */
function cms_ecomm_hidetitle_class($classes) {
	if ( is_page() ) : 
		$classes[] = 'hidetitle';
		return $classes;
	endif; 
	return $classes;
}
add_filter('post_class', 'cms_ecomm_hidetitle_class');

/**
 * Add function to display 3 posts with a specific category assigned
 */
function cms_ecomm_posts_by_category() {

	$getNewsPosts_query = new WP_Query( array( 
		'category_name' => 'News', 
		'posts_per_page' => 3
	) ); 

	$string = '';

	if ( $getNewsPosts_query->have_posts() ) {
		$string .= '<ul class="postsbycategory widget_recent_entries">';
		while ( $getNewsPosts_query->have_posts() ) {
			$getNewsPosts_query->the_post();
				if ( has_post_thumbnail() ) {
				$string .= '<li>';
				$string .= '<a href="' . get_the_permalink() .'" rel="bookmark">' . get_the_post_thumbnail($post_id, array( 50, 50) ) . get_the_title() .'</a></li>';
				} else { 
				// if no featured image is found
				$string .= '<li><a href="' . get_the_permalink() .'" rel="bookmark">' . get_the_title() .'</a></li>';
				}
			}
		} else {
		// no posts found
	$string .= '<li>No Posts Found</li>';
	}
	$string .= '</ul>';

	return $string;

	/* Restore original Post Data */
	wp_reset_postdata();
}
add_shortcode('news_posts', 'cms_ecomm_posts_by_category');


/* Add a function to display latest 3 posts */
function cms_ecomm_latest_three_posts() {

	$getThreeLastPosts_query = new WP_Query( array( 
		'posts_per_page' => 3
	) );

	$string = '';

	if ( $getThreeLastPosts_query->have_posts() ) {
		$string .= '<ul class="latestPosts widget_recent_entries">';
		while ( $getThreeLastPosts_query->have_posts() ) {
			$getThreeLastPosts_query->the_post();
				if ( has_post_thumbnail() ) {
				$string .= '<li>';
				$string .= '<a href="' . get_the_permalink() .'" rel="bookmark">' . get_the_post_thumbnail($post_id, array( 50, 50) ) . get_the_title() .'</a></li>';
				} else { // no featured image is found
				$string .= '<li><a href="' . get_the_permalink() .'" rel="bookmark">' . get_the_title() .'</a></li>';
				}
			}
		} else {// no posts found
	$string .= '<li>No Posts Found</li>';
	}
	$string .= '</ul>';

	return $string;

	/* Restore original Post Data */
	wp_reset_postdata();
}
add_shortcode('latest_posts', 'cms_ecomm_latest_three_posts');
