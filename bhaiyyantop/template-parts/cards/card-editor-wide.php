<?php
/**
 * Card Template Part: Editor's Choice Wide Card
 * Implements Stretched Link pattern for whole-card clickability.
 *
 * @package Bhaiyyantop
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

$ed_item  = isset( $args['item'] ) ? $args['item'] : null;
$badge_color = isset( $args['badge_color'] ) ? $args['badge_color'] : 'teal';

if ( $ed_item ) {
    $permalink   = isset( $ed_item['permalink'] ) ? $ed_item['permalink'] : get_permalink( $ed_item['id'] );
    $title       = isset( $ed_item['title'] ) ? $ed_item['title'] : get_the_title( $ed_item['id'] );
    $thumbnail   = isset( $ed_item['thumbnail'] ) ? $ed_item['thumbnail'] : get_the_post_thumbnail_url( $ed_item['id'], 'bhaiyyantop-thumb' );
    $category    = isset( $ed_item['category'] ) ? $ed_item['category'] : 'समाचार';
    $cat_url     = isset( $ed_item['cat_url'] ) ? $ed_item['cat_url'] : '#';
    $author_name = isset( $ed_item['author'] ) ? $ed_item['author'] : get_the_author();
    $date        = isset( $ed_item['date'] ) ? $ed_item['date'] : get_the_date( 'j F, Y' );
} else {
    $post_id     = get_the_ID();
    $permalink   = get_permalink( $post_id );
    $title       = get_the_title( $post_id );
    $thumbnail   = get_the_post_thumbnail_url( $post_id, 'bhaiyyantop-thumb' );
    $categories  = get_the_category( $post_id );
    $category    = ! empty( $categories ) ? $categories[0]->name : 'समाचार';
    $cat_url     = ! empty( $categories ) ? get_category_link( $categories[0]->term_id ) : '#';
    $author_name = get_the_author();
    $date        = get_the_date( 'j F, Y' );
}
?>

<article class="editors-wide-card whole-card-link">
    <div class="editors-wide-content">
        <a href="<?php echo esc_url( $cat_url ); ?>" class="cat-badge <?php echo esc_attr( $badge_color ); ?>"><?php echo esc_html( $category ); ?></a>
        <h3 class="editors-wide-title">
            <a href="<?php echo esc_url( $permalink ); ?>" class="stretched-link"><?php echo esc_html( $title ); ?></a>
        </h3>
        <div class="post-meta">by <span><?php echo esc_html( $author_name ); ?></span> &bull; <?php echo esc_html( $date ); ?></div>
    </div>
    <div class="editors-wide-thumb">
        <img src="<?php echo esc_url( $thumbnail ); ?>" alt="<?php echo esc_attr( $title ); ?>">
    </div>
</article>
