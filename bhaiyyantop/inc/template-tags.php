<?php
/**
 * Custom template tags for Bhaiyyantop
 *
 * @package Bhaiyyantop
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

if ( ! function_exists( 'bhaiyyantop_posted_on' ) ) :
    /**
     * Prints HTML with meta information for the current post-date/time.
     */
    function bhaiyyantop_posted_on() {
        $time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
        if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
            $time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time> <span class="updated-date">(अपडेटेड: <time class="updated" datetime="%3$s">%4$s</time>)</span>';
        }

        $time_string = sprintf(
            $time_string,
            esc_attr( get_the_date( DATE_W3C ) ),
            esc_html( get_the_date( 'j F, Y' ) ),
            esc_attr( get_the_modified_date( DATE_W3C ) ),
            esc_html( get_the_modified_date( 'j F, Y' ) )
        );

        echo '<span class="posted-on"><i class="fa fa-calendar-alt"></i> ' . $time_string . '</span>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
    }
endif;

if ( ! function_exists( 'bhaiyyantop_posted_by' ) ) :
    /**
     * Prints HTML with meta information for the current author.
     */
    function bhaiyyantop_posted_by() {
        $byline = sprintf(
            /* translators: %s: post author. */
            esc_html_x( 'by %s', 'post author', 'bhaiyyantop' ),
            '<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
        );

        echo '<span class="byline"> ' . $byline . '</span>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
    }
endif;

if ( ! function_exists( 'bhaiyyantop_reading_time' ) ) :
    /**
     * Calculates estimated reading time for post content.
     */
    function bhaiyyantop_reading_time() {
        $content = get_post_field( 'post_content', get_the_ID() );
        $word_count = str_word_count( strip_tags( $content ) );
        if ( empty( $word_count ) ) {
            // Support for Devanagari / multibyte word counting
            $clean_text = preg_replace( '/\s+/', ' ', strip_tags( $content ) );
            $word_count = count( explode( ' ', $clean_text ) );
        }
        $reading_time = ceil( $word_count / 200 );
        if ( $reading_time < 1 ) {
            $reading_time = 1;
        }

        return sprintf( esc_html__( '%d मिनट पठन', 'bhaiyyantop' ), $reading_time );
    }
endif;

if ( ! function_exists( 'bhaiyyantop_post_views' ) ) :
    /**
     * Track and display post view count.
     */
    function bhaiyyantop_post_views( $post_id = 0 ) {
        if ( ! $post_id ) {
            $post_id = get_the_ID();
        }
        $count_key = 'bhaiyyantop_post_views_count';
        $count     = get_post_meta( $post_id, $count_key, true );

        if ( $count === '' ) {
            $count = 0;
            delete_post_meta( $post_id, $count_key );
            add_post_meta( $post_id, $count_key, '0' );
        }

        return number_format_i18n( (int) $count );
    }
endif;

/**
 * Increment view count on single post load
 */
function bhaiyyantop_set_post_views( $post_id ) {
    $count_key = 'bhaiyyantop_post_views_count';
    $count     = get_post_meta( $post_id, $count_key, true );

    if ( $count === '' ) {
        $count = 0;
        delete_post_meta( $post_id, $count_key );
        add_post_meta( $post_id, $count_key, '1' );
    } else {
        $count++;
        update_post_meta( $post_id, $count_key, $count );
    }
}

if ( ! function_exists( 'bhaiyyantop_get_card_data' ) ) :
    /**
     * Helper to normalize and extract post data for Card Components.
     *
     * @param array $args Component arguments passed to get_template_part.
     * @return array Normalized post data.
     */
    function bhaiyyantop_get_card_data( $args = array() ) {
        $item = isset( $args['item'] ) ? $args['item'] : null;

        if ( $item && is_array( $item ) ) {
            $id          = isset( $item['id'] ) ? $item['id'] : 0;
            $permalink   = isset( $item['permalink'] ) ? $item['permalink'] : ( $id ? get_permalink( $id ) : '#' );
            $title       = isset( $item['title'] ) ? $item['title'] : ( $id ? get_the_title( $id ) : '' );
            $thumbnail   = isset( $item['thumbnail'] ) ? $item['thumbnail'] : ( $id ? get_the_post_thumbnail_url( $id, 'large' ) : '' );
            $category    = isset( $item['category'] ) ? $item['category'] : 'समाचार';
            $cat_url     = isset( $item['cat_url'] ) && '#' !== $item['cat_url'] ? $item['cat_url'] : home_url( '/' );
            $author_name = isset( $item['author'] ) ? $item['author'] : ( $id ? get_the_author_meta( 'display_name', get_post_field( 'post_author', $id ) ) : 'संपादक' );
            $date        = isset( $item['date'] ) ? $item['date'] : ( $id ? get_the_date( 'j F, Y', $id ) : date( 'j F, Y' ) );
            $excerpt     = isset( $item['excerpt'] ) ? $item['excerpt'] : ( $id ? get_the_excerpt( $id ) : '' );
        } else {
            $id          = get_the_ID();
            $permalink   = get_permalink( $id );
            $title       = get_the_title( $id );
            $thumbnail   = get_the_post_thumbnail_url( $id, 'large' );
            $categories  = get_the_category( $id );
            $category    = ! empty( $categories ) ? $categories[0]->name : 'समाचार';
            $cat_url     = ! empty( $categories ) ? get_category_link( $categories[0]->term_id ) : home_url( '/' );
            $author_name = get_the_author();
            $date        = get_the_date( 'j F, Y' );
            $excerpt     = get_the_excerpt( $id );
        }

        if ( empty( $thumbnail ) ) {
            $thumbnail = get_template_directory_uri() . '/assets/images/hero.png';
        }

        return array(
            'id'          => $id,
            'permalink'   => $permalink,
            'title'       => $title,
            'thumbnail'   => $thumbnail,
            'category'    => $category,
            'cat_url'     => $cat_url,
            'author'      => $author_name,
            'date'        => $date,
            'excerpt'     => $excerpt,
        );
    }
endif;
