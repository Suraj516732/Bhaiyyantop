<?php
/**
 * Card Template Part: Latest News Grid Card
 * Implements Stretched Link pattern for whole-card clickability.
 *
 * @package Bhaiyyantop
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

$post_id    = get_the_ID();
$permalink  = get_permalink( $post_id );
$title      = get_the_title( $post_id );
$categories = get_the_category( $post_id );
$cat_name   = ! empty( $categories ) ? $categories[0]->name : 'समाचार';
$cat_url    = ! empty( $categories ) ? get_category_link( $categories[0]->term_id ) : '#';
$author_id  = get_the_author_meta( 'ID' );
$author_name = get_the_author();
$author_url  = get_author_posts_url( $author_id );
$date        = get_the_date( 'j F, Y' );
$excerpt     = wp_trim_words( get_the_excerpt( $post_id ), 25, '...' );
?>

<article id="post-<?php echo esc_attr( $post_id ); ?>" <?php post_class( 'grid-news-card whole-card-link' ); ?>>
    <div class="grid-news-thumb">
        <?php if ( has_post_thumbnail( $post_id ) ) : ?>
            <?php echo get_the_post_thumbnail( $post_id, 'bhaiyyantop-medium', array( 'alt' => esc_attr( $title ) ) ); ?>
        <?php else : ?>
            <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/city_skyline.png' ); ?>" alt="<?php echo esc_attr( $title ); ?>" loading="lazy">
        <?php endif; ?>
    </div>

    <div class="grid-news-content">
        <div class="post-card-top-meta">
            <a href="<?php echo esc_url( $cat_url ); ?>" class="cat-badge pink"><?php echo esc_html( $cat_name ); ?></a>
        </div>

        <h3 class="grid-news-title">
            <a href="<?php echo esc_url( $permalink ); ?>" class="stretched-link"><?php echo esc_html( $title ); ?></a>
        </h3>

        <?php if ( ! empty( $excerpt ) ) : ?>
            <div class="grid-news-excerpt">
                <?php echo esc_html( $excerpt ); ?>
            </div>
        <?php endif; ?>

        <div class="post-meta">
            by <a href="<?php echo esc_url( $author_url ); ?>" class="author-link"><?php echo esc_html( $author_name ); ?></a> &bull; <?php echo esc_html( $date ); ?>
        </div>
    </div>
</article>
