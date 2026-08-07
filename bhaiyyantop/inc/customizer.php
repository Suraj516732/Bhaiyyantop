<?php
/**
 * Bhaiyyantop Theme Customizer Integration
 *
 * @package Bhaiyyantop
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

/**
 * Register Theme Customizer settings and controls.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function bhaiyyantop_customize_register( $wp_customize ) {

    // -------------------------------------------------------------
    // Main Panel: Bhaiyyantop Options
    // -------------------------------------------------------------
    $wp_customize->add_panel( 'bhaiyyantop_panel', array(
        'priority'       => 10,
        'capability'     => 'edit_theme_options',
        'theme_supports' => '',
        'title'          => __( 'Bhaiyyantop Theme Options', 'bhaiyyantop' ),
        'description'    => __( 'Customize header, colors, typography, ads, social links, and footer.', 'bhaiyyantop' ),
    ) );

    // -------------------------------------------------------------
    // Section 1: Header & Notice
    // -------------------------------------------------------------
    $wp_customize->add_section( 'bhaiyyantop_header_section', array(
        'title'    => __( 'Header & Ticker Settings', 'bhaiyyantop' ),
        'panel'    => 'bhaiyyantop_panel',
        'priority' => 10,
    ) );

    // Top Notice Bar Text
    $wp_customize->add_setting( 'bhaiyyantop_header_notice', array(
        'default'           => __( 'ट्रेंडिंग समाचार और ताज़ा अपडेट्स', 'bhaiyyantop' ),
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    ) );
    $wp_customize->add_control( 'bhaiyyantop_header_notice', array(
        'label'    => __( 'Header Top Notice Text', 'bhaiyyantop' ),
        'section'  => 'bhaiyyantop_header_section',
        'type'     => 'text',
    ) );

    // Show/Hide Breaking Ticker
    $wp_customize->add_setting( 'bhaiyyantop_show_ticker', array(
        'default'           => true,
        'sanitize_callback' => 'bhaiyyantop_sanitize_checkbox',
    ) );
    $wp_customize->add_control( 'bhaiyyantop_show_ticker', array(
        'label'    => __( 'Show Breaking News Ticker', 'bhaiyyantop' ),
        'section'  => 'bhaiyyantop_header_section',
        'type'     => 'checkbox',
    ) );

    // -------------------------------------------------------------
    // Section 2: Colors & Theme Mode
    // -------------------------------------------------------------
    $wp_customize->add_section( 'bhaiyyantop_colors_section', array(
        'title'    => __( 'Colors & Theme Style', 'bhaiyyantop' ),
        'panel'    => 'bhaiyyantop_panel',
        'priority' => 20,
    ) );

    // Primary Accent Color
    $wp_customize->add_setting( 'bhaiyyantop_primary_color', array(
        'default'           => '#e91e63',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'bhaiyyantop_primary_color', array(
        'label'    => __( 'Primary Accent Color (Pink/Red)', 'bhaiyyantop' ),
        'section'  => 'bhaiyyantop_colors_section',
    ) ) );

    // Secondary Accent Color
    $wp_customize->add_setting( 'bhaiyyantop_secondary_color', array(
        'default'           => '#00bcd4',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'bhaiyyantop_secondary_color', array(
        'label'    => __( 'Secondary Accent Color (Teal)', 'bhaiyyantop' ),
        'section'  => 'bhaiyyantop_colors_section',
    ) ) );

    // -------------------------------------------------------------
    // Section 3: Advertisements
    // -------------------------------------------------------------
    $wp_customize->add_section( 'bhaiyyantop_ads_section', array(
        'title'    => __( 'Advertisement Banners', 'bhaiyyantop' ),
        'panel'    => 'bhaiyyantop_panel',
        'priority' => 30,
    ) );

    // Header Ad Image URL
    $wp_customize->add_setting( 'bhaiyyantop_header_ad_image', array(
        'default'           => '',
        'sanitize_callback' => 'esc_url_raw',
    ) );
    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'bhaiyyantop_header_ad_image', array(
        'label'    => __( 'Header Top Banner Ad Image (728x90)', 'bhaiyyantop' ),
        'section'  => 'bhaiyyantop_ads_section',
    ) ) );

    // Header Ad Link
    $wp_customize->add_setting( 'bhaiyyantop_header_ad_link', array(
        'default'           => '#',
        'sanitize_callback' => 'esc_url_raw',
    ) );
    $wp_customize->add_control( 'bhaiyyantop_header_ad_link', array(
        'label'    => __( 'Header Ad Destination Link', 'bhaiyyantop' ),
        'section'  => 'bhaiyyantop_ads_section',
        'type'     => 'url',
    ) );

    // -------------------------------------------------------------
    // Section 4: Social Media Links
    # -------------------------------------------------------------
    $wp_customize->add_section( 'bhaiyyantop_social_section', array(
        'title'    => __( 'Social Media Links', 'bhaiyyantop' ),
        'panel'    => 'bhaiyyantop_panel',
        'priority' => 40,
    ) );

    $social_networks = array(
        'facebook'  => __( 'Facebook URL', 'bhaiyyantop' ),
        'twitter'   => __( 'Twitter / X URL', 'bhaiyyantop' ),
        'instagram' => __( 'Instagram URL', 'bhaiyyantop' ),
        'youtube'   => __( 'YouTube URL', 'bhaiyyantop' ),
        'telegram'  => __( 'Telegram URL', 'bhaiyyantop' ),
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
    // Section 5: Footer Options
    // -------------------------------------------------------------
    $wp_customize->add_section( 'bhaiyyantop_footer_section', array(
        'title'    => __( 'Footer Options', 'bhaiyyantop' ),
        'panel'    => 'bhaiyyantop_panel',
        'priority' => 50,
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

    $custom_css = '';
    if ( '#e91e63' !== $primary_color || '#00bcd4' !== $secondary_color ) {
        $custom_css = "
            :root {
                --primary-color: " . esc_attr( $primary_color ) . ";
                --secondary-color: " . esc_attr( $secondary_color ) . ";
            }
        ";
    }

    if ( ! empty( $custom_css ) ) {
        wp_add_inline_style( 'bhaiyyantop-style', $custom_css );
    }
}
add_action( 'wp_enqueue_scripts', 'bhaiyyantop_customizer_css', 20 );
