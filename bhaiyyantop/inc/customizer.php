<?php
/**
 * Refactored Bhaiyyantop Theme Customizer Integration
 *
 * Organizes Theme Customizer into 10 structured sections:
 * Brand, Header, Navigation, Typography, Buttons, Footer, Search, Ads, Social, and Layout.
 * Supports selective_refresh and postMessage live preview for every setting.
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
        'description'    => __( 'Full customization options for Brand, Header, Navigation, Typography, Buttons, Footer, Search, Ads, Social, and Layout.', 'bhaiyyantop' ),
    ) );

    // =============================================================
    // 1. BRAND SECTION
    // =============================================================
    $wp_customize->add_section( 'bhaiyyantop_brand_section', array(
        'title'    => __( '1. Brand & Logo', 'bhaiyyantop' ),
        'panel'    => 'bhaiyyantop_panel',
        'priority' => 10,
    ) );

    // Logo Text Title
    $wp_customize->add_setting( 'bhaiyyantop_logo_text_title', array(
        'default'           => __( 'भैय्यान्टॉप', 'bhaiyyantop' ),
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'bhaiyyantop_logo_text_title', array(
        'label'    => __( 'Header Logo Title Text', 'bhaiyyantop' ),
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

    // =============================================================
    // 2. HEADER SECTION
    // =============================================================
    $wp_customize->add_section( 'bhaiyyantop_header_section', array(
        'title'    => __( '2. Header & Banner', 'bhaiyyantop' ),
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

    // =============================================================
    // 3. NAVIGATION SECTION
    // =============================================================
    $wp_customize->add_section( 'bhaiyyantop_nav_section', array(
        'title'    => __( '3. Navigation Menu', 'bhaiyyantop' ),
        'panel'    => 'bhaiyyantop_panel',
        'priority' => 30,
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

    // =============================================================
    // 4. TYPOGRAPHY SECTION
    // =============================================================
    $wp_customize->add_section( 'bhaiyyantop_typography_section', array(
        'title'    => __( '4. Typography Settings', 'bhaiyyantop' ),
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

    // =============================================================
    // 5. BUTTONS SECTION
    // =============================================================
    $wp_customize->add_section( 'bhaiyyantop_button_section', array(
        'title'    => __( '5. Button Styles', 'bhaiyyantop' ),
        'panel'    => 'bhaiyyantop_panel',
        'priority' => 50,
    ) );

    // Button Background Color
    $wp_customize->add_setting( 'bhaiyyantop_button_bg', array(
        'default'           => '#e91e63',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'bhaiyyantop_button_bg', array(
        'label'    => __( 'Primary Button Background Color', 'bhaiyyantop' ),
        'section'  => 'bhaiyyantop_button_section',
    ) ) );

    // Button Hover Color
    $wp_customize->add_setting( 'bhaiyyantop_button_hover', array(
        'default'           => '#c2185b',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'bhaiyyantop_button_hover', array(
        'label'    => __( 'Primary Button Hover Color', 'bhaiyyantop' ),
        'section'  => 'bhaiyyantop_button_section',
    ) ) );

    // =============================================================
    // 6. FOOTER SECTION
    // =============================================================
    $wp_customize->add_section( 'bhaiyyantop_footer_section', array(
        'title'    => __( '6. Footer Options', 'bhaiyyantop' ),
        'panel'    => 'bhaiyyantop_panel',
        'priority' => 60,
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

    // =============================================================
    // 7. SEARCH SECTION
    // =============================================================
    $wp_customize->add_section( 'bhaiyyantop_search_section', array(
        'title'    => __( '7. Search Settings', 'bhaiyyantop' ),
        'panel'    => 'bhaiyyantop_panel',
        'priority' => 70,
    ) );

    // Search Placeholder Text
    $wp_customize->add_setting( 'bhaiyyantop_search_placeholder', array(
        'default'           => __( 'खबरें खोजें...', 'bhaiyyantop' ),
        'transport'         => 'postMessage',
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'bhaiyyantop_search_placeholder', array(
        'label'    => __( 'Search Input Placeholder Text', 'bhaiyyantop' ),
        'section'  => 'bhaiyyantop_search_section',
        'type'     => 'text',
    ) );

    // =============================================================
    // 8. ADS SECTION
    // =============================================================
    $wp_customize->add_section( 'bhaiyyantop_ads_section', array(
        'title'    => __( '8. Advertisement Slots', 'bhaiyyantop' ),
        'panel'    => 'bhaiyyantop_panel',
        'priority' => 80,
    ) );

    // Enable Header Ad Banner
    $wp_customize->add_setting( 'bhaiyyantop_enable_header_ad', array(
        'default'           => false,
        'sanitize_callback' => 'bhaiyyantop_sanitize_checkbox',
    ) );
    $wp_customize->add_control( 'bhaiyyantop_enable_header_ad', array(
        'label'    => __( 'Enable Top Header Ad Banner Space', 'bhaiyyantop' ),
        'section'  => 'bhaiyyantop_ads_section',
        'type'     => 'checkbox',
    ) );

    // Header Ad Code / HTML
    $wp_customize->add_setting( 'bhaiyyantop_header_ad_code', array(
        'default'           => '',
        'sanitize_callback' => 'wp_kses_post',
    ) );
    $wp_customize->add_control( 'bhaiyyantop_header_ad_code', array(
        'label'       => __( 'Header Ad Embed Code / HTML', 'bhaiyyantop' ),
        'section'     => 'bhaiyyantop_ads_section',
        'type'        => 'textarea',
        'description' => __( 'Paste AdSense script or banner HTML code.', 'bhaiyyantop' ),
    ) );

    // =============================================================
    // 9. SOCIAL LINKS SECTION
    // =============================================================
    $wp_customize->add_section( 'bhaiyyantop_social_section', array(
        'title'    => __( '9. Social Media Links', 'bhaiyyantop' ),
        'panel'    => 'bhaiyyantop_panel',
        'priority' => 90,
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

    // =============================================================
    // 10. LAYOUT & COLORS SECTION
    // =============================================================
    $wp_customize->add_section( 'bhaiyyantop_layout_section', array(
        'title'    => __( '10. Theme Colors & Layout', 'bhaiyyantop' ),
        'panel'    => 'bhaiyyantop_panel',
        'priority' => 100,
    ) );

    // Primary Color
    $wp_customize->add_setting( 'bhaiyyantop_primary_color', array(
        'default'           => '#e91e63',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'bhaiyyantop_primary_color', array(
        'label'    => __( 'Primary Accent Color (Pink/Red)', 'bhaiyyantop' ),
        'section'  => 'bhaiyyantop_layout_section',
    ) ) );

    // Secondary Color
    $wp_customize->add_setting( 'bhaiyyantop_secondary_color', array(
        'default'           => '#00bcd4',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'bhaiyyantop_secondary_color', array(
        'label'    => __( 'Secondary Accent Color (Teal)', 'bhaiyyantop' ),
        'section'  => 'bhaiyyantop_layout_section',
    ) ) );

    // Accent Color
    $wp_customize->add_setting( 'bhaiyyantop_accent_color', array(
        'default'           => '#ffeb3b',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'bhaiyyantop_accent_color', array(
        'label'    => __( 'Accent Highlight Color (Yellow)', 'bhaiyyantop' ),
        'section'  => 'bhaiyyantop_layout_section',
    ) ) );

    // Body Background Color
    $wp_customize->add_setting( 'bhaiyyantop_body_bg_color', array(
        'default'           => '#f4f3ef',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'bhaiyyantop_body_bg_color', array(
        'label'    => __( 'Body Page Background Color', 'bhaiyyantop' ),
        'section'  => 'bhaiyyantop_layout_section',
    ) ) );

    // Container Radius
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

    // Ticker Badge Label
    $wp_customize->add_setting( 'bhaiyyantop_header_notice', array(
        'default'           => __( 'ताज़ा खबरें', 'bhaiyyantop' ),
        'transport'         => 'postMessage',
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'bhaiyyantop_header_notice', array(
        'label'    => __( 'Ticker Badge Label Text', 'bhaiyyantop' ),
        'section'  => 'bhaiyyantop_layout_section',
        'type'     => 'text',
    ) );

    // Selective Refresh Support for live updates without full page refresh
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
