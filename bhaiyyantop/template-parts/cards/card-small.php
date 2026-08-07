<?php
/**
 * Card Component: Small Card
 * Compact mini news card for sidebar lists. Optimized for CLS & Core Web Vitals.
 *
 * @package Bhaiyyantop
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

$card = bhaiyyantop_get_card_data( $args );
?>

<div class="mini-news-card whole-card-link">
    <div class="mini-news-thumb">
        <img src="<?php echo esc_url( $card['thumbnail'] ); ?>" alt="<?php echo esc_attr( $card['title'] ); ?>" width="160" height="120" loading="lazy" decoding="async">
    </div>
    <div class="mini-news-content">
        <h4 class="mini-news-title">
            <a href="<?php echo esc_url( $card['permalink'] ); ?>" class="stretched-link"><?php echo esc_html( $card['title'] ); ?></a>
        </h4>
        <div class="post-meta">
            <?php esc_html_e( 'by', 'bhaiyyantop' ); ?> <span><?php echo esc_html( $card['author'] ); ?></span> &bull; <?php echo esc_html( $card['date'] ); ?>
        </div>
    </div>
</div>
