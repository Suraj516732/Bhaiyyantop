<?php
/**
 * Card Component: Category Grid Card
 * Reusable grid card component for Homepage grid & Category archive feeds.
 * Optimized for CLS & Core Web Vitals.
 *
 * @package Bhaiyyantop
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

$card = bhaiyyantop_get_card_data( $args );
?>

<div class="grid-news-card whole-card-link">
    <div class="card-thumb-wrap">
        <img src="<?php echo esc_url( $card['thumbnail'] ); ?>" alt="<?php echo esc_attr( $card['title'] ); ?>" width="400" height="260" loading="lazy" decoding="async">
    </div>
    <div class="card-body">
        <a href="<?php echo esc_url( $card['cat_url'] ); ?>" class="cat-badge pink"><?php echo esc_html( $card['category'] ); ?></a>
        <h3 class="card-title">
            <a href="<?php echo esc_url( $card['permalink'] ); ?>" class="stretched-link"><?php echo esc_html( $card['title'] ); ?></a>
        </h3>
        <div class="post-meta">
            <?php esc_html_e( 'by', 'bhaiyyantop' ); ?> <span><?php echo esc_html( $card['author'] ); ?></span> &bull; <?php echo esc_html( $card['date'] ); ?>
        </div>
    </div>
</div>
