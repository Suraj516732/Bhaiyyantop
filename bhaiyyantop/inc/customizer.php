<?php
/**
 * Comprehensive WordPress Theme Customizer Integration
 *
 * Provides full control over all theme elements across 15 structured sections:
 * Brand, Header, Navigation, Homepage, Breaking News, Sidebar, Footer,
 * Advertisement, Social Media, Typography, Buttons, Cards, Animation, Colors, and Layout.
 * Supports selective refresh and postMessage live preview for real-time updates.
 *
 * @package Bhaiyyantop
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

/**
 * Register Theme Customizer Panels, Sections, Settings, and Controls.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function bhaiyyantop_customize_register( $wp_customize ) {

    // Main Theme Options Panel
    $wp_customize->add_panel( 'bhaiyyantop_panel', array(
        'priority'       => 10,
        'capability'     => 'edit_theme_options',
        'theme_supports' => '',
        'title'          => __( 'Bhaiyyantop Theme Options', 'bhaiyyantop' ),
        'description'    => __( 'Full customization suite for Brand, Header, Navigation, Homepage, Breaking News, Sidebar, Footer, Ads, Social Media, Typography, Buttons, Cards, Animation, Colors, and Layout.', 'bhaiyyantop' ),
    ) );

    // =============================================================
    // 1. BRAND SECTION
    // =============================================================
    $wp_customize->add_section( 'bhaiyyantop_brand_section', array(
        'title'    => __( '1. Brand & Logo Options', 'bhaiyyantop' ),
        'panel'    => 'bhaiyyantop_panel',
        'priority' => 10,
    ) );

    // Header Logo Text Title
    $wp_customize->add_setting( 'bhaiyyantop_logo_text_title', array(
        'default'           => __( 'भैय्यान्टॉप', 'bhaiyyantop' ),
        'transport'         => 'postMessage',
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'bhaiyyantop_logo_text_title', array(
        'label'    => __( 'Logo Title Text', 'bhaiyyantop' ),
        'section'  => 'bhaiyyantop_brand_section',
        'type'     => 'text',
    ) );

    // Logo Icon Bubble Character
    $wp_customize->add_setting( 'bhaiyyantop_logo_bubble_letter', array(
        'default'           => 'भ',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'bhaiyyantop_logo_bubble_letter', array(
        'label'    => __( 'Logo Icon Bubble Character', 'bhaiyyantop' ),
        'section'  => 'bhaiyyantop_brand_section',
        'type'     => 'text',
    ) );

    // Custom Logo Upload
    $wp_customize->add_setting( 'bhaiyyantop_logo', array(
        'default'           => '',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'esc_url_raw',
    ) );
    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'bhaiyyantop_logo', array(
        'label'    => __( 'Logo Image Upload', 'bhaiyyantop' ),
        'section'  => 'bhaiyyantop_brand_section',
    ) ) );

    // Retina Logo Upload
    $wp_customize->add_setting( 'bhaiyyantop_retina_logo', array(
        'default'           => '',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'esc_url_raw',
    ) );
    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'bhaiyyantop_retina_logo', array(
        'label'    => __( 'Retina Logo (@2x) Upload', 'bhaiyyantop' ),
        'section'  => 'bhaiyyantop_brand_section',
    ) ) );

    // Logo Width (px)
    $wp_customize->add_setting( 'bhaiyyantop_logo_width', array(
        'default'           => 400,
        'transport'         => 'postMessage',
        'sanitize_callback' => 'absint',
    ) );
    $wp_customize->add_control( 'bhaiyyantop_logo_width', array(
        'label'       => __( 'Logo Max Width (px)', 'bhaiyyantop' ),
        'section'     => 'bhaiyyantop_brand_section',
        'type'        => 'number',
        'input_attrs' => array( 'min' => 50, 'max' => 600, 'step' => 1 ),
    ) );

    // Logo Height (px)
    $wp_customize->add_setting( 'bhaiyyantop_logo_height', array(
        'default'           => 112,
        'transport'         => 'postMessage',
        'sanitize_callback' => 'absint',
    ) );
    $wp_customize->add_control( 'bhaiyyantop_logo_height', array(
        'label'       => __( 'Logo Max Height (px)', 'bhaiyyantop' ),
        'section'     => 'bhaiyyantop_brand_section',
        'type'        => 'number',
        'input_attrs' => array( 'min' => 20, 'max' => 300, 'step' => 1 ),
    ) );

    // =============================================================
    // 2. HEADER SECTION
    // =============================================================
    $wp_customize->add_section( 'bhaiyyantop_header_section', array(
        'title'    => __( '2. Header & Banner Settings', 'bhaiyyantop' ),
        'panel'    => 'bhaiyyantop_panel',
        'priority' => 20,
    ) );

    // Header Background Color
    $wp_customize->add_setting( 'bhaiyyantop_header_bg_color', array(
        'default'           => '#00bcd4',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'bhaiyyantop_header_bg_color', array(
        'label'    => __( 'Header Background Color', 'bhaiyyantop' ),
        'section'  => 'bhaiyyantop_header_section',
    ) ) );

    // Header Overlay Opacity
    $wp_customize->add_setting( 'bhaiyyantop_header_overlay_opacity', array(
        'default'           => 0.65,
        'transport'         => 'postMessage',
        'sanitize_callback' => 'bhaiyyantop_sanitize_float',
    ) );
    $wp_customize->add_control( 'bhaiyyantop_header_overlay_opacity', array(
        'label'       => __( 'Header Overlay Opacity (0.0 to 1.0)', 'bhaiyyantop' ),
        'section'     => 'bhaiyyantop_header_section',
        'type'        => 'number',
        'input_attrs' => array( 'min' => 0, 'max' => 1, 'step' => 0.05 ),
    ) );

    // Header Background Image
    $wp_customize->add_setting( 'bhaiyyantop_header_bg_image', array(
        'default'           => '',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'esc_url_raw',
    ) );
    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'bhaiyyantop_header_bg_image', array(
        'label'    => __( 'Header Background Banner Image', 'bhaiyyantop' ),
        'section'  => 'bhaiyyantop_header_section',
    ) ) );

    // Header Min Height
    $wp_customize->add_setting( 'bhaiyyantop_header_min_height', array(
        'default'           => 155,
        'transport'         => 'postMessage',
        'sanitize_callback' => 'absint',
    ) );
    $wp_customize->add_control( 'bhaiyyantop_header_min_height', array(
        'label'       => __( 'Header Min Height (px)', 'bhaiyyantop' ),
        'section'     => 'bhaiyyantop_header_section',
        'type'        => 'number',
        'input_attrs' => array( 'min' => 100, 'max' => 300, 'step' => 5 ),
    ) );

    // Enable Sticky Header
    $wp_customize->add_setting( 'bhaiyyantop_sticky_header_enable', array(
        'default'           => true,
        'transport'         => 'refresh',
        'sanitize_callback' => 'bhaiyyantop_sanitize_checkbox',
    ) );
    $wp_customize->add_control( 'bhaiyyantop_sticky_header_enable', array(
        'label'    => __( 'Enable Sticky Navigation Header', 'bhaiyyantop' ),
        'section'  => 'bhaiyyantop_header_section',
        'type'     => 'checkbox',
    ) );

    // Sticky Header Background Color
    $wp_customize->add_setting( 'bhaiyyantop_sticky_header_bg_color', array(
        'default'           => '#ffffff',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'bhaiyyantop_sticky_header_bg_color', array(
        'label'    => __( 'Sticky Header Background Color', 'bhaiyyantop' ),
        'section'  => 'bhaiyyantop_header_section',
    ) ) );

    // Sticky Header Shadow
    $wp_customize->add_setting( 'bhaiyyantop_sticky_header_shadow', array(
        'default'           => '0 4px 15px rgba(0, 0, 0, 0.08)',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'bhaiyyantop_sticky_header_shadow', array(
        'label'    => __( 'Sticky Header Box Shadow CSS', 'bhaiyyantop' ),
        'section'  => 'bhaiyyantop_header_section',
        'type'     => 'text',
    ) );

    // Sticky Header Blur (px)
    $wp_customize->add_setting( 'bhaiyyantop_sticky_header_blur', array(
        'default'           => 8,
        'transport'         => 'postMessage',
        'sanitize_callback' => 'absint',
    ) );
    $wp_customize->add_control( 'bhaiyyantop_sticky_header_blur', array(
        'label'       => __( 'Sticky Header Backdrop Blur (px)', 'bhaiyyantop' ),
        'section'     => 'bhaiyyantop_header_section',
        'type'        => 'number',
        'input_attrs' => array( 'min' => 0, 'max' => 30, 'step' => 1 ),
    ) );

    // =============================================================
    // 3. NAVIGATION SECTION
    // =============================================================
    $wp_customize->add_section( 'bhaiyyantop_nav_section', array(
        'title'    => __( '3. Navigation Options', 'bhaiyyantop' ),
        'panel'    => 'bhaiyyantop_panel',
        'priority' => 30,
    ) );

    // Primary Menu Color
    $wp_customize->add_setting( 'bhaiyyantop_nav_text_color', array(
        'default'           => '#111111',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'bhaiyyantop_nav_text_color', array(
        'label'    => __( 'Primary Menu Link Text Color', 'bhaiyyantop' ),
        'section'  => 'bhaiyyantop_nav_section',
    ) ) );

    // Navigation Hover Color
    $wp_customize->add_setting( 'bhaiyyantop_nav_hover_color', array(
        'default'           => '#ffffff',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'bhaiyyantop_nav_hover_color', array(
        'label'    => __( 'Navigation Link Hover Color', 'bhaiyyantop' ),
        'section'  => 'bhaiyyantop_nav_section',
    ) ) );

    // Navigation Active Color
    $wp_customize->add_setting( 'bhaiyyantop_nav_hover_bg', array(
        'default'           => '#e91e63',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'bhaiyyantop_nav_hover_bg', array(
        'label'    => __( 'Active/Hover Item Background Color', 'bhaiyyantop' ),
        'section'  => 'bhaiyyantop_nav_section',
    ) ) );

    // Dropdown Background Color
    $wp_customize->add_setting( 'bhaiyyantop_nav_dropdown_bg', array(
        'default'           => '#ffffff',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'bhaiyyantop_nav_dropdown_bg', array(
        'label'    => __( 'Submenu Dropdown Background Color', 'bhaiyyantop' ),
        'section'  => 'bhaiyyantop_nav_section',
    ) ) );

    // Mobile Menu Background Color
    $wp_customize->add_setting( 'bhaiyyantop_mobile_menu_bg', array(
        'default'           => '#ffffff',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'bhaiyyantop_mobile_menu_bg', array(
        'label'    => __( 'Mobile Drawer Menu Background Color', 'bhaiyyantop' ),
        'section'  => 'bhaiyyantop_nav_section',
    ) ) );

    // Mobile Overlay Color
    $wp_customize->add_setting( 'bhaiyyantop_mobile_overlay_color', array(
        'default'           => 'rgba(0, 0, 0, 0.5)',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'bhaiyyantop_mobile_overlay_color', array(
        'label'    => __( 'Mobile Menu Overlay Color (CSS rgba)', 'bhaiyyantop' ),
        'section'  => 'bhaiyyantop_nav_section',
        'type'     => 'text',
    ) );

    // Hamburger Icon Color
    $wp_customize->add_setting( 'bhaiyyantop_hamburger_color', array(
        'default'           => '#111111',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'bhaiyyantop_hamburger_color', array(
        'label'    => __( 'Hamburger Toggle Icon Color', 'bhaiyyantop' ),
        'section'  => 'bhaiyyantop_nav_section',
    ) ) );

    // Sticky Navigation Text Color
    $wp_customize->add_setting( 'bhaiyyantop_sticky_nav_color', array(
        'default'           => '#111111',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'bhaiyyantop_sticky_nav_color', array(
        'label'    => __( 'Sticky Navigation Text Color', 'bhaiyyantop' ),
        'section'  => 'bhaiyyantop_nav_section',
    ) ) );

    // Nav Link Font Size
    $wp_customize->add_setting( 'bhaiyyantop_nav_font_size', array(
        'default'           => 19,
        'transport'         => 'postMessage',
        'sanitize_callback' => 'absint',
    ) );
    $wp_customize->add_control( 'bhaiyyantop_nav_font_size', array(
        'label'       => __( 'Navigation Link Font Size (px)', 'bhaiyyantop' ),
        'section'     => 'bhaiyyantop_nav_section',
        'type'        => 'number',
        'input_attrs' => array( 'min' => 14, 'max' => 26, 'step' => 1 ),
    ) );

    // =============================================================
    // 4. HOMEPAGE SECTION
    // =============================================================
    $wp_customize->add_section( 'bhaiyyantop_homepage_section', array(
        'title'    => __( '4. Homepage Layout Options', 'bhaiyyantop' ),
        'panel'    => 'bhaiyyantop_panel',
        'priority' => 40,
    ) );

    // Hero Slider Enable
    $wp_customize->add_setting( 'bhaiyyantop_hero_slider_enable', array(
        'default'           => true,
        'transport'         => 'refresh',
        'sanitize_callback' => 'bhaiyyantop_sanitize_checkbox',
    ) );
    $wp_customize->add_control( 'bhaiyyantop_hero_slider_enable', array(
        'label'    => __( 'Enable Hero Slider Section', 'bhaiyyantop' ),
        'section'  => 'bhaiyyantop_homepage_section',
        'type'     => 'checkbox',
    ) );

    // Hero Post Count
    $wp_customize->add_setting( 'bhaiyyantop_hero_post_count', array(
        'default'           => 5,
        'transport'         => 'refresh',
        'sanitize_callback' => 'absint',
    ) );
    $wp_customize->add_control( 'bhaiyyantop_hero_post_count', array(
        'label'       => __( 'Hero Slider Post Count', 'bhaiyyantop' ),
        'section'     => 'bhaiyyantop_homepage_section',
        'type'        => 'number',
        'input_attrs' => array( 'min' => 1, 'max' => 10, 'step' => 1 ),
    ) );

    // Latest News Count
    $wp_customize->add_setting( 'bhaiyyantop_latest_news_count', array(
        'default'           => 8,
        'transport'         => 'refresh',
        'sanitize_callback' => 'absint',
    ) );
    $wp_customize->add_control( 'bhaiyyantop_latest_news_count', array(
        'label'       => __( 'Latest News Grid Post Count', 'bhaiyyantop' ),
        'section'     => 'bhaiyyantop_homepage_section',
        'type'        => 'number',
        'input_attrs' => array( 'min' => 4, 'max' => 24, 'step' => 1 ),
    ) );

    // Editor's Choice Count
    $wp_customize->add_setting( 'bhaiyyantop_editors_choice_count', array(
        'default'           => 3,
        'transport'         => 'refresh',
        'sanitize_callback' => 'absint',
    ) );
    $wp_customize->add_control( 'bhaiyyantop_editors_choice_count', array(
        'label'       => __( 'Editor\'s Choice Post Count', 'bhaiyyantop' ),
        'section'     => 'bhaiyyantop_homepage_section',
        'type'        => 'number',
        'input_attrs' => array( 'min' => 1, 'max' => 6, 'step' => 1 ),
    ) );

    // Sidebar Post Count
    $wp_customize->add_setting( 'bhaiyyantop_sidebar_post_count', array(
        'default'           => 5,
        'transport'         => 'refresh',
        'sanitize_callback' => 'absint',
    ) );
    $wp_customize->add_control( 'bhaiyyantop_sidebar_post_count', array(
        'label'       => __( 'Left Sidebar Featured Post Count', 'bhaiyyantop' ),
        'section'     => 'bhaiyyantop_homepage_section',
        'type'        => 'number',
        'input_attrs' => array( 'min' => 1, 'max' => 10, 'step' => 1 ),
    ) );

    // Category Sections Enable/Disable
    $wp_customize->add_setting( 'bhaiyyantop_category_sections_enable', array(
        'default'           => true,
        'transport'         => 'refresh',
        'sanitize_callback' => 'bhaiyyantop_sanitize_checkbox',
    ) );
    $wp_customize->add_control( 'bhaiyyantop_category_sections_enable', array(
        'label'    => __( 'Enable Category Sections Tabs', 'bhaiyyantop' ),
        'section'  => 'bhaiyyantop_homepage_section',
        'type'     => 'checkbox',
    ) );

    // =============================================================
    // 5. BREAKING NEWS SECTION
    // =============================================================
    $wp_customize->add_section( 'bhaiyyantop_breaking_news_section', array(
        'title'    => __( '5. Breaking News Ticker', 'bhaiyyantop' ),
        'panel'    => 'bhaiyyantop_panel',
        'priority' => 50,
    ) );

    // Enable Breaking News Ticker
    $wp_customize->add_setting( 'bhaiyyantop_breaking_news_enable', array(
        'default'           => true,
        'transport'         => 'refresh',
        'sanitize_callback' => 'bhaiyyantop_sanitize_checkbox',
    ) );
    $wp_customize->add_control( 'bhaiyyantop_breaking_news_enable', array(
        'label'    => __( 'Enable Breaking News Ticker Bar', 'bhaiyyantop' ),
        'section'  => 'bhaiyyantop_breaking_news_section',
        'type'     => 'checkbox',
    ) );

    // Breaking News Speed (seconds)
    $wp_customize->add_setting( 'bhaiyyantop_breaking_news_speed', array(
        'default'           => 5,
        'transport'         => 'postMessage',
        'sanitize_callback' => 'absint',
    ) );
    $wp_customize->add_control( 'bhaiyyantop_breaking_news_speed', array(
        'label'       => __( 'Ticker Transition Speed (Seconds)', 'bhaiyyantop' ),
        'section'     => 'bhaiyyantop_breaking_news_section',
        'type'        => 'number',
        'input_attrs' => array( 'min' => 2, 'max' => 15, 'step' => 1 ),
    ) );

    // Ticker Badge Label
    $wp_customize->add_setting( 'bhaiyyantop_header_notice', array(
        'default'           => __( 'ताज़ा खबरें', 'bhaiyyantop' ),
        'transport'         => 'postMessage',
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'bhaiyyantop_header_notice', array(
        'label'    => __( 'Ticker Badge Label Text', 'bhaiyyantop' ),
        'section'  => 'bhaiyyantop_breaking_news_section',
        'type'     => 'text',
    ) );

    // Ticker Badge Background Color
    $wp_customize->add_setting( 'bhaiyyantop_breaking_news_bg', array(
        'default'           => '#e91e63',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'bhaiyyantop_breaking_news_bg', array(
        'label'    => __( 'Ticker Badge Background Color', 'bhaiyyantop' ),
        'section'  => 'bhaiyyantop_breaking_news_section',
    ) ) );

    // Ticker Text Color
    $wp_customize->add_setting( 'bhaiyyantop_breaking_news_text_color', array(
        'default'           => '#ffffff',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'bhaiyyantop_breaking_news_text_color', array(
        'label'    => __( 'Ticker Badge Text Color', 'bhaiyyantop' ),
        'section'  => 'bhaiyyantop_breaking_news_section',
    ) ) );

    // =============================================================
    // 6. SIDEBAR SECTION
    // =============================================================
    $wp_customize->add_section( 'bhaiyyantop_sidebar_section', array(
        'title'    => __( '6. Sidebar Options', 'bhaiyyantop' ),
        'panel'    => 'bhaiyyantop_panel',
        'priority' => 60,
    ) );

    // Sidebar Layout Position
    $wp_customize->add_setting( 'bhaiyyantop_sidebar_position', array(
        'default'           => 'right',
        'transport'         => 'refresh',
        'sanitize_callback' => 'bhaiyyantop_sanitize_select',
    ) );
    $wp_customize->add_control( 'bhaiyyantop_sidebar_position', array(
        'label'   => __( 'Sidebar Layout Position', 'bhaiyyantop' ),
        'section' => 'bhaiyyantop_sidebar_section',
        'type'    => 'select',
        'choices' => array(
            'right' => __( 'Right Sidebar', 'bhaiyyantop' ),
            'left'  => __( 'Left Sidebar', 'bhaiyyantop' ),
            'none'  => __( 'No Sidebar (Full Width)', 'bhaiyyantop' ),
        ),
    ) );

    // Sticky Sidebar Enable
    $wp_customize->add_setting( 'bhaiyyantop_sidebar_sticky_enable', array(
        'default'           => true,
        'transport'         => 'postMessage',
        'sanitize_callback' => 'bhaiyyantop_sanitize_checkbox',
    ) );
    $wp_customize->add_control( 'bhaiyyantop_sidebar_sticky_enable', array(
        'label'    => __( 'Enable Sticky Sidebar Scrolling', 'bhaiyyantop' ),
        'section'  => 'bhaiyyantop_sidebar_section',
        'type'     => 'checkbox',
    ) );

    // Sidebar Recent Posts Count
    $wp_customize->add_setting( 'bhaiyyantop_sidebar_recent_count', array(
        'default'           => 5,
        'transport'         => 'refresh',
        'sanitize_callback' => 'absint',
    ) );
    $wp_customize->add_control( 'bhaiyyantop_sidebar_recent_count', array(
        'label'       => __( 'Widget Recent Posts Count', 'bhaiyyantop' ),
        'section'     => 'bhaiyyantop_sidebar_section',
        'type'        => 'number',
        'input_attrs' => array( 'min' => 1, 'max' => 15, 'step' => 1 ),
    ) );

    // Widget Title Color
    $wp_customize->add_setting( 'bhaiyyantop_sidebar_title_color', array(
        'default'           => '#111111',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'bhaiyyantop_sidebar_title_color', array(
        'label'    => __( 'Sidebar Widget Heading Color', 'bhaiyyantop' ),
        'section'  => 'bhaiyyantop_sidebar_section',
    ) ) );

    // =============================================================
    // 7. FOOTER SECTION
    // =============================================================
    $wp_customize->add_section( 'bhaiyyantop_footer_section', array(
        'title'    => __( '7. Footer Options', 'bhaiyyantop' ),
        'panel'    => 'bhaiyyantop_panel',
        'priority' => 70,
    ) );

    // Footer Background Color
    $wp_customize->add_setting( 'bhaiyyantop_footer_bg_color', array(
        'default'           => '#121216',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'bhaiyyantop_footer_bg_color', array(
        'label'    => __( 'Footer Background Color', 'bhaiyyantop' ),
        'section'  => 'bhaiyyantop_footer_section',
    ) ) );

    // Footer Text Color
    $wp_customize->add_setting( 'bhaiyyantop_footer_text_color', array(
        'default'           => '#a0a0a0',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'bhaiyyantop_footer_text_color', array(
        'label'    => __( 'Footer Text Color', 'bhaiyyantop' ),
        'section'  => 'bhaiyyantop_footer_section',
    ) ) );

    // Footer About Title
    $wp_customize->add_setting( 'bhaiyyantop_footer_about_title', array(
        'default'           => __( 'हमारे बारे में', 'bhaiyyantop' ),
        'transport'         => 'postMessage',
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'bhaiyyantop_footer_about_title', array(
        'label'    => __( 'Footer About Title', 'bhaiyyantop' ),
        'section'  => 'bhaiyyantop_footer_section',
        'type'     => 'text',
    ) );

    // Footer About Text
    $wp_customize->add_setting( 'bhaiyyantop_footer_about_text', array(
        'default'           => __( 'भैय्यान्टॉप भारत का एक अग्रणी न्यूज़ पोर्टल है जो नवीनतम समाचार, राजनीति, खेल, मनोरंजन और तकनीकी जगत की ख़बरें हिंदी में प्रदान करता है।', 'bhaiyyantop' ),
        'transport'         => 'postMessage',
        'sanitize_callback' => 'wp_kses_post',
    ) );
    $wp_customize->add_control( 'bhaiyyantop_footer_about_text', array(
        'label'    => __( 'Footer About Description', 'bhaiyyantop' ),
        'section'  => 'bhaiyyantop_footer_section',
        'type'     => 'textarea',
    ) );

    // Quick Links Column Enable
    $wp_customize->add_setting( 'bhaiyyantop_footer_quick_links_enable', array(
        'default'           => true,
        'transport'         => 'refresh',
        'sanitize_callback' => 'bhaiyyantop_sanitize_checkbox',
    ) );
    $wp_customize->add_control( 'bhaiyyantop_footer_quick_links_enable', array(
        'label'    => __( 'Enable Footer Quick Links Column', 'bhaiyyantop' ),
        'section'  => 'bhaiyyantop_footer_section',
        'type'     => 'checkbox',
    ) );

    // Footer Social Icons Enable
    $wp_customize->add_setting( 'bhaiyyantop_footer_social_icons_enable', array(
        'default'           => true,
        'transport'         => 'refresh',
        'sanitize_callback' => 'bhaiyyantop_sanitize_checkbox',
    ) );
    $wp_customize->add_control( 'bhaiyyantop_footer_social_icons_enable', array(
        'label'    => __( 'Enable Footer Bottom Social Icons', 'bhaiyyantop' ),
        'section'  => 'bhaiyyantop_footer_section',
        'type'     => 'checkbox',
    ) );

    // Footer Copyright Text
    $wp_customize->add_setting( 'bhaiyyantop_footer_copyright', array(
        'default'           => sprintf( __( '© %s भैय्यान्टॉप. सर्वाधिकार सुरक्षित।', 'bhaiyyantop' ), date( 'Y' ) ),
        'transport'         => 'postMessage',
        'sanitize_callback' => 'wp_kses_post',
    ) );
    $wp_customize->add_control( 'bhaiyyantop_footer_copyright', array(
        'label'    => __( 'Footer Copyright Text', 'bhaiyyantop' ),
        'section'  => 'bhaiyyantop_footer_section',
        'type'     => 'textarea',
    ) );

    // =============================================================
    // 8. ADVERTISEMENT SECTION
    // =============================================================
    $wp_customize->add_section( 'bhaiyyantop_ads_section', array(
        'title'    => __( '8. Advertisement Slots', 'bhaiyyantop' ),
        'panel'    => 'bhaiyyantop_panel',
        'priority' => 80,
    ) );

    $ad_slots = array(
        'header_banner'    => __( 'Header Banner Ad', 'bhaiyyantop' ),
        'sidebar_top'      => __( 'Sidebar Top Ad', 'bhaiyyantop' ),
        'sidebar_middle'   => __( 'Sidebar Middle Ad', 'bhaiyyantop' ),
        'sidebar_bottom'   => __( 'Sidebar Bottom Ad', 'bhaiyyantop' ),
        'between_sections' => __( 'Between Homepage Sections Ad', 'bhaiyyantop' ),
        'footer_banner'    => __( 'Footer Banner Ad', 'bhaiyyantop' ),
        'article_ads'      => __( 'Article Single Post Ad', 'bhaiyyantop' ),
    );

    foreach ( $ad_slots as $slot_key => $slot_label ) {
        // Enable Ad Checkbox
        $wp_customize->add_setting( 'bhaiyyantop_ad_' . $slot_key . '_enable', array(
            'default'           => false,
            'transport'         => 'refresh',
            'sanitize_callback' => 'bhaiyyantop_sanitize_checkbox',
        ) );
        $wp_customize->add_control( 'bhaiyyantop_ad_' . $slot_key . '_enable', array(
            'label'    => sprintf( __( 'Enable %s', 'bhaiyyantop' ), $slot_label ),
            'section'  => 'bhaiyyantop_ads_section',
            'type'     => 'checkbox',
        ) );

        // Ad Embed Code / HTML
        $wp_customize->add_setting( 'bhaiyyantop_ad_' . $slot_key, array(
            'default'           => '',
            'transport'         => 'postMessage',
            'sanitize_callback' => 'wp_kses_post',
        ) );
        $wp_customize->add_control( 'bhaiyyantop_ad_' . $slot_key, array(
            'label'       => sprintf( __( '%s HTML / Embed Code', 'bhaiyyantop' ), $slot_label ),
            'section'     => 'bhaiyyantop_ads_section',
            'type'        => 'textarea',
            'description' => __( 'Paste AdSense script or banner HTML code.', 'bhaiyyantop' ),
        ) );
    }

    // Legacy Header Ad Controls Support
    $wp_customize->add_setting( 'bhaiyyantop_enable_header_ad', array(
        'default'           => false,
        'sanitize_callback' => 'bhaiyyantop_sanitize_checkbox',
    ) );
    $wp_customize->add_setting( 'bhaiyyantop_header_ad_code', array(
        'default'           => '',
        'sanitize_callback' => 'wp_kses_post',
    ) );

    // =============================================================
    // 9. SOCIAL MEDIA SECTION
    // =============================================================
    $wp_customize->add_section( 'bhaiyyantop_social_section', array(
        'title'    => __( '9. Social Media Links', 'bhaiyyantop' ),
        'panel'    => 'bhaiyyantop_panel',
        'priority' => 90,
    ) );

    $social_networks = array(
        'facebook'  => __( 'Facebook Page URL', 'bhaiyyantop' ),
        'instagram' => __( 'Instagram Profile URL', 'bhaiyyantop' ),
        'twitter'   => __( 'Twitter / X Profile URL', 'bhaiyyantop' ),
        'youtube'   => __( 'YouTube Channel URL', 'bhaiyyantop' ),
        'linkedin'  => __( 'LinkedIn Profile URL', 'bhaiyyantop' ),
        'telegram'  => __( 'Telegram Channel URL', 'bhaiyyantop' ),
        'whatsapp'  => __( 'WhatsApp Channel URL', 'bhaiyyantop' ),
    );

    foreach ( $social_networks as $key => $label ) {
        $wp_customize->add_setting( 'bhaiyyantop_social_' . $key, array(
            'default'           => '#',
            'transport'         => 'postMessage',
            'sanitize_callback' => 'esc_url_raw',
        ) );
        $wp_customize->add_control( 'bhaiyyantop_social_' . $key, array(
            'label'   => $label,
            'section' => 'bhaiyyantop_social_section',
            'type'    => 'url',
        ) );
    }

    // =============================================================
    // 10. TYPOGRAPHY SECTION
    // =============================================================
    $wp_customize->add_section( 'bhaiyyantop_typography_section', array(
        'title'    => __( '10. Typography Options', 'bhaiyyantop' ),
        'panel'    => 'bhaiyyantop_panel',
        'priority' => 100,
    ) );

    // Body Font Family
    $wp_customize->add_setting( 'bhaiyyantop_body_font', array(
        'default'           => 'Noto Sans Devanagari',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'bhaiyyantop_body_font', array(
        'label'   => __( 'Body Text Font Family', 'bhaiyyantop' ),
        'section' => 'bhaiyyantop_typography_section',
        'type'    => 'select',
        'choices' => array(
            'Noto Sans Devanagari' => 'Noto Sans Devanagari',
            'Outfit'               => 'Outfit',
            'Roboto'               => 'Roboto',
            'Inter'                => 'Inter',
            'Arial, sans-serif'    => 'System Sans-Serif',
        ),
    ) );

    // Heading Font Family
    $wp_customize->add_setting( 'bhaiyyantop_heading_font', array(
        'default'           => 'Noto Sans Devanagari',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'bhaiyyantop_heading_font', array(
        'label'   => __( 'Heading Font Family', 'bhaiyyantop' ),
        'section' => 'bhaiyyantop_typography_section',
        'type'    => 'select',
        'choices' => array(
            'Noto Sans Devanagari' => 'Noto Sans Devanagari',
            'Outfit'               => 'Outfit',
            'Roboto'               => 'Roboto',
            'Inter'                => 'Inter',
        ),
    ) );

    // Base Font Size
    $wp_customize->add_setting( 'bhaiyyantop_base_font_size', array(
        'default'           => 18,
        'transport'         => 'postMessage',
        'sanitize_callback' => 'absint',
    ) );
    $wp_customize->add_control( 'bhaiyyantop_base_font_size', array(
        'label'       => __( 'Base Font Size (px)', 'bhaiyyantop' ),
        'section'     => 'bhaiyyantop_typography_section',
        'type'        => 'number',
        'input_attrs' => array( 'min' => 12, 'max' => 26, 'step' => 1 ),
    ) );

    // Line Height
    $wp_customize->add_setting( 'bhaiyyantop_line_height', array(
        'default'           => 1.6,
        'transport'         => 'postMessage',
        'sanitize_callback' => 'bhaiyyantop_sanitize_float',
    ) );
    $wp_customize->add_control( 'bhaiyyantop_line_height', array(
        'label'       => __( 'Line Height multiplier (e.g. 1.6)', 'bhaiyyantop' ),
        'section'     => 'bhaiyyantop_typography_section',
        'type'        => 'number',
        'input_attrs' => array( 'min' => 1.0, 'max' => 2.5, 'step' => 0.1 ),
    ) );

    // Letter Spacing
    $wp_customize->add_setting( 'bhaiyyantop_letter_spacing', array(
        'default'           => 0,
        'transport'         => 'postMessage',
        'sanitize_callback' => 'bhaiyyantop_sanitize_float',
    ) );
    $wp_customize->add_control( 'bhaiyyantop_letter_spacing', array(
        'label'       => __( 'Letter Spacing (px)', 'bhaiyyantop' ),
        'section'     => 'bhaiyyantop_typography_section',
        'type'        => 'number',
        'input_attrs' => array( 'min' => -2, 'max' => 5, 'step' => 0.5 ),
    ) );

    // =============================================================
    // 11. BUTTONS SECTION
    // =============================================================
    $wp_customize->add_section( 'bhaiyyantop_buttons_section', array(
        'title'    => __( '11. Button Styling', 'bhaiyyantop' ),
        'panel'    => 'bhaiyyantop_panel',
        'priority' => 110,
    ) );

    // Primary Button Color
    $wp_customize->add_setting( 'bhaiyyantop_button_bg', array(
        'default'           => '#e91e63',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'bhaiyyantop_button_bg', array(
        'label'    => __( 'Primary Button Background Color', 'bhaiyyantop' ),
        'section'  => 'bhaiyyantop_buttons_section',
    ) ) );

    // Secondary Button Color
    $wp_customize->add_setting( 'bhaiyyantop_button_secondary_bg', array(
        'default'           => '#00bcd4',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'bhaiyyantop_button_secondary_bg', array(
        'label'    => __( 'Secondary Button Background Color', 'bhaiyyantop' ),
        'section'  => 'bhaiyyantop_buttons_section',
    ) ) );

    // Button Hover Color
    $wp_customize->add_setting( 'bhaiyyantop_button_hover', array(
        'default'           => '#c2185b',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'bhaiyyantop_button_hover', array(
        'label'    => __( 'Button Hover Background Color', 'bhaiyyantop' ),
        'section'  => 'bhaiyyantop_buttons_section',
    ) ) );

    // Button Radius
    $wp_customize->add_setting( 'bhaiyyantop_button_radius', array(
        'default'           => 6,
        'transport'         => 'postMessage',
        'sanitize_callback' => 'absint',
    ) );
    $wp_customize->add_control( 'bhaiyyantop_button_radius', array(
        'label'       => __( 'Button Border Radius (px)', 'bhaiyyantop' ),
        'section'     => 'bhaiyyantop_buttons_section',
        'type'        => 'number',
        'input_attrs' => array( 'min' => 0, 'max' => 30, 'step' => 1 ),
    ) );

    // Button Box Shadow
    $wp_customize->add_setting( 'bhaiyyantop_button_shadow', array(
        'default'           => '0 4px 10px rgba(0, 0, 0, 0.15)',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'bhaiyyantop_button_shadow', array(
        'label'    => __( 'Button Box Shadow CSS', 'bhaiyyantop' ),
        'section'  => 'bhaiyyantop_buttons_section',
        'type'     => 'text',
    ) );

    // =============================================================
    // 12. CARDS SECTION
    // =============================================================
    $wp_customize->add_section( 'bhaiyyantop_cards_section', array(
        'title'    => __( '12. Card Styling', 'bhaiyyantop' ),
        'panel'    => 'bhaiyyantop_panel',
        'priority' => 120,
    ) );

    // Card Border Radius
    $wp_customize->add_setting( 'bhaiyyantop_card_border_radius', array(
        'default'           => 8,
        'transport'         => 'postMessage',
        'sanitize_callback' => 'absint',
    ) );
    $wp_customize->add_control( 'bhaiyyantop_card_border_radius', array(
        'label'       => __( 'Card Border Radius (px)', 'bhaiyyantop' ),
        'section'     => 'bhaiyyantop_cards_section',
        'type'        => 'number',
        'input_attrs' => array( 'min' => 0, 'max' => 30, 'step' => 1 ),
    ) );

    // Card Shadow
    $wp_customize->add_setting( 'bhaiyyantop_card_shadow', array(
        'default'           => '0 2px 8px rgba(0, 0, 0, 0.06)',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'bhaiyyantop_card_shadow', array(
        'label'    => __( 'Card Box Shadow CSS', 'bhaiyyantop' ),
        'section'  => 'bhaiyyantop_cards_section',
        'type'     => 'text',
    ) );

    // Card Hover Animation
    $wp_customize->add_setting( 'bhaiyyantop_card_hover_animation', array(
        'default'           => 'translateY',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'bhaiyyantop_sanitize_select',
    ) );
    $wp_customize->add_control( 'bhaiyyantop_card_hover_animation', array(
        'label'   => __( 'Card Hover Animation Style', 'bhaiyyantop' ),
        'section' => 'bhaiyyantop_cards_section',
        'type'    => 'select',
        'choices' => array(
            'translateY' => __( 'Translate Up (-4px)', 'bhaiyyantop' ),
            'scale'      => __( 'Scale Up (1.02x)', 'bhaiyyantop' ),
            'shadow'     => __( 'Shadow Glow', 'bhaiyyantop' ),
            'none'       => __( 'None', 'bhaiyyantop' ),
        ),
    ) );

    // Card Inner Spacing
    $wp_customize->add_setting( 'bhaiyyantop_card_spacing', array(
        'default'           => 20,
        'transport'         => 'postMessage',
        'sanitize_callback' => 'absint',
    ) );
    $wp_customize->add_control( 'bhaiyyantop_card_spacing', array(
        'label'       => __( 'Card Grid Spacing (px)', 'bhaiyyantop' ),
        'section'     => 'bhaiyyantop_cards_section',
        'type'        => 'number',
        'input_attrs' => array( 'min' => 10, 'max' => 40, 'step' => 2 ),
    ) );

    // =============================================================
    // 13. ANIMATION SECTION
    // =============================================================
    $wp_customize->add_section( 'bhaiyyantop_animation_section', array(
        'title'    => __( '13. Animation Options', 'bhaiyyantop' ),
        'panel'    => 'bhaiyyantop_panel',
        'priority' => 130,
    ) );

    // Enable Global Animations
    $wp_customize->add_setting( 'bhaiyyantop_animation_enable', array(
        'default'           => true,
        'transport'         => 'postMessage',
        'sanitize_callback' => 'bhaiyyantop_sanitize_checkbox',
    ) );
    $wp_customize->add_control( 'bhaiyyantop_animation_enable', array(
        'label'    => __( 'Enable Theme CSS Animations', 'bhaiyyantop' ),
        'section'  => 'bhaiyyantop_animation_section',
        'type'     => 'checkbox',
    ) );

    // Enable Micro Hover Effects
    $wp_customize->add_setting( 'bhaiyyantop_hover_effects_enable', array(
        'default'           => true,
        'transport'         => 'postMessage',
        'sanitize_callback' => 'bhaiyyantop_sanitize_checkbox',
    ) );
    $wp_customize->add_control( 'bhaiyyantop_hover_effects_enable', array(
        'label'    => __( 'Enable Interactive Hover Micro-Animations', 'bhaiyyantop' ),
        'section'  => 'bhaiyyantop_animation_section',
        'type'     => 'checkbox',
    ) );

    // Transition Speed (Seconds)
    $wp_customize->add_setting( 'bhaiyyantop_transition_speed', array(
        'default'           => 0.25,
        'transport'         => 'postMessage',
        'sanitize_callback' => 'bhaiyyantop_sanitize_float',
    ) );
    $wp_customize->add_control( 'bhaiyyantop_transition_speed', array(
        'label'       => __( 'Global Transition Speed (Seconds)', 'bhaiyyantop' ),
        'section'     => 'bhaiyyantop_animation_section',
        'type'        => 'number',
        'input_attrs' => array( 'min' => 0.05, 'max' => 1.5, 'step' => 0.05 ),
    ) );

    // =============================================================
    // 14. COLORS SECTION
    // =============================================================
    $wp_customize->add_section( 'bhaiyyantop_colors_section', array(
        'title'    => __( '14. Global Color Palette', 'bhaiyyantop' ),
        'panel'    => 'bhaiyyantop_panel',
        'priority' => 140,
    ) );

    // Primary Color
    $wp_customize->add_setting( 'bhaiyyantop_primary_color', array(
        'default'           => '#e91e63',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'bhaiyyantop_primary_color', array(
        'label'    => __( 'Primary Accent Color (Pink/Red)', 'bhaiyyantop' ),
        'section'  => 'bhaiyyantop_colors_section',
    ) ) );

    // Secondary Color
    $wp_customize->add_setting( 'bhaiyyantop_secondary_color', array(
        'default'           => '#00bcd4',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'bhaiyyantop_secondary_color', array(
        'label'    => __( 'Secondary Accent Color (Teal)', 'bhaiyyantop' ),
        'section'  => 'bhaiyyantop_colors_section',
    ) ) );

    // Accent Color
    $wp_customize->add_setting( 'bhaiyyantop_accent_color', array(
        'default'           => '#ffeb3b',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'bhaiyyantop_accent_color', array(
        'label'    => __( 'Highlight Accent Color (Yellow)', 'bhaiyyantop' ),
        'section'  => 'bhaiyyantop_colors_section',
    ) ) );

    // Body Background Color
    $wp_customize->add_setting( 'bhaiyyantop_body_bg_color', array(
        'default'           => '#f4f3ef',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'bhaiyyantop_body_bg_color', array(
        'label'    => __( 'Body Page Background Color', 'bhaiyyantop' ),
        'section'  => 'bhaiyyantop_colors_section',
    ) ) );

    // Main Body Text Color
    $wp_customize->add_setting( 'bhaiyyantop_text_color', array(
        'default'           => '#333333',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'bhaiyyantop_text_color', array(
        'label'    => __( 'Main Body Text Color', 'bhaiyyantop' ),
        'section'  => 'bhaiyyantop_colors_section',
    ) ) );

    // Global Border Color
    $wp_customize->add_setting( 'bhaiyyantop_border_color', array(
        'default'           => '#e0e0e0',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'bhaiyyantop_border_color', array(
        'label'    => __( 'Global Border Color', 'bhaiyyantop' ),
        'section'  => 'bhaiyyantop_colors_section',
    ) ) );

    // =============================================================
    // 15. LAYOUT SECTION
    // =============================================================
    $wp_customize->add_section( 'bhaiyyantop_layout_section', array(
        'title'    => __( '15. Layout & Container Settings', 'bhaiyyantop' ),
        'panel'    => 'bhaiyyantop_panel',
        'priority' => 150,
    ) );

    // Container Max Width (px)
    $wp_customize->add_setting( 'bhaiyyantop_container_width', array(
        'default'           => 1800,
        'transport'         => 'postMessage',
        'sanitize_callback' => 'absint',
    ) );
    $wp_customize->add_control( 'bhaiyyantop_container_width', array(
        'label'       => __( 'Container Max Width (px)', 'bhaiyyantop' ),
        'section'     => 'bhaiyyantop_layout_section',
        'type'        => 'number',
        'input_attrs' => array( 'min' => 960, 'max' => 2000, 'step' => 10 ),
    ) );

    // Content Gap / Grid Spacing (px)
    $wp_customize->add_setting( 'bhaiyyantop_content_gap', array(
        'default'           => 20,
        'transport'         => 'postMessage',
        'sanitize_callback' => 'absint',
    ) );
    $wp_customize->add_control( 'bhaiyyantop_content_gap', array(
        'label'       => __( 'Grid Content Gap (px)', 'bhaiyyantop' ),
        'section'     => 'bhaiyyantop_layout_section',
        'type'        => 'number',
        'input_attrs' => array( 'min' => 10, 'max' => 50, 'step' => 2 ),
    ) );

    // Container Border Radius
    $wp_customize->add_setting( 'bhaiyyantop_container_radius', array(
        'default'           => 8,
        'transport'         => 'postMessage',
        'sanitize_callback' => 'absint',
    ) );
    $wp_customize->add_control( 'bhaiyyantop_container_radius', array(
        'label'       => __( 'Container Border Radius (px)', 'bhaiyyantop' ),
        'section'     => 'bhaiyyantop_layout_section',
        'type'        => 'number',
        'input_attrs' => array( 'min' => 0, 'max' => 30, 'step' => 1 ),
    ) );

    // Search Placeholder Text
    $wp_customize->add_setting( 'bhaiyyantop_search_placeholder', array(
        'default'           => __( 'खबरें खोजें...', 'bhaiyyantop' ),
        'transport'         => 'postMessage',
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'bhaiyyantop_search_placeholder', array(
        'label'    => __( 'Search Input Placeholder Text', 'bhaiyyantop' ),
        'section'  => 'bhaiyyantop_layout_section',
        'type'     => 'text',
    ) );

    // Selective Refresh Support
    if ( isset( $wp_customize->selective_refresh ) ) {
        $wp_customize->selective_refresh->add_partial( 'bhaiyyantop_logo_text_title', array(
            'selector'        => '.logo-link',
            'render_callback' => function() {
                return esc_html( get_theme_mod( 'bhaiyyantop_logo_text_title', __( 'भैय्यान्टॉप', 'bhaiyyantop' ) ) );
            },
        ) );
        $wp_customize->selective_refresh->add_partial( 'bhaiyyantop_header_notice', array(
            'selector'        => '.ticker-label span',
            'render_callback' => function() {
                return esc_html( get_theme_mod( 'bhaiyyantop_header_notice', __( 'ताज़ा खबरें', 'bhaiyyantop' ) ) );
            },
        ) );
        $wp_customize->selective_refresh->add_partial( 'bhaiyyantop_footer_about_text', array(
            'selector'        => '.footer-widget:first-child p',
            'render_callback' => function() {
                return wp_kses_post( get_theme_mod( 'bhaiyyantop_footer_about_text', __( 'भैय्यान्टॉप भारत का एक अग्रणी न्यूज़ पोर्टल है...', 'bhaiyyantop' ) ) );
            },
        ) );
        $wp_customize->selective_refresh->add_partial( 'bhaiyyantop_footer_copyright', array(
            'selector'        => '.footer-bottom p',
            'render_callback' => function() {
                return wp_kses_post( get_theme_mod( 'bhaiyyantop_footer_copyright', sprintf( __( '© %s भैय्यान्टॉप. सर्वाधिकार सुरक्षित।', 'bhaiyyantop' ), date( 'Y' ) ) ) );
            },
        ) );
    }
}
add_action( 'customize_register', 'bhaiyyantop_customize_register' );

/**
 * Sanitize Checkbox
 */
