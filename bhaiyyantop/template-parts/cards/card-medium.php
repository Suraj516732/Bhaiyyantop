<?php
/**
 * Card Component: Medium Card
 * Wide featured card for in-feed mid sections. Optimized for CLS & Core Web Vitals.
 *
 * @package Bhaiyyantop
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

$card = bhaiyyantop_get_card_data( $args );
?>

<div class="mid-featured-story whole-card-link">
    <div class="mid-card-inner">
        <div class="mid-card-image">
            <img src="<?php echo esc_url( $card['thumbnail'] ); ?>" alt="<?php echo esc_attr( $card['title'] ); ?>" width="600" height="340" loading="lazy" decoding="async">
        </div>
        <div class="mid-card-content">
            <a href="<?php echo esc_url( $card['cat_url'] ); ?>" class="cat-badge teal"><?php echo esc_html( $card['category'] ); ?></a>
            <h3 class="mid-card-title">
                <a href="<?php echo esc_url( $card['permalink'] ); ?>" class="stretched-link"><?php echo esc_html( $card['title'] ); ?></a>
            </h3>
            <?php if ( ! empty( $card['excerpt'] ) ) : ?>
                <p class="mid-card-excerpt"><?php echo esc_html( $card['excerpt'] ); ?></p>
            <?php endif; ?>
            <div class="post-meta">
                <?php esc_html_e( 'by', 'bhaiyyantop' ); ?> <span><?php echo esc_html( $card['author'] ); ?></span> &bull; <?php echo esc_html( $card['date'] ); ?>
            </div>
        </div>
    </div>
</div>
