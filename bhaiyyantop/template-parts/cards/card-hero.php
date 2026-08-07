<?php
/**
 * Card Template Part: Hero Slider Card
 * Implements Stretched Link pattern for whole-card clickability.
 *
 * @package Bhaiyyantop
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

$hero_item = isset( $args['item'] ) ? $args['item'] : null;

if ( $hero_item ) {
    $permalink   = isset( $hero_item['permalink'] ) ? $hero_item['permalink'] : get_permalink( $hero_item['id'] );
    $title       = isset( $hero_item['title'] ) ? $hero_item['title'] : get_the_title( $hero_item['id'] );
    $thumbnail   = isset( $hero_item['thumbnail'] ) ? $hero_item['thumbnail'] : get_the_post_thumbnail_url( $hero_item['id'], 'bhaiyyantop-hero' );
    $category    = isset( $hero_item['category'] ) ? $hero_item['category'] : 'समाचार';
    $cat_url     = isset( $hero_item['cat_url'] ) ? $hero_item['cat_url'] : '#';
    $author_name = isset( $hero_item['author'] ) ? $hero_item['author'] : get_the_author();
    $date        = isset( $hero_item['date'] ) ? $hero_item['date'] : get_the_date( 'j F, Y' );
    $excerpt     = isset( $hero_item['excerpt'] ) ? $hero_item['excerpt'] : '';
} else {
    $post_id     = get_the_ID();
    $permalink   = get_permalink( $post_id );
    $title       = get_the_title( $post_id );
    $thumbnail   = get_the_post_thumbnail_url( $post_id, 'bhaiyyantop-hero' );
    $categories  = get_the_category( $post_id );
    $category    = ! empty( $categories ) ? $categories[0]->name : 'समाचार';
    $cat_url     = ! empty( $categories ) ? get_category_link( $categories[0]->term_id ) : '#';
    $author_name = get_the_author();
    $date        = get_the_date( 'j F, Y' );
    $excerpt     = get_the_excerpt( $post_id );
}
?>

<div class="hero-slide active whole-card-link">
    <img src="<?php echo esc_url( $thumbnail ); ?>" alt="<?php echo esc_attr( $title ); ?>">
    <div class="hero-overlay">
        <a href="<?php echo esc_url( $cat_url ); ?>" class="cat-badge pink"><?php echo esc_html( $category ); ?></a>
        <h2 class="hero-title">
            <a href="<?php echo esc_url( $permalink ); ?>" class="stretched-link"><?php echo esc_html( $title ); ?></a>
        </h2>
        <?php if ( ! empty( $excerpt ) ) : ?>
            <p class="hero-excerpt"><?php echo esc_html( $excerpt ); ?></p>
        <?php endif; ?>
        <div class="post-meta">
            by <span><?php echo esc_html( $author_name ); ?></span> &bull; <?php echo esc_html( $date ); ?>
        </div>
    </div>
</div>