function bhaiyyantop_sanitize_checkbox( $checked ) {
    return ( ( isset( $checked ) && true === $checked ) ? true : false );
}

/**
 * Sanitize Float Numbers
 */
function bhaiyyantop_sanitize_float( $input ) {
    return floatval( $input );
}

/**
 * Sanitize Select Dropdown Options
 */
function bhaiyyantop_sanitize_select( $input, $setting ) {
    $input   = sanitize_key( $input );
    $choices = $setting->manager->get_control( $setting->id )->choices;
    return ( array_key_exists( $input, $choices ) ? $input : $setting->default );
}

/**
 * Inject Dynamic CSS Variables into Head based on Theme Customizer settings
 */
function bhaiyyantop_customizer_css() {
    $primary_color        = get_theme_mod( 'bhaiyyantop_primary_color', '#e91e63' );
    $secondary_color      = get_theme_mod( 'bhaiyyantop_secondary_color', '#00bcd4' );
    $accent_color         = get_theme_mod( 'bhaiyyantop_accent_color', '#ffeb3b' );
    $body_bg_color        = get_theme_mod( 'bhaiyyantop_body_bg_color', '#f4f3ef' );
    $text_color           = get_theme_mod( 'bhaiyyantop_text_color', '#333333' );
    $border_color         = get_theme_mod( 'bhaiyyantop_border_color', '#e0e0e0' );

    $logo_width           = get_theme_mod( 'bhaiyyantop_logo_width', 400 );
    $logo_height          = get_theme_mod( 'bhaiyyantop_logo_height', 112 );

    $header_bg_color      = get_theme_mod( 'bhaiyyantop_header_bg_color', '#00bcd4' );
    $header_bg_img        = get_theme_mod( 'bhaiyyantop_header_bg_image', '' );
    $header_opacity       = get_theme_mod( 'bhaiyyantop_header_overlay_opacity', 0.65 );
    $header_min_height    = get_theme_mod( 'bhaiyyantop_header_min_height', 155 );
    $sticky_header_bg     = get_theme_mod( 'bhaiyyantop_sticky_header_bg_color', '#ffffff' );
    $sticky_header_shadow = get_theme_mod( 'bhaiyyantop_sticky_header_shadow', '0 4px 15px rgba(0, 0, 0, 0.08)' );
    $sticky_header_blur   = get_theme_mod( 'bhaiyyantop_sticky_header_blur', 8 );

    $nav_text_color       = get_theme_mod( 'bhaiyyantop_nav_text_color', '#111111' );
    $nav_hover_color      = get_theme_mod( 'bhaiyyantop_nav_hover_color', '#ffffff' );
    $nav_hover_bg         = get_theme_mod( 'bhaiyyantop_nav_hover_bg', '#e91e63' );
    $nav_dropdown_bg      = get_theme_mod( 'bhaiyyantop_nav_dropdown_bg', '#ffffff' );
    $mobile_menu_bg       = get_theme_mod( 'bhaiyyantop_mobile_menu_bg', '#ffffff' );
    $mobile_overlay_color = get_theme_mod( 'bhaiyyantop_mobile_overlay_color', 'rgba(0, 0, 0, 0.5)' );
    $hamburger_color      = get_theme_mod( 'bhaiyyantop_hamburger_color', '#111111' );
    $sticky_nav_color     = get_theme_mod( 'bhaiyyantop_sticky_nav_color', '#111111' );
    $nav_font_size        = get_theme_mod( 'bhaiyyantop_nav_font_size', 19 );

    $breaking_bg          = get_theme_mod( 'bhaiyyantop_breaking_news_bg', '#e91e63' );
    $breaking_text_color  = get_theme_mod( 'bhaiyyantop_breaking_news_text_color', '#ffffff' );

    $sidebar_title_color  = get_theme_mod( 'bhaiyyantop_sidebar_title_color', '#111111' );

    $heading_font         = get_theme_mod( 'bhaiyyantop_heading_font', 'Noto Sans Devanagari' );
    $body_font            = get_theme_mod( 'bhaiyyantop_body_font', 'Noto Sans Devanagari' );
    $base_font_size       = get_theme_mod( 'bhaiyyantop_base_font_size', 18 );
    $line_height          = get_theme_mod( 'bhaiyyantop_line_height', 1.6 );
    $letter_spacing       = get_theme_mod( 'bhaiyyantop_letter_spacing', 0 );

    $button_bg            = get_theme_mod( 'bhaiyyantop_button_bg', '#e91e63' );
    $button_secondary_bg  = get_theme_mod( 'bhaiyyantop_button_secondary_bg', '#00bcd4' );
    $button_hover         = get_theme_mod( 'bhaiyyantop_button_hover', '#c2185b' );
    $button_radius        = get_theme_mod( 'bhaiyyantop_button_radius', 6 );
    $button_shadow        = get_theme_mod( 'bhaiyyantop_button_shadow', '0 4px 10px rgba(0, 0, 0, 0.15)' );

    $card_border_radius   = get_theme_mod( 'bhaiyyantop_card_border_radius', 8 );
    $card_shadow          = get_theme_mod( 'bhaiyyantop_card_shadow', '0 2px 8px rgba(0, 0, 0, 0.06)' );
    $card_spacing         = get_theme_mod( 'bhaiyyantop_card_spacing', 20 );

    $transition_speed     = get_theme_mod( 'bhaiyyantop_transition_speed', 0.25 );

    $footer_bg_color      = get_theme_mod( 'bhaiyyantop_footer_bg_color', '#121216' );
    $footer_text_color    = get_theme_mod( 'bhaiyyantop_footer_text_color', '#a0a0a0' );

    $container_width      = get_theme_mod( 'bhaiyyantop_container_width', 1800 );
    $content_gap          = get_theme_mod( 'bhaiyyantop_content_gap', 20 );
    $container_radius     = get_theme_mod( 'bhaiyyantop_container_radius', 8 );

    $custom_css = "
        :root {
            --primary-color: " . esc_attr( $primary_color ) . ";
            --secondary-color: " . esc_attr( $secondary_color ) . ";
            --accent-yellow: " . esc_attr( $accent_color ) . ";
            --light-bg: " . esc_attr( $body_bg_color ) . ";
            --text-color: " . esc_attr( $text_color ) . ";
            --border-color: " . esc_attr( $border_color ) . ";

            --logo-width: " . esc_attr( $logo_width ) . "px;
            --logo-height: " . esc_attr( $logo_height ) . "px;

            --header-bg: " . esc_attr( $header_bg_color ) . ";
            --header-overlay-opacity: " . esc_attr( $header_opacity ) . ";
            --header-min-height: " . esc_attr( $header_min_height ) . "px;
            --sticky-header-bg: " . esc_attr( $sticky_header_bg ) . ";
            --sticky-header-shadow: " . esc_attr( $sticky_header_shadow ) . ";
            --sticky-header-blur: " . esc_attr( $sticky_header_blur ) . "px;

            --nav-text: " . esc_attr( $nav_text_color ) . ";
            --nav-hover: " . esc_attr( $nav_hover_color ) . ";
            --nav-hover-bg: " . esc_attr( $nav_hover_bg ) . ";
            --nav-dropdown-bg: " . esc_attr( $nav_dropdown_bg ) . ";
            --mobile-menu-bg: " . esc_attr( $mobile_menu_bg ) . ";
            --mobile-overlay-color: " . esc_attr( $mobile_overlay_color ) . ";
            --hamburger-color: " . esc_attr( $hamburger_color ) . ";
            --sticky-nav-color: " . esc_attr( $sticky_nav_color ) . ";
            --nav-font-size: " . esc_attr( $nav_font_size ) . "px;

            --breaking-bg: " . esc_attr( $breaking_bg ) . ";
            --breaking-text-color: " . esc_attr( $breaking_text_color ) . ";
            --sidebar-title-color: " . esc_attr( $sidebar_title_color ) . ";

            --button-bg: " . esc_attr( $button_bg ) . ";
            --button-secondary-bg: " . esc_attr( $button_secondary_bg ) . ";
            --button-hover: " . esc_attr( $button_hover ) . ";
            --button-radius: " . esc_attr( $button_radius ) . "px;
            --button-shadow: " . esc_attr( $button_shadow ) . ";

            --card-border-radius: " . esc_attr( $card_border_radius ) . "px;
            --card-shadow: " . esc_attr( $card_shadow ) . ";
            --card-spacing: " . esc_attr( $card_spacing ) . "px;
            --transition-speed: " . esc_attr( $transition_speed ) . "s;

            --footer-bg: " . esc_attr( $footer_bg_color ) . ";
            --footer-text: " . esc_attr( $footer_text_color ) . ";

            --font-primary: '" . esc_attr( $body_font ) . "', sans-serif;
            --font-heading: '" . esc_attr( $heading_font ) . "', sans-serif;
            --container-width: " . esc_attr( $container_width ) . "px;
            --content-gap: " . esc_attr( $content_gap ) . "px;
            --container-radius: " . esc_attr( $container_radius ) . "px;
        }

        body {
            font-family: var(--font-primary);
            font-size: " . esc_attr( $base_font_size ) . "px;
            line-height: " . esc_attr( $line_height ) . ";
            letter-spacing: " . esc_attr( $letter_spacing ) . "px;
            background-color: var(--light-bg);
            color: var(--text-color);
        }

        h1, h2, h3, h4, h5, h6, .site-header, .section-title, .widget-title {
            font-family: var(--font-heading);
        }

        .site-header {
            background-color: var(--header-bg);
            min-height: var(--header-min-height);
            " . ( ! empty( $header_bg_img ) ? "background-image: url('" . esc_url( $header_bg_img ) . "');" : "" ) . "
        }

        .site-header::before {
            background: linear-gradient(to bottom,
                rgba(0, 188, 212, 0) 0%,
                rgba(0, 188, 212, 0.2) 30%,
                rgba(0, 188, 212, 0.4) 60%,
                rgba(0, 188, 212, 0.65) 80%,
                rgba(0, 188, 212, var(--header-overlay-opacity)) 100%);
        }

        .custom-logo, .sticky-logo-img {
            max-width: var(--logo-width);
            max-height: var(--logo-height);
        }

        .bhaiyyantop-sticky-navbar {
            background-color: var(--sticky-header-bg);
            box-shadow: var(--sticky-header-shadow);
            backdrop-filter: blur(var(--sticky-header-blur));
        }

        .bhaiyyantop-sticky-navbar a {
            color: var(--sticky-nav-color);
        }

        .hamburger-bar {
            background-color: var(--hamburger-color);
        }

        .nav-menu-wrapper {
            background-color: var(--mobile-menu-bg);
        }

        .mobile-menu-backdrop {
            background: var(--mobile-overlay-color);
        }

        .nav-menu-wrapper .header-menu li a {
            color: var(--nav-text);
            font-size: var(--nav-font-size);
            border-radius: var(--container-radius);
        }

        .nav-menu-wrapper .header-menu li a:hover,
        .nav-menu-wrapper .header-menu li.current-menu-item a {
            background-color: var(--nav-hover-bg);
            color: var(--nav-hover);
        }

        .nav-menu-wrapper .header-menu ul.sub-menu {
            background-color: var(--nav-dropdown-bg);
        }

        .ticker-label {
            background-color: var(--breaking-bg);
            color: var(--breaking-text-color);
        }

        .widget-title {
            color: var(--sidebar-title-color);
        }

        button, .subscribe-btn, .search-submit-btn, .cat-tab-btn.active {
            background-color: var(--button-bg);
            border-radius: var(--button-radius);
            box-shadow: var(--button-shadow);
        }

        button:hover, .subscribe-btn:hover, .search-submit-btn:hover {
            background-color: var(--button-hover);
        }

        .grid-news-card, .mini-news-card, .editors-hero-card, .color-card-promo {
            border-radius: var(--card-border-radius);
            box-shadow: var(--card-shadow);
            transition: transform var(--transition-speed) ease, box-shadow var(--transition-speed) ease;
        }

        .site-footer {
            background-color: var(--footer-bg);
            color: var(--footer-text);
        }
    ";

    wp_add_inline_style( 'bhaiyyantop-style', $custom_css );
}
add_action( 'wp_enqueue_scripts', 'bhaiyyantop_customizer_css', 20 );

/**
 * Enqueue Customizer Live Preview JS
 */
function bhaiyyantop_customizer_preview_js() {
    $preview_js_path = get_template_directory() . '/assets/js/customizer-preview.js';
    if ( file_exists( $preview_js_path ) ) {
        wp_enqueue_script(
            'bhaiyyantop-customizer-preview',
            get_template_directory_uri() . '/assets/js/customizer-preview.js',
            array( 'customize-preview', 'jquery' ),
            filemtime( $preview_js_path ),
            true
        );
    }
}
add_action( 'customize_preview_init', 'bhaiyyantop_customizer_preview_js' );
