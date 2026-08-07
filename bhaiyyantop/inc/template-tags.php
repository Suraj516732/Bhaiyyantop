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
