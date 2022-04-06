<?php

/**
 * BMW Golf Cup functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package BMW_Golf_Cup
 */

if (!defined('_S_VERSION')) {
	// Replace the version number of the theme on each release.
	define('_S_VERSION', '1.0.0');
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function bmwgolfcup_setup()
{
	/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on BMW Golf Cup, use a find and replace
		* to change 'bmwgolfcup' to the name of your theme in all the template files.
		*/
	load_theme_textdomain('bmwgolfcup', get_template_directory() . '/languages');

	// Add default posts and comments RSS feed links to head.
	add_theme_support('automatic-feed-links');

	/*
		* Let WordPress manage the document title.
		* By adding theme support, we declare that this theme does not use a
		* hard-coded <title> tag in the document head, and expect WordPress to
		* provide it for us.
		*/
	add_theme_support('title-tag');

	/*
		* Enable support for Post Thumbnails on posts and pages.
		*
		* @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		*/
	add_theme_support('post-thumbnails');

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus(
		array(
			'menu-1' => esc_html__('Primary', 'bmwgolfcup'),
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

	// Set up the WordPress core custom background feature.
	add_theme_support(
		'custom-background',
		apply_filters(
			'bmwgolfcup_custom_background_args',
			array(
				'default-color' => 'ffffff',
				'default-image' => '',
			)
		)
	);

	// Add theme support for selective refresh for widgets.
	add_theme_support('customize-selective-refresh-widgets');

	/**
	 * Add support for core custom logo.
	 *
	 * @link https://codex.wordpress.org/Theme_Logo
	 */
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		)
	);
}
add_action('after_setup_theme', 'bmwgolfcup_setup');

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function bmwgolfcup_content_width()
{
	$GLOBALS['content_width'] = apply_filters('bmwgolfcup_content_width', 640);
}
add_action('after_setup_theme', 'bmwgolfcup_content_width', 0);

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function bmwgolfcup_widgets_init()
{
	register_sidebar(
		array(
			'name'          => esc_html__('Sidebar', 'bmwgolfcup'),
			'id'            => 'sidebar-1',
			'description'   => esc_html__('Add widgets here.', 'bmwgolfcup'),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action('widgets_init', 'bmwgolfcup_widgets_init');

/**
 * Enqueue scripts and styles.
 */
function bmwgolfcup_scripts()
{
	wp_enqueue_style('bmwgolfcup-style', get_stylesheet_uri() . '?v=' . time(), array(), _S_VERSION);
	wp_style_add_data('bmwgolfcup-style', 'rtl', 'replace');

	wp_enqueue_script('jquery', 'https://code.jquery.com/jquery-3.6.0.min.js', array(), _S_VERSION, true);
	
	wp_enqueue_script('bmwgolfcup-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true);
	wp_enqueue_script('bmwgolfcup-customizer', get_template_directory_uri() . '/js/customizer.js?v='.time(), array(), _S_VERSION, true);

	if (is_singular() && comments_open() && get_option('thread_comments')) {
		wp_enqueue_script('comment-reply');
	}
}
add_action('wp_enqueue_scripts', 'bmwgolfcup_scripts');


function bmwgolfcup_admin_scripts($hook)
{
	wp_enqueue_script('custom-script', get_template_directory_uri() . '/js/custom-admin-script.js?v=' . time());
}
add_action('admin_enqueue_scripts', 'bmwgolfcup_admin_scripts');

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

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
 * Load Jetpack compatibility file.
 */
if (defined('JETPACK__VERSION')) {
	require get_template_directory() . '/inc/jetpack.php';
}


function bmwgolfcup_on_wp_initialization()
{
	session_start();

	global $pagenow;
	$request_uri = $_SERVER['REQUEST_URI'];

	$pos = strpos($request_uri, "wp-admin");

	if (!$pos && $pagenow != 'wp-login.php' && $pagenow != 'login.php' && $pagenow != 'participant.php') {
		if (!isset($_SESSION["bmwgolfcup_user_id"])) {
			wp_safe_redirect( get_home_url() . '/login.php', 302);
			exit();
		}
	}
}
add_action('init', 'bmwgolfcup_on_wp_initialization');

/**
 * Add the media popup to the page 'toplevel_page_participant'
 */
function page_enqueue_media_scripts()
{
	$screen = get_current_screen();
	if ($screen->base == 'toplevel_page_participant') wp_enqueue_media();
}
add_action('admin_enqueue_scripts', 'page_enqueue_media_scripts');


/**
 * Replace the [username] in the_content
 */
function replace_text_wps($text){
	$userObj = null;

	if (isset($_SESSION["bmwgolfcup_user_id"])) {
		$userObj = $_SESSION["participant"];
	}


	$replace = array(
			// 'WORD TO REPLACE' => 'REPLACE WORD WITH THIS'
			'[username]' => '<span class="font-bold">' . $userObj->name . '</span>'
	);
	$text = str_replace(array_keys($replace), $replace, $text);
	return $text;
}
add_filter('the_content', 'replace_text_wps');


/**
 * Create website setting
 */
if (function_exists('acf_add_options_page')) {
	acf_add_options_page(
		array(
			'page_title' => 'Website Settings',
			'menu_title' => 'Website Settings',
			'menu_slug' => 'website-settings',
			'capability' => 'edit_posts'
		)
	);
}

/**
 * Redirect 404 page to home page
 */
function redirect_404s() {
	if(is_404()) {
			wp_redirect(home_url(), '301');
	}
}
add_action('wp_enqueue_scripts', 'redirect_404s');
