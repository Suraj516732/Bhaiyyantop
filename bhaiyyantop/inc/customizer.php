<?php
/**
 * Comprehensive Bhaiyyantop Theme Customizer Integration
 *
 * Provides full Theme Customizer options for Header Background, Overlay, Colors,
 * Navigation, Typography, Logo, Breaking News Ticker, Buttons, Dark Mode, Social Links, and Footer.
 * All options dynamically generate :root CSS variables with live 'postMessage' preview.
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

    // Main Panel: Bhaiyyantop Theme Options
    $wp_customize->add_panel( 'bhaiyyantop_panel', array(
        'priority'       => 10,
        'capability'     => 'edit_theme_options',
        'theme_supports' => '',
        'title'          => __( 'Bhaiyyantop Theme Options', 'bhaiyyantop' ),
        'description'    => __( 'Customize Header, Navigation, Colors, Typography, Buttons, Ticker, Social Links, and Footer.', 'bhaiyyantop' ),
    ) );

    // -------------------------------------------------------------
    // Section 1: Logo & Branding
    // -------------------------------------------------------------
    $wp_customize->add_section( 'bhaiyyantop_logo_section', array(
        'title'    => __( 'Logo & Branding', 'bhaiyyantop' ),
        'panel'    => 'bhaiyyantop_panel',
        'priority' => 10,
    ) );

    // Logo Icon Bubble Character
    $wp_customize->add_setting( 'bhaiyyantop_logo_bubble_letter', array(
        'default'           => 'भ',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'bhaiyyantop_logo_bubble_letter', array(
        'label'    => __( 'Logo Icon Bubble Character', 'bhaiyyantop' ),
        'section'  => 'bhaiyyantop_logo_section',
        'type'     => 'text',
    ) );

    // Logo Text Title
    $wp_customize->add_setting( 'bhaiyyantop_logo_text_title', array(
        'default'           => __( 'भैय्यान्टॉप', 'bhaiyyantop' ),
        'transport'         => 'postMessage',
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'bhaiyyantop_logo_text_title', array(
        'label'    => __( 'Header Logo Title Text', 'bhaiyyantop' ),
        'section'  => 'bhaiyyantop_logo_section',
        'type'     => 'text',
    ) );

    // -------------------------------------------------------------
    // Section 2: Header & Header Background
    // -------------------------------------------------------------
    $wp_customize->add_section( 'bhaiyyantop_header_section', array(
        'title'    => __( 'Header & Background', 'bhaiyyantop' ),
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

    // Header Background Image Upload
    $wp_customize->add_setting( 'bhaiyyantop_header_bg_image', array(
        'default'           => '',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'esc_url_raw',
    ) );
    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'bhaiyyantop_header_bg_image', array(
        'label'    => __( 'Header Background Banner Image', 'bhaiyyantop' ),
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

    // Header Minimum Height
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

    // -------------------------------------------------------------
    // Section 3: Navigation Menu Styling
    // -------------------------------------------------------------
    $wp_customize->add_section( 'bhaiyyantop_nav_section', array(
        'title'    => __( 'Navigation Menu Styling', 'bhaiyyantop' ),
        'panel'    => 'bhaiyyantop_panel',
        'priority' => 25,
    ) );

    // Nav Item Text Color
    $wp_customize->add_setting( 'bhaiyyantop_nav_text_color', array(
        'default'           => '#111111',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'bhaiyyantop_nav_text_color', array(
        'label'    => __( 'Navigation Link Text Color', 'bhaiyyantop' ),
        'section'  => 'bhaiyyantop_nav_section',
    ) ) );

    // Nav Item Hover Text Color
    $wp_customize->add_setting( 'bhaiyyantop_nav_hover_color', array(
        'default'           => '#ffffff',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'bhaiyyantop_nav_hover_color', array(
        'label'    => __( 'Navigation Hover Text Color', 'bhaiyyantop' ),
        'section'  => 'bhaiyyantop_nav_section',
    ) ) );

    // Nav Item Hover Background Color
    $wp_customize->add_setting( 'bhaiyyantop_nav_hover_bg', array(
        'default'           => '#e91e63',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'bhaiyyantop_nav_hover_bg', array(
        'label'    => __( 'Navigation Hover/Active Background Color', 'bhaiyyantop' ),
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

    // -------------------------------------------------------------
    // Section 4: Colors & Theme Style
    // -------------------------------------------------------------
    $wp_customize->add_section( 'bhaiyyantop_colors_section', array(
        'title'    => __( 'Colors & Accent Theme', 'bhaiyyantop' ),
        'panel'    => 'bhaiyyantop_panel',
        'priority' => 30,
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
        'label'    => __( 'Accent Highlight Color (Yellow)', 'bhaiyyantop' ),
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

    // Container Radius
    $wp_customize->add_setting( 'bhaiyyantop_container_radius', array(
        'default'           => 8,
        'transport'         => 'postMessage',
        'sanitize_callback' => 'absint',
    ) );
    $wp_customize->add_control( 'bhaiyyantop_container_radius', array(
        'label'       => __( 'Container Border Radius (px)', 'bhaiyyantop' ),
        'section'     => 'bhaiyyantop_colors_section',
        'type'        => 'number',
        'input_attrs' => array( 'min' => 0, 'max' => 30, 'step' => 1 ),
    ) );

    // -------------------------------------------------------------
    // Section 5: Button Styles
    // -------------------------------------------------------------
    $wp_customize->add_section( 'bhaiyyantop_button_section', array(
        'title'    => __( 'Button Styles', 'bhaiyyantop' ),
        'panel'    => 'bhaiyyantop_panel',
        'priority' => 35,
    ) );

    // Button Background Color
    $wp_customize->add_setting( 'bhaiyyantop_button_bg', array(
        'default'           => '#e91e63',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'bhaiyyantop_button_bg', array(
        'label'    => __( 'Button Background Color', 'bhaiyyantop' ),
        'section'  => 'bhaiyyantop_button_section',
    ) ) );

    // Button Hover Color
    $wp_customize->add_setting( 'bhaiyyantop_button_hover', array(
        'default'           => '#c2185b',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'bhaiyyantop_button_hover', array(
        'label'    => __( 'Button Hover Color', 'bhaiyyantop' ),
        'section'  => 'bhaiyyantop_button_section',
    ) ) );

    // -------------------------------------------------------------
    // Section 6: Typography Settings
    // -------------------------------------------------------------
    $wp_customize->add_section( 'bhaiyyantop_typography_section', array(
        'title'    => __( 'Typography Settings', 'bhaiyyantop' ),
        'panel'    => 'bhaiyyantop_panel',
        'priority' => 40,
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
            'Arial, sans-serif'    => 'System Sans-Serif',
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
        'input_attrs' => array( 'min' => 12, 'max' => 24, 'step' => 1 ),
    ) );

    // -------------------------------------------------------------
    // Section 7: Breaking News & Ticker
    // -------------------------------------------------------------
    $wp_customize->add_section( 'bhaiyyantop_ticker_section', array(
        'title'    => __( 'Breaking News & Ticker', 'bhaiyyantop' ),
        'panel'    => 'bhaiyyantop_panel',
        'priority' => 50,
    ) );

    // Show/Hide Ticker
    $wp_customize->add_setting( 'bhaiyyantop_show_ticker', array(
        'default'           => true,
        'sanitize_callback' => 'bhaiyyantop_sanitize_checkbox',
    ) );
    $wp_customize->add_control( 'bhaiyyantop_show_ticker', array(
        'label'    => __( 'Show Breaking News Ticker', 'bhaiyyantop' ),
        'section'  => 'bhaiyyantop_ticker_section',
        'type'     => 'checkbox',
    ) );

    // Ticker Badge Label
    $wp_customize->add_setting( 'bhaiyyantop_header_notice', array(
        'default'           => __( 'ताज़ा खबरें', 'bhaiyyantop' ),
        'transport'         => 'postMessage',
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'bhaiyyantop_header_notice', array(
        'label'    => __( 'Ticker Badge Label Text', 'bhaiyyantop' ),
        'section'  => 'bhaiyyantop_ticker_section',
        'type'     => 'text',
    ) );

    // Ticker Auto-Scroll Speed (ms)
    $wp_customize->add_setting( 'bhaiyyantop_ticker_speed', array(
        'default'           => 4000,
        'sanitize_callback' => 'absint',
    ) );
    $wp_customize->add_control( 'bhaiyyantop_ticker_speed', array(
        'label'       => __( 'Ticker Slide Speed (Milliseconds)', 'bhaiyyantop' ),
        'section'     => 'bhaiyyantop_ticker_section',
        'type'        => 'number',
        'input_attrs' => array( 'min' => 1000, 'max' => 10000, 'step' => 500 ),
    ) );

    // -------------------------------------------------------------
    // Section 8: Social Links
    // -------------------------------------------------------------
    $wp_customize->add_section( 'bhaiyyantop_social_section', array(
        'title'    => __( 'Social Links', 'bhaiyyantop' ),
        'panel'    => 'bhaiyyantop_panel',
        'priority' => 70,
    ) );

    $social_networks = array(
        'facebook'  => __( 'Facebook URL', 'bhaiyyantop' ),
        'twitter'   => __( 'Twitter / X URL', 'bhaiyyantop' ),
        'instagram' => __( 'Instagram URL', 'bhaiyyantop' ),
        'youtube'   => __( 'YouTube URL', 'bhaiyyantop' ),
        'telegram'  => __( 'Telegram URL', 'bhaiyyantop' ),
        'whatsapp'  => __( 'WhatsApp Channel URL', 'bhaiyyantop' ),
        'linkedin'  => __( 'LinkedIn URL', 'bhaiyyantop' ),
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

    // -------------------------------------------------------------
    // Section 9: Footer Options
    // -------------------------------------------------------------
    $wp_customize->add_section( 'bhaiyyantop_footer_section', array(
        'title'    => __( 'Footer Options', 'bhaiyyantop' ),
        'panel'    => 'bhaiyyantop_panel',
        'priority' => 80,
    ) );

    // Footer About Title
    $wp_customize->add_setting( 'bhaiyyantop_footer_about_title', array(
        'default'           => __( 'हमारे बारे में', 'bhaiyyantop' ),
        'transport'         => 'postMessage',
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'bhaiyyantop_footer_about_title', array(
        'label'    => __( 'Footer About Column Title', 'bhaiyyantop' ),
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
        'label'    => __( 'Footer About Text Description', 'bhaiyyantop' ),
        'section'  => 'bhaiyyantop_footer_section',
        'type'     => 'textarea',
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
}
add_action( 'customize_register', 'bhaiyyantop_customize_register' );

/**
 * Sanitize Checkbox
 */
