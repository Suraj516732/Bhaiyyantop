<?php
/**
 * Comprehensive Bhaiyyantop Theme Customizer Integration
 *
 * Provides editable Theme Customizer settings for Header Background, Colors,
 * Typography, Logo, Breaking News Ticker, Dark Mode, Social Links, and Footer.
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
        'description'    => __( 'Customize Header, Colors, Typography, Logo, Ticker, Dark Mode, Social Links, and Footer.', 'bhaiyyantop' ),
    ) );

    // -------------------------------------------------------------
    // Section 1: Logo & Branding
    // -------------------------------------------------------------
    $wp_customize->add_section( 'bhaiyyantop_logo_section', array(
        'title'    => __( 'Logo & Branding', 'bhaiyyantop' ),
        'panel'    => 'bhaiyyantop_panel',
        'priority' => 10,
    ) );

    // Logo Bubble Letter
    $wp_customize->add_setting( 'bhaiyyantop_logo_bubble_letter', array(
        'default'           => 'भ',
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
        'default'           => '#1a1a1a',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'bhaiyyantop_header_bg_color', array(
        'label'    => __( 'Header Background Color', 'bhaiyyantop' ),
        'section'  => 'bhaiyyantop_header_section',
    ) ) );

    // Header Background Image Upload
    $wp_customize->add_setting( 'bhaiyyantop_header_bg_image', array(
        'default'           => '',
        'sanitize_callback' => 'esc_url_raw',
    ) );
    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'bhaiyyantop_header_bg_image', array(
        'label'    => __( 'Header Background Banner Image', 'bhaiyyantop' ),
        'section'  => 'bhaiyyantop_header_section',
    ) ) );

    // -------------------------------------------------------------
    // Section 3: Colors & Theme Style
    // -------------------------------------------------------------
    $wp_customize->add_section( 'bhaiyyantop_colors_section', array(
        'title'    => __( 'Colors & Accent Theme', 'bhaiyyantop' ),
        'panel'    => 'bhaiyyantop_panel',
        'priority' => 30,
    ) );

    // Primary Color
    $wp_customize->add_setting( 'bhaiyyantop_primary_color', array(
        'default'           => '#e91e63',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'bhaiyyantop_primary_color', array(
        'label'    => __( 'Primary Accent Color (Pink/Red)', 'bhaiyyantop' ),
        'section'  => 'bhaiyyantop_colors_section',
    ) ) );

    // Secondary Color
    $wp_customize->add_setting( 'bhaiyyantop_secondary_color', array(
        'default'           => '#00bcd4',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'bhaiyyantop_secondary_color', array(
        'label'    => __( 'Secondary Accent Color (Teal)', 'bhaiyyantop' ),
        'section'  => 'bhaiyyantop_colors_section',
    ) ) );

    // Body Background Color
    $wp_customize->add_setting( 'bhaiyyantop_body_bg_color', array(
        'default'           => '#f4f6f9',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'bhaiyyantop_body_bg_color', array(
        'label'    => __( 'Body Page Background Color', 'bhaiyyantop' ),
        'section'  => 'bhaiyyantop_colors_section',
    ) ) );

    // -------------------------------------------------------------
    // Section 4: Typography Settings
    // -------------------------------------------------------------
    $wp_customize->add_section( 'bhaiyyantop_typography_section', array(
        'title'    => __( 'Typography Settings', 'bhaiyyantop' ),
        'panel'    => 'bhaiyyantop_panel',
        'priority' => 40,
    ) );

    // Heading Font Family
    $wp_customize->add_setting( 'bhaiyyantop_heading_font', array(
        'default'           => 'Noto Sans Devanagari',
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
        'default'           => 16,
        'sanitize_callback' => 'absint',
    ) );
    $wp_customize->add_control( 'bhaiyyantop_base_font_size', array(
        'label'       => __( 'Base Font Size (px)', 'bhaiyyantop' ),
        'section'     => 'bhaiyyantop_typography_section',
        'type'        => 'number',
        'input_attrs' => array( 'min' => 12, 'max' => 22, 'step' => 1 ),
    ) );

    // -------------------------------------------------------------
    // Section 5: Breaking News & Ticker
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
        'default'           => __( 'ताजा खबरें', 'bhaiyyantop' ),
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
    // Section 6: Dark Mode Settings
    // -------------------------------------------------------------
    $wp_customize->add_section( 'bhaiyyantop_darkmode_section', array(
        'title'    => __( 'Dark Mode Settings', 'bhaiyyantop' ),
        'panel'    => 'bhaiyyantop_panel',
        'priority' => 60,
    ) );

    // Enable Dark Mode Toggle Button in Header
    $wp_customize->add_setting( 'bhaiyyantop_enable_dark_mode_toggle', array(
        'default'           => true,
        'sanitize_callback' => 'bhaiyyantop_sanitize_checkbox',
    ) );
    $wp_customize->add_control( 'bhaiyyantop_enable_dark_mode_toggle', array(
        'label'    => __( 'Enable Dark Mode Toggle Button', 'bhaiyyantop' ),
        'section'  => 'bhaiyyantop_darkmode_section',
        'type'     => 'checkbox',
    ) );

    // Default Theme Mode
    $wp_customize->add_setting( 'bhaiyyantop_default_theme_mode', array(
        'default'           => 'light',
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'bhaiyyantop_default_theme_mode', array(
        'label'   => __( 'Default Theme Appearance Mode', 'bhaiyyantop' ),
        'section' => 'bhaiyyantop_darkmode_section',
        'type'    => 'select',
        'choices' => array(
            'light' => __( 'Light Mode (Default)', 'bhaiyyantop' ),
            'dark'  => __( 'Dark Mode', 'bhaiyyantop' ),
        ),
    ) );

    // -------------------------------------------------------------
    // Section 7: Social Links
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
            'sanitize_callback' => 'esc_url_raw',
        ) );
        $wp_customize->add_control( 'bhaiyyantop_social_' . $key, array(
            'label'   => $label,
            'section' => 'bhaiyyantop_social_section',
            'type'    => 'url',
        ) );
    }

    // -------------------------------------------------------------
    // Section 8: Footer Options
    // -------------------------------------------------------------
    $wp_customize->add_section( 'bhaiyyantop_footer_section', array(
        'title'    => __( 'Footer Options', 'bhaiyyantop' ),
        'panel'    => 'bhaiyyantop_panel',
        'priority' => 80,
    ) );

    // Footer About Title
    $wp_customize->add_setting( 'bhaiyyantop_footer_about_title', array(
        'default'           => __( 'हमारे बारे में', 'bhaiyyantop' ),
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
        'sanitize_callback' => 'sanitize_hex_color',
    ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'bhaiyyantop_footer_bg_color', array(
        'label'    => __( 'Footer Background Color', 'bhaiyyantop' ),
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
 * Inject Customizer CSS into Head
 */
