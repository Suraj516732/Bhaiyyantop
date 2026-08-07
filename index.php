<?php
/**
 * Mock WordPress Environment for Local Previewing of Bhaiyyantop Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
    define( 'ABSPATH', __DIR__ . '/' );
}

// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Mock WordPress Core Helper Functions for standalone previewing
function add_action($tag, $function_to_add, $priority = 10, $accepted_args = 1) {}
function add_theme_support($feature, $args = null) {}
function add_image_size($name, $width = 0, $height = 0, $crop = false) {}
function register_nav_menus($locations = array()) {}
function register_sidebar($args = array()) {}
function wp_enqueue_style($handle, $src = '', $deps = array(), $ver = false, $media = 'all') {}
function wp_enqueue_script($handle, $src = '', $deps = array(), $ver = false, $in_footer = false) {}
function get_stylesheet_uri() { return '/bhaiyyantop/style.css'; }
function wp_parse_args($args, $defaults = array()) {
    if (is_object($args)) {
        $r = get_object_vars($args);
    } elseif (is_array($args)) {
        $r = &$args;
    } else {
        $r = array();
        parse_str($args, $r);
    }
    if (is_array($defaults)) {
        return array_merge($defaults, $r);
    }
    return $r;
}
function is_wp_error($thing) { return false; }
function get_template_directory() {
    return __DIR__ . '/bhaiyyantop';
}

function get_template_part( $slug, $name = null, $args = array() ) {
    $file = '';
    if ( $name !== null ) {
        $file = __DIR__ . '/bhaiyyantop/' . $slug . '-' . $name . '.php';
    }
    if ( ! $file || ! file_exists( $file ) ) {
        $file = __DIR__ . '/bhaiyyantop/' . $slug . '.php';
    }

    if ( file_exists( $file ) ) {
        // Set the global item if passed in args
        if ( isset( $args['item'] ) ) {
            $GLOBALS['current_mock_post'] = $args['item'];
        }
        include $file;
        // Clean up
        unset( $GLOBALS['current_mock_post'] );
    }
}

function get_the_ID() {
    return isset($GLOBALS['current_mock_post']['id']) ? $GLOBALS['current_mock_post']['id'] : 0;
}
function get_permalink($id = 0) {
    return isset($GLOBALS['current_mock_post']['permalink']) ? $GLOBALS['current_mock_post']['permalink'] : '#';
}
function get_the_title($id = 0) {
    return isset($GLOBALS['current_mock_post']['title']) ? $GLOBALS['current_mock_post']['title'] : '';
}
function get_the_category($id = 0) {
    if (isset($GLOBALS['current_mock_post']['category'])) {
        $cat = new stdClass();
        $cat->name = $GLOBALS['current_mock_post']['category'];
        $cat->term_id = 1;
        return array($cat);
    }
    return array();
}
function get_category_link($term_id) {
    return isset($GLOBALS['current_mock_post']['cat_url']) ? $GLOBALS['current_mock_post']['cat_url'] : '#';
}
function get_the_author_meta($field, $user_id = false) {
    return '1';
}
function get_the_author() {
    return isset($GLOBALS['current_mock_post']['author']) ? $GLOBALS['current_mock_post']['author'] : 'bhaiyantop';
}
function get_author_posts_url($author_id) {
    return '#';
}
function get_the_date($format = '', $post = null) {
    return isset($GLOBALS['current_mock_post']['date']) ? $GLOBALS['current_mock_post']['date'] : '';
}
function wp_trim_words($text, $num_words = 55, $more = null) {
    return $text;
}
function get_the_excerpt($post = null) {
    return isset($GLOBALS['current_mock_post']['excerpt']) ? $GLOBALS['current_mock_post']['excerpt'] : '';
}
function post_class($class = '', $post_id = null) {
    $classes = array_merge(array('post'), (array)$class);
    echo 'class="' . esc_attr(implode(' ', $classes)) . '"';
}
function has_post_thumbnail($post = null) {
    return !empty($GLOBALS['current_mock_post']['thumbnail']);
}
function get_the_post_thumbnail($post = null, $size = 'post-thumbnail', $attr = '') {
    $src = isset($GLOBALS['current_mock_post']['thumbnail']) ? $GLOBALS['current_mock_post']['thumbnail'] : '';
    $alt = '';
    if (is_array($attr) && isset($attr['alt'])) {
        $alt = $attr['alt'];
    }
    return '<img src="' . esc_url($src) . '" alt="' . esc_attr($alt) . '" loading="lazy">';
}
function is_active_sidebar($index) {
    return false;
}
function get_search_form() {
    echo '<form role="search" method="get" class="search-form" action="/"><label><span class="screen-reader-text">खोजें:</span><input type="search" class="search-field" placeholder="खोजें &hellip;" value="" name="s" /></label><input type="submit" class="search-submit" value="खोजें" /></form>';
}
function wp_get_recent_posts($args = array(), $output = 'ARRAY_A') {
    return array();
}
function wp_list_categories($args = array()) {
    $categories = function_exists('bhaiyyantop_get_all_categories') ? bhaiyyantop_get_all_categories() : array();
    foreach ($categories as $slug => $cat_info) {
        echo '<li><a href="' . esc_url($cat_info['url']) . '">' . esc_html($cat_info['name']) . '</a></li>';
    }
}
function dynamic_sidebar($index) {
    return false;
}

// Include theme functions
require_once __DIR__ . '/bhaiyyantop/functions.php';

// Mock WordPress functions
function wp_head() {
    echo '<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Noto+Sans+Devanagari:wght@400;600;700;900&family=Outfit:wght@400;600;700;800;900&display=swap">' . "\n";
    echo '<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">' . "\n";
    echo '<link rel="stylesheet" href="/bhaiyyantop/style.css?v=' . filemtime(__DIR__ . '/bhaiyyantop/style.css') . '">' . "\n";
}

function wp_footer() {
    echo '<script src="/bhaiyyantop/assets/js/theme.js?v=' . filemtime(__DIR__ . '/bhaiyyantop/assets/js/theme.js') . '"></script>' . "\n";
}

function wp_body_open() {}

function language_attributes() {
    echo 'lang="hi"';
}

function bloginfo( $show = '' ) {
    if ( $show === 'charset' ) {
        echo 'UTF-8';
    }
}

function body_class( $class = '' ) {
    echo 'class="home blog ' . esc_attr( $class ) . '"';
}

function esc_url( $url ) {
    return htmlspecialchars( $url, ENT_QUOTES, 'UTF-8' );
}

function esc_html( $text ) {
    return htmlspecialchars( $text, ENT_QUOTES, 'UTF-8' );
}

function esc_attr( $text ) {
    return htmlspecialchars( $text, ENT_QUOTES, 'UTF-8' );
}

function esc_html_e( $text, $domain = '' ) {
    echo esc_html( $text );
}

function esc_attr_e( $text, $domain = '' ) {
    echo esc_attr( $text );
}

function esc_attr_x( $text, $context, $domain = '' ) {
    return esc_attr( $text );
}

function esc_html__($text, $domain = '') {
    return esc_html($text);
}

function __($text, $domain = '') {
    return esc_html($text);
}

function esc_attr__( $text, $domain = '' ) {
    return esc_attr( $text );
}

function home_url( $path = '' ) {
    return '/' . ltrim( $path, '/' );
}

function has_nav_menu( $location ) {
    return false;
}

function get_template_directory_uri() {
    return '/bhaiyyantop';
}

function get_posts( $args = array() ) {
    return array(); // Empty array to force mock fallback in front-page.php
}

function get_header() {
    include __DIR__ . '/bhaiyyantop/header.php';
}

function get_footer() {
    include __DIR__ . '/bhaiyyantop/footer.php';
}

function get_sidebar() {
    include __DIR__ . '/bhaiyyantop/sidebar.php';
}

// get_template_part is defined above

// Mock queries for dynamic loops
class WP_Query {
    public $posts = array();
    public function __construct( $args = array() ) {}
    public function have_posts() { return false; }
    public function the_post() {}
}

function wp_reset_postdata() {}

// Render the front page
include __DIR__ . '/bhaiyyantop/front-page.php';
