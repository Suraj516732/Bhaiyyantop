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
    // Enqueue Google Fonts (Noto Sans Devanagari for whole website)
    wp_enqueue_style( 'bhaiyyantop-fonts', 'https://fonts.googleapis.com/css2?family=Noto+Sans+Devanagari:wght@400;500;600;700;800;900&display=swap', array(), null );

    // Enqueue FontAwesome for icons (e.g. search, arrows, bolt)
    wp_enqueue_style( 'font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css', array(), '6.4.0' );

    // Enqueue main stylesheet with dynamic filemtime versioning
    $theme_css_path = get_template_directory() . '/style.css';
    $theme_css_ver  = file_exists( $theme_css_path ) ? filemtime( $theme_css_path ) : '1.0.0';
    wp_enqueue_style( 'bhaiyyantop-style', get_stylesheet_uri(), array( 'bhaiyyantop-fonts', 'font-awesome' ), $theme_css_ver );

    // Enqueue single post CSS if viewing single article with filemtime versioning
    if ( is_single() ) {
        $single_css_path = get_template_directory() . '/assets/css/single.css';
        $single_css_ver  = file_exists( $single_css_path ) ? filemtime( $single_css_path ) : '1.0.0';
        wp_enqueue_style( 'bhaiyyantop-single-style', get_template_directory_uri() . '/assets/css/single.css', array( 'bhaiyyantop-style' ), $single_css_ver );
    }
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

/**
 * Get custom category URL path
 */
function bhaiyyantop_get_category_url( $slug ) {
    if ( empty( $slug ) || $slug === 'home' || $slug === 'all' ) {
        return function_exists( 'home_url' ) ? home_url( '/' ) : '/';
    }
    
    if ( function_exists( 'get_category_by_slug' ) ) {
        $cat = get_category_by_slug( $slug );
        if ( $cat && ! is_wp_error( $cat ) ) {
            return get_category_link( $cat->term_id );
        }
    }
    
    return function_exists( 'home_url' ) ? home_url( '/category/' . esc_attr( $slug ) . '/' ) : '/category/' . esc_attr( $slug ) . '/';
}

/**
 * List of all site categories with name, slug, and path
 */
function bhaiyyantop_get_all_categories() {
    return array(
        'desh'       => array( 'name' => 'देश', 'slug' => 'desh', 'url' => bhaiyyantop_get_category_url('desh') ),
        'duniya'     => array( 'name' => 'दुनिया', 'slug' => 'duniya', 'url' => bhaiyyantop_get_category_url('duniya') ),
        'business'   => array( 'name' => 'बिज़नेस', 'slug' => 'business', 'url' => bhaiyyantop_get_category_url('business') ),
        'technology' => array( 'name' => 'टेक्नोलॉजी', 'slug' => 'technology', 'url' => bhaiyyantop_get_category_url('technology') ),
        'khel'       => array( 'name' => 'खेल', 'slug' => 'khel', 'url' => bhaiyyantop_get_category_url('khel') ),
        'manoranjan' => array( 'name' => 'मनोरंजन', 'slug' => 'manoranjan', 'url' => bhaiyyantop_get_category_url('manoranjan') ),
        'swasthya'   => array( 'name' => 'स्वास्थ्य', 'slug' => 'swasthya', 'url' => bhaiyyantop_get_category_url('swasthya') ),
        'lifestyle'  => array( 'name' => 'लाइफस्टाइल', 'slug' => 'lifestyle', 'url' => bhaiyyantop_get_category_url('lifestyle') ),
        'blog'       => array( 'name' => 'ब्लॉग', 'slug' => 'blog', 'url' => bhaiyyantop_get_category_url('blog') ),
        'video'      => array( 'name' => 'वीडियो', 'slug' => 'video', 'url' => bhaiyyantop_get_category_url('video') ),
    );
}

/**
 * Function to retrieve recent posts for homepage sections
 *
 * @param array $args Parameters for posts query (numberposts, category, exclude)
 * @return array List of post objects or formatted post arrays
 */
