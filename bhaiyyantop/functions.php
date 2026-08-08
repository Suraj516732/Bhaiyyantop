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
            'height'      => 112,
            'width'       => 400,
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
 * Defer non-critical theme scripts to improve FID and INP (Core Web Vitals)
 */
function bhaiyyantop_defer_theme_scripts( $tag, $handle, $src ) {
    if ( 'bhaiyyantop-theme-js' === $handle && false === strpos( $tag, 'defer' ) ) {
        return str_replace( ' src=', ' defer src=', $tag );
    }
    return $tag;
}
add_filter( 'script_loader_tag', 'bhaiyyantop_defer_theme_scripts', 10, 3 );

/**
 * Preload LCP Logo / Hero Assets to achieve Lighthouse 95+ score
 */
function bhaiyyantop_lcp_preload_hints() {
    $custom_logo = get_theme_mod( 'bhaiyyantop_logo' );
    if ( ! empty( $custom_logo ) ) {
        echo '<link rel="preload" as="image" href="' . esc_url( $custom_logo ) . '" fetchpriority="high" />' . "\n";
    }
}
add_action( 'wp_head', 'bhaiyyantop_lcp_preload_hints', 0 );

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
 * Helper to Get Category Permalink by Slug or Fallback to Home URL with Static Memory Cache
 *
 * @param string $slug Category slug.
 * @return string Category URL.
 */
function bhaiyyantop_get_category_url( $slug = '' ) {
    static $cat_urls = array();

    $clean_slug = sanitize_title( $slug );
    if ( empty( $clean_slug ) ) {
        return home_url( '/' );
    }

    if ( isset( $cat_urls[ $clean_slug ] ) ) {
        return $cat_urls[ $clean_slug ];
    }

    $category = get_category_by_slug( $clean_slug );
    if ( $category ) {
        $url = get_category_link( $category->term_id );
    } else {
        $url = home_url( '/' . $clean_slug . '/' );
    }

    $cat_urls[ $clean_slug ] = $url;
    return $url;
}

/**
 * Get All Categories List for Navigation Defaults with Static Memory Cache
 *
 * @return array Category data list.
 */
function bhaiyyantop_get_all_categories() {
    static $all_categories = null;

    if ( null !== $all_categories ) {
        return $all_categories;
    }

    $all_categories = get_transient( 'bhaiyyantop_all_categories_transient' );

    if ( false === $all_categories ) {
        $all_categories = array(
            'desh'       => array( 'name' => __( 'देश', 'bhaiyyantop' ), 'url' => bhaiyyantop_get_category_url( 'desh' ) ),
            'duniya'     => array( 'name' => __( 'दुनिया', 'bhaiyyantop' ), 'url' => bhaiyyantop_get_category_url( 'duniya' ) ),
            'business'   => array( 'name' => __( 'बिज़नेस', 'bhaiyyantop' ), 'url' => bhaiyyantop_get_category_url( 'business' ) ),
            'khel'       => array( 'name' => __( 'खेल', 'bhaiyyantop' ), 'url' => bhaiyyantop_get_category_url( 'khel' ) ),
            'technology' => array( 'name' => __( 'तकनीक', 'bhaiyyantop' ), 'url' => bhaiyyantop_get_category_url( 'technology' ) ),
            'manoranjan' => array( 'name' => __( 'मनोरंजन', 'bhaiyyantop' ), 'url' => bhaiyyantop_get_category_url( 'manoranjan' ) ),
            'swasthya'   => array( 'name' => __( 'स्वास्थ्य', 'bhaiyyantop' ), 'url' => bhaiyyantop_get_category_url( 'swasthya' ) ),
            'auto'       => array( 'name' => __( 'ऑटो', 'bhaiyyantop' ), 'url' => bhaiyyantop_get_category_url( 'auto' ) ),
            'blog'       => array( 'name' => __( 'ब्लॉग', 'bhaiyyantop' ), 'url' => bhaiyyantop_get_category_url( 'blog' ) ),
        );

        set_transient( 'bhaiyyantop_all_categories_transient', $all_categories, DAY_IN_SECONDS );
    }

    return $all_categories;
}

/**
 * Flush theme post transients on save, delete or customizer updates.
 */
function bhaiyyantop_flush_theme_transients() {
    delete_transient( 'bhaiyyantop_ticker_posts_5' );
    delete_transient( 'bhaiyyantop_ticker_posts_10' );
    delete_transient( 'bhaiyyantop_all_categories_transient' );
    delete_transient( 'bhaiyyantop_sidebar_recent_posts' );

    global $wpdb;
    if ( isset( $wpdb->options ) ) {
        $wpdb->query( "DELETE FROM {$wpdb->options} WHERE option_name LIKE '_transient_bhaiyyantop_recent_posts_%' OR option_name LIKE '_transient_timeout_bhaiyyantop_recent_posts_%'" );
    }
}
add_action( 'save_post', 'bhaiyyantop_flush_theme_transients' );
add_action( 'deleted_post', 'bhaiyyantop_flush_theme_transients' );
add_action( 'created_category', 'bhaiyyantop_flush_theme_transients' );
add_action( 'edited_category', 'bhaiyyantop_flush_theme_transients' );
add_action( 'delete_category', 'bhaiyyantop_flush_theme_transients' );
add_action( 'customize_save_after', 'bhaiyyantop_flush_theme_transients' );

/**
 * Render Ad Block with Output Escaping
 *
 * @param string $slot Ad slot identifier.
 */
function bhaiyyantop_render_ad_block( $slot = 'default' ) {
    $normalized_slot = str_replace( '-', '_', $slot );
    $slot_enable     = get_theme_mod( 'bhaiyyantop_ad_' . $normalized_slot . '_enable', get_theme_mod( 'bhaiyyantop_enable_header_ad', false ) );
    $ad_code         = get_theme_mod( 'bhaiyyantop_ad_' . $normalized_slot, get_theme_mod( 'bhaiyyantop_header_ad_code', '' ) );

    if ( $slot_enable && ! empty( $ad_code ) ) {
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
