<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Bhaiyyantop
 */

get_header();

// Increment post view counter
if ( function_exists( 'bhaiyyantop_set_post_views' ) ) {
    bhaiyyantop_set_post_views( get_the_ID() );
}
?>

<div class="main-wrapper">
    <div class="container theme-grid" style="grid-template-columns: 1fr 380px;">
        
        <main id="primary" class="site-main">
            <?php
            while ( have_posts() ) :
                the_post();

                get_template_part( 'template-parts/content', 'single' );

            endwhile; // End of the loop.
            ?>
        </main>

        <!-- Sidebar -->
        <?php get_sidebar(); ?>

    </div>
</div>

<?php
get_footer();
