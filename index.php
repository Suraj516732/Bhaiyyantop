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
function get_stylesheet_uri() { return 'bhaiyyantop/style.css'; }
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

// Include theme functions
require_once __DIR__ . '/bhaiyyantop/functions.php';

// Mock WordPress functions
function wp_head() {
    echo '<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Noto+Sans+Devanagari:wght@400;600;700;900&family=Outfit:wght@400;600;700;800;900&display=swap">' . "\n";
    echo '<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">' . "\n";
    echo '<link rel="stylesheet" href="bhaiyyantop/style.css">' . "\n";
}

function wp_footer() {
    echo '<script src="bhaiyyantop/assets/js/theme.js"></script>' . "\n";
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
    return 'bhaiyyantop';
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