function bhaiyyantop_customizer_css() {
    $primary_color   = get_theme_mod( 'bhaiyyantop_primary_color', '#e91e63' );
    $secondary_color = get_theme_mod( 'bhaiyyantop_secondary_color', '#00bcd4' );
    $body_bg_color   = get_theme_mod( 'bhaiyyantop_body_bg_color', '#f4f6f9' );
    $header_bg_color = get_theme_mod( 'bhaiyyantop_header_bg_color', '#1a1a1a' );
    $header_bg_img   = get_theme_mod( 'bhaiyyantop_header_bg_image', '' );
    $footer_bg_color = get_theme_mod( 'bhaiyyantop_footer_bg_color', '#121216' );
    $heading_font    = get_theme_mod( 'bhaiyyantop_heading_font', 'Noto Sans Devanagari' );
    $body_font       = get_theme_mod( 'bhaiyyantop_body_font', 'Noto Sans Devanagari' );
    $base_font_size  = get_theme_mod( 'bhaiyyantop_base_font_size', 16 );

    $custom_css = "
        :root {
            --primary-color: " . esc_attr( $primary_color ) . ";
            --secondary-color: " . esc_attr( $secondary_color ) . ";
            --bg-color: " . esc_attr( $body_bg_color ) . ";
            --heading-font: '" . esc_attr( $heading_font ) . "', sans-serif;
            --body-font: '" . esc_attr( $body_font ) . "', sans-serif;
        }

        body {
            font-family: var(--body-font);
            font-size: " . esc_attr( $base_font_size ) . "px;
            background-color: var(--bg-color);
        }

        h1, h2, h3, h4, h5, h6, .site-header, .section-title {
            font-family: var(--heading-font);
        }

        .site-header {
            background-color: " . esc_attr( $header_bg_color ) . ";
            " . ( ! empty( $header_bg_img ) ? "background-image: url('" . esc_url( $header_bg_img ) . "'); background-size: cover; background-position: center;" : "" ) . "
        }

        .site-footer {
            background-color: " . esc_attr( $footer_bg_color ) . ";
        }
    ";

    wp_add_inline_style( 'bhaiyyantop-style', $custom_css );
}
add_action( 'wp_enqueue_scripts', 'bhaiyyantop_customizer_css', 20 );
