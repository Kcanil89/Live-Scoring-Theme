<?php
/**
 * Live Scoring Theme functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Live_Scoring_Theme
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function live_scoring_theme_setup() {
	/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on Live Scoring Theme, use a find and replace
		* to change 'live-scoring-theme' to the name of your theme in all the template files.
		*/
	load_theme_textdomain( 'live-scoring-theme', get_template_directory() . '/languages' );

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

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus(
		array(
			'menu-1' => esc_html__( 'Primary', 'live-scoring-theme' ),
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
			'live_scoring_theme_custom_background_args',
			array(
				'default-color' => 'ffffff',
				'default-image' => '',
			)
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
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		)
	);
}
add_action( 'after_setup_theme', 'live_scoring_theme_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function live_scoring_theme_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'live_scoring_theme_content_width', 640 );
}
add_action( 'after_setup_theme', 'live_scoring_theme_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function live_scoring_theme_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'live-scoring-theme' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'live-scoring-theme' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'live_scoring_theme_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function live_scoring_theme_scripts() {
	wp_enqueue_style( 'live-scoring-theme-style', get_stylesheet_uri(), array(), _S_VERSION );
	wp_style_add_data( 'live-scoring-theme-style', 'rtl', 'replace' );

	wp_enqueue_script( 'live-scoring-theme-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'live_scoring_theme_scripts' );

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
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

// Enqueue theme styles and scripts
function live_scoring_theme_enqueue_scripts() {
    wp_enqueue_style('main-style', get_stylesheet_uri());
    wp_enqueue_script('main-js', get_template_directory_uri() . '/js/main.js', array('jquery'), '1.0', true);
}
add_action('wp_enqueue_scripts', 'live_scoring_theme_enqueue_scripts');

function live_scoring_custom_scripts() {
    wp_enqueue_style('live-scoring-style', get_stylesheet_uri());
    wp_enqueue_script('custom-js', get_template_directory_uri() . '/js/custom.js', array('jquery'), '', true);
}
add_action('wp_enqueue_scripts', 'live_scoring_custom_scripts');


// Register Menus
function live_scoring_register_menus() {
    register_nav_menus(array(
        'main-menu' => __('Main Menu', 'live-scoring-theme'),
    ));
}
add_action('init', 'live_scoring_register_menus');

// Add support for thumbnails and title tag
function live_scoring_theme_support() {
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
}
add_action('after_setup_theme', 'live_scoring_theme_support');

// Register Custom Post Type for Matches

// Enqueue styles and scripts
function live_scoring_enqueue_scripts() {
    wp_enqueue_style('main-style', get_stylesheet_uri());
    wp_enqueue_script('main-js', get_template_directory_uri() . '/assets/js/main.js', array('jquery'), '1.0', true);
}
add_action('wp_enqueue_scripts', 'live_scoring_enqueue_scripts');


// Register Custom Post Type for Matches
function live_scoring_register_post_type() {
    $labels = array(
        'name'               => 'Matches',
        'singular_name'      => 'Match',
        'menu_name'          => 'Matches',
        'name_admin_bar'     => 'Match',
        'add_new'            => 'Add New Match',
        'add_new_item'       => 'Add New Match',
        'new_item'           => 'New Match',
        'edit_item'          => 'Edit Match',
        'view_item'          => 'View Match',
        'all_items'          => 'All Matches',
        'search_items'       => 'Search Matches',
        'parent_item_colon'  => 'Parent Matches:',
        'not_found'          => 'No matches found.',
        'not_found_in_trash' => 'No matches found in Trash.'
    );
    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array('slug' => 'matches'),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => 5,
        'supports'           => array('title', 'editor', 'thumbnail'),
    );
    register_post_type('matches', $args);
}
add_action('init', 'live_scoring_register_post_type');

// Add Custom Meta Boxes for Matches
function live_scoring_add_meta_boxes() {
    add_meta_box('match_info', 'Match Information', 'live_scoring_match_info_meta_box', 'matches', 'normal', 'high');
}
add_action('add_meta_boxes', 'live_scoring_add_meta_boxes');

function live_scoring_match_info_meta_box($post) {
    $team_1 = get_post_meta($post->ID, 'team_1', true);
    $team_2 = get_post_meta($post->ID, 'team_2', true);
    $match_time = get_post_meta($post->ID, 'match_time', true);
    $venue = get_post_meta($post->ID, 'venue', true);
    
    echo '<label for="team_1">Team 1</label>';
    echo '<input type="text" id="team_1" name="team_1" value="' . esc_attr($team_1) . '" class="widefat" />';
    
    echo '<label for="team_2">Team 2</label>';
    echo '<input type="text" id="team_2" name="team_2" value="' . esc_attr($team_2) . '" class="widefat" />';
    
    echo '<label for="match_time">Match Time</label>';
    echo '<input type="datetime-local" id="match_time" name="match_time" value="' . esc_attr($match_time) . '" class="widefat" />';
    
    echo '<label for="venue">Venue</label>';
    echo '<input type="text" id="venue" name="venue" value="' . esc_attr($venue) . '" class="widefat" />';
}

// Save Meta Box Data
function live_scoring_save_meta_box_data($post_id) {
    if (array_key_exists('team_1', $_POST)) {
        update_post_meta($post_id, 'team_1', sanitize_text_field($_POST['team_1']));
    }
    if (array_key_exists('team_2', $_POST)) {
        update_post_meta($post_id, 'team_2', sanitize_text_field($_POST['team_2']));
    }
    if (array_key_exists('match_time', $_POST)) {
        update_post_meta($post_id, 'match_time', sanitize_text_field($_POST['match_time']));
    }
    if (array_key_exists('venue', $_POST)) {
        update_post_meta($post_id, 'venue', sanitize_text_field($_POST['venue']));
    }
}
add_action('save_post', 'live_scoring_save_meta_box_data');


// Register Widgets
function live_scoring_widgets_init() {
    register_sidebar(array(
        'name'          => __('Footer Widget Area', 'live-scoring-theme'),
        'id'            => 'footer-1',
        'description'   => __('Widgets added here will appear in the footer.', 'live-scoring-theme'),
        'before_widget' => '<div class="footer-widget">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ));
}
add_action('widgets_init', 'live_scoring_widgets_init');

function live_scoring_register_widgets() {
    register_sidebar(array(
        'name'          => __('Footer Widget Area 1', 'live-scoring-theme'),
        'id'            => 'footer-widget-1',
        'before_widget' => '<div class="footer-widget">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="footer-widget-title">',
        'after_title'   => '</h3>',
    ));
    register_sidebar(array(
        'name'          => __('Footer Widget Area 2', 'live-scoring-theme'),
        'id'            => 'footer-widget-2',
        'before_widget' => '<div class="footer-widget">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="footer-widget-title">',
        'after_title'   => '</h3>',
    ));
    register_sidebar(array(
        'name'          => __('Footer Widget Area 3', 'live-scoring-theme'),
        'id'            => 'footer-widget-3',
        'before_widget' => '<div class="footer-widget">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="footer-widget-title">',
        'after_title'   => '</h3>',
    ));
    register_sidebar(array(
        'name'          => __('Footer Widget Area 4', 'live-scoring-theme'),
        'id'            => 'footer-widget-4',
        'before_widget' => '<div class="footer-widget">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="footer-widget-title">',
        'after_title'   => '</h3>',
    ));
}
add_action('widgets_init', 'live_scoring_register_widgets');

