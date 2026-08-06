<?php
/**
 * Bhaiyyantop functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Bhaiyyantop
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

if ( ! function_exists( 'bhaiyyantop_setup' ) ) :
    /**
     * Sets up theme defaults and registers support for various WordPress features.
     */
    function bhaiyyantop_setup() {
        // Add default posts and comments RSS feed links to head.
        add_theme_support( 'automatic-feed-links' );

        /*
         * Let WordPress manage the document title.
         * By adding theme support, we declare that this theme does not use a
         * hard-coded <title> tag in the document head, and WordPress will
         * provide it for us.
         */
        add_theme_support( 'title-tag' );

        /*
         * Enable support for Post Thumbnails on posts and pages.
         *
         * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
         */
        add_theme_support( 'post-thumbnails' );

        // Add custom thumbnail sizes for optimal image sizing
        add_image_size( 'bhaiyyantop-hero', 850, 450, true );
        add_image_size( 'bhaiyyantop-medium', 400, 260, true );
        add_image_size( 'bhaiyyantop-thumb', 120, 90, true );

        // Register Navigation Menus
        register_nav_menus( array(
            'primary' => esc_html__( 'Primary Menu', 'bhaiyyantop' ),
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
            'style',
            'script',
        ) );

        // Add support for custom logo
        add_theme_support( 'custom-logo', array(
            'height'      => 60,
            'width'       => 240,
            'flex-width'  => true,
            'flex-height' => true,
        ) );
    }
endif;
add_action( 'after_setup_theme', 'bhaiyyantop_setup' );

/**
 * Enqueue scripts and styles.
 */
function bhaiyyantop_scripts() {
    // Enqueue Google Fonts (Outfit & Noto Sans Devanagari for Hindi translation)
    wp_enqueue_style( 'bhaiyyantop-fonts', 'https://fonts.googleapis.com/css2?family=Noto+Sans+Devanagari:wght@400;600;700;900&family=Outfit:wght@400;600;700;800;900&display=swap', array(), null );

    // Enqueue FontAwesome for icons (e.g. search, arrows, bolt)
    wp_enqueue_style( 'font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css', array(), '6.4.0' );

    // Enqueue main stylesheet.
    wp_enqueue_style( 'bhaiyyantop-style', get_stylesheet_uri(), array( 'bhaiyyantop-fonts', 'font-awesome' ), '1.0.0' );

    // Enqueue theme javascript (handles carousel, ticker and ajax categories if needed)
    wp_enqueue_script( 'bhaiyyantop-scripts', get_template_directory_uri() . '/assets/js/theme.js', array(), '1.0.0', true );
}
add_action( 'wp_enqueue_scripts', 'bhaiyyantop_scripts' );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function bhaiyyantop_widgets_init() {
    register_sidebar( array(
        'name'          => esc_html__( 'Main Sidebar', 'bhaiyyantop' ),
        'id'            => 'sidebar-1',
        'description'   => esc_html__( 'Add widgets here to appear in your sidebar.', 'bhaiyyantop' ),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ) );

    register_sidebar( array(
        'name'          => esc_html__( 'Left Sidebar Area', 'bhaiyyantop' ),
        'id'            => 'left-sidebar',
        'description'   => esc_html__( 'Widgets appearing in the left column on the home page.', 'bhaiyyantop' ),
        'before_widget' => '<div id="%1$s" class="left-widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="left-widget-title">',
        'after_title'   => '</h4>',
    ) );

    register_sidebar( array(
        'name'          => esc_html__( 'Right Sidebar Area', 'bhaiyyantop' ),
        'id'            => 'right-sidebar',
        'description'   => esc_html__( 'Widgets appearing in the right column on the home page.', 'bhaiyyantop' ),
        'before_widget' => '<div id="%1$s" class="right-widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="right-widget-title">',
        'after_title'   => '</h4>',
    ) );
}
add_action( 'widgets_init', 'bhaiyyantop_widgets_init' );
