<?php
/**
 * Bhaiyyantop Functions and Definitions
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

        // Let WordPress manage the document title.
        add_theme_support( 'title-tag' );

        // Enable support for Post Thumbnails on posts and pages.
        add_theme_support( 'post-thumbnails' );

        // Custom thumbnail sizes for news grid and hero sections
        add_image_size( 'bhaiyyantop-hero', 850, 450, true );
        add_image_size( 'bhaiyyantop-medium', 400, 260, true );
        add_image_size( 'bhaiyyantop-thumb', 120, 90, true );

        // Register Navigation Menus
        register_nav_menus( array(
            'primary' => esc_html__( 'Primary Menu', 'bhaiyyantop' ),
        ) );

        // Switch default core markup to HTML5
        add_theme_support( 'html5', array(
            'search-form',
            'comment-form',
            'comment-list',
            'gallery',
            'caption',
            'style',
            'script',
        ) );

        // Custom logo support
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
    // Enqueue Google Fonts (Noto Sans Devanagari)
    wp_enqueue_style( 'bhaiyyantop-fonts', 'https://fonts.googleapis.com/css2?family=Noto+Sans+Devanagari:wght@400;500;600;700;800;900&display=swap', array(), null );

    // Enqueue FontAwesome for icons
    wp_enqueue_style( 'font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css', array(), '6.4.0' );

    // Enqueue main stylesheet with filemtime versioning
    $theme_css_path = get_template_directory() . '/style.css';
    $theme_css_ver  = file_exists( $theme_css_path ) ? filemtime( $theme_css_path ) : '1.0.0';
    wp_enqueue_style( 'bhaiyyantop-style', get_stylesheet_uri(), array( 'bhaiyyantop-fonts', 'font-awesome' ), $theme_css_ver );

    // Enqueue single post CSS if viewing single article
    if ( is_single() ) {
        $single_css_path = get_template_directory() . '/assets/css/single.css';
        $single_css_ver  = file_exists( $single_css_path ) ? filemtime( $single_css_path ) : '1.0.0';
        wp_enqueue_style( 'bhaiyyantop-single-style', get_template_directory_uri() . '/assets/css/single.css', array( 'bhaiyyantop-style' ), $single_css_ver );
    }

    // Enqueue theme JS script for sticky navbar, search, and scroll throttling
    $theme_js_path = get_template_directory() . '/assets/js/theme.js';
    if ( file_exists( $theme_js_path ) ) {
        wp_enqueue_script( 'bhaiyyantop-theme-js', get_template_directory_uri() . '/assets/js/theme.js', array(), filemtime( $theme_js_path ), true );
    }
}
add_action( 'wp_enqueue_scripts', 'bhaiyyantop_scripts' );

/**
 * Add Resource Hints (DNS Prefetch & Preconnect) for Fonts and CDNs to improve Web Vitals
 */
function bhaiyyantop_resource_hints( $urls, $relation_type ) {
    if ( 'preconnect' === $relation_type ) {
        $urls[] = array(
            'href'        => 'https://fonts.googleapis.com',
            'crossorigin' => 'anonymous',
        );
        $urls[] = array(
            'href'        => 'https://fonts.gstatic.com',
            'crossorigin' => 'anonymous',
        );
        $urls[] = array(
            'href'        => 'https://cdnjs.cloudflare.com',
            'crossorigin' => 'anonymous',
        );
    }
    return $urls;
}
add_filter( 'wp_resource_hints', 'bhaiyyantop_resource_hints', 10, 2 );

/**
 * Register Widget Areas.
 */
function bhaiyyantop_widgets_init() {
    register_sidebar( array(
        'name'          => esc_html__( 'Main Sidebar', 'bhaiyyantop' ),
        'id'            => 'sidebar-1',
        'description'   => esc_html__( 'Add widgets here.', 'bhaiyyantop' ),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ) );
}
add_action( 'widgets_init', 'bhaiyyantop_widgets_init' );

/**
 * Helper to Get Category Permalink by Slug or Fallback to Home URL
 *
 * @param string $slug Category slug.
 * @return string Category URL.
 */
function bhaiyyantop_get_category_url( $slug = '' ) {
    if ( empty( $slug ) ) {
        return home_url( '/' );
    }

    $category = get_category_by_slug( $slug );
    if ( $category ) {
        return get_category_link( $category->term_id );
    }

    return home_url( '/' . sanitize_title( $slug ) . '/' );
}

/**
 * Get All Categories List for Navigation Defaults
 *
 * @return array Category data list.
 */
function bhaiyyantop_get_all_categories() {
    return array(
        'desh'       => array( 'name' => 'देश', 'url' => bhaiyyantop_get_category_url( 'desh' ) ),
        'duniya'     => array( 'name' => 'दुनिया', 'url' => bhaiyyantop_get_category_url( 'duniya' ) ),
        'business'   => array( 'name' => 'बिज़नेस', 'url' => bhaiyyantop_get_category_url( 'business' ) ),
        'khel'       => array( 'name' => 'खेल', 'url' => bhaiyyantop_get_category_url( 'khel' ) ),
        'technology' => array( 'name' => 'तकनीक', 'url' => bhaiyyantop_get_category_url( 'technology' ) ),
        'manoranjan' => array( 'name' => 'मनोरंजन', 'url' => bhaiyyantop_get_category_url( 'manoranjan' ) ),
        'swasthya'   => array( 'name' => 'स्वास्थ्य', 'url' => bhaiyyantop_get_category_url( 'swasthya' ) ),
        'auto'       => array( 'name' => 'ऑटो', 'url' => bhaiyyantop_get_category_url( 'auto' ) ),
        'blog'       => array( 'name' => 'ब्लॉग', 'url' => bhaiyyantop_get_category_url( 'blog' ) ),
    );
}

/**
 * Render Advertisement Block Component
 *
 * @param string $slot Ad slot identifier.
 */
function bhaiyyantop_render_ad_block( $slot = 'default' ) {
    $enable_ad = get_theme_mod( 'bhaiyyantop_enable_header_ad', false );
    $ad_code   = get_theme_mod( 'bhaiyyantop_header_ad_code', '' );

    if ( $enable_ad && ! empty( $ad_code ) ) {
        echo '<div class="ad-block-container ad-slot-' . esc_attr( $slot ) . '">';
        echo '<span class="ad-label">' . esc_html__( 'विज्ञापन', 'bhaiyyantop' ) . '</span>';
        echo '<div class="ad-content">' . wp_kses_post( $ad_code ) . '</div>';
        echo '</div>';
    }
}

/**
 * Include Theme Inc Modules
 */
require_once get_template_directory() . '/inc/posts-handler.php';
require_once get_template_directory() . '/inc/template-tags.php';
require_once get_template_directory() . '/inc/breadcrumbs.php';
require_once get_template_directory() . '/inc/related-posts.php';
require_once get_template_directory() . '/inc/author-box.php';
require_once get_template_directory() . '/inc/share-buttons.php';
require_once get_template_directory() . '/inc/customizer.php';
require_once get_template_directory() . '/inc/seo.php';
require_once get_template_directory() . '/inc/scripts-handler.php';
require_once get_template_directory() . '/inc/demo-import.php';
