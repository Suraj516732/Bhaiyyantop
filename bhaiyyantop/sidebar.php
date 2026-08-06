<?php
/**
 * The sidebar containing the main widget area
 *
 * @package Bhaiyyantop
 */

if ( ! is_active_sidebar( 'sidebar-1' ) ) {
    ?>
    <aside id="secondary" class="widget-area standard-sidebar">
        <section class="widget">
            <h3 class="widget-title">खोजें</h3>
            <?php get_search_form(); ?>
        </section>

        <section class="widget">
            <h3 class="widget-title">ताज़ा खबरें</h3>
            <ul>
                <?php
                $recent_posts = wp_get_recent_posts( array(
                    'numberposts' => 5,
                    'post_status' => 'publish',
                ) );
                if ( ! empty( $recent_posts ) ) {
                    foreach ( $recent_posts as $post ) {
                        echo '<li><a href="' . esc_url( get_permalink( $post['ID'] ) ) . '">' . esc_html( $post['post_title'] ) . '</a></li>';
                    }
                } else {
                    echo '<li>कोई हालिया पोस्ट उपलब्ध नहीं है।</li>';
                }
                ?>
            </ul>
        </section>

        <section class="widget">
            <h3 class="widget-title">श्रेणियां</h3>
            <ul>
                <?php wp_list_categories( array( 'title_li' => '' ) ); ?>
            </ul>
        </section>
    </aside>
    <?php
    return;
}
?>

<aside id="secondary" class="widget-area standard-sidebar">
    <?php dynamic_sidebar( 'sidebar-1' ); ?>
</aside>
