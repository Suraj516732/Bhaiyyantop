<?php
/**
 * Breadcrumb Trail Generator for Bhaiyyantop
 * Supports Schema.org microdata for SEO rich snippets.
 *
 * @package Bhaiyyantop
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

if ( ! function_exists( 'bhaiyyantop_breadcrumbs' ) ) :
    function bhaiyyantop_breadcrumbs() {
        if ( is_front_page() ) {
            return;
        }

        echo '<nav class="bhaiyyantop-breadcrumbs" aria-label="Breadcrumbs">';
        echo '<ol itemscope itemtype="https://schema.org/BreadcrumbList">';

        // Home Link
        echo '<li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">';
        echo '<a itemprop="item" href="' . esc_url( home_url( '/' ) ) . '"><i class="fa fa-home"></i> <span itemprop="name">' . esc_html__( 'होम', 'bhaiyyantop' ) . '</span></a>';
        echo '<meta itemprop="position" content="1" />';
        echo '</li>';
        echo '<li class="separator"><i class="fa fa-chevron-right"></i></li>';

        $position = 2;

        if ( is_single() ) {
            $categories = get_the_category();
            if ( ! empty( $categories ) ) {
                $category = $categories[0];
                echo '<li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">';
                echo '<a itemprop="item" href="' . esc_url( get_category_link( $category->term_id ) ) . '"><span itemprop="name">' . esc_html( $category->name ) . '</span></a>';
                echo '<meta itemprop="position" content="' . $position . '" />';
                echo '</li>';
                echo '<li class="separator"><i class="fa fa-chevron-right"></i></li>';
                $position++;
            }
            echo '<li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem" class="active">';
            echo '<span itemprop="name">' . esc_html( get_the_title() ) . '</span>';
            echo '<meta itemprop="position" content="' . $position . '" />';
            echo '</li>';
        } elseif ( is_category() ) {
            echo '<li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem" class="active">';
            echo '<span itemprop="name">' . single_cat_title( '', false ) . '</span>';
            echo '<meta itemprop="position" content="' . $position . '" />';
            echo '</li>';
        } elseif ( is_page() ) {
            echo '<li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem" class="active">';
            echo '<span itemprop="name">' . esc_html( get_the_title() ) . '</span>';
            echo '<meta itemprop="position" content="' . $position . '" />';
            echo '</li>';
        }

        echo '</ol>';
        echo '</nav>';
    }
endif;
