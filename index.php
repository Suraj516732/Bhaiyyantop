<?php
/**
 * Mock WordPress Environment for Local Previewing of Bhaiyyantop Theme
 */

// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Mock WordPress functions
function wp_head() {
    echo '<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Noto+Sans+Devanagari:wght@400;600;700;900&family=Outfit:wght@400;600;700;800;900&display=swap">' . "\n";
    echo '<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">' . "\n";
    echo '<link rel="stylesheet" href="/bhaiyyantop/style.css">' . "\n";
}

function wp_footer() {
    echo '<script src="/bhaiyyantop/assets/js/theme.js"></script>' . "\n";
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
