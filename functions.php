<?php
/**
 * familyplanner functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package familyplanner
 */

if ( ! function_exists( 'familyplanner_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function familyplanner_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on familyplanner, use a find and replace
		 * to change 'familyplanner' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'familyplanner', get_template_directory() . '/languages' );

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
		register_nav_menus( [
			'sidebar' => 'Side Menu',
			'footer-main' => 'Footer Menu',
			'footer-social'	=> 'Footer Social Media',
		 ] );

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
		add_theme_support( 'custom-background', apply_filters( 'familyplanner_custom_background_args', array(
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
	}
endif;
add_action( 'after_setup_theme', 'familyplanner_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function familyplanner_content_width() {
	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = apply_filters( 'familyplanner_content_width', 640 );
}
add_action( 'after_setup_theme', 'familyplanner_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function familyplanner_widgets_init() {
	register_sidebar( array(
		'name'          => 'Search',
		'id'            => 'search-function',
		'description'   => 'Search Widget',
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'familyplanner_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function familyplanner_scripts() {
	wp_enqueue_style( 'familyplanner-style', get_stylesheet_uri() );

	wp_enqueue_script( 'familyplanner-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20151215', true );

	wp_enqueue_script( 'familyplanner-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	wp_enqueue_script( 
		"familyplanner-slider", //script name (for usage by other tools)
		get_template_directory_uri() ."/js/scripts.js", //Script file path
		['jquery'], //This script uses jquery
	   	"1.0", //Script version. Change this for cache-breaking purposes
		true //Load script in footer of site (instead of head)
	);
}
add_action( 'wp_enqueue_scripts', 'familyplanner_scripts' );

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


add_shortcode("contrived-example", "contrived_example_func");
function contrived_example_func( $atts, $content = null ) {
	//Filter $atts to only use those attributes we've specifically defined and support
	$atts = shortcode_atts([
		"title" => "Default Title",
		"image" => get_stylesheet_directory_uri() . "/img/logo.png"
	], $atts, "contrived-example");
	//We are got to create formatted content block with a background image
	//We are not allowed to echo anything while in a shortcode, so use the ob
	//to buffer the output and then just return the string we get when we
	//clear out the buffer

	//TODO:
	ob_start(); // Start buffering output
	?>
	    <div class="contrived-example" style="background-image: url(<?php echo $atts['image']; ?>)">
        <h2><?php echo $atts['title']; ?></h2>
        <p><?php echo $content; ?></p>
    	</div>
	<?php

	return ob_get_clean(); // Retrieve buffered output, then clear the buffer
}

add_shortcode("familyplanner-slider", "familyplanner_slider_func");
function familyplanner_slider_func($atts, $content = null) {
	// Legal attributes
	$atts = shortcode_atts([
		"ids" => null
	], $atts, "familyplanner-slider");
	// Null ids => slider cannot run!
	if (is_null($atts['ids'])) {
		error_log("familyplanner-slider: No IDs specified");
		return "";
	}
	// 'ids' is a comma-separated list of image ids (from the media library)
	// explode converts this into an array
	$ids = explode(",", $atts['ids']);
	//error_log(print_r($ids, true));
	ob_start();
	?>
	<div id="familyplanner-slider">
		<?php
		foreach ($ids as $id) :
			//https://developer.wordpress.org/reference/functions/wp_get_attachment_image/
			echo wp_get_attachment_image($id, $size = '150%');
		endforeach;
		?>
	</div>
	<?php
	return ob_get_clean();
}

add_shortcode("family-slider", "family_slider_func");
function family_slider_func($atts, $content = null) {
	// Legal attributes
	$atts = shortcode_atts([
		"ids" => null
	], $atts, "family-slider");
	// Null ids => slider cannot run!
	if (is_null($atts['ids'])) {
		error_log("family-slider: No IDs specified");
		return "";
	}
	// 'ids' is a comma-separated list of image ids (from the media library)
	// explode converts this into an array
	$ids = explode(",", $atts['ids']);
	//error_log(print_r($ids, true));
	ob_start();
	?>
	<div id="family-slider">
		<?php
		foreach ($ids as $id) :
			//https://developer.wordpress.org/reference/functions/wp_get_attachment_image/
			echo wp_get_attachment_image($id, 'full');
		endforeach;
		?>
	</div>
	<?php
	return ob_get_clean();
}