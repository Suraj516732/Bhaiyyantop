<?php
/**
 * Card Template Part: Mini Featured News Card
 * Implements Stretched Link pattern for whole-card clickability.
 *
 * @package Bhaiyyantop
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

// Accepts post array or WP_Post object passed via args or global post
$post_item = isset( $args['item'] ) ? $args['item'] : null;

if ( $post_item ) {
    $permalink   = isset( $post_item['permalink'] ) ? $post_item['permalink'] : get_permalink( $post_item['id'] );
    $title       = isset( $post_item['title'] ) ? $post_item['title'] : get_the_title( $post_item['id'] );
    $thumbnail   = isset( $post_item['thumbnail'] ) ? $post_item['thumbnail'] : get_the_post_thumbnail_url( $post_item['id'], 'bhaiyyantop-thumb' );
    $author_name = isset( $post_item['author'] ) ? $post_item['author'] : get_the_author();
    $date        = isset( $post_item['date'] ) ? $post_item['date'] : get_the_date( 'j F, Y' );
    $author_url  = isset( $post_item['cat_slug'] ) ? bhaiyyantop_get_category_url( $post_item['cat_slug'] ) : '#';
} else {
    $post_id     = get_the_ID();
    $permalink   = get_permalink( $post_id );
    $title       = get_the_title( $post_id );
    $thumbnail   = get_the_post_thumbnail_url( $post_id, 'bhaiyyantop-thumb' );
    $author_name = get_the_author();
    $date        = get_the_date( 'j F, Y' );
    $author_url  = get_author_posts_url( get_the_author_meta( 'ID' ) );
}
?>

<article class="mini-news-card whole-card-link">
    <div class="mini-news-thumb">
        <?php if ( ! empty( $thumbnail ) ) : ?>
            <img src="<?php echo esc_url( $thumbnail ); ?>" alt="<?php echo esc_attr( $title ); ?>" loading="lazy">
        <?php else : ?>
            <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/hero_india_gate.png' ); ?>" alt="<?php echo esc_attr( $title ); ?>" loading="lazy">
        <?php endif; ?>
    </div>
    <div class="mini-news-content">
        <h3 class="mini-news-title">
            <a href="<?php echo esc_url( $permalink ); ?>" class="stretched-link"><?php echo esc_html( $title ); ?></a>
        </h3>
        <div class="post-meta">
            by <a href="<?php echo esc_url( $author_url ); ?>" class="author-link"><?php echo esc_html( $author_name ); ?></a> &bull; <?php echo esc_html( $date ); ?>
        </div>
    </div>
</article>
