<?php
/**
 * Card Component: Editor's Choice Card
 * Reusable component supporting both 'hero' and 'wide' variants.
 *
 * @package Bhaiyyantop
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

$card        = bhaiyyantop_get_card_data( $args );
$variant     = isset( $args['variant'] ) ? $args['variant'] : 'hero';
$badge_color = isset( $args['badge_color'] ) ? $args['badge_color'] : 'teal';

if ( 'hero' === $variant ) :
    ?>
    <div class="editors-hero-card whole-card-link">
        <div class="editors-hero-img">
            <img src="<?php echo esc_url( $card['thumbnail'] ); ?>" alt="<?php echo esc_attr( $card['title'] ); ?>" loading="lazy" decoding="async">
            <span class="cat-badge pink"><?php echo esc_html( $card['category'] ); ?></span>
        </div>
        <div class="editors-hero-content">
            <h3 class="editors-hero-title">
                <a href="<?php echo esc_url( $card['permalink'] ); ?>" class="stretched-link"><?php echo esc_html( $card['title'] ); ?></a>
            </h3>
            <div class="post-meta">
                <?php esc_html_e( 'by', 'bhaiyyantop' ); ?> <span><?php echo esc_html( $card['author'] ); ?></span> &bull; <?php echo esc_html( $card['date'] ); ?>
            </div>
        </div>
    </div>
    <?php
else :
    ?>
    <div class="editors-wide-card whole-card-link">
        <div class="editors-wide-thumb">
            <img src="<?php echo esc_url( $card['thumbnail'] ); ?>" alt="<?php echo esc_attr( $card['title'] ); ?>" loading="lazy" decoding="async">
        </div>
        <div class="editors-wide-content">
            <a href="<?php echo esc_url( $card['cat_url'] ); ?>" class="cat-badge <?php echo esc_attr( $badge_color ); ?>"><?php echo esc_html( $card['category'] ); ?></a>
            <h4 class="editors-wide-title">
                <a href="<?php echo esc_url( $card['permalink'] ); ?>" class="stretched-link"><?php echo esc_html( $card['title'] ); ?></a>
            </h4>
            <div class="post-meta">
                <?php esc_html_e( 'by', 'bhaiyyantop' ); ?> <span><?php echo esc_html( $card['author'] ); ?></span> &bull; <?php echo esc_html( $card['date'] ); ?>
            </div>
        </div>
    </div>
    <?php
endif;
