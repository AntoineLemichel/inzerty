<?php
/**
 * quna functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package quna
 */

if ( ! function_exists( 'quna_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function quna_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on quna, use a find and replace
		 * to change 'quna' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'quna', get_template_directory() . '/languages' );

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
		register_nav_menus( array(
			'menu-1' => esc_html__( 'Primary', 'quna' ),
		) );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'quna_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support( 'custom-logo', array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		) );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		// Add support for Block Styles.
		add_theme_support( 'wp-block-styles' );

		// Add support for full and wide align images.
		add_theme_support( 'align-wide' );

		// Add support for editor styles.
		add_theme_support( 'editor-styles' );

		// Enqueue editor styles.
		add_editor_style( 'style-editor.css' );

		// Add support for responsive embedded content.
		add_theme_support( 'responsive-embeds' );

		// Custom color palette
		/*
		add_theme_support( 'editor-color-palette', array(
			array(
				'name'  => __( 'Facebook', 'quna' ),
				'slug'  => 'color-facebook',
				'color'	=> '#3b5999',
			),
			array(
				'name'  => __( 'Twitter', 'quna' ),
				'slug'  => 'color-twitter',
				'color'	=> '#55acee',
			),
			array(
				'name'  => __( 'Instagram', 'quna' ),
				'slug'  => 'color-twitter',
				'color'	=> '#e4405f',
			),
			array(
				'name'  => __( 'Linkedin', 'quna' ),
				'slug'  => 'color-linkedin',
				'color'	=> '#0077B5',
			),
			array(
				'name'  => __( 'VK', 'quna' ),
				'slug'  => 'color-vk',
				'color'	=> '#4c75a3',
			),
			array(
				'name'  => __( 'YouTube', 'quna' ),
				'slug'  => 'color-youtube',
				'color'	=> '#cd201f',
			),
			array(
				'name'  => __( 'Github', 'quna' ),
				'slug'  => 'color-github',
				'color'	=> '#24292e',
			),
			array(
				'name'  => __( 'Google', 'quna' ),
				'slug'  => 'color-google',
				'color'	=> '#dd4b39',
			),
			array(
				'name'  => __( 'Behance', 'quna' ),
				'slug'  => 'color-behance',
				'color'	=> '#131418',
			),
			array(
				'name'  => __( 'Whats App', 'quna' ),
				'slug'  => 'color-whatsapp',
				'color'	=> '#128c7e',
			),
			array(
				'name'  => __( 'Line', 'quna' ),
				'slug'  => 'color-line',
				'color'	=> '#00c300',
			),
		));
		*/

		add_image_size('quna_square_large', 600, 600, true);

	}
endif;
add_action( 'after_setup_theme', 'quna_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function quna_content_width() {
	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = apply_filters( 'quna_content_width', 640 );
}
add_action( 'after_setup_theme', 'quna_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function quna_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'quna' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'quna' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Footer 1', 'quna' ),
		'id'            => 'sidebar-2',
		'description'   => esc_html__( 'Add widgets here.', 'quna' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Footer 2', 'quna' ),
		'id'            => 'sidebar-3',
		'description'   => esc_html__( 'Add widgets here.', 'quna' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Footer 3', 'quna' ),
		'id'            => 'sidebar-4',
		'description'   => esc_html__( 'Add widgets here.', 'quna' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Footer 4', 'quna' ),
		'id'            => 'sidebar-5',
		'description'   => esc_html__( 'Add widgets here.', 'quna' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Footer 5', 'quna' ),
		'id'            => 'sidebar-6',
		'description'   => esc_html__( 'Add widgets here.', 'quna' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}

add_action( 'widgets_init', 'quna_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function quna_scripts() {
	wp_enqueue_style( 'quna-fontawesome', get_template_directory_uri() . '/assets/fontawesome/fontawesome-all.min.css', array(), '5.2.0' );

	$body_font = get_theme_mod('quna_body_gfont', 'Roboto:400,400i,500,700,700i,900,900i');
	$heading_font = get_theme_mod('quna_heading_gfont', 'Dosis:400,500,600,700,800');

	if($body_font) {
		wp_enqueue_style( 'quna-body-googlefont', '//fonts.googleapis.com/css?family='.$body_font);
	}
	if($heading_font) {
		wp_enqueue_style( 'quna-heading-googlefont', '//fonts.googleapis.com/css?family='.$heading_font );
	}

	wp_enqueue_style( 'quna-style', get_stylesheet_uri() );

	wp_enqueue_script( 'quna-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20151215', true );

	wp_enqueue_script( 'quna-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'quna_scripts' );

/**
 * Enqueue block editor styles.
 */
function quna_editor_customizer_styles() {

	wp_enqueue_style( 'quna-fontawesome', get_template_directory_uri() . '/assets/fontawesome/fontawesome-all.min.css', array(), '5.2.0' );

	$body_font = get_theme_mod('quna_body_gfont', 'Roboto:400,400i,500,700,700i,900,900i');
	$heading_font = get_theme_mod('quna_heading_gfont', 'Dosis:400,500,600,700,800');

	if($body_font) {
		wp_enqueue_style( 'quna-body-googlefont', '//fonts.googleapis.com/css?family='.$body_font);
	}
	if($heading_font) {
		wp_enqueue_style( 'quna-heading-googlefont', '//fonts.googleapis.com/css?family='.$heading_font );
	}

	wp_enqueue_style( 'quna-editor-customizer-styles', get_theme_file_uri( '/style-editor.css' ), false, '1.0', 'all' );
	wp_add_inline_style( 'quna-editor-customizer-styles', quna_editor_css() );

	/*
	wp_enqueue_style( 'twentynineteen-editor-customizer-styles', get_theme_file_uri( '/style-editor-customizer.css' ), false, '1.0', 'all' );

	if ( 'custom' === get_theme_mod( 'primary_color' ) ) {
		// Include color patterns.
		require_once get_parent_theme_file_path( '/inc/color-patterns.php' );
		wp_add_inline_style( 'twentynineteen-editor-customizer-styles', twentynineteen_custom_colors_css() );
	}
	*/

}
add_action( 'enqueue_block_editor_assets', 'quna_editor_customizer_styles' );

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
require get_template_directory() . '/inc/customizer/font-family.php';
require get_template_directory() . '/inc/customizer/font-size.php';
require get_template_directory() . '/inc/customizer/social.php';
require get_template_directory() . '/inc/customizer/social-feeds.php';
require get_template_directory() . '/inc/customizer/page.php';
require get_template_directory() . '/inc/customizer/post.php';

/**
 * Inline styles function.
 */
require get_template_directory() . '/inc/inline-styles.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

/**
 * Load WooCommerce compatibility file.
 */
if ( class_exists( 'WooCommerce' ) ) {
	require get_template_directory() . '/inc/woocommerce.php';
}