function bhaiyyantop_sanitize_checkbox( $checked ) {
    return ( ( isset( $checked ) && true === $checked ) ? true : false );
}

/**
 * Sanitize Float / Opacity Numbers
 */
function bhaiyyantop_sanitize_float( $input ) {
    return floatval( $input );
}

/**
 * Inject Dynamic CSS Variables into Head based on Theme Customizer settings
 */
function bhaiyyantop_customizer_css() {
    $primary_color     = get_theme_mod( 'bhaiyyantop_primary_color', '#e91e63' );
    $secondary_color   = get_theme_mod( 'bhaiyyantop_secondary_color', '#00bcd4' );
    $accent_color      = get_theme_mod( 'bhaiyyantop_accent_color', '#ffeb3b' );
    $body_bg_color     = get_theme_mod( 'bhaiyyantop_body_bg_color', '#f4f3ef' );
    $header_bg_color   = get_theme_mod( 'bhaiyyantop_header_bg_color', '#00bcd4' );
    $header_bg_img     = get_theme_mod( 'bhaiyyantop_header_bg_image', '' );
    $header_opacity    = get_theme_mod( 'bhaiyyantop_header_overlay_opacity', 0.65 );
    $header_min_height = get_theme_mod( 'bhaiyyantop_header_min_height', 155 );
    
    $nav_text_color    = get_theme_mod( 'bhaiyyantop_nav_text_color', '#111111' );
    $nav_hover_color   = get_theme_mod( 'bhaiyyantop_nav_hover_color', '#ffffff' );
    $nav_hover_bg      = get_theme_mod( 'bhaiyyantop_nav_hover_bg', '#e91e63' );
    $nav_font_size     = get_theme_mod( 'bhaiyyantop_nav_font_size', 19 );
    
    $button_bg         = get_theme_mod( 'bhaiyyantop_button_bg', '#e91e63' );
    $button_hover      = get_theme_mod( 'bhaiyyantop_button_hover', '#c2185b' );
    
    $footer_bg_color   = get_theme_mod( 'bhaiyyantop_footer_bg_color', '#121216' );
    $footer_text_color = get_theme_mod( 'bhaiyyantop_footer_text_color', '#a0a0a0' );
    
    $heading_font      = get_theme_mod( 'bhaiyyantop_heading_font', 'Noto Sans Devanagari' );
    $body_font         = get_theme_mod( 'bhaiyyantop_body_font', 'Noto Sans Devanagari' );
    $base_font_size    = get_theme_mod( 'bhaiyyantop_base_font_size', 18 );
    $container_radius  = get_theme_mod( 'bhaiyyantop_container_radius', 8 );

    $custom_css = "
        :root {
            --primary-color: " . esc_attr( $primary_color ) . ";
            --secondary-color: " . esc_attr( $secondary_color ) . ";
            --accent-yellow: " . esc_attr( $accent_color ) . ";
            --light-bg: " . esc_attr( $body_bg_color ) . ";
            --header-bg: " . esc_attr( $header_bg_color ) . ";
            --header-overlay-opacity: " . esc_attr( $header_opacity ) . ";
            --header-min-height: " . esc_attr( $header_min_height ) . "px;
            --nav-text: " . esc_attr( $nav_text_color ) . ";
            --nav-hover: " . esc_attr( $nav_hover_color ) . ";
            --nav-hover-bg: " . esc_attr( $nav_hover_bg ) . ";
            --nav-font-size: " . esc_attr( $nav_font_size ) . "px;
            --button-bg: " . esc_attr( $button_bg ) . ";
            --button-hover: " . esc_attr( $button_hover ) . ";
            --footer-bg: " . esc_attr( $footer_bg_color ) . ";
            --footer-text: " . esc_attr( $footer_text_color ) . ";
            --font-primary: '" . esc_attr( $body_font ) . "', sans-serif;
            --font-heading: '" . esc_attr( $heading_font ) . "', sans-serif;
            --container-radius: " . esc_attr( $container_radius ) . "px;
        }

        body {
            font-family: var(--font-primary);
            font-size: " . esc_attr( $base_font_size ) . "px;
            background-color: var(--light-bg);
        }

        h1, h2, h3, h4, h5, h6, .site-header, .section-title {
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
