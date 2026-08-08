<?php
/**
 * Refactored Bhaiyyantop Theme Customizer Integration
 *
 * Organizes Theme Customizer into structured sections:
 * Brand, Header, Navigation, Typography, Colors, Buttons, Cards & Layout, Footer, Search, Breaking News, Ads, and Social Media.
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

    // Custom Logo Image
    $wp_customize->add_setting( 'bhaiyyantop_logo', array(
        'default'           => '',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'esc_url_raw',
    ) );
    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'bhaiyyantop_logo', array(
        'label'    => __( 'Custom Logo Image', 'bhaiyyantop' ),
        'section'  => 'bhaiyyantop_brand_section',
    ) ) );

    // Retina Logo Image (2x)
    $wp_customize->add_setting( 'bhaiyyantop_retina_logo', array(
        'default'           => '',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'esc_url_raw',
    ) );
    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'bhaiyyantop_retina_logo', array(
        'label'    => __( 'Retina Logo Image (2x)', 'bhaiyyantop' ),
        'section'  => 'bhaiyyantop_brand_section',
    ) ) );

    // Logo Text Title
    $wp_customize->add_setting( 'bhaiyyantop_logo_text_title', array(
        'default'           => __( 'भैय्यान्टॉप', 'bhaiyyantop' ),
        'transport'         => 'postMessage',
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

    // Logo Max Width
    $wp_customize->add_setting( 'bhaiyyantop_logo_width', array(
        'default'           => 400,
        'transport'         => 'postMessage',
        'sanitize_callback' => 'absint',
    ) );
    $wp_customize->add_control( 'bhaiyyantop_logo_width', array(
        'label'       => __( 'Logo Max Width (px)', 'bhaiyyantop' ),
        'section'     => 'bhaiyyantop_brand_section',
        'type'        => 'number',
        'input_attrs' => array( 'min' => 100, 'max' => 800, 'step' => 5 ),
    ) );

    // Logo Max Height
    $wp_customize->add_setting( 'bhaiyyantop_logo_height', array(
        'default'           => 112,
        'transport'         => 'postMessage',
        'sanitize_callback' => 'absint',
    ) );
    $wp_customize->add_control( 'bhaiyyantop_logo_height', array(
        'label'       => __( 'Logo Max Height (px)', 'bhaiyyantop' ),
        'section'     => 'bhaiyyantop_brand_section',
        'type'        => 'number',
        'input_attrs' => array( 'min' => 30, 'max' => 300, 'step' => 2 ),
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
        'default'           => '0.95',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'bhaiyyantop_header_overlay_opacity', array(
        'label'       => __( 'Header Gradient Overlay Opacity', 'bhaiyyantop' ),
        'section'     => 'bhaiyyantop_header_section',
        'type'        => 'number',
        'input_attrs' => array( 'min' => 0, 'max' => 1, 'step' => 0.05 ),
    ) );

    // Header Min Height
    $wp_customize->add_setting( 'bhaiyyantop_header_min_height', array(
        'default'           => 120,
        'transport'         => 'postMessage',
        'sanitize_callback' => 'absint',
    ) );
    $wp_customize->add_control( 'bhaiyyantop_header_min_height', array(
        'label'       => __( 'Header Minimum Height (px)', 'bhaiyyantop' ),
        'section'     => 'bhaiyyantop_header_section',
        'type'        => 'number',
        'input_attrs' => array( 'min' => 60, 'max' => 300, 'step' => 5 ),
    ) );

    // Sticky Header Enable
    $wp_customize->add_setting( 'bhaiyyantop_sticky_header_enable', array(
        'default'           => true,
        'transport'         => 'refresh',
        'sanitize_callback' => 'bhaiyyantop_sanitize_checkbox',
    ) );
    $wp_customize->add_control( 'bhaiyyantop_sticky_header_enable', array(
        'label'    => __( 'Enable Sticky Navigation Bar', 'bhaiyyantop' ),
        'section'  => 'bhaiyyantop_header_section',
        'type'     => 'checkbox',
    ) );

    // Sticky Header Background
    $wp_customize->add_setting( 'bhaiyyantop_sticky_header_bg', array(
        'default'           => '#00bcd4',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'bhaiyyantop_sticky_header_bg', array(
        'label'    => __( 'Sticky Header Background Color', 'bhaiyyantop' ),
        'section'  => 'bhaiyyantop_header_section',
    ) ) );

    // Sticky Header Shadow
    $wp_customize->add_setting( 'bhaiyyantop_sticky_header_shadow', array(
        'default'           => '0 4px 15px rgba(0, 0, 0, 0.12)',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'bhaiyyantop_sticky_header_shadow', array(
        'label'    => __( 'Sticky Header Shadow (CSS box-shadow)', 'bhaiyyantop' ),
        'section'  => 'bhaiyyantop_header_section',
        'type'     => 'text',
    ) );

    // Sticky Header Blur
    $wp_customize->add_setting( 'bhaiyyantop_sticky_header_blur', array(
        'default'           => 10,
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
        'title'    => __( '3. Navigation Menu', 'bhaiyyantop' ),
        'panel'    => 'bhaiyyantop_panel',
        'priority' => 30,
    ) );

    // Nav Item Text Color
    $wp_customize->add_setting( 'bhaiyyantop_nav_text_color', array(
        'default'           => '#ffffff',
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

    // Dropdown Background
    $wp_customize->add_setting( 'bhaiyyantop_nav_dropdown_bg', array(
        'default'           => '#ffffff',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'bhaiyyantop_nav_dropdown_bg', array(
        'label'    => __( 'Navigation Dropdown Menu Background Color', 'bhaiyyantop' ),
        'section'  => 'bhaiyyantop_nav_section',
    ) ) );

    // Mobile Menu Background
    $wp_customize->add_setting( 'bhaiyyantop_mobile_menu_bg', array(
        'default'           => '#ffffff',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'bhaiyyantop_mobile_menu_bg', array(
        'label'    => __( 'Mobile Dropdown Menu Background Color', 'bhaiyyantop' ),
        'section'  => 'bhaiyyantop_nav_section',
    ) ) );

    // Hamburger Icon Color
    $wp_customize->add_setting( 'bhaiyyantop_hamburger_color', array(
        'default'           => '#111111',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'bhaiyyantop_hamburger_color', array(
        'label'    => __( 'Mobile Hamburger Icon Color', 'bhaiyyantop' ),
        'section'  => 'bhaiyyantop_nav_section',
    ) ) );

    // Sticky Nav Text Color
    $wp_customize->add_setting( 'bhaiyyantop_sticky_nav_color', array(
        'default'           => '#ffffff',
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
        'default'           => 16,
        'transport'         => 'postMessage',
        'sanitize_callback' => 'absint',
    ) );
    $wp_customize->add_control( 'bhaiyyantop_base_font_size', array(
        'label'       => __( 'Base Font Size (px)', 'bhaiyyantop' ),
        'section'     => 'bhaiyyantop_typography_section',
        'type'        => 'number',
        'input_attrs' => array( 'min' => 12, 'max' => 22, 'step' => 1 ),
    ) );

    // Line Height
    $wp_customize->add_setting( 'bhaiyyantop_line_height', array(
        'default'           => '1.6',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'bhaiyyantop_line_height', array(
        'label'       => __( 'Body Line Height', 'bhaiyyantop' ),
        'section'     => 'bhaiyyantop_typography_section',
        'type'        => 'number',
        'input_attrs' => array( 'min' => 1.2, 'max' => 2.2, 'step' => 0.05 ),
    ) );

    // Letter Spacing
    $wp_customize->add_setting( 'bhaiyyantop_letter_spacing', array(
        'default'           => '0',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'bhaiyyantop_letter_spacing', array(
        'label'       => __( 'Letter Spacing (px)', 'bhaiyyantop' ),
        'section'     => 'bhaiyyantop_typography_section',
        'type'        => 'number',
        'input_attrs' => array( 'min' => -2, 'max' => 5, 'step' => 0.5 ),
    ) );

    // =============================================================
    // 5. COLORS & THEME SYSTEM
    // =============================================================
    $wp_customize->add_section( 'bhaiyyantop_colors_section', array(
        'title'    => __( '5. Colors & Theme System', 'bhaiyyantop' ),
        'panel'    => 'bhaiyyantop_panel',
        'priority' => 50,
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

    // Text Color
    $wp_customize->add_setting( 'bhaiyyantop_text_color', array(
        'default'           => '#333333',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'bhaiyyantop_text_color', array(
        'label'    => __( 'Main Body Text Color', 'bhaiyyantop' ),
        'section'  => 'bhaiyyantop_colors_section',
    ) ) );

    // Heading Text Color
    $wp_customize->add_setting( 'bhaiyyantop_heading_color', array(
        'default'           => '#111111',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'bhaiyyantop_heading_color', array(
        'label'    => __( 'Heading Titles Text Color', 'bhaiyyantop' ),
        'section'  => 'bhaiyyantop_colors_section',
    ) ) );

    // =============================================================
    // 6. BUTTONS SECTION
    // =============================================================
    $wp_customize->add_section( 'bhaiyyantop_button_section', array(
        'title'    => __( '6. Button Styles', 'bhaiyyantop' ),
        'panel'    => 'bhaiyyantop_panel',
        'priority' => 60,
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

    // Secondary Button Color
    $wp_customize->add_setting( 'bhaiyyantop_secondary_button_bg', array(
        'default'           => '#00bcd4',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'bhaiyyantop_secondary_button_bg', array(
        'label'    => __( 'Secondary Button Background Color', 'bhaiyyantop' ),
        'section'  => 'bhaiyyantop_button_section',
    ) ) );

    // Button Radius
    $wp_customize->add_setting( 'bhaiyyantop_button_radius', array(
        'default'           => 4,
        'transport'         => 'postMessage',
        'sanitize_callback' => 'absint',
    ) );
    $wp_customize->add_control( 'bhaiyyantop_button_radius', array(
        'label'       => __( 'Button Border Radius (px)', 'bhaiyyantop' ),
        'section'     => 'bhaiyyantop_button_section',
        'type'        => 'number',
        'input_attrs' => array( 'min' => 0, 'max' => 30, 'step' => 1 ),
    ) );

    // Button Shadow
    $wp_customize->add_setting( 'bhaiyyantop_button_shadow', array(
        'default'           => '0 4px 10px rgba(0, 0, 0, 0.1)',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'bhaiyyantop_button_shadow', array(
        'label'    => __( 'Button Shadow (CSS box-shadow)', 'bhaiyyantop' ),
        'section'  => 'bhaiyyantop_button_section',
        'type'     => 'text',
    ) );

    // =============================================================
    // 7. CARDS & LAYOUT SECTION
    // =============================================================
    $wp_customize->add_section( 'bhaiyyantop_card_section', array(
        'title'    => __( '7. Cards & Layout', 'bhaiyyantop' ),
        'panel'    => 'bhaiyyantop_panel',
        'priority' => 70,
    ) );

    // Card Background Color
    $wp_customize->add_setting( 'bhaiyyantop_card_bg', array(
        'default'           => '#ffffff',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'bhaiyyantop_card_bg', array(
        'label'    => __( 'Card Background Color', 'bhaiyyantop' ),
        'section'  => 'bhaiyyantop_card_section',
    ) ) );

    // Container / Card Border Radius
    $wp_customize->add_setting( 'bhaiyyantop_container_radius', array(
        'default'           => 8,
        'transport'         => 'postMessage',
        'sanitize_callback' => 'absint',
    ) );
    $wp_customize->add_control( 'bhaiyyantop_container_radius', array(
        'label'       => __( 'Card & Box Border Radius (px)', 'bhaiyyantop' ),
        'section'     => 'bhaiyyantop_card_section',
        'type'        => 'number',
        'input_attrs' => array( 'min' => 0, 'max' => 30, 'step' => 1 ),
    ) );

    // Card Shadow
    $wp_customize->add_setting( 'bhaiyyantop_card_shadow', array(
        'default'           => '0 4px 15px rgba(0, 0, 0, 0.05)',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'bhaiyyantop_card_shadow', array(
        'label'    => __( 'Card Box Shadow', 'bhaiyyantop' ),
        'section'  => 'bhaiyyantop_card_section',
        'type'     => 'text',
    ) );

    // Card Spacing / Gap
    $wp_customize->add_setting( 'bhaiyyantop_card_spacing', array(
        'default'           => 20,
        'transport'         => 'postMessage',
        'sanitize_callback' => 'absint',
    ) );
    $wp_customize->add_control( 'bhaiyyantop_card_spacing', array(
        'label'       => __( 'Card Grid Gap & Spacing (px)', 'bhaiyyantop' ),
        'section'     => 'bhaiyyantop_card_section',
        'type'        => 'number',
        'input_attrs' => array( 'min' => 10, 'max' => 40, 'step' => 2 ),
    ) );

    // Main Container Width
    $wp_customize->add_setting( 'bhaiyyantop_container_width', array(
        'default'           => 1200,
        'transport'         => 'postMessage',
        'sanitize_callback' => 'absint',
    ) );
    $wp_customize->add_control( 'bhaiyyantop_container_width', array(
        'label'       => __( 'Container Maximum Width (px)', 'bhaiyyantop' ),
        'section'     => 'bhaiyyantop_card_section',
        'type'        => 'number',
        'input_attrs' => array( 'min' => 960, 'max' => 1600, 'step' => 20 ),
    ) );

    // =============================================================
    // 8. FOOTER SECTION
    // =============================================================
    $wp_customize->add_section( 'bhaiyyantop_footer_section', array(
        'title'    => __( '8. Footer Options', 'bhaiyyantop' ),
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

    // Enable Footer Quick Links
    $wp_customize->add_setting( 'bhaiyyantop_footer_quick_links_enable', array(
        'default'           => true,
        'transport'         => 'refresh',
        'sanitize_callback' => 'bhaiyyantop_sanitize_checkbox',
    ) );
    $wp_customize->add_control( 'bhaiyyantop_footer_quick_links_enable', array(
        'label'    => __( 'Show Footer Main Categories Links', 'bhaiyyantop' ),
        'section'  => 'bhaiyyantop_footer_section',
        'type'     => 'checkbox',
    ) );

    // Enable Footer Social Icons
    $wp_customize->add_setting( 'bhaiyyantop_footer_social_icons_enable', array(
        'default'           => true,
        'transport'         => 'refresh',
        'sanitize_callback' => 'bhaiyyantop_sanitize_checkbox',
    ) );
    $wp_customize->add_control( 'bhaiyyantop_footer_social_icons_enable', array(
        'label'    => __( 'Show Footer Social Icons', 'bhaiyyantop' ),
        'section'  => 'bhaiyyantop_footer_section',
        'type'     => 'checkbox',
    ) );

    // =============================================================
    // 9. SEARCH SECTION
    // =============================================================
    $wp_customize->add_section( 'bhaiyyantop_search_section', array(
        'title'    => __( '9. Search Settings', 'bhaiyyantop' ),
        'panel'    => 'bhaiyyantop_panel',
        'priority' => 90,
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
    // 10. BREAKING NEWS TICKER SECTION
    // =============================================================
    $wp_customize->add_section( 'bhaiyyantop_breaking_section', array(
        'title'    => __( '10. Breaking News Ticker', 'bhaiyyantop' ),
        'panel'    => 'bhaiyyantop_panel',
        'priority' => 100,
    ) );

    // Enable Breaking News Ticker
    $wp_customize->add_setting( 'bhaiyyantop_breaking_news_enable', array(
        'default'           => true,
        'transport'         => 'refresh',
        'sanitize_callback' => 'bhaiyyantop_sanitize_checkbox',
    ) );
    $wp_customize->add_control( 'bhaiyyantop_breaking_news_enable', array(
        'label'    => __( 'Enable Breaking News Ticker Bar', 'bhaiyyantop' ),
        'section'  => 'bhaiyyantop_breaking_section',
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
        'section'  => 'bhaiyyantop_breaking_section',
        'type'     => 'text',
    ) );

    // Ticker Bar Background Color
    $wp_customize->add_setting( 'bhaiyyantop_ticker_bg', array(
        'default'           => 'rgba(255, 235, 59, 0.15)',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'bhaiyyantop_ticker_bg', array(
        'label'    => __( 'Ticker Background Color / RGBA', 'bhaiyyantop' ),
        'section'  => 'bhaiyyantop_breaking_section',
        'type'     => 'text',
    ) );

    // Ticker Text Color
    $wp_customize->add_setting( 'bhaiyyantop_ticker_text_color', array(
        'default'           => '#111111',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'bhaiyyantop_ticker_text_color', array(
        'label'    => __( 'Ticker Text Link Color', 'bhaiyyantop' ),
        'section'  => 'bhaiyyantop_breaking_section',
    ) ) );

    // =============================================================
    // 11. ADS SECTION
    // =============================================================
    $wp_customize->add_section( 'bhaiyyantop_ads_section', array(
        'title'    => __( '11. Advertisement Slots', 'bhaiyyantop' ),
        'panel'    => 'bhaiyyantop_panel',
        'priority' => 110,
    ) );

    // Enable Header Ad Banner
    $wp_customize->add_setting( 'bhaiyyantop_enable_header_ad', array(
        'default'           => false,
        'transport'         => 'refresh',
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
        'transport'         => 'refresh',
        'sanitize_callback' => 'wp_kses_post',
    ) );
    $wp_customize->add_control( 'bhaiyyantop_header_ad_code', array(
        'label'       => __( 'Header Ad Embed Code / HTML', 'bhaiyyantop' ),
        'section'     => 'bhaiyyantop_ads_section',
        'type'        => 'textarea',
        'description' => __( 'Paste AdSense script or banner HTML code.', 'bhaiyyantop' ),
    ) );

    // =============================================================
    // 12. SOCIAL LINKS SECTION
    // =============================================================
    $wp_customize->add_section( 'bhaiyyantop_social_section', array(
        'title'    => __( '12. Social Media Links', 'bhaiyyantop' ),
        'panel'    => 'bhaiyyantop_panel',
        'priority' => 120,
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

    // Selective Refresh Support for live HTML text partial updates
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
        $wp_customize->selective_refresh->add_partial( 'bhaiyyantop_footer_about_title', array(
            'selector'        => '.footer-widget:first-child h4',
            'render_callback' => function() {
                return esc_html( get_theme_mod( 'bhaiyyantop_footer_about_title', __( 'हमारे बारे में', 'bhaiyyantop' ) ) );
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
    $primary_color          = get_theme_mod( 'bhaiyyantop_primary_color', '#e91e63' );
    $secondary_color        = get_theme_mod( 'bhaiyyantop_secondary_color', '#00bcd4' );
    $accent_color           = get_theme_mod( 'bhaiyyantop_accent_color', '#ffeb3b' );
    $body_bg_color          = get_theme_mod( 'bhaiyyantop_body_bg_color', '#f4f3ef' );
    $header_bg_color        = get_theme_mod( 'bhaiyyantop_header_bg_color', '#00bcd4' );
    $header_bg_img          = get_theme_mod( 'bhaiyyantop_header_bg_image', '' );
    $header_overlay_opacity = get_theme_mod( 'bhaiyyantop_header_overlay_opacity', '0.95' );
    $header_min_height      = get_theme_mod( 'bhaiyyantop_header_min_height', 120 );
    $logo_width             = get_theme_mod( 'bhaiyyantop_logo_width', 400 );
    $logo_height            = get_theme_mod( 'bhaiyyantop_logo_height', 112 );
    
    $nav_text_color         = get_theme_mod( 'bhaiyyantop_nav_text_color', '#ffffff' );
    $nav_hover_color        = get_theme_mod( 'bhaiyyantop_nav_hover_color', '#ffffff' );
    $nav_hover_bg           = get_theme_mod( 'bhaiyyantop_nav_hover_bg', '#e91e63' );
    $nav_dropdown_bg        = get_theme_mod( 'bhaiyyantop_nav_dropdown_bg', '#ffffff' );
    $mobile_menu_bg         = get_theme_mod( 'bhaiyyantop_mobile_menu_bg', '#ffffff' );
    $hamburger_color        = get_theme_mod( 'bhaiyyantop_hamburger_color', '#111111' );
    $nav_font_size          = get_theme_mod( 'bhaiyyantop_nav_font_size', 19 );
    
    $sticky_header_bg       = get_theme_mod( 'bhaiyyantop_sticky_header_bg', '#00bcd4' );
    $sticky_header_shadow   = get_theme_mod( 'bhaiyyantop_sticky_header_shadow', '0 4px 15px rgba(0, 0, 0, 0.12)' );
    $sticky_header_blur     = get_theme_mod( 'bhaiyyantop_sticky_header_blur', 10 );
    $sticky_nav_color       = get_theme_mod( 'bhaiyyantop_sticky_nav_color', '#ffffff' );
    
    $heading_font           = get_theme_mod( 'bhaiyyantop_heading_font', 'Noto Sans Devanagari' );
    $body_font              = get_theme_mod( 'bhaiyyantop_body_font', 'Noto Sans Devanagari' );
    $base_font_size         = get_theme_mod( 'bhaiyyantop_base_font_size', 16 );
    $line_height            = get_theme_mod( 'bhaiyyantop_line_height', '1.6' );
    $letter_spacing         = get_theme_mod( 'bhaiyyantop_letter_spacing', '0' );

    $text_color             = get_theme_mod( 'bhaiyyantop_text_color', '#333333' );
    $heading_color          = get_theme_mod( 'bhaiyyantop_heading_color', '#111111' );
    
    $button_bg              = get_theme_mod( 'bhaiyyantop_button_bg', '#e91e63' );
    $button_hover           = get_theme_mod( 'bhaiyyantop_button_hover', '#c2185b' );
    $sec_button_bg          = get_theme_mod( 'bhaiyyantop_secondary_button_bg', '#00bcd4' );
    $button_radius          = get_theme_mod( 'bhaiyyantop_button_radius', 4 );
    $button_shadow          = get_theme_mod( 'bhaiyyantop_button_shadow', '0 4px 10px rgba(0, 0, 0, 0.1)' );
    
    $card_bg                = get_theme_mod( 'bhaiyyantop_card_bg', '#ffffff' );
    $container_radius       = get_theme_mod( 'bhaiyyantop_container_radius', 8 );
    $card_shadow            = get_theme_mod( 'bhaiyyantop_card_shadow', '0 4px 15px rgba(0, 0, 0, 0.05)' );
    $card_spacing           = get_theme_mod( 'bhaiyyantop_card_spacing', 20 );
    $container_width        = get_theme_mod( 'bhaiyyantop_container_width', 1200 );
    
    $footer_bg_color        = get_theme_mod( 'bhaiyyantop_footer_bg_color', '#121216' );
    $footer_text_color      = get_theme_mod( 'bhaiyyantop_footer_text_color', '#a0a0a0' );
    
    $ticker_bg              = get_theme_mod( 'bhaiyyantop_ticker_bg', 'rgba(255, 235, 59, 0.15)' );
    $ticker_text_color      = get_theme_mod( 'bhaiyyantop_ticker_text_color', '#111111' );

    $custom_css = "
        :root {
            --primary-color: " . esc_attr( $primary_color ) . ";
            --secondary-color: " . esc_attr( $secondary_color ) . ";
            --accent-yellow: " . esc_attr( $accent_color ) . ";
            --bg-color: " . esc_attr( $body_bg_color ) . ";
            --header-bg: " . esc_attr( $header_bg_color ) . ";
            --header-min-height: " . esc_attr( $header_min_height ) . "px;
            --logo-max-width: " . esc_attr( $logo_width ) . "px;
            --logo-max-height: " . esc_attr( $logo_height ) . "px;
            --nav-text: " . esc_attr( $nav_text_color ) . ";
            --nav-hover: " . esc_attr( $nav_hover_color ) . ";
            --nav-hover-bg: " . esc_attr( $nav_hover_bg ) . ";
            --nav-dropdown-bg: " . esc_attr( $nav_dropdown_bg ) . ";
            --mobile-menu-bg: " . esc_attr( $mobile_menu_bg ) . ";
            --hamburger-color: " . esc_attr( $hamburger_color ) . ";
            --nav-font-size: " . esc_attr( $nav_font_size ) . "px;
            --sticky-nav-bg: " . esc_attr( $sticky_header_bg ) . ";
            --sticky-nav-shadow: " . esc_attr( $sticky_header_shadow ) . ";
            --sticky-nav-blur: " . esc_attr( $sticky_header_blur ) . "px;
            --sticky-nav-color: " . esc_attr( $sticky_nav_color ) . ";
            --heading-font: '" . esc_attr( $heading_font ) . "', sans-serif;
            --body-font: '" . esc_attr( $body_font ) . "', sans-serif;
            --base-font-size: " . esc_attr( $base_font_size ) . "px;
            --line-height: " . esc_attr( $line_height ) . ";
            --letter-spacing: " . esc_attr( $letter_spacing ) . "px;
            --dark-color: " . esc_attr( $heading_color ) . ";
            --text-color: " . esc_attr( $text_color ) . ";
            --button-bg: " . esc_attr( $button_bg ) . ";
            --button-hover: " . esc_attr( $button_hover ) . ";
            --secondary-button-bg: " . esc_attr( $sec_button_bg ) . ";
            --button-radius: " . esc_attr( $button_radius ) . "px;
            --button-shadow: " . esc_attr( $button_shadow ) . ";
            --card-bg: " . esc_attr( $card_bg ) . ";
            --card-border-radius: " . esc_attr( $container_radius ) . "px;
            --card-shadow: " . esc_attr( $card_shadow ) . ";
            --card-spacing: " . esc_attr( $card_spacing ) . "px;
            --container-width: " . esc_attr( $container_width ) . "px;
            --footer-bg: " . esc_attr( $footer_bg_color ) . ";
            --footer-text: " . esc_attr( $footer_text_color ) . ";
            --ticker-bg: " . esc_attr( $ticker_bg ) . ";
            --ticker-text-color: " . esc_attr( $ticker_text_color ) . ";
        }

        body {
            font-family: var(--body-font);
            font-size: var(--base-font-size);
            line-height: var(--line-height);
            letter-spacing: var(--letter-spacing);
            background-color: var(--bg-color);
            color: var(--text-color);
        }

        h1, h2, h3, h4, h5, h6, .site-header, .section-title {
            font-family: var(--heading-font);
            color: var(--dark-color);
        }

        .site-header {
            min-height: var(--header-min-height);
            background-color: var(--header-bg);
            " . ( ! empty( $header_bg_img ) ? "background-image: linear-gradient(to bottom, rgba(0, 188, 212, " . esc_attr( $header_overlay_opacity ) . ") 0%, rgba(0, 188, 212, " . esc_attr( $header_overlay_opacity ) . ") 100%), url('" . esc_url( $header_bg_img ) . "'); background-size: cover; background-position: center;" : "" ) . "
        }

        .custom-logo {
            max-width: var(--logo-max-width);
            max-height: var(--logo-max-height);
        }

        .header-menu > li > a {
            color: var(--nav-text);
            font-size: var(--nav-font-size);
        }

        .header-menu > li > a:hover,
        .header-menu > li.current-menu-item > a {
            color: var(--nav-hover);
            background-color: var(--nav-hover-bg);
        }

        @media (min-width: 1281px) {
            .site-header .header-nav > .nav-menu-wrapper {
                background: transparent;
            }
            .header-menu .sub-menu,
            .header-menu .dropdown-menu {
                background-color: var(--nav-dropdown-bg);
            }
        }

        @media (max-width: 1280px) {
            .site-header .header-nav > .nav-menu-wrapper {
                background-color: var(--mobile-menu-bg);
            }
        }

        .hamburger-bar {
            background-color: var(--hamburger-color);
        }

        .bhaiyyantop-sticky-navbar {
            background-color: var(--sticky-nav-bg);
            box-shadow: var(--sticky-nav-shadow);
            backdrop-filter: blur(var(--sticky-nav-blur));
        }

        .sticky-header-menu > li > a {
            color: var(--sticky-nav-color);
        }

        .btn-primary, .social-btn.facebook, .social-btn.youtube, .social-btn.instagram {
            border-radius: var(--button-radius);
            box-shadow: var(--button-shadow);
        }

        .container {
            max-width: var(--container-width);
        }

        .site-footer {
            background-color: var(--footer-bg);
            color: var(--footer-text);
        }

        .ticker-container-wrap {
            background: var(--ticker-bg);
        }

        .ticker-list a {
            color: var(--ticker-text-color);
        }
    ";

    wp_add_inline_style( 'bhaiyyantop-style', $custom_css );
}
add_action( 'wp_enqueue_scripts', 'bhaiyyantop_customizer_css', 20 );

/**
 * Enqueue Customizer Live Preview JS script
 */
function bhaiyyantop_customize_preview_js() {
    wp_enqueue_script(
        'bhaiyyantop-customizer-preview',
        get_template_directory_uri() . '/assets/js/customizer-preview.js',
        array( 'customize-preview', 'jquery' ),
        '1.0.0',
        true
    );
}
add_action( 'customize_preview_init', 'bhaiyyantop_customize_preview_js' );
