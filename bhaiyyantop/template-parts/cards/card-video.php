<?php
/**
 * Card Component: Video Card
 * Video post card with play icon overlay badge and duration label.
 *
 * @package Bhaiyyantop
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

$card     = bhaiyyantop_get_card_data( $args );
$duration = isset( $args['duration'] ) ? $args['duration'] : '03:45';
?>

<div class="grid-news-card whole-card-link card-video-item">
    <div class="card-thumb-wrap">
        <img src="<?php echo esc_url( $card['thumbnail'] ); ?>" alt="<?php echo esc_attr( $card['title'] ); ?>" loading="lazy" decoding="async">
        <div class="play-icon-overlay" aria-hidden="true"><i class="fa fa-play"></i></div>
        <span class="video-duration-badge"><?php echo esc_html( $duration ); ?></span>
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
