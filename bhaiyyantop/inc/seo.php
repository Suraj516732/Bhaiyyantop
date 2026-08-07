<?php
/**
 * Advanced SEO, OpenGraph, Twitter Cards, Canonical URLs & Schema.org JSON-LD Integration
 *
 * @package Bhaiyyantop
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

/**
 * Output Canonical URL, Meta Description, OpenGraph, and Twitter Cards in wp_head
 */
function bhaiyyantop_seo_meta_tags() {
    $site_name   = get_bloginfo( 'name' );
    $site_desc   = get_bloginfo( 'description' );
    $permalink   = home_url( '/' );
    $title       = $site_name;
    $description = $site_desc;
    $og_type     = 'website';
    $og_image    = get_template_directory_uri() . '/assets/images/logo.png';

    if ( is_single() || is_page() ) {
        $post_id     = get_the_ID();
        $permalink   = get_permalink( $post_id );
        $title       = get_the_title( $post_id ) . ' - ' . $site_name;
        $excerpt     = get_the_excerpt( $post_id );
        $description = ! empty( $excerpt ) ? wp_strip_all_tags( $excerpt ) : $site_desc;
        $og_type     = is_single() ? 'article' : 'website';
        
        if ( has_post_thumbnail( $post_id ) ) {
            $thumb_url = get_the_post_thumbnail_url( $post_id, 'large' );
            if ( $thumb_url ) {
                $og_image = $thumb_url;
            }
        }
    } elseif ( is_category() || is_tag() || is_archive() ) {
        $permalink   = get_category_link( get_queried_object_id() );
        $title       = single_term_title( '', false ) . ' - ' . $site_name;
        $term_desc   = term_description();
        $description = ! empty( $term_desc ) ? wp_strip_all_tags( $term_desc ) : sprintf( __( '%s पर ताज़ा समाचार और मुख्य ख़बरें।', 'bhaiyyantop' ), single_term_title( '', false ) );
    }

    // Canonical Tag
    echo '<link rel="canonical" href="' . esc_url( $permalink ) . '" />' . "\n";
    echo '<meta name="description" content="' . esc_attr( $description ) . '" />' . "\n";

    // OpenGraph Tags
    echo '<meta property="og:site_name" content="' . esc_attr( $site_name ) . '" />' . "\n";
    echo '<meta property="og:title" content="' . esc_attr( $title ) . '" />' . "\n";
    echo '<meta property="og:description" content="' . esc_attr( $description ) . '" />' . "\n";
    echo '<meta property="og:type" content="' . esc_attr( $og_type ) . '" />' . "\n";
    echo '<meta property="og:url" content="' . esc_url( $permalink ) . '" />' . "\n";
    echo '<meta property="og:image" content="' . esc_url( $og_image ) . '" />' . "\n";
    echo '<meta property="og:locale" content="hi_IN" />' . "\n";

    // Twitter Card Tags
    echo '<meta name="twitter:card" content="summary_large_image" />' . "\n";
    echo '<meta name="twitter:title" content="' . esc_attr( $title ) . '" />' . "\n";
    echo '<meta name="twitter:description" content="' . esc_attr( $description ) . '" />' . "\n";
    echo '<meta name="twitter:image" content="' . esc_url( $og_image ) . '" />' . "\n";
}
add_action( 'wp_head', 'bhaiyyantop_seo_meta_tags', 1 );

/**
 * Output JSON-LD Schema.org Structured Data in wp_head
 */
function bhaiyyantop_schema_structured_data() {
    $site_name = get_bloginfo( 'name' );
    $site_url  = home_url( '/' );
    $logo_url  = get_template_directory_uri() . '/assets/images/logo.png';

    if ( has_custom_logo() ) {
        $custom_logo_id = get_theme_mod( 'custom_logo' );
        $logo_src       = wp_get_attachment_image_src( $custom_logo_id, 'full' );
        if ( $logo_src ) {
            $logo_url = $logo_src[0];
        }
    }

    // 1. Organization & WebSite Schema
    $website_schema = array(
        '@context'        => 'https://schema.org',
        '@type'           => 'NewsMediaOrganization',
        'name'            => $site_name,
        'url'             => $site_url,
        'logo'            => array(
            '@type' => 'ImageObject',
            'url'   => $logo_url,
        ),
        'sameAs'          => array_filter( array(
            get_theme_mod( 'bhaiyyantop_social_facebook', '' ),
            get_theme_mod( 'bhaiyyantop_social_twitter', '' ),
            get_theme_mod( 'bhaiyyantop_social_instagram', '' ),
            get_theme_mod( 'bhaiyyantop_social_youtube', '' ),
        ) ),
    );

    echo '<script type="application/ld+json">' . wp_json_encode( $website_schema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE ) . '</script>' . "\n";

    // 2. Single Article NewsArticle Schema
    if ( is_single() ) {
        $post_id   = get_the_ID();
        $author_id = get_post_field( 'post_author', $post_id );
        $thumb_url = has_post_thumbnail( $post_id ) ? get_the_post_thumbnail_url( $post_id, 'full' ) : $logo_url;

        $article_schema = array(
            '@context'         => 'https://schema.org',
            '@type'            => 'NewsArticle',
            'mainEntityOfPage' => array(
                '@type' => 'WebPage',
                '@id'   => get_permalink( $post_id ),
            ),
            'headline'         => get_the_title( $post_id ),
            'image'            => array( $thumb_url ),
            'datePublished'    => get_the_date( 'c', $post_id ),
            'dateModified'     => get_the_modified_date( 'c', $post_id ),
            'author'           => array(
                '@type' => 'Person',
                'name'  => get_the_author_meta( 'display_name', $author_id ),
                'url'   => get_author_posts_url( $author_id ),
            ),
            'publisher'        => array(
                '@type' => 'Organization',
                'name'  => $site_name,
                'logo'  => array(
                    '@type' => 'ImageObject',
                    'url'   => $logo_url,
                ),
            ),
            'description'      => wp_strip_all_tags( get_the_excerpt( $post_id ) ),
        );

        echo '<script type="application/ld+json">' . wp_json_encode( $article_schema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE ) . '</script>' . "\n";
    }

    // 3. BreadcrumbList Schema
    if ( ! is_front_page() && ! is_home() ) {
        $breadcrumb_list = array(
            '@context'        => 'https://schema.org',
            '@type'           => 'BreadcrumbList',
            'itemListElement' => array(
                array(
                    '@type'    => 'ListItem',
                    'position' => 1,
                    'name'     => __( 'होम', 'bhaiyyantop' ),
                    'item'     => $site_url,
                ),
            ),
        );

        if ( is_single() ) {
            $categories = get_the_category();
            if ( ! empty( $categories ) ) {
                $breadcrumb_list['itemListElement'][] = array(
                    '@type'    => 'ListItem',
                    'position' => 2,
                    'name'     => $categories[0]->name,
                    'item'     => get_category_link( $categories[0]->term_id ),
                );
                $breadcrumb_list['itemListElement'][] = array(
                    '@type'    => 'ListItem',
                    'position' => 3,
                    'name'     => get_the_title(),
                    'item'     => get_permalink(),
                );
            }
        } elseif ( is_category() ) {
            $breadcrumb_list['itemListElement'][] = array(
                '@type'    => 'ListItem',
                'position' => 2,
                'name'     => single_cat_title( '', false ),
                'item'     => get_category_link( get_queried_object_id() ),
            );
        }

        echo '<script type="application/ld+json">' . wp_json_encode( $breadcrumb_list, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE ) . '</script>' . "\n";
    }
}
add_action( 'wp_head', 'bhaiyyantop_schema_structured_data', 2 );
