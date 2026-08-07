<?php
/**
 * Card Template Part: Middle Wide Featured Card
 * Implements Stretched Link pattern for whole-card clickability.
 *
 * @package Bhaiyyantop
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

$mid_item = isset( $args['item'] ) ? $args['item'] : null;

if ( $mid_item ) {
    $permalink   = isset( $mid_item['permalink'] ) ? $mid_item['permalink'] : get_permalink( $mid_item['id'] );
    $title       = isset( $mid_item['title'] ) ? $mid_item['title'] : get_the_title( $mid_item['id'] );
    $thumbnail   = isset( $mid_item['thumbnail'] ) ? $mid_item['thumbnail'] : get_the_post_thumbnail_url( $mid_item['id'], 'bhaiyyantop-medium' );
    $category    = isset( $mid_item['category'] ) ? $mid_item['category'] : 'समाचार';
    $cat_url     = isset( $mid_item['cat_url'] ) ? $mid_item['cat_url'] : '#';
    $author_name = isset( $mid_item['author'] ) ? $mid_item['author'] : get_the_author();
    $date        = isset( $mid_item['date'] ) ? $mid_item['date'] : get_the_date( 'j F, Y' );
} else {
    $post_id     = get_the_ID();
    $permalink   = get_permalink( $post_id );
    $title       = get_the_title( $post_id );
    $thumbnail   = get_the_post_thumbnail_url( $post_id, 'bhaiyyantop-medium' );
    $categories  = get_the_category( $post_id );
    $category    = ! empty( $categories ) ? $categories[0]->name : 'समाचार';
    $cat_url     = ! empty( $categories ) ? get_category_link( $categories[0]->term_id ) : '#';
    $author_name = get_the_author();
    $date        = get_the_date( 'j F, Y' );
}
?>

<div class="mid-featured-story whole-card-link">
    <div class="mid-card-inner">
        <div class="mid-card-content">
            <a href="<?php echo esc_url( $cat_url ); ?>" class="cat-badge teal"><?php echo esc_html( $category ); ?></a>
            <h3 class="mid-card-title">
                <a href="<?php echo esc_url( $permalink ); ?>" class="stretched-link"><?php echo esc_html( $title ); ?></a>
            </h3>
            <div class="post-meta">by <span><?php echo esc_html( $author_name ); ?></span> &bull; <?php echo esc_html( $date ); ?></div>
        </div>
        <div class="mid-card-image">
            <img src="<?php echo esc_url( $thumbnail ); ?>" alt="<?php echo esc_attr( $title ); ?>">
        </div>
    </div>
</div>
