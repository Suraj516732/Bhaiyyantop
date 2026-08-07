<?php
/**
 * Card Component: Large / Hero Card
 * Optimized for Core Web Vitals (LCP fetchpriority="high", explicit dimensions, CLS prevention).
 *
 * @package Bhaiyyantop
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

$card         = bhaiyyantop_get_card_data( $args );
$is_first     = isset( $args['is_first'] ) ? $args['is_first'] : true;
$loading_attr = $is_first ? 'fetchpriority="high" decoding="async"' : 'loading="lazy" decoding="async"';
?>

<div class="hero-slide active whole-card-link">
    <img src="<?php echo esc_url( $card['thumbnail'] ); ?>" alt="<?php echo esc_attr( $card['title'] ); ?>" width="800" height="450" <?php echo $loading_attr; ?>>
    <div class="hero-overlay">
        <a href="<?php echo esc_url( $card['cat_url'] ); ?>" class="cat-badge pink"><?php echo esc_html( $card['category'] ); ?></a>
        <h2 class="hero-title">
            <a href="<?php echo esc_url( $card['permalink'] ); ?>" class="stretched-link"><?php echo esc_html( $card['title'] ); ?></a>
        </h2>
        <?php if ( ! empty( $card['excerpt'] ) ) : ?>
            <p class="hero-excerpt"><?php echo esc_html( $card['excerpt'] ); ?></p>
        <?php endif; ?>
        <div class="post-meta">
            <?php esc_html_e( 'by', 'bhaiyyantop' ); ?> <span><?php echo esc_html( $card['author'] ); ?></span> &bull; <?php echo esc_html( $card['date'] ); ?>
        </div>
    </div>
</div>
