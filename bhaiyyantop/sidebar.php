<?php
/**
 * The sidebar containing the main widget area
 *
 * @package Bhaiyyantop
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

if ( ! is_active_sidebar( 'sidebar-1' ) ) {
    ?>
    <aside id="secondary" class="widget-area standard-sidebar">
        <section class="widget">
            <h3 class="widget-title"><?php esc_html_e( 'खोजें', 'bhaiyyantop' ); ?></h3>
            <?php get_search_form(); ?>
        </section>

        <section class="widget">
            <h3 class="widget-title"><?php esc_html_e( 'ताज़ा खबरें', 'bhaiyyantop' ); ?></h3>
            <ul>
                <?php
                $recent_count = get_theme_mod( 'bhaiyyantop_sidebar_recent_count', 5 );
                $recent_posts = get_transient( 'bhaiyyantop_sidebar_recent_posts' );
                if ( false === $recent_posts ) {
                    $recent_posts = wp_get_recent_posts( array(
                        'numberposts'      => absint( $recent_count ),
                        'post_status'      => 'publish',
                        'suppress_filters' => true,
                    ) );
                    set_transient( 'bhaiyyantop_sidebar_recent_posts', $recent_posts, 15 * MINUTE_IN_SECONDS );
                }
                if ( ! empty( $recent_posts ) ) {
                    foreach ( $recent_posts as $post ) {
                        echo '<li><a href="' . esc_url( get_permalink( $post['ID'] ) ) . '">' . esc_html( $post['post_title'] ) . '</a></li>';
                    }
                } else {
                    echo '<li>' . esc_html__( 'कोई हालिया पोस्ट उपलब्ध नहीं है।', 'bhaiyyantop' ) . '</li>';
                }
                ?>
            </ul>
        </section>

        <section class="widget">
            <h3 class="widget-title"><?php esc_html_e( 'श्रेणियां', 'bhaiyyantop' ); ?></h3>
            <ul>
                <?php wp_list_categories( array( 'title_li' => '' ) ); ?>
            </ul>
        </section>

        <?php if ( function_exists( 'bhaiyyantop_render_ad_block' ) ) bhaiyyantop_render_ad_block( 'sidebar_bottom' ); ?>
    </aside>
    <?php
    return;
}
?>

<aside id="secondary" class="widget-area standard-sidebar">
    <?php dynamic_sidebar( 'sidebar-1' ); ?>
    <?php if ( function_exists( 'bhaiyyantop_render_ad_block' ) ) bhaiyyantop_render_ad_block( 'sidebar_bottom' ); ?>
</aside>