function bhaiyyantop_get_recent_posts( $args = array() ) {
    $defaults = array(
        'numberposts' => 10,
        'category'    => '',
        'exclude'     => array(),
        'orderby'     => 'date',
        'order'       => 'DESC',
    );

    $parsed_args = wp_parse_args( $args, $defaults );
    $posts = array();

    if ( function_exists( 'get_posts' ) ) {
        $query_args = array(
            'posts_per_page' => $parsed_args['numberposts'],
            'post_status'    => 'publish',
            'orderby'        => $parsed_args['orderby'],
            'order'          => $parsed_args['order'],
        );

        if ( ! empty( $parsed_args['category'] ) ) {
            $query_args['category_name'] = $parsed_args['category'];
        }

        if ( ! empty( $parsed_args['exclude'] ) ) {
            $query_args['post__not_in'] = (array) $parsed_args['exclude'];
        }

        $wp_posts = get_posts( $query_args );

        if ( ! empty( $wp_posts ) ) {
            foreach ( $wp_posts as $p ) {
                $cats = get_the_category( $p->ID );
                $cat_name = ! empty( $cats ) ? $cats[0]->name : 'समाचार';
                $cat_slug = ! empty( $cats ) ? $cats[0]->slug : 'samachar';
                $thumb_id = get_post_thumbnail_id( $p->ID );
                $thumb_url = $thumb_id ? wp_get_attachment_image_url( $thumb_id, 'bhaiyyantop-medium' ) : '';

                $posts[] = array(
                    'id'          => $p->ID,
                    'title'       => get_the_title( $p ),
                    'permalink'   => get_permalink( $p ),
                    'date'        => get_the_date( 'j F, Y', $p ),
                    'author'      => get_the_author_meta( 'display_name', $p->post_author ),
                    'category'    => $cat_name,
                    'cat_slug'    => $cat_slug,
                    'cat_url'     => bhaiyyantop_get_category_url( $cat_slug ),
                    'thumbnail'   => $thumb_url,
                    'excerpt'     => get_the_excerpt( $p ),
                );
            }
            return $posts;
        }
    }

    // Fallback dynamic mock data when running locally or if database has no posts
    $theme_uri = get_template_directory_uri();
    
    $mock_all = array(
        array(
            'id'        => 101,
            'title'     => 'दिल्ली में प्रदूषण का स्तर फिर बढ़ा, जानें कारण और बचाव के उपाय',
            'permalink' => bhaiyyantop_get_category_url('desh') . '#post-101',
            'date'      => '1 जुलाई, 2024',
            'author'    => 'bhaiyantop',
            'category'  => 'देश',
            'cat_slug'  => 'desh',
            'cat_url'   => bhaiyyantop_get_category_url('desh'),
            'thumbnail' => $theme_uri . '/assets/images/hero_india_gate.png',
            'excerpt'   => 'दिल्ली-एनसीआर में वायु प्रदूषण खतरनाक स्तर पर पहुंचा। विशेषज्ञों ने लोगों को सतर्क रहने और मास्क पहनने की सलाह दी है...',
        ),
        array(
            'id'        => 102,
            'title'     => 'कम बजट में हेल्दी डाइट के टिप्स: रोज़मर्रा के खाने में लाएं बदलाव',
            'permalink' => bhaiyyantop_get_category_url('swasthya') . '#post-102',
            'date'      => '1 जुलाई, 2024',
            'author'    => 'bhaiyantop',
            'category'  => 'स्वास्थ्य',
            'cat_slug'  => 'swasthya',
            'cat_url'   => bhaiyyantop_get_category_url('swasthya'),
            'thumbnail' => $theme_uri . '/assets/images/healthy_diet.png',
            'excerpt'   => 'स्वास्थ्य विशेषज्ञ बता रहे हैं कि किस तरह जेब पर भारी पड़े बिना आप पोषाहार से भरपूर भोजन चुन सकते हैं...',
        ),
        array(
            'id'        => 103,
            'title'     => 'सेलिब्रिटी स्कैंडल: ताज़ा खुलासे और बॉलीवुड की प्रतिक्रियाएं',
            'permalink' => bhaiyyantop_get_category_url('manoranjan') . '#post-103',
            'date'      => '1 जुलाई, 2024',
            'author'    => 'bhaiyantop',
            'category'  => 'मनोरंजन',
            'cat_slug'  => 'manoranjan',
            'cat_url'   => bhaiyyantop_get_category_url('manoranjan'),
            'thumbnail' => $theme_uri . '/assets/images/city_skyline.png',
            'excerpt'   => 'मनोरंजन जगत से आ रही बड़ी खबरें और विवादों पर बॉलीवुड सितारों के बयान...',
        ),
        array(
            'id'        => 104,
            'title'     => 'चोटिल हुए स्टार एथलीट, ओलंपिक 2024 से बाहर होने की संभावना',
            'permalink' => bhaiyyantop_get_category_url('khel') . '#post-104',
            'date'      => '1 जुलाई, 2024',
            'author'    => 'bhaiyantop',
            'category'  => 'खेल',
            'cat_slug'  => 'khel',
            'cat_url'   => bhaiyyantop_get_category_url('khel'),
            'thumbnail' => $theme_uri . '/assets/images/athlete_running.png',
            'excerpt'   => 'ट्रैक एंड फील्ड के दिग्गज खिलाड़ी ट्रेनिंग के दौरान चोटग्रस्त हुए, फैंस में निराशा...',
        ),
        array(
            'id'        => 105,
            'title'     => 'RBI ने बदली रेपो रेट, जानें होम लोन और EMI पर क्या होगा असर',
            'permalink' => bhaiyyantop_get_category_url('business') . '#post-105',
            'date'      => '1 जुलाई, 2024',
            'author'    => 'bhaiyantop',
            'category'  => 'बिज़नेस',
            'cat_slug'  => 'business',
            'cat_url'   => bhaiyyantop_get_category_url('business'),
            'thumbnail' => $theme_uri . '/assets/images/rbi_building.png',
            'excerpt'   => 'रिजर्व बैंक की मौद्रिक नीति समिति की बैठक के बाद नीतिगत ब्याज दरों में नया फैसला घोषित हुआ...',
        ),
        array(
            'id'        => 106,
            'title'     => 'इम्यूनिटी बढ़ाने वाले आसान घरेलू नुस्खे: आयुर्वेद की शक्ति',
            'permalink' => bhaiyyantop_get_category_url('swasthya') . '#post-106',
            'date'      => '1 जुलाई, 2024',
            'author'    => 'bhaiyantop',
            'category'  => 'स्वास्थ्य',
            'cat_slug'  => 'swasthya',
            'cat_url'   => bhaiyyantop_get_category_url('swasthya'),
            'thumbnail' => $theme_uri . '/assets/images/herbs_immunity.png',
            'excerpt'   => 'रसोई में रखी साधारण सामग्रियां आपकी रोग प्रतिरोधक क्षमता को दोगुना बढ़ा सकती हैं...',
        ),
        array(
            'id'        => 107,
            'title'     => 'क्वांटम कंप्यूटिंग: टेक्नोलॉजी की दुनिया में एक नई क्रांति',
            'permalink' => bhaiyyantop_get_category_url('technology') . '#post-107',
            'date'      => '1 जुलाई, 2024',
            'author'    => 'bhaiyantop',
            'category'  => 'टेक्नोलॉजी',
            'cat_slug'  => 'technology',
            'cat_url'   => bhaiyyantop_get_category_url('technology'),
            'thumbnail' => $theme_uri . '/assets/images/editor_girl_reading.png',
            'excerpt'   => 'सुपरकंप्यूटिंग से भी लाखों गुना तेज़ काम करने वाली नई क्वांटम तकनीक से बदल जाएगी पूरी दुनिया...',
        ),
        array(
            'id'        => 108,
            'title'     => 'नया म्यूज़िक एल्बम रिलीज़: कलाकार की सफलता की नई उड़ान',
            'permalink' => bhaiyyantop_get_category_url('manoranjan') . '#post-108',
            'date'      => '1 जुलाई, 2024',
            'author'    => 'bhaiyantop',
            'category'  => 'मनोरंजन',
            'cat_slug'  => 'manoranjan',
            'cat_url'   => bhaiyyantop_get_category_url('manoranjan'),
            'thumbnail' => $theme_uri . '/assets/images/music_concert.png',
            'excerpt'   => 'संगीत की दुनिया में छा गया नया एल्बम, यूट्यूब और स्पॉटीफाई पर मिलियन व्यूज पार...',
        ),
    );

    // Filter by category if requested
    if ( ! empty( $parsed_args['category'] ) ) {
        $filtered = array();
        $target_slug = strtolower( trim( $parsed_args['category'] ) );
        foreach ( $mock_all as $item ) {
            if ( strtolower( $item['cat_slug'] ) === $target_slug || strtolower( $item['category'] ) === $target_slug ) {
                $filtered[] = $item;
            }
        }
        if ( ! empty( $filtered ) ) {
            $mock_all = $filtered;
        }
    }

    return array_slice( $mock_all, 0, $parsed_args['numberposts'] );
}

/**
 * Load Custom Template Tags and Inc Modules
 */
require_once get_template_directory() . '/inc/template-tags.php';
require_once get_template_directory() . '/inc/breadcrumbs.php';
require_once get_template_directory() . '/inc/related-posts.php';
require_once get_template_directory() . '/inc/author-box.php';
require_once get_template_directory() . '/inc/share-buttons.php';
require_once get_template_directory() . '/inc/customizer.php';
require_once get_template_directory() . '/inc/scripts-handler.php';
require_once get_template_directory() . '/inc/demo-import.php';



